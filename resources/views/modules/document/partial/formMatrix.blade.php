@csrf
<div class="col-lg-12 row">
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('documento')}}</small>
      <select name="amDoc" id="" class="form-control form-control-sm" required>
        <option value="">{{ucwords('seleccione...')}}</option>
        @foreach($DocumentMNG as $item)
        <option value="{{$item->domId}}">{{$item->domName}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('actividad')}}</small>
      <input name="amActivity" type="text" class="form-control form-control-sm" maxlength="30" required>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('frecuencia')}}</small>
      <select name="amFrequency" class="form-control form-control-sm" required>
        <option value="">{{ucwords('seleccione...')}}</option>
        <option value="rutinaria">{{ucwords('rutinaria')}}</option>
        <option value="no rutinaria">{{ucwords('no rutinaria')}}</option>
        <option value="esporadica">{{ucwords('esporadica')}}</option>
      </select>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('peligro')}}</small>
      <input name="amDanger" type="text" class="form-control form-control-sm" maxlength="100" required>
    </div>
  </div>
</div>
<div class="col-lg-12 row">
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('riesgo')}}</small>
      <input name="amRick" type="text" class="form-control form-control-sm" maxlength="100" required>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('tipo de riesgo')}}</small>
      <select name="amTypeRick" class="form-control form-control-sm" required>
        <option value="">{{ucwords('seleccione...')}}</option>
        <option value="accidente">{{ucwords('accidente')}}</option>
        <option value="enfermedad">{{ucwords('enfermedad')}}</option>
      </select>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('medidas de control existentes')}}</small>
      <input name="amExistsControl" type="text" class="form-control form-control-sm" maxlength="200" required>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('niveles')}}</small>
      <select name="amLevel" id="" class="form-control form-control-sm" required>
        <option value="">{{ucwords('seleccione...')}}</option>
        <option value="eliminando el peligro">{{ucwords('eliminando el peligro')}}</option>
        <option value="mitigando el peligro">{{ucwords('mitigando el peligro')}}</option>
        <option value="utilizando protección">{{ucwords('utilizando protección')}}</option>
      </select>
    </div>
  </div>
</div>
<div class="col-lg-12 row">
  <div class="col-lg-2">
    <div class="form-group">
      <small class="text-muted">{{ucwords('personal. expuesto')}}</small>
      <input name="amPExposed" type="text" class="form-control form-control-sm" required v-model="exposed">
    </div>
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <small class="text-muted">{{ucwords('personal entrenado')}}</small>
      <input name="amPTrained" type="text" class="form-control form-control-sm" required v-model="trained">
    </div>
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <small class="text-muted" title="Personal Parcialmente Entrenado">{{ucwords('personal p. entrenado')}}</small>
      <input name="amPPTrained" title="Personal Parcialmente Entrenado" type="text" class="form-control form-control-sm" required>
    </div>
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <small class="text-muted">{{ucwords('personal no entrenado')}}</small>
      <input name="amPNotTrained" type="text" class="form-control form-control-sm" required>
    </div>
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <small class="text-muted">{{ucwords('exposición de riesgo')}}</small>
      <input name="amExpoRick" type="text" class="form-control form-control-sm" required>
    </div>
  </div>
  <div class="col-lg-2">
    <div class="form-group">
      <small class="text-muted">{{ucwords('probabilidad')}}</small>
      <input name="amProbability" type="text" class="form-control form-control-sm" required>
    </div>
  </div>
</div>
<div class="col-lg-12 row d-flex justify-content-around">
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('severidad')}}</small>
      <input name="amSeverity" type="text" class="form-control form-control-sm" required>
    </div>
  </div>
  <!-- se debe multiplicar los campos numerocos anteriores y mostrarlos en este input -->
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('probabilidad por severidad')}}</small>
      <input name="amProSeverity" type="text" class="form-control form-control-sm" required>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('grado de riesgo')}}</small>
      <select name="amGradeRick" class="form-control form-control-sm" required>
        <option value="">{{ucwords('seleccione...')}}</option>
        <option value="trivial">{{ucwords('trivial')}}</option>
        <option value="tolerable">{{ucwords('tolerable')}}</option>
        <option value="moderado">{{ucwords('moderado')}}</option>
        <option value="importante">{{ucwords('importante')}}</option>
        <option value="intolerable">{{ucwords('intolerable')}}</option>
      </select>
    </div>
  </div>
</div>