<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('img/shortlogo.gif') }}" />

  <title>{{ config('app.name', 'opensoft') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Ubuntu&family=Allison&family=Glory" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- Fullcalendar -->
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar/packages/core/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar/packages/daygrid/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar/packages/timegrid/main.min.css')}}">
  <!-- ChartJs -->
  <link rel="stylesheet" href="{{asset('plugins/chartJS/Chart.min.css')}}">
</head>

<body>
  <div id="app" class="bj-body">

    <!-- # HEADER # -->
    <header class="row">
      <div class="col-md-3">
        <div class="bj-logo">
          <div>
            <a href="{{ url('/home') }}">
              <img src="{{ asset('img/shortlogo.gif') }}" class="img-opensoft" alt="{{ config('app.lastname', 'OPENSOFT') }}">
            </a><br>
            <small class="kinsmall">{{ __('OPEN') }}</small><small class="sofsmall">{{ __('SOFT') }}</small><small class="tm">&trade;</small>
          </div>
          <div style="padding-left: 10px;">
            <small class="javapri">{{ __('Versión 20.03.01') }}</small><br>
            <small class="javapri">{{ __('Copyright © Javapri') }}</small>
            <!-- <b><small class="eslogan">{{ __('Control en linea') }}</small></b> -->
          </div>
        </div>
      </div>
      @auth
      <input type="hidden" id="validateAuthColor" name="validateAuthColor" value="Autenticado">
      <div class="col-md-6 bj-nav">
        <ul class="bj-header-menu">
          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          <li><a href="#">CREACION <i class="fas fa-level-down-alt"></i></a>
            <ul class="bj-header-submenu">
              <li><a href="{{ route('access.roles') }}">ACCESO</a></li>
              <li><a href="{{ route('places.departments') }}">LUGARES</a></li>
              <li><a href="{{ route('security.health') }}">SEGURIDAD SOCIAL</a></li>
              <li><a href="{{ route('documents.personal') }}">DOCUMENTOS</a></li>
              <li><a href="{{ route('vehicle.motorcycles') }}">TIPOS DE VEHICULOS</a></li>
              <li><a href="{{ route('products.messenger') }}">TIPOS DE PRODUCTOS</a></li>
              <li><a href="{{ route('services.messenger') }}">TIPOS DE SERVICIOS</a></li>
            </ul>
          </li>
          @endhasanyrole
          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          <li><a href="#">SISTEMAS <i class="fas fa-level-down-alt"></i></a>
            <ul class="bj-header-submenu">
              <li><a href="{{ route('managerial.hankbook') }}">SG-GERENCIAL</a></li>
              <li><a href="{{ route('logistic.hankbook') }}">SG-LOGISTICA</a></li>
              <li><a href="{{ route('commercial.hankbook') }}">SG-COMERCIAL</a></li>
              <li><a href="{{ route('operative.hankbook') }}">SG-OPERATIVA</a></li>
              <li><a href="{{ route('improvement.hankbook') }}">SG-MEJORA CONTINUA</a></li>
              <!-- <li><a href="{{ route('documentary.hankbook') }}">SG-DOCUMENTAL</a></li> -->
            </ul>
          </li>
          @endhasanyrole
          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          <li><a href="#">BASE DE DATOS<i class="fas fa-level-down-alt"></i></a>
            <ul class="bj-header-submenu">
              <li><a href="{{ route('company.legal') }}">CREACION EMPRESA</a></li>
              <li><a href="{{ route('humans.collaborators') }}">CREACION RECURSOS HUMANOS</a></li>
              <li><a href="{{ route('providers.products') }}">CREACION PROVEEDORES</a></li>
              <li><a href="{{ route('allies.messengers') }}">CREACION EMPRESAS ALIADAS</a></li>
              <li><a href="{{ route('automotors.messengers') }}">CREACION PARQUE AUTOMOTOR</a></li>
              <li><a href="{{ route('training.planing') }}">CREACION DE CAPACITACIONES</a></li>
            </ul>
          </li>
          @endhasanyrole
          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          <li><a href="#">GERENCIAL<i class="fas fa-level-down-alt"></i></a>
            <ul class="bj-header-submenu">
              <li><a href="{{route('commitee.index')}}">COMITES</a></li>
              <li><a href="{{route('implementation.index')}}">PROCEDIMIENTOS</a></li>
              <li><a href="{{route('legal.index')}}">DOCUMENTOS</a></li>
            </ul>
          </li>
          @endhasanyrole

          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          <li><a href="#">COMERCIAL <i class="fas fa-level-down-alt"></i></a>
            <ul class="bj-header-submenu">
              <!-- <li><a href="{{ route('tariffs.messenger') }}">TABLA DE TARIFAS</a></li> -->
              <li><a href="{{ route('tariffs.messenger') }}">PORTAFOLIO DE SERVICIOS</a></li>
              <li><a href="{{ route('marketing.opportunity') }}">PLAN DE MERCADEO</a></li>
              <li><a href="{{ route('clients.bidding') }}">CLIENTE POTENCIAL</a></li>
              <li><a href="{{ route('permanent.clients') }}">CONTRATOS PERMANENTES</a></li>
              <li><a href="{{ route('occasional.orders') }}">CONTRATOS OCASIONALES</a></li>
            </ul>
          </li>
          @endhasanyrole
          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          <li><a href="#">LOGISTICA <i class="fas fa-level-down-alt"></i></a>
            <ul class="bj-header-submenu">
              <li><a href="{{ route('collaborators.position') }}">COLABORADORES</a></li>
              <li><a href="{{ route('contractors.handbook') }}">CONTRATISTAS</a></li>
              <li><a href="{{ route('providers.bill') }}">PROVEEDORES</a></li>
              <li><a href="{{ route('programs.replacement') }}">PROGRAMAS</a></li>
            </ul>
          </li>
          @endhasanyrole
          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          <li><a href="#">OPERATIVA <i class="fas fa-level-down-alt"></i></a>
            <ul class="bj-header-submenu">
              <li><a href="{{ route('request.messenger') }}">SOLICITUD DE SERVICIOS</a></li>
              <li><a href="{{ route('programming.assignment') }}">PROGRAMACION DE SERVICIOS</a></li>
              <li><a href="{{ route('tracking.confirmation') }}">SEGUIMIENTO DE SERVICIOS</a></li>
              <li><a href="{{ route('settlement.clients') }}">LIQUIDACION DE SERVICIOS</a></li>
              <li><a href="{{ route('qualification.users') }}">CALIFICACION DE SERVICIOS</a></li>
            </ul>
          </li>
          @endhasanyrole
          @hasanyrole('ADMINISTRADOR SISTEMA|ADMINISTRADOR|OPERADOR')
          <li><a href="#">FINANCIERA <i class="fas fa-level-down-alt"></i></a>
            <ul class="bj-header-submenu">
              <li><a href="{{ route('account.receivable') }}">CUENTAS POR COBRAR</a></li>
              <li><a href="{{ route('account.pay') }}">CUENTAS POR PAGAR</a></li>
              <li><a href="{{ route('entrys.facturation') }}">MOVIMIENTO DE INGRESOS</a></li>
              <li><a href="{{ route('egress.accounts') }}">MOVIMIENTO DE EGRESOS</a></li>
              <li><a href="{{ route('analysis.conciliation') }}">ANALISIS DE PRESUPUESTO</a></li>
            </ul>
          </li>
          @endhasanyrole
          @endhasanyrole
        </ul>
      </div>
      <div class="col-md-3">
        <div class="row profile">
          <img src="{{ asset('img/bg_profile.png') }}" class="bg-profile" alt="{{ config('app.lastname', 'PROFILE') }}">
          <div class="bj-profile">
            <i class="fas fa-user bj-user"></i>
            <a href="#" class="bj-link-user">
              {{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}<br>
              @if(isset(Auth::user()->getRoleNames()[0]))
              {{ Auth::user()->getRoleNames()[0] }}
              @else
              {{ __('ROL INDEFINIDO') }}
              @endif
            </a>
            <a href="{{ route('logout') }}" title="Salir" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-in-alt bj-icon-logout"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </div>
      </div>
      @else
      <input type="hidden" id="validateAuthColor" name="validateAuthColor" value="Ausente">
      @endauth
    </header>
    <!-- # HEADER # -->
    <main class="row">
      @yield('content')
    </main>
  </div>

  <!-- ckeditor5 -->
  <script src="{{asset('plugins/ckeditor/build/ckeditor.js')}}"></script>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  <!-- Fullcalendar-->
  <script src="{{asset('plugins/fullcalendar/moment/main.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar/packages/core/main.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar/packages/daygrid/main.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar/packages/timegrid/main.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar/packages/interaction/main.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar/packages/core/locales/es.js')}}"></script>


  <!-- ChartJS para graficos de las estadisticas -->
  <script src="{{asset('plugins/chartJS/Chart.min.js')}}"></script>

  <!-- Plugin de jsPDF para reportes -->
  <script src="{{asset('plugins/jsPDF-1.3.2/dist/jspdf.min.js')}}"></script>
  <!-- Plugin de html2canvas para reportes -->
  <script src="{{asset('plugins/html2canvas/html2canvas.min.js')}}"></script>
  @yield('scripts')
</body>

</html>