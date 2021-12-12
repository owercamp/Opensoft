@extends('modules.operativeProgramming')

@section('space')
<div class="col-md-12" style="font-size: 12px;">
  <div class="row border-bottom mb-2">
    <div class="col-md-6">
      <h5>PENDIENTE DE ASIGNACION</h5>
    </div>
    <div class="col-md-6">
      @if(session('SuccessAssignment'))
      <div class="alert alert-success">
        {{ session('SuccessAssignment') }}
      </div>
      @endif
      @if(session('PrimaryAssignment'))
      <div class="alert alert-primary">
        {{ session('PrimaryAssignment') }}
      </div>
      @endif
      @if(session('WarningAssignment'))
      <div class="alert alert-warning">
        {{ session('WarningAssignment') }}
      </div>
      @endif
      @if(session('SecondaryAssignment'))
      <div class="alert alert-secondary">
        {{ session('SecondaryAssignment') }}
      </div>
      @endif
    </div>
  </div>
  @include('partials.alerts')
  <table id="tableDatatable" class="table text-center" width="100%">
    <thead>
      <tr>
        <th>N° SERVICIO</th>
        <th>TIPO DE SOLICITUD</th>
        <th>SERVICIO</th>
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
        <td>{{ getStringSequence($i + 1) }}</td>
        <td>{{ $dates[$i][3] }}</td>
        <td>{{ $dates[$i][4] }}</td>
        <td>{{ $dates[$i][2] }}</td>
        <td>{{ $dates[$i][5] }}</td>
        <td>{{ $dates[$i][9] }}</td>
        <td>
          <a href="#" title="Ver información completa" class="btn btn-outline-tertiary rounded-circle form-control-sm details-link">
            <i class="fas fa-eye"></i>
            <span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
            <span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
            <span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
            <span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
            <span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
            <span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
            <span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
            <span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
            <span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
            <span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
            <span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
            <span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
            <span hidden>{{ $dates[$i][12] }}</span> <!-- Identificador -->
          </a>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm edit-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
            <span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
            <span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
            <span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
            <span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
            <span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
            <span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
            <span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
            <span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
            <span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
            <span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
            <span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
            <span hidden>{{ $dates[$i][12] }}</span> <!-- Identificador -->
          </a>
          <a href="#" title="Asignar" class="btn btn-outline-success rounded-circle form-control-sm assign-link">
            <i class="fas fa-exchange-alt"></i>
            <span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
            <span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
            <span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
            <span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
            <span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
            <span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
            <span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
            <span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
            <span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
            <span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
            <span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
            <span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
            <span hidden>{{ $dates[$i][12] }}</span> <!-- Identificador -->
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-danger rounded-circle form-control-sm delete-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
            <span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
            <span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
            <span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
            <span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
            <span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
            <span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
            <span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
            <span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
            <span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
            <span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
            <span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
            <span hidden>{{ $dates[$i][12] }}</span> <!-- Identificador -->
          </a>
        </td>
        </tr>
        @endfor
    </tbody>
  </table>
</div>

<!-- Show -->
<div class="modal fade" id="ShowAsign" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="btn-close btn-primary" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @include('modules.programmings.assignment.form.ShowDelete')
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit -->
<div class="modal fade" id="Edit" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="btn-close btn-primary" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <form action="{{ route('request.update') }}" method="post" class="p-2">
          @csrf @method('PATCH')
          <div class="col-lg-12 row">
            <div class="col-md-4">
              <div class="form-group">
                <small class="text-muted">Nombre de cliente: </small>
                <select name="Client" class="form-control form-control-sm" required>
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
                <select name="Messenger_id" class="form-control form-control-sm" required>
                  <option value="">Seleccione ...</option>

                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <small class="text-muted">Fecha: </small>
                <input type="text" name="Dateservice" class="form-control form-control-sm text-center datepicker" required>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <small class="text-muted">Hora: </small>
                <input type="time" name="Hourstart" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="col-lg-12 row">
            <div class="col-md-6 p-1 pr-3 border-right">
              <small style="color: blue; font-weight: bold;">ORIGEN: </small>
              <div class="row border-top">
                <div class="col-md-4">
                  <!-- CIUDAD -->
                  <div class="form-group">
                    <small class="text-muted">Ciudad: </small>
                    <select name="Municipalityorigin_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="Addressorigin" class="form-control form-control-sm" required>
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
                    <select name="Municipalitydestiny_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="Addressdestiny" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 row">
            <div class="col-md-6">
              <div class="form-group">
                <small class="text-muted">Contacto: </small>
                <input type="text" name="Contact" maxlength="50" title="De 1 a 50 carácteres NO numéricos" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">Teléfono: </small>
                <input type="text" name="Phone" maxlength="10" pattern="[0-9]{1,10}" title="De 1 a 10 números" class="form-control form-control-sm" required>
              </div>
            </div>
            <div class="col-md-6 Obs">
              <div class="form-group">
                <small class="text-muted">Observación: </small>
                <textarea name="Observation" rows="4" class="form-control form-control-sm"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <input type="hidden" name="id">
            <input type="hidden" name="type">
            <input type="hidden" name="Typecliente" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- delete -->
<div class="modal fade" id="Delete" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title"></h5>
        <button type="button" class="btn-close btn-primary" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('destroy.to')}}" method="post">
          @csrf @method('DELETE')
          @include('modules.programmings.assignment.form.ShowDelete')
          <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-tertiary">Eliminar</button>
            <input type="hidden" name="id">
            <input type="hidden" name="type">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- asignación -->
<div class="modal fade" id="Asign" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title"></h5>
        <button type="button" class="btn-close btn-primary" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered border" id="tbl" width="100">
          <thead>
            <th>Selección</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <form action="{{ route('asign.to') }}" method="post">
          @csrf
          <input type="hidden" name="id">
          <input type="hidden" name="tblid">
          <input type="hidden" name="type">
          <button type="submit" class="btn btn-primary">Asignar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $('select[name=Client]').on('change', function(e) {
    let selected = e.target.value;
    $('input[name=Typecliente]').val('');
    if (selected !== '') {
      let type = $('select[name=Client] option:selected').attr('data-type');
      $('input[name=Typecliente]').val(type);
    }
  });

  const asign = (asign, register, type) => {
    let typeService = ["Mensajería Express", "Logística Express", "Carga Express", "Turismo Pasajeros", "Traslado Urbano", "Traslado Intermunicipal"];
    if ($("input[name=id]").val() == "") {
      $("input[name='id']").val(asign);
      $("input[name='tblid']").val(register);
      $("input[name='type']").val(typeService[type]);
    } else {
      $("input[name='id']").val(asign);
      $("input[name='tblid']").val(register);
      $("input[name='type']").val(typeService[type]);
      $('input[type=checkbox]').each(function() {
        if ($(this).val() == $('input[name=id]').val()) {
          $(this).prop("checked", true);
        } else {
          $(this).prop("checked", false);
        }
      });
    }
  }

  // *asign
  $('.assign-link').click(function() {
    let typeRequest = $(this).find('span:nth-child(5)').text(),
      register = $(this).find('span:nth-child(14)').text(),
      type = ["Mensajería Express", "Logística Express", "Carga Express", "Turismo Pasajeros", "Traslado Urbano", "Traslado Intermunicipal"];
    let index = type.findIndex(type => type === typeRequest);
    $('.title').text(`Servicio ${typeRequest}`).addClass('text-uppercase');
    $('#tbl tbody').empty();
    if ($(this).find('span:nth-child(5)').text() == 'Mensajería Express') {
      // *consulta contractormessegers
      $.get("{{ route('apiContractorMessenger') }}", function(objectMessenger) {
        objectMessenger.forEach(element => {
          $('#tbl tbody').append(`<tr>
          <td style="vertical-align: middle"><input type="checkbox" value="${element.cmId}" class="micheckbox" onclick="asign(${element.cmId},${register},${index})"></td>
          <td style="vertical-align: middle" class="text-capitalize">${element.cmNames}</td>
          <td style="vertical-align: middle">${element.cmEmail}</td>
          <td style="vertical-align: middle">${element.cmMovil}</td>
          </tr>`);
        });
      })
    } else if ($(this).find('span:nth-child(5)').text() == 'Logística Express' || $(this).find('span:nth-child(5)').text() == 'Carga Express') {
      // *consulta contracttorschargeexpress
      $.get("{{ route('apiContractorCharge') }}", function(objectCharge) {
        objectCharge.forEach(element => {
          $('#tbl tbody').append(`<tr>
          <td style="vertical-align: middle"><input type="checkbox" value="${element.ccId}" class="micheckbox" onclick="asign(${element.ccId},${register},${index})"></td>
          <td style="vertical-align: middle" class="text-capitalize">${element.ccNames}</td>
          <td style="vertical-align: middle">${element.ccEmail}</td>
          <td style="vertical-align: middle">${element.ccMovil}</td>
          </tr>`);
        });
      });
    } else if ($(this).find('span:nth-child(5)').text() == 'Turismo Pasajeros' || $(this).find('span:nth-child(5)').text() == 'Traslado Urbano' || $(this).find('span:nth-child(5)').text() == 'Traslado Intermunicipal') {
      // *consulta contractorserviceespecial
      $.get("{{ route('apiContractorSpecial') }}", function(objectSpecial) {
        objectSpecial.forEach(element => {
          $('#tbl tbody').append(`<tr>
          <td style="vertical-align: middle"><input type="checkbox" value="${element.ceId}" class="micheckbox" onclick="asign(${element.ceId},${register},${index})"></td>
          <td style="vertical-align: middle" class="text-capitalize">${element.ceNames}</td>
          <td style="vertical-align: middle">${element.ceEmail}</td>
          <td style="vertical-align: middle">${element.ceMovil}</td>
          </tr>`);
        });
      });
    }
    $('#Asign').modal();
  });

  // *edit info
  $('.edit-link').click(function() {
    let typeService = $(this).find('span:nth-child(5)').text(),
      id = $(this).find('span:nth-child(14)').text();

    $('select[name=Messenger_id]').empty();
    $('select[name=Messenger_id]').append(`<option value="">Seleccione...</option>`);
    $.ajax({
      "_token": "{{csrf_token()}}",
      type: "POST",
      dataType: "JSON",
      data: {
        type: typeService,
        id: id
      },
      url: "{{ route('apiService') }}",
      success(res) {
        $('select[name=Client]').val(res[1]);
        let data = $('select[name=Client] option:selected').attr('data-type');
        $('input[name=Typecliente]').val(data);
        $('input[name=Dateservice]').val(res[2]);
        $('input[name=Hourstart]').val(res[3]);
        $('select[name=Municipalityorigin_id]').val(res[4]);
        $('input[name=Addressorigin]').val(res[5]);
        $('select[name=Municipalitydestiny_id]').val(res[6]);
        $('input[name=Addressdestiny]').val(res[7]);
        $('input[name=Contact]').val(res[8]);
        $('input[name=Phone]').val(res[9]);
        $('input[name=id]').val(id);
        $('input[name=type]').val(typeService);
        if (typeService == "Mensajería Express") {
          $.get("{{ route('getMessenger') }}", function(objectMessenger) {
            let count = Object.keys(objectMessenger).length;
            if (count > 0) {
              for (let i = 0; i < count; i++) {
                if (objectMessenger[i]['smId'] == res[11]) {
                  $('select[name=Messenger_id]').append(`<option value="${objectMessenger[i]['smId']}" selected>${objectMessenger[i]['smService']}</option>`);
                } else {
                  $('select[name=Messenger_id]').append(`<option value="${objectMessenger[i]['smId']}">${objectMessenger[i]['smService']}</option>`);
                }
              }
            }
          })
        } else if (typeService == "Logística Express") {
          $.get("{{ route('getLogistic') }}", function(objectLogistic) {
            let count = Object.keys(objectLogistic).length;
            if (count > 0) {
              for (let i = 0; i < count; i++) {
                if (objectLogistic[i]['slId'] == res[11]) {
                  $('select[name=Messenger_id]').append(`<option value="${objectLogistic[i]['slId']}" selected>${objectLogistic[i]['slService']}</option>`);
                } else {
                  $('select[name=Messenger_id]').append(`<option value="${objectLogistic[i]['slId']}" selected>${objectLogistic[i]['slService']}</option>`);
                }
              }
            }
          })
        } else if (typeService == "Carga Express") {
          $.get("{{ route('getExpress') }}", function(objectExpress) {
            let count = Object.keys(objectExpress).length;
            if (count > 0) {
              for (let i = 0; i < count; i++) {
                if (objectExpress[i]['scId'] == res[11]) {
                  $('select[name=Messenger_id]').append(`<option value="${objectExpress[i]['scId']}" selected>${objectExpress[i]['scService']}</option>`);
                } else {
                  $('select[name=Messenger_id]').append(`<option value="${objectExpress[i]['scId']}">${objectExpress[i]['scService']}</option>`);
                }
              }
            }
          });
        } else if (typeService == "Turismo Pasajeros") {
          $.get("{{ route('getTurism') }}", function(objectTurism) {
            let count = Object.keys(objectTurism).length;
            if (count > 0) {
              for (let i = 0; i < count; i++) {
                if (objectTurism[i]['stId'] == res[11]) {
                  $('select[name=Messenger_id]').append(`<option value="${objectTurism[i]['stId']}" selected>${objectTurism[i]['stService']}</option>`);
                } else {
                  $('select[name=Messenger_id]').append(`<option value="${objectTurism[i]['stId']}" selected>${objectTurism[i]['stService']}</option>`);
                }
              }
            }
          })
        } else if (typeService == "Traslado Urbano") {
          $.get("{{ route('getUrban') }}", function(objectUrban) {
            let count = Object.keys(objectUrban).length;
            if (count > 0) {
              for (let i = 0; i < count; i++) {
                if (objectUrban[i]['strId'] == res[11]) {
                  $('select[name=Messenger_id]').append(`<option value="${objectUrban[i]['strId']}" selected>${objectUrban[i]['strService']}</option>`);
                } else {
                  $('select[name=Messenger_id]').append(`<option value="${objectUrban[i]['strId']}" >${objectUrban[i]['strService']}</option>`);
                }
              }
            }
          })
        } else if (typeService == "Traslado Intermunicipal") {
          $.get("{{ route('getInter') }}", function(objectInter) {
            let count = Object.keys(objectInter).length;
            if (count > 0) {
              for (let i = 0; i < count; i++) {
                if (objectInter[i]['stmId'] == res[11]) {
                  $('select[name=Messenger_id]').append(`<option value="${objectInter[i]['stmId']}" selected>${objectInter[i]['stmService']}</option>`);
                } else {
                  $('select[name=Messenger_id]').append(`<option value="${objectInter[i]['stmId']}">${objectInter[i]['stmService']}</option>`);
                }
              }
            }
          })
        }
        if (res[0] == "Mensajeria") {
          $('textarea[name=Observation]').val(res[10]);
          $('.Obs').prop('hidden', false);
        } else {
          $('.Obs').prop('hidden', true);
        }
      },
      complete() {
        $('#Edit').modal();
      }
    })
  });

  // *del info
  $('.delete-link').click(function() {
    let typeRequest = $(this).find('span:nth-child(5)').text();
    $('.title').text(`Servicio ${typeRequest}`).addClass('text-uppercase');
    $('.date').text($(this).find('span:nth-child(2)').text());
    $('.hour').text($(this).find('span:nth-child(3)').text());
    $('.customer').text($(this).find('span:nth-child(4)').text());
    $('.typeRequest').text($(this).find('span:nth-child(5)').text());
    $('.service').text($(this).find('span:nth-child(6)').text());
    $('.origin').text($(this).find('span:nth-child(7)').text());
    $('.addressOrigin').text($(this).find('span:nth-child(8)').text());
    $('.contact').text($(this).find('span:nth-child(9)').text());
    $('.phone').text($(this).find('span:nth-child(10)').text());
    $('.destiny').text($(this).find('span:nth-child(11)').text());
    $('.addressDestiny').text($(this).find('span:nth-child(12)').text());
    $('input[name=id]').val($(this).find('span:nth-child(14)').text());
    $('input[name=type]').val($(this).find('span:nth-child(5)').text());
    $('.obs').text($(this).find('span:nth-child(13)').text());

    $('#Delete').modal();
  });

  // *show info
  $('.details-link').click(function() {
    let typeRequest = $(this).find('span:nth-child(5)').text();
    $('#title').text(`Servicio ${typeRequest}`).addClass('text-uppercase');
    $('.date').text($(this).find('span:nth-child(2)').text());
    $('.hour').text($(this).find('span:nth-child(3)').text());
    $('.customer').text($(this).find('span:nth-child(4)').text());
    $('.typeRequest').text($(this).find('span:nth-child(5)').text());
    $('.service').text($(this).find('span:nth-child(6)').text());
    $('.origin').text($(this).find('span:nth-child(7)').text());
    $('.addressOrigin').text($(this).find('span:nth-child(8)').text());
    $('.contact').text($(this).find('span:nth-child(9)').text());
    $('.phone').text($(this).find('span:nth-child(10)').text());
    $('.destiny').text($(this).find('span:nth-child(11)').text());
    $('.addressDestiny').text($(this).find('span:nth-child(12)').text());
    $('.obs').text($(this).find('span:nth-child(13)').text());

    $('#ShowAsign').modal();
  });
</script>
@endsection