<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Provider;
use App\Models\Providerproduct;
use App\Models\Providerservice;
use App\Models\Settingpersonal;
use App\Models\Settingdepartment;

class ProvidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE PRODUCTOS DE PROVEEDORES
    =============================================================================================== */
    
    function productsTo(){
        $products = Providerproduct::all();
        return view('modules.providers.products.index',compact('products'));
    }

    function saveProduct(Request $request){
        // dd($request->all());
        $validate = Providerproduct::where('ppName',$this->fu($request->ppName))->first();
        if($validate == null){
            Providerproduct::create([
                'ppName' => $this->fu($request->ppName),
                'ppDescription' => $this->fu($request->ppDescription)
            ]);
            return redirect()->route('providers.products')->with('SuccessProducts', 'Producto ' . $this->fu($request->ppName) . ', registrado');
        }else{
            return redirect()->route('providers.products')->with('SecondaryProducts', 'Ya existe el producto ' . $validate->ppName);
        } 
    }

    function updateProduct(Request $request){
        // dd($request->all());
        $validateOther = Providerproduct::where('ppName',$this->fu($request->ppName_Edit))
                                        ->where('ppId','!=',trim($request->ppId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Providerproduct::find(trim($request->ppId_Edit));
            if($validate != null){
                $nameOld = $validate->ppName;
                $validate->ppName = $this->fu($request->ppName_Edit);
                $validate->ppDescription = $this->fu($request->ppDescription_Edit);
                $validate->save();
                return redirect()->route('providers.products')->with('PrimaryProducts', 'Producto ' . $this->fu($request->ppName_Edit) . ', actualizado');
            }else{
                return redirect()->route('providers.products')->with('SecondaryProducts', 'No se encuentra el producto, consulte al administrador');
            }
        }else{
            return redirect()->route('providers.products')->with('SecondaryProducts', 'Ya existe el producto ' . $validateOther->ppName);
        }
    }

    function deleteProduct(Request $request){
        // dd($request->all());
        $validate = Providerproduct::find(trim($request->ppId_Delete));
        if($validate != null){
            $name = $validate->ppName;
            $validate->delete();
            return redirect()->route('providers.products')->with('WarningProducts', 'Producto ' . $name . ', eliminado');
        }else{
            return redirect()->route('providers.products')->with('SecondaryProducts', 'No se encuentra el producto');
        }
    }

    /* ===============================================================================================
			MODULO DE SERVICIOS DE PROVEEDORES
    =============================================================================================== */

    function servicesTo(){
        $services = Providerservice::all();
        return view('modules.providers.services.index',compact('services'));
    }

    function saveService(Request $request){
        // dd($request->all());
        $validate = Providerservice::where('psName',$this->fu($request->psName))->first();
        if($validate == null){
            Providerservice::create([
                'psName' => $this->fu($request->psName),
                'psDescription' => $this->fu($request->psDescription)
            ]);
            return redirect()->route('providers.services')->with('SuccessServices', 'Servicio ' . $this->fu($request->psName) . ', registrado');
        }else{
            return redirect()->route('providers.services')->with('SecondaryServices', 'Ya existe el servicio ' . $validate->psName);
        }
    }

    function updateService(Request $request){
        // dd($request->all());
        $validateOther = Providerservice::where('psName',$this->fu($request->psName_Edit))
                                        ->where('psId','!=',trim($request->psId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Providerservice::find(trim($request->psId_Edit));
            if($validate != null){
                $nameOld = $validate->psName;
                $validate->psName = $this->fu($request->psName_Edit);
                $validate->psDescription = $this->fu($request->psDescription_Edit);
                $validate->save();
                return redirect()->route('providers.services')->with('PrimaryServices', 'Servicio ' . $this->fu($request->psName_Edit) . ', actualizado');
            }else{
                return redirect()->route('providers.services')->with('SecondaryServices', 'No se encuentra el servicio, consulte al administrador');
            }
        }else{
            return redirect()->route('providers.products')->with('SecondaryServices', 'Ya existe el servicio ' . $validateOther->psName);
        }
    }

    function deleteService(Request $request){
        // dd($request->all());
        $validate = Providerservice::find(trim($request->psId_Delete));
        if($validate != null){
            $name = $validate->psName;
            $validate->delete();
            return redirect()->route('providers.services')->with('WarningServices', 'Servicio ' . $name . ', eliminado');
        }else{
            return redirect()->route('providers.services')->with('SecondaryServices', 'No se encuentra el servicio');
        }
    }

    /* ===============================================================================================
			MODULO DE PROVEEDORES
    =============================================================================================== */

    function providersTo(){
        // $providers = Provider::all();
        $providers = Provider::select(
                    'providers.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.perName'
                )
                ->join('settingpersonals','settingpersonals.perId','providers.proPersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','providers.proNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->get();
        $personals = Settingpersonal::all();
        $departments = Settingdepartment::all();
        return view('modules.providers.providers.index',compact('providers','personals','departments'));
    }

    function saveProvider(Request $request){
        // dd($request->all());
        /*
            $request->proReasonsocial
            $request->proPersonal_id
            $request->proNumberdocument
            $request->proNumberregistration
            $request->proDateregistration
            $request->proCommerce
            $request->proDepartment_id
            $request->proMunicipality_id
            $request->proZoning_id
            $request->proNeighborhood_id
            $request->proCode
            $request->proAddress
            $request->proEmail
            $request->proPhone
            $request->proMovil
            $request->proWhatsapp
            $request->proRepresentativename
            $request->proRepresentativepersonal_id
            $request->proRepresentativenumberdocument
            $request->proBank
            $request->proTypeaccount
            $request->proAccountnumber
            $request->proRegime
            $request->proTaxpayer
            $request->proAutoretainer
            $request->proActivitys_one
            $request->proActivitys_two
            $request->proActivitys_three
            $request->proActivitys_four
        */
        $validate = Provider::where('proReasonsocial',$this->fu($request->proReasonsocial))->first();
        if($validate == null){
            $activitys = '';
            if($request->proActivitys_one != ''){
                $activitys .= $request->proActivitys_one . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->proActivitys_two != ''){
                $activitys .= $request->proActivitys_two . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->proActivitys_three != ''){
                $activitys .= $request->proActivitys_three . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->proActivitys_four != ''){
                $activitys .= $request->proActivitys_four;
            }else{
                $activitys .= 'N/A';
            }
            Provider::create([
                'proReasonsocial' => $this->fu($request->proReasonsocial),
                'proPersonal_id' => trim($request->proPersonal_id),
                'proNumberdocument' => trim($request->proNumberdocument),
                'proNumberregistration' => trim($request->proNumberregistration),
                'proDateregistration' => trim($request->proDateregistration),
                'proCommerce' => trim($request->proCommerce),
                'proNeighborhood_id' => trim($request->proNeighborhood_id),
                'proAddress' => $this->upper($request->proAddress),
                'proEmail' => $this->lower($request->proEmail),
                'proPhone' => trim($request->proPhone),
                'proMovil' => trim($request->proMovil),
                'proWhatsapp' => trim($request->proWhatsapp),
                'proRepresentativename' => trim($request->proRepresentativename),
                'proRepresentativepersonal_id' => trim($request->proRepresentativepersonal_id),
                'proRepresentativenumberdocument' => trim($request->proRepresentativenumberdocument),
                'proBank' => $this->upper($request->proBank),
                'proTypeaccount' => $this->upper($request->proTypeaccount),
                'proAccountnumber' => $this->upper($request->proAccountnumber),
                'proRegime' => $this->upper($request->proRegime),
                'proTaxpayer' => $this->upper($request->proTaxpayer),
                'proAutoretainer' => $this->upper($request->proAutoretainer),
                'proActivitys' => $activitys
            ]);
            return redirect()->route('providers.providers')->with('SuccessProviders', 'Proveedor ' . $this->fu($request->proReasonsocial) . ', registrado');
        }else{
            return redirect()->route('providers.providers')->with('SecondaryProviders', 'Ya existe el proveedor ' . $validate->proReasonsocial);
        }
    }

    function updateProvider(Request $request){
        // dd($request->all());
        /*
            $request->proReasonsocial_Edit
            $request->proPersonal_id_Edit
            $request->proNumberdocument_Edit
            $request->proNumberregistration_Edit
            $request->proDateregistration_Edit
            $request->proCommerce_Edit
            $request->proDepartment_id_Edit
            $request->proMunicipality_id_Edit
            $request->proZoning_id_Edit
            $request->proNeighborhood_id_Edit
            $request->proCode_Edit
            $request->proAddress_Edit
            $request->proEmail_Edit
            $request->proPhone_Edit
            $request->proMovil_Edit
            $request->proWhatsapp_Edit
            $request->proRepresentativename_Edit
            $request->proRepresentativepersonal_id_Edit
            $request->proRepresentativenumberdocument_Edit
            $request->proBank_Edit
            $request->proTypeaccount_Edit
            $request->proAccountnumber_Edit
            $request->proRegime_Edit
            $request->proTaxpayer_Edit
            $request->proAutoretainer_Edit
            $request->proActivitys_one_Edit
            $request->proActivitys_two_Edit
            $request->proActivitys_three_Edit
            $request->proActivitys_four_Edit
            $request->proId_Edit
        */
        $validateOther = Provider::where('proReasonsocial',$this->fu($request->proReasonsocial_Edit))
                                        ->where('proId','!=',trim($request->proId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Provider::find(trim($request->proId_Edit));
            if($validate != null){
                $nameOld = $validate->proReasonsocial;
                $activitys = '';
                if($request->proActivitys_one_Edit != ''){
                    $activitys .= $request->proActivitys_one_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->proActivitys_two_Edit != ''){
                    $activitys .= $request->proActivitys_two_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->proActivitys_three_Edit != ''){
                    $activitys .= $request->proActivitys_three_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->proActivitys_four_Edit != ''){
                    $activitys .= $request->proActivitys_four_Edit;
                }else{
                    $activitys .= 'N/A';
                }
                $validate->proReasonsocial = $this->fu($request->proReasonsocial_Edit);
                $validate->proPersonal_id = trim($request->proPersonal_id_Edit);
                $validate->proNumberdocument = trim($request->proNumberdocument_Edit);
                $validate->proNumberregistration = trim($request->proNumberregistration_Edit);
                $validate->proDateregistration = trim($request->proDateregistration_Edit);
                $validate->proCommerce = trim($request->proCommerce_Edit);
                $validate->proNeighborhood_id = trim($request->proNeighborhood_id_Edit);
                $validate->proAddress = $this->upper($request->proAddress_Edit);
                $validate->proEmail = $this->lower($request->proEmail_Edit);
                $validate->proPhone = trim($request->proPhone_Edit);
                $validate->proMovil = trim($request->proMovil_Edit);
                $validate->proWhatsapp = trim($request->proWhatsapp_Edit);
                $validate->proRepresentativename = trim($request->proRepresentativename_Edit);
                $validate->proRepresentativepersonal_id = trim($request->proRepresentativepersonal_id_Edit);
                $validate->proRepresentativenumberdocument = trim($request->proRepresentativenumberdocument_Edit);
                $validate->proBank = $this->upper($request->proBank_Edit);
                $validate->proTypeaccount = $this->upper($request->proTypeaccount_Edit);
                $validate->proAccountnumber = $this->upper($request->proAccountnumber_Edit);
                $validate->proRegime = $this->upper($request->proRegime_Edit);
                $validate->proTaxpayer = $this->upper($request->proTaxpayer_Edit);
                $validate->proAutoretainer = $this->upper($request->proAutoretainer_Edit);
                $validate->proActivitys = $activitys;
                $validate->save();
                return redirect()->route('providers.providers')->with('PrimaryProviders', 'Proveedor ' . $this->fu($request->proReasonsocial_Edit) . ', actualizado');
            }else{
                return redirect()->route('providers.providers')->with('SecondaryProviders', 'No se encuentra el proveedor, consulte al administrador');
            }
        }else{
            return redirect()->route('providers.providers')->with('SecondaryProviders', 'Ya existe el proveedor ' . $validateOther->proReasonsocial);
        }
    }

    function deleteProvider(Request $request){
        // dd($request->all());
        $validate = Provider::find(trim($request->proId_Delete));
        if($validate != null){
            $name = $validate->proReasonsocial;
            $validate->delete();
            return redirect()->route('providers.providers')->with('WarningProviders', 'Proveedor ' . $name . ', eliminado');
        }else{
            return redirect()->route('providers.providers')->with('SecondaryProviders', 'No se encuentra el proveedor');
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
