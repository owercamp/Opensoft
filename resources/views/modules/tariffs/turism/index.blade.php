@extends('modules.comercialTariffs')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>TURISMO PASAJEROS</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newTurism-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessTurism'))
      <div class="alert alert-success">
        {{ session('SuccessTurism') }}
      </div>
      @endif
      @if(session('PrimaryTurism'))
      <div class="alert alert-primary">
        {{ session('PrimaryTurism') }}
      </div>
      @endif
      @if(session('WarningTurism'))
      <div class="alert alert-warning">
        {{ session('WarningTurism') }}
      </div>
      @endif
      @if(session('SecondaryTurism'))
      <div class="alert alert-secondary">
        {{ session('SecondaryTurism') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>AÑO</th>
        <th>CIUDAD</th>
        <th>VEHICULO</th>
        <th>TIPO DE SERVICIO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($briefcases as $turism)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $turism->bteYear }}</td>
        <td>{{ $turism->munName }}</td>
        <td>{{ $turism->espTypology }}</td>
        <td>{{ $turism->stService }}</td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editTurism-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $turism->bteId }}</span>
            <span hidden>{{ $turism->bteYear }}</span>
            <span hidden>{{ $turism->munName }}</span>
            <span hidden>{{ $turism->espTypology }}</span>
            <span hidden>{{ $turism->stService }}</span>
            <span hidden>{{ $turism->stAvailability }}</span>
            <span hidden>{{ $turism->stDescription }}</span>
            <span hidden>{{ $turism->ptProduct }}</span>
            <span hidden>{{ $turism->bteValueratebase }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteTurism-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $turism->bteId }}</span>
            <span hidden>{{ $turism->bteYear }}</span>
            <span hidden>{{ $turism->munName }}</span>
            <span hidden>{{ $turism->espTypology }}</span>
            <span hidden>{{ $turism->stService }}</span>
            <span hidden>{{ $turism->stAvailability }}</span>
            <span hidden>{{ $turism->stDescription }}</span>
            <span hidden>{{ $turism->ptProduct }}</span>
            <span hidden>{{ $turism->bteValueratebase }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@php
$yearnow = date('Y');
$mountnow = date('m');
$yearfutureOne = date('Y') + 1;
$yearfutureTwo = date('Y') + 2;
$yearfutureThree = date('Y') + 3;
$yearfutureFour = date('Y') + 4;
$yearfutureFive = date('Y') + 5;
$yearfutureSix = date('Y') + 6;
$yearfutureSeven = date('Y') + 7;
@endphp

<div class="modal fade" id="newTurism-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVOS REGISTROS DE TURISMO PASAJEROS:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('tariffs.turism.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">AÑO:</small>
                    <select name="bteYear" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      <option value="{{ $yearnow }}">{{ $yearnow }}</option>
                      <option value="{{ $yearfutureOne }}">{{ $yearfutureOne }}</option>
                      <option value="{{ $yearfutureTwo }}">{{ $yearfutureTwo }}</option>
                      <option value="{{ $yearfutureThree }}">{{ $yearfutureThree }}</option>
                      <option value="{{ $yearfutureFour }}">{{ $yearfutureFour }}</option>
                      <option value="{{ $yearfutureFive }}">{{ $yearfutureFive }}</option>
                      <option value="{{ $yearfutureSix }}">{{ $yearfutureSix }}</option>
                      <option value="{{ $yearfutureSeven }}">{{ $yearfutureSeven }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CIUDAD:</small>
                    <select name="bteMunicipility_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($municipalities as $municipality)
                      <option value="{{ $municipality->munId }}">{{ $municipality->munName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">VEHICULO:</small>
                    <select name="bteTypevehicle_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($especials as $especial)
                      <option value="{{ $especial->espId }}">{{ $especial->espTypology }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">SERVICIOS:</small>
                    <select name="bteTypeservice_id_new" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      @foreach($servicesturism as $service)
                      <option value="{{ $service->stId }}" data-product='{{ $service->ptProduct }}'>{{ $service->stService }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">PRODUCTO:</small>
                    <input type="text" name="bteProduct_new" class="form-control form-control-sm" readonly disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 p-3 text-center">
                  <button type="button" class="btn btn-outline-success form-control-sm mt-3 btn-addService-newTurism" title='AGREGUE EL SERVICIO SELECCIONADO PARA ESPECIFICAR VALORES'>Agregar servicio</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 p-3 text-center">
                  <small class="infoRepeat" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table class="table text-center border-bottom tbl-service-newTurism" width="100%" style="font-size: 12px;">
                    <thead>
                      <th>SERVICIO</th>
                      <th>PRODUCTO</th>
                      <th>TARIFA BASE</th>
                      <th></th>
                    </thead>
                    <tbody>
                      <!-- Dinamics row -->
                      <!-- stId, stService, ptProduct -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <input type="hidden" name="all_services" class="form-control form-control-sm" readonly required>
            <button type="submit" class="btn btn-outline-success form-control-sm btn-saveDefinitive">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editTurism-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE VALORES, PORTAFOLIO DE TURISMO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('tariffs.turism.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row text-center border p-3">
                <div class="col-md-3">
                  <small class="text-muted">AÑO:</small>
                  <h3 class="text-muted"><b class="bteYear_Edit"></b></h3><br>
                  <input type="hidden" name="bteYear_Edit" class="form-control form-control-sm" readonly required>
                </div>
                <div class="col-md-4">
                  <small class="text-muted">CIUDAD:</small>
                  <h3 class="text-muted"><b class="bteCity_Edit"></b></h3><br>
                  <input type="hidden" name="bteCity_Edit" class="form-control form-control-sm" readonly required>
                </div>
                <div class="col-md-4">
                  <small class="text-muted">VEHICULO:</small>
                  <h3 class="text-muted"><b class="bteVehicle_Edit"></b></h3><br>
                  <input type="hidden" name="bteVehicle_Edit" class="form-control form-control-sm" readonly required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="font-size: 12px; text-align: center;">
                  <small class="text-muted">SERVICIO: </small>
                  <span class="text-muted"><b class="stService_Edit"></b></span><br>
                  <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small>
                  <span class="text-muted"><b class="stAvailability_Edit"></b></span><br>
                  <small class="text-muted">DESCRIPCION: </small><br>
                  <span class="text-muted"><b class="stDescription_Edit"></b></span><br>
                  <small class="text-muted">PRODUCTO: </small><br>
                  <span class="text-muted"><b class="ptProduct_Edit"></b></span><br>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table class="table text-center border-bottom tbl-service-editTurism" width="100%" style="font-size: 12px;">
                    <thead>
                      <th>TARIFA BASE</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class='form-group'>
                            <div class='input-group'>
                              <div class='input-group-prepend'>
                                <span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>
                              </div>
                              <input type='text' name='bteValueratebase' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Tarifa base ($)' required>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="bteId_Edit" readonly required>
              <button type="submit" class="btn btn-outline-success form-control-sm my-3">GUARDAR CAMBIOS</button>
            </div>
            <div class="col-md-6">
              <button type="button" class="btn btn-outline-tertiary mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteTurism-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE REGISTRO, PORTAFOLIO DE TURISMO:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <small class="text-muted">AÑO: </small><br>
            <span class="text-muted"><b class="bteYear_Delete"></b></span><br>
            <small class="text-muted">CIUDAD: </small><br>
            <span class="text-muted"><b class="bteCity_Delete"></b></span><br>
            <small class="text-muted">SERVICIO: </small><br>
            <span class="text-muted"><b class="stService_Delete"></b></span><br>
            <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
            <span class="text-muted"><b class="stAvailability_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION DEL SERVICIO: </small><br>
            <span class="text-muted"><b class="stDescription_Delete"></b></span><br>
            <small class="text-muted">PRODUCTO: </small><br>
            <span class="text-muted"><b class="ptProduct_Delete"></b></span><br>
            <small class="text-muted">TARIFA BASE: </small><br>
            <span class="text-muted"><b class="bteValueratebase_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('tariffs.turism.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="bteYear_Delete" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="bteCity_Delete" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="bteVehicle_Delete" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="bteId_Delete" readonly required>
            <button type="submit" class="btn btn-outline-success form-control-sm my-3">ELIMINAR</button>
          </form>
          <div class="col-md-6">
            <button type="button" class="btn btn-outline-tertiary mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
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

  });

  $('.newTurism-link').on('click', function() {
    $('.tbl-service-newTurism').find('tbody').empty();
    $('#newTurism-modal').modal();
  });

  $('select[name=bteTypeservice_id_new]').on('click', function(e) {
    var selected = e.target.value;
    $('input[name=bteProduct_new]').val('');
    if (selected != '') {
      var product = $('select[name=bteTypeservice_id_new] option:selected').attr('data-product');
      $('input[name=bteProduct_new]').val(product);
    }
  });

  // BOTON PARA AGREGAR SERVICIOS A NUEVO REGISTRO
  $('.btn-addService-newTurism').on('click', function() {
    var stId = $('select[name=bteTypeservice_id_new]').val();
    var stService = $('select[name=bteTypeservice_id_new] option:selected').text();
    var ptProduct = $('input[name=bteProduct_new]').val();
    var validateRepet = false;
    $('.tbl-service-newTurism').find('tbody').find('tr').each(function() {
      var idService = $(this).attr('class');
      if (idService == stId) {
        validateRepet = true;
      }
    });
    if (stId != '') {
      if (validateRepet == false) {
        $('.tbl-service-newTurism').find('tbody').append(
          "<tr class='" + stId + "' data-idService='" + stId + "'>" +
          "<td>" + stService + "</td>" +
          "<td>" + ptProduct + "</td>" +
          "<td>" +
          "<div class='form-group'>" +
          "<div class='input-group'>" +
          "<div class='input-group-prepend'>" +
          "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
          "</div>" +
          "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center bteValueratebase' title='Tarifa base ($)' required>" +
          "</div>" +
          "</div>" +
          "</td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteService-newTurism' title='Eliminar servicio'><i class='fas fa-trash-alt'></i></button>" +
          "</td>" +
          "</tr>"
        );
      } else {
        $('.infoRepeat').css('display', 'block');
        $('.infoRepeat').text('Servicio seleccionado ya está en la tabla');
        setTimeout(function() {
          $('.infoRepeat').css('display', 'none');
          $('.infoRepeat').text('');
        }, 3000);
      }
    } else {
      $('.infoRepeat').css('display', 'block');
      $('.infoRepeat').text('No hay seleccionado ningun servicio');
      setTimeout(function() {
        $('.infoRepeat').css('display', 'none');
        $('.infoRepeat').text('');
      }, 3000);
    }
  });

  // EVENTO PARA CLICK EN MODAL, GUARDAR EL NUEVO REGISTRO
  $('.btn-saveDefinitive').on('click', function(e) {
    // e.preventDefault();
    var allServices = '';
    $('input[name=all_services]').val('');
    $('.tbl-service-newTurism').find('tbody').find('tr').each(function() {
      var idService = $(this).attr('data-idService');
      var valuebase = $(this).find('input.bteValueratebase').val();
      allServices += idService + '-' + valuebase + '=';
    });
    $('input[name=all_services]').val(allServices);
    if (allServices != '' && allServices != null) {
      $(this).submit();
    } else {
      e.preventDefault();
      $('.infoRepeat').css('display', 'block');
      $('.infoRepeat').text('Seleccione al menos un servicio y defina sus valores antes de enviar la información');
      setTimeout(function() {
        $('.infoRepeat').css('display', 'none');
        $('.infoRepeat').text('');
      }, 3000);
    }
  });

  // BOTON DE TABLA DE DESTINOS PARA ELIMINAR FILA CLIKEADA
  $('.tbl-service-newTurism').on('click', '.btn-deleteService-newTurism', function() {
    $(this).parents('tr').remove();
  });

  $('.editTurism-link').on('click', function(e) {
    e.preventDefault();
    var bteId = $(this).find('span:nth-child(2)').text();
    var bteYear = $(this).find('span:nth-child(3)').text();
    var munName = $(this).find('span:nth-child(4)').text();
    var bteVehicle = $(this).find('span:nth-child(5)').text();
    var stService = $(this).find('span:nth-child(6)').text();
    var stAvailability = $(this).find('span:nth-child(7)').text();
    var stDescription = $(this).find('span:nth-child(8)').text();
    var ptProduct = $(this).find('span:nth-child(9)').text();
    var bteValueratebase = $(this).find('span:nth-child(10)').text();
    $('input[name=bteId_Edit]').val(bteId);
    $('b.bteYear_Edit').text(bteYear);
    $('input[name=bteYear_Edit]').val(bteYear);
    $('b.bteCity_Edit').text(munName);
    $('input[name=bteCity_Edit]').val(munName);
    $('b.bteVehicle_Edit').text(bteVehicle);
    $('input[name=bteVehicle_Edit]').val(bteVehicle);
    $('.stService_Edit').text(stService);
    $('.stAvailability_Edit').text(stAvailability);
    $('.stDescription_Edit').text(stDescription);
    $('.ptProduct_Edit').text(ptProduct);
    $('.tbl-service-editTurism').find('input[name=bteValueratebase]').val(bteValueratebase);
    $('#editTurism-modal').modal();
  });

  $('.deleteTurism-link').on('click', function(e) {
    e.preventDefault();
    var bteId = $(this).find('span:nth-child(2)').text();
    var bteYear = $(this).find('span:nth-child(3)').text();
    var munName = $(this).find('span:nth-child(4)').text();
    var bteVehicle = $(this).find('span:nth-child(5)').text();
    var stService = $(this).find('span:nth-child(6)').text();
    var stAvailability = $(this).find('span:nth-child(7)').text();
    var stDescription = $(this).find('span:nth-child(8)').text();
    var ptProduct = $(this).find('span:nth-child(9)').text();
    var bteValueratebase = $(this).find('span:nth-child(10)').text();
    $('input[name=bteId_Delete]').val(bteId);
    $('b.bteYear_Delete').text(bteYear);
    $('input[name=bteYear_Delete]').val(bteYear);
    $('b.bteCity_Delete').text(munName);
    $('input[name=bteCity_Delete]').val(munName);
    $('b.bteVehicle_Delete').text(bteVehicle);
    $('input[name=bteVehicle_Delete]').val(bteVehicle);
    $('.stService_Delete').text(stService);
    $('.stAvailability_Delete').text(stAvailability);
    $('.stDescription_Delete').text(stDescription);
    $('.ptProduct_Delete').text(ptProduct);
    $('.bteValueratebase_Delete').text('$' + bteValueratebase);
    $('#deleteTurism-modal').modal();
  });
</script>
@endsection