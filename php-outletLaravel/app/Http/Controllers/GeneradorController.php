<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * La clase GeneradorController es un controlador en una aplicacion de nuestra tienda que gestiona las solicitudes relacionadas
 *  con la generacion y descarga de archivos PDF.
 *
 * @package App\Http\Controllers
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class GeneradorController extends Controller{

    /**
     * Metodo imprimir.
     * Genera un archivo PDF utilizando la biblioteca Dompdf y lo descarga en el navegador del usuario.
     *
     * @return \Illuminate\Http\Response La respuesta HTTP que contiene el archivo PDF generado para su descarga.
     */
    public function imprimir(){
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.invoice');
        return $pdf->download('ejemplo.pdf');
    }

}
