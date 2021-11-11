@extends('modules.integralOperative')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>CONFIGURACION DOCUMENTO</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newDocument-link">Nuevo</button>
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
      @foreach ($configuration as $config)
      <tr>
        <td>{{$row++}}</td>
        <td>{{$config->document->doOName}}</td>
        <td>
          @php
          $data = str_split($config->cdoContent);
          $num=0;
          foreach($data as $key => $item){
          if($key >= 70 & $item == " "){
          break;
          }
          print($item);
          }
          @endphp
          ...
        </td>
        <td>
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editDocument-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $config->cdoId }}</span>
            <span hidden>{{ $config->cdoDocument_id }}</span>
            <span hidden>{{ $config->cdoContent }}</span>
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteDocument-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $config->cdoId }}</span>
            <span hidden>{{ $config->document->doOName }}</span>
            <span hidden>{{ $config->cdoContent }}</span>
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
{{-- formulario de Creación --}}
<div class="modal fade" id="newDocumentOp-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVA CONFIGURACION DE DOCUMENTO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('operative.configuration.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DOCUMENTO:</small>
                    <select name="cdoDocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione un documento ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->doOId }}" data-code="{{ $document->doOCode }}" data-version="{{ $document->doOVersion }}">{{ $document->doOName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="doOCode" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="doOVersion" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE VARIABLE:</small>
                    <select name="valOId" class="form-control form-control-sm">
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
                    <input type="text" name="valOType" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">LONGITUD:</small>
                    <input type="text" name="valOLongitud" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">ESCRIBA CONTENIDO AQUI:</small>
                    <textarea name="cdoContent" id="TextContent" cols="30" rows="10"></textarea>
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

{{-- Formulario de Edición --}}
<div class="modal fade" id="editDocumentOp-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>MODIFICACION DE CONFIGURACION:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('operative.configuration.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DOCUMENTO:</small>
                    <select name="cdoDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione un documento ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->doOId }}" data-code="{{ $document->doOCode }}" data-version="{{ $document->doOVersion }}">{{ $document->doOName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="doOCode_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="doOVersion_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE VARIABLE:</small>
                    <select name="valOId_Edit" class="form-control form-control-sm">
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
                    <input type="text" name="valOType_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">LONGITUD:</small>
                    <input type="text" name="valOLongitud_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">ESCRIBA CONTENIDO AQUI:</small>
                    <textarea name="cdoContent_Edit" id="TextContentEdit" cols="30" rows="10"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="cdoId_Edit" readonly required>
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

{{-- formulario de eliminación --}}
<div class="modal fade" id="deleteDocumentOp-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>ELIMINACION DE CONFIGURACION:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <small class="text-muted">DOCUMENTO: </small><br>
            <span class="text-muted"><b class="cdoDocument_Delete"></b></span><br>
            <small class="text-muted">CONTENIDO: </small><br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 p-2 border cdoContent_final_Delete" style="font-size: 12px; text-align: justify;">

          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('operative.configuration.delete') }}" method="POST" class="col-md-6 DeleteSend">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="cdoId_Delete" readonly required>
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
  // !implementación ckeditor
  let MyEditor;
  ClassicEditor
    .create(document.querySelector('#TextContent'), {
      fontColor: {
        colors: [{
            color: '#000000',
            label: 'Black',
            hasBorder: true
          },
          {
            color: '#4D4D4D',
            label: 'Dim grey',
            hasBorder: true
          },
          {
            color: '#999999',
            label: 'Grey',
            hasBorder: true
          },
          {
            color: '#E6E6E6',
            label: 'Light grey',
            hasBorder: true
          },
          {
            color: '#FFFFFF',
            label: 'White',
            hasBorder: true
          },
          {
            color: '#e3342f',
            label: 'Red',
            hasBorder: true
          },
          {
            color: '#0086f9',
            label: 'Blue',
            hasBorder: true
          },
          {
            color: '#ffed4a',
            label: 'Yellow',
            hasBorder: true
          },
          {
            color: '#fd8701',
            label: 'Orange',
            hasBorder: true
          },
          {
            color: '#627700',
            label: 'Green',
            hasBorder: true
          }
        ]
      },
    })
    .then(editor => {
      MyEditor = editor;
    })
    .catch(error => {
      console.error(error);
    });

  // Lanza formulario de creación
  $('.newDocument-link').on('click', function() {
    $('#newDocumentOp-modal').modal();
  });

  // seleccion de mi campo Documento y carga info en codigo y version, carga lista tipo de variable
  $('select[name=cdoDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=doOCode]').val('');
    $('input[name=doOVersion]').val('');
    $('select[name=valOId]').empty();
    $('select[name=valOId]').append("<option value=''>Seleccione ...</option>");
    $('input[name=valOType]').val('');
    $('input[name=valOLongitud]').val('');
    if (selected != '') {
      var code = $('select[name=cdoDocument_id] option:selected').attr('data-code');
      var version = $('select[name=cdoDocument_id] option:selected').attr('data-version');
      $('input[name=doOCode]').val(code);
      $('input[name=doOVersion]').val(version);
      // cargo mi ruta desde api.php
      $.get("{{ route('getVariablesFromDocumentOperative') }}", {
        doOId: selected
      }, function(objectVariables) {
        var count = Object.keys(objectVariables).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=valOId]').append(
              "<option value='" + objectVariables[i]['valOId'] + "' data-type='" + objectVariables[i]['valOType'] + "' data-longitud='" + objectVariables[i]['valOLongitud'] + "'>" +
              objectVariables[i]['valOName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // seleccion de mi campo tipo de variable y llamada a la info
  $('select[name=valOId]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=valOType]').val('');
    $('input[name=valOLongitud]').val('');
    if (selected != '') {
      var type = $('select[name=valOId] option:selected').attr('data-type');
      var longitud = $('select[name=valOId] option:selected').attr('data-longitud');
      $('input[name=valOType]').val(type);
      $('input[name=valOLongitud]').val(longitud);
    }
  });

  // agrega las variables a mi cuadro de texto despues de cliquear btn_agregar variable
  $('.addVariable_new').on('click', function(e) {
    e.preventDefault();
    var selected = $('select[name=valOId]').val();
    if (selected != '') {
      var type = $('select[name=valOId] option:selected').attr('data-type');
      var long = $('select[name=valOId] option:selected').attr('data-longitud');
      switch (type) {
        case 'Texto':
          var add = "<input type='text' placeholder='Campo de texto' maxlength='" + long + "' disabled>";
          var content_example = MyEditor.getData();
          MyEditor.setData(`${content_example} <u><i><b>¡¡¡Texto dinámico!!!</b></i></u>`);
          break;
        case 'Numérico':
          var add = "<input type='text' maxlength='2' pattern='[0-9]{1," + long + "}' placeholder='Campo de número' disabled>";
          var content_example = MyEditor.getData();
          MyEditor.setData(`${content_example} <u><i><b>¡¡¡Número dinámico!!!</b></i></u>`);
          break;
        case 'Moneda':
          var add = "<input type='text' maxlength='10' pattern='[0-9]{1," + long + "}' placeholder='Campo de móneda' disabled>";
          var content_example = MyEditor.getData();
          MyEditor.setData(`${content_example} <u><i><b>¡¡¡Moneda dinámica!!!</b></i></u>`);
          break;
        case 'Calendario':
          var add = "<input type='text' maxlength='" + long + "' placeholder='Campo de fecha' disabled>";
          var content_example = MyEditor.getData();
          MyEditor.setData(`${content_example} <u><i><b>¡¡¡Calendario dinámico!!!</b></i></u>`);
          break;
      }
    }
  });

  let MyEditorEdit;
  ClassicEditor
    .create(document.querySelector('#TextContentEdit'), {
      fontColor: {
        colors: [{
            color: '#000000',
            label: 'Black',
            hasBorder: true
          },
          {
            color: '#4D4D4D',
            label: 'Dim grey',
            hasBorder: true
          },
          {
            color: '#999999',
            label: 'Grey',
            hasBorder: true
          },
          {
            color: '#E6E6E6',
            label: 'Light grey',
            hasBorder: true
          },
          {
            color: '#FFFFFF',
            label: 'White',
            hasBorder: true
          },
          {
            color: '#e3342f',
            label: 'Red',
            hasBorder: true
          },
          {
            color: '#0086f9',
            label: 'Blue',
            hasBorder: true
          },
          {
            color: '#ffed4a',
            label: 'Yellow',
            hasBorder: true
          },
          {
            color: '#fd8701',
            label: 'Orange',
            hasBorder: true
          },
          {
            color: '#627700',
            label: 'Green',
            hasBorder: true
          }
        ]
      },
    })
    .then(editor => {
      MyEditorEdit = editor;
    })
    .catch(error => {
      console.error(error);
    });


  // Lanza mi formulario de edición 
  $('.editDocument-link').on('click', function(e) {
    Swal.fire({
      title: 'Desea editar este registro?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#f58f4d',
      confirmButtonText: 'Si, editar',
      cancelButtonText: 'No',
      showClass: {
        popup: 'animate__animated animate__flipInX'
      },
      hideClass: {
        popup: 'animate__animated animate__flipOutX'
      },
    }).then((result) => {
      if (result.isConfirmed) {
        e.preventDefault();
        var cdoId = $(this).find('span:nth-child(2)').text();
        var cdoDocument_id = $(this).find('span:nth-child(3)').text();
        var cdoContent = $(this).find('span:nth-child(4)').text();
        $('input[name=cdoId_Edit]').val(cdoId);
        $('select[name=cdoDocument_id_Edit]').val(cdoDocument_id);
        var code = $('select[name=cdoDocument_id_Edit] option:selected').attr('data-code');
        var version = $('select[name=cdoDocument_id_Edit] option:selected').attr('data-version');
        $('input[name=doOCode_Edit]').val(code);
        $('input[name=doOVersion_Edit]').val(version);
        $('select[name=valOId_Edit]').empty();
        $('select[name=valOId_Edit]').append("<option value=''>Seleccione ...</option>");
        // carga mis listas desde la api.php
        $.get("{{ route('getVariablesFromDocumentOperative') }}", {
          doOId: cdoDocument_id
        }, function(objectVariables) {
          var count = Object.keys(objectVariables).length;
          if (count > 0) {
            for (var i = 0; i < count; i++) {
              $('select[name=valOId_Edit]').append(
                "<option value='" + objectVariables[i]['valOId'] + "' data-type='" + objectVariables[i]['valOType'] + "' data-longitud='" + objectVariables[i]['valOLongitud'] + "'>" +
                objectVariables[i]['valOName'] +
                "</option>"
              );
            }
          }
        });
        MyEditorEdit.setData(cdoContent);
        $('#editDocumentOp-modal').modal();
      }
    })
  });

  // seleccion de mi campo Documento y carga info en codigo y version, carga lista tipo de variable
  $('select[name=cdoDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=doOCode_Edit]').val('');
    $('input[name=doOVersion_Edit]').val('');
    $('select[name=valOId_Edit]').empty();
    $('select[name=valOId_Edit]').append("<option value=''>Seleccione ...</option>");
    $('input[name=valOType_Edit]').val('');
    $('input[name=valOLongitud_Edit]').val('');
    if (selected != '') {
      var code = $('select[name=cdoDocument_id_Edit] option:selected').attr('data-code');
      var version = $('select[name=cdoDocument_id_Edit] option:selected').attr('data-version');
      $('input[name=doOCode_Edit]').val(code);
      $('input[name=doOVersion_Edit]').val(version);
      // cargo mi ruta desde api.php
      $.get("{{ route('getVariablesFromDocumentOperative') }}", {
        doOId: selected
      }, function(objectVariables) {
        var count = Object.keys(objectVariables).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=valOId_Edit]').append(
              "<option value='" + objectVariables[i]['valOId'] + "' data-type='" + objectVariables[i]['valOType'] + "' data-longitud='" + objectVariables[i]['valOLongitud'] + "'>" +
              objectVariables[i]['valOName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // seleccion de mi campo tipo de variable y llamada a la info
  $('select[name=valOId_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=valOType_Edit]').val('');
    $('input[name=valOLongitud_Edit]').val('');
    if (selected != '') {
      var type = $('select[name=valOId_Edit] option:selected').attr('data-type');
      var longitud = $('select[name=valOId_Edit] option:selected').attr('data-longitud');
      $('input[name=valOType_Edit]').val(type);
      $('input[name=valOLongitud_Edit]').val(longitud);
    }
  });

  // agrega las variables a mi cuadro de texto despues de cliquear btn_agregar variable
  $('.addVariable_edit').on('click', function(e) {
    e.preventDefault();
    var selected = $('select[name=valOId_Edit]').val();
    if (selected != '') {
      var type = $('select[name=valOId_Edit] option:selected').attr('data-type');
      var long = $('select[name=valOId_Edit] option:selected').attr('data-longitud');
      switch (type) {
        case 'Texto':
          var add = "<input type='text' placeholder='Campo de texto' maxlength='" + long + "' disabled>";
          var content_example = MyEditorEdit.getData();
          MyEditorEdit.setData(`${content_example} <u><i><b>¡¡¡Texto dinámico!!!</b></i></u>`);
          break;
        case 'Numérico':
          var add = "<input type='text' maxlength='2' pattern='[0-9]{1," + long + "}' placeholder='Campo de número' disabled>";
          var content_example = MyEditorEdit.getData();
          MyEditorEdit.setData(`${content_example} <u><i><b>¡¡¡Número dinámico!!!</b></i></u>`);
          break;
        case 'Moneda':
          var add = "<input type='text' maxlength='10' pattern='[0-9]{1," + long + "}' placeholder='Campo de móneda' disabled>";
          var content_example = MyEditorEdit.getData();
          MyEditorEdit.setData(`${content_example} <u><i><b>¡¡¡Moneda dinámica!!!</b></i></u>`);
          break;
        case 'Calendario':
          var add = "<input type='text' maxlength='" + long + "' placeholder='Campo de fecha' disabled>";
          var content_example = MyEditorEdit.getData();
          MyEditorEdit.setData(`${content_example} <u><i><b>¡¡¡Calendario dinámico!!!</b></i></u>`);
          break;
      }
    }
  });

  // configuración escritura writed de mi textarea
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

  // Lanza el formulario de eliminación
  $('.deleteDocument-link').on('click', function(e) {
    e.preventDefault();
    var cdoId = $(this).find('span:nth-child(2)').text();
    var cdoDocument = $(this).find('span:nth-child(3)').text();
    var cdoContent = $(this).find('span:nth-child(4)').text();
    $('input[name=cdoId_Delete]').val(cdoId);
    $('b.cdoDocument_Delete').text(cdoDocument);
    var contentFinal = showContent(cdoContent);
    $('div.cdoContent_final_Delete').html(contentFinal);
    $('#deleteDocumentOp-modal').modal();
  });
  // envio formulario de eliminación
  $('.DeleteSend').submit('click', function(e) {
    e.preventDefault();
    Swal.fire({
      title: '¡¡Eliminación!!',
      text: "Desea continuar con la eliminación",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#f58f4d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'No',
      showClass: {
        popup: 'animate__animated animate__flipInX'
      },
      hideClass: {
        popup: 'animate__animated animate__flipOutX'
      },
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    })
  })
</script>
@if(session('SuccessDocument'))
<script>
  Swal.fire({
    icon: 'success',
    title: '¡creado con exito!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@if(session('SecondaryDocument'))
<script>
  Swal.fire({
    icon: 'error',
    title: 'Oops..',
    text: '¡configuración del documento existente!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@if(session('PrimaryDocument'))
<script>
  Swal.fire({
    icon: 'success',
    title: '¡configuración de documento actualizada!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@if(session('SecondaryDocument') == "Configuración no encontrada")
<script>
  Swal.fire({
    icon: 'error',
    title: 'Oops..',
    text: '¡configuración del documento no encontrada!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@if(session('WarningDocument'))
<script>
  Swal.fire({
    icon: 'success',
    title: '¡eliminado con exito!',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    showClass: {
      popup: 'animate__animated animate__flipInX'
    },
    hideClass: {
      popup: 'animate__animated animate__flipOutX'
    }
  })
</script>
@endif
@endsection