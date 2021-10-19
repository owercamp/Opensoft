<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Settingmotorcycle;
use App\Models\Settingheavy;
use App\Models\Settingespecial;

class VehiclesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MOTOCICLETAS (motorcycles)
    =============================================================================================== */
    
    function motorcyclesTo(){
        $motorcycles = Settingmotorcycle::all();
        return view('modules.vehicles.motorcycles.index',compact('motorcycles'));
    }

    function saveMotorcycles(Request $request){
        // dd($request->all());
        $validate = Settingmotorcycle::where('motTypology',$this->fu($request->motTypology))
                                        ->where('motDisplacement',trim($request->motDisplacement))
                                        ->where('motTimes',trim($request->motTimes))
                                        ->first();
        if($validate == null){
            Settingmotorcycle::create([
                'motTypology' => $this->fu($request->motTypology),
                'motDisplacement' => trim($request->motDisplacement),
                'motTimes' => trim($request->motTimes),
                'motDescription' => $this->fu($request->motDescription),
            ]);
            return redirect()->route('vehicle.motorcycles')->with('SuccessMotorcycles', 'Motocicleta ' . $this->fu($request->motTypology) . ', registrada');
        }else{
            return redirect()->route('vehicle.motorcycles')->with('SecondaryMotorcycles', 'Ya existe la motocicleta ' . $validate->motTypology);
        }   
    }

    function updateMotorcycles(Request $request){
        // dd($request->all());
        $validateOther = Settingmotorcycle::where('motTypology',$this->fu($request->motTypology_Edit))
                                        ->where('motDisplacement',trim($request->motDisplacement_Edit))
                                        ->where('motTimes',trim($request->motTimes_Edit))
                                        ->where('motId','!=',trim($request->motId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingmotorcycle::find(trim($request->motId_Edit));
            if($validate != null){
                $nameOld = $validate->motTypology;
                $validate->motTypology = $this->fu($request->motTypology_Edit);
                $validate->motDisplacement = trim($request->motDisplacement_Edit);
                $validate->motTimes = trim($request->motTimes_Edit);
                $validate->motDescription = trim($request->motDescription_Edit);
                $validate->save();
                return redirect()->route('vehicle.motorcycles')->with('PrimaryMotorcycles', 'Motocicleta ' . $nameOld . ', actualizada');
            }else{
                return redirect()->route('vehicle.motorcycles')->with('SecondaryMotorcycles', 'No se encuentra motocicleta, consulte al administrador');
            }
        }else{
            return redirect()->route('vehicle.motorcycles')->with('SecondaryMotorcycles', 'Ya existe la motocicleta ' . $validateOther->motTypology);
        }
    }

    function deleteMotorcycles(Request $request){
        // dd($request->all());
        $validate = Settingmotorcycle::find(trim($request->motId_Delete));
        if($validate != null){
            $name = $validate->motTypology;
            $validate->delete();
            return redirect()->route('vehicle.motorcycles')->with('WarningMotorcycles', 'Motocicleta ' . $name . ', eliminada');
        }else{
            return redirect()->route('vehicle.motorcycles')->with('SecondaryMotorcycles', 'No se encuentra la motocicleta, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE VEHICULOS DE CARGA (heavy)
    =============================================================================================== */

    function heavyTo(){
        $heavys = Settingheavy::all();
        return view('modules.vehicles.heavy.index',compact('heavys'));
    }

    function saveHeavys(Request $request){
        // dd($request->all());
        $validate = Settingheavy::where('heaTypology',$this->fu($request->heaTypology))
                                        ->where('heaDisplacement',trim($request->heaDisplacement))
                                        ->where('heaCapacity',$this->fu($request->heaCapacity))
                                        ->first();
        if($validate == null){
            Settingheavy::create([
                'heaTypology' => $this->fu($request->heaTypology),
                'heaDisplacement' => trim($request->heaDisplacement),
                'heaCapacity' => $this->fu($request->heaCapacity),
                'heaDescription' => $this->fu($request->heaDescription),
            ]);
            return redirect()->route('vehicle.heavy')->with('SuccessHeavys', 'Carga ' . $this->fu($request->heaTypology) . ', registrada');
        }else{
            return redirect()->route('vehicle.heavy')->with('SecondaryHeavys', 'Ya existe la carga ' . $validate->heaTypology);
        }   
    }

    function updateHeavys(Request $request){
        // dd($request->all());
        $validateOther = Settingheavy::where('heaTypology',$this->fu($request->heaTypology_Edit))
                                        ->where('heaDisplacement',trim($request->heaDisplacement_Edit))
                                        ->where('heaCapacity',$this->fu($request->heaCapacity_Edit))
                                        ->where('heaId','!=',trim($request->heaId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingheavy::find(trim($request->heaId_Edit));
            if($validate != null){
                $name = $validate->heaTypology;
                $validate->heaTypology = $this->fu($request->heaTypology_Edit);
                $validate->heaDisplacement = trim($request->heaDisplacement_Edit);
                $validate->heaCapacity = $this->fu($request->heaCapacity_Edit);
                $validate->heaDescription = trim($request->heaDescription_Edit);
                $validate->save();
                return redirect()->route('vehicle.heavy')->with('PrimaryHeavys', 'Carga ' . $name . ', actualizada');
            }else{
                return redirect()->route('vehicle.heavy')->with('SecondaryHeavys', 'No se encuentra carga, consulte al administrador');
            }
        }else{
            return redirect()->route('vehicle.heavy')->with('SecondaryHeavys', 'Ya existe la carga ' . $validateOther->heaTypology);
        }
    }

    function deleteHeavys(Request $request){
        // dd($request->all());
        $validate = Settingheavy::find(trim($request->heaId_Delete));
        if($validate != null){
            $name = $validate->heaTypology;
            $validate->delete();
            return redirect()->route('vehicle.heavy')->with('WarningHeavys', 'Carga ' . $name . ', eliminada');
        }else{
            return redirect()->route('vehicle.heavy')->with('SecondaryHeavys', 'No se encuentra la carga, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE VEHICULOS ESPECIALES (especial)
    =============================================================================================== */

    function especialTo(){
        $especials = Settingespecial::all();
        return view('modules.vehicles.especial.index',compact('especials'));
    }

    function saveEspecials(Request $request){
        // dd($request->all());
        $validate = Settingespecial::where('espTypology',$this->fu($request->espTypology))
                                        ->where('espPassengers',trim($request->espPassengers))
                                        ->where('espDisplacement',trim($request->espDisplacement))
                                        ->where('espTransmission',$this->upper($request->espTransmission))
                                        ->first();
        if($validate == null){
            Settingespecial::create([
                'espTypology' => $this->fu($request->espTypology),
                'espPassengers' => trim($request->espPassengers),
                'espDisplacement' => trim($request->espDisplacement),
                'espTransmission' => $this->upper($request->espTransmission),
                'espDescription' => $this->fu($request->espDescription),
            ]);
            return redirect()->route('vehicle.especial')->with('SuccessEspecials', 'Vehículo especial ' . $this->fu($request->espTypology) . ', registrado');
        }else{
            return redirect()->route('vehicle.especial')->with('SecondaryEspecials', 'Ya existe el vehículo especial ' . $validate->espTypology);
        }   
    }

    function updateEspecials(Request $request){
        // dd($request->all());
        $validateOther = Settingespecial::where('espTypology',$this->fu($request->espTypology_Edit))
                                        ->where('espPassengers',trim($request->espPassengers_Edit))
                                        ->where('espDisplacement',trim($request->espDisplacement_Edit))
                                        ->where('espTransmission',$this->upper($request->espTransmission_Edit))
                                        ->where('espId','!=',trim($request->espId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingespecial::find(trim($request->espId_Edit));
            if($validate != null){
                $name = $validate->espTypology;
                $validate->espTypology = $this->fu($request->espTypology_Edit);
                $validate->espPassengers = trim($request->espPassengers_Edit);
                $validate->espDisplacement = trim($request->espDisplacement_Edit);
                $validate->espTransmission = $this->upper($request->espTransmission_Edit);
                $validate->espDescription = trim($request->espDescription_Edit);
                $validate->save();
                return redirect()->route('vehicle.especial')->with('PrimaryEspecials', 'Vehículo especial ' . $name . ', actualizado');
            }else{
                return redirect()->route('vehicle.especial')->with('SecondaryEspecials', 'No se encuentra el vehículo especial, consulte al administrador');
            }
        }else{
            return redirect()->route('vehicle.especial')->with('SecondaryEspecials', 'Ya existe el vehículo especial ' . $validateOther->heaTypology);
        }
    }

    function deleteEspecials(Request $request){
        // dd($request->all());
        $validate = Settingespecial::find(trim($request->espId_Delete));
        if($validate != null){
            $name = $validate->espTypology;
            $validate->delete();
            return redirect()->route('vehicle.especial')->with('WarningEspecials', 'Vehículo especial ' . $name . ', eliminado');
        }else{
            return redirect()->route('vehicle.especial')->with('SecondaryEspecials', 'No se encuentra el vehículo especial, Consulte con el administrador');
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

