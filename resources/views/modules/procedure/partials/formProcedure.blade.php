@csrf
<div class="w-100 row">
  <div class="col-4">
    <small>DOCUMENTO</small>
    <select name="SelectDocument" class="form-control form-control-sm">
      <option value="">Seleccione...</option>
      @foreach($configuration as $item)
      <option value="{{ $item->cdmId }}">{{ $item->domName }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-8">
    <small>CONTENIDO</small>
    <textarea name="TextContent" id="TextContent" cols="30" rows="10" class="form-control-sm form-control"></textarea>
  </div>
</div>
<hr>