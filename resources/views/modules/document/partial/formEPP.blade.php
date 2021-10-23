@csrf
<div class="col-lg-12 row">
  <div class="col-lg-4">
    <div class="form-group">
      <small class="text-muted">{{ucwords('documento')}}</small>
      <select name="meDoc" class="form-control form-control-sm" required>
        <option value="">{{ucwords('seleccione...')}}</option>
        @foreach($DocumentMNG as $item)
        <option value="{{$item->domId}}">{{$item->domName}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      <small class="text-muted">{{ucwords('elementos de protección personal')}}</small>
      <input name="meEPP" type="text" class="form-control form-control-sm" maxlength="30" required>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      <small class="text-muted">{{ucwords('descripción del elemento')}}</small>
      <input name="meDes" type="text" class="form-control form-control-sm" maxlength="100" required>
    </div>
  </div>
</div>
<div class="col-lg-12 row justify-content-around">
  <div class="col-lg-4">
    <div class="form-group">
      <small class="text-muted">{{ucwords('norma aplicable')}}</small>
      <input name="meNor" type="text" class="form-control form-control-sm" maxlength="100" required>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      <small class="text-muted">{{ucwords('observaciones')}}</small>
      <input name="meObs" type="text" class="form-control form-control-sm" maxlength="100" required>
    </div>
  </div>
</div>