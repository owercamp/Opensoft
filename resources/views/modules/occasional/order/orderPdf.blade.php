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
            small.text-index:before { content: counter(contador-tema) " de " counter(page); }
            small.text-index { counter-increment: contador-tema; counter-reset: contador-parte; }
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
                    <td class="border">{{ $order->oroDocumentcode }}</td>
                </tr>
                <tr>
                    <td class="border">Versión</td>
                    <td class="border">{{ $order->document->docVersion }}</td>
                </tr>
                <tr>
                    <td class="border" rowspan="2">
                        {{ $order->document->docName }}
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
        <table class="border" width="100%" style="font-size: 12px;">
            <thead>
                <tr class="text-center">
                    <th class="border text-center" colspan="4" style="padding: 2px;">DETALLES DE ORDEN DE SERVICIO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" style="padding-left: 10px;">
                        <b>CLIENTE:</b> {{ $order->proposal->cprClient }} <br>
                        <b>Documento:</b> {{ $order->proposal->cprNumberdocument }} <br>
                        <b>Correo:</b> {{ $order->proposal->cprEmail }} <br>
                        <b>Contacto:</b> {{ $order->proposal->cprContact }} <br>
                        <b>Teléfono:</b> {{ $order->proposal->cprPhone }} <br>
                        <b>Ciudad:</b> {{ $order->proposal->municipality->munName }}
                    </td>
                    <td colspan="2" style="padding-left: 10px;">
                        <b>TIPO DE ORDEN:</b> {{ $order->document->docName }}<br>
                        <b>Código:</b> {{ $order->oroDocumentcode }} <br>
                        <b>Versión:</b> {{ $order->document->docVersion }} <br>
                        <b>Fecha inicio:</b> {{ $order->oroDatestart }} <br>
                        <b>Fecha vencimiento:</b> {{ $order->oroDateend }} <br>
                        <b>Estado actual: </b> {{ $order->oroStatus . ' - ' . $order->oroState }}
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <p style="font-size: 12px; text-align: justify;">{{ $order->oroContentfinal }}</p>
        <hr>
        <table class="border text-center" width="100%" style="font-size: 12px;">
            <thead>
                <tr>
                    <th class="border" colspan="4" style="padding: 2px;">PRODUCTOS/SERVICIOS RELACIONADOS</th>
                </tr>
                <tr>
                    <th class="border" style="padding: 2px;">PORTAFOLIO</th>
                    <th class="border" style="padding: 2px;">TIPO DE SERVICIO</th>
                    <th class="border" style="padding: 2px;">TIPO DE VEHICULO</th>
                    <th class="border" style="padding: 2px;">TARIFA BASE</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @for($i = 0; $i < count($list); $i++)
                    @php
                        $total += (int)$list[$i][3]; 
                    @endphp
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $list[$i][0] }}</td>
                        <td class="border" style="padding: 2px;">{{ $list[$i][1] }}</td>
                        <td class="border" style="padding: 2px;">{{ $list[$i][2] }}</td>
                        <td class="border" style="padding: 2px;">{{ $list[$i][3] }}</td>
                    </tr>
                @endfor
                <tr>
                    <td colspan="3" style="text-align: right;">TOTAL A PAGAR:</td>
                    <td style="text-align: right;"><b>{{ $total }}</b></td>
                </tr>
            </tbody>
        </table>
        <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

</html>
