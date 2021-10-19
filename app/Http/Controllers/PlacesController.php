<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Settingdepartment;
use App\Models\Settingmunicipality;
use App\Models\Settingzoning;
use App\Models\Settingneighborhood;

class PlacesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE DEPARTAMENTOS (departments)
    =============================================================================================== */
    
    function departmentsTo(){
        $departments = Settingdepartment::all();
        return view('modules.places.departments.index',compact('departments'));
    }

    function saveDepartments(Request $request){
        // dd($request->all());
        $validate = Settingdepartment::where('depName',ucfirst(mb_strtolower(trim($request->depName),'UTF-8')))->first();
        if($validate == null){
            Settingdepartment::create([
                'depName' => ucfirst(mb_strtolower(trim($request->depName)))
            ]);
            return redirect()->route('places.departments')->with('SuccessDepartments', 'Departamento ' . ucfirst(mb_strtolower(trim($request->depName),'UTF-8')) . ', registrado');
        }else{
            return redirect()->route('places.departments')->with('SecondaryDepartments', 'Ya existe el departamento ' . $validate->depName);
        }   
    }

    function updateDepartments(Request $request){
        // dd($request->all());
        $validateOther = Settingdepartment::where('depName',ucfirst(mb_strtolower(trim($request->depName_Edit),'UTF-8')))
                                        ->where('depId','!=',trim($request->depId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingdepartment::find(trim($request->depId_Edit));
            if($validate != null){
                $nameOld = $validate->depName;
                $validate->depName = ucfirst(mb_strtolower(trim($request->depName_Edit),'UTF-8'));
                $validate->save();
                return redirect()->route('places.departments')->with('PrimaryDepartments', 'Departamento ' . $nameOld . ' a ' . ucfirst(mb_strtolower(trim($request->depName_Edit),'UTF-8')) . ', actualizado');
            }else{
                return redirect()->route('places.departments')->with('SecondaryDepartments', 'No se encuentra departamento, consulte al administrador');
            }
        }else{
            return redirect()->route('places.departments')->with('SecondaryDepartments', 'Ya existe el departamento ' . $validateOther->depName . ', consulte al administrador');
        }
    }

    function deleteDepartments(Request $request){
        // dd($request->all());
        $validateMunicipality = Settingmunicipality::where('munDepartment_id',trim($request->depId_Delete))->get()->count();
        if($validateMunicipality <= 0){
            $validate = Settingdepartment::find(trim($request->depId_Delete));
            if($validate != null){
                $name = $validate->depName;
                $validate->delete();
                return redirect()->route('places.departments')->with('WarningDepartments', 'Departamento ' . $name . ', eliminado');
            }else{
                return redirect()->route('places.departments')->with('SecondaryDepartments', 'No se encuentra el departamento, Consulte con el administrador');
            }
        }else{
            return redirect()->route('places.departments')->with('SecondaryDepartments', 'No es posible eliminar un departamento con municipios relacionados');
        }
    }

    /* ===============================================================================================
			MODULO DE MUNICIPIOS (municipalities)
    =============================================================================================== */

    function municipalitiesTo(){
        $departments = Settingdepartment::all();
        $municipalities = Settingmunicipality::select('settingmunicipalities.*','settingdepartments.*')
                                            ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                                            ->get();
        return view('modules.places.municipalities.index',compact('departments','municipalities'));
    }

    function saveMunicipalities(Request $request){
        // dd($request->all());
        $validate = Settingmunicipality::where('munName',ucfirst(mb_strtolower(trim($request->munName),'UTF-8')))
                                        ->where('munDepartment_id',trim($request->munDepartment_id))
                                        ->first();
        if($validate == null){
            Settingmunicipality::create([
                'munName' => ucfirst(mb_strtolower(trim($request->munName),'UTF-8')),
                'munDepartment_id' => trim($request->munDepartment_id)
            ]);
            return redirect()->route('places.municipalities')->with('SuccessMunicipalities', 'Municipio ' . ucfirst(mb_strtolower(trim($request->munName),'UTF-8')) . ', registrado');
        }else{
            $department = Settingdepartment::find($validate->munDepartment_id);
            return redirect()->route('places.municipalities')->with('SecondaryMunicipalities', 'Ya existe el municipio ' . $validate->munName . ' en el departamento ' . $department->depName);
        }   
    }

    function updateMunicipalities(Request $request){
        // dd($request->all());
        $validateOther = Settingmunicipality::where('munName',ucfirst(mb_strtolower(trim($request->munName_Edit),'UTF-8')))
                                        ->where('munDepartment_id',trim($request->munDepartment_id_Edit))
                                        ->where('munId','!=',trim($request->munId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingmunicipality::find(trim($request->munId_Edit));
            if($validate != null){
                $validate->munName = ucfirst(mb_strtolower(trim($request->munName_Edit),'UTF-8'));
                $validate->munDepartment_id = trim($request->munDepartment_id_Edit);
                $validate->save();
                return redirect()->route('places.municipalities')->with('PrimaryMunicipalities', 'Municipio ' . ucfirst(mb_strtolower(trim($request->munName_Edit),'UTF-8')) . ', actualizado');
            }else{
                return redirect()->route('places.municipalities')->with('SecondaryMunicipalities', 'No se encuentra el municipio, consulte al administrador');
            }
               
        }else{
            return redirect()->route('places.municipalities')->with('SecondaryMunicipalities', 'Ya existe un municipio con el nombre y departamento, consulte la tabla');
        }
    }

    function deleteMunicipalities(Request $request){
        // dd($request->all());
        $zoningCount = Settingzoning::where('zonMunicipality_id',trim($request->munId_Delete))->get()->count();
        if($zoningCount <= 0){
            $validate = Settingmunicipality::find(trim($request->munId_Delete));
            if($validate != null){
                $name = $validate->munName;
                $validate->delete();
                return redirect()->route('places.municipalities')->with('WarningMunicipalities', 'Municipio ' . $name . ', eliminado');
            }else{
                return redirect()->route('places.municipalities')->with('SecondaryMunicipalities', 'No se encuentra el municipio, Consulte con el administrador');
            }
        }else{
            return redirect()->route('places.municipalities')->with('SecondaryMunicipalities', 'No es posible eliminar un municipio con zonas registradas');
        }
    }

    /* ===============================================================================================
			MODULO DE ZONIFICACION (zoning)
    =============================================================================================== */

    function zoningTo(){
        $departments = Settingdepartment::all();
        $zonings = Settingzoning::select('settingzonings.*','settingmunicipalities.*','settingdepartments.*')
                                    ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                                    ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                                    ->get();
        return view('modules.places.zoning.index',compact('departments','zonings'));
    }

    function saveZonings(Request $request){
        // dd($request->all());
        $validate = Settingzoning::where('zonName',ucfirst(mb_strtolower(trim($request->zonName),'UTF-8')))
                                        ->where('zonMunicipality_id',trim($request->zonMunicipality_id))
                                        ->first();
        if($validate == null){
            Settingzoning::create([
                'zonName' => ucfirst(mb_strtolower(trim($request->zonName),'UTF-8')),
                'zonMunicipality_id' => trim($request->zonMunicipality_id)
            ]);
            return redirect()->route('places.zoning')->with('SuccessZonings', 'Zona ' . ucfirst(mb_strtolower(trim($request->zonName),'UTF-8')) . ', registrada');
        }else{
            $municipality = Settingmunicipality::select('settingmunicipalities.munName','settingdepartments.depName')
                            ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                            ->where('munId',$validate->zonMunicipality_id)->first();
            return redirect()->route('places.zoning')->with('SecondaryZonings', 'Ya existe la zona ' . $validate->zonName . ' perteneciente a municipio/departamento ' . $municipality->munName . ', ' . $municipality->depName);
        }   
    }

    function updateZonings(Request $request){
        // dd($request->all());
        $validateOther = Settingzoning::where('zonName',ucfirst(mb_strtolower(trim($request->zonName_Edit),'UTF-8')))
                                        ->where('zonMunicipality_id',trim($request->zonMunicipality_id_Edit))
                                        ->where('zonId','!=',trim($request->zonId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingzoning::find(trim($request->zonId_Edit));
            if($validate != null){
                $validate->zonName = ucfirst(mb_strtolower(trim($request->zonName_Edit),'UTF-8'));
                $validate->zonMunicipality_id = trim($request->zonMunicipality_id_Edit);
                $validate->save();
                return redirect()->route('places.zoning')->with('PrimaryZonings', 'Zona ' . ucfirst(mb_strtolower(trim($request->zonName_Edit),'UTF-8')) . ', actualizada');
            }else{
                return redirect()->route('places.zoning')->with('SecondaryZonings', 'No se encuentra la zona, consulte al administrador');
            }
               
        }else{
            return redirect()->route('places.zoning')->with('SecondaryZonings', 'Ya existe una zona con el nombre, municipio y departamento, consulte la tabla');
        }
    }

    function deleteZonings(Request $request){
        // dd($request->all());
        $neighborhoodCount = Settingneighborhood::where('neZoning_id',trim($request->zonId_Delete))->get()->count();
        if($neighborhoodCount <= 0){
            $validate = Settingzoning::find(trim($request->zonId_Delete));
            if($validate != null){
                $name = $validate->zonName;
                $validate->delete();
                return redirect()->route('places.zoning')->with('WarningZonings', 'Zona ' . $name . ', eliminada');
            }else{
                return redirect()->route('places.zoning')->with('SecondaryZonings', 'No se encuentra la zona, Consulte con el administrador');
            }
        }else{
            return redirect()->route('places.zoning')->with('SecondaryZonings', 'No es posible aliminar zonas con barrios relacionados');
        }
    }

    /* ===============================================================================================
			MODULO DE BARRIOS (neighborhoods)
    =============================================================================================== */

    function neighborhoodsTo(){
        $departments = Settingdepartment::all();
        $neighborhoods = Settingneighborhood::select('settingneighborhoods.*','settingzonings.*','settingmunicipalities.*','settingdepartments.*')
                                    ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                                    ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                                    ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                                    ->get();
        return view('modules.places.neighborhoods.index',compact('departments','neighborhoods'));
    }

    function saveNeighborhoods(Request $request){
        // dd($request->all());
        $validate = Settingneighborhood::where('neName',ucfirst(mb_strtolower(trim($request->neName),'UTF-8')))
                                        ->where('neZoning_id',trim($request->neZoning_id))
                                        ->first();
        if($validate == null){
            Settingneighborhood::create([
                'neName' => ucfirst(mb_strtolower(trim($request->neName),'UTF-8')),
                'neCode' => trim($request->neCode),
                'neZoning_id' => trim($request->neZoning_id)
            ]);
            return redirect()->route('places.neighborhoods')->with('SuccessNeighborhood', 'Barrio ' . ucfirst(mb_strtolower(trim($request->neName),'UTF-8')) . ', registrado');
        }else{
            $zoning = Settingzoning::select('settingzonings.*','settingmunicipalities.munName','settingdepartments.depName')
                            ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                            ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                            ->where('neId',$validate->neZoning_id)->first();
            return redirect()->route('places.neighborhoods')->with('SecondaryNeighborhood', 'Ya existe el barrio ' . $validate->neName . ' perteneciente a zona/municipio/departamento ' . $zoning->zonName . ', ' . $zoning->munName . ', ' . $zoning->depName);
        }   
    }

    function updateNeighborhoods(Request $request){
        // dd($request->all());
        $validateOther = Settingneighborhood::where('neName',ucfirst(mb_strtolower(trim($request->neName_Edit),'UTF-8')))
                                        ->where('neZoning_id',trim($request->neZoning_id_Edit))
                                        ->where('neId','!=',trim($request->neId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingneighborhood::find(trim($request->neId_Edit));
            if($validate != null){
                $validate->neName = ucfirst(mb_strtolower(trim($request->neName_Edit),'UTF-8'));
                $validate->neCode = trim($request->neCode_Edit);
                $validate->neZoning_id = trim($request->neZoning_id_Edit);
                $validate->save();
                return redirect()->route('places.neighborhoods')->with('PrimaryNeighborhood', 'Barrio ' . ucfirst(mb_strtolower(trim($request->neName_Edit),'UTF-8')) . ', actualizado');
            }else{
                return redirect()->route('places.neighborhoods')->with('SecondaryNeighborhood', 'No se encuentra el barrio, consulte al administrador');
            }
        }else{
            return redirect()->route('places.neighborhoods')->with('SecondaryNeighborhood', 'Ya existe un barrio con el nombre y zona seleccionada, consulte la tabla');
        }
    }

    function deleteNeighborhoods(Request $request){
        // dd($request->all());
        $validate = Settingneighborhood::find(trim($request->neId_Delete));
        if($validate != null){
            $name = $validate->neName;
            $validate->delete();
            return redirect()->route('places.neighborhoods')->with('WarningNeighborhood', 'Barrio ' . $name . ', eliminado');
        }else{
            return redirect()->route('places.neighborhoods')->with('SecondaryNeighborhood', 'No se encuentra el barrio, Consulte con el administrador');
        }
    }
}

