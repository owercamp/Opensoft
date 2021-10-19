@extends('home')

@section('modules')
<div class="col-md-12 bj-container-nav">
  <div class="row">
    <div class="col-md-2">
      <ul class="nav bj-flex">
        <li>
          <a href="{{ route('commitee.index') }}" class="nav-link">
            <i class="fas fa-chalkboard-teacher"></i>
            <p>{{ __('Actas de Comités') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('process.commitee') }}" class="nav-link">
            <i class="fas fa-exchange-alt"></i>
            <p>{{ __('Actas en Proceso') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('file.commitee') }}" class="nav-link">
            <i class="fas fa-boxes"></i>
            <p>{{ __('Archivo de Actas') }}</p>
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