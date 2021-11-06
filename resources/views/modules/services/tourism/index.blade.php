@extends('modules.settingServices')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>TURISMO PASAJEROS</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar turismo" class="btn btn-outline-success form-control-sm newTurism-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessTurism'))
      <div class="alert alert-success">
        {{ session('SuccessTurism') }}
      </div>
      @endif
      @if(session('PrimaryTurism'))
      <div class="alert alert-primary">
        {{ session('PrimaryTurism') }}
      </div>
      @endif
      @if(session('WarningTurism'))
      <div class="alert alert-warning">
        {{ session('WarningTurism') }}
      </div>
      @endif
      @if(session('SecondaryTurism'))
      <div class="alert alert-secondary">
        {{ session('SecondaryTurism') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>PRODUCTO</th>
        <th>SERVICIO</th>
        <th>TIEMPO DE DISPONIBILIDAD</th>
        <th>DESCRIPCION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($tourisms as $tourism)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $tourism->ptProduct }}</td>
        <td>{{ $tourism->stService }}</td>
        <td>{{ $tourism->stAvailability }}</td>
        @if(strlen($tourism->stDescription) > 50)
        <td>{{ substr($tourism->stDescription,0,50) . ' ... ' }}</td>
        @else
        <td>{{ $tourism->stDescription }}</td>
        @endif
        <td>
          <a href="#" title="Editar turismo {{ $tourism->stService }}" class="btn btn-outline-primary rounded-circle form-control-sm editTurism-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $tourism->stId }}</span>
            <span hidden>{{ $tourism->stProduct_id }}</span>
            <span hidden>{{ $tourism->stService }}</span>
            <span hidden>{{ $tourism->stAvailability }}</span>
            <span hidden>{{ $tourism->stDescription }}</span>
          </a>
          <a href="#" title="Eliminar turismo {{ $tourism->stService }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteTurism-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $tourism->stId }}</span>
            <span hidden>{{ $tourism->ptProduct }}</span>
            <span hidden>{{ $tourism->stService }}</span>
            <span hidden>{{ $tourism->stAvailability }}</span>
            <span hidden>{{ $tourism->stDescription }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newTurism-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO TURISMO DE SERVICIOS:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('services.tourism.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">TIPO DE PRODUCTO:</small>
                <select name="stProduct_id" class="form-control form-control-sm" required>
                  <option value="">Seleccione un tipo de producto ...</option>
                  @foreach($productstourisms as $productstourism)
                  <option value="{{ $productstourism->ptId }}">{{ $productstourism->ptProduct }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <small class="text-muted">SERVICIO:</small>
                <input type="text" name="stService" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Ruta empresarial" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                <input type="text" name="stAvailability" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 2 Horas" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <textarea name="stDescription" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de entrega express" required></textarea>
              </div>
            </div>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-success form-control-sm">GUARDAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editTurism-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR TURISMO DE SERVICIOS:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('services.tourism.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">TIPO DE PRODUCTO:</small>
                <select name="stProduct_id_Edit" class="form-control form-control-sm" required>
                  <option value="">Seleccione un tipo de producto ...</option>
                  @foreach($productstourisms as $productstourism)
                  <option value="{{ $productstourism->ptId }}">{{ $productstourism->ptProduct }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <small class="text-muted">SERVICIO:</small>
                <input type="text" name="stService_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Ruta empresarial" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                <input type="text" name="stAvailability_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 2 Horas" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <textarea name="stDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de entrega express" required></textarea>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="stId_Edit" value="" required>
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

<div class="modal fade" id="deleteTurism-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE TURISMO DE SERVICIOS:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">TIPO DE PRODUCTO: </small><br>
            <span class="text-muted"><b class="stProduct_id_Delete"></b></span><br>
            <small class="text-muted">SERVICIO: </small><br>
            <span class="text-muted"><b class="stService_Delete"></b></span><br>
            <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
            <span class="text-muted"><b class="stAvailability_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION: </small><br>
            <span class="text-muted"><b class="stDescription_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('services.tourism.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="stId_Delete" value="" required>
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

  $('.newTurism-link').on('click', function() {
    $('#newTurism-modal').modal();
  });

  $('.editTurism-link').on('click', function(e) {
    e.preventDefault();
    var stId = $(this).find('span:nth-child(2)').text();
    var stProduct_id = $(this).find('span:nth-child(3)').text();
    var stService = $(this).find('span:nth-child(4)').text();
    var stAvailability = $(this).find('span:nth-child(5)').text();
    var stDescription = $(this).find('span:nth-child(6)').text();
    $('input[name=stId_Edit]').val(stId);
    $('select[name=stProduct_id_Edit]').val(stProduct_id);
    $('input[name=stService_Edit]').val(stService);
    $('input[name=stAvailability_Edit]').val(stAvailability);
    $('textarea[name=stDescription_Edit]').val(stDescription);
    $('#editTurism-modal').modal();
  });

  $('.deleteTurism-link').on('click', function(e) {
    e.preventDefault();
    var stId = $(this).find('span:nth-child(2)').text();
    var stProduct_id = $(this).find('span:nth-child(3)').text();
    var stService = $(this).find('span:nth-child(4)').text();
    var stAvailability = $(this).find('span:nth-child(5)').text();
    var stDescription = $(this).find('span:nth-child(6)').text();
    $('input[name=stId_Delete]').val(stId);
    $('.stProduct_id_Delete').text(stProduct_id);
    $('.stService_Delete').text(stService);
    $('.stAvailability_Delete').text(stAvailability);
    $('.stDescription_Delete').text(stDescription);
    $('#deleteTurism-modal').modal();
  });
</script>
@endsection