<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Settinglegal;
use App\Models\Settingfinancial;
use App\Models\Settingtechnical;
use App\Models\Settingpersonal;
use App\Models\Settingdepartment;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE INFORMACION JURIDICA
    =============================================================================================== */
    
    function legalTo(){
        $legal = Settinglegal::select(
                    'settinglegals.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.perName'
                )
                ->join('settingpersonals','settingpersonals.perId','settinglegals.lePersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','settinglegals.leNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->first();
        $personals = Settingpersonal::all();
        $deparments = Settingdepartment::all();
        return view('modules.company.legal.index',compact('legal','personals','deparments'));
    }

    function saveLegals(Request $request){
        // dd($request->all());
        $validate = Settinglegal::where('leReasonsocial',$this->fu($request->leReasonsocial))
                                    ->where('leNumberdocument',$this->upper($request->leNumberdocument))
                                    ->where('leNumberregistration',$this->upper($request->leNumberregistration))
                                    ->first();
        if($validate == null){
            Settinglegal::create([
                'leReasonsocial' => $this->fu($request->leReasonsocial),
                'lePersonal_id' => trim($request->lePersonal_id),
                'leNumberdocument' => $this->upper($request->leNumberdocument),
                'leNumberregistration' => $this->upper($request->leNumberregistration),
                'leDateregistration' => trim($request->leDateregistration),
                'leCommerce' => $this->upper($request->leCommerce),
                'leNeighborhood_id' => trim($request->leNeighborhood_id),
                'leAddress' => $this->upper($request->leAddress),
                'leEmail' => $this->lower($request->leEmail),
                'lePhone' => trim($request->lePhone),
                'leMovil' => trim($request->leMovil),
                'leWhatsapp' => trim($request->leWhatsapp),
                'leRepresentativename' => $this->fu($request->leRepresentativename),
                'leRepresentativepersonal_id' => trim($request->leRepresentativepersonal_id),
                'leRepresentativenumberdocument' => $this->upper($request->leRepresentativenumberdocument)
            ]);
            return redirect()->route('company.legal')->with('SuccessLegal', 'Información jurídica de ' . $this->fu($request->leReasonsocial) . ', registrada');
        }else{
            return redirect()->route('company.legal')->with('SecondaryLegal', 'Ya existe la información juridica de ' . $validate->leReasonsocial);
        }
    }

    function updateLegals(Request $request){
        // dd($request->all());
        $validateOther = Settinglegal::where('leReasonsocial',$this->fu($request->leReasonsocial_Edit))
                                        ->where('leNumberdocument',$this->upper($request->leNumberdocument_Edit))
                                        ->where('leNumberregistration',$this->upper($request->leNumberregistration_Edit))
                                        ->where('leId','!=',trim($request->leId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Settinglegal::find(trim($request->leId_Edit));
            if($validate != null){
                $validate->leReasonsocial = $this->fu($request->leReasonsocial_Edit);
                $validate->lePersonal_id = trim($request->lePersonal_id_Edit);
                $validate->leNumberdocument = $this->upper($request->leNumberdocument_Edit);
                $validate->leNumberregistration = $this->upper($request->leNumberregistration_Edit);
                $validate->leDateregistration = trim($request->leDateregistration_Edit);
                $validate->leCommerce = $this->upper($request->leCommerce_Edit);
                $validate->leNeighborhood_id = trim($request->leNeighborhood_id_Edit);
                $validate->leAddress = $this->upper($request->leAddress_Edit);
                $validate->leEmail = $this->lower($request->leEmail_Edit);
                $validate->lePhone = trim($request->lePhone_Edit);
                $validate->leMovil = trim($request->leMovil_Edit);
                $validate->leWhatsapp = trim($request->leWhatsapp_Edit);
                $validate->leRepresentativename = $this->fu($request->leRepresentativename_Edit);
                $validate->leRepresentativepersonal_id = trim($request->leRepresentativepersonal_id_Edit);
                $validate->leRepresentativenumberdocument = $this->upper($request->leRepresentativenumberdocument_Edit);
                $validate->save();
                return redirect()->route('company.legal')->with('PrimaryLegal', 'Información jurídica de ' . $this->fu($request->leReasonsocial_Edit) . ', actualizada');
            }else{
                return redirect()->route('company.legal')->with('SecondaryLegal', 'No se encuentra la información jurídica, consulte al administrador');
            }
        }else{
            return redirect()->route('company.legal')->with('SecondaryLegal', 'Ya existe la información jurídica de ' . $validateOther->leReasonsocial . ', consulte al administrador');
        }
    }

    function deleteLegals(Request $request){
        // dd($request->all());
        $validate = Settinglegal::find(trim($request->leId_Delete));
        if($validate != null){
            $name = $validate->leReasonsocial;
            $validate->delete();
            return redirect()->route('company.legal')->with('WarningLegal', 'Información jurídica de ' . $name . ', eliminada');
        }else{
            return redirect()->route('company.legal')->with('SecondaryLegal', 'No se encuentra la información jurídica, Consulte con el administrador');
        }
    }

    /* ===============================================================================================
			MODULO DE INFORMACION FINANCIERA
    =============================================================================================== */

    function financialTo(){
        $financial = Settingfinancial::first();
        return view('modules.company.financial.index', compact('financial'));
    }

    function saveFinancials(Request $request){
        // dd($request->all());
        /*
            fiRegime
            fiTaxpayer
            fiAutoretainer
            fiActivitys_one
            fiActivitys_two
            fiActivitys_three
            fiActivitys_four
            fiResolutionfacturation
            fiDateresolutionfacturation
            fiMountcountresolution
            fiDatefallresolution
            fiPrefix
            fiNumberinitial
            fiNumberfinal
            fiBank
            fiTypeaccount
            fiAccountnumber
            fiNotesone
            fiNotestwo
            fiNumberinitialfacturation
            fiNumberinitialvoucherentry
            fiNumberinitialvoucheregress
            fiCapitalwork
            fiHeritage
            fiIndexsettlement
            fiIndexdebt
            fiReasoncoverage
            fiProfitabilityheritage
            fiProfitabilityactives
        */
        if($request->fiNumberinitial < $request->fiNumberfinal){
            $activitys = '';
            if($request->fiActivitys_one != ''){
                $activitys .= $request->fiActivitys_one . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->fiActivitys_two != ''){
                $activitys .= $request->fiActivitys_two . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->fiActivitys_three != ''){
                $activitys .= $request->fiActivitys_three . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->fiActivitys_four != ''){
                $activitys .= $request->fiActivitys_four;
            }else{
                $activitys .= 'N/A';
            }
            if($request->hasFile('fiBanklogo')){
                $banklogo = $request->file('fiBanklogo');
                $namelogo = $banklogo->getClientOriginalName();
                Storage::disk('opensoft')->putFileAs('infoCompany/bank',$banklogo,$namelogo);
                Settingfinancial::create([
                    'fiRegime' => trim($request->fiRegime),
                    'fiTaxpayer' => trim($request->fiTaxpayer),
                    'fiAutoretainer' => trim($request->fiAutoretainer),
                    'fiActivitys' => $activitys,
                    'fiResolutionfacturation' => trim($request->fiResolutionfacturation),
                    'fiDateresolutionfacturation' => trim($request->fiDateresolutionfacturation),
                    'fiMountcountresolution' => trim($request->fiMountcountresolution),
                    'fiDatefallresolution' => trim($request->fiDatefallresolution),
                    'fiPrefix' => $this->upper($request->fiPrefix),
                    'fiNumberinitial' => trim($request->fiNumberinitial),
                    'fiNumberfinal' => trim($request->fiNumberfinal),
                    'fiBank' => $this->upper($request->fiBank),
                    'fiBanklogo' => $namelogo,
                    'fiTypeaccount' => trim($request->fiTypeaccount),
                    'fiAccountnumber' => trim($request->fiAccountnumber),
                    'fiNotesone' => $this->fu($request->fiNotesone),
                    'fiNotestwo' => $this->fu($request->fiNotestwo),
                    'fiNumberinitialfacturation' => $this->upper($request->fiNumberinitialfacturation),
                    'fiNumberinitialvoucherentry' => $this->upper($request->fiNumberinitialvoucherentry),
                    'fiNumberinitialvoucheregress' => $this->upper($request->fiNumberinitialvoucheregress),
                    'fiCapitalwork' => trim($request->fiCapitalwork),
                    'fiHeritage' => trim($request->fiHeritage),
                    'fiIndexsettlement' => number_format(trim($request->fiIndexsettlement),2),
                    'fiIndexdebt' => number_format(trim($request->fiIndexdebt),2),
                    'fiReasoncoverage' => number_format(trim($request->fiReasoncoverage),2),
                    'fiProfitabilityheritage' => number_format(trim($request->fiProfitabilityheritage),2),
                    'fiProfitabilityactives' => number_format(trim($request->fiProfitabilityactives),2)
                ]);
            }else{
                Settingfinancial::create([
                    'fiRegime' => trim($request->fiRegime),
                    'fiTaxpayer' => trim($request->fiTaxpayer),
                    'fiAutoretainer' => trim($request->fiAutoretainer),
                    'fiActivitys' => $activitys,
                    'fiResolutionfacturation' => trim($request->fiResolutionfacturation),
                    'fiDateresolutionfacturation' => trim($request->fiDateresolutionfacturation),
                    'fiMountcountresolution' => trim($request->fiMountcountresolution),
                    'fiDatefallresolution' => trim($request->fiDatefallresolution),
                    'fiPrefix' => $this->upper($request->fiPrefix),
                    'fiNumberinitial' => trim($request->fiNumberinitial),
                    'fiNumberfinal' => trim($request->fiNumberfinal),
                    'fiBank' => $this->upper($request->fiBank),
                    'fiTypeaccount' => trim($request->fiTypeaccount),
                    'fiAccountnumber' => trim($request->fiAccountnumber),
                    'fiNotesone' => $this->fu($request->fiNotesone),
                    'fiNotestwo' => $this->fu($request->fiNotestwo),
                    'fiNumberinitialfacturation' => $this->upper($request->fiNumberinitialfacturation),
                    'fiNumberinitialvoucherentry' => $this->upper($request->fiNumberinitialvoucherentry),
                    'fiNumberinitialvoucheregress' => $this->upper($request->fiNumberinitialvoucheregress),
                    'fiCapitalwork' => trim($request->fiCapitalwork),
                    'fiHeritage' => trim($request->fiHeritage),
                    'fiIndexsettlement' => number_format(trim($request->fiIndexsettlement),2),
                    'fiIndexdebt' => number_format(trim($request->fiIndexdebt),2),
                    'fiReasoncoverage' => number_format(trim($request->fiReasoncoverage),2),
                    'fiProfitabilityheritage' => number_format(trim($request->fiProfitabilityheritage),2),
                    'fiProfitabilityactives' => number_format(trim($request->fiProfitabilityactives),2)
                ]);
            }
            return redirect()->route('company.financial')->with('SuccessFinancial', 'Información financiera, registrada');
        }else{
            return redirect()->route('company.financial')->with('SecondaryFinancial', 'Error en coherencia de datos, asegurese de ingresar la información correcta');
        }
    }

    function updateFinancials(Request $request){
        // dd($request->all());
        /*
            $request->fiRegime_Edit 
            $request->fiTaxpayer_Edit   
            $request->fiAutoretainer_Edit   
            $request->fiActivitys_one_Edit  
            $request->fiActivitys_two_Edit  
            $request->fiActivitys_three_Edit    
            $request->fiActivitys_four_Edit 
            $request->fiResolutionfacturation_Edit  
            $request->fiDateresolutionfacturation_Edit
            $request->fiMountcountresolution_Edit   
            $request->fiDatefallresolution_Edit
            $request->fiPrefix_Edit 
            $request->fiNumberinitial_Edit  
            $request->fiNumberfinal_Edit    
            $request->fiBank_Edit   
            $request->fiTypeaccount_Edit    
            $request->fiAccountnumber_Edit  
            $request->fiNotesone_Edit
            $request->fiNotestwo_Edit
            $request->fiNumberinitialfacturation_Edit   
            $request->fiNumberinitialvoucherentry_Edit  
            $request->fiNumberinitialvoucheregress_Edit 
            $request->fiCapitalwork_Edit    
            $request->fiHeritage_Edit   
            $request->fiIndexsettlement_Edit
            $request->fiIndexdebt_Edit
            $request->fiReasoncoverage_Edit
            $request->fiProfitabilityheritage_Edit
            $request->fiProfitabilityactives_Edit
            $request->fiId_Edit 
        */
        if($request->fiNumberinitial_Edit < $request->fiNumberfinal_Edit){
            $activitys = '';
            if($request->fiActivitys_one_Edit != ''){
                $activitys .= $request->fiActivitys_one_Edit . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->fiActivitys_two_Edit != ''){
                $activitys .= $request->fiActivitys_two_Edit . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->fiActivitys_three_Edit != ''){
                $activitys .= $request->fiActivitys_three_Edit . '-';
            }else{
                $activitys .= 'N/A-';
            }
            if($request->fiActivitys_four_Edit != ''){
                $activitys .= $request->fiActivitys_four_Edit;
            }else{
                $activitys .= 'N/A';
            }
            $validate = Settingfinancial::find(trim($request->fiId_Edit));
            if($validate != null){
                $namelogofinal = 'banklogoDefault.png';
                if($request->hasFile('fiBanklogo_Edit')){
                    $banklogo = $request->file('fiBanklogo_Edit');
                    $namelogo = $banklogo->getClientOriginalName();
                    if($validate->fiBanklogo != 'banklogoDefault.png'){
                        Storage::disk('opensoft')->delete('infoCompany/bank/'.$validate->fiBanklogo);
                    }
                    Storage::disk('opensoft')->putFileAs('infoCompany/bank',$banklogo,$namelogo);
                    $namelogofinal = $namelogo;
                }
                $validate->fiRegime = trim($request->fiRegime_Edit);
                $validate->fiTaxpayer = trim($request->fiTaxpayer_Edit);
                $validate->fiAutoretainer = trim($request->fiAutoretainer_Edit);
                $validate->fiActivitys = $activitys;
                $validate->fiResolutionfacturation = trim($request->fiResolutionfacturation_Edit);
                $validate->fiDateresolutionfacturation = trim($request->fiDateresolutionfacturation_Edit);
                $validate->fiMountcountresolution = trim($request->fiMountcountresolution_Edit);
                $validate->fiDatefallresolution = trim($request->fiDatefallresolution_Edit);
                $validate->fiPrefix = $this->upper($request->fiPrefix_Edit);
                $validate->fiNumberinitial = trim($request->fiNumberinitial_Edit);
                $validate->fiNumberfinal = trim($request->fiNumberfinal_Edit);
                $validate->fiBank = $this->upper($request->fiBank_Edit);
                $validate->fiBanklogo = $namelogofinal;
                $validate->fiTypeaccount = trim($request->fiTypeaccount_Edit);
                $validate->fiAccountnumber = trim($request->fiAccountnumber_Edit);
                $validate->fiNotesone = $this->fu($request->fiNotesone_Edit);
                $validate->fiNotestwo = $this->fu($request->fiNotestwo_Edit);
                $validate->fiNumberinitialfacturation = $this->upper($request->fiNumberinitialfacturation_Edit);
                $validate->fiNumberinitialvoucherentry = $this->upper($request->fiNumberinitialvoucherentry_Edit);
                $validate->fiNumberinitialvoucheregress = $this->upper($request->fiNumberinitialvoucheregress_Edit);
                $validate->fiCapitalwork = trim($request->fiCapitalwork_Edit);
                $validate->fiHeritage = trim($request->fiHeritage_Edit);
                $validate->fiIndexsettlement = number_format(trim($request->fiIndexsettlement_Edit),2);
                $validate->fiIndexdebt = number_format(trim($request->fiIndexdebt_Edit),2);
                $validate->fiReasoncoverage = number_format(trim($request->fiReasoncoverage_Edit),2);
                $validate->fiProfitabilityheritage = number_format(trim($request->fiProfitabilityheritage_Edit),2);
                $validate->fiProfitabilityactives = number_format(trim($request->fiProfitabilityactives_Edit),2);
                $validate->save();
                // dd(number_format(trim($request->fiIndexsettlement_Edit),2));
                return redirect()->route('company.financial')->with('PrimaryFinancial', 'Información financiera, actualizada');
            }else{
                return redirect()->route('company.financial')->with('SecondaryFinancial', 'No se encuentra la información financiera');
            }
        }else{
            return redirect()->route('company.financial')->with('SecondaryFinancial', 'Error en coherencia de datos, asegurese de ingresar la información correcta para actualizar');
        }
    }

    function deleteFinancials(Request $request){
        // dd($request->all());
        $validate = Settingfinancial::find(trim($request->fiId_Delete));
        if($validate != null){
            if($validate->fiBanklogo != 'banklogoDefault.png'){
                Storage::disk('opensoft')->delete('infoCompany/bank/'.$validate->fiBanklogo);
            }
            $validate->delete();
            return redirect()->route('company.financial')->with('WarningFinancial', 'Información financiera, eliminada');
        }else{
            return redirect()->route('company.financial')->with('SecondaryFinancial', 'No se encuentra la información financiera');
        }
    }

    /* ===============================================================================================
			MODULO DE INFORMACION TECNICA
    =============================================================================================== */

    function technicalTo(){
        $technical = Settingtechnical::first();

        $certifications = array();
        if($technical != null){
            $separatedCertificated = explode('<=>', $technical->teCertificate);
            for ($i=0; $i < count($separatedCertificated); $i++) { 
                array_push($certifications,$separatedCertificated[$i]);
            }
        }
        return view('modules.company.technical.index', compact('technical','certifications'));
    }

    function saveTechnical(Request $request){
        // dd($request->all());
        /*
            $request->teResolutiontransport
            $request->teDateresolutiontransport
            $request->teResolutioncapacity
            $request->teDateresolutioncapacity
            $request->certificated
            $request->teNoteonecertificate
            $request->teNotetwocertificate
            $request->teCertificate
            $request->teCodeqr
            $request->teLogotransport
            $request->teLogocompany
        */
        if(isset($request->teResolutiontransport)){
            $certifications = substr(trim($request->teCertificate),0,-3); // QUITAR LOS ULTIMOS 3 CARACTERES (<=>)
            $namecodefinal = 'codeTecnicalDefault.png';
            $namelogotransportfinal = 'logoTecnicalDefault.png';
            $namelogocompanyfinal = 'logoTecnicalDefault.png';
            if($request->hasFile('teCodeqr')){
                $code = $request->file('teCodeqr');
                $namecode = $code->getClientOriginalName();
                Storage::disk('opensoft')->putFileAs('infoCompany/technical/code/',$code,$namecode);
                $namecodefinal = $namecode;
            }
            if($request->hasFile('teLogotransport')){
                $logotransport = $request->file('teLogotransport');
                $namelogotransport = $logotransport->getClientOriginalName();
                Storage::disk('opensoft')->putFileAs('infoCompany/technical/transport/',$logotransport,$namelogotransport);
                $namelogotransportfinal = $namelogotransport;
            }
            // if($request->hasFile('teLogocompany')){
            //     $logocompany = $request->file('teLogocompany');
            //     $namelogocompany = $logocompany->getClientOriginalName();
            //     Storage::disk('opensoft')->putFileAs('infoCompany/technical/company/',$logocompany,$namelogocompany);
            //     $namelogocompanyfinal = $namelogocompany;
            // }
            Settingtechnical::create([
                'teResolutiontransport' => trim($request->teResolutiontransport),
                'teDateresolutiontransport' => trim($request->teDateresolutiontransport),
                'teResolutioncapacity' => trim($request->teResolutioncapacity),
                'teDateresolutioncapacity' => trim($request->teDateresolutioncapacity),
                'teCertificate' => $certifications,
                'teNoteonecertificate' => $this->fu($request->teNoteonecertificate),
                'teNotetwocertificate' => $this->fu($request->teNotetwocertificate),
                'teCodeqr' => $namecodefinal,
                'teLogotransport' => $namelogotransportfinal,
                'teLogocompany' => $namelogocompanyfinal
            ]);
            return redirect()->route('company.technical')->with('SuccessTechnical', 'Información técnica, registrada');
        }else{
            return redirect()->route('company.technical')->with('SecondaryTechnical', 'Al menos el primer campo debe tener información para procesar el registro, no se ha guardado la información');
        }
    }

    function updateTechnical(Request $request){
        // dd($request->all());
        /*
            $request->teResolutiontransport_Edit
            $request->teDateresolutiontransport_Edit
            $request->teResolutioncapacity_Edit
            $request->teDateresolutioncapacity_Edit
            $request->certificated
            $request->teNoteonecertificate_Edit
            $request->teNotetwocertificate_Edit
            $request->teCertificate_Edit
            $request->teId_Edit
            $request->teCodeqr_Edit
            $request->teCodeqrnot_Edit
            $request->teLogotransport_Edit
            $request->teLogotransportnot_Edit
            $request->teLogocompany_Edit
            $request->teLogocompanynot_Edit
        */
        $validate = Settingtechnical::find(trim($request->teId_Edit));
        if($validate != null){
            $certifications = substr(trim($request->teCertificate_Edit),0,-3); // QUITAR LOS ULTIMOS 3 CARACTERES (<=>)
            $namecodefinal = $validate->teCodeqr;
            $namelogotransportfinal = $validate->teLogotransport;
            $namelogocompanyfinal = $validate->teLogocompany;
            // VALIDACION DE IMAGEN DE CODIGO QR
            if(!isset($request->teCodeqrnot_Edit)){
                if($request->hasFile('teCodeqr_Edit')){
                    $code = $request->file('teCodeqr_Edit');
                    $namecode = $code->getClientOriginalName();
                    if($validate->teCodeqr != 'codeTecnicalDefault.png'){
                        Storage::disk('opensoft')->delete('infoCompany/technical/code/'.$validate->teCodeqr);
                    }
                    Storage::disk('opensoft')->putFileAs('infoCompany/technical/code/',$code,$namecode);
                    $namecodefinal = $namecode;
                }
            }else{
                if($validate->teCodeqr != 'codeTecnicalDefault.png'){
                    Storage::disk('opensoft')->delete('infoCompany/technical/code/'.$validate->teCodeqr);
                }
                $namecodefinal = 'codeTecnicalDefault.png';
            }
            // VALIDACION DE IMAGEN DE LOGO DE SUPERTRANSPORTE
            if(!isset($request->teLogotransportnot_Edit)){
                if($request->hasFile('teLogotransport_Edit')){
                    $logotransport = $request->file('teLogotransport_Edit');
                    $namelogotransport = $logotransport->getClientOriginalName();
                    if($validate->teLogotransport != 'logoTecnicalDefault.png'){
                        Storage::disk('opensoft')->delete('infoCompany/technical/transport/'.$validate->teLogotransport);
                    }
                    Storage::disk('opensoft')->putFileAs('infoCompany/technical/transport/',$logotransport,$namelogotransport);
                    $namelogotransportfinal = $namelogotransport;
                }
            }else{
                if($validate->teLogotransport != 'logoTecnicalDefault.png'){
                    Storage::disk('opensoft')->delete('infoCompany/technical/transport/'.$validate->teLogotransport);
                }
                $namelogotransportfinal = 'logoTecnicalDefault.png';
            }
            // VALIDACION DE IMAGEN DE LOGO DE EMPRESA
            // if(!isset($request->teLogocompanynot_Edit)){
            //     if($request->hasFile('teLogocompany_Edit')){
            //         $logocompany = $request->file('teLogocompany_Edit');
            //         $namelogocompany = $logocompany->getClientOriginalName();
            //         if($validate->teLogocompany != 'logoTecnicalDefault.png'){
            //             Storage::disk('opensoft')->delete('infoCompany/technical/company/'.$validate->teLogocompany);
            //         }
            //         Storage::disk('opensoft')->putFileAs('infoCompany/technical/company/',$logocompany,$namelogocompany);
            //         $namelogocompanyfinal = $namelogocompany;
            //     }
            // }else{
            //     if($validate->teLogocompany != 'logoTecnicalDefault.png'){
            //         Storage::disk('opensoft')->delete('infoCompany/technical/company/'.$validate->teLogocompany);
            //     }
            //     $namelogocompanyfinal = 'logoTecnicalDefault.png';
            // }
            $validate->teResolutiontransport = trim($request->teResolutiontransport_Edit);
            $validate->teDateresolutiontransport = trim($request->teDateresolutiontransport_Edit);
            $validate->teResolutioncapacity = trim($request->teResolutioncapacity_Edit);
            $validate->teDateresolutioncapacity = trim($request->teDateresolutioncapacity_Edit);
            $validate->teCertificate = $certifications;
            $validate->teNoteonecertificate = $this->fu($request->teNoteonecertificate_Edit);
            $validate->teNotetwocertificate = $this->fu($request->teNotetwocertificate_Edit);
            $validate->teCodeqr = $namecodefinal;
            $validate->teLogotransport = $namelogotransportfinal;
            // $validate->teLogocompany = $namelogocompanyfinal;
            $validate->save();
            return redirect()->route('company.technical')->with('PrimaryTechnical', 'Información técnica, actualizada');
        }else{
            return redirect()->route('company.technical')->with('SecondaryTechnical', 'No se encuentra la información técnica');
        }
    }

    function deleteTechnical(Request $request){
        // dd($request->all());
        /*
            $request->teId_Delete
        */
        $validate = Settingtechnical::find(trim($request->teId_Delete));
        if($validate != null){
            if($validate->teCodeqr != 'codeTecnicalDefault.png'){
                Storage::disk('opensoft')->delete('infoCompany/technical/code/'.$validate->teCodeqr);
            }
            if($validate->teLogotransport != 'logoTecnicalDefault.png'){
                Storage::disk('opensoft')->delete('infoCompany/technical/transport/'.$validate->teLogotransport);
            }
            // if($validate->teLogocompany != 'logoTecnicalDefault.png'){
            //     Storage::disk('opensoft')->delete('infoCompany/technical/company/'.$validate->teLogocompany);
            // }
            $validate->delete();
            return redirect()->route('company.technical')->with('WarningTechnical', 'Información técnica, eliminada');
        }else{
            return redirect()->route('company.technical')->with('SecondaryTechnical', 'No se encuentra la información técnica');
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
