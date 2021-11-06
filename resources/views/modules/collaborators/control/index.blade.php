@extends('modules.logisticCollaborators')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-6">
      <h6>CONTROL DE AUSENCIA Y AUSENTISMO</h6>
    </div>
    <div class="col-md-2">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newControl-link">NUEVO</button>
    </div>
    <div class="col-md-4" style="font-size: 12px;">
      @if(session('SuccessControl'))
      <div class="alert alert-success">
        {{ session('SuccessControl') }}
      </div>
      @endif
      @if(session('PrimaryControl'))
      <div class="alert alert-primary">
        {{ session('PrimaryControl') }}
      </div>
      @endif
      @if(session('WarningControl'))
      <div class="alert alert-warning">
        {{ session('WarningControl') }}
      </div>
      @endif
      @if(session('SecondaryControl'))
      <div class="alert alert-secondary">
        {{ session('SecondaryControl') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>COLABORADOR</th>
        <th>CODIGO DE REGISTRO</th>
        <th>AUSENTISMO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($controls as $control)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $control->acoDate }}</td>
        <td>{{ $control->bill->collaborator->coNames }}</td>
        <td>{{ $control->acoDocumentcode }}</td>
        <td>{{ $control->acoAbsenteeism }}</td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="EDITAR" class="btn btn-outline-primary rounded-circle form-control-sm editControl-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $control->acoId }}</span>
            <span hidden>{{ $control->bill->collaborator->coNames }}</span>
            <span hidden>{{ $control->bill->collaborator->type->perName }}</span>
            <span hidden>{{ $control->bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $control->bill->collaborator->coPosition }}</span>
            <span hidden>{{ $control->acoDocumentcode }}</span>
            <span hidden>{{ $control->bill->collaborator->coAddress }}</span>
            <span hidden>{{ $control->bill->collaborator->coBloodtype }}</span>
            <span hidden>{{ $control->bill->collaborator->coEmail }}</span>
            <span hidden>{{ $control->bill->collaborator->coMovil }}</span>
            <span hidden>{{ $control->bill->collaborator->coWhatsapp }}</span>
            <span hidden>{{ $control->acoAbsenteeism }}</span>
            <span hidden>{{ $control->acoHourentry }}</span>
            <span hidden>{{ $control->acoHourexit }}</span>
            <span hidden>{{ $control->acoDescription }}</span>
            <span hidden>{{ $control->acoDate }}</span>
            <img src="{{ asset('storage/collaboratorsPhotos/'.$control->bill->collaborator->coPhoto) }}" hidden>
            @if($control->bill->collaborator->coFirm !== null)
            <img src="{{ asset('storage/collaboratorsFirms/'.$control->bill->collaborator->coFirm) }}" hidden>
            @else
            <img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
            @endif
          </a>
          <a href="#" title="ELIMINAR" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteControl-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $control->acoId }}</span>
            <span hidden>{{ $control->bill->collaborator->coNames }}</span>
            <span hidden>{{ $control->bill->collaborator->type->perName }}</span>
            <span hidden>{{ $control->bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $control->bill->collaborator->coPosition }}</span>
            <span hidden>{{ $control->acoDocumentcode }}</span>
            <span hidden>{{ $control->bill->collaborator->coAddress }}</span>
            <span hidden>{{ $control->bill->collaborator->coBloodtype }}</span>
            <span hidden>{{ $control->bill->collaborator->coEmail }}</span>
            <span hidden>{{ $control->bill->collaborator->coMovil }}</span>
            <span hidden>{{ $control->bill->collaborator->coWhatsapp }}</span>
            <span hidden>{{ $control->acoAbsenteeism }}</span>
            <span hidden>{{ $control->acoHourentry }}</span>
            <span hidden>{{ $control->acoHourexit }}</span>
            <span hidden>{{ $control->acoDescription }}</span>
            <span hidden>{{ $control->acoDate }}</span>
            <img src="{{ asset('storage/collaboratorsPhotos/'.$control->bill->collaborator->coPhoto) }}" hidden>
            @if($control->bill->collaborator->coFirm !== null)
            <img src="{{ asset('storage/collaboratorsFirms/'.$control->bill->collaborator->coFirm) }}" hidden>
            @else
            <img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
            @endif
          </a>
          <form action="{{ route('collaborators.control.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="acoId" value="{{ $control->acoId }}" class="form-control form-control-sm" required>
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

<div class="modal fade" id="newControl-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO REGISTRO DE CONTROL:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.control.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="acoDocument_id" class="form-control form-control-sm" required>
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
                    <select name="acoLegalization_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($legalizations as $legalization)
                      <option value="{{ $legalization->bcoId }}" data-names='{{ $legalization->coNames }}' data-type='{{ $legalization->perName }}' data-document='{{ $legalization->coNumberdocument }}' data-position='{{ $legalization->coPosition }}' data-photo='{{ $legalization->coPhoto }}' data-firm='{{ $legalization->coFirm }}' data-address='{{ $legalization->coAddress }}' data-bloodtype='{{ $legalization->coBloodtype }}' data-email='{{ $legalization->coEmail }}' data-movil='{{ $legalization->coMovil }}' data-whatsapp='{{ $legalization->coWhatsapp }}'>
                        {{ $legalization->coNames }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">FECHA:</small>
                    <input type="text" name="acoDate" class="form-control form-control-sm text-center datepicker" required>
                  </div>
                </div>
              </div>
              <div class="row border m-3 p-3">
                <div class="col-md-6 text-center">
                  <span class="coPosition"></span><br>
                  <img src="" class="img img-thumbnail coPhotonow" style="width: 150px; height: auto;" hidden><br>
                  <input type="hidden" name="route_hidden_photo" value="{{ asset('storage/collaboratorsPhotos') }}" class="form-control form-control-sm" disabled>
                  <span class="coNames"></span><br>
                  <span class="coNumberdocument"></span><br>
                  <img src="" class="img img-thumbnail coFirmnow" style="width: 150px; height: auto;" hidden><br>
                  <input type="hidden" name="route_hidden_firm" value="{{ asset('storage/collaboratorsFirms') }}" class="form-control form-control-sm" disabled>
                  <span class="text-muted">DIRECCION</span><br>
                  <span class="coAddress"></span><br>
                  <span class="text-muted">GRUPO SANGUINEO</span><br>
                  <span class="coBloodtype"></span><br>
                  <span class="text-muted">CORREO ELECTRONICO</span><br>
                  <span class="coEmail"></span><br>
                  <span class="text-muted">LINEA DE CELULAR</span><br>
                  <span class="coMovil"></span><br>
                  <span class="text-muted">NUMERO DE WHATSAPP</span><br>
                  <span class="coWhatsapp"></span><br>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">AUSENTISMO:</small>
                        <select name="acoAbsenteeism" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="NO ASISTIÓ">NO ASISTIÓ</option>
                          <option value="LLEGÓ TARDE">LLEGÓ TARDE</option>
                          <option value="SALIÓ TEMPRANO">SALIÓ TEMPRANO</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row acoAbsenteeism-sectionNot" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="acoDescription_not" class="form-control form-control-sm" maxlength="500" rows="12" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row acoAbsenteeism-sectionCome" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">HORA DE LLEGADA:</small>
                        <input type="time" name="acoHourentry" class="form-control form-control-sm" disabled>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="acoDescription_come" class="form-control form-control-sm" maxlength="500" rows="12" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row acoAbsenteeism-sectionOut" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">HORA DE SALIDA:</small>
                        <input type="time" name="acoHourexit" class="form-control form-control-sm" disabled>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="acoDescription_out" class="form-control form-control-sm" maxlength="500" rows="12" disabled></textarea>
                      </div>
                    </div>
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

<div class="modal fade" id="editControl-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>MODIFICACION DE CONTROL:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.control.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row border m-3 p-3">
                <div class="col-md-6 text-center">
                  <span class="coPosition_Edit"></span><br>
                  <img src="" class="img img-thumbnail coPhotonow_Edit" style="width: 150px; height: auto;" hidden><br>
                  <input type="hidden" name="route_hidden_photo_Edit" value="{{ asset('storage/collaboratorsPhotos') }}" class="form-control form-control-sm" disabled>
                  <span class="coNames_Edit"></span><br>
                  <span class="coNumberdocument_Edit"></span><br>
                  <img src="" class="img img-thumbnail coFirmnow_Edit" style="width: 150px; height: auto;" hidden><br>
                  <input type="hidden" name="route_hidden_firm_Edit" value="{{ asset('storage/collaboratorsFirms') }}" class="form-control form-control-sm" disabled>
                  <span class="text-muted">CODIGO DE CONTROL</span><br>
                  <span class="acoDocumentcode_Edit"></span><br>
                  <span class="text-muted">DIRECCION</span><br>
                  <span class="coAddress_Edit"></span><br>
                  <span class="text-muted">GRUPO SANGUINEO</span><br>
                  <span class="coBloodtype_Edit"></span><br>
                  <span class="text-muted">CORREO ELECTRONICO</span><br>
                  <span class="coEmail_Edit"></span><br>
                  <span class="text-muted">LINEA DE CELULAR</span><br>
                  <span class="coMovil_Edit"></span><br>
                  <span class="text-muted">NUMERO DE WHATSAPP</span><br>
                  <span class="coWhatsapp_Edit"></span><br>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">FECHA:</small>
                        <input type="text" name="acoDate_Edit" class="form-control form-control-sm text-center datepicker" required>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">AUSENTISMO:</small>
                        <select name="acoAbsenteeism_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="NO ASISTIÓ">NO ASISTIÓ</option>
                          <option value="LLEGÓ TARDE">LLEGÓ TARDE</option>
                          <option value="SALIÓ TEMPRANO">SALIÓ TEMPRANO</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row acoAbsenteeism-sectionNot_Edit" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="acoDescription_not_Edit" class="form-control form-control-sm" maxlength="500" rows="12" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row acoAbsenteeism-sectionCome_Edit" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">HORA DE LLEGADA:</small>
                        <input type="time" name="acoHourentry_Edit" class="form-control form-control-sm" disabled>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="acoDescription_come_Edit" class="form-control form-control-sm" maxlength="500" rows="12" disabled></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row acoAbsenteeism-sectionOut_Edit" style="display: none;">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">HORA DE SALIDA:</small>
                        <input type="time" name="acoHourexit_Edit" class="form-control form-control-sm" disabled>
                      </div>
                      <div class="form-group">
                        <small class="text-muted">DESCRIPCIÓN</small>
                        <textarea name="acoDescription_out_Edit" class="form-control form-control-sm" maxlength="500" rows="12" disabled></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="coNames_Edit" class="form-control form-control-sm" required>
            <input type="hidden" name="acoId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteControl-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE CONTROL:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 text-center">
            <span class="coPosition_Delete"></span><br>
            <img src="" class="img img-thumbnail coPhotonow_Delete" style="width: 150px; height: auto;" hidden><br>
            <span class="coNames_Delete"></span><br>
            <span class="coNumberdocument_Delete"></span><br>
            <img src="" class="img img-thumbnail coFirmnow_Delete" style="width: 150px; height: auto;" hidden><br>
            <span class="coAddress_Delete"></span><br>
            <span class="coBloodtype_Delete"></span><br>
            <span class="coEmail_Delete"></span><br>
            <span class="coMovil_Delete"></span><br>
            <span class="coWhatsapp_Delete"></span><br>
          </div>
          <div class="col-md-6 text-center pt-3">
            <small class="text-muted">FECHA DE CONTROL: </small><br>
            <span class="text-muted"><b class="acoDate_Delete"></b></span><br>
            <small class="text-muted">TIPO DE AUSENTISMO: </small><br>
            <span class="text-muted"><b class="acoAbsenteeism_Delete"></b></span><br>
            <small class="text-muted">HORA DE LLEGADA: </small><br>
            <span class="text-muted"><b class="acoHourentry_Delete"></b></span><br>
            <small class="text-muted">HORA DE SALIDA: </small><br>
            <span class="text-muted"><b class="acoHourexit_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION: </small><br>
            <span class="text-muted"><b class="acoDescription_Delete"></b></span><br>
          </div>
        </div>
        <form action="{{ route('collaborators.control.delete') }}" method="POST">
          @csrf
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="coNames_Delete" class="form-control form-control-sm" required>
            <input type="hidden" name="acoId_Delete" class="form-control form-control-sm" required>
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

  $('.newControl-link').on('click', function(e) {
    e.preventDefault();
    $('#newControl-modal').modal();
  });

  $('select[name=acoDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode]').val('');
    $('input[name=dolVersion]').val('');
    if (selected != '') {
      var code = $('select[name=acoDocument_id] option:selected').attr('data-code');
      var version = $('select[name=acoDocument_id] option:selected').attr('data-version');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForControl') }}", {
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

  $('select[name=acoLegalization_id]').on('change', function(e) {
    var selected = e.target.value;
    $('.coPosition').text('');
    $('.coPhotonow').attr('src', '');
    $('.coNames').text('');
    $('.coNumberdocument').text('');
    $('.coFirmnow').attr('src', '');
    $('.coAddress').text('');
    $('.coBloodtype').text('');
    $('.coEmail').text('');
    $('.coMovil').text('');
    $('.coWhatsapp').text('');
    if (selected != '') {
      var position = $('select[name=acoLegalization_id] option:selected').attr('data-position');
      var names = $('select[name=acoLegalization_id] option:selected').attr('data-names');
      var type = $('select[name=acoLegalization_id] option:selected').attr('data-type');
      var number = $('select[name=acoLegalization_id] option:selected').attr('data-document');
      var photo = $('select[name=acoLegalization_id] option:selected').attr('data-photo');
      var firm = $('select[name=acoLegalization_id] option:selected').attr('data-firm');
      var address = $('select[name=acoLegalization_id] option:selected').attr('data-address');
      var bloodtype = $('select[name=acoLegalization_id] option:selected').attr('data-bloodtype');
      var email = $('select[name=acoLegalization_id] option:selected').attr('data-email');
      var movil = $('select[name=acoLegalization_id] option:selected').attr('data-movil');
      var whatsapp = $('select[name=acoLegalization_id] option:selected').attr('data-whatsapp');
      $('.coPosition').text(position);
      var routePhoto = $('input[name=route_hidden_photo]').val();
      var routeFirm = $('input[name=route_hidden_firm]').val();
      $('.coPhotonow').attr('src', routePhoto + "/" + photo);
      $('.coPhotonow').attr('hidden', false);
      $('.coNames').text(names);
      $('.coNumberdocument').text(type + ': ' + number);
      if (firm != null && firm != 'null' && firm != '') {
        $('.coFirmnow').attr('src', routeFirm + "/" + firm);
        $('.coFirmnow').attr('hidden', false);
      } else {
        $('.coFirmnow').attr('src', '');
        $('.coFirmnow').attr('hidden', true);
      }
      $('.coAddress').text(address);
      $('.coBloodtype').text(bloodtype);
      $('.coEmail').text(email);
      $('.coMovil').text(movil);
      $('.coWhatsapp').text(whatsapp);
    }
  });

  $('select[name=acoAbsenteeism]').on('change', function(e) {
    var selected = e.target.value;
    if (selected != '') {
      switch (selected) {
        case 'NO ASISTIÓ':
          $('div.acoAbsenteeism-sectionCome').css('display', 'none');
          $('div.acoAbsenteeism-sectionCome').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionCome').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionOut').css('display', 'none');
          $('div.acoAbsenteeism-sectionOut').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionOut').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionNot').css('display', 'flex');
          $('div.acoAbsenteeism-sectionNot').find('textarea').attr('disabled', false);
          $('div.acoAbsenteeism-sectionNot').find('textarea').attr('required', true);
          break;
        case 'LLEGÓ TARDE':
          $('div.acoAbsenteeism-sectionCome').css('display', 'flex');
          $('div.acoAbsenteeism-sectionCome').find('input').attr('disabled', false);
          $('div.acoAbsenteeism-sectionCome').find('input').attr('required', true);
          $('div.acoAbsenteeism-sectionCome').find('textarea').attr('disabled', false);
          $('div.acoAbsenteeism-sectionCome').find('textarea').attr('required', true);
          $('div.acoAbsenteeism-sectionOut').css('display', 'none');
          $('div.acoAbsenteeism-sectionOut').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionOut').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionNot').css('display', 'none');
          $('div.acoAbsenteeism-sectionNot').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionNot').find('textarea').attr('required', false);
          break;
        case 'SALIÓ TEMPRANO':
          $('div.acoAbsenteeism-sectionCome').css('display', 'none');
          $('div.acoAbsenteeism-sectionCome').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionCome').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionOut').css('display', 'flex');
          $('div.acoAbsenteeism-sectionOut').find('input').attr('disabled', false);
          $('div.acoAbsenteeism-sectionOut').find('input').attr('required', true);
          $('div.acoAbsenteeism-sectionOut').find('textarea').attr('disabled', false);
          $('div.acoAbsenteeism-sectionOut').find('textarea').attr('required', true);
          $('div.acoAbsenteeism-sectionNot').css('display', 'none');
          $('div.acoAbsenteeism-sectionNot').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionNot').find('textarea').attr('required', false);
          break;
        default:
          $('div.acoAbsenteeism-sectionCome').css('display', 'none');
          $('div.acoAbsenteeism-sectionCome').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionCome').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionOut').css('display', 'none');
          $('div.acoAbsenteeism-sectionOut').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionOut').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionNot').css('display', 'none');
          $('div.acoAbsenteeism-sectionNot').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionNot').find('textarea').attr('required', false);
          break;
      }
    } else {
      $('div.acoAbsenteeism-sectionCome').css('display', 'none');
      $('div.acoAbsenteeism-sectionCome').find('input').attr('disabled', true);
      $('div.acoAbsenteeism-sectionCome').find('input').attr('required', false);
      $('div.acoAbsenteeism-sectionCome').find('textarea').attr('disabled', true);
      $('div.acoAbsenteeism-sectionCome').find('textarea').attr('required', false);
      $('div.acoAbsenteeism-sectionOut').css('display', 'none');
      $('div.acoAbsenteeism-sectionOut').find('input').attr('disabled', true);
      $('div.acoAbsenteeism-sectionOut').find('input').attr('required', false);
      $('div.acoAbsenteeism-sectionOut').find('textarea').attr('disabled', true);
      $('div.acoAbsenteeism-sectionOut').find('textarea').attr('required', false);
      $('div.acoAbsenteeism-sectionNot').css('display', 'none');
      $('div.acoAbsenteeism-sectionNot').find('textarea').attr('disabled', true);
      $('div.acoAbsenteeism-sectionNot').find('textarea').attr('required', false);
    }
  });

  $('.editControl-link').on('click', function(e) {
    e.preventDefault();
    var coPhoto = $(this).find('img:first').attr('src');
    var coFirm = $(this).find('img:last').attr('src');
    var acoId = $(this).find('span:nth-child(2)').text();
    var coNames = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var coNumberdocument = $(this).find('span:nth-child(5)').text();
    var coPosition = $(this).find('span:nth-child(6)').text();
    var documentCode = $(this).find('span:nth-child(7)').text();
    var address = $(this).find('span:nth-child(8)').text();
    var bloodtype = $(this).find('span:nth-child(9)').text();
    var email = $(this).find('span:nth-child(10)').text();
    var movil = $(this).find('span:nth-child(11)').text();
    var whatsapp = $(this).find('span:nth-child(12)').text();
    var acoAbsenteeism = $(this).find('span:nth-child(13)').text();
    var acoHourentry = $(this).find('span:nth-child(14)').text();
    var acoHourexit = $(this).find('span:nth-child(15)').text();
    var acoDescription = $(this).find('span:nth-child(16)').text();
    var acoDate = $(this).find('span:nth-child(17)').text();
    $('input[name=acoId_Edit]').val(acoId);
    $('.coPhotonow_Edit').attr('hidden', false);
    $('.coPhotonow_Edit').attr('src', coPhoto);
    if (coFirm != null && coFirm != 'null') {
      $('.coFirmnow_Edit').attr('hidden', false);
      $('.coFirmnow_Edit').attr('src', coFirm);
    } else {
      $('.coFirmnow_Edit').attr('src', '');
      $('.coFirmnow_Edit').attr('hidden', true);
    }
    $('.coPosition_Edit').text(coPosition);
    $('.coNames_Edit').text(coNames);
    $('input[name=coNames_Edit]').val(coNames);
    $('.coNumberdocument_Edit').text(perName + ': ' + coNumberdocument);
    $('.acoDocumentcode_Edit').text(documentCode);
    $('.coAddress_Edit').text(address);
    $('.coBloodtype_Edit').text(bloodtype);
    $('.coEmail_Edit').text(email);
    $('.coMovil_Edit').text(movil);
    $('.coWhatsapp_Edit').text(whatsapp);
    $('input[name=acoDate_Edit]').val(acoDate);
    $('select[name=acoAbsenteeism_Edit]').val(acoAbsenteeism);
    changeOptionsEdit(acoAbsenteeism, acoHourentry, acoHourexit, acoDescription);
    $('#editControl-modal').modal();
  });

  $('select[name=acoAbsenteeism_Edit]').on('change', function(e) {
    var selected = e.target.value;
    changeOptionsEdit(selected);
  });

  function changeOptionsEdit(selected, entry = '', exit = '', description = '') {
    $('div.acoAbsenteeism-sectionCome_Edit').css('display', 'none');
    $('div.acoAbsenteeism-sectionCome_Edit').find('input').attr('disabled', true);
    $('div.acoAbsenteeism-sectionCome_Edit').find('input').attr('required', false);
    $('div.acoAbsenteeism-sectionCome_Edit').find('input').val('');
    $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').attr('disabled', true);
    $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').attr('required', false);
    $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').val('');
    $('div.acoAbsenteeism-sectionOut_Edit').css('display', 'none');
    $('div.acoAbsenteeism-sectionOut_Edit').find('input').attr('disabled', true);
    $('div.acoAbsenteeism-sectionOut_Edit').find('input').attr('required', false);
    $('div.acoAbsenteeism-sectionOut_Edit').find('input').val('');
    $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').attr('disabled', true);
    $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').attr('required', false);
    $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').val('');
    $('div.acoAbsenteeism-sectionNot_Edit').css('display', 'none');
    $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').attr('disabled', true);
    $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').attr('required', false);
    if (selected != '') {
      switch (selected) {
        case 'NO ASISTIÓ':
          $('div.acoAbsenteeism-sectionCome_Edit').css('display', 'none');
          $('div.acoAbsenteeism-sectionCome_Edit').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome_Edit').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionOut_Edit').css('display', 'none');
          $('div.acoAbsenteeism-sectionOut_Edit').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut_Edit').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionNot_Edit').css('display', 'flex');
          $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').attr('disabled', false);
          $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').attr('required', true);
          $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').val(description);
          break;
        case 'LLEGÓ TARDE':
          $('div.acoAbsenteeism-sectionCome_Edit').css('display', 'flex');
          $('div.acoAbsenteeism-sectionCome_Edit').find('input').attr('disabled', false);
          $('div.acoAbsenteeism-sectionCome_Edit').find('input').attr('required', true);
          $('div.acoAbsenteeism-sectionCome_Edit').find('input').val(entry);
          $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').attr('disabled', false);
          $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').attr('required', true);
          $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').val(description);
          $('div.acoAbsenteeism-sectionOut_Edit').css('display', 'none');
          $('div.acoAbsenteeism-sectionOut_Edit').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut_Edit').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionNot_Edit').css('display', 'none');
          $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').attr('required', false);
          break;
        case 'SALIÓ TEMPRANO':
          $('div.acoAbsenteeism-sectionCome_Edit').css('display', 'none');
          $('div.acoAbsenteeism-sectionCome_Edit').find('input').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome_Edit').find('input').attr('required', false);
          $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionCome_Edit').find('textarea').attr('required', false);
          $('div.acoAbsenteeism-sectionOut_Edit').css('display', 'flex');
          $('div.acoAbsenteeism-sectionOut_Edit').find('input').attr('disabled', false);
          $('div.acoAbsenteeism-sectionOut_Edit').find('input').attr('required', true);
          $('div.acoAbsenteeism-sectionOut_Edit').find('input').val(exit);
          $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').attr('disabled', false);
          $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').attr('required', true);
          $('div.acoAbsenteeism-sectionOut_Edit').find('textarea').val(description);
          $('div.acoAbsenteeism-sectionNot_Edit').css('display', 'none');
          $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').attr('disabled', true);
          $('div.acoAbsenteeism-sectionNot_Edit').find('textarea').attr('required', false);
          break;
      }
    }
  }

  $('.deleteControl-link').on('click', function(e) {
    e.preventDefault();
    var coPhoto = $(this).find('img:first').attr('src');
    var coFirm = $(this).find('img:last').attr('src');
    var acoId = $(this).find('span:nth-child(2)').text();
    var coNames = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var coNumberdocument = $(this).find('span:nth-child(5)').text();
    var coPosition = $(this).find('span:nth-child(6)').text();
    var documentCode = $(this).find('span:nth-child(7)').text();
    var address = $(this).find('span:nth-child(8)').text();
    var bloodtype = $(this).find('span:nth-child(9)').text();
    var email = $(this).find('span:nth-child(10)').text();
    var movil = $(this).find('span:nth-child(11)').text();
    var whatsapp = $(this).find('span:nth-child(12)').text();
    var acoAbsenteeism = $(this).find('span:nth-child(13)').text();
    var acoHourentry = $(this).find('span:nth-child(14)').text();
    var acoHourexit = $(this).find('span:nth-child(15)').text();
    var acoDescription = $(this).find('span:nth-child(16)').text();
    var acoDate = $(this).find('span:nth-child(17)').text();
    $('input[name=acoId_Delete]').val(acoId);
    $('.coPhotonow_Delete').attr('hidden', false);
    $('.coPhotonow_Delete').attr('src', coPhoto);
    if (coFirm != null && coFirm != 'null') {
      $('.coFirmnow_Delete').attr('hidden', false);
      $('.coFirmnow_Delete').attr('src', coFirm);
    } else {
      $('.coFirmnow_Delete').attr('src', '');
      $('.coFirmnow_Delete').attr('hidden', true);
    }
    $('.coPosition_Delete').text(coPosition);
    $('.coNames_Delete').text(coNames);
    $('input[name=coNames_Delete]').val(coNames);
    $('.coNumberdocument_Delete').text(perName + ': ' + coNumberdocument);
    $('.acoDocumentcode_Delete').text(documentCode);
    $('.coAddress_Delete').text(address);
    $('.coBloodtype_Delete').text(bloodtype);
    $('.coEmail_Delete').text(email);
    $('.coMovil_Delete').text(movil);
    $('.coWhatsapp_Delete').text(whatsapp);
    $('.acoDate_Delete').text(acoDate);
    $('.acoAbsenteeism_Delete').text(acoAbsenteeism);
    if (acoHourentry == '' || acoHourentry == null || acoHourentry == 'null') {
      acoHourentry = 'N/A';
    }
    if (acoHourexit == '' || acoHourexit == null || acoHourexit == 'null') {
      acoHourexit = 'N/A';
    }
    $('.acoHourentry_Delete').text(acoHourentry);
    $('.acoHourexit_Delete').text(acoHourexit);
    $('.acoDescription_Delete').text(acoDescription);
    $('#deleteControl-modal').modal();
  });
</script>
@endsection