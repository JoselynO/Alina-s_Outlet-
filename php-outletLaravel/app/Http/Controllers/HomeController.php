<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * Class HomeController
 *
 *La clase HomeController es un controlador en una aplicacion de nuestra tienda que gestiona las solicitudes relacionadas
 *con la pagina de inicio de sesion.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
