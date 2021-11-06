@extends('modules.comercialPotentialclient')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>ARCHIVO COMERCIAL</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Consultar seguimientos realizados" class="btn btn-outline-success form-control-sm historyClient-link">HISTORIALES</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessBidding'))
      <div class="alert alert-success">
        {{ session('SuccessBidding') }}
      </div>
      @endif
      @if(session('PrimaryBidding'))
      <div class="alert alert-primary">
        {{ session('PrimaryBidding') }}
      </div>
      @endif
      @if(session('WarningBidding'))
      <div class="alert alert-warning">
        {{ session('WarningBidding') }}
      </div>
      @endif
      @if(session('SecondaryBidding'))
      <div class="alert alert-secondary">
        {{ session('SecondaryBidding') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>TIPO DE COTIZACION</th>
        <th>N° COTIZACION</th>
        <th>CLIENTE/ENTIDAD</th>
        <th>CIUDAD</th>
        <th>MODALIDAD</th>
        <th>ESTADO</th>
      </tr>
    </thead>
    <tbody>
      @for($i=0; $i < count($dates); $i++) <tr>
        @if($dates[$i][0] == 'Licitación')
        <td>
          <h4><span class="badge badge-dark">{{ $dates[$i][0] }}</span></h4>
        </td>
        <td>{{ $dates[$i][1] }}</td>
        <td>{{ $dates[$i][6] }}</td>
        <td>{{ $dates[$i][7] }}</td>
        <td>{{ $dates[$i][8] }}</td>
        <td>
          @if($dates[$i][12] == 'ACEPTADO')
          <h5><span class="badge badge-success">{{ __('APROBADA') }}</span></h5>
          @else
          <h5><span class="badge badge-warning">{{ __('RECHAZADA') }}</span></h5>
          @endif
        </td>
        @else
        <td>
          <h4><span class="badge badge-dark">{{ $dates[$i][0] }}</span></h4>
        </td>
        <td>{{ $dates[$i][1] }}</td>
        <td>{{ $dates[$i][4] }}</td>
        <td>{{ $dates[$i][7] }}</td>
        <td>{{ $dates[$i][8] }}</td>
        <td>
          @if($dates[$i][14] == 'ACEPTADO')
          <h5><span class="badge badge-success">{{ __('APROBADA') }}</span></h5>
          @else
          <h5><span class="badge badge-warning">{{ __('RECHAZADA') }}</span></h5>
          @endif
        </td>
        @endif
        </tr>
        @endfor
    </tbody>
  </table>
</div>

<div class="modal fade" id="historyClient-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>HISTORIAL DE SEGUIMIENTOS:</h6><br>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row py-3">
        <div class="col-md-6 text-center" title="Agregar seguimiento">
          <small class="text-muted" for="bidding_option">
            <input type="radio" name="optionhistory" id="bidding_option" value="bidding" checked>
            Licitaciones públicas
          </small>
        </div>
        <div class="col-md-6 text-center" title="Cambiar estado">
          <small class="text-muted" for="proposal_option">
            <input type="radio" name="optionhistory" id="proposal_option" value="proposal">
            Propuestas comerciales
          </small>
        </div>
      </div>
      <div class="modal-body sectionModal-bidding">
        <div class="row border-bottom mb-2">
          <div class="col-md-6">
            <div class="form-group">
              <select name="cbiId_query" title="ENTIDAD (Licitaciones públicas)" class="form-control form-control-sm" required>
                <option value="">Seleccione ...</option>
                @foreach($biddingshistory as $bidding)
                <option value="{{ $bidding->cbiId }}" data-number="{{ $bidding->cbiNumberprocess }}" data-dateopen="{{ $bidding->cbiDateopen }}" data-dateclose="{{ $bidding->cbiDateclose }}" data-entity="{{ $bidding->cbiEntity }}" data-municipality="{{ $bidding->munName }}" data-modality="{{ $bidding->cbiModalitycontract }}" data-object="{{ $bidding->cbiObjectcontract }}" data-email="{{ $bidding->cbiEmail }}" data-observation="{{ $bidding->cbiObservation }}">{{ $bidding->cbiEntity . ' - ' . $bidding->cbiNumberprocess }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <button type="button" class="btn btn-outline-success form-control-sm btn-history-bidding">CONSULTAR</button>
          </div>
        </div>
        <div class="row p-4 text-center bj-spinner bj-spinner-bidding">
          <div class="col-md-12">
            <div class="spinner-border" align="center" role="status">
              <span class="sr-only" align="center">Procesando...</span>
            </div>
          </div>
        </div>
        <div class="row sectionModal-bidding-details" style="display: none;">
          <div class="col-md-4">
            <small class="text-muted">NUMERO DE PROCESO: </small><br>
            <span class="text-muted"><b class="cbiNumberprocess_history"></b></span><br>
            <small class="text-muted">FECHA DE APERTURA: </small><br>
            <span class="text-muted"><b class="cbiDateopen_history"></b></span><br>
            <small class="text-muted">FECHA DE CIERRE: </small><br>
            <span class="text-muted"><b class="cbiDateclose_history"></b></span><br>
            <small class="text-muted">ENTIDAD: </small><br>
            <span class="text-muted"><b class="cbiEntity_history"></b></span><br>
            <small class="text-muted">CIUDAD: </small><br>
            <span class="text-muted"><b class="munName_history"></b></span><br>
            <small class="text-muted">MODALIDAD DE CONTRATACION: </small><br>
            <span class="text-muted"><b class="cbiModalitycontract_history"></b></span><br>
            <small class="text-muted">CORREO: </small><br>
            <span class="text-muted"><b class="cbiEmail_history"></b></span><br>
            <small class="text-muted">OBJETO DEL CONTRATO: </small><br>
            <span class="text-muted"><b class="cbiObjectcontract_history"></b></span><br>
            <small class="text-muted">OBSERVACION: </small><br>
            <span class="text-muted"><b class="cbiObservation_history"></b></span><br>
          </div>
          <div class="col-md-8 text-center">
            <h5 class="text-center" style="font-weight: bold;">SEGUIMIENTOS DE LICITACIONES</h5>
            <table class="table table-striped text-center tbl-history-bidding" style="font-size: 12px;">
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
      </div>
      <div class="modal-body sectionModal-proposal" style="display: none;">
        <div class="row">
          <div class="col-md-6 border-bottom mb-2">
            <div class="form-group">
              <select name="cprId_query" title="CLIENTE (Propuestas comerciales)" class="form-control form-control-sm" required>
                <option value="">Seleccione ...</option>
                @foreach($proposalshistory as $proposal)
                <option value="{{ $proposal->cprId }}" data-date="{{ $proposal->cprDate }}" data-client="{{ $proposal->cprClient }}" data-document="{{ $proposal->perName . '  N° ' . $proposal->cprNumberdocument }}" data-municipality="{{ $proposal->munName }}" data-modality="{{ $proposal->cprModalitycontract }}" data-email="{{ $proposal->cprEmail }}" data-phone="{{ $proposal->cprPhone }}" data-contact="{{ $proposal->cprContact }}" data-observation="{{ $proposal->cprObservation }}" data-briefcase="{{ $proposal->cprBriefcase }}">{{ $proposal->cprClient . ' - N° ' . $proposal->cprNumberdocument }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <button type="button" class="btn btn-outline-success form-control-sm btn-history-proposal">CONSULTAR</button>
          </div>
        </div>
        <div class="row p-4 text-center bj-spinner bj-spinner-proposal">
          <div class="col-md-12">
            <div class="spinner-border" align="center" role="status">
              <span class="sr-only" align="center">Procesando...</span>
            </div>
          </div>
        </div>
        <div class="row sectionModal-proposal-details" style="display: none;">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-4">
                <small class="text-muted">FECHA: </small><br>
                <span class="text-muted"><b class="cprDate_history"></b></span><br>
                <small class="text-muted">CLIENTE: </small><br>
                <span class="text-muted"><b class="cprClient_history"></b></span><br>
                <small class="text-muted">DOCUMENTO: </small><br>
                <span class="text-muted"><b class="cprNumberdocument_history"></b></span><br>
                <small class="text-muted">CIUDAD: </small><br>
                <span class="text-muted"><b class="cprMunicipility_history"></b></span><br>
                <small class="text-muted">MODALIDAD DE CONTRATACION: </small><br>
                <span class="text-muted"><b class="cprModalitycontract_history"></b></span><br>
                <small class="text-muted">CONTACTO: </small><br>
                <span class="text-muted"><b class="cprContact_history"></b></span><br>
                <small class="text-muted">CORREO: </small><br>
                <span class="text-muted"><b class="cprEmail_history"></b></span><br>
                <small class="text-muted">TELEFONO: </small><br>
                <span class="text-muted"><b class="cprPhone_history"></b></span><br>
                <small class="text-muted">OBSERVACION: </small><br>
                <span class="text-muted"><b class="cprObservation_history"></b></span><br>
              </div>
              <div class="col-md-8 text-center">
                <h5 class="text-center" style="font-weight: bold;">SEGUIMIENTOS DE PROPUESTAS</h5>
                <table class="table table-striped text-center tbl-history-proposal" style="font-size: 12px;">
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
            <div class="row p-3">
              <div class="col-md-12 p-3">
                <h5 class="text-center" style="font-weight: bold;">PORTAFOLIOS INCLUIDOS</h5>
                <table class="table table-striped text-center tbl-briefcase-history-proposal" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th>PORTAFOLIO</th>
                      <th>TIPO DE SERVICIO</th>
                      <th>TIPO DE VEHICULO</th>
                      <th>TARIFA BASE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- dinamics row -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {
    $('.bj-spinner-bidding').css('display', 'none');
    $('.bj-spinner-proposal').css('display', 'none');
  });

  $('.historyClient-link').on('click', function(e) {
    e.preventDefault();
    $('#historyClient-modal').modal();
  });

  $('input[name=optionhistory]').on('click', function(e) {
    var value = e.target.value;
    if (value == 'bidding') {
      $('.sectionModal-bidding').css('display', 'block');
      $('.sectionModal-proposal').css('display', 'none');
    } else if (value == 'proposal') {
      $('.sectionModal-bidding').css('display', 'none');
      $('.sectionModal-proposal').css('display', 'block');
    }
  });

  $('.btn-history-bidding').on('click', function(e) {
    e.preventDefault();
    var cbiId = $('select[name=cbiId_query]').val();
    $('.tbl-history-bidding tbody').empty();
    $('.cbiNumberprocess_history').text('');
    $('.cbiDateopen_history').text('');
    $('.cbiDateclose_history').text('');
    $('.cbiEntity_history').text('');
    $('.munName_history').text('');
    $('.cbiModalitycontract_history').text('');
    $('.cbiEmail_history').text('');
    $('.cbiObjectcontract_history').text('');
    $('.cbiObservation_history').text('');
    $('.sectionModal-bidding-details').css('display', 'none');
    if (cbiId != '') {
      $('.bj-spinner-bidding').css('display', 'block');
      var number = $('select[name=cbiId_query] option:selected').attr('data-number');
      var dateopen = $('select[name=cbiId_query] option:selected').attr('data-dateopen');
      var dateclose = $('select[name=cbiId_query] option:selected').attr('data-dateclose');
      var entity = $('select[name=cbiId_query] option:selected').attr('data-entity');
      var municipality = $('select[name=cbiId_query] option:selected').attr('data-municipality');
      var modality = $('select[name=cbiId_query] option:selected').attr('data-modality');
      var object = $('select[name=cbiId_query] option:selected').attr('data-object');
      var email = $('select[name=cbiId_query] option:selected').attr('data-email');
      var observation = $('select[name=cbiId_query] option:selected').attr('data-observation');
      $('.cbiNumberprocess_history').text(number);
      $('.cbiDateopen_history').text(dateopen);
      $('.cbiDateclose_history').text(dateclose);
      $('.cbiEntity_history').text(entity);
      $('.munName_history').text(municipality);
      $('.cbiModalitycontract_history').text(modality);
      $('.cbiEmail_history').text(object);
      $('.cbiObjectcontract_history').text(email);
      $('.cbiObservation_history').text(observation);
      $.get("{{ route('getBinnaclebiddings') }}", {
        cbiId: cbiId
      }, function(objectBinnacles) {
        var count = Object.keys(objectBinnacles).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('.tbl-history-bidding tbody').append(
              "<tr>" +
              "<td>" + objectBinnacles[i]['bbDate'] + "</td>" +
              "<td>" + objectBinnacles[i]['bbObservation'] + "</td>" +
              "</tr>"
            );
          }
        }
      });
      setTimeout(function() {
        $('.bj-spinner-bidding').css('display', 'none');
        $('.sectionModal-bidding-details').css('display', 'flex');
      }, 2000);
    }
  });

  $('.btn-history-proposal').on('click', function(e) {
    e.preventDefault();
    var cprId = $('select[name=cprId_query]').val();
    $('.tbl-history-proposal tbody').empty();
    $('.cprDate_history').text('');
    $('.cprClient_history').text('');
    $('.cprNumberdocument_history').text('');
    $('.cprMunicipility_history').text('');
    $('.cprModalitycontract_history').text('');
    $('.cprContact_history').text('');
    $('.cprEmail_history').text('');
    $('.cprPhone_history').text('');
    $('.cprObservation_history').text('');
    $('.sectionModal-proposal-details').css('display', 'none');
    if (cprId != '') {
      $('.bj-spinner-proposal').css('display', 'block');
      var date = $('select[name=cprId_query] option:selected').attr('data-date');
      var client = $('select[name=cprId_query] option:selected').attr('data-client');
      var numberdocument = $('select[name=cprId_query] option:selected').attr('data-document');
      var municipality = $('select[name=cprId_query] option:selected').attr('data-municipality');
      var modality = $('select[name=cprId_query] option:selected').attr('data-modality');
      var email = $('select[name=cprId_query] option:selected').attr('data-email');
      var phone = $('select[name=cprId_query] option:selected').attr('data-phone');
      var contact = $('select[name=cprId_query] option:selected').attr('data-contact');
      var observation = $('select[name=cprId_query] option:selected').attr('data-observation');
      var briefcase = $('select[name=cprId_query] option:selected').attr('data-briefcase');
      $('.cprDate_history').text(date);
      $('.cprClient_history').text(client);
      $('.cprNumberdocument_history').text(numberdocument);
      $('.cprMunicipility_history').text(municipality);
      $('.cprModalitycontract_history').text(modality);
      $('.cprContact_history').text(contact);
      $('.cprEmail_history').text(email);
      $('.cprPhone_history').text(phone);
      $('.cprObservation_history').text(observation);
      $.get("{{ route('getBinnacleproposals') }}", {
        cprId: cprId
      }, function(objectBinnacles) {
        var count = Object.keys(objectBinnacles).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('.tbl-history-proposal tbody').append(
              "<tr>" +
              "<td>" + objectBinnacles[i]['bpDate'] + "</td>" +
              "<td>" + objectBinnacles[i]['bpObservation'] + "</td>" +
              "</tr>"
            );
          }
        }
      });
      $('.tbl-briefcase-history-proposal tbody').empty();
      var find = briefcase.indexOf('<=|=>');
      if (find > -1) {
        var separated = briefcase.split('<=|=>');
        for (var i = 0; i < separated.length; i++) {
          var separatedItems = separated[i].split('=>');
          switch (separatedItems[0]) {
            case 'Mensajería Express':
              $.get(
                "{{ route('getServiceproposal') }}", {
                  type: separatedItems[0],
                  briefcase: separatedItems[1],
                  service: separatedItems[2]
                },
                function(objectService) {
                  if (objectService != null) {
                    $('.tbl-briefcase-history-proposal tbody').append(
                      "<tr>" +
                      "<td>Mensajería Express</td>" +
                      "<td>" + objectService['smService'] + "</td>" +
                      "<td>N/A</td>" +
                      "<td>" + objectService['bmeValueratebase'] + "</td>" +
                      "</tr>"
                    );
                  }
                }
              );
              break;
            case 'Logística Express':
              $.get(
                "{{ route('getServiceproposal') }}", {
                  type: separatedItems[0],
                  briefcase: separatedItems[1],
                  service: separatedItems[2]
                },
                function(objectService) {
                  if (objectService != null) {
                    $('.tbl-briefcase-history-proposal tbody').append(
                      "<tr>" +
                      "<td>Logística Express</td>" +
                      "<td>" + objectService['slService'] + "</td>" +
                      "<td>N/A</td>" +
                      "<td>" + objectService['bleValueratebase'] + "</td>" +
                      "</tr>"
                    );
                  }
                }
              );
              break;
            case 'Carga Express':
              $.get(
                "{{ route('getServiceproposal') }}", {
                  type: separatedItems[0],
                  briefcase: separatedItems[1],
                  service: separatedItems[2]
                },
                function(objectService) {
                  if (objectService != null) {
                    $('.tbl-briefcase-history-proposal tbody').append(
                      "<tr>" +
                      "<td>Carga Express</td>" +
                      "<td>" + objectService['scService'] + "</td>" +
                      "<td>" + objectService['heaTypology'] + "</td>" +
                      "<td>" + objectService['bceValueratebase'] + "</td>" +
                      "</tr>"
                    );
                  }
                }
              );
              break;
            case 'Turismo Pasajeros':
              $.get(
                "{{ route('getServiceproposal') }}", {
                  type: separatedItems[0],
                  briefcase: separatedItems[1],
                  service: separatedItems[2]
                },
                function(objectService) {
                  if (objectService != null) {
                    $('.tbl-briefcase-history-proposal tbody').append(
                      "<tr>" +
                      "<td>Turismo Pasajeros</td>" +
                      "<td>" + objectService['stService'] + "</td>" +
                      "<td>" + objectService['espTypology'] + "</td>" +
                      "<td>" + objectService['bteValueratebase'] + "</td>" +
                      "</tr>"
                    );
                  }
                }
              );
              break;
            case 'Traslado Urbano':
              $.get(
                "{{ route('getServiceproposal') }}", {
                  type: separatedItems[0],
                  briefcase: separatedItems[1],
                  service: separatedItems[2]
                },
                function(objectService) {
                  if (objectService != null) {
                    $('.tbl-briefcase-history-proposal tbody').append(
                      "<tr>" +
                      "<td>Traslado Urbano</td>" +
                      "<td>" + objectService['strService'] + "</td>" +
                      "<td>" + objectService['espTypology'] + "</td>" +
                      "<td>" + objectService['btreValueratebase'] + "</td>" +
                      "</tr>"
                    );
                  }
                }
              );
              break;
            case 'Traslado Intermunicipal':
              $.get(
                "{{ route('getServiceproposal') }}", {
                  type: separatedItems[0],
                  briefcase: separatedItems[1],
                  service: separatedItems[2]
                },
                function(objectService) {
                  if (objectService != null) {
                    $('.tbl-briefcase-history-proposal tbody').append(
                      "<tr>" +
                      "<td>Traslado Intermunicipal</td>" +
                      "<td>" + objectService['stmService'] + "</td>" +
                      "<td>" + objectService['espTypology'] + "</td>" +
                      "<td>" + objectService['btriValuebase'] + "</td>" +
                      "</tr>"
                    );
                  }
                }
              );
              break;
          }
        }
      } else {
        var separatedItems = briefcase.split('=>');
        switch (separatedItems[0]) {
          case 'Mensajería Express':
            $.get(
              "{{ route('getServiceproposal') }}", {
                type: separatedItems[0],
                briefcase: separatedItems[1],
                service: separatedItems[2]
              },
              function(objectService) {
                if (objectService != null) {
                  $('.tbl-briefcase-history-proposal tbody').append(
                    "<tr>" +
                    "<td>Mensajería Express</td>" +
                    "<td>" + objectService['smService'] + "</td>" +
                    "<td>N/A</td>" +
                    "<td>" + objectService['bmeValueratebase'] + "</td>" +
                    "</tr>"
                  );
                }
              }
            );
            break;
          case 'Logística Express':
            $.get(
              "{{ route('getServiceproposal') }}", {
                type: separatedItems[0],
                briefcase: separatedItems[1],
                service: separatedItems[2]
              },
              function(objectService) {
                if (objectService != null) {
                  $('.tbl-briefcase-history-proposal tbody').append(
                    "<tr>" +
                    "<td>Logística Express</td>" +
                    "<td>" + objectService['slService'] + "</td>" +
                    "<td>N/A</td>" +
                    "<td>" + objectService['bleValueratebase'] + "</td>" +
                    "</tr>"
                  );
                }
              }
            );
            break;
          case 'Carga Express':
            $.get(
              "{{ route('getServiceproposal') }}", {
                type: separatedItems[0],
                briefcase: separatedItems[1],
                service: separatedItems[2]
              },
              function(objectService) {
                if (objectService != null) {
                  $('.tbl-briefcase-history-proposal tbody').append(
                    "<tr>" +
                    "<td>Carga Express</td>" +
                    "<td>" + objectService['scService'] + "</td>" +
                    "<td>" + objectService['heaTypology'] + "</td>" +
                    "<td>" + objectService['bceValueratebase'] + "</td>" +
                    "</tr>"
                  );
                }
              }
            );
            break;
          case 'Turismo Pasajeros':
            $.get(
              "{{ route('getServiceproposal') }}", {
                type: separatedItems[0],
                briefcase: separatedItems[1],
                service: separatedItems[2]
              },
              function(objectService) {
                if (objectService != null) {
                  $('.tbl-briefcase-history-proposal tbody').append(
                    "<tr>" +
                    "<td>Turismo Pasajeros</td>" +
                    "<td>" + objectService['stService'] + "</td>" +
                    "<td>" + objectService['espTypology'] + "</td>" +
                    "<td>" + objectService['bteValueratebase'] + "</td>" +
                    "</tr>"
                  );
                }
              }
            );
            break;
          case 'Traslado Urbano':
            $.get(
              "{{ route('getServiceproposal') }}", {
                type: separatedItems[0],
                briefcase: separatedItems[1],
                service: separatedItems[2]
              },
              function(objectService) {
                if (objectService != null) {
                  $('.tbl-briefcase-history-proposal tbody').append(
                    "<tr>" +
                    "<td>Traslado Urbano</td>" +
                    "<td>" + objectService['strService'] + "</td>" +
                    "<td>" + objectService['espTypology'] + "</td>" +
                    "<td>" + objectService['btreValueratebase'] + "</td>" +
                    "</tr>"
                  );
                }
              }
            );
            break;
          case 'Traslado Intermunicipal':
            $.get(
              "{{ route('getServiceproposal') }}", {
                type: separatedItems[0],
                briefcase: separatedItems[1],
                service: separatedItems[2]
              },
              function(objectService) {
                if (objectService != null) {
                  $('.tbl-briefcase-history-proposal tbody').append(
                    "<tr>" +
                    "<td>Traslado Intermunicipal</td>" +
                    "<td>" + objectService['stmService'] + "</td>" +
                    "<td>" + objectService['espTypology'] + "</td>" +
                    "<td>" + objectService['btriValuebase'] + "</td>" +
                    "</tr>"
                  );
                }
              }
            );
            break;
        }
      }
      setTimeout(function() {
        $('.bj-spinner-proposal').css('display', 'none');
        $('.sectionModal-proposal-details').css('display', 'block');
      }, 2000);
    }
  });
</script>
@endsection