<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Requestcharge;
use App\Models\Requestlogistic;
use App\Models\Requestmessenger;
use App\Models\Requestturism;
use App\Models\RequestUrbanTransfer;
use App\Models\RequestIntermunityTransfer;
use App\Models\RequestshasContractors;
use App\Models\Contractorcharge;
use App\Models\Contractorespecial;
use App\Models\Contractormessenger;

class SettlementController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /* ===============================================================================================
			MODULO DE LIQUIDACION PARA CLIENTES DE (LIQUIDACION DE SERVICIOS)
    =============================================================================================== */

  function clientsTo()
  {
    $messengers = Requestmessenger::all()->where('remStatus', '=', 'LIQUIDAR');
    $logistics = Requestlogistic::all()->where('relStatus', '=', 'LIQUIDAR');
    $charges = Requestcharge::all()->where('recStatus', '=', 'LIQUIDAR');
    $turisms = Requestturism::all()->where('retStatus', '=', 'LIQUIDAR');
    $transfers = RequestUrbanTransfer::all()->where('reuStatus', '=', 'LIQUIDAR');
    $intermunipals = RequestIntermunityTransfer::all()->where('reiStatus', '=', 'LIQUIDAR');

    $dates = array();

    foreach ($messengers as $messenger) {
      $date = Date('Y-m-d', strtotime($messenger->remDateservice));
      $hour = Date('H:i:s', strtotime($messenger->remHourstart));
      if ($messenger->remTypecliente == 'PERMANENTE') {
        $client = $messenger->permanent->client->cliNamereason;
      } else {
        $client = $messenger->occasional->proposal->cprClient;
      }

      $exists = RequestshasContractors::where([
        ['rc_request', '=', $messenger->remId],
        ['rc_type', '=', 'Mensajería Express']
      ])->value('rc_contractor');

      if ($exists) {
        $collaborator = Contractormessenger::where('cmId', '=', $exists)->value('cmNames');
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
        $messenger->remId,
        (isset($collaborator)) ? $collaborator : ''
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

      $exists = RequestshasContractors::where([
        ['rc_request', '=', $logistic->relId],
        ['rc_type', '=', 'Logística Express']
      ])->value('rc_contractor');

      if ($exists) {
        $collaborator = Contractorcharge::where('ccId', '=', $exists)->value('ccNames');
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
        $logistic->relId,
        (isset($collaborator)) ? $collaborator : ''
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

      $exists = RequestshasContractors::where([
        ['rc_request', '=', $charge->recId],
        ['rc_type', '=', 'Carga Express']
      ])->value('rc_contractor');

      if ($exists) {
        $collaborator = Contractorcharge::where('ccId', '=', $exists)->value('ccNames');
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
        $charge->recId,
        (isset($collaborator)) ? $collaborator : ''
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

      $exists = RequestshasContractors::where([
        ['rc_request', '=', $turism->retId],
        ['rc_type', '=', 'Turismo Pasajeros']
      ])->value('rc_contractor');

      if ($exists) {
        $collaborator = Contractorespecial::where('ceId', '=', $exists)->value('ceNames');
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
        $turism->retId,
        (isset($collaborator)) ? $collaborator : ''
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

      $exists = RequestshasContractors::where([
        ['rc_request', '=', $transfer->reuId],
        ['rc_type', '=', 'Traslado Urbano']
      ])->value('rc_contractor');

      if ($exists) {
        $collaborator = Contractorespecial::where('ceId', '=', $exists)->value('ceNames');
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
        $transfer->reuId,
        (isset($collaborator)) ? $collaborator : ''
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

      $exists = RequestshasContractors::where([
        ['rc_request', '=', $municipal->reiId],
        ['rc_type', '=', 'Traslado Intermunicipal']
      ])->value('rc_contractor');

      if ($exists) {
        $collaborator = Contractorespecial::where('ceId', '=', $exists)->value('ceNames');
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
        $municipal->reiId,
        (isset($collaborator)) ? $collaborator : ''
      ]);
    }

    sort($dates);

    return view('modules.settlements.clients.index', compact('dates'));
  }

  /* ===============================================================================================
			MODULO DE LIQUIDACION PARA OPERADORES DE (LIQUIDACION DE SERVICIOS)
    =============================================================================================== */

  function operatorsTo()
  {
    return view('modules.settlements.operators.index');
  }

  /* ===========================================================================================================
            FUNCIONES PARA CONVERTIR CADENAS DE TEXTO (Mayusculas/Minusculas/Solo primera en Mayuscula)
    =========================================================================================================== */

  function upper($string)
  {
    return mb_strtoupper(trim($string), 'UTF-8');
  }

  function lower($string)
  {
    return mb_strtolower(trim($string), 'UTF-8');
  }

  function fu($string)
  {
    return ucfirst(mb_strtolower(trim($string), 'UTF-8'));
  }
}
