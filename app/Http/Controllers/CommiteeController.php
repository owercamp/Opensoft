<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Commitee;
use App\Models\Configdocumentmanagerial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CommiteeController extends Controller
{

  public function __construct()
  {
    return $this->middleware('auth');
  }

  function commiteeindex()
  {
    $configuration = Configdocumentmanagerial::select('configdocumentsmanagerial.*', 'documentsmanagerial.*')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    $Collaborators = Collaborator::select('collaborators.*', 'settingpersonals.*')
      ->join('settingpersonals', 'settingpersonals.perId', 'collaborators.coPersonal_id')->get();
    return view('modules.commitee.commitee', compact('configuration', 'Collaborators'));
  }

  function processindex()
  {
    $minutes = Commitee::select('commitees.*', 'configdocumentsmanagerial.*', 'documentsmanagerial.*')
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'commitees.comconf')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    // dd($minutes);
    $configuration = Configdocumentmanagerial::select('configdocumentsmanagerial.*', 'documentsmanagerial.*')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    $Collaborators = Collaborator::select('collaborators.*', 'settingpersonals.*')
      ->join('settingpersonals', 'settingpersonals.perId', 'collaborators.coPersonal_id')->get();
    return view('modules.commitee.process', compact('minutes', 'configuration', 'Collaborators'));
  }

  function commiteeupdate(Request $request)
  {
    $commitee = Commitee::find($request->UpdateId);
    if (!$commitee) {
      return back()->with("Error", "No se encontro el registro especificado");
    }
    $commitee->comconf = $request->SelectDocument;
    $commitee->comtext = $request->TextContent;
    $commitee->comfir = $request->DataCollaborators;
    $commitee->save();
    return back()->with("Success", "Registro actualizado");
  }

  function commiteedestroy(Request $request)
  {
    $del = Commitee::where("comid", $request->idDelete)
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'commitees.comconf')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    $code = $del[0]["domCode"];
    if (!$del) {
      return back()->with("Error", "Registro no Encontrado");
    }
    Commitee::destroy($request->idDelete);
    DB::statement("ALTER TABLE commitees AUTO_INCREMENT=1");
    return back()->with("Success", "Registro con el Codigo " . Str::upper($code) . " eliminado");
  }

  function approvedminutes(Request $request)
  {
    $approved = Commitee::find($request->idApproved);
    if (!$approved) {
      return back()->with("Error", "Registro no Encontrado");
    }
    $approved->com_status = "approved";
    $approved->save();
    $note = Commitee::where("comid", $request->idApproved)
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'commitees.comconf')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    $code = $note[0]["domCode"];
    return back()->with("Success", "El acta N° " . Str::upper($code) . " fue aprobada");
  }

  function fileindex()
  {
    $archives = Commitee::select('commitees.*', 'configdocumentsmanagerial.*', 'documentsmanagerial.*')
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'commitees.comconf')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    return view('modules.commitee.file', compact("archives"));
  }

  function pdfminutes(Request $request)
  {
    $firmNames = [];
    $firmDocuments = [];
    $firmNumbers = [];
    $firmPosts = [];
    $firmFirms = [];
    $matriz = [];
    $allPDF = Commitee::where("comid", $request->idPDF)
      ->join('configdocumentsmanagerial', 'configdocumentsmanagerial.cdmId', 'commitees.comconf')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'configdocumentsmanagerial.cdmDocument_id')->get();
    $pdf = App::make("dompdf.wrapper");
    $datafirms = mb_split(",", $allPDF[0]["comfir"]);

    // dd($datafirms);
    foreach ($datafirms as $name) {
      $firmName = explode('-', $name);
      array_push($firmNames, $firmName[0]);
    }
    foreach ($datafirms as $document) {
      $firmDocument = explode('-', $document);
      array_push($firmDocuments, $firmDocument[1]);
    }
    foreach ($datafirms as $number) {
      $firmNumber = explode('-', $number);
      array_push($firmNumbers, $firmNumber[2]);
    }
    foreach ($datafirms as $post) {
      $firmPost = explode('-', $post);
      array_push($firmPosts, $firmPost[3]);
    }
    foreach ($datafirms as $firm) {
      $firmFirm = explode('-', $firm);
      array_push($firmFirms, $firmFirm[4]);
    }
    array_push($matriz, $firmNames);
    array_push($matriz, $firmDocuments);
    array_push($matriz, $firmNumbers);
    array_push($matriz, $firmPosts);
    array_push($matriz, $firmFirms);

    $nameProjects = config('app.name');
    $name = "Actas de Comite.pdf";
    $pdf = App::make('dompdf.wrapper');
    $pdf = PDF::loadview("modules.commitee.pdf.commiteePDF", compact("nameProjects", "allPDF", "matriz"));
    return $pdf->stream();
  }

  function commiteesave(Request $request)
  {
    Commitee::create([
      "comconf" => $request->SelectDocument,
      "comtext" => $request->TextContent,
      "comfir" => $request->DataCollaborators
    ]);

    return back()->with("Success", "Acta de Comite Creada");
  }
}
