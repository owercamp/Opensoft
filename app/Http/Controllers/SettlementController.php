<?php

namespace App\Http\Controllers;

use App\Models\BouchersServices;
use App\Models\Term;


use Illuminate\Http\Request;
use App\Models\Requestcharge;
use App\Models\Requestturism;
use App\Models\Orderoccasional;
use App\Models\Requestlogistic;
use App\Models\Contractorcharge;
use App\Models\Requestmessenger;
use App\Models\Contractorespecial;
use Illuminate\Support\Facades\DB;
use App\Models\Contractormessenger;
use App\Models\RequestUrbanTransfer;
use App\Models\RequestshasContractors;
use App\Models\RequestIntermunityTransfer;
use App\Models\Settingmunicipality;
use Exception;

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

    /** CONSULTAS DE LAS SOLICITUDES **/
    $messengers = Requestmessenger::with('permanent.client', 'occasional.proposal')->where('remStatus', '=', 'LIQUIDAR')->get();
    $logistics = Requestlogistic::with('permanent.client', 'occasional.proposal')->where('relStatus', '=', 'LIQUIDAR')->get();
    $charges = Requestcharge::with('permanent.client', 'occasional.proposal')->where('recStatus', '=', 'LIQUIDAR')->get();
    $turisms = Requestturism::with('permanent.client', 'occasional.proposal')->where('retStatus', '=', 'LIQUIDAR')->get();
    $transfers = RequestUrbanTransfer::with('permanent.client', 'occasional.proposal')->where('reuStatus', '=', 'LIQUIDAR')->get();
    $intermunipals = RequestIntermunityTransfer::with('permanent.client', 'occasional.proposal')->where('reiStatus', '=', 'LIQUIDAR')->get();

    $dates = array();

    /*** SE RECORRE LAS SOLICITUDES DE MENSAJERIA ***/
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

    /*** SE RECORRE LAS SOLICITUDES DE LOGISTICA ***/
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

    /*** SE RECORRE LAS SOLICITUDES DE CARGA EXPRESS ***/
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

    /*** SE RECORRE LAS SOLICITUDES DE TURISMO ***/
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

    /*** SE RECORRE LAS SOLICITUDES DE TRASLADO URBANO ***/
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

    /*** SE RECORRE LAS SOLICITUDES DE TRASLADO INTERNACIONAL ***/
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

  function liquidateTo(Request $request)
  {
    /***
     * SE OBTIENE EL ID DE MI CLIENTE POR MEDIO DE LA RELACIONES, AL IGUAL QUE LOS TERMINOS DEL CONTRATO PARA LIQUIDAR EL SERVICIO
     * Y SE RECORRE PARA CAPTURAR EL TERMINO CORRESPONDIENTE DEPENDIENDO DEL TIPO DE SERVICIO
     */
    $arrayData = [];
    /** mensajeria **/
    if ($request->type == "Mensajería Express") {
      $req = Requestmessenger::with('permanent.client:cliId')->where('remId', $request->id)->get()->pluck('permanent.client.cliId')->toArray();
      $terms = Term::with('legalization.client:cliId,cliNamereason')->get()->toArray();

      if (empty($req)) {
        $req = Requestmessenger::with('occasional.proposal:cprId')->where('remId', $request->id)->get()->pluck('occasional.proposal:cprId')->toArray();

        foreach ($terms as $key => $term) {
          if ($term['legalization']['proposal']['cprId'] == $req[0]) {
            $all = explode('=>', $term['terBriefcase']);
            $price = $all[6];
            $service = $all[0];
            $client = $term['legalization']['proposal']['cprClient'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      } else {
        foreach ($terms as $key => $term) {
          if ($term['legalization']['client']['cliId'] == $req[0]) {
            $all = explode('=>', $term['terBriefcase']);
            $price = $all[6];
            $service = $all[0];
            $client = $term['legalization']['client']['cliNamereason'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      }
      /** Logistica **/
    } elseif ($request->type == "Logística Express") {
      $req = Requestlogistic::with('permanent.client:cliId,cliNamereason')->where('relId', $request->id)->get()->pluck('permanent.client.cliId')->toArray();
      $terms = Term::with('legalization.client:cliId,cliNamereason')->get()->toArray();

      if (empty($req[0])) {
        $req = Requestlogistic::with('occasional.proposal:cprId,cprClient')->where('relId', $request->id)->get()->pluck('occasional.proposal.cprId')->toArray();
        $terms = Orderoccasional::with('proposal:cprId,cprClient')->get()->toArray();

        foreach ($terms as $key => $term) {
          if ($term['proposal']['cprId'] == $req[0]) {
            $all = explode('===>', $term['oroAllproposal']);
            $price = $all[10];
            $service = $all[6];
            $client = $term['proposal']['cprClient'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      } else {
        foreach ($terms as $key => $term) {
          if ($term['legalization']['client']['cliId'] == $req[0]) {
            $all = explode('=>', $term['terBriefcase']);
            $price = $all[6];
            $service = $all[0];
            $client = $term['legalization']['client']['cliNamereason'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      }
      /** Carga Express **/
    } elseif ($request->type == "Carga Express") {
      $req = Requestcharge::with('permanent.client:cliId,cliNamereason')->where('recId', $request->id)->get()->pluck('permanent.client.cliId')->toArray();
      $terms = Term::with('legalization.client:cliId,cliNamereason')->get()->toArray();

      if (empty($req[0])) {
        $req = Requestcharge::with('occasional.proposal:cprId,cprClient')->where('recId', $request->id)->get()->pluck('occasional.proposal.cprId')->toArray();
        $terms = Orderoccasional::with('proposal:cprId,cprClient')->get()->toArray();

        foreach ($terms as $key => $term) {
          if ($term['proposal']['cprId'] == $req[0]) {
            $all = explode('===>', $term['oroAllproposal']);
            $price = $all[10];
            $service = $all[6];
            $client = $term['proposal']['cprClient'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      } else {
        foreach ($terms as $key => $term) {
          if ($term['legalization']['client']['cliId'] == $req[0]) {
            $all = explode('=>', $term['terBriefcase']);
            $price = $all[6];
            $service = $all[0];
            $client = $term['legalization']['client']['cliNamereason'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      }
      /** Turismo **/
    } elseif ($request->type == "Turismo Pasajeros") {
      $req = Requestturism::with('permanent.client:cliId,cliNamereason')->where('retId', $request->id)->get()->pluck('permanent.client.cliId')->toArray();
      $terms = Term::with('legalization.client:cliId,cliNamereason')->get()->toArray();

      if (empty($req[0])) {
        $req = Requestturism::with('occasional.proposal:cprId,cprClient')->where('retId', $request->id)->get()->pluck('occasional.proposal.cprId')->toArray();
        $terms = Orderoccasional::with('proposal:cprId,cprClient')->get()->toArray();

        foreach ($terms as $key => $term) {
          if ($term['proposal']['cprId'] == $req[0]) {
            $all = explode('===>', $term['oroAllproposal']);
            $price = $all[10];
            $service = $all[6];
            $client = $term['proposal']['cprClient'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      } else {
        foreach ($terms as $key => $term) {
          if ($term['legalization']['client']['cliId'] == $req[0]) {
            $all = explode('=>', $term['terBriefcase']);
            $price = $all[6];
            $service = $all[0];
            $client = $term['legalization']['client']['cliNamereason'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      }
      /** Traslado Urbano **/
    } elseif ($request->type == "Traslado Urbano") {
      $req = RequestUrbanTransfer::with('permanent.client:cliId,cliNamereason')->where('reuId', $request->id)->get()->pluck('permanent.client.cliId')->toArray();
      $terms = Term::with('legalization.client:cliId,cliNamereason')->get()->toArray();

      if (empty($req[0])) {
        $req = RequestUrbanTransfer::with('occasional.proposal:cprId,cprClient')->where('reuId', $request->id)->get()->pluck('occasional.proposal.cprId')->toArray();
        $terms = Orderoccasional::with('proposal:cprId,cprClient')->get()->toArray();

        foreach ($terms as $key => $term) {
          if ($term['proposal']['cprId'] == $req[0]) {
            $all = explode('===>', $term['oroAllproposal']);
            $price = $all[10];
            $service = $all[6];
            $client = $term['proposal']['cprClient'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      } else {
        foreach ($terms as $key => $term) {
          if ($term['legalization']['client']['cliId'] == $req[0]) {
            $all = explode('=>', $term['terBriefcase']);
            $price = $all[6];
            $service = $all[0];
            $client = $term['legalization']['client']['cliNamereason'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      }
      /** Traslado intermunicipal **/
    } elseif ($request->type == "Traslado Intermunicipal") {
      $req = RequestIntermunityTransfer::with('permanent.client:cliId,cliNamereason')->where('reiId', $request->id)->get()->pluck('permanent.client.cliId')->toArray();
      $terms = Term::with('legalization.client:cliId,cliNamereason')->get()->toArray();

      if (empty($req[0])) {
        $req = RequestIntermunityTransfer::with('occasional.proposal:cprId,cprClient')->where('reiId', $request->id)->get()->pluck('occasional.proposal.cprId')->toArray();
        $terms = Orderoccasional::with('proposal:cprId,cprClient')->get()->toArray();

        foreach ($terms as $key => $term) {
          if ($term['proposal']['cprId'] == $req[0]) {
            $all = explode('===>', $term['oroAllproposal']);
            $price = $all[10];
            $service = $all[6];
            $client = $term['proposal']['cprClient'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      } else {
        foreach ($terms as $key => $term) {
          if ($term['legalization']['client']['cliId'] == $req[0]) {
            $all = explode('=>', $term['terBriefcase']);
            $price = $all[6];
            $service = $all[0];
            $client = $term['legalization']['client']['cliNamereason'];
            $origin = $request->origin;
            $destiny = $request->destiny;
            array_push($arrayData, [
              'id'=>$request->id,
              'price' => $price,
              'service' => $service,
              'client' => $client,
              'origin' => $origin,
              'destiny' => $destiny
            ]);
          }
        }
      }
    }

    /** retorno mi array con la información correspondiente **/
    return response()->json($arrayData);
  }


  function liquidateSave(Request $request)
  {
    /** VALIDACION DE MIS DATOS **/
    $request->validate([
      'typeservices' => 'required|string',
      'origin' => 'required|string',
      'destiny' => 'required|string',
      'price' => 'required|string',
      'colaborator' => 'required|string',
    ]);

    /** TRATAMIENTO DE MIS DATOS **/
    $clean = array("COP",".","$");
    $price = str_replace($clean,"",$request->price);
    $idSeparate = explode("-",$request->typeservices);
    
    $idDestiny = Settingmunicipality::where('munName', $request->destiny)->value('munId');
    $idOrigin = Settingmunicipality::where('munName', $request->origin)->value('munId');

    /** VALIDAMOS DUPLICADOS **/
    $validate = BouchersServices::where([
      ['typeservices', $idSeparate[0]],
      ['origin', $idOrigin],
      ['destiny', $idDestiny],
      ['price', $price],
      ['colaborator', $request->colaborator]
    ])->count();
    if ($validate) {
      return back()->with('Info', 'El servicio ya existe en liquidación');
    }

    DB::beginTransaction();
    try{
      $liquidateNew = new BouchersServices;
      $liquidateNew->typeservices = $idSeparate[0];
      $liquidateNew->origin = $idOrigin;
      $liquidateNew->destiny = $idDestiny;
      $liquidateNew->price = intval($price);
      $liquidateNew->status = "LIQUIDADO";
      $liquidateNew->colaborator = $request->colaborator;
      if($liquidateNew->save()){
        if ($idSeparate[0] == strtoupper("Traslado Urbano")) {
          RequestUrbanTransfer::where('reuId', $idSeparate[1])->update(['reuStatus' => 'LIQUIDADOPCLIENTE']);
        }elseif ($idSeparate[0] == strtoupper("Mensajería Express")) {
          Requestmessenger::where('remId', $idSeparate[1])->update(['remStatus' => 'LIQUIDADOPCLIENTE']);
        }elseif ($idSeparate[0] == strtoupper("Traslado Intermunicipal")) {
          RequestIntermunityTransfer::where('reiId', $idSeparate[1])->update(['reiStatus' => 'LIQUIDADOPCLIENTE']);
        }elseif ($idSeparate[0] == strtoupper("Logística Express")) {
          Requestlogistic::where('relId', $idSeparate[1])->update(['relStatus' => 'LIQUIDADOPCLIENTE']);
        }elseif ($idSeparate[0] == strtoupper("Carga Express")) {
          Requestcharge::where('recId', $idSeparate[1])->update(['recStatus' => 'LIQUIDADOPCLIENTE']);
        }elseif ($idSeparate[0] == strtoupper("Turismo Pasajeros")) {
          Requestturism::where('retId', $idSeparate[1])->update(['retStatus' => 'LIQUIDADOPCLIENTE']);
        }
        DB::commit();
        return back()->with('Success', 'Facturación del Voucher N°'.str_pad($liquidateNew->id,5,"00000",STR_PAD_LEFT).' guardada correctamente');
      }
    }catch(Exception $e){
      DB::rollback();
      return back()->with('Error', 'Error al guardar la facturación del Voucher N° '.str_pad($liquidateNew->id,5,"00000",STR_PAD_LEFT));
    }
  }

  /* ===============================================================================================
			MODULO DE LIQUIDACION PARA OPERADORES DE (LIQUIDACION DE SERVICIOS)
    =============================================================================================== */

  function operatorsTo()
  {
    /** CONSULTA DE LAS SOLICITUDES **/
    $messengers = Requestmessenger::with('permanent.client','occasional.proposal')->where('remStatus', 'LIQUIDADOPCLIENTE')->get();
    $logistics = Requestlogistic::with('permanent.client','occasional.proposal')->where('relStatus', 'LIQUIDADOPCLIENTE')->get();
    $charges = Requestcharge::with('permanent.client','occasional.proposal')->where('recStatus', 'LIQUIDADOPCLIENTE')->get();
    $turisms = Requestturism::with('permanent.client','occasional.proposal')->where('retStatus', 'LIQUIDADOPCLIENTE')->get();
    $urbans = RequesturbanTransfer::with('permanent.client','occasional.proposal')->where('reuStatus', 'LIQUIDADOPCLIENTE')->get();
    $intermunipals = RequestIntermunityTransfer::with('permanent.client','occasional.proposal')->where('reiStatus', 'LIQUIDADOPCLIENTE')->get();

    $dataArray = array();

    /** RECORRIDO DE LAS SOLICITUDES DE MENSAJERIA**/
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

    /** RECORRIDO DE LAS SOLICITUDES DE LOGISTICA**/
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
        (isset($logistic->relObservation)) ? $logistic->relObservation : 'N/A',
        $logistic->relId,
        (isset($collaborator)) ? $collaborator : ''
      ]);
    }

    /** RECORRIDO DE LAS SOLICITUDES DE CARGA EXPRESS **/
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
      array_push($dataArray, [
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
        (isset($charge->recObservation)) ? $charge->recObservation : 'N/A',
        $charge->recId,
        (isset($collaborator)) ? $collaborator : ''
      ]);
    }

    /** RECORRIDO DE LAS SOLICITUDES DE TURISMO **/
    foreach($turisms as $turism){
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

      if($exists){
        $collaborator = Contractorespecial::where('ceId', '=', $exists)->value('ceNames');
      }

      array_push($dataArray,[
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
        (isset($turism->retObservation)) ? $turism->retObservation : 'N/A',
        $turism->retId,
        (isset($collaborator)) ? $collaborator : ''
      ]);
    }

    /** RECORRIDO DE LAS SOLICITUDES DE TRASLADO URBANO **/
    foreach($urbans as $urban){
      $date = Date('Y-m-d', strtotime($urban->reuDateservice));
      $hour = Date('H:i:s', strtotime($urban->reuHourstart));
      if ($urban->reuTypecliente == 'PERMANENTE') {
        $client = $urban->permanent->client->cliNamereason;
      } else {
        $client = $urban->occasional->proposal->cprClient;
      }

      $exists = RequestshasContractors::where([
        ['rc_request', '=', $urban->reuId],
        ['rc_type', '=', 'Traslado Urbano']
      ])->value('rc_contractor');

      if($exists){
        $collaborator = Contractorespecial::where('ceId', '=', $exists)->value('ceNames');
      }

      array_push($dataArray,[
        $date,
        $hour,
        $client,
        'Traslado Urbano',
        $urban->transfer->strService,
        $urban->origin->munName,
        $urban->reuAddressorigin,
        $urban->reuContact,
        $urban->reuPhone,
        $urban->destiny->munName,
        $urban->reuAddressdestiny,
        (isset($urban->reuObservation)) ? $urban->reuObservation : 'N/A',
        $urban->reuId,
        (isset($collaborator)) ? $collaborator : ''
      ]);
    }

    /** RECORRIDO DE LAS SOLICITUDES DE TRASLADO INTERMUNICIPAL **/
    foreach ($intermunipals as $intermunicipal) {
      $date = Date('Y-m-d', strtotime($intermunicipal->reiDateservice));
      $hour = Date('H:i:s', strtotime($intermunicipal->reiHourstart));
      if ($intermunicipal->reiTypecliente == 'PERMANENTE') {
        $client = $intermunicipal->permanent->client->cliNamereason;
      }else {
        $client = $intermunicipal->occasional->proposal->cprClient;
      }

      $exists = RequestshasContractors::where([
        ['rc_request', '=', $intermunicipal->reiId],
        ['rc_type', '=', 'Traslado Intermunicipal']
      ])->value('rc_contractor');

      if($exists){
        $collaborator = Contractorespecial::where('ceId', '=', $exists)->value('ceNames');
      }

      array_push($dataArray,[
        $date,
        $hour,
        $client,
        'Traslado Intermunicipal',
        $intermunicipal->transfer->stmService,
        $intermunicipal->origin->munName,
        $intermunicipal->reiAddressorigin,
        $intermunicipal->reiContact,
        $intermunicipal->reiPhone,
        $intermunicipal->destiny->munName,
        $intermunicipal->reiAddressdestiny,
        (isset($intermunicipal->reiObservation)) ? $intermunicipal->reiObservation : 'N/A',
        $intermunicipal->reiId,
        (isset($collaborator)) ? $collaborator : ''
      ]);
    }

    sort($dataArray,SORT_REGULAR);

    return view('modules.settlements.operators.index', compact('dataArray'));
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
