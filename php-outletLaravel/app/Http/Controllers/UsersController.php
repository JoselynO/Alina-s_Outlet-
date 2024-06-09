<?php

namespace App\Http\Controllers;

use App\Mail\MailableController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersController
 *
 *Controlador que maneja las acciones relacionadas con los usuarios autenticados.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class UsersController extends Controller
{
    /**
     * Muestra los detalles del usuario autenticado.
     *
     * @return \Illuminate\View\View La vista que muestra los detalles del usuario.
     */

    public function userDetails()
    {
        $user = User::find(Auth::id());
        return view('users.detail')->with('user', $user);
    }

    /**
     * Actualiza los detalles del usuario autenticado.
     *
     * @param \Illuminate\Http\Request $request La solicitud que contiene los detalles actualizados del usuario.
     * @return \Illuminate\Http\RedirectResponse Redirige de nuevo a la página de detalles del usuario con un mensaje flash.
     */

    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|string|max:255',
            'email' => 'required|email|string|max:255|unique:users,email, ' . Auth::id(),
            'phone_number' => 'sometimes|regex:/^(6|7|8|9)\d{8}$/',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->update($request->all());
        flash('User ' . $user->name . ' updated successfully.')->warning()->important();
        return redirect()->route('users.detail');
    }



}
