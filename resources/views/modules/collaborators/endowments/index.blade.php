@extends('modules.logisticCollaborators')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-6">
      <h6>ENTREGA DE DOTACIONES</h6>
    </div>
    <div class="col-md-2">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newEndowment-link">NUEVO</button>
    </div>
    <div class="col-md-4" style="font-size: 12px;">
      @if(session('SuccessEndowment'))
      <div class="alert alert-success">
        {{ session('SuccessEndowment') }}
      </div>
      @endif
      @if(session('PrimaryEndowment'))
      <div class="alert alert-primary">
        {{ session('PrimaryEndowment') }}
      </div>
      @endif
      @if(session('WarningEndowment'))
      <div class="alert alert-warning">
        {{ session('WarningEndowment') }}
      </div>
      @endif
      @if(session('SecondaryEndowment'))
      <div class="alert alert-secondary">
        {{ session('SecondaryEndowment') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>COLABORADOR</th>
        <th>CODIGO DE ENTREGA</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($endowments as $endowment)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $endowment->bill->collaborator->coNames }}</td>
        <td>{{ $endowment->ecoDocumentcode }}</td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editEndowment-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $endowment->ecoId }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coNames }}</span>
            <span hidden>{{ $endowment->bill->collaborator->type->perName }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coPosition }}</span>
            <span hidden>{{ $endowment->bill->bcoDocumentcode }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coAddress }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coBloodtype }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coEmail }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coMovil }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coWhatsapp }}</span>
            <span hidden>{{ $endowment->ecoDelivery }}</span>
            <img src="{{ asset('storage/collaboratorsPhotos/'.$endowment->bill->collaborator->coPhoto) }}" hidden>
            @if($endowment->bill->collaborator->coFirm !== null)
            <img src="{{ asset('storage/collaboratorsFirms/'.$endowment->bill->collaborator->coFirm) }}" hidden>
            @else
            <img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
            @endif
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteEndowment-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $endowment->ecoId }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coNames }}</span>
            <span hidden>{{ $endowment->bill->collaborator->type->perName }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coPosition }}</span>
            <span hidden>{{ $endowment->bill->bcoDocumentcode }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coAddress }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coBloodtype }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coEmail }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coMovil }}</span>
            <span hidden>{{ $endowment->bill->collaborator->coWhatsapp }}</span>
            <span hidden>{{ $endowment->ecoDelivery }}</span>
            <img src="{{ asset('storage/collaboratorsPhotos/'.$endowment->bill->collaborator->coPhoto) }}" hidden>
            @if($endowment->bill->collaborator->coFirm !== null)
            <img src="{{ asset('storage/collaboratorsFirms/'.$endowment->bill->collaborator->coFirm) }}" hidden>
            @else
            <img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
            @endif
          </a>
          <form action="{{ route('collaborators.endowment.pdf') }}" method="GET" style="display: inline-block;">
            @csrf
            <input type="hidden" name="ecoId" value="{{ $endowment->ecoId }}" class="form-control form-control-sm" required>
            <button type="submit" title="Descargar PDF" class="btn btn-outline-danger rounded-circle form-control-sm">
              <i class="fas fa-file-pdf"></i>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newEndowment-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA ENTREGA DE DOTACION:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.endowment.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
                    <select name="ecoDocument_id" class="form-control form-control-sm" required>
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
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CONTRATO COLABORADOR:</small>
                    <select name="ecoLegalization_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($legalizations as $legalization)
                      <option value="{{ $legalization->bcoId }}" data-names='{{ $legalization->coNames }}' data-type='{{ $legalization->perName }}' data-document='{{ $legalization->coNumberdocument }}' data-position='{{ $legalization->coPosition }}' data-photo='{{ $legalization->coPhoto }}' data-firm='{{ $legalization->coFirm }}' data-address='{{ $legalization->coAddress }}' data-bloodtype='{{ $legalization->coBloodtype }}' data-email='{{ $legalization->coEmail }}' data-movil='{{ $legalization->coMovil }}' data-whatsapp='{{ $legalization->coWhatsapp }}'>
                        {{ $legalization->coNames }}
                      </option>
                      @endforeach
                    </select>
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
                  <small class="text-muted">ACTA DE ENTREGA DE DOTACION: </small><br>
                  <textarea name="ecoDelivery" placeholder="Texto de hasta 2000 carácteres" class="form-control form-control-sm" maxlength="2000" rows="20" required></textarea>
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

<div class="modal fade" id="editEndowment-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>MODIFICACION DE ENTREGA DE DOTACION:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.endowment.update') }}" method="POST">
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
                  <span class="text-muted">DOCUMENTO DE CONTRATO</span><br>
                  <span class="ecoDocument_id_Edit"></span><br>
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
                  <small class="text-muted">ACTA DE ENTREGA DE DOTACION: </small><br>
                  <textarea name="ecoDelivery_Edit" placeholder="Texto de hasta 2000 carácteres" class="form-control form-control-sm" maxlength="2000" rows="20" required></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="coNames_Edit" class="form-control form-control-sm" required>
            <input type="hidden" name="ecoId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteEndowment-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE ENTREGA DE DOTACION:</h5>
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
            <small class="text-muted">ACTA DE ENTREGA DE DOTACION: </small><br>
            <span class="text-muted"><b class="ecoDelivery_Delete"></b></span><br>
          </div>
        </div>
        <form action="{{ route('collaborators.endowment.delete') }}" method="POST">
          @csrf
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="coNames_Delete" class="form-control form-control-sm" required>
            <input type="hidden" name="ecoId_Delete" class="form-control form-control-sm" required>
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

  $('.newEndowment-link').on('click', function(e) {
    e.preventDefault();
    $('#newEndowment-modal').modal();
  });

  $('select[name=ecoDocument_id]').on('change', function(e) {
    var selected = e.target.value;
    $('input[name=dolCode]').val('');
    $('input[name=dolVersion]').val('');
    // $('select[name=ecoLegalization_id]').empty();
    // $('select[name=ecoLegalization_id]').append("<option value=''>Seleccione ...</option>");
    if (selected != '') {
      var code = $('select[name=ecoDocument_id] option:selected').attr('data-code');
      var version = $('select[name=ecoDocument_id] option:selected').attr('data-version');
      $('input[name=dolVersion]').val(version);
      $.get("{{ route('getNextcodeForEndowment') }}", {
        dolId: selected
      }, function(objectsNext) {
        if (objectsNext != null) {
          $('input[name=dolCode]').val(objectsNext);
        } else {
          $('input[name=dolCode]').val('');
        }
      });
      // $.get("{{ route('getLegalizationFromDocument') }}",{dolId: selected},function(objectLegalizations){
      // 	var count = Object.keys(objectLegalizations).length;
      // 	if(count > 0){
      // 		for (var i = 0; i < count; i++) {
      // 			$('select[name=ecoLegalization_id]').append(
      // 				"<option value='" + objectLegalizations[i]['lccId'] + "'" +
      // 					" data-names='" + objectLegalizations[i]['coNames'] + "'" +
      // 					" data-type='" + objectLegalizations[i]['perName'] + "'" +
      // 					" data-document='" + objectLegalizations[i]['coNumberdocument'] + "'" +
      // 					" data-position='" + objectLegalizations[i]['coPosition'] + "'" +
      // 					" data-photo='" + objectLegalizations[i]['coPhoto']  + "'" +
      // 					" data-firm='" + objectLegalizations[i]['coFirm']  + "'" +
      // 					" data-address='" + objectLegalizations[i]['coAddress'] + "'" +
      // 					" data-bloodtype='" + objectLegalizations[i]['coBloodtype'] + "'" +
      // 					" data-email='" + objectLegalizations[i]['coEmail'] + "'" +
      // 					" data-movil='" + objectLegalizations[i]['coMovil'] + "'" +
      // 					" data-whatsapp='" + objectLegalizations[i]['coWhatsapp'] + "'" +
      // 				">" +
      // 					objectLegalizations[i]['coNames'] +
      // 				"</option>"
      // 			);
      // 		}
      // 	}
      // });
    }
  });

  $('select[name=ecoLegalization_id]').on('change', function(e) {
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
      var position = $('select[name=ecoLegalization_id] option:selected').attr('data-position');
      var names = $('select[name=ecoLegalization_id] option:selected').attr('data-names');
      var type = $('select[name=ecoLegalization_id] option:selected').attr('data-type');
      var number = $('select[name=ecoLegalization_id] option:selected').attr('data-document');
      var photo = $('select[name=ecoLegalization_id] option:selected').attr('data-photo');
      var firm = $('select[name=ecoLegalization_id] option:selected').attr('data-firm');
      var address = $('select[name=ecoLegalization_id] option:selected').attr('data-address');
      var bloodtype = $('select[name=ecoLegalization_id] option:selected').attr('data-bloodtype');
      var email = $('select[name=ecoLegalization_id] option:selected').attr('data-email');
      var movil = $('select[name=ecoLegalization_id] option:selected').attr('data-movil');
      var whatsapp = $('select[name=ecoLegalization_id] option:selected').attr('data-whatsapp');
      $('.coPosition').text(position);
      var routePhoto = $('input[name=route_hidden_photo]').val();
      var routeFirm = $('input[name=route_hidden_firm]').val();
      $('.coPhotonow').attr('src', routePhoto + "/" + photo);
      $('.coPhotonow').attr('hidden', false);
      $('.coNames').text(names);
      $('.coNumberdocument').text(type + ': ' + number);
      if (firm != null && firm != 'null') {
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

  $('.editEndowment-link').on('click', function(e) {
    e.preventDefault();
    var coPhoto = $(this).find('img:first').attr('src');
    var coFirm = $(this).find('img:last').attr('src');
    var ecoId = $(this).find('span:nth-child(2)').text();
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
    var ecoDelivery = $(this).find('span:nth-child(13)').text();
    $('input[name=ecoId_Edit]').val(ecoId);
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
    $('.ecoDocument_id_Edit').text(documentCode);
    $('.coAddress_Edit').text(address);
    $('.coBloodtype_Edit').text(bloodtype);
    $('.coEmail_Edit').text(email);
    $('.coMovil_Edit').text(movil);
    $('.coWhatsapp_Edit').text(whatsapp);
    $('textarea[name=ecoDelivery_Edit]').val(ecoDelivery);
    $('#editEndowment-modal').modal();
  });

  $('.deleteEndowment-link').on('click', function(e) {
    e.preventDefault();
    var coPhoto = $(this).find('img:first').attr('src');
    var coFirm = $(this).find('img:last').attr('src');
    var ecoId = $(this).find('span:nth-child(2)').text();
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
    var ecoDelivery = $(this).find('span:nth-child(13)').text();
    $('input[name=ecoId_Delete]').val(ecoId);
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
    $('.ecoDocument_id_Edit').text(documentCode);
    $('.coAddress_Delete').text(address);
    $('.coBloodtype_Delete').text(bloodtype);
    $('.coEmail_Delete').text(email);
    $('.coMovil_Delete').text(movil);
    $('.coWhatsapp_Delete').text(whatsapp);
    $('.ecoDelivery_Delete').text(ecoDelivery);
    $('#deleteEndowment-modal').modal();
  });
</script>
@endsection