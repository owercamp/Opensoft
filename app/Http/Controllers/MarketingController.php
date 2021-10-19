<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Marketing;
use App\Models\Binnaclemarketing;
use App\Models\Settingmunicipality;

class MarketingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE OPORTUNIDAD DE NEGOCIO DE (PLAN DE MERCADEO)
    =============================================================================================== */
    
    function opportunityTo(){
        $municipalities = Settingmunicipality::all();
        return view('modules.marketing.opportunity.index',compact('municipalities'));
    }

    function saveOpportunity(Request $request){
        // dd($request->all());
        $validate = Marketing::where('marReason',$this::upper($request->marReason))->first();
        if($validate == null){
            Marketing::create([
                'marDate' => trim($request->marDate),
                'marReason' => $this::upper($request->marReason),
                'marMunicipility_id' => trim($request->marMunicipility_id),
                'marAddress' => $this::upper($request->marAddress),
                'marContact' => $this::upper($request->marContact),
                'marPhone' => trim($request->marPhone),
                'marEmail' => $this::lower($request->marEmail),
                'marObservation' => $this::fu($request->marObservation)
            ]);
            return redirect()->route('marketing.opportunity')->with('SuccessOpportunity', 'Oportunidad de negocio (' . $this::upper($request->marReason) . '), registrada');
        }else{
            return redirect()->route('marketing.opportunity')->with('SecondaryOpportunity', 'Ya existe la Oportunidad de negocio (' . $validate->marReason);
        }
    }

    function yesOpportunity(Request $request){
        // dd($request->all());
        // $request->marId_yes
        $marketing = Marketing::find(trim($request->marId_yes));
        if($marketing != null){
            $reason = $marketing->marReason;
            $marketing->marStatus = 'ACEPTADO';
            $marketing->save();
            return redirect()->route('marketing.tracking')->with('SuccessOpportunity', 'Oportunidad de negocio de (' . $reason . '), Aceptada y cerrada, consulte en ARCHIVO DE NEGOCIOS');
        }else{
            return redirect()->route('marketing.tracking')->with('SecondaryOpportunity', 'No se encuentra la Oportunidad de negocio');
        }
    }

    function noOpportunity(Request $request){
        // dd($request->all());
        // $request->marId_no
        $marketing = Marketing::find(trim($request->marId_no));
        if($marketing != null){
            $reason = $marketing->marReason;
            $marketing->marStatus = 'DENEGADO';
            $marketing->save();
            return redirect()->route('marketing.tracking')->with('SuccessOpportunity', 'Oportunidad de negocio de (' . $reason . '), Denegada y cerrada, consulte en ARCHIVO DE NEGOCIOS');
        }else{
            return redirect()->route('marketing.tracking')->with('SecondaryOpportunity', 'No se encuentra la Oportunidad de negocio');
        }
    }

    /* ===============================================================================================
			MODULO DE SEGUIMIENTO DE NEGOCIOS DE (PLAN DE MERCADEO)
    =============================================================================================== */

    function trackingTo(){
        $marketings = Marketing::select('marketings.*','settingmunicipalities.munName')
                        ->join('settingmunicipalities','settingmunicipalities.munId','marketings.marMunicipility_id')
                        ->where('marStatus','PENDIENTE')
                        ->get();
        return view('modules.marketing.tracking.index',compact('marketings'));
    }

    function saveTracking(Request $request){
        // dd($request->all());
        Binnaclemarketing::create([
            'bmDate' => trim($request->bmDate),
            'bmObservation' => $this::lower($request->bmObservation),
            'bmMarketing_id' => trim($request->marId_binnacle)
        ]);
        $marketing = Marketing::find(trim($request->marId_binnacle));
        return redirect()->route('marketing.tracking')->with('SuccessOpportunity', 'Seguimiento agregado a (' . $marketing->marReason . ')');
    }

    /* ===============================================================================================
			MODULO DE ARCHIVO DE NEGOCIOS DE (PLAN DE MERCADEO)
    =============================================================================================== */

    function recordsTo(){
        $marketings = Marketing::select('marketings.*','settingmunicipalities.munName')
                        ->join('settingmunicipalities','settingmunicipalities.munId','marketings.marMunicipility_id')
                        ->where('marStatus','!=','PENDIENTE')
                        ->get();
        return view('modules.marketing.records.index',compact('marketings'));
    }

    /* ===============================================================================================
			MODULO DE ESTADISTICA DE (PLAN DE MERCADEO)
    =============================================================================================== */

    function statisticTo(){
        $year = date('Y');
        $datesAll = $this->getMarketings($year);
        return view('modules.marketing.statistic.index',compact('datesAll'));
    }

    function getMarketings($year){
        $result = array();
        for ($i=1; $i <= 12; $i++) {
            $aproved = Marketing::whereBetween('marDate', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('marStatus','ACEPTADO')->count();
            $notAproved = Marketing::whereBetween('marDate', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('marStatus','DENEGADO')->count();
            $pending = Marketing::whereBetween('marDate', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('marStatus','PENDIENTE')->count();
            $result[$i][0] = $pending;
            $result[$i][1] = $aproved;
            $result[$i][2] = $notAproved;
        }
        return $result;
    }

    function getMarketingAproved(Request $request){
        $notAssisted = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $query = Marketing::whereBetween('marDate', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('marStatus','ACEPTADO')->count();
            array_push($notAssisted, $query);
        }
        return $notAssisted;
    }

    function getMarketingNotAproved(Request $request){
        $assisted = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $query = Marketing::whereBetween('marDate', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('marStatus','DENEGADO')->count();
            array_push($assisted, $query);
        }
        return $assisted;
    }

    function getMarketingPending(Request $request){
        $pending = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $query = Marketing::whereBetween('marDate', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('marStatus','PENDIENTE')->count();
            array_push($pending, $query);
        }
        return $pending;
    }

    function getMount($numberMount){
        return ($numberMount<10 ? '0' : '') . $numberMount;
    }

    function numberDays($mount,$year){
        $days = date("t",strtotime($year . '-' . $mount . '-15'));
        return $days;
        //dd(cal_days_in_month(CAL_GREGORIAN,$mount,$year));
        //return cal_days_in_month(CAL_GREGORIAN,$mount,$year);
    }
}
