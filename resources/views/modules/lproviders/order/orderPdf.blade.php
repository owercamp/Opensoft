<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Para bootstrap -->
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
        <style>
            @page { margin: 180px 70px 50px 70px; }
            #header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px; background-color: transparent; text-align: center; }
            .page:before { content: counter(page, upper-roman); }
            @media print {
                small.text-index { page-break-before: always; text-align: center; font-size: 12px; }
            }
            small.text-index:before { content: counter(contador-pag) " de " counter(page); }
            small.text-index { counter-increment: contador-pag; counter-reset: contador-total;}
        </style>
    </head>
    <body style="font-size: 12px;">
        @php $date = Date("Y-m-d",strtotime($order->created_at)) @endphp
        <header id="header">
            <table class="border" width="100%" style="text-align: center;">
                <tr>
                    <td class="border" rowspan="4" style="width: 20%; padding: 2px; align-items: center; vertical-align: middle;">
                        <div style="align-items: center; display: flex; flex-flow: column; align-items: center; justify-content: center;">
                            @if(asset('storage/infoCompany/technical/company/'.$technical->teLogocompany))
                                <img style="width: 70px; height: auto;" src="{{ asset('storage/infoCompany/technical/company/'.$technical->teLogocompany) }}">
                            @else
                                {{ __('LOGO') }}
                            @endif
                        </div>
                    </td>
                    <td class="border" rowspan="2" style="width: 40%;">
                        SISTEMA DE GESTION DE CALIDAD Y CONTROL INTERNO
                    </td>
                    <td class="border">Código</td>
                    <td class="border">{{ $order->orpDocumentcode }}</td>
                </tr>
                <tr>
                    <td class="border">Versión</td>
                    <td class="border">{{ $order->document->dolVersion }}</td>
                </tr>
                <tr>
                    <td class="border" rowspan="2">
                        {{ $order->document->dolName }}
                    </td>
                    <td class="border">Fecha</td>
                    <td class="border">{{ $date }}</td>
                </tr>
                <tr>
                    <td class="border">Página</td>
                    <td class="border">
                        <small class="text-index"></small>
                    </td>
                </tr>
            </table>
        </header>
        <div style="width: 100%; padding: 20px; text-align: center;">
          <h5>ESTADO DE ORDEN DE COMPRA: <b style="padding: 10px; border: 1px solid #ccc;">{{ $order->orpStatus }}</b> </h5>
        </div>
        <small class="text-muted">INFORMACION GENERAL: </small>
        <hr>
        <table class="table table-hover text-center" width="100%" style="font-size: 12px;">
          <thead>
            <tr>
              <th>PROVEEDOR</th>
              <th>DOCUMENTO</th>
              <th>DIRECCION</th>
              <th>TELEFONO</th>
              <th>WHATSAPP</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $order->bill->provider->proReasonsocial }}</td>
              <td>{{ $order->bill->provider->proNumberdocument }}</td>
              <td>{{ $order->bill->provider->proAddress }}</td>
              <td>{{ $order->bill->provider->proPhone }}</td>
              <td>{{ $order->bill->provider->proWhatsapp }}</td>
            </tr>
          </tbody>
        </table>
        <small class="text-muted">PRODUCTOS/SERVICIOS DE LA ORDEN DE COMPRA: </small>
        <hr>
        <table border="1" class="table table-hover text-center" width="100%" style="font-size: 12px;">
          <thead>
            <tr>
              <th>TIPO</th>
              <th>NOMBRE</th>
              <th>VrUNITARIO</th>
              <th>CANTIDAD</th>
              <th>$SUBTOTAL</th>
              <th>%IVA</th>
              <th>$IVA</th>
              <th>$TOTAL</th>
            </tr>
          </thead>
          <tbody>
            @for($i = 0; $i < count($listOrders); $i++)
              <tr>
                <td>{{ $listOrders[$i][0] }}</td>
                <td>{{ $listOrders[$i][1] }}</td>
                <td>{{ $listOrders[$i][2] }}</td>
                <td>{{ $listOrders[$i][3] }}</td>
                <td>{{ $listOrders[$i][4] }}</td>
                <td>{{ $listOrders[$i][5] }}</td>
                <td>{{ $listOrders[$i][6] }}</td>
                <td>{{ $listOrders[$i][7] }}</td>
              </tr>
            @endfor
            <tr>
              <td colspan="4">TOTAL A PAGAR</td>
              <td>{{ $order->orpSubtotal }}</td>
              <td></td>
              <td>{{ $order->orpIva }}</td>
              <td>{{ $order->orpTotal }}</td>
            </tr>
            <!-- Dinamics row -->
            <!-- orpProductservice, type, name, valueUnity, count, subtotal, % iva, $iva, $total -->
          </tbody>
        </table>
        <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

</html>
