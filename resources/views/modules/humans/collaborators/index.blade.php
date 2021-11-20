@extends('modules.administrativeHumans')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>COLABORADORES</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar colaborador" class="btn btn-outline-success form-control-sm newCollaborator-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessCollaborator'))
      <div class="alert alert-success">
        {{ session('SuccessCollaborator') }}
      </div>
      @endif
      @if(session('PrimaryCollaborator'))
      <div class="alert alert-primary">
        {{ session('PrimaryCollaborator') }}
      </div>
      @endif
      @if(session('WarningCollaborator'))
      <div class="alert alert-warning">
        {{ session('WarningCollaborator') }}
      </div>
      @endif
      @if(session('SecondaryCollaborator'))
      <div class="alert alert-secondary">
        {{ session('SecondaryCollaborator') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>NOMBRES</th>
        <th>NUMERO DE DOCUMENTO</th>
        <th>CARGO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($collaborators as $collaborator)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $collaborator->coNames }}</td>
        <td>{{ $collaborator->coNumberdocument }}</td>
        <td>{{ $collaborator->coPosition }}</td>
        <td>
          <button title="Editar colaborador {{ $collaborator->coNames }}" class="btn btn-outline-primary rounded-circle editCollaborator-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $collaborator->coId }}</span>
            <span hidden>{{ $collaborator->coNames }}</span>
            <span hidden>{{ $collaborator->coPersonal_id }}</span>
            <span hidden>{{ $collaborator->coNumberdocument }}</span>
            <span hidden>{{ $collaborator->coPosition }}</span>
            <span hidden>{{ $collaborator->depId }}</span>
            <span hidden>{{ $collaborator->munId }}</span>
            <span hidden>{{ $collaborator->zonId }}</span>
            <span hidden>{{ $collaborator->neId }}</span>
            <span hidden>{{ $collaborator->coAddress }}</span>
            <span hidden>{{ $collaborator->coBloodtype }}</span>
            <span hidden>{{ $collaborator->coHealths_id }}</span>
            <span hidden>{{ $collaborator->coRisk_id }}</span>
            <span hidden>{{ $collaborator->coPension_id }}</span>
            <span hidden>{{ $collaborator->coLayoff_id }}</span>
            <span hidden>{{ $collaborator->coCompensation_id }}</span>
            <span hidden>{{ $collaborator->coEmail }}</span>
            <span hidden>{{ $collaborator->coMovil }}</span>
            <span hidden>{{ $collaborator->coWhatsapp }}</span>
            <span hidden>{{ $collaborator->colRef1 }}</span>
            <span hidden>{{ $collaborator->cedRef1 }}</span>
            <span hidden>{{ $collaborator->numRef1 }}</span>
            <span hidden>{{ $collaborator->colRef2 }}</span>
            <span hidden>{{ $collaborator->cedRef2 }}</span>
            <span hidden>{{ $collaborator->numRef2 }}</span>
            <span hidden>{{ $collaborator->rsRef1 }}</span>
            <span hidden>{{ $collaborator->nitRef1 }}</span>
            <span hidden>{{ $collaborator->addRef1 }}</span>
            <span hidden>{{ $collaborator->phoRef1 }}</span>
            <span hidden>{{ $collaborator->ciuRef1 }}</span>
            <span hidden>{{ $collaborator->rsRef2 }}</span>
            <span hidden>{{ $collaborator->nitRef2 }}</span>
            <span hidden>{{ $collaborator->addRef2 }}</span>
            <span hidden>{{ $collaborator->phoRef2 }}</span>
            <span hidden>{{ $collaborator->ciuRef2 }}</span>
            <span hidden>{{ $collaborator->titlePrimary }}</span>
            <span hidden>{{ $collaborator->acaPrimary }}</span>
            <span hidden>{{ $collaborator->dePrimary }}</span>
            <span hidden>{{ $collaborator->iniPrimary }}</span>
            <span hidden>{{ $collaborator->finPrimary }}</span>
            <span hidden>{{ $collaborator->titleSecondary }}</span>
            <span hidden>{{ $collaborator->acaSecondary }}</span>
            <span hidden>{{ $collaborator->deSecondary }}</span>
            <span hidden>{{ $collaborator->iniSecondary }}</span>
            <span hidden>{{ $collaborator->finSecondary }}</span>
            <span hidden>{{ $collaborator->academics }}</span>
            <span hidden>{{ $collaborator->titles }}</span>
            <span hidden>{{ $collaborator->initials }}</span>
            <span hidden>{{ $collaborator->finals }}</span>
            <img src="{{ asset('storage/collaboratorsPhotos/'.$collaborator->coPhoto) }}" hidden>
            @if($collaborator->coFirm != null)
            <img src="{{ asset('storage/collaboratorsFirms/'.$collaborator->coFirm) }}" hidden>
            @else
            <img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
            @endif
          </button>
          <button title="Eliminar colaborador {{ $collaborator->coNames }}" class="btn btn-outline-tertiary rounded-circle deleteCollaborator-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $collaborator->coId }}</span>
            <span hidden>{{ $collaborator->coNames }}</span>
            <span hidden>{{ $collaborator->perName }}</span>
            <span hidden>{{ $collaborator->coNumberdocument }}</span>
            <span hidden>{{ $collaborator->coPosition }}</span>
            <span hidden>{{ $collaborator->depName }}</span>
            <span hidden>{{ $collaborator->munName }}</span>
            <span hidden>{{ $collaborator->zonName }}</span>
            <span hidden>{{ $collaborator->neName }}</span>
            <span hidden>{{ $collaborator->neCode }}</span>
            <span hidden>{{ $collaborator->coAddress }}</span>
            <span hidden>{{ $collaborator->coBloodtype }}</span>
            <span hidden>{{ $collaborator->heaName }}</span>
            <span hidden>{{ $collaborator->risName }}</span>
            <span hidden>{{ $collaborator->penName }}</span>
            <span hidden>{{ $collaborator->layName }}</span>
            <span hidden>{{ $collaborator->comName }}</span>
            <span hidden>{{ $collaborator->coEmail }}</span>
            <span hidden>{{ $collaborator->coMovil }}</span>
            <span hidden>{{ $collaborator->coWhatsapp }}</span>
            <img src="{{ asset('storage/collaboratorsPhotos/'.$collaborator->coPhoto) }}" hidden>
            @if($collaborator->coFirm != null)
            <img src="{{ asset('storage/collaboratorsFirms/'.$collaborator->coFirm) }}" hidden>
            @else
            <img src="{{ asset('storage/collaboratorsFirms/firmCollaboratorDefault.png') }}" hidden>
            @endif
          </button>
          <button class="btn btn-outline-info rounded-circle Interview" title="{{'Entrevista '.$collaborator->coNames}}"><i class="fas fa-clipboard"></i>
            <span hidden>{{ $collaborator->coNames }}</span>
            <span hidden>{{ $collaborator->coId }}</span>
          </button>
          <button class="btn btn-outline-secondary rounded-circle References" title="{{'Referencias '.$collaborator->coNames}}"><i class="far fa-eye"></i>
            <span hidden>{{ $collaborator->coNames }}</span>
            <span hidden>{{ $collaborator->coId }}</span>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- formulario de referencias -->
<div class="modal fade" id="formCheck">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="references" class="text-capitalize"></h3>
        <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">&xfr;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborator.references') }}" method="post">
          @csrf
          <div class="row">
            <h5 class="text-muted w-100 text-center">REFERENCIAS PERSONALES</h5>
            <div class="col-md-12 row">
              <div class="col-md-4">
                <div class="col-md-12 row">
                  <div class="form-group w-100">
                    <small class="text-muted">NOMBRES COMPLETOS</small>
                    <input type="text" name="colRef1" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group w-100">
                    <small class="text-muted">CEDULA</small>
                    <input type="text" name="cedRef1" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group w-100">
                    <small class="text-muted">TELEFONO</small>
                    <input type="text" name="numRef1" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group w-100">
                    <small class="text-muted">VERIFICACION</small>
                    <select name="ver1" class="form-control form-control-sm">
                      <option value="">{{ucfirst('seleccione...')}}</option>
                      <option value="{{strtoupper('verificada')}}">{{strtoupper('verificada')}}</option>
                      <option value="{{strtoupper('no verificada')}}">{{strtoupper('no verificada')}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="text-muted">{{ucwords('observaciones')}}</div>
                <textarea name="obsver1" cols="30" rows="13" class="form-control form-control-sm"></textarea>
              </div>
            </div>
            <hr>
            <div class="col-md-12 row">
              <div class="col-md-4">
                <div class="col-md-12 row">
                  <div class="form-group w-100">
                    <small class="text-muted">NOMBRES COMPLETOS</small>
                    <input type="text" name="colRef2" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group w-100">
                    <small class="text-muted">CEDULA</small>
                    <input type="text" name="cedRef2" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group w-100">
                    <small class="text-muted">TELEFONO</small>
                    <input type="text" name="numRef2" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group w-100">
                    <small class="text-muted">VERIFICACION</small>
                    <select name="ver2" class="form-control form-control-sm">
                      <option value="">{{ucfirst('seleccione...')}}</option>
                      <option value="{{strtoupper('verificada')}}">{{strtoupper('verificada')}}</option>
                      <option value="{{strtoupper('no verificada')}}">{{strtoupper('no verificada')}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="text-muted">{{ucwords('observaciones')}}</div>
                <textarea name="obsver2" cols="30" rows="13" class="form-control form-control-sm"></textarea>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <h5 class="text-muted w-100 text-center">REFERENCIAS LABORALES</h5>
            <div class="col-md-12 row">
              <div class="col-md-4">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">RAZON SOCIAL</small>
                    <input type="text" name="rsRef1" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">NIT</small>
                    <input type="text" name="nitRef1" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION</small>
                    <input type="text" name="addRef1" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">TELEFONO</small>
                    <input type="text" name="phoRef1" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CIUDAD</small>
                    <input type="text" name="ciuRef1" class="form-control form-control-sm">
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="w-100">
                  <div class="col-md-6">
                    <small class="text-muted">VERIFICACION</small>
                    <select name="verRef1" class="form-control form-control-sm">
                      <option value="">{{ucfirst('seleccione...')}}</option>
                      <option value="{{strtoupper('verificada')}}">{{strtoupper('verificada')}}</option>
                      <option value="{{strtoupper('no verificada')}}">{{strtoupper('no verificada')}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="text-muted">{{ucwords('observaciones')}}</div>
                  <textarea name="obsverRef1" cols="30" rows="13" class="form-control form-control-sm"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-12 row">
              <div class="col-md-4">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">RAZON SOCIAL</small>
                    <input type="text" name="rsRef2" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">NIT</small>
                    <input type="text" name="nitRef2" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION</small>
                    <input type="text" name="addRef2" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">TELEFONO</small>
                    <input type="text" name="phoRef2" class="form-control form-control-sm">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CIUDAD</small>
                    <input type="text" name="ciuRef2" class="form-control form-control-sm">
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="w-100">
                  <div class="col-md-6">
                    <small class="text-muted">VERIFICACION</small>
                    <select name="verRef2" class="form-control form-control-sm">
                      <option value="">{{ucfirst('seleccione...')}}</option>
                      <option value="{{strtoupper('verificada')}}">{{strtoupper('verificada')}}</option>
                      <option value="{{strtoupper('no verificada')}}">{{strtoupper('no verificada')}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="text-muted">{{ucwords('observaciones')}}</div>
                  <textarea name="obsverRef2" cols="30" rows="13" class="form-control form-control-sm"></textarea>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="w-100 d-flex justify-content-center my-3">
            <input type="hidden" name="rc_collaborator_id">
            <button type="submit" class="btn btn-outline-success">{{ucwords('guardar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formulario de entrevista -->
<div class="modal fade" id="formInterview">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header justify-content-between">
        <h3 id="header" class="text-capitalize"></h3>
        <button type="button" class="btn btn-sm btn-tertiary" data-dismiss="modal">&xfr;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('interview.save')}}" method="post">
          @csrf
          <div class="col-lg-12 row">
            <div class="col-lg-6">
              <div class="form-group">
                <small class="text-muted">{{ucwords('fecha:')}}</small>
                <b class="text-secondary">{{$date}}</b>
                <input type="hidden" name="int_date">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <small class="text-muted">{{ucwords('Hora:')}}</small>
                <b id="hour" class="text-secondary"></b>
                <input type="hidden" name="int_hour">
              </div>
            </div>
          </div>
          <div class="col-lg-12 row">
            <div class="col-lg-6">
              <div class="col-lg-12">
                <div class="form-group">
                  <small class="text-muted">{{ucwords('cumplimiento')}}</small>
                  <select name="int_compliance" class="form-control form-control-sm">
                    <option value="">{{ucfirst('seleccione...')}}</option>
                    <option value="LLEGO A TIEMPO">LLEGO A TIEMPO</option>
                    <option value="LLEGO TARDE">LLEGO TARDE</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <small class="text-muted">{{ucwords('presentación')}}</small>
                  <select name="int_presence" class="form-control form-control-sm">
                    <option value="">{{ucwords('seleccione...')}}</option>
                    <option value="EXCELENTE">EXCELENTE</option>
                    <option value="BUENA">BUENA</option>
                    <option value="REGULAR">REGULAR</option>
                    <option value="MALO">MALO</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <small class="text-muted">{{ucwords('observaciones')}}</small>
                <textarea name="int_Obs" cols="30" rows="10" class="form-control form-control-sm"></textarea>
              </div>
            </div>
          </div>
          <hr>
          <div class="col-lg-12 justify-content-center d-flex">
            <input type="hidden" name="int_IdCollaborator">
            <button class="btn btn-outline-success">{{ucwords('guardar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formulario de creación -->
<div class="modal fade" id="newCollaborator-modal">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO COLABORADOR:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborator.save') }}" method="POST" enctype="multipart/form-data">
          @include('modules.humans.partials.formCollaborator')
          <div class="form-group text-center pt-2 border-top">
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formualrio de edición -->
<div class="modal fade" id="editCollaborator-modal">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR COLABORADOR:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('collaborator.update') }}" method="POST" enctype="multipart/form-data">
          <div class="col-md-12 row">
            <div class="col-md-6 row justify-content-center">
              <div class="form-group">
                <small class="text-muted">FOTO ACTUAL:</small><br>
                <img src="" class="img-thumbnail text-center coPhotonow_Edit" style="width: 3cm!important; height: 4cm!important;"><br>
                <small class="text-muted coPhotonot_Edit d-flex justify-content-center my-2">
                  <input type="checkbox" name="coPhotonot_Edit" value="SIN FOTO">
                  <b class="ml-1">Dejar sin fotografia</b>
                </small>
              </div>
            </div>
            <div class="col-md-6 row justify-content-center">
              <div class="form-group">
                <small class="text-muted">FIRMA ACTUAL:</small><br>
                <img src="" class="img-thumbnail text-center coFirmnow_Edit" style="width: 3cm!important; height: 4cm!important;"><br>
                <small class="text-muted coFirmnot_Edit d-flex justify-content-center my-2">
                  <input type="checkbox" name="coFirmnot_Edit" value="SIN FIRMA">
                  <b class="ml-1">Dejar sin firma</b>
                </small>
              </div>
            </div>
          </div>
          @include('modules.humans.partials.formCollaborator')
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="coId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteCollaborator-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>DETALLES/ELIMINACION DE COLABORADOR:</h5>
      </div>
      <div class="modal-body">
        <div class="row text-center">
          <div class="col-md-12">
            <span class="text-muted"><b class="coNames_Delete"></b></span><br>
            <span class="text-muted"><b class="coPersonal_id_Delete"></b>: <b class="coNumberdocument_Delete"></b></span><br>
            <span class="text-muted"><b class="coPosition_Delete"></b></span><br>
          </div>
        </div>
        <div class="row text-center py-2">
          <div class="col-md-6">
            <img src="" class="img-responsive img-thumbnail coPhotonow_Delete" style="width: 150px; height: 150px;">
          </div>
          <div class="col-md-6">
            <img src="" class="img-responsive img-thumbnail coFirmnow_Delete" style="width: 150px; height: 150px;">
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-12">
            <small class="text-muted">DEPARTAMENTO/CIUDAD: </small><br>
            <span class="text-muted"><b class="coDeparment_id_Delete"></b>/<b class="coMunicipality_id_Delete"></b></span><br>
            <small class="text-muted">LOCALIDAD/BARRIO/CODIGO POSTAL: </small><br>
            <span class="text-muted"><b class="coZoning_id_Delete"></b>/<b class="coNeighborhood_id_Delete"></b>/<b class="coCode_Delete"></b></span><br>
            <small class="text-muted">DIRECCION: </small><br>
            <span class="text-muted"><b class="coAddress_Delete"></b></span><br>
            <small class="text-muted">CORREO ELECTRONICO: </small><br>
            <span class="text-muted"><b class="coEmail_Delete"></b></span><br>
            <small class="text-muted">TELEFONO CELULAR: </small><br>
            <span class="text-muted"><b class="coMovil_Delete"></b></span><br>
            <small class="text-muted">LINEA WHATSAPP: </small><br>
            <span class="text-muted"><b class="coWhatsapp_Delete"></b></span><br>
            <hr>
            <small class="text-muted">TIPO DE SANGRE: </small><br>
            <span class="text-muted"><b class="coBloodtype_Delete"></b></span><br>
            <small class="text-muted">ENTIDAD PROMOTORA DE SALUD: </small><br>
            <span class="text-muted"><b class="coHealths_id_Delete"></b></span><br>
            <small class="text-muted">ADMINISTRADORA DE RIESGOS LABORALES: </small><br>
            <span class="text-muted"><b class="coRisk_id_Delete"></b></span><br>
            <small class="text-muted">CAJA DE COMPENSACION: </small><br>
            <span class="text-muted"><b class="coCompensation_id_Delete"></b></span><br>
            <small class="text-muted">FONDO DE PENSION: </small><br>
            <span class="text-muted"><b class="coPension_id_Delete"></b></span><br>
            <small class="text-muted">FONDO DE CESANTIAS: </small><br>
            <span class="text-muted"><b class="coLayoff_id_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('collaborator.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="coId_Delete" value="" required>
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
  // *llama al formulario de validación referencias
  $('.References').click(function() {
    const name = $(this).find('span:nth-child(2)').text();
    const id = $(this).find('span:nth-child(3)').text();
    $("#references").empty();
    $("#references").prepend(`Referencias de ${name}`);
    $.ajax({
      "_token": "{{csrf_token()}}",
      type: "POST",
      dataType: "JSON",
      url: "{{ route('apiCollaborator') }}",
      data: {
        data: id
      },
      beforeSend() {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 1500,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'info',
          title: `Consultando las referencias de ${name.toUpperCase()}`
        })
      },
      success(res) {
        $('input[name=colRef1]').val(res.colRef1);
        $('input[name=colRef2]').val(res.colRef2);
        $('input[name=cedRef1]').val(res.cedRef1);
        $('input[name=cedRef2]').val(res.cedRef2);
        $('input[name=numRef1]').val(res.numRef1);
        $('input[name=numRef2]').val(res.numRef2);
        $('input[name=rsRef1]').val(res.rsRef1);
        $('input[name=rsRef2]').val(res.rsRef2);
        $('input[name=nitRef1]').val(res.nitRef1);
        $('input[name=nitRef2]').val(res.nitRef2);
        $('input[name=addRef1]').val(res.addRef1);
        $('input[name=addRef2]').val(res.addRef2);
        $('input[name=phoRef1]').val(res.phoRef1);
        $('input[name=phoRef2]').val(res.phoRef2);
        $('input[name=ciuRef1]').val(res.ciuRef1);
        $('input[name=ciuRef2]').val(res.ciuRef2);
        $('input[name=rc_collaborator_id]').val(id);
      },
      complete() {
        $('#formCheck').modal();
      }
    })
  });
  // *carga hora actual
  const timer = setInterval(() => {
    let now = new Date();
    let date = now.toLocaleDateString();
    let hour = now.toLocaleTimeString('en-En');
    $('#hour').text(('00:00:00' + hour).slice(-11));
    $('input[name=int_hour]').val(('00:00:00' + hour).slice(-11));
    $('input[name=int_date]').val(date);
  }, 1000);

  // *llama al formulario de entrevista
  $('.Interview').click(function() {
    const name = $(this).find('span:nth-child(2)').text();
    const id = $(this).find('span:nth-child(3)').text();
    $("#header").empty();
    $("#header").prepend(`entrevista ${name}`);
    $('input[name=int_IdCollaborator]').val(id);
    $('#formInterview').modal();
  });

  // *añade una nueva linea para agregar otros
  $('.addOthers').click(function() {
    $('.Others').prepend(`
    <div class="col-md-12 row">
      <div class="col-md-4">
        <div class="form-group">
          <small class="text-muted">CENTRO ACADEMICO</small>
          <input type="text" name="academics[]" class="form-control form-control-sm">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <small class="text-muted">TITULO</small>
          <input type="text" name="titles[]" class="form-control form-control-sm">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <small class="text-muted">INICIO</small>
          <input type="date" name="initials[]" class="form-control form-control-sm">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <small class="text-muted">FIN</small>
          <input type="date" name="finals[]" class="form-control form-control-sm">
        </div>
      </div>
    </div>
    `);
  });

  // ?lanza el formulario de creación
  $('.newCollaborator-link').on('click', function() {
    $('#newCollaborator-modal').modal();
  });

  // ?lanza el formulario de edición
  $('.editCollaborator-link').on('click', function(e) {
    e.preventDefault();
    let coPhoto = $(this).find('img:first').attr('src');
    let coFirm = $(this).find('img:last').attr('src');
    let coId = $(this).find('span:nth-child(2)').text();
    let coNames = $(this).find('span:nth-child(3)').text();
    let coPersonal_id = $(this).find('span:nth-child(4)').text();
    let coNumberdocument = $(this).find('span:nth-child(5)').text();
    let coPosition = $(this).find('span:nth-child(6)').text();
    let depId = $(this).find('span:nth-child(7)').text();
    let munId = $(this).find('span:nth-child(8)').text();
    let zonId = $(this).find('span:nth-child(9)').text();
    let neId = $(this).find('span:nth-child(10)').text();
    let coAddress = $(this).find('span:nth-child(11)').text();
    let coBloodtype = $(this).find('span:nth-child(12)').text();
    let coHealths_id = $(this).find('span:nth-child(13)').text();
    let coRisk_id = $(this).find('span:nth-child(14)').text();
    let coPension_id = $(this).find('span:nth-child(15)').text();
    let coLayoff_id = $(this).find('span:nth-child(16)').text();
    let coCompensation_id = $(this).find('span:nth-child(17)').text();
    let coEmail = $(this).find('span:nth-child(18)').text();
    let coMovil = $(this).find('span:nth-child(19)').text();
    let coWhatsapp = $(this).find('span:nth-child(20)').text();
    let colRef1 = $(this).find('span:nth-child(21)').text();
    let cedRef1 = $(this).find('span:nth-child(22)').text();
    let numRef1 = $(this).find('span:nth-child(23)').text();
    let colRef2 = $(this).find('span:nth-child(24)').text();
    let cedRef2 = $(this).find('span:nth-child(25)').text();
    let numRef2 = $(this).find('span:nth-child(26)').text();
    let rsRef1 = $(this).find('span:nth-child(27)').text();
    let nitRef1 = $(this).find('span:nth-child(28)').text();
    let addRef1 = $(this).find('span:nth-child(29)').text();
    let phoRef1 = $(this).find('span:nth-child(30)').text();
    let ciuRef1 = $(this).find('span:nth-child(31)').text();
    let rsRef2 = $(this).find('span:nth-child(32)').text();
    let nitRef2 = $(this).find('span:nth-child(33)').text();
    let addRef2 = $(this).find('span:nth-child(34)').text();
    let phoRef2 = $(this).find('span:nth-child(35)').text();
    let ciuRef2 = $(this).find('span:nth-child(36)').text();
    let titlePrimary = $(this).find('span:nth-child(37)').text();
    let acaPrimary = $(this).find('span:nth-child(38)').text();
    let dePrimary = $(this).find('span:nth-child(39)').text();
    let iniPrimary = $(this).find('span:nth-child(40)').text();
    let finPrimary = $(this).find('span:nth-child(41)').text();
    let titleSecondary = $(this).find('span:nth-child(42)').text();
    let acaSecondary = $(this).find('span:nth-child(43)').text();
    let deSecondary = $(this).find('span:nth-child(44)').text();
    let iniSecondary = $(this).find('span:nth-child(45)').text();
    let finSecondary = $(this).find('span:nth-child(46)').text();
    let academics = $(this).find('span:nth-child(47)').text();
    let titles = $(this).find('span:nth-child(48)').text();
    let initials = $(this).find('span:nth-child(49)').text();
    let finals = $(this).find('span:nth-child(50)').text();

    $('input[name=coId_Edit]').val(coId);
    $('.coPhotonow_Edit').attr("src", coPhoto);
    $('.coFirmnow_Edit').attr("src", coFirm);
    let findFirmDefault = coFirm.indexOf('firmCollaboratorDefault.png');
    if (findFirmDefault > -1) {
      $('.coFirmnot_Edit').css("display", "none");
    } else {
      $('.coFirmnot_Edit').css("display", "block");
    }
    let findPhotoDefault = coPhoto.indexOf('photoCollaboratorDefault.png');
    if (findPhotoDefault > -1) {
      $('.coPhotonot_Edit').css("display", "none");
    } else {
      $('.coPhotonot_Edit').css("display", "block");
    }
    $('input[name=coNames]').val(coNames);
    $('select[name=coPersonal_id]').val(coPersonal_id);
    $('input[name=coNumberdocument]').val(coNumberdocument);
    $('input[name=coPosition]').val(coPosition);
    $('select[name=coDeparment_id]').val(depId);

    $('select[name=coMunicipality_id]').empty();
    $('select[name=coMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $.get("{{ route('getMunicipalities') }}", {
      depId: depId
    }, function(objectMunicipalities) {
      let count = Object.keys(objectMunicipalities).length;
      if (count > 0) {
        for (let i = 0; i < count; i++) {
          if (objectMunicipalities[i]['munId'] == munId) {
            $('select[name=coMunicipality_id]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "' selected>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          } else {
            $('select[name=coMunicipality_id]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      }
    });

    $('select[name=coZoning_id]').empty();
    $('select[name=coZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $.get("{{ route('getZonings') }}", {
      munId: munId
    }, function(objectZonings) {
      let count = Object.keys(objectZonings).length;
      if (count > 0) {
        for (let i = 0; i < count; i++) {
          if (objectZonings[i]['zonId'] == zonId) {
            $('select[name=coZoning_id]').append(
              "<option value='" + objectZonings[i]['zonId'] + "' selected>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          } else {
            $('select[name=coZoning_id]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      }
    });

    $('select[name=coNeighborhood_id]').empty();
    $('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $.get("{{ route('getNeighborhoods') }}", {
      zonId: zonId
    }, function(objectNeighborhoods) {
      let count = Object.keys(objectNeighborhoods).length;
      if (count > 0) {
        for (let i = 0; i < count; i++) {
          if (objectNeighborhoods[i]['neId'] == neId) {
            $('input[name=coCode]').val(objectNeighborhoods[i]['neCode']);
            $('select[name=coNeighborhood_id]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "' selected>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          } else {
            $('select[name=coNeighborhood_id]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "'>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          }
        }
      }
    });

    $('input[name=coAddress]').val(coAddress);
    $('select[name=coBloodtype]').val(coBloodtype);
    $('select[name=coHealths_id]').val(coHealths_id);
    $('select[name=coRisk_id]').val(coRisk_id);
    $('select[name=coPension_id]').val(coPension_id);
    $('select[name=coLayoff_id]').val(coLayoff_id);
    $('select[name=coCompensation_id]').val(coCompensation_id);
    $('input[name=coEmail]').val(coEmail);
    $('input[name=coMovil]').val(coMovil);
    $('input[name=coWhatsapp]').val(coWhatsapp);
    $('input[name=colRef1]').val(colRef1);
    $('input[name=cedRef1]').val(cedRef1);
    $('input[name=numRef1]').val(numRef1);
    $('input[name=colRef2]').val(colRef2);
    $('input[name=cedRef2]').val(cedRef2);
    $('input[name=numRef2]').val(numRef2);
    $('input[name=rsRef1]').val(rsRef1);
    $('input[name=nitRef1]').val(nitRef1);
    $('input[name=addRef1]').val(addRef1);
    $('input[name=phoRef1]').val(phoRef1);
    $('input[name=ciuRef1]').val(ciuRef1);
    $('input[name=rsRef2]').val(rsRef2);
    $('input[name=nitRef2]').val(nitRef2);
    $('input[name=addRef2]').val(addRef2);
    $('input[name=phoRef2]').val(phoRef2);
    $('input[name=ciuRef2]').val(ciuRef2);
    $('input[name=titlePrimary]').val(titlePrimary);
    $('input[name=acaPrimary]').val(acaPrimary);
    $('input[name=dePrimary]').val(dePrimary);
    $('input[name=iniPrimary]').val(iniPrimary);
    $('input[name=finPrimary]').val(finPrimary);
    $('input[name=titleSecondary]').val(titleSecondary);
    $('input[name=acaSecondary]').val(acaSecondary);
    $('input[name=deSecondary]').val(deSecondary);
    $('input[name=iniSecondary]').val(iniSecondary);
    $('input[name=finSecondary]').val(finSecondary);

    if (academics.length != 0 & titles.length != 0 & initials.length != 0 & finals.length != 0) {
      let academic = JSON.parse(academics);
      let title = JSON.parse(titles);
      let initial = JSON.parse(initials);
      let final = JSON.parse(finals);

      for (const key in academic) {
        $('.Others').prepend(`
          <div class="col-md-12 row">
            <div class="col-md-4">
              <div class="form-group">
                <small class="text-muted">CENTRO ACADEMICO</small>
                <input type="text" name="academics[]" class="form-control form-control-sm" value="${academic[key]}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <small class="text-muted">TITULO</small>
                <input type="text" name="titles[]" class="form-control form-control-sm" value="${title[key]}">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <small class="text-muted">INICIO</small>
                <input type="date" name="initials[]" class="form-control form-control-sm"
                value="${initial[key]}">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <small class="text-muted">FIN</small>
                <input type="date" name="finals[]" class="form-control form-control-sm" value="${final[key]}">
              </div>
            </div>
          </div>
        `);
      }
    }

    $('#editCollaborator-modal').modal();
  });

  $('.deleteCollaborator-link').on('click', function(e) {
    e.preventDefault();
    let coPhoto = $(this).find('img:first').attr('src');
    let coFirm = $(this).find('img:last').attr('src');
    let coId = $(this).find('span:nth-child(2)').text();
    let coNames = $(this).find('span:nth-child(3)').text();
    let perName = $(this).find('span:nth-child(4)').text();
    let coNumberdocument = $(this).find('span:nth-child(5)').text();
    let coPosition = $(this).find('span:nth-child(6)').text();
    let depName = $(this).find('span:nth-child(7)').text();
    let munName = $(this).find('span:nth-child(8)').text();
    let zonName = $(this).find('span:nth-child(9)').text();
    let neName = $(this).find('span:nth-child(10)').text();
    let neCode = $(this).find('span:nth-child(11)').text();
    let coAddress = $(this).find('span:nth-child(12)').text();
    let coBloodtype = $(this).find('span:nth-child(13)').text();
    let coHealths_id = $(this).find('span:nth-child(14)').text();
    let coRisk_id = $(this).find('span:nth-child(15)').text();
    let coPension_id = $(this).find('span:nth-child(16)').text();
    let coLayoff_id = $(this).find('span:nth-child(17)').text();
    let coCompensation_id = $(this).find('span:nth-child(18)').text();
    let coEmail = $(this).find('span:nth-child(19)').text();
    let coMovil = $(this).find('span:nth-child(20)').text();
    let coWhatsapp = $(this).find('span:nth-child(21)').text();
    $('input[name=coId_Delete]').val(coId);
    $('.coNames_Delete').text(coNames);
    $('.coPersonal_id_Delete').text(perName);
    $('.coNumberdocument_Delete').text(coNumberdocument);
    $('.coPosition_Delete').text(coPosition);
    $('.coPhotonow_Delete').attr('src', coPhoto)
    $('.coFirmnow_Delete').attr('src', coFirm)
    $('.coDeparment_id_Delete').text(depName);
    $('.coMunicipality_id_Delete').text(munName);
    $('.coZoning_id_Delete').text(zonName);
    $('.coNeighborhood_id_Delete').text(neName);
    $('.coCode_Delete').text(neCode);
    $('.coAddress_Delete').text(coAddress);
    $('.coEmail_Delete').text(coEmail);
    $('.coMovil_Delete').text(coMovil);
    $('.coWhatsapp_Delete').text(coWhatsapp);
    $('.coBloodtype_Delete').text(coBloodtype);
    $('.coHealths_id_Delete').text(coHealths_id);
    $('.coRisk_id_Delete').text(coRisk_id);
    $('.coPension_id_Delete').text(coPension_id);
    $('.coLayoff_id_Delete').text(coLayoff_id);
    $('.coCompensation_id_Delete').text(coCompensation_id);
    $('#deleteCollaborator-modal').modal();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO SELECCIONADO EN EL MODAL DE NUEVA INFORMACION
  $('select[name=coDeparment_id]').on('change', function(e) {
    let deparmentSelected = e.target.value;
    $('select[name=coMunicipality_id]').empty();
    $('select[name=coMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=coZoning_id]').empty();
    $('select[name=coZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=coNeighborhood_id]').empty();
    $('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=coCode]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        let count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=coMunicipality_id]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELECCIONADA EN EL MODAL DE NUEVA INFORMACION
  $('select[name=coMunicipality_id]').on('change', function(e) {
    let municipalitySelected = e.target.value;
    $('select[name=coZoning_id]').empty();
    $('select[name=coZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=coNeighborhood_id]').empty();
    $('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=coCode]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        let count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=coZoning_id]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELECCIONADA EN EL MODAL DE NUEVA INFORMACION
  $('select[name=coZoning_id]').on('change', function(e) {
    let zoneSelected = e.target.value;
    $('select[name=coNeighborhood_id]').empty();
    $('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=coCode]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        let count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=coNeighborhood_id]').append(
              "<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" +
              objectNeighborhood[i]['neName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELECCIONADA EN EL MODAL DE NUEVA INFORMACION
  $('select[name=coNeighborhood_id]').on('change', function(e) {
    let neSelected = e.target.value;
    $('input[name=coCode]').val('');
    if (neSelected != '') {
      let text = $('select[name=coNeighborhood_id] option:selected').attr('data-code');
      $('input[name=coCode]').val(text);
    }
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO SELECCIONADO EN EL MODAL DE EDICION DE INFORMACION
  $('select[name=coDeparment_id]').on('change', function(e) {
    let deparmentSelected = e.target.value;
    $('select[name=coMunicipality_id]').empty();
    $('select[name=coMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=coZoning_id]').empty();
    $('select[name=coZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=coNeighborhood_id]').empty();
    $('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=coCode]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        let count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=coMunicipality_id]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELECCIONADA EN EL MODAL DE EDICION DE INFORMACION
  $('select[name=coMunicipality_id]').on('change', function(e) {
    let municipalitySelected = e.target.value;
    $('select[name=coZoning_id]').empty();
    $('select[name=coZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=coNeighborhood_id]').empty();
    $('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=coCode]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        let count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=coZoning_id]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELECCIONADA EN EL MODAL DE EDICION DE INFORMACION
  $('select[name=coZoning_id]').on('change', function(e) {
    let zoneSelected = e.target.value;
    $('select[name=coNeighborhood_id]').empty();
    $('select[name=coNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=coCode]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        let count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=coNeighborhood_id]').append(
              "<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" +
              objectNeighborhood[i]['neName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELECCIONADA EN EL MODAL DE NUEVA INFORMACION
  $('select[name=coNeighborhood_id]').on('change', function(e) {
    let neSelected = e.target.value;
    $('input[name=coCode]').val('');
    if (neSelected != '') {
      let text = $('select[name=coNeighborhood_id] option:selected').attr('data-code');
      $('input[name=coCode]').val(text);
    }
  });
</script>
@endsection