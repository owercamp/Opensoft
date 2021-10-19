@extends('home')

@section('modules')
<div class="col-md-12 bj-container-nav">
  <div class="row">
    <div class="col-md-2">
      <ul class="nav bj-flex">
        <li>
          <a href="{{ route('legal.index') }}" class="nav-link">
            <i class="fas fa-chalkboard-teacher"></i>
            <p>{{ __('Matriz Legal') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('analysis.index') }}" class="nav-link">
            <i class="fas fa-exchange-alt"></i>
            <p>{{ __('Matriz de Analisis') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('matriz.index') }}" class="nav-link">
            <i class="fas fa-boxes"></i>
            <p>{{ __('Matriz EPP') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('accountability.index') }}" class="nav-link">
            <i class="fas fa-boxes"></i>
            <p>{{ __('Rendición de Cuentas') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{ route('program.index') }}" class="nav-link">
            <i class="fas fa-boxes"></i>
            <p>{{ __('Programas') }}</p>
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