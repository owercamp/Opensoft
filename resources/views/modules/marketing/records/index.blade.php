@extends('modules.comercialMarketing')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>ARCHIVO DE NEGOCIOS</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Consultar seguimientos realizados" class="btn btn-outline-success form-control-sm historyOpportunity-link">HISTORIALES</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessOpportunity'))
      <div class="alert alert-success">
        {{ session('SuccessOpportunity') }}
      </div>
      @endif
      @if(session('PrimaryOpportunity'))
      <div class="alert alert-primary">
        {{ session('PrimaryOpportunity') }}
      </div>
      @endif
      @if(session('WarningOpportunity'))
      <div class="alert alert-warning">
        {{ session('WarningOpportunity') }}
      </div>
      @endif
      @if(session('SecondaryOpportunity'))
      <div class="alert alert-secondary">
        {{ session('SecondaryOpportunity') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>RAZON SOCIAL</th>
        <th>CIUDAD</th>
        <th>CONTACTO</th>
        <th>ESTADO</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($marketings as $marketing)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $marketing->marDate }}</td>
        <td>{{ $marketing->marReason }}</td>
        <td>{{ $marketing->munName }}</td>
        <td>{{ $marketing->marContact }}</td>
        <td>
          @if($marketing->marStatus == 'ACEPTADO')
          <h5><span class="badge badge-success">ACEPTADO</span></h5>
          @else
          <h5><span class="badge badge-warning">DENEGADO</span></h5>
          @endif
          <!-- <a href="#" title="Editar" class="btn btn-outline-primary form-control-sm editExpress-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $marketing->marId }}</span>
							<span hidden>{{ $marketing->marDate }}</span>
							<span hidden>{{ $marketing->marReason }}</span>
							<span hidden>{{ $marketing->marMunicipility_id }}</span>
							<span hidden>{{ $marketing->marAddress }}</span>
							<span hidden>{{ $marketing->marContact }}</span>
							<span hidden>{{ $marketing->marPhone }}</span>
							<span hidden>{{ $marketing->marEmail }}</span>
							<span hidden>{{ $marketing->marObservation }}</span>
						</a> -->
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="historyOpportunity-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>HISTORIAL DE SEGUIMIENTOS:</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row p-4 border">
          <div class="col-md-6">
            <div class="form-group">
              <select name="marId_query" title="RAZON SOCIAL: (Oportunidades de negocio)" class="form-control form-control-sm" required>
                <option value="">Seleccione ...</option>
                @foreach($marketings as $marketing)
                <option value="{{ $marketing->marId }}" data-date="{{ $marketing->marDate }}" data-reason="{{ $marketing->marReason }}" data-municipality="{{ $marketing->munName }}" data-address="{{ $marketing->marAddress }}" data-contact="{{ $marketing->marContact }}" data-phone="{{ $marketing->marPhone }}" data-email="{{ $marketing->marEmail }}" data-observation="{{ $marketing->marObservation }}">{{ $marketing->marReason . ' - ' . $marketing->munName }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <button type="button" class="btn btn-outline-success form-control-sm btn-history">CONSULTAR</button>
          </div>
        </div>
        <div class="row p-4 text-center bj-spinner">
          <div class="col-md-12">
            <div class="spinner-border" align="center" role="status">
              <span class="sr-only" align="center">Procesando...</span>
            </div>
          </div>
        </div>
        <div class="row section-history" style="display: none;">
          <div class="col-md-4 pt-4">
            <small class="text-muted">FECHA: </small><br>
            <span class="text-muted"><b class="marDate_history"></b></span><br>
            <small class="text-muted">RAZON SOCIAL: </small><br>
            <span class="text-muted"><b class="marReason_history"></b></span><br>
            <small class="text-muted">CIUDAD: </small><br>
            <span class="text-muted"><b class="munName_history"></b></span><br>
            <small class="text-muted">DIRECCION: </small><br>
            <span class="text-muted"><b class="marAddress_history"></b></span><br>
            <small class="text-muted">CONTACTO: </small><br>
            <span class="text-muted"><b class="marContact_history"></b></span><br>
            <small class="text-muted">TELEFONO: </small><br>
            <span class="text-muted"><b class="marPhone_history"></b></span><br>
            <small class="text-muted">CORREO ELECTRONICO: </small><br>
            <span class="text-muted"><b class="marEmail_history"></b></span><br>
            <small class="text-muted">OBSERVACION: </small><br>
            <span class="text-muted"><b class="marObservation_history"></b></span><br>
          </div>
          <div class="col-md-8 text-center">
            <small class="text-center" style="font-weight: bold;">SEGUIMIENTOS</small>
            <table class="table table-striped text-center tbl-history" style="font-size: 12px;">
              <thead>
                <tr>
                  <th>FECHA</th>
                  <th>OBSERVACION</th>
                </tr>
              </thead>
              <tbody>
                <!-- dinamics row -->
              </tbody>
            </table>
          </div>
        </div>
        <!-- <div class="row">
						<div class="col-md-12 text-center">
							<button type="button" class="btn btn-outline-tertiary mx-3 form-control-sm my-3" data-dismiss="modal">CERRAR</button>
						</div>
					</div> -->
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {
    $('.bj-spinner').css('display', 'none');
  });

  $('.historyOpportunity-link').on('click', function(e) {
    e.preventDefault();
    $('#historyOpportunity-modal').modal();
  });

  $('.btn-history').on('click', function(e) {
    e.preventDefault();
    var marId = $('select[name=marId_query]').val();
    $('.tbl-history tbody').empty();
    $('.marDate_history').text('');
    $('.marReason_history').text('');
    $('.munName_history').text('');
    $('.marAddress_history').text('');
    $('.marContact_history').text('');
    $('.marPhone_history').text('');
    $('.marEmail_history').text('');
    $('.marObservation_history').text('');
    $('.section-history').css('display', 'none');
    if (marId != '') {
      $('.bj-spinner').css('display', 'block');
      var date = $('select[name=marId_query] option:selected').attr('data-date');
      var reason = $('select[name=marId_query] option:selected').attr('data-reason');
      var municipality = $('select[name=marId_query] option:selected').attr('data-municipality');
      var address = $('select[name=marId_query] option:selected').attr('data-address');
      var contact = $('select[name=marId_query] option:selected').attr('data-contact');
      var phone = $('select[name=marId_query] option:selected').attr('data-phone');
      var email = $('select[name=marId_query] option:selected').attr('data-email');
      var observation = $('select[name=marId_query] option:selected').attr('data-observation');
      $('.marDate_history').text(date);
      $('.marReason_history').text(reason);
      $('.munName_history').text(municipality);
      $('.marAddress_history').text(address);
      $('.marContact_history').text(contact);
      $('.marPhone_history').text(phone);
      $('.marEmail_history').text(email);
      $('.marObservation_history').text(observation);
      $.get("{{ route('getBinnacles') }}", {
        marId: marId
      }, function(objectBinnacles) {
        var count = Object.keys(objectBinnacles).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('.tbl-history tbody').append(
              "<tr>" +
              "<td>" + objectBinnacles[i]['bmDate'] + "</td>" +
              "<td>" + objectBinnacles[i]['bmObservation'] + "</td>" +
              "</tr>"
            );
          }
        }
      });
      $('input[name=marId_repeat]').val(marId);
      setTimeout(function() {
        $('.bj-spinner').css('display', 'none');
        $('.section-history').css('display', 'flex');
      }, 2000);
    }
  });
</script>
@endsection