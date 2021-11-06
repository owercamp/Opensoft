@extends('modules.administrativeAllies')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>CARGA EXPRESS ALIADA</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar carga express aliada" class="btn btn-outline-success form-control-sm newCharge-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessCharges'))
      <div class="alert alert-success">
        {{ session('SuccessCharges') }}
      </div>
      @endif
      @if(session('PrimaryCharges'))
      <div class="alert alert-primary">
        {{ session('PrimaryCharges') }}
      </div>
      @endif
      @if(session('WarningCharges'))
      <div class="alert alert-warning">
        {{ session('WarningCharges') }}
      </div>
      @endif
      @if(session('SecondaryCharges'))
      <div class="alert alert-secondary">
        {{ session('SecondaryCharges') }}
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
      @foreach($alliescharges as $charge)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $charge->acReasonsocial }}</td>
        <td>{{ $charge->acNumberdocument }}</td>
        <td>{{ $charge->acRepresentativename }}</td>
        <td>
          <a href="#" title="Editar carga express aliada" class="btn btn-outline-primary rounded-circle form-control-sm editCharge-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $charge->acId }}</span>
            <span hidden>{{ $charge->acReasonsocial }}</span>
            <span hidden>{{ $charge->acPersonal_id }}</span>
            <span hidden>{{ $charge->acNumberdocument }}</span>
            <span hidden>{{ $charge->acNumberregistration }}</span>
            <span hidden>{{ $charge->acDateregistration }}</span>
            <span hidden>{{ $charge->acCommerce }}</span>
            <span hidden>{{ $charge->depId }}</span>
            <span hidden>{{ $charge->munId }}</span>
            <span hidden>{{ $charge->zonId }}</span>
            <span hidden>{{ $charge->acNeighborhood_id }}</span>
            <span hidden>{{ $charge->acAddress }}</span>
            <span hidden>{{ $charge->acEmail }}</span>
            <span hidden>{{ $charge->acPhone }}</span>
            <span hidden>{{ $charge->acMovil }}</span>
            <span hidden>{{ $charge->acWhatsapp }}</span>
            <span hidden>{{ $charge->acRepresentativename }}</span>
            <span hidden>{{ $charge->acRepresentativepersonal_id }}</span>
            <span hidden>{{ $charge->acRepresentativenumberdocument }}</span>
            <span hidden>{{ $charge->acBank }}</span>
            <span hidden>{{ $charge->acTypeaccount }}</span>
            <span hidden>{{ $charge->acAccountnumber }}</span>
            <span hidden>{{ $charge->acRegime }}</span>
            <span hidden>{{ $charge->acTaxpayer }}</span>
            <span hidden>{{ $charge->acAutoretainer }}</span>
            <span hidden>{{ $charge->acActivitys }}</span>
          </a>
          <a href="#" title="Eliminar carga express aliada" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteCharge-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $charge->acId }}</span>
            <span hidden>{{ $charge->acReasonsocial }}</span>
            <span hidden>{{ $charge->perName }}</span>
            <span hidden>{{ $charge->acNumberdocument }}</span>
            <span hidden>{{ $charge->acNumberregistration }}</span>
            <span hidden>{{ $charge->acDateregistration }}</span>
            <span hidden>{{ $charge->acCommerce }}</span>
            <span hidden>{{ $charge->depName }}</span>
            <span hidden>{{ $charge->munName }}</span>
            <span hidden>{{ $charge->zonName }}</span>
            <span hidden>{{ $charge->neName }}</span>
            <span hidden>{{ $charge->neCode }}</span>
            <span hidden>{{ $charge->acAddress }}</span>
            <span hidden>{{ $charge->acEmail }}</span>
            <span hidden>{{ $charge->acPhone }}</span>
            <span hidden>{{ $charge->acMovil }}</span>
            <span hidden>{{ $charge->acWhatsapp }}</span>
            <span hidden>{{ $charge->acRepresentativename }}</span>
            <span hidden>{{ $charge->acRepresentativenumberdocument }}</span>
            <span hidden>{{ $charge->acBank }}</span>
            <span hidden>{{ $charge->acTypeaccount }}</span>
            <span hidden>{{ $charge->acAccountnumber }}</span>
            <span hidden>{{ $charge->acRegime }}</span>
            <span hidden>{{ $charge->acTaxpayer }}</span>
            <span hidden>{{ $charge->acAutoretainer }}</span>
            <span hidden>{{ $charge->acActivitys }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newCharge-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA CARGA EXPRESS ALIADA:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('allies.express.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">RAZON SOCIAL:</small>
                    <input type="text" name="acReasonsocial" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de proveedor" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION:</small>
                    <select name="acPersonal_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="acNumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE MATRICULA:</small>
                    <input type="text" name="acNumberregistration" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE MATRICULA:</small>
                    <input type="text" name="acDateregistration" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAMARA DE COMERCIO:</small>
                    <input type="text" name="acCommerce" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">DEPARTAMENTO:</small>
                        <select name="acDepartment_id" class="form-control form-control-sm" required>
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
                        <select name="acMunicipality_id" class="form-control form-control-sm" required>
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
                        <select name="acZoning_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione localidad/zona ...</option>
                          <!-- zonId - zonName - zonMunicipality_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">BARRIO:</small>
                        <select name="acNeighborhood_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione barrio ...</option>
                          <!-- neId - neName - neZoning_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">CODIGO POSTAL:</small>
                        <input type="text" name="acCode" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION:</small>
                    <input type="text" name="acAddress" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CORREO ELECTRONICO:</small>
                        <input type="email" name="acEmail" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO FIJO:</small>
                        <input type="text" name="acPhone" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO CELULAR:</small>
                        <input type="text" name="acMovil" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">LINEA WHATSAPP:</small>
                        <input type="text" name="acWhatsapp" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">REPRESENTANTE LEGAL:</small>
                    <input type="text" name="acRepresentativename" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
                    <select name="acRepresentativepersonal_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="acRepresentativenumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
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
                        <input type="text" name="acBank" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de banco" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TIPO DE CUENTA:</small>
                        <select name="acTypeaccount" class="form-control form-control-sm" required>
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
                        <input type="text" name="acAccountnumber" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">REGIMEN IVA:</small>
                        <select name="acRegime" class="form-control form-control-sm" required>
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
                        <select name="acTaxpayer" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">¿AUTORETENEDORES?:</small>
                        <select name="acAutoretainer" class="form-control form-control-sm" required>
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
                            <input type="text" name="acActivitys_one" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="acActivitys_two" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="acActivitys_three" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="acActivitys_four" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
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
            <button type="submit" class="btn btn-outline-success form-control-sm">REGISTRAR CARGA EXPRESS ALIADA</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editCharge-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR CARGA EXPRESS ALIADA:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('allies.express.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">RAZON SOCIAL:</small>
                    <input type="text" name="acReasonsocial_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de proveedor" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION:</small>
                    <select name="acPersonal_id_Edit" class="form-control form-control-sm" required>
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
                    <input type="text" name="acNumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE MATRICULA:</small>
                    <input type="text" name="acNumberregistration_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE MATRICULA:</small>
                    <input type="text" name="acDateregistration_Edit" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAMARA DE COMERCIO:</small>
                    <input type="text" name="acCommerce_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">DEPARTAMENTO:</small>
                        <select name="acDepartment_id_Edit" class="form-control form-control-sm" required>
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
                        <select name="acMunicipality_id_Edit" class="form-control form-control-sm" required>
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
                        <select name="acZoning_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione localidad/zona ...</option>
                          <!-- zonId - zonName - zonMunicipality_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">BARRIO:</small>
                        <select name="acNeighborhood_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione barrio ...</option>
                          <!-- neId - neName - neZoning_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">CODIGO POSTAL:</small>
                        <input type="text" name="acCode_Edit" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION:</small>
                    <input type="text" name="acAddress_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CORREO ELECTRONICO:</small>
                        <input type="email" name="acEmail_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO FIJO:</small>
                        <input type="text" name="acPhone_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO CELULAR:</small>
                        <input type="text" name="acMovil_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">LINEA WHATSAPP:</small>
                        <input type="text" name="acWhatsapp_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">REPRESENTANTE LEGAL:</small>
                    <input type="text" name="acRepresentativename_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
                    <select name="acRepresentativepersonal_id_Edit" class="form-control form-control-sm" required>
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
                    <input type="text" name="acRepresentativenumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
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
                        <input type="text" name="acBank_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de banco" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TIPO DE CUENTA:</small>
                        <select name="acTypeaccount_Edit" class="form-control form-control-sm" required>
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
                        <input type="text" name="acAccountnumber_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">REGIMEN IVA:</small>
                        <select name="acRegime_Edit" class="form-control form-control-sm" required>
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
                        <select name="acTaxpayer_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">¿AUTORETENEDORES?:</small>
                        <select name="acAutoretainer_Edit" class="form-control form-control-sm" required>
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
                            <input type="text" name="acActivitys_one_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="acActivitys_two_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="acActivitys_three_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="acActivitys_four_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
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
              <input type="hidden" class="form-control form-control-sm" name="acId_Edit" value="" required>
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

<div class="modal fade" id="deleteCharge-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION/DETALLES DE CARGA EXPRESS ALIADA:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <small class="text-muted">RAZON SOCIAL: </small><br>
            <span class="text-muted"><b class="acReasonsocial_Delete"></b></span><br>
            <small class="text-muted">DOCUMENTO: </small><br>
            <span class="text-muted"><b class="acNumberdocument_Delete"></b></span><br>
            <small class="text-muted">DEPARTAMENTO/MUNICIPIO: </small><br>
            <span class="text-muted"><b class="depName_Delete"></b>/<b class="munName_Delete"></b></span><br>
            <small class="text-muted">ZONA/BARRIO/CODIGO POSTAL: </small><br>
            <span class="text-muted"><b class="zonName_Delete"></b>/<b class="neName_Delete"></b>/<b class="neCode_Delete"></b></span><br>
            <small class="text-muted">DIRECCION: </small><br>
            <span class="text-muted"><b class="acAddress_Delete"></b></span><br>
            <small class="text-muted">CORREO ELECTRONICO: </small><br>
            <span class="text-muted"><b class="acEmail_Delete"></b></span><br>
            <small class="text-muted">TELEFONO: </small><br>
            <span class="text-muted"><b class="acPhone_Delete"></b></span><br>
            <small class="text-muted">CELULAR: </small><br>
            <span class="text-muted"><b class="acMovil_Delete"></b></span><br>
            <small class="text-muted">WHATSAPP: </small><br>
            <span class="text-muted"><b class="acWhatsapp_Delete"></b></span><br>
          </div>
          <div class="col-md-6">
            <small class="text-muted">FECHA/NUMERO DE MATRICULA: </small><br>
            <span class="text-muted"><b class="acDateregistration_Delete"></b>/<b class="acNumberregistration_Delete"></b></span><br>
            <small class="text-muted">CAMARA DE COMERCIO: </small><br>
            <span class="text-muted"><b class="acCommerce_Delete"></b></span><br>
            <small class="text-muted">REPRESENTANTE LEGAL: </small><br>
            <span class="text-muted"><b class="acRepresentativename_Delete"></b></span><br>
            <small class="text-muted">DOCUMENTO DE REPRESENTANTE LEGAL: </small><br>
            <span class="text-muted"><b class="acRepresentativenumberdocument_Delete"></b></span><br>
            <small class="text-muted">ENTIDAD BANCARIA: </small><br>
            <span class="text-muted"><b class="acBank_Delete"></b></span><br>
            <small class="text-muted">TIPO Y NUMERO DE CUENTA: </small><br>
            <span class="text-muted"><b class="acTypeaccount_Delete"></b>/<b class="acAccountnumber_Delete"></b></span><br>
            <small class="text-muted">REGIMEN: </small><br>
            <span class="text-muted"><b class="acRegime_Delete"></b></span><br>
            <small class="text-muted">GRANDES CONTRIBUYESTES: </small><br>
            <span class="text-muted"><b class="acTaxpayer_Delete"></b></span><br>
            <small class="text-muted">AUTORETENEDORES: </small><br>
            <span class="text-muted"><b class="acAutoretainer_Delete"></b></span><br>
            <small class="text-muted">ACTIVIDADES ECONOMICAS: </small><br>
            <span class="text-muted"><b class="acActivitys_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('allies.express.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="acId_Delete" value="" required>
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

  $('.newCharge-link').on('click', function() {
    $('#newCharge-modal').modal();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO
  $('select[name=acDepartment_id]').on('change', function(e) {
    var deparmentSelected = e.target.value;
    $('select[name=acMunicipality_id]').empty();
    $('select[name=acMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=acZoning_id]').empty();
    $('select[name=acZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=acNeighborhood_id]').empty();
    $('select[name=acNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=acCode]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        var count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=acMunicipality_id]').append(
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
  $('select[name=acMunicipality_id]').on('change', function(e) {
    var municipalitySelected = e.target.value;
    $('select[name=acZoning_id]').empty();
    $('select[name=acZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=acNeighborhood_id]').empty();
    $('select[name=acNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=acCode]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        var count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=acZoning_id]').append(
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
  $('select[name=acZoning_id]').on('change', function(e) {
    var zoneSelected = e.target.value;
    $('select[name=acNeighborhood_id]').empty();
    $('select[name=acNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=acCode]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        var count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=acNeighborhood_id]').append(
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
  $('select[name=acNeighborhood_id]').on('change', function(e) {
    var neSelected = e.target.value;
    $('input[name=acCode]').val('');
    if (neSelected != '') {
      var text = $('select[name=acNeighborhood_id] option:selected').attr('data-code');
      $('input[name=acCode]').val(text);
    }
  });

  $('.editCharge-link').on('click', function(e) {
    e.preventDefault();
    var acId = $(this).find('span:nth-child(2)').text();
    var acReasonsocial = $(this).find('span:nth-child(3)').text();
    var acPersonal_id = $(this).find('span:nth-child(4)').text();
    var acNumberdocument = $(this).find('span:nth-child(5)').text();
    var acNumberregistration = $(this).find('span:nth-child(6)').text();
    var acDateregistration = $(this).find('span:nth-child(7)').text();
    var acCommerce = $(this).find('span:nth-child(8)').text();
    var acDepartment_id = $(this).find('span:nth-child(9)').text();
    var acMunicipality_id = $(this).find('span:nth-child(10)').text();
    var acZoning_id = $(this).find('span:nth-child(11)').text();
    var acNeighborhood_id = $(this).find('span:nth-child(12)').text();
    var acAddress = $(this).find('span:nth-child(13)').text();
    var acEmail = $(this).find('span:nth-child(14)').text();
    var acPhone = $(this).find('span:nth-child(15)').text();
    var acMovil = $(this).find('span:nth-child(16)').text();
    var acWhatsapp = $(this).find('span:nth-child(17)').text();
    var acRepresentativename = $(this).find('span:nth-child(18)').text();
    var acRepresentativepersonal_id = $(this).find('span:nth-child(19)').text();
    var acRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
    var acBank = $(this).find('span:nth-child(21)').text();
    var acTypeaccount = $(this).find('span:nth-child(22)').text();
    var acAccountnumber = $(this).find('span:nth-child(23)').text();
    var acRegime = $(this).find('span:nth-child(24)').text();
    var acTaxpayer = $(this).find('span:nth-child(25)').text();
    var acAutoretainer = $(this).find('span:nth-child(26)').text();
    var acActivitys = $(this).find('span:nth-child(27)').text();
    $('input[name=acId_Edit]').val(acId);
    $('input[name=acReasonsocial_Edit]').val(acReasonsocial);
    $('select[name=acPersonal_id_Edit]').val(acPersonal_id);
    $('input[name=acNumberdocument_Edit]').val(acNumberdocument);
    $('input[name=acNumberregistration_Edit]').val(acNumberregistration);
    $('input[name=acDateregistration_Edit]').val(acDateregistration);
    $('input[name=acCommerce_Edit]').val(acCommerce);
    $('select[name=acDepartment_id_Edit]').val(acDepartment_id);
    $('select[name=acMunicipality_id_Edit]').empty();
    $('select[name=acMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $.get("{{ route('getMunicipalities') }}", {
      depId: acDepartment_id
    }, function(objectMunicipalities) {
      var count = Object.keys(objectMunicipalities).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectMunicipalities[i]['munId'] == acMunicipality_id) {
            $('select[name=acMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "' selected>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          } else {
            $('select[name=acMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('select[name=acZoning_id_Edit]').empty();
    $('select[name=acZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $.get("{{ route('getZonings') }}", {
      munId: acMunicipality_id
    }, function(objectZonings) {
      var count = Object.keys(objectZonings).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectZonings[i]['zonId'] == acZoning_id) {
            $('select[name=acZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "' selected>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          } else {
            $('select[name=acZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('select[name=acNeighborhood_id_Edit]').empty();
    $('select[name=acNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $.get("{{ route('getNeighborhoods') }}", {
      zonId: acZoning_id
    }, function(objectNeighborhoods) {
      var count = Object.keys(objectNeighborhoods).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectNeighborhoods[i]['neId'] == acNeighborhood_id) {
            $('input[name=acCode_Edit]').val(objectNeighborhoods[i]['neCode']);
            $('select[name=acNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "' selected>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          } else {
            $('select[name=acNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "'>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('input[name=acAddress_Edit]').val(acAddress);
    $('input[name=acEmail_Edit]').val(acEmail);
    $('input[name=acPhone_Edit]').val(acPhone);
    $('input[name=acMovil_Edit]').val(acMovil);
    $('input[name=acWhatsapp_Edit]').val(acWhatsapp);
    $('input[name=acRepresentativename_Edit]').val(acRepresentativename);
    $('select[name=acRepresentativepersonal_id_Edit]').val(acRepresentativepersonal_id);
    $('input[name=acRepresentativenumberdocument_Edit]').val(acRepresentativenumberdocument);
    $('input[name=acBank_Edit]').val(acBank);
    $('select[name=acTypeaccount_Edit]').val(acTypeaccount);
    $('input[name=acAccountnumber_Edit]').val(acAccountnumber);
    $('select[name=acRegime_Edit]').val(acRegime);
    $('select[name=acTaxpayer_Edit]').val(acTaxpayer);
    $('select[name=acAutoretainer_Edit]').val(acAutoretainer);
    var separatedActivitys = acActivitys.split('-');
    $('input[name=acActivitys_one_Edit]').val(separatedActivitys[0]);
    $('input[name=acActivitys_two_Edit]').val(separatedActivitys[1]);
    $('input[name=acActivitys_three_Edit]').val(separatedActivitys[2]);
    $('input[name=acActivitys_four_Edit]').val(separatedActivitys[3]);
    $('#editCharge-modal').modal();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO
  $('select[name=acDepartment_id_Edit]').on('change', function(e) {
    var deparmentSelected = e.target.value;
    $('select[name=acMunicipality_id_Edit]').empty();
    $('select[name=acMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=acZoning_id_Edit]').empty();
    $('select[name=acZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=acNeighborhood_id_Edit]').empty();
    $('select[name=acNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=acCode_Edit]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        var count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=acMunicipality_id_Edit]').append(
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
  $('select[name=acMunicipality_id_Edit]').on('change', function(e) {
    var municipalitySelected = e.target.value;
    $('select[name=acZoning_id_Edit]').empty();
    $('select[name=acZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=acNeighborhood_id_Edit]').empty();
    $('select[name=acNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=acCode_Edit]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        var count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=acZoning_id_Edit]').append(
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
  $('select[name=acZoning_id_Edit]').on('change', function(e) {
    var zoneSelected = e.target.value;
    $('select[name=acNeighborhood_id_Edit]').empty();
    $('select[name=acNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=acCode_Edit]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        var count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=acNeighborhood_id_Edit]').append(
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
  $('select[name=acNeighborhood_id_Edit]').on('change', function(e) {
    var neSelected = e.target.value;
    $('input[name=acCode_Edit]').val('');
    if (neSelected != '') {
      var text = $('select[name=acNeighborhood_id_Edit] option:selected').attr('data-code');
      $('input[name=acCode_Edit]').val(text);
    }
  });

  $('.deleteCharge-link').on('click', function(e) {
    e.preventDefault();
    var acId = $(this).find('span:nth-child(2)').text();
    var acReasonsocial = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var acNumberdocument = $(this).find('span:nth-child(5)').text();
    var acNumberregistration = $(this).find('span:nth-child(6)').text();
    var acDateregistration = $(this).find('span:nth-child(7)').text();
    var acCommerce = $(this).find('span:nth-child(8)').text();
    var depName = $(this).find('span:nth-child(9)').text();
    var munName = $(this).find('span:nth-child(10)').text();
    var zonName = $(this).find('span:nth-child(11)').text();
    var neName = $(this).find('span:nth-child(12)').text();
    var neCode = $(this).find('span:nth-child(13)').text();
    var acAddress = $(this).find('span:nth-child(14)').text();
    var acEmail = $(this).find('span:nth-child(15)').text();
    var acPhone = $(this).find('span:nth-child(16)').text();
    var acMovil = $(this).find('span:nth-child(17)').text();
    var acWhatsapp = $(this).find('span:nth-child(18)').text();
    var acRepresentativename = $(this).find('span:nth-child(19)').text();
    var acRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
    var acBank = $(this).find('span:nth-child(21)').text();
    var acTypeaccount = $(this).find('span:nth-child(22)').text();
    var acAccountnumber = $(this).find('span:nth-child(23)').text();
    var acRegime = $(this).find('span:nth-child(24)').text();
    var acTaxpayer = $(this).find('span:nth-child(25)').text();
    var acAutoretainer = $(this).find('span:nth-child(26)').text();
    var acActivitys = $(this).find('span:nth-child(27)').text();
    $('input[name=acId_Delete]').val(acId);
    $('.acReasonsocial_Delete').text(acReasonsocial);
    $('.acNumberdocument_Delete').text(perName + ': ' + acNumberdocument);
    $('.acNumberregistration_Delete').text(acNumberregistration);
    $('.acDateregistration_Delete').text(acDateregistration);
    $('.acCommerce_Delete').text(acCommerce);
    $('.depName_Delete').text(depName);
    $('.munName_Delete').text(munName);
    $('.zonName_Delete').text(zonName);
    $('.neName_Delete').text(neName);
    $('.neCode_Delete').text(neCode);
    $('.acAddress_Delete').text(acAddress);
    $('.acEmail_Delete').text(acEmail);
    $('.acPhone_Delete').text(acPhone);
    $('.acMovil_Delete').text(acMovil);
    $('.acWhatsapp_Delete').text(acWhatsapp);
    $('.acRepresentativename_Delete').text(acRepresentativename);
    $('.acRepresentativenumberdocument_Delete').text(acRepresentativenumberdocument);
    $('.acBank_Delete').text(acBank);
    $('.acTypeaccount_Delete').text(acTypeaccount);
    $('.acAccountnumber_Delete').text(acAccountnumber);
    $('.acRegime_Delete').text(acRegime);
    $('.acTaxpayer_Delete').text(acTaxpayer);
    $('.acAutoretainer_Delete').text(acAutoretainer);
    $('.acActivitys_Delete').text(acActivitys);
    $('#deleteCharge-modal').modal();
  });
</script>
@endsection