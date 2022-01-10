@extends('modules.logisticCollaborators')

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
        <td>{{ $training->tcoDate }}</td>
        <td>{{ $training->tcoDocumentcode }}</td>
        <td>{{ $training->tcoNametraining }}</td>
        <td>{{ $training->tcoNametrainer }}</td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="EDITAR" class="btn btn-outline-primary rounded-circle form-control-sm editTraining-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $training->tcoId }}</span>
            <span hidden>{{ $training->tcoDate }}</span>
            <span hidden>{{ $training->tcoDocument_id }}</span>
            <span hidden>{{ $training->document->dolVersion }}</span>
            <span hidden>{{ $training->tcoDocumentcode }}</span>
            <span hidden>{{ $training->tcoNametraining }}</span>
            <span hidden>{{ $training->tcoNametrainer }}</span>
            <span hidden>{{ $training->tcoLegalizations }}</span>
          </a>
          <a href="#" title="ELIMINAR" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteTraining-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $training->tcoId }}</span>
            <span hidden>{{ $training->tcoDate }}</span>
            <span hidden>{{ $training->tcoDocumentcode }}</span>
            <span hidden>{{ $training->tcoNametraining }}</span>
            <span hidden>{{ $training->tcoNametrainer }}</span>
          </a>
          <form action="{{ route('collaborators.training.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="tcoId" value="{{ $training->tcoId }}" class="form-control form-control-sm" required>
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
        <form action="{{ route('collaborators.training.save') }}" method="POST" autocomplete="off">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="tcoDate" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAPACITACION:</small>
                    <input type="text" name="tcoNametraining" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DE CAPACITADOR:</small>
                    <input type="text" name="tcoNametrainer" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="tcoDocument_id" class="form-control form-control-sm" required>
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
                    <small class="text-muted">COLABORADORES:</small>
                    <select name="tcoLegalization_id" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      @foreach($legalizations as $legalization)
                      <option value="{{ $legalization->bcoId }}" data-names='{{ $legalization->coNames }}' data-document='{{ $legalization->coNumberdocument }}' data-position='{{ $legalization->coPosition }}' data-email='{{ $legalization->coEmail }}'>
                        {{ $legalization->coNames }}
                      </option>
                      @endforeach
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
                <table class="table table-hover text-center tbl-legalizations-newTraining" width="100%" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <td>COLABORADOR</td>
                      <td>DOCUMENTO</td>
                      <td>CARGO</td>
                      <td>CORREO</td>
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
        <form action="{{ route('collaborators.training.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="tcoDate_Edit" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAPACITACION:</small>
                    <input type="text" name="tcoNametraining_Edit" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DE CAPACITADOR:</small>
                    <input type="text" name="tcoNametrainer_Edit" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="tcoDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="tcoDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
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
                    <small class="text-muted">COLABORADORES:</small>
                    <select name="tcoLegalization_id_Edit" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      @foreach($legalizations as $legalization)
                      <option value="{{ $legalization->bcoId }}" data-names='{{ $legalization->coNames }}' data-document='{{ $legalization->coNumberdocument }}' data-position='{{ $legalization->coPosition }}' data-email='{{ $legalization->coEmail }}'>
                        {{ $legalization->coNames }}
                      </option>
                      @endforeach
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
                <table class="table table-hover text-center tbl-legalizations-updateTraining" width="100%" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <td>COLABORADOR</td>
                      <td>DOCUMENTO</td>
                      <td>CARGO</td>
                      <td>CORREO</td>
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
            <input type="hidden" name="tcoId_Edit" class="form-control form-control-sm" required>
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
            <span class="text-muted"><b class="tcoDate_Delete"></b></span><br>
            <small class="text-muted">CODIGO DE CAPACITACION: </small><br>
            <span class="text-muted"><b class="tcoDocumentcode_Delete"></b></span><br>
            <small class="text-muted">CAPACITACION: </small><br>
            <span class="text-muted"><b class="tcoNametraining_Delete"></b></span><br>
            <small class="text-muted">CAPACITADOR: </small><br>
            <span class="text-muted"><b class="tcoNametrainer_Delete"></b></span><br>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12 text-center">
                <p class="text-muted">ASISTENTES</p>
              </div>
            </div>
            <table class="table table-hover text-center tbl-collaborators-Delete" width="100%" style="font-size: 12px;">
              <thead>
                <tr>
                  <th>COLABORADOR/CARGO</th>
                </tr>
              </thead>
              <tbody>
                <!-- tr dinamics -->
              </tbody>
            </table>
          </div>
        </div>
        <form action="{{ route('collaborators.training.delete') }}" method="POST">
          @csrf
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="tcoId_Delete" class="form-control form-control-sm" required>
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

  $('select[name=tcoDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode]').val('');
    $('input[name=dolVersion]').val('');
    if (selected != '') {
      var code = $('select[name=tcoDocument_id] option:selected').attr('data-code');
      var version = $('select[name=tcoDocument_id] option:selected').attr('data-version');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForTraining') }}", {
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
    var bcoId = $('select[name=tcoLegalization_id]').val();
    var validateRepet = false;
    $('.tbl-legalizations-newTraining').find('tbody').find('tr').each(function() {
      var idBill = $(this).attr('class');
      if (idBill == bcoId) {
        validateRepet = true;
      }
    });
    if (bcoId != '') {
      if (validateRepet == false) {
        var names = $('select[name=tcoLegalization_id] option:selected').attr('data-names');
        var number = $('select[name=tcoLegalization_id] option:selected').attr('data-document');
        var position = $('select[name=tcoLegalization_id] option:selected').attr('data-position');
        var email = $('select[name=tcoLegalization_id] option:selected').attr('data-email');
        $('.tbl-legalizations-newTraining').find('tbody').append(
          "<tr class='" + bcoId + "' data-idLegalization='" + bcoId + "'>" +
          "<td>" + names + "</td>" +
          "<td>" + number + "</td>" +
          "<td>" + position + "</td>" +
          "<td>" + email + "</td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteLegalization-newTraining' title='ELIMINAR ASISTENTE'><i class='fas fa-trash-alt'></i></button>" +
          "</td>" +
          "</tr>"
        );
      } else {
        $('.infoRepeat').css('display', 'block');
        $('.infoRepeat').text('Colaborador seleccionado ya está en la lista de asistentes');
        setTimeout(function() {
          $('.infoRepeat').css('display', 'none');
          $('.infoRepeat').text('');
        }, 3000);
      }
    } else {
      $('.infoRepeat').css('display', 'block');
      $('.infoRepeat').text('No hay seleccionado ningun colaborador');
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
      var bcoId = $(this).attr('data-idLegalization');
      var name = $(this).find('td:nth-child(1)').text();
      var number = $(this).find('td:nth-child(2)').text();
      var position = $(this).find('td:nth-child(3)').text();
      var email = $(this).find('td:nth-child(4)').text();
      allLegalizations += bcoId + '=';
    });
    $('input[name=allLegalizations]').val(allLegalizations);
    if (allLegalizations != '' && allLegalizations != null) {
      $(this).submit();
    } else {
      e.preventDefault();
      $('.infoRepeat').css('display', 'block');
      $('.infoRepeat').text('Seleccione al menos 1 colaborador');
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
    var tcoId = $(this).find('span:nth-child(2)').text();
    var tcoDate = $(this).find('span:nth-child(3)').text();
    var tcoDocument_id = $(this).find('span:nth-child(4)').text();
    var version = $(this).find('span:nth-child(5)').text();
    var tcoDocumentcode = $(this).find('span:nth-child(6)').text();
    var tcoNametraining = $(this).find('span:nth-child(7)').text();
    var tcoNametrainer = $(this).find('span:nth-child(8)').text();
    var tcoLegalizations = $(this).find('span:nth-child(9)').text();
    $('input[name=tcoId_Edit]').val(tcoId);
    $('input[name=tcoDate_Edit]').val(tcoDate);
    $('input[name=tcoNametraining_Edit]').val(tcoNametraining);
    $('input[name=tcoNametrainer_Edit]').val(tcoNametrainer);
    $('select[name=tcoDocument_id_Edit]').val(tcoDocument_id);
    $('input[name=tcoDocument_id_hidden_Edit]').val(tcoDocument_id);
    $('input[name=dolCode_Edit]').val(tcoDocumentcode);
    $('input[name=dolCode_hidden_Edit]').val(tcoDocumentcode);
    $('input[name=dolVersion_Edit]').val(version);
    $('.tbl-legalizations-updateTraining tbody').empty();
    $.get("{{ route('getLegalizationFromTraining') }}", {
      tcoId: tcoId
    }, function(objectsLegalizations) {
      var count = Object.keys(objectsLegalizations).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          $('.tbl-legalizations-updateTraining').find('tbody').append(
            "<tr class='" + objectsLegalizations[i]['bcoId'] + "' data-idLegalization='" + objectsLegalizations[i]['bcoId'] + "'>" +
            "<td>" + objectsLegalizations[i]['coNames'] + "</td>" +
            "<td>" + objectsLegalizations[i]['coNumberdocument'] + "</td>" +
            "<td>" + objectsLegalizations[i]['coPosition'] + "</td>" +
            "<td>" + objectsLegalizations[i]['coEmail'] + "</td>" +
            "<td>" +
            "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteLegalization-updateTraining' title='ELIMINAR ASISTENTE'><i class='fas fa-trash-alt'></i></button>" +
            "</td>" +
            "</tr>"
          );
        }
      }
    });
    $('input[name=allLegalizations_Edit]').val(tcoLegalizations + '=');
    $('#editTraining-modal').modal();
  });

  $('select[name=tcoDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode_Edit]').val('');
    $('input[name=dolVersion_Edit]').val('');
    if (selected != '') {
      var oldId = $('input[name=tcoDocument_id_hidden_Edit]').val();
      var code = $('select[name=tcoDocument_id_Edit] option:selected').attr('data-code');
      var version = $('select[name=tcoDocument_id_Edit] option:selected').attr('data-version');
      $('input[name=dolVersion_Edit]').val(version);
      if (oldId != selected) {
        $.get("{{ route('getNextcodeForTraining') }}", {
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
    var bcoId = $('select[name=tcoLegalization_id_Edit]').val();
    var validateRepet = false;
    $('.tbl-legalizations-updateTraining').find('tbody').find('tr').each(function() {
      var idBill = $(this).attr('class');
      if (idBill == bcoId) {
        validateRepet = true;
      }
    });
    if (bcoId != '') {
      if (validateRepet == false) {
        var names = $('select[name=tcoLegalization_id_Edit] option:selected').attr('data-names');
        var number = $('select[name=tcoLegalization_id_Edit] option:selected').attr('data-document');
        var position = $('select[name=tcoLegalization_id_Edit] option:selected').attr('data-position');
        var email = $('select[name=tcoLegalization_id_Edit] option:selected').attr('data-email');
        $('.tbl-legalizations-updateTraining').find('tbody').append(
          "<tr class='" + bcoId + "' data-idLegalization='" + bcoId + "'>" +
          "<td>" + names + "</td>" +
          "<td>" + number + "</td>" +
          "<td>" + position + "</td>" +
          "<td>" + email + "</td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteLegalization-updateTraining' title='ELIMINAR ASISTENTE'><i class='fas fa-trash-alt'></i></button>" +
          "</td>" +
          "</tr>"
        );
      } else {
        $('.infoRepeat_Edit').css('display', 'block');
        $('.infoRepeat_Edit').text('Colaborador seleccionado ya está en la lista de asistentes');
        setTimeout(function() {
          $('.infoRepeat_Edit').css('display', 'none');
          $('.infoRepeat_Edit').text('');
        }, 3000);
      }
    } else {
      $('.infoRepeat_Edit').css('display', 'block');
      $('.infoRepeat_Edit').text('No hay seleccionado ningun colaborador');
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
      var bcoId = $(this).attr('data-idLegalization');
      var name = $(this).find('td:nth-child(1)').text();
      var number = $(this).find('td:nth-child(2)').text();
      var position = $(this).find('td:nth-child(3)').text();
      var email = $(this).find('td:nth-child(4)').text();
      allLegalizations += bcoId + '=';
    });
    $('input[name=allLegalizations_Edit]').val(allLegalizations);
    if (allLegalizations != '' && allLegalizations != null) {
      $(this).submit();
    } else {
      e.preventDefault();
      $('.infoRepeat_Edit').css('display', 'block');
      $('.infoRepeat_Edit').text('Seleccione al menos 1 colaborador');
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
    var tcoId = $(this).find('span:nth-child(2)').text();
    var tcoDate = $(this).find('span:nth-child(3)').text();
    var tcoDocumentcode = $(this).find('span:nth-child(4)').text();
    var tcoNametraining = $(this).find('span:nth-child(5)').text();
    var tcoNametrainer = $(this).find('span:nth-child(6)').text();
    $('input[name=tcoId_Delete]').val(tcoId);
    $('.tcoDate_Delete').text(tcoDate);
    $('.tcoDocumentcode_Delete').text(tcoDocumentcode);
    $('.tcoNametraining_Delete').text(tcoNametraining);
    $('.tcoNametrainer_Delete').text(tcoNametrainer);
    $('.tbl-collaborators-Delete tbody').empty();
    $.get("{{ route('getLegalizationFromTraining') }}", {
      tcoId: tcoId
    }, function(objectsLegalizations) {
      var count = Object.keys(objectsLegalizations).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          $('.tbl-collaborators-Delete tbody').append(
            "<tr>" +
            "<td>" +
            objectsLegalizations[i]['coNames'] + "/" + objectsLegalizations[i]['coPosition'] +
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