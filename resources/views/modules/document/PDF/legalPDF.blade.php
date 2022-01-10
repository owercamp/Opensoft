<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$name}}</title>
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
        <td class="border"></td>
      </tr>
      <tr>
        <td class="border">Versión</td>
        <td class="border"></td>
      </tr>
      <tr>
        <td class="border" rowspan="2">
          {{ucwords('listado matrices legales')}}
        </td>
        <td class="border">Fecha</td>
        <td class="border">{{$day}}</td>
      </tr>
      <tr>
        <td class="border">Página</td>
        <td class="border">
        </td>
      </tr>
    </table>
  </header>
  <main>
    <table class="table border border-secondary table-striped w-100 text-center" style="font-size: 15px;">
      <thead class="text-white" style="background-color: #B0B0B0;">
        <tr>
          <th class="align-middle">{{ucwords('documento')}}</th>
          <th class="align-middle">{{ucwords('tipo documento')}}</th>
          <th class="align-middle">{{ucwords('titulo')}}</th>
          <th class="align-middle">{{ucwords('articulo')}}</th>
          <th class="align-middle">{{ucwords('año')}}</th>
          <th class="align-middle">{{ucwords('Colaborador')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pdfs as $item)
        <tr>
          <td>{{$item->domName}}</td>
          <td>{{$item->lp_typeDoc}}</td>
          <td>{{$item->lp_title}}</td>
          <td>{{$item->lp_article}}</td>
          <td>{{$item->lp_year}}</td>
          <td>{{ucwords($item->coNames)}}</td>
        </tr>
        @endforeach
      </tbody>
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