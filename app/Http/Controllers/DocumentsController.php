<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Settingpersonal;
use App\Models\Settingdriving;
use App\Models\Settingcourse;
use App\Models\Settinginsurance;
use App\Models\Settinglegalization;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE DOCUMENTOS PERSONALES (personal)
    =============================================================================================== */
    
    function personalTo(){
        $personals = Settingpersonal::all();
        return view('modules.documents.personal.index',compact('personals'));
    }

    function savePersonals(Request $request){
        // dd($request->all());
        $validate = Settingpersonal::where('perName',ucfirst(mb_strtolower(trim($request->perName),'UTF-8')))->first();
        if($validate == null){
            Settingpersonal::create([
                'perName' => ucfirst(mb_strtolower(trim($request->perName)))
            ]);
            return redirect()->route('documents.personal')->with('SuccessPersonals', 'Identificación ' . ucfirst(mb_strtolower(trim($request->perName),'UTF-8')) . ', registrada');
        }else{
            return redirect()->route('documents.personal')->with('SecondaryPersonals', 'Ya existe la identificación ' . $validate->perName);
        }   
    }

    function updatePersonals(Request $request){
        // dd($request->all());
        $validateOther = Settingpersonal::where('perName',ucfirst(mb_strtolower(trim($request->perName_Edit),'UTF-8')))
                                        ->where('perId','!=',trim($request->perId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingpersonal::find(trim($request->perId_Edit));
            if($validate != null){
                $nameOld = $validate->perName;
                $validate->perName = ucfirst(mb_strtolower(trim($request->perName_Edit),'UTF-8'));
                $validate->save();
                return redirect()->route('documents.personal')->with('PrimaryPersonals', 'Identificación ' . $nameOld . ' a ' . ucfirst(mb_strtolower(trim($request->perName_Edit),'UTF-8')) . ', actualizada');
            }else{
                return redirect()->route('documents.personal')->with('SecondaryPersonals', 'No se encuentra identificación, consulte al administrador');
            }
        }else{
            return redirect()->route('documents.personal')->with('SecondaryPersonals', 'Ya existe la identificación ' . $validateOther->perName . ', consulte al administrador');
        }
    }

    function deletePersonals(Request $request){
        // dd($request->all());
        $validate = Settingpersonal::find(trim($request->perId_Delete));
        if($validate != null){
            $name = $validate->perName;
            $validate->delete();
            return redirect()->route('documents.personal')->with('WarningPersonals', 'Identificación ' . $name . ', eliminada');
        }else{
            return redirect()->route('documents.personal')->with('SecondaryPersonals', 'No se encuentra la identificación, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE LICENCIAS DE CONDUCCION (driving)
    =============================================================================================== */

    function drivingTo(){
        $drivings = Settingdriving::all();
        return view('modules.documents.driving.index',compact('drivings'));
    }

    function saveDrivings(Request $request){
        // dd($request->all());
        $validate = Settingdriving::where('driCategory',mb_strtoupper(trim($request->driCategory),'UTF-8'))
                                    ->where('driClassvehicle',ucfirst(mb_strtolower(trim($request->driClassvehicle),'UTF-8')))
                                    ->where('driTypeservice',ucfirst(mb_strtolower(trim($request->driTypeservice),'UTF-8')))
                                    ->first();
        if($validate == null){
            Settingdriving::create([
                'driCategory' => mb_strtoupper(trim($request->driCategory),'UTF-8'),
                'driClassvehicle' => ucfirst(mb_strtolower(trim($request->driClassvehicle))),
                'driTypeservice' => ucfirst(mb_strtolower(trim($request->driTypeservice)))
            ]);
            return redirect()->route('documents.driving')->with('SuccessDrivings', 'Licencia de conducción ' . mb_strtoupper(trim($request->driCategory),'UTF-8') . ', registrada');
        }else{
            return redirect()->route('documents.driving')->with('SecondaryDrivings', 'Ya existe la licencia de conducción ' . $validate->driCategory);
        }   
    }

    function updateDrivings(Request $request){
        // dd($request->all());
        $validateOther = Settingdriving::where('driCategory',mb_strtoupper(trim($request->driCategory_Edit),'UTF-8'))
                                        ->where('driClassvehicle',ucfirst(mb_strtolower(trim($request->driClassvehicle_Edit),'UTF-8')))
                                        ->where('driTypeservice',ucfirst(mb_strtolower(trim($request->driTypeservice_Edit),'UTF-8')))
                                        ->where('driId','!=',trim($request->driId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingdriving::find(trim($request->driId_Edit));
            if($validate != null){
                $nameOld = $validate->driCategory;
                $validate->driCategory = mb_strtoupper(trim($request->driCategory_Edit),'UTF-8');
                $validate->driClassvehicle = ucfirst(mb_strtolower(trim($request->driClassvehicle_Edit),'UTF-8'));
                $validate->driTypeservice = ucfirst(mb_strtolower(trim($request->driTypeservice_Edit),'UTF-8'));
                $validate->save();
                return redirect()->route('documents.driving')->with('PrimaryDrivings', 'Licencia de conducción ' . mb_strtoupper(trim($request->driCategory_Edit),'UTF-8') . ', actualizada');
            }else{
                return redirect()->route('documents.driving')->with('SecondaryDrivings', 'No se encuentra la licencia de conducción, consulte al administrador');
            }
        }else{
            return redirect()->route('documents.driving')->with('SecondaryDrivings', 'Ya existe la licencia de conducción ' . $validateOther->driCategory . ', consulte al administrador');
        }
    }

    function deleteDrivings(Request $request){
        // dd($request->all());
        $validate = Settingdriving::find(trim($request->driId_Delete));
        if($validate != null){
            $name = $validate->driCategory;
            $validate->delete();
            return redirect()->route('documents.driving')->with('WarningDrivings', 'Licencia de conducción ' . $name . ', eliminada');
        }else{
            return redirect()->route('documents.driving')->with('SecondaryDrivings', 'No se encuentra la licencia de conducción, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE CURSOS CERTIFICADOS (courses)
    =============================================================================================== */

    function coursesTo(){
        $courses = Settingcourse::all();
        return view('modules.documents.courses.index',compact('courses'));
    }

    function saveCourses(Request $request){
        // dd($request->all());
        $validate = Settingcourse::where('couName',$this->fu($request->couName))
                                    ->where('couDescription',$this->fu($request->couDescription))
                                    ->first();
        if($validate == null){
            Settingcourse::create([
                'couName' => $this->fu($request->couName),
                'couIntensity' => $this->fu($request->couIntensity),
                'couDescription' => $this->fu($request->couDescription)
            ]);
            return redirect()->route('documents.courses')->with('SuccessCourses', 'Curso certificado ' . $this->fu($request->couName) . ', registrado');
        }else{
            return redirect()->route('documents.courses')->with('SecondaryCourses', 'Ya existe el curso ' . $validate->couName);
        }   
    }

    function updateCourses(Request $request){
        // dd($request->all());
        $validateOther = Settingcourse::where('couName',$this->fu($request->couName_Edit))
                                        ->where('couIntensity',$this->fu($request->couIntensity_Edit))
                                        ->where('couDescription',$this->fu($request->couDescription_Edit))
                                        ->where('couId','!=',trim($request->couId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingcourse::find(trim($request->couId_Edit));
            if($validate != null){
                $nameOld = $validate->couName;
                $validate->couName = $this->fu($request->couName_Edit);
                $validate->couIntensity = $this->fu($request->couIntensity_Edit);
                $validate->couDescription = $this->fu($request->couDescription_Edit);
                $validate->save();
                return redirect()->route('documents.courses')->with('PrimaryCourses', 'Curso certificado ' . $this->fu($request->couName_Edit) . ', actualizado');
            }else{
                return redirect()->route('documents.courses')->with('SecondaryCourses', 'No se encuentra el curso certificado, consulte al administrador');
            }
        }else{
            return redirect()->route('documents.courses')->with('SecondaryCourses', 'Ya existe el curso certificado ' . $validateOther->couName . ', consulte al administrador');
        }
    }

    function deleteCourses(Request $request){
        // dd($request->all());
        $validate = Settingcourse::find(trim($request->couId_Delete));
        if($validate != null){
            $name = $validate->couName;
            $validate->delete();
            return redirect()->route('documents.courses')->with('WarningCourses', 'Curso certificado ' . $name . ', eliminado');
        }else{
            return redirect()->route('documents.courses')->with('SecondaryCourses', 'No se encuentra el curso certificado, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE POLIZAS Y SEGUROS (insurances)
    =============================================================================================== */

    function insurancesTo(){
        $insurances = Settinginsurance::all();
        return view('modules.documents.insurances.index',compact('insurances'));
    }

    function saveInsurances(Request $request){
        // dd($request->all());
        $validate = Settinginsurance::where('insName',$this->fu($request->insName))->first();
        if($validate == null){
            Settinginsurance::create([
                'insName' => $this->fu($request->insName),
                'insDescription' => $this->fu($request->insDescription)
            ]);
            return redirect()->route('documents.insurances')->with('SuccessInsurances', 'Póliza/Seguro ' . $this->fu($request->insName) . ', registrado');
        }else{
            return redirect()->route('documents.insurances')->with('SecondaryInsurances', 'Ya existe la póliza/seguro ' . $validate->insName);
        }   
    }

    function updateInsurances(Request $request){
        // dd($request->all());
        $validateOther = Settinginsurance::where('insName',$this->fu($request->insName_Edit))
                                        ->where('insId','!=',trim($request->insId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settinginsurance::find(trim($request->insId_Edit));
            if($validate != null){
                $nameOld = $validate->insName;
                $validate->insName = $this->fu($request->insName_Edit);
                $validate->insDescription = $this->fu($request->insDescription_Edit);
                $validate->save();
                return redirect()->route('documents.insurances')->with('PrimaryInsurances', 'Póliza/Seguro ' . $this->fu($request->insName_Edit) . ', actualizado');
            }else{
                return redirect()->route('documents.insurances')->with('SecondaryInsurances', 'No se encuentra la póliza/seguro, consulte al administrador');
            }
        }else{
            return redirect()->route('documents.insurances')->with('SecondaryInsurances', 'Ya existe la póliza/seguro ' . $validateOther->insName . ', consulte al administrador');
        }
    }

    function deleteInsurances(Request $request){
        // dd($request->all());
        $validate = Settinginsurance::find(trim($request->insId_Delete));
        if($validate != null){
            $name = $validate->insName;
            $validate->delete();
            return redirect()->route('documents.insurances')->with('WarningInsurances', 'Póliza/Seguro ' . $name . ', eliminado');
        }else{
            return redirect()->route('documents.insurances')->with('SecondaryInsurances', 'No se encuentra la póliza/seguro, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE LEGALIZACIONES DE VEHICULOS (legalization)
    =============================================================================================== */

    function legalizationTo(){
        $legalizations = Settinglegalization::all();
        return view('modules.documents.legalizations.index',compact('legalizations'));
    }

    function saveLegalizations(Request $request){
        // dd($request->all());
        $validate = Settinglegalization::where('legDocument',$this->fu($request->legDocument))->first();
        if($validate == null){
            Settinglegalization::create([
                'legDocument' => $this->fu($request->legDocument),
                'legDescription' => $this->fu($request->legDescription)
            ]);
            return redirect()->route('documents.legalization')->with('SuccessLegalizations', 'Legalización ' . $this->fu($request->legDocument) . ', registrada');
        }else{
            return redirect()->route('documents.legalization')->with('SecondaryLegalizations', 'Ya existe la legalización ' . $validate->legDocument);
        }   
    }

    function updateLegalizations(Request $request){
        // dd($request->all());
        $validateOther = Settinglegalization::where('legDocument',$this->fu($request->legDocument_Edit))
                                        ->where('legId','!=',trim($request->legId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settinglegalization::find(trim($request->legId_Edit));
            if($validate != null){
                $nameOld = $validate->legDocument;
                $validate->legDocument = $this->fu($request->legDocument_Edit);
                $validate->legDescription = $this->fu($request->legDescription_Edit);
                $validate->save();
                return redirect()->route('documents.legalization')->with('PrimaryLegalizations', 'Legalización ' . $this->fu($request->legDocument_Edit) . ', actualizada');
            }else{
                return redirect()->route('documents.legalization')->with('SecondaryLegalizations', 'No se encuentra la legalización, consulte al administrador');
            }
        }else{
            return redirect()->route('documents.legalization')->with('SecondaryLegalizations', 'Ya existe la legalización ' . $validateOther->legDocument . ', consulte al administrador');
        }
    }

    function deleteLegalizations(Request $request){
        // dd($request->all());
        $validate = Settinglegalization::find(trim($request->legId_Delete));
        if($validate != null){
            $name = $validate->legDocument;
            $validate->delete();
            return redirect()->route('documents.legalization')->with('WarningLegalizations', 'Legalización ' . $name . ', eliminada');
        }else{
            return redirect()->route('documents.legalization')->with('SecondaryLegalizations', 'No se encuentra la legalización, Consulte con el administrador');
        }
    }

    /* ===========================================================================================================
            FUNCIONES PARA CONVERTIR CADENAS DE TEXTO (Mayusculas/Minusculas/Solo primera en Mayuscula)
    =========================================================================================================== */

    function upper($string){
        return mb_strtoupper(trim($string),'UTF-8');
    }

    function lower($string){
        return mb_strtolower(trim($string),'UTF-8');
    }

    function fu($string){
        return ucfirst(mb_strtolower(trim($string),'UTF-8'));
    }
}

