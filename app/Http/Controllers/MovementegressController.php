<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class MovementegressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE CUENTAS POR PAGAR DE (MOVIMIENTO DE EGRESOS)
    =============================================================================================== */
    
    function accountsTo(){
        return view('modules.movementsegress.accounts.index');
    }

    /* ===============================================================================================
			MODULO DE OBLIGACIONES VENCIDAS DE (MOVIMIENTO DE EGRESOS)
    =============================================================================================== */

    function obligationsTo(){
        return view('modules.movementsegress.obligations.index');
    }

    /* ===============================================================================================
			MODULO DE COMPROBANTES DE EGRESO DE (MOVIMIENTO DE EGRESOS)
    =============================================================================================== */

    function vouchersTo(){
        return view('modules.movementsegress.vouchers.index');
    }

    /* ===============================================================================================
			MODULO DE ESTADISTICAS DE GASTOS (MOVIMIENTO DE EGRESOS)
    =============================================================================================== */

    function statisticTo(){
        return view('modules.movementsegress.statistics.index');
    }
}
