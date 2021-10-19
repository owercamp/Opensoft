<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class AnalysisbudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE CONSILIACION DE SALDOS DE (ANALISIS DE PRESUPUESTO)
    =============================================================================================== */
    
    function conciliationTo(){
        return view('modules.analysis.conciliation.index');
    }

    /* ===============================================================================================
			MODULO DE ESTRUCTURA DE COSTOS DE (ANALISIS DE PRESUPUESTO)
    =============================================================================================== */

    function structureTo(){
        return view('modules.analysis.structure.index');
    }

    /* ===============================================================================================
			MODULO DE DESCRIPCION DE COSTOS DE (ANALISIS DE PRESUPUESTO)
    =============================================================================================== */

    function descriptionTo(){
        return view('modules.analysis.description.index');
    }

    /* ===============================================================================================
			MODULO DE PRESUPUESTO ANUAL (ANALISIS DE PRESUPUESTO)
    =============================================================================================== */

    function budgetTo(){
        return view('modules.analysis.budget.index');
    }

    /* ===============================================================================================
			MODULO DE SEGUIMIENTO MENSUAL DE (ANALISIS DE PRESUPUESTO)
    =============================================================================================== */

    function trackingTo(){
        return view('modules.analysis.tracking.index');
    }

    /* ===============================================================================================
			MODULO DE INFORME DE CIERRE (ANALISIS DE PRESUPUESTO)
    =============================================================================================== */

    function reportTo(){
        return view('modules.analysis.reports.index');
    }
}
