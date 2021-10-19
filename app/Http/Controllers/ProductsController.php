<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Settingservicemessenger;
use App\Models\Settingproductmessenger;
use App\Models\Settingservicelogistic;
use App\Models\Settingproductlogistic;
use App\Models\Settingproductcharge;
use App\Models\Settingserviceturism;
use App\Models\Settingproductturism;
use App\Models\Settingservicetransfer;
use App\Models\Settingproducttransfer;
use App\Models\Settingproducttransfermunicipal;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MENSAJERIA (messenger)
    =============================================================================================== */
    
    function messengerTo(){
        $messengers = Settingproductmessenger::all();
        return view('modules.products.messenger.index',compact('messengers'));
    }

    function saveMessengers(Request $request){
        // dd($request->all());
        $validate = Settingproductmessenger::where('pmProduct',$this->fu($request->pmProduct))
                                    ->where('pmAvailability',$this->fu($request->pmAvailability))
                                    ->first();
        if($validate == null){
            Settingproductmessenger::create([
                'pmProduct' => $this->fu($request->pmProduct),
                'pmAvailability' => $this->fu($request->pmAvailability),
                'pmDescription' => $this->fu($request->pmDescription)
            ]);
            return redirect()->route('products.messenger')->with('SuccessMessengers', 'Mensajeria de productos ' . $this->fu($request->pmProduct) . ', registrada');
        }else{
            return redirect()->route('products.messenger')->with('SecondaryMessengers', 'Ya existe la mensajeria de productos ' . $validate->pmProduct);
        }
    }

    function updateMessengers(Request $request){
        // dd($request->all());
        $validateOther = Settingproductmessenger::where('pmProduct',$this->fu($request->pmProduct_Edit))
                                        ->where('pmAvailability',$this->fu($request->pmAvailability_Edit))
                                        ->where('pmDescription',$this->fu($request->pmDescription_Edit))
                                        ->where('pmId','!=',trim($request->pmId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingproductmessenger::find(trim($request->pmId_Edit));
            if($validate != null){
                $validate->pmProduct = $this->fu($request->pmProduct_Edit);
                $validate->pmAvailability = $this->fu($request->pmAvailability_Edit);
                $validate->pmDescription = $this->fu($request->pmDescription_Edit);
                $validate->save();
                return redirect()->route('products.messenger')->with('PrimaryMessengers', 'Mensajeria de productos ' . $this->fu($request->pmProduct_Edit) . ', actualizada');
            }else{
                return redirect()->route('products.messenger')->with('SecondaryMessengers', 'No se encuentra la mensajeria de productos, consulte al administrador');
            }
        }else{
            return redirect()->route('products.messenger')->with('SecondaryMessengers', 'Ya existe la mensajeria de productos ' . $validateOther->pmProduct . ', consulte al administrador');
        }
    }

    function deleteMessengers(Request $request){
        // dd($request->all());
        $validateRelation = Settingservicemessenger::where('smProduct_id',trim($request->pmId_Delete))->first();
        if($validateRelation == null){
            $validate = Settingproductmessenger::find(trim($request->pmId_Delete));
            if($validate != null){
                $name = $validate->pmProduct;
                $validate->delete();
                return redirect()->route('products.messenger')->with('WarningMessengers', 'Mensajeria de productos ' . $name . ', eliminada');
            }else{
                return redirect()->route('products.messenger')->with('SecondaryMessengers', 'No se encuentra la mensajeria de productos, Consulte con el administrador');
            }
        }else{
            return redirect()->route('products.messenger')->with('SecondaryMessengers', 'No es posible eliminar un dato al que se hace referencia desde otro módulo');
        }   
    }

    /* ===============================================================================================
			MODULO DE LOGISTICA (logistic)
    =============================================================================================== */

    function logisticTo(){
        $logistics = Settingproductlogistic::all();
        return view('modules.products.logistic.index',compact('logistics'));
    }

    function saveLogistics(Request $request){
        // dd($request->all());
        $validate = Settingproductlogistic::where('plProduct',$this->fu($request->plProduct))->first();
        if($validate == null){
            Settingproductlogistic::create([
                'plProduct' => $this->fu($request->plProduct),
                'plDescription' => $this->fu($request->plDescription)
            ]);
            return redirect()->route('products.logistic')->with('SuccessLogistics', 'Logística de productos ' . $this->fu($request->plProduct) . ', registrada');
        }else{
            return redirect()->route('products.logistic')->with('SecondaryLogistics', 'Ya existe la logística de productos ' . $validate->plProduct);
        }   
    }

    function updateLogistics(Request $request){
        // dd($request->all());
        $validateOther = Settingproductlogistic::where('plProduct',$this->fu($request->plProduct_Edit))
                                        ->where('plId','!=',trim($request->plId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingproductlogistic::find(trim($request->plId_Edit));
            if($validate != null){
                $validate->plProduct = $this->fu($request->plProduct_Edit);
                $validate->plDescription = $this->fu($request->plDescription_Edit);
                $validate->save();
                return redirect()->route('products.logistic')->with('PrimaryLogistics', 'Logística de productos ' . $this->fu($request->plProduct_Edit) . ', actualizada');
            }else{
                return redirect()->route('products.logistic')->with('SecondaryLogistics', 'No se encuentra la logística de productos, consulte al administrador');
            }
        }else{
            return redirect()->route('products.logistic')->with('SecondaryLogistics', 'Ya existe la logística de productos ' . $validateOther->plProduct);
        }
    }

    function deleteLogistics(Request $request){
        // dd($request->all());
        $validateRelation = Settingservicelogistic::where('slProduct_id',trim($request->plId_Delete))->first();
        if($validateRelation == null){
            $validate = Settingproductlogistic::find(trim($request->plId_Delete));
            if($validate != null){
                $name = $validate->plProduct;
                $validate->delete();
                return redirect()->route('products.logistic')->with('WarningLogistics', 'Logística de productos ' . $name . ', eliminada');
            }else{
                return redirect()->route('products.logistic')->with('SecondaryLogistics', 'No se encuentra la logística de productos, Consulte con el administrador');
            }
        }else{
            return redirect()->route('products.logistic')->with('SecondaryLogistics', 'No es posible eliminar un dato al que se hace referencia desde otro módulo');
        }
    }

    /* ===============================================================================================
            MODULO DE CARGA EXPRESS (express)
    =============================================================================================== */

    function expressTo(){
        $charges = Settingproductcharge::all();
        return view('modules.products.express.index',compact('charges'));
    }

    function saveExpress(Request $request){
        // dd($request->all());
        $validate = Settingproductcharge::where('pcProduct',$this->fu($request->pcProduct))->first();
        if($validate == null){
            Settingproductcharge::create([
                'pcProduct' => $this->fu($request->pcProduct),
                'pcDescription' => $this->fu($request->pcDescription)
            ]);
            return redirect()->route('products.express')->with('SuccessExpress', 'Carga express de productos ' . $this->fu($request->pcProduct) . ', registrada');
        }else{
            return redirect()->route('products.express')->with('SecondaryExpress', 'Ya existe la carga express de productos ' . $validate->pcProduct);
        }   
    }

    function updateExpress(Request $request){
        // dd($request->all());
        $validateOther = Settingproductcharge::where('pcProduct',$this->fu($request->pcProduct_Edit))
                                        ->where('pcId','!=',trim($request->pcId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingproductcharge::find(trim($request->pcId_Edit));
            if($validate != null){
                $validate->pcProduct = $this->fu($request->pcProduct_Edit);
                $validate->pcDescription = $this->fu($request->pcDescription_Edit);
                $validate->save();
                return redirect()->route('products.express')->with('PrimaryExpress', 'Carga express de productos ' . $this->fu($request->pcProduct_Edit) . ', actualizada');
            }else{
                return redirect()->route('products.express')->with('SecondaryExpress', 'No se encuentra la carga express de productos, consulte al administrador');
            }
        }else{
            return redirect()->route('products.express')->with('SecondaryExpress', 'Ya existe la carga express de productos ' . $validateOther->pcProduct);
        }
    }

    function deleteExpress(Request $request){
        // dd($request->all());
        $validate = Settingproductcharge::find(trim($request->pcId_Delete));
        if($validate != null){
            $name = $validate->pcProduct;
            $validate->delete();
            return redirect()->route('products.express')->with('WarningExpress', 'Carga express de productos ' . $name . ', eliminada');
        }else{
            return redirect()->route('products.express')->with('SecondaryExpress', 'No se encuentra la carga express de productos, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE TURISMO (tourism)
    =============================================================================================== */

    function tourismTo(){
        $tourisms = Settingproductturism::all();
        return view('modules.products.tourism.index',compact('tourisms'));
    }

    function saveTourism(Request $request){
        // dd($request->all());
        $validate = Settingproductturism::where('ptProduct',$this->fu($request->ptProduct))->first();
        if($validate == null){
            Settingproductturism::create([
                'ptProduct' => $this->fu($request->ptProduct),
                'ptAvailability' => $this->upper($request->ptAvailability),
                'ptDescription' => $this->fu($request->ptDescription)
            ]);
            return redirect()->route('products.tourism')->with('SuccessTurism', 'Turismo de productos ' . $this->fu($request->ptProduct) . ', registrado');
        }else{
            return redirect()->route('products.tourism')->with('SecondaryTurism', 'Ya existe el turismo de productos ' . $validate->ptProduct);
        }   
    }

    function updateTourism(Request $request){
        // dd($request->all());
        $validateOther = Settingproductturism::where('ptProduct',$this->fu($request->ptProduct_Edit))
                                        ->where('ptId','!=',trim($request->ptId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingproductturism::find(trim($request->ptId_Edit));
            if($validate != null){
                $validate->ptProduct = $this->fu($request->ptProduct_Edit);
                $validate->ptAvailability = $this->upper($request->ptAvailability_Edit);
                $validate->ptDescription = $this->fu($request->ptDescription_Edit);
                $validate->save();
                return redirect()->route('products.tourism')->with('PrimaryTurism', 'Turismo de productos ' . $this->fu($request->ptProduct_Edit) . ', actualizado');
            }else{
                return redirect()->route('products.tourism')->with('SecondaryTurism', 'No se encuentra el turismo de productos, consulte al administrador');
            }
        }else{
            return redirect()->route('products.tourism')->with('SecondaryTurism', 'Ya existe el turismo de productos ' . $validateOther->ptProduct);
        }
    }

    function deleteTourism(Request $request){
        // dd($request->all());
        $validateRelation = Settingserviceturism::where('stProduct_id',trim($request->ptId_Delete))->first();
        if($validateRelation == null){
            $validate = Settingproductturism::find(trim($request->ptId_Delete));
            if($validate != null){
                $name = $validate->ptProduct;
                $validate->delete();
                return redirect()->route('products.tourism')->with('WarningTurism', 'Turismo de productos ' . $name . ', eliminado');
            }else{
                return redirect()->route('products.tourism')->with('SecondaryTurism', 'No se encuentra el turismo de productos, Consulte con el administrador');
            }
        }else{
            return redirect()->route('products.tourism')->with('SecondaryTurism', 'No es posible eliminar un dato al que se hace referencia desde otro módulo');
        }
    }

    /* ===============================================================================================
			MODULO DE TRASLADOS URBANOS (transfers)
    =============================================================================================== */

    function transfersTo(){
        $transfers = Settingproducttransfer::all();
        return view('modules.products.transfers.index',compact('transfers'));
    }

    function saveTransfers(Request $request){
        // dd($request->all());
        $validate = Settingproducttransfer::where('ptrProduct',$this->fu($request->ptrProduct))->first();
        if($validate == null){
            Settingproducttransfer::create([
                'ptrProduct' => $this->fu($request->ptrProduct),
                'ptrAvailability' => $this->upper($request->ptrAvailability),
                'ptrDescription' => $this->fu($request->ptrDescription)
            ]);
            return redirect()->route('products.transfers')->with('SuccessTransfer', 'Traslado urbano de productos ' . $this->fu($request->ptrProduct) . ', registrado');
        }else{
            return redirect()->route('products.transfers')->with('SecondaryTransfer', 'Ya existe el traslado urbano de productos ' . $validate->ptrProduct);
        }   
    }

    function updateTransfers(Request $request){
        // dd($request->all());
        $validateOther = Settingproducttransfer::where('ptrProduct',$this->fu($request->ptrProduct_Edit))
                                        ->where('ptrId','!=',trim($request->ptrId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingproducttransfer::find(trim($request->ptrId_Edit));
            if($validate != null){
                $validate->ptrProduct = $this->fu($request->ptrProduct_Edit);
                $validate->ptrAvailability = $this->upper($request->ptrAvailability_Edit);
                $validate->ptrDescription = $this->fu($request->ptrDescription_Edit);
                $validate->save();
                return redirect()->route('products.transfers')->with('PrimaryTransfer', 'Traslado urbano de productos ' . $this->fu($request->ptrProduct_Edit) . ', actualizado');
            }else{
                return redirect()->route('products.transfers')->with('SecondaryTransfer', 'No se encuentra el traslado urbano de productos, consulte al administrador');
            }
        }else{
            return redirect()->route('products.transfers')->with('SecondaryTransfer', 'Ya existe el traslado urbano de productos ' . $validateOther->ptrProduct);
        }
    }

    function deleteTransfers(Request $request){
        // dd($request->all());
        $validateRelation = Settingservicetransfer::where('strProduct_id',trim($request->ptrId_Delete))->first();
        if($validateRelation == null){
            $validate = Settingproducttransfer::find(trim($request->ptrId_Delete));
            if($validate != null){
                $name = $validate->ptrProduct;
                $validate->delete();
                return redirect()->route('products.transfers')->with('WarningTransfer', 'Traslado urbano de productos ' . $name . ', eliminado');
            }else{
                return redirect()->route('products.transfers')->with('SecondaryTransfer', 'No se encuentra el traslado urbano de productos, Consulte con el administrador');
            }
        }else{
            return redirect()->route('products.transfers')->with('SecondaryTransfer', 'No es posible eliminar un dato al que se hace referencia desde otro módulo');
        }
    }

    /* ===============================================================================================
            MODULO DE TRASLADOS INTERMUNICIPALES (transfers municipalities)
    =============================================================================================== */

    function transfersmunicipalsTo(){
        $transfers = Settingproducttransfermunicipal::all();
        return view('modules.products.transfersmunicipalities.index',compact('transfers'));
    }

    function saveTransfersmunicipals(Request $request){
        // dd($request->all());
        $validate = Settingproducttransfermunicipal::where('ptmProduct',$this->fu($request->ptmProduct))->first();
        if($validate == null){
            Settingproducttransfermunicipal::create([
                'ptmProduct' => $this->fu($request->ptmProduct),
                'ptmDescription' => $this->fu($request->ptmDescription)
            ]);
            return redirect()->route('products.transfersmunicipals')->with('SuccessTransfer', 'Traslado intermunicipal de productos ' . $this->fu($request->ptmProduct) . ', registrado');
        }else{
            return redirect()->route('products.transfersmunicipals')->with('SecondaryTransfer', 'Ya existe el traslado intermunicipal de productos ' . $validate->ptmProduct);
        }   
    }

    function updateTransfersmunicipals(Request $request){
        // dd($request->all());
        $validateOther = Settingproducttransfermunicipal::where('ptmProduct',$this->fu($request->ptmProduct_Edit))
                                        ->where('ptmId','!=',trim($request->ptmId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settingproducttransfermunicipal::find(trim($request->ptmId_Edit));
            if($validate != null){
                $validate->ptmProduct = $this->fu($request->ptmProduct_Edit);
                $validate->ptmDescription = $this->fu($request->ptmDescription_Edit);
                $validate->save();
                return redirect()->route('products.transfersmunicipals')->with('PrimaryTransfer', 'Traslado intermunicipal de productos ' . $this->fu($request->ptmProduct_Edit) . ', actualizado');
            }else{
                return redirect()->route('products.transfersmunicipals')->with('SecondaryTransfer', 'No se encuentra el traslado intermunicipal de productos');
            }
        }else{
            return redirect()->route('products.transfersmunicipals')->with('SecondaryTransfer', 'Ya existe el traslado intermunicipal de productos ' . $validateOther->ptmProduct);
        }
    }

    function deleteTransfersmunicipals(Request $request){
        // dd($request->all());
        // $validateRelation = Settingservicetransfer::where('strProduct_id',trim($request->ptrId_Delete))->first();
        // if($validateRelation == null){
            $validate = Settingproducttransfermunicipal::find(trim($request->ptmId_Delete));
            if($validate != null){
                $name = $validate->ptmProduct;
                $validate->delete();
                return redirect()->route('products.transfersmunicipals')->with('WarningTransfer', 'Traslado intermunicipal de productos ' . $name . ', eliminado');
            }else{
                return redirect()->route('products.transfersmunicipals')->with('SecondaryTransfer', 'No se encuentra el traslado intermunicipal de productos');
            }
        // }else{
            // return redirect()->route('products.transfers')->with('SecondaryTransfer', 'No es posible eliminar un dato al que se hace referencia desde otro módulo');
        // }
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
