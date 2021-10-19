<?php

namespace App\Http\Controllers;

use App\Models\Configdocumentimprovement;
use App\Models\Documentimprovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Variablesimprovement;

class SGImprovementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MANUAL DE FUNCIONES DE (SG-MEJORA CONTINUA)
    =============================================================================================== */
    
    function hankbookTo(){
        $DocImprovement = Documentimprovement::all();
        return view('modules.SGImprovement.hankbook.index', compact('DocImprovement'));
    }

    function saveDocumentimprovement(Request $request){
        
        $validate = Documentimprovement::where('doIName',$this::upper($request->doIName))->first();
        if($validate == null){
            $doICode = $this::upper($request->doICode_one) . '-' . $this::upper($request->doICode_two) . '-' . $this::upper($request->doICode_three);
            Documentimprovement::create([
                'doIName' => $this::upper($request->doIName),
                'doICode' => $doICode,
                'doIVersion' => $this::upper($request->doIVersion),
                'doIDate' => trim($request->doIDate)
            ]);
            return redirect()->route('improvement.hankbook')->with('SuccessCreation', 'Documento Creado: '. $this::upper($request->doIName));
        }else{
            return redirect()->route('improvement.hankbook')->with('SecondaryCreation', 'Ya existe el nombre del documento (' . $validate->doIName . ')');
        }
    }

    function updateDocumentimprovement(Request $request){

        $validateData = Documentimprovement::where('doIName',$this::upper($request->doIName_Edit))
        ->where('doIId','!=',trim($request->doIId_Edit))
        ->first();
        if($validateData == null){
            $valida = Documentimprovement::find($request->doIId_Edit);
            if($valida != null){
                $codigo = $this::upper($request->doICode_one_Edit).'-'.$this::upper($request->doICode_two_Edit).'-'.$this::upper($request->doICode_three_Edit);
                $valida ->doIName = $this::upper($request->doIName_Edit);
                $valida ->doICode = $codigo;
                $valida ->doIVersion = $this::upper($request->doIVersion_Edit);
                $valida->save();
                return redirect()->route('improvement.hankbook')->with('PrimaryCreation','Documento Actualizado: '.$this::upper($request->doIName_Edit));
            }else{
                return redirect()->route('improvement.hankbook')->with('SecondCreation','No Encontrado');
            }
        }else{
            return redirect()->route('improvement.hankbook')->with('SecondaryCreation','Ya existe un documento con el nombre: '. $request->doIName_Edit);
        }
    }

    function deleteDocumentimprovement(Request $request){

        $foreign = Configdocumentimprovement::where('cdiDocument_id',trim($request->doIId_Delete))->first();
        if($foreign == null){
            $validate = Documentimprovement::find(trim($request->doIId_Delete));
            if($validate != null){
                $name = $validate->doIName;
                $validate->delete();
                return redirect()->route('improvement.hankbook')->with('WarningCreation','Documento Eliminado: '. $name);
            }else{
                return redirect()->route('improvement.hankbook')->with('SecondCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('improvement.hankbook')->with('SecondaryCreation','No es posible eliminar registros relacionados');
        }
    }

    /* ===============================================================================================
			MODULO DE PROCEDIMIENTOS DE (SG-MEJORA CONTINUA)
    =============================================================================================== */

    function proceduresTo(){
        $variables = Variablesimprovement::all();
        $documents = Documentimprovement::all();
        return view('modules.SGImprovement.procedures.index', compact('variables','documents'));
    }

    function saveVariableImprovement(Request $request){
        $validar = Variablesimprovement::where('valIName',$this::upper($request->valIName))->first();
        if($validar == null){
            Variablesimprovement::create([
                'valIDocument_id' => trim($request->valIDocument_id),
                'valIName' => $this::upper($request->valIName),
                'valIType' => trim($request->valIType),
                'valILongitud' => trim($request->valILongitud)
            ]);
            return redirect()->route('improvement.procedures')->with('SuccessVariable', 'Variable Creado: '.$this::upper($request->valIName));
        }else{
            return redirect()->route('improvement.procedures')->with('SecondaryVariable', 'Variable '.$validar->valIName.' ya creada');
        }
    }

    function updateVariableImprovement(Request $request){

        $validate = Variablesimprovement::where('valIName', $this::upper($request->valIName_Edit))
        ->where('valIId','!=',trim($request->valIId_Edit))
        ->first();
        if($validate == null){
            $valida = Variablesimprovement::find(trim($request->valIId_Edit));
            if($valida != null){
                $valida->valIDocument_id = trim($request->valIDocument_id_Edit);
                $valida->valIName = $this::upper($request->valIName_Edit);
                $valida->valIType = trim($request->valIType_Edit);
                $valida->valILongitud = trim($request->valILongitud_Edit);
                $valida->save();
                return redirect()->route('improvement.procedures')->with('PrimaryVariable','Variable Actualizada: '.$request->valIName_Edit);
            }else{
                return redirect()->route('improvement.procedures')->with('SecondaryVariable','Variable no Existente');
            }
        }else{
            return redirect()->route('improvement.procedures')->with('SecondaryVariable','Ya existe una variable: '.$validate->valIName);
        }
    }

    function deleteVariableImprovement(Request $request){
        $validate = Variablesimprovement::find(trim($request->valIId_Delete));
        if($validate != null){
            $name = $validate->valIName;
            $validate->delete();
            return redirect()->route('improvement.procedures')->with('WarningVariable','Variable Eliminada: '.$name);
        }else{
            return redirect()->route('improvement.procedures')->with('SecondaryVariable','No se encontro la variable');
        }
    }

    /* ===============================================================================================
			MODULO DE PLANEACION DE (SG-MEJORA CONTINUA)
    =============================================================================================== */

    function planingTo(){
        $documentos = Documentimprovement::all();
        $configuracion = Configdocumentimprovement::all();
        return view('modules.SGImprovement.planning.index', compact('configuracion','documentos'));
    }

    function saveConfigImprovement(Request $request){
        $myValidate = Configdocumentimprovement::where('cdiDocument_id',trim($request->cdiDocument_id))
        ->where('cdiContent',$this::fu($request->cdiContent_example))
        ->first();
        if($myValidate == null){
            Configdocumentimprovement::create([
                'cdiDocument_id' => trim($request->cdiDocument_id),
                'cdiContent' => $this::fu($request->cdiContent_example)
            ]);
            $documentos = Documentimprovement::find(trim($request->cdiDocument_id));
            return redirect()->route('improvement.planing')->with('SuccessDocument', 'Registro Configuración del Documento: '.$documentos->doIName);
        }else{
            return redirect()->route('improvement.planing')->with('SecondaryDocument', 'Ya existe una configuración del documento (' . $myValidate->document->doIName . ') con su contenido');
        }
    }

    function updateConfigImprovement(Request $request){
        $ValidateEdit = Configdocumentimprovement::where('cdiDocument_id',trim($request->cdiDocument_id_Edit))
        ->where('cdiContent',$this::fu($request->cdiContent_example_Edit))
        ->where('cdiId','!=',trim($request->cdiId_Edit))
        ->first();
        if($ValidateEdit == null){
            $validate = Configdocumentimprovement::find(trim($request->cdiId_Edit));
            if($validate != null){
                $documents =$validate->document->doIName;
                $validate->cdiDocument_id = trim($request->cdiDocument_id_Edit);
                $validate->cdiContent = $this::fu($request->cdiContent_example_Edit);
                $validate->save();
                return redirect()->route('improvement.planing')->with('PrimaryDocument','Actualización Configuración del Documento: '.$documents);
            }else{
                return redirect()->route('improvement.planing')->with('SecondaryDocument','Configuración no encontrada');
            }
        }else{
            return redirect()->route('improvement.planing')->with('SecondaryDocument','Ya existe una configuración del documento (' . $ValidateEdit->document->doIName . ') con su contenido');
        }
    }

    function deleteConfigImprovement(Request $request){
        $validate = Configdocumentimprovement::find(trim($request->cdiId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('improvement.planing')->with('WarningDocument','Configuración Eliminada: '.$validate->document->doIName);
        }else{
            return redirect()->route('improvement.planing')->with('SecondaryVariable','No se encontro la variable');
        }
    }

    /* ===============================================================================================
			MODULO DE PROGRAMAS DE (SG-MEJORA CONTINUA)
    =============================================================================================== */

    function programsTo(){
        return view('modules.SGImprovement.programs.index');
    }

    /* ===============================================================================================
			MODULO DE DOCUMENTOS DE (SG-MEJORA CONTINUA)
    =============================================================================================== */

    function documentsTo(){
        return view('modules.SGImprovement.documents.index');
    }

    /* ===============================================================================================
			MODULO DE FORMATOS DE (SG-MEJORA CONTINUA)
    =============================================================================================== */

    function formatsTo(){
        return view('modules.SGImprovement.formats.index');
    }
}
