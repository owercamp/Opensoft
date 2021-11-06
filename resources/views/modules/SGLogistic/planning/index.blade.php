@extends('modules.integralLogistic')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>CONFIGURACION DE DOCUMENTOS</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newDocument-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessDocument'))
      <div class="alert alert-success">
        {{ session('SuccessDocument') }}
      </div>
      @endif
      @if(session('PrimaryDocument'))
      <div class="alert alert-primary">
        {{ session('PrimaryDocument') }}
      </div>
      @endif
      @if(session('WarningDocument'))
      <div class="alert alert-warning">
        {{ session('WarningDocument') }}
      </div>
      @endif
      @if(session('SecondaryDocument'))
      <div class="alert alert-secondary">
        {{ session('SecondaryDocument') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>DOCUMENTO</th>
        <th>CONTENIDO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($configurations as $configuration)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $configuration->document->dolName }}</td>
        <td>
          @if(strlen($configuration->cdlContent) > 50)
          {{ substr($configuration->cdlContent,0,50) . ' ... ' }}
          @else
          {{ $configuration->cdlContent }}
          @endif
        </td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editDocument-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $configuration->cdlId }}</span>
            <span hidden>{{ $configuration->cdlDocument_id }}</span>
            <span hidden>{{ $configuration->cdlContent }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteDocument-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $configuration->cdlId }}</span>
            <span hidden>{{ $configuration->document->dolName }}</span>
            <span hidden>{{ $configuration->cdlContent }}</span>
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

<div class="modal fade" id="newDocument-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVA CONFIGURACION DE DOCUMENTO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('logistic.configuration.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DOCUMENTO:</small>
                    <select name="cdlDocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione un documento ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dolVersion" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE VARIABLE:</small>
                    <select name="valId" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      <!-- dinamics -->
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <br>
                  <a href="#" class="btn btn-outline-success form-control-sm addVariable_new" title="Agregar Variable"><i class="fas fa-plus-circle"></i></a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO:</small>
                    <input type="text" name="valType" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">LONGITUD:</small>
                    <input type="text" name="valLongitud" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">ESCRIBA CONTENIDO AQUI:</small>
                    <textarea name="cdlContent_example" rows="10" class="form-control form-control-sm text-justify" required></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CONTENIDO FINAL:</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 p-2 border cdlContent_final" style="font-size: 12px; text-align: justify;">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <button type="submit" class="btn btn-outline-success form-control-sm btn-saveDefinitive">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editDocument-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE CONFIGURACION:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('logistic.configuration.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DOCUMENTO:</small>
                    <select name="cdlDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione un documento ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dolVersion_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE VARIABLE:</small>
                    <select name="valId_Edit" class="form-control form-control-sm">
                      <option value="">Seleccione ...</option>
                      <!-- dinamics -->
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <br>
                  <a href="#" class="btn btn-outline-success form-control-sm addVariable_edit" title="Agregar Variable"><i class="fas fa-plus-circle"></i></a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO:</small>
                    <input type="text" name="valType_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">LONGITUD:</small>
                    <input type="text" name="valLongitud_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">ESCRIBA CONTENIDO AQUI:</small>
                    <textarea name="cdlContent_example_Edit" rows="10" class="form-control form-control-sm text-justify" required></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CONTENIDO FINAL:</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 p-2 border cdlContent_final_Edit" style="font-size: 12px; text-align: justify;">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="cdlId_Edit" readonly required>
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

<div class="modal fade" id="deleteDocument-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE CONFIGURACION:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <small class="text-muted">DOCUMENTO: </small><br>
            <span class="text-muted"><b class="cdlDocument_Delete"></b></span><br>
            <small class="text-muted">CONTENIDO: </small><br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 p-2 border cdlContent_final_Delete" style="font-size: 12px; text-align: justify;">

          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('logistic.configuration.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="cdlId_Delete" readonly required>
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

  $('.newDocument-link').on('click', function() {
    $('#newDocument-modal').modal();
  });

  $('textarea[name=cdlContent_example]').on('keyup', function(e) {
    var writed = e.target.value;
    var contentFinal = showContent(writed);
    $('div.cdlContent_final').html(contentFinal);
  });

  $('select[name=cdlDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode]').val('');
    $('input[name=dolVersion]').val('');
    $('select[name=valId]').empty();
    $('select[name=valId]').append("<option value=''>Seleccione ...</option>");
    $('input[name=valType]').val('');
    $('input[name=valLongitud]').val('');
    if (selected != '') {
      var code = $('select[name=cdlDocument_id] option:selected').attr('data-code');
      var version = $('select[name=cdlDocument_id] option:selected').attr('data-version');
      $('input[name=dolCode]').val(code);
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getVariablesFromDocumentLogistic') }}", {
        dolId: selected
      }, function(objectVariables) {
        var count = Object.keys(objectVariables).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=valId]').append(
              "<option value='" + objectVariables[i]['valId'] + "' data-type='" + objectVariables[i]['valType'] + "' data-longitud='" + objectVariables[i]['valLongitud'] + "'>" +
              objectVariables[i]['valName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  $('select[name=valId]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=valType]').val('');
    $('input[name=valLongitud]').val('');
    if (selected != '') {
      var type = $('select[name=valId] option:selected').attr('data-type');
      var longitud = $('select[name=valId] option:selected').attr('data-longitud');
      $('input[name=valType]').val(type);
      $('input[name=valLongitud]').val(longitud);
    }
  });

  $('.addVariable_new').on('click', function(e) {
    e.preventDefault();
    var selected = $('select[name=valId]').val();
    if (selected != '') {
      var type = $('select[name=valId] option:selected').attr('data-type');
      var long = $('select[name=valId] option:selected').attr('data-longitud');
      switch (type) {
        case 'Texto':
          var add = "<input type='text' placeholder='Campo de texto' maxlength='" + long + "' disabled>";
          var content_example = $('textarea[name=cdlContent_example]').val();
          $('textarea[name=cdlContent_example]').val(content_example + '¡¡¡Texto dinámico!!!');
          $('div.cdlContent_final').append(add);
          break;
        case 'Numérico':
          var add = "<input type='text' maxlength='2' pattern='[0-9]{1," + long + "}' placeholder='Campo de número' disabled>";
          var content_example = $('textarea[name=cdlContent_example]').val();
          $('textarea[name=cdlContent_example]').val(content_example + '¡¡¡Número dinámico!!!');
          $('div.cdlContent_final').append(add);
          break;
        case 'Moneda':
          var add = "<input type='text' maxlength='10' pattern='[0-9]{1," + long + "}' placeholder='Campo de móneda' disabled>";
          var content_example = $('textarea[name=cdlContent_example]').val();
          $('textarea[name=cdlContent_example]').val(content_example + '¡¡¡Moneda dinámica!!!');
          $('div.cdlContent_final').append(add);
          break;
        case 'Calendario':
          var add = "<input type='text' maxlength='" + long + "' placeholder='Campo de fecha' disabled>";
          var content_example = $('textarea[name=cdlContent_example]').val();
          $('textarea[name=cdlContent_example]').val(content_example + '¡¡¡Calendario dinámico!!!');
          $('div.cdlContent_final').append(add);
          break;
      }
    }
  });

  $('.editDocument-link').on('click', function(e) {
    e.preventDefault();
    var cdlId = $(this).find('span:nth-child(2)').text();
    var cdlDocument_id = $(this).find('span:nth-child(3)').text();
    var cdlContent = $(this).find('span:nth-child(4)').text();
    $('input[name=cdlId_Edit]').val(cdlId);
    $('select[name=cdlDocument_id_Edit]').val(cdlDocument_id);
    var code = $('select[name=cdlDocument_id_Edit] option:selected').attr('data-code');
    var version = $('select[name=cdlDocument_id_Edit] option:selected').attr('data-version');
    $('input[name=dolCode_Edit]').val(code);
    $('input[name=dolVersion_Edit]').val(version);
    $('select[name=valId_Edit]').empty();
    $('select[name=valId_Edit]').append("<option value=''>Seleccione ...</option>");
    $.get("{{ route('getVariablesFromDocumentLogistic') }}", {
      dolId: cdlDocument_id
    }, function(objectVariables) {
      var count = Object.keys(objectVariables).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          $('select[name=valId_Edit]').append(
            "<option value='" + objectVariables[i]['valId'] + "' data-type='" + objectVariables[i]['valType'] + "' data-longitud='" + objectVariables[i]['valLongitud'] + "'>" +
            objectVariables[i]['valName'] +
            "</option>"
          );
        }
      }
    });
    $('textarea[name=cdlContent_example_Edit]').val(cdlContent);
    var contentFinal = showContent(cdlContent);
    $('div.cdlContent_final_Edit').html(contentFinal);
    $('#editDocument-modal').modal();
  });

  $('textarea[name=cdlContent_example_Edit]').on('keyup', function(e) {
    var writed = e.target.value;
    var contentFinal = showContent(writed);
    $('div.cdlContent_final_Edit').html(contentFinal);
  });

  $('select[name=cdlDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode_Edit]').val('');
    $('input[name=dolVersion_Edit]').val('');
    $('select[name=valId_Edit]').empty();
    $('select[name=valId_Edit]').append("<option value=''>Seleccione ...</option>");
    $('input[name=valType_Edit]').val('');
    $('input[name=valLongitud_Edit]').val('');
    if (selected != '') {
      var code = $('select[name=cdlDocument_id_Edit] option:selected').attr('data-code');
      var version = $('select[name=cdlDocument_id_Edit] option:selected').attr('data-version');
      $('input[name=dolCode_Edit]').val(code);
      $('input[name=dolVersion_Edit]').val(version);
      $.get("{{ route('getVariablesFromDocumentLogistic') }}", {
        dolId: selected
      }, function(objectVariables) {
        var count = Object.keys(objectVariables).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=valId_Edit]').append(
              "<option value='" + objectVariables[i]['valId'] + "' data-type='" + objectVariables[i]['valType'] + "' data-longitud='" + objectVariables[i]['valLongitud'] + "'>" +
              objectVariables[i]['valName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  $('select[name=valId_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=valType_Edit]').val('');
    $('input[name=valLongitud_Edit]').val('');
    if (selected != '') {
      var type = $('select[name=valId_Edit] option:selected').attr('data-type');
      var longitud = $('select[name=valId_Edit] option:selected').attr('data-longitud');
      $('input[name=valType_Edit]').val(type);
      $('input[name=valLongitud_Edit]').val(longitud);
    }
  });

  $('.addVariable_edit').on('click', function(e) {
    e.preventDefault();
    var selected = $('select[name=valId_Edit]').val();
    if (selected != '') {
      var type = $('select[name=valId_Edit] option:selected').attr('data-type');
      var long = $('select[name=valId_Edit] option:selected').attr('data-longitud');
      console.log(type);
      switch (type) {
        case 'Texto':
          var add = "<input type='text' placeholder='Campo de texto' maxlength='" + long + "' disabled>";
          var content_example = $('textarea[name=cdlContent_example_Edit]').val();
          $('textarea[name=cdlContent_example_Edit]').val(content_example + '¡¡¡Texto dinámico!!!');
          $('div.cdlContent_final_Edit').append(add);
          break;
        case 'Numérico':
          var add = "<input type='text' maxlength='" + long + "' pattern='[0-9]{1," + long + "}' placeholder='Campo de número' disabled>";
          var content_example = $('textarea[name=cdlContent_example_Edit]').val();
          $('textarea[name=cdlContent_example_Edit]').val(content_example + '¡¡¡Número dinámico!!!');
          $('div.cdlContent_final_Edit').append(add);
          break;
        case 'Moneda':
          var add = "<input type='text' maxlength='10' pattern='[0-9]{1," + long + "}' placeholder='Campo de móneda' disabled>";
          var content_example = $('textarea[name=cdlContent_example_Edit]').val();
          $('textarea[name=cdlContent_example_Edit]').val(content_example + '¡¡¡Moneda dinámica!!!');
          $('div.cdlContent_final_Edit').append(add);
          break;
        case 'Calendario':
          var add = "<input type='text' maxlength='" + long + "' placeholder='Campo de fecha' disabled>";
          var content_example = $('textarea[name=cdlContent_example_Edit]').val();
          $('textarea[name=cdlContent_example_Edit]').val(content_example + '¡¡¡Calendario dinámico!!!');
          $('div.cdlContent_final_Edit').append(add);
          break;
      }
    }
  });

  function showContent(writed) {
    const text = /¡¡¡Texto dinámico!!!/gi;
    const number = /¡¡¡Número dinámico!!!/gi;
    const money = /¡¡¡Moneda dinámica!!!/gi;
    const calendar = /¡¡¡Calendario dinámico!!!/gi;
    var newTexto = writed.replace(text, "<input type='text' placeholder='Campo de texto' disabled>");
    var newNumber = newTexto.replace(number, "<input type='text' maxlength='2' pattern='[0-9]{1,2}' placeholder='Campo de número' disabled>");
    var newMoney = newNumber.replace(money, "<input type='text' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de móneda' disabled>");
    var element = newMoney.replace(calendar, "<input type='text' maxlength='10' pattern='[0-9]{1,10}' placeholder='Campo de fecha' disabled>");
    return element;
  }

  $('.deleteDocument-link').on('click', function(e) {
    e.preventDefault();
    var cdlId = $(this).find('span:nth-child(2)').text();
    var cdlDocument = $(this).find('span:nth-child(3)').text();
    var cdlContent = $(this).find('span:nth-child(4)').text();
    $('input[name=cdlId_Delete]').val(cdlId);
    $('b.cdlDocument_Delete').text(cdlDocument);
    var contentFinal = showContent(cdlContent);
    $('div.cdlContent_final_Delete').html(contentFinal);
    $('#deleteDocument-modal').modal();
  });
</script>
@endsection