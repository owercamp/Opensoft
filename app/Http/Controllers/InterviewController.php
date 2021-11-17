<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\interviewCollaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InterviewController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  function interviewSave(Request $request)
  {
    $search = interviewCollaborator::where('int_IdCollaborator', '=', $request->int_IdCollaborator)
      ->join('collaborators', 'collaborators.coId', 'interview_collaborators.int_IdCollaborator')->first();
    if (!$search) {
      $msg = Collaborator::find($request->int_IdCollaborator);
      $data = Arr::except($request->all(), "_token");
      interviewCollaborator::create($data);
      return back()->with('SuccessCollaborator', 'Entrevista del colaborador ' . strtoupper($msg->coNames) . ' almacenada');
    }
    return back()->with('WarningCollaborator', 'El colaborador ' . strtoupper($search->coNames) . ' ya cuenta con la entrevista');
  }
}
