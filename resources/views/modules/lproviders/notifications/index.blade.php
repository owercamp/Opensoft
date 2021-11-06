@extends('modules.logisticProviders')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-6">
      <h6>NOTIFICACIONES</h6>
    </div>
    <div class="col-md-2">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newNotification-link">NUEVO</button>
    </div>
    <div class="col-md-4" style="font-size: 12px;">
      @if(session('SuccessNotification'))
      <div class="alert alert-success">
        {{ session('SuccessNotification') }}
      </div>
      @endif
      @if(session('PrimaryNotification'))
      <div class="alert alert-primary">
        {{ session('PrimaryNotification') }}
      </div>
      @endif
      @if(session('WarningNotification'))
      <div class="alert alert-warning">
        {{ session('WarningNotification') }}
      </div>
      @endif
      @if(session('SecondaryNotification'))
      <div class="alert alert-secondary">
        {{ session('SecondaryNotification') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>PROVEEDOR</th>
        <th>CODIGO DE REGISTRO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($notifications as $notification)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $notification->npDate }}</td>
        <td>{{ $notification->bill->provider->proReasonsocial }}</td>
        <td>{{ $notification->npDocumentcode }}</td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="EDITAR" class="btn btn-outline-primary rounded-circle form-control-sm editNotification-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $notification->npId }}</span>
            <span hidden>{{ $notification->bill->provider->proReasonsocial }}</span>
            <span hidden>{{ $notification->bill->provider->document->perName }}</span>
            <span hidden>{{ $notification->bill->provider->proNumberdocument }}</span>
            <span hidden>{{ $notification->npDocumentcode }}</span>
            <span hidden>{{ $notification->bill->provider->proAddress }}</span>
            <span hidden>{{ $notification->bill->provider->proEmail }}</span>
            <span hidden>{{ $notification->bill->provider->proPhone }}</span>
            <span hidden>{{ $notification->bill->provider->proMovil }}</span>
            <span hidden>{{ $notification->bill->provider->proWhatsapp }}</span>
            <span hidden>{{ $notification->npNotification }}</span>
            <span hidden>{{ $notification->npDate }}</span>
          </a>
          <a href="#" title="ELIMINAR" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteNotification-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $notification->npId }}</span>
            <span hidden>{{ $notification->bill->provider->proReasonsocial }}</span>
            <span hidden>{{ $notification->bill->provider->document->perName }}</span>
            <span hidden>{{ $notification->bill->provider->proNumberdocument }}</span>
            <span hidden>{{ $notification->npDocumentcode }}</span>
            <span hidden>{{ $notification->bill->provider->proAddress }}</span>
            <span hidden>{{ $notification->bill->provider->proEmail }}</span>
            <span hidden>{{ $notification->bill->provider->proPhone }}</span>
            <span hidden>{{ $notification->bill->provider->proMovil }}</span>
            <span hidden>{{ $notification->bill->provider->proWhatsapp }}</span>
            <span hidden>{{ $notification->npNotification }}</span>
            <span hidden>{{ $notification->npDate }}</span>
          </a>
          <form action="{{ route('providers.notification.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="npId" value="{{ $notification->npId }}" class="form-control form-control-sm" required>
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

<div class="modal fade" id="newNotification-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO REGISTRO DE NOTIFICACIONES:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('providers.notification.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="npDocument_id" class="form-control form-control-sm" required>
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
                    <small class="text-muted">CONTRATO COLABORADOR:</small>
                    <select name="npLegalization_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($legalizations as $legalization)
                      <option value="{{ $legalization->bpId }}" data-names='{{ $legalization->proReasonsocial }}' data-type='{{ $legalization->perName }}' data-document='{{ $legalization->proNumberdocument }}' data-address='{{ $legalization->proAddress }}' data-email='{{ $legalization->proEmail }}' data-movil='{{ $legalization->proMovil }}' data-phone='{{ $legalization->proPhone }}' data-whatsapp='{{ $legalization->proWhatsapp }}'>
                        {{ $legalization->proReasonsocial }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="npDate" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
              </div>
              <div class="row border m-3 p-3">
                <div class="col-md-6 text-center">
                  <span class="text-muted">PROVEEDOR</span><br>
                  <span class="proReasonsocial"></span><br>
                  <span class="text-muted">DOCUMENTO N°</span><br>
                  <span class="proNumberdocument"></span><br>
                  <span class="text-muted">DIRECCION</span><br>
                  <span class="proAddress"></span><br>
                  <span class="text-muted">CORREO ELECTRONICO</span><br>
                  <span class="proEmail"></span><br>
                  <span class="text-muted">LINEA DE CELULAR</span><br>
                  <span class="proMovil"></span><br>
                  <span class="text-muted">LINEA FIJA</span><br>
                  <span class="proPhone"></span><br>
                  <span class="text-muted">NUMERO DE WHATSAPP</span><br>
                  <span class="proWhatsapp"></span><br>
                </div>
                <div class="col-md-6">
                  <small class="text-muted">NOTIFICACION: </small><br>
                  <textarea name="npNotification" placeholder="Texto de hasta 2000 carácteres" class="form-control form-control-sm" maxlength="2000" rows="7" required></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editNotification-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>MODIFICACION DE NOTIFICACIONES:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('providers.notification.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row border m-3 p-3">
                <div class="col-md-6 text-center">
                  <span class="text-muted">CODIGO DE NOTIFICACION</span><br>
                  <span class="npDocumentcode_Edit"></span><br>
                  <span class="text-muted">PROVEEDOR</span><br>
                  <span class="proReasonsocial_Edit"></span><br>
                  <span class="text-muted">DOCUMENTO N°</span><br>
                  <span class="proNumberdocument_Edit"></span><br>
                  <span class="text-muted">DIRECCION</span><br>
                  <span class="proAddress_Edit"></span><br>
                  <span class="text-muted">CORREO ELECTRONICO</span><br>
                  <span class="proEmail_Edit"></span><br>
                  <span class="text-muted">LINEA DE CELULAR</span><br>
                  <span class="proMovil_Edit"></span><br>
                  <span class="text-muted">LINEA FIJA</span><br>
                  <span class="proPhone_Edit"></span><br>
                  <span class="text-muted">NUMERO DE WHATSAPP</span><br>
                  <span class="proWhatsapp_Edit"></span><br>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="npDate_Edit" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">NOTIFICACION: </small><br>
                    <textarea name="npNotification_Edit" placeholder="Texto de hasta 2000 carácteres" class="form-control form-control-sm" maxlength="2000" rows="7" required></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="proReasonsocial_Edit" class="form-control form-control-sm" required>
            <input type="hidden" name="npId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteNotification-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE NOTIFICACIONES:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 text-center">
            <span class="text-muted">PROVEEDOR</span><br>
            <span class="proReasonsocial_Delete"></span><br>
            <span class="text-muted">DOCUMENTO N°</span><br>
            <span class="proNumberdocument_Delete"></span><br>
            <span class="text-muted">DIRECCION</span><br>
            <span class="proAddress_Delete"></span><br>
            <span class="text-muted">CORREO ELECTRONICO</span><br>
            <span class="proEmail_Delete"></span><br>
            <span class="text-muted">LINEA DE CELULAR</span><br>
            <span class="proMovil_Delete"></span><br>
            <span class="text-muted">LINEA FIJA</span><br>
            <span class="proPhone_Delete"></span><br>
            <span class="text-muted">NUMERO DE WHATSAPP</span><br>
            <span class="proWhatsapp_Delete"></span><br>
          </div>
          <div class="col-md-6 text-center">
            <small class="text-muted">CODIGO DE NOTIFICACION: </small><br>
            <span class="text-muted"><b class="npDocumentcode_Delete"></b></span><br>
            <small class="text-muted">FECHA DE ENTREGA: </small><br>
            <span class="text-muted"><b class="npDate_Delete"></b></span><br>
            <small class="text-muted">NOTIFICACION: </small><br>
            <span class="text-muted"><b class="npNotification_Delete"></b></span><br>
          </div>
        </div>
        <form action="{{ route('providers.notification.delete') }}" method="POST">
          @csrf
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="proReasonsocial_Delete" class="form-control form-control-sm" required>
            <input type="hidden" name="npId_Delete" class="form-control form-control-sm" required>
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

  $('.newNotification-link').on('click', function(e) {
    e.preventDefault();
    $('#newNotification-modal').modal();
  });

  $('select[name=npDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode]').val('');
    $('input[name=dolVersion]').val('');
    if (selected != '') {
      var code = $('select[name=npDocument_id] option:selected').attr('data-code');
      var version = $('select[name=npDocument_id] option:selected').attr('data-version');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForNotificationprovider') }}", {
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

  $('select[name=npLegalization_id]').on('change', function(e) {
    var selected = e.target.value;
    $('.proReasonsocial').text('');
    $('.proNumberdocument').text('');
    $('.proAddress').text('');
    $('.proEmail').text('');
    $('.proMovil').text('');
    $('.proPhone').text('');
    $('.proWhatsapp').text('');
    if (selected != '') {
      var names = $('select[name=npLegalization_id] option:selected').attr('data-names');
      var type = $('select[name=npLegalization_id] option:selected').attr('data-type');
      var number = $('select[name=npLegalization_id] option:selected').attr('data-document');
      var address = $('select[name=npLegalization_id] option:selected').attr('data-address');
      var email = $('select[name=npLegalization_id] option:selected').attr('data-email');
      var movil = $('select[name=npLegalization_id] option:selected').attr('data-movil');
      var phone = $('select[name=npLegalization_id] option:selected').attr('data-phone');
      var whatsapp = $('select[name=npLegalization_id] option:selected').attr('data-whatsapp');
      $('.proReasonsocial').text(names);
      $('.proNumberdocument').text(type + ': ' + number);
      $('.proAddress').text(address);
      $('.proEmail').text(email);
      $('.proMovil').text(movil);
      $('.proPhone').text(phone);
      $('.proWhatsapp').text(whatsapp);
    }
  });

  $('.editNotification-link').on('click', function(e) {
    e.preventDefault();
    var npId = $(this).find('span:nth-child(2)').text();
    var proReasonsocial = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var proNumberdocument = $(this).find('span:nth-child(5)').text();
    var documentCode = $(this).find('span:nth-child(6)').text();
    var address = $(this).find('span:nth-child(7)').text();
    var email = $(this).find('span:nth-child(8)').text();
    var movil = $(this).find('span:nth-child(9)').text();
    var phone = $(this).find('span:nth-child(10)').text();
    var whatsapp = $(this).find('span:nth-child(11)').text();
    var npNotification = $(this).find('span:nth-child(12)').text();
    var npDate = $(this).find('span:nth-child(13)').text();
    $('input[name=npId_Edit]').val(npId);
    $('.proReasonsocial_Edit').text(proReasonsocial);
    $('input[name=proReasonsocial_Edit]').val(proReasonsocial);
    $('.proNumberdocument_Edit').text(perName + ': ' + proNumberdocument);
    $('.npDocumentcode_Edit').text(documentCode);
    $('.proAddress_Edit').text(address);
    $('.proEmail_Edit').text(email);
    $('.proMovil_Edit').text(movil);
    $('.proPhone_Edit').text(movil);
    $('.proWhatsapp_Edit').text(phone);
    $('input[name=npDate_Edit]').val(npDate);
    $('textarea[name=npNotification_Edit]').val(npNotification);
    $('#editNotification-modal').modal();
  });

  $('.deleteNotification-link').on('click', function(e) {
    e.preventDefault();
    var npId = $(this).find('span:nth-child(2)').text();
    var proReasonsocial = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var proNumberdocument = $(this).find('span:nth-child(5)').text();
    var documentCode = $(this).find('span:nth-child(6)').text();
    var address = $(this).find('span:nth-child(7)').text();
    var email = $(this).find('span:nth-child(8)').text();
    var movil = $(this).find('span:nth-child(9)').text();
    var phone = $(this).find('span:nth-child(10)').text();
    var whatsapp = $(this).find('span:nth-child(11)').text();
    var npNotification = $(this).find('span:nth-child(12)').text();
    var npDate = $(this).find('span:nth-child(13)').text();
    $('input[name=npId_Delete]').val(npId);
    $('.proReasonsocial_Delete').text(proReasonsocial);
    $('input[name=proReasonsocial_Delete]').val(proReasonsocial);
    $('.proNumberdocument_Delete').text(perName + ': ' + proNumberdocument);
    $('.npDocumentcode_Delete').text(documentCode);
    $('.proAddress_Delete').text(address);
    $('.proEmail_Delete').text(email);
    $('.proMovil_Delete').text(movil);
    $('.proPhone_Delete').text(movil);
    $('.proWhatsapp_Delete').text(phone);
    $('.npDate_Delete').text(npDate);
    $('.npNotification_Delete').text(npNotification);
    $('#deleteNotification-modal').modal();
  });
</script>
@endsection