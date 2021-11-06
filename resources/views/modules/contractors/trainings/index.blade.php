@extends('modules.logisticContractors')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-6">
      <h6>CONTROL DE ASISTENCIA A CAPACITACIONES</h6>
    </div>
    <div class="col-md-2">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newTraining-link">NUEVO</button>
    </div>
    <div class="col-md-4" style="font-size: 12px;">
      @if(session('SuccessTraining'))
      <div class="alert alert-success">
        {{ session('SuccessTraining') }}
      </div>
      @endif
      @if(session('PrimaryTraining'))
      <div class="alert alert-primary">
        {{ session('PrimaryTraining') }}
      </div>
      @endif
      @if(session('WarningTraining'))
      <div class="alert alert-warning">
        {{ session('WarningTraining') }}
      </div>
      @endif
      @if(session('SecondaryTraining'))
      <div class="alert alert-secondary">
        {{ session('SecondaryTraining') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>CODIGO DE REGISTRO</th>
        <th>CAPACITACION</th>
        <th>CAPACITADOR</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($trainings as $training)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $training->trcDate }}</td>
        <td>{{ $training->trcDocumentcode }}</td>
        <td>{{ $training->trcNametraining }}</td>
        <td>{{ $training->trcNametrainer }}</td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="EDITAR" class="btn btn-outline-primary rounded-circle form-control-sm editTraining-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $training->trcId }}</span>
            <span hidden>{{ $training->trcDate }}</span>
            <span hidden>{{ $training->trcDocument_id }}</span>
            <span hidden>{{ $training->document->dolVersion }}</span>
            <span hidden>{{ $training->trcDocumentcode }}</span>
            <span hidden>{{ $training->trcNametraining }}</span>
            <span hidden>{{ $training->trcNametrainer }}</span>
            <span hidden>{{ $training->trcLegalizations }}</span>
          </a>
          <a href="#" title="ELIMINAR" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteTraining-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $training->trcId }}</span>
            <span hidden>{{ $training->trcDate }}</span>
            <span hidden>{{ $training->trcDocumentcode }}</span>
            <span hidden>{{ $training->trcNametraining }}</span>
            <span hidden>{{ $training->trcNametrainer }}</span>
          </a>
          <form action="{{ route('contractors.training.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="trcId" value="{{ $training->trcId }}" class="form-control form-control-sm" required>
            <button type="submit" title="DESCARGAR PDF" class="btn btn-outline-danger rounded-circle form-control-sm">
              <i class="fas fa-file-pdf"></i>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newTraining-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVO REGISTRO DE ASISTENCIA A CAPACITACION:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractors.training.save') }}" method="POST" autocomplete="off">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="trcDate" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAPACITACION:</small>
                    <input type="text" name="trcNametraining" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DE CAPACITADOR:</small>
                    <input type="text" name="trcNametrainer" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="trcDocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dolVersion" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode" class="form-control form-control-sm text-center" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <small class="text-muted">CONTRATISTAS:</small>
                    <select name="trcLegalization_id" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      @for($i = 0; $i < count($contractors); $i++) <option value="{{ $contractors[$i][0] }}" data-type="{{ $contractors[$i][1] }}" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
                        @endfor
                    </select>
                  </div>
                </div>
                <div class="col-md-4 text-center">
                  <button type="button" class="btn btn-outline-success form-control-sm mt-3 btn-addLegalization-newTraining" title='AGREGAR ASISTENTE'>Agregar asistente</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 p-3 text-center">
                  <small class="infoRepeat" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
                </div>
              </div>
              <div class="row border m-3 p-3">
                <table class="table table-striped text-center tbl-legalizations-newTraining" width="100%" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <td>TIPO DE CONTRATISTA</td>
                      <td>CONTRATISTA</td>
                      <td>DOCUMENTO</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- tr dinamics -->
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-12 p-3 text-center">
                  <small class="infoRepeat" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="allLegalizations" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm btn-saveDefinitive">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editTraining-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE ASISTENCIA A CAPACITACION:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractors.training.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="trcDate_Edit" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAPACITACION:</small>
                    <input type="text" name="trcNametraining_Edit" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DE CAPACITADOR:</small>
                    <input type="text" name="trcNametrainer_Edit" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="trcDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="trcDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dolVersion_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode_Edit" class="form-control form-control-sm text-center" readonly>
                    <input type="hidden" name="dolCode_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <small class="text-muted">CONTRATISTAS:</small>
                    <select name="trcLegalization_id_Edit" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      @for($i = 0; $i < count($contractors); $i++) <option value="{{ $contractors[$i][0] }}" data-type="{{ $contractors[$i][1] }}" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
                        @endfor
                    </select>
                  </div>
                </div>
                <div class="col-md-4 text-center">
                  <button type="button" class="btn btn-outline-success form-control-sm mt-3 btn-addLegalization-updateTraining" title='AGREGAR ASISTENTE'>Agregar asistente</button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 p-3 text-center">
                  <small class="infoRepeat_Edit" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
                </div>
              </div>
              <div class="row border m-3 p-3">
                <table class="table table-striped text-center tbl-legalizations-updateTraining" width="100%" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <td>TIPO DE CONTRATISTA</td>
                      <td>CONTRATISTA</td>
                      <td>DOCUMENTO</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- tr dinamics -->
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-12 p-3 text-center">
                  <small class="infoRepeat_Edit" style="display: none; transition: all .2s; color: red; font-size: 14px;"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="allLegalizations_Edit" class="form-control form-control-sm" required>
            <input type="hidden" name="trcId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-primary form-control-sm btn-updateDefinitive">ACTUALIZAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteTraining-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE ASISTENCIA A CAPACITACION:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <small class="text-muted">FECHA DE CAPACITACION: </small><br>
            <span class="text-muted"><b class="trcDate_Delete"></b></span><br>
            <small class="text-muted">CODIGO DE CAPACITACION: </small><br>
            <span class="text-muted"><b class="trcDocumentcode_Delete"></b></span><br>
            <small class="text-muted">CAPACITACION: </small><br>
            <span class="text-muted"><b class="trcNametraining_Delete"></b></span><br>
            <small class="text-muted">CAPACITADOR: </small><br>
            <span class="text-muted"><b class="trcNametrainer_Delete"></b></span><br>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12 text-center">
                <p class="text-muted">ASISTENTES</p>
              </div>
            </div>
            <table class="table table-striped text-center tbl-contractors-Delete" width="100%" style="font-size: 12px;">
              <thead>
                <tr>
                  <th>CONTRATISTA</th>
                </tr>
              </thead>
              <tbody>
                <!-- tr dinamics -->
              </tbody>
            </table>
          </div>
        </div>
        <form action="{{ route('contractors.training.delete') }}" method="POST">
          @csrf
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="trcId_Delete" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-tertiary form-control-sm">ELIMINAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(function() {

  });

  $('.newTraining-link').on('click', function(e) {
    e.preventDefault();
    $('#newTraining-modal').modal();
  });

  $('select[name=trcDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode]').val('');
    $('input[name=dolVersion]').val('');
    if (selected != '') {
      var code = $('select[name=trcDocument_id] option:selected').attr('data-code');
      var version = $('select[name=trcDocument_id] option:selected').attr('data-version');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForTrainingcontractor') }}", {
        dolId: selected
      }, function(objectsNext) {
        if (objectsNext != null) {
          $('input[name=dolCode]').val(objectsNext);
        } else {
          $('input[name=dolCode]').val('');
        }
      });
    }
  });

  $('.btn-addLegalization-newTraining').on('click', function() {
    var bcId = $('select[name=trcLegalization_id]').val();
    var validateRepet = false;
    $('.tbl-legalizations-newTraining').find('tbody').find('tr').each(function() {
      var idBill = $(this).attr('class');
      if (idBill == bcId) {
        validateRepet = true;
      }
    });
    if (bcId != '') {
      if (validateRepet == false) {
        var type = $('select[name=trcLegalization_id] option:selected').attr('data-type');
        var names = $('select[name=trcLegalization_id] option:selected').attr('data-names');
        var number = $('select[name=trcLegalization_id] option:selected').attr('data-document');
        $('.tbl-legalizations-newTraining').find('tbody').append(
          "<tr class='" + bcId + "' data-idLegalization='" + bcId + "'>" +
          "<td>" + type + "</td>" +
          "<td>" + names + "</td>" +
          "<td>" + number + "</td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteLegalization-newTraining' title='ELIMINAR ASISTENTE'><i class='fas fa-trash-alt'></i></button>" +
          "</td>" +
          "</tr>"
        );
      } else {
        $('.infoRepeat').css('display', 'block');
        $('.infoRepeat').text('Contratista seleccionado ya está en la lista de asistentes');
        setTimeout(function() {
          $('.infoRepeat').css('display', 'none');
          $('.infoRepeat').text('');
        }, 3000);
      }
    } else {
      $('.infoRepeat').css('display', 'block');
      $('.infoRepeat').text('Ningun contratista seleccionado');
      setTimeout(function() {
        $('.infoRepeat').css('display', 'none');
        $('.infoRepeat').text('');
      }, 3000);
    }
  });

  $('.btn-saveDefinitive').on('click', function(e) {
    // e.preventDefault();
    var allLegalizations = '';
    $('input[name=allLegalizations]').val('');
    $('.tbl-legalizations-newTraining').find('tbody').find('tr').each(function() {
      var bcId = $(this).attr('data-idLegalization');
      allLegalizations += bcId + '=';
    });
    $('input[name=allLegalizations]').val(allLegalizations);
    if (allLegalizations != '' && allLegalizations != null) {
      $(this).submit();
    } else {
      e.preventDefault();
      $('.infoRepeat').css('display', 'block');
      $('.infoRepeat').text('Seleccione al menos 1 contratista');
      setTimeout(function() {
        $('.infoRepeat').css('display', 'none');
        $('.infoRepeat').text('');
      }, 3000);
    }
  });

  // BOTON DE TABLA DE ASISTENTES PARA ELIMINAR FILA CLIKEADA
  $('.tbl-legalizations-newTraining').on('click', '.btn-deleteLegalization-newTraining', function() {
    $(this).parents('tr').remove();
  });

  $('.editTraining-link').on('click', function(e) {
    e.preventDefault();
    var trcId = $(this).find('span:nth-child(2)').text();
    var trcDate = $(this).find('span:nth-child(3)').text();
    var trcDocument_id = $(this).find('span:nth-child(4)').text();
    var version = $(this).find('span:nth-child(5)').text();
    var trcDocumentcode = $(this).find('span:nth-child(6)').text();
    var trcNametraining = $(this).find('span:nth-child(7)').text();
    var trcNametrainer = $(this).find('span:nth-child(8)').text();
    var trcLegalizations = $(this).find('span:nth-child(9)').text();
    $('input[name=trcId_Edit]').val(trcId);
    $('input[name=trcDate_Edit]').val(trcDate);
    $('input[name=trcNametraining_Edit]').val(trcNametraining);
    $('input[name=trcNametrainer_Edit]').val(trcNametrainer);
    $('select[name=trcDocument_id_Edit]').val(trcDocument_id);
    $('input[name=trcDocument_id_hidden_Edit]').val(trcDocument_id);
    $('input[name=dolCode_Edit]').val(trcDocumentcode);
    $('input[name=dolCode_hidden_Edit]').val(trcDocumentcode);
    $('input[name=dolVersion_Edit]').val(version);
    $('.tbl-legalizations-updateTraining tbody').empty();
    $.get("{{ route('getLegalizationFromTrainingcontractor') }}", {
      trcId: trcId
    }, function(objectsLegalizations) {
      var count = Object.keys(objectsLegalizations).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          $('.tbl-legalizations-updateTraining').find('tbody').append(
            "<tr class='" + objectsLegalizations[i][0] + "' data-idLegalization='" + objectsLegalizations[i][0] + "'>" +
            "<td>" + objectsLegalizations[i][1] + "</td>" +
            "<td>" + objectsLegalizations[i][2] + "</td>" +
            "<td>" + objectsLegalizations[i][3] + "</td>" +
            "<td>" +
            "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteLegalization-updateTraining' title='ELIMINAR ASISTENTE'><i class='fas fa-trash-alt'></i></button>" +
            "</td>" +
            "</tr>"
          );
        }
      }
    });
    $('input[name=allLegalizations_Edit]').val(trcLegalizations + '=');
    $('#editTraining-modal').modal();
  });

  $('select[name=trcDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode_Edit]').val('');
    $('input[name=dolVersion_Edit]').val('');
    if (selected != '') {
      var oldId = $('input[name=trcDocument_id_hidden_Edit]').val();
      var code = $('select[name=trcDocument_id_Edit] option:selected').attr('data-code');
      var version = $('select[name=trcDocument_id_Edit] option:selected').attr('data-version');
      $('input[name=dolVersion_Edit]').val(version);
      if (oldId != selected) {
        $.get("{{ route('getNextcodeForTrainingcontractor') }}", {
          dolId: selected
        }, function(objectsNext) {
          if (objectsNext != null) {
            $('input[name=dolCode_Edit]').val(objectsNext);
          } else {
            $('input[name=dolCode_Edit]').val('');
          }
        });
      } else {
        var oldCode = $('input[name=dolCode_hidden_Edit]').val();
        $('input[name=dolCode_Edit]').val(oldCode);
      }
    }
  });

  $('.btn-addLegalization-updateTraining').on('click', function() {
    var trcId = $('select[name=trcLegalization_id_Edit]').val();
    var validateRepet = false;
    $('.tbl-legalizations-updateTraining').find('tbody').find('tr').each(function() {
      var idBill = $(this).attr('class');
      if (idBill == trcId) {
        validateRepet = true;
      }
    });
    if (trcId != '') {
      if (validateRepet == false) {
        var type = $('select[name=trcLegalization_id_Edit] option:selected').attr('data-type');
        var names = $('select[name=trcLegalization_id_Edit] option:selected').attr('data-names');
        var number = $('select[name=trcLegalization_id_Edit] option:selected').attr('data-document');
        $('.tbl-legalizations-updateTraining').find('tbody').append(
          "<tr class='" + trcId + "' data-idLegalization='" + trcId + "'>" +
          "<td>" + type + "</td>" +
          "<td>" + names + "</td>" +
          "<td>" + number + "</td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteLegalization-updateTraining' title='ELIMINAR ASISTENTE'><i class='fas fa-trash-alt'></i></button>" +
          "</td>" +
          "</tr>"
        );
      } else {
        $('.infoRepeat_Edit').css('display', 'block');
        $('.infoRepeat_Edit').text('Contratista seleccionado ya está en la lista de asistentes');
        setTimeout(function() {
          $('.infoRepeat_Edit').css('display', 'none');
          $('.infoRepeat_Edit').text('');
        }, 3000);
      }
    } else {
      $('.infoRepeat_Edit').css('display', 'block');
      $('.infoRepeat_Edit').text('Ningun Contratista seleccionado');
      setTimeout(function() {
        $('.infoRepeat_Edit').css('display', 'none');
        $('.infoRepeat_Edit').text('');
      }, 3000);
    }
  });

  $('.btn-updateDefinitive').on('click', function(e) {
    // e.preventDefault();
    var allLegalizations = '';
    $('input[name=allLegalizations_Edit]').val('');
    $('.tbl-legalizations-updateTraining').find('tbody').find('tr').each(function() {
      var trcId = $(this).attr('data-idLegalization');
      allLegalizations += trcId + '=';
    });
    $('input[name=allLegalizations_Edit]').val(allLegalizations);
    if (allLegalizations != '' && allLegalizations != null) {
      $(this).submit();
    } else {
      e.preventDefault();
      $('.infoRepeat_Edit').css('display', 'block');
      $('.infoRepeat_Edit').text('Seleccione al menos 1 contratista');
      setTimeout(function() {
        $('.infoRepeat_Edit').css('display', 'none');
        $('.infoRepeat_Edit').text('');
      }, 3000);
    }
  });

  // BOTON DE TABLA DE ASISTENTES PARA ELIMINAR FILA CLIKEADA
  $('.tbl-legalizations-updateTraining').on('click', '.btn-deleteLegalization-updateTraining', function() {
    $(this).parents('tr').remove();
  });

  $('.deleteTraining-link').on('click', function(e) {
    e.preventDefault();
    var trcId = $(this).find('span:nth-child(2)').text();
    var trcDate = $(this).find('span:nth-child(3)').text();
    var trcDocumentcode = $(this).find('span:nth-child(4)').text();
    var trcNametraining = $(this).find('span:nth-child(5)').text();
    var trcNametrainer = $(this).find('span:nth-child(6)').text();
    $('input[name=trcId_Delete]').val(trcId);
    $('.trcDate_Delete').text(trcDate);
    $('.trcDocumentcode_Delete').text(trcDocumentcode);
    $('.trcNametraining_Delete').text(trcNametraining);
    $('.trcNametrainer_Delete').text(trcNametrainer);
    $('.tbl-contractors-Delete tbody').empty();
    $.get("{{ route('getLegalizationFromTrainingcontractor') }}", {
      trcId: trcId
    }, function(objectsLegalizations) {
      var count = Object.keys(objectsLegalizations).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          $('.tbl-contractors-Delete tbody').append(
            "<tr>" +
            "<td>" +
            objectsLegalizations[i][1] + "/" + objectsLegalizations[i][2] +
            "</td>" +
            "</tr>"
          );
        }
      }
    });
    $('#deleteTraining-modal').modal();
  });
</script>
@endsection