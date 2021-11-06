@extends('modules.logisticCollaborators')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>MINUTA DE CONTRATO</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="REGISTRAR NUEVO CONTRATO" class="btn btn-outline-success form-control-sm newBill-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessBill'))
      <div class="alert alert-success">
        {{ session('SuccessBill') }}
      </div>
      @endif
      @if(session('PrimaryBill'))
      <div class="alert alert-primary">
        {{ session('PrimaryBill') }}
      </div>
      @endif
      @if(session('WarningBill'))
      <div class="alert alert-warning">
        {{ session('WarningBill') }}
      </div>
      @endif
      @if(session('SecondaryBill'))
      <div class="alert alert-secondary">
        {{ session('SecondaryBill') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>COLABORADOR</th>
        <th>NOMBRE DE DOCUMENTO</th>
        <th>CODIGO DE DOCUMENTO</th>
        <th>CONTENIDO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($bills as $bill)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $bill->collaborator->coNames }}</td>
        <td>{{ $bill->document->dolName }}</td>
        <td>{{ $bill->bcoDocumentcode }}</td>
        <td>
          @if(strlen($bill->bcoContentfinal) > 20)
          {{ substr($bill->bcoContentfinal,0,20) . ' ...' }}
          @else
          {{ $bill->bcoContentfinal }}
          @endif
        </td>
        <td class="d-flex justofy-content-center">
          @if($bill->bcoStatus != 'TERMINADO')
          <a href="#" title="EDITAR CONTRATO" class="btn btn-outline-primary rounded-circle form-control-sm editBill-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $bill->bcoId }}</span>
            <span hidden>{{ $bill->bcoDocument_id }}</span>
            <span hidden>{{ $bill->bcoDocumentcode }}</span>
            <span hidden>{{ $bill->document->dolVersion }}</span>
            <span hidden>{{ $bill->collaborator->coNames }}</span>
            <span hidden>{{ $bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $bill->bcoConfigdocument_id }}</span>
            <span hidden>{{ $bill->bcoContentfinal }}</span>
            <span hidden>{{ $bill->bcoWrited }}</span>
          </a>
          <a href="#" title="RECHAZAR CONTRATO" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteBill-link">
            <i class="fas fa-times"></i>
            <span hidden>{{ $bill->bcoId }}</span>
            <span hidden>{{ $bill->document->dolName }}</span>
            <span hidden>{{ $bill->bcoDocumentcode }}</span>
            <span hidden>{{ $bill->document->dolVersion }}</span>
            <span hidden>{{ $bill->collaborator->coNames }}</span>
            <span hidden>{{ $bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $bill->bcoContentfinal }}</span>
          </a>
          <form action="{{ route('collaborators.bill.aproved') }}" method="POST" style="display: inline-block;">
            @csrf
            <input type="hidden" name="bcoId" value="{{ $bill->bcoId }}" class="form-control form-control-sm" required>
            <button type="submit" title="APROBAR CONTRATO" class="btn btn-outline-success form-control-sm">
              <i class="fas fa-plus"></i>
            </button>
          </form>
          <form action="{{ route('collaborators.bill.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="bcoId" value="{{ $bill->bcoId }}" class="form-control form-control-sm" required>
            <button type="submit" title="DESCARGAR PDF" class="btn btn-outline-danger form-control-sm">
              <i class="fas fa-file-pdf"></i>
            </button>
          </form>
          @endif
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

<div class="modal fade" id="newBill-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVA MINUTA DE CONTRATO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.bill.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">COLABORADOR:</small>
                    <select name="bcoCollaborator_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($collaborators as $collaborator)
                      <option value="{{ $collaborator->coId }}" data-document="{{ $collaborator->coNumberdocument }}">{{ $collaborator->coNames }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                    <input type="text" name="coNumberdocument" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="bcoDocument_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="dolVersion" class="form-control form-control-sm text-center" readonly>
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
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTENIDOS:</small>
                    <select name="bcoConfigdocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="bcoTemplate" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border bcoContentfinal" style="font-size: 12px;">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <input type="hidden" name="bcoVariables" class="form-control form-control-sm" readonly required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editBill-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE MINUTA:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.bill.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">COLABORADOR:</small>
                    <input type="text" name="coNames_Edit" class="form-control form-control-sm" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                    <input type="text" name="coNumberdocument_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="bcoDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="bcoDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
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
                    <input type="text" name="dolCode_Edit" class="form-control form-control-sm text-center" readonly required>
                    <input type="hidden" name="dolCode_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTENIDOS:</small>
                    <select name="bcoConfigdocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="bcoTemplate_Edit" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border bcoContentfinal_Edit" style="font-size: 12px;">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" name="bcoVariables_Edit" class="form-control form-control-sm" readonly required>
              <input type="hidden" class="form-control form-control-sm" name="bcoId_Edit" readonly required>
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

<div class="modal fade" id="deleteBill-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE MINUTA:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <small class="text-muted">COLABORADOR: </small><br>
            <span class="text-muted"><b class="coNames_Delete"></b></span><br>
            <small class="text-muted">NUMERO DE IDENTIFICACION: </small><br>
            <span class="text-muted"><b class="coNumberdocument_Delete"></b></span><br>
            <small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="dolName_Delete"></b></span><br>
            <small class="text-muted">CODIGO DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="dolCode_Delete"></b></span><br>
            <small class="text-muted">VERSION DEL DOCUMENTO: </small><br>
            <span class="text-muted"><b class="dolVersion_Delete"></b></span><br>
            <small class="text-muted">CONTENIDO: </small><br>
            <span class="text-muted"><b class="bcoContentfinal_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('collaborators.bill.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="bcoId_Delete" readonly required>
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

  $('.newBill-link').on('click', function() {
    $('#newBill-modal').modal();
  });

  $('select[name=bcoCollaborator_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=coNumberdocument]').val('');
    if (selected != '') {
      var numberDocument = $('select[name=bcoCollaborator_id] option:selected').attr('data-document');
      $('input[name=coNumberdocument]').val(numberDocument);
    }
  });

  $('select[name=bcoDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion]').val('');
    $('input[name=dolCode]').val('');
    $('select[name=bcoConfigdocument_id]').empty();
    $('select[name=bcoConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
    $('div.bcoContentfinal').empty();
    if (selected != '') {
      var version = $('select[name=bcoDocument_id] option:selected').attr('data-version');
      var code = $('select[name=bcoDocument_id] option:selected').attr('data-code');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForBill') }}", {
        dolId: selected
      }, function(objectsNext) {
        if (objectsNext != null) {
          $('input[name=dolCode]').val(objectsNext);
        } else {
          $('input[name=dolCode]').val('');
        }
      });
      $.get("{{ route('getContentFromDocumentLogistic') }}", {
        dolId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdlContent'].length > 100) {
              var chain = objectsConfig[i]['cdlContent'].substring(0, 100) + ' ...';
              $('select[name=bcoConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=bcoConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=bcoConfigdocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=bcoTemplate]').val('');
    $('div.bcoContentfinal').empty();
    if (selected != '') {
      var content = $('select[name=bcoConfigdocument_id] option:selected').attr('data-content');
      $('input[name=bcoTemplate]').val(content);
      $('div.bcoContentfinal').append(showContent(content));
    }
  });

  $('div.bcoContentfinal').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=bcoVariables]').val('');
    $('div.bcoContentfinal > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=bcoVariables]').val(all);
  });

  $('.editBill-link').on('click', function(e) {
    e.preventDefault();
    var bcoId = $(this).find('span:nth-child(2)').text();
    var bcoDocument_id = $(this).find('span:nth-child(3)').text();
    var dolCode = $(this).find('span:nth-child(4)').text();
    var dolVersion = $(this).find('span:nth-child(5)').text();
    var coNames = $(this).find('span:nth-child(6)').text();
    var coNumberdocument = $(this).find('span:nth-child(7)').text();
    var bcoConfigdocument_id = $(this).find('span:nth-child(8)').text();
    var bcoContentfinal = $(this).find('span:nth-child(9)').text();
    var bcoWrited = $(this).find('span:nth-child(10)').text();
    $('input[name=bcoId_Edit]').val(bcoId);
    $('select[name=bcoDocument_id_Edit]').val(bcoDocument_id);
    $('input[name=dolCode_Edit]').val(dolCode);
    $('input[name=dolCode_hidden_Edit]').val(dolCode);
    $('input[name=dolVersion_Edit]').val(dolVersion);
    $('input[name=coNames_Edit]').val(coNames);
    $('input[name=coNumberdocument_Edit]').val(coNumberdocument);
    $('input[name=bcoVariables_Edit]').val(bcoWrited + '!!==¡¡');
    var contentAll = '';
    $('select[name=bcoConfigdocument_id_Edit]').empty();
    $('select[name=bcoConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('input[name=bcoDocument_id_hidden_Edit]').val(bcoDocument_id);
    $.get("{{ route('getContentFromDocumentLogistic') }}", {
      dolId: bcoDocument_id
    }, function(objectsConfig) {
      var count = Object.keys(objectsConfig).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectsConfig[i]['cdlContent'].length > 100) {
            var chain = objectsConfig[i]['cdlContent'].substring(0, 100) + ' ...';
            if (bcoConfigdocument_id == objectsConfig[i]['cdlId']) {
              $('select[name=bcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + chain + "</option>"
              );
              $('input[name=bcoTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
              $('div.bcoContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
            } else {
              $('select[name=bcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            }
          } else {
            if (bcoConfigdocument_id == objectsConfig[i]['cdlId']) {
              $('select[name=bcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
              $('input[name=bcoTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
              $('div.bcoContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
            } else {
              $('select[name=bcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
        var separatedVariables = bcoWrited.split("!!==¡¡");
        var item;
        for (var i = 0; i < separatedVariables.length; i++) {
          item = separatedVariables[i].split('=>');
          $('div.bcoContentfinal_Edit > .field-dinamic').each(function() {
            var value = $(this).val();
            if (value == '') {
              $(this).val(item[0]);
              return false;
            }
          });
        }
        $('#editBill-modal').modal();
      }
    });
  });

  $('select[name=bcoDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion_Edit]').val('');
    $('input[name=dolCode_Edit]').val('');
    $('select[name=bcoConfigdocument_id_Edit]').empty();
    $('select[name=bcoConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('div.bcoContentfinal_Edit').empty();
    if (selected != '') {
      var version = $('select[name=bcoDocument_id_Edit] option:selected').attr('data-version');
      var code = $('select[name=bcoDocument_id_Edit] option:selected').attr('data-code');
      var dolId = $('input[name=bcoDocument_id_hidden_Edit]').val();
      $('input[name=dolVersion_Edit]').val(version);
      if (selected == dolId) {
        $('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
      } else {
        $.get("{{ route('getNextcodeForBill') }}", {
          dolId: selected
        }, function(objectsNext) {
          if (objectsNext != null) {
            $('input[name=dolCode_Edit]').val(objectsNext);
          } else {
            $('input[name=dolCode_Edit]').val('');
          }
        });
      }
      $.get("{{ route('getContentFromDocumentLogistic') }}", {
        dolId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdlContent'].length > 50) {
              var chain = objectsConfig[i]['cdlContent'].substring(0, 50) + ' ...';
              $('select[name=bcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=bcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=bcoConfigdocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=bcoTemplate_Edit]').val('');
    $('div.bcoContentfinal_Edit').empty();
    if (selected != '') {
      var content = $('select[name=bcoConfigdocument_id_Edit] option:selected').attr('data-content');
      $('input[name=bcoTemplate_Edit]').val(content);
      $('div.bcoContentfinal_Edit').append(showContent(content));
    }
  });

  $('div.bcoContentfinal_Edit').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=bcoVariables_Edit]').val('');
    $('div.bcoContentfinal_Edit > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=bcoVariables_Edit]').val(all);
  });

  $('.deleteBill-link').on('click', function(e) {
    e.preventDefault();
    var bcoId = $(this).find('span:nth-child(2)').text();
    var dolName = $(this).find('span:nth-child(3)').text();
    var dolCode = $(this).find('span:nth-child(4)').text();
    var dolVersion = $(this).find('span:nth-child(5)').text();
    var coNames = $(this).find('span:nth-child(6)').text();
    var coNumberdocument = $(this).find('span:nth-child(7)').text();
    var bcoContentfinal = $(this).find('span:nth-child(8)').text();
    $('input[name=bcoId_Delete]').val(bcoId);
    $('b.dolName_Delete').text(dolName);
    $('b.dolCode_Delete').text(dolCode);
    $('b.dolVersion_Delete').text(dolVersion);
    $('b.coNames_Delete').text(coNames);
    $('b.coNumberdocument_Delete').text(coNumberdocument);
    $('b.bcoContentfinal_Delete').text(bcoContentfinal);
    $('#deleteBill-modal').modal();
  });

  function showContent(content) {
    const text = /¡¡¡texto dinámico!!!/g;
    const number = /¡¡¡número dinámico!!!/g;
    const money = /¡¡¡moneda dinámica!!!/g;
    const calendar = /¡¡¡calendario dinámico!!!/g;
    var newTexto = content.replace(text, "<input type='text' class='field-dinamic' data-type='texto' maxlength='50' placeholder='Campo de texto' required>");
    var newNumber = newTexto.replace(number, "<input type='text' class='field-dinamic' data-type='numero' maxlength='20' pattern='[0-9]{1,20}' placeholder='Campo de número' required>");
    var newMoney = newNumber.replace(money, "<input type='text' class='field-dinamic' data-type='moneda' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' required>");
    var element = newMoney.replace(calendar, "<input type='date' class='field-dinamic datepicker' data-type='calendario' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' required>");
    return element;
  }
</script>
@endsection