<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Settingservicemessenger;
use App\Models\Settingproductmessenger;
use App\Models\Settingservicelogistic;
use App\Models\Settingproductlogistic;
use App\Models\Settingservicecharge;
use App\Models\Settingproductcharge;
use App\Models\Settingserviceturism;
use App\Models\Settingproductturism;
use App\Models\Settingservicetransfer;
use App\Models\Settingproducttransfer;
use App\Models\Settingservicetransfermunicipal;
use App\Models\Settingproducttransfermunicipal;
use App\Models\Settingmunicipality;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MENSAJERIA (messenger)
    =============================================================================================== */
    
    function messengerTo(){
        $messengers = Settingservicemessenger::select('settingservicesmessenger.*','settingproductsmessenger.pmProduct')
                                ->join('settingproductsmessenger','settingproductsmessenger.pmId','settingservicesmessenger.smProduct_id')
                                ->get();
        $productsmessengers = Settingproductmessenger::all();
        return view('modules.services.messenger.index',compact('messengers','productsmessengers'));
    }

    function saveMessengers(Request $request){
        // dd($request->all());
        $validate = Settingservicemessenger::where('smService',$this->fu($request->smService))
                                    ->where('smAvailability',$this->upper($request->smAvailability))
                                    ->first();
        if($validate == null){
            Settingservicemessenger::create([
                'smProduct_id' => $this->fu($request->smProduct_id),
                'smService' => $this->fu($request->smService),
                'smAvailability' => $this->upper($request->smAvailability),
                'smDescription' => $this->fu($request->smDescription)
            ]);
            return redirect()->route('services.messenger')->with('SuccessMessengers', 'Mensajeria de servicios ' . $this->fu($request->smService) . ', registrada');
        }else{
            return redirect()->route('services.messenger')->with('SecondaryMessengers', 'Ya existe la mensajeria de servicios ' . $validate->smService);
        }   
    }

    function updateMessengers(Request $request){
        // dd($request->all());
        $validateOther = Settingservicemessenger::where('smService',$this->fu($request->smService_Edit))
                                        ->where('smAvailability',$this->fu($request->smAvailability_Edit))
                                        ->where('smDescription',$this->fu($request->smDescription_Edit))
                                        ->where('smId','!=',trim($request->smId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingservicemessenger::find(trim($request->smId_Edit));
            if($validate != null){
                $validate->smProduct_id = $this->fu($request->smProduct_id_Edit);
                $validate->smService = $this->fu($request->smService_Edit);
                $validate->smAvailability = $this->upper($request->smAvailability_Edit);
                $validate->smDescription = $this->fu($request->smDescription_Edit);
                $validate->save();
                return redirect()->route('services.messenger')->with('PrimaryMessengers', 'Mensajeria de servicios ' . $this->fu($request->smService_Edit) . ', actualizada');
            }else{
                return redirect()->route('services.messenger')->with('SecondaryMessengers', 'No se encuentra la mensajeria de servicios, consulte al administrador');
            }
        }else{
            return redirect()->route('services.messenger')->with('SecondaryMessengers', 'Ya existe la mensajeria de servicios ' . $validateOther->smService . ', consulte al administrador');
        }
    }

    function deleteMessengers(Request $request){
        // dd($request->all());
        $validate = Settingservicemessenger::find(trim($request->smId_Delete));
        if($validate != null){
            $name = $validate->smService;
            $validate->delete();
            return redirect()->route('services.messenger')->with('WarningMessengers', 'Mensajeria de servicios ' . $name . ', eliminada');
        }else{
            return redirect()->route('services.messenger')->with('SecondaryMessengers', 'No se encuentra la mensajeria de servicios, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE LOGISTICA (logistic)
    =============================================================================================== */

    function logisticTo(){
        $logistics = Settingservicelogistic::select('settingserviceslogistic.*','settingproductslogistic.plProduct')
                                ->join('settingproductslogistic','settingproductslogistic.plId','settingserviceslogistic.slProduct_id')
                                ->get();
        $productslogistics = Settingproductlogistic::all();
        return view('modules.services.logistic.index',compact('logistics','productslogistics'));
    }

    function saveLogistics(Request $request){
        // dd($request->all());
        $validate = Settingservicelogistic::where('slService',$this->fu($request->slService))
                                    ->where('slAvailability',$this->upper($request->slAvailability))
                                    ->first();
        if($validate == null){
            Settingservicelogistic::create([
                'slProduct_id' => trim($request->slProduct_id),
                'slService' => $this->fu($request->slService),
                'slAvailability' => $this->upper($request->slAvailability),
                'slDescription' => $this->fu($request->slDescription)
            ]);
            return redirect()->route('services.logistic')->with('SuccessLogistics', 'Logística de servicios ' . $this->fu($request->slService) . ', registrada');
        }else{
            return redirect()->route('services.logistic')->with('SecondaryLogistics', 'Ya existe la logística de servicios ' . $validate->slService);
        }   
    }

    function updateLogistics(Request $request){
        // dd($request->all());
        $validateOther = Settingservicelogistic::where('slService',$this->fu($request->slService_Edit))
                                        ->where('slAvailability',$this->upper($request->slAvailability_Edit))
                                        ->where('slDescription',$this->fu($request->slDescription_Edit))
                                        ->where('slId','!=',trim($request->slId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingservicelogistic::find(trim($request->slId_Edit));
            if($validate != null){
                $validate->slProduct_id = trim($request->slProduct_id_Edit);
                $validate->slService = $this->fu($request->slService_Edit);
                $validate->slAvailability = $this->upper($request->slAvailability_Edit);
                $validate->slDescription = $this->fu($request->slDescription_Edit);
                $validate->save();
                return redirect()->route('services.logistic')->with('PrimaryLogistics', 'Logística de servicios ' . $this->fu($request->slService_Edit) . ', actualizada');
            }else{
                return redirect()->route('services.logistic')->with('SecondaryLogistics', 'No se encuentra la logística de servicios');
            }
        }else{
            return redirect()->route('services.logistic')->with('SecondaryLogistics', 'Ya existe la logística de servicios ' . $validateOther->slService . ', consulte la tabla');
        }
    }

    function deleteLogistics(Request $request){
        // dd($request->all());
        $validate = Settingservicelogistic::find(trim($request->slId_Delete));
        if($validate != null){
            $name = $validate->slService;
            $validate->delete();
            return redirect()->route('services.logistic')->with('WarningLogistics', 'Logística de servicios ' . $name . ', eliminada');
        }else{
            return redirect()->route('services.logistic')->with('SecondaryLogistics', 'No se encuentra la logística de servicios, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
            MODULO DE CARGA EXPRESS (express)
    =============================================================================================== */

    function expressTo(){
        $charges = Settingservicecharge::select('settingservicescharge.*','settingproductscharge.pcProduct')
                                ->join('settingproductscharge','settingproductscharge.pcId','settingservicescharge.scTypeproduct_id')
                                ->get();
        $productsexpress = Settingproductcharge::all();
        return view('modules.services.express.index',compact('charges','productsexpress'));
    }

    function saveExpress(Request $request){
        // dd($request->all());
        /*
            $request->scTypeproduct_id
            $request->scService
            $request->scUnit
            $request->scKilos
            $request->scDimensions_height
            $request->scDimensions_long
            $request->scDimensions_width
            $request->scDescription
        */
        $validate = Settingservicecharge::where('scService',$this->fu($request->scService))
                                    ->where('scTypeproduct_id',trim($request->scTypeproduct_id))
                                    ->first();
        if($validate == null){
            $dimensions = trim($request->scDimensions_height) . '-' . trim($request->scDimensions_long) . '-' . trim($request->scDimensions_width);
            Settingservicecharge::create([
                'scTypeproduct_id' => trim($request->scTypeproduct_id),
                'scService' => $this->fu($request->scService),
                'scUnit' => trim($request->scUnit),
                'scKilos' => trim($request->scKilos),
                'scDimensions' => $dimensions,
                'scDescription' => $this->fu($request->scDescription)
            ]);
            return redirect()->route('services.express')->with('SuccessExpress', 'Carga express de servicios ' . $this->fu($request->scService) . ', registrada');
        }else{
            return redirect()->route('services.express')->with('SecondaryExpress', 'Ya existe la carga express de servicios ' . $validate->scService);
        }   
    }

    function updateExpress(Request $request){
        // dd($request->all());
        $validateOther = Settingservicecharge::where('scService',$this->fu($request->scService_Edit))
                                        ->where('scTypeproduct_id',$this->upper($request->scTypeproduct_id_Edit))
                                        ->where('scId','!=',trim($request->scId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingservicecharge::find(trim($request->scId_Edit));
            if($validate != null){
                $dimensions = trim($request->scDimensions_height_Edit) . '-' . trim($request->scDimensions_long_Edit) . '-' . trim($request->scDimensions_width_Edit);
                $validate->scTypeproduct_id = trim($request->scTypeproduct_id_Edit);
                $validate->scService = $this->fu($request->scService_Edit);
                $validate->scUnit = trim($request->scUnit_Edit);
                $validate->scKilos = trim($request->scKilos_Edit);
                $validate->scDimensions = $dimensions;
                $validate->scDescription = $this->fu($request->scDescription_Edit);
                $validate->save();
                return redirect()->route('services.express')->with('PrimaryExpress', 'Carga express de servicios ' . $this->fu($request->scService_Edit) . ', actualizada');
            }else{
                return redirect()->route('services.express')->with('SecondaryExpress', 'No se encuentra la carga express de servicios');
            }
        }else{
            return redirect()->route('services.express')->with('SecondaryExpress', 'Ya existe la carga express de servicios ' . $validateOther->scService . ', consulte la tabla');
        }
    }

    function deleteExpress(Request $request){
        // dd($request->all());
        $validate = Settingservicecharge::find(trim($request->scId_Delete));
        if($validate != null){
            $name = $validate->scService;
            $validate->delete();
            return redirect()->route('services.express')->with('WarningExpress', 'Carga express de servicios ' . $name . ', eliminada');
        }else{
            return redirect()->route('services.express')->with('SecondaryExpress', 'No se encuentra la carga express de servicios');
        }
    }

    /* ===============================================================================================
			MODULO DE TURISMO (tourism)
    =============================================================================================== */

    function tourismTo(){
        $tourisms = Settingserviceturism::select('settingservicesturism.*','settingproductsturism.ptProduct')
                                ->join('settingproductsturism','settingproductsturism.ptId','settingservicesturism.stProduct_id')
                                ->get();
        $productstourisms = Settingproductturism::all();
        return view('modules.services.tourism.index',compact('tourisms','productstourisms'));
    }

    function saveTourism(Request $request){
        // dd($request->all());
        $validate = Settingserviceturism::where('stService',$this->fu($request->stService))
                                    ->where('stAvailability',$this->upper($request->stAvailability))
                                    ->first();
        if($validate == null){
            Settingserviceturism::create([
                'stProduct_id' => trim($request->stProduct_id),
                'stService' => $this->fu($request->stService),
                'stAvailability' => $this->upper($request->stAvailability),
                'stDescription' => $this->fu($request->stDescription)
            ]);
            return redirect()->route('services.tourism')->with('SuccessTurism', 'Turismo de servicios ' . $this->fu($request->stService) . ', registrado');
        }else{
            return redirect()->route('services.tourism')->with('SecondaryTurism', 'Ya existe la turismo de servicios ' . $validate->stService);
        }   
    }

    function updateTourism(Request $request){
        // dd($request->all());
        $validateOther = Settingserviceturism::where('stService',$this->fu($request->stService_Edit))
                                        ->where('stAvailability',$this->upper($request->stAvailability_Edit))
                                        ->where('stDescription',$this->fu($request->stDescription_Edit))
                                        ->where('stId','!=',trim($request->stId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingserviceturism::find(trim($request->stId_Edit));
            if($validate != null){
                $validate->stProduct_id = trim($request->stProduct_id_Edit);
                $validate->stService = $this->fu($request->stService_Edit);
                $validate->stAvailability = $this->upper($request->stAvailability_Edit);
                $validate->stDescription = $this->fu($request->stDescription_Edit);
                $validate->save();
                return redirect()->route('services.tourism')->with('PrimaryTurism', 'Turismo de servicios ' . $this->fu($request->stService_Edit) . ', actualizado');
            }else{
                return redirect()->route('services.tourism')->with('SecondaryTurism', 'No se encuentra el turismo de servicios');
            }
        }else{
            return redirect()->route('services.tourism')->with('SecondaryTurism', 'Ya existe el turismo de servicios ' . $validateOther->stService . ', consulte la tabla');
        }
    }

    function deleteTourism(Request $request){
        // dd($request->all());
        $validate = Settingserviceturism::find(trim($request->stId_Delete));
        if($validate != null){
            $name = $validate->stService;
            $validate->delete();
            return redirect()->route('services.tourism')->with('WarningTurism', 'Turismo de servicios ' . $name . ', eliminado');
        }else{
            return redirect()->route('services.tourism')->with('SecondaryTurism', 'No se encuentra el turismo de servicios, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE TRASLADOS (transfers)
    =============================================================================================== */

    function transfersTo(){
        $transfers = Settingservicetransfer::select('settingservicestransfer.*','settingproductstransfer.ptrProduct')
                                ->join('settingproductstransfer','settingproductstransfer.ptrId','settingservicestransfer.strProduct_id')
                                ->get();
        $productstransfers = Settingproducttransfer::all();
        return view('modules.services.transfers.index',compact('transfers','productstransfers'));
    }

    function saveTransfers(Request $request){
        // dd($request->all());
        $validate = Settingservicetransfer::where('strService',$this->fu($request->strService))
                                    ->where('strAvailability',$this->upper($request->strAvailability))
                                    ->first();
        if($validate == null){
            Settingservicetransfer::create([
                'strProduct_id' => trim($request->strProduct_id),
                'strService' => $this->fu($request->strService),
                'strAvailability' => $this->upper($request->strAvailability),
                'strDescription' => $this->fu($request->strDescription)
            ]);
            return redirect()->route('services.transfers')->with('SuccessTransfer', 'Traslado de servicios ' . $this->fu($request->strService) . ', registrado');
        }else{
            return redirect()->route('services.transfers')->with('SecondaryTransfer', 'Ya existe la traslado de servicios ' . $validate->strService);
        }   
    }

    function updateTransfers(Request $request){
        // dd($request->all());
        $validateOther = Settingservicetransfer::where('strService',$this->fu($request->strService_Edit))
                                        ->where('strAvailability',$this->upper($request->strAvailability_Edit))
                                        ->where('strDescription',$this->fu($request->strDescription_Edit))
                                        ->where('strId','!=',trim($request->strId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingservicetransfer::find(trim($request->strId_Edit));
            if($validate != null){
                $validate->strProduct_id = trim($request->strProduct_id_Edit);
                $validate->strService = $this->fu($request->strService_Edit);
                $validate->strAvailability = $this->upper($request->strAvailability_Edit);
                $validate->strDescription = $this->fu($request->strDescription_Edit);
                $validate->save();
                return redirect()->route('services.transfers')->with('PrimaryTransfer', 'Traslado de servicios ' . $this->fu($request->strService_Edit) . ', actualizado');
            }else{
                return redirect()->route('services.transfers')->with('SecondaryTransfer', 'No se encuentra el traslado de servicios');
            }
        }else{
            return redirect()->route('services.transfers')->with('SecondaryTransfer', 'Ya existe el traslado de servicios ' . $validateOther->strService . ', consulte la tabla');
        }
    }

    function deleteTransfers(Request $request){
        // dd($request->all());
        $validate = Settingservicetransfer::find(trim($request->strId_Delete));
        if($validate != null){
            $name = $validate->strService;
            $validate->delete();
            return redirect()->route('services.transfers')->with('WarningTransfer', 'Traslado de servicios ' . $name . ', eliminado');
        }else{
            return redirect()->route('services.transfers')->with('SecondaryTransfer', 'No se encuentra el traslado de servicios, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
            MODULO DE TRASLADOS INTERMUNICIPALES (transfers municipalities)
    =============================================================================================== */

    function transfersmunicipalsTo(){
        $transfers = Settingservicetransfermunicipal::select('settingservicestransfermunicipals.*','settingmunicipalities.munName','settingproductstransfermunicipals.ptmProduct')
                                ->join('settingproductstransfermunicipals','settingproductstransfermunicipals.ptmId','settingservicestransfermunicipals.stmTypeproduct_id')
                                ->join('settingmunicipalities','settingmunicipalities.munId','settingservicestransfermunicipals.stmMunstart_id')
                                ->get();
        $productstransfers = Settingproducttransfermunicipal::all();
        $municipalities = Settingmunicipality::all();
        return view('modules.services.transfersmunicipalities.index',compact('transfers','productstransfers','municipalities'));
    }

    function saveTransfersmunicipals(Request $request){
        // dd($request->all());
        /*
            $request->strProduct_id
            $request->stmService
            $request->stmTimeavailability
            $request->stmMunstart_id
            $request->stmMunicipilityend_id_new
            $request->stmKilometres
            $request->stmDescription
            $request->stmMunicipilityends
        */
        $validate = Settingservicetransfermunicipal::where('stmService',$this->fu($request->stmService))->first();
        if($validate == null){
            if(trim($request->stmMunicipilityends) != '' && trim($request->stmMunicipilityends) != '='){
                $ends = substr(trim($request->stmMunicipilityends),0,-1); // QUITAR ULTIMO CARACTER QUE ES (=)
            }else{
                $ends = null;
            }
            Settingservicetransfermunicipal::create([
                'stmTypeproduct_id' => trim($request->stmTypeproduct_id),
                'stmService' => $this->fu($request->stmService),
                'stmTimeavailability' => $this->upper($request->stmTimeavailability),
                'stmMunstart_id' => trim($request->stmMunstart_id),
                'stmMunicipilityends' => $ends,
                'stmKilometres' => $this->upper($request->stmKilometres),
                'stmDescription' => $this->fu($request->stmDescription)
            ]);
            return redirect()->route('services.transfersmunicipals')->with('SuccessTransfer', 'Traslado intermunicipal de servicios ' . $this->fu($request->stmService) . ', registrado');
        }else{
            return redirect()->route('services.transfersmunicipals')->with('SecondaryTransfer', 'Ya existe el traslado intermunicipal de servicios ' . $validate->stmService);
        }   
    }

    function updateTransfersmunicipals(Request $request){
        // dd($request->all());
        /*
            $request->stmTypeproduct_id_Edit
            $request->stmService_Edit
            $request->stmTimeavailability_Edit
            $request->stmMunstart_id_Edit
            $request->stmMunicipilityend_id_edit
            $request->stmKilometres_Edit
            $request->stmDescription_Edit
            $request->stmMunicipilityends_Edit
            $request->stmId_Edit
        */
        $validateOther = Settingservicetransfermunicipal::where('stmService',$this->fu($request->stmService_Edit))
                                        ->where('stmId','!=',trim($request->stmId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingservicetransfermunicipal::find(trim($request->stmId_Edit));
            if($validate != null){
                if(trim($request->stmMunicipilityends_Edit) != '' && trim($request->stmMunicipilityends_Edit) != '='){
                    $ends = substr(trim($request->stmMunicipilityends_Edit),0,-1); // QUITAR ULTIMO CARACTER QUE ES (=)
                }else{
                    $ends = null;
                }
                $ends = substr(trim($request->stmMunicipilityends_Edit),0,-1); // QUITAR ULTIMO CARACTER QUE ES (=)
                $validate->stmTypeproduct_id = trim($request->stmTypeproduct_id_Edit);
                $validate->stmService = $this->fu($request->stmService_Edit);
                $validate->stmTimeavailability = $this->upper($request->stmTimeavailability_Edit);
                $validate->stmMunstart_id = trim($request->stmMunstart_id_Edit);
                $validate->stmMunicipilityends = $ends;
                $validate->stmKilometres = $this->upper($request->stmKilometres_Edit);
                $validate->stmDescription = $this->fu($request->stmDescription_Edit);
                $validate->save();
                return redirect()->route('services.transfersmunicipals')->with('PrimaryTransfer', 'Traslado intermunicipal de servicios ' . $this->fu($request->stmService_Edit) . ', actualizado');
            }else{
                return redirect()->route('services.transfersmunicipals')->with('SecondaryTransfer', 'No se encuentra el traslado intermunicipal de servicios');
            }
        }else{
            return redirect()->route('services.transfersmunicipals')->with('SecondaryTransfer', 'Ya existe el traslado intermunicipal de servicios ' . $validateOther->stmService);
        }
    }

    function deleteTransfersmunicipals(Request $request){
        // dd($request->all());
        $validate = Settingservicetransfermunicipal::find(trim($request->stmId_Delete));
        if($validate != null){
            $name = $validate->stmService;
            $validate->delete();
            return redirect()->route('services.transfersmunicipals')->with('WarningTransfer', 'Traslado intermunicipal de servicios ' . $name . ', eliminado');
        }else{
            return redirect()->route('services.transfersmunicipals')->with('SecondaryTransfer', 'No se encuentra el traslado intermunicipal de servicios');
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

