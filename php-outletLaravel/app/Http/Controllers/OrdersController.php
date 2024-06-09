<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class OrdersController
 *
 *Controlador que gestiona las operaciones relacionadas con las ordenes de compra.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class OrdersController extends Controller{

    /**
     * Crea una nueva orden de compra.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los detalles de la orden.
     * @return \Illuminate\Http\RedirectResponse Redirige de vuelta a la pagina de la orden con un mensaje flash.
     */
    public function createOrder(Request $request){
        $request->validate([
            'name' => 'min:3|max:50|required',
            'lastName' => 'min:3|max:75|required',
            'dni' => 'regex:/^\d{8}[a-zA-Z]$/|required',
            'street' => 'min:5|max:100|required',
            'number' => 'sometimes|min:1|max:7',
            'city' => 'min:3|max:50|required',
            'province' => 'min:3|max:70|required',
            'postCode' => 'regex:/^\d{5}$/|required',
            'additionalInfo' => 'sometimes|max:150',
            'card' => 'required|regex:/^\d{16}$/',
            'expiry' => 'required|regex:/^[0-9]{2}\/[0-9]{2}$/',
            'cvv' => 'required|regex:/^\d{3}$/'
        ]);
        $adress = new Address($request->all());
        $adress->country = "Spain";
        $adress->user_id = Auth::id();
        $cart = Session::get('cart', []);
        $order = new Order();
        $order->user_id = Auth::id();
        $order->save();
        $adress->save();

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            $orderLine = new OrderLine();
            $orderLine->order_id = $order->id;
            $orderLine->product_id = $product->id;
            $orderLine->stock = $item['stock'];
            $product->stock -= $orderLine->stock;
            $orderLine->unitPrice = $product->price;
            $orderLine->linePrice = $product->price * $orderLine->stock;
            $order->totalItems += $orderLine->stock;
            $order->totalPrice += $orderLine->linePrice;
            $order->tax += $orderLine->linePrice * 0.21;
            $order->total = $order->totalPrice + $order->tax;
            $product->save();
            $orderLine->save();
            $order->save();
        }
        Session::forget('cart');
        Session::forget('totalItems');
        Session::put('totalItems', 0);

        flash('Order successfully made.')->success()->important();
        return $this->generateInvoice($order, $order->orderLines, $adress);
    }

    /**
     * Genera una factura en formato PDF para una orden dada.
     *
     * @param \App\Models\Order $order La orden para la cual se generara la factura.
     * @param \Illuminate\Database\Eloquent\Collection $orderLines Las lineas de la orden.
     * @param \App\Models\Address $address La direccion de entrega de la orden.
     * @return \Illuminate\Http\Response La respuesta HTTP que contiene la factura en formato PDF para descargar.
     */
    public function generateInvoice($order, $orderLines, $address){
        $user = User::find(Auth::id());
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', ['user' => $user, 'order' => $order, 'address' => $address, 'orderLines' => $orderLines]);
        return $pdf->download(Carbon::now() . $order->id . '.pdf');
    }
    /**
     * Obtiene todas las ordenes.
     *
     * @return \Illuminate\View\View La vista que muestra todas las ordenes.
     */
    public function getOrders(){
        $orders = Order::all();
        return view('orders.index')->with('orders', $orders);
    }

    /**
     * Obtiene todas las ordenes del usuario autenticado.
     *
     * @return \Illuminate\View\View La vista que muestra todas las ordenes del usuario autenticado.
     */
    public function getMeOrders(){
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.index')->with('orders', $orders);
    }

    /**
     * Obtiene una orden por su ID.
     *
     * @param int $id El ID de la orden.
     * @return \Illuminate\View\View La vista que muestra los detalles de la orden.
     */
    public function getOrderById($id){
        $order = Order::find($id);
        return view('orders.show')->with('order', $order);
    }

    /**
     * Obtiene una orden del usuario autenticado por su ID.
     *
     * @param int $id El ID de la orden.
     * @return \Illuminate\View\View La vista que muestra los detalles de la orden del usuario autenticado.
     */
    public function getMeOrderById($id){
        $order = Order::find($id)
            ->where('user_id', Auth::id())
            ->first();
        return view('orders.show')->with('order', $order);
    }

    /**
     * Muestra el formulario para realizar una nueva orden.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP.
     * @return \Illuminate\View\View La vista que muestra el formulario para realizar una nueva orden.
     */
    public function storeOrder(Request $request){
        $user = User::find(Auth::id());
        $addresses = $user->addresses();
        $cart = Session::get('cart');
        return view('orders.store')->with('cart', $cart)->with('address', $addresses);
    }

    /**
     * Cancela y devuelve una orden por su ID, devolviendo el stock de los productos asociados.
     *
     * @param int $id El ID de la orden que se desea cancelar y devolver.
     * @return \Illuminate\Http\RedirectResponse Redirige a la página de todas las ordenes.
     */
    public function returnOrderById($id){
        try {
            $order = Order::find($id);
            foreach ($order->orderLines() as $orderline) {
                $product = Product::find($orderline->product_id);
                $product->stock += $orderline->stock;
                $product->save();
            }
            $order->delete();
            return redirect()->route('orders.index');
        } catch (Exception $e) {
            flash('Error returning the order' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Cancela y devuelve una orden del usuario autenticado por su ID, devolviendo el stock de los productos asociados.
     *
     * @param int $id El ID de la orden del usuario autenticado que se desea cancelar y devolver.
     * @return \Illuminate\Http\RedirectResponse Redirige a la pagina de todas las ordenes.
     */
    public function returnMeOrderById($id){
        try {
            $order = Order::find($id)
                ->where('user_id', Auth::id())
                ->first();
            foreach ($order->orderLine as $orderline) {
                $product = Product::find($orderline->product_id);
                $product->stock += $orderline->stock;
                $product->save();
            }
            $order->delete();
            return redirect()->route('orders.index');
        } catch (Exception $e) {
            flash('Error returning the order' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Elimina una orden por su ID.
     *
     * @param int $id El ID de la orden que se desea eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige a la pagina de todas las ordenes.
     */
    public function destroyOrderById($id){
        try {
            $order = Order::find($id);
            $order->delete();
            flash('Order ' . $order->id . ' deleted successfully.')->error()->important();
            return redirect()->route('orders.index');
        } catch (Exception $e) {
            flash('Error deleting the order' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Elimina una orden del usuario autenticado por su ID.
     *
     * @param int $id El ID de la orden del usuario autenticado que se desea eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige a la página de todas las órdenes.
     */
    public function destroyMeOrderById($id){
        try {
            $order = Order::find($id)
                ->where('user_id', Auth::id())
                ->first();
            $order->delete();
            flash('Order ' . $order->id . ' deleted successfully.')->error()->important();
            return redirect()->route('orders.index');
        } catch (Exception $e) {
            flash('Error deleting the order' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }
}
