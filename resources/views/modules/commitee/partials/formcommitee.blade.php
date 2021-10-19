@csrf
<div class="col-12 row">
  <div class="col-4">
    <div class="form-group">
      <small class="text-muted">DOCUMENTO</small>
      <select name="SelectDocument" class="form-control form-control-sm">
        <option value="">Seleccione...</option>
        @foreach($configuration as $item)
        <option value="{{ $item->cdmId }}">{{ $item->domName }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <small class="text-muted">CONTENIDO</small>
      <textarea name="TextContent" id="TextContent" cols="30" rows="10" class="form-control form-control-sm"></textarea>
    </div>
  </div>
  <div class="col-8">
    <div class="form-group">
      <small class="text-muted d-block">PARTICIPANTES</small>
      @foreach($Collaborators as $Collaborator)
      <div class="formgroup d-inline-flex" id="List">
        <input type="checkbox" class="m-auto" value="{{ $Collaborator->coFirm.'-'.$Collaborator->coNames.'-'.$Collaborator->perName.'-'.$Collaborator->coNumberdocument.'-'.$Collaborator->coPosition}}">
        <label for="name" class="mb-0 px-1">{{ ucwords($Collaborator->coNames) }} |</label>
      </div>
      @endforeach
    </div>
    <textarea hidden name="DataCollaborators" id="DataCollaborators" cols="30" rows="10"></textarea>
  </div>
</div>
<hr>