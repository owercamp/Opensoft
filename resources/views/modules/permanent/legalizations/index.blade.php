@extends('modules.comercialPermanentcontracts')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>LEGALIZACION CONTRACTUAL</h6>
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
        <th>NOMBRE DE DOCUMENTO</th>
        <th>CODIGO DE DOCUMENTO</th>
        <th>CLIENTE</th>
        <th>CONTENIDO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($legalizations as $legalization)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $legalization->document->docName }}</td>
        <td>{{ $legalization->document->docCode }}</td>
        <td>{{ $legalization->client->cliNamereason }}</td>
        <td>
          @if(strlen($legalization->lcoContentfinal) > 50)
          {{ substr($legalization->lcoContentfinal,0,50) . ' ...' }}
          @else
          {{ $legalization->lcoContentfinal }}
          @endif
        </td>
        <td>
          @if($legalization->lcoStatus != 'TERMINADO')
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editLegalization-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $legalization->lcoId }}</span>
            <span hidden>{{ $legalization->lcoDocument_id }}</span>
            <span hidden>{{ $legalization->document->docCode }}</span>
            <span hidden>{{ $legalization->document->docVersion }}</span>
            <span hidden>{{ $legalization->client->cliNamereason }}</span>
            <span hidden>{{ $legalization->lcoConfigdocument_id }}</span>
            <span hidden>{{ $legalization->lcoContentfinal }}</span>
            <span hidden>{{ $legalization->lcoWrited }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteLegalization-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $legalization->lcoId }}</span>
            <span hidden>{{ $legalization->document->docName }}</span>
            <span hidden>{{ $legalization->document->docCode }}</span>
            <span hidden>{{ $legalization->document->docVersion }}</span>
            <span hidden>{{ $legalization->client->cliNamereason }}</span>
            <span hidden>{{ $legalization->lcoContentfinal }}</span>
          </a>
          @endif
          <form action="{{ route('permanent.legalizations.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="lcoId" value="{{ $legalization->lcoId }}" class="form-control form-control-sm" required>
            <button type="submit" title="Descargar PDF" class="btn btn-outline-success rounded-circle form-control-sm">
              <i class="fas fa-file-pdf"></i>
            </button>
          </form>
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
        <h6>NUEVA LEGALIZACION:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('permanent.legalizations.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="lcoDocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->docId }}" data-code="{{ $document->docCode }}" data-version="{{ $document->docVersion }}">{{ $document->docName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="docVersion" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="docCode" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">CLIENTE:</small>
                    <select name="lcoClient_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($clients as $client)
                      <option value="{{ $client->cliId }}" data-document="{{ $client->cliNumberdocument }}" data-email="{{ $client->cliEmail }}">{{ $client->cliNamereason }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <small class="text-muted">CONTENIDOS:</small>
                    <select name="lcoConfigdocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="lcoTemplate" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border lcoContentfinal" style="font-size: 12px;">

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" name="lcoVariables" class="form-control form-control-sm" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
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
        <form action="{{ route('permanent.legalizations.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="lcoDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->docId }}" data-code="{{ $document->docCode }}" data-version="{{ $document->docVersion }}">{{ $document->docName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="docVersion_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="docCode_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">CLIENTE:</small>
                    <input type="text" name="lcoClient_id_Edit" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <small class="text-muted">CONTENIDOS:</small>
                    <select name="lcoConfigdocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="lcoTemplate_Edit" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border lcoContentfinal_Edit" style="font-size: 12px;">

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" name="lcoVariables_Edit" class="form-control form-control-sm" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="lcoId_Edit" readonly required>
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
            <small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="docName_Delete"></b></span><br>
            <small class="text-muted">CODIGO DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="docCode_Delete"></b></span><br>
            <small class="text-muted">VERSION DEL DOCUMENTO: </small><br>
            <span class="text-muted"><b class="docVersion_Delete"></b></span><br>
            <small class="text-muted">CLIENTE: </small><br>
            <span class="text-muted"><b class="cliNamereason_Delete"></b></span><br>
            <small class="text-muted">CONTENIDO: </small><br>
            <span class="text-muted"><b class="lcoContentfinal_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('permanent.legalizations.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="lcoId_Delete" readonly required>
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

  $('select[name=lcoDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=docVersion]').val('');
    $('input[name=docCode]').val('');
    $('select[name=lcoConfigdocument_id]').empty();
    $('select[name=lcoConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
    $('div.lcoContentfinal').empty();
    if (selected != '') {
      var version = $('select[name=lcoDocument_id] option:selected').attr('data-version');
      var code = $('select[name=lcoDocument_id] option:selected').attr('data-code');
      $('input[name=docVersion]').val(version);
      $('input[name=docCode]').val(code);
      $.get("{{ route('getContentFromDocument') }}", {
        docId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdoContent'].length > 50) {
              var chain = objectsConfig[i]['cdoContent'].substring(0, 50) + ' ...';
              $('select[name=lcoConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=lcoConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + objectsConfig[i]['cdoContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=lcoConfigdocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=lcoTemplate]').val('');
    $('div.lcoContentfinal').empty();
    if (selected != '') {
      var content = $('select[name=lcoConfigdocument_id] option:selected').attr('data-content');
      $('input[name=lcoTemplate]').val(content);
      $('div.lcoContentfinal').append(showContent(content));
    }
  });

  $('div.lcoContentfinal').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=lcoVariables]').val('');
    $('div.lcoContentfinal > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=lcoVariables]').val(all);
  });

  $('.editLegalization-link').on('click', function(e) {
    e.preventDefault();
    var lcoId = $(this).find('span:nth-child(2)').text();
    var lcoDocument_id = $(this).find('span:nth-child(3)').text();
    var docCode = $(this).find('span:nth-child(4)').text();
    var docVersion = $(this).find('span:nth-child(5)').text();
    var lcoClient_id = $(this).find('span:nth-child(6)').text();
    var lcoConfigdocument_id = $(this).find('span:nth-child(7)').text();
    var lcoContentfinal = $(this).find('span:nth-child(8)').text();
    var lcoWrited = $(this).find('span:nth-child(9)').text();
    $('input[name=lcoId_Edit]').val(lcoId);
    $('select[name=lcoDocument_id_Edit]').val(lcoDocument_id);
    $('input[name=docCode_Edit]').val(docCode);
    $('input[name=docVersion_Edit]').val(docVersion);
    $('input[name=lcoClient_id_Edit]').val(lcoClient_id);
    $('input[name=lcoVariables_Edit]').val(lcoWrited + '!!==¡¡');
    var contentAll = '';
    $.get("{{ route('getContentFromDocument') }}", {
      docId: lcoDocument_id
    }, function(objectsConfig) {
      var count = Object.keys(objectsConfig).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectsConfig[i]['cdoContent'].length > 50) {
            var chain = objectsConfig[i]['cdoContent'].substring(0, 50) + ' ...';
            if (lcoConfigdocument_id == objectsConfig[i]['cdoId']) {
              $('select[name=lcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "' selected>" + chain + "</option>"
              );
              $('input[name=lcoTemplate_Edit]').val(objectsConfig[i]['cdoContent']);
              $('div.lcoContentfinal_Edit').html(showContent(objectsConfig[i]['cdoContent']));
            } else {
              $('select[name=lcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + chain + "</option>"
              );
            }
          } else {
            if (lcoConfigdocument_id == objectsConfig[i]['cdoId']) {
              $('select[name=lcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "' selected>" + objectsConfig[i]['cdoContent'] + "</option>"
              );
            } else {
              $('select[name=lcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + objectsConfig[i]['cdoContent'] + "</option>"
              );
            }
          }
        }
        var separatedVariables = lcoWrited.split("!!==¡¡");
        var item;
        for (var i = 0; i < separatedVariables.length; i++) {
          item = separatedVariables[i].split('=>');
          $('div.lcoContentfinal_Edit > .field-dinamic').each(function() {
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

  $('select[name=lcoDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=docVersion_Edit]').val('');
    $('input[name=docCode_Edit]').val('');
    $('select[name=lcoConfigdocument_id_Edit]').empty();
    $('select[name=lcoConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('div.lcoContentfinal').empty();
    if (selected != '') {
      var version = $('select[name=lcoDocument_id_Edit] option:selected').attr('data-version');
      var code = $('select[name=lcoDocument_id_Edit] option:selected').attr('data-code');
      $('input[name=docVersion_Edit]').val(version);
      $('input[name=docCode_Edit]').val(code);
      $.get("{{ route('getContentFromDocument') }}", {
        docId: selected
      }, function(objectsConfig) {
        var count = Object.keys(objectsConfig).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            if (objectsConfig[i]['cdoContent'].length > 50) {
              var chain = objectsConfig[i]['cdoContent'].substring(0, 50) + ' ...';
              $('select[name=lcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=lcoConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdoId'] + "' data-content='" + objectsConfig[i]['cdoContent'] + "'>" + objectsConfig[i]['cdoContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=lcoConfigdocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=lcoTemplate_Edit]').val('');
    $('div.lcoContentfinal_Edit').empty();
    if (selected != '') {
      var content = $('select[name=lcoConfigdocument_id_Edit] option:selected').attr('data-content');
      $('input[name=lcoTemplate_Edit]').val(content);
      $('div.lcoContentfinal_Edit').append(showContent(content));
    }
  });

  $('div.lcoContentfinal_Edit').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=lcoVariables_Edit]').val('');
    $('div.lcoContentfinal_Edit > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=lcoVariables_Edit]').val(all);
  });

  $('.deleteLegalization-link').on('click', function(e) {
    e.preventDefault();
    var lcoId = $(this).find('span:nth-child(2)').text();
    var docName = $(this).find('span:nth-child(3)').text();
    var docCode = $(this).find('span:nth-child(4)').text();
    var docVersion = $(this).find('span:nth-child(5)').text();
    var cliNamereason = $(this).find('span:nth-child(6)').text();
    var lcoContentfinal = $(this).find('span:nth-child(7)').text();
    $('input[name=lcoId_Delete]').val(lcoId);
    $('b.docName_Delete').text(docName);
    $('b.docCode_Delete').text(docCode);
    $('b.docVersion_Delete').text(docVersion);
    $('b.cliNamereason_Delete').text(cliNamereason);
    $('b.lcoContentfinal_Delete').text(lcoContentfinal);
    $('#deleteLegalization-modal').modal();
  });

  function showContent(content) {
    const text = /¡¡¡texto dinámico!!!/g;
    const number = /¡¡¡número dinámico!!!/g;
    const money = /¡¡¡moneda dinámica!!!/g;
    const calendar = /¡¡¡calendario dinámico!!!/g;
    var newTexto = content.replace(text, "<input type='text' class='field-dinamic' data-type='texto' maxlength='50' placeholder='Campo de texto' required>");
    var newNumber = newTexto.replace(number, "<input type='text' class='field-dinamic' data-type='numero' maxlength='2' pattern='[0-9]{1,2}' placeholder='Campo de número' required>");
    var newMoney = newNumber.replace(money, "<input type='text' class='field-dinamic' data-type='moneda' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' required>");
    var element = newMoney.replace(calendar, "<input type='date' class='field-dinamic datepicker' data-type='calendario' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' required>");
    return element;
  }
</script>
@endsection