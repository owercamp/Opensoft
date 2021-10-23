<?php

namespace App\Http\Controllers;

use App\Models\AnalysisMatrix;
use App\Models\Collaborator;
use App\Models\Documentmanagerial;
use App\Models\LegalParent;
use App\Models\MatrixEPP;
use App\Models\Settingtechnical;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class DocumentsManagementController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  function legalindex()
  {
    $DocumentMNG = Documentmanagerial::all();
    $collaborators = Collaborator::all();
    $legals = LegalParent::select('legal_parents.*', 'collaborators.*', 'documentsmanagerial.*')
      ->join('collaborators', 'collaborators.coId', 'legal_parents.lp_collaborator')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'legal_parents.lp_fDoc')->get();
    return view('modules.document.legalPatern', compact('collaborators', 'legals', 'DocumentMNG'));
  }

  function legalsave(Request $request)
  {
    LegalParent::create([
      "lp_fDoc" => $request->mlfDoc,
      "lp_typeDoc" => $request->mlDoc,
      "lp_Num" => $request->mlNum,
      "lp_year" => $request->mlYear,
      "lp_title" => $request->mltitle,
      "lp_article" => $request->mlArticle,
      "lp_description" => $request->mlDescription,
      "lp_area" => $request->mlArea,
      "lp_evidence" => $request->mlEvidence,
      "lp_collaborator" => trim($request->mlCollaborator),
      "lp_meet" => ucwords($request->mlMeet)
    ]);

    return back()->with("Success", "Se ha creado la Matriz Legal Correctamente");
  }

  public function legalupdate(Request $request)
  {
    $msg = LegalParent::where('lp_id', $request->legalIdUpdate)
      ->join('collaborators', 'collaborators.coId', 'legal_parents.lp_collaborator')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'legal_parents.lp_fDoc')->get();

    $search = LegalParent::find($request->legalIdUpdate);

    if (!$search) {
      return back()->with('Error', 'Registro no Encontrado');
    }
    $search->lp_fDoc = $request->mlfDoc;
    $search->lp_typeDoc = $request->mlDoc;
    $search->lp_Num = $request->mlNum;
    $search->lp_year = $request->mlYear;
    $search->lp_title = $request->mltitle;
    $search->lp_article = $request->mlArticle;
    $search->lp_description = $request->mlDescription;
    $search->lp_area = $request->mlArea;
    $search->lp_evidence = $request->mlEvidence;
    $search->lp_collaborator = trim($request->mlCollaborator);
    $search->lp_meet = ucwords($request->mlMeet);
    $search->save();

    return back()->with('Update', 'Registro de titulo ' . strtoupper($msg[0]['lp_title']) . " Año " . strtoupper($msg[0]['lp_year']) . " y Colaborador " . strtoupper($msg[0]['coNames']) . " ha sido actualizado");
  }

  public function legaldestroy(Request $request)
  {
    $searchDelete = legalParent::find($request->legalIdDelete);
    $msg = LegalParent::where('lp_id', $request->legalIdDelete)
      ->join('collaborators', 'collaborators.coId', 'legal_parents.lp_collaborator')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'legal_parents.lp_fDoc')->get();

    if (!$searchDelete) {
      return back()->with('Error', 'Registro no Encontrado');
    }

    LegalParent::destroy($request->legalIdDelete);
    DB::statement("ALTER TABLE legal_parents AUTO_INCREMENT=1");

    return back()->with('Delete', 'Registro de titulo ' . strtoupper($msg[0]['domName']) . ' eliminado');
  }

  public function legalpdf(Request $request)
  {
    $pdfs = LegalParent::select('legal_parents.*', 'collaborators.*', 'documentsmanagerial.*')
      ->join('collaborators', 'collaborators.coId', 'legal_parents.lp_collaborator')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'legal_parents.lp_fDoc')->get();

    if (!$pdfs) {
      return back()->with('Info', "No hay registros para descargar");
    }
    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $pdf = App::make('dompdf.wrapper');
    $name = "Listado Matriz Legal " . $day . ".pdf";
    $pdf = PDF::loadview('modules.document.PDF.legalPDF', compact('technical', 'day', 'pdfs', 'name'));
    return $pdf->download($name);
  }

  function analysisindex()
  {
    $analysis = AnalysisMatrix::select('analysis_matrices.*', 'documentsmanagerial.*')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'analysis_matrices.amDoc')->get();
    $DocumentMNG = Documentmanagerial::all();
    return view('modules.document.analysisMatrix', compact('DocumentMNG', 'analysis'));
  }

  function analysissave(Request $request)
  {
    AnalysisMatrix::create($request->all());
    return back()->with('Success', 'Registro de analisis de matriz creado Correctamente');
  }

  function analysisupdate(Request $request)
  {
    $search = AnalysisMatrix::where('am_id', $request->analysisIdUpdate)
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'analysis_matrices.amDoc')->get();

    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }

    $data = Arr::except($request->all(), ['_method', '_token', 'analysisIdUpdate']);

    AnalysisMatrix::where('am_id', $request->analysisIdUpdate)
      ->update($data);

    return back()->with("Update", "Registro de Documento " . strtoupper($search[0]['domName']) . " Actualizado ");
  }

  function analysisdestroy(Request $request)
  {
    $search = AnalysisMatrix::where('am_id', $request->analysisIdDelete)
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'analysis_matrices.amDoc')->get();

    if (!$search) {
      return back()->with("Error", "Registro no Encontrado");
    }

    AnalysisMatrix::destroy($request->analysisIdDelete);
    DB::statement("ALTER TABLE analysis_matrices AUTO_INCREMENT=1");

    return back()->with("Delete", "Registro de Documento " . strtoupper($search[0]['domName']) . " Eliminado ");
  }

  function analysispdf(Request $request)
  {
    $pdfs = AnalysisMatrix::select('analysis_matrices.*', 'documentsmanagerial.*')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'analysis_matrices.amDoc')->get();

    if (!$pdfs) {
      return back()->with('Info', "No hay registros para descargar");
    }

    $day = Carbon::today('America/Bogota')->locale('es')->isoFormat('D-M-Y');
    $technical = Settingtechnical::first();
    $pdf = App::make('dompdf.wrapper');
    $name = "Analisis de Matriz " . $day . ".pdf";
    $pdf = PDF::loadview('modules.document.PDF.matrixPDF', compact('technical', 'day', 'pdfs', 'name'));
    return $pdf->download($name);
  }

  function matrixindex()
  {
    $DocumentMNG = Documentmanagerial::all();
    $epps = MatrixEPP::select('matrix_e_p_p_s.*', 'documentsmanagerial.*')
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'matrix_e_p_p_s.meDoc')->get();
    return view('modules.document.matrizEPP', compact('DocumentMNG', "epps"));
  }

  function matrixsave(Request $request)
  {
    if ($request->hasfile('meFil')) {
      $file = $request->file('meFil');
      $nameFile = $file->getClientOriginalName();
      $name = str_replace(" ", "", $nameFile);
      Storage::disk('opensoft')->putFileAs(DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "MatrixEPP" . DIRECTORY_SEPARATOR, $request->file('meFil'), $name);
    }

    MatrixEPP::create([
      "meDoc" => $request->meDoc,
      "meEPP" => $request->meEPP,
      "meDes" => $request->meDes,
      "meNor" => $request->meNor,
      "meObs" => $request->meObs,
      "meFil" => $name
    ]);
    return back()->with('Success', "Creación de matriz del EPP " . strtoupper($request->meEPP) . " fue exitoso");
  }

  function matrixupdate(Request $request)
  {
    $search = MatrixEPP::where('me_id', $request->matrixIdUpdate)
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'matrix_e_p_p_s.meDoc')->get();

    if ($search) {
      if ($request->hasfile('meFil')) {
        Storage::disk('opensoft')->delete(DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "MatrixEPP" . DIRECTORY_SEPARATOR . $search[0]['meFil']);
        $file = $request->file('meFil');
        $nameFile = $file->getClientOriginalName();
        $name = str_replace(" ", "", $nameFile);
        Storage::disk('opensoft')->putFileAs(DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "MatrixEPP" . DIRECTORY_SEPARATOR, $request->file('meFil'), $name);
      }

      MatrixEPP::where('me_id', $request->matrixIdUpdate)
        ->update([
          "meDoc" => $request->meDoc,
          "meEPP" => $request->meEPP,
          "meDes" => $request->meDes,
          "meNor" => $request->meNor,
          "meObs" => $request->meObs,
          "meFil" => $name
        ]);
      return back()->with("Update", "Matriz de EPP " . strtoupper($search[0]['meEPP']) . " y Documento " . strtoupper($search[0]['domName']) . " actualizado");
    }
    return back()->with("Error", "registro no Encontrado");
  }

  function matrixdelete(Request $request)
  {
    $search = MatrixEPP::where('me_id', $request->matrixIdDelete)
      ->join('documentsmanagerial', 'documentsmanagerial.domId', 'matrix_e_p_p_s.meDoc')->get();

    if ($search) {
      Storage::disk('opensoft')->delete(DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "MatrixEPP" . DIRECTORY_SEPARATOR . $search[0]['meFil']);

      MatrixEPP::destroy($request->matrixIdDelete);
      DB::statement("ALTER TABLE matrix_e_p_p_s AUTO_INCREMENT=1");
      return back()->with("Delete", "Registro del elemento de protección " . strtoupper($search[0]['meEPP']) . " eliminado satisfactoriamente");
    }
    return back()->with("Error", "registro no Encontrado");
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
