@extends('modules.comercialTariffs')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>TRASLADO URBANO</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newTransfer-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessTransfer'))
      <div class="alert alert-success">
        {{ session('SuccessTransfer') }}
      </div>
      @endif
      @if(session('PrimaryTransfer'))
      <div class="alert alert-primary">
        {{ session('PrimaryTransfer') }}
      </div>
      @endif
      @if(session('WarningTransfer'))
      <div class="alert alert-warning">
        {{ session('WarningTransfer') }}
      </div>
      @endif
      @if(session('SecondaryTransfer'))
      <div class="alert alert-secondary">
        {{ session('SecondaryTransfer') }}
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
      @foreach($briefcases as $transfer)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $transfer->btreYear }}</td>
        <td>{{ $transfer->munName }}</td>
        <td>{{ $transfer->espTypology }}</td>
        <td>{{ $transfer->strService }}</td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editTransfer-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $transfer->btreId }}</span>
            <span hidden>{{ $transfer->btreYear }}</span>
            <span hidden>{{ $transfer->munName }}</span>
            <span hidden>{{ $transfer->espTypology }}</span>
            <span hidden>{{ $transfer->strService }}</span>
            <span hidden>{{ $transfer->strAvailability }}</span>
            <span hidden>{{ $transfer->strDescription }}</span>
            <span hidden>{{ $transfer->ptrProduct }}</span>
            <span hidden>{{ $transfer->btreValueratebase }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteTransfer-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $transfer->btreId }}</span>
            <span hidden>{{ $transfer->btreYear }}</span>
            <span hidden>{{ $transfer->munName }}</span>
            <span hidden>{{ $transfer->espTypology }}</span>
            <span hidden>{{ $transfer->strService }}</span>
            <span hidden>{{ $transfer->strAvailability }}</span>
            <span hidden>{{ $transfer->strDescription }}</span>
            <span hidden>{{ $transfer->ptrProduct }}</span>
            <span hidden>{{ $transfer->btreValueratebase }}</span>
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

<div class="modal fade" id="newTransfer-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVOS REGISTROS DE TRASLADO URBANO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('tariffs.transfer.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">AÑO:</small>
                    <select name="btreYear" class="form-control form-control-sm" required>
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
                    <select name="btreMunicipility_id" class="form-control form-control-sm" required>
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
                    <select name="btreTypevehicle_id" class="form-control form-control-sm" required>
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
                    <select name="btreTypeservice_id_new" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      @foreach($servicestransfer as $service)
                      <option value="{{ $service->strId }}" data-product='{{ $service->ptrProduct }}'>{{ $service->strService }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">PRODUCTO:</small>
                    <input type="text" name="btreProduct_new" class="form-control form-control-sm" readonly disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 p-3 text-center">
                  <button type="button" class="btn btn-outline-success form-control-sm mt-3 btn-addService-newTransfer" title='AGREGUE EL SERVICIO SELECCIONADO PARA ESPECIFICAR VALORES'>Agregar servicio</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 p-3 text-center">
                  <small class="infoRepeat" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table class="table text-center border-bottom tbl-service-newTransfer" width="100%" style="font-size: 12px;">
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

<div class="modal fade" id="editTransfer-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE VALORES, PORTAFOLIO DE TRASLADO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('tariffs.transfer.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row text-center border p-3">
                <div class="col-md-3">
                  <small class="text-muted">AÑO:</small>
                  <h3 class="text-muted"><b class="btreYear_Edit"></b></h3><br>
                  <input type="hidden" name="btreYear_Edit" class="form-control form-control-sm" readonly required>
                </div>
                <div class="col-md-4">
                  <small class="text-muted">CIUDAD:</small>
                  <h3 class="text-muted"><b class="btreCity_Edit"></b></h3><br>
                  <input type="hidden" name="btreCity_Edit" class="form-control form-control-sm" readonly required>
                </div>
                <div class="col-md-4">
                  <small class="text-muted">VEHICULO:</small>
                  <h3 class="text-muted"><b class="btreVehicle_Edit"></b></h3><br>
                  <input type="hidden" name="btreVehicle_Edit" class="form-control form-control-sm" readonly required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="font-size: 12px; text-align: center;">
                  <small class="text-muted">SERVICIO: </small>
                  <span class="text-muted"><b class="strService_Edit"></b></span><br>
                  <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small>
                  <span class="text-muted"><b class="strAvailability_Edit"></b></span><br>
                  <small class="text-muted">DESCRIPCION: </small><br>
                  <span class="text-muted"><b class="strDescription_Edit"></b></span><br>
                  <small class="text-muted">PRODUCTO: </small><br>
                  <span class="text-muted"><b class="ptrProduct_Edit"></b></span><br>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table class="table text-center border-bottom tbl-service-editTransfer" width="100%" style="font-size: 12px;">
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
                              <input type='text' name='btreValueratebase' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Tarifa base ($)' required>
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
              <input type="hidden" class="form-control form-control-sm" name="btreId_Edit" readonly required>
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

<div class="modal fade" id="deleteTransfer-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE REGISTRO, PORTAFOLIO DE TRASLADO:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <small class="text-muted">AÑO: </small><br>
            <span class="text-muted"><b class="btreYear_Delete"></b></span><br>
            <small class="text-muted">CIUDAD: </small><br>
            <span class="text-muted"><b class="btreCity_Delete"></b></span><br>
            <small class="text-muted">SERVICIO: </small><br>
            <span class="text-muted"><b class="strService_Delete"></b></span><br>
            <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
            <span class="text-muted"><b class="strAvailability_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION DEL SERVICIO: </small><br>
            <span class="text-muted"><b class="strDescription_Delete"></b></span><br>
            <small class="text-muted">PRODUCTO: </small><br>
            <span class="text-muted"><b class="ptrProduct_Delete"></b></span><br>
            <small class="text-muted">TARIFA BASE: </small><br>
            <span class="text-muted"><b class="btreValueratebase_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('tariffs.transfer.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="btreYear_Delete" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="btreCity_Delete" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="btreVehicle_Delete" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="btreId_Delete" readonly required>
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

  $('.newTransfer-link').on('click', function() {
    $('.tbl-service-newTransfer').find('tbody').empty();
    $('#newTransfer-modal').modal();
  });

  $('select[name=btreTypeservice_id_new]').on('click', function(e) {
    var selected = e.target.value;
    $('input[name=btreProduct_new]').val('');
    if (selected != '') {
      var product = $('select[name=btreTypeservice_id_new] option:selected').attr('data-product');
      $('input[name=btreProduct_new]').val(product);
    }
  });

  // BOTON PARA AGREGAR SERVICIOS A NUEVO REGISTRO
  $('.btn-addService-newTransfer').on('click', function() {
    var strId = $('select[name=btreTypeservice_id_new]').val();
    var strService = $('select[name=btreTypeservice_id_new] option:selected').text();
    var ptrProduct = $('input[name=btreProduct_new]').val();
    var validateRepet = false;
    $('.tbl-service-newTransfer').find('tbody').find('tr').each(function() {
      var idService = $(this).attr('class');
      if (idService == strId) {
        validateRepet = true;
      }
    });
    if (strId != '') {
      if (validateRepet == false) {
        $('.tbl-service-newTransfer').find('tbody').append(
          "<tr class='" + strId + "' data-idService='" + strId + "'>" +
          "<td>" + strService + "</td>" +
          "<td>" + ptrProduct + "</td>" +
          "<td>" +
          "<div class='form-group'>" +
          "<div class='input-group'>" +
          "<div class='input-group-prepend'>" +
          "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
          "</div>" +
          "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center btreValueratebase' title='Tarifa base ($)' required>" +
          "</div>" +
          "</div>" +
          "</td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteService-newTransfer' title='Eliminar servicio'><i class='fas fa-trash-alt'></i></button>" +
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
    $('.tbl-service-newTransfer').find('tbody').find('tr').each(function() {
      var idService = $(this).attr('data-idService');
      var valuebase = $(this).find('input.btreValueratebase').val();
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
  $('.tbl-service-newTransfer').on('click', '.btn-deleteService-newTransfer', function() {
    $(this).parents('tr').remove();
  });

  $('.editTransfer-link').on('click', function(e) {
    e.preventDefault();
    var btreId = $(this).find('span:nth-child(2)').text();
    var btreYear = $(this).find('span:nth-child(3)').text();
    var munName = $(this).find('span:nth-child(4)').text();
    var btreVehicle = $(this).find('span:nth-child(5)').text();
    var strService = $(this).find('span:nth-child(6)').text();
    var strAvailability = $(this).find('span:nth-child(7)').text();
    var strDescription = $(this).find('span:nth-child(8)').text();
    var ptrProduct = $(this).find('span:nth-child(9)').text();
    var btreValueratebase = $(this).find('span:nth-child(10)').text();
    $('input[name=btreId_Edit]').val(btreId);
    $('b.btreYear_Edit').text(btreYear);
    $('input[name=btreYear_Edit]').val(btreYear);
    $('b.btreCity_Edit').text(munName);
    $('input[name=btreCity_Edit]').val(munName);
    $('b.btreVehicle_Edit').text(btreVehicle);
    $('input[name=btreVehicle_Edit]').val(btreVehicle);
    $('.strService_Edit').text(strService);
    $('.strAvailability_Edit').text(strAvailability);
    $('.strDescription_Edit').text(strDescription);
    $('.ptrProduct_Edit').text(ptrProduct);
    $('.tbl-service-editTransfer').find('input[name=btreValueratebase]').val(btreValueratebase);
    $('#editTransfer-modal').modal();
  });

  $('.deleteTransfer-link').on('click', function(e) {
    e.preventDefault();
    var btreId = $(this).find('span:nth-child(2)').text();
    var btreYear = $(this).find('span:nth-child(3)').text();
    var munName = $(this).find('span:nth-child(4)').text();
    var btreVehicle = $(this).find('span:nth-child(5)').text();
    var strService = $(this).find('span:nth-child(6)').text();
    var strAvailability = $(this).find('span:nth-child(7)').text();
    var strDescription = $(this).find('span:nth-child(8)').text();
    var ptrProduct = $(this).find('span:nth-child(9)').text();
    var btreValueratebase = $(this).find('span:nth-child(10)').text();
    $('input[name=btreId_Delete]').val(btreId);
    $('b.btreYear_Delete').text(btreYear);
    $('input[name=btreYear_Delete]').val(btreYear);
    $('b.btreCity_Delete').text(munName);
    $('input[name=btreCity_Delete]').val(munName);
    $('b.btreVehicle_Delete').text(btreVehicle);
    $('input[name=btreVehicle_Delete]').val(btreVehicle);
    $('.strService_Delete').text(strService);
    $('.strAvailability_Delete').text(strAvailability);
    $('.strDescription_Delete').text(strDescription);
    $('.ptrProduct_Delete').text(ptrProduct);
    $('.btreValueratebase_Delete').text('$' + btreValueratebase);
    $('#deleteTransfer-modal').modal();
  });
</script>
@endsection