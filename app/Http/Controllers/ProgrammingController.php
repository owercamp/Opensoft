<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Settingservicetransfermunicipal;
use App\Models\Settingservicemessenger;
use App\Models\Settingservicelogistic;
use App\Models\Settingservicetransfer;
use App\Models\Settingserviceturism;
use App\Models\Settingservicecharge;
use App\Models\Settingmunicipality;
use App\Models\Requestmessenger;
use App\Models\Orderoccasional;
use App\Models\Requestlogistic;
use App\Models\Requestcharge;
use App\Models\RequestIntermunityTransfer;
use App\Models\Requestturism;
use App\Models\RequestUrbanTransfer;

class ProgrammingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /* ===============================================================================================
			MODULO DE ASIGNACION DE OPERADOR DE (PROGRAMACION DE SERVICIOS)
    =============================================================================================== */

  function assignmentsTo()
  {
    $messengers = Requestmessenger::all();
    $logistics = Requestlogistic::all();
    $charges = Requestcharge::all();
    $turisms = Requestturism::all();
    $transfers = RequestUrbanTransfer::all();
    $intermunipals = RequestIntermunityTransfer::all();

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
        $messenger->remObservation
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
        'N/A'
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
        'N/A'
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
        'N/A'
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
        'N/A'
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
        'N/A'
      ]);
    }

    sort($dates);

    return view('modules.programmings.assignment.index', compact('dates'));
  }

  /* ===============================================================================================
			MODULO DE ACEPTACION DE OPERADOR DE (PROGRAMACION DE SERVICIOS)
    =============================================================================================== */

  function acceptancesTo()
  {
    return view('modules.programmings.acceptance.index');
  }

  /* ===============================================================================================
			MODULO DE INFORME DE SERVICIO DE (PROGRAMACION DE SERVICIOS)
    =============================================================================================== */

  function reportsTo()
  {
    return view('modules.programmings.report.index');
  }
}
