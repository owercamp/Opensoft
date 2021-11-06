@extends('modules.administrativeProviders')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>PROVEDORES</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar un proveedor" class="btn btn-outline-success form-control-sm newProvider-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessProviders'))
      <div class="alert alert-success">
        {{ session('SuccessProviders') }}
      </div>
      @endif
      @if(session('PrimaryProviders'))
      <div class="alert alert-primary">
        {{ session('PrimaryProviders') }}
      </div>
      @endif
      @if(session('WarningProviders'))
      <div class="alert alert-warning">
        {{ session('WarningProviders') }}
      </div>
      @endif
      @if(session('SecondaryProviders'))
      <div class="alert alert-secondary">
        {{ session('SecondaryProviders') }}
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
      @foreach($providers as $provider)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $provider->proReasonsocial }}</td>
        <td>{{ $provider->proNumberdocument }}</td>
        <td>{{ $provider->proRepresentativename }}</td>
        <td>
          <a href="#" title="Editar proveedor {{ $provider->proReasonsocial }}" class="btn btn-outline-primary rounded-circle form-control-sm editProvider-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $provider->proId }}</span>
            <span hidden>{{ $provider->proReasonsocial }}</span>
            <span hidden>{{ $provider->proPersonal_id }}</span>
            <span hidden>{{ $provider->proNumberdocument }}</span>
            <span hidden>{{ $provider->proNumberregistration }}</span>
            <span hidden>{{ $provider->proDateregistration }}</span>
            <span hidden>{{ $provider->proCommerce }}</span>
            <span hidden>{{ $provider->depId }}</span>
            <span hidden>{{ $provider->munId }}</span>
            <span hidden>{{ $provider->zonId }}</span>
            <span hidden>{{ $provider->proNeighborhood_id }}</span>
            <span hidden>{{ $provider->proAddress }}</span>
            <span hidden>{{ $provider->proEmail }}</span>
            <span hidden>{{ $provider->proPhone }}</span>
            <span hidden>{{ $provider->proMovil }}</span>
            <span hidden>{{ $provider->proWhatsapp }}</span>
            <span hidden>{{ $provider->proRepresentativename }}</span>
            <span hidden>{{ $provider->proRepresentativepersonal_id }}</span>
            <span hidden>{{ $provider->proRepresentativenumberdocument }}</span>
            <span hidden>{{ $provider->proBank }}</span>
            <span hidden>{{ $provider->proTypeaccount }}</span>
            <span hidden>{{ $provider->proAccountnumber }}</span>
            <span hidden>{{ $provider->proRegime }}</span>
            <span hidden>{{ $provider->proTaxpayer }}</span>
            <span hidden>{{ $provider->proAutoretainer }}</span>
            <span hidden>{{ $provider->proActivitys }}</span>
          </a>
          <a href="#" title="Eliminar proveedor {{ $provider->proReasonsocial }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteProvider-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $provider->proId }}</span>
            <span hidden>{{ $provider->proReasonsocial }}</span>
            <span hidden>{{ $provider->perName }}</span>
            <span hidden>{{ $provider->proNumberdocument }}</span>
            <span hidden>{{ $provider->proNumberregistration }}</span>
            <span hidden>{{ $provider->proDateregistration }}</span>
            <span hidden>{{ $provider->proCommerce }}</span>
            <span hidden>{{ $provider->depName }}</span>
            <span hidden>{{ $provider->munName }}</span>
            <span hidden>{{ $provider->zonName }}</span>
            <span hidden>{{ $provider->neName }}</span>
            <span hidden>{{ $provider->neCode }}</span>
            <span hidden>{{ $provider->proAddress }}</span>
            <span hidden>{{ $provider->proEmail }}</span>
            <span hidden>{{ $provider->proPhone }}</span>
            <span hidden>{{ $provider->proMovil }}</span>
            <span hidden>{{ $provider->proWhatsapp }}</span>
            <span hidden>{{ $provider->proRepresentativename }}</span>
            <span hidden>{{ $provider->proRepresentativenumberdocument }}</span>
            <span hidden>{{ $provider->proBank }}</span>
            <span hidden>{{ $provider->proTypeaccount }}</span>
            <span hidden>{{ $provider->proAccountnumber }}</span>
            <span hidden>{{ $provider->proRegime }}</span>
            <span hidden>{{ $provider->proTaxpayer }}</span>
            <span hidden>{{ $provider->proAutoretainer }}</span>
            <span hidden>{{ $provider->proActivitys }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newProvider-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO PROVEEDOR:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('providers.providers.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">RAZON SOCIAL:</small>
                    <input type="text" name="proReasonsocial" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de proveedor" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION:</small>
                    <select name="proPersonal_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="proNumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE MATRICULA:</small>
                    <input type="text" name="proNumberregistration" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE MATRICULA:</small>
                    <input type="text" name="proDateregistration" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAMARA DE COMERCIO:</small>
                    <input type="text" name="proCommerce" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">DEPARTAMENTO:</small>
                        <select name="proDepartment_id" class="form-control form-control-sm" required>
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
                        <select name="proMunicipality_id" class="form-control form-control-sm" required>
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
                        <select name="proZoning_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione localidad/zona ...</option>
                          <!-- zonId - zonName - zonMunicipality_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">BARRIO:</small>
                        <select name="proNeighborhood_id" class="form-control form-control-sm" required>
                          <option value="">Seleccione barrio ...</option>
                          <!-- neId - neName - neZoning_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">CODIGO POSTAL:</small>
                        <input type="text" name="proCode" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION:</small>
                    <input type="text" name="proAddress" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CORREO ELECTRONICO:</small>
                        <input type="email" name="proEmail" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO FIJO:</small>
                        <input type="text" name="proPhone" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO CELULAR:</small>
                        <input type="text" name="proMovil" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">LINEA WHATSAPP:</small>
                        <input type="text" name="proWhatsapp" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">REPRESENTANTE LEGAL:</small>
                    <input type="text" name="proRepresentativename" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
                    <select name="proRepresentativepersonal_id" class="form-control form-control-sm" required>
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
                    <input type="text" name="proRepresentativenumberdocument" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
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
                        <input type="text" name="proBank" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de banco" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TIPO DE CUENTA:</small>
                        <select name="proTypeaccount" class="form-control form-control-sm" required>
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
                        <input type="text" name="proAccountnumber" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">REGIMEN IVA:</small>
                        <select name="proRegime" class="form-control form-control-sm" required>
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
                        <select name="proTaxpayer" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">¿AUTORETENEDORES?:</small>
                        <select name="proAutoretainer" class="form-control form-control-sm" required>
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
                            <input type="text" name="proActivitys_one" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="proActivitys_two" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="proActivitys_three" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="proActivitys_four" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
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
            <button type="submit" class="btn btn-outline-success form-control-sm">REGISTRAR PROVEEDOR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editProvider-modal">
  <div class="modal-dialog modal-lg" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR PROVEEDOR:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('providers.providers.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">RAZON SOCIAL:</small>
                    <input type="text" name="proReasonsocial_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de proveedor" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION:</small>
                    <select name="proPersonal_id_Edit" class="form-control form-control-sm" required>
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
                    <input type="text" name="proNumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000, 000000000000-3" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">NUMERO DE MATRICULA:</small>
                    <input type="text" name="proNumberregistration_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">FECHA DE MATRICULA:</small>
                    <input type="text" name="proDateregistration_Edit" class="form-control form-control-sm datepicker" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">CAMARA DE COMERCIO:</small>
                    <input type="text" name="proCommerce_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Campo numérico">
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <small class="text-muted">DEPARTAMENTO:</small>
                        <select name="proDepartment_id_Edit" class="form-control form-control-sm" required>
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
                        <select name="proMunicipality_id_Edit" class="form-control form-control-sm" required>
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
                        <select name="proZoning_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione localidad/zona ...</option>
                          <!-- zonId - zonName - zonMunicipality_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">BARRIO:</small>
                        <select name="proNeighborhood_id_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione barrio ...</option>
                          <!-- neId - neName - neZoning_id -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">CODIGO POSTAL:</small>
                        <input type="text" name="proCode_Edit" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DIRECCION:</small>
                    <input type="text" name="proAddress_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <small class="text-muted">CORREO ELECTRONICO:</small>
                        <input type="email" name="proEmail_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO FIJO:</small>
                        <input type="text" name="proPhone_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TELEFONO CELULAR:</small>
                        <input type="text" name="proMovil_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">LINEA WHATSAPP:</small>
                        <input type="text" name="proWhatsapp_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row py-2 border-top border-bottom">
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">REPRESENTANTE LEGAL:</small>
                    <input type="text" name="proRepresentativename_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre completo" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <small class="text-muted">TIPO DE IDENTIFICACION DE REPRESENTANTE:</small>
                    <select name="proRepresentativepersonal_id_Edit" class="form-control form-control-sm" required>
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
                    <input type="text" name="proRepresentativenumberdocument_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
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
                        <input type="text" name="proBank_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Nombre de banco" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">TIPO DE CUENTA:</small>
                        <select name="proTypeaccount_Edit" class="form-control form-control-sm" required>
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
                        <input type="text" name="proAccountnumber_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 00000000000000000000000000000000000000000000000000" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">REGIMEN IVA:</small>
                        <select name="proRegime_Edit" class="form-control form-control-sm" required>
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
                        <select name="proTaxpayer_Edit" class="form-control form-control-sm" required>
                          <option value="">Seleccione ...</option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <small class="text-muted">¿AUTORETENEDORES?:</small>
                        <select name="proAutoretainer_Edit" class="form-control form-control-sm" required>
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
                            <input type="text" name="proActivitys_one_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="proActivitys_two_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="proActivitys_three_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <input type="text" name="proActivitys_four_Edit" maxlength="4" class="form-control form-control-sm" pattern="[0-9]{1,4}" placeholder="Ej. 0000">
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
              <input type="hidden" class="form-control form-control-sm" name="proId_Edit" value="" required>
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

<div class="modal fade" id="deleteProvider-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE PROVEEDOR:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <small class="text-muted">RAZON SOCIAL: </small><br>
            <span class="text-muted"><b class="proReasonsocial_Delete"></b></span><br>
            <small class="text-muted">DOCUMENTO: </small><br>
            <span class="text-muted"><b class="proNumberdocument_Delete"></b></span><br>
            <small class="text-muted">DEPARTAMENTO/MUNICIPIO: </small><br>
            <span class="text-muted"><b class="depName_Delete"></b>/<b class="munName_Delete"></b></span><br>
            <small class="text-muted">ZONA/BARRIO/CODIGO POSTAL: </small><br>
            <span class="text-muted"><b class="zonName_Delete"></b>/<b class="neName_Delete"></b>/<b class="neCode_Delete"></b></span><br>
            <small class="text-muted">DIRECCION: </small><br>
            <span class="text-muted"><b class="proAddress_Delete"></b></span><br>
            <small class="text-muted">CORREO ELECTRONICO: </small><br>
            <span class="text-muted"><b class="proEmail_Delete"></b></span><br>
            <small class="text-muted">TELEFONO: </small><br>
            <span class="text-muted"><b class="proPhone_Delete"></b></span><br>
            <small class="text-muted">CELULAR: </small><br>
            <span class="text-muted"><b class="proMovil_Delete"></b></span><br>
            <small class="text-muted">WHATSAPP: </small><br>
            <span class="text-muted"><b class="proWhatsapp_Delete"></b></span><br>
          </div>
          <div class="col-md-6">
            <small class="text-muted">FECHA/NUMERO DE MATRICULA: </small><br>
            <span class="text-muted"><b class="proDateregistration_Delete"></b>/<b class="proNumberregistration_Delete"></b></span><br>
            <small class="text-muted">CAMARA DE COMERCIO: </small><br>
            <span class="text-muted"><b class="proCommerce_Delete"></b></span><br>
            <small class="text-muted">REPRESENTANTE LEGAL: </small><br>
            <span class="text-muted"><b class="proRepresentativename_Delete"></b></span><br>
            <small class="text-muted">DOCUMENTO DE REPRESENTANTE LEGAL: </small><br>
            <span class="text-muted"><b class="proRepresentativenumberdocument_Delete"></b></span><br>
            <small class="text-muted">ENTIDAD BANCARIA: </small><br>
            <span class="text-muted"><b class="proBank_Delete"></b></span><br>
            <small class="text-muted">TIPO Y NUMERO DE CUENTA: </small><br>
            <span class="text-muted"><b class="proTypeaccount_Delete"></b>/<b class="proAccountnumber_Delete"></b></span><br>
            <small class="text-muted">REGIMEN: </small><br>
            <span class="text-muted"><b class="proRegime_Delete"></b></span><br>
            <small class="text-muted">GRANDES CONTRIBUYESTES: </small><br>
            <span class="text-muted"><b class="proTaxpayer_Delete"></b></span><br>
            <small class="text-muted">AUTORETENEDORES: </small><br>
            <span class="text-muted"><b class="proAutoretainer_Delete"></b></span><br>
            <small class="text-muted">ACTIVIDADES ECONOMICAS: </small><br>
            <span class="text-muted"><b class="proActivitys_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('providers.providers.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="proId_Delete" value="" required>
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

  $('.newProvider-link').on('click', function() {
    $('#newProvider-modal').modal();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO
  $('select[name=proDepartment_id]').on('change', function(e) {
    var deparmentSelected = e.target.value;
    $('select[name=proMunicipality_id]').empty();
    $('select[name=proMunicipality_id]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=proZoning_id]').empty();
    $('select[name=proZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=proNeighborhood_id]').empty();
    $('select[name=proNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=proCode]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        var count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=proMunicipality_id]').append(
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
  $('select[name=proMunicipality_id]').on('change', function(e) {
    var municipalitySelected = e.target.value;
    $('select[name=proZoning_id]').empty();
    $('select[name=proZoning_id]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=proNeighborhood_id]').empty();
    $('select[name=proNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=proCode]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        var count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=proZoning_id]').append(
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
  $('select[name=proZoning_id]').on('change', function(e) {
    var zoneSelected = e.target.value;
    $('select[name=proNeighborhood_id]').empty();
    $('select[name=proNeighborhood_id]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=proCode]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        var count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=proNeighborhood_id]').append(
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
  $('select[name=proNeighborhood_id]').on('change', function(e) {
    var neSelected = e.target.value;
    $('input[name=proCode]').val('');
    if (neSelected != '') {
      var text = $('select[name=proNeighborhood_id] option:selected').attr('data-code');
      $('input[name=proCode]').val(text);
    }
  });

  $('.editProvider-link').on('click', function(e) {
    e.preventDefault();
    var proId = $(this).find('span:nth-child(2)').text();
    var proReasonsocial = $(this).find('span:nth-child(3)').text();
    var proPersonal_id = $(this).find('span:nth-child(4)').text();
    var proNumberdocument = $(this).find('span:nth-child(5)').text();
    var proNumberregistration = $(this).find('span:nth-child(6)').text();
    var proDateregistration = $(this).find('span:nth-child(7)').text();
    var proCommerce = $(this).find('span:nth-child(8)').text();
    var proDepartment_id = $(this).find('span:nth-child(9)').text();
    var proMunicipality_id = $(this).find('span:nth-child(10)').text();
    var proZoning_id = $(this).find('span:nth-child(11)').text();
    var proNeighborhood_id = $(this).find('span:nth-child(12)').text();
    var proAddress = $(this).find('span:nth-child(13)').text();
    var proEmail = $(this).find('span:nth-child(14)').text();
    var proPhone = $(this).find('span:nth-child(15)').text();
    var proMovil = $(this).find('span:nth-child(16)').text();
    var proWhatsapp = $(this).find('span:nth-child(17)').text();
    var proRepresentativename = $(this).find('span:nth-child(18)').text();
    var proRepresentativepersonal_id = $(this).find('span:nth-child(19)').text();
    var proRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
    var proBank = $(this).find('span:nth-child(21)').text();
    var proTypeaccount = $(this).find('span:nth-child(22)').text();
    var proAccountnumber = $(this).find('span:nth-child(23)').text();
    var proRegime = $(this).find('span:nth-child(24)').text();
    var proTaxpayer = $(this).find('span:nth-child(25)').text();
    var proAutoretainer = $(this).find('span:nth-child(26)').text();
    var proActivitys = $(this).find('span:nth-child(27)').text();
    $('input[name=proId_Edit]').val(proId);
    $('input[name=proReasonsocial_Edit]').val(proReasonsocial);
    $('select[name=proPersonal_id_Edit]').val(proPersonal_id);
    $('input[name=proNumberdocument_Edit]').val(proNumberdocument);
    $('input[name=proNumberregistration_Edit]').val(proNumberregistration);
    $('input[name=proDateregistration_Edit]').val(proDateregistration);
    $('input[name=proCommerce_Edit]').val(proCommerce);
    $('select[name=proDepartment_id_Edit]').val(proDepartment_id);
    $('select[name=proMunicipality_id_Edit]').empty();
    $('select[name=proMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $.get("{{ route('getMunicipalities') }}", {
      depId: proDepartment_id
    }, function(objectMunicipalities) {
      var count = Object.keys(objectMunicipalities).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectMunicipalities[i]['munId'] == proMunicipality_id) {
            $('select[name=proMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "' selected>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          } else {
            $('select[name=proMunicipality_id_Edit]').append(
              "<option value='" + objectMunicipalities[i]['munId'] + "'>" +
              objectMunicipalities[i]['munName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('select[name=proZoning_id_Edit]').empty();
    $('select[name=proZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $.get("{{ route('getZonings') }}", {
      munId: proMunicipality_id
    }, function(objectZonings) {
      var count = Object.keys(objectZonings).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectZonings[i]['zonId'] == proZoning_id) {
            $('select[name=proZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "' selected>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          } else {
            $('select[name=proZoning_id_Edit]').append(
              "<option value='" + objectZonings[i]['zonId'] + "'>" +
              objectZonings[i]['zonName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('select[name=proNeighborhood_id_Edit]').empty();
    $('select[name=proNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $.get("{{ route('getNeighborhoods') }}", {
      zonId: proZoning_id
    }, function(objectNeighborhoods) {
      var count = Object.keys(objectNeighborhoods).length;
      if (count > 0) {
        for (var i = 0; i < count; i++) {
          if (objectNeighborhoods[i]['neId'] == proNeighborhood_id) {
            $('input[name=proCode_Edit]').val(objectNeighborhoods[i]['neCode']);
            $('select[name=proNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "' selected>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          } else {
            $('select[name=proNeighborhood_id_Edit]').append(
              "<option value='" + objectNeighborhoods[i]['neId'] + "' data-code='" + objectNeighborhoods[i]['neCode'] + "'>" +
              objectNeighborhoods[i]['neName'] +
              "</option>"
            );
          }
        }
      }
    });
    $('input[name=proAddress_Edit]').val(proAddress);
    $('input[name=proEmail_Edit]').val(proEmail);
    $('input[name=proPhone_Edit]').val(proPhone);
    $('input[name=proMovil_Edit]').val(proMovil);
    $('input[name=proWhatsapp_Edit]').val(proWhatsapp);
    $('input[name=proRepresentativename_Edit]').val(proRepresentativename);
    $('select[name=proRepresentativepersonal_id_Edit]').val(proRepresentativepersonal_id);
    $('input[name=proRepresentativenumberdocument_Edit]').val(proRepresentativenumberdocument);
    $('input[name=proBank_Edit]').val(proBank);
    $('select[name=proTypeaccount_Edit]').val(proTypeaccount);
    $('input[name=proAccountnumber_Edit]').val(proAccountnumber);
    $('select[name=proRegime_Edit]').val(proRegime);
    $('select[name=proTaxpayer_Edit]').val(proTaxpayer);
    $('select[name=proAutoretainer_Edit]').val(proAutoretainer);
    var separatedActivitys = proActivitys.split('-');
    $('input[name=proActivitys_one_Edit]').val(separatedActivitys[0]);
    $('input[name=proActivitys_two_Edit]').val(separatedActivitys[1]);
    $('input[name=proActivitys_three_Edit]').val(separatedActivitys[2]);
    $('input[name=proActivitys_four_Edit]').val(separatedActivitys[3]);
    $('#editProvider-modal').modal();
  });

  // CONSULTAR MUNICIPIO POR DEPARTAMENTO
  $('select[name=proDepartment_id_Edit]').on('change', function(e) {
    var deparmentSelected = e.target.value;
    $('select[name=proMunicipality_id_Edit]').empty();
    $('select[name=proMunicipality_id_Edit]').append("<option value=''>Seleccione ciudad/municipio ...</option>");
    $('select[name=proZoning_id_Edit]').empty();
    $('select[name=proZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=proNeighborhood_id_Edit]').empty();
    $('select[name=proNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=proCode_Edit]').val('');
    if (deparmentSelected != '') {
      $.get("{{ route('getMunicipalities') }}", {
        depId: deparmentSelected
      }, function(objectMunicipalities) {
        var count = Object.keys(objectMunicipalities).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=proMunicipality_id_Edit]').append(
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
  $('select[name=proMunicipality_id_Edit]').on('change', function(e) {
    var municipalitySelected = e.target.value;
    $('select[name=proZoning_id_Edit]').empty();
    $('select[name=proZoning_id_Edit]').append("<option value=''>Seleccione localidad/zona ...</option>");
    $('select[name=proNeighborhood_id_Edit]').empty();
    $('select[name=proNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=proCode_Edit]').val('');
    if (municipalitySelected != '') {
      $.get("{{ route('getZonings') }}", {
        munId: municipalitySelected
      }, function(objectZonings) {
        var count = Object.keys(objectZonings).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=proZoning_id_Edit]').append(
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
  $('select[name=proZoning_id_Edit]').on('change', function(e) {
    var zoneSelected = e.target.value;
    $('select[name=proNeighborhood_id_Edit]').empty();
    $('select[name=proNeighborhood_id_Edit]').append("<option value=''>Seleccione barrio ...</option>");
    $('input[name=proCode_Edit]').val('');
    if (zoneSelected != '') {
      $.get("{{ route('getNeighborhoods') }}", {
        zonId: zoneSelected
      }, function(objectNeighborhood) {
        var count = Object.keys(objectNeighborhood).length;
        if (count > 0) {
          for (var i = 0; i < count; i++) {
            $('select[name=proNeighborhood_id_Edit]').append(
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
  $('select[name=proNeighborhood_id_Edit]').on('change', function(e) {
    var neSelected = e.target.value;
    $('input[name=proCode_Edit]').val('');
    if (neSelected != '') {
      var text = $('select[name=proNeighborhood_id_Edit] option:selected').attr('data-code');
      $('input[name=proCode_Edit]').val(text);
    }
  });

  $('.deleteProvider-link').on('click', function(e) {
    e.preventDefault();
    var proId = $(this).find('span:nth-child(2)').text();
    var proReasonsocial = $(this).find('span:nth-child(3)').text();
    var perName = $(this).find('span:nth-child(4)').text();
    var proNumberdocument = $(this).find('span:nth-child(5)').text();
    var proNumberregistration = $(this).find('span:nth-child(6)').text();
    var proDateregistration = $(this).find('span:nth-child(7)').text();
    var proCommerce = $(this).find('span:nth-child(8)').text();
    var depName = $(this).find('span:nth-child(9)').text();
    var munName = $(this).find('span:nth-child(10)').text();
    var zonName = $(this).find('span:nth-child(11)').text();
    var neName = $(this).find('span:nth-child(12)').text();
    var neCode = $(this).find('span:nth-child(13)').text();
    var proAddress = $(this).find('span:nth-child(14)').text();
    var proEmail = $(this).find('span:nth-child(15)').text();
    var proPhone = $(this).find('span:nth-child(16)').text();
    var proMovil = $(this).find('span:nth-child(17)').text();
    var proWhatsapp = $(this).find('span:nth-child(18)').text();
    var proRepresentativename = $(this).find('span:nth-child(19)').text();
    var proRepresentativenumberdocument = $(this).find('span:nth-child(20)').text();
    var proBank = $(this).find('span:nth-child(21)').text();
    var proTypeaccount = $(this).find('span:nth-child(22)').text();
    var proAccountnumber = $(this).find('span:nth-child(23)').text();
    var proRegime = $(this).find('span:nth-child(24)').text();
    var proTaxpayer = $(this).find('span:nth-child(25)').text();
    var proAutoretainer = $(this).find('span:nth-child(26)').text();
    var proActivitys = $(this).find('span:nth-child(27)').text();
    $('input[name=proId_Delete]').val(proId);
    $('.proReasonsocial_Delete').text(proReasonsocial);
    $('.proNumberdocument_Delete').text(perName + ': ' + proNumberdocument);
    $('.proNumberregistration_Delete').text(proNumberregistration);
    $('.proDateregistration_Delete').text(proDateregistration);
    $('.proCommerce_Delete').text(proCommerce);
    $('.depName_Delete').text(depName);
    $('.munName_Delete').text(munName);
    $('.zonName_Delete').text(zonName);
    $('.neName_Delete').text(neName);
    $('.neCode_Delete').text(neCode);
    $('.proAddress_Delete').text(proAddress);
    $('.proEmail_Delete').text(proEmail);
    $('.proPhone_Delete').text(proPhone);
    $('.proMovil_Delete').text(proMovil);
    $('.proWhatsapp_Delete').text(proWhatsapp);
    $('.proRepresentativename_Delete').text(proRepresentativename);
    $('.proRepresentativenumberdocument_Delete').text(proRepresentativenumberdocument);
    $('.proBank_Delete').text(proBank);
    $('.proTypeaccount_Delete').text(proTypeaccount);
    $('.proAccountnumber_Delete').text(proAccountnumber);
    $('.proRegime_Delete').text(proRegime);
    $('.proTaxpayer_Delete').text(proTaxpayer);
    $('.proAutoretainer_Delete').text(proAutoretainer);
    $('.proActivitys_Delete').text(proActivitys);
    $('#deleteProvider-modal').modal();
  });
</script>
@endsection