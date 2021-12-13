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
use App\Models\RequestshasContractors;
use App\Models\Requestturism;
use App\Models\RequestUrbanTransfer;
use App\Models\Term;

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
    $messengers = Requestmessenger::all()->where('remStatus','=','PENDIENTE');
    $logistics = Requestlogistic::all()->where('relStatus','=','PENDIENTE');
    $charges = Requestcharge::all()->where('recStatus','=','PENDIENTE');
    $turisms = Requestturism::all()->where('retStatus','=','PENDIENTE');
    $transfers = RequestUrbanTransfer::all()->where('reuStatus','=','PENDIENTE');
    $intermunipals = RequestIntermunityTransfer::all()->where('reiStatus','=','PENDIENTE');

    $clients = array();
    $date = Date('Y-m-d');
    // CLIENTES QUE TIENEN PORTAFOLIO DE TRANSPORTE INTERMUNICIPAL EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
    $permanents = Term::select(
      'legalizationscontractual.*',
      'clients.*',
      'terms.*'
    )->join('legalizationscontractual', 'legalizationscontractual.lcoId', 'terms.terLegalization_id')
      ->join('clients', 'clients.cliId', 'legalizationscontractual.lcoClient_id')
      ->where('lcoStatus', 'VIGENTE')
      ->where('terStatus', 'VIGENTE')
      // ->where('terBriefcase', 'LIKE', '%Traslado Intermunicipal%')
      ->where('terDateinitial', '<=', $date)
      ->where('terDatefinal', '>=', $date)
      ->get();
    $occasionals = Orderoccasional::select(
      'orderoccasionals.*',
      'clientproposals.*'
    )->join('clientproposals', 'clientproposals.cprId', 'orderoccasionals.oroClientproposal_id')
      ->where('oroState', 'APROBADO')
      ->where('oroStatus', 'VIGENTE')
      ->where('cprStatus', 'ACEPTADO')
      // ->where('oroAllproposal', 'LIKE', '%Traslado Intermunicipal%')
      ->where('oroDatestart', '<=', $date)
      ->where('oroDateend', '>=', $date)
      ->get();
    foreach ($permanents as $permanent) {
      array_push($clients, [
        $permanent->lcoId,
        $permanent->cliNamereason . ' (Contrato permanente)',
        $permanent->cliNumberdocument,
        $permanent->terDateinitial,
        $permanent->terDatefinal,
        'PERMANENTE'
      ]);
    }

    foreach ($occasionals as $occasional) {
      array_push($clients, [
        $occasional->oroId,
        $occasional->cprClient . ' (Contrato ocasional)',
        $occasional->cprNumberdocument,
        $occasional->oroDatestart,
        $occasional->oroDateend,
        'OCASIONAL'
      ]);
    }

    $municipalities = Settingmunicipality::orderBy('munName', 'asc')->get();

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

    return view('modules.programmings.assignment.index', compact('dates', 'clients', 'municipalities'));
  }

  function destroyTo(Request $request)
  {
    if ($request->type == "Mensajería Express") {
      $search = Requestmessenger::where('remId',$request->id)->first();
      if (!$search) {
        return back()->with('Info','No se encontro el registro');
      }
      Requestmessenger::destroy($request->id);
      DB::statement('ALTER TABLE requestmessengers AUTO_INCREMENT=1');
      return back()->with('Delete','registro eliminado');
    }elseif ($request->type == "Logística Express") {
      $search = Requestlogistic::where('relId',$request->id)->first();
      if (!$search) {
        return back()->with('Info','No se encontro el registro');
      }
      Requestlogistic::destroy($request->id);
      DB::statement('ALTER TABLE requestlogistics AUTO_INCREMENT=1');
      return back()->with('Delete','registro eliminado');
    }elseif ($request->type == "Carga Express") {
      $search = Requestcharge::where('recId',$request->id)->first();
      if (!$search) {
        return back()->with('Info','No se encontro el registro');
      }
      Requestcharge::destroy($request->id);
      DB::statement('ALTER TABLE requestcharges AUTO_INCREMENT=1');
      return back()->with('Delete','registro eliminado');
    }elseif ($request->type == "Turismo Pasajeros") {
      $search = Requestturism::where('retId',$request->id)->first();
      if (!$search) {
        return back()->with('Info','No se encontro el registro');
      }
      Requestturism::destroy($request->id);
      DB::statement('ALTER TABLE requestturisms AUTO_INCREMENT=1');
      return back()->with('Delete','registro eliminado');
    }elseif ($request->type == "Traslado Urbano") {
      $search = RequestUrbanTransfer::where('reuId',$request->id)->first();
      if (!$search) {
        return back()->with('Info','No se encontro el registro');
      }
      RequestUrbanTransfer::destroy($request->id);
      DB::statement('ALTER TABLE request_urban_transfers AUTO_INCREMENT=1');
      return back()->with('Delete','registro eliminado');
    }elseif ($request->type == "Traslado Intermunicipal") {
      $search = RequestIntermunityTransfer::where('reiId',$request->id)->first(); 
      if (!$search) {
        return back()->with('Info','No se encontro el registro');
      }
      RequestIntermunityTransfer::destroy($request->id);
      DB::statement('ALTER TABLE request_intermunity_transfers AUTO_INCREMENT=1');
      return back()->with('Delete','registro eliminado');
    }
  }

  function asignTo(Request $request)
  {
    if ($request->type == "Mensajería Express") {
      $search = Requestmessenger::find(trim($request->tblid));
      $search->remStatus = "EJECUTANDO";
      $search->save();
    }elseif ($request->type == "Logística Express") {
      $search = Requestlogistic::find(trim($request->tblid));
      $search->relStatus = "EJECUTANDO";
      $search->save();
    }elseif ($request->type == "Carga Express") {
      $search = Requestcharge::find(trim($request->tblid));
      $search->recStatus = "EJECUTANDO";
      $search->save();
    }elseif ($request->type == "Turismo Pasajeros") {
      $search = Requestturism::find(trim($request->tblid));
      $search->retStatus = "EJECUTANDO";
      $search->save();
    }elseif ($request->type == "Traslado Urbano") {
      $search = RequestUrbanTransfer::find(trim($request->tblid));
      $search->reuStatus = "EJECUTANDO";
      $search->save();
    }elseif ($request->type == "Traslado Intermunicipal") {
      $search = RequestIntermunityTransfer::find(trim($request->tblid));
      $search->reiStatus = "EJECUTANDO";
      $search->save();
    }

    RequestshasContractors::create([
      "rc_request" => $request->tblid,
      "rc_contractor" => $request->id,
      "rc_type" => $request->type
    ]);

    return back()->with("Success", "Contratista Asignado");
  }

  /* ===============================================================================================
			MODULO DE ACEPTACION DE OPERADOR DE (PROGRAMACION DE SERVICIOS)
    =============================================================================================== */

  function acceptancesTo()
  {
    $messengers = Requestmessenger::all()->where('remStatus','=','EJECUTANDO');
    $logistics = Requestlogistic::all()->where('relStatus','=','EJECUTANDO');
    $charges = Requestcharge::all()->where('recStatus','=','EJECUTANDO');
    $turisms = Requestturism::all()->where('retStatus','=','EJECUTANDO');
    $transfers = RequestUrbanTransfer::all()->where('reuStatus','=','EJECUTANDO');
    $intermunipals = RequestIntermunityTransfer::all()->where('reiStatus','=','EJECUTANDO');

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

    return view('modules.programmings.acceptance.index',compact('dates'));
  }

  function rejected(Request $request)
  {
    if ($request->type == "Mensajería Express") {
      $search = Requestmessenger::find(trim($request->id));
      $search->remStatus = "PENDIENTE";
      $search->save();
    }elseif ($request->type == "Logística Express") {
      $search = Requestlogistic::find(trim($request->id));
      $search->relStatus = "PENDIENTE";
      $search->save();
    }elseif ($request->type == "Carga Express") {
      $search = Requestcharge::find(trim($request->id));
      $search->recStatus = "PENDIENTE";
      $search->save();
    }elseif ($request->type == "Turismo Pasajeros") {
      $search = Requestturism::find(trim($request->id));
      $search->retStatus = "PENDIENTE";
      $search->save();
    }elseif ($request->type == "Traslado Urbano") {
      $search = RequestUrbanTransfer::find(trim($request->id));
      $search->reuStatus = "PENDIENTE";
      $search->save();
    }elseif ($request->type == "Traslado Intermunicipal") {
      $search = RequestIntermunityTransfer::find(trim($request->id));
      $search->reiStatus = "PENDIENTE";
      $search->save();
    }

    $validate = RequestshasContractors::where([
      ["rc_request","=",$request->id],
      ["rc_type","=",$request->type]
    ])->first();

    if ($validate) {
      RequestshasContractors::destroy($validate->rc_id);
      DB::statement("ALTER TABLE requestshas_contractors AUTO_INCREMENT=1");
      return back()->with("Info","Solicitud Rechazada");
    }
    return back()->with("Error","No se encontro el registro");
  }

  /* ===============================================================================================
			MODULO DE INFORME DE SERVICIO DE (PROGRAMACION DE SERVICIOS)
    =============================================================================================== */

  function reportsTo()
  {
    return view('modules.programmings.report.index');
  }
}
