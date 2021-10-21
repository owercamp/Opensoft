@csrf
<div class="col-lg-12 row">
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('tipo de documento')}}</small>
      <select name="mlDoc" class="form-control form-control-sm" required>
        <option value="">{{ucfirst('seleccione...')}}</option>
        <option value="{{ucfirst('articulo')}}">{{ucfirst('articulo')}}</option>
        <option value="{{ucfirst('circular')}}">{{ucfirst('circular')}}</option>
        <option value="{{ucfirst('Código')}}">{{ucfirst('Código')}}</option>
        <option value="{{ucfirst('Concepto')}}">{{ucfirst('Concepto')}}</option>
        <option value="{{ucfirst('constitución')}}">{{ucfirst('constitución')}}</option>
        <option value="{{ucfirst('decisión')}}">{{ucfirst('decisión')}}</option>
        <option value="{{ucfirst('decreto')}}">{{ucfirst('decreto')}}</option>
        <option value="{{ucfirst('ley')}}">{{ucfirst('ley')}}</option>
        <option value="{{ucfirst('norma')}}">{{ucfirst('norma')}}</option>
        <option value="{{ucfirst('otro')}}">{{ucfirst('otro')}}</option>
        <option value="{{ucfirst('resolución')}}">{{ucfirst('resolución')}}</option>
        <option value="{{ucfirst('sentencia')}}">{{ucfirst('sentencia')}}</option>
      </select>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('numero')}}</small>
      <input name="mlNum" type="text" class="form-control form-control-sm" maxlength="30" required>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('año')}}</small>
      <select name="mlYear" id="" class="form-control form-control-sm" required></select>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('titulo')}}</small>
      <input name="mltitle" type="text" class="form-control form-control-sm" maxlength="30" required>
    </div>
  </div>
</div>
<div class="col-lg-12 row">
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('articulos que aplican')}}</small>
      <input name="mlArticle" type="text" class="form-control form-control-sm" maxlength="100" required>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('descripción y alcance')}}</small>
      <input name="mlDescription" type="text" class="form-control form-control-sm" maxlength="200">
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('area que aplica')}}</small>
      <input name="mlArea" type="text" class="form-control form-control-sm" maxlength="30" required>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('evidencia de cumplimiento')}}</small>
      <input name="mlEvidence" type="text" class="form-control form-control-sm" maxlength="30" required>
    </div>
  </div>
</div>
<div class="col-lg-12 row justify-content-around">
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('responsable')}}</small>
      <select name="mlCollaborator" id="" class="form-control form-control-sm" required>
        <option value="">{{ucwords('seleccione...')}}</option>
        @foreach($collaborators as $collaborator)
        <option value="{{$collaborator->coId}}">{{ucwords($collaborator->coNames)}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      <small class="text-muted">{{ucwords('cumple')}}</small>
      <select name="mlMeet" class="form-control form-control-sm" required>
        <option value="">{{ucwords('seleccione...')}}</option>
        <option value="{{ucwords('si')}}">{{ucwords('si')}}</option>
        <option value="{{ucwords('no')}}">{{ucwords('no')}}</option>
      </select>
    </div>
  </div>
</div>