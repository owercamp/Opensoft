<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  /* ===============================================================================================
			MODULO DE PLAN DE CAPACITACIONES
    =============================================================================================== */

  function planingTo()
  {
    return view('modules.training.planing.index');
  }

  /* ===============================================================================================
			MODULO DE SOPORTE CAPACITACIONES
    =============================================================================================== */

  function supportTo()
  {
    return view('modules.training.support.index');
  }

  /* ===============================================================================================
			MODULO DE EFICIENCIA CAPACITACIONES
    =============================================================================================== */

  function effectivenessTo()
  {
    return view('modules.training.effectiveness.index');
  }

  /* ===============================================================================================
			MODULO DE INDICADORES CORRESPONDIENTES
    =============================================================================================== */

  function indicatorsTo()
  {
    return view('modules.training.indicators.index');
  }
}
