<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Provider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ProductsController
 *
 *Controlador que maneja las acciones relacionadas con los productos.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class ProductsController extends Controller{

    /**
     * Muestra una lista paginada de productos, opcionalmente filtrados y ordenados.
     *
     * @param \Illuminate\Http\Request $request La solicitud que puede contener parametros de filtrado y orden.
     * @return \Illuminate\View\View La vista que muestra la lista de productos.
     */
    public function index(Request $request){
        $products = Product::filtrar($request->search, $request->category)->orderBy($request->orderBy ?? 'id', $request->order ?? 'asc')->paginate($request->paginate ?? 6);
        $categories = Category::all();
        return view('products.index')->with('products', $products)
            ->with('categories', $categories);
    }

    /**
     * Muestra una lista paginada de todos los productos.
     *
     * @return \Illuminate\View\View La vista que muestra la lista de productos.
     */
    public function products(){
        $products = Product::orderBy('id', 'asc')->paginate(6);
        return view('products.gestion')->with('products', $products);
    }

    /**
     * Anade un producto al carrito de compras.
     *
     * @param \Illuminate\Http\Request $request La solicitud que contiene los detalles del producto a agregar.
     * @param string $id El ID del producto que se va a agregar al carrito.
     * @return \Illuminate\Http\RedirectResponse Redirige de nuevo a la pagina del producto con un mensaje flash.
     */
    public function addToCart(Request $request, $id){
        try {
            $product = $this->getProduct($id);
            $request->validate([
                'stock' => 'required|gt:0|lte:' . $product->stock,
            ]);
            $cart = Session::get('cart', []);
            $totalItems = Session::get('totalItems', 0);
            $totalItems += $request->stock;
            $newItem = [
                'product_id' => $product->id,
                'stock' => $request->stock,
            ];
            $cart[] = $newItem;
            Session::put('cart', $cart);
            Session::put('totalItems', $totalItems);
            Cache::put($id, $product, 300);
            flash($request->stock . ' ' . $product->name . ' added to cart.')->success()->important();
            return redirect()->back();
        } catch (Exception $e) {
            flash('Error adding ' . $product->name . ' to cart.' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Muestra los detalles de un producto y los productos relacionados.
     *
     * @param string $id El ID del producto.
     * @return \Illuminate\View\View La vista que muestra los detalles del producto.
     */
    public function show($id){
        $product = $this->getProduct($id);
        $relatedProducts = Product::where('category_id', '=', $product->category_id)->where('id', "<>", $id)->get();
        Cache::put($id, $product, 300);
        $cart = Session::get('cart', []);
        foreach ($cart as $item) {
            if($item['product_id'] == $id){
                $product->stock -= $item['stock'];
            };
        }
        return view('products.show')->with('product', $product)->with('relatedProducts', $relatedProducts);
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\View\View La vista que muestra el formulario de creacion de productos.
     */
    public function create(){
        $categories = Category::where('id', '<>', 1)->get();
        return view('products.create')->with('categories', $categories);
    }

    /**
     * Obtiene los productos por categoria y los muestra paginados.
     *
     * @param string $id El ID de la categoria.
     * @return \Illuminate\View\View La vista que muestra los productos de una categoria especifica.
     */
    public function getProductsByCategory($id){
        $products = Product::where('category_id', "=", $id)->orderBy('id', 'asc')->paginate(5);
        return view('products.index')->with('products', $products);
    }

    /**
     * Obtiene los productos por genero y los muestra paginados.
     *
     * @param string $sex El genero de los productos.
     * @return \Illuminate\View\View La vista que muestra los productos de un genero especifico.
     */
    public function getProductsBySex($sex){
        $products = Product::where('sex', "=", $sex)->orderBy('id', 'asc')->paginate(5);
        $categories = Category::where('id', '<>', 1)->get();
        return view('products.index')->with('products', $products)->with('categories', $categories);
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     *
     * @param \Illuminate\Http\Request $request La solicitud que contiene los datos del nuevo producto.
     * @return \Illuminate\Http\RedirectResponse Redirige de nuevo a la lista de productos con un mensaje flash.
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'min:3|max:120|required|unique:products,name',
            'sex' => 'required',
            'description' => 'max:255|sometimes',
            'price' => 'required|regex:/^\d{1,6}(\.\d{1,2})?$/',
            'price_before' => 'sometimes|regex:/^\d{1,6}(\.\d{1,2})?$/',
            'stock' => 'required|integer|max:10000',
            'category' => 'sometimes|exists:categories,id',
        ]);

        try {
            $product = new Product($request->all());
            $product->id = Str::uuid();
            $product->category_id = $request->category ?? 1;
            $product->save();
            flash('Product ' . $product->name . ' created successfully.')->success()->important();
            return redirect()->route('products.index');
        } catch (Exception $e) {
            flash('Error creating the product. ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Muestra el formulario para editar un producto.
     *
     * @param string $id El ID del producto a editar.
     * @return \Illuminate\View\View La vista que muestra el formulario de edicion de productos.
     */
    public function edit($id){
        $product = $this->getProduct($id);
        $categories = Category::where('id', '<>', 1)->get();
        Cache::put($id, $product, 300);
        return view('products.edit')
            ->with('product', $product)
            ->with('categories', $categories);
    }

    /**
     * Actualiza un producto existente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request La solicitud que contiene los datos actualizados del producto.
     * @param string $id El ID del producto que se va a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirige de nuevo a la lista de productos con un mensaje flash.
     */
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'min:3|max:120|required|unique:products,name,' . $id,
            'description' => 'max:255|sometimes',
            'sex' => 'required',
            'price' => 'required|regex:/^\d{1,6}(\.\d{1,2})?$/',
            'price_before' => 'sometimes|regex:/^\d{1,6}(\.\d{1,2})?$/',
            'stock' => 'required|integer|max:10000',
            'category' => 'sometimes|exists:categories,id',
        ]);
        try {
            $product = $this->getProduct($id);
            $product->sex = $request->sex;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price_before = $request->price_before;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category ?? 1;
            $product->save();
            $cart = Session::get('cart', []);
            $totalItems = Session::get('totalItems', 0);
            $totalToRemove = 0;

            foreach ($cart as $key => $item) {
                if ($item['product_id'] == $id) {
                    $totalToRemove += $item['stock'];
                    unset($cart[$key]);
                }
            }
            Session::put('cart', array_values($cart));
            Session::put('totalItems', max(0, $totalItems - $totalToRemove));
            Cache::forget($product->id);
            flash('Product ' . $product->name . ' updated successfully.')->warning()->important();
            return redirect()->route('products.index');
        } catch (Exception $e) {
            flash('Error updating the product' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Muestra el formulario para editar la imagen de un producto.
     *
     * @param string $id El ID del producto cuya imagen se va a editar.
     * @return \Illuminate\View\View La vista que muestra el formulario de edicion de imagen de productos.
     */
    public function editImage($id){
        $product = $this->getProduct($id);
        Cache::put($id, $product, 300);
        return view('products.image')->with('product', $product);
    }

    /**
     * Actualiza la imagen de un producto existente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request La solicitud que contiene la imagen actualizada del producto.
     * @param string $id El ID del producto cuya imagen se va a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirige de nuevo a la lista de productos con un mensaje flash.
     */
    public function updateImage(Request $request, $id){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            $product = $this->getProduct($id);
            if ($product->image != Product::$IMAGE_DEFAULT && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileToSave = $product->id . '.' . $extension;
            $product->image = $image->storeAs('products', $fileToSave, 'public');
            $product->save();
            Cache::forget($product->id);
            flash('Product ' . $product->name . ' updated successfully.')->warning()->important();
            return redirect()->route('products.index');
        } catch (Exception $e) {
            flash('Error updating the product' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param string $id El ID del producto que se va a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige de nuevo a la lista de productos con un mensaje flash.
     */
    public function destroy($id){
        try {
            $product = $this->getProduct($id);
            if ($product->image != Product::$IMAGE_DEFAULT && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
            $product->delete();
            $cart = Session::get('cart', []);

            $totalItems = Session::get('totalItems', 0);
            $totalToRemove = 0;

            foreach ($cart as $key => $item) {
                if ($item['product_id'] == $id) {
                    $totalToRemove += $item['stock'];
                    unset($cart[$key]);
                }
            }
            Session::put('cart', array_values($cart));
            Session::put('totalItems', max(0, $totalItems - $totalToRemove));
            Cache::forget($product->id);
            flash('Product ' . $product->name . ' deleted successfully.')->error()->important();
            return redirect()->route('products.index');
        } catch (Exception $e) {
            flash('Error deleting the product' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }


    /**
     * Obtiene un producto por su ID, utilizando la cache si esta disponible.
     *
     * @param string $id El ID del producto que se va a obtener.
     * @return \App\Models\Product|null El producto correspondiente al ID proporcionado, o null si no se encuentra.
     */
    private function getProduct($id){
        return Cache::has($id) ?  Cache::get($id) : Product::find($id);
    }
}
