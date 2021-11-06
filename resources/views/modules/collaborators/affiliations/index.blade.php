@extends('modules.logisticCollaborators')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-6">
      <h6>AFILIACIONES SEGURIDAD SOCIAL</h6>
    </div>
    <div class="col-md-2">
      <button type="button" title="Registrar" class="btn btn-outline-success form-control-sm newAffiliation-link">NUEVO</button>
    </div>
    <div class="col-md-4" style="font-size: 12px;">
      @if(session('SuccessAffiliation'))
      <div class="alert alert-success">
        {{ session('SuccessAffiliation') }}
      </div>
      @endif
      @if(session('PrimaryAffiliation'))
      <div class="alert alert-primary">
        {{ session('PrimaryAffiliation') }}
      </div>
      @endif
      @if(session('WarningAffiliation'))
      <div class="alert alert-warning">
        {{ session('WarningAffiliation') }}
      </div>
      @endif
      @if(session('SecondaryAffiliation'))
      <div class="alert alert-secondary">
        {{ session('SecondaryAffiliation') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>COLABORADOR</th>
        <th>DOCUMENTO DE CONTRATO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($affiliations as $affiliation)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $affiliation->bill->collaborator->coNames }}</td>
        <td>{{ $affiliation->bill->bcoDocumentcode }}</td>
        <td class="d-flex justofy-content-center">
          <a href="#" title="Editar" class="btn btn-outline-primary rounded-circle form-control-sm editAffiliation-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $affiliation->afcId }}</span>
            <span hidden>{{ $affiliation->bill->collaborator->coNames }}</span>
            <span hidden>{{ $affiliation->bill->collaborator->type->perName }}</span>
            <span hidden>{{ $affiliation->bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $affiliation->bill->collaborator->coPosition }}</span>
            <span hidden>{{ $affiliation->afcHealth_id }}</span>
            <span hidden>{{ $affiliation->afcPension_id }}</span>
            <span hidden>{{ $affiliation->afcLayoff_id }}</span>
            <span hidden>{{ $affiliation->afcRisk_id }}</span>
            <span hidden>{{ $affiliation->afcCompensation_id }}</span>
            <img src="{{ asset('storage/collaboratorsPhotos/'.$affiliation->bill->collaborator->coPhoto) }}" hidden>
            @if($affiliation->bill->collaborator->coFirm !== null)
            <img src="{{ asset('storage/collaboratorsFirms/'.$affiliation->bill->collaborator->coFirm) }}" hidden>
            @else
            <img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
            @endif
          </a>
          <a href="#" title="Eliminar" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteAffiliation-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $affiliation->afcId }}</span>
            <span hidden>{{ $affiliation->bill->collaborator->coNames }}</span>
            <span hidden>{{ $affiliation->bill->collaborator->type->perName }}</span>
            <span hidden>{{ $affiliation->bill->collaborator->coNumberdocument }}</span>
            <span hidden>{{ $affiliation->bill->collaborator->coPosition }}</span>
            <span hidden>{{ $affiliation->health->heaName }}</span>
            <span hidden>{{ $affiliation->pension->penName }}</span>
            <span hidden>{{ $affiliation->layoff->layName }}</span>
            <span hidden>{{ $affiliation->risk->risName }}</span>
            <span hidden>{{ $affiliation->compensation->comName }}</span>
            <img src="{{ asset('storage/collaboratorsPhotos/'.$affiliation->bill->collaborator->coPhoto) }}" hidden>
            @if($affiliation->bill->collaborator->coFirm !== null)
            <img src="{{ asset('storage/collaboratorsFirms/'.$affiliation->bill->collaborator->coFirm) }}" hidden>
            @else
            <img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
            @endif
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newAffiliation-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA AFILIACION:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.affiliation.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">COLABORADOR:</small>
                    <select name="afcLegalization_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($collaborators as $collaborator)
                      @if($collaborator->coFirm != null)
                      <option value="{{ $collaborator->bcoId }}" data-names="{{ $collaborator->coNames }}" data-document="{{ $collaborator->coNumberdocument }}" data-firm="{{ asset('storage/collaboratorsFirms/'.$collaborator->coFirm) }}" data-photo="{{ asset('storage/collaboratorsPhotos/'.$collaborator->coPhoto) }}" data-position="{{ $collaborator->coPosition }}">{{ $collaborator->coNames }}</option>
                      @else
                      <option value="{{ $collaborator->bcoId }}" data-names="{{ $collaborator->coNames }}" data-document="{{ $collaborator->coNumberdocument }}" data-firm="{{ __('N/A') }}" data-photo="{{ asset('storage/collaboratorsPhotos/'.$collaborator->coPhoto) }}" data-position="{{ $collaborator->coPosition }}">{{ $collaborator->coNames }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 text-center pt-4">
                  <span class="coPosition"></span><br>
                  <img src="" class="img img-thumbnail coPhotonow" style="width: 150px; height: auto;" hidden><br>
                  <span class="coNames"></span><br>
                  <span class="coNumberdocument"></span><br>
                  <img src="" class="img img-thumbnail coFirmnow" style="width: 150px; height: auto;" hidden><br>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">ENTIDAD PROMOTORA DE SALUD:</small>
                    <select name="afcHealth_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($healths as $health)
                      <option value="{{ $health->heaId }}">{{ $health->heaName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">FONDO DE PENSIONES:</small>
                    <select name="afcPension_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($pensions as $pension)
                      <option value="{{ $pension->penId }}">{{ $pension->penName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">FONDO DE CESANTIAS:</small>
                    <select name="afcLayoff_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($layoffs as $layoff)
                      <option value="{{ $layoff->layId }}">{{ $layoff->layName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">ADMINISTRADORA DE RIESGOS PROFESIONALES:</small>
                    <select name="afcRisk_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($risks as $risk)
                      <option value="{{ $risk->risId }}">{{ $risk->risName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">CAJA DE COMPENSACION:</small>
                    <select name="afcCompensation_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($compensations as $compensation)
                      <option value="{{ $compensation->comId }}">{{ $compensation->comName }}</option>
                      @endforeach
                    </select>
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

<div class="modal fade" id="editAffiliation-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>MODIFICACION DE AFILIACIONES:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborators.affiliation.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6 text-center pt-4">
                  <span class="coPosition_Edit"></span><br>
                  <img src="" class="img img-thumbnail coPhotonow_Edit" style="width: 150px; height: auto;" hidden><br>
                  <span class="coNames_Edit"></span><br>
                  <b class="perName_Edit"></b><br>
                  <span class="coNumberdocument_Edit"></span><br>
                  <img src="" class="img img-thumbnail coFirmnow_Edit" style="width: 150px; height: auto;" hidden><br>
                  <input type="hidden" name="coNames_Edit" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">ENTIDAD PROMOTORA DE SALUD:</small>
                    <select name="afcHealth_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($healths as $health)
                      <option value="{{ $health->heaId }}">{{ $health->heaName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">FONDO DE PENSIONES:</small>
                    <select name="afcPension_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($pensions as $pension)
                      <option value="{{ $pension->penId }}">{{ $pension->penName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">FONDO DE CESANTIAS:</small>
                    <select name="afcLayoff_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($layoffs as $layoff)
                      <option value="{{ $layoff->layId }}">{{ $layoff->layName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">ADMINISTRADORA DE RIESGOS PROFESIONALES:</small>
                    <select name="afcRisk_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($risks as $risk)
                      <option value="{{ $risk->risId }}">{{ $risk->risName }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <small class="text-muted">CAJA DE COMPENSACION:</small>
                    <select name="afcCompensation_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione ...</option>
                      @foreach($compensations as $compensation)
                      <option value="{{ $compensation->comId }}">{{ $compensation->comName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="afcId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteAffiliation-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE AFILIACIONES:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 text-center">
            <span class="coPosition_Delete"></span><br>
            <img src="" class="img img-thumbnail coPhotonow_Delete" style="width: 150px; height: auto;" hidden><br>
            <span class="coNames_Delete"></span><br>
            <b class="perName_Delete"></b><br>
            <span class="coNumberdocument_Delete"></span><br>
            <img src="" class="img img-thumbnail coFirmnow_Delete" style="width: 150px; height: auto;" hidden><br>
          </div>
          <div class="col-md-6 text-center pt-3">
            <small class="text-muted">ENTIDAD PROMOTORA DE SALUD: </small><br>
            <span class="text-muted"><b class="health_Delete"></b></span><br>
            <small class="text-muted">FONDO DE PENSIONES: </small><br>
            <span class="text-muted"><b class="pension_Delete"></b></span><br>
            <small class="text-muted">FONDO DE CESANTIAS: </small><br>
            <span class="text-muted"><b class="layoff_Delete"></b></span><br>
            <small class="text-muted">ADMINISTRADORA DE RIESGOS PROFESIONALES: </small><br>
            <span class="text-muted"><b class="risk_Delete"></b></span><br>
            <small class="text-muted">CAJA DE COMPENSACION: </small><br>
            <span class="text-muted"><b class="compensation_Delete"></b></span><br>
          </div>
        </div>
        <form action="{{ route('collaborators.affiliation.delete') }}" method="POST">
          @csrf
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="afcId_Delete" class="form-control form-control-sm" required>
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

  $('.newAffiliation-link').on('click', function(e) {
    e.preventDefault();
    $('#newAffiliation-modal').modal();
  });

  $('select[name=afcLegalization_id]').on('change', function(e) {
    var selected = e.target.value;
    $('.coPosition').text('');
    $('.coNames').text('');
    $('.coNumberdocument').text('');
    $('img.coPhotonow').attr('src', '');
    $('img.coPhotonow').attr("hidden", true);
    $('img.coFirmnow').attr('src', '');
    $('img.coFirmnow').attr("hidden", true);
    if (selected != '') {
      var names = $('select[name=afcLegalization_id] option:selected').attr('data-names');
      var number = $('select[name=afcLegalization_id] option:selected').attr('data-document');
      var firm = $('select[name=afcLegalization_id] option:selected').attr('data-firm');
      var photo = $('select[name=afcLegalization_id] option:selected').attr('data-photo');
      var position = $('select[name=afcLegalization_id] option:selected').attr('data-position');
      $('.coNames').text(names);
      $('.coNumberdocument').text(number);
      if (firm != 'N/A') {
        $('img.coFirmnow').attr("src", firm);
        $('img.coFirmnow').attr("hidden", false);
      } else {
        $('img.coFirmnow').attr("src", '');
        $('img.coFirmnow').attr("hidden", true);
      }
      $('img.coPhotonow').attr("src", photo);
      $('img.coPhotonow').attr("hidden", false);
      $('.coPosition').text(position);
    }
  });

  $('.editAffiliation-link').on('click', function(e) {
    e.preventDefault();
    var coPhoto = $(this).find('img:first').attr('src');
    var coFirm = $(this).find('img:last').attr('src');
    var afcId = $(this).find('span:nth-child(2)').text();
    var coNames = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var coNumberdocument = $(this).find('span:nth-child(5)').text();
    var coPosition = $(this).find('span:nth-child(6)').text();
    var afcHealth_id = $(this).find('span:nth-child(7)').text();
    var afcPension_id = $(this).find('span:nth-child(8)').text();
    var afcLayoff_id = $(this).find('span:nth-child(9)').text();
    var afcRisk_id = $(this).find('span:nth-child(10)').text();
    var afcCompensation_id = $(this).find('span:nth-child(11)').text();
    $('input[name=afcId_Edit]').val(afcId);
    $('.coPhotonow_Edit').attr("src", coPhoto);
    $('.coPhotonow_Edit').attr("hidden", false);
    $('.coFirmnow_Edit').attr("src", coFirm);
    var findFirmDefault = coFirm.indexOf('firmCollaboratorDefault.png');
    if (findFirmDefault > -1) {
      $('.coFirmnow_Edit').attr("hidden", true);
    } else {
      $('.coFirmnow_Edit').attr("hidden", false);
    }
    $('.coNames_Edit').text(coNames);
    $('input[name=coNames_Edit]').val(coNames);
    $('.perName_Edit').text(perName);
    $('.coNumberdocument_Edit').text(coNumberdocument);
    $('.coPosition_Edit').text(coPosition);
    $('select[name=afcHealth_id_Edit]').val(afcHealth_id);
    $('select[name=afcPension_id_Edit]').val(afcPension_id);
    $('select[name=afcLayoff_id_Edit]').val(afcLayoff_id);
    $('select[name=afcRisk_id_Edit]').val(afcRisk_id);
    $('select[name=afcCompensation_id_Edit]').val(afcCompensation_id);
    $('#editAffiliation-modal').modal();
  });

  $('.deleteAffiliation-link').on('click', function(e) {
    e.preventDefault();
    var coPhoto = $(this).find('img:first').attr('src');
    var coFirm = $(this).find('img:last').attr('src');
    var afcId = $(this).find('span:nth-child(2)').text();
    var coNames = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var coNumberdocument = $(this).find('span:nth-child(5)').text();
    var coPosition = $(this).find('span:nth-child(6)').text();
    var health = $(this).find('span:nth-child(7)').text();
    var pension = $(this).find('span:nth-child(8)').text();
    var layoff = $(this).find('span:nth-child(9)').text();
    var risk = $(this).find('span:nth-child(10)').text();
    var compensation = $(this).find('span:nth-child(11)').text();
    $('input[name=afcId_Delete]').val(afcId);
    $('.coPhotonow_Delete').attr("src", coPhoto);
    $('.coPhotonow_Delete').attr("hidden", false);
    $('.coFirmnow_Delete').attr("src", coFirm);
    var findFirmDefault = coFirm.indexOf('firmCollaboratorDefault.png');
    if (findFirmDefault > -1) {
      $('.coFirmnow_Delete').attr("hidden", true);
    } else {
      $('.coFirmnow_Delete').attr("hidden", false);
    }
    $('.coNames_Delete').text(coNames);
    $('.perName_Delete').text(perName);
    $('.coNumberdocument_Delete').text(coNumberdocument);
    $('.coPosition_Delete').text(coPosition);
    $('.health_Delete').text(health);
    $('.pension_Delete').text(pension);
    $('.layoff_Delete').text(layoff);
    $('.risk_Delete').text(risk);
    $('.compensation_Delete').text(compensation);;
    $('#deleteAffiliation-modal').modal();
  });
</script>
@endsection