<?php

namespace App\Http\Controllers;

use App\Models\Requestcharge;
use App\Models\RequestIntermunityTransfer;
use App\Models\Requestlogistic;
use App\Models\Requestmessenger;
use App\Models\RequestshasContractors;
use App\Models\Requestturism;
use App\Models\RequestUrbanTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class TrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE CONFIRMACION OPERADOR DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */
    
    function confirmationsTo(){
      $messengers = Requestmessenger::all()->where('remStatus','=','ACEPTADO');
      $logistics = Requestlogistic::all()->where('relStatus','=','ACEPTADO');
      $charges = Requestcharge::all()->where('recStatus','=','ACEPTADO');
      $turisms = Requestturism::all()->where('retStatus','=','ACEPTADO');
      $transfers = RequestUrbanTransfer::all()->where('reuStatus','=','ACEPTADO');
      $intermunipals = RequestIntermunityTransfer::all()->where('reiStatus','=','ACEPTADO');
  
      $dates = array();
  
      foreach ($messengers as $messenger) {
        $date = Date('Y-m-d', strtotime($messenger->remDateservice));
        $hour = Date('H:i:s', strtotime($messenger->remHourstart));
        if ($messenger->remTypecliente == 'PERMANENTE') {
          $client = $messenger->permanent->client->cliNamereason;
        } else {
          $client = $messenger->occasional->proposal->cprClient;
        }
        array_push($dates, [
          $date,
          $hour,
          $client,
          'Mensajería Express',
          $messenger->messenger->smService,
          $messenger->origin->munName,
          $messenger->remAddressorigin,
          $messenger->remContact,
          $messenger->remPhone,
          $messenger->destiny->munName,
          $messenger->remAddressdestiny,
          (isset($messenger->remObservation)) ? $messenger->remObservation : 'N/A',
          $messenger->remId
        ]);
      }
  
      foreach ($logistics as $logistic) {
        $date = Date('Y-m-d', strtotime($logistic->relDateservice));
        $hour = Date('H:i:s', strtotime($logistic->relHourstart));
        if ($logistic->relTypecliente == 'PERMANENTE') {
          $client = $logistic->permanent->client->cliNamereason;
        } else {
          $client = $logistic->occasional->proposal->cprClient;
        }
        array_push($dates, [
          $date,
          $hour,
          $client,
          'Logística Express',
          $logistic->logistic->slService,
          $logistic->origin->munName,
          $logistic->relAddressorigin,
          $logistic->relContact,
          $logistic->relPhone,
          $logistic->destiny->munName,
          $logistic->relAddressdestiny,
          'N/A',
          $logistic->relId
        ]);
      }
  
      foreach ($charges as $charge) {
        $date = Date('Y-m-d', strtotime($charge->recDateservice));
        $hour = Date('H:i:s', strtotime($charge->recHourstart));
        if ($charge->recTypecliente == 'PERMANENTE') {
          $client = $charge->permanent->client->cliNamereason;
        } else {
          $client = $charge->occasional->proposal->cprClient;
        }
        array_push($dates, [
          $date,
          $hour,
          $client,
          'Carga Express',
          $charge->charge->scService,
          $charge->origin->munName,
          $charge->recAddressorigin,
          $charge->recContact,
          $charge->recPhone,
          $charge->destiny->munName,
          $charge->recAddressdestiny,
          'N/A',
          $charge->recId
        ]);
      }
  
      foreach ($turisms as $turism) {
        $date = Date('Y-m-d', strtotime($turism->retDateservice));
        $hour = Date('H:i:s', strtotime($turism->retHourstart));
        if ($turism->retTypecliente == 'PERMANENTE') {
          $client = $turism->permanent->client->cliNamereason;
        } else {
          $client = $turism->occasional->proposal->cprClient;
        }
        array_push($dates, [
          $date,
          $hour,
          $client,
          'Turismo Pasajeros',
          $turism->charge->scService,
          $turism->origin->munName,
          $turism->retAddressorigin,
          $turism->retContact,
          $turism->retPhone,
          $turism->destiny->munName,
          $turism->retAddressdestiny,
          'N/A',
          $turism->retId
        ]);
      }
  
      foreach ($transfers as $transfer) {
        $date = Date('Y-m-d', strtotime($transfer->reuDateservice));
        $hour = Date('H:i:s', strtotime($transfer->reuHourstart));
        if ($transfer->reuTypecliente == 'PERMANENTE') {
          $client = $transfer->permanent->client->cliNamereason;
        } else {
          $client = $transfer->occasional->proposal->cprClient;
        }
        array_push($dates, [
          $date,
          $hour,
          $client,
          'Traslado Urbano',
          $transfer->transfer->strService,
          $transfer->origin->munName,
          $transfer->reuAddressorigin,
          $transfer->reuContact,
          $transfer->reuPhone,
          $transfer->destiny->munName,
          $transfer->reuAddressdestiny,
          'N/A',
          $transfer->reuId
        ]);
      }
  
      foreach ($intermunipals as $municipal) {
        $date = Date('Y-m-d', strtotime($municipal->reiDateservice));
        $hour = Date('H:i:s', strtotime($municipal->reiHourstart));
        if ($municipal->reiTypecliente == 'PERMANENTE') {
          $client = $municipal->permanent->client->cliNamereason;
        } else {
          $client = $municipal->occasional->proposal->cprClient;
        }
        array_push($dates, [
          $date,
          $hour,
          $client,
          'Traslado Intermunicipal',
          $municipal->transfer->stmService,
          $municipal->origin->munName,
          $municipal->reiAddressorigin,
          $municipal->reiContact,
          $municipal->reiPhone,
          $municipal->destiny->munName,
          $municipal->reiAddressdestiny,
          'N/A',
          $municipal->reiId
        ]);
      }
  
      sort($dates);

        return view('modules.trackings.confirmation.index', compact('dates'));
    }

    /* ===============================================================================================
			MODULO DE INICIO DE SERVICIO DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

    function startsTo(){
        return view('modules.trackings.start.index');
    }

    /* ===============================================================================================
			MODULO DE SERVICIO EN EJECUCION DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

    function runningsTo(){
        return view('modules.trackings.running.index');
    }

    /* ===============================================================================================
			MODULO DE SERVICIOS FINALIZADOS DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

    function finalizedsTo(){
        return view('modules.trackings.finalized.index');
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
