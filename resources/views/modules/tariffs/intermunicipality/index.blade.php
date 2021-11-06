@extends('modules.comercialTariffs')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>TRASLADO INTERMUNICIPAL</h6>
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
        <th>VEHICULO</th>
        <th>TIPO DE SERVICIO</th>
        <th>TIPO DE PRODUCTO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($briefcases as $transfer)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $transfer->btriYear }}</td>
        <td>{{ $transfer->espTypology }}</td>
        <td>{{ $transfer->stmService }}</td>
        <td>{{ $transfer->ptmProduct }}</td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editTransfer-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $transfer->btriId }}</span>
            <span hidden>{{ $transfer->btriYear }}</span>
            <span hidden>{{ $transfer->espTypology }}</span>
            <span hidden>{{ $transfer->stmService }}</span>
            <span hidden>{{ $transfer->ptmProduct }}</span>
            <span hidden>{{ $transfer->stmTimeavailability }}</span>
            <span hidden>{{ $transfer->stmKilometres }}</span>
            <span hidden>{{ $transfer->btriValuebase }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteTransfer-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $transfer->btriId }}</span>
            <span hidden>{{ $transfer->btriYear }}</span>
            <span hidden>{{ $transfer->espTypology }}</span>
            <span hidden>{{ $transfer->stmService }}</span>
            <span hidden>{{ $transfer->ptmProduct }}</span>
            <span hidden>{{ $transfer->stmTimeavailability }}</span>
            <span hidden>{{ $transfer->stmKilometres }}</span>
            <span hidden>{{ $transfer->btriValuebase }}</span>
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
        <h6>NUEVOS REGISTROS DE TRASLADO INTERMUNICIPAL:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('tariffs.transferintermunipality.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">AÑO:</small>
                    <select name="btriYear" class="form-control form-control-sm" required>
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
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">VEHICULO:</small>
                    <select name="btriTypevehicle_id" class="form-control form-control-sm" required>
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
                    <select name="btriTypeservice_id_new" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      @foreach($servicesmunicipalitys as $service)
                      <option value="{{ $service->stmId }}" data-timeavailability='{{ $service->stmTimeavailability }}' data-kilometres='{{ $service->stmKilometres }}' data-product='{{ $service->ptmProduct }}'>{{ $service->stmService }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">PRODUCTO:</small>
                    <input type="text" name="btriProduct_new" class="form-control form-control-sm" readonly disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                    <input type="text" name="btriTime_new" class="form-control form-control-sm" readonly disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">KILOMETROS DE RECORRIDO:</small>
                    <input type="text" name="btriKilometres_new" class="form-control form-control-sm" readonly disabled>
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
                      <th>TIEMPO DE DISPONIBILIDAD</th>
                      <th>KILOMETROS DE RECORRIDO</th>
                      <th>TARIFA BASE</th>
                      <th></th>
                    </thead>
                    <tbody>
                      <!-- Dinamics row -->
                      <!-- stmId, stmService, ptmProduct, stmTimeavailability, stmKilometres, btriValuebase -->
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
        <form action="{{ route('tariffs.transferintermunipality.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row text-center border p-3">
                <div class="col-md-6">
                  <small class="text-muted">AÑO:</small>
                  <h3 class="text-muted"><b class="btriYear_Edit"></b></h3><br>
                  <input type="hidden" name="btriYear_Edit" class="form-control form-control-sm" readonly required>
                </div>
                <div class="col-md-6">
                  <small class="text-muted">VEHICULO:</small>
                  <h3 class="text-muted"><b class="btriVehicle_Edit"></b></h3><br>
                  <input type="hidden" name="btriVehicle_Edit" class="form-control form-control-sm" readonly required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="font-size: 12px; text-align: center;">
                  <small class="text-muted">SERVICIO: </small><br>
                  <span class="text-muted"><b class="stmService_Edit"></b></span><br>
                  <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
                  <span class="text-muted"><b class="stmTimeavailability_Edit"></b></span><br>
                  <small class="text-muted">KILOMETROS DE RECORRIDO: </small><br>
                  <span class="text-muted"><b class="stmKilometres_Edit"></b></span><br>
                  <small class="text-muted">PRODUCTO: </small><br>
                  <span class="text-muted"><b class="stmProduct_Edit"></b></span><br>
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
                              <input type='text' name='btriValuebase' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center' title='Tarifa base ($)' required>
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
              <input type="hidden" class="form-control form-control-sm" name="btriId_Edit" readonly required>
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
            <span class="text-muted"><b class="btriYear_Delete"></b></span><br>
            <small class="text-muted">TIPO DE VEHICULO: </small><br>
            <span class="text-muted"><b class="btriVehicle_Delete"></b></span><br>
            <small class="text-muted">TIPO DE SERVICIO: </small><br>
            <span class="text-muted"><b class="stmService_Delete"></b></span><br>
            <small class="text-muted">TIPO DE PRODUCTO: </small><br>
            <span class="text-muted"><b class="stmProduct_Delete"></b></span><br>
            <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
            <span class="text-muted"><b class="btriTime_Delete"></b></span><br>
            <small class="text-muted">KILOMETROS DE RECORRIDO: </small><br>
            <span class="text-muted"><b class="btriKilometres_Delete"></b></span><br>
            <small class="text-muted">TARIFA BASE: </small><br>
            <span class="text-muted"><b class="btriValuebase_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('tariffs.transferintermunipality.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="btriYear_Delete" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="btriVehicle_Delete" readonly required>
            <input type="hidden" class="form-control form-control-sm" name="btriId_Delete" readonly required>
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

  $('select[name=btriTypeservice_id_new]').on('click', function(e) {
    var selected = e.target.value;
    $('input[name=btriProduct_new]').val('');
    $('input[name=btriTime_new]').val('');
    $('input[name=btriKilometres_new]').val('');
    if (selected != '') {
      var product = $('select[name=btriTypeservice_id_new] option:selected').attr('data-product');
      var time = $('select[name=btriTypeservice_id_new] option:selected').attr('data-timeavailability');
      var kilometres = $('select[name=btriTypeservice_id_new] option:selected').attr('data-kilometres');
      $('input[name=btriProduct_new]').val(product);
      $('input[name=btriTime_new]').val(time);
      $('input[name=btriKilometres_new]').val(kilometres);
    }
  });

  // BOTON PARA AGREGAR SERVICIOS A NUEVO REGISTRO
  $('.btn-addService-newTransfer').on('click', function() {
    var stmId = $('select[name=btriTypeservice_id_new]').val();
    var stmService = $('select[name=btriTypeservice_id_new] option:selected').text();
    var ptmProduct = $('input[name=btriProduct_new]').val();
    var stmTimeavailability = $('input[name=btriTime_new]').val();
    var stmKilometres = $('input[name=btriKilometres_new]').val();
    var validateRepet = false;
    $('.tbl-service-newTransfer').find('tbody').find('tr').each(function() {
      var idService = $(this).attr('class');
      if (idService == stmId) {
        validateRepet = true;
      }
    });
    if (stmId != '') {
      if (validateRepet == false) {
        $('.tbl-service-newTransfer').find('tbody').append(
          "<tr class='" + stmId + "' data-idService='" + stmId + "'>" +
          "<td>" + stmService + "</td>" +
          "<td>" + ptmProduct + "</td>" +
          "<td>" + stmTimeavailability + "</td>" +
          "<td>" + stmKilometres + "</td>" +
          "<td>" +
          "<div class='form-group'>" +
          "<div class='input-group'>" +
          "<div class='input-group-prepend'>" +
          "<span class='input-group-text'><i class='fas fa-dollar-sign'></i></span>" +
          "</div>" +
          "<input type='text' pattern='[0-9]{1,10}' class='form-control form-control-sm text-center btriValuebase' title='Tarifa base ($)' required>" +
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
      var valuebase = $(this).find('input.btriValuebase').val();
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
    var btriId = $(this).find('span:nth-child(2)').text();
    var btriYear = $(this).find('span:nth-child(3)').text();
    var btriVehicle = $(this).find('span:nth-child(4)').text();
    var stmService = $(this).find('span:nth-child(5)').text();
    var stmProduct = $(this).find('span:nth-child(6)').text();
    var stmTime = $(this).find('span:nth-child(7)').text();
    var stmKilometres = $(this).find('span:nth-child(8)').text();
    var btriValuebase = $(this).find('span:nth-child(9)').text();
    $('input[name=btriId_Edit]').val(btriId);
    $('b.btriYear_Edit').text(btriYear);
    $('input[name=btriYear_Edit]').val(btriYear);
    $('b.btriVehicle_Edit').text(btriVehicle);
    $('input[name=btriVehicle_Edit]').val(btriVehicle);
    $('.stmService_Edit').text(stmService);
    $('.stmProduct_Edit').text(stmProduct);
    $('.stmTimeavailability_Edit').text(stmTime);
    $('.stmKilometres_Edit').text(stmKilometres);
    $('.tbl-service-editTransfer').find('input[name=btriValuebase]').val(btriValuebase);
    $('#editTransfer-modal').modal();
  });

  $('.deleteTransfer-link').on('click', function(e) {
    e.preventDefault();
    var btriId = $(this).find('span:nth-child(2)').text();
    var btriYear = $(this).find('span:nth-child(3)').text();
    var btriVehicle = $(this).find('span:nth-child(4)').text();
    var stmService = $(this).find('span:nth-child(5)').text();
    var stmProduct = $(this).find('span:nth-child(6)').text();
    var stmTime = $(this).find('span:nth-child(7)').text();
    var stmKilometres = $(this).find('span:nth-child(8)').text();
    var btriValuebase = $(this).find('span:nth-child(9)').text();
    $('input[name=btriId_Delete]').val(btriId);
    $('b.btriYear_Delete').text(btriYear);
    $('input[name=btriYear_Delete]').val(btriYear);
    $('b.btriVehicle_Delete').text(btriVehicle);
    $('input[name=btriVehicle_Delete]').val(btriVehicle);
    $('.stmService_Delete').text(stmService);
    $('.stmProduct_Delete').text(stmProduct);
    $('.btriTime_Delete').text(stmTime + ' HORAS');
    $('.btriKilometres_Delete').text(stmKilometres + ' KILOMETROS');
    $('.btriValuebase_Delete').text('$' + btriValuebase);
    $('#deleteTransfer-modal').modal();
  });
</script>
@endsection