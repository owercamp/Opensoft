<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Automotormessenger;
use App\Models\Automotorcharge;
use App\Models\Automotorespecial;
use App\Models\Settingmotorcycle;
use App\Models\Settingheavy;
use App\Models\Settingespecial;
use App\Models\Contractormessenger;
use App\Models\Contractorcharge;
use App\Models\Contractorespecial;
use App\Models\Alliesespecial;

class AutomotorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MENSAJERIA DE PARQUE AUTOMOTOR
    =============================================================================================== */
    
    function messengersTo(){
        $automotorsmessengers = Automotormessenger::select(
                    'automotorsmessenger.*',
                    'settingmotorcycles.*',
                    'contractorsmessenger.*'
                )
                ->join('settingmotorcycles','settingmotorcycles.motId','automotorsmessenger.aumMotorcycle_id')
                ->join('contractorsmessenger','contractorsmessenger.cmId','automotorsmessenger.aumContractormessenger_id')
                ->get();
        $motorcycles = Settingmotorcycle::all();
        $contractorsmessengers = Contractormessenger::all();
        return view('modules.automotors.messengers.index',compact('automotorsmessengers','motorcycles','contractorsmessengers'));
    }

    function saveMessenger(Request $request){
        // dd($request->all());
        /*
            $request->aumMotorcycle_id
            $request->aumPlate
            $request->aumBrand
            $request->aumModel
            $request->aumContractormessenger_id
            $request->aumPhone
            $request->aumContractormessengers_new
            $request->aumContractormessengers
        */
        $validate = Automotormessenger::where('aumPlate',$this->upper($request->aumPlate))
                                    ->first();
        if($validate == null){
            $drivers = substr(trim($request->aumContractormessengers),0,-1); // QUITAR LOS ULTIMOS 3 CARACTERES (,)
            $namefrontfinal = 'imgDefault.png';
            $namesidefinal = 'imgDefault.png';
            $namebackfinal = 'imgDefault.png';
            if($request->hasFile('aumPhotofront')){
                $front = $request->file('aumPhotofront');
                // $namefront = $front->getClientOriginalName();
                $extension = $front->extension();
                Storage::disk('opensoft')->putFileAs('automotorsMessenger/front/',$front,$this->upper($request->aumPlate) . '_front.' . $extension);
                $namefrontfinal = $this->upper($request->aumPlate) . '_front.' . $extension;
            }
            if($request->hasFile('aumPhotoside')){
                $side = $request->file('aumPhotoside');
                // $nameside = $side->getClientOriginalName();
                $extension = $side->extension();
                Storage::disk('opensoft')->putFileAs('automotorsMessenger/side/',$side,$this->upper($request->aumPlate) . '_side.' . $extension);
                $namesidefinal = $this->upper($request->aumPlate) . '_side.' . $extension;
            }
            if($request->hasFile('aumPhotoback')){
                $back = $request->file('aumPhotoback');
                // $nameback = $back->getClientOriginalName();
                $extension = $back->extension();
                Storage::disk('opensoft')->putFileAs('automotorsMessenger/back/',$back,$this->upper($request->aumPlate) . '_back.' . $extension);
                $namebackfinal = $this->upper($request->aumPlate) . '_back.' . $extension;
            }
            Automotormessenger::create([
                'aumPhone' => trim($request->aumPhone),
                'aumMotorcycle_id' => trim($request->aumMotorcycle_id),
                'aumPlate' => $this->upper($request->aumPlate),
                'aumBrand' => $this->upper($request->aumBrand),
                'aumModel' => $this->upper($request->aumModel),
                'aumContractormessenger_id' => trim($request->aumContractormessenger_id),
                'aumContractormessengers' => $drivers,
                'aumPhotofront' => $namefrontfinal,
                'aumPhotoside' => $namesidefinal,
                'aumPhotoback' => $namebackfinal
            ]);
            return redirect()->route('automotors.messengers')->with('SuccessMessengers', 'Automotor de mensajería ' . $this->upper($request->aumPlate) . ', registrado');
        }else{
            return redirect()->route('automotors.messengers')->with('SecondaryMessengers', 'Ya existe automotor de mensajería ' . $validate->aumPlate);
        }
    }

    function updateMessenger(Request $request){
        // dd($request->all());
        /*
            $request->aumMotorcycle_id_Edit
            $request->aumPlate_Edit
            $request->aumBrand_Edit
            $request->aumModel_Edit
            $request->aumContractormessenger_id_Edit
            $request->aumPhone_Edit
            $request->aumContractormessengers_Edit
            $request->aumPhotobacknot_Edit
            $request->aumPhotosidenot_Edit
            $request->aumPhotofrontnot_Edit
            $request->aumPhotoback_Edit
            $request->aumPhotoside_Edit
            $request->aumPhotofront_Edit
            $request->aumId_Edit
        */
        $validateOther = Automotormessenger::where('aumPlate',$this->fu($request->aumPlate_Edit))
                                        ->where('aumId','!=',trim($request->aumId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Automotormessenger::find(trim($request->aumId_Edit));
            if($validate != null){
                $drivers = substr(trim($request->aumContractormessengers_Edit),0,-1); // QUITAR LOS ULTIMOS 3 CARACTERES (,)
                // VALIDACION DE IMAGEN DE ATRAS
                if(!isset($request->aumPhotobacknot_Edit)){
                    if($request->hasFile('aumPhotoback_Edit')){
                        $back = $request->file('aumPhotoback_Edit');
                        // $nameback = $back->getClientOriginalName();
                        $extension = $back->extension();
                        if($validate->aumPhotoback != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsMessenger/back/'.$validate->aumPhotoback);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsMessenger/back/',$back,$this->upper($request->aumPlate_Edit) . '_back.' . $extension);
                        $namebackfinal = $this->upper($request->aumPlate_Edit) . '_back.' . $extension;
                    }else{
                        if($validate->aumPhotoback != 'imgDefault.png'){
                            // $find_ = strpos($validate->aumPhotoback,'_');
                            // if($find_ === false){
                            //     $namebackfinal = $this->upper($request->aumPlate_Edit) . '_' . $validate->aumPhotoback;
                            // }else{
                                $separatedName = explode('_', $validate->aumPhotoback);
                                $namebackfinal = $this->upper($request->aumPlate_Edit) . '_' . $separatedName[1];
                            // }
                            if($validate->aumPhotoback != $namebackfinal){
                                Storage::disk('opensoft')->move('automotorsMessenger/back/'.$validate->aumPhotoback,'automotorsMessenger/back/'.$namebackfinal);
                            }
                        }
                    }
                }else{
                    if($validate->aumPhotoback != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsMessenger/back/'.$validate->aumPhotoback);
                    }
                    $namebackfinal = 'imgDefault.png';
                }
                // VALIDACION DE IMAGEN DE LADO
                if(!isset($request->aumPhotosidenot_Edit)){
                    if($request->hasFile('aumPhotoside_Edit')){
                        $side = $request->file('aumPhotoside_Edit');
                        // $nameside = $side->getClientOriginalName();
                        $extension = $side->extension();
                        if($validate->aumPhotoside != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsMessenger/side/'.$validate->aumPhotoside);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsMessenger/side/',$side,$this->upper($request->aumPlate_Edit) . '_side.' . $extension);
                        $namesidefinal = $this->upper($request->aumPlate_Edit) . '_side.' . $extension;
                    }else{
                        if($validate->aumPhotoside != 'imgDefault.png'){
                            // $find_ = strpos($validate->aumPhotoside,'_');
                            // if($find_ === false){
                            //     $namesidefinal = $this->upper($request->aumPlate_Edit) . '_' . $validate->aumPhotoside;
                            // }else{
                                $separatedName = explode('_', $validate->aumPhotoside);
                                $namesidefinal = $this->upper($request->aumPlate_Edit) . '_' . $separatedName[1];
                            // }
                            if($validate->aumPhotoside != $namesidefinal){
                                Storage::disk('opensoft')->move('automotorsMessenger/side/'.$validate->aumPhotoside,'automotorsMessenger/side/'.$namesidefinal);
                            }
                        }
                    }
                }else{
                    if($validate->aumPhotoside != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsMessenger/side/'.$validate->aumPhotoside);
                    }
                    $namesidefinal = 'imgDefault.png';
                }
                // VALIDACION DE IMAGEN DE FRENTE
                if(!isset($request->aumPhotofrontnot_Edit)){
                    if($request->hasFile('aumPhotofront_Edit')){
                        $front = $request->file('aumPhotofront_Edit');
                        // $namefront = $front->getClientOriginalName();
                        $extension = $front->extension();
                        if($validate->aumPhotofront != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsMessenger/front/'.$validate->aumPhotofront);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsMessenger/front/',$front,$this->upper($request->aumPlate_Edit) . '_front.' . $extension);
                        $namefrontfinal = $this->upper($request->aumPlate_Edit) . '_front.' . $extension;
                    }else{
                        if($validate->aumPhotofront != 'imgDefault.png'){
                            // $find_ = strpos($validate->aumPhotofront,'_');
                            // if($find_ === false){
                            //     $namefrontfinal = $this->upper($request->aumPlate_Edit) . '_' . $validate->aumPhotofront;
                            // }else{
                                $separatedName = explode('_', $validate->aumPhotofront);
                                $namefrontfinal = $this->upper($request->aumPlate_Edit) . '_' . $separatedName[1];
                            // }
                            if($validate->aumPhotofront != $namefrontfinal){
                                Storage::disk('opensoft')->move('automotorsMessenger/front/'.$validate->aumPhotofront,'automotorsMessenger/front/'.$namefrontfinal);
                            }
                        }
                    }
                }else{
                    if($validate->aumPhotofront != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsMessenger/front/'.$validate->aumPhotofront);
                    }
                    $namefrontfinal = 'imgDefault.png';
                }
                $validate->aumPhone = trim($request->aumPhone_Edit);
                $validate->aumMotorcycle_id = trim($request->aumMotorcycle_id_Edit);
                $validate->aumPlate = $this->upper($request->aumPlate_Edit);
                $validate->aumBrand = $this->upper($request->aumBrand_Edit);
                $validate->aumModel = $this->upper($request->aumModel_Edit);
                $validate->aumContractormessenger_id = trim($request->aumContractormessenger_id_Edit);
                $validate->aumContractormessengers = $drivers;
                $validate->aumPhotofront = $namefrontfinal;
                $validate->aumPhotoside = $namesidefinal;
                $validate->aumPhotoback = $namebackfinal;
                $validate->save();
                return redirect()->route('automotors.messengers')->with('PrimaryMessengers', 'Automotor de mensajería ' . $this->upper($request->aumPlate_Edit) . ', actualizado');
            }else{
                return redirect()->route('automotors.messengers')->with('SecondaryMessengers', 'No se encuentra el automotor de mensajería, consulte al administrador');
            }
        }else{
            return redirect()->route('automotors.messengers')->with('SecondaryMessengers', 'Ya existe  automotor de mensajería ' . $validateOther->aumPlate);
        }
    }

    function deleteMessenger(Request $request){
        // dd($request->all());
        $validate = Automotormessenger::find(trim($request->aumId_Delete));
        if($validate != null){
            $name = $validate->aumPlate;
            if($validate->aumPhotoback != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsMessenger/back/'.$validate->aumPhotoback);
            }
            if($validate->aumPhotoside != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsMessenger/side/'.$validate->aumPhotoside);
            }
            if($validate->aumPhotofront != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsMessenger/front/'.$validate->aumPhotofront);
            }
            $validate->delete();
            return redirect()->route('automotors.messengers')->with('WarningMessengers', 'Automotor de mensajería ' . $name . ', eliminado');
        }else{
            return redirect()->route('automotors.messengers')->with('SecondaryMessengers', 'No se encuentra el automotor de mensajería');
        }
    }

    /* ===============================================================================================
			MODULO DE CARGA EXPRESS DE PARQUE AUTOMOTOR
    =============================================================================================== */

    function expressTo(){
        $automotorscharges = Automotorcharge::select(
                    'automotorscharge.*',
                    'settingheavys.*',
                    'contractorsmessenger.*'
                )
                ->join('settingheavys','settingheavys.heaId','automotorscharge.aucTypevehicle_id')
                ->join('contractorsmessenger','contractorsmessenger.cmId','automotorscharge.aucContractormessenger_id')
                ->get();
        $heavys = Settingheavy::all();
        $contractorsmessengers = Contractormessenger::all();
        return view('modules.automotors.express.index',compact('automotorscharges','heavys','contractorsmessengers'));
    }

    function saveExpress(Request $request){
        // dd($request->all());
        /*
            $request->aucTypevehicle_id
            $request->aucPlate
            $request->aucBrand
            $request->aucModel
            $request->aucContractormessenger_id
            $request->aucPhone
            $request->aucContractormessengers_new
            $request->aucContractormessengers
        */
        $validate = Automotorcharge::where('aucPlate',$this->upper($request->aucPlate))
                                    ->first();
        if($validate == null){
            $drivers = substr(trim($request->aucContractormessengers),0,-1); // QUITAR LOS ULTIMOS 3 CARACTERES (,)
            $namefrontfinal = 'imgDefault.png';
            $namesidefinal = 'imgDefault.png';
            $namebackfinal = 'imgDefault.png';
            if($request->hasFile('aucPhotofront')){
                $front = $request->file('aucPhotofront');
                // $namefront = $front->getClientOriginalName();
                $extension = $front->extension();
                Storage::disk('opensoft')->putFileAs('automotorsCharge/front/',$front,$this->upper($request->aucPlate) . '_front.' . $extension);
                $namefrontfinal = $this->upper($request->aucPlate) . '_front.' . $extension;
            }
            if($request->hasFile('aucPhotoside')){
                $side = $request->file('aucPhotoside');
                // $nameside = $side->getClientOriginalName();
                $extension = $side->extension();
                Storage::disk('opensoft')->putFileAs('automotorsCharge/side/',$side,$this->upper($request->aucPlate) . '_side.' . $extension);
                $namesidefinal = $this->upper($request->aucPlate) . '_side.' . $extension;
            }
            if($request->hasFile('aucPhotoback')){
                $back = $request->file('aucPhotoback');
                // $nameback = $back->getClientOriginalName();
                $extension = $back->extension();
                Storage::disk('opensoft')->putFileAs('automotorsCharge/back/',$back,$this->upper($request->aucPlate) . '_back.' . $extension);
                $namebackfinal = $this->upper($request->aucPlate) . '_back.' . $extension;
            }
            Automotorcharge::create([
                'aucPhone' => trim($request->aucPhone),
                'aucTypevehicle_id' => trim($request->aucTypevehicle_id),
                'aucPlate' => $this->upper($request->aucPlate),
                'aucBrand' => $this->upper($request->aucBrand),
                'aucModel' => $this->upper($request->aucModel),
                'aucContractormessenger_id' => trim($request->aucContractormessenger_id),
                'aucContractormessengers' => $drivers,
                'aucPhotofront' => $namefrontfinal,
                'aucPhotoside' => $namesidefinal,
                'aucPhotoback' => $namebackfinal
            ]);
            return redirect()->route('automotors.express')->with('SuccessCharges', 'Automotor de carga express ' . $this->upper($request->aucPlate) . ', registrado');
        }else{
            return redirect()->route('automotors.express')->with('SecondaryCharges', 'Ya existe automotor de carga express ' . $validate->aucPlate);
        }
    }

    function updateExpress(Request $request){
        // dd($request->all());
        /*
            $request->aucTypevehicle_id_Edit
            $request->aucPlate_Edit
            $request->aucBrand_Edit
            $request->aucModel_Edit
            $request->aucContractormessenger_id_Edit
            $request->aucPhone_Edit
            $request->aucContractormessengers_Edit
            $request->aucPhotobacknot_Edit
            $request->aucPhotosidenot_Edit
            $request->aucPhotofrontnot_Edit
            $request->aucPhotoback_Edit
            $request->aucPhotoside_Edit
            $request->aucPhotofront_Edit
            $request->aucId_Edit
        */
        $validateOther = Automotorcharge::where('aucPlate',$this->fu($request->aucPlate_Edit))
                                        ->where('aucId','!=',trim($request->aucId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Automotorcharge::find(trim($request->aucId_Edit));
            if($validate != null){
                $drivers = substr(trim($request->aucContractormessengers_Edit),0,-1); // QUITAR LOS ULTIMOS 3 CARACTERES (,)
                // VALIDACION DE IMAGEN DE ATRAS
                $namebackfinal = '';
                if(!isset($request->aucPhotobacknot_Edit)){
                    if($request->hasFile('aucPhotoback_Edit')){
                        $back = $request->file('aucPhotoback_Edit');
                        // $nameback = $back->getClientOriginalName();
                        $extension = $back->extension();
                        if($validate->aucPhotoback != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsCharge/back/'.$validate->aucPhotoback);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsCharge/back/',$back,$this->upper($request->aucPlate_Edit) . '_back.' . $extension);
                        $namebackfinal = $this->upper($request->aucPlate_Edit) . '_back.' . $extension;
                    }else{
                        if($validate->aucPhotoback != 'imgDefault.png'){
                            // $find_ = strpos($validate->aucPhotoback,'_');
                            // if($find_ === false){
                            //     $namebackfinal = $this->upper($request->aucPlate_Edit) . '_' . $validate->aucPhotoback;
                            // }else{
                                $separatedName = explode('_', $validate->aucPhotoback);
                                $namebackfinal = $this->upper($request->aucPlate_Edit) . '_' . $separatedName[1];
                            // }
                            if($validate->aucPhotoback != $namebackfinal){
                                Storage::disk('opensoft')->move('automotorsCharge/back/'.$validate->aucPhotoback,'automotorsCharge/back/'.$namebackfinal);
                            }
                        }
                    }
                }else{
                    if($validate->aucPhotoback != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsCharge/back/'.$validate->aucPhotoback);
                    }
                    $namebackfinal = 'imgDefault.png';
                }
                // VALIDACION DE IMAGEN DE LADO
                $namesidefinal = '';
                if(!isset($request->aucPhotosidenot_Edit)){
                    if($request->hasFile('aucPhotoside_Edit')){
                        $side = $request->file('aucPhotoside_Edit');
                        // $nameside = $side->getClientOriginalName();
                        $extension = $side->extension();
                        if($validate->aucPhotoside != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsCharge/side/'.$validate->aucPhotoside);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsCharge/side/',$side,$this->upper($request->aucPlate_Edit) . '_side.' . $extension);
                        $namesidefinal = $this->upper($request->aucPlate_Edit) . '_side.' . $extension;
                    }else{
                        if($validate->aucPhotoside != 'imgDefault.png'){
                            // $find_ = strpos($validate->aucPhotoside,'_');
                            // if($find_ === false){
                            //     $namesidefinal = $this->upper($request->aucPlate_Edit) . '_' . $validate->aucPhotoside;
                            // }else{
                                $separatedName = explode('_', $validate->aucPhotoside);
                                $namesidefinal = $this->upper($request->aucPlate_Edit) . '_' . $separatedName[1];
                            // }
                            if($validate->aucPhotoside != $namesidefinal){
                                Storage::disk('opensoft')->move('automotorsCharge/side/'.$validate->aucPhotoside,'automotorsCharge/side/'.$namesidefinal);
                            }
                        }
                    }
                }else{
                    if($validate->aucPhotoside != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsCharge/side/'.$validate->aucPhotoside);
                    }
                    $namesidefinal = 'imgDefault.png';
                }
                // VALIDACION DE IMAGEN DE FRENTE
                $namefrontfinal = '';
                if(!isset($request->aucPhotofrontnot_Edit)){
                    if($request->hasFile('aucPhotofront_Edit')){
                        $front = $request->file('aucPhotofront_Edit');
                        // $namefront = $front->getClientOriginalName();
                        $extension = $front->extension();
                        if($validate->aucPhotofront != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsCharge/front/'.$validate->aucPhotofront);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsCharge/front/',$front,$this->upper($request->aucPlate_Edit) . '_front.' . $extension);
                        $namefrontfinal = $this->upper($request->aucPlate_Edit) . '_front.' . $extension;
                    }else{
                        if($validate->aucPhotofront != 'imgDefault.png'){
                            $find_ = strpos($validate->aucPhotofront,'_');
                            // if($find_ === false){
                            //     $namefrontfinal = $this->upper($request->aucPlate_Edit) . '_' . $validate->aucPhotofront;
                            // }else{
                                $separatedName = explode('_', $validate->aucPhotofront);
                                $namefrontfinal = $this->upper($request->aucPlate_Edit) . '_' . $separatedName[1];
                            // }
                            if($validate->aucPhotofront != $namefrontfinal){
                                Storage::disk('opensoft')->move('automotorsCharge/front/'.$validate->aucPhotofront,'automotorsCharge/front/'.$namefrontfinal);
                            }
                        }
                    }
                }else{
                    if($validate->aucPhotofront != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsCharge/front/'.$validate->aucPhotofront);
                    }
                    $namefrontfinal = 'imgDefault.png';
                }
                $validate->aucPhone = trim($request->aucPhone_Edit);
                $validate->aucTypevehicle_id = trim($request->aucTypevehicle_id_Edit);
                $validate->aucPlate = $this->upper($request->aucPlate_Edit);
                $validate->aucBrand = $this->upper($request->aucBrand_Edit);
                $validate->aucModel = $this->upper($request->aucModel_Edit);
                $validate->aucContractormessenger_id = trim($request->aucContractormessenger_id_Edit);
                $validate->aucContractormessengers = $drivers;
                $validate->aucPhotofront = $namefrontfinal;
                $validate->aucPhotoside = $namesidefinal;
                $validate->aucPhotoback = $namebackfinal;
                $validate->save();
                return redirect()->route('automotors.express')->with('PrimaryCharges', 'Automotor de carga express ' . $this->upper($request->aucPlate_Edit) . ', actualizado');
            }else{
                return redirect()->route('automotors.express')->with('SecondaryCharges', 'No se encuentra el automotor de carga express, consulte al administrador');
            }
        }else{
            return redirect()->route('automotors.express')->with('SecondaryCharges', 'Ya existe automotor de carga express ' . $validateOther->aucPlate);
        }
    }

    function deleteExpress(Request $request){
        // dd($request->all());
        $validate = Automotorcharge::find(trim($request->aucId_Delete));
        if($validate != null){
            $name = $validate->aucPlate;
            if($validate->aucPhotoback != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsCharge/back/'.$validate->aucPhotoback);
            }
            if($validate->aucPhotoside != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsCharge/side/'.$validate->aucPhotoside);
            }
            if($validate->aucPhotofront != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsCharge/front/'.$validate->aucPhotofront);
            }
            $validate->delete();
            return redirect()->route('automotors.express')->with('WarningCharges', 'Automotor de carga express ' . $name . ', eliminado');
        }else{
            return redirect()->route('automotors.express')->with('SecondaryCharges', 'No se encuentra el automotor de carga express');
        }
    }

    /* ===============================================================================================
			MODULO DE SERVICIOS ESPECIALES DE PARQUE AUTOMOTOR
    =============================================================================================== */

    function servicesTo(){
        $automotorsespecials = Automotorespecial::select(
                    'automotorsespecial.*',
                    'settingespecials.*',
                    'alliesespecial.*',
                    'contractorsserviceespecial.*'
                )
                ->join('contractorsserviceespecial','contractorsserviceespecial.ceId','automotorsespecial.aueContractorespecial_id')
                ->join('alliesespecial','alliesespecial.aeId','automotorsespecial.aueAlliesespecial_id')
                ->join('settingespecials','settingespecials.espId','automotorsespecial.aueTypevehicle_id')
                ->get();
        $settingsespecials = Settingespecial::all();
        $alliesespecials = Alliesespecial::all();
        $contractorsespecials = Contractorespecial::all();
        return view('modules.automotors.services.index',compact('automotorsespecials','settingsespecials','contractorsespecials','alliesespecials'));
    }

    function saveService(Request $request){
        // dd($request->all());
        /*
            $request->aueTypevehicle_id
            $request->auePlate
            $request->aueBrand
            $request->aueModel
            $request->aueAlliesespecial_id
            $request->aueContractorespecial_id
            $request->auePhone
            $request->aueContractorespecials_new
            $request->aueContractorespecials
        */
        $validate = Automotorespecial::where('auePlate',$this->upper($request->auePlate))
                                    ->first();
        if($validate == null){
            $drivers = substr(trim($request->aueContractorespecials),0,-1); // QUITAR LOS ULTIMOS 3 CARACTERES (,)
            $namefrontfinal = 'imgDefault.png';
            $namesidefinal = 'imgDefault.png';
            $namebackfinal = 'imgDefault.png';
            if($request->hasFile('auePhotofront')){
                $front = $request->file('auePhotofront');
                // $namefront = $front->getClientOriginalName();
                $extension = $front->extension();
                Storage::disk('opensoft')->putFileAs('automotorsEspecial/front/',$front,$this->upper($request->auePlate) . '_front.' . $extension);
                $namefrontfinal = $this->upper($request->auePlate) . '_front.' . $extension;
            }
            if($request->hasFile('auePhotoside')){
                $side = $request->file('auePhotoside');
                // $nameside = $side->getClientOriginalName();
                $extension = $side->extension();
                Storage::disk('opensoft')->putFileAs('automotorsEspecial/side/',$side,$this->upper($request->auePlate) . '_side.' . $extension);
                $namesidefinal = $this->upper($request->auePlate) . '_side.' . $extension;
            }
            if($request->hasFile('auePhotoback')){
                $back = $request->file('auePhotoback');
                // $nameback = $back->getClientOriginalName();
                $extension = $back->extension();
                Storage::disk('opensoft')->putFileAs('automotorsEspecial/back/',$back,$this->upper($request->auePlate) . '_back.' . $extension);
                $namebackfinal = $this->upper($request->auePlate) . '_back.' . $extension;
            }
            Automotorespecial::create([
                'auePhone' => trim($request->auePhone),
                'aueTypevehicle_id' => trim($request->aueTypevehicle_id),
                'auePlate' => $this->upper($request->auePlate),
                'aueBrand' => $this->upper($request->aueBrand),
                'aueModel' => $this->upper($request->aueModel),
                'aueAlliesespecial_id' => trim($request->aueAlliesespecial_id),
                'aueContractorespecial_id' => trim($request->aueContractorespecial_id),
                'aueContractorespecials' => $drivers,
                'auePhotofront' => $namefrontfinal,
                'auePhotoside' => $namesidefinal,
                'auePhotoback' => $namebackfinal
            ]);
            return redirect()->route('automotors.services')->with('SuccessEspecials', 'Automotor de servicio especial ' . $this->upper($request->auePlate) . ', registrado');
        }else{
            return redirect()->route('automotors.services')->with('SecondaryEspecials', 'Ya existe automotor de servicio especial ' . $validate->auePlate);
        }
    }

    function updateService(Request $request){
        // dd($request->all());
        /*
            $request->aueTypevehicle_id_Edit
            $request->auePlate_Edit
            $request->aueBrand_Edit
            $request->aueModel_Edit
            $request->aueAlliesespecial_id_Edit
            $request->aueContractorespecial_id_Edit
            $request->auePhone_Edit
            $request->aueContractorespecials_new_Edit
            $request->aueContractorespecials_Edit
            $request->auePhotobacknot_Edit
            $request->auePhotosidenot_Edit
            $request->auePhotofrontnot_Edit
            $request->auePhotoback_Edit
            $request->auePhotoside_Edit
            $request->auePhotofront_Edit
            $request->aueId_Edit
        */
        $validateOther = Automotorespecial::where('auePlate',$this->fu($request->auePlate_Edit))
                                        ->where('aueId','!=',trim($request->aueId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Automotorespecial::find(trim($request->aueId_Edit));
            if($validate != null){
                $drivers = substr(trim($request->aueContractorespecials_Edit),0,-1); // QUITAR EL ULTIMO CARACTER (,)
                // VALIDACION DE IMAGEN DE ATRAS
                $namebackfinal = '';
                if(!isset($request->auePhotobacknot_Edit)){
                    if($request->hasFile('auePhotoback_Edit')){
                        $back = $request->file('auePhotoback_Edit');
                        // $nameback = $back->getClientOriginalName();
                        $extension = $back->extension();
                        if($validate->auePhotoback != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsEspecial/back/'.$validate->auePhotoback);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsEspecial/back/',$back,$this->upper($request->auePlate_Edit) . '_back.' . $extension);
                        $namebackfinal = $this->upper($request->auePlate_Edit) . '_back.' . $extension;
                    }else{
                        if($validate->auePhotoback != 'imgDefault.png'){
                            $separatedName = explode('_', $validate->auePhotoback);
                            $namebackfinal = $this->upper($request->auePlate_Edit) . '_' . $separatedName[1];
                            if($validate->auePhotoback != $namebackfinal){
                                Storage::disk('opensoft')->move('automotorsEspecial/back/'.$validate->auePhotoback,'automotorsEspecial/back/'.$namebackfinal);
                            }
                        }
                    }
                }else{
                    if($validate->auePhotoback != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsEspecial/back/'.$validate->auePhotoback);
                    }
                    $namebackfinal = 'imgDefault.png';
                }
                // VALIDACION DE IMAGEN DE LADO
                $namesidefinal = '';
                if(!isset($request->auePhotosidenot_Edit)){
                    if($request->hasFile('auePhotoside_Edit')){
                        $side = $request->file('auePhotoside_Edit');
                        // $nameside = $side->getClientOriginalName();
                        $extension = $side->extension();
                        if($validate->auePhotoside != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsEspecial/side/'.$validate->auePhotoside);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsEspecial/side/',$side,$this->upper($request->auePlate_Edit) . '_side.' . $extension);
                        $namesidefinal = $this->upper($request->auePlate_Edit) . '_side.' . $extension;
                    }else{
                        if($validate->auePhotoside != 'imgDefault.png'){
                            $separatedName = explode('_', $validate->auePhotoside);
                            $namesidefinal = $this->upper($request->auePlate_Edit) . '_' . $separatedName[1];
                            if($validate->auePhotoside != $namesidefinal){
                                Storage::disk('opensoft')->move('automotorsEspecial/side/'.$validate->auePhotoside,'automotorsEspecial/side/'.$namesidefinal);
                            }
                        }
                    }
                }else{
                    if($validate->aucPhotoside != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsEspecial/side/'.$validate->auePhotoside);
                    }
                    $namesidefinal = 'imgDefault.png';
                }
                // VALIDACION DE IMAGEN DE FRENTE
                $namefrontfinal = '';
                if(!isset($request->auePhotofrontnot_Edit)){
                    if($request->hasFile('auePhotofront_Edit')){
                        $front = $request->file('auePhotofront_Edit');
                        // $namefront = $front->getClientOriginalName();
                        $extension = $front->extension();
                        if($validate->auePhotofront != 'imgDefault.png'){
                            Storage::disk('opensoft')->delete('automotorsEspecial/front/'.$validate->auePhotofront);
                        }
                        Storage::disk('opensoft')->putFileAs('automotorsEspecial/front/',$front,$this->upper($request->auePlate_Edit) . '_front.' . $extension);
                        $namefrontfinal = $this->upper($request->auePlate_Edit) . '_front.' . $extension;
                    }else{
                        if($validate->aucPhotofront != 'imgDefault.png'){
                            $find_ = strpos($validate->auePhotofront,'_');
                            $separatedName = explode('_', $validate->auePhotofront);
                            $namefrontfinal = $this->upper($request->auePlate_Edit) . '_' . $separatedName[1];
                            if($validate->auePhotofront != $namefrontfinal){
                                Storage::disk('opensoft')->move('automotorsEspecial/front/'.$validate->auePhotofront,'automotorsEspecial/front/'.$namefrontfinal);
                            }
                        }
                    }
                }else{
                    if($validate->auePhotofront != 'imgDefault.png'){
                        Storage::disk('opensoft')->delete('automotorsEspecial/front/'.$validate->auePhotofront);
                    }
                    $namefrontfinal = 'imgDefault.png';
                }
                $validate->auePhone = trim($request->auePhone_Edit);
                $validate->aueTypevehicle_id = trim($request->aueTypevehicle_id_Edit);
                $validate->auePlate = $this->upper($request->auePlate_Edit);
                $validate->aueBrand = $this->upper($request->aueBrand_Edit);
                $validate->aueModel = $this->upper($request->aueModel_Edit);
                $validate->aueAlliesespecial_id = $this->upper($request->aueAlliesespecial_id_Edit);
                $validate->aueContractorespecial_id = trim($request->aueContractorespecial_id_Edit);
                $validate->aueContractorespecials = $drivers;
                $validate->auePhotofront = $namefrontfinal;
                $validate->auePhotoside = $namesidefinal;
                $validate->auePhotoback = $namebackfinal;
                $validate->save();
                return redirect()->route('automotors.services')->with('PrimaryEspecials', 'Automotor de servicio especial ' . $this->upper($request->auePlate_Edit) . ', actualizado');
            }else{
                return redirect()->route('automotors.services')->with('SecondaryEspecials', 'No se encuentra el automotor de servicio especial, consulte al administrador');
            }
        }else{
            return redirect()->route('automotors.services')->with('SecondaryEspecials', 'Ya existe automotor de servicio especial ' . $validateOther->auePlate);
        }
    }

    function deleteService(Request $request){
        // dd($request->all());
        $validate = Automotorespecial::find(trim($request->aueId_Delete));
        if($validate != null){
            $name = $validate->auePlate;
            if($validate->auePhotoback != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsEspecial/back/'.$validate->auePhotoback);
            }
            if($validate->auePhotoside != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsEspecial/side/'.$validate->auePhotoside);
            }
            if($validate->auePhotofront != 'imgDefault.png'){
                Storage::disk('opensoft')->delete('automotorsEspecial/front/'.$validate->auePhotofront);
            }
            $validate->delete();
            return redirect()->route('automotors.services')->with('WarningEspecials', 'Automotor de servicio especial ' . $name . ', eliminado');
        }else{
            return redirect()->route('automotors.services')->with('SecondaryEspecials', 'No se encuentra el automotor de servicio especial');
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
