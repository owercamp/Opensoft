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
        @php $date = Date("Y-m-d",strtotime($training->tcoDate)) @endphp
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
                    <td class="border">{{ $training->tcoDocumentcode }}</td>
                </tr>
                <tr>
                    <td class="border">Versión</td>
                    <td class="border">{{ $training->document->dolVersion }}</td>
                </tr>
                <tr>
                    <td class="border" rowspan="2">
                        {{ $training->document->dolName }}                 
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
        <p style="text-align: justify; border-bottom-style: solid; border-color: #ccc;">
        	<b>{{ __('CAPACITACION: ') }}</b>{{ $training->tcoNametraining }}<br>
        	<b>{{ __('CAPACITADOR: ') }}</b>{{ $training->tcoNametrainer }}<br>
        </p>
        <table border="1" class=" table-striped text-center" width="100%" style="font-size: 11px; border-collapse: collapse;">
        	<thead>
	        	<tr>
	        		<th style="height: 20px; padding: 6px;">COLABORADOR</th>
	        		<th style="height: 20px; padding: 6px;">DOCUMENTO</th>
	        		<th style="height: 20px; padding: 6px;">CARGO</th>
	        		<th style="height: 20px; padding: 6px; width: 120px;">FIRMA</th>
	        	</tr>
        	</thead>
        	<tbody>
        		@foreach($binnacles as $binnacle)
        			<tr>
        				<td style="padding: 2px;">{{ $binnacle->bill->collaborator->coNames }}</td>
        				<td style="padding: 2px;">{{ $binnacle->bill->collaborator->coNumberdocument }}</td>
        				<td style="padding: 2px;">{{ $binnacle->bill->collaborator->coPosition }}</td>
        				<td style="padding: 2px;"></td>
        			</tr>
        		@endforeach
        	</tbody>
        </table>
        <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

</html>

