@extends('modules.operativeRequest')

@section('space')
<div class="col-md-12">
  <h5>TRASLADO URBANO</h5>
  @include('partials.alerts')
  <form action="{{ route('request.transfer.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <small class="text-muted">Nombre de cliente: </small>
          <select name="reuClient" class="form-control form-control-sm select2" required>
            <option value="">Seleccione ...</option>
            @for($i = 0; $i < count($clients); $i++) <option value="{{ $clients[$i][0] }}" data-name="{{ $clients[$i][1] }}" data-document="{{ $clients[$i][2] }}" data-datestart="{{ $clients[$i][3] }}" data-dateend="{{ $clients[$i][4] }}" data-type="{{ $clients[$i][5] }}">
              {{ $clients[$i][1] }}
              </option>
              @endfor
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <small class="text-muted">Tipo de servicio: </small>
          <select name="reuTransfer_id" class="form-control form-control-sm select2" required>
            <option value="">Seleccione...</option>
            @foreach($servicetransfers as $servicetransfer)
            <option value="{{ $servicetransfer->strId }}" data-service="{{ $servicetransfer->strService }}" data-description="{{ $servicetransfer->strDescription }}">
              {{ $servicetransfer->strService }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <small class="text-muted">Fecha: </small>
          <input type="text" name="reuDateservice" class="form-control form-control-sm text-center datepicker" required>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <small class="text-muted">Hora: </small>
          <input type="time" name="reuHourstart" class="form-control form-control-sm" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 p-1 pr-3 border-right">
        <small style="color: blue; font-weight: bold;">ORIGEN: </small>
        <div class="row border-top">
          <div class="col-md-4">
            <!-- CIUDAD -->
            <div class="form-group">
              <small class="text-muted">Ciudad: </small>
              <select name="reuMunicipalityorigin_id" class="form-control form-control-sm select2" required>
                <option value="">Seleccione ...</option>
                @foreach($municipalities as $municipality)
                <option value="{{ $municipality->munId }}" data-municipality="{{ $municipality->munName }}">
                  {{ $municipality->munName }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-8">
            <!-- DIRECCION -->
            <div class="form-group">
              <small class="text-muted">Dirección: </small>
              <input type="text" name="reuAddressorigin" class="form-control form-control-sm" required>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 p-1 pl-3 border-left">
        <small style="color: blue; font-weight: bold;">DESTINO: </small>
        <div class="row border-top">
          <div class="col-md-4">
            <!-- CIUDAD -->
            <div class="form-group">
              <small class="text-muted">Ciudad: </small>
              <select name="reuMunicipalitydestiny_id" class="form-control form-control-sm select2" required>
                <option value="">Seleccione ...</option>
                @foreach($municipalities as $municipality)
                <option value="{{ $municipality->munId }}" data-municipality="{{ $municipality->munName }}">
                  {{ $municipality->munName }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-8">
            <!-- DIRECCION -->
            <div class="form-group">
              <small class="text-muted">Dirección: </small>
              <input type="text" name="reuAddressdestiny" class="form-control form-control-sm" required>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <small class="text-muted">Contacto: </small>
          <input type="text" name="reuContact" maxlength="50" title="De 1 a 50 carácteres NO numéricos" class="form-control form-control-sm" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <small class="text-muted">Teléfono: </small>
          <input type="text" name="reuPhone" maxlength="10" pattern="[0-9]{1,10}" title="De 1 a 10 números" class="form-control form-control-sm" required>
        </div>
      </div>
    </div>
    <div class="form-group text-center m-3">
      <input type="hidden" name="reuTypecliente" class="form-control form-control-sm" required>
      <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR REGISTRO</button>
    </div>
  </form>
</div>

@endsection

@section('scripts')
<script>
  $('select[name=reuClient]').on('change', function(e) {
    let selected = e.target.value;
    $('input[name=reuTypecliente]').val('');
    if (selected !== '') {
      let type = $('select[name=reuClient] option:selected').attr('data-type');
      $('input[name=reuTypecliente]').val(type);
    }
  });
</script>
@endsection