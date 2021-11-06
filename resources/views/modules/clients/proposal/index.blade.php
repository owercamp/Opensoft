@extends('modules.comercialPotentialclient')

@section('space')
<div class="col-md-12">
  <div class="row">
    <div class="col-md-6">
      <h5>PROPUESTA COMERCIAL</h5>
    </div>
    <div class="col-md-6">
      @if(session('SuccessProposal'))
      <div class="alert alert-success">
        {{ session('SuccessProposal') }}
      </div>
      @endif
      @if(session('SecondaryProposal'))
      <div class="alert alert-secondary">
        {{ session('SecondaryProposal') }}
      </div>
      @endif
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h6>Registro de propuestas comerciales</h6>
    </div>
    <form action="{{ route('clients.proposal.save') }}" method="POST">
      <div class="card-body p-3 border">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">FECHA:</small>
                  <input type="text" name="cprDate" title="Campo de fecha (aaaa-mm-aa)" class="form-control form-control-sm datepicker" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">CLIENTE:</small>
                  <input type="text" name="cprClient" title="Campo de texto (aA-zZ) de 50 carácteres máximo" maxlength="50" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">TIPO DE DOCUMENTO:</small>
                  <select name="cprTypedocument_id" class="form-control form-control-sm" required>
                    <option value="">Seleccione ...</option>
                    @foreach($typedocuments as $document)
                    <option value="{{ $document->perId }}">{{ $document->perName }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                  <input type="text" name="cprNumberdocument" maxlength="50" title="Campo alfanumérico (0-9,aA-zZ) de 20 carácteres máximo" class="form-control form-control-sm" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">CIUDAD:</small>
                  <select name="cprMunicipility_id" class="form-control form-control-sm" required>
                    <option value="">Seleccione ...</option>
                    @foreach($municipalities as $municipality)
                    <option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">MODALIDAD:</small>
                  <select name="cprModalitycontract" class="form-control form-control-sm" title="Seleccione modalidad de contratación" required>
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
              <div class="col-md-5">
                <div class="form-group">
                  <small class="text-muted">CONTACTO:</small>
                  <input type="text" name="cprContact" maxlength="50" title="Campo de texto (aA-zZ) de 50 carácteres máximo" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">TELEFONO:</small>
                  <input type="text" name="cprPhone" maxlength="10" pattern="[0-9]{1,10}" title="Campo numérico (0-9) de 10 números máximo" class="form-control form-control-sm" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <small class="text-muted">CORREO ELECTRONICO:</small>
                  <input type="email" name="cprEmail" maxlength="50" title="Campo de alfanumérico (0-9,aA-zZ) con @ obligatorio" class="form-control form-control-sm" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <small class="text-muted">OBSERVACIONES:</small>
                  <textarea type="text" name="cprObservation" maxlength="500" title="Campo de texto (0-9,aA-zZ) de 500 carácteres máximo" rows="2" class="form-control form-control-sm" required></textarea>
                </div>
              </div>
            </div>
            <div class="row border mx-3 p-2">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <small class="text-muted">PORTAFOLIO DE SERVICIO:</small>
                      <select name="briefcases_select" class="form-control form-control-sm" title="Seleccione el tipo de portafolio">
                        <option value="">Seleccione ...</option>
                        <option value="Mensajería Express">Mensajería Express</option>
                        <option value="Logística Express">Logística Express</option>
                        <option value="Carga Express">Carga Express</option>
                        <option value="Turismo Pasajeros">Turismo Pasajeros</option>
                        <option value="Traslado Urbano">Traslado Urbano</option>
                        <option value="Traslado Intermunicipal">Traslado Intermunicipal</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <small class="text-muted">TIPO DE SERVICIO:</small>
                      <select name="typeService_id" class="form-control form-control-sm" title="Seleccione tipo de servicio">
                        <option value="">Seleccione servicio ...</option>
                        <!-- dinamics row -->
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <small class="text-muted">TIPO DE VEHICULO:</small>
                      <input type="text" name="typeVehicle" class="form-control form-control-sm" disabled>
                      <!-- <select name="typeVehicle_id" class="form-control form-control-sm" title="Seleccione tipo de vehículo">
													<option value="">Seleccione vehículo ...</option>
												</select> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-outline-success form-control-sm btn-briefcase-addProposal">Agregar</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 p-3 text-center">
                <small class="info" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <table class="table text-center border-bottom tbl-briefcase-proposals" width="100%" style="font-size: 12px;">
                  <thead>
                    <th>PORTAFOLIO</th>
                    <th>TIPO DE SERVICIO</th>
                    <th>TIPO DE VEHICULO</th>
                    <th>TARIFA BASE</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <!-- Dinamics row -->
                    <!-- briefcases_select, typeService, typeVehicle, valueBaserate -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="form-group text-center">
          <input type="hidden" name="all_briefcase" class="form-control form-control-sm" required>
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

  $('.btn-saveDefinitive').on('click', function(e) {
    // e.preventDefault();
    var all = '';
    $('input[name=all_briefcase]').val('');
    $('.tbl-briefcase-proposals').find('tbody').find('tr').each(function() {
      var typeBriefcase = $(this).attr('data-typeBriefcase');
      var idBriefcase = $(this).attr('data-idBriefcase');
      var idservice = $(this).find('td:nth-child(2)').find('span').text();
      var idVehicle = $(this).find('td:nth-child(3)').find('span').text();
      var valuebase = $(this).find('td:nth-child(4)').text();
      all += typeBriefcase + '=>' + idBriefcase + '=>' + idservice + '=>' + idVehicle + '=>' + valuebase + '<=|=>';
    });
    $('input[name=all_briefcase]').val(all);
    console.log(all);
    if (all != '' && all != null) {
      $(this).submit();
    } else {
      e.preventDefault();
      $('.info').css('display', 'block');
      $('.info').text('Seleccione al menos un portafolio y su tipo de servicio antes de enviar la información');
      setTimeout(function() {
        $('.info').css('display', 'none');
        $('.info').text('');
      }, 3000);
    }
  });

  $('select[name=briefcases_select]').on('change', function(e) {
    var selected = e.target.value;
    $('select[name=typeService_id]').empty();
    $('select[name=typeService_id]').append("<option value=''>Seleccione servicio ...</option>");
    $('input[name=typeVehicle]').val('');
    // $('select[name=typeVehicle_id]').empty();
    // $('select[name=typeVehicle_id]').append("<option value=''>Seleccione vehículo ...</option>");
    // $('select[name=typeVehicle_id]').attr('disabled',false);
    if (selected != '') {
      switch (selected) {
        case 'Mensajería Express':
          $.get("{{ route('getTypeservice') }}", {
            type: 'Mensajería Express'
          }, function(objectServices) {
            var count = Object.keys(objectServices).length;
            if (count > 0) {
              for (var i = 0; i < count; i++) {
                // $('select[name=typeService_id]').append(
                // 	"<option value='" + objectServices[i]['smId'] + "'>" +
                // 		objectServices[i]['smService'] +
                // 	"</option>"
                // );
                $('select[name=typeService_id]').append(
                  "<option value='" + objectServices[i]['bmeId'] + "'" +
                  " data-service='" + objectServices[i]['smId'] + "' " +
                  " data-base='" + objectServices[i]['bmeValueratebase'] + "' " +
                  " data-vehicle='N/A' " +
                  ">" +
                  objectServices[i]['smService'] + ' - $' +
                  objectServices[i]['bmeValueratebase'] +
                  "</option>"
                );
              }
            }
          });
          break;
        case 'Logística Express':
          $.get("{{ route('getTypeservice') }}", {
            type: 'Logística Express'
          }, function(objectServices) {
            var count = Object.keys(objectServices).length;
            if (count > 0) {
              for (var i = 0; i < count; i++) {
                $('select[name=typeService_id]').append(
                  "<option value='" + objectServices[i]['bleId'] + "'" +
                  " data-service='" + objectServices[i]['slId'] + "' " +
                  " data-base='" + objectServices[i]['bleValueratebase'] + "' " +
                  " data-vehicle='N/A' " +
                  ">" +
                  objectServices[i]['slService'] + ' - $' +
                  objectServices[i]['bleValueratebase'] +
                  "</option>"
                );
              }
            }
          });
          break;
        case 'Carga Express':
          $.get("{{ route('getTypeservice') }}", {
            type: 'Carga Express'
          }, function(objectServices) {
            var count = Object.keys(objectServices).length;
            if (count > 0) {
              for (var i = 0; i < count; i++) {
                $('select[name=typeService_id]').append(
                  "<option value='" + objectServices[i]['bceId'] + "'" +
                  " data-service='" + objectServices[i]['scId'] + "' " +
                  " data-base='" + objectServices[i]['bceValueratebase'] + "' " +
                  " data-vehicle='" + objectServices[i]['heaId'] + "-" + objectServices[i]['heaTypology'] + "' " +
                  ">" +
                  objectServices[i]['scService'] + ' - $' +
                  objectServices[i]['bceValueratebase'] +
                  "</option>"
                );
              }
            }
          });
          break;
        case 'Turismo Pasajeros':
          $.get("{{ route('getTypeservice') }}", {
            type: 'Turismo Pasajeros'
          }, function(objectServices) {
            var count = Object.keys(objectServices).length;
            if (count > 0) {
              for (var i = 0; i < count; i++) {
                $('select[name=typeService_id]').append(
                  "<option value='" + objectServices[i]['bteId'] + "'" +
                  " data-service='" + objectServices[i]['stId'] + "' " +
                  " data-base='" + objectServices[i]['bteValueratebase'] + "' " +
                  " data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
                  ">" +
                  objectServices[i]['stService'] + ' - $' +
                  objectServices[i]['bteValueratebase'] +
                  "</option>"
                );
              }
            }
          });
          break;
        case 'Traslado Urbano':
          $.get("{{ route('getTypeservice') }}", {
            type: 'Traslado Urbano'
          }, function(objectServices) {
            var count = Object.keys(objectServices).length;
            if (count > 0) {
              for (var i = 0; i < count; i++) {
                $('select[name=typeService_id]').append(
                  "<option value='" + objectServices[i]['btreId'] + "'" +
                  " data-service='" + objectServices[i]['strId'] + "' " +
                  " data-base='" + objectServices[i]['btreValueratebase'] + "' " +
                  " data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
                  ">" +
                  objectServices[i]['strService'] + ' - $' +
                  objectServices[i]['btreValueratebase'] +
                  "</option>"
                );
              }
            }
          });
          break;
        case 'Traslado Intermunicipal':
          $.get("{{ route('getTypeservice') }}", {
            type: 'Traslado Intermunicipal'
          }, function(objectServices) {
            var count = Object.keys(objectServices).length;
            if (count > 0) {
              for (var i = 0; i < count; i++) {
                $('select[name=typeService_id]').append(
                  "<option value='" + objectServices[i]['btriId'] + "'" +
                  " data-service='" + objectServices[i]['stmId'] + "' " +
                  " data-base='" + objectServices[i]['btriValuebase'] + "' " +
                  " data-vehicle='" + objectServices[i]['espId'] + "-" + objectServices[i]['espTypology'] + "' " +
                  ">" +
                  objectServices[i]['stmService'] + ' - $' +
                  objectServices[i]['btriValuebase'] +
                  "</option>"
                );
              }
            }
          });
          break;
      }
    }
  });

  $('select[name=typeService_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=typeVehicle]').val('');
    if (selected != '') {
      var vehicle = $('select[name=typeService_id] option:selected').attr('data-vehicle');
      $('input[name=typeVehicle]').val(vehicle);
    }
  });

  // BOTON PARA AGREGAR SERVICIOS A NUEVO REGISTRO
  $('.btn-briefcase-addProposal').on('click', function() {
    var briefcase = $('select[name=briefcases_select]').val();
    var briefcase_id = $('select[name=typeService_id]').val();
    var idService = $('select[name=typeService_id] option:selected').attr('data-service');
    var serviceValueSeparated = $('select[name=typeService_id] option:selected').text().split(' - ');
    var service = serviceValueSeparated[0];
    var rate = serviceValueSeparated[1];
    var find = $('input[name=typeVehicle]').val().indexOf('-');
    if (find > -1) {
      var vehicleSeparated = $('input[name=typeVehicle]').val().split('-');
      var idVehicle = vehicleSeparated[0];
      var vehicle = vehicleSeparated[1];
    } else {
      var idVehicle = $('input[name=typeVehicle]').val();
      var vehicle = $('input[name=typeVehicle]').val();
    }

    var validateRepet = false;
    $('.tbl-briefcase-proposals').find('tbody').find('tr').each(function() {
      var idBriefcase = $(this).attr('class');
      var typeBriefcase = $(this).attr('data-typeBriefcase');
      if (idBriefcase == briefcase_id && typeBriefcase == briefcase) {
        validateRepet = true;
      }
    });
    if (briefcase_id != '' && vehicle != '') {
      if (validateRepet == false) {
        $('.tbl-briefcase-proposals').find('tbody').append(
          "<tr class='" + briefcase_id + "' data-typeBriefcase='" + briefcase + "' data-idBriefcase='" + briefcase_id + "'>" +
          "<td>" + briefcase + "</td>" +
          "<td><span hidden>" + idService + "</span>" + service + "</td>" +
          "<td><span hidden>" + idVehicle + "</span>" + vehicle + "</td>" +
          "<td>" + rate + "</td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteBriefcase' title='Eliminar portafolio'><i class='fas fa-trash-alt'></i></button>" +
          "</td>" +
          "</tr>"
        );
      } else {
        $('.info').css('display', 'block');
        $('.info').text('Portafolio y/o tipo de servicio seleccionado ya está en la tabla');
        setTimeout(function() {
          $('.info').css('display', 'none');
          $('.info').text('');
        }, 3000);
      }
    } else {
      $('.info').css('display', 'block');
      $('.info').text('No hay seleccionado ningun portafolio y/o tipo de servicio');
      setTimeout(function() {
        $('.info').css('display', 'none');
        $('.info').text('');
      }, 3000);
    }
  });

  $('.tbl-briefcase-proposals').on('click', '.btn-deleteBriefcase', function() {
    $(this).parents('tr').remove();
  });
</script>
@endsection