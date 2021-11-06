@extends('modules.administrativeAllies')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>SERVICIOS ESPECIALES ALIADOS</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar servicio especial aliado" class="btn btn-outline-success form-control-sm newEspecial-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessEspecials'))
      <div class="alert alert-success">
        {{ session('SuccessEspecials') }}
      </div>
      @endif
      @if(session('PrimaryEspecials'))
      <div class="alert alert-primary">
        {{ session('PrimaryEspecials') }}
      </div>
      @endif
      @if(session('WarningEspecials'))
      <div class="alert alert-warning">
        {{ session('WarningEspecials') }}
      </div>
      @endif
      @if(session('SecondaryEspecials'))
      <div class="alert alert-secondary">
        {{ session('SecondaryEspecials') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>RAZON SOCIAL</th>
        <th>N° DE IDENTIFICACION</th>
        <th>REPRESENTANTE LEGAL</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($alliesespecials as $especial)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $especial->aeReasonsocial }}</td>
        <td>{{ $especial->aeNumberdocument }}</td>
        <td>{{ $especial->aeRepresentativename }}</td>
        <td>
          <a href="#" title="Editar servicio especial aliado" class="btn btn-outline-primary rounded-circle form-control-sm editEspecial-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $especial->aeId }}</span>
            <span hidden>{{ $especial->aeReasonsocial }}</span>
            <span hidden>{{ $especial->aePersonal_id }}</span>
            <span hidden>{{ $especial->aeNumberdocument }}</span>
            <span hidden>{{ $especial->aeNumberregistration }}</span>
            <span hidden>{{ $especial->aeDateregistration }}</span>
            <span hidden>{{ $especial->aeCommerce }}</span>
            <span hidden>{{ $especial->depId }}</span>
            <span hidden>{{ $especial->munId }}</span>
            <span hidden>{{ $especial->zonId }}</span>
            <span hidden>{{ $especial->aeNeighborhood_id }}</span>
            <span hidden>{{ $especial->aeAddress }}</span>
            <span hidden>{{ $especial->aeEmail }}</span>
            <span hidden>{{ $especial->aePhone }}</span>
            <span hidden>{{ $especial->aeMovil }}</span>
            <span hidden>{{ $especial->aeWhatsapp }}</span>
            <span hidden>{{ $especial->aeRepresentativename }}</span>
            <span hidden>{{ $especial->aeRepresentativepersonal_id }}</span>
            <span hidden>{{ $especial->aeRepresentativenumberdocument }}</span>
            <span hidden>{{ $especial->aeBank }}</span>
            <span hidden>{{ $especial->aeTypeaccount }}</span>
            <span hidden>{{ $especial->aeAccountnumber }}</span>
            <span hidden>{{ $especial->aeRegime }}</span>
            <span hidden>{{ $especial->aeTaxpayer }}</span>
            <span hidden>{{ $especial->aeAutoretainer }}</span>
            <span hidden>{{ $especial->aeActivitys }}</span>
          </a>
          <a href="#" title="Eliminar servicio especial aliado" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteEspecial-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $especial->aeId }}</span>
            <span hidden>{{ $especial->aeReasonsocial }}</span>
            <span hidden>{{ $especial->perName }}</span>
            <span hidden>{{ $especial->aeNumberdocument }}</span>
            <span hidden>{{ $especial->aeNumberregistration }}</span>
            <span hidden>{{ $especial->aeDateregistration }}</span>
            <span hidden>{{ $especial->aeCommerce }}</span>
            <span hidden>{{ $especial->depName }}</span>
            <span hidden>{{ $especial->munName }}</span>
            <span hidden>{{ $especial->zonName }}</span>
            <span hidden>{{ $especial->neName }}</span>
            <span hidden>{{ $especial->neCode }}</span>
            <span hidden>{{ $especial->aeAddress }}</span>
            <span hidden>{{ $especial->aeEmail }}</span>
            <span hidden>{{ $especial->aePhone }}</span>
            <span hidden>{{ $especial->aeMovil }}</span>
            <span hidden>{{ $especial->aeWhatsapp }}</span>
            <span hidden>{{ $especial->aeRepresentativename }}</span>
            <span hidden>{{ $especial->aeRepresentativenumberdocument }}</span>
            <span hidden>{{ $especial->aeBank }}</span>
            <span hidden>{{ $especial->aeTypeaccount }}</span>
            <span hidden>{{ $especial->aeAccountnumber }}</span>
            <span hidden>{{ $especial->aeRegime }}</span>
            <span hidden>{{ $especial->aeTaxpayer }}</span>
            <span hidden>{{ $especial->aeAutoretainer }}</span>
            <span hidden>{{ $especial->aeActivitys }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newEspecial-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO SERVICIO ESPECIAL ALIADO:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('allies.services.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">RAZON SOCIAL:</small>
                    <input type="text" name="aeReasonsocial" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de proveedor" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION:</small>
                    <select name="aePersonal_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione tipo de identificación ...</option>
                      @foreach($personals as $personal)
                      <option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                    <input type="text" name="aeNumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE MATRICULA:</small>
                    <input type="text" name="aeNumberregistration" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE MATRICULA:</small>
                    <input type="text" name="aeDateregistration" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAMARA DE COMERCIO:</small>
                    <input type="text" name="aeCommerce" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">DEPARTAMENTO:</small>
                        <select name="aeDepartment_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione departamento ...</option>
                          @foreach($departments as $department)
                          <option value="{{ $department->depId }}">{{ $department->depName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">CIUDAD/MUNICIPIO:</small>
                        <select name="aeMunicipality_id" class="form-control form-control-sm" required>
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
                        <select name="aeZoning_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione localidad/zona ...</option>
                          <!-- zonId - zonName - zonMunicipality_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">BARRIO:</small>
                        <select name="aeNeighborhood_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione barrio ...</option>
                          <!-- neId - neName - neZoning_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">CODIGO POSTAL:</small>
                        <input type="text" name="aeCode" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION:</small>
                    <input type="text" name="aeAddress" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CORREO ELECTRONICO:</small>
                        <input type="email" name="aeEmail" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO FIJO:</small>
                        <input type="text" name="aePhone" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO CELULAR:</small>
                        <input type="text" name="aeMovil" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">LINEA WHATSAPP:</small>
                        <input type="text" name="aeWhatsapp" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">REPRESENTANTE LEGAL:</small>
                    <input type="text" name="aeRepresentativename" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
                    <select name="aeRepresentativepersonal_id" class="form-control form-control-sm" required>
                      <option value="">Seleccione identificación ...</option>
                      @foreach($personals as $personal)
                      <option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO DE REPRESENTANTE:</small>
                    <input type="text" name="aeRepresentativenumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
                  </div>
                </div>
              </div>
              <div class="row pt-4">
                <div class="col-md-12">
                  <small>INFORMACION JURIDICA/FINANCIERA DE PROVEEDOR</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">ENTIDAD BANCARIA:</small>
                        <input type="text" name="aeBank" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de banco" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TIPO DE CUENTA:</small>
                        <select name="aeTypeaccount" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="CORRIENTE">CORRIENTE</option>
                          <option value="AHORROS">AHORROS</option>
                          <option value="RECAUDO">RECAUDO</option>
                          <option value="FIDUCIA">FIDUCIA</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">NUMERO DE CUENTA:</small>
                        <input type="text" name="aeAccountnumber" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">REGIMEN IVA:</small>
                        <select name="aeRegime" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="COMUN">COMUN</option>
                          <option value="SIMPLIFICADO">SIMPLIFICADO</option>
                          <option value="ESPECIAL">ESPECIAL</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">¿CONTRIBUYESTES?:</small>
                        <select name="aeTaxpayer" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">¿AUTORETENEDORES?:</small>
                        <select name="aeAutoretainer" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <small>ACTIVIDADES ECONOMICAS DE PROVEEDOR:</small>
                      <hr>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="aeActivitys_one" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="aeActivitys_two" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="aeActivitys_three" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="aeActivitys_four" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-success form-control-sm">REGISTRAR SERVICIO ESPECIAL ALIADO</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editEspecial-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR SERVICIO ESPECIAL ALIADO:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('allies.services.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">RAZON SOCIAL:</small>
                    <input type="text" name="aeReasonsocial_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de proveedor" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION:</small>
                    <select name="aePersonal_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione tipo de identificación ...</option>
                      @foreach($personals as $personal)
                      <option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO:</small>
                    <input type="text" name="aeNumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE MATRICULA:</small>
                    <input type="text" name="aeNumberregistration_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE MATRICULA:</small>
                    <input type="text" name="aeDateregistration_Edit" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAMARA DE COMERCIO:</small>
                    <input type="text" name="aeCommerce_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">DEPARTAMENTO:</small>
                        <select name="aeDepartment_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione departamento ...</option>
                          @foreach($departments as $department)
                          <option value="{{ $department->depId }}">{{ $department->depName }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">CIUDAD/MUNICIPIO:</small>
                        <select name="aeMunicipality_id_Edit" class="form-control form-control-sm" required>
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
                        <select name="aeZoning_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione localidad/zona ...</option>
                          <!-- zonId - zonName - zonMunicipality_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">BARRIO:</small>
                        <select name="aeNeighborhood_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione barrio ...</option>
                          <!-- neId - neName - neZoning_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">CODIGO POSTAL:</small>
                        <input type="text" name="aeCode_Edit" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION:</small>
                    <input type="text" name="aeAddress_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CORREO ELECTRONICO:</small>
                        <input type="email" name="aeEmail_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO FIJO:</small>
                        <input type="text" name="aePhone_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO CELULAR:</small>
                        <input type="text" name="aeMovil_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">LINEA WHATSAPP:</small>
                        <input type="text" name="aeWhatsapp_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">REPRESENTANTE LEGAL:</small>
                    <input type="text" name="aeRepresentativename_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
                    <select name="aeRepresentativepersonal_id_Edit" class="form-control form-control-sm" required>
                      <option value="">Seleccione identificación ...</option>
                      @foreach($personals as $personal)
                      <option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE DOCUMENTO DE REPRESENTANTE:</small>
                    <input type="text" name="aeRepresentativenumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
                  </div>
                </div>
              </div>
              <div class="row pt-4">
                <div class="col-md-12">
                  <small>INFORMACION JURIDICA/FINANCIERA DE PROVEEDOR</small>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">ENTIDAD BANCARIA:</small>
                        <input type="text" name="aeBank_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de banco" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TIPO DE CUENTA:</small>
                        <select name="aeTypeaccount_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="CORRIENTE">CORRIENTE</option>
                          <option value="AHORROS">AHORROS</option>
                          <option value="RECAUDO">RECAUDO</option>
                          <option value="FIDUCIA">FIDUCIA</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">NUMERO DE CUENTA:</small>
                        <input type="text" name="aeAccountnumber_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">REGIMEN IVA:</small>
                        <select name="aeRegime_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="COMUN">COMUN</option>
                          <option value="SIMPLIFICADO">SIMPLIFICADO</option>
                          <option value="ESPECIAL">ESPECIAL</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">¿CONTRIBUYESTES?:</small>
                        <select name="aeTaxpayer_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">¿AUTORETENEDORES?:</small>
                        <select name="aeAutoretainer_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <small>ACTIVIDADES ECONOMICAS DE PROVEEDOR:</small>
                      <hr>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="aeActivitys_one_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="aeActivitys_two_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="aeActivitys_three_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="aeActivitys_four_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
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
              <input type="hidden" class="form-control form-control-sm" name="aeId_Edit" value="" required>
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

<div class="modal fade" id="deleteEspecial-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION/DETALLES DE SERVICIO ESPECIAL ALIADO:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <small class="text-muted">RAZON SOCIAL: </small><br>
            <span class="text-muted"><b class="aeReasonsocial_Delete"></b></span><br>
            <small class="text-muted">DOCUMENTO: </small><br>
            <span class="text-muted"><b class="aeNumberdocument_Delete"></b></span><br>
            <small class="text-muted">DEPARTAMENTO/MUNICIPIO: </small><br>
            <span class="text-muted"><b class="depName_Delete"></b>/<b class="munName_Delete"></b></span><br>
            <small class="text-muted">ZONA/BARRIO/CODIGO POSTAL: </small><br>
            <span class="text-muted"><b class="zonName_Delete"></b>/<b class="neName_Delete"></b>/<b class="neCode_Delete"></b></span><br>
            <small class="text-muted">DIRECCION: </small><br>
            <span class="text-muted"><b class="aeAddress_Delete"></b></span><br>
            <small class="text-muted">CORREO ELECTRONICO: </small><br>
            <span class="text-muted"><b class="aeEmail_Delete"></b></span><br>
            <small class="text-muted">TELEFONO: </small><br>
            <span class="text-muted"><b class="aePhone_Delete"></b></span><br>
            <small class="text-muted">CELULAR: </small><br>
            <span class="text-muted"><b class="aeMovil_Delete"></b></span><br>
            <small class="text-muted">WHATSAPP: </small><br>
            <span class="text-muted"><b class="aeWhatsapp_Delete"></b></span><br>
          </div>
          <div class="col-md-6">
            <small class="text-muted">FECHA/NUMERO DE MATRICULA: </small><br>
            <span class="text-muted"><b class="aeDateregistration_Delete"></b>/<b class="aeNumberregistration_Delete"></b></span><br>
            <small class="text-muted">CAMARA DE COMERCIO: </small><br>
            <span class="text-muted"><b class="aeCommerce_Delete"></b></span><br>
            <small class="text-muted">REPRESENTANTE LEGAL: </small><br>
            <span class="text-muted"><b class="aeRepresentativename_Delete"></b></span><br>
            <small class="text-muted">DOCUMENTO DE REPRESENTANTE LEGAL: </small><br>
            <span class="text-muted"><b class="aeRepresentativenumberdocument_Delete"></b></span><br>
            <small class="text-muted">ENTIDAD BANCARIA: </small><br>
            <span class="text-muted"><b class="aeBank_Delete"></b></span><br>
            <small class="text-muted">TIPO Y NUMERO DE CUENTA: </small><br>
            <span class="text-muted"><b class="aeTypeaccount_Delete"></b>/<b class="aeAccountnumber_Delete"></b></span><br>
            <small class="text-muted">REGIMEN: </small><br>
            <span class="text-muted"><b class="aeRegime_Delete"></b></span><br>
            <small class="text-muted">GRANDES CONTRIBUYESTES: </small><br>
            <span class="text-muted"><b class="aeTaxpayer_Delete"></b></span><br>
            <small class="text-muted">AUTORETENEDORES: </small><br>
            <span class="text-muted"><b class="aeAutoretainer_Delete"></b></span><br>
            <small class="text-muted">ACTIVIDADES ECONOMICAS: </small><br>
            <span class="text-muted"><b class="aeActivitys_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('allies.services.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="aeId_Delete" value="" required>
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

  $('.newEspecial-link').on('click', function() {
    $('#newEspecial-modal').modal();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO
  $('select[name=aeDepartment_id]').on('change', function(e) {
    var deparmentSelected = e.target.value;
    $('select[name=aeMunicipality_id]').empty();
    $('select[name=aeMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=aeZoning_id]').empty();
    $('select[name=aeZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=aeNeighborhood_id]').empty();
    $('select[name=aeNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=aeCode]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        var count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=aeMunicipality_id]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELECCIONADA
  $('select[name=aeMunicipality_id]').on('change', function(e) {
    var municipalitySelected = e.target.value;
    $('select[name=aeZoning_id]').empty();
    $('select[name=aeZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=aeNeighborhood_id]').empty();
    $('select[name=aeNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=aeCode]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        var count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=aeZoning_id]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELEceIONADA
  $('select[name=aeZoning_id]').on('change', function(e) {
    var zoneSelected = e.target.value;
    $('select[name=aeNeighborhood_id]').empty();
    $('select[name=aeNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=aeCode]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        var count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=aeNeighborhood_id]').append(
              "<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" +
              objectNeighborhood[i]['neName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELEceIONADA
  $('select[name=aeNeighborhood_id]').on('change', function(e) {
    var neSelected = e.target.value;
    $('input[name=aeCode]').val('');
    if (neSelected != '') {
      var text = $('select[name=aeNeighborhood_id] option:selected').attr('data-code');
      $('input[name=aeCode]').val(text);
    }
  });

  $('.editEspecial-link').on('click', function(e) {
    e.preventDefault();
    var aeId = $(this).find('span:nth-child(2)').text();
    var aeReasonsocial = $(this).find('span:nth-child(3)').text();
    var aePersonal_id = $(this).find('span:nth-child(4)').text();
    var aeNumberdocument = $(this).find('span:nth-child(5)').text();
    var aeNumberregistration = $(this).find('span:nth-child(6)').text();
    var aeDateregistration = $(this).find('span:nth-child(7)').text();
    var aeCommerce = $(this).find('span:nth-child(8)').text();
    var aeDepartment_id = $(this).find('span:nth-child(9)').text();
    var aeMunicipality_id = $(this).find('span:nth-child(10)').text();
    var aeZoning_id = $(this).find('span:nth-child(11)').text();
    var aeNeighborhood_id = $(this).find('span:nth-child(12)').text();
    var aeAddress = $(this).find('span:nth-child(13)').text();
    var aeEmail = $(this).find('span:nth-child(14)').text();
    var aePhone = $(this).find('span:nth-child(15)').text();
    var aeMovil = $(this).find('span:nth-child(16)').text();
    var aeWhatsapp = $(this).find('span:nth-child(17)').text();
    var aeRepresentativename = $(this).find('span:nth-child(18)').text();
    var aeRepresentativepersonal_id = $(this).find('span:nth-child(19)').text();
    var aeRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
    var aeBank = $(this).find('span:nth-child(21)').text();
    var aeTypeaccount = $(this).find('span:nth-child(22)').text();
    var aeAccountnumber = $(this).find('span:nth-child(23)').text();
    var aeRegime = $(this).find('span:nth-child(24)').text();
    var aeTaxpayer = $(this).find('span:nth-child(25)').text();
    var aeAutoretainer = $(this).find('span:nth-child(26)').text();
    var aeActivitys = $(this).find('span:nth-child(27)').text();
    $('input[name=aeId_Edit]').val(aeId);
    $('input[name=aeReasonsocial_Edit]').val(aeReasonsocial);
    $('select[name=aePersonal_id_Edit]').val(aePersonal_id);
    $('input[name=aeNumberdocument_Edit]').val(aeNumberdocument);
    $('input[name=aeNumberregistration_Edit]').val(aeNumberregistration);
    $('input[name=aeDateregistration_Edit]').val(aeDateregistration);
    $('input[name=aeCommerce_Edit]').val(aeCommerce);
    $('select[name=aeDepartment_id_Edit]').val(aeDepartment_id);
    $('select[name=aeMunicipality_id_Edit]').empty();
    $('select[name=aeMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $.get("{{ route('getMunicipalities') }}", {
      depId: aeDepartment_id
    }, function(objectMunicipalities) {
      var count = Object.keys(objectMunicipalities).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectMunicipalities[i]['munId'] == aeMunicipality_id) {
            $('select[name=aeMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "' selected>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          } else {
            $('select[name=aeMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('select[name=aeZoning_id_Edit]').empty();
    $('select[name=aeZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $.get("{{ route('getZonings') }}", {
      munId: aeMunicipality_id
    }, function(objectZonings) {
      var count = Object.keys(objectZonings).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectZonings[i]['zonId'] == aeZoning_id) {
            $('select[name=aeZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "' selected>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          } else {
            $('select[name=aeZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('select[name=aeNeighborhood_id_Edit]').empty();
    $('select[name=aeNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $.get("{{ route('getNeighborhoods') }}", {
      zonId: aeZoning_id
    }, function(objectNeighborhoods) {
      var count = Object.keys(objectNeighborhoods).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectNeighborhoods[i]['neId'] == aeNeighborhood_id) {
            $('input[name=aeCode_Edit]').val(objectNeighborhoods[i]['neCode']);
            $('select[name=aeNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "' selected>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          } else {
            $('select[name=aeNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "'>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('input[name=aeAddress_Edit]').val(aeAddress);
    $('input[name=aeEmail_Edit]').val(aeEmail);
    $('input[name=aePhone_Edit]').val(aePhone);
    $('input[name=aeMovil_Edit]').val(aeMovil);
    $('input[name=aeWhatsapp_Edit]').val(aeWhatsapp);
    $('input[name=aeRepresentativename_Edit]').val(aeRepresentativename);
    $('select[name=aeRepresentativepersonal_id_Edit]').val(aeRepresentativepersonal_id);
    $('input[name=aeRepresentativenumberdocument_Edit]').val(aeRepresentativenumberdocument);
    $('input[name=aeBank_Edit]').val(aeBank);
    $('select[name=aeTypeaccount_Edit]').val(aeTypeaccount);
    $('input[name=aeAccountnumber_Edit]').val(aeAccountnumber);
    $('select[name=aeRegime_Edit]').val(aeRegime);
    $('select[name=aeTaxpayer_Edit]').val(aeTaxpayer);
    $('select[name=aeAutoretainer_Edit]').val(aeAutoretainer);
    var separatedActivitys = aeActivitys.split('-');
    $('input[name=aeActivitys_one_Edit]').val(separatedActivitys[0]);
    $('input[name=aeActivitys_two_Edit]').val(separatedActivitys[1]);
    $('input[name=aeActivitys_three_Edit]').val(separatedActivitys[2]);
    $('input[name=aeActivitys_four_Edit]').val(separatedActivitys[3]);
    $('#editEspecial-modal').modal();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO
  $('select[name=aeDepartment_id_Edit]').on('change', function(e) {
    var deparmentSelected = e.target.value;
    $('select[name=aeMunicipality_id_Edit]').empty();
    $('select[name=aeMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=aeZoning_id_Edit]').empty();
    $('select[name=aeZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=aeNeighborhood_id_Edit]').empty();
    $('select[name=aeNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=aeCode_Edit]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        var count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=aeMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR ZONA/LOCALIDAD POR CIUDAD SELECCIONADA
  $('select[name=aeMunicipality_id_Edit]').on('change', function(e) {
    var municipalitySelected = e.target.value;
    $('select[name=aeZoning_id_Edit]').empty();
    $('select[name=aeZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=aeNeighborhood_id_Edit]').empty();
    $('select[name=aeNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=aeCode_Edit]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        var count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=aeZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELEceIONADA
  $('select[name=aeZoning_id_Edit]').on('change', function(e) {
    var zoneSelected = e.target.value;
    $('select[name=aeNeighborhood_id_Edit]').empty();
    $('select[name=aeNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=aeCode_Edit]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        var count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=aeNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhood[i]['neId'] + "' data-code='" + objectNeighborhood[i]['neCode'] + "'>" +
              objectNeighborhood[i]['neName'] +
              "</option>"
            );
          }
        }
      });
    }
  });

  // CONSULTAR BARRIO POR ZONA SELEceIONADA
  $('select[name=aeNeighborhood_id_Edit]').on('change', function(e) {
    var neSelected = e.target.value;
    $('input[name=aeCode_Edit]').val('');
    if (neSelected != '') {
      var text = $('select[name=aeNeighborhood_id_Edit] option:selected').attr('data-code');
      $('input[name=aeCode_Edit]').val(text);
    }
  });

  $('.deleteEspecial-link').on('click', function(e) {
    e.preventDefault();
    var aeId = $(this).find('span:nth-child(2)').text();
    var aeReasonsocial = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var aeNumberdocument = $(this).find('span:nth-child(5)').text();
    var aeNumberregistration = $(this).find('span:nth-child(6)').text();
    var aeDateregistration = $(this).find('span:nth-child(7)').text();
    var aeCommerce = $(this).find('span:nth-child(8)').text();
    var depName = $(this).find('span:nth-child(9)').text();
    var munName = $(this).find('span:nth-child(10)').text();
    var zonName = $(this).find('span:nth-child(11)').text();
    var neName = $(this).find('span:nth-child(12)').text();
    var neCode = $(this).find('span:nth-child(13)').text();
    var aeAddress = $(this).find('span:nth-child(14)').text();
    var aeEmail = $(this).find('span:nth-child(15)').text();
    var aePhone = $(this).find('span:nth-child(16)').text();
    var aeMovil = $(this).find('span:nth-child(17)').text();
    var aeWhatsapp = $(this).find('span:nth-child(18)').text();
    var aeRepresentativename = $(this).find('span:nth-child(19)').text();
    var aeRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
    var aeBank = $(this).find('span:nth-child(21)').text();
    var aeTypeaccount = $(this).find('span:nth-child(22)').text();
    var aeAccountnumber = $(this).find('span:nth-child(23)').text();
    var aeRegime = $(this).find('span:nth-child(24)').text();
    var aeTaxpayer = $(this).find('span:nth-child(25)').text();
    var aeAutoretainer = $(this).find('span:nth-child(26)').text();
    var aeActivitys = $(this).find('span:nth-child(27)').text();
    $('input[name=aeId_Delete]').val(aeId);
    $('.aeReasonsocial_Delete').text(aeReasonsocial);
    $('.aeNumberdocument_Delete').text(perName + ': ' + aeNumberdocument);
    $('.aeNumberregistration_Delete').text(aeNumberregistration);
    $('.aeDateregistration_Delete').text(aeDateregistration);
    $('.aeCommerce_Delete').text(aeCommerce);
    $('.depName_Delete').text(depName);
    $('.munName_Delete').text(munName);
    $('.zonName_Delete').text(zonName);
    $('.neName_Delete').text(neName);
    $('.neCode_Delete').text(neCode);
    $('.aeAddress_Delete').text(aeAddress);
    $('.aeEmail_Delete').text(aeEmail);
    $('.aePhone_Delete').text(aePhone);
    $('.aeMovil_Delete').text(aeMovil);
    $('.aeWhatsapp_Delete').text(aeWhatsapp);
    $('.aeRepresentativename_Delete').text(aeRepresentativename);
    $('.aeRepresentativenumberdocument_Delete').text(aeRepresentativenumberdocument);
    $('.aeBank_Delete').text(aeBank);
    $('.aeTypeaccount_Delete').text(aeTypeaccount);
    $('.aeAccountnumber_Delete').text(aeAccountnumber);
    $('.aeRegime_Delete').text(aeRegime);
    $('.aeTaxpayer_Delete').text(aeTaxpayer);
    $('.aeAutoretainer_Delete').text(aeAutoretainer);
    $('.aeActivitys_Delete').text(aeActivitys);
    $('#deleteEspecial-modal').modal();
  });
</script>
@endsection