<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentsManagementController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  function legalindex()
  {
    return view('modules.document.legalPatern');
  }

  function analysisindex()
  {
    return view('modules.document.analysisMatrix');
  }

  function matrixindex()
  {
    return view('modules.document.matrizEPP');
  }

  function accountabilityindex()
  {
    return view('modules.document.accountability');
  }

  function programsindex()
  {
    return view('modules.document.programs');
  }
}
