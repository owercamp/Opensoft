@extends('modules.logisticProviders')

@section('space')
<div class="col-md-12">
  @include('partials.alerts')
  <h5>EVALUACIONES DE DESEMPEÑO</h5>
  <div class="container">
    <div class="col-lg-12 row">
      <form action="{{route('provider.evaluation')}}" method="post" class="col-lg-8 shadow p-3">
        @csrf
        <div class="col-lg-12 row">
          <div class="col-lg-4">
            <div class="form-group">
              <small>{{ucwords('fecha')}}</small>
              <input type="date" name="su_date" id="" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <small>{{ucwords('proveedor')}}</small>
              <select name="su_provider" id="" class="form-control form-control-sm" required>
                <option value="">{{ucwords('seleccione...')}}</option>
                @foreach ($providers as $provider)
                  <option value="{{$provider->proId}}">{{ucwords($provider->proReasonsocial)}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <small>{{ucwords('estado')}}</small>
              <select name="su_status" id="" class="form-control form-control-sm" required>
                <option value="">{{ucwords('seleccione...')}}</option>
                <option value="{{strtoupper('cumple')}}">{{ucwords('cumple')}}</option>
                <option value="{{strtoupper('no cumple')}}">{{ucwords('no cumple')}}</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <small class="text-muted">{{ucwords('evaluación')}}</small>
            <textarea name="su_comment" id="" cols="30" rows="10" class="form-control-sm form-control" required></textarea>
          </div>
        </div>
        <div class="col-lg-12 d-flex justify-content-center">
          <button class="btn btn-outline-primary">{{ucwords('guardar')}}</button>
        </div>
      </form>
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