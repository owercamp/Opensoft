@extends('modules.administrativeHumans')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5 id="titleSection">CONTRATISTAS SERVICIOS ESPECIALES</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar contratista de servicio especial" class="btn btn-outline-success form-control-sm newContractor-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessContractor'))
      <div class="alert alert-success">
        {{ session('SuccessContractor') }}
      </div>
      @endif
      @if(session('PrimaryContractor'))
      <div class="alert alert-primary">
        {{ session('PrimaryContractor') }}
      </div>
      @endif
      @if(session('WarningContractor'))
      <div class="alert alert-warning">
        {{ session('WarningContractor') }}
      </div>
      @endif
      @if(session('SecondaryContractor'))
      <div class="alert alert-secondary">
        {{ session('SecondaryContractor') }}
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
        <th>NUMERO DE LICENCIA</th>
        <th>AceIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($contractorsespecials as $contractor)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $contractor->ceNames }}</td>
        <td>{{ $contractor->ceNumberdocument }}</td>
        <td>{{ $contractor->ceNumberdriving }}</td>
        <td>
          <button href="#" title="Editar contratista {{ ucwords($contractor->ceNames) }}" class="btn btn-outline-primary rounded-circle editContractor-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $contractor->ceId }}</span>
            <span hidden>{{ $contractor->ceNames }}</span>
            <span hidden>{{ $contractor->cePersonal_id }}</span>
            <span hidden>{{ $contractor->ceNumberdocument }}</span>
            <span hidden>{{ $contractor->ceDriving_id }}</span>
            <span hidden>{{ $contractor->ceNumberdriving }}</span>
            <span hidden>{{ $contractor->depId }}</span>
            <span hidden>{{ $contractor->munId }}</span>
            <span hidden>{{ $contractor->zonId }}</span>
            <span hidden>{{ $contractor->neId }}</span>
            <span hidden>{{ $contractor->ceAddress }}</span>
            <span hidden>{{ $contractor->ceBloodtype }}</span>
            <span hidden>{{ $contractor->ceHealths_id }}</span>
            <span hidden>{{ $contractor->ceRisk_id }}</span>
            <span hidden>{{ $contractor->cePension_id }}</span>
            <span hidden>{{ $contractor->ceLayoff_id }}</span>
            <span hidden>{{ $contractor->ceCompensation_id }}</span>
            <span hidden>{{ $contractor->ceEmail }}</span>
            <span hidden>{{ $contractor->ceMovil }}</span>
            <span hidden>{{ $contractor->ceWhatsapp }}</span>
            <span hidden>{{ $contractor->ceCourses }}</span>
            <span hidden>{{ $contractor->colRef1 }}</span>
            <span hidden>{{ $contractor->cedRef1 }}</span>
            <span hidden>{{ $contractor->numRef1 }}</span>
            <span hidden>{{ $contractor->colRef2 }}</span>
            <span hidden>{{ $contractor->cedRef2 }}</span>
            <span hidden>{{ $contractor->numRef2 }}</span>
            <span hidden>{{ $contractor->rsRef1 }}</span>
            <span hidden>{{ $contractor->nitRef1 }}</span>
            <span hidden>{{ $contractor->addRef1 }}</span>
            <span hidden>{{ $contractor->phoRef1 }}</span>
            <span hidden>{{ $contractor->ciuRef1 }}</span>
            <span hidden>{{ $contractor->rsRef2 }}</span>
            <span hidden>{{ $contractor->nitRef2 }}</span>
            <span hidden>{{ $contractor->addRef2 }}</span>
            <span hidden>{{ $contractor->phoRef2 }}</span>
            <span hidden>{{ $contractor->ciuRef2 }}</span>
            <span hidden>{{ $contractor->titlePrimary }}</span>
            <span hidden>{{ $contractor->acaPrimary }}</span>
            <span hidden>{{ $contractor->dePrimary }}</span>
            <span hidden>{{ $contractor->iniPrimary }}</span>
            <span hidden>{{ $contractor->finPrimary }}</span>
            <span hidden>{{ $contractor->titleSecondary }}</span>
            <span hidden>{{ $contractor->acaSecondary }}</span>
            <span hidden>{{ $contractor->deSecondary }}</span>
            <span hidden>{{ $contractor->iniSecondary }}</span>
            <span hidden>{{ $contractor->finSecondary }}</span>
            <span hidden>{{ $contractor->academics }}</span>
            <span hidden>{{ $contractor->titles }}</span>
            <span hidden>{{ $contractor->initials }}</span>
            <span hidden>{{ $contractor->finals }}</span>
            <img src="{{ asset('storage/contractorsEspecialPhotos/'.$contractor->cePhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsEspecialFirms/'.$contractor->ceFirm) }}" hidden>
          </button>
          <button href="#" title="Eliminar contratista {{ ucwords($contractor->ceNames) }}" class="btn btn-outline-tertiary rounded-circle deleteContractor-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $contractor->ceId }}</span>
            <span hidden>{{ $contractor->ceNames }}</span>
            <span hidden>{{ $contractor->perName }}</span>
            <span hidden>{{ $contractor->ceNumberdocument }}</span>
            <span hidden>{{ $contractor->driCategory }}</span>
            <span hidden>{{ $contractor->ceNumberdriving }}</span>
            <span hidden>{{ $contractor->depName }}</span>
            <span hidden>{{ $contractor->munName }}</span>
            <span hidden>{{ $contractor->zonName }}</span>
            <span hidden>{{ $contractor->neName }}</span>
            <span hidden>{{ $contractor->neCode }}</span>
            <span hidden>{{ $contractor->ceAddress }}</span>
            <span hidden>{{ $contractor->ceBloodtype }}</span>
            <span hidden>{{ $contractor->heaName }}</span>
            <span hidden>{{ $contractor->risName }}</span>
            <span hidden>{{ $contractor->penName }}</span>
            <span hidden>{{ $contractor->layName }}</span>
            <span hidden>{{ $contractor->comName }}</span>
            <span hidden>{{ $contractor->ceEmail }}</span>
            <span hidden>{{ $contractor->ceMovil }}</span>
            <span hidden>{{ $contractor->ceWhatsapp }}</span>
            <span hidden>{{ $contractor->ceCourses }}</span>
            <span hidden>{{ $contractor->colRef1 }}</span>
            <span hidden>{{ $contractor->cedRef1 }}</span>
            <span hidden>{{ $contractor->numRef1 }}</span>
            <span hidden>{{ $contractor->colRef2 }}</span>
            <span hidden>{{ $contractor->cedRef2 }}</span>
            <span hidden>{{ $contractor->numRef2 }}</span>
            <span hidden>{{ $contractor->rsRef1 }}</span>
            <span hidden>{{ $contractor->nitRef1 }}</span>
            <span hidden>{{ $contractor->addRef1 }}</span>
            <span hidden>{{ $contractor->phoRef1 }}</span>
            <span hidden>{{ $contractor->ciuRef1 }}</span>
            <span hidden>{{ $contractor->rsRef2 }}</span>
            <span hidden>{{ $contractor->nitRef2 }}</span>
            <span hidden>{{ $contractor->addRef2 }}</span>
            <span hidden>{{ $contractor->phoRef2 }}</span>
            <span hidden>{{ $contractor->ciuRef2 }}</span>
            <span hidden>{{ $contractor->titlePrimary }}</span>
            <span hidden>{{ $contractor->acaPrimary }}</span>
            <span hidden>{{ $contractor->dePrimary }}</span>
            <span hidden>{{ $contractor->iniPrimary }}</span>
            <span hidden>{{ $contractor->finPrimary }}</span>
            <span hidden>{{ $contractor->titleSecondary }}</span>
            <span hidden>{{ $contractor->acaSecondary }}</span>
            <span hidden>{{ $contractor->deSecondary }}</span>
            <span hidden>{{ $contractor->iniSecondary }}</span>
            <span hidden>{{ $contractor->finSecondary }}</span>
            <span hidden>{{ $contractor->academics }}</span>
            <span hidden>{{ $contractor->titles }}</span>
            <span hidden>{{ $contractor->initials }}</span>
            <span hidden>{{ $contractor->finals }}</span>
            <img src="{{ asset('storage/contractorsEspecialPhotos/'.$contractor->cePhoto) }}" hidden>
            <img src="{{ asset('storage/contractorsEspecialFirms/'.$contractor->ceFirm) }}" hidden>
          </button>
          <button class="btn btn-outline-info rounded-circle Interview" title="{{'Entrevista '.ucwords($contractor->ceNames)}}"><i class="fas fa-clipboard"></i>
            <span hidden>{{ $contractor->ceNames }}</span>
            <span hidden>{{ $contractor->ceId }}</span>
          </button>
          <button class="btn btn-outline-secondary rounded-circle References" title="{{'Referencias '.ucwords($contractor->ceNames)}}"><i class="far fa-eye"></i>
            <span hidden>{{ $contractor->ceNames }}</span>
            <span hidden>{{ $contractor->ceId }}</span>
          </button>
          <button class="btn btn-outline-tertiary rounded-circle CV" title="{{'Hoja de Vida '.ucwords($contractor->ceNames)}}"><i class="fas fa-award"></i><span hidden>{{ $contractor->ceId}}</span></button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- formulario para crear el PDF de la hoja de vida -->
<div hidden aria-hidden="true">
  <form action="{{route('cv.collaborators')}}" method="post" id="formCV">
    @csrf
    <input type="text" name="idSearch">
    <input type="text" name="FormSubmit">
  </form>
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
        <form action="{{ route('specials.references') }}" method="post">
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
                    <select name="ver1" class="form-control form-control-sm" required>
                      <option value="">{{ucfirst('seleccione...')}}</option>
                      <option value="{{strtoupper('verificada')}}">{{strtoupper('verificada')}}</option>
                      <option value="{{strtoupper('no verificada')}}">{{strtoupper('no verificada')}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="text-muted">{{ucwords('observaciones')}}</div>
                <textarea name="obsver1" cols="30" rows="13" class="form-control form-control-sm" required></textarea>
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
                    <select name="ver2" class="form-control form-control-sm" required>
                      <option value="">{{ucfirst('seleccione...')}}</option>
                      <option value="{{strtoupper('verificada')}}">{{strtoupper('verificada')}}</option>
                      <option value="{{strtoupper('no verificada')}}">{{strtoupper('no verificada')}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="text-muted">{{ucwords('observaciones')}}</div>
                <textarea name="obsver2" cols="30" rows="13" class="form-control form-control-sm" required></textarea>
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
                    <input type="text" name="nitRef1" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION</small>
                    <input type="text" name="addRef1" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">TELEFONO</small>
                    <input type="text" name="phoRef1" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CIUDAD</small>
                    <input type="text" name="ciuRef1" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="w-100">
                  <div class="col-md-6">
                    <small class="text-muted">VERIFICACION</small>
                    <select name="verRef1" class="form-control form-control-sm" required>
                      <option value="">{{ucfirst('seleccione...')}}</option>
                      <option value="{{strtoupper('verificada')}}">{{strtoupper('verificada')}}</option>
                      <option value="{{strtoupper('no verificada')}}">{{strtoupper('no verificada')}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="text-muted">{{ucwords('observaciones')}}</div>
                  <textarea name="obsverRef1" cols="30" rows="13" class="form-control form-control-sm" required></textarea>
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
                    <input type="text" name="nitRef2" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION</small>
                    <input type="text" name="addRef2" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">TELEFONO</small>
                    <input type="text" name="phoRef2" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">CIUDAD</small>
                    <input type="text" name="ciuRef2" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="w-100">
                  <div class="col-md-6">
                    <small class="text-muted">VERIFICACION</small>
                    <select name="verRef2" class="form-control form-control-sm" required>
                      <option value="">{{ucfirst('seleccione...')}}</option>
                      <option value="{{strtoupper('verificada')}}">{{strtoupper('verificada')}}</option>
                      <option value="{{strtoupper('no verificada')}}">{{strtoupper('no verificada')}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="text-muted">{{ucwords('observaciones')}}</div>
                  <textarea name="obsverRef2" cols="30" rows="13" class="form-control form-control-sm" required></textarea>
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
        <form action="{{route('specials.save')}}" method="post">
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
<div class="modal fade" id="newContractor-modal">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO CONTRATISTA DE SERVICIO ESPECIAL:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractorsEspecial.save') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FOTOGRAFIA:</small>
                    <div class="custom-file">
                      <input type="file" name="cePhoto" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" aceept="image/jpg,image/jpeg,image/png">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">FIRMA DIGITAL:</small>
                    <div class="custom-file">
                      <input type="file" name="ceFirm" lang="es" placeholder="Unicamente con extensión .jpg .jpeg o .png" aceept="image/jpg,image/jpeg,image/png">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">NOMBRES COMPLETOS:</small>
                    <input type="text" name="ceNames" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION:</small>
                    <select name="cePersonal_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione identificación ...</option>
                      @foreach($personals as $personal)
                      <option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                    <input type="text" name="ceNumberdocument" maxlength="15" pattern="[0-9]{1,15}" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE LICENCIA:</small>
                    <select name="ceDriving_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione licencia ...</option>
                      @foreach($drivings as $driving)
                      <option value="{{ $driving->driId }}">{{ $driving->driCategory }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE LICENCIA:</small>
                    <input type="text" name="ceNumberdriving" maxlength="15" pattern="[0-9]{1,15}" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
                  </div>
                </div>
              </div>
              <div class="row py-4">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">DEPARTAMENTO:</small>
                        <select name="ceDeparment_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione departamento ...</option>
                          @foreach($deparments as $deparment)
                          <option value="{{ $deparment->depId }}">{{ $deparment->depName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">CIUDAD/MUNICIPIO:</small>
                        <select name="ceMunicipality_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione ciudad/municipio ...</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">LOCALIDAD/ZONA:</small>
                        <select name="ceZoning_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione localidad/zona ...</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">BARRIO:</small>
                        <select name="ceNeighborhood_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione barrio ...</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">CODIGO POSTAL:</small>
                        <input type="text" name="ceCode" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">DIRECCION:</small>
                        <input type="text" name="ceAddress" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CORREO ELECTRONICO:</small>
                        <input type="email" name="ceEmail" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direceiondecorreo@teminacion.com" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO CELULAR:</small>
                        <input type="text" name="ceMovil" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">LINEA WHATSAPP:</small>
                        <input type="text" name="ceWhatsapp" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-4">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">TIPO SANGUINEO:</small>
                        <select name="ceBloodtype" class="form-control form-control-sm" required>
                          <option value="">Seleccione tipo de sangre ...</option>
                          <option value="A POSITIVO">A POSITIVO</option>
                          <option value="A NEGATIVO">A NEGATIVO</option>
                          <option value="B POSITIVO">B POSITIVO</option>
                          <option value="B NEGATIVO">B NEGATIVO</option>
                          <option value="O POSITIVO">O POSITIVO</option>
                          <option value="O NEGATIVO">O NEGATIVO</option>
                          <option value="AB POSITIVO">AB POSITIVO</option>
                          <option value="AB NEGATIVO">AB NEGATIVO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">ENTIDAD PROMOTORA DE SALUD:</small>
                        <select name="ceHealths_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione entidad de salud ...</option>
                          @foreach($healths as $health)
                          <option value="{{ $health->heaId }}">{{ $health->heaName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">ADMINISTRADORA DE RIESGOS LABORALES:</small>
                        <select name="ceRisk_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione entidad de riesgos ...</option>
                          @foreach($risks as $risk)
                          <option value="{{ $risk->risId }}">{{ $risk->risName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">CAJA DE COMPENSACION:</small>
                        <select name="ceCompensation_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione caja ...</option>
                          @foreach($compensations as $compensation)
                          <option value="{{ $compensation->comId }}">{{ $compensation->comName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">FONDO DE PENSION:</small>
                        <select name="cePension_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione fondo de pensión ...</option>
                          @foreach($pensions as $pension)
                          <option value="{{ $pension->penId }}">{{ $pension->penName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">FONDE CESANTIAS:</small>
                        <select name="ceLayoff_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione fondo de cesantías ...</option>
                          @foreach($layoffs as $layoff)
                          <option value="{{ $layoff->layId }}">{{ $layoff->layName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row m-3 p-3 border">
                    <div class="col-md-12">
                      <div class="row text-center">
                        <div class="col-md-12">
                          <h6>CURSOS CERTIFICADOS</h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <small class="text-muted">CURSO:</small>
                            <select name="ceCourse_id" class="form-control form-control-sm">
                              <option value="">Seleccione curso ...</option>
                              @foreach($courses as $course)
                              <option value="{{ $course->couId }}" data-couIntensity="{{ $course->couIntensity }}">{{ $course->couName }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4 text-center">
                          <button type="button" class="btn btn-outline-success form-control-sm mt-3 btn-addCourse-newContractor" title='AGREGUE CURSOS CERTIFICADOS'>Agregar curso</button>
                        </div>
                        <div class="col-md-4 p-3 text-center">
                          <small class="infoRepeat" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-hover text-center tbl-courses-newContractor" width="100%" style="font-size: 12px;">
                            <thead>
                              <th>CURSO</th>
                              <th>DURACION</th>
                              <th>FECHA DE CERTIFICACION</th>
                              <th></th>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <h5 class="text-muted w-100 text-center">REFERENCIAS PERSONALES</h5>
                    <div class="col-md-12 row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">NOMBRES COMPLETOS</small>
                          <input type="text" name="colRef1" class="form-control form-control-sm" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">CEDULA</small>
                          <input type="text" name="cedRef1" class="form-control form-control-sm" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">TELEFONO</small>
                          <input type="text" name="numRef1" class="form-control form-control-sm" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">NOMBRES COMPLETOS</small>
                          <input type="text" name="colRef2" class="form-control form-control-sm" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">CEDULA</small>
                          <input type="text" name="cedRef2" class="form-control form-control-sm" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">TELEFONO</small>
                          <input type="text" name="numRef2" class="form-control form-control-sm" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <h5 class="text-muted w-100 text-center">REFERENCIAS LABORALES</h5>
                    <div class="col-md-12 row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <small class="text-muted">RAZON SOCIAL</small>
                          <input type="text" name="rsRef1" class="form-control form-control-sm" required>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <small class="text-muted">NIT</small>
                          <input type="text" name="nitRef1" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <small class="text-muted">DIRECCION</small>
                          <input type="text" name="addRef1" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <small class="text-muted">TELEFONO</small>
                          <input type="text" name="phoRef1" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <small class="text-muted">CIUDAD</small>
                          <input type="text" name="ciuRef1" class="form-control form-control-sm">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <small class="text-muted">RAZON SOCIAL</small>
                          <input type="text" name="rsRef2" class="form-control form-control-sm" required>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <small class="text-muted">NIT</small>
                          <input type="text" name="nitRef2" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <small class="text-muted">DIRECCION</small>
                          <input type="text" name="addRef2" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <small class="text-muted">TELEFONO</small>
                          <input type="text" name="phoRef2" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <small class="text-muted">CIUDAD</small>
                          <input type="text" name="ciuRef2" class="form-control form-control-sm">
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <h5 class="text-muted w-100 text-center">FORMACION ACADEMICA</h5>
                    <div class="col-md-12 row justify-content-around">
                      <h6 class="text-muted w-100 ml-3">Primaria</h6>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">TITULO</small>
                          <input type="text" name="titlePrimary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">CENTRO ACADEMICO</small>
                          <input type="text" name="acaPrimary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">CIUDAD/DEPARTAMENTO</small>
                          <input type="text" name="dePrimary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <small class="text-muted">INICIO</small>
                          <input type="date" name="iniPrimary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <small class="text-muted">FIN</small>
                          <input type="date" name="finPrimary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <h6 class="text-muted w-100 ml-3">Secundaria</h6>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">TITULO</small>
                          <input type="text" name="titleSecondary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">CENTRO ACADEMICO</small>
                          <input type="text" name="acaSecondary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <small class="text-muted">CIUDAD/DEPARTAMENTO</small>
                          <input type="text" name="deSecondary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <small class="text-muted">INICIO</small>
                          <input type="date" name="iniSecondary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <small class="text-muted">FIN</small>
                          <input type="date" name="finSecondary" class="form-control form-control-sm">
                        </div>
                      </div>
                      <h6 class="text-muted w-100 ml-3">Otros</h6>
                      <div class="w-100 ml-3 Others"></div>
                      <div class="col-md-12 d-flex justify-content-center py-2">
                        <button type="button" class="btn btn-outline-danger btn-sm row addOthers"><i class="fas fa-plus"></i> Agregar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="ceCourses" class="form-control form-control-sm" placeholder="Ids courses" readonly>
            <button type="submit" class="btn btn-outline-success form-control-sm btn-saveDefinitive">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formulario de edición -->
<div class="modal fade" id="editContractor-modal">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR CONTRATISTA DE SERVICIO ESPECIAL:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('contractorsEspecial.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @csrf
          <div class="col-md-12 row">
            <div class="col-md-6 row justify-content-center">
              <div class="form-group">
                <small class="text-muted">FOTO ACTUAL:</small><br>
                <img src="" class="img-thumbnail text-center cePhotonow_Edit" style="width: 3cm!important; height: 4cm!important;"><br>
                <small class="text-muted cePhotonot_Edit d-flex justify-content-center my-2">
                  <input type="checkbox" name="cePhotonot_Edit" value="SIN FOTO">
                  <b class="ml-1">Dejar sin fotografia</b>
                </small>
              </div>
            </div>
            <div class="col-md-6 row justify-content-center">
              <div class="form-group">
                <small class="text-muted">FIRMA ACTUAL:</small><br>
                <img src="" class="img-thumbnail text-center ceFirmnow_Edit" style="width: 3cm!important; height: 4cm!important;"><br>
                <small class="text-muted ceFirmnot_Edit d-flex justify-content-center my-2">
                  <input type="checkbox" name="ceFirmnot_Edit" value="SIN FIRMA">
                  <b class="ml-1">Dejar sin firma</b>
                </small>
              </div>
            </div>
          </div>
          <div class="col-md-12 row">
            <div class="col-md-6 row justify-content-center">
              <div class="form-group">
                <small class="text-muted">FOTOGRAFIA:</small>
                <div class="custom-file">
                  <input type="file" name="cePhoto_Edit" lang="es" placeholder="Unicamente con extensión .png" accept=".png">
                </div>
              </div>
            </div>
            <div class="col-md-6 row justify-content-center">
              <div class="form-group">
                <small class="text-muted">FIRMA DIGITAL:</small>
                <div class="custom-file">
                  <input type="file" name="ceFirm_Edit" lang="es" placeholder="Unicamente con extensión .png" accept=".png">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">NOMBRES COMPLETOS:</small>
                    <input type="text" name="ceNames_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Transportes Operalo" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION:</small>
                    <select name="cePersonal_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione identificación ...</option>
                      @foreach($personals as $personal)
                      <option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                    <input type="text" name="ceNumberdocument_Edit" maxlength="15" pattern="[0-9]{1,15}" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE LICENCIA:</small>
                    <select name="ceDriving_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione licencia ...</option>
                      @foreach($drivings as $driving)
                      <option value="{{ $driving->driId }}">{{ $driving->driCategory }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE LICENCIA:</small>
                    <input type="text" name="ceNumberdriving_Edit" maxlength="15" pattern="[0-9]{1,15}" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
                  </div>
                </div>
              </div>
              <div class="row py-4">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">DEPARTAMENTO:</small>
                        <select name="ceDeparment_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione departamento ...</option>
                          @foreach($deparments as $deparment)
                          <option value="{{ $deparment->depId }}">{{ $deparment->depName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">CIUDAD/MUNICIPIO:</small>
                        <select name="ceMunicipality_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ciudad/municipio ...</option>
                          <!-- munId - munName - munDepartment_id -->
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">LOCALIDAD/ZONA:</small>
                        <select name="ceZoning_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione localidad/zona ...</option>
                          <!-- zonId - zonName - zonMunicipality_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">BARRIO:</small>
                        <select name="ceNeighborhood_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione barrio ...</option>
                          <!-- neId - neName - neZoning_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">CODIGO POSTAL:</small>
                        <input type="text" name="ceCode_Edit" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION:</small>
                    <input type="text" name="ceAddress_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CORREO ELECTRONICO:</small>
                        <input type="email" name="ceEmail_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO CELULAR:</small>
                        <input type="text" name="ceMovil_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">LINEA WHATSAPP:</small>
                        <input type="text" name="ceWhatsapp_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-4">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">TIPO SANGUINEO:</small>
                        <select name="ceBloodtype_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione tipo de sangre ...</option>
                          <option value="A POSITIVO">A POSITIVO</option>
                          <option value="A NEGATIVO">A NEGATIVO</option>
                          <option value="B POSITIVO">B POSITIVO</option>
                          <option value="B NEGATIVO">B NEGATIVO</option>
                          <option value="O POSITIVO">O POSITIVO</option>
                          <option value="O NEGATIVO">O NEGATIVO</option>
                          <option value="AB POSITIVO">AB POSITIVO</option>
                          <option value="AB NEGATIVO">AB NEGATIVO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">ENTIDAD PROMOTORA DE SALUD:</small>
                        <select name="ceHealths_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione entidad de salud ...</option>
                          @foreach($healths as $health)
                          <option value="{{ $health->heaId }}">{{ $health->heaName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">ADMINISTRADORA DE RIESGOS LABORALES:</small>
                        <select name="ceRisk_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione entidad de riesgos ...</option>
                          @foreach($risks as $risk)
                          <option value="{{ $risk->risId }}">{{ $risk->risName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">CAJA DE COMPENSACION:</small>
                        <select name="ceCompensation_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione caja ...</option>
                          @foreach($compensations as $compensation)
                          <option value="{{ $compensation->comId }}">{{ $compensation->comName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">FONDO DE PENSION:</small>
                        <select name="cePension_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione fondo de pensión ...</option>
                          @foreach($pensions as $pension)
                          <option value="{{ $pension->penId }}">{{ $pension->penName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">FONDE CESANTIAS:</small>
                        <select name="ceLayoff_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione fondo de cesantías ...</option>
                          @foreach($layoffs as $layoff)
                          <option value="{{ $layoff->layId }}">{{ $layoff->layName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row m-3 p-3 border">
                    <div class="col-md-12">
                      <div class="row text-center">
                        <div class="col-md-12">
                          <h6>CURSOS CERTIFICADOS</h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <small class="text-muted">CURSO:</small>
                            <select name="ceCourse_id_Edit" class="form-control form-control-sm">
                              <option value="">Seleccione curso ...</option>
                              @foreach($courses as $course)
                              <option value="{{ $course->couId }}" data-couIntensity="{{ $course->couIntensity }}">{{ $course->couName }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4 text-center">
                          <button type="button" class="btn btn-outline-success form-control-sm mt-3 btn-addCourse-editContractor" title='AGREGUE CURSOS CERTIFICADOS'>Agregar curso</button>
                        </div>
                        <div class="col-md-4 p-3 text-center">
                          <small class="infoRepeat_Edit" style="display: none; transition: all .2s; color: red; font-size: 15px;"></small>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-hover text-center tbl-courses-editContractor" width="100%" style="font-size: 12px;">
                            <thead>
                              <th>CURSO</th>
                              <th>DURACION</th>
                              <th>FECHA DE CERTIFICACION</th>
                              <th></th>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <h5 class="text-muted w-100 text-center">REFERENCIAS PERSONALES</h5>
            <div class="col-md-12 row">
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">NOMBRES COMPLETOS</small>
                  <input type="text" name="colRef1_Edit" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">CEDULA</small>
                  <input type="text" name="cedRef1_Edit" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">TELEFONO</small>
                  <input type="text" name="numRef1_Edit" class="form-control form-control-sm" required>
                </div>
              </div>
            </div>
            <div class="col-md-12 row">
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">NOMBRES COMPLETOS</small>
                  <input type="text" name="colRef2_Edit" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">CEDULA</small>
                  <input type="text" name="cedRef2_Edit" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">TELEFONO</small>
                  <input type="text" name="numRef2_Edit" class="form-control form-control-sm" required>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <h5 class="text-muted w-100 text-center">REFERENCIAS LABORALES</h5>
            <div class="col-md-12 row">
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">RAZON SOCIAL</small>
                  <input type="text" name="rsRef1_Edit" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">NIT</small>
                  <input type="text" name="nitRef1_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">DIRECCION</small>
                  <input type="text" name="addRef1_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">TELEFONO</small>
                  <input type="text" name="phoRef1_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">CIUDAD</small>
                  <input type="text" name="ciuRef1_Edit" class="form-control form-control-sm">
                </div>
              </div>
            </div>
            <div class="col-md-12 row">
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">RAZON SOCIAL</small>
                  <input type="text" name="rsRef2_Edit" class="form-control form-control-sm" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">NIT</small>
                  <input type="text" name="nitRef2_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">DIRECCION</small>
                  <input type="text" name="addRef2_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">TELEFONO</small>
                  <input type="text" name="phoRef2_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <small class="text-muted">CIUDAD</small>
                  <input type="text" name="ciuRef2_Edit" class="form-control form-control-sm">
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <h5 class="text-muted w-100 text-center">FORMACION ACADEMICA</h5>
            <div class="col-md-12 row justify-content-around">
              <h6 class="text-muted w-100 ml-3">Primaria</h6>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">TITULO</small>
                  <input type="text" name="titlePrimary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">CENTRO ACADEMICO</small>
                  <input type="text" name="acaPrimary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">CIUDAD/DEPARTAMENTO</small>
                  <input type="text" name="dePrimary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">INICIO</small>
                  <input type="date" name="iniPrimary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">FIN</small>
                  <input type="date" name="finPrimary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <h6 class="text-muted w-100 ml-3">Secundaria</h6>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">TITULO</small>
                  <input type="text" name="titleSecondary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">CENTRO ACADEMICO</small>
                  <input type="text" name="acaSecondary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <small class="text-muted">CIUDAD/DEPARTAMENTO</small>
                  <input type="text" name="deSecondary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">INICIO</small>
                  <input type="date" name="iniSecondary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <small class="text-muted">FIN</small>
                  <input type="date" name="finSecondary_Edit" class="form-control form-control-sm">
                </div>
              </div>
              <h6 class="text-muted w-100 ml-3">Otros</h6>
              <div class="w-100 ml-3 Others_Edit"></div>
              <div class="col-md-12 d-flex justify-content-center py-2">
                <button type="button" class="btn btn-outline-danger btn-sm row addOthers_Edit"><i class="fas fa-plus"></i> Agregar</button>
              </div>
            </div>
          </div>
          <div class="form-group text-center pt-2 border-top">
            <input type="hidden" name="ceCourses_Edit" class="form-control form-control-sm" placeholder="Ids courses" readonly>
            <input type="hidden" name="ceId_Edit" class="form-control form-control-sm" required>
            <button type="submit" class="btn btn-outline-success form-control-sm btn-updateDefinitive">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteContractor-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>DETALLES/ELIMINACION DE CONTRATISTA DE SERVICIO ESPECIAL:</h5>
      </div>
      <div class="modal-body">
        <div class="row text-center">
          <div class="col-md-12">
            <span class="text-muted"><b class="ceNames_Delete"></b></span><br>
            <span class="text-muted"><b class="cePersonal_id_Delete"></b>: <b class="ceNumberdocument_Delete"></b></span><br>
            <span class="text-muted"><b class="ceDriving_id_Delete"></b>: <b class="ceNumberdriving_Delete"></b></span><br>
          </div>
        </div>
        <div class="row text-center py-2">
          <div class="col-md-6">
            <img src="" class="img-responsive img-thumbnail cePhotonow_Delete" style="width: 150px; height: 150px;">
          </div>
          <div class="col-md-6">
            <img src="" class="img-responsive img-thumbnail ceFirmnow_Delete" style="width: 150px; height: 150px;">
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-12">
            <small class="text-muted">DEPARTAMENTO/CIUDAD: </small><br>
            <span class="text-muted"><b class="ceDeparment_id_Delete"></b>/<b class="ceMunicipality_id_Delete"></b></span><br>
            <small class="text-muted">LOCALIDAD/BARRIO/CODIGO POSTAL: </small><br>
            <span class="text-muted"><b class="ceZoning_id_Delete"></b>/<b class="ceNeighborhood_id_Delete"></b>/<b class="ceCode_Delete"></b></span><br>
            <small class="text-muted">DIREceION: </small><br>
            <span class="text-muted"><b class="ceAddress_Delete"></b></span><br>
            <small class="text-muted">CORREO ELECTRONICO: </small><br>
            <span class="text-muted"><b class="ceEmail_Delete"></b></span><br>
            <small class="text-muted">TELEFONO CELULAR: </small><br>
            <span class="text-muted"><b class="ceMovil_Delete"></b></span><br>
            <small class="text-muted">LINEA WHATSAPP: </small><br>
            <span class="text-muted"><b class="ceWhatsapp_Delete"></b></span><br>
            <hr>
            <small class="text-muted">TIPO DE SANGRE: </small><br>
            <span class="text-muted"><b class="ceBloodtype_Delete"></b></span><br>
            <small class="text-muted">ENTIDAD PROMOTORA DE SALUD: </small><br>
            <span class="text-muted"><b class="ceHealths_id_Delete"></b></span><br>
            <small class="text-muted">ADMINISTRADORA DE RIESGOS LABORALES: </small><br>
            <span class="text-muted"><b class="ceRisk_id_Delete"></b></span><br>
            <small class="text-muted">CAJA DE COMPENSACION: </small><br>
            <span class="text-muted"><b class="ceCompensation_id_Delete"></b></span><br>
            <small class="text-muted">FONDO DE PENSION: </small><br>
            <span class="text-muted"><b class="cePension_id_Delete"></b></span><br>
            <small class="text-muted">FONDO DE CESANTIAS: </small><br>
            <span class="text-muted"><b class="ceLayoff_id_Delete"></b></span><br>
            <hr>
            <small class="text-muted">CURSOS CERTIFICADOS: </small><br>
            <ul class="list-group ceCourses_Delete">
              <!-- Li dinamics -->
            </ul>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('contractorsEspecial.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="ceId_Delete" value="" required>
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
  $('input[name=cedRef1]').mask('###',{reverse:true});
  $('input[name=numRef1]').mask('###',{reverse:true});
  $('input[name=cedRef2]').mask('###',{reverse:true});
  $('input[name=numRef2]').mask('###',{reverse:true});
  $('input[name=cedRef1_Edit]').mask('###',{reverse:true});
  $('input[name=numRef1_Edit]').mask('###',{reverse:true});
  $('input[name=cedRef2_Edit]').mask('###',{reverse:true});
  $('input[name=numRef2_Edit]').mask('###',{reverse:true});
  
  // *se envia el id para consultar la información del colaborador para generar el PDF y toma el nombre de la cabecera
  $('.CV').click(function() {
    let id = $(this).find('span:nth-child(2)').text();
    let form = $('#titleSection').text();
    $('input[name=idSearch]').val(id);
    $('input[name=FormSubmit]').val(form);
    $('#formCV').submit();
  });
  
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
      url: "{{ route('apiSpecial') }}",
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

  // *añade una nueva linea para agregar otros en formulario Edición
  $('.addOthers_Edit').click(function() {
    $('.Others_Edit').prepend(`
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

  // *llama al formulario de entrevista
  $('.Interview').click(function() {
    const name = $(this).find('span:nth-child(2)').text();
    const id = $(this).find('span:nth-child(3)').text();
    $("#header").empty();
    $("#header").prepend(`entrevista ${name}`);
    $('input[name=int_IdCollaborator]').val(id);
    $('#formInterview').modal();
  });

  /*=================================================================================
  	/ Registro de contratistas \
  =================================================================================*/

  $('.newContractor-link').on('click', function() {
    $('.tbl-courses-newContractor').find('tbody').empty();
    $('#newContractor-modal').modal();
  });

  // BOTON PARA AGREGAR CURSOS CERTIFICADOS A NUEVO CONTRATISTA
  $('.btn-addCourse-newContractor').on('click', function() {
    let couId = $('select[name=ceCourse_id]').val();
    let couName = $('select[name=ceCourse_id] option:selected').text();
    let couIntensity = $('select[name=ceCourse_id] option:selected').attr('data-couIntensity');
    let validateRepet = false;
    $('.tbl-courses-newContractor').find('tbody').find('tr').each(function() {
      let idCou = $(this).attr('class');
      if (idCou == couId) {
        validateRepet = true;
      }
    });
    if (couId != '') {
      if (validateRepet == false) {
        $('.tbl-courses-newContractor').find('tbody').append(
          "<tr class='" + couId + "' data-idCourse='" + couId + "'>" +
          "<td>" + couName + "</td>" +
          "<td>" + couIntensity + "</td>" +
          "<td><input type='date' class='inputDatecourse-newContractor form-control form-control-sm text-center datepicker' required></td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteCourse-newContractor'><i class='fas fa-trash-alt'></i></button>" +
          "</td>" +
          "</tr>"
        );
      } else {
        $('.infoRepeat').css('display', 'block');
        $('.infoRepeat').text('Curso certificado repetido');
        setTimeout(function() {
          $('.infoRepeat').css('display', 'none');
          $('.infoRepeat').text('');
        }, 3000);
      }
    } else {
      $('.infoRepeat').css('display', 'block');
      $('.infoRepeat').text('Seleccione un curso');
      setTimeout(function() {
        $('.infoRepeat').css('display', 'none');
        $('.infoRepeat').text('');
      }, 3000);
    }
  });

  // EVENTO PARA CLICK EN MODAL, GUARDAR EL NUEVO CONTRATISTA
  $('.btn-saveDefinitive').on('click', function(e) {
    // e.preventDefault();
    let allCourses = '';
    $('input[name=ceCourses]').val('');
    $('.tbl-courses-newContractor').find('tbody').find('tr').each(function() {
      let idCourse = $(this).attr('data-idCourse');
      let dateCourse = $(this).find('input[type=date]').val();
      allCourses += idCourse + '>' + dateCourse + ',';
    });
    $('input[name=ceCourses]').val(allCourses);
    $(this).submit();
  });

  // BOTON DE TABLA DE CURSOS CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
  $('.tbl-courses-newContractor').on('click', '.btn-deleteCourse-newContractor', function() {
    $(this).parents('tr').remove();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO SELEceIONADO EN EL MODAL DE NUEVA INFORMACION
  $('select[name=ceDeparment_id]').on('change', function(e) {
    let deparmentSelected = e.target.value;
    $('select[name=ceMunicipality_id]').empty();
    $('select[name=ceMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=ceZoning_id]').empty();
    $('select[name=ceZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=ceNeighborhood_id]').empty();
    $('select[name=ceNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=ceCode]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        let count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=ceMunicipality_id]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELEceIONADA EN EL MODAL DE NUEVA INFORMACION
  $('select[name=ceMunicipality_id]').on('change', function(e) {
    let municipalitySelected = e.target.value;
    $('select[name=ceZoning_id]').empty();
    $('select[name=ceZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=ceNeighborhood_id]').empty();
    $('select[name=ceNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=ceCode]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        let count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=ceZoning_id]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELEceIONADA EN EL MODAL DE NUEVA INFORMACION
  $('select[name=ceZoning_id]').on('change', function(e) {
    let zoneSelected = e.target.value;
    $('select[name=ceNeighborhood_id]').empty();
    $('select[name=ceNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=ceCode]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        let count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=ceNeighborhood_id]').append(
              "<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" +
              objectNeighborhood[i]['neName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELEceIONADA EN EL MODAL DE NUEVA INFORMACION
  $('select[name=ceNeighborhood_id]').on('change', function(e) {
    let neSelected = e.target.value;
    $('input[name=ceCode]').val('');
    if (neSelected != '') {
      let text = $('select[name=ceNeighborhood_id] option:selected').attr('data-code');
      $('input[name=ceCode]').val(text);
    }
  });

  /*=================================================================================
  	/ Edición de contratistas \
  =================================================================================*/

  $('.editContractor-link').on('click', function(e) {
    e.preventDefault();

    let cePhoto = $(this).find('img:first').attr('src');
    let ceFirm = $(this).find('img:last').attr('src');
    let ceId = $(this).find('span:nth-child(2)').text();
    let ceNames = $(this).find('span:nth-child(3)').text();
    let cePersonal_id = $(this).find('span:nth-child(4)').text();
    let ceNumberdocument = $(this).find('span:nth-child(5)').text();
    let ceDriving_id = $(this).find('span:nth-child(6)').text();
    let ceNumberdriving = $(this).find('span:nth-child(7)').text();
    let depId = $(this).find('span:nth-child(8)').text();
    let munId = $(this).find('span:nth-child(9)').text();
    let zonId = $(this).find('span:nth-child(10)').text();
    let neId = $(this).find('span:nth-child(11)').text();
    let ceAddress = $(this).find('span:nth-child(12)').text();
    let ceBloodtype = $(this).find('span:nth-child(13)').text();
    let ceHealths_id = $(this).find('span:nth-child(14)').text();
    let ceRisk_id = $(this).find('span:nth-child(15)').text();
    let cePension_id = $(this).find('span:nth-child(16)').text();
    let ceLayoff_id = $(this).find('span:nth-child(17)').text();
    let ceCompensation_id = $(this).find('span:nth-child(18)').text();
    let ceEmail = $(this).find('span:nth-child(19)').text();
    let ceMovil = $(this).find('span:nth-child(20)').text();
    let ceWhatsapp = $(this).find('span:nth-child(21)').text();
    let ceCourses = $(this).find('span:nth-child(22)').text();
    let colRef1 = $(this).find('span:nth-child(23)').text();
    let cedRef1 = $(this).find('span:nth-child(24)').text();
    let numRef1 = $(this).find('span:nth-child(25)').text();
    let colRef2 = $(this).find('span:nth-child(26)').text();
    let cedRef2 = $(this).find('span:nth-child(27)').text();
    let numRef2 = $(this).find('span:nth-child(28)').text();
    let rsRef1 = $(this).find('span:nth-child(29)').text();
    let nitRef1 = $(this).find('span:nth-child(30)').text();
    let addRef1 = $(this).find('span:nth-child(31)').text();
    let phoRef1 = $(this).find('span:nth-child(32)').text();
    let ciuRef1 = $(this).find('span:nth-child(33)').text();
    let rsRef2 = $(this).find('span:nth-child(34)').text();
    let nitRef2 = $(this).find('span:nth-child(35)').text();
    let addRef2 = $(this).find('span:nth-child(36)').text();
    let phoRef2 = $(this).find('span:nth-child(37)').text();
    let ciuRef2 = $(this).find('span:nth-child(38)').text();
    let titlePrimary = $(this).find('span:nth-child(39)').text();
    let acaPrimary = $(this).find('span:nth-child(40)').text();
    let dePrimary = $(this).find('span:nth-child(41)').text();
    let iniPrimary = $(this).find('span:nth-child(42)').text();
    let finPrimary = $(this).find('span:nth-child(43)').text();
    let titleSecondary = $(this).find('span:nth-child(44)').text();
    let acaSecondary = $(this).find('span:nth-child(45)').text();
    let deSecondary = $(this).find('span:nth-child(46)').text();
    let iniSecondary = $(this).find('span:nth-child(47)').text();
    let finSecondary = $(this).find('span:nth-child(48)').text();
    let academics = $(this).find('span:nth-child(49)').text();
    let titles = $(this).find('span:nth-child(50)').text();
    let initials = $(this).find('span:nth-child(51)').text();
    let finals = $(this).find('span:nth-child(52)').text();


    $('input[name=ceId_Edit]').val(ceId);

    $('.cePhotonow_Edit').attr("src", cePhoto);
    $('.ceFirmnow_Edit').attr("src", ceFirm);
    let findFirmDefault = ceFirm.indexOf('firmContractorEspecialDefault.png');
    if (findFirmDefault > -1) {
      $('.ceFirmnot_Edit').css("display", "none");
    } else {
      $('.ceFirmnot_Edit').css("display", "block");
    }
    let findPhotoDefault = cePhoto.indexOf('photoContractorEspecialDefault.png');
    if (findPhotoDefault > -1) {
      $('.cePhotonot_Edit').css("display", "none");
    } else {
      $('.cePhotonot_Edit').css("display", "block");
    }
    $('input[name=ceNames_Edit]').val(ceNames);
    $('select[name=cePersonal_id_Edit]').val(cePersonal_id);
    $('input[name=ceNumberdocument_Edit]').val(ceNumberdocument);
    $('select[name=ceDriving_id_Edit]').val(ceDriving_id);
    $('input[name=ceNumberdriving_Edit]').val(ceNumberdriving);
    $('select[name=ceDeparment_id_Edit]').val(depId);

    $('select[name=ceMunicipality_id_Edit]').empty();
    $('select[name=ceMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $.get("{{ route('getMunicipalities') }}", {
      depId: depId
    }, function(objectMunicipalities) {
      let count = Object.keys(objectMunicipalities).length;
      if (count > 0) {
        for (let i = 0; i < count; i++) {
          if (objectMunicipalities[i]['munId'] == munId) {
            $('select[name=ceMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "' selected>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          } else {
            $('select[name=ceMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      }
    });

    $('select[name=ceZoning_id_Edit]').empty();
    $('select[name=ceZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $.get("{{ route('getZonings') }}", {
      munId: munId
    }, function(objectZonings) {
      let count = Object.keys(objectZonings).length;
      if (count > 0) {
        for (let i = 0; i < count; i++) {
          if (objectZonings[i]['zonId'] == zonId) {
            $('select[name=ceZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "' selected>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          } else {
            $('select[name=ceZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      }
    });

    $('select[name=ceNeighborhood_id_Edit]').empty();
    $('select[name=ceNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $.get("{{ route('getNeighborhoods') }}", {
      zonId: zonId
    }, function(objectNeighborhoods) {
      let count = Object.keys(objectNeighborhoods).length;
      if (count > 0) {
        for (let i = 0; i < count; i++) {
          if (objectNeighborhoods[i]['neId'] == neId) {
            $('input[name=ceCode_Edit]').val(objectNeighborhoods[i]['neCode']);
            $('select[name=ceNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "' selected>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          } else {
            $('select[name=ceNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "'>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          }
        }
      }
    });

    $('input[name=ceAddress_Edit]').val(ceAddress);
    $('select[name=ceBloodtype_Edit]').val(ceBloodtype);
    $('select[name=ceHealths_id_Edit]').val(ceHealths_id);
    $('select[name=ceRisk_id_Edit]').val(ceRisk_id);
    $('select[name=cePension_id_Edit]').val(cePension_id);
    $('select[name=ceLayoff_id_Edit]').val(ceLayoff_id);
    $('select[name=ceCompensation_id_Edit]').val(ceCompensation_id);
    $('input[name=ceEmail_Edit]').val(ceEmail);
    $('input[name=ceMovil_Edit]').val(ceMovil);
    $('input[name=ceWhatsapp_Edit]').val(ceWhatsapp);
    $('input[name=colRef1_Edit]').val(colRef1);
    $('input[name=cedRef1_Edit]').val(cedRef1);
    $('input[name=numRef1_Edit]').val(numRef1);
    $('input[name=colRef2_Edit]').val(colRef2);
    $('input[name=cedRef2_Edit]').val(cedRef2);
    $('input[name=numRef2_Edit]').val(numRef2);
    $('input[name=rsRef1_Edit]').val(rsRef1);
    $('input[name=nitRef1_Edit]').val(nitRef1);
    $('input[name=addRef1_Edit]').val(addRef1);
    $('input[name=phoRef1_Edit]').val(phoRef1);
    $('input[name=ciuRef1_Edit]').val(ciuRef1);
    $('input[name=rsRef2_Edit]').val(rsRef2);
    $('input[name=nitRef2_Edit]').val(nitRef2);
    $('input[name=addRef2_Edit]').val(addRef2);
    $('input[name=phoRef2_Edit]').val(phoRef2);
    $('input[name=ciuRef2_Edit]').val(ciuRef2);
    $('input[name=titlePrimary_Edit]').val(titlePrimary);
    $('input[name=acaPrimary_Edit]').val(acaPrimary);
    $('input[name=dePrimary_Edit]').val(dePrimary);
    $('input[name=iniPrimary_Edit]').val(iniPrimary);
    $('input[name=finPrimary_Edit]').val(finPrimary);
    $('input[name=titleSecondary_Edit]').val(titleSecondary);
    $('input[name=acaSecondary_Edit]').val(acaSecondary);
    $('input[name=deSecondary_Edit]').val(deSecondary);
    $('input[name=iniSecondary_Edit]').val(iniSecondary);
    $('input[name=finSecondary_Edit]').val(finSecondary);
    $('.tbl-courses-editContractor').find('tbody').empty();
    $.get("{{ route('getCourses') }}", {
      ids: ceCourses
    }, function(objectCourses) {
      let count = Object.keys(objectCourses).length;
      if (count > 0) {
        for (let i = 0; i < count; i++) {
          $('.tbl-courses-editContractor').find('tbody').append(
            "<tr class='" + objectCourses[i][0] + "' data-idCourse='" + objectCourses[i][0] + "'>" +
            "<td>" + objectCourses[i][1] + "</td>" +
            "<td>" + objectCourses[i][2] + "</td>" +
            "<td><input type='date' class='inputDatecourse-editContractor form-control form-control-sm text-center datepicker' value='" + objectCourses[i][3] + "' required></td>" +
            "<td>" +
            "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteCourse-editContractor'><i class='fas fa-trash-alt'></i></button>" +
            "</td>" +
            "</tr>"
          );
        }
      }
    });

    if (academics.length != 0 & titles.length != 0 & initials.length != 0 & finals.length != 0) {
      let academic = JSON.parse(academics);
      let title = JSON.parse(titles);
      let initial = JSON.parse(initials);
      let final = JSON.parse(finals);

      for (const key in academic) {
        $('.Others_Edit').prepend(`
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

    $('#editContractor-modal').modal();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO SELEceIONADO EN EL MODAL DE EDICION DE INFORMACION
  $('select[name=ceDeparment_id_Edit]').on('change', function(e) {
    let deparmentSelected = e.target.value;
    $('select[name=ceMunicipality_id_Edit]').empty();
    $('select[name=ceMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=ceZoning_id_Edit]').empty();
    $('select[name=ceZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=ceNeighborhood_id_Edit]').empty();
    $('select[name=ceNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=ceCode_Edit]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        let count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=ceMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELEceIONADA EN EL MODAL DE EDICION DE INFORMACION
  $('select[name=ceMunicipality_id_Edit]').on('change', function(e) {
    let municipalitySelected = e.target.value;
    $('select[name=ceZoning_id_Edit]').empty();
    $('select[name=ceZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=ceNeighborhood_id_Edit]').empty();
    $('select[name=ceNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=ceCode_Edit]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        let count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=ceZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELEceIONADA EN EL MODAL DE EDICION DE INFORMACION
  $('select[name=ceZoning_id_Edit]').on('change', function(e) {
    let zoneSelected = e.target.value;
    $('select[name=ceNeighborhood_id_Edit]').empty();
    $('select[name=ceNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=ceCode_Edit]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        let count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (let i = 0; i < count; i++) {
            $('select[name=ceNeighborhood_id_Edit]').append(
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
  $('select[name=ceNeighborhood_id_Edit]').on('change', function(e) {
    let neSelected = e.target.value;
    $('input[name=ceCode_Edit]').val('');
    if (neSelected != '') {
      let text = $('select[name=ceNeighborhood_id_Edit] option:selected').attr('data-code');
      $('input[name=ceCode_Edit]').val(text);
    }
  });

  // BOTON PARA AGREGAR CURSOS CERTIFICADOS A EL CONTRATISTA A EDITAR
  $('.btn-addCourse-editContractor').on('click', function() {
    let couId = $('select[name=ceCourse_id_Edit]').val();
    let couName = $('select[name=ceCourse_id_Edit] option:selected').text();
    let couIntensity = $('select[name=ceCourse_id_Edit] option:selected').attr('data-couIntensity');
    let validateRepet = false;
    $('.tbl-courses-editContractor').find('tbody').find('tr').each(function() {
      let idCou = $(this).attr('class');
      if (idCou == couId) {
        validateRepet = true;
      }
    });
    if (couId != '') {
      if (validateRepet == false) {
        $('.tbl-courses-editContractor').find('tbody').append(
          "<tr class='" + couId + "' data-idCourse='" + couId + "'>" +
          "<td>" + couName + "</td>" +
          "<td>" + couIntensity + "</td>" +
          "<td><input type='date' class='inputDatecourse-editContractor form-control form-control-sm text-center datepicker' required></td>" +
          "<td>" +
          "<button type='button' class='btn btn-outline-tertiary form-control-sm btn-deleteCourse-editContractor'><i class='fas fa-trash-alt'></i></button>" +
          "</td>" +
          "</tr>"
        );
      } else {
        $('.infoRepeat_Edit').css('display', 'block');
        $('.infoRepeat_Edit').text('Curso certificado repetido');
        setTimeout(function() {
          $('.infoRepeat_Edit').css('display', 'none');
          $('.infoRepeat_Edit').text('');
        }, 3000);
      }
    } else {
      $('.infoRepeat_Edit').css('display', 'block');
      $('.infoRepeat_Edit').text('Seleccione un curso');
      setTimeout(function() {
        $('.infoRepeat_Edit').css('display', 'none');
        $('.infoRepeat_Edit').text('');
      }, 3000);
    }
  });

  // EVENTO PARA CLICK EN MODAL, GUARDAR EL CONTRATISTA A EDITAR
  $('.btn-updateDefinitive').on('click', function(e) {
    // e.preventDefault();
    let allCourses = '';
    $('input[name=ceCourses_Edit]').val('');
    $('.tbl-courses-editContractor').find('tbody').find('tr').each(function() {
      let idCourse = $(this).attr('data-idCourse');
      let dateCourse = $(this).find('input[type=date]').val();
      allCourses += idCourse + '>' + dateCourse + ',';
    });
    $('input[name=ceCourses_Edit]').val(allCourses);
    $(this).submit();
  });

  // BOTON DE TABLA DE CURSOS CERTIFICADOS PARA ELIMINAR FILA CLIKEADA
  $('.tbl-courses-editContractor').on('click', '.btn-deleteCourse-editContractor', function() {
    $(this).parents('tr').remove();
  });

  /*=================================================================================
  	/ Eliminación de contratistas \
  =================================================================================*/

  $('.deleteContractor-link').on('click', function(e) {
    e.preventDefault();
    let cePhoto = $(this).find('img:first').attr('src');
    let ceFirm = $(this).find('img:last').attr('src');
    let ceId = $(this).find('span:nth-child(2)').text();
    let ceNames = $(this).find('span:nth-child(3)').text();
    let perName = $(this).find('span:nth-child(4)').text();
    let ceNumberdocument = $(this).find('span:nth-child(5)').text();
    let driCategory = $(this).find('span:nth-child(6)').text();
    let ceNumberdriving = $(this).find('span:nth-child(7)').text();
    let depName = $(this).find('span:nth-child(8)').text();
    let munName = $(this).find('span:nth-child(9)').text();
    let zonName = $(this).find('span:nth-child(10)').text();
    let neName = $(this).find('span:nth-child(11)').text();
    let neCode = $(this).find('span:nth-child(12)').text();
    let ceAddress = $(this).find('span:nth-child(13)').text();
    let ceBloodtype = $(this).find('span:nth-child(14)').text();
    let heaName = $(this).find('span:nth-child(15)').text();
    let risName = $(this).find('span:nth-child(16)').text();
    let penName = $(this).find('span:nth-child(17)').text();
    let layName = $(this).find('span:nth-child(18)').text();
    let comName = $(this).find('span:nth-child(19)').text();
    let ceEmail = $(this).find('span:nth-child(20)').text();
    let ceMovil = $(this).find('span:nth-child(21)').text();
    let ceWhatsapp = $(this).find('span:nth-child(22)').text();
    let ceCourses = $(this).find('span:nth-child(23)').text();

    $('input[name=ceId_Delete]').val(ceId);
    $('.ceNames_Delete').text(ceNames);
    $('.cePersonal_id_Delete').text(perName);
    $('.ceNumberdocument_Delete').text(ceNumberdocument);
    $('.ceDriving_id_Delete').text(driCategory);
    $('.ceNumberdriving_Delete').text(ceNumberdriving);
    $('.cePhotonow_Delete').attr('src', cePhoto)
    $('.ceFirmnow_Delete').attr('src', ceFirm)
    $('.ceDeparment_id_Delete').text(depName);
    $('.ceMunicipality_id_Delete').text(munName);
    $('.ceZoning_id_Delete').text(zonName);
    $('.ceNeighborhood_id_Delete').text(neName);
    $('.ceCode_Delete').text(neCode);
    $('.ceAddress_Delete').text(ceAddress);
    $('.ceEmail_Delete').text(ceEmail);
    $('.ceMovil_Delete').text(ceMovil);
    $('.ceWhatsapp_Delete').text(ceWhatsapp);
    $('.ceBloodtype_Delete').text(ceBloodtype);
    $('.ceHealths_id_Delete').text(heaName);
    $('.ceRisk_id_Delete').text(risName);
    $('.cePension_id_Delete').text(penName);
    $('.ceLayoff_id_Delete').text(layName);
    $('.ceCompensation_id_Delete').text(comName);
    $('.ceCourses_Delete').empty();
    $.get("{{ route('getCourses') }}", {
      ids: ceCourses
    }, function(objectCourses) {
      let count = Object.keys(objectCourses).length;
      if (count > 0) {
        for (let i = 0; i < count; i++) {
          $('.ceCourses_Delete').append(
            "<li class='list-group-item d-flex justify-content-between align-items-center'>" +
            objectCourses[i][1] + ' -> ' + objectCourses[i][2] +
            "<span class='badge badge-primary badge-pill'>" +
            objectCourses[i][3] +
            "</span>" +
            "</li>"
          );
        }
      }
    });
    $('#deleteContractor-modal').modal();
  });
</script>
@endsection