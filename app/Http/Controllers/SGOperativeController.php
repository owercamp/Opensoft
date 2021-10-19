<?php

namespace App\Http\Controllers;

use App\Models\configdocumentoperative;
use App\Models\Documentoperative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Variableoperative;

class SGOperativeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MANUAL DE FUNCIONES DE (SG-OPERATIVO)
    =============================================================================================== */
    
    function hankbookTo(){
        $DocumentOp = Documentoperative::all();
        return view('modules.SGOperative.hankbook.index', compact('DocumentOp'));
    }

    function saveDocumentOperative(Request $request){
        $Saves = Documentoperative::where('doOName', $this::upper($request->doOName))->first();
        if($Saves == null){
            $doOCode = $this::upper($request->doOCode_one) . '-' . $this::upper($request->doOCode_two) . '-' . $this::upper($request->doOCode_three);
            Documentoperative::create([
                'doOName' => $this::upper($request->doOName),
                'doOCode' => $doOCode,
                'doOVersion' => $this::upper($request->doOVersion),
                'doODate' => trim($request->doODate)
            ]);
            return redirect()->route('operative.hankbook')->with('SuccessCreation', 'Documento Creado: '.$this::upper($request->doOName));
        }else{
            return redirect()->route('operative.hankbook')->with('SecondaryCreation', 'Ya existe el nombre del documento (' . $Saves->doOName . ')');
        }
    }

    function updateDocumentOperative(Request $request){
        $validate = Documentoperative::where('doOName',$this::upper($request->doOName_Edit))
        ->where('doOId','!=',trim($request->doOId_Edit))
        ->first();
        if($validate == null){
            $validateData = Documentoperative::find($request->doOId_Edit);
            if($validateData != null){
                $codigo = $this::upper($request->doOCode_one_Edit).'-'.($request->doOCode_two_Edit).'-'.($request->doOCode_three_Edit);
                $validateData->doOName=$this::upper($request->doOName_Edit);
                $validateData->doOCode=$codigo;
                $validateData->doOversion=$this::upper($request->doOVersion_Edit);
                $validateData->save();
                return redirect()->route('operative.hankbook')->with('PrimaryCreation','Documento Actualizado: '.$this::upper($request->doOName_Edit));
            }else{
                return redirect()->route('operative.hankbook')->with('SecondCreation','No Encontrado');
            }
        }else{
            return redirect()->route('operative.hankbook')->with('SecondaryCreation','Ya existe un documento con el nombre: '. $request->doOName_Edit);
        }
    }

    function deleteDocumentOperative(Request $request){
        $foreing = configdocumentoperative::where('cdoDocument_id', trim($request->doOId_Delete))->first();
        if($foreing == null){
            $validate = Documentoperative::find(trim($request->doOId_Delete));
            if($validate != null){
                $name = $validate->doOName;
                $validate->delete();
                return redirect()->route('operative.hankbook')->with('WarningCreation','Documento Eliminado: '. $name);
            }else{
                return redirect()->route('operative.hankbook')->with('SecondCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('managerial.hankbook')->with('SecondaryCreation','No es posible eliminar registros relacionados');
        }
    }

    /* ===============================================================================================
			MODULO DE PROCEDIMIENTOS DE (SG-OPERATIVO)
    =============================================================================================== */

    function proceduresTo(){
        $variables = Variableoperative::all();
        $documentos = Documentoperative::all();
        return view('modules.SGOperative.procedures.index', compact('variables','documentos'));
    }

    function saveVariableOperative(Request $request){
        $validate = Variableoperative::where('valOName',$this::upper($request->valOName))->first();
        if($validate == null){
            Variableoperative::create([
                'valODocument_id' => trim($request->valODocument_id),
                'valOName' => $this::upper($request->valOName),
                'valOType' => trim($request->valOType),
                'valOLongitud' => trim($request->valOLongitud)
            ]);
            return redirect()->route('operative.procedures')->with('SuccessVariable', 'Variable Creado: '.$this::upper($request->valOName));
        }else{
            return redirect()->route('operative.procedures')->with('SecondaryVariable', 'Variable '.$validate->valOName.' ya creada');
        }
    }

    function updateVariableOperative(Request $request){
        $validate = Variableoperative::where('valOName', $this::upper($request->valOName_Edit))
        ->where('valOId','!=',trim($request->valOId_Edit))
        ->first();
        if($validate == null){
            $valida = Variableoperative::find(trim($request->valOId_Edit));
            if($valida != null){
                $valida->valODocument_id = trim($request->valODocument_id_Edit);
                $valida->valOName = $this::upper($request->valOName_Edit);
                $valida->valOType = trim($request->valOType_Edit);
                $valida->valOLongitud = trim($request->valOLongitud_Edit);
                $valida->save();
                return redirect()->route('operative.procedures')->with('PrimaryVariable','Variable Actualizada: '.$request->valOName_Edit);
            }else{
                return redirect()->route('operative.procedures')->with('SecondaryVariable','Variable no Existente');
            }
        }else{
            return redirect()->route('operative.procedures')->with('SecondaryVariable','Ya existe una variable: '.$validate->valOName);
        }
    }

    function deleteVariableOperative(Request $request){
        $validate = Variableoperative::find(trim($request->valOId_Delete));
        if($validate != null){
            $name = $validate->valOName;
            $validate->delete();
            return redirect()->route('operative.procedures')->with('WarningVariable','Variable Eliminada: '.$name);
        }else{
            return redirect()->route('operative.procedures')->with('SecondaryVariable','No se encontro la variable');
        }
    }

    /* ===============================================================================================
			MODULO DE PLANEACION DE (SG-OPERATIVO)
    =============================================================================================== */

    function planingTo(){
        $documents = Documentoperative::all();
        $configuration = Configdocumentoperative::all();
        return view('modules.SGOperative.planning.index',compact('configuration','documents'));
    }

    function saveConfiguration(Request $request){
        $myValidate = Configdocumentoperative::where('cdoDocument_id',trim($request->cdoDocument_id))
        ->where('cdoContent',$this::fu($request->cdoContent_example))
        ->first();
        if($myValidate == null){
            Configdocumentoperative::create([
                'cdoDocument_id' => trim($request->cdoDocument_id),
                'cdoContent' => $this::fu($request->cdoContent_example)
            ]);
            $documentos = Documentoperative::find(trim($request->cdoDocument_id));
            return redirect()->route('operative.planing')->with('SuccessDocument', 'Registro Configuración del Documento: '.$documentos->doOName);
        }else{
            return redirect()->route('operative.planing')->with('SecondaryDocument', 'Ya existe una configuración del documento (' . $myValidate->document->doOName . ') con su contenido');
        }
    }

    function updateConfiguration(Request $request){
        $ValidateEdit = Configdocumentoperative::where('cdoDocument_id',trim($request->cdoDocument_id_Edit))
        ->where('cdoContent',$this::fu($request->cdoContent_example_Edit))
        ->where('cdOId','!=',trim($request->cdoId_Edit))
        ->first();
        if($ValidateEdit == null){
            $validate = Configdocumentoperative::find(trim($request->cdoId_Edit));
            if($validate != null){
                $documents =$validate->document->doOName;
                $validate->cdoDocument_id = trim($request->cdoDocument_id_Edit);
                $validate->cdoContent = $this::fu($request->cdoContent_example_Edit);
                $validate->save();
                return redirect()->route('operative.planing')->with('PrimaryDocument','Actualización Configuración del Documento: '.$documents);
            }else{
                return redirect()->route('operative.planing')->with('SecondaryDocument','Configuración no encontrada');
            }
        }else{
            return redirect()->route('operative.planing')->with('SecondaryDocument','Ya existe una configuración del documento (' . $ValidateEdit->document->doOName . ') con su contenido');
        }
    }

    function deleteConfiguration(Request $request){
        $validate = Configdocumentoperative::find(trim($request->cdoId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('operative.planing')->with('WarningDocument','Configuración Eliminada: '.$validate->document->doOName);
        }else{
            return redirect()->route('operative.planing')->with('SecondaryVariable','No se encontro la variable');
        }
    }

    /* ===============================================================================================
			MODULO DE PROGRAMAS DE (SG-OPERATIVO)
    =============================================================================================== */

    function programsTo(){
        return view('modules.SGOperative.programs.index');
    }

    /* ===============================================================================================
			MODULO DE DOCUMENTOS DE (SG-OPERATIVO)
    =============================================================================================== */

    function documentsTo(){
        return view('modules.SGOperative.documents.index');
    }

    /* ===============================================================================================
			MODULO DE FORMATOS DE (SG-OPERATIVO)
    =============================================================================================== */

    function formatsTo(){
        return view('modules.SGOperative.formats.index');
    }
}
