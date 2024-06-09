<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class HomeController
 *
 * La clase Controller es una clase base que extiende BaseController y proporciona funcionalidades comunes
 *  para los controladores en una aplicacion de nuestra tienda.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class Controller extends BaseController
{
    /**
     * Trait AuthorizesRequests.
     * Proporciona métodos para autorizar acciones dentro de los controladores.
     *
     *  Trait ValidatesRequests.
     *  Proporciona métodos para validar las solicitudes recibidas en los controladores.
     * /
     */
    use AuthorizesRequests, ValidatesRequests;
}
