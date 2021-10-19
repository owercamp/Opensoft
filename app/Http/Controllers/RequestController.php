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
use App\Models\Requestturism;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE MENSAJERIA EXPRESS DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */
    
    function messengersExpressTo(){
        $clients = array();
        $date = Date('Y-m-d');
        // CLIENTES QUE TIENEN PORTAFOLIO DE MENSAJERIA EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
        $permanents = Term::select(
                        'legalizationscontractual.*',
                        'clients.*',
                        'terms.*'
                    )->join('legalizationscontractual','legalizationscontractual.lcoId','terms.terLegalization_id')
                    ->join('clients','clients.cliId','legalizationscontractual.lcoClient_id')
                    ->where('lcoStatus','VIGENTE')
                    ->where('terStatus','VIGENTE')
                    ->where('terBriefcase','LIKE','%Mensajería Express%')
                    ->where('terDateinitial','<=',$date)
                    ->where('terDatefinal','>=',$date)
                    ->get();
        $occasionals = Orderoccasional::select(
                        'orderoccasionals.*',
                        'clientproposals.*'
                    )->join('clientproposals','clientproposals.cprId','orderoccasionals.oroClientproposal_id')
                    ->where('oroState','APROBADO')
                    ->where('oroStatus','VIGENTE')
                    ->where('cprStatus','ACEPTADO')
                    ->where('oroAllproposal','LIKE','%Mensajería Express%')
                    ->where('oroDatestart','<=',$date)
                    ->where('oroDateend','>=',$date)
                    ->get();
        foreach ($permanents as $permanent) {
            array_push($clients,[
                $permanent->lcoId,
                $permanent->cliNamereason . ' (Contrato permanente)',
                $permanent->cliNumberdocument,
                $permanent->terDateinitial,
                $permanent->terDatefinal,
                'PERMANENTE'
            ]);
        }

        foreach ($occasionals as $occasional) {
            array_push($clients,[
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
        $municipalities = Settingmunicipality::orderBy('munName','asc')->get();
        return view('modules.requests.messenger.index',compact('clients','servicemessengers','municipalities'));
    }

    function messengersSave(Request $request){
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
        $dateservice = Date('Y-m-d',strtotime($request->remDateservice));
        if(trim($request->remTypecliente) === 'PERMANENTE'){
            $validate = Requestmessenger::where('remClientpermanent_id',trim($request->remClient))
                                        ->where('remDateservice',$dateservice)
                                        ->where('remMunicipalitydestiny_id',trim($request->remMunicipalitydestiny_id))
                                        ->where('remMunicipalityorigin_id',trim($request->remMunicipalityorigin_id))
                                        ->first();
            if($validate === null){
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
            }else{
                return redirect()->route('request.messenger')->with('SecondaryMessenger', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
            }
        }else if(trim($request->remTypecliente) === 'OCASIONAL'){
            $validate = Requestmessenger::where('remClientoccasional_id',trim($request->remClient))
                                        ->where('remDateservice',$dateservice)
                                        ->where('remMunicipalitydestiny_id',trim($request->remMunicipalitydestiny_id))
                                        ->where('remMunicipalityorigin_id',trim($request->remMunicipalityorigin_id))
                                        ->first();
            if($validate === null){
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
            }else{
                return redirect()->route('request.messenger')->with('SecondaryMessenger', 'Ya existe un registro como el indicado, consulte los registros pendientes de asignación');
            }
        }else{
            return redirect()->route('request.messenger')->with('SecondaryMessenger', 'No se encuentra el tipo de cliente (' . trim($request->remTypecliente) . '), intentelo de nuevo');
        }
    }

    /* ===============================================================================================
			MODULO DE LOGISTICA EXPRESS DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

    function logisticExpressTo(){
        $clients = array();
        $date = Date('Y-m-d');
        // CLIENTES QUE TIENEN PORTAFOLIO DE LOGISTICA EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
        $permanents = Term::select(
                        'legalizationscontractual.*',
                        'clients.*',
                        'terms.*'
                    )->join('legalizationscontractual','legalizationscontractual.lcoId','terms.terLegalization_id')
                    ->join('clients','clients.cliId','legalizationscontractual.lcoClient_id')
                    ->where('lcoStatus','VIGENTE')
                    ->where('terStatus','VIGENTE')
                    ->where('terBriefcase','LIKE','%Logística Express%')
                    ->where('terDateinitial','<=',$date)
                    ->where('terDatefinal','>=',$date)
                    ->get();
        $occasionals = Orderoccasional::select(
                        'orderoccasionals.*',
                        'clientproposals.*'
                    )->join('clientproposals','clientproposals.cprId','orderoccasionals.oroClientproposal_id')
                    ->where('oroState','APROBADO')
                    ->where('oroStatus','VIGENTE')
                    ->where('cprStatus','ACEPTADO')
                    ->where('oroAllproposal','LIKE','%Logística Express%')
                    ->where('oroDatestart','<=',$date)
                    ->where('oroDateend','>=',$date)
                    ->get();
        foreach ($permanents as $permanent) {
            array_push($clients,[
                $permanent->lcoId,
                $permanent->cliNamereason . ' (Contrato permanente)',
                $permanent->cliNumberdocument,
                $permanent->terDateinitial,
                $permanent->terDatefinal,
                'PERMANENTE'
            ]);
        }

        foreach ($occasionals as $occasional) {
            array_push($clients,[
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
        $municipalities = Settingmunicipality::orderBy('munName','asc')->get();
        return view('modules.requests.logistic.index',compact('clients','servicelogistics','municipalities'));
    }

    function logisticSave(Request $request){
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
        $dateservice = Date('Y-m-d',strtotime($request->relDateservice));
        if(trim($request->relTypecliente) === 'PERMANENTE'){
            $validate = Requestlogistic::where('relClientpermanent_id',trim($request->relClient))
                                        ->where('relDateservice',$dateservice)
                                        ->where('relMunicipalitydestiny_id',trim($request->relMunicipalitydestiny_id))
                                        ->where('relMunicipalityorigin_id',trim($request->relMunicipalityorigin_id))
                                        ->first();
            if($validate === null){
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
            }else{
                return redirect()->route('request.logistic')->with('SecondaryLogistic', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
            }
        }else if(trim($request->relTypecliente) === 'OCASIONAL'){
            $validate = Requestlogistic::where('relClientpermanent_id',trim($request->relClient))
                                        ->where('relDateservice',$dateservice)
                                        ->where('relMunicipalitydestiny_id',trim($request->relMunicipalitydestiny_id))
                                        ->where('relMunicipalityorigin_id',trim($request->relMunicipalityorigin_id))
                                        ->first();
            if($validate === null){
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
            }else{
                return redirect()->route('request.logistic')->with('SecondaryLogistic', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
            }
        }else{
            return redirect()->route('request.logistic')->with('SecondaryLogistic', 'No se encuentra el tipo de cliente (' . trim($request->relTypecliente) . '), intentelo de nuevo');
        }
    }

    /* ===============================================================================================
			MODULO DE CARGA EXPRESS DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

    function chargeExpressTo(){
        $clients = array();
        $date = Date('Y-m-d');
        // CLIENTES QUE TIENEN PORTAFOLIO DE CARGA EXPRESS EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
        $permanents = Term::select(
                        'legalizationscontractual.*',
                        'clients.*',
                        'terms.*'
                    )->join('legalizationscontractual','legalizationscontractual.lcoId','terms.terLegalization_id')
                    ->join('clients','clients.cliId','legalizationscontractual.lcoClient_id')
                    ->where('lcoStatus','VIGENTE')
                    ->where('terStatus','VIGENTE')
                    ->where('terBriefcase','LIKE','%Carga Express%')
                    ->where('terDateinitial','<=',$date)
                    ->where('terDatefinal','>=',$date)
                    ->get();
        $occasionals = Orderoccasional::select(
                        'orderoccasionals.*',
                        'clientproposals.*'
                    )->join('clientproposals','clientproposals.cprId','orderoccasionals.oroClientproposal_id')
                    ->where('oroState','APROBADO')
                    ->where('oroStatus','VIGENTE')
                    ->where('cprStatus','ACEPTADO')
                    ->where('oroAllproposal','LIKE','%Carga Express%')
                    ->where('oroDatestart','<=',$date)
                    ->where('oroDateend','>=',$date)
                    ->get();
        foreach ($permanents as $permanent) {
            array_push($clients,[
                $permanent->lcoId,
                $permanent->cliNamereason . ' (Contrato permanente)',
                $permanent->cliNumberdocument,
                $permanent->terDateinitial,
                $permanent->terDatefinal,
                'PERMANENTE'
            ]);
        }

        foreach ($occasionals as $occasional) {
            array_push($clients,[
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
        $municipalities = Settingmunicipality::orderBy('munName','asc')->get();
        return view('modules.requests.charge.index',compact('clients','servicecharges','municipalities'));
    }

    function chargeSave(Request $request){
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
        $dateservice = Date('Y-m-d',strtotime($request->recDateservice));
        if(trim($request->recTypecliente) === 'PERMANENTE'){
            $validate = Requestcharge::where('recClientpermanent_id',trim($request->recClient))
                                        ->where('recDateservice',$dateservice)
                                        ->where('recMunicipalitydestiny_id',trim($request->recMunicipalitydestiny_id))
                                        ->where('recMunicipalityorigin_id',trim($request->recMunicipalityorigin_id))
                                        ->first();
            if($validate === null){
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
            }else{
                return redirect()->route('request.charge')->with('SecondaryCharge', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
            }
        }else if(trim($request->recTypecliente) === 'OCASIONAL'){
            $validate = Requestcharge::where('recClientpermanent_id',trim($request->recClient))
                                        ->where('recDateservice',$dateservice)
                                        ->where('recMunicipalitydestiny_id',trim($request->recMunicipalitydestiny_id))
                                        ->where('recMunicipalityorigin_id',trim($request->recMunicipalityorigin_id))
                                        ->first();
            if($validate === null){
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
            }else{
                return redirect()->route('request.charge')->with('SecondaryCharge', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
            }
        }else{
            return redirect()->route('request.charge')->with('SecondaryCharge', 'No se encuentra el tipo de cliente (' . trim($request->recTypecliente) . '), intentelo de nuevo');
        }
    }

    /* ===============================================================================================
			MODULO DE TURISMO PASAJEROS DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

    function turismTo(){
        $clients = array();
        $date = Date('Y-m-d');
        // CLIENTES QUE TIENEN PORTAFOLIO DE TURISMO EN SUS CONDICIONES ECONOMICAS Y ESTEN ACTIVOS DENTRO DEL RANGO DE CONTRATO
        $permanents = Term::select(
                        'legalizationscontractual.*',
                        'clients.*',
                        'terms.*'
                    )->join('legalizationscontractual','legalizationscontractual.lcoId','terms.terLegalization_id')
                    ->join('clients','clients.cliId','legalizationscontractual.lcoClient_id')
                    ->where('lcoStatus','VIGENTE')
                    ->where('terStatus','VIGENTE')
                    ->where('terBriefcase','LIKE','%Turismo Pasajeros%')
                    ->where('terDateinitial','<=',$date)
                    ->where('terDatefinal','>=',$date)
                    ->get();
        $occasionals = Orderoccasional::select(
                        'orderoccasionals.*',
                        'clientproposals.*'
                    )->join('clientproposals','clientproposals.cprId','orderoccasionals.oroClientproposal_id')
                    ->where('oroState','APROBADO')
                    ->where('oroStatus','VIGENTE')
                    ->where('cprStatus','ACEPTADO')
                    ->where('oroAllproposal','LIKE','%Turismo Pasajeros%')
                    ->where('oroDatestart','<=',$date)
                    ->where('oroDateend','>=',$date)
                    ->get();
        foreach ($permanents as $permanent) {
            array_push($clients,[
                $permanent->lcoId,
                $permanent->cliNamereason . ' (Contrato permanente)',
                $permanent->cliNumberdocument,
                $permanent->terDateinitial,
                $permanent->terDatefinal,
                'PERMANENTE'
            ]);
        }

        foreach ($occasionals as $occasional) {
            array_push($clients,[
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
        $municipalities = Settingmunicipality::orderBy('munName','asc')->get();
        return view('modules.requests.turism.index',compact('clients','serviceturisms','municipalities'));
    }

    function turismSave(Request $request){
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
        $dateservice = Date('Y-m-d',strtotime($request->retDateservice));
        if(trim($request->retTypecliente) === 'PERMANENTE'){
            $validate = Requestturism::where('retClientpermanent_id',trim($request->retClient))
                                        ->where('retDateservice',$dateservice)
                                        ->where('retMunicipalitydestiny_id',trim($request->retMunicipalitydestiny_id))
                                        ->where('retMunicipalityorigin_id',trim($request->retMunicipalityorigin_id))
                                        ->first();
            if($validate === null){
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
            }else{
                return redirect()->route('request.turism')->with('SecondaryTurism', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
            }
        }else if(trim($request->retTypecliente) === 'OCASIONAL'){
            $validate = Requestturism::where('recClientpermanent_id',trim($request->recClient))
                                        ->where('recDateservice',$dateservice)
                                        ->where('recMunicipalitydestiny_id',trim($request->recMunicipalitydestiny_id))
                                        ->where('recMunicipalityorigin_id',trim($request->recMunicipalityorigin_id))
                                        ->first();
            if($validate === null){
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
            }else{
                return redirect()->route('request.turism')->with('SecondaryTurism', 'Ya existe un registro como en indicado, consulte los registros pendientes de asignación');
            }
        }else{
            return redirect()->route('request.turism')->with('SecondaryTurism', 'No se encuentra el tipo de cliente (' . trim($request->retTypecliente) . '), intentelo de nuevo');
        }
    }

    /* ===============================================================================================
            MODULO DE TRASLADO DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

    function transferTo(){
        return view('modules.requests.transfer.index');
    }

    /* ===============================================================================================
            MODULO DE TRASLADO INTERMUNICIPAL DE (SOLICITUD DE SERVICIOS)
    =============================================================================================== */

    function transferintermunicipalTo(){
        return view('modules.requests.transferintermunicipal.index');
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
