@extends('home')

@section('modules')
<div class="col-md-12 bj-container-nav">
  <div class="row">
    <div class="col-md-2">
      <ul class="nav bj-flex">
        <li>
          <a href="{{route('list.improvement')}}" class="nav-link">
            <i class="fas fa-chalkboard-teacher"></i>
            <p>{{ucwords('listado maestro')}}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{route('procedure.improvement')}}" class="nav-link">
            <i class="far fa-clipboard"></i>
            <p>{{ ucwords('procedimientos documentales') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{route('register.improvement')}}" class="nav-link">
            <i class="fas fa-search-dollar"></i>
            <p>{{ ucwords('registros documentales') }}</p>
          </a>
        </li>
        <div class="dropdown-divider bj-divider"></div>
        <li>
          <a href="{{route('search.improvement')}}" class="nav-link">
            <i class="fas fa-chart-line"></i>
            <p>{{ ucwords('documentos de consulta') }}</p>
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