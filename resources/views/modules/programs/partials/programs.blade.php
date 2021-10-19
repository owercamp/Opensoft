@csrf
<div class="col-12 row">
  <div class="col-4">
    <div class="form-group">
      <small>DOCUMENTO</small>
      <select name="SelectDocument" class="form-control form-control-sm">
        <option value="">Seleccione...</option>
        @foreach($documents as $document)
        <option value="{{$document->cdlId}}">{{$document->dolName}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-8">
    <div class="form-group">
      <small>CONTENIDO</small>
      <textarea name="TextContent" id="TextContent" cols="30" rows="10" class="form-control-sm form-control"></textarea>
    </div>
  </div>
</div>
<hr>