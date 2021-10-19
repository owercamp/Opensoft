<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class SettlementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE LIQUIDACION PARA CLIENTES DE (LIQUIDACION DE SERVICIOS)
    =============================================================================================== */
    
    function clientsTo(){
        return view('modules.settlements.clients.index');
    }

    /* ===============================================================================================
			MODULO DE LIQUIDACION PARA OPERADORES DE (LIQUIDACION DE SERVICIOS)
    =============================================================================================== */

    function operatorsTo(){
        return view('modules.settlements.operators.index');
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
