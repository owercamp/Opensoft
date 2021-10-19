<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Settinghealth;
use App\Models\Settingpension;
use App\Models\Settinglayoff;
use App\Models\Settingrisk;
use App\Models\Settingcompensation;

class SecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE ENTIDADES PROMOTORAS DE SALUD (health)
    =============================================================================================== */
    
    function healthTo(){
        $healths = Settinghealth::all();
        return view('modules.security.health.index',compact('healths'));
    }

    function saveHealths(Request $request){
        // dd($request->all());
        $validate = Settinghealth::where('heaName',ucfirst(mb_strtolower(trim($request->heaName),'UTF-8')))->first();
        if($validate == null){
            Settinghealth::create([
                'heaName' => ucfirst(mb_strtolower(trim($request->heaName),'UTF-8'))
            ]);
            return redirect()->route('security.health')->with('SuccessHealths', 'Entidad ' . ucfirst(mb_strtolower(trim($request->heaName),'UTF-8')) . ', registrada');
        }else{
            return redirect()->route('security.health')->with('SecondaryHealths', 'Ya existe la entidad ' . $validate->heaName);
        }   
    }

    function updateHealths(Request $request){
        // dd($request->all());
        $validateOther = Settinghealth::where('heaName',ucfirst(mb_strtolower(trim($request->heaName_Edit),'UTF-8')))
                                        ->where('heaId','!=',trim($request->heaId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settinghealth::find(trim($request->heaId_Edit));
            if($validate != null){
                $name = $validate->heaName;
                $validate->heaName = ucfirst(mb_strtolower(trim($request->heaName_Edit),'UTF-8'));
                $validate->save();
                return redirect()->route('security.health')->with('PrimaryHealths', 'Entidad de salud ' . ucfirst(mb_strtolower(trim($request->heaName_Edit),'UTF-8')) . ', actualizada');
            }else{
                return redirect()->route('security.health')->with('SecondaryHealths', 'No se encuentra la entidad de salud, consulte al administrador');
            }
        }else{
            return redirect()->route('security.health')->with('SecondaryHealths', 'Ya existe la entidad de salud ' . $validateOther->heaName . ', consulte la tabla');
        } 
    }

    function deleteHealths(Request $request){
        // dd($request->all());
        $validate = Settinghealth::find(trim($request->heaId_Delete));
        if($validate != null){
            $name = $validate->heaName;
            $validate->delete();
            return redirect()->route('security.health')->with('WarningHealths', 'Entidad de salud ' . $name . ', eliminada');
        }else{
            return redirect()->route('security.health')->with('SecondaryHealths', 'No se encuentra la entidad, consulte al administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE FONDO DE PENSIONES (pensions)
    =============================================================================================== */

    function pensionsTo(){
        $pensions = Settingpension::all();
        return view('modules.security.pensions.index',compact('pensions'));
    }

    function savePensions(Request $request){
        // dd($request->all());
        $validate = Settingpension::where('penName',ucfirst(mb_strtolower(trim($request->penName),'UTF-8')))->first();
        if($validate == null){
            Settingpension::create([
                'penName' => ucfirst(mb_strtolower(trim($request->penName),'UTF-8'))
            ]);
            return redirect()->route('security.pensions')->with('SuccessPensions', 'Fondo de pension ' . ucfirst(mb_strtolower(trim($request->penName),'UTF-8')) . ', registrado');
        }else{
            return redirect()->route('security.pensions')->with('SecondaryPensions', 'Ya existe el fondo ' . $validate->penName);
        }   
    }

    function updatePensions(Request $request){
        // dd($request->all());
        $validateOther = Settingpension::where('penName',ucfirst(mb_strtolower(trim($request->penName_Edit),'UTF-8')))
                                        ->where('penId','!=',trim($request->penId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingpension::find(trim($request->penId_Edit));
            if($validate != null){
                $name = $validate->penName;
                $validate->penName = ucfirst(mb_strtolower(trim($request->penName_Edit),'UTF-8'));
                $validate->save();
                return redirect()->route('security.pensions')->with('PrimaryPensions', 'Fondo de pensión ' . ucfirst(mb_strtolower(trim($request->penName_Edit),'UTF-8')) . ', actualizado');
            }else{
                return redirect()->route('security.pensions')->with('SecondaryPensions', 'No se encuentra el fondo de pensión, consulte al administrador');
            }
        }else{
            return redirect()->route('security.pensions')->with('SecondaryPensions', 'Ya existe el fondo de pensión ' . $validateOther->penName . ', consulte la tabla');
        } 
    }

    function deletePensions(Request $request){
        // dd($request->all());
        $validate = Settingpension::find(trim($request->penId_Delete));
        if($validate != null){
            $name = $validate->penName;
            $validate->delete();
            return redirect()->route('security.pensions')->with('WarningPensions', 'Fondo de pensión ' . $name . ', eliminado');
        }else{
            return redirect()->route('security.pensions')->with('SecondaryPensions', 'No se encuentra el fondo de pensión, consulte al administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE FONDO DE CESANTIAS (layoffs)
    =============================================================================================== */

    function layoffsTo(){
        $layoffs = Settinglayoff::all();
        return view('modules.security.layoffs.index',compact('layoffs'));
    }

    function saveLayoffs(Request $request){
        // dd($request->all());
        $validate = Settinglayoff::where('layName',ucfirst(mb_strtolower(trim($request->layName),'UTF-8')))->first();
        if($validate == null){
            Settinglayoff::create([
                'layName' => ucfirst(mb_strtolower(trim($request->layName),'UTF-8'))
            ]);
            return redirect()->route('security.layoffs')->with('SuccessLayoffs', 'Fondo de cesantias ' . ucfirst(mb_strtolower(trim($request->layName),'UTF-8')) . ', registrado');
        }else{
            return redirect()->route('security.layoffs')->with('SecondaryLayoffs', 'Ya existe el fondo ' . $validate->layName);
        }   
    }

    function updateLayoffs(Request $request){
        // dd($request->all());
        $validateOther = Settinglayoff::where('layName',ucfirst(mb_strtolower(trim($request->layName_Edit),'UTF-8')))
                                        ->where('layId','!=',trim($request->layId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settinglayoff::find(trim($request->layId_Edit));
            if($validate != null){
                $name = $validate->layName;
                $validate->layName = ucfirst(mb_strtolower(trim($request->layName_Edit),'UTF-8'));
                $validate->save();
                return redirect()->route('security.layoffs')->with('PrimaryLayoffs', 'Fondo de cesantias ' . ucfirst(mb_strtolower(trim($request->layName_Edit),'UTF-8')) . ', actualizado');
            }else{
                return redirect()->route('security.layoffs')->with('SecondaryLayoffs', 'No se encuentra el fondo de cesantias, consulte al administrador');
            }
        }else{
            return redirect()->route('security.layoffs')->with('SecondaryLayoffs', 'Ya existe el fondo de cesantias ' . $validateOther->layName . ', consulte la tabla');
        } 
    }

    function deleteLayoffs(Request $request){
        // dd($request->all());
        $validate = Settinglayoff::find(trim($request->layId_Delete));
        if($validate != null){
            $name = $validate->layName;
            $validate->delete();
            return redirect()->route('security.layoffs')->with('WarningLayoffs', 'Fondo de cesantias ' . $name . ', eliminado');
        }else{
            return redirect()->route('security.layoffs')->with('SecondaryLayoffs', 'No se encuentra el fondo de cesantias, consulte al administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE RIESGOS LABORALES (risks)
    =============================================================================================== */

    function risksTo(){
        $risks = Settingrisk::all();
        return view('modules.security.risks.index',compact('risks'));
    }

    function saveRisks(Request $request){
        // dd($request->all());
        $validate = Settingrisk::where('risName',ucfirst(mb_strtolower(trim($request->risName),'UTF-8')))->first();
        if($validate == null){
            Settingrisk::create([
                'risName' => ucfirst(mb_strtolower(trim($request->risName),'UTF-8'))
            ]);
            return redirect()->route('security.risks')->with('SuccessRisks', 'Administradora de riesgos ' . ucfirst(mb_strtolower(trim($request->risName),'UTF-8')) . ', registrada');
        }else{
            return redirect()->route('security.risks')->with('SecondaryRisks', 'Ya existe la administradora de riesgos ' . $validate->risName . ', consulte la tabla');
        }   
    }

    function updateRisks(Request $request){
        // dd($request->all());
        $validateOther = Settingrisk::where('risName',ucfirst(mb_strtolower(trim($request->risName_Edit),'UTF-8')))
                                        ->where('risId','!=',trim($request->risId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingrisk::find(trim($request->risId_Edit));
            if($validate != null){
                $name = $validate->risName;
                $validate->risName = ucfirst(mb_strtolower(trim($request->risName_Edit),'UTF-8'));
                $validate->save();
                return redirect()->route('security.risks')->with('PrimaryRisks', 'Administradora de riesgos ' . ucfirst(mb_strtolower(trim($request->risName_Edit),'UTF-8')) . ', actualizada');
            }else{
                return redirect()->route('security.risks')->with('SecondaryRisks', 'No se encuentra la administradora de riesgos, consulte al administrador');
            }
        }else{
            return redirect()->route('security.risks')->with('SecondaryRisks', 'Ya existe la administradora de riesgos ' . $validateOther->risName . ', consulte la tabla');
        } 
    }

    function deleteRisks(Request $request){
        // dd($request->all());
        $validate = Settingrisk::find(trim($request->risId_Delete));
        if($validate != null){
            $name = $validate->risName;
            $validate->delete();
            return redirect()->route('security.risks')->with('WarningRisks', 'Administradora de riesgos ' . $name . ', eliminada');
        }else{
            return redirect()->route('security.risks')->with('SecondaryRisks', 'No se encuentra la dministradora de riesgos, consulte al administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE CAJA DE COPENSACION (compensations)
    =============================================================================================== */

    function compensationsTo(){
        $compensations = Settingcompensation::all();
        return view('modules.security.compensations.index',compact('compensations'));
    }

    function saveCompensations(Request $request){
        // dd($request->all());
        $validate = Settingcompensation::where('comName',ucfirst(mb_strtolower(trim($request->comName),'UTF-8')))->first();
        if($validate == null){
            Settingcompensation::create([
                'comName' => ucfirst(mb_strtolower(trim($request->comName),'UTF-8'))
            ]);
            return redirect()->route('security.compensations')->with('SuccessCompensations', 'Caja de compensación ' . ucfirst(mb_strtolower(trim($request->comName),'UTF-8')) . ', registrada');
        }else{
            return redirect()->route('security.compensations')->with('SecondaryCompensations', 'Ya existe la caja de compensación ' . $validate->comName . ', consulte la tabla');
        }   
    }

    function updateCompensations(Request $request){
        // dd($request->all());
        $validateOther = Settingcompensation::where('comName',ucfirst(mb_strtolower(trim($request->comName_Edit),'UTF-8')))
                                        ->where('comId','!=',trim($request->comId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingcompensation::find(trim($request->comId_Edit));
            if($validate != null){
                $name = $validate->comName;
                $validate->comName = ucfirst(mb_strtolower(trim($request->comName_Edit),'UTF-8'));
                $validate->save();
                return redirect()->route('security.compensations')->with('PrimaryCompensations', 'Caja de compensación ' . ucfirst(mb_strtolower(trim($request->comName_Edit),'UTF-8')) . ', actualizada');
            }else{
                return redirect()->route('security.compensations')->with('SecondaryCompensations', 'No se encuentra la caja de compensación, consulte al administrador');
            }
        }else{
            return redirect()->route('security.compensations')->with('SecondaryCompensations', 'Ya existe la caja de compensación ' . $validateOther->comName . ', consulte la tabla');
        } 
    }

    function deleteCompensations(Request $request){
        // dd($request->all());
        $validate = Settingcompensation::find(trim($request->comId_Delete));
        if($validate != null){
            $name = $validate->comName;
            $validate->delete();
            return redirect()->route('security.compensations')->with('WarningCompensations', 'Caja de compensación ' . $name . ', eliminada');
        }else{
            return redirect()->route('security.compensations')->with('SecondaryCompensations', 'No se encuentra la caja de compensación, consulte al administrador');
        }
    }
}

