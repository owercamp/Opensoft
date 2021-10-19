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
        @php $date = Date("Y-m-d",strtotime($term->dateCreated)) @endphp
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
                    <td class="border">{{ $term->docCode }}</td>
                </tr>
                <tr>
                    <td class="border">Versión</td>
                    <td class="border">{{ $term->docVersion }}</td>
                </tr>
                <tr>
                    <td class="border" rowspan="2">
                        {{ $term->docName }}                 
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

        @if($term->cliType == 'Natural')
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">TIPO DE ENTIDAD</th>
                        <th class="border" style="padding: 2px;">NOMBRE</th>
                        <th class="border" style="padding: 2px;">NUMERO DE IDENTIFICACION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ __('PERSONA NATURAL') }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliNamereason }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliNumberdocument }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">MUNICIPIO/DEPARTAMENTO</th>
                        <th class="border" style="padding: 2px;">DIRECCION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $term->depName . '/' . $term->munName }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliAddress }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">TELEFONO</th>
                        <th class="border" style="padding: 2px;">CELULAR</th>
                        <th class="border" style="padding: 2px;">WHATSAPP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $term->cliPhone }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliMovil }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliWhatsapp }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">CORREO ELECTRONICO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $term->cliEmail }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" colspan="2" style="padding: 2px;">DOCUMENTOS ENTREGADOS</th>
                    </tr>
                    <tr>
                        <th class="border" style="padding: 2px;">RUT</th>
                        <th class="border" style="padding: 2px;">FOTOCOPIA DE CEDULA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">
                            @if($term->cliPdfrut != null)
                                {{ __('SI') }}
                            @else
                                {{ __('NO') }}
                            @endif
                        </td>
                        <td class="border" style="padding: 2px;">
                            @if($term->cliPdfphotocopy != null)
                                {{ __('SI') }}
                            @else
                                {{ __('NO') }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">TIPO DE ENTIDAD</th>
                        <th class="border" style="padding: 2px;">RAZON SOCIAL</th>
                        <th class="border" style="padding: 2px;">NUMERO DE NIT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ __('PERSONA JURIDICA') }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliNamereason }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliNumberdocument }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">NOMBRE DE REPRESENTANTE</th>
                        <th class="border" style="padding: 2px;">N° DOCUMENTO DE REPRESENTANTE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $term->cliNamerepresentative }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliNumberrepresentative }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">MUNICIPIO/DEPARTAMENTO</th>
                        <th class="border" style="padding: 2px;">DIRECCION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $term->depName . '/' . $term->munName }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliAddress }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">TELEFONO</th>
                        <th class="border" style="padding: 2px;">CELULAR</th>
                        <th class="border" style="padding: 2px;">WHATSAPP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $term->cliPhone }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliMovil }}</td>
                        <td class="border" style="padding: 2px;">{{ $term->cliWhatsapp }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" style="padding: 2px;">CORREO ELECTRONICO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $term->cliEmail }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="border text-center" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border" colspan="4" style="padding: 2px;">DOCUMENTOS ENTREGADOS</th>
                    </tr>
                    <tr>
                        <th class="border" style="padding: 2px;">RUT</th>
                        <th class="border" style="padding: 2px;">FOTOCOPIA DE CEDULA</th>
                        <th class="border" style="padding: 2px;">CERTIFICADO DE EXISTENCIA</th>
                        <th class="border" style="padding: 2px;">REPRESENTACION LEGAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border" style="padding: 2px;">
                            @if($term->cliPdfrut != null)
                                {{ __('SI') }}
                            @else
                                {{ __('NO') }}
                            @endif
                        </td>
                        <td class="border" style="padding: 2px;">
                            @if($term->cliPdfphotocopy != null)
                                {{ __('SI') }}
                            @else
                                {{ __('NO') }}
                            @endif
                        </td>
                        <td class="border" style="padding: 2px;">
                            @if($term->cliPdfexistence != null)
                                {{ __('SI') }}
                            @else
                                {{ __('NO') }}
                            @endif
                        </td>
                        <td class="border" style="padding: 2px;">
                            @if($term->cliPdflegal != null)
                                {{ __('SI') }}
                            @else
                                {{ __('NO') }}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
            
        <table class="border text-center" width="100%" style="font-size: 12px;">
            <thead>
                <tr>
                    <th class="border" colspan="4" style="padding: 2px;">PORTAFOLIO DE SERVICIOS</th>
                </tr>
                <tr>
                    <th class="border" style="padding: 2px;">TIPO DE SERVICIO</th>
                    <th class="border" style="padding: 2px;">SERVICIO</th>
                    <th class="border" style="padding: 2px;">VEHICULO</th>
                    <th class="border" style="padding: 2px;">TARIFA BASE</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < count($briefcase); $i++)
                    <tr>
                        <td class="border" style="padding: 2px;">{{ $briefcase[$i][0] }}</td>
                        <td class="border" style="padding: 2px;">{{ $briefcase[$i][1] }}</td>
                        <td class="border" style="padding: 2px;">{{ $briefcase[$i][2] }}</td>
                        <td class="border" style="padding: 2px;">{{ $briefcase[$i][3] }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
        <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    </body>

</html>

