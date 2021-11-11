<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  function planingTo()
  {
    return view('modules.training.planing.index');
  }
}
