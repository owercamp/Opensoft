<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Notificationprovider;
use App\Models\Settingtechnical;
use App\Models\Documentlogistic;
use App\Models\Billprovider;
use App\Models\Provider;
use App\Models\Orderprovider;
use App\Models\Providerproduct;
use App\Models\Providerservice;

class LProvidersController extends Controller
{
    /* ===============================================================================================
			MODULO DE MINUTA DE CONTRATO DE (PROVEEDORES)
    =============================================================================================== */

    function billTo(){
        $documents = Documentlogistic::all();
        $providers = Provider::all();
        $bills = Billprovider::where('bpStatus','VIGENTE')->where('bpState','PENDIENTE')->get();
        return view('modules.lproviders.bill.index',compact('bills','documents','providers'));
    }

    function saveBill(Request $request){
        // dd($request->all());
        /*
            $request->bpProvider_id
            $request->bpDocument_id
            $request->dolCode
            $request->bpConfigdocument_id
            $request->bpTemplate
            $request->bpVariables
        */
        $validate = Billprovider::where('bpProvider_id',trim($request->bpProvider_id))->where('bpStatus','VIGENTE')->first();
        if($validate == null){
            $content = '';
            $variables = substr(trim($request->bpVariables),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                    $content = preg_replace($search, $var[0], trim($request->bpTemplate),1);
                }else{
                    $content = preg_replace($search, $var[0], $content,1);
                }
            }
            $new = Billprovider::create([
                'bpDocument_id' => trim($request->bpDocument_id),
                'bpDocumentcode' => $this::upper($request->dolCode),
                'bpProvider_id' => trim($request->bpProvider_id),
                'bpConfigdocument_id' => trim($request->bpConfigdocument_id),
                'bpContentfinal' => $content,
                'bpWrited' => $variables
            ]);
            return redirect()->route('providers.bill')->with('SuccessBill', 'Minuta de contrato de proveedor (' . $new->provider->proReasonsocial . '), registrada');
        }else{
            return redirect()->route('providers.bill')->with('SecondaryBill', 'Ya existe una minuta de contrato para ' . $validate->provider->proReasonsocial);
        }
    }

    function updateBill(Request $request){
        // dd($request->all());
        /*
            $request->proReasonsocial_Edit
            $request->bpDocument_id_Edit
            $request->dolCode_Edit
            $request->bpConfigdocument_id_Edit
            $request->bpTemplate_Edit
            $request->bpVariables_Edit
            $request->bpId_Edit
        */
        $validate = Billprovider::find(trim($request->bpId_Edit));
        if($validate != null){
            $content = '';
            $variables = substr(trim($request->bpVariables_Edit),0,-8); // QUITAR LOS ULTIMOS 3 CARACTERES (!!==¡¡)
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
                $content = preg_replace($search, $var[0], trim($request->bpTemplate_Edit),1);
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
                        $content = preg_replace($search, $var[0], trim($request->bpTemplate_Edit),1);
                    }else{
                        $content = preg_replace($search, $var[0], $content,1);
                    }
                }
            }
            $validate->bpDocument_id = trim($request->bpDocument_id_Edit);
            $validate->bpDocumentcode = $this::upper($request->dolCode_Edit);
            $validate->bpConfigdocument_id = trim($request->bpConfigdocument_id_Edit);
            $validate->bpContentfinal = $content;
            $validate->bpWrited = $variables;
            $validate->save();
            return redirect()->route('providers.bill')->with('PrimaryBill', 'Minuta de contrato para proveedor (' . trim($request->proReasonsocial_Edit) . '), actualizada');
        }else{
            return redirect()->route('providers.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato para proveedor (' . trim($request->proReasonsocial_Edit) . ')');
        }
    }

    function deleteBill(Request $request){
        // dd($request->all());
        $validate = Billprovider::find(trim($request->bpId_Delete));
        if($validate != null){
            $provider = $validate->provider->proReasonsocial;
            $validate->bpState = 'RECHAZADO';
            $validate->bpStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('providers.bill')->with('WarningBill', 'Minuta de contrato para proveedor (' . $provider . '), Finalizada');
        }else{
            return redirect()->route('providers.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato de proveedor');
        }
    }

    function aprovedBill(Request $request){
        // dd($request->all());
        $validate = Billprovider::find(trim($request->bpId));
        if($validate != null){
            $provider = $validate->provider->proReasonsocial;
            $validate->bpState = 'APROBADO';
            $validate->save();
            return redirect()->route('providers.bill')->with('SuccessBill', 'Minuta de contrato de proveedor (' . $provider . '), ¡APROBADA!');
        }else{
            return redirect()->route('providers.bill')->with('SecondaryBill', 'No se encuentra la minuta de contrato de proveedor');
        }
    }

    function pdfBill(Request $request){
        // dd($request->all());
        $legalization = Billprovider::find($request->bpId);
        if($legalization != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Minuta de contrato de  proveedor (' . $legalization->provider->proReasonsocial . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.lproviders.bill.billPdf',compact('technical','legalization'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('providers.bill')->with('SecondaryBill', 'No se encuentran la minuta de contrato de proveedor');
        }
    }

    /* ===============================================================================================
			MODULO DE LEGALIZACION DE CONTRATO DE (PROVEEDORES)
    =============================================================================================== */

    function legalizationTo(){
        $documents = Documentlogistic::all();
        $bills = Billprovider::whereIn('bpStatus',['VIGENTE','TERMINADO'])->where('bpState','APROBADO')->get();
        $providers = Billprovider::select('billproviders.bpId','providers.proId','providers.proReasonsocial','providers.proNumberdocument')->join('providers','providers.proId','billproviders.bpProvider_id')->where('bpStatus','VIGENTE')->where('bpState','APROBADO')->get();
        return view('modules.lproviders.legalization.index',compact('bills','documents','providers'));
    }

    function finishLegalization(Request $request){
        // dd($request->all());
        $validate = Billprovider::find(trim($request->bpId_Finish));
        if($validate != null){
            $provider = $validate->provider->proReasonsocial;
            $validate->bpStatus = 'TERMINADO';
            $validate->save();
            return redirect()->route('providers.legalization')->with('WarningLegalization', 'Legalización de contrato de proveedor (' . $provider . '), ¡FINALIZADO!');
        }else{
            return redirect()->route('providers.legalization')->with('SecondaryLegalization', 'No se encuentra la legalización de contrato de proveedor');
        }
    }

    function pdfLegalization(Request $request){
        // dd($request->all());
        $legalization = Billprovider::find($request->bpId);
        if($legalization != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Legalización de contrato de proveedor (' . $legalization->provider->proReasonsocial . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.lproviders.legalization.legalizationPdf',compact('technical','legalization'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.legalization')->with('SecondaryLegalization', 'No se encuentran la minuta de contrato de proveedor');
        }
    }

	/* ===============================================================================================
			MODULO DE NOTIFICACIONES DE (PROVEEDORES)
    =============================================================================================== */

    function notificationsTo(){
        $notifications = Notificationprovider::all();
        $documents = Documentlogistic::all();
        $legalizations = Billprovider::select(
                                'billproviders.*',
                                'providers.*',
                                'settingpersonals.perName'
                            )
                            ->join('providers','providers.proId','billproviders.bpProvider_id')
                            ->join('settingpersonals','settingpersonals.perId','providers.proPersonal_id')
                            ->where('bpStatus','VIGENTE')->where('bpState','APROBADO')
                            ->get();
        return view('modules.lproviders.notifications.index',compact('notifications','documents','legalizations'));
    }

    function saveNotification(Request $request){
        // dd($request->all());
        /*
            $request->npDocument_id
            $request->dolCode
            $request->npLegalization_id
            $request->npDate
            $request->npNotification
        */
        // $validate = Notificationprovider::where('npLegalization_id',trim($request->npLegalization_id))->where('npDocument_id',trim($request->npDocument_id))->first();
        // if($validate == null){
            $date = Date('Y-m-d',strtotime(trim($request->npDate)));
            $new = Notificationprovider::create([
                'npDate' => $date,
                'npDocument_id' => trim($request->npDocument_id),
                'npDocumentcode' => $this::upper($request->dolCode),
                'npBillprovider_id' => trim($request->npLegalization_id),
                'npNotification' => $this::fu($request->npNotification)
            ]);
            return redirect()->route('providers.notifications')->with('SuccessNotification', 'Registro de notificación de proveedor (' . $new->bill->provider->proReasonsocial . '), registrada');
        // }else{
            // return redirect()->route('providers.notifications')->with('SecondaryNotification', 'Ya existe una notificación para proveedor (' . $validate->bill->provider->proReasonsocial . ')');
        // }
    }

    function updateNotification(Request $request){
        // dd($request->all());
        /*
            $request->proReasonsocial_Edit
            $request->npNotification_Edit
            $request->npDate_Edit
            $request->npId_Edit
        */
        $validate = Notificationprovider::find(trim($request->npId_Edit));
        if($validate != null){
            $validate->npNotification = $this::fu($request->npNotification_Edit);
            $validate->npDate = trim($request->npDate_Edit);
            $validate->save();
            return redirect()->route('providers.notifications')->with('PrimaryNotification', 'Registro de notificación de proveedor (' . trim($request->proReasonsocial_Edit) . '), actualizado');
        }else{
            return redirect()->route('providers.notifications')->with('SecondaryNotification', 'No se encuentra la notificación de proveedor (' . trim($request->proReasonsocial_Edit) . ')');
        }
    }

    function deleteNotification(Request $request){
        // dd($request->all());
        $validate = Notificationprovider::find(trim($request->npId_Delete));
        if($validate != null){
            $validate->delete();
            return redirect()->route('providers.notifications')->with('WarningNotification', 'Registro de notificación de proveedor (' . trim($request->proReasonsocial_Delete) . '), Eliminada');
        }else{
            return redirect()->route('providers.notifications')->with('SecondaryNotification', 'No se encuentran la notificación de proveedor (' . trim($request->proReasonsocial_Delete) . ')');
        }
    }

    function pdfNotification(Request $request){
        // dd($request->all());
        $notification = Notificationprovider::find($request->npId);
        if($notification != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $namefile = 'Notificación de proveedor (' . $notification->bill->provider->proReasonsocial . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.lproviders.notifications.notificationPdf',compact('technical','notification'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('collaborators.notifications')->with('SecondaryNotification', 'No se encuentran el registro de notificación de proveedor');
        }
    }

    /* ===============================================================================================
			MODULO DE EVALUACIONES DE DESEMPEÑO DE (PROVEEDORES)
    =============================================================================================== */

    function testsTo(){
        return view('modules.lproviders.tests.index');
    }

    /* ===============================================================================================
            MODULO DE ORDEN DE COMPRA DE (PROVEEDORES)
    =============================================================================================== */

    function orderTo(){
        $orders = Orderprovider::all();
        $documents = Documentlogistic::all();
        // $providers = Provider::all();
        $providers = Billprovider::select(
                                'billproviders.*',
                                'providers.*'
                            )
                            ->join('providers','providers.proId','billproviders.bpProvider_id')
                            ->where('bpStatus','VIGENTE')->where('bpState','APROBADO')
                            ->get();
        $products = Providerproduct::all(); // ppId, ppName, ppDescription, created_at, updated_at
        $services = Providerservice::all(); // psId, psName, psDescription, created_at, updated_at
        $proser = array();
        foreach ($products as $product) {
          array_push($proser, [
            $product->ppId,
            $product->ppName,
            'Producto'
          ]);
        }
        foreach ($services as $service) {
          array_push($proser, [
            $service->psId,
            $service->psName,
            'Servicio'
          ]);
        }
        sort($proser); // Ordenar array
        return view('modules.lproviders.order.index',compact('orders','documents','providers','proser'));
    }

    function saveOrder(Request $request){
        // dd($request->all());
        /*
            $request->orpDocument_id
            $request->dolCode
            $request->orpBillprovider_id
            $request->orpProductservice
            $request->subtotal_from_tbl
            $request->precioiva_from_tbl
            $request->total_from_tbl
            $request->allorpOrders
        */
        // $validate = Orderprovider::where('orpBillprovider_id',trim($request->orpBillprovider_id))->where('orpDocument_id',trim($request->orpDocument_id))->first();
        // if($validate == null){
          $orders = substr(trim($request->allorpOrders),0,-6); // QUITAR LOS ULTIMOS CARACTERES (!!==!!)
            $new = Orderprovider::create([
                'orpDocument_id' => trim($request->orpDocument_id),
                'orpDocumentcode' => trim($request->dolCode),
                'orpBillprovider_id' => trim($request->orpBillprovider_id),
                'orpOrders' => trim($orders),
                'orpSubtotal' => trim($request->subtotal_from_tbl),
                'orpIva' => trim($request->precioiva_from_tbl),
                'orpTotal' => trim($request->total_from_tbl)
            ]);
            return redirect()->route('providers.order')->with('SuccessOrder', 'Orden de compra de proveedor (' . $new->bill->provider->proReasonsocial . '), registrada');
        // }else{
            // return redirect()->route('providers.order')->with('SecondaryOrder', 'Ya existe una orden de compra para proveedor (' . $validate->bill->provider->proReasonsocial . ')');
        // }
    }

    function updateOrder(Request $request){
        // dd($request->all());
        /*
            $request->subtotal_from_tbl_Edit
            $request->precioiva_from_tbl_Edit
            $request->total_from_tbl_Edit
            $request->proReasonsocial_Edit
            $request->allorpOrders_Edit
            $request->orpId_Edit
        */
        $validate = Orderprovider::find(trim($request->orpId_Edit));
        if($validate != null){
            $orders = substr(trim($request->allorpOrders_Edit),0,-6); // QUITAR LOS ULTIMOS CARACTERES (!!==!!)
            $validate->orpOrders = trim($orders);
            $validate->orpSubtotal = trim($request->subtotal_from_tbl_Edit);
            $validate->orpIva = trim($request->precioiva_from_tbl_Edit);
            $validate->orpTotal = trim($request->total_from_tbl_Edit);
            $validate->save();
            return redirect()->route('providers.order')->with('PrimaryOrder', 'Orden de compra de proveedor (' . trim($request->proReasonsocial_Edit) . '), actualizada');
        }else{
            return redirect()->route('providers.order')->with('SecondaryOrder', 'No se encuentra la orden de compra de proveedor (' . trim($request->proReasonsocial_Edit) . ')');
        }
    }

    function cancelOrder(Request $request){
        // dd($request->all());
        $validate = Orderprovider::find(trim($request->orpId_Null));
        if($validate != null){
            $validate->orpStatus = 'ANULADA';
            $validate->save();
            return redirect()->route('providers.order')->with('WarningOrder', 'Orden de compra de proveedor (' . trim($request->proReasonsocial_Null) . '), Anulada');
        }else{
            return redirect()->route('providers.order')->with('SecondaryOrder', 'No se encuentran la orden de compra de proveedor (' . trim($request->proReasonsocial_Null) . ')');
        }
    }

    function qualifyOrder(Request $request){
      // dd($request->all());
      $validate = Orderprovider::find(trim($request->orpId_Qualify));
      if($validate != null){
          $validate->orpNote = trim($request->orpQualify);
          $validate->save();
          return redirect()->route('providers.order')->with('SuccessOrder', 'Orden de compra de proveedor (' . trim($request->proReasonsocial_Qualify) . '), Calificada');
      }else{
          return redirect()->route('providers.order')->with('SecondaryOrder', 'No se encuentran la orden de compra de proveedor (' . trim($request->proReasonsocial_Qualify) . ')');
      }
    }

    function pdfOrder(Request $request){
        // dd($request->all());
        $order = Orderprovider::find($request->orpId);
        if($order != null){
            $date = Date('Y-m-d h:i:s');
            $technical = Settingtechnical::first();
            $listOrders = array();
            $find = strpos($order->orpOrders,'!!==!!');
            // dd($find);
            if($find !== false){
              $separated = explode('!!==!!',$order->orpOrders);
              for ($i=0; $i < count($separated); $i++) {
                $separatedItems = explode('!==!',$separated[$i]);
                array_push($listOrders, [
                  $separatedItems[1],
                  $separatedItems[2],
                  $separatedItems[3],
                  $separatedItems[4],
                  $separatedItems[5],
                  $separatedItems[6],
                  $separatedItems[7],
                  $separatedItems[8]
                ]);
              }
            }else{
              $separatedItems = explode('!==!',$order->orpOrders);
              array_push($listOrders, [
                $separatedItems[1],
                $separatedItems[2],
                $separatedItems[3],
                $separatedItems[4],
                $separatedItems[5],
                $separatedItems[6],
                $separatedItems[7],
                $separatedItems[8]
              ]);
            }
            $namefile = 'Orden de compra de proveedor (' . $order->bill->provider->proReasonsocial . ') descargado el ' . $date . '.pdf';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('modules.lproviders.order.orderPdf',compact('technical','order','listOrders'));
            return $pdf->download($namefile);
        }else{
            return redirect()->route('providers.order')->with('SecondaryOrder', 'No se encuentran la orden de compra de proveedor(' . trim($request->proReasonsocial_Qualify) . ')');
        }
    }
}