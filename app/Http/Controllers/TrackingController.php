<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class TrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE CONFIRMACION OPERADOR DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */
    
    function confirmationsTo(){
        return view('modules.trackings.confirmation.index');
    }

    /* ===============================================================================================
			MODULO DE INICIO DE SERVICIO DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

    function startsTo(){
        return view('modules.trackings.start.index');
    }

    /* ===============================================================================================
			MODULO DE SERVICIO EN EJECUCION DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

    function runningsTo(){
        return view('modules.trackings.running.index');
    }

    /* ===============================================================================================
			MODULO DE SERVICIOS FINALIZADOS DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

    function finalizedsTo(){
        return view('modules.trackings.finalized.index');
    }

    /* ===========================================================================================================
            FUNCIONES PARA CONVERTIR CADENAS DE TEXTO (Mayusculas/Minusculas/Solo primera en Mayuscula)
    =========================================================================================================== */

    function upper($string){
        return mb_strtoupper(trim($string),'UTF-8');
    }

    function lower($string){
        return mb_strtolower(trim($string),'UTF-8');
    }

    function fu($string){
        return ucfirst(mb_strtolower(trim($string),'UTF-8'));
    }
}
