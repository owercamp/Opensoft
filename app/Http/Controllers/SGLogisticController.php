<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Documentlogistic;
use App\Models\Variablelogistic;
use App\Models\Configdocumentlogistic;
use App\Models\Handbookcollaborator;
use App\Models\Affiliationcollaborator;
use App\Models\Endowmentcollaborator;
use App\Models\Billcollaborator;

class SGLogisticController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /* ===============================================================================================
			MODULO DE MANUAL DE FUNCIONES DE (SG-LOGISTICA)
    =============================================================================================== */

  function hankbookTo()
  {
    $documents = Documentlogistic::all();
    return view('modules.SGLogistic.hankbook.index', compact('documents'));
  }

  function saveDocumentlogistic(Request $request)
  {
    // dd($request->all());
    $validate = Documentlogistic::where('dolName', $this::upper($request->dolName))->first();
    if ($validate == null) {
      $dolCode = $this::upper($request->dolCode_one) . '-' . $this::upper($request->dolCode_two) . '-' . $this::upper($request->dolCode_three);
      Documentlogistic::create([
        'dolName' => $this::upper($request->dolName),
        'dolCode' => $dolCode,
        'dolVersion' => $this::upper($request->dolVersion),
        'dolDate' => trim($request->dolDate)
      ]);
      return redirect()->route('logistic.hankbook')->with('SuccessCreation', 'Documento ' . $this::upper($request->dolName) . ', registrado');
    } else {
      return redirect()->route('logistic.hankbook')->with('SecondaryCreation', 'Ya existe el nombre del documento (' . $validate->dolName . ')');
    }
  }

  function updateDocumentlogistic(Request $request)
  {
    // dd($request->all());
    $validateOther = Documentlogistic::where('dolName', $this::upper($request->dolName_Edit))
      ->where('dolId', '!=', trim($request->dolId_Edit))
      ->first();
    if ($validateOther == null) {
      $validate = Documentlogistic::find(trim($request->dolId_Edit));
      if ($validate != null) {
        $dolCode = $this::upper($request->dolCode_one_Edit) . '-' . $this::upper($request->dolCode_two_Edit) . '-' . $this::upper($request->dolCode_three_Edit);
        $validate->dolName = $this::upper($request->dolName_Edit);
        $validate->dolCode = $dolCode;
        $validate->dolVersion = $this::upper($request->dolVersion_Edit);
        $validate->dolDate = trim($request->dolDate_Edit);
        $validate->save();
        return redirect()->route('logistic.hankbook')->with('PrimaryCreation', 'Documento ' . $this::upper($request->dolName_Edit) . ', actualizado');
      } else {
        return redirect()->route('logistic.hankbook')->with('SecondaryCreation', 'No se encuentra el documento');
      }
    } else {
      return redirect()->route('logistic.hankbook')->with('SecondaryCreation', 'Ya existe un documento con nombre (' . $validateOther->dolName . ')');
    }
  }

  function deleteDocumentlogistic(Request $request)
  {
    // dd($request->all());
    $foreign = Configdocumentlogistic::where('cdlDocument_id', trim($request->dolId_Delete))->first();
    if ($foreign == null) {
      $validate = Documentlogistic::find(trim($request->dolId_Delete));
      if ($validate != null) {
        $name = $validate->dolName;
        $validate->delete();
        return redirect()->route('logistic.hankbook')->with('WarningCreation', 'Documento ' . $name . ', eliminado');
      } else {
        return redirect()->route('logistic.hankbook')->with('SecondaryCreation', 'No se encuentra el documento');
      }
    } else {
      return redirect()->route('logistic.hankbook')->with('SecondaryCreation', 'No es posible eliminar registros relacionados');
    }
  }

  /* ===============================================================================================
			MODULO DE PROCEDIMIENTOS DE (SG-LOGISTICA)
    =============================================================================================== */

  function proceduresTo()
  {
    $variables = Variablelogistic::all();
    $documents = Documentlogistic::all();
    return view('modules.SGLogistic.procedures.index', compact('variables', 'documents'));
  }

  function saveVariable(Request $request)
  {
    // dd($request->all());
    $validate = Variablelogistic::where('valName', $this::upper($request->valName))->first();
    if ($validate == null) {
      Variablelogistic::create([
        'valDocument_id' => trim($request->valDocument_id),
        'valName' => $this::upper($request->valName),
        'valType' => trim($request->valType),
        'valLongitud' => trim($request->valLongitud)
      ]);
      return redirect()->route('logistic.procedures')->with('SuccessVariable', 'Variable ' . $this::upper($request->valName) . ', registrada');
    } else {
      return redirect()->route('logistic.procedures')->with('SecondaryVariable', 'Ya existe una variable con nombre (' . $validate->valName . ')');
    }
  }

  function updateVariable(Request $request)
  {
    // dd($request->all());
    $validateOther = Variablelogistic::where('valName', $this::upper($request->valName_Edit))
      ->where('valId', '!=', trim($request->valId_Edit))
      ->first();
    if ($validateOther == null) {
      $validate = Variablelogistic::find(trim($request->valId_Edit));
      if ($validate != null) {
        $validate->valDocument_id = trim($request->valDocument_id_Edit);
        $validate->valName = $this::upper($request->valName_Edit);
        $validate->valType = trim($request->valType_Edit);
        $validate->valLongitud = trim($request->valLongitud_Edit);
        $validate->save();
        return redirect()->route('logistic.procedures')->with('PrimaryVariable', 'Variable ' . $this::upper($request->valName_Edit) . ', actualizada');
      } else {
        return redirect()->route('logistic.procedures')->with('SecondaryVariable', 'No se encuentra la variable');
      }
    } else {
      return redirect()->route('logistic.procedures')->with('SecondaryVariable', 'Ya existe una variable con nombre (' . $validateOther->valName . ')');
    }
  }

  function deleteVariable(Request $request)
  {
    // dd($request->all());
    $validate = Variablelogistic::find(trim($request->valId_Delete));
    if ($validate != null) {
      $name = $validate->valName;
      $validate->delete();
      return redirect()->route('logistic.procedures')->with('WarningVariable', 'Variable ' . $name . ', eliminada');
    } else {
      return redirect()->route('logistic.procedures')->with('SecondaryVariable', 'No se encuentra la variable');
    }
  }

  /* ===============================================================================================
			MODULO DE PLANEACION DE (SG-LOGISTICA)
    =============================================================================================== */

  function planingTo()
  {
    $documents = Documentlogistic::all();
    $configurations = Configdocumentlogistic::all();
    return view('modules.SGLogistic.planning.index', compact('configurations', 'documents'));
  }

  function saveConfiguration(Request $request)
  {
    // dd($request->all());
    /*
            $request->cdlDocument_id
            $request->cdlContent_example
        */
    $validate = Configdocumentlogistic::where('cdlDocument_id', trim($request->cdlDocument_id))
      ->where('cdlContent', $request->cdlContent)
      ->first();
    if ($validate == null) {
      Configdocumentlogistic::create([
        'cdlDocument_id' => trim($request->cdlDocument_id),
        'cdlContent' => $request->cdlContent
      ]);
      $document = Documentlogistic::find(trim($request->cdlDocument_id));
      return redirect()->route('logistic.planing')->with('SuccessDocument', 'Configuración de documento de ' . $document->dolName . ', registrado');
    } else {
      return redirect()->route('logistic.planing')->with('SecondaryDocument', 'Ya existe una configuración de documento con el contenido escrito del documento (' . $validate->document->dolName . ')');
    }
  }

  function updateConfiguration(Request $request)
  {
    // dd($request->all());
    /*
            $request->cdlDocument_id_Edit
            $request->cdlContent_example_Edit
        */
    $validateOther = Configdocumentlogistic::where('cdlDocument_id', trim($request->cdlDocument_id_Edit))
      ->where('cdlContent', $request->cdlContent_Edit)
      ->where('cdlId', '!=', trim($request->cdlId_Edit))
      ->first();
    if ($validateOther == null) {
      $validate = Configdocumentlogistic::find(trim($request->cdlId_Edit));
      if ($validate != null) {
        $document = $validate->document->dolName;
        $validate->cdlDocument_id = trim($request->cdlDocument_id_Edit);
        $validate->cdlContent = $request->cdlContent_Edit;
        $validate->save();
        return redirect()->route('logistic.planing')->with('PrimaryDocument', 'Configuración de documento de ' . $document . ', actualizado');
      } else {
        return redirect()->route('logistic.planing')->with('SecondaryDocument', 'No se encuentra la configuración de documento');
      }
    } else {
      return redirect()->route('logistic.planing')->with('SecondaryDocument', 'Ya existe una configuración de documento con el contenido escrito y documento (' . $validateOther->document->dolName . ')');
    }
  }

  function deleteConfiguration(Request $request)
  {
    // dd($request->all());
    /*
            $request->cdlId_Delete
        */
    $foreign = Billcollaborator::where('bcoConfigdocument_id', trim($request->cdlId_Delete))->where('bcoStatus', 'VIGENTE')->first();
    if ($foreign == null) {
      $validate = Configdocumentlogistic::find(trim($request->cdlId_Delete));
      if ($validate != null) {
        $name = $validate->document->dolName;
        $validate->delete();
        return redirect()->route('logistic.planing')->with('WarningDocument', 'Configuración de documento de ' . $name . ', eliminado');
      } else {
        return redirect()->route('logistic.planing')->with('SecondaryDocument', 'No se encuentra la configuración de documento');
      }
    } else {
      return redirect()->route('logistic.hankbook')->with('SecondaryCreation', 'No es posible eliminar registros relacionados');
    }
  }

  /* ===============================================================================================
			MODULO DE PROGRAMAS DE (SG-LOGISTICA)
    =============================================================================================== */

  function programsTo()
  {
    return view('modules.SGLogistic.programs.index');
  }

  /* ===============================================================================================
			MODULO DE DOCUMENTOS DE (SG-LOGISTICA)
    =============================================================================================== */

  function documentsTo()
  {
    return view('modules.SGLogistic.documents.index');
  }

  /* ===============================================================================================
			MODULO DE FORMATOS DE (SG-LOGISTICA)
    =============================================================================================== */

  function formatsTo()
  {
    return view('modules.SGLogistic.formats.index');
  }
}
