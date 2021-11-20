<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Contractorcharge;
use App\Models\Contractorespecial;
use App\Models\interviewCollaborator;
use App\Models\interviewExpress;
use App\Models\interviewMessenger;
use App\Models\interviewSpecial;
use App\Models\ReferencesCollaborator;
use App\Models\ReferencesMessenger;
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

  function CollaboratorReferences(Request $request)
  {
    $search = ReferencesCollaborator::where('rc_collaborator_id', $request->rc_collaborator_id)->first();
    if (!$search) {
      $data = Arr::except($request->all(), ['_token']);
      ReferencesCollaborator::create($data);
      return back()->with('SuccessCollaborator', 'Verificación Referencias Almacenado');
    } else {
      $data = Arr::except($request->all(), ['_token']);
      ReferencesCollaborator::where('rc_collaborator_id', $request->rc_collaborator_id)
        ->update($data);
      return back()->with('PrimaryCollaborator', 'Verificación Referencias Actualizada');
    }
  }

  function MessengersSave(Request $request)
  {
    $search = interviewMessenger::where('int_IdCollaborator', '=', $request->int_IdCollaborator)
      ->join('collaborators', 'collaborators.coId', 'interview_messengers.int_IdCollaborator')->first();
    if (!$search) {
      $msg = Collaborator::find($request->int_IdCollaborator);
      $data = Arr::except($request->all(), "_token");
      interviewMessenger::create($data);
      return back()->with('SuccessContractor', 'Entrevista del colaborador ' . strtoupper($msg->coNames) . ' almacenada');
    }
    return back()->with('WarningContractor', 'El colaborador ' . strtoupper($search->coNames) . ' ya cuenta con la entrevista');
  }

  function MessengerReferences(Request $request)
  {
    $search = ReferencesMessenger::where('rc_collaborator_id', $request->rc_collaborator_id)->first();
    if (!$search) {
      $data = Arr::except($request->all(), ['_token']);
      ReferencesMessenger::create($data);
      return back()->with('SuccessContractor', 'Verificación Referencias Almacenado');
    } else {
      $data = Arr::except($request->all(), ['_token']);
      ReferencesMessenger::where('rc_collaborator_id', $request->rc_collaborator_id)
        ->update($data);
      return back()->with('PrimaryContractor', 'Verificación Referencias Actualizada');
    }
  }

  function ExpressSave(Request $request)
  {
    $search = interviewExpress::where('int_IdCollaborator', '=', $request->int_IdCollaborator)
      ->join('contractorschargeexpress', 'contractorschargeexpress.ccId', 'interview_expresses.int_IdCollaborator')->first();
    if (!$search) {
      $msg = Contractorcharge::find($request->int_IdCollaborator);
      $data = Arr::except($request->all(), "_token");
      interviewExpress::create($data);
      return back()->with('SuccessContractor', 'Entrevista del contratista ' . strtoupper($msg->ccNames) . ' almacenada');
    }
    return back()->with('WarningContractor', 'El contratista ' . strtoupper($search->ccNames) . ' ya cuenta con la entrevista');
  }

  function SpecialsSave(Request $request)
  {
    $search = interviewSpecial::where('int_IdCollaborator', '=', $request->int_IdCollaborator)
      ->join('contractorsserviceespecial', 'contractorsserviceespecial.ceId', 'interview_specials.int_IdCollaborator')->first();
    if (!$search) {
      $msg = Contractorespecial::find($request->int_IdCollaborator);
      $data = Arr::except($request->all(), "_token");
      interviewSpecial::create($data);
      return back()->with('SuceessContractor', 'Entrevista del contratista ' . strtoupper($msg->ceNames) . ' almacenada');
    }
    return back()->with('WarningContractor', 'El contratista ' . strtoupper($search->ceNames) . ' ya cuenta con la entrevista');
  }
}
