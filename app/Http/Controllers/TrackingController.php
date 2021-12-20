<?php

namespace App\Http\Controllers;

use App\Models\Contractorcharge;
use App\Models\Contractorespecial;
use App\Models\Contractormessenger;
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

  function confirmationsTo()
  {
    $messengers = Requestmessenger::all()->where('remStatus', '=', 'ACEPTADO');
    $logistics = Requestlogistic::all()->where('relStatus', '=', 'ACEPTADO');
    $charges = Requestcharge::all()->where('recStatus', '=', 'ACEPTADO');
    $turisms = Requestturism::all()->where('retStatus', '=', 'ACEPTADO');
    $transfers = RequestUrbanTransfer::all()->where('reuStatus', '=', 'ACEPTADO');
    $intermunipals = RequestIntermunityTransfer::all()->where('reiStatus', '=', 'ACEPTADO');

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

    return view('modules.trackings.confirmation.index', compact('dates'));
  }

  function acceptedTo(Request $request)
  {
    if ($request->type == "Mensajería Express") {
      $search = Requestmessenger::find(trim($request->id));
      $search->remStatus = "ACEPTADOCOL";
      $search->save();
    } elseif ($request->type == "Logística Express") {
      $search = Requestlogistic::find(trim($request->id));
      $search->relStatus = "ACEPTADOCOL";
      $search->save();
    } elseif ($request->type == "Carga Express") {
      $search = Requestcharge::find(trim($request->id));
      $search->recStatus = "ACEPTADOCOL";
      $search->save();
    } elseif ($request->type == "Turismo Pasajeros") {
      $search = Requestturism::find(trim($request->id));
      $search->retStatus = "ACEPTADOCOL";
      $search->save();
    } elseif ($request->type == "Traslado Urbano") {
      $search = RequestUrbanTransfer::find(trim($request->id));
      $search->reuStatus = "ACEPTADOCOL";
      $search->save();
    } elseif ($request->type == "Traslado Intermunicipal") {
      $search = RequestIntermunityTransfer::find(trim($request->id));
      $search->reiStatus = "ACEPTADOCOL";
      $search->save();
    }
    return back()->with('Success', 'Servicio aceptado por el Colaborador ' . strtoupper($request->col));
  }

  function rejectedTo(Request $request)
  {
    if ($request->type == "Mensajería Express") {
      $search = Requestmessenger::find(trim($request->id));
      $search->remStatus = "PENDIENTE";
      $search->save();
    } elseif ($request->type == "Logística Express") {
      $search = Requestlogistic::find(trim($request->id));
      $search->relStatus = "PENDIENTE";
      $search->save();
    } elseif ($request->type == "Carga Express") {
      $search = Requestcharge::find(trim($request->id));
      $search->recStatus = "PENDIENTE";
      $search->save();
    } elseif ($request->type == "Turismo Pasajeros") {
      $search = Requestturism::find(trim($request->id));
      $search->retStatus = "PENDIENTE";
      $search->save();
    } elseif ($request->type == "Traslado Urbano") {
      $search = RequestUrbanTransfer::find(trim($request->id));
      $search->reuStatus = "PENDIENTE";
      $search->save();
    } elseif ($request->type == "Traslado Intermunicipal") {
      $search = RequestIntermunityTransfer::find(trim($request->id));
      $search->reiStatus = "PENDIENTE";
      $search->save();
    }

    $validate = RequestshasContractors::where([
      ["rc_request", "=", $request->id],
      ["rc_type", "=", $request->type]
    ])->first();

    if ($validate) {
      RequestshasContractors::destroy($validate->rc_id);
      DB::statement("ALTER TABLE requestshas_contractors AUTO_INCREMENT=1");
      return back()->with('Info', 'Servicio rechazado por el Colaborador ' . strtoupper($request->col));
    }
    return back()->with("Error", "No se encontro el registro");
  }


  /* ===============================================================================================
			MODULO DE INICIO DE SERVICIO DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

  function startsTo()
  {
    $messengers = Requestmessenger::all()->where('remStatus', '=', 'ACEPTADOCOL');
    $logistics = Requestlogistic::all()->where('relStatus', '=', 'ACEPTADOCOL');
    $charges = Requestcharge::all()->where('recStatus', '=', 'ACEPTADOCOL');
    $turisms = Requestturism::all()->where('retStatus', '=', 'ACEPTADOCOL');
    $transfers = RequestUrbanTransfer::all()->where('reuStatus', '=', 'ACEPTADOCOL');
    $intermunipals = RequestIntermunityTransfer::all()->where('reiStatus', '=', 'ACEPTADOCOL');

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

    return view('modules.trackings.start.index', compact('dates'));
  }

  /* ===============================================================================================
			MODULO DE SERVICIO EN EJECUCION DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

  function runningsTo()
  {
    $messengers = Requestmessenger::all()->where('remStatus', '=', 'SERVICIOEJECUCION');
    $logistics = Requestlogistic::all()->where('relStatus', '=', 'SERVICIOEJECUCION');
    $charges = Requestcharge::all()->where('recStatus', '=', 'SERVICIOEJECUCION');
    $turisms = Requestturism::all()->where('retStatus', '=', 'SERVICIOEJECUCION');
    $transfers = RequestUrbanTransfer::all()->where('reuStatus', '=', 'SERVICIOEJECUCION');
    $intermunipals = RequestIntermunityTransfer::all()->where('reiStatus', '=', 'SERVICIOEJECUCION');

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

    return view('modules.trackings.running.index', compact('dates'));
  }

  function initialsTo(Request $request)
  {
    if ($request->type == "Mensajería Express") {
      $search = Requestmessenger::find(trim($request->id));
      $search->remStatus = "SERVICIOEJECUCION";
      $search->save();
    } elseif ($request->type == "Logística Express") {
      $search = Requestlogistic::find(trim($request->id));
      $search->relStatus = "SERVICIOEJECUCION";
      $search->save();
    } elseif ($request->type == "Carga Express") {
      $search = Requestcharge::find(trim($request->id));
      $search->recStatus = "SERVICIOEJECUCION";
      $search->save();
    } elseif ($request->type == "Turismo Pasajeros") {
      $search = Requestturism::find(trim($request->id));
      $search->retStatus = "SERVICIOEJECUCION";
      $search->save();
    } elseif ($request->type == "Traslado Urbano") {
      $search = RequestUrbanTransfer::find(trim($request->id));
      $search->reuStatus = "SERVICIOEJECUCION";
      $search->save();
    } elseif ($request->type == "Traslado Intermunicipal") {
      $search = RequestIntermunityTransfer::find(trim($request->id));
      $search->reiStatus = "SERVICIOEJECUCION";
      $search->save();
    }
    return back()->with('Info', 'Servicio del colaborador ' . strtoupper($request->col) . ' ha sido inicializado');
  }

  /* ===============================================================================================
			MODULO DE SERVICIOS FINALIZADOS DE (SEGUIMIENTO DE SERVICIOS)
    =============================================================================================== */

  function finalizedsTo()
  {
    return view('modules.trackings.finalized.index');
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
