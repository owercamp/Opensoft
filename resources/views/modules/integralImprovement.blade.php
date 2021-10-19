@extends('home')

@section('modules')
<div class="col-md-12 bj-container-nav">
  <div class="row">
    <div class="col-md-2">
      <ul class="nav bj-flex">
        <li>
          <a href="{{ route('improvement.hankbook') }}" class="nav-link">
            <i class="fas fa-fist-raised"></i>
            <p>{{ __('Creación de Documentos') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('improvement.procedures') }}" class="nav-link">
            <i class="fas fa-clipboard-list"></i>
            <p>{{ __('Creación de Variables') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('improvement.planing') }}" class="nav-link">
            <i class="fas fa-list-ol"></i>
            <p>{{ __('Configuración Documento') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('improvement.programs') }}" class="nav-link">
            <i class="fab fa-accusoft"></i>
            <p>{{ __('Acciones Preventivas') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('improvement.documents') }}" class="nav-link">
            <i class="fas fa-copy"></i>
            <p>{{ __('Acciones Correctivas') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('improvement.formats') }}" class="nav-link">
            <i class="fas fa-paste"></i>
            <p>{{ __('Oportunidades de Mejora') }}</p>
          </a>
        </li>
      </ul>
    </div>
    <div class="col-md-10">
      <div class="row">
        @yield('space')
      </div>
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