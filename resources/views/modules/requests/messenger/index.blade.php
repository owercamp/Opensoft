@extends('modules.operativeRequest')

@section('space')
<div class="col-md-12 p-3" style="font-size: 12px;">
  <div class="row border-bottom mb-2">
    <div class="col-md-6">
      <h5>MENSAJERIA EXPRESS</h5>
    </div>
    <div class="col-md-6">
      @if(session('SuccessMessenger'))
      <div class="alert alert-success">
        {{ session('SuccessMessenger') }}
      </div>
      @endif
      @if(session('SecondaryMessenger'))
      <div class="alert alert-secondary">
        {{ session('SecondaryMessenger') }}
      </div>
      @endif
    </div>
  </div>
  <form action="{{ route('request.messenger.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <small class="text-muted">Nombre de cliente: </small>
          <select name="remClient" class="form-control form-control-sm" required>
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
          <select name="remMessenger_id" class="form-control form-control-sm" required>
            <option value="">Seleccione ...</option>
            @foreach($servicemessengers as $servicemessenger)
            <option value="{{ $servicemessenger->smId }}" data-service="{{ $servicemessenger->smService }}" data-description="{{ $servicemessenger->smDescription }}">
              {{ $servicemessenger->smService }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <small class="text-muted">Fecha: </small>
          <input type="text" name="remDateservice" class="form-control form-control-sm text-center datepicker" required>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <small class="text-muted">Hora: </small>
          <input type="time" name="remHourstart" class="form-control form-control-sm" required>
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
              <select name="remMunicipalityorigin_id" class="form-control form-control-sm" required>
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
              <input type="text" name="remAddressorigin" class="form-control form-control-sm" required>
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
              <select name="remMunicipalitydestiny_id" class="form-control form-control-sm" required>
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
              <input type="text" name="remAddressdestiny" class="form-control form-control-sm" required>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <small class="text-muted">Contacto: </small>
          <input type="text" name="remContact" maxlength="50" title="De 1 a 50 carácteres NO numéricos" class="form-control form-control-sm" required>
        </div>
        <div class="form-group">
          <small class="text-muted">Teléfono: </small>
          <input type="text" name="remPhone" maxlength="10" pattern="[0-9]{1,10}" title="De 1 a 10 números" class="form-control form-control-sm" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <small class="text-muted">Observación: </small>
          <textarea name="remObservation" rows="4" class="form-control form-control-sm" required></textarea>
        </div>
      </div>
    </div>
    <div class="form-group text-center m-3">
      <input type="hidden" name="remTypecliente" class="form-control form-control-sm" required>
      <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR REGISTRO</button>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script>
  $('select[name=remClient]').on('change', function(e) {
    let selected = e.target.value;
    $('input[name=remTypecliente]').val('');
    if (selected !== '') {
      let type = $('select[name=remClient] option:selected').attr('data-type');
      $('input[name=remTypecliente]').val(type);
    }
  });
</script>
@endsection