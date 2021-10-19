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
        @php $date = Date("Y-m-d",strtotime($legalization->created_at)) @endphp
        <img src="{{ asset('storage/stamps/billpendingred.png') }}"
        	style="
        		width: 600px;
        		height: auto;
        		position: absolute;
        		left: 50%;
        		top: 50%;
        		margin-left: -300px;
        		margin-top: -450px;
        		transform: rotate(-35deg);
        		opacity: .4;
        ">
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
                    <td class="border">{{ $legalization->bpDocumentcode }}</td>
                </tr>
                <tr>
                    <td class="border">Versión</td>
                    <td class="border">{{ $legalization->document->dolVersion }}</td>
                </tr>
                <tr>
                    <td class="border" rowspan="2">
                        {{ $legalization->document->dolName }}                 
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
        <p style="text-align: justify;">
            {{ $legalization->bpContentfinal }}
        </p>
        <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

</html>

