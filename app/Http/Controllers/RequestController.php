<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// CONTRATOS PERMANENTES

/*
    $term->terLegalization_id => LEGALIZACION
    $term->terDateinitial => FECHA INICIAL DE CONDICIONES ECONOMICAS
    $term->terDatefinal => FECHA FINAL DE CONDICIONES ECONOMICAS
    $term->terBriefcase => PORTAFOLIOS
    $term->terStatus => ESTADO DE CONDICIONES ECONOMICAS - VIGENTE/TERMINADO
*/
use App\Models\Term; // CAMPO terBriefcase TIENE LOS PORTAFOLIOS

/*
    $legalization->lcoDocument_id => TIPO DE DOCUMENTO DE CLIENTE
    $legalization->lcoClient_id => CLIENTE ID TABLE clients
    $legalization->lcoConfigdocument_id =>
    $legalization->lcoContentfinal => CONTENIDO FINAL DE CONTRATO
    $legalization->lcoWrited => VARIABLES ESCRITAS EN CONTRATO (VARIABLES DINAMICAS)
    $legalization->lcoStatus => ESTADO DE CONTRATO - VIGENTE/TERMINADO
*/
use App\Models\Client;
use App\Models\Legalizationcontractual;

// CONTRATOS OCASIONALES

/*
    $occasional->oroDocument_id => TIPO DE DOCUMENTO DE CLIENTE
    $occasional->oroDocumentcode => CLIENTE ID
    $occasional->oroDdatestart =>
    $occasional->oroDdateend =>
    $occasional->oroClientproposal_id =>
    $occasional->oroAllProposal =>
    $occasional->oroConfigdocument_id =>
    $occasional->oroContentfinal => CONTENIDO FINAL DE CONTRATO
    $occasional->oroWrited => VARIABLES ESCRITAS EN CONTRATO (VARIABLES DINAMICAS)
    $occasional->oroStatus => ESTADO DE CONTRATO
*/
use App\Models\Orderoccasional; // CAMPO oroAllproposal TIENE LOS PORTAFOLIOS


use App\Models\Settingservicetransfermunicipal;
use App\Models\Settingservicemessenger;
use App\Models\Settingservicelogistic;
use App\Models\Settingservicetransfer;
use App\Models\Settingserviceturism;
use App\Models\Settingservicecharge;
use App\Models\Settingmunicipality;
use App\Models\Requestmessenger;
use App\Models\Requestlogistic;
use App\Models\Requestcharge;
use App\Models\RequestIntermunityTransfer;
use App\Models\Requestturism;
use App\Models\RequestUrbanTransfer;

class RequestController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /* ===============================================================================================
			MODULO DE MENSAJERIA EXPRESS DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

  function messengersExpressTo()
  {
    $clients = array();
    $date = Date('Y-m-d');
    // CLIENTES QUE TIENEN PORTAFOLIO DE MENSAJERIA EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
    $permanents = Term::select(
      'legalizationscontractual.*',
      'clients.*',
      'terms.*'
    )->join('legalizationscontractual', 'legalizationscontractual.lcoId', 'terms.terLegalization_id')
      ->join('clients', 'clients.cliId', 'legalizationscontractual.lcoClient_id')
      ->where('lcoStatus', 'VIGENTE')
      ->where('terStatus', 'VIGENTE')
      ->where('terBriefcase', 'LIKE', '%Mensajería Express%')
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
      ->where('oroAllproposal', 'LIKE', '%Mensajería Express%')
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
    asort($clients);
    $servicemessengers = Settingservicemessenger::all();
    $municipalities = Settingmunicipality::orderBy('munName', 'asc')->get();
    return view('modules.requests.messenger.index', compact('clients', 'servicemessengers', 'municipalities'));
  }

  function messengersSave(Request $request)
  {
    // dd($request->all());
    /*
            $request->remClient
            $request->remMessenger_id
            $request->remDateservice
            $request->remHourstart
            $request->remMunicipalityorigin_id
            $request->remAddressorigin
            $request->remMunicipalitydestiny_id
            $request->remAddressdestiny
            $request->remContact
            $request->remPhone
            $request->remObservation

            $colletion->remTypecliente   ===> PERMANENTE/OCASIONAL
            $colletion->remClientpermanent_id
            $colletion->remClientoccasional_id
            $colletion->remMessenger_id
            $colletion->remDateservice
            $colletion->remHourstart
            $colletion->remAddressdestiny
            $colletion->remMunicipalitydestiny_id
            $colletion->remAddressorigin
            $colletion->remMunicipalityorigin_id
            $colletion->remContact
            $colletion->remPhone
            $colletion->remObservation
        */
    $dateservice = Date('Y-m-d', strtotime($request->remDateservice));
    if (trim($request->remTypecliente) === 'PERMANENTE') {
      $validate = Requestmessenger::where('remClientpermanent_id', trim($request->remClient))
        ->where('remDateservice', $dateservice)
        ->where('remMunicipalitydestiny_id', trim($request->remMunicipalitydestiny_id))
        ->where('remMunicipalityorigin_id', trim($request->remMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        Requestmessenger::create([
          'remTypecliente' => 'PERMANENTE',
          'remClientpermanent_id' => trim($request->remClient),
          'remClientoccasional_id' => null,
          'remMessenger_id' => trim($request->remMessenger_id), // tipo de servicio seleccionado de las configuraciones
          'remDateservice' => $dateservice,
          'remHourstart' => trim($request->remHourstart),
          'remAddressdestiny' => $this->upper($request->remAddressdestiny),
          'remMunicipalitydestiny_id' => trim($request->remMunicipalitydestiny_id),
          'remAddressorigin' => $this->upper($request->remAddressorigin),
          'remMunicipalityorigin_id' => trim($request->remMunicipalityorigin_id),
          'remContact' => $this->fu($request->remContact),
          'remPhone' => trim($request->remPhone),
          'remObservation' => $this->fu($request->remObservation)
        ]);
        return redirect()->route('request.messenger')->with('SuccessMessenger', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return redirect()->route('request.messenger')->with('SecondaryMessenger', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else if (trim($request->remTypecliente) === 'OCASIONAL') {
      $validate = Requestmessenger::where('remClientoccasional_id', trim($request->remClient))
        ->where('remDateservice', $dateservice)
        ->where('remMunicipalitydestiny_id', trim($request->remMunicipalitydestiny_id))
        ->where('remMunicipalityorigin_id', trim($request->remMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        Requestmessenger::create([
          'remTypecliente' => 'OCASIONAL',
          'remClientpermanent_id' => null,
          'remClientoccasional_id' => trim($request->remClient),
          'remMessenger_id' => trim($request->remMessenger_id), // tipo de servicio seleccionado de las configuraciones
          'remDateservice' => $dateservice,
          'remHourstart' => trim($request->remHourstart),
          'remAddressdestiny' => $this->upper($request->remAddressdestiny),
          'remMunicipalitydestiny_id' => trim($request->remMunicipalitydestiny_id),
          'remAddressorigin' => $this->upper($request->remAddressorigin),
          'remMunicipalityorigin_id' => trim($request->remMunicipalityorigin_id),
          'remContact' => $this->fu($request->remContact),
          'remPhone' => trim($request->remPhone),
          'remObservation' => $this->fu($request->remObservation)
        ]);
        return redirect()->route('request.messenger')->with('SuccessMessenger', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return redirect()->route('request.messenger')->with('SecondaryMessenger', 'Ya existe un registro como el indicado, consulte los registros pendientes de asignación');
      }
    } else {
      return redirect()->route('request.messenger')->with('SecondaryMessenger', 'No se encuentra el tipo de cliente (' . trim($request->remTypecliente) . '), intentelo de nuevo');
    }
  }

  /* ===============================================================================================
			MODULO DE LOGISTICA EXPRESS DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

  function logisticExpressTo()
  {
    $clients = array();
    $date = Date('Y-m-d');
    // CLIENTES QUE TIENEN PORTAFOLIO DE LOGISTICA EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
    $permanents = Term::select(
      'legalizationscontractual.*',
      'clients.*',
      'terms.*'
    )->join('legalizationscontractual', 'legalizationscontractual.lcoId', 'terms.terLegalization_id')
      ->join('clients', 'clients.cliId', 'legalizationscontractual.lcoClient_id')
      ->where('lcoStatus', 'VIGENTE')
      ->where('terStatus', 'VIGENTE')
      ->where('terBriefcase', 'LIKE', '%Logística Express%')
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
      ->where('oroAllproposal', 'LIKE', '%Logística Express%')
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
    asort($clients);
    $servicelogistics = Settingservicelogistic::all();
    $municipalities = Settingmunicipality::orderBy('munName', 'asc')->get();
    return view('modules.requests.logistic.index', compact('clients', 'servicelogistics', 'municipalities'));
  }

  function logisticSave(Request $request)
  {
    // dd($request->all());
    /*
            $request->relClient
            $request->relLogistic_id
            $request->relDateservice
            $request->relHourstart
            $request->relMunicipalityorigin_id
            $request->relAddressorigin
            $request->relMunicipalitydestiny_id
            $request->relAddressdestiny
            $request->relContact
            $request->relPhone

            $colletion->relTypecliente   ===> PERMANENTE/OCASIONAL
            $colletion->relClientpermanent_id
            $colletion->relClientoccasional_id
            $colletion->relLogistic_id
            $colletion->relDateservice
            $colletion->relHourstart
            $colletion->relAddressdestiny
            $colletion->relMunicipalitydestiny_id
            $colletion->relAddressorigin
            $colletion->relMunicipalityorigin_id
            $colletion->relContact
            $colletion->relPhone
        */
    $dateservice = Date('Y-m-d', strtotime($request->relDateservice));
    if (trim($request->relTypecliente) === 'PERMANENTE') {
      $validate = Requestlogistic::where('relClientpermanent_id', trim($request->relClient))
        ->where('relDateservice', $dateservice)
        ->where('relMunicipalitydestiny_id', trim($request->relMunicipalitydestiny_id))
        ->where('relMunicipalityorigin_id', trim($request->relMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        Requestlogistic::create([
          'relTypecliente' => 'PERMANENTE',
          'relClientpermanent_id' => trim($request->relClient),
          'relClientoccasional_id' => null,
          'relLogistic_id' => trim($request->relLogistic_id), // tipo de servicio seleccionado de las configuraciones
          'relDateservice' => $dateservice,
          'relHourstart' => trim($request->relHourstart),
          'relAddressdestiny' => $this->upper($request->relAddressdestiny),
          'relMunicipalitydestiny_id' => trim($request->relMunicipalitydestiny_id),
          'relAddressorigin' => $this->upper($request->relAddressorigin),
          'relMunicipalityorigin_id' => trim($request->relMunicipalityorigin_id),
          'relContact' => $this->fu($request->relContact),
          'relPhone' => trim($request->relPhone)
        ]);
        return redirect()->route('request.logistic')->with('SuccessLogistic', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return redirect()->route('request.logistic')->with('SecondaryLogistic', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else if (trim($request->relTypecliente) === 'OCASIONAL') {
      $validate = Requestlogistic::where('relClientpermanent_id', trim($request->relClient))
        ->where('relDateservice', $dateservice)
        ->where('relMunicipalitydestiny_id', trim($request->relMunicipalitydestiny_id))
        ->where('relMunicipalityorigin_id', trim($request->relMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        Requestlogistic::create([
          'relTypecliente' => 'OCASIONAL',
          'relClientpermanent_id' => null,
          'relClientoccasional_id' => trim($request->relClient),
          'relLogistic_id' => trim($request->relLogistic_id), // tipo de servicio seleccionado de las configuraciones
          'relDateservice' => $dateservice,
          'relHourstart' => trim($request->relHourstart),
          'relAddressdestiny' => $this->upper($request->relAddressdestiny),
          'relMunicipalitydestiny_id' => trim($request->relMunicipalitydestiny_id),
          'relAddressorigin' => $this->upper($request->relAddressorigin),
          'relMunicipalityorigin_id' => trim($request->relMunicipalityorigin_id),
          'relContact' => $this->fu($request->relContact),
          'relPhone' => trim($request->relPhone)
        ]);
        return redirect()->route('request.logistic')->with('SuccessLogistic', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return redirect()->route('request.logistic')->with('SecondaryLogistic', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else {
      return redirect()->route('request.logistic')->with('SecondaryLogistic', 'No se encuentra el tipo de cliente (' . trim($request->relTypecliente) . '), intentelo de nuevo');
    }
  }

  /* ===============================================================================================
			MODULO DE CARGA EXPRESS DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

  function chargeExpressTo()
  {
    $clients = array();
    $date = Date('Y-m-d');
    // CLIENTES QUE TIENEN PORTAFOLIO DE CARGA EXPRESS EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
    $permanents = Term::select(
      'legalizationscontractual.*',
      'clients.*',
      'terms.*'
    )->join('legalizationscontractual', 'legalizationscontractual.lcoId', 'terms.terLegalization_id')
      ->join('clients', 'clients.cliId', 'legalizationscontractual.lcoClient_id')
      ->where('lcoStatus', 'VIGENTE')
      ->where('terStatus', 'VIGENTE')
      ->where('terBriefcase', 'LIKE', '%Carga Express%')
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
      ->where('oroAllproposal', 'LIKE', '%Carga Express%')
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
    asort($clients);
    $servicecharges = Settingservicecharge::all();
    $municipalities = Settingmunicipality::orderBy('munName', 'asc')->get();
    return view('modules.requests.charge.index', compact('clients', 'servicecharges', 'municipalities'));
  }

  function chargeSave(Request $request)
  {
    // dd($request->all());
    /*
            $request->recClient
            $request->recCharge_id
            $request->recDateservice
            $request->recHourstart
            $request->recMunicipalityorigin_id
            $request->recAddressorigin
            $request->recMunicipalitydestiny_id
            $request->recAddressdestiny
            $request->recContact
            $request->recPhone

            $colletion->recTypecliente   ===> PERMANENTE/OCASIONAL
            $colletion->recClientpermanent_id
            $colletion->recClientoccasional_id
            $colletion->recCharge_id
            $colletion->recDateservice
            $colletion->recHourstart
            $colletion->recAddressdestiny
            $colletion->recMunicipalitydestiny_id
            $colletion->recAddressorigin
            $colletion->recMunicipalityorigin_id
            $colletion->recContact
            $colletion->recPhone
        */
    $dateservice = Date('Y-m-d', strtotime($request->recDateservice));
    if (trim($request->recTypecliente) === 'PERMANENTE') {
      $validate = Requestcharge::where('recClientpermanent_id', trim($request->recClient))
        ->where('recDateservice', $dateservice)
        ->where('recMunicipalitydestiny_id', trim($request->recMunicipalitydestiny_id))
        ->where('recMunicipalityorigin_id', trim($request->recMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        Requestcharge::create([
          'recTypecliente' => 'PERMANENTE',
          'recClientpermanent_id' => trim($request->recClient),
          'recClientoccasional_id' => null,
          'recCharge_id' => trim($request->recCharge_id), // tipo de servicio seleccionado de las configuraciones
          'recDateservice' => $dateservice,
          'recHourstart' => trim($request->recHourstart),
          'recAddressdestiny' => $this->upper($request->recAddressdestiny),
          'recMunicipalitydestiny_id' => trim($request->recMunicipalitydestiny_id),
          'recAddressorigin' => $this->upper($request->recAddressorigin),
          'recMunicipalityorigin_id' => trim($request->recMunicipalityorigin_id),
          'recContact' => $this->fu($request->recContact),
          'recPhone' => trim($request->recPhone)
        ]);
        return redirect()->route('request.charge')->with('SuccessCharge', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return redirect()->route('request.charge')->with('SecondaryCharge', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else if (trim($request->recTypecliente) === 'OCASIONAL') {
      $validate = Requestcharge::where('recClientpermanent_id', trim($request->recClient))
        ->where('recDateservice', $dateservice)
        ->where('recMunicipalitydestiny_id', trim($request->recMunicipalitydestiny_id))
        ->where('recMunicipalityorigin_id', trim($request->recMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        Requestcharge::create([
          'recTypecliente' => 'OCASIONAL',
          'recClientpermanent_id' => null,
          'recClientoccasional_id' => trim($request->recClient),
          'recCharge_id' => trim($request->recCharge_id), // tipo de servicio seleccionado de las configuraciones
          'recDateservice' => $dateservice,
          'recHourstart' => trim($request->recHourstart),
          'recAddressdestiny' => $this->upper($request->recAddressdestiny),
          'recMunicipalitydestiny_id' => trim($request->recMunicipalitydestiny_id),
          'recAddressorigin' => $this->upper($request->recAddressorigin),
          'recMunicipalityorigin_id' => trim($request->recMunicipalityorigin_id),
          'recContact' => $this->fu($request->recContact),
          'recPhone' => trim($request->recPhone)
        ]);
        return redirect()->route('request.charge')->with('SuccessCharge', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return redirect()->route('request.charge')->with('SecondaryCharge', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else {
      return redirect()->route('request.charge')->with('SecondaryCharge', 'No se encuentra el tipo de cliente (' . trim($request->recTypecliente) . '), intentelo de nuevo');
    }
  }

  /* ===============================================================================================
			MODULO DE TURISMO PASAJEROS DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

  function turismTo()
  {
    $clients = array();
    $date = Date('Y-m-d');
    // CLIENTES QUE TIENEN PORTAFOLIO DE TURISMO EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
    $permanents = Term::select(
      'legalizationscontractual.*',
      'clients.*',
      'terms.*'
    )->join('legalizationscontractual', 'legalizationscontractual.lcoId', 'terms.terLegalization_id')
      ->join('clients', 'clients.cliId', 'legalizationscontractual.lcoClient_id')
      ->where('lcoStatus', 'VIGENTE')
      ->where('terStatus', 'VIGENTE')
      ->where('terBriefcase', 'LIKE', '%Turismo Pasajeros%')
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
      ->where('oroAllproposal', 'LIKE', '%Turismo Pasajeros%')
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
    asort($clients);
    $serviceturisms = Settingserviceturism::all();
    $municipalities = Settingmunicipality::orderBy('munName', 'asc')->get();
    return view('modules.requests.turism.index', compact('clients', 'serviceturisms', 'municipalities'));
  }

  function turismSave(Request $request)
  {
    // dd($request->all());
    /*
            $request->retClient
            $request->retBriefcasecharge_id
            $request->retDateservice
            $request->retHourstart
            $request->retMunicipalityorigin_id
            $request->retAddressorigin
            $request->retMunicipalitydestiny_id
            $request->retAddressdestiny
            $request->retContact
            $request->retPhone

            $colletion->retTypecliente   ===> PERMANENTE/OCASIONAL
            $colletion->retClientpermanent_id
            $colletion->retClientoccasional_id
            $colletion->retTurism_id
            $colletion->retDateservice
            $colletion->retHourstart
            $colletion->retAddressdestiny
            $colletion->retMunicipalitydestiny_id
            $colletion->retAddressorigin
            $colletion->retMunicipalityorigin_id
            $colletion->retContact
            $colletion->retPhone
        */
    $dateservice = Date('Y-m-d', strtotime($request->retDateservice));
    if (trim($request->retTypecliente) === 'PERMANENTE') {
      $validate = Requestturism::where('retClientpermanent_id', trim($request->retClient))
        ->where('retDateservice', $dateservice)
        ->where('retMunicipalitydestiny_id', trim($request->retMunicipalitydestiny_id))
        ->where('retMunicipalityorigin_id', trim($request->retMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        Requestturism::create([
          'retTypecliente' => 'PERMANENTE',
          'retClientpermanent_id' => trim($request->retClient),
          'retClientoccasional_id' => null,
          'retTurism_id' => trim($request->retTurism_id), // tipo de servicio seleccionado de las configuraciones
          'retDateservice' => $dateservice,
          'retHourstart' => trim($request->retHourstart),
          'retAddressdestiny' => $this->upper($request->retAddressdestiny),
          'retMunicipalitydestiny_id' => trim($request->retMunicipalitydestiny_id),
          'retAddressorigin' => $this->upper($request->retAddressorigin),
          'retMunicipalityorigin_id' => trim($request->retMunicipalityorigin_id),
          'retContact' => $this->fu($request->retContact),
          'retPhone' => trim($request->retPhone)
        ]);
        return redirect()->route('request.turism')->with('SuccessTurism', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return redirect()->route('request.turism')->with('SecondaryTurism', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else if (trim($request->retTypecliente) === 'OCASIONAL') {
      $validate = Requestturism::where('recClientpermanent_id', trim($request->recClient))
        ->where('recDateservice', $dateservice)
        ->where('recMunicipalitydestiny_id', trim($request->recMunicipalitydestiny_id))
        ->where('recMunicipalityorigin_id', trim($request->recMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        Requestturism::create([
          'retTypecliente' => 'OCASIONAL',
          'retClientpermanent_id' => null,
          'retClientoccasional_id' => trim($request->retClient),
          'retTurism_id' => trim($request->retTurism_id), // tipo de servicio seleccionado de las configuraciones
          'retDateservice' => $dateservice,
          'retHourstart' => trim($request->retHourstart),
          'retAddressdestiny' => $this->upper($request->retAddressdestiny),
          'retMunicipalitydestiny_id' => trim($request->retMunicipalitydestiny_id),
          'retAddressorigin' => $this->upper($request->retAddressorigin),
          'retMunicipalityorigin_id' => trim($request->retMunicipalityorigin_id),
          'retContact' => $this->fu($request->retContact),
          'retPhone' => trim($request->retPhone)
        ]);
        return redirect()->route('request.turism')->with('SuccessTurism', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return redirect()->route('request.turism')->with('SecondaryTurism', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else {
      return redirect()->route('request.turism')->with('SecondaryTurism', 'No se encuentra el tipo de cliente (' . trim($request->retTypecliente) . '), intentelo de nuevo');
    }
  }

  /* ===============================================================================================
            MODULO DE TRASLADO DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

  function transferTo()
  {
    $clients = array();
    $date = Date('Y-m-d');
    // CLIENTES QUE TIENEN PORTAFOLIO DE TRASLADO URBANO EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
    $permanents = Term::select(
      'legalizationscontractual.*',
      'clients.*',
      'terms.*'
    )->join('legalizationscontractual', 'legalizationscontractual.lcoId', 'terms.terLegalization_id')
      ->join('clients', 'clients.cliId', 'legalizationscontractual.lcoClient_id')
      ->where('lcoStatus', 'VIGENTE')
      ->where('terStatus', 'VIGENTE')
      ->where('terBriefcase', 'LIKE', '%Traslado Urbano%')
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
      ->where('oroAllproposal', 'LIKE', '%Traslado Urbano%')
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
    asort($clients);
    $servicetransfers = Settingservicetransfer::all();
    $municipalities = Settingmunicipality::orderBy('munName', 'asc')->get();
    return view('modules.requests.transfer.index', compact('clients', 'servicetransfers', 'municipalities'));
  }

  function transferSave(Request $request)
  {
    $dateservice = Date('Y-m-d', strtotime($request->reuDateservice));
    if (trim($request->reuTypecliente) === 'PERMANENTE') {
      $validate = RequestUrbanTransfer::where('reuClientpermanent_id', trim($request->reuClient))
        ->where('reuDateservice', $dateservice)
        ->where('reuMunicipalitydestiny_id', trim($request->reuMunicipalitydestiny_id))
        ->where('reuMunicipalityorigin_id', trim($request->reuMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        RequestUrbanTransfer::create([
          'reuTypecliente' => 'PERMANENTE',
          'reuClientpermanent_id' => trim($request->reuClient),
          'reuClientoccasional_id' => null,
          'reuTransfer_id' => trim($request->reuTransfer_id), // tipo de servicio seleccionado de las configuraciones
          'reuDateservice' => $dateservice,
          'reuHourstart' => trim($request->reuHourstart),
          'reuAddressdestiny' => $this->upper($request->reuAddressdestiny),
          'reuMunicipalitydestiny_id' => trim($request->reuMunicipalitydestiny_id),
          'reuAddressorigin' => $this->upper($request->reuAddressorigin),
          'reuMunicipalityorigin_id' => trim($request->reuMunicipalityorigin_id),
          'reuContact' => $this->fu($request->reuContact),
          'reuPhone' => trim($request->reuPhone)
        ]);
        return back()->with('Success', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return back()->with('Secondary', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else if (trim($request->reuTypecliente) === 'OCASIONAL') {
      $validate = RequestUrbanTransfer::where('reuClientpermanent_id', trim($request->reuClient))
        ->where('reuDateservice', $dateservice)
        ->where('reuMunicipalitydestiny_id', trim($request->reuMunicipalitydestiny_id))
        ->where('reuMunicipalityorigin_id', trim($request->reuMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        RequestUrbanTransfer::create([
          'reuTypecliente' => 'OCASIONAL',
          'reuClientpermanent_id' => null,
          'reuClientoccasional_id' => trim($request->reuClient),
          'reuTransfer_id' => trim($request->reuTransfer_id), // tipo de servicio seleccionado de las configuraciones
          'reuDateservice' => $dateservice,
          'reuHourstart' => trim($request->reuHourstart),
          'reuAddressdestiny' => $this->upper($request->reuAddressdestiny),
          'reuMunicipalitydestiny_id' => trim($request->reuMunicipalitydestiny_id),
          'reuAddressorigin' => $this->upper($request->reuAddressorigin),
          'reuMunicipalityorigin_id' => trim($request->reuMunicipalityorigin_id),
          'reuContact' => $this->fu($request->reuContact),
          'reuPhone' => trim($request->reuPhone)
        ]);
        return back()->with('Success', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return back()->with('Secondary', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else {
      return back()->with('Secondary', 'No se encuentra el tipo de cliente (' . trim($request->reuTypecliente) . '), intentelo de nuevo');
    }
  }

  /* ===============================================================================================
            MODULO DE TRASLADO INTERMUNICIPAL DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

  function transferintermunicipalTo()
  {
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
      ->where('terBriefcase', 'LIKE', '%Traslado Intermunicipal%')
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
      ->where('oroAllproposal', 'LIKE', '%Traslado Intermunicipal%')
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
    asort($clients);
    $servicetransfers = Settingservicetransfermunicipal::all();
    $municipalities = Settingmunicipality::orderBy('munName', 'asc')->get();
    return view('modules.requests.transferintermunicipal.index', compact('clients', 'servicetransfers', 'municipalities'));
  }

  function transferintermunicipalSave(Request $request)
  {
    $dateservice = Date('Y-m-d', strtotime($request->reiDateservice));
    if (trim($request->reiTypecliente) === 'PERMANENTE') {
      $validate = RequestIntermunityTransfer::where('reiClientpermanent_id', trim($request->reiClient))
        ->where('reiDateservice', $dateservice)
        ->where('reiMunicipalitydestiny_id', trim($request->reiMunicipalitydestiny_id))
        ->where('reiMunicipalityorigin_id', trim($request->reiMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        RequestIntermunityTransfer::create([
          'reiTypecliente' => 'PERMANENTE',
          'reiClientpermanent_id' => trim($request->reiClient),
          'reiClientoccasional_id' => null,
          'reiTransfer_id' => trim($request->reiTransfer_id), // tipo de servicio seleccionado de las configuraciones
          'reiDateservice' => $dateservice,
          'reiHourstart' => trim($request->reiHourstart),
          'reiAddressdestiny' => $this->upper($request->reiAddressdestiny),
          'reiMunicipalitydestiny_id' => trim($request->reiMunicipalitydestiny_id),
          'reiAddressorigin' => $this->upper($request->reiAddressorigin),
          'reiMunicipalityorigin_id' => trim($request->reiMunicipalityorigin_id),
          'reiContact' => $this->fu($request->reiContact),
          'reiPhone' => trim($request->reiPhone)
        ]);
        return back()->with('Success', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return back()->with('Secondary', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else if (trim($request->reiTypecliente) === 'OCASIONAL') {
      $validate = RequestIntermunityTransfer::where('reiClientpermanent_id', trim($request->reiClient))
        ->where('reiDateservice', $dateservice)
        ->where('reiMunicipalitydestiny_id', trim($request->reiMunicipalitydestiny_id))
        ->where('reiMunicipalityorigin_id', trim($request->reiMunicipalityorigin_id))
        ->first();
      if ($validate === null) {
        RequestIntermunityTransfer::create([
          'reiTypecliente' => 'OCASIONAL',
          'reiClientpermanent_id' => null,
          'reiClientoccasional_id' => trim($request->reiClient),
          'reiTransfer_id' => trim($request->reiTransfer_id), // tipo de servicio seleccionado de las configuraciones
          'reiDateservice' => $dateservice,
          'reiHourstart' => trim($request->reiHourstart),
          'reiAddressdestiny' => $this->upper($request->reiAddressdestiny),
          'reiMunicipalitydestiny_id' => trim($request->reiMunicipalitydestiny_id),
          'reiAddressorigin' => $this->upper($request->reiAddressorigin),
          'reiMunicipalityorigin_id' => trim($request->reiMunicipalityorigin_id),
          'reiContact' => $this->fu($request->reiContact),
          'reiPhone' => trim($request->reiPhone)
        ]);
        return back()->with('Success', 'Se ha procesado y guardado el registro correctamente, consúltelo en los registros: Operativa >> Programacion de servicios >> pendiente de asignación');
      } else {
        return back()->with('Secondary', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
      }
    } else {
      return back()->with('Secondary', 'No se encuentra el tipo de cliente (' . trim($request->reiTypecliente) . '), intentelo de nuevo');
    }
  }


  function editRegister(Request $request)
  {
    if ($request->type == "Mensajería Express") {
      $dateservice = Date('Y-m-d', strtotime($request->Dateservice));
      // dd($dateservice);
      if (trim($request->Typecliente) === 'PERMANENTE') {
        $validate = Requestmessenger::where('remId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->remTypecliente = 'PERMANENTE';
          $validate->remClientpermanent_id = trim($request->Client);
          $validate->remClientoccasional_id = null;
          $validate->remMessenger_id = trim($request->Messenger_id);
          $validate->remDateservice = $dateservice;
          $validate->remHourstart = trim($request->Hourstart);
          $validate->remAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->remMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->remAddressorigin = $this->upper($request->Addressorigin);
          $validate->remMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->remContact = $this->fu($request->Contact);
          $validate->remPhone = trim($request->Phone);
          $validate->remObservation = $this->fu($request->Observation);
          $validate->save();
          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'No existe un registro como le indicado, consulte los registros pendientes de asignación');
        }
      } else if (trim($request->remTypecliente) === 'OCASIONAL') {
        $validate = Requestmessenger::where('remId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->remTypecliente = 'OCASIONAL';
          $validate->remClientpermanent_id = null;
          $validate->remClientoccasional_id = trim($request->Client);
          $validate->remMessenger_id = trim($request->Messenger_id);
          $validate->remDateservice = $dateservice;
          $validate->remHourstart = trim($request->Hourstart);
          $validate->remAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->remMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->remAddressorigin = $this->upper($request->Addressorigin);
          $validate->remMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->remContact = $this->fu($request->Contact);
          $validate->remPhone = trim($request->Phone);
          $validate->remObservation = $this->fu($request->Observation);
          $validate->save();

          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'Ya existe un registro como el indicado, consulte los registros pendientes de asignación');
        }
      } else {
        return back()->with('Secondary', 'No se encuentra el tipo de cliente (' . trim($request->remTypecliente) . '), intentelo de nuevo');
      }
    }elseif ($request->type == 'Logística Express') {
      $dateservice = Date('Y-m-d', strtotime($request->Dateservice));
      if (trim($request->Typecliente) === 'PERMANENTE') {
        $validate = Requestlogistic::where('relId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->relTypecliente = 'PERMANENTE';
          $validate->relClientpermanent_id = trim($request->Client);
          $validate->relClientoccasional_id = null;
          $validate->relLogistic_id = trim($request->Messenger_id);
          $validate->relDateservice = $dateservice;
          $validate->relHourstart = trim($request->Hourstart);
          $validate->relAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->relMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->relAddressorigin = $this->upper($request->Addressorigin);
          $validate->relMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->relContact = $this->fu($request->Contact);
          $validate->relPhone = trim($request->Phone);
          $validate->save();
          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'No existe un registro como le indicado, consulte los registros pendientes de asignación');
        }
      } else if (trim($request->Typecliente) === 'OCASIONAL') {
        $validate = Requestlogistic::where('relId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->relTypecliente = 'OCASIONAL';
          $validate->relClientpermanent_id = null;
          $validate->relClientoccasional_id = trim($request->Client);
          $validate->relLogistic_id = trim($request->Messenger_id);
          $validate->relDateservice = $dateservice;
          $validate->relHourstart = trim($request->Hourstart);
          $validate->relAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->relMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->relAddressorigin = $this->upper($request->Addressorigin);
          $validate->relMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->relContact = $this->fu($request->Contact);
          $validate->relPhone = trim($request->Phone);
          $validate->save();

          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'Ya existe un registro como el indicado, consulte los registros pendientes de asignación');
        }
      } else {
        return back()->with('Secondary', 'No se encuentra el tipo de cliente (' . trim($request->relTypecliente) . '), intentelo de nuevo');
      }
    }elseif ($request->type == 'Carga Express') {
      $dateservice = Date('Y-m-d', strtotime($request->Dateservice));
      if (trim($request->Typecliente) === 'PERMANENTE') {
        $validate = Requestcharge::where('recId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->recTypecliente = 'PERMANENTE';
          $validate->recClientpermanent_id = trim($request->Client);
          $validate->recClientoccasional_id = null;
          $validate->recCharge_id = trim($request->Messenger_id);
          $validate->recDateservice = $dateservice;
          $validate->recHourstart = trim($request->Hourstart);
          $validate->recAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->recMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->recAddressorigin = $this->upper($request->Addressorigin);
          $validate->recMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->recContact = $this->fu($request->Contact);
          $validate->recPhone = trim($request->Phone);
          $validate->save();
          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'No existe un registro como le indicado, consulte los registros pendientes de asignación');
        }
      } else if (trim($request->Typecliente) === 'OCASIONAL') {
        $validate = Requestcharge::where('recId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->recTypecliente = 'OCASIONAL';
          $validate->recClientpermanent_id = null;
          $validate->recClientoccasional_id = trim($request->Client);
          $validate->recCharge_id = trim($request->Messenger_id);
          $validate->recDateservice = $dateservice;
          $validate->recHourstart = trim($request->Hourstart);
          $validate->recAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->recMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->recAddressorigin = $this->upper($request->Addressorigin);
          $validate->recMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->recContact = $this->fu($request->Contact);
          $validate->recPhone = trim($request->Phone);
          $validate->save();

          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'Ya existe un registro como el indicado, consulte los registros pendientes de asignación');
        }
      } else {
        return back()->with('Secondary', 'No se encuentra el tipo de cliente (' . trim($request->recTypecliente) . '), intentelo de nuevo');
      }
    }elseif ($request->type == 'Turismo Pasajeros') {
      $dateservice = Date('Y-m-d', strtotime($request->Dateservice));
      if (trim($request->Typecliente) === 'PERMANENTE') {
        $validate = Requestturism::where('retId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->retTypecliente = 'PERMANENTE';
          $validate->retClientpermanent_id = trim($request->Client);
          $validate->retClientoccasional_id = null;
          $validate->retTurism_id = trim($request->Messenger_id);
          $validate->retDateservice = $dateservice;
          $validate->retHourstart = trim($request->Hourstart);
          $validate->retAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->retMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->retAddressorigin = $this->upper($request->Addressorigin);
          $validate->retMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->retContact = $this->fu($request->Contact);
          $validate->retPhone = trim($request->Phone);
          $validate->save();
          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'No existe un registro como le indicado, consulte los registros pendientes de asignación');
        }
      } else if (trim($request->Typecliente) === 'OCASIONAL') {
        $validate = Requestturism::where('retId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->retTypecliente = 'OCASIONAL';
          $validate->retClientpermanent_id = null;
          $validate->retClientoccasional_id = trim($request->Client);
          $validate->retTurism_id = trim($request->Messenger_id);
          $validate->retDateservice = $dateservice;
          $validate->retHourstart = trim($request->Hourstart);
          $validate->retAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->retMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->retAddressorigin = $this->upper($request->Addressorigin);
          $validate->retMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->retContact = $this->fu($request->Contact);
          $validate->retPhone = trim($request->Phone);
          $validate->save();

          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'Ya existe un registro como el indicado, consulte los registros pendientes de asignación');
        }
      } else {
        return back()->with('Secondary', 'No se encuentra el tipo de cliente (' . trim($request->retTypecliente) . '), intentelo de nuevo');
      }
    }elseif ($request->type == 'Traslado Urbano') {
      $dateservice = Date('Y-m-d', strtotime($request->Dateservice));
      if (trim($request->Typecliente) === 'PERMANENTE') {
        $validate = RequestUrbanTransfer::where('reuId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->reuTypecliente = 'PERMANENTE';
          $validate->reuClientpermanent_id = trim($request->Client);
          $validate->reuClientoccasional_id = null;
          $validate->reuTransfer_id = trim($request->Messenger_id);
          $validate->reuDateservice = $dateservice;
          $validate->reuHourstart = trim($request->Hourstart);
          $validate->reuAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->reuMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->reuAddressorigin = $this->upper($request->Addressorigin);
          $validate->reuMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->reuContact = $this->fu($request->Contact);
          $validate->reuPhone = trim($request->Phone);
          $validate->save();
          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'No existe un registro como le indicado, consulte los registros pendientes de asignación');
        }
      } else if (trim($request->Typecliente) === 'OCASIONAL') {
        $validate = RequestUrbanTransfer::where('reuId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->reuTypecliente = 'OCASIONAL';
          $validate->reuClientpermanent_id = null;
          $validate->reuClientoccasional_id = trim($request->Client);
          $validate->reuTransfer_id = trim($request->Messenger_id);
          $validate->reuDateservice = $dateservice;
          $validate->reuHourstart = trim($request->Hourstart);
          $validate->reuAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->reuMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->reuAddressorigin = $this->upper($request->Addressorigin);
          $validate->reuMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->reuContact = $this->fu($request->Contact);
          $validate->reuPhone = trim($request->Phone);
          $validate->save();

          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'Ya existe un registro como el indicado, consulte los registros pendientes de asignación');
        }
      } else {
        return back()->with('Secondary', 'No se encuentra el tipo de cliente (' . trim($request->reuTypecliente) . '), intentelo de nuevo');
      }
    }elseif ($request->type == 'Traslado Intermunicipal') {
      $dateservice = Date('Y-m-d', strtotime($request->Dateservice));
      if (trim($request->Typecliente) === 'PERMANENTE') {
        $validate = RequestUrbanTransfer::where('reiId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->reiTypecliente = 'PERMANENTE';
          $validate->reiClientpermanent_id = trim($request->Client);
          $validate->reiClientoccasional_id = null;
          $validate->reiTransfer_id = trim($request->Messenger_id);
          $validate->reiDateservice = $dateservice;
          $validate->reiHourstart = trim($request->Hourstart);
          $validate->reiAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->reiMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->reiAddressorigin = $this->upper($request->Addressorigin);
          $validate->reiMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->reiContact = $this->fu($request->Contact);
          $validate->reiPhone = trim($request->Phone);
          $validate->save();
          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'No existe un registro como le indicado, consulte los registros pendientes de asignación');
        }
      } else if (trim($request->Typecliente) === 'OCASIONAL') {
        $validate = RequestUrbanTransfer::where('reuId', trim($request->id))
          ->first();
        if ($validate != null) {
          $validate->reiTypecliente = 'OCASIONAL';
          $validate->reiClientpermanent_id = null;
          $validate->reiClientoccasional_id = trim($request->Client);
          $validate->reiTransfer_id = trim($request->Messenger_id);
          $validate->reiDateservice = $dateservice;
          $validate->reiHourstart = trim($request->Hourstart);
          $validate->reiAddressdestiny = $this->upper($request->Addressdestiny);
          $validate->reiMunicipalitydestiny_id = trim($request->Municipalitydestiny_id);
          $validate->reiAddressorigin = $this->upper($request->Addressorigin);
          $validate->reiMunicipalityorigin_id = trim($request->Municipalityorigin_id);
          $validate->reiContact = $this->fu($request->Contact);
          $validate->reiPhone = trim($request->Phone);
          $validate->save();

          return back()->with('Success', 'Se ha procesado y guardado el registro correctamente');
        } else {
          return back()->with('Secondary', 'Ya existe un registro como el indicado, consulte los registros pendientes de asignación');
        }
      } else {
        return back()->with('Secondary', 'No se encuentra el tipo de cliente (' . trim($request->reiTypecliente) . '), intentelo de nuevo');
      }
    }
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
