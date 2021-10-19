<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Document;
use App\Models\Variable;
use App\Models\Configdocument;

class SGCommercialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MANUAL DE FUNCIONES DE (SG-COMERCIAL)
    =============================================================================================== */
    
    function hankbookTo(){
        $documents = Document::all();
        return view('modules.SGCommercial.hankbook.index',compact('documents'));
    }

    function saveDocument(Request $request){
        // dd($request->all());
        $validate = Document::where('docName',$this::upper($request->docName))->first();
        if($validate == null){
            $docCode = $this::upper($request->docCode_one) . '-' . $this::upper($request->docCode_two) . '-' . $this::upper($request->docCode_three);
            Document::create([
                'docName' => $this::upper($request->docName),
                'docCode' => $docCode,
                'docVersion' => $this::upper($request->docVersion),
                'docDate' => trim($request->docDate)
            ]);
            return redirect()->route('commercial.hankbook')->with('SuccessCreation', 'Documento ' . $this::upper($request->docName) . ', registrado');
        }else{
            return redirect()->route('commercial.hankbook')->with('SecondaryCreation', 'Ya existe el nombre del documento (' . $validate->docName . ')');
        }
    }

    function updateDocument(Request $request){
        // dd($request->all());
        $validateOther = Document::where('docName',$this::upper($request->docName_Edit))
                                        ->where('docId','!=',trim($request->docId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Document::find(trim($request->docId_Edit));
            if($validate != null){
                $docCode = $this::upper($request->docCode_one_Edit) . '-' . $this::upper($request->docCode_two_Edit) . '-' . $this::upper($request->docCode_three_Edit);
                $validate->docName = $this::upper($request->docName_Edit);
                $validate->docCode = $docCode;
                $validate->docVersion = $this::upper($request->docVersion_Edit);
                $validate->docDate = trim($request->docDate_Edit);
                $validate->save();
                return redirect()->route('commercial.hankbook')->with('PrimaryCreation', 'Documento ' . $this::upper($request->docName_Edit) . ', actualizado');
            }else{
                return redirect()->route('commercial.hankbook')->with('SecondaryCreation', 'No se encuentra el documento');
            }
        }else{
            return redirect()->route('commercial.hankbook')->with('SecondaryCreation', 'Ya existe un documento con nombre (' . $validateOther->docName . ')');
        }
    }

    function deleteDocument(Request $request){
        // dd($request->all());
        $foreign = Configdocument::where('cdoDocument_id',trim($request->docId_Delete))->first();
        if($foreign == null){
            $validate = Document::find(trim($request->docId_Delete));
            if($validate != null){
                $name = $validate->docName;
                $validate->delete();
                return redirect()->route('commercial.hankbook')->with('WarningCreation', 'Documento ' . $name . ', eliminado');
            }else{
                return redirect()->route('commercial.hankbook')->with('SecondaryCreation', 'No se encuentra el documento');
            }
        }else{
            return redirect()->route('commercial.hankbook')->with('SecondaryCreation', 'No es posible eliminar registros relacionados');
        }
    }

    /* ===============================================================================================
			MODULO DE PROCEDIMIENTOS DE (SG-COMERCIAL)
    =============================================================================================== */

    function proceduresTo(){
        $variables = Variable::all();
        $documents = Document::all();
        return view('modules.SGCommercial.procedures.index',compact('variables','documents'));
    }

    function saveVariable(Request $request){
        // dd($request->all());
        $validate = Variable::where('varName',$this::upper($request->varName))->first();
        if($validate == null){
            Variable::create([
                'varDocument_id' => trim($request->varDocument_id),
                'varName' => $this::upper($request->varName),
                'varType' => trim($request->varType),
                'varLongitud' => trim($request->varLongitud)
            ]);
            return redirect()->route('commercial.procedures')->with('SuccessVariable', 'Variable ' . $this::upper($request->varName) . ', registrada');
        }else{
            return redirect()->route('commercial.procedures')->with('SecondaryVariable', 'Ya existe una variable con nombre (' . $validate->varName . ')');
        }
    }

    function updateVariable(Request $request){
        // dd($request->all());
        $validateOther = Variable::where('varName',$this::upper($request->varName_Edit))
                                        ->where('varId','!=',trim($request->varId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Variable::find(trim($request->varId_Edit));
            if($validate != null){
                $validate->varDocument_id = trim($request->varDocument_id_Edit);
                $validate->varName = $this::upper($request->varName_Edit);
                $validate->varType = trim($request->varType_Edit);
                $validate->varLongitud = trim($request->varLongitud_Edit);
                $validate->save();
                return redirect()->route('commercial.procedures')->with('PrimaryVariable', 'Variable ' . $this::upper($request->varName_Edit) . ', actualizada');
            }else{
                return redirect()->route('commercial.procedures')->with('SecondaryVariable', 'No se encuentra la variable');
            }
        }else{
            return redirect()->route('commercial.procedures')->with('SecondaryVariable', 'Ya existe una variable con nombre (' . $validateOther->varName . ')');
        }
    }

    function deleteVariable(Request $request){
        // dd($request->all());
        $validate = Variable::find(trim($request->varId_Delete));
        if($validate != null){
            $name = $validate->varName;
            $validate->delete();
            return redirect()->route('commercial.procedures')->with('WarningVariable', 'Variable ' . $name . ', eliminada');
        }else{
            return redirect()->route('commercial.procedures')->with('SecondaryVariable', 'No se encuentra la variable');
        }
    }

    /* ===============================================================================================
			MODULO DE PLANEACION DE (SG-COMERCIAL)
    =============================================================================================== */

    function planingTo(){
        $documents = Document::all();
        $configurations = Configdocument::all();
        return view('modules.SGCommercial.planning.index',compact('configurations','documents'));
    }

    function saveConfiguration(Request $request){
        // dd($request->all());
        /*
            $request->cdoDocument_id
            $request->cdoContent_example
        */
        $validate = Configdocument::where('cdoDocument_id',trim($request->cdoDocument_id))
                                ->where('cdoContent',$this::fu($request->cdoContent_example))
                                ->first();
        if($validate == null){
            Configdocument::create([
                'cdoDocument_id' => trim($request->cdoDocument_id),
                'cdoContent' => $this::fu($request->cdoContent_example)
            ]);
            $document = Document::find(trim($request->cdoDocument_id));
            return redirect()->route('commercial.planing')->with('SuccessDocument', 'Configuración de documento de ' . $document->docName . ', registrado');
        }else{
            return redirect()->route('commercial.planing')->with('SecondaryDocument', 'Ya existe una configuración de documento con el contenido escrito del documento (' . $validate->document->docName . ')');
        }
    }

    function updateConfiguration(Request $request){
        // dd($request->all());
        /*
            $request->cdoDocument_id_Edit
            $request->cdoContent_example_Edit
        */
        $validateOther = Configdocument::where('cdoDocument_id',trim($request->cdoDocument_id_Edit))
                                ->where('cdoContent',$this::fu($request->cdoContent_example_Edit))
                                ->where('cdoId','!=',trim($request->cdoId_Edit))
                                ->first();
        if($validateOther == null){
            $validate = Configdocument::find(trim($request->cdoId_Edit));
            if($validate != null){
                $document = $validate->document->docName;
                $validate->cdoDocument_id = trim($request->cdoDocument_id_Edit);
                $validate->cdoContent = $this::fu($request->cdoContent_example_Edit);
                $validate->save();
                return redirect()->route('commercial.planing')->with('PrimaryDocument', 'Configuración de documento de ' . $document . ', actualizado');
            }else{
                return redirect()->route('commercial.planing')->with('SecondaryDocument', 'No se encuentra la configuración de documento');
            }
        }else{
            return redirect()->route('commercial.planing')->with('SecondaryDocument', 'Ya existe una configuración de documento con el contenido escrito y documento (' . $validateOther->document->docName . ')');
        }
    }

    function deleteConfiguration(Request $request){
        // dd($request->all());
        /*
            $request->cdoId_Delete
        */
        $validate = Configdocument::find(trim($request->cdoId_Delete));
        if($validate != null){
            $name = $validate->document->docName;
            $validate->delete();
            return redirect()->route('commercial.planing')->with('WarningDocument', 'Configuración de documento de ' . $name . ', eliminado');
        }else{
            return redirect()->route('commercial.planing')->with('SecondaryDocument', 'No se encuentra la configuración de documento');
        }
    }

    /* ===============================================================================================
			MODULO DE PROGRAMAS DE (SG-COMERCIAL)
    =============================================================================================== */

    function programsTo(){
        return view('modules.SGCommercial.programs.index');
    }

    /* ===============================================================================================
			MODULO DE DOCUMENTOS DE (SG-COMERCIAL)
    =============================================================================================== */

    function documentsTo(){
        return view('modules.SGCommercial.documents.index');
    }

    /* ===============================================================================================
			MODULO DE FORMATOS DE (SG-COMERCIAL)
    =============================================================================================== */

    function formatsTo(){
        return view('modules.SGCommercial.formats.index');
    }
}
