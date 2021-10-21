<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\LegalParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentsManagementController extends Controller
{
  public function __construct()
  {
    return $this->middleware('auth');
  }

  function legalindex()
  {
    $collaborators = Collaborator::all();
    $legals = LegalParent::select('legal_parents.*', 'collaborators.*')
      ->join('collaborators', 'collaborators.coId', 'legal_parents.lp_collaborator')->get();
    return view('modules.document.legalPatern', compact('collaborators', 'legals'));
  }

  function legalsave(Request $request)
  {
    LegalParent::create([
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

    return back()->with("Success", "Se ha creado la Matriz Legal correctamente");
  }

  public function legalupdate(Request $request)
  {
    $search = LegalParent::find($request->legalIdUpdate);

    if (!$search) {
      return back()->with('Error', 'Registro no Encontrado');
    }

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

    return back()->with('Update', 'Registro de titulo ' . strtoupper($search->lp_title) . " ha sido actualizado");
  }

  public function legaldestroy(Request $request)
  {
    $searchDelete = legalParent::find($request->legalIdDelete);
    $title = $searchDelete->lp_title;

    if (!$searchDelete) {
      return back()->with('Error', 'Registro no Encontrado');
    }

    LegalParent::destroy($request->legalIdDelete);
    DB::statement("ALTER TABLE legal_parents AUTO_INCREMENT=1");

    return back()->with('Delete', 'Registro de titulo ' . strtoupper($title) . ' eliminado');
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
