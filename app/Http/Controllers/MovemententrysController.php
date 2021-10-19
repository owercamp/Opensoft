<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class MovemententrysController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE FACTURACION DE VENTA DE (MOVIMIENTO DE INGRESOS)
    =============================================================================================== */
    
    function facturationsTo(){
        return view('modules.movementsentry.facturations.index');
    }

    /* ===============================================================================================
			MODULO DE CARTERA VENCIDA DE (MOVIMIENTO DE INGRESOS)
    =============================================================================================== */

    function walletsTo(){
        return view('modules.movementsentry.wallets.index');
    }

    /* ===============================================================================================
			MODULO DE COMPROBANTES DE INGRESO DE (MOVIMIENTO DE INGRESOS)
    =============================================================================================== */

    function vouchersTo(){
        return view('modules.movementsentry.vouchers.index');
    }

    /* ===============================================================================================
			MODULO DE ESTADISTICAS DE VENTA (MOVIMIENTO DE INGRESOS)
    =============================================================================================== */

    function statisticTo(){
        return view('modules.movementsentry.statistics.index');
    }
}
