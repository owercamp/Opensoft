<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContinuousImprovementController extends Controller
{
    function __construct()
    {
      $this->middleware('auth');
    }

    function listTo()
    {
      return view('modules.improvement.list.index');
    }

    function procedureTo()
    {
      return view('modules.improvement.procedure.index');
    }

    function registerTo()
    {
      return view('modules.improvement.register.index');
    }

    function searchTo()
    {
      return view('modules.improvement.search.index');
    }
}
