@extends('modules.logisticCollaborators')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>LEGALIZACION DE CONTRATO</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newLegalization-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessLegalization'))
      <div class="alert alert-success">
        {{ session('SuccessLegalization') }}
      </div>
      @endif
      @if(session('PrimaryLegalization'))
      <div class="alert alert-primary">
        {{ session('PrimaryLegalization') }}
      </div>
      @endif
      @if(session('WarningLegalization'))
      <div class="alert alert-warning">
        {{ session('WarningLegalization') }}
      </div>
      @endif
      @if(session('SecondaryLegalization'))
      <div class="alert alert-secondary">
        {{ session('SecondaryLegalization') }}
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
      @foreach($legalizations as $legalization)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $legalization->bill->collaborator->coNames }}</td>
        <td>{{ $legalization->document->dolName }}</td>
        <td>{{ $legalization->document->dolCode }}</td>
        <td>
          @if(strlen($legalization->lccContentfinal) > 20)
          {{ substr($legalization->lccContentfinal,0,20) . ' ...' }}
          @else
          {{ $legalization->lccContentfinal }}
          @endif
        </td>
        <td class="d-flex justofy-content-center">
          @if($legalization->lccStatus != 'TERMINADO')
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editLegalization-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $legalization->lccId }}</span>
            <span hidden>{{ $legalization->lccDocument_id }}</span>
            <span hidden>{{ $legalization->document->dolCode }}</span>
            <span hidden>{{ $legalization->document->dolVersion }}</span>
            <span hidden>{{ $legalization->bill->collaborator->coNames }}</span>
            <span hidden>{{ $legalization->bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $legalization->lccConfigdocument_id }}</span>
            <span hidden>{{ $legalization->lccContentfinal }}</span>
            <span hidden>{{ $legalization->lccWrited }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteLegalization-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $legalization->lccId }}</span>
            <span hidden>{{ $legalization->document->dolName }}</span>
            <span hidden>{{ $legalization->document->dolCode }}</span>
            <span hidden>{{ $legalization->document->dolVersion }}</span>
            <span hidden>{{ $legalization->bill->collaborator->coNames }}</span>
            <span hidden>{{ $legalization->bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $legalization->lccContentfinal }}</span>
          </a>
          <form action="{{ route('collaborators.legalization.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="lccId" value="{{ $legalization->lccId }}" class="form-control form-control-sm" required>
            <button type="submit" title="Descargar PDF" class="btn btn-outline-success rounded-circle form-control-sm">
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

<div class="modal fade" id="newLegalization-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVA LEGALIZACION DE CONTRATO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.legalization.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">MINUTA DE CONTRATO DE:</small>
                    <select name="lccBillcollaborator_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($collaborators as $collaborator)
                      <option value="{{ $collaborator->bcoId }}" data-document="{{ $collaborator->coNumberdocument }}">{{ $collaborator->coNames }}</option>
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
                    <select name="lccDocument_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="dolCode" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTENIDOS:</small>
                    <select name="lccConfigdocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="lccTemplate" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border lccContentfinal" style="font-size: 12px;">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <input type="hidden" name="lccVariables" class="form-control form-control-sm" readonly required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editLegalization-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE LEGALIZACION:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.legalization.update') }}" method="POST">
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
                    <select name="lccDocument_id_Edit" class="form-control form-control-sm" required>
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
                    <input type="text" name="dolVersion_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTENIDOS:</small>
                    <select name="lccConfigdocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="lccTemplate_Edit" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border lccContentfinal_Edit" style="font-size: 12px;">

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
              <input type="hidden" name="lccVariables_Edit" class="form-control form-control-sm" readonly required>
              <input type="hidden" class="form-control form-control-sm" name="lccId_Edit" readonly required>
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

<div class="modal fade" id="deleteLegalization-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE LEGALIZACION:</h6>
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
            <span class="text-muted"><b class="lccContentfinal_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('collaborators.legalization.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="lccId_Delete" readonly required>
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

  $('.newLegalization-link').on('click', function() {
    $('#newLegalization-modal').modal();
  });

  $('select[name=lccBillcollaborator_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=coNumberdocument]').val('');
    if (selected != '') {
      var numberDocument = $('select[name=lccBillcollaborator_id] option:selected').attr('data-document');
      $('input[name=coNumberdocument]').val(numberDocument);
    }
  });

  $('select[name=lccDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion]').val('');
    $('input[name=dolCode]').val('');
    $('select[name=lccConfigdocument_id]').empty();
    $('select[name=lccConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
    $('div.lccContentfinal').empty();
    if (selected != '') {
      var version = $('select[name=lccDocument_id] option:selected').attr('data-version');
      var code = $('select[name=lccDocument_id] option:selected').attr('data-code');
      $('input[name=dolVersion]').val(version);
      $('input[name=dolCode]').val(code);
      $.get("{{ route('getContentFromDocumentLogistic') }}", {
        dolId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdlContent'].length > 100) {
              var chain = objectsConfig[i]['cdlContent'].substring(0, 100) + ' ...';
              $('select[name=lccConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=lccConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=lccConfigdocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=lccTemplate]').val('');
    $('div.lccContentfinal').empty();
    if (selected != '') {
      var content = $('select[name=lccConfigdocument_id] option:selected').attr('data-content');
      $('input[name=lccTemplate]').val(content);
      $('div.lccContentfinal').append(showContent(content));
    }
  });

  $('div.lccContentfinal').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=lccVariables]').val('');
    $('div.lccContentfinal > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=lccVariables]').val(all);
  });

  $('.editLegalization-link').on('click', function(e) {
    e.preventDefault();
    var lccId = $(this).find('span:nth-child(2)').text();
    var lccDocument_id = $(this).find('span:nth-child(3)').text();
    var dolCode = $(this).find('span:nth-child(4)').text();
    var dolVersion = $(this).find('span:nth-child(5)').text();
    var coNames = $(this).find('span:nth-child(6)').text();
    var coNumberdocument = $(this).find('span:nth-child(7)').text();
    var lccConfigdocument_id = $(this).find('span:nth-child(8)').text();
    var lccContentfinal = $(this).find('span:nth-child(9)').text();
    var lccWrited = $(this).find('span:nth-child(10)').text();
    $('input[name=lccId_Edit]').val(lccId);
    $('select[name=lccDocument_id_Edit]').val(lccDocument_id);
    $('input[name=dolCode_Edit]').val(dolCode);
    $('input[name=dolVersion_Edit]').val(dolVersion);
    $('input[name=coNames_Edit]').val(coNames);
    $('input[name=coNumberdocument_Edit]').val(coNumberdocument);
    $('input[name=lccVariables_Edit]').val(lccWrited + '!!==¡¡');
    var contentAll = '';
    $('select[name=lccConfigdocument_id_Edit]').empty();
    $('select[name=lccConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $.get("{{ route('getContentFromDocumentLogistic') }}", {
      dolId: lccDocument_id
    }, function(objectsConfig) {
      var count = Object.keys(objectsConfig).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectsConfig[i]['cdlContent'].length > 100) {
            var chain = objectsConfig[i]['cdlContent'].substring(0, 100) + ' ...';
            if (lccConfigdocument_id == objectsConfig[i]['cdlId']) {
              $('select[name=lccConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + chain + "</option>"
              );
              $('input[name=lccTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
              $('div.lccContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
            } else {
              $('select[name=lccConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            }
          } else {
            if (lccConfigdocument_id == objectsConfig[i]['cdlId']) {
              $('select[name=lccConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
              $('input[name=lccTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
              $('div.lccContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
            } else {
              $('select[name=lccConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
        var separatedVariables = lccWrited.split("!!==¡¡");
        var item;
        for (var i = 0; i < separatedVariables.length; i++) {
          item = separatedVariables[i].split('=>');
          $('div.lccContentfinal_Edit > .field-dinamic').each(function() {
            var value = $(this).val();
            if (value == '') {
              $(this).val(item[0]);
              return false;
            }
          });
        }
        $('#editLegalization-modal').modal();
      }
    });
  });

  $('select[name=lccDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion_Edit]').val('');
    $('input[name=dolCode_Edit]').val('');
    $('select[name=lccConfigdocument_id_Edit]').empty();
    $('select[name=lccConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('div.lccContentfinal_Edit').empty();
    if (selected != '') {
      var version = $('select[name=lccDocument_id_Edit] option:selected').attr('data-version');
      var code = $('select[name=lccDocument_id_Edit] option:selected').attr('data-code');
      $('input[name=dolVersion_Edit]').val(version);
      $('input[name=dolCode_Edit]').val(code);
      $.get("{{ route('getContentFromDocumentLogistic') }}", {
        dolId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdlContent'].length > 50) {
              var chain = objectsConfig[i]['cdlContent'].substring(0, 50) + ' ...';
              $('select[name=lccConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=lccConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=lccConfigdocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=lccTemplate_Edit]').val('');
    $('div.lccContentfinal_Edit').empty();
    if (selected != '') {
      var content = $('select[name=lccConfigdocument_id_Edit] option:selected').attr('data-content');
      $('input[name=lccTemplate_Edit]').val(content);
      $('div.lccContentfinal_Edit').append(showContent(content));
    }
  });

  $('div.lccContentfinal_Edit').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=lccVariables_Edit]').val('');
    $('div.lccContentfinal_Edit > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=lccVariables_Edit]').val(all);
  });

  $('.deleteLegalization-link').on('click', function(e) {
    e.preventDefault();
    var lccId = $(this).find('span:nth-child(2)').text();
    var dolName = $(this).find('span:nth-child(3)').text();
    var dolCode = $(this).find('span:nth-child(4)').text();
    var dolVersion = $(this).find('span:nth-child(5)').text();
    var coNames = $(this).find('span:nth-child(6)').text();
    var coNumberdocument = $(this).find('span:nth-child(7)').text();
    var lccContentfinal = $(this).find('span:nth-child(8)').text();
    $('input[name=lccId_Delete]').val(lccId);
    $('b.dolName_Delete').text(dolName);
    $('b.dolCode_Delete').text(dolCode);
    $('b.dolVersion_Delete').text(dolVersion);
    $('b.coNames_Delete').text(coNames);
    $('b.coNumberdocument_Delete').text(coNumberdocument);
    $('b.lccContentfinal_Delete').text(lccContentfinal);
    $('#deleteLegalization-modal').modal();
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