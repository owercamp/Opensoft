@csrf
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <small class="text-muted">FOTOGRAFIA:</small>
          <div class="custom-file">
            <input type="file" name="coPhoto" lang="es" placeholder="Unicamente con extensión .png" accept=".png">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <small class="text-muted">FIRMA DIGITAL:</small>
          <div class="custom-file">
            <input type="file" name="coFirm" lang="es" placeholder="Unicamente con extensión .png" accept=".png">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <small class="text-muted">NOMBRES COMPLETOS:</small>
          <input type="text" name="coNames" maxlength="50" class="form-control form-control-sm" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <small class="text-muted">TIPO DE IDENTIFICACION:</small>
          <select name="coPersonal_id" class="form-control form-control-sm" required>
            <option value="">Seleccione identificación ...</option>
            @foreach($personals as $personal)
            <option value="{{ $personal->perId }}">{{ $personal->perName }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <small class="text-muted">NUMERO DE DOCUMENTO:</small>
          <input type="text" name="coNumberdocument" maxlength="15" pattern="[0-9]{1,15}" class="form-control form-control-sm" placeholder="Ej. 000000000000" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <small class="text-muted">CARGO:</small>
          <input type="text" name="coPosition" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Mensajero/Secretaria/Conductor" required>
        </div>
      </div>
    </div>
    <div class="row py-4">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <small class="text-muted">DEPARTAMENTO:</small>
              <select name="coDeparment_id" class="form-control form-control-sm" required>
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
              <select name="coMunicipality_id" class="form-control form-control-sm" required>
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
              <select name="coZoning_id" class="form-control form-control-sm" required>
                <option value="">Seleccione localidad/zona ...</option>
                <!-- zonId - zonName - zonMunicipality_id -->
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <small class="text-muted">BARRIO:</small>
              <select name="coNeighborhood_id" class="form-control form-control-sm" required>
                <option value="">Seleccione barrio ...</option>
                <!-- neId - neName - neZoning_id -->
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <small class="text-muted">CODIGO POSTAL:</small>
              <input type="text" name="coCode" maxlength="10" class="form-control form-control-sm" placeholder="Código postal" readonly required>
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
              <input type="text" name="coAddress" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Cra./Cll/Trans./Diag. 00 # 00J - 00Z sur/Norte" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <small class="text-muted">CORREO ELECTRONICO:</small>
              <input type="email" name="coEmail" maxlength="50" class="form-control form-control-sm" placeholder="Ej. direcciondecorreo@teminacion.com" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <small class="text-muted">TELEFONO CELULAR:</small>
              <input type="text" name="coMovil" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <small class="text-muted">LINEA WHATSAPP:</small>
              <input type="text" name="coWhatsapp" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" placeholder="Campo numérico" required>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <small class="text-muted">TIPO SANGUINEO:</small>
              <select name="coBloodtype" class="form-control form-control-sm" required>
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
              <select name="coHealths_id" class="form-control form-control-sm" required>
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
              <select name="coRisk_id" class="form-control form-control-sm" required>
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
              <select name="coCompensation_id" class="form-control form-control-sm" required>
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
              <select name="coPension_id" class="form-control form-control-sm" required>
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
              <select name="coLayoff_id" class="form-control form-control-sm" required>
                <option value="">Seleccione fondo de cesantías ...</option>
                @foreach($layoffs as $layoff)
                <option value="{{ $layoff->layId }}">{{ $layoff->layName }}</option>
                @endforeach
              </select>
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