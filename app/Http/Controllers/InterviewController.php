<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Contractorcharge;
use App\Models\Contractorespecial;
use App\Models\Contractormessenger;
use App\Models\interviewCollaborator;
use App\Models\interviewExpress;
use App\Models\interviewMessenger;
use App\Models\interviewSpecial;
use App\Models\ReferencesCollaborator;
use App\Models\ReferencesExpress;
use App\Models\ReferencesMessenger;
use App\Models\ReferencesSpecial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Settingtechnical;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

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

  function ExpressReferences(Request $request)
  {
    $search = ReferencesExpress::where('rc_collaborator_id', $request->rc_collaborator_id)->first();
    if (!$search) {
      $data = Arr::except($request->all(), ['_token']);
      ReferencesExpress::create($data);
      return back()->with('SuccessContractor', 'Verificación Referencias Almacenado');
    } else {
      $data = Arr::except($request->all(), ['_token']);
      ReferencesExpress::where('rc_collaborator_id', $request->rc_collaborator_id)
        ->update($data);
      return back()->with('PrimaryContractor', 'Verificación Referencias Actualizada');
    }
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

  function SpecialsReferences(Request $request)
  {
    $search = ReferencesSpecial::where('rc_collaborator_id', $request->rc_collaborator_id)->first();
    if (!$search) {
      $data = Arr::except($request->all(), ['_token']);
      ReferencesSpecial::create($data);
      return back()->with('SuccessContractor', 'Verificación Referencias Almacenado');
    } else {
      $data = Arr::except($request->all(), ['_token']);
      ReferencesSpecial::where('rc_collaborator_id', $request->rc_collaborator_id)
        ->update($data);
      return back()->with('PrimaryContractor', 'Verificación Referencias Actualizada');
    }
  }

  function PDFCollaborators(Request $request)
  {
    $technical = Settingtechnical::first();
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    if ($request->FormSubmit == "COLABORADORES") {
      $search = Collaborator::where('coId', trim($request->idSearch))
        ->join('settingpersonals', 'settingpersonals.perId', 'collaborators.coPersonal_id')
        ->join('settingneighborhoods', 'settingneighborhoods.neId', 'collaborators.coNeighborhood_id')
        ->join('settinghealths', 'settinghealths.heaId', 'collaborators.coHealths_id')
        ->join('settingrisks', 'settingrisks.risId', 'collaborators.coRisk_id')
        ->join('settingpensions', 'settingpensions.penId', 'collaborators.coPension_id')
        ->join('settinglayoffs', 'settinglayoffs.layId', 'collaborators.coLayoff_id')
        ->join('settingcompensations', 'settingcompensations.comId', 'collaborators.coCompensation_id')
        ->join('settingzonings', 'settingzonings.zonId', 'settingneighborhoods.neZoning_id')
        ->join('settingmunicipalities', 'settingmunicipalities.munId', 'settingzonings.zonMunicipality_id')
        ->join('settingdepartments', 'settingdepartments.depId', 'settingmunicipalities.munDepartment_id')
        ->first();
      // dd($search);
      // *cargo la foto y firma existente de colaboradores
      $photo = 'storage/collaboratorsPhotos/' . $search->coPhoto;
      $firm = 'storage/collaboratorsFirms/' . $search->coFirm;
      $names = $search->coNames;
      $cc = $search->coNumberdocument;
      $position = $search->coPosition;
      $address = $search->coAddress;
      $mail = $search->coEmail;
      $movil = $search->coMovil;
    } elseif ($request->FormSubmit == "CONTRATISTAS MENSAJERIA") {
      $search = Contractormessenger::where('cmId', trim($request->idSearch))
        ->join('settingpersonals', 'settingpersonals.perId', 'contractorsmessenger.cmPersonal_id')
        ->join('settingneighborhoods', 'settingneighborhoods.neId', 'contractorsmessenger.cmNeighborhood_id')
        ->join('settinghealths', 'settinghealths.heaId', 'contractorsmessenger.cmHealths_id')
        ->join('settingrisks', 'settingrisks.risId', 'contractorsmessenger.cmRisk_id')
        ->join('settingpensions', 'settingpensions.penId', 'contractorsmessenger.cmPension_id')
        ->join('settinglayoffs', 'settinglayoffs.layId', 'contractorsmessenger.cmLayoff_id')
        ->join('settingcompensations', 'settingcompensations.comId', 'contractorsmessenger.cmCompensation_id')
        ->join('settingzonings', 'settingzonings.zonId', 'settingneighborhoods.neZoning_id')
        ->join('settingmunicipalities', 'settingmunicipalities.munId', 'settingzonings.zonMunicipality_id')
        ->join('settingdepartments', 'settingdepartments.depId', 'settingmunicipalities.munDepartment_id')
        ->first();
      // *cargo la foto y firma existente de colaboradores Mensajeria
      $photo = 'storage/contractorsMessengerPhotos/' . $search->cmPhoto;
      $firm = 'storage/contractorsMessengerFirms/' . $search->cmFirm;
      $names = $search->cmNames;
      $cc = $search->cmNumberdocument;
      $position = $search->cmPosition;
      $address = $search->cmAddress;
      $mail = $search->cmEmail;
      $movil = $search->cmMovil;
      // dd($search);
    } elseif ($request->FormSubmit == "CONTRATISTAS CARGA EXPRESS") {
      $search = Contractorcharge::where('ccId', trim($request->idSearch))
        ->join('settingpersonals', 'settingpersonals.perId', 'contractorschargeexpress.ccPersonal_id')
        ->join('settingneighborhoods', 'settingneighborhoods.neId', 'contractorschargeexpress.ccNeighborhood_id')
        ->join('settinghealths', 'settinghealths.heaId', 'contractorschargeexpress.ccHealths_id')
        ->join('settingrisks', 'settingrisks.risId', 'contractorschargeexpress.ccRisk_id')
        ->join('settingpensions', 'settingpensions.penId', 'contractorschargeexpress.ccPension_id')
        ->join('settinglayoffs', 'settinglayoffs.layId', 'contractorschargeexpress.ccLayoff_id')
        ->join('settingcompensations', 'settingcompensations.comId', 'contractorschargeexpress.ccCompensation_id')
        ->join('settingzonings', 'settingzonings.zonId', 'settingneighborhoods.neZoning_id')
        ->join('settingmunicipalities', 'settingmunicipalities.munId', 'settingzonings.zonMunicipality_id')
        ->join('settingdepartments', 'settingdepartments.depId', 'settingmunicipalities.munDepartment_id')
        ->first();
      // *cargo la foto y firma existente de colaboradores Carga Express
      $photo = 'storage/contractorsChargePhotos/' . $search->ccPhoto;
      $firm = 'storage/contractorsChargeFirms/' . $search->ccFirm;
      $names = $search->ccNames;
      $cc = $search->ccNumberdocument;
      $position = $search->ccPosition;
      $address = $search->ccAddress;
      $mail = $search->ccEmail;
      $movil = $search->ccMovil;
      // dd($search);
    } elseif ($request->FormSubmit == "CONTRATISTAS SERVICIOS ESPECIALES") {
      $search = Contractorespecial::where('ceId', trim($request->idSearch))
        ->join('settingpersonals', 'settingpersonals.perId', 'contractorsserviceespecial.cePersonal_id')
        ->join('settingneighborhoods', 'settingneighborhoods.neId', 'contractorsserviceespecial.ceNeighborhood_id')
        ->join('settinghealths', 'settinghealths.heaId', 'contractorsserviceespecial.ceHealths_id')
        ->join('settingrisks', 'settingrisks.risId', 'contractorsserviceespecial.ceRisk_id')
        ->join('settingpensions', 'settingpensions.penId', 'contractorsserviceespecial.cePension_id')
        ->join('settinglayoffs', 'settinglayoffs.layId', 'contractorsserviceespecial.ceLayoff_id')
        ->join('settingcompensations', 'settingcompensations.comId', 'contractorsserviceespecial.ceCompensation_id')
        ->join('settingzonings', 'settingzonings.zonId', 'settingneighborhoods.neZoning_id')
        ->join('settingmunicipalities', 'settingmunicipalities.munId', 'settingzonings.zonMunicipality_id')
        ->join('settingdepartments', 'settingdepartments.depId', 'settingmunicipalities.munDepartment_id')
        ->first();
      // *cargo la foto y firma existente de colaboradores Servicios Especiales
      $photo = 'storage/contractorsEspecialPhotos/' . $search->cePhoto;
      $firm = 'storage/contractorsEspecialFirms/' . $search->ceFirm;
      $names = $search->ceNames;
      $cc = $search->ceNumberdocument;
      $position = $search->cePosition;
      $address = $search->ceAddress;
      $mail = $search->ceEmail;
      $movil = $search->ceMovil;
      // dd($search);
    }

    $academic = json_decode($search->academics);
    $title = json_decode($search->titles);
    $initial = json_decode($search->initials);
    $final = json_decode($search->finals);

    // dd($academic, $title, $initial, $final);
    $form = $request->FormSubmit;
    $pdf = App::make('dompdf.wrapper');
    $name = "Hoja de Vida Colaborador " . $names . ".pdf";
    $pdf = PDF::loadview('modules.humans.PDF.CurriculumVitae', compact('technical', 'day', 'search', 'photo', 'firm', 'names', 'cc', 'position', 'address', 'mail', 'movil', 'form','academic','title','initial','final'));
    return $pdf->download($name);
    // return $pdf->stream();
  }
}
