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
        @php $date = Date("Y-m-d",strtotime($control->ascDate)) @endphp
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
                    <td class="border">{{ $control->ascDocumentcode }}</td>
                </tr>
                <tr>
                    <td class="border">Versión</td>
                    <td class="border">{{ $control->document->dolVersion }}</td>
                </tr>
                <tr>
                    <td class="border" rowspan="2">
                        {{ $control->document->dolName }}                 
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
        <table class="table text-center" width="100%">
        	<thead>
	        	<tr>
	        		<th>FECHA</th>
	        		<th>CONTRATISTA</th>
	        		<th>TIPO DE AUSENTISMO</th>
	        		<th>OBSERVACION</th>
	        	</tr>
        	</thead>
        	<tbody>
        		<tr>
        			<td>{{ $date }}</td>
        			<td>
        				@if($control->bill->bcTypecontractor == 'MENSAJERIA')
							{{ $control->bill->messenger->cmNames }}
						@elseif($control->bill->bcTypecontractor == 'CARGA EXPRESS')
							{{ $control->bill->charge->ccNames }}
						@elseif($control->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
							{{ $control->bill->especial->ceNames }}
						@endif
        			</td>
	        		<td>{{ $control->ascAbsenteeism }}</td>
	        		<td>{{ $control->ascDescription }}</td>
        		</tr>
        	</tbody>
        </table>
        <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

</html>

