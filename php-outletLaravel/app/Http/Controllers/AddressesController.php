<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
/**
 * Class AddressesController
 *
 * La clase AddressesController gestiona operaciones relacionadas con las direcciones de envio en nuestra aplicacion.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class AddressesController extends Controller{
    /**
     * Obtiene todas las direcciones y las muestra.
     *
     * Obtiene todas las direcciones de la cache si estan disponibles, de lo contrario,
     * obtiene todas las direcciones de la base de datos y las almacena en la cache durante
     * 300 segundos. Luego devuelve la vista de indice con las direcciones recuperadas.
     *
     * @return \Illuminate\View\View Retorna la vista de indice que muestra las direcciones.
     * @throws \Exception
     */
    public function getAddresses(){
        $addresses = Cache::has('addresses') ? Cache::get('addresses') : Address::all();
        Cache::put('addresses', $addresses, 300);
        return view('addresses.index')->with('addresses', $addresses);
    }

    /**
     * Obtiene las direcciones asociadas con el usuario autenticado y las muestra.
     *
     * @return \Illuminate\View\View Retorna la vista de indice que muestra las direcciones del usuario.
     */
    public function getMeAddresses(){
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('addresses.index')->with('addresses', $addresses);
    }

    /**
     * Obtiene una direccion especifica por su ID y la muestra.
     *
     * @param int $id El ID de la direccion a recuperar.
     * @return \Illuminate\View\View Retorna la vista que muestra la direccion.
     */
    public function getAddressById($id){
        $address = Cache::has('address' . $id) ? Cache::get('address' . $id) : Address::find($id);
        Cache::put('address' . $id, $address, 300);
        return view('address.show')->with('address', $address);
    }

    /**
     * Obtiene una direccion especifica por su ID para el usuario autenticado y la muestra.
     *
     * @param int $id El ID de la direccion a recuperar.
     * @return \Illuminate\View\View Retorna la vista que muestra la direccion.
     */
    public function getMeAddressById($id){
        $address = Address::find($id)
            ->where('user_id', Auth::id())
            ->first();
        return view('address.show')->with('address', $address);
    }

    /**
     * Muestra el formulario para crear una nueva direccion.
     *
     * @return \Illuminate\View\View Retorna la vista con el formulario para crear una nueva direccion.
     */
    public function createAddress(){
        return view('addresses.create');
    }

    /**
     * Almacena una nueva direccion para el usuario autenticado.
     *
     * Valida los datos de la solicitud entrante para la creacion de la direccion. Si la validacion
     * es exitosa, crea una nueva instancia de Address con los datos de la solicitud, la asocia con el ID
     * de usuario autenticado y la guarda en la base de datos. Limpia la cache de direcciones para reflejar
     * la nueva adición. En caso de creacion exitosa, redirige a la ruta de indice de direcciones con un mensaje
     * flash de exito. Si ocurre un error durante la creacion, redirige de nuevo con un mensaje flash de error.
     *
     * @param \Illuminate\Http\Request $request El objeto de solicitud HTTP.
     * @return \Illuminate\Http\RedirectResponse Redirige a la vista correspondiente con un mensaje flash.
     */
    public function storeMeAddress(Request $request){
        $request->validate([
            'name' => 'min:3|max:50|required',
            'lastName' => 'min:3|max:75|required',
            'dni' => 'regex:/^\d{8}[a-zA-a]$/|required',
            'street' => 'min:5|max:100|required',
            'number' => 'sometimes|min:1|max:7',
            'city' => 'min:3|max:50|required',
            'province' => 'min:3|max:70|required',
            'country' => 'min:3|max:70|required',
            'postCode' => 'regex:/^\d{5}$/|required',
            'additionalInfo' => 'sometimes|max:150'
        ]);

        try {
            $address = new Address($request->all());
            $address->user_id = Auth::id();
            $address->save();
            Cache::forget('addresses');
            flash('New address created successfully.')->success()->important();
            return redirect()->route('addresses.index');
        } catch (Exception $e) {
            flash('Error creating the address. ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Muestra el formulario de edicion para una direccion especifica del usuario autenticado.
     *
     * Encuentra la direccion por su ID, asegurandose de que pertenece al usuario autenticado actualmente.
     * Si se encuentra, devuelve la vista de edicion con los datos de la direccion para su edicion. Esto asegura que
     * los usuarios solo puedan editar sus propias direcciones.
     *
     * @param int|string $id El ID de la direccion que se va a editar.
     * @return \Illuminate\View\View Retorna la vista para editar la direccion especificada.
     */
    public function editMeAddress($id){
        $address = Address::find($id)->where('user_id', Auth::id())->first();
        return view('addresses.edit')->with('address', $address);
    }

    /**
     * Muestra el formulario de edicion para una direccion especifica.
     *
     * Encuentra la direccion por su ID y devuelve la vista de edicion con los datos de la direccion
     * para su edicion. Este metodo no restringe la edicion en funcion del usuario, por lo que debe
     * usarse con precaucion y se deben implementar controles de autorizacion adecuados en otro lugar
     * para garantizar la seguridad de los datos.
     *
     * @param int|string $id El ID de la direccion que se va a editar.
     * @return \Illuminate\View\View Retorna la vista para editar la direccion especificada.
     */
    public function editAddress($id){
        $address = Cache::has('address' . $id) ? Cache::get('address' . $id) : Address::find($id);
        Cache::put('address' . $id, $address, 300);
        return view('addresses.edit')->with('address', $address);
    }

    /**
     * Actualiza la direccion especificada del usuario autenticado.
     *
     * Valida los datos de la solicitud entrante para la actualizacion de la direccion. Si la validacion
     * es exitosa, intenta encontrar y actualizar la direccion perteneciente al usuario autenticado con
     * el ID proporcionado. El método asegura que solo el propietario de la direccion pueda actualizarla.
     * Tras la actualizacion exitosa, elimina las caches relevantes y redirige a la ruta de indice de direcciones
     * con un mensaje flash de exito. Si ocurre algún error durante la actualizacion, redirige de nuevo con un
     * mensaje flash de error.
     *
     * @param \Illuminate\Http\Request $request El objeto de solicitud HTTP.
     * @param int|string $id El ID de la direccion que se va a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirige a la vista correspondiente con mensaje flash.
     */
    public function updateMeAddress(Request $request, $id){
        $request->validate([
            'name' => 'min:3|max:50|required',
            'lastName' => 'min:3|max:75|required',
            'dni' => 'regex:/^\d{8}[a-zA-a]$/|required',
            'street' => 'min:5|max:100|required',
            'number' => 'sometimes|min:1|max:7',
            'city' => 'min:3|max:50|required',
            'province' => 'min:3|max:70|required',
            'country' => 'min:3|max:70|required',
            'postCode' => 'regex:/^\d{5}$/|required',
            'additionalInfo' => 'sometimes|max:150'
        ]);

        try {
            $address = Address::find($id)->where('user_id', Auth::id())->first();
            $address->update($request->all());
            Cache::forget('address' . $id);
            Cache::forget('addresses');
            flash('Address updated successfully.')->warning()->important();
            return redirect()->route('addresses.index');
        } catch (Exception $e) {
            flash('Error updating the address' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Elimina una direccion especifica.
     *
     * Intenta encontrar y eliminar la direccion con el ID proporcionado. Tras la eliminacion exitosa,
     * se borran las caches relevantes para garantizar que el sistema refleje la ausencia de la direccion eliminada.
     * Redirige a la ruta de indice de direcciones con un mensaje flash de exito indicando que la direccion ha sido
     * eliminada. Si ocurre algun error durante el proceso de eliminacion, redirige de nuevo con un mensaje flash de error.
     *
     * @param int|string $id El ID de la direccion que se va a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige a la vista correspondiente con mensaje flash.
     */
    public function destroyAddress($id){
        try {
            $address = Cache::has('address' . $id) ? Cache::get('address' . $id) : Address::find($id);
            $address->delete();
            Cache::forget('address' . $id);
            Cache::forget('addresses');
            flash('Address ' . $address->id . ' deleted successfully.')->error()->important();
            return redirect()->route('addresses.index');
        } catch (Exception $e) {
            flash('Error deleting the address' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    /**
     * Elimina una direccion especifica que pertenece al usuario autenticado.
     *
     * Encuentra y elimina la direccion con el ID proporcionado que pertenece al usuario autenticado.
     * Tras la eliminacion exitosa, se borran las caches relevantes para reflejar el cambio. Redirige a la
     * ruta de indice de direcciones con un mensaje flash de exito indicando que la direccion ha sido eliminada.
     * Si ocurre algun error durante el proceso de eliminacion, o si la direccion no pertenece al usuario autenticado,
     * redirige de nuevo con un mensaje flash de error.
     *
     * @param int|string $id El ID de la direccion que se va a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige a la vista correspondiente con mensaje flash.
     */
    public function destroyMeAddress($id){
        try {
            $address = Address::find($id)
                ->where('user_id', Auth::id())
                ->first();
            $address->delete();
            Cache::forget('address' . $id);
            Cache::forget('addresses');
            flash('Address ' . $address->id . ' deleted successfully.')->error()->important();
            return redirect()->route('addresses.index');
        } catch (Exception $e) {
            flash('Error deleting the address' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }
}
