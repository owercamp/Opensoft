<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Briefcasemessengerexpress;
use App\Models\Briefcaselogisticexpress;
use App\Models\Briefcasechargeexpress;
use App\Models\Briefcaseturismexpress;
use App\Models\Briefcasetransferexpress;
use App\Models\Briefcasetransferintermunicipality;
use App\Models\Settingservicemessenger;
use App\Models\Settingservicelogistic;
use App\Models\Settingservicecharge;
use App\Models\Settingserviceturism;
use App\Models\Settingservicetransfer;
use App\Models\Settingservicetransfermunicipal;
use App\Models\Settingmunicipality;
use App\Models\Settingespecial;
use App\Models\Settingheavy;

class TariffsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MENSAJERIA EXPRESS DE (PORTAFOLIO DE SERVICIOS)
    =============================================================================================== */
    
    function messengersExpressTo(){
        $briefcases = Briefcasemessengerexpress::select(
                            'briefcasemessengerexpress.*',
                            'settingmunicipalities.munName',
                            'settingservicesmessenger.*'
                        )
                        ->join('settingmunicipalities','settingmunicipalities.munId','briefcasemessengerexpress.bmeMunicipility_id')
                        ->join('settingservicesmessenger','settingservicesmessenger.smId','briefcasemessengerexpress.bmeTypeservice_id')
                        ->get();
        $municipalities = Settingmunicipality::all();
        $servicesmessenger = Settingservicemessenger::all();
        return view('modules.tariffs.messenger.index', compact('briefcases','municipalities','servicesmessenger'));
    }

    function saveMessengersexpress(Request $request){
        // dd($request->all());
        /*
            $request->bmeYear
            $request->bmeMunicipility_id
            $request->bmeTypeservice_id_new
            $request->all_services
        */
        $countWrited = 0;
        $countCreated = 0;
        $services = substr(trim($request->all_services),0,-1); // QUITAR EL ULTIMO CARACTER (=)
        $find = strpos($services,'=');
        if($find === false){
            $separated = explode('-',$services);
            $validate = Briefcasemessengerexpress::where('bmeYear',$this->upper($request->bmeYear))
                                    ->where('bmeMunicipility_id',trim($request->bmeMunicipility_id))
                                    ->where('bmeTypeservice_id',$separated[0])
                                    ->first();
            if($validate == null){
                Briefcasemessengerexpress::create([
                    'bmeYear' => $this->upper($request->bmeYear),
                    'bmeMunicipility_id' => trim($request->bmeMunicipility_id),
                    'bmeTypeservice_id' => $separated[0],
                    'bmeValueratebase' => $separated[1],
                    'bmeValuekilometres' => $separated[2],
                    'bmeValueminutewait' => $separated[3],
                    'bmeValuereturn' => $separated[4]
                ]);
                $countCreated++;
            }else{
                $validate->bmeValueratebase = $separated[1];
                $validate->bmeValuekilometres = $separated[2];
                $validate->bmeValueminutewait = $separated[3];
                $validate->bmeValuereturn = $separated[4];
                $validate->save();
                $countWrited++;
            }
        }else{
            $separatedServices = explode('=',$services);
            for ($i=0; $i < count($separatedServices); $i++) { 
                $separated = explode('-',$separatedServices[$i]);
                $validate = Briefcasemessengerexpress::where('bmeYear',$this->upper($request->bmeYear))
                                        ->where('bmeMunicipility_id',trim($request->bmeMunicipility_id))
                                        ->where('bmeTypeservice_id',$separated[0])
                                        ->first();
                if($validate == null){
                    Briefcasemessengerexpress::create([
                        'bmeYear' => $this->upper($request->bmeYear),
                        'bmeMunicipility_id' => trim($request->bmeMunicipility_id),
                        'bmeTypeservice_id' => $separated[0],
                        'bmeValueratebase' => $separated[1],
                        'bmeValuekilometres' => $separated[2],
                        'bmeValueminutewait' => $separated[3],
                        'bmeValuereturn' => $separated[4]
                    ]);
                    $countCreated++;
                }else{
                    $validate->bmeValueratebase = $separated[1];
                    $validate->bmeValuekilometres = $separated[2];
                    $validate->bmeValueminutewait = $separated[3];
                    $validate->bmeValuereturn = $separated[4];
                    $validate->save();
                    $countWrited++;
                }
            }
        }
        $municipality = Settingmunicipality::find($this->upper($request->bmeMunicipility_id));
        return redirect()->route('tariffs.messenger')->with('SuccessExpress', 'Mensajeria express de (' . $this->upper($request->bmeYear) . '-' . $municipality->munName . '): ' . $countCreated . ' registro/s nuevo/s, y ' . $countWrited . ' sobreescrito/s');
    }

    function updateMessengersexpress(Request $request){
        // dd($request->all());
        $validate = Briefcasemessengerexpress::find(trim($request->bmeId_Edit));
            if($validate != null){
                $validate->bmeValueratebase = trim($request->bmeValueratebase);
                $validate->bmeValuekilometres = trim($request->bmeValuekilometres);
                $validate->bmeValueminutewait = trim($request->bmeValueminutewait);
                $validate->bmeValuereturn = trim($request->bmeValuereturn);
                $validate->save();
                return redirect()->route('tariffs.messenger')->with('PrimaryExpress', 'Mensajeria express de (' . $this->upper($request->bmeYear_Edit) . '-' . $this->upper($request->bmeCity_Edit) . '), Actualizada');
            }else{
                return redirect()->route('tariffs.messenger')->with('SecondaryExpress', 'No se encuentra la mensajeria express');
            }
    }

    function deleteMessengersexpress(Request $request){
        // dd($request->all());
        $validate = Briefcasemessengerexpress::find(trim($request->bmeId_Delete));
        if($validate != null){
            $service =  Settingservicemessenger::find($validate->bmeTypeservice_id);
            $validate->delete();
            return redirect()->route('tariffs.messenger')->with('WarningExpress', 'Mensajeria express de (' . $this->upper($request->bmeYear_Delete) . '-'  . $this->upper($request->bmeCity_Delete) . ') de servicio ' . $service->smService . ', eliminada');
        }else{
            return redirect()->route('tariffs.messenger')->with('SecondaryExpress', 'No se encuentra la mensajeria express');
        }
    }

    /* ===============================================================================================
			MODULO DE LOGISTICA EXPRESS DE (PORTAFOLIO DE SERVICIOS)
    =============================================================================================== */

    function logisticExpressTo(){
        $briefcases = Briefcaselogisticexpress::select(
                            'briefcaselogisticexpress.*',
                            'settingmunicipalities.munName',
                            'settingserviceslogistic.*'
                        )
                        ->join('settingmunicipalities','settingmunicipalities.munId','briefcaselogisticexpress.bleMunicipility_id')
                        ->join('settingserviceslogistic','settingserviceslogistic.slId','briefcaselogisticexpress.bleTypeservice_id')
                        ->get();
        $municipalities = Settingmunicipality::all();
        $serviceslogistic = Settingservicelogistic::all();
        return view('modules.tariffs.logistic.index', compact('briefcases','municipalities','serviceslogistic'));
    }

    function saveLogisticsexpress(Request $request){
        // dd($request->all());
        /*
            $request->bleYear
            $request->bleMunicipility_id
            $request->bleTypeservice_id_new
            $request->all_services
        */
        $countWrited = 0;
        $countCreated = 0;
        $services = substr(trim($request->all_services),0,-1); // QUITAR EL ULTIMO CARACTER (=)
        $find = strpos($services,'=');
        if($find === false){
            $separated = explode('-',$services);
            $validate = Briefcaselogisticexpress::where('bleYear',$this->upper($request->bleYear))
                                    ->where('bleMunicipility_id',trim($request->bleMunicipility_id))
                                    ->where('bleTypeservice_id',$separated[0])
                                    ->first();
            if($validate == null){
                Briefcaselogisticexpress::create([
                    'bleYear' => $this->upper($request->bleYear),
                    'bleMunicipility_id' => trim($request->bleMunicipility_id),
                    'bleTypeservice_id' => $separated[0],
                    'bleValueratebase' => $separated[1],
                    'bleValueminutewait' => $separated[2],
                    'bleValuereturn' => $separated[3]
                ]);
                $countCreated++;
            }else{
                $validate->bleValueratebase = $separated[1];
                $validate->bleValueminutewait = $separated[2];
                $validate->bleValuereturn = $separated[3];
                $validate->save();
                $countWrited++;
            }
        }else{
            $separatedServices = explode('=',$services);
            for ($i=0; $i < count($separatedServices); $i++) { 
                $separated = explode('-',$separatedServices[$i]);
                $validate = Briefcaselogisticexpress::where('bleYear',$this->upper($request->bleYear))
                                        ->where('bleMunicipility_id',trim($request->bleMunicipility_id))
                                        ->where('bleTypeservice_id',$separated[0])
                                        ->first();
                if($validate == null){
                    Briefcaselogisticexpress::create([
                        'bleYear' => $this->upper($request->bleYear),
                        'bleMunicipility_id' => trim($request->bleMunicipility_id),
                        'bleTypeservice_id' => $separated[0],
                        'bleValueratebase' => $separated[1],
                        'bleValueminutewait' => $separated[2],
                        'bleValuereturn' => $separated[3]
                    ]);
                    $countCreated++;
                }else{
                    $validate->bleValueratebase = $separated[1];
                    $validate->bleValueminutewait = $separated[2];
                    $validate->bleValuereturn = $separated[3];
                    $validate->save();
                    $countWrited++;
                }
            }
        }
        $municipality = Settingmunicipality::find($this->upper($request->bleMunicipility_id));
        return redirect()->route('tariffs.logistic')->with('SuccessExpress', 'Logística express de (' . $this->upper($request->bleYear) . '-' . $municipality->munName . '): ' . $countCreated . ' registro/s nuevo/s, y ' . $countWrited . ' sobreescrito/s');
    }

    function updateLogisticsexpress(Request $request){
        // dd($request->all());
        $validate = Briefcaselogisticexpress::find(trim($request->bleId_Edit));
            if($validate != null){
                $validate->bleValueratebase = trim($request->bleValueratebase);
                $validate->bleValueminutewait = trim($request->bleValueminutewait);
                $validate->bleValuereturn = trim($request->bleValuereturn);
                $validate->save();
                return redirect()->route('tariffs.logistic')->with('PrimaryExpress', 'Logística express de (' . $this->upper($request->bleYear_Edit) . '-' . $this->upper($request->bleCity_Edit) . '), Actualizada');
            }else{
                return redirect()->route('tariffs.logistic')->with('SecondaryExpress', 'No se encuentra la logística express');
            }
    }

    function deleteLogisticsexpress(Request $request){
        // dd($request->all());
        $validate = Briefcaselogisticexpress::find(trim($request->bleId_Delete));
        if($validate != null){
            $service =  Briefcaselogisticexpress::find($validate->bleTypeservice_id);
            $validate->delete();
            return redirect()->route('tariffs.logistic')->with('WarningExpress', 'Logística express de (' . $this->upper($request->bleYear_Delete) . '-'  . $this->upper($request->bleCity_Delete) . ') de servicio ' . $service->slService . ', eliminada');
        }else{
            return redirect()->route('tariffs.logistic')->with('SecondaryExpress', 'No se encuentra la logística express');
        }
    }

    /* ===============================================================================================
			MODULO DE CARGA EXPRESS DE (PORTAFOLIO DE SERVICIOS)
    =============================================================================================== */

    function chargeExpressTo(){
        $briefcases = Briefcasechargeexpress::select(
                            'briefcasechargeexpress.*',
                            'settingmunicipalities.munName',
                            'settingservicescharge.*',
                            'settingheavys.*'
                        )
                        ->join('settingmunicipalities','settingmunicipalities.munId','briefcasechargeexpress.bceMunicipility_id')
                        ->join('settingheavys','settingheavys.heaId','briefcasechargeexpress.bceTypevehicle_id')
                        ->join('settingservicescharge','settingservicescharge.scId','briefcasechargeexpress.bceTypeservice_id')
                        ->get();
        $heavys = Settingheavy::all();
        $municipalities = Settingmunicipality::all();
        $servicescharge = Settingservicecharge::all();
        return view('modules.tariffs.charge.index', compact('briefcases','municipalities','heavys','servicescharge'));
    }

    function saveChargeexpress(Request $request){
        // dd($request->all());
        /*
            $request->bceYear
            $request->bceMunicipility_id
            $request->bceTypeservice_id_new
            $request->all_services
        */
        $countWrited = 0;
        $countCreated = 0;
        $services = substr(trim($request->all_services),0,-1); // QUITAR EL ULTIMO CARACTER (=)
        $find = strpos($services,'=');
        if($find === false){
            $separated = explode('-',$services);
            $validate = Briefcasechargeexpress::where('bceYear',$this->upper($request->bceYear))
                                    ->where('bceMunicipility_id',trim($request->bceMunicipility_id))
                                    ->where('bceTypevehicle_id',trim($request->bceTypevehicle_id))
                                    ->where('bceTypeservice_id',$separated[0])
                                    ->first();
            if($validate == null){
                Briefcasechargeexpress::create([
                    'bceYear' => $this->upper($request->bceYear),
                    'bceMunicipility_id' => trim($request->bceMunicipility_id),
                    'bceTypevehicle_id' => trim($request->bceTypevehicle_id),
                    'bceTypeservice_id' => $separated[0],
                    'bceValueratebase' => $separated[1],
                    'bceValuekilometres' => $separated[2],
                    'bceValuereturn' => $separated[3]
                ]);
                $countCreated++;
            }else{
                $validate->bceValueratebase = $separated[1];
                $validate->bceValuekilometres = $separated[2];
                $validate->bceValuereturn = $separated[3];
                $validate->save();
                $countWrited++;
            }
        }else{
            $separatedServices = explode('=',$services);
            for ($i=0; $i < count($separatedServices); $i++) { 
                $separated = explode('-',$separatedServices[$i]);
                $validate = Briefcasechargeexpress::where('bceYear',$this->upper($request->bceYear))
                                        ->where('bceMunicipility_id',trim($request->bceMunicipility_id))
                                        ->where('bceTypevehicle_id',trim($request->bceTypevehicle_id))
                                        ->where('bceTypeservice_id',$separated[0])
                                        ->first();
                if($validate == null){
                    Briefcasechargeexpress::create([
                        'bceYear' => $this->upper($request->bceYear),
                        'bceMunicipility_id' => trim($request->bceMunicipility_id),
                        'bceTypevehicle_id' => trim($request->bceTypevehicle_id),
                        'bceTypeservice_id' => $separated[0],
                        'bceValueratebase' => $separated[1],
                        'bceValuekilometres' => $separated[2],
                        'bceValuereturn' => $separated[3]
                    ]);
                    $countCreated++;
                }else{
                    $validate->bceValueratebase = $separated[1];
                    $validate->bceValuekilometres = $separated[2];
                    $validate->bceValuereturn = $separated[3];
                    $validate->save();
                    $countWrited++;
                }
            }
        }
        $municipality = Settingmunicipality::find($this->upper($request->bceMunicipility_id));
        return redirect()->route('tariffs.charge')->with('SuccessExpress', 'Carga express de (' . $this->upper($request->bceYear) . '-' . $municipality->munName . '): ' . $countCreated . ' registro/s nuevo/s, y ' . $countWrited . ' sobreescrito/s');
    }

    function updateChargeexpress(Request $request){
        // dd($request->all());
        $validate = Briefcasechargeexpress::find(trim($request->bceId_Edit));
            if($validate != null){
                $validate->bceValueratebase = trim($request->bceValueratebase);
                $validate->bceValuekilometres = trim($request->bceValuekilometres);
                $validate->bceValuereturn = trim($request->bceValuereturn);
                $validate->save();
                return redirect()->route('tariffs.charge')->with('PrimaryExpress', 'Carga express de (' . $this->upper($request->bceYear_Edit) . '-' . $this->upper($request->bceCity_Edit) . '-' . $this->upper($request->bceVehicle_Edit) . '), Actualizada');
            }else{
                return redirect()->route('tariffs.charge')->with('SecondaryExpress', 'No se encuentra la carga express');
            }
    }

    function deleteChargeexpress(Request $request){
        // dd($request->all());
        $validate = Briefcasechargeexpress::find(trim($request->bceId_Delete));
        if($validate != null){
            $service =  Briefcasechargeexpress::find($validate->bceTypeservice_id);
            $validate->delete();
            return redirect()->route('tariffs.charge')->with('WarningExpress', 'Carga express de (' . $this->upper($request->bceYear_Delete) . '-'  . $this->upper($request->bceCity_Delete) . '-'  . $this->upper($request->bceVehicle_Delete) . ') de servicio ' . $service->scService . ', eliminada');
        }else{
            return redirect()->route('tariffs.charge')->with('SecondaryExpress', 'No se encuentra la carga express');
        }
    }

    /* ===============================================================================================
            MODULO DE TURISMO EXPRESS DE (PORTAFOLIO DE SERVICIOS)
    =============================================================================================== */

    function turismExpressTo(){
        $briefcases = Briefcaseturismexpress::select(
                            'briefcaseturismexpress.*',
                            'settingmunicipalities.munName',
                            'settingservicesturism.*',
                            'settingespecials.*',
                            'settingproductsturism.ptId',
                            'settingproductsturism.ptProduct'
                        )
                        ->join('settingmunicipalities','settingmunicipalities.munId','briefcaseturismexpress.bteMunicipility_id')
                        ->join('settingespecials','settingespecials.espId','briefcaseturismexpress.bteTypevehicle_id')
                        ->join('settingservicesturism','settingservicesturism.stId','briefcaseturismexpress.bteTypeservice_id')
                        ->join('settingproductsturism','settingproductsturism.ptId','settingservicesturism.stProduct_id')
                        ->get();
        $especials = Settingespecial::all();
        $municipalities = Settingmunicipality::all();
        $servicesturism = Settingserviceturism::select('settingservicesturism.*','settingproductsturism.ptProduct')
                            ->join('settingproductsturism','settingproductsturism.ptId','settingservicesturism.stProduct_id')
                            ->get();
        return view('modules.tariffs.turism.index', compact('briefcases','municipalities','especials','servicesturism'));
    }

    function saveTurismexpress(Request $request){
        // dd($request->all());
        /*
            $request->bteYear
            $request->bteMunicipility_id
            $request->bteTypevehicle_id
            $request->bteTypeservice_id_new
            $request->all_services
        */
        $countWrited = 0;
        $countCreated = 0;
        $services = substr(trim($request->all_services),0,-1); // QUITAR EL ULTIMO CARACTER (=)
        $find = strpos($services,'=');
        if($find === false){
            $separated = explode('-',$services);
            $validate = Briefcaseturismexpress::where('bteYear',$this->upper($request->bteYear))
                                    ->where('bteMunicipility_id',trim($request->bteMunicipility_id))
                                    ->where('bteTypevehicle_id',trim($request->bteTypevehicle_id))
                                    ->where('bteTypeservice_id',$separated[0])
                                    ->first();
            if($validate == null){
                Briefcaseturismexpress::create([
                    'bteYear' => $this->upper($request->bteYear),
                    'bteMunicipility_id' => trim($request->bteMunicipility_id),
                    'bteTypevehicle_id' => trim($request->bteTypevehicle_id),
                    'bteTypeservice_id' => $separated[0],
                    'bteValueratebase' => $separated[1]
                ]);
                $countCreated++;
            }else{
                $validate->bteValueratebase = $separated[1];
                $validate->save();
                $countWrited++;
            }
        }else{
            $separatedServices = explode('=',$services);
            for ($i=0; $i < count($separatedServices); $i++) { 
                $separated = explode('-',$separatedServices[$i]);
                $validate = Briefcaseturismexpress::where('bteYear',$this->upper($request->bteYear))
                                    ->where('bteMunicipility_id',trim($request->bteMunicipility_id))
                                    ->where('bteTypevehicle_id',trim($request->bteTypevehicle_id))
                                    ->where('bteTypeservice_id',$separated[0])
                                    ->first();
                if($validate == null){
                    Briefcaseturismexpress::create([
                        'bteYear' => $this->upper($request->bteYear),
                        'bteMunicipility_id' => trim($request->bteMunicipility_id),
                        'bteTypevehicle_id' => trim($request->bteTypevehicle_id),
                        'bteTypeservice_id' => $separated[0],
                        'bteValueratebase' => $separated[1]
                    ]);
                    $countCreated++;
                }else{
                    $validate->bteValueratebase = $separated[1];
                    $validate->save();
                    $countWrited++;
                }
            }
        }
        $municipality = Settingmunicipality::find($this->upper($request->bteMunicipility_id));
        return redirect()->route('tariffs.turism')->with('SuccessTurism', 'Turismo pasajeros de (' . $this->upper($request->bteYear) . '-' . $municipality->munName . '): ' . $countCreated . ' registro/s nuevo/s, y ' . $countWrited . ' sobreescrito/s');
    }

    function updateTurismexpress(Request $request){
        // dd($request->all());
        $validate = Briefcaseturismexpress::find(trim($request->bteId_Edit));
        if($validate != null){
            $validate->bteValueratebase = trim($request->bteValueratebase);
            $validate->save();
            return redirect()->route('tariffs.turism')->with('PrimaryTurism', 'Turismo pasajeros de (' . $this->upper($request->bteYear_Edit) . '-' . $this->upper($request->bteCity_Edit) . '-' . $this->upper($request->bteVehicle_Edit) . '), Actualizada');
        }else{
            return redirect()->route('tariffs.turism')->with('SecondaryTurism', 'No se encuentra el turismo pasajeros');
        }
    }

    function deleteTurismexpress(Request $request){
        // dd($request->all());
        $validate = Briefcaseturismexpress::find(trim($request->bteId_Delete));
        if($validate != null){
            $service =  Settingserviceturism::find($validate->bteTypeservice_id);
            $validate->delete();
            return redirect()->route('tariffs.turism')->with('WarningTurism', 'Turismo pasajeros de (' . $this->upper($request->bteYear_Delete) . '-'  . $this->upper($request->bteCity_Delete) . '-'  . $this->upper($request->bteVehicle_Delete) . ') de servicio ' . $service->stService . ', eliminada');
        }else{
            return redirect()->route('tariffs.turism')->with('SecondaryTurism', 'No se encuentra el turismo pasajeros');
        }
    }

    /* ===============================================================================================
            MODULO DE TRASLADO URBANO DE (PORTAFOLIO DE SERVICIOS)
    =============================================================================================== */

    function transferExpressTo(){
        $briefcases = Briefcasetransferexpress::select(
                            'briefcasetransferexpress.*',
                            'settingmunicipalities.munName',
                            'settingservicestransfer.*',
                            'settingespecials.*',
                            'settingproductstransfer.ptrId',
                            'settingproductstransfer.ptrProduct'
                        )
                        ->join('settingmunicipalities','settingmunicipalities.munId','briefcasetransferexpress.btreMunicipility_id')
                        ->join('settingespecials','settingespecials.espId','briefcasetransferexpress.btreTypevehicle_id')
                        ->join('settingservicestransfer','settingservicestransfer.strId','briefcasetransferexpress.btreTypeservice_id')
                        ->join('settingproductstransfer','settingproductstransfer.ptrId','settingservicestransfer.strProduct_id')
                        ->get();
        $especials = Settingespecial::all();
        $municipalities = Settingmunicipality::all();
        $servicestransfer = Settingservicetransfer::select('settingservicestransfer.*','settingproductstransfer.ptrProduct')
                            ->join('settingproductstransfer','settingproductstransfer.ptrId','settingservicestransfer.strProduct_id')
                            ->get();
        return view('modules.tariffs.transfer.index', compact('briefcases','municipalities','especials','servicestransfer'));
    }

    function saveTransferexpress(Request $request){
        // dd($request->all());
        /*
            $request->btreYear
            $request->btreMunicipility_id
            $request->btreTypevehicle_id
            $request->btreTypeservice_id_new
            $request->all_services
        */
        $countWrited = 0;
        $countCreated = 0;
        $services = substr(trim($request->all_services),0,-1); // QUITAR EL ULTIMO CARACTER (=)
        $find = strpos($services,'=');
        if($find === false){
            $separated = explode('-',$services);
            $validate = Briefcasetransferexpress::where('btreYear',$this->upper($request->btreYear))
                                    ->where('btreMunicipility_id',trim($request->btreMunicipility_id))
                                    ->where('btreTypevehicle_id',trim($request->btreTypevehicle_id))
                                    ->where('btreTypeservice_id',$separated[0])
                                    ->first();
            if($validate == null){
                Briefcasetransferexpress::create([
                    'btreYear' => $this->upper($request->btreYear),
                    'btreMunicipility_id' => trim($request->btreMunicipility_id),
                    'btreTypevehicle_id' => trim($request->btreTypevehicle_id),
                    'btreTypeservice_id' => $separated[0],
                    'btreValueratebase' => $separated[1]
                ]);
                $countCreated++;
            }else{
                $validate->btreValueratebase = $separated[1];
                $validate->save();
                $countWrited++;
            }
        }else{
            $separatedServices = explode('=',$services);
            for ($i=0; $i < count($separatedServices); $i++) { 
                $separated = explode('-',$separatedServices[$i]);
                $validate = Briefcasetransferexpress::where('btreYear',$this->upper($request->btreYear))
                                    ->where('btreMunicipility_id',trim($request->btreMunicipility_id))
                                    ->where('btreTypevehicle_id',trim($request->btreTypevehicle_id))
                                    ->where('btreTypeservice_id',$separated[0])
                                    ->first();
                if($validate == null){
                    Briefcasetransferexpress::create([
                        'btreYear' => $this->upper($request->btreYear),
                        'btreMunicipility_id' => trim($request->btreMunicipility_id),
                        'btreTypevehicle_id' => trim($request->btreTypevehicle_id),
                        'btreTypeservice_id' => $separated[0],
                        'btreValueratebase' => $separated[1]
                    ]);
                    $countCreated++;
                }else{
                    $validate->btreValueratebase = $separated[1];
                    $validate->save();
                    $countWrited++;
                }
            }
        }
        $municipality = Settingmunicipality::find($this->upper($request->btreMunicipility_id));
        return redirect()->route('tariffs.transfer')->with('SuccessTransfer', 'Traslado urbano de (' . $this->upper($request->btreYear) . '-' . $municipality->munName . '): ' . $countCreated . ' registro/s nuevo/s, y ' . $countWrited . ' sobreescrito/s');
    }

    function updateTransferexpress(Request $request){
        // dd($request->all());
        $validate = Briefcasetransferexpress::find(trim($request->btreId_Edit));
            if($validate != null){
                $validate->btreValueratebase = trim($request->btreValueratebase);
                $validate->save();
                return redirect()->route('tariffs.transfer')->with('PrimaryTransfer', 'Traslado urbano de (' . $this->upper($request->btreYear_Edit) . '-' . $this->upper($request->btreCity_Edit) . '-' . $this->upper($request->btreVehicle_Edit) . '), Actualizada');
            }else{
                return redirect()->route('tariffs.transfer')->with('SecondaryTransfer', 'No se encuentra el traslado urbano');
            }
    }

    function deleteTransferexpress(Request $request){
        // dd($request->all());
        $validate = Briefcasetransferexpress::find(trim($request->btreId_Delete));
        if($validate != null){
            $service =  Settingservicetransfer::find($validate->btreTypeservice_id);
            $validate->delete();
            return redirect()->route('tariffs.transfer')->with('WarningTransfer', 'Traslado urbano de (' . $this->upper($request->btreYear_Delete) . '-'  . $this->upper($request->btreCity_Delete) . '-'  . $this->upper($request->btreVehicle_Delete) . ') de servicio ' . $service->strService . ', eliminada');
        }else{
            return redirect()->route('tariffs.transfer')->with('SecondaryTransfer', 'No se encuentra el traslado urbano');
        }
    }

    /* ===============================================================================================
            MODULO DE TRASLADO INTERMUNICIPAL DE (PORTAFOLIO DE SERVICIOS)
    =============================================================================================== */

    function transferintermunipalityTo(){
        $briefcases = Briefcasetransferintermunicipality::select(
                            'briefcasetransferintermunicipalities.*',
                            'settingservicestransfermunicipals.*',
                            'settingespecials.*',
                            'settingproductstransfermunicipals.ptmId',
                            'settingproductstransfermunicipals.ptmProduct'
                        )
                        ->join('settingespecials','settingespecials.espId','briefcasetransferintermunicipalities.btriTypevehicle_id')
                        ->join('settingservicestransfermunicipals','settingservicestransfermunicipals.stmId','briefcasetransferintermunicipalities.btriTypeservice_id')
                        ->join('settingproductstransfermunicipals','settingproductstransfermunicipals.ptmId','settingservicestransfermunicipals.stmTypeproduct_id')
                        ->get();
        $especials = Settingespecial::all();
        $servicesmunicipalitys = Settingservicetransfermunicipal::select('settingservicestransfermunicipals.*','settingproductstransfermunicipals.ptmProduct')
                            ->join('settingproductstransfermunicipals','settingproductstransfermunicipals.ptmId','settingservicestransfermunicipals.stmTypeproduct_id')
                            ->get();
        return view('modules.tariffs.intermunicipality.index', compact('briefcases','especials','servicesmunicipalitys'));
    }

    function saveTransferintermunipality(Request $request){
        // dd($request->all());
        /*
            $request->btriYear
            $request->btriTypevehicle_id
            $request->btriTypeservice_id_new
            $request->all_services
        */
        $countWrited = 0;
        $countCreated = 0;
        $services = substr(trim($request->all_services),0,-1); // QUITAR EL ULTIMO CARACTER (=)
        $find = strpos($services,'=');
        if($find === false){
            $separated = explode('-',$services);
            $separated[0] = (integer)$separated[0];
            $validate = Briefcasetransferintermunicipality::where('btriYear',$this->upper($request->btriYear))
                                    ->where('btriTypevehicle_id',trim($request->btriTypevehicle_id))
                                    ->where('btriTypeservice_id',$separated[0])
                                    ->first();
                // dd($separated[0]);
            if($validate == null){
                Briefcasetransferintermunicipality::create([
                    'btriYear' => $this->upper($request->btriYear),
                    'btriTypevehicle_id' => trim($request->btriTypevehicle_id),
                    'btriTypeservice_id' => $separated[0],
                    'btriValuebase' => $separated[1]
                ]);
                $countCreated++;
            }else{
                $validate->btriValuebase = $separated[1];
                $validate->save();
                $countWrited++;
            }
        }else{
            $separatedServices = explode('=',$services);
            for ($i=0; $i < count($separatedServices); $i++) { 
                $separated = explode('-',$separatedServices[$i]);
                $separated[0] = (integer)$separated[0];
                $validate = Briefcasetransferintermunicipality::where('btriYear',$this->upper($request->btriYear))
                                    ->where('btriTypevehicle_id',trim($request->btriTypevehicle_id))
                                    ->where('btriTypeservice_id',$separated[0])
                                    ->first();
                // dd($separated[0]);
                if($validate == null){
                    Briefcasetransferintermunicipality::create([
                        'btriYear' => $this->upper($request->btriYear),
                        'btriTypevehicle_id' => trim($request->btriTypevehicle_id),
                        'btriTypeservice_id' => $separated[0],
                        'btriValuebase' => $separated[1]
                    ]);
                    $countCreated++;
                }else{
                    $validate->btriValuebase = $separated[1];
                    $validate->save();
                    $countWrited++;
                }
            }
        }
        $vehicle = Settingespecial::find($this->upper($request->btriTypevehicle_id));
        return redirect()->route('tariffs.transferintermunipality')->with('SuccessTransfer', 'Traslado intermunicipal de (' . $this->upper($request->btriYear) . '-' . $vehicle->espTypology . '): ' . $countCreated . ' registro/s nuevo/s, y ' . $countWrited . ' sobreescrito/s');
    }

    function updateTransferintermunipality(Request $request){
        // dd($request->all());
        /*
            $request->btriYear_Edit
            $request->btriVehicle_Edit
            $request->btriValuebase
            $request->btriId_Edit
        */
        $validate = Briefcasetransferintermunicipality::find(trim($request->btriId_Edit));
            if($validate != null){
                $validate->btriValuebase = trim($request->btriValuebase);
                $validate->save();
                return redirect()->route('tariffs.transferintermunipality')->with('PrimaryTransfer', 'Traslado intermunicipal de (' . $this->upper($request->btriYear_Edit) . '-' . $this->upper($request->btriVehicle_Edit) . '), Actualizado');
            }else{
                return redirect()->route('tariffs.transferintermunipality')->with('SecondaryTransfer', 'No se encuentra el traslado intermunicipal');
            }
    }

    function deleteTransferintermunipality(Request $request){
        // dd($request->all());
        /*
            $request->btriYear_Delete
            $request->btriVehicle_Delete
            $request->btriId_Delete
        */
        $validate = Briefcasetransferintermunicipality::find(trim($request->btriId_Delete));
        if($validate != null){
            $service =  Settingservicetransfermunicipal::find($validate->btriTypeservice_id);
            $validate->delete();
            return redirect()->route('tariffs.transferintermunipality')->with('WarningTransfer', 'Traslado intermunicipal de (' . $this->upper($request->btriYear_Delete) . '-'  . $this->upper($request->btriVehicle_Delete) . ') de servicio ' . $service->stmService . ', eliminado');
        }else{
            return redirect()->route('tariffs.transferintermunipality')->with('SecondaryTransfer', 'No se encuentra el traslado intermunicipal');
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
