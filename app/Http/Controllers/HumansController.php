<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Collaborator;
use App\Models\Settingpersonal;
use App\Models\Settingdepartment;
use App\Models\Settinghealth;
use App\Models\Settingrisk;
use App\Models\Settingcompensation;
use App\Models\Settingpension;
use App\Models\Settinglayoff;

use App\Models\Contractormessenger;
use App\Models\Contractorcharge;
use App\Models\Contractorespecial;
use App\Models\Settingdriving;
use App\Models\Settingcourse;

use App\Models\Billcollaborator;
use App\Models\Billcontractor;

class HumansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE COLABORADORES
    =============================================================================================== */
    
    function collaboratorsTo(){
        $collaborators = Collaborator::select(
                    'collaborators.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.*',
                    'settinghealths.*',
                    'settingrisks.*',
                    'settingcompensations.*',
                    'settingpensions.*',
                    'settinglayoffs.*'
                )
                ->join('settinglayoffs','settinglayoffs.layId','collaborators.coLayoff_id')
                ->join('settingpensions','settingpensions.penId','collaborators.coPension_id')
                ->join('settingcompensations','settingcompensations.comId','collaborators.coCompensation_id')
                ->join('settingrisks','settingrisks.risId','collaborators.coRisk_id')
                ->join('settinghealths','settinghealths.heaId','collaborators.coHealths_id')
                ->join('settingpersonals','settingpersonals.perId','collaborators.coPersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','collaborators.coNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->get();
        $personals = Settingpersonal::all();
        $deparments = Settingdepartment::all();
        $healths = Settinghealth::all();
        $risks = Settingrisk::all();
        $compensations = Settingcompensation::all();
        $pensions = Settingpension::all();
        $layoffs = Settinglayoff::all();
        return view('modules.humans.collaborators.index',compact('collaborators','personals','deparments','healths','risks','compensations','pensions','layoffs'));
    }

    function saveCollaborator(Request $request){
        // dd($request->all());
        $validate = Collaborator::where('coNumberdocument',$this->fu($request->coNumberdocument))->first();
        if($validate == null){
            if($request->hasFile('coPhoto')){
                if($request->hasFile('coFirm')){
                    $photo = $request->file('coPhoto');
                    $firm = $request->file('coFirm');
                    $namephoto = $photo->getClientOriginalName();
                    $namefirm = $firm->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('collaboratorsPhotos',$photo,$namephoto);
                    Storage::disk('opensoft')->putFileAs('collaboratorsFirms',$firm,$namefirm);
                    Collaborator::create([
                        'coPhoto' => $namephoto,
                        'coFirm' => $namefirm,
                        'coNames' => $this->fu($request->coNames),
                        'coPersonal_id' => trim($request->coPersonal_id),
                        'coNumberdocument' => $this->upper($request->coNumberdocument),
                        'coPosition' => $this->fu($request->coPosition),
                        'coNeighborhood_id' => trim($request->coNeighborhood_id),
                        'coAddress' => $this->upper($request->coAddress),
                        'coEmail' => $this->lower($request->coEmail),
                        'coMovil' => trim($request->coMovil),
                        'coWhatsapp' => trim($request->coWhatsapp),
                        'coBloodtype' => $this->upper($request->coBloodtype),
                        'coHealths_id' => trim($request->coHealths_id),
                        'coRisk_id' => trim($request->coRisk_id),
                        'coCompensation_id' => trim($request->coCompensation_id),
                        'coPension_id' => trim($request->coPension_id),
                        'coLayoff_id' => trim($request->coLayoff_id),
                    ]);
                }else{
                    $photo = $request->file('coPhoto');
                    $namephoto = $photo->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('collaboratorsPhotos',$photo,$namephoto);
                    Collaborator::create([
                        'coPhoto' => $namephoto,
                        'coFirm' => null,
                        'coNames' => $this->fu($request->coNames),
                        'coPersonal_id' => trim($request->coPersonal_id),
                        'coNumberdocument' => $this->upper($request->coNumberdocument),
                        'coPosition' => $this->fu($request->coPosition),
                        'coNeighborhood_id' => trim($request->coNeighborhood_id),
                        'coAddress' => $this->upper($request->coAddress),
                        'coEmail' => $this->lower($request->coEmail),
                        'coMovil' => trim($request->coMovil),
                        'coWhatsapp' => trim($request->coWhatsapp),
                        'coBloodtype' => $this->upper($request->coBloodtype),
                        'coHealths_id' => trim($request->coHealths_id),
                        'coRisk_id' => trim($request->coRisk_id),
                        'coCompensation_id' => trim($request->coCompensation_id),
                        'coPension_id' => trim($request->coPension_id),
                        'coLayoff_id' => trim($request->coLayoff_id),
                    ]);
                }
            }else{
                if($request->hasFile('coFirm')){
                    $firm = $request->file('coFirm');
                    $namefirm = $firm->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('collaboratorsFirms',$firm,$namefirm);
                    Collaborator::create([
                        'coPhoto' => 'photoCollaboratorDefault.png',
                        'coFirm' => $namefirm,
                        'coNames' => $this->fu($request->coNames),
                        'coPersonal_id' => trim($request->coPersonal_id),
                        'coNumberdocument' => $this->upper($request->coNumberdocument),
                        'coPosition' => $this->fu($request->coPosition),
                        'coNeighborhood_id' => trim($request->coNeighborhood_id),
                        'coAddress' => $this->upper($request->coAddress),
                        'coEmail' => $this->lower($request->coEmail),
                        'coMovil' => trim($request->coMovil),
                        'coWhatsapp' => trim($request->coWhatsapp),
                        'coBloodtype' => $this->upper($request->coBloodtype),
                        'coHealths_id' => trim($request->coHealths_id),
                        'coRisk_id' => trim($request->coRisk_id),
                        'coCompensation_id' => trim($request->coCompensation_id),
                        'coPension_id' => trim($request->coPension_id),
                        'coLayoff_id' => trim($request->coLayoff_id),
                    ]);
                }else{
                    Collaborator::create([
                        'coPhoto' => 'photoCollaboratorDefault.png',
                        'coFirm' => null,
                        'coNames' => $this->fu($request->coNames),
                        'coPersonal_id' => trim($request->coPersonal_id),
                        'coNumberdocument' => $this->upper($request->coNumberdocument),
                        'coPosition' => $this->fu($request->coPosition),
                        'coNeighborhood_id' => trim($request->coNeighborhood_id),
                        'coAddress' => $this->upper($request->coAddress),
                        'coEmail' => $this->lower($request->coEmail),
                        'coMovil' => trim($request->coMovil),
                        'coWhatsapp' => trim($request->coWhatsapp),
                        'coBloodtype' => $this->upper($request->coBloodtype),
                        'coHealths_id' => trim($request->coHealths_id),
                        'coRisk_id' => trim($request->coRisk_id),
                        'coCompensation_id' => trim($request->coCompensation_id),
                        'coPension_id' => trim($request->coPension_id),
                        'coLayoff_id' => trim($request->coLayoff_id),
                    ]);
                }
            }
            return redirect()->route('humans.collaborators')->with('SuccessCollaborator', 'Colaborador ' . $this->fu($request->coNames) . ', registrado');
        }else{
            return redirect()->route('humans.collaborators')->with('SecondaryCollaborator', 'Ya existe un colaborador con el número de identificación ' . $validate->coNumberdocument);
        }
    }

    function updateCollaborator(Request $request){
        // dd($request->all());
        $validateOther = Collaborator::where('coNumberdocument',$this->upper($request->coNumberdocument_Edit))
                                        ->where('coId','!=',trim($request->coId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Collaborator::find(trim($request->coId_Edit));
            if($validate != null){
                $namephotofinal = $validate->coPhoto;
                $namefirmfinal = $validate->coFirm;
                if(!isset($request->coPhotonot_Edit)){
                    if(!isset($request->coFirmnot_Edit)){
                        if($request->hasFile('coPhoto_Edit')){
                            if($request->hasFile('coFirm_Edit')){
                                $photo = $request->file('coPhoto_Edit');
                                $firm = $request->file('coFirm_Edit');
                                $namephoto = $photo->getClientOriginalName();
                                $namefirm = $firm->getClientOriginalName();
                                if($validate->coPhoto != 'photoCollaboratorDefault.png'){
                                    Storage::disk('opensoft')->delete('collaboratorsPhotos/'.$validate->coPhoto);
                                }
                                Storage::disk('opensoft')->putFileAs('collaboratorsPhotos',$photo,$namephoto);
                                if($validate->coFirm != 'firmCollaboratorDefault.png'){
                                    Storage::disk('opensoft')->delete('collaboratorsFirms/'.$validate->coFirm);
                                }
                                Storage::disk('opensoft')->putFileAs('collaboratorsFirms',$firm,$namefirm);
                                $namephotofinal = $namephoto;
                                $namefirmfinal = $namefirm;
                            }else{
                                $photo = $request->file('coPhoto_Edit');
                                $namephoto = $photo->getClientOriginalName();
                                if($validate->coPhoto != 'photoCollaboratorDefault.png'){
                                    Storage::disk('opensoft')->delete('collaboratorsPhotos/'.$validate->coPhoto);
                                }
                                Storage::disk('opensoft')->putFileAs('collaboratorsPhotos',$photo,$namephoto);
                                $namephotofinal = $namephoto;
                            }
                        }else{
                            if($request->hasFile('coFirm_Edit')){
                                $firm = $request->file('coFirm_Edit');
                                $namefirm = $firm->getClientOriginalName();
                                if($validate->coFirm != 'firmCollaboratorDefault.png'){
                                    Storage::disk('opensoft')->delete('collaboratorsFirms/'.$validate->coFirm);
                                }
                                Storage::disk('opensoft')->putFileAs('collaboratorsFirms',$firm,$namefirm);
                                $namefirmfinal = $namefirm;
                            }
                        }    
                    }else{
                        $namefirmfinal = 'firmCollaboratorDefault.png';
                        if($request->hasFile('coPhoto_Edit')){
                            $photo = $request->file('coPhoto_Edit');
                            $namephoto = $photo->getClientOriginalName();
                            if($validate->coPhoto != 'photoCollaboratorDefault.png'){
                                Storage::disk('opensoft')->delete('collaboratorsPhotos/'.$validate->coPhoto);
                            }
                            Storage::disk('opensoft')->putFileAs('collaboratorsPhotos',$photo,$namephoto);
                            $namephotofinal = $namephoto;
                        }
                    }
                }else{
                    $namephotofinal = 'photoCollaboratorDefault.png';
                    if($request->hasFile('coFirm_Edit')){
                        $firm = $request->file('coFirm_Edit');
                        $namefirm = $firm->getClientOriginalName();
                        if($validate->coFirm != 'firmCollaboratorDefault.png'){
                            Storage::disk('opensoft')->delete('collaboratorsFirms/'.$validate->coFirm);
                        }
                        Storage::disk('opensoft')->putFileAs('collaboratorsFirms',$firm,$namefirm);
                        $namefirmfinal = $namefirm;
                    }
                }
                $validate->coPhoto = $namephotofinal;
                $validate->coFirm = $namefirmfinal;
                $validate->coNames = $this->fu($request->coNames_Edit);
                $validate->coPersonal_id = trim($request->coPersonal_id_Edit);
                $validate->coNumberdocument = $this->upper($request->coNumberdocument_Edit);
                $validate->coPosition = $this->fu($request->coPosition_Edit);
                $validate->coNeighborhood_id = trim($request->coNeighborhood_id_Edit);
                $validate->coAddress = $this->upper($request->coAddress_Edit);
                $validate->coEmail = $this->lower($request->coEmail_Edit);
                $validate->coMovil = $this->upper($request->coMovil_Edit);
                $validate->coWhatsapp = $this->upper($request->coWhatsapp_Edit);
                $validate->coBloodtype = $this->upper($request->coBloodtype_Edit);
                $validate->coHealths_id = trim($request->coHealths_id_Edit);
                $validate->coRisk_id = trim($request->coRisk_id_Edit);
                $validate->coCompensation_id = trim($request->coCompensation_id_Edit);
                $validate->coPension_id = trim($request->coPension_id_Edit);
                $validate->coLayoff_id = trim($request->coLayoff_id_Edit);
                $validate->save();
                return redirect()->route('humans.collaborators')->with('PrimaryCollaborator', 'Colaborador ' . $this->fu($request->coNames_Edit) . ', actualizado');
            }else{
                return redirect()->route('humans.collaborators')->with('SecondaryCollaborator', 'No se encuentra el colaborador, consulte al administrador');
            }
        }else{
            return redirect()->route('humans.collaborators')->with('SecondaryCollaborator', 'Ya existe un colaborador con el número de identificación ' . $validateOther->coNumberdocument);
        }
    }

    function deleteCollaborator(Request $request){
        // dd($request->all());
        $foreign = Billcollaborator::where('bcoCollaborator_id',trim($request->coId_Delete))->where('bcoStatus','VIGENTE')->first();
        if($foreign == null){
            $validate = Collaborator::find(trim($request->coId_Delete));
            if($validate != null){
                $name = $validate->coNames;
                if($validate->coPhoto != 'photoCollaboratorDefault.png'){
                    Storage::disk('opensoft')->delete('collaboratorsPhotos/'.$validate->coPhoto);
                }
                if($validate->coFirm != 'firmCollaboratorDefault.png' && $validate->coFirm != null){
                    Storage::disk('opensoft')->delete('collaboratorsFirms/'.$validate->coFirm);
                }
                $validate->delete();
                return redirect()->route('humans.collaborators')->with('WarningCollaborator', 'Colaborador ' . $name . ', eliminado');
            }else{
                return redirect()->route('humans.collaborators')->with('SecondaryCollaborator', 'No se encuentra el colaborador, Consulte con el administrador');
            }
        }else{
            return redirect()->route('humans.collaborators')->with('SecondaryCollaborator', 'No es posible eliminar un colaborador con contrato vigente');
        }
    }

    /* ===============================================================================================
			MODULO DE CONTRATISTAS MENSAJERIA
    =============================================================================================== */

    function contractorsMessengerTo(){
        $contractorsmessengers = Contractormessenger::select(
                    'contractorsmessenger.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.*',
                    'settingdrivings.*',
                    'settinghealths.*',
                    'settingrisks.*',
                    'settingcompensations.*',
                    'settingpensions.*',
                    'settinglayoffs.*'
                )
                ->join('settinglayoffs','settinglayoffs.layId','contractorsmessenger.cmLayoff_id')
                ->join('settingpensions','settingpensions.penId','contractorsmessenger.cmPension_id')
                ->join('settingcompensations','settingcompensations.comId','contractorsmessenger.cmCompensation_id')
                ->join('settingrisks','settingrisks.risId','contractorsmessenger.cmRisk_id')
                ->join('settinghealths','settinghealths.heaId','contractorsmessenger.cmHealths_id')
                ->join('settingdrivings','settingdrivings.driId','contractorsmessenger.cmDriving_id')
                ->join('settingpersonals','settingpersonals.perId','contractorsmessenger.cmPersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','contractorsmessenger.cmNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->get();
        $personals = Settingpersonal::all();
        $deparments = Settingdepartment::all();
        $healths = Settinghealth::all();
        $risks = Settingrisk::all();
        $compensations = Settingcompensation::all();
        $pensions = Settingpension::all();
        $layoffs = Settinglayoff::all();
        $drivings = Settingdriving::all();
        $courses = Settingcourse::all();
        return view('modules.humans.contractorsMessenger.index', compact('contractorsmessengers','personals','deparments','healths','risks','compensations','pensions','layoffs','drivings','courses'));
    }

    function saveContractorsmessenger(Request $request){
        // dd($request->all());
        $validate = Contractormessenger::where('cmNumberdocument',$this->upper($request->cmNumberdocument))
                                        ->orWhere('cmNumberdriving',$this->upper($request->cmNumberdriving))->first();
        if($validate == null){
            $idsCourses = substr(trim($request->cmCourses),0,-1); // QUITAR ULTIMO CARACTER QUE ES (-)
            if($request->hasFile('cmPhoto')){
                if($request->hasFile('cmFirm')){
                    $photo = $request->file('cmPhoto');
                    $firm = $request->file('cmFirm');
                    $namephoto = $photo->getClientOriginalName();
                    $namefirm = $firm->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsMessengerPhotos',$photo,$namephoto);
                    Storage::disk('opensoft')->putFileAs('contractorsMessengerFirms',$firm,$namefirm);
                    Contractormessenger::create([
                        'cmPhoto' => $namephoto,
                        'cmFirm' => $namefirm,
                        'cmNames' => $this->fu($request->cmNames),
                        'cmPersonal_id' => trim($request->cmPersonal_id),
                        'cmNumberdocument' => $this->upper($request->cmNumberdocument),
                        'cmDriving_id' => trim($request->cmDriving_id),
                        'cmNumberdriving' => $this->upper($request->cmNumberdriving),
                        'cmNeighborhood_id' => trim($request->cmNeighborhood_id),
                        'cmAddress' => $this->upper($request->cmAddress),
                        'cmEmail' => $this->lower($request->cmEmail),
                        'cmMovil' => trim($request->cmMovil),
                        'cmWhatsapp' => trim($request->cmWhatsapp),
                        'cmBloodtype' => $this->upper($request->cmBloodtype),
                        'cmHealths_id' => trim($request->cmHealths_id),
                        'cmRisk_id' => trim($request->cmRisk_id),
                        'cmCompensation_id' => trim($request->cmCompensation_id),
                        'cmPension_id' => trim($request->cmPension_id),
                        'cmLayoff_id' => trim($request->cmLayoff_id),
                        'cmCourses' => $idsCourses
                    ]);
                }else{
                    $photo = $request->file('cmPhoto');
                    $namephoto = $photo->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsMessengerPhotos',$photo,$namephoto);
                    Contractormessenger::create([
                        'cmPhoto' => $namephoto,
                        'cmNames' => $this->fu($request->cmNames),
                        'cmPersonal_id' => trim($request->cmPersonal_id),
                        'cmNumberdocument' => $this->upper($request->cmNumberdocument),
                        'cmDriving_id' => trim($request->cmDriving_id),
                        'cmNumberdriving' => $this->upper($request->cmNumberdriving),
                        'cmNeighborhood_id' => trim($request->cmNeighborhood_id),
                        'cmAddress' => $this->upper($request->cmAddress),
                        'cmEmail' => $this->lower($request->cmEmail),
                        'cmMovil' => trim($request->cmMovil),
                        'cmWhatsapp' => trim($request->cmWhatsapp),
                        'cmBloodtype' => $this->upper($request->cmBloodtype),
                        'cmHealths_id' => trim($request->cmHealths_id),
                        'cmRisk_id' => trim($request->cmRisk_id),
                        'cmCompensation_id' => trim($request->cmCompensation_id),
                        'cmPension_id' => trim($request->cmPension_id),
                        'cmLayoff_id' => trim($request->cmLayoff_id),
                        'cmCourses' => $idsCourses
                    ]);
                }
            }else{
                if($request->hasFile('cmPhoto')){
                    $firm = $request->file('cmFirm');
                    $namefirm = $firm->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsMessengerFirms',$firm,$namefirm);
                    Contractormessenger::create([
                        'cmFirm' => $namefirm,
                        'cmNames' => $this->fu($request->cmNames),
                        'cmPersonal_id' => trim($request->cmPersonal_id),
                        'cmNumberdocument' => $this->upper($request->cmNumberdocument),
                        'cmDriving_id' => trim($request->cmDriving_id),
                        'cmNumberdriving' => $this->upper($request->cmNumberdriving),
                        'cmNeighborhood_id' => trim($request->cmNeighborhood_id),
                        'cmAddress' => $this->upper($request->cmAddress),
                        'cmEmail' => $this->lower($request->cmEmail),
                        'cmMovil' => trim($request->cmMovil),
                        'cmWhatsapp' => trim($request->cmWhatsapp),
                        'cmBloodtype' => $this->upper($request->cmBloodtype),
                        'cmHealths_id' => trim($request->cmHealths_id),
                        'cmRisk_id' => trim($request->cmRisk_id),
                        'cmCompensation_id' => trim($request->cmCompensation_id),
                        'cmPension_id' => trim($request->cmPension_id),
                        'cmLayoff_id' => trim($request->cmLayoff_id),
                        'cmCourses' => $idsCourses
                    ]);
                }else{
                    Contractormessenger::create([
                        'cmNames' => $this->fu($request->cmNames),
                        'cmPersonal_id' => trim($request->cmPersonal_id),
                        'cmNumberdocument' => $this->upper($request->cmNumberdocument),
                        'cmDriving_id' => trim($request->cmDriving_id),
                        'cmNumberdriving' => $this->upper($request->cmNumberdriving),
                        'cmNeighborhood_id' => trim($request->cmNeighborhood_id),
                        'cmAddress' => $this->upper($request->cmAddress),
                        'cmEmail' => $this->lower($request->cmEmail),
                        'cmMovil' => trim($request->cmMovil),
                        'cmWhatsapp' => trim($request->cmWhatsapp),
                        'cmBloodtype' => $this->upper($request->cmBloodtype),
                        'cmHealths_id' => trim($request->cmHealths_id),
                        'cmRisk_id' => trim($request->cmRisk_id),
                        'cmCompensation_id' => trim($request->cmCompensation_id),
                        'cmPension_id' => trim($request->cmPension_id),
                        'cmLayoff_id' => trim($request->cmLayoff_id),
                        'cmCourses' => $idsCourses
                    ]);
                }
            }
            return redirect()->route('humans.contractorsMessenger')->with('SuccessContractor', 'Contratista de mensajería ' . $this->fu($request->cmNames) . ', registrado');
        }else{
            return redirect()->route('humans.contractorsMessenger')->with('SecondaryContractor', 'Ya existe un contratista de mensajería con el número de identificación ' . $validate->cmNumberdocument . ' o número de licencia ' . $validate->cmNumberdriving);
        }
    }

    function updateContractorsmessenger(Request $request){
        // dd($request->all());
        $validateOther = Contractormessenger::where('cmNumberdocument',$this->upper($request->cmNumberdocument_Edit))
                                        ->where('cmId','!=',trim($request->cmId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Contractormessenger::find(trim($request->cmId_Edit));
            if($validate != null){
                $namephotofinal = $validate->cmPhoto;
                $namefirmfinal = $validate->cmFirm;
                if(!isset($request->cmPhotonot_Edit)){
                    if(!isset($request->cmFirmnot_Edit)){
                        if($request->hasFile('cmPhoto_Edit')){
                            if($request->hasFile('cmFirm_Edit')){
                                $photo = $request->file('cmPhoto_Edit');
                                $firm = $request->file('cmFirm_Edit');
                                $namephoto = $photo->getClientOriginalName();
                                $namefirm = $firm->getClientOriginalName();
                                if($validate->cmPhoto != 'photoContractorMessengerDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsMessengerPhotos/'.$validate->cmPhoto);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsMessengerPhotos',$photo,$namephoto);
                                if($validate->cmFirm != 'firmContractorMessengerDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsMessengerFirms/'.$validate->cmFirm);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsMessengerFirms',$firm,$namefirm);
                                $namephotofinal = $namephoto;
                                $namefirmfinal = $namefirm;
                            }else{
                                $photo = $request->file('cmPhoto_Edit');
                                $namephoto = $photo->getClientOriginalName();
                                if($validate->cmPhoto != 'photoContractorMessengerDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsMessengerPhotos/'.$validate->cmPhoto);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsMessengerPhotos',$photo,$namephoto);
                                $namephotofinal = $namephoto;
                            }
                        }else{
                            if($request->hasFile('cmFirm_Edit')){
                                $firm = $request->file('cmFirm_Edit');
                                $namefirm = $firm->getClientOriginalName();
                                if($validate->cmFirm != 'firmContractorMessengerDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsMessengerFirms/'.$validate->cmFirm);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsMessengerFirms',$firm,$namefirm);
                                $namefirmfinal = $namefirm;
                            }
                        }    
                    }else{
                        $namefirmfinal = 'firmContractorMessengerDefault.png';
                        if($request->hasFile('cmPhoto_Edit')){
                            $photo = $request->file('cmPhoto_Edit');
                            $namephoto = $photo->getClientOriginalName();
                            if($validate->cmPhoto != 'photoContractorMessengerDefault.png'){
                                Storage::disk('opensoft')->delete('contractorsMessengerPhotos/'.$validate->cmPhoto);
                            }
                            Storage::disk('opensoft')->putFileAs('contractorsMessengerPhotos',$photo,$namephoto);
                            $namephotofinal = $namephoto;
                        }
                    }
                }else{
                    $namephotofinal = 'photoContractorMessengerDefault.png';
                    if($request->hasFile('cmFirm_Edit')){
                        $firm = $request->file('cmFirm_Edit');
                        $namefirm = $firm->getClientOriginalName();
                        if($validate->cmFirm != 'firmContractorMessengerDefault.png'){
                            Storage::disk('opensoft')->delete('contractorsMessengerFirms/'.$validate->cmFirm);
                        }
                        Storage::disk('opensoft')->putFileAs('contractorsMessengerFirms',$firm,$namefirm);
                        $namefirmfinal = $namefirm;
                    }
                }
                $validate->cmPhoto = $namephotofinal;
                $validate->cmFirm = $namefirmfinal;
                $validate->cmNames = $this->fu($request->cmNames_Edit);
                $validate->cmPersonal_id = trim($request->cmPersonal_id_Edit);
                $validate->cmNumberdocument = $this->upper($request->cmNumberdocument_Edit);
                $validate->cmDriving_id = trim($request->cmDriving_id_Edit);
                $validate->cmNumberdriving = $this->upper($request->cmNumberdriving_Edit);
                $validate->cmNeighborhood_id = trim($request->cmNeighborhood_id_Edit);
                $validate->cmAddress = $this->upper($request->cmAddress_Edit);
                $validate->cmEmail = $this->lower($request->cmEmail_Edit);
                $validate->cmMovil = trim($request->cmMovil_Edit);
                $validate->cmWhatsapp = trim($request->cmWhatsapp_Edit);
                $validate->cmBloodtype = $this->upper($request->cmBloodtype_Edit);
                $validate->cmHealths_id = trim($request->cmHealths_id_Edit);
                $validate->cmRisk_id = trim($request->cmRisk_id_Edit);
                $validate->cmCompensation_id = trim($request->cmCompensation_id_Edit);
                $validate->cmPension_id = trim($request->cmPension_id_Edit);
                $validate->cmLayoff_id = trim($request->cmLayoff_id_Edit);
                $idsCourses = substr(trim($request->cmCourses_Edit),0,-1); // QUITAR ULTIMO CARACTER QUE ES (-)
                $validate->cmCourses = $idsCourses;
                $validate->save();
                return redirect()->route('humans.contractorsMessenger')->with('PrimaryContractor', 'Contratista de mensajería ' . $this->fu($request->cmNames_Edit) . ', actualizado');
            }else{
                return redirect()->route('humans.contractorsMessenger')->with('SecondaryContractor', 'No se encuentra el contratista de mensajería, consulte al administrador');
            }
        }else{
            return redirect()->route('humans.contractorsMessenger')->with('SecondaryContractor', 'Ya existe un contratista de mensajería con el número de identificación ' . $validateOther->cmNumberdocument);
        }
    }

    function deleteContractorsmessenger(Request $request){
        // dd($request->all());
        $foreign = Billcontractor::where('bcContractormessenger_id',trim($request->cmId_Delete))->where('bcStatus','VIGENTE')->first();
        if($foreign == null){
            $validate = Contractormessenger::find(trim($request->cmId_Delete));
            if($validate != null){
                $name = $validate->cmNames;
                if($validate->cmPhoto != 'photoContractorMessengerDefault.png'){
                    Storage::disk('opensoft')->delete('contractorsMessengerPhotos/'.$validate->cmPhoto);
                }
                if($validate->cmFirm != 'firmContractorMessengerDefault.png'){
                    Storage::disk('opensoft')->delete('contractorsMessengerFirms/'.$validate->cmFirm);
                }
                $validate->delete();
                return redirect()->route('humans.contractorsMessenger')->with('WarningContractor', 'Contratista de mensajería ' . $name . ', eliminado');
            }else{
                return redirect()->route('humans.contractorsMessenger')->with('SecondaryContractor', 'No se encuentra el contratista de mensajería, Consulte con el administrador');
            }
        }else{
            return redirect()->route('humans.contractorsMessenger')->with('SecondaryContractor', 'No es posible eliminar un contratista con contrato vigente');
        }
    }

    /* ===============================================================================================
			MODULO DE CONTRATISTAS DE CARGA EXPRESS
    =============================================================================================== */

    function contractorsExpressTo(){
        $contractorscharges = Contractorcharge::select(
                    'contractorschargeexpress.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.*',
                    'settingdrivings.*',
                    'settinghealths.*',
                    'settingrisks.*',
                    'settingcompensations.*',
                    'settingpensions.*',
                    'settinglayoffs.*'
                )
                ->join('settinglayoffs','settinglayoffs.layId','contractorschargeexpress.ccLayoff_id')
                ->join('settingpensions','settingpensions.penId','contractorschargeexpress.ccPension_id')
                ->join('settingcompensations','settingcompensations.comId','contractorschargeexpress.ccCompensation_id')
                ->join('settingrisks','settingrisks.risId','contractorschargeexpress.ccRisk_id')
                ->join('settinghealths','settinghealths.heaId','contractorschargeexpress.ccHealths_id')
                ->join('settingdrivings','settingdrivings.driId','contractorschargeexpress.ccDriving_id')
                ->join('settingpersonals','settingpersonals.perId','contractorschargeexpress.ccPersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','contractorschargeexpress.ccNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->get();
        $personals = Settingpersonal::all();
        $deparments = Settingdepartment::all();
        $healths = Settinghealth::all();
        $risks = Settingrisk::all();
        $compensations = Settingcompensation::all();
        $pensions = Settingpension::all();
        $layoffs = Settinglayoff::all();
        $drivings = Settingdriving::all();
        $courses = Settingcourse::all();
        return view('modules.humans.contractorsExpress.index', compact('contractorscharges','personals','deparments','healths','risks','compensations','pensions','layoffs','drivings','courses'));
    }

    function saveContractorscharge(Request $request){
        // dd($request->all());
        $validate = Contractorcharge::where('ccNumberdocument',$this->upper($request->ccNumberdocument))
                                        ->orWhere('ccNumberdriving',$this->upper($request->ccNumberdriving))->first();
        if($validate == null){
            $idsCourses = substr(trim($request->ccCourses),0,-1); // QUITAR ULTIMO CARACTER QUE ES (-)
            if($request->hasFile('ccPhoto')){
                if($request->hasFile('ccFirm')){
                    $photo = $request->file('ccPhoto');
                    $firm = $request->file('ccFirm');
                    $namephoto = $photo->getClientOriginalName();
                    $namefirm = $firm->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsChargePhotos',$photo,$namephoto);
                    Storage::disk('opensoft')->putFileAs('contractorsChargeFirms',$firm,$namefirm);
                    Contractorcharge::create([
                        'ccPhoto' => $namephoto,
                        'ccFirm' => $namefirm,
                        'ccNames' => $this->fu($request->ccNames),
                        'ccPersonal_id' => trim($request->ccPersonal_id),
                        'ccNumberdocument' => $this->upper($request->ccNumberdocument),
                        'ccDriving_id' => trim($request->ccDriving_id),
                        'ccNumberdriving' => $this->upper($request->ccNumberdriving),
                        'ccNeighborhood_id' => trim($request->ccNeighborhood_id),
                        'ccAddress' => $this->upper($request->ccAddress),
                        'ccEmail' => $this->lower($request->ccEmail),
                        'ccMovil' => trim($request->ccMovil),
                        'ccWhatsapp' => trim($request->ccWhatsapp),
                        'ccBloodtype' => $this->upper($request->ccBloodtype),
                        'ccHealths_id' => trim($request->ccHealths_id),
                        'ccRisk_id' => trim($request->ccRisk_id),
                        'ccCompensation_id' => trim($request->ccCompensation_id),
                        'ccPension_id' => trim($request->ccPension_id),
                        'ccLayoff_id' => trim($request->ccLayoff_id),
                        'ccCourses' => $idsCourses
                    ]);
                }else{
                    $photo = $request->file('ccPhoto');
                    $namephoto = $photo->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsChargePhotos',$photo,$namephoto);
                    Contractorcharge::create([
                        'ccPhoto' => $namephoto,
                        'ccNames' => $this->fu($request->ccNames),
                        'ccPersonal_id' => trim($request->ccPersonal_id),
                        'ccNumberdocument' => $this->upper($request->ccNumberdocument),
                        'ccDriving_id' => trim($request->ccDriving_id),
                        'ccNumberdriving' => $this->upper($request->ccNumberdriving),
                        'ccNeighborhood_id' => trim($request->ccNeighborhood_id),
                        'ccAddress' => $this->upper($request->ccAddress),
                        'ccEmail' => $this->lower($request->ccEmail),
                        'ccMovil' => trim($request->ccMovil),
                        'ccWhatsapp' => trim($request->ccWhatsapp),
                        'ccBloodtype' => $this->upper($request->ccBloodtype),
                        'ccHealths_id' => trim($request->ccHealths_id),
                        'ccRisk_id' => trim($request->ccRisk_id),
                        'ccCompensation_id' => trim($request->ccCompensation_id),
                        'ccPension_id' => trim($request->ccPension_id),
                        'ccLayoff_id' => trim($request->ccLayoff_id),
                        'ccCourses' => $idsCourses
                    ]);
                }
            }else{
                if($request->hasFile('ccPhoto')){
                    $firm = $request->file('ccFirm');
                    $namefirm = $firm->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsChargeFirms',$firm,$namefirm);
                    Contractorcharge::create([
                        'ccFirm' => $namefirm,
                        'ccNames' => $this->fu($request->ccNames),
                        'ccPersonal_id' => trim($request->ccPersonal_id),
                        'ccNumberdocument' => $this->upper($request->ccNumberdocument),
                        'ccDriving_id' => trim($request->ccDriving_id),
                        'ccNumberdriving' => $this->upper($request->ccNumberdriving),
                        'ccNeighborhood_id' => trim($request->ccNeighborhood_id),
                        'ccAddress' => $this->upper($request->ccAddress),
                        'ccEmail' => $this->lower($request->ccEmail),
                        'ccMovil' => trim($request->ccMovil),
                        'ccWhatsapp' => trim($request->ccWhatsapp),
                        'ccBloodtype' => $this->upper($request->ccBloodtype),
                        'ccHealths_id' => trim($request->ccHealths_id),
                        'ccRisk_id' => trim($request->ccRisk_id),
                        'ccCompensation_id' => trim($request->ccCompensation_id),
                        'ccPension_id' => trim($request->ccPension_id),
                        'ccLayoff_id' => trim($request->ccLayoff_id),
                        'ccCourses' => $idsCourses
                    ]);
                }else{
                    Contractorcharge::create([
                        'ccNames' => $this->fu($request->ccNames),
                        'ccPersonal_id' => trim($request->ccPersonal_id),
                        'ccNumberdocument' => $this->upper($request->ccNumberdocument),
                        'ccDriving_id' => trim($request->ccDriving_id),
                        'ccNumberdriving' => $this->upper($request->ccNumberdriving),
                        'ccNeighborhood_id' => trim($request->ccNeighborhood_id),
                        'ccAddress' => $this->upper($request->ccAddress),
                        'ccEmail' => $this->lower($request->ccEmail),
                        'ccMovil' => trim($request->ccMovil),
                        'ccWhatsapp' => trim($request->ccWhatsapp),
                        'ccBloodtype' => $this->upper($request->ccBloodtype),
                        'ccHealths_id' => trim($request->ccHealths_id),
                        'ccRisk_id' => trim($request->ccRisk_id),
                        'ccCompensation_id' => trim($request->ccCompensation_id),
                        'ccPension_id' => trim($request->ccPension_id),
                        'ccLayoff_id' => trim($request->ccLayoff_id),
                        'ccCourses' => $idsCourses
                    ]);
                }
            }
            return redirect()->route('humans.contractorsExpress')->with('SuccessContractor', 'Contratista de carga express ' . $this->fu($request->ccNames) . ', registrado');
        }else{
            return redirect()->route('humans.contractorsExpress')->with('SecondaryContractor', 'Ya existe un contratista de carga express con el número de identificación ' . $validate->ccNumberdocument . ' o número de licencia ' . $validate->ccNumberdriving);
        }
    }

    function updateContractorscharge(Request $request){
        // dd($request->all());
        $validateOther = Contractorcharge::where('ccNumberdocument',$this->upper($request->ccNumberdocument_Edit))
                                        ->where('ccId','!=',trim($request->ccId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Contractorcharge::find(trim($request->ccId_Edit));
            if($validate != null){
                $namephotofinal = $validate->ccPhoto;
                $namefirmfinal = $validate->ccFirm;
                if(!isset($request->ccPhotonot_Edit)){
                    if(!isset($request->ccFirmnot_Edit)){
                        if($request->hasFile('ccPhoto_Edit')){
                            if($request->hasFile('ccFirm_Edit')){
                                $photo = $request->file('ccPhoto_Edit');
                                $firm = $request->file('ccFirm_Edit');
                                $namephoto = $photo->getClientOriginalName();
                                $namefirm = $firm->getClientOriginalName();
                                if($validate->ccPhoto != 'photoContractorChargeDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsChargePhotos/'.$validate->ccPhoto);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsChargePhotos',$photo,$namephoto);
                                if($validate->ccFirm != 'firmContractorChargeDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsChargeFirms/'.$validate->ccFirm);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsChargeFirms',$firm,$namefirm);
                                $namephotofinal = $namephoto;
                                $namefirmfinal = $namefirm;
                            }else{
                                $photo = $request->file('ccPhoto_Edit');
                                $namephoto = $photo->getClientOriginalName();
                                if($validate->ccPhoto != 'photoContractorChargeDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsChargePhotos/'.$validate->ccPhoto);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsChargePhotos',$photo,$namephoto);
                                $namephotofinal = $namephoto;
                            }
                        }else{
                            if($request->hasFile('ccFirm_Edit')){
                                $firm = $request->file('ccFirm_Edit');
                                $namefirm = $firm->getClientOriginalName();
                                if($validate->ccFirm != 'firmContractorChargeDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsChargeFirms/'.$validate->ccFirm);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsChargeFirms',$firm,$namefirm);
                                $namefirmfinal = $namefirm;
                            }
                        }    
                    }else{
                        $namefirmfinal = 'firmContractorChargeDefault.png';
                        if($request->hasFile('ccPhoto_Edit')){
                            $photo = $request->file('ccPhoto_Edit');
                            $namephoto = $photo->getClientOriginalName();
                            if($validate->ccPhoto != 'photoContractorChargeDefault.png'){
                                Storage::disk('opensoft')->delete('contractorsChargePhotos/'.$validate->ccPhoto);
                            }
                            Storage::disk('opensoft')->putFileAs('contractorsChargePhotos',$photo,$namephoto);
                            $namephotofinal = $namephoto;
                        }
                    }
                }else{
                    $namephotofinal = 'photoContractorChargeDefault.png';
                    if($request->hasFile('ccFirm_Edit')){
                        $firm = $request->file('ccFirm_Edit');
                        $namefirm = $firm->getClientOriginalName();
                        if($validate->ccFirm != 'firmContractorChargeDefault.png'){
                            Storage::disk('opensoft')->delete('contractorsChargeFirms/'.$validate->ccFirm);
                        }
                        Storage::disk('opensoft')->putFileAs('contractorsChargeFirms',$firm,$namefirm);
                        $namefirmfinal = $namefirm;
                    }
                }
                $validate->ccPhoto = $namephotofinal;
                $validate->ccFirm = $namefirmfinal;
                $validate->ccNames = $this->fu($request->ccNames_Edit);
                $validate->ccPersonal_id = trim($request->ccPersonal_id_Edit);
                $validate->ccNumberdocument = $this->upper($request->ccNumberdocument_Edit);
                $validate->ccDriving_id = trim($request->ccDriving_id_Edit);
                $validate->ccNumberdriving = $this->upper($request->ccNumberdriving_Edit);
                $validate->ccNeighborhood_id = trim($request->ccNeighborhood_id_Edit);
                $validate->ccAddress = $this->upper($request->ccAddress_Edit);
                $validate->ccEmail = $this->lower($request->ccEmail_Edit);
                $validate->ccMovil = trim($request->ccMovil_Edit);
                $validate->ccWhatsapp = trim($request->ccWhatsapp_Edit);
                $validate->ccBloodtype = $this->upper($request->ccBloodtype_Edit);
                $validate->ccHealths_id = trim($request->ccHealths_id_Edit);
                $validate->ccRisk_id = trim($request->ccRisk_id_Edit);
                $validate->ccCompensation_id = trim($request->ccCompensation_id_Edit);
                $validate->ccPension_id = trim($request->ccPension_id_Edit);
                $validate->ccLayoff_id = trim($request->ccLayoff_id_Edit);
                $idsCourses = substr(trim($request->ccCourses_Edit),0,-1); // QUITAR ULTIMO CARACTER QUE ES (-)
                $validate->ccCourses = $idsCourses;
                $validate->save();
                return redirect()->route('humans.contractorsExpress')->with('PrimaryContractor', 'Contratista de carga express ' . $this->fu($request->ccNames_Edit) . ', actualizado');
            }else{
                return redirect()->route('humans.contractorsExpress')->with('SecondaryContractor', 'No se encuentra el contratista de carga express, consulte al administrador');
            }
        }else{
            return redirect()->route('humans.contractorsExpress')->with('SecondaryContractor', 'Ya existe un contratista de carga express con el número de identificación ' . $validateOther->ccNumberdocument);
        }
    }

    function deleteContractorscharge(Request $request){
        // dd($request->all());
        $foreign = Billcontractor::where('bcContractorcharge_id',trim($request->ccId_Delete))->where('bcStatus','VIGENTE')->first();
        if($foreign == null){
            $validate = Contractorcharge::find(trim($request->ccId_Delete));
            if($validate != null){
                $name = $validate->ccNames;
                if($validate->ccPhoto != 'photoContractorChargeDefault.png'){
                    Storage::disk('opensoft')->delete('contractorsChargePhotos/'.$validate->ccPhoto);
                }
                if($validate->ccFirm != 'firmContractorChargeDefault.png'){
                    Storage::disk('opensoft')->delete('contractorsChargeFirms/'.$validate->ccFirm);
                }
                $validate->delete();
                return redirect()->route('humans.contractorsExpress')->with('WarningContractor', 'Contratista de carga express ' . $name . ', eliminado');
            }else{
                return redirect()->route('humans.contractorsExpress')->with('SecondaryContractor', 'No se encuentra el contratista de carga express, Consulte con el administrador');
            }
        }else{
            return redirect()->route('humans.contractorsExpress')->with('SecondaryContractor', 'No es posible eliminar un contratista con contrato vigente');
        }
    }

    /* ===============================================================================================
			MODULO DE CONTRATISTAS DE SERVICIOS ESPECIALES
    =============================================================================================== */

    function contractorsEspecialTo(){
        $contractorsespecials = Contractorespecial::select(
                    'contractorsserviceespecial.*',
                    'settingdepartments.*',
                    'settingmunicipalities.*',
                    'settingzonings.*',
                    'settingneighborhoods.*',
                    'settingpersonals.*',
                    'settingdrivings.*',
                    'settinghealths.*',
                    'settingrisks.*',
                    'settingcompensations.*',
                    'settingpensions.*',
                    'settinglayoffs.*'
                )
                ->join('settinglayoffs','settinglayoffs.layId','contractorsserviceespecial.ceLayoff_id')
                ->join('settingpensions','settingpensions.penId','contractorsserviceespecial.cePension_id')
                ->join('settingcompensations','settingcompensations.comId','contractorsserviceespecial.ceCompensation_id')
                ->join('settingrisks','settingrisks.risId','contractorsserviceespecial.ceRisk_id')
                ->join('settinghealths','settinghealths.heaId','contractorsserviceespecial.ceHealths_id')
                ->join('settingdrivings','settingdrivings.driId','contractorsserviceespecial.ceDriving_id')
                ->join('settingpersonals','settingpersonals.perId','contractorsserviceespecial.cePersonal_id')
                ->join('settingneighborhoods','settingneighborhoods.neId','contractorsserviceespecial.ceNeighborhood_id')
                ->join('settingzonings','settingzonings.zonId','settingneighborhoods.neZoning_id')
                ->join('settingmunicipalities','settingmunicipalities.munId','settingzonings.zonMunicipality_id')
                ->join('settingdepartments','settingdepartments.depId','settingmunicipalities.munDepartment_id')
                ->get();
        $personals = Settingpersonal::all();
        $deparments = Settingdepartment::all();
        $healths = Settinghealth::all();
        $risks = Settingrisk::all();
        $compensations = Settingcompensation::all();
        $pensions = Settingpension::all();
        $layoffs = Settinglayoff::all();
        $drivings = Settingdriving::all();
        $courses = Settingcourse::all();
        return view('modules.humans.contractorsEspecial.index', compact('contractorsespecials','personals','deparments','healths','risks','compensations','pensions','layoffs','drivings','courses'));
    }

    function saveContractorsespecial(Request $request){
        // dd($request->all());
        $validate = Contractorespecial::where('ceNumberdocument',$this->upper($request->ceNumberdocument))
                                        ->orWhere('ceNumberdriving',$this->upper($request->ceNumberdriving))->first();
        if($validate == null){
            $idsCourses = substr(trim($request->ceCourses),0,-1); // QUITAR ULTIMO CARACTER QUE ES (-)
            if($request->hasFile('cePhoto')){
                if($request->hasFile('ceFirm')){
                    $photo = $request->file('cePhoto');
                    $firm = $request->file('ceFirm');
                    $namephoto = $photo->getClientOriginalName();
                    $namefirm = $firm->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsEspecialPhotos',$photo,$namephoto);
                    Storage::disk('opensoft')->putFileAs('contractorsEspecialFirms',$firm,$namefirm);
                    Contractorespecial::create([
                        'cePhoto' => $namephoto,
                        'ceFirm' => $namefirm,
                        'ceNames' => $this->fu($request->ceNames),
                        'cePersonal_id' => trim($request->cePersonal_id),
                        'ceNumberdocument' => $this->upper($request->ceNumberdocument),
                        'ceDriving_id' => trim($request->ceDriving_id),
                        'ceNumberdriving' => $this->upper($request->ceNumberdriving),
                        'ceNeighborhood_id' => trim($request->ceNeighborhood_id),
                        'ceAddress' => $this->upper($request->ceAddress),
                        'ceEmail' => $this->lower($request->ceEmail),
                        'ceMovil' => trim($request->ceMovil),
                        'ceWhatsapp' => trim($request->ceWhatsapp),
                        'ceBloodtype' => $this->upper($request->ceBloodtype),
                        'ceHealths_id' => trim($request->ceHealths_id),
                        'ceRisk_id' => trim($request->ceRisk_id),
                        'ceCompensation_id' => trim($request->ceCompensation_id),
                        'cePension_id' => trim($request->cePension_id),
                        'ceLayoff_id' => trim($request->ceLayoff_id),
                        'ceCourses' => $idsCourses
                    ]);
                }else{
                    $photo = $request->file('cePhoto');
                    $namephoto = $photo->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsEspecialPhotos',$photo,$namephoto);
                    Contractorespecial::create([
                        'cePhoto' => $namephoto,
                        'ceNames' => $this->fu($request->ceNames),
                        'cePersonal_id' => trim($request->cePersonal_id),
                        'ceNumberdocument' => $this->upper($request->ceNumberdocument),
                        'ceDriving_id' => trim($request->ceDriving_id),
                        'ceNumberdriving' => $this->upper($request->ceNumberdriving),
                        'ceNeighborhood_id' => trim($request->ceNeighborhood_id),
                        'ceAddress' => $this->upper($request->ceAddress),
                        'ceEmail' => $this->lower($request->ceEmail),
                        'ceMovil' => trim($request->ceMovil),
                        'ceWhatsapp' => trim($request->ceWhatsapp),
                        'ceBloodtype' => $this->upper($request->ceBloodtype),
                        'ceHealths_id' => trim($request->ceHealths_id),
                        'ceRisk_id' => trim($request->ceRisk_id),
                        'ceCompensation_id' => trim($request->ceCompensation_id),
                        'cePension_id' => trim($request->cePension_id),
                        'ceLayoff_id' => trim($request->ceLayoff_id),
                        'ceCourses' => $idsCourses
                    ]);
                }
            }else{
                if($request->hasFile('cePhoto')){
                    $firm = $request->file('ceFirm');
                    $namefirm = $firm->getClientOriginalName();
                    Storage::disk('opensoft')->putFileAs('contractorsEspecialFirms',$firm,$namefirm);
                    Contractorespecial::create([
                        'ceFirm' => $namefirm,
                        'ceNames' => $this->fu($request->ceNames),
                        'cePersonal_id' => trim($request->cePersonal_id),
                        'ceNumberdocument' => $this->upper($request->ceNumberdocument),
                        'ceDriving_id' => trim($request->ceDriving_id),
                        'ceNumberdriving' => $this->upper($request->ceNumberdriving),
                        'ceNeighborhood_id' => trim($request->ceNeighborhood_id),
                        'ceAddress' => $this->upper($request->ceAddress),
                        'ceEmail' => $this->lower($request->ceEmail),
                        'ceMovil' => trim($request->ceMovil),
                        'ceWhatsapp' => trim($request->ceWhatsapp),
                        'ceBloodtype' => $this->upper($request->ceBloodtype),
                        'ceHealths_id' => trim($request->ceHealths_id),
                        'ceRisk_id' => trim($request->ceRisk_id),
                        'ceCompensation_id' => trim($request->ceCompensation_id),
                        'cePension_id' => trim($request->cePension_id),
                        'ceLayoff_id' => trim($request->ceLayoff_id),
                        'ceCourses' => $idsCourses
                    ]);
                }else{
                    Contractorespecial::create([
                        'ceNames' => $this->fu($request->ceNames),
                        'cePersonal_id' => trim($request->cePersonal_id),
                        'ceNumberdocument' => $this->upper($request->ceNumberdocument),
                        'ceDriving_id' => trim($request->ceDriving_id),
                        'ceNumberdriving' => $this->upper($request->ceNumberdriving),
                        'ceNeighborhood_id' => trim($request->ceNeighborhood_id),
                        'ceAddress' => $this->upper($request->ceAddress),
                        'ceEmail' => $this->lower($request->ceEmail),
                        'ceMovil' => trim($request->ceMovil),
                        'ceWhatsapp' => trim($request->ceWhatsapp),
                        'ceBloodtype' => $this->upper($request->ceBloodtype),
                        'ceHealths_id' => trim($request->ceHealths_id),
                        'ceRisk_id' => trim($request->ceRisk_id),
                        'ceCompensation_id' => trim($request->ceCompensation_id),
                        'cePension_id' => trim($request->cePension_id),
                        'ceLayoff_id' => trim($request->ceLayoff_id),
                        'ceCourses' => $idsCourses
                    ]);
                }
            }
            return redirect()->route('humans.contractorsEspecial')->with('SuccessContractor', 'Contratista de servicio especial ' . $this->fu($request->ceNames) . ', registrado');
        }else{
            return redirect()->route('humans.contractorsEspecial')->with('SecondaryContractor', 'Ya existe un contratista de servicio especial con el número de identificación ' . $validate->ceNumberdocument . ' o número de licencia ' . $validate->ceNumberdriving);
        }
    }

    function updateContractorsespecial(Request $request){
        // dd($request->all());
        $validateOther = Contractorespecial::where('ceNumberdocument',$this->upper($request->ceNumberdocument_Edit))
                                        ->where('ceId','!=',trim($request->ceId_Edit))
                                        ->first();
        if($validateOther == null){
            $validate = Contractorespecial::find(trim($request->ceId_Edit));
            if($validate != null){
                $namephotofinal = $validate->cePhoto;
                $namefirmfinal = $validate->ceFirm;
                if(!isset($request->cePhotonot_Edit)){
                    if(!isset($request->ceFirmnot_Edit)){
                        if($request->hasFile('cePhoto_Edit')){
                            if($request->hasFile('ceFirm_Edit')){
                                $photo = $request->file('cePhoto_Edit');
                                $firm = $request->file('ceFirm_Edit');
                                $namephoto = $photo->getClientOriginalName();
                                $namefirm = $firm->getClientOriginalName();
                                if($validate->cePhoto != 'photoContractorEspecialDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsEspecialPhotos/'.$validate->cePhoto);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsEspecialPhotos',$photo,$namephoto);
                                if($validate->ceFirm != 'firmContractorEspecialDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsEspecialFirms/'.$validate->ceFirm);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsEspecialFirms',$firm,$namefirm);
                                $namephotofinal = $namephoto;
                                $namefirmfinal = $namefirm;
                            }else{
                                $photo = $request->file('cePhoto_Edit');
                                $namephoto = $photo->getClientOriginalName();
                                if($validate->cePhoto != 'photoContractorEspecialDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsEspecialPhotos/'.$validate->cePhoto);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsEspecialPhotos',$photo,$namephoto);
                                $namephotofinal = $namephoto;
                            }
                        }else{
                            if($request->hasFile('ceFirm_Edit')){
                                $firm = $request->file('ceFirm_Edit');
                                $namefirm = $firm->getClientOriginalName();
                                if($validate->ceFirm != 'firmContractorEspecialDefault.png'){
                                    Storage::disk('opensoft')->delete('contractorsEspecialFirms/'.$validate->ceFirm);
                                }
                                Storage::disk('opensoft')->putFileAs('contractorsEspecialFirms',$firm,$namefirm);
                                $namefirmfinal = $namefirm;
                            }
                        }    
                    }else{
                        $namefirmfinal = 'firmContractorEspecialDefault.png';
                        if($request->hasFile('cePhoto_Edit')){
                            $photo = $request->file('cePhoto_Edit');
                            $namephoto = $photo->getClientOriginalName();
                            if($validate->cePhoto != 'photoContractorEspecialDefault.png'){
                                Storage::disk('opensoft')->delete('contractorsEspecialPhotos/'.$validate->cePhoto);
                            }
                            Storage::disk('opensoft')->putFileAs('contractorsEspecialPhotos',$photo,$namephoto);
                            $namephotofinal = $namephoto;
                        }
                    }
                }else{
                    $namephotofinal = 'photoContractorEspecialDefault.png';
                    if($request->hasFile('ceFirm_Edit')){
                        $firm = $request->file('ceFirm_Edit');
                        $namefirm = $firm->getClientOriginalName();
                        if($validate->ceFirm != 'firmContractorEspecialDefault.png'){
                            Storage::disk('opensoft')->delete('contractorsEspecialFirms/'.$validate->ceFirm);
                        }
                        Storage::disk('opensoft')->putFileAs('contractorsEspecialFirms',$firm,$namefirm);
                        $namefirmfinal = $namefirm;
                    }
                }
                $validate->cePhoto = $namephotofinal;
                $validate->ceFirm = $namefirmfinal;
                $validate->ceNames = $this->fu($request->ceNames_Edit);
                $validate->cePersonal_id = trim($request->cePersonal_id_Edit);
                $validate->ceNumberdocument = $this->upper($request->ceNumberdocument_Edit);
                $validate->ceDriving_id = trim($request->ceDriving_id_Edit);
                $validate->ceNumberdriving = $this->upper($request->ceNumberdriving_Edit);
                $validate->ceNeighborhood_id = trim($request->ceNeighborhood_id_Edit);
                $validate->ceAddress = $this->upper($request->ceAddress_Edit);
                $validate->ceEmail = $this->lower($request->ceEmail_Edit);
                $validate->ceMovil = trim($request->ceMovil_Edit);
                $validate->ceWhatsapp = trim($request->ceWhatsapp_Edit);
                $validate->ceBloodtype = $this->upper($request->ceBloodtype_Edit);
                $validate->ceHealths_id = trim($request->ceHealths_id_Edit);
                $validate->ceRisk_id = trim($request->ceRisk_id_Edit);
                $validate->ceCompensation_id = trim($request->ceCompensation_id_Edit);
                $validate->cePension_id = trim($request->cePension_id_Edit);
                $validate->ceLayoff_id = trim($request->ceLayoff_id_Edit);
                $idsCourses = substr(trim($request->ceCourses_Edit),0,-1); // QUITAR ULTIMO CARACTER QUE ES (-)
                $validate->ceCourses = $idsCourses;
                $validate->save();
                return redirect()->route('humans.contractorsEspecial')->with('PrimaryContractor', 'Contratista de servicio especial ' . $this->fu($request->ceNames_Edit) . ', actualizado');
            }else{
                return redirect()->route('humans.contractorsEspecial')->with('SecondaryContractor', 'No se encuentra el contratista de servicio especial, consulte al administrador');
            }
        }else{
            return redirect()->route('humans.contractorsEspecial')->with('SecondaryContractor', 'Ya existe un contratista de servicio especial con el número de identificación ' . $validateOther->ceNumberdocument);
        }
    }

    function deleteContractorsespecial(Request $request){
        // dd($request->all());
        $foreign = Billcontractor::where('bcContractorespecial_id',trim($request->ceId_Delete))->where('bcStatus','VIGENTE')->first();
        if($foreign == null){
            $validate = Contractorespecial::find(trim($request->ceId_Delete));
            if($validate != null){
                $name = $validate->ceNames;
                if($validate->cePhoto != 'photoContractorEspecialDefault.png'){
                    Storage::disk('opensoft')->delete('contractorsEspecialPhotos/'.$validate->cePhoto);
                }
                if($validate->ceFirm != 'firmContractorEspecialDefault.png'){
                    Storage::disk('opensoft')->delete('contractorsEspecialFirms/'.$validate->ceFirm);
                }
                $validate->delete();
                return redirect()->route('humans.contractorsEspecial')->with('WarningContractor', 'Contratista de servicio especial ' . $name . ', eliminado');
            }else{
                return redirect()->route('humans.contractorsEspecial')->with('SecondaryContractor', 'No se encuentra el contratista de servicio especial, Consulte con el administrador');
            }
        }else{
            return redirect()->route('humans.contractorsEspecial')->with('SecondaryContractor', 'No es posible eliminar un contratista con contrato vigente');
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
