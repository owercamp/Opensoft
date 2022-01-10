@extends('modules.operativeTracking')

@section('space')
<div class="col-md-12">
  <h5>INICIO DEL SERVICIO</h5>
  @include('partials.alerts')
  <div class="container-fluid">
    <table id="tableServices" class="table table-hover text-center" width="100%">
      <thead>
        <tr>
          <th>FECHA SERVICIO</th>
          <th>TIPO DE SOLICITUD</th>
          <th>COLABORADOR</th>
          <th>CLIENTE</th>
          <th>ORIGEN</th>
          <th>DESTINO</th>
          <th>ACCIONES</th>
        </tr>
      </thead>
      <tbody>
        <!-- Función para retornar el consecutivo con ceros a la izquierda de acuerdo a cada iteracion -->
        @php
        function getStringSequence ($number){
        $len = strlen($number);
        switch ($len) {
        case 1: return '00000' . $number; break;
        case 2: return '0000' . $number; break;
        case 3: return '000' . $number; break;
        case 4: return '00' . $number; break;
        case 5: return '0' . $number; break;
        default: return (string)$number; break;
        }
        }
        @endphp
        @for($i = 0; $i < count($dates); $i++) <tr>
          <td>{{ $dates[$i][0] }} {{ $dates[$i][1] }}</td>
          <td>{{ $dates[$i][3] }} - {{ $dates[$i][4] }}</td>
          <td>{{ $dates[$i][13] }}</td>
          <td>{{ $dates[$i][2] }}</td>
          <td>{{ $dates[$i][5] }}</td>
          <td>{{ $dates[$i][9] }}</td>
          <td class="align-middle d-flex justify-content-around">
            <form action="{{ route('tracking.initials') }}" method="post">
              @csrf
              <button class="btn btn-outline-primary rounded-circle" title="Inicio de Servicio">
                <i class="fas fa-stopwatch"></i>
                <input type="hidden" name="id" value="{{ $dates[$i][12] }}">
                <input type="hidden" name="type" value="{{ $dates[$i][3] }}">
                <input type="hidden" name="col" value="{{ $dates[$i][13] }}">
              </button>
            </form>
            <button class="btn btn-outline-success rounded-circle edit-register" title="Cambio de Operador">
              <i class="fas fa-exchange-alt"></i>
              <span hidden>{{ $dates[$i][12] }}</span><!-- identificador -->
              <span hidden>{{ $dates[$i][3] }}</span><!-- tipo de servicio -->
              <span hidden>{{ $dates[$i][13] }}</span><!-- Colaborador -->
            </button>
            <button class="btn btn-outline-secondary rounded-circle cancel-register" title="Cancelación Servicio">
              <i class="fas fa-ban"></i>
              <span hidden>{{ $dates[$i][12] }}</span><!-- identificador -->
              <span hidden>{{ $dates[$i][3] }}</span><!-- tipo de servicio -->
              <span hidden>{{ $dates[$i][13] }}</span><!-- Colaborador -->
            </button>
            <form action="{{ route('tracking.binnacle') }}" method="post">
              @csrf
              <button class="btn btn-outline-dark rounded-circle" title="Novedades Servicio">
                <i class="fas fa-info-circle"></i>
                <input type="hidden" name="id" value="{{ $dates[$i][12] }}">
                <input type="hidden" name="type" value="{{ $dates[$i][3] }}">
                <input type="hidden" name="col" value="{{ $dates[$i][13] }}">
              </button>
            </form>
          </td>
          </tr>
          @endfor
      </tbody>
    </table>
  </div>
</div>

<!-- Cancelacion Servicio -->
<div class="modal fade" id="CancelServices" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title Title"></h5>
        <button type="button" class="btn btn-sm btn-outline-info" data-dismiss="modal" aria-label="Close">&Dfr;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tracking.cancel') }}" method="post">
          @csrf @method('PATCH')
          <div class="col-lg-12 row d-flex justify-content-center ml-1">
            <small class="text-muted">{{ ucwords('observaciones de cancelación') }}</small>
            <textarea name="bs_observations" cols="30" rows="10" class="form-control form-control-sm"></textarea>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="bs_type">
            <input type="hidden" name="bs_oldCollaborator">
            <input type="hidden" name="bs_request">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-tertiary">Cancelar Servicio</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Cambio de Colaborador -->
<div class="modal fade" id="Edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title"></h5>
        <button type="button" class="btn btn-sm rounded btn-outline-dark" data-dismiss="modal" aria-label="Close">&Chi;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tracking.update') }}" method="post">
          @csrf @method('PATCH')
          <div class="col-lg-12 d-flex justify-content-center">
            <div class="form-group w-50">
              <small class="text-muted">{{ ucwords('colaborador') }}</small>
              <select name="bs_collaborator" class="form-control form-control-sm select2" style="width: 100%;" required>
                <option value="">{{ ucwords('seleccione...') }}</option>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              <small class="text-muted">{{ ucwords('Observaciones') }}</small>
              <textarea name="bs_observations" cols="30" rows="10" class="form-control form-control-sm"></textarea>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-around">
            <input type="hidden" name="bs_type">
            <input type="hidden" name="bs_oldCollaborator">
            <input type="hidden" name="bs_request">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn btn-primary">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  // *cancelación de servicio
  $('.cancel-register').click(function() {
    $('.Title').text($(this).find('span:nth-child(3)').text());
    $('input[name=bs_request]').val($(this).find('span:nth-child(2)').text());
    $('input[name=bs_type]').val($(this).find('span:nth-child(3)').text());
    $('input[name=bs_oldCollaborator]').val($(this).find('span:nth-child(4)').text()+" - CANCELADO");
    $('#CancelServices').modal();
  });

  // *edición de colaborador
  $('.edit-register').click(function() {
    $('.title').text($(this).find('span:nth-child(3)').text() + " Cambio Colaborador").addClass('text-uppercase');
    $('input[name=bs_oldCollaborator]').val($(this).find('span:nth-child(4)').text());
    $('input[name=bs_request]').val($(this).find('span:nth-child(2)').text());
    $('input[name=bs_type]').val($(this).find('span:nth-child(3)').text());
    $('select[name=bs_collaborator]').empty();
    $('select[name=bs_collaborator]').append("<option value=''>Seleccione...</option>");
    if ($(this).find('span:nth-child(3)').text() == "Mensajería Express") {
      let col = $(this).find('span:nth-child(4)').text();
      // *consulta contractormessegers
      $.get("{{ route('apiContractorMessenger') }}", function(objectMessenger) {
        let count = Object.keys(objectMessenger).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            if (objectMessenger[i]['cmNames'] == col) {
              $('select[name=bs_collaborator]').append("<option value='" + objectMessenger[i]['cmId'] + "' selected>" + objectMessenger[i]['cmNames'] + "</option>");
            } else {
              $('select[name=bs_collaborator]').append("<option value='" + objectMessenger[i]['cmId'] + "'>" + objectMessenger[i]['cmNames'] + "</option>");
            }
          }
        }
      });
    } else if ($(this).find('span:nth-child(3)').text() == "Logística Express" || $(this).find('span:nth-child(3)').text() == "Carga Express") {
      let col = $(this).find('span:nth-child(4)').text();
      // *consulta contracttorschargeexpress
      $.get("{{ route('apiContractorCharge') }}", function(objectCharge) {
        let count = Object.keys(objectCharge).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            if (objectCharge[i]['ccNames'] == col) {
              $('select[name=bs_collaborator]').append("<option value='" + objectCharge[i]['ccId'] + "' selected>" + objectCharge[i]['ccNames'] + "</option>");
            } else {
              $('select[name=bs_collaborator]').append("<option value='" + objectCharge[i]['ccId'] + "'>" + objectCharge[i]['ccNames'] + "</option>");
            }
          }
        }
      });
    } else if ($(this).find('span:nth-child(3)').text() == "Turismo Pasajeros" || $(this).find('span:nth-child(3)').text() == "Traslado Urbano" || $(this).find('span:nth-child(3)').text() == "Traslado Intermunicipal") {
      let col = $(this).find('span:nth-child(4)').text();
      // *consulta contractorserviceespecial
      $.get("{{ route('apiContractorSpecial') }}", function(objectSpecial) {
        let count = Object.keys(objectSpecial).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            if (objectSpecial[i]['ceNames'] == col) {
              $('select[name=bs_collaborator]').append("<option value='" + objectSpecial[i]['ceId'] + "' selected>" + objectSpecial[i]['ceNames'] + "</option>");
            } else {
              $('select[name=bs_collaborator]').append("<option value='" + objectSpecial[i]['ceId'] + "'>" + objectSpecial[i]['ceNames'] + "</option>");
            }
          }
        }
      });
    }
    $('#Edit').modal();
  })
</script>
@endsection