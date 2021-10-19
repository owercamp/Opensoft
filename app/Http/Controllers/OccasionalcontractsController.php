<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Settingtechnical;
use App\Models\Orderoccasional;
use App\Models\Clientproposal;
use App\Models\Document;

class OccasionalcontractsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO DE ORDEN DE SERVICIO DE (CONTRATOS OCASIONALES)
    =============================================================================================== */

    function ordersTo(){
      $orders = Orderoccasional::where('oroState','PENDIENTE')->where('oroStatus','VIGENTE')->get();
      $documents = Document::all();
      $clients = Clientproposal::where('cprStatus','ACEPTADO')->get();
      return view('modules.occasional.order.index',compact('orders','clients','documents'));
    }

    function saveOrder(Request $request) {
      // dd($request->all());
      /*
        $request->oroDocument_id
        $request->docCode
        $request->oroDatestart
        $request->oroDateend
        $request->oroClientproposal_id
        $request->oroConfigdocument_id
        $request->oroTemplate
        $request->oroAllproposal
        $request->oroVariables
      */
      $validate = Orderoccasional::where('oroClientproposal_id',trim($request->oroClientproposal_id))
                            ->where('oroState','PENDIENTE')
                            ->where('oroStatus','VIGENTE')
                            ->first();
      if($validate == null){
          $content = '';
          $variables = substr(trim($request->oroVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
          $variablesSeparated = explode('!!==¡¡',$variables);
          for ($i=0; $i < count($variablesSeparated); $i++) {

              $var = explode('=>', $variablesSeparated[$i]); // $var[0] = writed; $var[1] = type;
              $search = '';
              switch ($var[1]) {
                  case 'texto': $search = '/¡¡¡texto dinámico!!!/'; break;
                  case 'numero': $search = '/¡¡¡número dinámico!!!/'; break;
                  case 'moneda': $search = '/¡¡¡moneda dinámica!!!/'; break;
                  case 'calendario': $search = '/¡¡¡calendario dinámico!!!/'; break;
              }
              if($i == 0){
                  $content = preg_replace($search, $var[0], trim($request->oroTemplate),1);
              }else{
                  $content = preg_replace($search, $var[0], $content,1);
              }
          }
          $datestart = Date('Y-m-d',strtotime(trim($request->oroDatestart)));
          $dateend = Date('Y-m-d',strtotime(trim($request->oroDateend)));
          $allproposal = substr(trim($request->oroAllproposal),0,-5); // Quitar (<=|=>)
          $new = Orderoccasional::create([
            'oroDocument_id' => trim($request->oroDocument_id),
            'oroDocumentcode' => $this::upper($request->docCode),
            'oroDatestart' => $datestart,
            'oroDateend' => $dateend,
            'oroClientproposal_id' => trim($request->oroClientproposal_id),
            'oroAllproposal' => $allproposal,
            'oroConfigdocument_id' => trim($request->oroConfigdocument_id),
            'oroContentfinal' => $content,
            'oroWrited' => $variables
          ]);
          return redirect()->route('occasional.orders')->with('SuccessOrder', 'Orden de servicio para (' . $new->proposal->cprClient . '), registrada');
      }else{
          return redirect()->route('occasional.orders')->with('SecondaryOrder', 'Ya existe una orden de servicio VIGENTE para (' . $validate->proposal->cprClient . ')');
      }
    }

    function updateOrder(Request $request) {
      // dd($request->all());
      /*
        $request->oroDocument_id_Edit
        $request->docCode_Edit
        $request->oroDatestart_Edit
        $request->oroDateend_Edit
        $request->oroConfigdocument_id_Edit
        $request->oroTemplate_Edit
        $request->oroAllproposal_Edit
        $request->oroVariables_Edit
        $request->oroId_Edit
      */
      $validate = Orderoccasional::find(trim($request->oroId_Edit));
      if($validate != null){
          $content = '';
          $variables = substr(trim($request->oroVariables_Edit),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
          $find = strpos($variables,'!!==¡¡');
          if($find === false){
              $var = explode('=>', $variables); // $var[0] = writed; $var[1] = type;
              $search = '';
              switch ($var[1]) {
                  case 'texto': $search = '/¡¡¡texto dinámico!!!/'; break;
                  case 'numero': $search = '/¡¡¡número dinámico!!!/'; break;
                  case 'moneda': $search = '/¡¡¡moneda dinámica!!!/'; break;
                  case 'calendario': $search = '/¡¡¡calendario dinámico!!!/'; break;
              }
              $content = preg_replace($search, $var[0], trim($request->oroTemplate_Edit),1);
          }else{
              $variablesSeparated = explode('!!==¡¡',$variables);
              for ($i=0; $i < count($variablesSeparated); $i++) { 
                  $var = explode('=>', $variablesSeparated[$i]); // $var[0] = writed; $var[1] = type;
                  $search = '';
                  switch ($var[1]) {
                      case 'texto': $search = '/¡¡¡texto dinámico!!!/'; break;
                      case 'numero': $search = '/¡¡¡número dinámico!!!/'; break;
                      case 'moneda': $search = '/¡¡¡moneda dinámica!!!/'; break;
                      case 'calendario': $search = '/¡¡¡calendario dinámico!!!/'; break;
                  }
                  if($i == 0){
                      $content = preg_replace($search, $var[0], trim($request->oroTemplate_Edit),1);
                  }else{
                      $content = preg_replace($search, $var[0], $content,1);
                  }
              }
          }
          $datestart = Date('Y-m-d',strtotime(trim($request->oroDatestart_Edit)));
          $dateend = Date('Y-m-d',strtotime(trim($request->oroDateend_Edit)));
          $allproposal = substr(trim($request->oroAllproposal_Edit),0,-5); // Quitar (<=|=>)
          $validate->oroDocument_id = trim($request->oroDocument_id_Edit);
          $validate->oroDocumentcode = $this::upper($request->docCode_Edit);
          $validate->oroDatestart = $datestart;
          $validate->oroDateend = $dateend;
          $validate->oroAllproposal = $allproposal;
          $validate->oroConfigdocument_id = trim($request->oroConfigdocument_id_Edit);
          $validate->oroContentfinal = $content;
          $validate->oroWrited = $variables;
          $client = $validate->proposal->cprClient;
          $validate->save();
          return redirect()->route('occasional.orders')->with('PrimaryOrder', 'Orden de servicio para (' . $client . '), actualizada');
      }else{
          return redirect()->route('occasional.orders')->with('SecondaryOrder', 'No se encuentra una orden de servicio para (' . $validate->proposal->cprClient . ')');
      }
    }

    function cancelOrder(Request $request) {
      // dd($request->all());
      $validate = Orderoccasional::find(trim($request->oroId_Cancel));
      if($validate != null){
          $client = $validate->proposal->cprClient;
          $validate->oroState = 'RECHAZADO';
          $validate->oroStatus = 'TERMINADO';
          $validate->save();
          return redirect()->route('occasional.orders')->with('WarningOrder', 'Orden de servicio para (' . $client . '), anulada');
      }else{
          return redirect()->route('occasional.orders')->with('SecondaryOrder', 'No se encuentra una orden de servicio para (' . $request->nameClient_Cancel . ')');
      }
    }

    function aprovedOrder(Request $request) {
      // dd($request->all());
      $validate = Orderoccasional::find(trim($request->oroId_Aproved));
      if($validate != null){
          $client = $validate->proposal->cprClient;
          $validate->oroState = 'APROBADO';
          $validate->save();
          return redirect()->route('occasional.orders')->with('SuccessOrder', 'Orden de servicio para (' . $client . '), aprobada');
      }else{
          return redirect()->route('occasional.orders')->with('SecondaryOrder', 'No se encuentra una orden de servicio para (' . $request->nameClient_Aproved . ')');
      }
    }

    function pdfOrder(Request $request) {
      // dd($request->all());
      $order = Orderoccasional::find($request->oroId);
        if($order != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $list = array();
            $find = strpos($order->oroAllproposal,'<=|=>');
            if($find !== false){
              $separated = explode('<=|=>',$order->oroAllproposal);
              for ($i=0; $i < count($separated); $i++) {
                $separatedItems = explode('===>',$separated[$i]);
                array_push($list, [
                  $separatedItems[1],
                  $separatedItems[3],
                  $separatedItems[4],
                  $separatedItems[5]
                ]);
              }
            }else{
              $separatedItems = explode('===>',$order->oroAllproposal);
              array_push($list, [
                $separatedItems[1],
                  $separatedItems[3],
                  $separatedItems[4],
                  $separatedItems[5]
              ]);
            }
            $namefile = 'Orden de servicio de cliente (' . $order->proposal->cprClient . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.occasional.order.orderPdf',compact('technical','order','list'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('occasional.order')->with('SecondaryOrder', 'No se encuentran la orden de servicio de cliente (' . trim($request->clientPdf) . ')');
        }
    }

    /* ===============================================================================================
			MODULO DE SEGUIMIENTO DE SERVICIO CARGA EXPRESS DE (CONTRATOS OCASIONALES)
    =============================================================================================== */

    function trackingsTo(){
      $orders = Orderoccasional::where('oroState','!=','PENDIENTE')->get();
      return view('modules.occasional.tracking.index',compact('orders'));
    }

    /* ===============================================================================================
			MODULO DE ESTADISTICA DE (CONTRATOS OCASIONALES)
    =============================================================================================== */

    function statisticTo(){
        $year = date('Y');
        $datesAll = $this->getOrders($year);
        return view('modules.occasional.statistic.index',compact('datesAll'));
    }

    function getOrders($year){
        $result = array();
        for ($i=1; $i <= 12; $i++) {
            $vigente = Orderoccasional::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('oroStatus','VIGENTE')->count();
            $terminado = Orderoccasional::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('oroStatus','TERMINADO')->count();
            $result[$i][0] = $vigente;
            $result[$i][1] = $terminado;
        }
        return $result;
    }

    function getVigente(Request $request){
        $vigente = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $query = Orderoccasional::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('oroStatus','VIGENTE')->count();
            array_push($vigente, $query);
        }
        return $vigente;
    }

    function getTerminado(Request $request){
        $terminado = array();
        $year = trim($request->year);
        for ($i=1; $i <= 12; $i++) {
            $query = Orderoccasional::whereBetween('created_at', [$year . '-' . $this->getMount($i) . '-01' , $year . '-' . $this->getMount($i) . '-' . $this->numberDays($this->getMount($i),$year)])->where('oroStatus','TERMINADO')->count();
            array_push($terminado, $query);
        }
        return $terminado;
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
