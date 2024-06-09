<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

/**
 * Class CartController
 *
 * La clase CategoriesController se encarga de todas las interacciones entre el usuario y su carrito de compras,
 * asegurando que las operaciones de compra se realicen de manera correcta y eficiente.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class CartController extends Controller{
    /**
     * Muestra el carrito de compras actual.
     *
     * Recupera el carrito de compras actual de la sesion. Si no hay ningun carrito en la sesion,
     * inicializa un array vacio como el carrito. Devuelve la vista del carrito con los datos del
     * carrito para mostrar los elementos actualmente en el carrito de compras.
     *
     * @return \Illuminate\View\View Devuelve una vista que muestra el carrito de compras.
     */
    public function showCart(){
        $cart = Session::get('cart', []);
        $cartItems = [];
        $totalPrice = 0;
        foreach ($cart as $item) {
            $product = $this->getProduct($item['product_id']);
            $totalPrice += $product->price * $item['stock'];
            $cartItems[] = [
                'product' => $product,
                'quantity' => $item['stock'],
            ];
        }

        return view('cart.cart')->with('cartItems', $cartItems)->with('totalPrice', $totalPrice);
    }

    /**
     * Muestra la pagina de pago.
     *
     * Obtiene el usuario actual y la direccion de envio del usuario desde la base de datos.
     * Calcula el precio total, el ahorro y el impuesto sobre el precio total de los productos en el carrito.
     * Devuelve la vista de pago con los datos calculados y la direccion de envio.
     *
     * @return \Illuminate\View\View Devuelve una vista que muestra la pagina de pago.
     */
    public function payment(){
        $user = User::find(Auth::id());
        $address = $user->addresses()->orderBy('id', 'desc')->first();
        $cart = Session::get('cart', []);
        $totalPrice = 0;
        $save = 0;
        foreach ($cart as $item) {
            $product = $this->getProduct($item['product_id']);
            $totalPrice += $product->price * $item['stock'];
            if($product->price_before && $product->price_before > 0){
                $save += ($product->price_before - $product->price) * $item['stock'];
            }
        }
        $tax = $totalPrice * 0.21;
        $total = $totalPrice + $tax;
        return view('layouts.payment')
            ->with('totalPrice', $totalPrice)
            ->with('save', $save)
            ->with('tax', $tax)
            ->with('total', $total)
            ->with('address', $address);
    }

    /**
     * Actualiza la cantidad de un producto especifico en el carrito de compras.
     *
     * Valida la cantidad solicitada en relacion con el stock disponible del producto.
     * Si la validacion es exitosa, actualiza la cantidad del producto especificado en el
     * carrito de compras almacenado en la sesion. También actualiza el numero total de
     * elementos en el carrito. Redirecciona a la pagina anterior tras una actualizacion
     * exitosa o en caso de un error con un mensaje flash apropiado.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos del formulario de actualizacion.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la pagina anterior con un mensaje de exito o error.
     */
    public function updateCartLine(Request $request){
        try {
            $product = $this->getProduct($request->id);

            $request->validate([
                'stock' => 'required|gt:0|lte:' . $product->stock,
            ]);

            $cart = Session::get('cart', []);
            $totalItems = Session::get('totalItems', 0);

            foreach ($cart as $key => $item) {
                if ($key == $request->key) {
                    $totalItems -= $cart[$key]['stock'];
                    $cart[$key]['stock'] = $request->stock;
                    $totalItems += $cart[$key]['stock'];
                    break;
                }
            }
            Session::put('cart', $cart);
            Session::put('totalItems', $totalItems);
            return redirect()->back();
        } catch (Exception $e) {
            flash('Error updating cart line ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Elimina una linea de producto especifica del carrito de compras.
     *
     * Itera a traves de los elementos del carrito almacenados en la sesion para encontrar la linea de producto
     * que coincida con la clave proporcionada en la solicitud. Al encontrar el elemento coincidente, deduce la
     * cantidad de ese elemento del recuento total de elementos y elimina el elemento del carrito. Actualiza el
     * carrito y el recuento total de elementos en la sesion. Redirecciona a la pagina anterior tras la eliminacion
     * exitosa o en caso de un error con un mensaje flash apropiado.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene la clave de la linea de producto a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la pagina anterior con un mensaje de exito o error.
     */
    public function destroyCartLine(Request $request){
        try {
            $cart = Session::get('cart', []);
            $totalItems = Session::get('totalItems', 0);

            foreach ($cart as $key => $item) {
                if ($key == $request->key) {
                    $totalItems = max(0, $totalItems - $cart[$key]['stock']);
                    unset($cart[$key]);
                    break;
                }
            }
            $cart = array_values($cart);
            Session::put('cart', $cart);
            Session::put('totalItems', $totalItems);
            return redirect()->back();
        } catch (Exception $e) {
            flash('Error updating cart line ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Obtiene un producto de la cache si esta disponible; de lo contrario, lo recupera de la base de datos.
     *
     * @param int $id El ID del producto que se va a obtener.
     * @return \App\Models\Product|null El producto recuperado de la cache o de la base de datos.
     */
    private function getProduct($id){
        return Cache::has($id) ? Cache::get($id) : Product::find($id);
    }
}
