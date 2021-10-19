<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Quotation;
use App\Models\Clientbidding;
use App\Models\Clientproposal;
use App\Models\Settingpersonal;
use App\Models\Binnaclebidding;
use App\Models\Binnacleproposal;
use App\Models\Settingmunicipality;

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
use App\Models\Settingespecial;
use App\Models\Settingheavy;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE LICITACIONES PUBLICAS DE (CLIENTE POTENCIAL)
    =============================================================================================== */

    function biddingTo(){
        $municipalities = Settingmunicipality::all();
        return view('modules.clients.bidding.index',compact('municipalities'));
    }

    function saveBidding(Request $request){
        // dd($request->all());
        $validate = Clientbidding::where('cbiEntity',$this::upper($request->cbiEntity))->first();
        if($validate == null){
            Clientbidding::create([
                'cbiNumberprocess' => trim($request->cbiNumberprocess),
                'cbiDateopen' => trim($request->cbiDateopen),
                'cbiDateclose' => trim($request->cbiDateclose),
                'cbiEntity' => $this::upper($request->cbiEntity),
                'cbiMunicipility_id' => trim($request->cbiMunicipility_id),
                'cbiModalitycontract' => $this::upper($request->cbiModalitycontract),
                'cbiEmail' => $this::lower($request->cbiEmail),
                'cbiObjectcontract' => $this::fu($request->cbiObjectcontract),
                'cbiObservation' => $this::fu($request->cbiObservation)
            ]);
            $new = Clientbidding::where('cbiEntity',$this::upper($request->cbiEntity))->first();
            Quotation::create([
                'quoType' => 'Licitación pública',
                'quoBidding_id' => $new->cbiId
            ]);
            return redirect()->route('clients.bidding')->with('SuccessBidding', 'Licitación pública de (' . $this::upper($request->cbiEntity) . '), registrada');
        }else{
            return redirect()->route('clients.bidding')->with('SecondaryBidding', 'Ya existe la licitación pública (' . $validate->cbiEntity);
        }
    }

    function yesBidding(Request $request){
        // dd($request->all());
        // $request->cbiId_yes
        $bidding = Clientbidding::find(trim($request->cbiId_yes));
        if($bidding != null){
            $reason = $bidding->cbiEntity;
            $bidding->cbiStatus = 'ACEPTADO';
            $bidding->save();
            return redirect()->route('clients.tracking')->with('PrimaryBidding', 'Licitación pública de (' . $reason . '), Aceptada y cerrada, consulte en ARCHIVO COMERCIAL');
        }else{
            return redirect()->route('clients.tracking')->with('SecondaryBidding', 'No se encuentra la licitación pública');
        }
    }

    function noBidding(Request $request){
        // dd($request->all());
        // $request->cbiId_no
        $bidding = Clientbidding::find(trim($request->cbiId_no));
        if($bidding != null){
            $reason = $bidding->cbiEntity;
            $bidding->cbiStatus = 'DENEGADO';
            $bidding->save();
            return redirect()->route('clients.tracking')->with('WarningBidding', 'Licitación pública de (' . $reason . '), Denegada y cerrada, consulte en ARCHIVO COMERCIAL');
        }else{
            return redirect()->route('clients.tracking')->with('SecondaryBidding', 'No se encuentra la licitación pública');
        }
    }

    /* ===============================================================================================
			MODULO DE PROPUESTA COMERCIAL DE (CLIENTE POTENCIAL)
    =============================================================================================== */

    function proposalTo(){
        $typedocuments = Settingpersonal::all();
        $municipalities = Settingmunicipality::all();
        return view('modules.clients.proposal.index',compact('typedocuments','municipalities'));
    }

    function saveProposal(Request $request){
        // dd($request->all());
        /*
            $request->cprDate
            $request->cprClient
            $request->cprTypedocument_id
            $request->cprNumberdocument
            $request->cprMunicipility_id
            $request->cprModalitycontract
            $request->cprContact
            $request->cprPhone
            $request->cprEmail
            $request->cprObservation
            $request->briefcases_select
            $request->typeService_id
            $request->all_briefcase // typeBriefcase=>idBriefcase=>idservice=>idVehicle=>valuebase
        */

        $briefcases = substr(trim($request->all_briefcase),0,-5);
        $validate = Clientproposal::where('cprClient',$this::upper($request->cprClient))
                                ->where('cprObservation',$this::fu($request->cprObservation))
                                ->first();
        if($validate == null){
            Clientproposal::create([
                'cprDate' => trim($request->cprDate),
                'cprClient' => $this::upper($request->cprClient),
                'cprTypedocument_id' => trim($request->cprTypedocument_id),
                'cprNumberdocument' => $this::upper($request->cprNumberdocument),
                'cprMunicipility_id' => trim($request->cprMunicipility_id),
                'cprModalitycontract' => $this::upper($request->cprModalitycontract),
                'cprContact' => $this::fu($request->cprContact),
                'cprPhone' => trim($request->cprPhone),
                'cprEmail' => $this::lower($request->cprEmail),
                'cprObservation' => $this::fu($request->cprObservation),
                'cprBriefcase' => $briefcases
            ]);
            $new = Clientproposal::where('cprClient',$this::upper($request->cprClient))
                                ->where('cprObservation',$this::fu($request->cprObservation))
                                ->first();
            Quotation::create([
                'quoType' => 'Propuesta comercial',
                'quoProposal_id' => $new->cprId
            ]);
            return redirect()->route('clients.proposal')->with('SuccessProposal', 'Propuesta comercial para (' . $this::upper($request->cprClient) . '), registrada');
        }else{
            return redirect()->route('clients.proposal')->with('SecondaryProposal', 'Ya existe una propuesta comercial con el cliente y observacion indicada');
        }
    }

    function yesProposal(Request $request){
        // dd($request->all());
        // $request->cprId_yes
        $proposal = Clientproposal::find(trim($request->cprId_yes));
        if($proposal != null){
            $reason = $proposal->cprClient;
            $proposal->cprStatus = 'ACEPTADO';
            $proposal->save();
            return redirect()->route('clients.tracking')->with('PrimaryProposal', 'Propuesta comercial de (' . $reason . '), Aceptada y cerrada, consulte en ARCHIVO COMERCIAL');
        }else{
            return redirect()->route('clients.tracking')->with('SecondaryProposal', 'No se encuentra la propuesta comercial');
        }
    }

    function noProposal(Request $request){
        // dd($request->all());
        // $request->cprId_no
        $proposal = Clientproposal::find(trim($request->cprId_no));
        if($proposal != null){
            $reason = $proposal->cprClient;
            $proposal->cprStatus = 'DENEGADO';
            $proposal->save();
            return redirect()->route('clients.tracking')->with('WarningProposal', 'Propuesta comercial de (' . $reason . '), Denegada y cerrada, consulte en ARCHIVO COMERCIAL');
        }else{
            return redirect()->route('clients.tracking')->with('SecondaryProposal', 'No se encuentra la propuesta comercial');
        }
    }

    /* ===============================================================================================
			MODULO DE SEGUIMIENTO COMERCIAL DE (CLIENTE POTENCIAL)
    =============================================================================================== */

    function trackingTo(){
        $dates = array();
        $biddings = Clientbidding::select('clientbiddings.*','settingmunicipalities.munName')
                        ->join('settingmunicipalities','settingmunicipalities.munId','clientbiddings.cbiMunicipility_id')
                        ->where('cbiStatus','PENDIENTE')
                        ->get();
        foreach ($biddings as $bidding) {
            $quotation = Quotation::where('quoBidding_id',$bidding->cbiId)->first();
            if($quotation != null){
                array_push($dates,[
                    'Licitación',
                    $this->getNumber($quotation->quoId),
                    $bidding->cbiId,
                    $bidding->cbiNumberprocess,
                    $bidding->cbiDateopen,
                    $bidding->cbiDateclose,
                    $bidding->cbiEntity,
                    $bidding->munName,
                    $bidding->cbiModalitycontract,
                    $bidding->cbiObjectcontract,
                    $bidding->cbiEmail,
                    $bidding->cbiObservation
                ]);
            }
        }
        $proposals = Clientproposal::select('clientproposals.*','settingmunicipalities.munName','settingpersonals.perName')
                        ->join('settingpersonals','settingpersonals.perId','clientproposals.cprTypedocument_id')
                        ->join('settingmunicipalities','settingmunicipalities.munId','clientproposals.cprMunicipility_id')
                        ->where('cprStatus','PENDIENTE')
                        ->get();
        foreach ($proposals as $proposal) {
            $quotation = Quotation::where('quoProposal_id',$proposal->cprId)->first();
            if($quotation != null){
                array_push($dates,[
                    'Propuesta',
                    $this->getNumber($quotation->quoId),
                    $proposal->cprId,
                    $proposal->cprDate,
                    $proposal->cprClient,
                    $proposal->perName,
                    $proposal->cprNumberdocument,
                    $proposal->munName,
                    $proposal->cprModalitycontract,
                    $proposal->cprEmail,
                    $proposal->cprPhone,
                    $proposal->cprContact,
                    $proposal->cprObservation,
                    $proposal->cprBriefcase
                ]);
            }
        }
        return view('modules.clients.tracking.index',compact('dates'));
    }

    function saveTracking(Request $request){
        // dd($request->all());
        Binnaclebidding::create([
            'bbDate' => trim($request->bbDate),
            'bbObservation' => $this::lower($request->bbObservation),
            'bbClientbidding_id' => trim($request->cbiId_binnacle)
        ]);
        $bidding = Clientbidding::find(trim($request->cbiId_binnacle));
        return redirect()->route('clients.tracking')->with('SuccessBidding', 'Seguimiento agregado a (' . $bidding->cbiEntity . ')');
    }

    function saveTrackingproposal(Request $request){
        // dd($request->all());
        Binnacleproposal::create([
            'bpDate' => trim($request->bpDate),
            'bpObservation' => $this::lower($request->bpObservation),
            'bpClientproposal_id' => trim($request->cprId_binnacle)
        ]);
        $proposal = Clientproposal::find(trim($request->cprId_binnacle));
        return redirect()->route('clients.tracking')->with('SuccessProposal', 'Seguimiento agregado a (' . $proposal->cprClient . ')');
    }

    /* ===============================================================================================
			MODULO DE ARCHIVO COMERCIAL DE (CLIENTE POTENCIAL)
    =============================================================================================== */

    function recordsTo(){
        $dates = array();
        $biddings = Clientbidding::select('clientbiddings.*','settingmunicipalities.munName')
                        ->join('settingmunicipalities','settingmunicipalities.munId','clientbiddings.cbiMunicipility_id')
                        ->where('cbiStatus','!=','PENDIENTE')
                        ->get();
        foreach ($biddings as $bidding) {
            $quotation = Quotation::where('quoBidding_id',$bidding->cbiId)->first();
            if($quotation != null){
                array_push($dates,[
                    'Licitación',
                    $this->getNumber($quotation->quoId),
                    $bidding->cbiId,
                    $bidding->cbiNumberprocess,
                    $bidding->cbiDateopen,
                    $bidding->cbiDateclose,
                    $bidding->cbiEntity,
                    $bidding->munName,
                    $bidding->cbiModalitycontract,
                    $bidding->cbiObjectcontract,
                    $bidding->cbiEmail,
                    $bidding->cbiObservation,
                    $bidding->cbiStatus
                ]);
            }
        }
        $proposals = Clientproposal::select('clientproposals.*','settingmunicipalities.munName','settingpersonals.perName')
                        ->join('settingpersonals','settingpersonals.perId','clientproposals.cprTypedocument_id')
                        ->join('settingmunicipalities','settingmunicipalities.munId','clientproposals.cprMunicipility_id')
                        ->where('cprStatus','!=','PENDIENTE')
                        ->get();
        foreach ($proposals as $proposal) {
            $quotation = Quotation::where('quoProposal_id',$proposal->cprId)->first();
            if($quotation != null){
                array_push($dates,[
                    'Propuesta',
                    $this->getNumber($quotation->quoId),
                    $proposal->cprId,
                    $proposal->cprDate,
                    $proposal->cprClient,
                    $proposal->perName,
                    $proposal->cprNumberdocument,
                    $proposal->munName,
                    $proposal->cprModalitycontract,
                    $proposal->cprEmail,
                    $proposal->cprPhone,
                    $proposal->cprContact,
                    $proposal->cprObservation,
                    $proposal->cprBriefcase,
                    $proposal->cprStatus
                ]);
            }
        }
        $biddingshistory = Clientbidding::select('clientbiddings.*','settingmunicipalities.munName')
                        ->join('settingmunicipalities','settingmunicipalities.munId','clientbiddings.cbiMunicipility_id')
                        ->where('cbiStatus','!=','PENDIENTE')
                        ->get();
        $proposalshistory = Clientproposal::select('clientproposals.*','settingmunicipalities.munName','settingpersonals.perName')
                        ->join('settingpersonals','settingpersonals.perId','clientproposals.cprTypedocument_id')
                        ->join('settingmunicipalities','settingmunicipalities.munId','clientproposals.cprMunicipility_id')
                        ->where('cprStatus','!=','PENDIENTE')
                        ->get();
        return view('modules.clients.records.index',compact('dates','biddingshistory','proposalshistory'));
    }

    /* ===============================================================================================
			MODULO DE ESTADISTICA DE (CLIENTE POTENCIAL)
    =============================================================================================== */

    function statisticTo(){
        $year = date('Y');
        $datesAll = $this->getClients($year);
        return view('modules.clients.statistic.index',compact('datesAll'));
    }

    function getClients($year){
        $result = array();
        for ($i=1; $i <= 12; $i++) {
            $aprovedBidding = Clientbidding::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cbiStatus','ACEPTADO')->count();
            // $aprovedBidding = Clientbidding::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('cbiStatus','ACEPTADO')->count();
            $notAprovedBidding = Clientbidding::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cbiStatus','DENEGADO')->count();
            $aprovedProposal = Clientproposal::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cprStatus','ACEPTADO')->count();
            $notAprovedProposal = Clientproposal::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cprStatus','DENEGADO')->count();
            $result[$i][0] = $aprovedBidding + $aprovedProposal;
            $result[$i][1] = $notAprovedBidding + $notAprovedProposal;
        }
        return $result;
    }

    function getClientAproved(Request $request){
        $notAssisted = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $bidding = Clientbidding::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cbiStatus','ACEPTADO')->count();
            $proposal = Clientproposal::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cprStatus','ACEPTADO')->count();
            $total = $bidding + $proposal;
            array_push($notAssisted, $total);
        }
        return $notAssisted;
    }

    function getClientsNotAproved(Request $request){
        $assisted = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $bidding = Clientbidding::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cbiStatus','DENEGADO')->count();
            $proposal = Clientproposal::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cprStatus','DENEGADO')->count();
            $total = $bidding + $proposal;
            array_push($assisted, $total);
        }
        return $assisted;
    }

    function getClientsPending(Request $request){
        $pending = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $bidding = Clientbidding::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cbiStatus','PENDIENTE')->count();
            $proposal = Clientproposal::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01 00:00:01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year) . ' 23:59:59'])->where('cprStatus','PENDIENTE')->count();
            $total = $bidding + $proposal;
            array_push($pending, $total);
        }
        return $pending;
    }

    function getMount($numberMount){
        return ($numberMount<10 ? '0' : '') . $numberMount;
    }

    function numberDays($mount,$year){
        $days = date("t", strtotime($year . '-' . $mount . '-15'));
        return $days;
        //dd(cal_days_in_month(CAL_GREGORIAN,$mount,$year));
        //return cal_days_in_month(CAL_GREGORIAN,$mount,$year);
    }

    /* ===============================================================================================
            FUNCION PARA OBTENER COTIZACION CON 0 ADICIONALES A LA IZQUIERDA
    =============================================================================================== */

    function getNumber($number){
        $count = strlen($number);
        switch ($count) {
            case 1: return (string)'0000' . $number; break;
            case 2: return (string)'000' . $number; break;
            case 3: return (string)'00' . $number; break;
            case 4: return (string)'0' . $number; break;
            default: return (string)$number; break;
        }
    }
}
