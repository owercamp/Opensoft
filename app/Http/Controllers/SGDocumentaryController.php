<?php

namespace App\Http\Controllers;

use App\Models\Configdocumentsdocumentary;
use App\Models\Documentdocumentary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Variablesdocumentary;

class SGDocumentaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MANUAL DE FUNCIONES DE (SG-DOCUMENTAL)
    =============================================================================================== */
    
    function hankbookTo(){
        $DocDocumentary = Documentdocumentary::all();
        return view('modules.SGDocumentary.hankbook.index', compact('DocDocumentary'));
    }

    function saveDocumentdocumentary(Request $request){
        $validate = Documentdocumentary::where('dodName',$this::upper($request->dodName))->first();
        if($validate == null){
            $dodCode = $this::upper($request->dodCode_one) . '-' . $this::upper($request->dodCode_two) . '-' . $this::upper($request->dodCode_three);
            Documentdocumentary::create([
                'dodName' => $this::upper($request->dodName),
                'dodCode' => $dodCode,
                'dodVersion' => $this::upper($request->dodVersion),
                'dodDate' => trim($request->dodDate)
            ]);
            return redirect()->route('documentary.hankbook')->with('SuccessCreation', 'Documento Creado: '. $this::upper($request->dodName));
        }else{
            return redirect()->route('documentary.hankbook')->with('SecondaryCreation', 'Ya existe el nombre del documento (' . $validate->dodName . ')');
        }
    }

    function updateDocumentdocumentary(Request $request){
        $validateData = Documentdocumentary::where('dodName',$this::upper($request->dodName_Edit))
        ->where('dodId','!=',trim($request->dodId_Edit))
        ->first();
        if($validateData == null){
            $valida = Documentdocumentary::find($request->dodId_Edit);
            if($valida != null){
                $codigo = $this::upper($request->dodCode_one_Edit).'-'.$this::upper($request->dodCode_two_Edit).'-'.$this::upper($request->dodCode_three_Edit);
                $valida ->dodName = $this::upper($request->dodName_Edit);
                $valida ->dodCode = $codigo;
                $valida ->dodVersion = $this::upper($request->dodVersion_Edit);
                $valida->save();
                return redirect()->route('documentary.hankbook')->with('PrimaryCreation','Documento Actualizado: '.$this::upper($request->dodName_Edit));
            }else{
                return redirect()->route('documentary.hankbook')->with('SecondCreation','No Encontrado');
            }
        }else{
            return redirect()->route('documentary.hankbook')->with('SecondaryCreation','Ya existe un documento con el nombre: '. $request->dodName_Edit);
        }
    }

    function deleteDocumentdocumentary(Request $request){
        $foreign = Configdocumentsdocumentary::where('cddDocument_id',trim($request->dodId_Delete))->first();
        if($foreign == null){
            $validate = Documentdocumentary::find(trim($request->dodId_Delete));
            if($validate != null){
                $name = $validate->dodName;
                $validate->delete();
                return redirect()->route('documentary.hankbook')->with('WarningCreation','Documento Eliminado: '. $name);
            }else{
                return redirect()->route('documentary.hankbook')->with('SecondCreation','NoEncontrado');
            }
        }else{
            return redirect()->route('documentary.hankbook')->with('SecondaryCreation','No es posible eliminar registros relacionados');
        }
    }

    /* ===============================================================================================
			MODULO DE PROCEDIMIENTOS DE (SG-DOCUMENTAL)
    =============================================================================================== */

    function proceduresTo(){
        $variables = Variablesdocumentary::all();
        $documents = Documentdocumentary::all();
        return view('modules.SGDocumentary.procedures.index',compact('variables','documents'));
    }

    function saveVariableDocumentary(Request $request){
        $validar = Variablesdocumentary::where('valdName',$this::upper($request->valdName))->first();
        if($validar == null){
            Variablesdocumentary::create([
                'valdDocument_id' => trim($request->valdDocument_id),
                'valdName' => $this::upper($request->valdName),
                'valdType' => trim($request->valdType),
                'valdLongitud' => trim($request->valdLongitud)
            ]);
            return redirect()->route('documentary.procedures')->with('SuccessVariable', 'Variable Creado: '.$this::upper($request->valdName));
        }else{
            return redirect()->route('documentary.procedures')->with('SecondaryVariable', 'Variable '.$validar->valdName.' ya creada');
        }
    }

    function updateVariableDocumentary(Request $request){

        $validate = Variablesdocumentary::where('valdName', $this::upper($request->valdName_Edit))
        ->where('valdId','!=',trim($request->valdId_Edit))
        ->first();
        if($validate == null){
            $valida = Variablesdocumentary::find(trim($request->valdId_Edit));
            if($valida != null){
                $valida->valdDocument_id = trim($request->valdDocument_id_Edit);
                $valida->valdName = $this::upper($request->valdName_Edit);
                $valida->valdType = trim($request->valdType_Edit);
                $valida->valdLongitud = trim($request->valdLongitud_Edit);
                $valida->save();
                return redirect()->route('documentary.procedures')->with('PrimaryVariable','Variable Actualizada: '.$request->valdName_Edit);
            }else{
                return redirect()->route('documentary.procedures')->with('SecondaryVariable','Variable no Existente');
            }
        }else{
            return redirect()->route('documentary.procedures')->with('SecondaryVariable','Ya existe una variable: '.$validate->valdName);
        }
    }

    function deleteVariableDocumentary(Request $request){
        $validate = Variablesdocumentary::find(trim($request->valdId_Delete));
        if($validate != null){
            $name = $validate->valdName;
            $validate->delete();
            return redirect()->route('documentary.procedures')->with('WarningVariable','Variable Eliminada: '.$name);
        }else{
            return redirect()->route('documentary.procedures')->with('SecondaryVariable','No se encontro la variable');
        }
    }

    /* ===============================================================================================
			MODULO DE PLANEACION DE (SG-DOCUMENTAL)
    =============================================================================================== */

    function planingTo(){
        $documents = Documentdocumentary::all();
        $configuration = Configdocumentsdocumentary::all();
        return view('modules.SGDocumentary.planning.index', compact('configuration','documents'));
    }

    function saveConfigurationDocumentary(Request $request){
        $myValidate = Configdocumentsdocumentary::where('cddDocument_id',trim($request->cddDocument_id))
        ->where('cddContent',$this::fu($request->cddContent_example))
        ->first();
        if($myValidate == null){
            Configdocumentsdocumentary::create([
                'cddDocument_id' => trim($request->cddDocument_id),
                'cddContent' => $this::fu($request->cddContent_example)
            ]);
            $documentos = Documentdocumentary::find(trim($request->cddDocument_id));
            return redirect()->route('documentary.planing')->with('SuccessDocument', 'Registro Configuración del Documento: '.$documentos->dodName);
        }else{
            return redirect()->route('documentary.planing')->with('SecondaryDocument', 'Ya existe una configuración del documento (' . $myValidate->document->dodName . ') con su contenido');
        }
    }

    function updateConfigurationDocumentary(Request $request){
        $ValidateEdit = Configdocumentsdocumentary::where('cddDocument_id',trim($request->cddDocument_id_Edit))
        ->where('cddContent',$this::fu($request->cddContent_example_Edit))
        ->where('cddId','!=',trim($request->cddId_Edit))
        ->first();
        if($ValidateEdit == null){
            $validate = Configdocumentsdocumentary::find(trim($request->cddId_Edit));
            if($validate != null){
                $documents =$validate->document->dodName;
                $validate->cddDocument_id = trim($request->cddDocument_id_Edit);
                $validate->cddContent = $this::fu($request->cddContent_example_Edit);
                $validate->save();
                return redirect()->route('documentary.planing')->with('PrimaryDocument','Actualización Configuración del Documento: '.$documents);
            }else{
                return redirect()->route('documentary.planing')->with('SecondaryDocument','Configuración no encontrada');
            }
        }else{
            return redirect()->route('documentary.planing')->with('SecondaryDocument','Ya existe una configuración del documento (' . $ValidateEdit->document->dodName . ') con su contenido');
        }
    }

    function deleteConfigurationDocumentary(Request $request){
        $validate = Configdocumentsdocumentary::find(trim($request->cddId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('documentary.planing')->with('WarningDocument','Configuración Eliminada: '.$validate->document->dodName);
        }else{
            return redirect()->route('documentary.planing')->with('SecondaryVariable','No se encontro la variable');
        }
    }

    /* ===============================================================================================
			MODULO DE PROGRAMAS DE (SG-DOCUMENTAL)
    =============================================================================================== */

    function programsTo(){
        return view('modules.SGDocumentary.programs.index');
    }

    /* ===============================================================================================
			MODULO DE DOCUMENTOS DE (SG-DOCUMENTAL)
    =============================================================================================== */

    function documentsTo(){
        return view('modules.SGDocumentary.documents.index');
    }

    /* ===============================================================================================
			MODULO DE FORMATOS DE (SG-DOCUMENTAL)
    =============================================================================================== */

    function formatsTo(){
        return view('modules.SGDocumentary.formats.index');
    }
}
