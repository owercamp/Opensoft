@extends('modules.logisticProviders')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h6>MINUTA DE CONTRATO</h6>
    </div>
    <div class="col-md-4">
      <button type="button" title="REGISTRAR NUEVO CONTRATO" class="btn btn-outline-success form-control-sm newBill-link">NUEVO</button>
    </div>
    <div class="col-md-4" style="font-size: 12px;">
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
        <th>PROVEEDOR</th>
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
        <td>{{ $bill->provider->proReasonsocial }}</td>
        <td>{{ $bill->document->dolName }}</td>
        <td>{{ $bill->bpDocumentcode }}</td>
        <td>
          @if(strlen($bill->bpContentfinal) > 20)
          {{ substr($bill->bpContentfinal,0,20) . ' ...' }}
          @else
          {{ $bill->bpContentfinal }}
          @endif
        </td>
        <td class="d-flex justofy-content-center">
          @if($bill->bcoStatus != 'TERMINADO')
          <a href="#" title="EDITAR CONTRATO" class="btn btn-outline-primary rounded-circle form-control-sm editBill-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $bill->bpId }}</span>
            <span hidden>{{ $bill->bpDocument_id }}</span>
            <span hidden>{{ $bill->bpDocumentcode }}</span>
            <span hidden>{{ $bill->document->dolVersion }}</span>
            <span hidden>{{ $bill->provider->proReasonsocial }}</span>
            <span hidden>{{ $bill->provider->proNumberdocument }}</span>
            <span hidden>{{ $bill->bpConfigdocument_id }}</span>
            <span hidden>{{ $bill->bpContentfinal }}</span>
            <span hidden>{{ $bill->bpWrited }}</span>
          </a>
          <a href="#" title="RECHAZAR CONTRATO" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteBill-link">
            <i class="fas fa-times"></i>
            <span hidden>{{ $bill->bpId }}</span>
            <span hidden>{{ $bill->document->dolName }}</span>
            <span hidden>{{ $bill->bpDocumentcode }}</span>
            <span hidden>{{ $bill->document->dolVersion }}</span>
            <span hidden>{{ $bill->provider->proReasonsocial }}</span>
            <span hidden>{{ $bill->provider->proNumberdocument }}</span>
            <span hidden>{{ $bill->bpContentfinal }}</span>
          </a>
          <form action="{{ route('providers.bill.aproved') }}" method="POST" style="display: inline-block;">
            @csrf
            <input type="hidden" name="bpId" value="{{ $bill->bpId }}" class="form-control form-control-sm" required>
            <button type="submit" title="APROBAR CONTRATO" class="btn btn-outline-success rounded-circle form-control-sm">
              <i class="fas fa-plus"></i>
            </button>
          </form>
          <form action="{{ route('providers.bill.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="bpId" value="{{ $bill->bpId }}" class="form-control form-control-sm" required>
            <button type="submit" title="DESCARGAR PDF" class="btn btn-outline-danger rounded-circle form-control-sm">
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

<div class="modal fade" id="newBill-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h6>NUEVA MINUTA DE CONTRATO:</h6>
      </div>
      <div class="modal-body">
        <form action="{{ route('providers.bill.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">PROVEEDOR:</small>
                    <select name="bpProvider_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($providers as $provider)
                      <option value="{{ $provider->proId }}" data-document="{{ $provider->proNumberdocument }}">{{ $provider->proReasonsocial }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                    <input type="text" name="proNumberdocument" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="bpDocument_id" class="form-control form-control-sm" required>
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
                    <select name="bpConfigdocument_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="bpTemplate" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border bpContentfinal" style="font-size: 12px;">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <input type="hidden" name="bpVariables" class="form-control form-control-sm" readonly required>
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
        <form action="{{ route('providers.bill.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">PROVEEDOR:</small>
                    <input type="text" name="proReasonsocial_Edit" class="form-control form-control-sm" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                    <input type="text" name="proNumberdocument_Edit" class="form-control form-control-sm" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="bpDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="bpDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
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
                    <select name="bpConfigdocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                    </select>
                    <input type="hidden" name="bpTemplate_Edit" class="form-control form-control-sm" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 p-2 border bpContentfinal_Edit" style="font-size: 12px;">

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
              <input type="hidden" name="bpVariables_Edit" class="form-control form-control-sm" readonly required>
              <input type="hidden" class="form-control form-control-sm" name="bpId_Edit" readonly required>
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
            <small class="text-muted">PROVEEDOR: </small><br>
            <span class="text-muted"><b class="proReasonsocial_Delete"></b></span><br>
            <small class="text-muted">NUMERO DE IDENTIFICACION: </small><br>
            <span class="text-muted"><b class="proNumberdocument_Delete"></b></span><br>
            <small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="dolName_Delete"></b></span><br>
            <small class="text-muted">CODIGO DE DOCUMENTO: </small><br>
            <span class="text-muted"><b class="dolCode_Delete"></b></span><br>
            <small class="text-muted">VERSION DEL DOCUMENTO: </small><br>
            <span class="text-muted"><b class="dolVersion_Delete"></b></span><br>
            <small class="text-muted">CONTENIDO: </small><br>
            <span class="text-muted"><b class="bpContentfinal_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('providers.bill.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="bpId_Delete" readonly required>
            <button type="submit" class="btn btn-outline-danger form-control-sm my-3">RECHAZAR</button>
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

  $('select[name=bpProvider_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=proNumberdocument]').val('');
    if (selected != '') {
      var numberDocument = $('select[name=bpProvider_id] option:selected').attr('data-document');
      $('input[name=proNumberdocument]').val(numberDocument);
    }
  });

  $('select[name=bpDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion]').val('');
    $('input[name=dolCode]').val('');
    $('select[name=bpConfigdocument_id]').empty();
    $('select[name=bpConfigdocument_id]').append("<option value=''>Seleccione ...</option>");
    $('div.bpContentfinal').empty();
    if (selected != '') {
      var version = $('select[name=bpDocument_id] option:selected').attr('data-version');
      var code = $('select[name=bpDocument_id] option:selected').attr('data-code');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForBillprovider') }}", {
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
              $('select[name=bpConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=bpConfigdocument_id]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=bpConfigdocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=bpTemplate]').val('');
    $('div.bpContentfinal').empty();
    if (selected != '') {
      var content = $('select[name=bpConfigdocument_id] option:selected').attr('data-content');
      $('input[name=bpTemplate]').val(content);
      $('div.bpContentfinal').append(showContent(content));
    }
  });

  $('div.bpContentfinal').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=bpVariables]').val('');
    $('div.bpContentfinal > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=bpVariables]').val(all);
  });

  $('.editBill-link').on('click', function(e) {
    e.preventDefault();
    var bpId = $(this).find('span:nth-child(2)').text();
    var bpDocument_id = $(this).find('span:nth-child(3)').text();
    var dolCode = $(this).find('span:nth-child(4)').text();
    var dolVersion = $(this).find('span:nth-child(5)').text();
    var proReasonsocial = $(this).find('span:nth-child(6)').text();
    var proNumberdocument = $(this).find('span:nth-child(7)').text();
    var bpConfigdocument_id = $(this).find('span:nth-child(8)').text();
    var bpContentfinal = $(this).find('span:nth-child(9)').text();
    var bpWrited = $(this).find('span:nth-child(10)').text();
    $('input[name=bpId_Edit]').val(bpId);
    $('select[name=bpDocument_id_Edit]').val(bpDocument_id);
    $('input[name=dolCode_Edit]').val(dolCode);
    $('input[name=dolCode_hidden_Edit]').val(dolCode);
    $('input[name=dolVersion_Edit]').val(dolVersion);
    $('input[name=proReasonsocial_Edit]').val(proReasonsocial);
    $('input[name=proNumberdocument_Edit]').val(proNumberdocument);
    $('input[name=bpVariables_Edit]').val(bpWrited + '!!==¡¡');
    var contentAll = '';
    $('select[name=bpConfigdocument_id_Edit]').empty();
    $('select[name=bpConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('input[name=bpDocument_id_hidden_Edit]').val(bpDocument_id);
    $.get("{{ route('getContentFromDocumentLogistic') }}", {
      dolId: bpDocument_id
    }, function(objectsConfig) {
      var count = Object.keys(objectsConfig).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectsConfig[i]['cdlContent'].length > 100) {
            var chain = objectsConfig[i]['cdlContent'].substring(0, 100) + ' ...';
            if (bpConfigdocument_id == objectsConfig[i]['cdlId']) {
              $('select[name=bpConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + chain + "</option>"
              );
              $('input[name=bpTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
              $('div.bpContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
            } else {
              $('select[name=bpConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            }
          } else {
            if (bpConfigdocument_id == objectsConfig[i]['cdlId']) {
              $('select[name=bpConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "' selected>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
              $('input[name=bpTemplate_Edit]').val(objectsConfig[i]['cdlContent']);
              $('div.bpContentfinal_Edit').html(showContent(objectsConfig[i]['cdlContent']));
            } else {
              $('select[name=bpConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
        var separatedVariables = bpWrited.split("!!==¡¡");
        var item;
        for (var i = 0; i < separatedVariables.length; i++) {
          item = separatedVariables[i].split('=>');
          $('div.bpContentfinal_Edit > .field-dinamic').each(function() {
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

  $('select[name=bpDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion_Edit]').val('');
    $('input[name=dolCode_Edit]').val('');
    $('select[name=bpConfigdocument_id_Edit]').empty();
    $('select[name=bpConfigdocument_id_Edit]').append("<option value=''>Seleccione ...</option>");
    $('div.bpContentfinal_Edit').empty();
    if (selected != '') {
      var version = $('select[name=bpDocument_id_Edit] option:selected').attr('data-version');
      var code = $('select[name=bpDocument_id_Edit] option:selected').attr('data-code');
      var dolId = $('input[name=bpDocument_id_hidden_Edit]').val();
      $('input[name=dolVersion_Edit]').val(version);
      if (selected == dolId) {
        $('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
      } else {
        $.get("{{ route('getNextcodeForBillprovider') }}", {
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
              $('select[name=bpConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + chain + "</option>"
              );
            } else {
              $('select[name=bpConfigdocument_id_Edit]').append(
                "<option value='" + objectsConfig[i]['cdlId'] + "' data-content='" + objectsConfig[i]['cdlContent'] + "'>" + objectsConfig[i]['cdlContent'] + "</option>"
              );
            }
          }
        }
      });
    }
  });

  $('select[name=bpConfigdocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=bpTemplate_Edit]').val('');
    $('div.bpContentfinal_Edit').empty();
    if (selected != '') {
      var content = $('select[name=bpConfigdocument_id_Edit] option:selected').attr('data-content');
      $('input[name=bpTemplate_Edit]').val(content);
      $('div.bpContentfinal_Edit').append(showContent(content));
    }
  });

  $('div.bpContentfinal_Edit').on('keyup change', '.field-dinamic', function() {
    var value = $(this).val();
    var element = $(this);
    var type = $(this).attr('data-type');
    var all = '';
    $('input[name=bpVariables_Edit]').val('');
    $('div.bpContentfinal_Edit > .field-dinamic').each(function() {
      var value = $(this).val();
      var type = $(this).attr('data-type');
      if (value != '') {
        all += value + '=>' + type + '!!==¡¡';
      } else {
        all += 'NOT!!==¡¡';
      }
    });
    $('input[name=bpVariables_Edit]').val(all);
  });

  $('.deleteBill-link').on('click', function(e) {
    e.preventDefault();
    var bpId = $(this).find('span:nth-child(2)').text();
    var dolName = $(this).find('span:nth-child(3)').text();
    var dolCode = $(this).find('span:nth-child(4)').text();
    var dolVersion = $(this).find('span:nth-child(5)').text();
    var proReasonsocial = $(this).find('span:nth-child(6)').text();
    var proNumberdocument = $(this).find('span:nth-child(7)').text();
    var bpContentfinal = $(this).find('span:nth-child(8)').text();
    $('input[name=bpId_Delete]').val(bpId);
    $('b.dolName_Delete').text(dolName);
    $('b.dolCode_Delete').text(dolCode);
    $('b.dolVersion_Delete').text(dolVersion);
    $('b.proReasonsocial_Delete').text(proReasonsocial);
    $('b.proNumberdocument_Delete').text(proNumberdocument);
    $('b.bpContentfinal_Delete').text(bpContentfinal);
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