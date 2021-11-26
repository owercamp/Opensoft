<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
  <style>
    @page {
      margin: 180px 70px 50px 70px;
    }

    #header {
      position: fixed;
      left: 0px;
      top: -150px;
      right: 0px;
      height: 150px;
      background-color: transparent;
      text-align: center;
    }
  </style>
</head>

<body>
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
        <td class="border" style="font-size: 0.89rem;">{{$search->neCode}}</td>
      </tr>
      <tr>
        <td class="border">Versión</td>
        <td class="border"></td>
      </tr>
      <tr>
        <td class="border" rowspan="2">
          {{strtoupper('hoja de vida')}}
        </td>
        <td class="border">Fecha</td>
        <td class="border">{{ $day }}</td>
      </tr>
      <tr>
        <td class="border">Página</td>
        <td class="border">
        </td>
      </tr>
    </table>
  </header>
  <main>
    <table width="100%">
      <!-- <tr>
        <td colspan="2">
          <p class="text-center ml-4">{{ucwords('foto actual')}}</p>
          <img src="{{asset($photo)}}" style="width: 3cm; height: 4cm; margin-left:29%;" class="border border-secondary rounded p-1">
        </td>
        <td colspan="2">
          <p class="text-center">{{ucwords('firma actual')}}</p>
          <img src="{{asset($firm)}}" alt="" style="width: 3cm; height: 4cm; margin-left:37%;" class="border border-secondary rounded p-1">
        </td>
      </tr> -->
      <!-- información del empleado -->
      <tr>
        <td colspan="6" class="text-center text-primary py-2" style="font-size: 25px;">{{ucwords('información personal')}}</td>
      </tr>
      <tr>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('nombres completos')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($names)}}</p>
        </td>
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('tipo de identificación')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->perName)}}</p>
        </td>

        <td colspan="1" rowspan="3">
          <img src="{{asset($photo)}}" style="width: 3cm; height: 4cm; margin-left:7%;" class="border border-secondary rounded p-1">
        </td>
      </tr>
      <tr>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('numero de documento')}}</small>
          <p class="border-bottom border-primary px-2">{{number_format($cc,0,',','.')}}</p>
        </td>
        @if(isset($position))
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('cargo')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($position)}}</p>
        </td>
        @endif
        @if (!isset($position))
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('departamento')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->depName)}}</p>
        </td>
        @endif
      </tr>
      <tr>
        @if (isset($position))
        <td class="px-1">
          <small class="mb-0">{{ucwords('departamento')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->depName)}}</p>
        </td>
        @endif
        <td class="px-1" colspan="{{(isset($position))? 1 : 2}}">
          <small class="mb-0">{{ucwords('ciudad/Municipio')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->munName)}}</p>
        </td>
        @if (isset($position))
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('localidad/zona')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->zonName)}}</p>
        </td>
        @endif
        @if (!isset($position))
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('localidad/zona')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->zonName)}}</p>
        </td>
        @endif
      </tr>
      <tr>
        @if (!isset($position) && $form != "CONTRATISTAS MENSAJERIA")
        <td class="px-1">
          <small class="mb-0">{{ucwords('localidad/zona')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->zonName)}}</p>
        </td>
        @endif
        <td class="px-1" colspan="{{($form == 'CONTRATISTAS CARGA EXPRESS' || $form == 'CONTRATISTAS SERVICIOS ESPECIALES') ? 2 : 1}}">
          <small class="mb-0">{{ucwords('barrio')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->neName)}}</p>
        </td>
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('dirección')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($address)}}</p>
        </td>
        @if ($form != 'CONTRATISTAS CARGA EXPRESS' && $form != 'CONTRATISTAS SERVICIOS ESPECIALES')
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('telefono celular')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($movil)}}</p>
        </td>
        @endif
      </tr>
      <tr>
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('correo electronico')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($mail)}}</p>
        </td>
        @if ($form == 'CONTRATISTAS CARGA EXPRESS' || $form == 'CONTRATISTAS SERVICIOS ESPECIALES')
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('telefono celular')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($movil)}}</p>
        </td>
        @endif
      </tr>
      <!-- información general de entidades prestadoras de servicios al empleado -->
      <tr>
        <td colspan="6" class="text-center text-primary py-2" style="font-size: 20px;">{{ucwords('información general')}}</td>
      </tr>
      <tr>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('entidad promotora de salud')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->heaName)}}</p>
        </td>
        <td class="px-1" colspan="4">
          <small class="mb-0">{{ucwords('administradora de riesgos laborales')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->risName)}}</p>
        </td>
      </tr>
      <tr>
        <td class="px-1" colspan="1">
          <small class="mb-0">{{ucwords('caja de compensación')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->comName)}}</p>
        </td>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('fondo de pension')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->penName)}}</p>
        </td>
        <td class="px-1" colspan="3">
          <small class="mb-0">{{ucwords('cesantias')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->layName)}}</p>
        </td>
      </tr>
      <!-- información de referencias laborales y personales -->
      <tr>
        <td colspan="6" class="text-center bg-secondary text-white my-2" style="font-size: 16px;">{{ucwords('referencias personales')}}</td>
      </tr>
      <tr>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('nombres completos')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->colRef1)}}</p>
        </td>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('cedula')}}</small>
          <p class="border-bottom border-primary px-2">{{number_format($search->cedRef1,0,',','.')}}</p>
        </td>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('telefono')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->numRef1)}}</p>
        </td>
      </tr>
      <tr>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('nombres completos')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->colRef2)}}</p>
        </td>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('cedula')}}</small>
          <p class="border-bottom border-primary px-2">{{number_format($search->cedRef2,0,',','.')}}</p>
        </td>
        <td class="px-1" colspan="2">
          <small class="mb-0">{{ucwords('telefono')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->numRef2)}}</p>
        </td>
      </tr>
      <tr>
        <td colspan="6" class="text-center bg-secondary text-white my-2" style="font-size: 16px;">{{ucwords('referencias laboral')}}</td>
      </tr>
    </table>
    <table width="100%">
      <tr>
        <td colspan="3">
          <small class="mb-0">{{ucwords('razón social')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->rsRef1)}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('nit')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->nitRef1)}}</p>
        </td>
        <td>
          <small class="mb-0">{{ucwords('telefono')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->phoRef1)}}</p>
        </td>
      </tr>
      <tr>
        <td colspan="4">
          <small class="mb-0">{{ucwords('dirección')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->addRef1)}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('ciudad')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->ciuRef1)}}</p>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <small class="mb-0">{{ucwords('razón social')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->rsRef2)}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('nit')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->nitRef2)}}</p>
        </td>
        <td>
          <small class="mb-0">{{ucwords('telefono')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->phoRef2)}}</p>
        </td>
      </tr>
      <tr>
        <td colspan="4">
          <small class="mb-0">{{ucwords('dirección')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->addRef2)}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('ciudad')}}</small>
          <p class="border-bottom border-primary px-2">{{ucwords($search->ciuRef2)}}</p>
        </td>
      </tr>
      <!-- información academica -->
      @if ($search->titlePrimary != null || $search->titleSecondary != null)
      <tr>
        <td colspan="6" class="text-center text-primary py-2" style="font-size: 25px;">{{ucwords('información academica')}}</td>
      </tr>
      @endif
      <!-- primaria -->
      @if ($search->titlePrimary)
      <tr>
        <td colspan="6" class="text-center bg-secondary text-white my-2" style="font-size: 16px;">{{ucwords('primaria')}}</td>
      </tr>
      <tr>
        <td colspan="2">
          <small class="mb-0">{{ucwords('titulo')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->titlePrimary)}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('centro academico')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->acaPrimary)}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('ciudad/Departamento')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->dePrimary)}}</p>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <small class="mb-0">{{ucwords('inicio')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->iniPrimary)}}</p>
        </td>
        <td></td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('fin')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->finPrimary)}}</p>
        </td>
        <td></td>
      </tr>
      @endif
      <!-- secundario -->
      @if ($search->titleSecondary)
      <tr>
        <td colspan="6" class="text-center bg-secondary text-white my-2" style="font-size: 16px;">{{ucwords('secundaria')}}</td>
      </tr>
      <tr>
        <td colspan="2">
          <small class="mb-0">{{ucwords('titulo')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->titleSecondary)}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('centro academico')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->acaSecondary)}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('ciudad/Departamento')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->deSecondary)}}</p>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <small class="mb-0">{{ucwords('inicio')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->iniSecondary)}}</p>
        </td>
        <td></td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('fin')}}</small>
          <p class="border-bottom border-primary mx-2">{{ucwords($search->finSecondary)}}</p>
        </td>
        <td></td>
      </tr>
      @endif
      <tr>
        <td colspan="6" class="text-center bg-secondary text-white my-2" style="font-size: 16px;">{{ucwords('otros cursos')}}</td>
      </tr>
      @for ($i = 0; $i < ((isset($academic))? count($academic) : 0); $i++) <tr>
        <td colspan="2">
          <small class="mb-0">{{ucwords('titulo')}}</small>
          <p>{{$title[$i]}}</p>
        </td>
        <td colspan="2">
          <small class="mb-0">{{ucwords('academia')}}</small>
          <p>{{$academic[$i]}}</p>
        </td>
        <td>
          <small class="mb-0">{{ucwords('inicio')}}</small>
          <p>{{$initial[$i]}}</p>
        </td>
        <td>
          <small class="mb-0">{{ucwords('fin')}}</small>
          <p>{{$final[$i]}}</p>
        </td>
        </tr>
        @endfor
        <tr>
          <td colspan="3">
            <img src="{{asset($firm)}}" alt="" style="width: 4cm; height: 3cm; margin-left:3%;" class="border border-secondary rounded p-1 mt-4">
          </td>
        </tr>
    </table>
  </main>
  <script type="text/php">
    if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(480, 90, "$PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
	</script>
  <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>