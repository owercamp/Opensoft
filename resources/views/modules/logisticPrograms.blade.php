@extends('home')

@section('modules')
<div class="container-fluid bj-container-nav">
  <div class="row">
    <div class="col-md-2">
      <ul class="nav bj-flex">
        <li>
          <a href="{{ route('programs.replacement') }}" class="{{request()->routeIs('programs.replacement') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-paste"></i>
            <p>{{ __('Reposición del parque automotor') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('programs.control') }}" class="{{request()->routeIs('programs.control') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-money-check"></i>
            <p>{{ __('Control de Infracciones a las normas de tránsito') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('programs.report') }}" class="{{request()->routeIs('programs.report') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-copy"></i>
            <p>{{ __('Informe de Control y análisis de accidentes') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('programs.procedures') }}" class="{{request()->routeIs('programs.procedures') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-list-ol"></i>
            <p>{{ __('Procedimientos de atención de usuarios') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('programs.comunications') }}" class="{{request()->routeIs('programs.comunications') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-exchange-alt"></i>
            <p>{{ __('Sistema de Comunicación Bidireccional') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('programs.maintenance') }}" class="{{request()->routeIs('programs.maintenance') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-paste"></i>
            <p>{{ __('Revisión de mantenimiento preventivo') }}</p>
          </a>
        </li>
      </ul>
    </div>
    <div class="col-md-8">
      <div class="row">
        @yield('space')
      </div>
    </div>
    <div class="col-md-2" style="z-index: 1000;">
      <ul class="nav bj-flex">
        <li>
          <a href="{{ route('archive.replacement') }}" class="{{request()->routeIs('archive.replacement') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-paste"></i>
            <p>{{ __('Archivo reposición del parque automotor') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('archive.control') }}" class="{{request()->routeIs('archive.control') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-money-check"></i>
            <p>{{ __('Archivo control de infracciones a las normas de transito') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('archive.report') }}" class="{{request()->routeIs('archive.report') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-copy"></i>
            <p>{{ __('Archivo informe de control y analisis de accidentes') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('archive.procedures') }}" class="{{request()->routeIs('archive.procedures') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-list-ol"></i>
            <p>{{ __('Archivos procedimientos de atención de usuarios') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('archive.comunications') }}" class="{{request()->routeIs('archive.comunications') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-exchange-alt"></i>
            <p>{{ __('Archivo sistema de Comunicación Bidireccional') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('archive.maintenance') }}" class="{{request()->routeIs('archive.maintenance') ? 'nav-link bg-primary' : 'nav-link'}}">
            <i class="fas fa-paste"></i>
            <p>{{ __('Archivo revisión de mantenimiento preventivo') }}</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {

  });
</script>
@endsection