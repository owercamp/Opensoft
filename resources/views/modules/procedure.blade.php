@extends('home')

@section('modules')
<div class="col-md-12 bj-container-nav">
  <div class="row">
    <div class="col-md-2">
      <ul class="nav bj-flex">
        <li>
          <a href="{{ route('implementation.index') }}" class="nav-link">
            <i class="fas fa-mail-bulk"></i>
            <p>{{ __('Implementación de Procedimientos') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('process.procedures') }}" class="nav-link">
            <i class="fas fa-exchange-alt"></i>
            <p>{{ __('Procedimientos en Proceso') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('file.procedures') }}" class="nav-link">
            <i class="fas fa-boxes"></i>
            <p>{{ __('Archivo de Procedimientos') }}</p>
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