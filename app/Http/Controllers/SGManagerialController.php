<?php

namespace App\Http\Controllers;

use App\Models\Configdocumentmanagerial;
use App\Models\Documentmanagerial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Variablemanagerial;

class SGManagerialController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /* ===============================================================================================
			MODULO DE MANUAL DE FUNCIONES DE (SG-GERENCIAL)
    =============================================================================================== */

  function hankbookTo()
  {
    $DocumentMNG = Documentmanagerial::all();
    return view('modules.SGManagerial.hankbook.index', compact('DocumentMNG'));
  }

  function saveDocumentmanagerial(Request $request)
  {

    $validate = Documentmanagerial::where('domName', Str::upper($request->domName))->first();
    if ($validate == null) {
      $domCode = Str::upper($request->domCode_one) . '-' . Str::upper($request->domCode_two) . '-' . Str::upper($request->domCode_three);
      Documentmanagerial::create([
        'domName' => Str::upper($request->domName),
        'domCode' => $domCode,
        'domVersion' => Str::upper($request->domVersion),
        'domDate' => trim($request->domDate)
      ]);
      return redirect()->route('managerial.hankbook')->with('SuccessCreation', 'Documento Creado: ' . Str::upper($request->domName));
    } else {
      return redirect()->route('managerial.hankbook')->with('SecondaryCreation', 'Ya existe el nombre del documento (' . $validate->domName . ')');
    }
  }

  function updateDocumentmanagerial(Request $request)
  {

    $validateData = Documentmanagerial::where('domName', Str::upper($request->domName_Edit))
      ->where('domId', '!=', trim($request->domId_Edit))
      ->first();
    if ($validateData == null) {
      $valida = Documentmanagerial::find($request->domId_Edit);
      if ($valida != null) {
        $codigo = Str::upper($request->domCode_one_Edit) . '-' . Str::upper($request->domCode_two_Edit) . '-' . Str::upper($request->domCode_three_Edit);
        $valida->domName = Str::upper($request->domName_Edit);
        $valida->domCode = $codigo;
        $valida->domVersion = Str::upper($request->domVersion_Edit);
        $valida->save();
        return redirect()->route('managerial.hankbook')->with('PrimaryCreation', 'Documento Actualizado: ' . Str::upper($request->domName_Edit));
      } else {
        return redirect()->route('managerial.hankbook')->with('SecondCreation', 'No Encontrado');
      }
    } else {
      return redirect()->route('managerial.hankbook')->with('SecondaryCreation', 'Ya existe un documento con el nombre: ' . $request->domName_Edit);
    }
  }

  function deleteDocumentmanagerial(Request $request)
  {

    $foreign = Configdocumentmanagerial::where('cdmDocument_id', trim($request->domId_Delete))->first();
    if ($foreign == null) {
      $validate = Documentmanagerial::find(trim($request->domId_Delete));
      if ($validate != null) {
        $name = $validate->domName;
        $validate->delete();
        return redirect()->route('managerial.hankbook')->with('WarningCreation', 'Documento Eliminado: ' . $name);
      } else {
        return redirect()->route('managerial.hankbook')->with('SecondCreation', 'NoEncontrado');
      }
    } else {
      return redirect()->route('managerial.hankbook')->with('SecondaryCreation', 'No es posible eliminar registros relacionados');
    }
  }

  /* ===============================================================================================
			MODULO DE PROCEDIMIENTOS DE (SG-GERENCIAL)
    =============================================================================================== */

  function proceduresTo()
  {
    $variables = Variablemanagerial::all();
    $documents = Documentmanagerial::all();
    return view('modules.SGManagerial.procedures.index', compact('variables', 'documents'));
  }

  function saveVariableMNG(Request $request)
  {
    $validar = Variablemanagerial::where('valmName', Str::upper($request->valmName))->first();
    if ($validar == null) {
      Variablemanagerial::create([
        'valmDocument_id' => trim($request->valmDocument_id),
        'valmName' => Str::upper($request->valmName),
        'valmType' => trim($request->valmType),
        'valmLongitud' => trim($request->valmLongitud)
      ]);
      return redirect()->route('managerial.procedures')->with('SuccessVariable', 'Variable Creado: ' . Str::upper($request->valmName));
    } else {
      return redirect()->route('managerial.procedures')->with('SecondaryVariable', 'Variable ' . $validar->valmName . ' ya creada');
    }
  }

  function updateVariableMNG(Request $request)
  {

    $validate = Variablemanagerial::where('valmName', Str::upper($request->valmName_Edit))
      ->where('valmid', '!=', trim($request->valmId_Edit))
      ->first();
    if ($validate == null) {
      $valida = Variablemanagerial::find(trim($request->valmId_Edit));
      if ($valida != null) {
        $valida->valmDocument_id = trim($request->valmDocument_id_Edit);
        $valida->valmName = Str::upper($request->valmName_Edit);
        $valida->valmType = trim($request->valmType_Edit);
        $valida->valmLongitud = trim($request->valmLongitud_Edit);
        $valida->save();
        return redirect()->route('managerial.procedures')->with('PrimaryVariable', 'Variable Actualizada: ' . $request->valmName_Edit);
      } else {
        return redirect()->route('managerial.procedures')->with('SecondaryVariable', 'Variable no Existente');
      }
    } else {
      return redirect()->route('managerial.procedures')->with('SecondaryVariable', 'Ya existe una variable: ' . $validate->valmName);
    }
  }

  function deleteVariableMNG(Request $request)
  {
    $validate = Variablemanagerial::find(trim($request->valmId_Delete));
    if ($validate != null) {
      $name = $validate->valmName;
      $validate->delete();
      return redirect()->route('managerial.procedures')->with('WarningVariable', 'Variable Eliminada: ' . $name);
    } else {
      return redirect()->route('managerial.procedures')->with('SecondaryVariable', 'No se encontro la variable');
    }
  }

  /* ===============================================================================================
			MODULO DE PLANEACION DE (SG-GERENCIAL)
    =============================================================================================== */

  function planingTo()
  {
    $documentos = Documentmanagerial::all();
    $configuracion = Configdocumentmanagerial::all();
    return view('modules.SGManagerial.planning.index', compact('configuracion', 'documentos'));
  }

  function saveConfigMNG(Request $request)
  {
    $myValidate = Configdocumentmanagerial::where('cdmDocument_id', trim($request->cdmDocument_id))
      ->where('cdmContent', $this->fu($request->cdmContent))
      ->first();
    if ($myValidate == null) {
      Configdocumentmanagerial::create([
        'cdmDocument_id' => trim($request->cdmDocument_id),
        'cdmContent' => $this->fu($request->cdmContent)
      ]);
      $documentos = Documentmanagerial::find(trim($request->cdmDocument_id));
      return redirect()->route('managerial.planing')->with('SuccessDocument', 'Registro Configuración del Documento: ' . $documentos->domName);
    } else {
      return redirect()->route('managerial.planing')->with('SecondaryDocument', 'Ya existe una configuración del documento (' . $myValidate->document->domName . ') con su contenido');
    }
  }

  function updateConfigMNG(Request $request)
  {
    $ValidateEdit = Configdocumentmanagerial::where('cdmDocument_id', trim($request->cdmDocument_id_Edit))
      ->where('cdmContent', $this->fu($request->cdmContent_Edit))
      ->where('cdmId', '!=', trim($request->cdmId_Edit))
      ->first();
    if ($ValidateEdit == null) {
      $validate = Configdocumentmanagerial::find(trim($request->cdmId_Edit));
      if ($validate != null) {
        $documents = $validate->document->domName;
        $validate->cdmDocument_id = trim($request->cdmDocument_id_Edit);
        $validate->cdmContent = $this->fu($request->cdmContent_Edit);
        $validate->save();
        return redirect()->route('managerial.planing')->with('PrimaryDocument', 'Actualización Configuración del Documento: ' . $documents);
      } else {
        return redirect()->route('managerial.planing')->with('SecondaryDocument', 'Configuración no encontrada');
      }
    } else {
      return redirect()->route('managerial.planing')->with('SecondaryDocument', 'Ya existe una configuración del documento (' . $ValidateEdit->document->domName . ') con su contenido');
    }
  }

  function deleteConfigMNG(Request $request)
  {
    $validate = Configdocumentmanagerial::find(trim($request->cdmId_Delete));
    if ($validate != null) {
      $validate->delete();
      return redirect()->route('managerial.planing')->with('WarningDocument', 'Configuración Eliminada: ' . $validate->document->domName);
    } else {
      return redirect()->route('managerial.planing')->with('SecondaryVariable', 'No se encontro la variable');
    }
  }

  /* ===============================================================================================
			MODULO DE PROGRAMAS DE (SG-GERENCIAL)
    =============================================================================================== */

  function programsTo()
  {
    return view('modules.SGManagerial.programs.index');
  }

  /* ===============================================================================================
			MODULO DE DOCUMENTOS DE (SG-GERENCIAL)
    =============================================================================================== */

  function documentsTo()
  {
    return view('modules.SGManagerial.documents.index');
  }

  /* ===============================================================================================
			MODULO DE FORMATOS DE (SG-GERENCIAL)
    =============================================================================================== */

  function formatsTo()
  {
    return view('modules.SGManagerial.formats.index');
  }
}
