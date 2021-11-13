@extends('home')

@section('modules')
<div class="col-md-12 bj-container-nav">
  <div class="row">
    <div class="col-md-2">
      <ul class="nav bj-flex">
        <li>
          <a href="{{route('training.planing')}}" class="nav-link">
            <i class="fas fa-chalkboard-teacher"></i>
            <p>{{ ucwords('plan de capacitaciones') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{route('training.support')}}" class="nav-link">
            <i class="far fa-clipboard"></i>
            <p>{{ ucwords('soporte de cumplimiento') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{route('training.effectiveness')}}" class="nav-link">
            <i class="fas fa-search-dollar"></i>
            <p>{{ ucwords('eficacia de capacitaciones') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{route('training.indicators')}}" class="nav-link">
            <i class="fas fa-chart-line"></i>
            <p>{{ ucwords('indicadores correspondientes') }}</p>
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