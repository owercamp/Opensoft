@extends('modules.logisticContractors')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-6">
      <h6>NOTIFICACIONES</h6>
    </div>
    <div class="col-md-2">
      <button type="button" title="REGISTRAR" class="btn btn-outline-success form-control-sm newNotification-link">NUEVO</button>
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
        <th>CONTRATISTA</th>
        <th>CODIGO DE NOTIFICACION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($notifications as $notification)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $notification->ncDate }}</td>
        <td>
          @if($notification->bill->bcTypecontractor == 'MENSAJERIA')
          {{ $notification->bill->messenger->cmNames }}
          @elseif($notification->bill->bcTypecontractor == 'CARGA EXPRESS')
          {{ $notification->bill->charge->ccNames }}
          @elseif($notification->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
          {{ $notification->bill->especial->ceNames }}
          @endif
        </td>
        <td>{{ $notification->ncDocumentcode }}</td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="EDITAR" class="btn btn-outline-primary rounded-circle form-control-sm editNotification-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $notification->ncId }}</span>
            <span hidden>{{ $notification->ncDate }}</span>
            <span hidden>{{ $notification->ncDocument_id }}</span>
            <span hidden>{{ $notification->ncDocumentcode }}</span>
            <span hidden>{{ $notification->document->dolVersion }}</span>
            <span hidden>{{ $notification->ncNotification }}</span>
            @if($notification->bill->bcTypecontractor == 'MENSAJERIA')
            <span hidden>{{ $notification->bill->messenger->cmNames }}</span>
            <span hidden>{{ $notification->bill->messenger->cmNumberdocument }}</span>
            <span hidden>{{ $notification->bill->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsMessengerPhotos/'.$notification->bill->messenger->cmPhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsMessengerFirms/'.$notification->bill->messenger->cmFirm) }}" hidden>
            @elseif($notification->bill->bcTypecontractor == 'CARGA EXPRESS')
            <span hidden>{{ $notification->bill->charge->ccNames }}</span>
            <span hidden>{{ $notification->bill->charge->ccNumberdocument }}</span>
            <span hidden>{{ $notification->bill->charge->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsChargePhotos/'.$notification->bill->charge->ccPhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsChargeFirms/'.$notification->bill->charge->ccFirm) }}" hidden>
            @elseif($notification->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
            <span hidden>{{ $notification->bill->especial->ceNames }}</span>
            <span hidden>{{ $notification->bill->especial->ceNumberdocument }}</span>
            <span hidden>{{ $notification->bill->especial->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsEspecialPhotos/'.$notification->bill->especial->cePhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsEspecialFirms/'.$notification->bill->especial->ceFirm) }}" hidden>
            @endif
          </a>
          <a href="#" title="ELIMINAR" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteNotification-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $notification->ncId }}</span>
            <span hidden>{{ $notification->ncDate }}</span>
            <span hidden>{{ $notification->ncDocument_id }}</span>
            <span hidden>{{ $notification->ncDocumentcode }}</span>
            <span hidden>{{ $notification->ncNotification }}</span>
            @if($notification->bill->bcTypecontractor == 'MENSAJERIA')
            <span hidden>{{ $notification->bill->messenger->cmNames }}</span>
            <span hidden>{{ $notification->bill->messenger->cmNumberdocument }}</span>
            <span hidden>{{ $notification->bill->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsMessengerPhotos/'.$notification->bill->messenger->cmPhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsMessengerFirms/'.$notification->bill->messenger->cmFirm) }}" hidden>
            @elseif($notification->bill->bcTypecontractor == 'CARGA EXPRESS')
            <span hidden>{{ $notification->bill->charge->ccNames }}</span>
            <span hidden>{{ $notification->bill->charge->ccNumberdocument }}</span>
            <span hidden>{{ $notification->bill->charge->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsChargePhotos/'.$notification->bill->charge->ccPhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsChargeFirms/'.$notification->bill->charge->ccFirm) }}" hidden>
            @elseif($notification->bill->bcTypecontractor == 'SERVICIO ESPECIAL')
            <span hidden>{{ $notification->bill->especial->ceNames }}</span>
            <span hidden>{{ $notification->bill->especial->ceNumberdocument }}</span>
            <span hidden>{{ $notification->bill->especial->neighborhood->neName }}</span>
            <img src="{{ asset('storage/contractorsEspecialPhotos/'.$notification->bill->especial->cePhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsEspecialFirms/'.$notification->bill->especial->ceFirm) }}" hidden>
            @endif
          </a>
          <form action="{{ route('contractors.notification.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="ncId" value="{{ $notification->ncId }}" class="form-control form-control-sm" required>
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
        <h5>NUEVA NOTIFICACION:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractors.notification.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="ncDate" class="form-control form-control-sm text-center datepicker" placeholder="aaaa-mm-dd" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="ncDocument_id" class="form-control form-control-sm" required>
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
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode" class="form-control form-control-sm text-center" readonly required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTRATISTA:</small>
                    <select name="ncBillcontractor_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @for($i = 0; $i < count($contractors); $i++) @if($contractors[$i][1]=='MENSAJERIA' ) <option value="{{ $contractors[$i][0] }}" data-type="$contractors[$i][1]" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}" data-city="{{ $contractors[$i][4] }}" data-photo="{{ asset('storage/contractorsMessengerPhotos/'.$contractors[$i][5]) }}" data-firm="{{ asset('storage/contractorsMessengerFirms/'.$contractors[$i][6]) }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
                        @elseif($contractors[$i][1] == 'CARGA EXPRESS')
                        <option value="{{ $contractors[$i][0] }}" data-type="$contractors[$i][1]" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}" data-city="{{ $contractors[$i][4] }}" data-photo="{{ asset('storage/contractorsChargePhotos/'.$contractors[$i][5]) }}" data-firm="{{ asset('storage/contractorsChargeFirms/'.$contractors[$i][6]) }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
                        @elseif($contractors[$i][1] == 'SERVICIO ESPECIAL')
                        <option value="{{ $contractors[$i][0] }}" data-type="$contractors[$i][1]" data-names="{{ $contractors[$i][2] }}" data-document="{{ $contractors[$i][3] }}" data-city="{{ $contractors[$i][4] }}" data-photo="{{ asset('storage/contractorsEspecialPhotos/'.$contractors[$i][5]) }}" data-firm="{{ asset('storage/contractorsEspecialFirms/'.$contractors[$i][6]) }}">{{ $contractors[$i][1] . ' - ' . $contractors[$i][2] }}</option>
                        @endif
                        @endfor
                    </select>
                  </div>
                </div>
              </div>
              <div class="row section-contratorSelected" style="display: none;">
                <div class="col-md-6 text-center pt-4">
                  <span class="cNames"></span><br>
                  <span class="cNumberdocument"></span><br>
                  <span class="cCity"></span><br>
                  <div class="row p-4 mt-4">
                    <div class="col-md-6">
                      <small class="text-muted">FOTO DE PERFIL:</small><br>
                      <img src="" class="img img-thumbnail cPhotonow" style="width: 150px; height: auto;" hidden><br>
                    </div>
                    <div class="col-md-6">
                      <small class="text-muted">FIRMA DIGITAL:</small><br>
                      <img src="" class="img img-thumbnail cFirmnow" style="width: 150px; height: auto;" hidden><br>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group border-bottom">
                    <h6 class="text-muted">NOTIFICACION:</h6>
                  </div>
                  <div class="form-group">
                    <textarea name="ncNotification" class="form-control form-control-sm" rows="10" disabled></textarea>
                  </div>
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
        <h5>MODIFICACION DE NOTIFICACION:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractors.notification.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="ncDate_Edit" class="form-control form-control-sm text-center datepicker" placeholder="aaaa-mm-dd" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="ncDocument_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($documents as $document)
                      <option value="{{ $document->dolId }}" data-code="{{ $document->dolCode }}" data-version="{{ $document->dolVersion }}">{{ $document->dolName }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" name="ncDocument_id_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">VERSION:</small>
                    <input type="text" name="dolVersion_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <small class="text-muted">CODIGO:</small>
                    <input type="text" name="dolCode_Edit" class="form-control form-control-sm text-center" readonly required>
                    <input type="hidden" name="dolCode_hidden_Edit" class="form-control form-control-sm text-center" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 text-center pt-4">
                  <span class="cNames_Edit"></span><br>
                  <span class="cNumberdocument_Edit"></span><br>
                  <span class="cCity_Edit"></span><br>
                  <div class="row p-4 mt-4">
                    <div class="col-md-6">
                      <small class="text-muted">FOTO DE PERFIL:</small><br>
                      <img src="" class="img img-thumbnail cPhotonow_Edit" style="width: 150px; height: auto;" hidden><br>
                    </div>
                    <div class="col-md-6">
                      <small class="text-muted">FIRMA DIGITAL:</small><br>
                      <img src="" class="img img-thumbnail cFirmnow_Edit" style="width: 150px; height: auto;" hidden><br>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group border-bottom">
                    <h6 class="text-muted">NOTIFICACION:</h6>
                  </div>
                  <div class="form-group">
                    <textarea name="ncNotification_Edit" class="form-control form-control-sm" rows="10" required></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="ncId_Edit" class="form-control form-control-sm" required>
            <input type="hidden" name="cNames_Edit" class="form-control form-control-sm" required>
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
        <h6>ELIMINACION DE NOTIFICACION:</h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 border-right text-center pt-4">
            <span class="cNames_Delete"></span><br>
            <span class="cNumberdocument_Delete"></span><br>
            <span class="cCity_Delete"></span><br>
            <div class="row p-4 mt-4">
              <div class="col-md-6">
                <small class="text-muted">FOTO DE PERFIL:</small><br>
                <img src="" class="img img-thumbnail cPhotonow_Delete" style="width: 150px; height: auto;" hidden><br>
              </div>
              <div class="col-md-6">
                <small class="text-muted">FIRMA DIGITAL:</small><br>
                <img src="" class="img img-thumbnail cFirmnow_Delete" style="width: 150px; height: auto;" hidden><br>
              </div>
            </div>
          </div>
          <div class="col-md-6 border-left text-center pt-4">
            <small class="text-muted">FECHA: </small><br>
            <span class="text-muted"><b class="ncDate_Delete"></b></span><br>
            <small class="text-muted">CODIGO DE SEGUIMIENTO: </small><br>
            <span class="text-muted"><b class="ncDocumentcode_Delete"></b></span><br>
            <hr>
            <small class="text-muted">NOTIFICACION: </small><br>
            <span class="text-muted"><b class="ncNotification_Delete"></b></span><br>
          </div>
        </div>
        <form action="{{ route('contractors.notification.delete') }}" method="POST">
          @csrf
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="ncId_Delete" class="form-control form-control-sm" required>
            <input type="hidden" name="cNames_Delete" class="form-control form-control-sm" required>
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

  $('select[name=ncDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion]').val('');
    $('input[name=dolCode]').val('');
    if (selected != '') {
      var version = $('select[name=ncDocument_id] option:selected').attr('data-version');
      var code = $('select[name=ncDocument_id] option:selected').attr('data-code');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForNotificationcontractor') }}", {
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

  $('select[name=ncBillcontractor_id]').on('change', function(e) {
    var selected = e.target.value;
    $('.cCity').text('');
    $('.cNames').text('');
    $('.cNumberdocument').text('');
    $('img.cPhotonow').attr('src', '');
    $('img.cPhotonow').attr("hidden", true);
    $('img.cFirmnow').attr('src', '');
    $('img.cFirmnow').attr("hidden", true);
    $('textarea[name=ncNotification]').attr('disabled', true);
    $('textarea[name=ncNotification]').attr('required', false);
    $('.section-contratorSelected').css('display', 'none');
    if (selected != '') {
      var names = $('select[name=ncBillcontractor_id] option:selected').attr('data-names');
      var number = $('select[name=ncBillcontractor_id] option:selected').attr('data-document');
      var firm = $('select[name=ncBillcontractor_id] option:selected').attr('data-firm');
      var photo = $('select[name=ncBillcontractor_id] option:selected').attr('data-photo');
      var city = $('select[name=ncBillcontractor_id] option:selected').attr('data-city');
      $('.cNames').text(names);
      $('.cNumberdocument').text(number);
      $('img.cFirmnow').attr("src", firm);
      $('img.cFirmnow').attr("hidden", false);
      $('img.cPhotonow').attr("src", photo);
      $('img.cPhotonow').attr("hidden", false);
      $('.cCity').text(city);
      $('textarea[name=ncNotification]').attr('disabled', false);
      $('textarea[name=ncNotification]').attr('required', true);
      $('.section-contratorSelected').css('display', 'flex');
    }
  });

  $('.editNotification-link').on('click', function(e) {
    e.preventDefault();
    var cPhoto = $(this).find('img:first').attr('src');
    var cFirm = $(this).find('img:last').attr('src');
    var ncId = $(this).find('span:nth-child(2)').text();
    var ncDate = $(this).find('span:nth-child(3)').text();
    var ncDocument_id = $(this).find('span:nth-child(4)').text();
    var ncDocumentcode = $(this).find('span:nth-child(5)').text();
    var dolVersion = $(this).find('span:nth-child(6)').text();
    var ncNotification = $(this).find('span:nth-child(7)').text();
    var namesContractor = $(this).find('span:nth-child(8)').text();
    var documentContractor = $(this).find('span:nth-child(9)').text();
    var cityContractor = $(this).find('span:nth-child(10)').text();
    $('input[name=ncId_Edit]').val(ncId);
    $('input[name=ncDate_Edit]').val(ncDate);
    $('select[name=ncDocument_id_Edit]').val(ncDocument_id);
    $('input[name=ncDocument_id_hidden_Edit]').val(ncDocument_id);
    $('input[name=dolCode_Edit]').val(ncDocumentcode);
    $('input[name=dolVersion_Edit]').val(dolVersion);
    $('input[name=dolCode_hidden_Edit]').val(ncDocumentcode);
    $('.cPhotonow_Edit').attr("src", cPhoto);
    $('.cPhotonow_Edit').attr("hidden", false);
    $('.cFirmnow_Edit').attr("src", cFirm);
    $('.cFirmnow_Edit').attr("hidden", false);
    $('.cNames_Edit').text(namesContractor);
    $('input[name=cNames_Edit]').val(namesContractor);
    $('.cNumberdocument_Edit').text(documentContractor);
    $('.cCity_Edit').text(cityContractor);
    $('textarea[name=ncNotification_Edit]').val(ncNotification);
    $('#editNotification-modal').modal();
  });

  $('select[name=ncDocument_id_Edit]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolVersion_Edit]').val('');
    $('input[name=dolCode_Edit]').val('');
    if (selected != '') {
      var version = $('select[name=ncDocument_id_Edit] option:selected').attr('data-version');
      var code = $('select[name=ncDocument_id_Edit] option:selected').attr('data-code');
      var dolId = $('input[name=ncDocument_id_hidden_Edit]').val();
      $('input[name=dolVersion_Edit]').val(version);
      if (selected == dolId) {
        $('input[name=dolCode_Edit]').val($('input[name=dolCode_hidden_Edit]').val());
      } else {
        $.get("{{ route('getNextcodeForNotificationcontractor') }}", {
          dolId: selected
        }, function(objectsNext) {
          if (objectsNext != null) {
            $('input[name=dolCode_Edit]').val(objectsNext);
          } else {
            $('input[name=dolCode_Edit]').val('');
          }
        });
      }
    }
  });

  $('.deleteNotification-link').on('click', function(e) {
    e.preventDefault();
    var cPhoto = $(this).find('img:first').attr('src');
    var cFirm = $(this).find('img:last').attr('src');
    var ncId = $(this).find('span:nth-child(2)').text();
    var ncDate = $(this).find('span:nth-child(3)').text();
    var ncDocument_id = $(this).find('span:nth-child(4)').text();
    var ncDocumentcode = $(this).find('span:nth-child(5)').text();
    var ncNotification = $(this).find('span:nth-child(6)').text();
    var namesContractor = $(this).find('span:nth-child(7)').text();
    var documentContractor = $(this).find('span:nth-child(8)').text();
    var cityContractor = $(this).find('span:nth-child(9)').text();
    $('input[name=ncId_Delete]').val(ncId);
    $('.ncDate_Delete').text(ncDate);
    $('.ncDocumentcode_Delete').text(ncDocumentcode);
    $('.cPhotonow_Delete').attr("src", cPhoto);
    $('.cPhotonow_Delete').attr("hidden", false);
    $('.cFirmnow_Delete').attr("src", cFirm);
    $('.cFirmnow_Delete').attr("hidden", false);
    $('.cNames_Delete').text(namesContractor);
    $('input[name=cNames_Delete]').val(namesContractor);
    $('.cNumberdocument_Delete').text(documentContractor);
    $('.cCity_Delete').text(cityContractor);
    $('.ncNotification_Delete').text(ncNotification);
    $('#deleteNotification-modal').modal();
  });
</script>
@endsection