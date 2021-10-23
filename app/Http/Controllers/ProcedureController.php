<?php

namespace App\Http\Controllers;

use App\Models\Configdocumentmanagerial;
use App\Models\Procedure;
use App\Models\Settingtechnical;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcedureController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  function implementationindex()
  {
    $configuration = Configdocumentmanagerial::select('configdocumentsmanagerial.*', 'documentsmanagerial.*')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    return view('modules.procedure.procedure', compact("configuration"));
  }

  function implementationsave(Request $request)
  {
    Procedure::create([
      "pro_doc" => $request->SelectDocument,
      "pro_content" => $request->TextContent
    ]);
    return back()->with("Success", "Procedimiento Creado");
  }

  function implementationupdate(Request $request)
  {
    $search = Procedure::find($request->UpdateId);
    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }
    $search->pro_doc = $request->SelectDocument;
    $search->pro_content = $request->TextContent;
    $search->save();
    return back()->with("Success", "Registro Actualizado");
  }

  function implementationdestroy(Request $request)
  {
    $del = Procedure::where('pro_id', $request->idDelete)
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'procedures.pro_doc')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    $code = $del[0]["domCode"];
    if (!$del) {
      return back()->with("Error", "Registro no Encontrado");
    }
    Procedure::destroy($request->idDelete);
    DB::statement("ALTER TABLE procedures AUTO_INCREMENT=1");
    return back()->with("Success", "Registro con el Codigo " . Str::upper($code) . " eliminado");
  }

  function approvedimplementation(Request $request)
  {
    $search = Procedure::find($request->idApproved);
    if (!$search) {
      return back()->with("Error", "registro no Encontrado");
    }
    $search->pro_status = "approved";
    $search->save();
    $note = Procedure::where("pro_id", $request->idApproved)
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'procedures.pro_doc')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    $code = $note[0]["domCode"];
    return back()->with("Success", "El acta N° " . Str::upper($code) . " fue aprobada");
  }

  function processindex()
  {
    $all = Procedure::select('procedures.*', 'configdocumentsmanagerial.*', 'documentsmanagerial.*')
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'procedures.pro_doc')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    $configuration = Configdocumentmanagerial::select('configdocumentsmanagerial.*', 'documentsmanagerial.*')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    return view('modules.procedure.process', compact("all", "configuration"));
  }

  function fileindex()
  {
    $allfiles = Procedure::select('procedures.*', 'configdocumentsmanagerial.*', 'documentsmanagerial.*')
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'procedures.pro_doc')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    return view('modules.procedure.file', compact("allfiles"));
  }

  function pdfimplementation(Request $request)
  {
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $allPDF = Procedure::where("pro_id", $request->idPDF)
      ->join("configdocumentsmanagerial", "configdocumentsmanagerial.cdmId", "procedures.pro_doc")
      ->join("documentsmanagerial", "documentsmanagerial.domId", "configdocumentsmanagerial.cdmDocument_id")->get();

    $pdf = App::make('dompdf.wrapper');
    $name = "Implementación de proceso " . ucwords($allPDF[0]['domName']) . ".pdf";
    $pdf = PDF::loadview("modules.procedure.pdf.procedurePDF", compact("allPDF", "day", "technical", "name"));
    return $pdf->download($name);
  }
}
