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

class ProductsController extends Controller{
    public function index(Request $request){
        $products = Product::filtrar($request->search, $request->category)->orderBy($request->orderBy ?? 'id', $request->order ?? 'asc')->paginate($request->paginate ?? 6);
        $categories = Category::all();
        return view('products.index')->with('products', $products)
            ->with('categories', $categories);
    }

    public function products(){
        $products = Product::orderBy('id', 'asc')->paginate(6);
        return view('products.gestion')->with('products', $products);
    }

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

    public function create(){
        $categories = Category::where('id', '<>', 1)->get();
        return view('products.create')->with('categories', $categories);
    }

    public function getProductsByCategory($id){
        $products = Product::where('category_id', "=", $id)->orderBy('id', 'asc')->paginate(5);
        return view('products.index')->with('products', $products);
    }

    public function getProductsBySex($sex){
        $products = Product::where('sex', "=", $sex)->orderBy('id', 'asc')->paginate(5);
        $categories = Category::where('id', '<>', 1)->get();
        return view('products.index')->with('products', $products)->with('categories', $categories);
    }

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

    public function edit($id){
        $product = $this->getProduct($id);
        $categories = Category::where('id', '<>', 1)->get();
        Cache::put($id, $product, 300);
        return view('products.edit')
            ->with('product', $product)
            ->with('categories', $categories);
    }

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

    public function editImage($id){
        $product = $this->getProduct($id);
        Cache::put($id, $product, 300);
        return view('products.image')->with('product', $product);
    }

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

    private function getProduct($id){
        return Cache::has($id) ?  Cache::get($id) : Product::find($id);
    }
}
