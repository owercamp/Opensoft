@extends('modules.comercialPotentialclient')

@section('space')
<div class="col-md-12">
  <div class="row">
    <div class="col-md-6">
      <h5>LICITACIONES PUBLICAS</h5>
    </div>
    <div class="col-md-6">
      @if(session('SuccessBidding'))
      <div class="alert alert-success">
        {{ session('SuccessBidding') }}
      </div>
      @endif
      @if(session('SecondaryBidding'))
      <div class="alert alert-secondary">
        {{ session('SecondaryBidding') }}
      </div>
      @endif
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h6>Registro de licitaciones públicas</h6>
    </div>
    <form action="{{ route('clients.bidding.save') }}" method="POST">
      <div class="card-body p-3 border">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <small class="text-muted">NUMERO DE PROCESO:</small>
                  <input type="text" name="cbiNumberprocess" title="Campo numérico (0-9) de 50 carácteres máximo" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">FECHA DE APERTURA:</small>
                  <input type="text" name="cbiDateopen" title="Campo de fecha (aaaa-mm-aa)" class="form-control form-control-sm datepicker" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">FECHA DE CIERRE:</small>
                  <input type="text" name="cbiDateclose" title="Campo de fecha (aaaa-mm-aa)" class="form-control form-control-sm datepicker" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <small class="text-muted">ENTIDAD:</small>
                  <input type="text" name="cbiEntity" maxlength="50" title="Campo de alfanumérico (0-9,aA-zZ)" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">CIUDAD:</small>
                  <select name="cbiMunicipility_id" class="form-control form-control-sm" required>
                    <option value="">Seleccione ...</option>
                    @foreach($municipalities as $municipality)
                    <option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">MODALIDAD DE CONTRATACION:</small>
                  <select name="cbiModalitycontract" class="form-control form-control-sm" required>
                    <option value="">Seleccione ...</option>
                    <option value="LICITACION PUBLICA">LICITACION PUBLICA</option>
                    <option value="SUBASTA INVERSA">SUBASTA INVERSA</option>
                    <option value="MENOR CUANTIA">MENOR CUANTIA</option>
                    <option value="MINIMA CUANTIA">MINIMA CUANTIA</option>
                    <option value="INVITACION PRIVADA">INVITACION PRIVADA</option>
                    <option value="ESTUDIO DE MERCADO">ESTUDIO DE MERCADO</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <small class="text-muted">CORREO ELECTRONICO:</small>
                  <input type="email" name="cbiEmail" maxlength="50" title="Campo de alfanumérico (0-9,aA-zZ) con @ obligatorio" class="form-control form-control-sm" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <small class="text-muted">OBJETO DEL CONTRACTO:</small>
                  <textarea type="text" name="cbiObjectcontract" maxlength="500" title="Campo de alfanumérico (0-9,aA-zZ)" rows="2" class="form-control form-control-sm" required></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <small class="text-muted">OBSERVACIONES:</small>
                  <textarea type="text" name="cbiObservation" maxlength="500" title="Campo de alfanumérico (0-9,aA-zZ)" rows="2" class="form-control form-control-sm" required></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="form-group text-center">
          <button type="submit" class="btn btn-outline-success form-control-sm btn-saveDefinitive">GUARDAR</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {

  });
</script>
@endsection