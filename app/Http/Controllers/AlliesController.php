<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Alliesmessenger;
use App\Models\Alliescharge;
use App\Models\Alliesespecial;
use App\Models\Settingpersonal;
use App\Models\Settingdepartment;

class AlliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MENSAJERIA DE ALIADOS
    =============================================================================================== */
    
    function messengersTo(){
        $alliesmessengers = Alliesmessenger::select(
                    'alliesmessenger.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.perName'
                )
                ->join('settingpersonals','settingpersonals.perId','alliesmessenger.amPersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','alliesmessenger.amNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->get();
        $personals = Settingpersonal::all();
        $departments = Settingdepartment::all();
        return view('modules.allies.messengers.index',compact('alliesmessengers','personals','departments'));
    }

    function saveMessenger(Request $request){
        // dd($request->all());
        /*
            $request->amReasonsocial
            $request->amPersonal_id
            $request->amNumberdocument
            $request->amNumberregistration
            $request->amDateregistration
            $request->amCommerce
            $request->amDepartment_id
            $request->amMunicipality_id
            $request->amZoning_id
            $request->amNeighborhood_id
            $request->amCode
            $request->amAddress
            $request->amEmail
            $request->amPhone
            $request->amMovil
            $request->amWhatsapp
            $request->amRepresentativename
            $request->amRepresentativepersonal_id
            $request->amRepresentativenumberdocument
            $request->amBank
            $request->amTypeaccount
            $request->amAccountnumber
            $request->amRegime
            $request->amTaxpayer
            $request->amAutoretainer
            $request->amActivitys_one
            $request->amActivitys_two
            $request->amActivitys_three
            $request->amActivitys_four
        */
        $validate = Alliesmessenger::where('amReasonsocial',$this->fu($request->amReasonsocial))->first();
        if($validate == null){
            $activitys = '';
            if($request->amActivitys_one != ''){
                $activitys .= $request->amActivitys_one . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->amActivitys_two != ''){
                $activitys .= $request->amActivitys_two . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->amActivitys_three != ''){
                $activitys .= $request->amActivitys_three . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->amActivitys_four != ''){
                $activitys .= $request->amActivitys_four;
            }else{
                $activitys .= 'N/A';
            }
            Alliesmessenger::create([
                'amReasonsocial' => $this->fu($request->amReasonsocial),
                'amPersonal_id' => trim($request->amPersonal_id),
                'amNumberdocument' => trim($request->amNumberdocument),
                'amNumberregistration' => trim($request->amNumberregistration),
                'amDateregistration' => trim($request->amDateregistration),
                'amCommerce' => trim($request->amCommerce),
                'amNeighborhood_id' => trim($request->amNeighborhood_id),
                'amAddress' => $this->upper($request->amAddress),
                'amEmail' => $this->lower($request->amEmail),
                'amPhone' => trim($request->amPhone),
                'amMovil' => trim($request->amMovil),
                'amWhatsapp' => trim($request->amWhatsapp),
                'amRepresentativename' => trim($request->amRepresentativename),
                'amRepresentativepersonal_id' => trim($request->amRepresentativepersonal_id),
                'amRepresentativenumberdocument' => trim($request->amRepresentativenumberdocument),
                'amBank' => $this->upper($request->amBank),
                'amTypeaccount' => $this->upper($request->amTypeaccount),
                'amAccountnumber' => $this->upper($request->amAccountnumber),
                'amRegime' => $this->upper($request->amRegime),
                'amTaxpayer' => $this->upper($request->amTaxpayer),
                'amAutoretainer' => $this->upper($request->amAutoretainer),
                'amActivitys' => $activitys
            ]);
            return redirect()->route('allies.messengers')->with('SuccessMessengers', 'Mensajería aliada ' . $this->fu($request->amReasonsocial) . ', registrada');
        }else{
            return redirect()->route('allies.messengers')->with('SecondaryMessengers', 'Ya existe la mensajería aliada ' . $validate->amReasonsocial);
        }
    }

    function updateMessenger(Request $request){
        // dd($request->all());
        /*
            $request->amReasonsocial_Edit
            $request->amPersonal_id_Edit
            $request->amNumberdocument_Edit
            $request->amNumberregistration_Edit
            $request->amDateregistration_Edit
            $request->amCommerce_Edit
            $request->amDepartment_id_Edit
            $request->amMunicipality_id_Edit
            $request->amZoning_id_Edit
            $request->amNeighborhood_id_Edit
            $request->amCode_Edit
            $request->amAddress_Edit
            $request->amEmail_Edit
            $request->amPhone_Edit
            $request->amMovil_Edit
            $request->amWhatsapp_Edit
            $request->amRepresentativename_Edit
            $request->amRepresentativepersonal_id_Edit
            $request->amRepresentativenumberdocument_Edit
            $request->amBank_Edit
            $request->amTypeaccount_Edit
            $request->amAccountnumber_Edit
            $request->amRegime_Edit
            $request->amTaxpayer_Edit
            $request->amAutoretainer_Edit
            $request->amActivitys_one_Edit
            $request->amActivitys_two_Edit
            $request->amActivitys_three_Edit
            $request->amActivitys_four_Edit
            $request->amId_Edit
        */
        $validateOther = Alliesmessenger::where('amReasonsocial',$this->fu($request->amReasonsocial_Edit))
                                        ->where('amId','!=',trim($request->amId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Alliesmessenger::find(trim($request->amId_Edit));
            if($validate != null){
                $nameOld = $validate->amReasonsocial;
                $activitys = '';
                if($request->amActivitys_one_Edit != ''){
                    $activitys .= $request->amActivitys_one_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->amActivitys_two_Edit != ''){
                    $activitys .= $request->amActivitys_two_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->amActivitys_three_Edit != ''){
                    $activitys .= $request->amActivitys_three_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->amActivitys_four_Edit != ''){
                    $activitys .= $request->amActivitys_four_Edit;
                }else{
                    $activitys .= 'N/A';
                }
                $validate->amReasonsocial = $this->fu($request->amReasonsocial_Edit);
                $validate->amPersonal_id = trim($request->amPersonal_id_Edit);
                $validate->amNumberdocument = trim($request->amNumberdocument_Edit);
                $validate->amNumberregistration = trim($request->amNumberregistration_Edit);
                $validate->amDateregistration = trim($request->amDateregistration_Edit);
                $validate->amCommerce = trim($request->amCommerce_Edit);
                $validate->amNeighborhood_id = trim($request->amNeighborhood_id_Edit);
                $validate->amAddress = $this->upper($request->amAddress_Edit);
                $validate->amEmail = $this->lower($request->amEmail_Edit);
                $validate->amPhone = trim($request->amPhone_Edit);
                $validate->amMovil = trim($request->amMovil_Edit);
                $validate->amWhatsapp = trim($request->amWhatsapp_Edit);
                $validate->amRepresentativename = trim($request->amRepresentativename_Edit);
                $validate->amRepresentativepersonal_id = trim($request->amRepresentativepersonal_id_Edit);
                $validate->amRepresentativenumberdocument = trim($request->amRepresentativenumberdocument_Edit);
                $validate->amBank = $this->upper($request->amBank_Edit);
                $validate->amTypeaccount = $this->upper($request->amTypeaccount_Edit);
                $validate->amAccountnumber = $this->upper($request->amAccountnumber_Edit);
                $validate->amRegime = $this->upper($request->amRegime_Edit);
                $validate->amTaxpayer = $this->upper($request->amTaxpayer_Edit);
                $validate->amAutoretainer = $this->upper($request->amAutoretainer_Edit);
                $validate->amActivitys = $activitys;
                $validate->save();
                return redirect()->route('allies.messengers')->with('PrimaryMessengers', 'Mensajería aliada ' . $this->fu($request->amReasonsocial_Edit) . ', actualizada');
            }else{
                return redirect()->route('allies.messengers')->with('SecondaryMessengers', 'No se encuentra la mensajería aliada, consulte al administrador');
            }
        }else{
            return redirect()->route('allies.messengers')->with('SecondaryMessengers', 'Ya existe la mensajería aliada ' . $validateOther->amReasonsocial);
        }
    }

    function deleteMessenger(Request $request){
        // dd($request->all());
        $validate = Alliesmessenger::find(trim($request->amId_Delete));
        if($validate != null){
            $name = $validate->amReasonsocial;
            $validate->delete();
            return redirect()->route('allies.messengers')->with('WarningMessengers', 'Mensajería aliada ' . $name . ', eliminada');
        }else{
            return redirect()->route('allies.messengers')->with('SecondaryMessengers', 'No se encuentra la mensajería aliada');
        }
    }

    /* ===============================================================================================
			MODULO DE CARGA EXPRESS DE ALIADOS
    =============================================================================================== */

    function expressTo(){
        $alliescharges = Alliescharge::select(
                    'alliescharge.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.perName'
                )
                ->join('settingpersonals','settingpersonals.perId','alliescharge.acPersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','alliescharge.acNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->get();
        $personals = Settingpersonal::all();
        $departments = Settingdepartment::all();
        return view('modules.allies.express.index',compact('alliescharges','personals','departments'));
    }

    function saveExpress(Request $request){
        // dd($request->all());
        /*
            $request->acReasonsocial
            $request->acPersonal_id
            $request->acNumberdocument
            $request->acNumberregistration
            $request->acDateregistration
            $request->acCommerce
            $request->acDepartment_id
            $request->acMunicipality_id
            $request->acZoning_id
            $request->acNeighborhood_id
            $request->acCode
            $request->acAddress
            $request->acEmail
            $request->acPhone
            $request->acMovil
            $request->acWhatsapp
            $request->acRepresentativename
            $request->acRepresentativepersonal_id
            $request->acRepresentativenumberdocument
            $request->acBank
            $request->acTypeaccount
            $request->acAccountnumber
            $request->acRegime
            $request->acTaxpayer
            $request->acAutoretainer
            $request->acActivitys_one
            $request->acActivitys_two
            $request->acActivitys_three
            $request->acActivitys_four
        */
        $validate = Alliescharge::where('acReasonsocial',$this->fu($request->acReasonsocial))->first();
        if($validate == null){
            $activitys = '';
            if($request->acActivitys_one != ''){
                $activitys .= $request->acActivitys_one . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->acActivitys_two != ''){
                $activitys .= $request->acActivitys_two . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->acActivitys_three != ''){
                $activitys .= $request->acActivitys_three . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->acActivitys_four != ''){
                $activitys .= $request->acActivitys_four;
            }else{
                $activitys .= 'N/A';
            }
            Alliescharge::create([
                'acReasonsocial' => $this->fu($request->acReasonsocial),
                'acPersonal_id' => trim($request->acPersonal_id),
                'acNumberdocument' => trim($request->acNumberdocument),
                'acNumberregistration' => trim($request->acNumberregistration),
                'acDateregistration' => trim($request->acDateregistration),
                'acCommerce' => trim($request->acCommerce),
                'acNeighborhood_id' => trim($request->acNeighborhood_id),
                'acAddress' => $this->upper($request->acAddress),
                'acEmail' => $this->lower($request->acEmail),
                'acPhone' => trim($request->acPhone),
                'acMovil' => trim($request->acMovil),
                'acWhatsapp' => trim($request->acWhatsapp),
                'acRepresentativename' => trim($request->acRepresentativename),
                'acRepresentativepersonal_id' => trim($request->acRepresentativepersonal_id),
                'acRepresentativenumberdocument' => trim($request->acRepresentativenumberdocument),
                'acBank' => $this->upper($request->acBank),
                'acTypeaccount' => $this->upper($request->acTypeaccount),
                'acAccountnumber' => $this->upper($request->acAccountnumber),
                'acRegime' => $this->upper($request->acRegime),
                'acTaxpayer' => $this->upper($request->acTaxpayer),
                'acAutoretainer' => $this->upper($request->acAutoretainer),
                'acActivitys' => $activitys
            ]);
            return redirect()->route('allies.express')->with('SuccessCharges', 'Carga express aliada ' . $this->fu($request->acReasonsocial) . ', registrada');
        }else{
            return redirect()->route('allies.express')->with('SecondaryCharges', 'Ya existe la carga express aliada ' . $validate->acReasonsocial);
        }
    }

    function updateExpress(Request $request){
        // dd($request->all());
        /*
            $request->acReasonsocial_Edit
            $request->acPersonal_id_Edit
            $request->acNumberdocument_Edit
            $request->acNumberregistration_Edit
            $request->acDateregistration_Edit
            $request->acCommerce_Edit
            $request->acDepartment_id_Edit
            $request->acMunicipality_id_Edit
            $request->acZoning_id_Edit
            $request->acNeighborhood_id_Edit
            $request->acCode_Edit
            $request->acAddress_Edit
            $request->acEmail_Edit
            $request->acPhone_Edit
            $request->acMovil_Edit
            $request->acWhatsapp_Edit
            $request->acRepresentativename_Edit
            $request->acRepresentativepersonal_id_Edit
            $request->acRepresentativenumberdocument_Edit
            $request->acBank_Edit
            $request->acTypeaccount_Edit
            $request->acAccountnumber_Edit
            $request->acRegime_Edit
            $request->acTaxpayer_Edit
            $request->acAutoretainer_Edit
            $request->acActivitys_one_Edit
            $request->acActivitys_two_Edit
            $request->acActivitys_three_Edit
            $request->acActivitys_four_Edit
            $request->acId_Edit
        */
        $validateOther = Alliescharge::where('acReasonsocial',$this->fu($request->acReasonsocial_Edit))
                                        ->where('acId','!=',trim($request->acId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Alliescharge::find(trim($request->acId_Edit));
            if($validate != null){
                $nameOld = $validate->acReasonsocial;
                $activitys = '';
                if($request->acActivitys_one_Edit != ''){
                    $activitys .= $request->acActivitys_one_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->acActivitys_two_Edit != ''){
                    $activitys .= $request->acActivitys_two_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->acActivitys_three_Edit != ''){
                    $activitys .= $request->acActivitys_three_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->acActivitys_four_Edit != ''){
                    $activitys .= $request->acActivitys_four_Edit;
                }else{
                    $activitys .= 'N/A';
                }
                $validate->acReasonsocial = $this->fu($request->acReasonsocial_Edit);
                $validate->acPersonal_id = trim($request->acPersonal_id_Edit);
                $validate->acNumberdocument = trim($request->acNumberdocument_Edit);
                $validate->acNumberregistration = trim($request->acNumberregistration_Edit);
                $validate->acDateregistration = trim($request->acDateregistration_Edit);
                $validate->acCommerce = trim($request->acCommerce_Edit);
                $validate->acNeighborhood_id = trim($request->acNeighborhood_id_Edit);
                $validate->acAddress = $this->upper($request->acAddress_Edit);
                $validate->acEmail = $this->lower($request->acEmail_Edit);
                $validate->acPhone = trim($request->acPhone_Edit);
                $validate->acMovil = trim($request->acMovil_Edit);
                $validate->acWhatsapp = trim($request->acWhatsapp_Edit);
                $validate->acRepresentativename = trim($request->acRepresentativename_Edit);
                $validate->acRepresentativepersonal_id = trim($request->acRepresentativepersonal_id_Edit);
                $validate->acRepresentativenumberdocument = trim($request->acRepresentativenumberdocument_Edit);
                $validate->acBank = $this->upper($request->acBank_Edit);
                $validate->acTypeaccount = $this->upper($request->acTypeaccount_Edit);
                $validate->acAccountnumber = $this->upper($request->acAccountnumber_Edit);
                $validate->acRegime = $this->upper($request->acRegime_Edit);
                $validate->acTaxpayer = $this->upper($request->acTaxpayer_Edit);
                $validate->acAutoretainer = $this->upper($request->acAutoretainer_Edit);
                $validate->acActivitys = $activitys;
                $validate->save();
                return redirect()->route('allies.express')->with('PrimaryCharges', 'Carga express aliada ' . $this->fu($request->acReasonsocial_Edit) . ', actualizada');
            }else{
                return redirect()->route('allies.express')->with('SecondaryCharges', 'No se encuentra la carga express aliada, consulte al administrador');
            }
        }else{
            return redirect()->route('allies.express')->with('SecondaryCharges', 'Ya existe la carga express aliada ' . $validateOther->acReasonsocial);
        }
    }

    function deleteExpress(Request $request){
        // dd($request->all());
        $validate = Alliescharge::find(trim($request->acId_Delete));
        if($validate != null){
            $name = $validate->acReasonsocial;
            $validate->delete();
            return redirect()->route('allies.express')->with('WarningCharges', 'Carga express aliada ' . $name . ', eliminada');
        }else{
            return redirect()->route('allies.express')->with('SecondaryCharges', 'No se encuentra la carga express aliada');
        }
    }

    /* ===============================================================================================
			MODULO DE SERVICIOS ESPECIALES DE ALIADOS
    =============================================================================================== */

    function servicesTo(){
        $alliesespecials = Alliesespecial::select(
                    'alliesespecial.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.perName'
                )
                ->join('settingpersonals','settingpersonals.perId','alliesespecial.aePersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','alliesespecial.aeNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->get();
        $personals = Settingpersonal::all();
        $departments = Settingdepartment::all();
        return view('modules.allies.services.index',compact('alliesespecials','personals','departments'));
    }

    function saveService(Request $request){
        // dd($request->all());
        /*
            $request->aeReasonsocial
            $request->aePersonal_id
            $request->aeNumberdocument
            $request->aeNumberregistration
            $request->aeDateregistration
            $request->aeCommerce
            $request->aeDepartment_id
            $request->aeMunicipality_id
            $request->aeZoning_id
            $request->aeNeighborhood_id
            $request->aeCode
            $request->aeAddress
            $request->aeEmail
            $request->aePhone
            $request->aeMovil
            $request->aeWhatsapp
            $request->aeRepresentativename
            $request->aeRepresentativepersonal_id
            $request->aeRepresentativenumberdocument
            $request->aeBank
            $request->aeTypeaccount
            $request->aeAccountnumber
            $request->aeRegime
            $request->aeTaxpayer
            $request->aeAutoretainer
            $request->aeActivitys_one
            $request->aeActivitys_two
            $request->aeActivitys_three
            $request->aeActivitys_four
        */
        $validate = Alliesespecial::where('aeReasonsocial',$this->fu($request->aeReasonsocial))->first();
        if($validate == null){
            $activitys = '';
            if($request->aeActivitys_one != ''){
                $activitys .= $request->aeActivitys_one . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->aeActivitys_two != ''){
                $activitys .= $request->aeActivitys_two . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->aeActivitys_three != ''){
                $activitys .= $request->aeActivitys_three . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->aeActivitys_four != ''){
                $activitys .= $request->aeActivitys_four;
            }else{
                $activitys .= 'N/A';
            }
            Alliesespecial::create([
                'aeReasonsocial' => $this->fu($request->aeReasonsocial),
                'aePersonal_id' => trim($request->aePersonal_id),
                'aeNumberdocument' => trim($request->aeNumberdocument),
                'aeNumberregistration' => trim($request->aeNumberregistration),
                'aeDateregistration' => trim($request->aeDateregistration),
                'aeCommerce' => trim($request->aeCommerce),
                'aeNeighborhood_id' => trim($request->aeNeighborhood_id),
                'aeAddress' => $this->upper($request->aeAddress),
                'aeEmail' => $this->lower($request->aeEmail),
                'aePhone' => trim($request->aePhone),
                'aeMovil' => trim($request->aeMovil),
                'aeWhatsapp' => trim($request->aeWhatsapp),
                'aeRepresentativename' => trim($request->aeRepresentativename),
                'aeRepresentativepersonal_id' => trim($request->aeRepresentativepersonal_id),
                'aeRepresentativenumberdocument' => trim($request->aeRepresentativenumberdocument),
                'aeBank' => $this->upper($request->aeBank),
                'aeTypeaccount' => $this->upper($request->aeTypeaccount),
                'aeAccountnumber' => $this->upper($request->aeAccountnumber),
                'aeRegime' => $this->upper($request->aeRegime),
                'aeTaxpayer' => $this->upper($request->aeTaxpayer),
                'aeAutoretainer' => $this->upper($request->aeAutoretainer),
                'aeActivitys' => $activitys
            ]);
            return redirect()->route('allies.services')->with('SuccessEspecials', 'Servicio especial aliado ' . $this->fu($request->aeReasonsocial) . ', registrado');
        }else{
            return redirect()->route('allies.services')->with('SecondaryEspecials', 'Ya existe el servicio especial aliado ' . $validate->aeReasonsocial);
        }
    }

    function updateService(Request $request){
        // dd($request->all());
        /*
            $request->aeReasonsocial_Edit
            $request->aePersonal_id_Edit
            $request->aeNumberdocument_Edit
            $request->aeNumberregistration_Edit
            $request->aeDateregistration_Edit
            $request->aeCommerce_Edit
            $request->aeDepartment_id_Edit
            $request->aeMunicipality_id_Edit
            $request->aeZoning_id_Edit
            $request->aeNeighborhood_id_Edit
            $request->aeCode_Edit
            $request->aeAddress_Edit
            $request->aeEmail_Edit
            $request->aePhone_Edit
            $request->aeMovil_Edit
            $request->aeWhatsapp_Edit
            $request->aeRepresentativename_Edit
            $request->aeRepresentativepersonal_id_Edit
            $request->aeRepresentativenumberdocument_Edit
            $request->aeBank_Edit
            $request->aeTypeaccount_Edit
            $request->aeAccountnumber_Edit
            $request->aeRegime_Edit
            $request->aeTaxpayer_Edit
            $request->aeAutoretainer_Edit
            $request->aeActivitys_one_Edit
            $request->aeActivitys_two_Edit
            $request->aeActivitys_three_Edit
            $request->aeActivitys_four_Edit
            $request->aeId_Edit
        */
        $validateOther = Alliesespecial::where('aeReasonsocial',$this->fu($request->aeReasonsocial_Edit))
                                        ->where('aeId','!=',trim($request->aeId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Alliesespecial::find(trim($request->aeId_Edit));
            if($validate != null){
                $nameOld = $validate->aeReasonsocial;
                $activitys = '';
                if($request->aeActivitys_one_Edit != ''){
                    $activitys .= $request->aeActivitys_one_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->aeActivitys_two_Edit != ''){
                    $activitys .= $request->aeActivitys_two_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->aeActivitys_three_Edit != ''){
                    $activitys .= $request->aeActivitys_three_Edit . '-';
                }else{
                    $activitys .= 'N/A-';
                }
                if($request->aeActivitys_four_Edit != ''){
                    $activitys .= $request->aeActivitys_four_Edit;
                }else{
                    $activitys .= 'N/A';
                }
                $validate->aeReasonsocial = $this->fu($request->aeReasonsocial_Edit);
                $validate->aePersonal_id = trim($request->aePersonal_id_Edit);
                $validate->aeNumberdocument = trim($request->aeNumberdocument_Edit);
                $validate->aeNumberregistration = trim($request->aeNumberregistration_Edit);
                $validate->aeDateregistration = trim($request->aeDateregistration_Edit);
                $validate->aeCommerce = trim($request->aeCommerce_Edit);
                $validate->aeNeighborhood_id = trim($request->aeNeighborhood_id_Edit);
                $validate->aeAddress = $this->upper($request->aeAddress_Edit);
                $validate->aeEmail = $this->lower($request->aeEmail_Edit);
                $validate->aePhone = trim($request->aePhone_Edit);
                $validate->aeMovil = trim($request->aeMovil_Edit);
                $validate->aeWhatsapp = trim($request->aeWhatsapp_Edit);
                $validate->aeRepresentativename = trim($request->aeRepresentativename_Edit);
                $validate->aeRepresentativepersonal_id = trim($request->aeRepresentativepersonal_id_Edit);
                $validate->aeRepresentativenumberdocument = trim($request->aeRepresentativenumberdocument_Edit);
                $validate->aeBank = $this->upper($request->aeBank_Edit);
                $validate->aeTypeaccount = $this->upper($request->aeTypeaccount_Edit);
                $validate->aeAccountnumber = $this->upper($request->aeAccountnumber_Edit);
                $validate->aeRegime = $this->upper($request->aeRegime_Edit);
                $validate->aeTaxpayer = $this->upper($request->aeTaxpayer_Edit);
                $validate->aeAutoretainer = $this->upper($request->aeAutoretainer_Edit);
                $validate->aeActivitys = $activitys;
                $validate->save();
                return redirect()->route('allies.services')->with('PrimaryEspecials', 'Servicio especial aliado ' . $this->fu($request->aeReasonsocial_Edit) . ', actualizado');
            }else{
                return redirect()->route('allies.services')->with('SecondaryEspecials', 'No se encuentra el servicio especial aliado, consulte al administrador');
            }
        }else{
            return redirect()->route('allies.services')->with('SecondaryEspecials', 'Ya existe el servicio especial aliado ' . $validateOther->aeReasonsocial);
        }
    }

    function deleteService(Request $request){
        // dd($request->all());
        $validate = Alliesespecial::find(trim($request->aeId_Delete));
        if($validate != null){
            $name = $validate->aeReasonsocial;
            $validate->delete();
            return redirect()->route('allies.services')->with('WarningEspecials', 'Servicio especial aliado ' . $name . ', eliminado');
        }else{
            return redirect()->route('allies.services')->with('SecondaryEspecials', 'No se encuentra el servicio especial aliado');
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
