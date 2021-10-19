<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class QualificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE CALIFICACION DEL USUARIO DE (CALIFICACION DE SERVICIOS)
    =============================================================================================== */
    
    function usersTo(){
        return view('modules.qualifications.users.index');
    }

    /* ===============================================================================================
			MODULO DE CALIFICACION DEL OPERADOR DE (CALIFICACION DE SERVICIOS)
    =============================================================================================== */

    function operatorsTo(){
        return view('modules.qualifications.operators.index');
    }

    /* ===============================================================================================
			MODULO DE ESTADISTICA DE (CALIFICACION DE SERVICIOS)
    =============================================================================================== */

    function statisticsTo(){
        return view('modules.qualifications.statistics.index');
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
