<?php

namespace App\Http\Controllers;

use App\Models\AccidentControlAndAnalysis;
use App\Models\AutoMotiveFleet;
use App\Models\BidirectionalCommunicationSystem;
use App\Models\Configdocumentlogistic;
use App\Models\PreventiveMaintenanceReview;
use App\Models\Settingtechnical;
use App\Models\TrafficRegulationsViolation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserServiceProcedures;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ProgramsController extends Controller
{
  /* ===============================================================================================
			MODULO DE REPOSICION DEL PARQUE AUTOMOTOR DE (PROGRAMAS)
    =============================================================================================== */

  function replacementTo()
  {
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.replacement.index', compact("documents"));
  }

  function replacementSave(Request $request)
  {
    AutoMotiveFleet::create([
      "amf_config" => $request->SelectDocument,
      "amf_Content" => $request->TextContent
    ]);
    return back()->with("Success", "Reposición del parque automotor creado");
  }

  function replacementArchive()
  {
    $all = AutoMotiveFleet::select('auto_motive_fleets.*', 'configdocumentslogistic.*', 'documentslogistic.*')
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'auto_motive_fleets.amf_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.replacement.archive', compact('all', 'documents'));
  }

  function replacementUpdate(Request $request)
  {
    $search = AutoMotiveFleet::find($request->idhidden);

    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }

    $search->amf_config = $request->SelectDocument;
    $search->amf_Content = $request->TextContent;
    $search->save();

    return back()->with("Success", "Registro Actualizado con Éxito");
  }

  function replacementDelete(Request $request)
  {
    $search = AutoMotiveFleet::where('amf_id', $request->idDelete)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'auto_motive_fleets.amf_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }
    $code = $search[0]['dolName'] . ' N° ' . $search[0]['dolCode'];
    AutoMotiveFleet::destroy($request->idDelete);
    DB::statement("ALTER TABLE auto_motive_fleets AUTO_INCREMENT=1");
    return back()->with("Success", $code . " Eliminado");
  }

  function replacementPDF(Request $request)
  {
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $all = AutoMotiveFleet::where('amf_id', $request->pdf)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'auto_motive_fleets.amf_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $content = $all[0]['amf_Content'];

    $pdf = App::make('dompdf.wrapper');
    $name = $all[0]['dolName'] . ' - ' . $all[0]['dolCode'] . '.pdf';
    $pdf = PDF::loadview("modules.programs.partials.programsPDF", compact("content", "all", "day", "technical", "name"));
    return $pdf->download($name);
  }

  /* ===============================================================================================
			MODULO DE CONTROL DE INFRACCIONES A LAS NORMAS DE TRANSITO DE (PROGRAMAS)
    =============================================================================================== */

  function controlTo()
  {
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.control.index', compact("documents"));
  }

  function controlSave(Request $request)
  {
    TrafficRegulationsViolation::create([
      "trv_config" => $request->SelectDocument,
      "trv_content" => $request->TextContent
    ]);
    return back()->with("Success", "Control infracciones a las normas de transito creada");
  }

  function controlArchive()
  {
    $all = TrafficRegulationsViolation::select('traffic_regulations_violations.*', 'configdocumentslogistic.*', 'documentslogistic.*')
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'traffic_regulations_violations.trv_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.control.archive', compact('all', 'documents'));
  }

  function controlUpdate(Request $request)
  {
    $search = TrafficRegulationsViolation::find($request->idhidden);

    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }

    $search->trv_config = $request->SelectDocument;
    $search->trv_content = $request->TextContent;
    $search->save();

    return back()->with("Success", "Registro Actualizado con Éxito");
  }

  function controlDelete(Request $request)
  {
    $search = TrafficRegulationsViolation::where('trv_id', $request->idDelete)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'traffic_regulations_violations.trv_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }
    $code = $search[0]['dolName'] . ' N° ' . $search[0]['dolCode'];
    TrafficRegulationsViolation::destroy($request->idDelete);
    DB::statement("ALTER TABLE traffic_regulations_violations AUTO_INCREMENT=1");
    return back()->with("Success", $code . " Eliminado");
  }

  function controlPDF(Request $request)
  {
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $all = TrafficRegulationsViolation::where('trv_id', $request->pdf)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'traffic_regulations_violations.trv_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $content = $all[0]['trv_content'];

    $pdf = App::make('dompdf.wrapper');
    $name = $all[0]['dolName'] . ' - ' . $all[0]['dolCode'] . '.pdf';
    $pdf = PDF::loadview("modules.programs.partials.programsPDF", compact("content", "all", "day", "technical", "name"));
    return $pdf->download($name);
  }

  /* ===============================================================================================
			MODULO DE INFORME DE CONTROL Y ANALISIS DE ACCIDENTES DE (PROGRAMAS)
    =============================================================================================== */

  function reportTo()
  {
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.report.index', compact("documents"));
  }

  function reportSave(Request $request)
  {
    AccidentControlAndAnalysis::create([
      'aca_config' => $request->SelectDocument,
      'aca_content' => $request->TextContent
    ]);
    return back()->with("Success", "Control y analisis de accidentes creada");
  }

  function reportArchive()
  {
    $all = AccidentControlAndAnalysis::select('accident_control_and_analyses.*', 'configdocumentslogistic.*', 'documentslogistic.*')
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'accident_control_and_analyses.aca_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.report.archive', compact('all', 'documents'));
  }

  function reportUpdate(Request $request)
  {
    $search = AccidentControlAndAnalysis::find($request->idhidden);

    if (!$search) {
      return back()->with('Error', 'Registro no Encontrado');
    }

    $search->aca_config = $request->SelectDocument;
    $search->aca_content = $request->TextContent;
    $search->save();

    return back()->with('Success', 'Registro Actualizado con Éxito');
  }

  function reportDelete(Request $request)
  {
    $search = AccidentControlAndAnalysis::where('aca_id', $request->idDelete)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'accident_control_and_analyses.aca_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }
    $code = $search[0]['dolName'] . ' N° ' . $search[0]['dolCode'];
    AccidentControlAndAnalysis::destroy($request->idDelete);
    DB::statement("ALTER TABLE accident_control_and_analyses AUTO_INCREMENT=1");
    return back()->with("Success", $code . " Eliminado");
  }

  function reportPDF(Request $request)
  {
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $all = AccidentControlAndAnalysis::where('aca_id', $request->pdf)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'accident_control_and_analyses.aca_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $content = $all[0]['aca_content'];

    $pdf = App::make('dompdf.wrapper');
    $name = $all[0]['dolName'] . ' - ' . $all[0]['dolCode'] . '.pdf';
    $pdf = PDF::loadview("modules.programs.partials.programsPDF", compact("content", "all", "day", "technical", "name"));
    return $pdf->download($name);
  }

  /* ===============================================================================================
			MODULO DE PROCEDIMIENTOS DE ATENCIÖN AL USUARIO DE (PROGRAMAS)
    =============================================================================================== */

  function proceduresTo()
  {
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.procedures.index', compact("documents"));
  }

  function proceduresSave(Request $request)
  {
    UserServiceProcedures::create([
      'usp_config' => $request->SelectDocument,
      'usp_content' => $request->TextContent
    ]);
    return back()->with("Success", "Procedimientos de atención al usuario creada");
  }

  function proceduresArchive()
  {
    $all = UserServiceProcedures::select('user_service_procedures.*', 'configdocumentslogistic.*', 'documentslogistic.*')
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'user_service_procedures.usp_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.procedures.archive', compact('all', 'documents'));
  }

  function proceduresUpdate(Request $request)
  {
    $search = UserServiceProcedures::find($request->idhidden);

    if (!$search) {
      return back()->with('Error', 'Registro no Encontrado');
    }

    $search->usp_config = $request->SelectDocument;
    $search->usp_content = $request->TextContent;
    $search->save();

    return back()->with('Success', 'Registro Actualizado con Éxito');
  }

  function proceduresDelete(Request $request)
  {
    $search = UserServiceProcedures::where('usp_id', $request->idDelete)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'user_service_procedures.usp_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }
    $code = $search[0]['dolName'] . ' N° ' . $search[0]['dolCode'];
    UserServiceProcedures::destroy($request->idDelete);
    DB::statement("ALTER TABLE user_service_procedures AUTO_INCREMENT=1");
    return back()->with("Success", $code . " Eliminado");
  }

  function proceduresPDF(Request $request)
  {
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $all = UserServiceProcedures::where('usp_id', $request->pdf)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'user_service_procedures.usp_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $content = $all[0]['usp_content'];

    $pdf = App::make('dompdf.wrapper');
    $name = $all[0]['dolName'] . ' - ' . $all[0]['dolCode'] . '.pdf';
    $pdf = PDF::loadview("modules.programs.partials.programsPDF", compact("content", "all", "day", "technical", "name"));
    return $pdf->download($name);
  }

  /* ===============================================================================================
			MODULO DE SISTEMA DE COMUNICACION BIDIRECCIONAL DE (PROGRAMAS)
    =============================================================================================== */

  function comunicationsTo()
  {
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.comunications.index', compact("documents"));
  }

  function comunicationsSave(Request $request)
  {
    BidirectionalCommunicationSystem::create([
      'bcs_config' => $request->SelectDocument,
      'bcs_content' => $request->TextContent
    ]);
    return back()->with("Success", "Sistema de Comunicación Bidireccional creado");
  }

  function comunicationsArchive()
  {
    $all = BidirectionalCommunicationSystem::select('bidirectional_communication_systems.*', 'configdocumentslogistic.*', 'documentslogistic.*')
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'bidirectional_communication_systems.bcs_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.comunications.archive', compact('all', 'documents'));
  }

  function comunicationsUpdate(Request $request)
  {
    $search = BidirectionalCommunicationSystem::find($request->idhidden);

    if (!$search) {
      return back()->with('Error', 'Registro no Encontrado');
    }

    $search->bcs_config = $request->SelectDocument;
    $search->bcs_content = $request->TextContent;
    $search->save();

    return back()->with('Success', 'Registro Actualizado con Éxito');
  }

  function comunicationsDelete(Request $request)
  {
    $search = BidirectionalCommunicationSystem::where('bcs_id', $request->idDelete)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'bidirectional_communication_systems.bcs_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }
    $code = $search[0]['dolName'] . ' N° ' . $search[0]['dolCode'];
    BidirectionalCommunicationSystem::destroy($request->idDelete);
    DB::statement("ALTER TABLE user_service_procedures AUTO_INCREMENT=1");
    return back()->with("Success", $code . " Eliminado");
  }

  function comunicationsPDF(Request $request)
  {
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $all = BidirectionalCommunicationSystem::where('bcs_id', $request->pdf)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'bidirectional_communication_systems.bcs_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $content = $all[0]['bcs_content'];

    $pdf = App::make('dompdf.wrapper');
    $name = $all[0]['dolName'] . ' - ' . $all[0]['dolCode'] . '.pdf';
    $pdf = PDF::loadview("modules.programs.partials.programsPDF", compact("content", "all", "day", "technical", "name"));
    return $pdf->download($name);
  }

  /* ===============================================================================================
			MODULO DE REVISION DE MANTENIMIENTO PREVENTIVO DE (PROGRAMAS)
    =============================================================================================== */

  function maintenanceTo()
  {
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.maintenance.index', compact("documents"));
  }

  function maintenanceSave(Request $request)
  {
    PreventiveMaintenanceReview::create([
      'pmr_config' => $request->SelectDocument,
      'pmr_content' => $request->TextContent
    ]);
    return back()->with("Success", "Revisión de mantenimiento preventivo creado");
  }

  function maintenanceArchive()
  {
    $all = PreventiveMaintenanceReview::select('preventive_maintenance_reviews.*', 'configdocumentslogistic.*', 'documentslogistic.*')
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'preventive_maintenance_reviews.pmr_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $documents = Configdocumentlogistic::select('configdocumentslogistic.*', 'documentslogistic.*')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    return view('modules.programs.maintenance.archive', compact('all', 'documents'));
  }

  function maintenanceUpdate(Request $request)
  {
    $search = PreventiveMaintenanceReview::find($request->idhidden);

    if (!$search) {
      return back()->with('Error', 'Registro no Encontrado');
    }

    $search->pmr_config = $request->SelectDocument;
    $search->pmr_content = $request->TextContent;
    $search->save();

    return back()->with('Success', 'Registro Actualizado con Éxito');
  }

  function maintenanceDelete(Request $request)
  {
    $search = PreventiveMaintenanceReview::where('pmr_id', $request->idDelete)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'preventive_maintenance_reviews.pmr_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }
    $code = $search[0]['dolName'] . ' N° ' . $search[0]['dolCode'];
    PreventiveMaintenanceReview::destroy($request->idDelete);
    DB::statement("ALTER TABLE preventive_maintenance_reviews AUTO_INCREMENT=1");
    return back()->with("Success", $code . " Eliminado");
  }

  function maintenancePDF(Request $request)
  {
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $all = PreventiveMaintenanceReview::where('pmr_id', $request->pdf)
      ->join('configdocumentslogistic', 'configdocumentslogistic.cdlId', 'preventive_maintenance_reviews.pmr_config')
      ->join('documentslogistic', 'documentslogistic.dolId', 'configdocumentslogistic.cdlDocument_id')->get();
    $content = $all[0]['pmr_content'];

    $pdf = App::make('dompdf.wrapper');
    $name = $all[0]['dolName'] . ' - ' . $all[0]['dolCode'] . '.pdf';
    $pdf = PDF::loadview("modules.programs.partials.programsPDF", compact("content", "all", "day", "technical", "name"));
    return $pdf->download($name);
  }
}
