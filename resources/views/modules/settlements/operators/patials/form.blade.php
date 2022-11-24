<div class="form-group">
  <label for="typeservices">{{ ucwords('tipo de servicio') }}</label>
  <input type="text" name="typeservices" class="form-control @error('typeservices') is-invalid @enderror" id="typeservices" value="{{ old('typeservices') }}">
  @error('typeservices')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    @enderror
</div>
<div class="form-group">
  <label for="origin">{{ ucwords('origen') }}</label>
  <input type="text" name="origin" class="form-control @error('origin') is-invalid @enderror" id="origin" value="{{ old('origin') }}">
  @error('origin')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    @enderror
</div>
<div class="form-group">
  <label for="destiny">{{ ucwords('destino') }}</label>
  <input type="text" name="destiny" class="form-control @error('destiny') is-invalid @enderror" id="destiny" value="{{ old('destiny') }}">
  @error('destiny')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    @enderror
</div>
<div class="form-group">
  <label for="colaborator">{{ ucwords('colaborador') }}</label>
  <input type="text" name="colaborator" class="form-control @error('colaborator') is-invalid @enderror" id="colaborator" value="{{ old('colaborator') }}">
  @error('colaborator')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    @enderror
</div>
<div class="form-group">
  <label for="price">{{ ucwords('precio') }}</label>
  <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}">
  @error('price')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    @enderror
</div>
<div class="form-group">
  <label for="date">{{ ucwords('fecha') }}</label>
  <input type="text" name="date" class="form-control @error('date') is-invalid @enderror" id="date" value="{{ old('date') }}">
  @error('date')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    @enderror
</div>