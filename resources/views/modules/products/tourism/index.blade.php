@extends('modules.settingProducts')

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
        <td>{{ $tourism->ptAvailability }}</td>
        @if(strlen($tourism->ptDescription) > 50)
        <td>{{ substr($tourism->ptDescription,0,50) . ' ... ' }}</td>
        @else
        <td>{{ $tourism->ptDescription }}</td>
        @endif
        <td>
          <a href="#" title="Editar turismo {{ $tourism->ptProduct }}" class="btn btn-outline-primary rounded-circle form-control-sm editTurism-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $tourism->ptId }}</span>
            <span hidden>{{ $tourism->ptProduct }}</span>
            <span hidden>{{ $tourism->ptAvailability }}</span>
            <span hidden>{{ $tourism->ptDescription }}</span>
          </a>
          <a href="#" title="Eliminar turismo {{ $tourism->ptProduct }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteTurism-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $tourism->ptId }}</span>
            <span hidden>{{ $tourism->ptProduct }}</span>
            <span hidden>{{ $tourism->ptAvailability }}</span>
            <span hidden>{{ $tourism->ptDescription }}</span>
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
        <h4>NUEVO TURISMO DE PRODUCTO:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('products.tourism.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">PRODUCTO:</small>
                <input type="text" name="ptProduct" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Paseo minas de sal zipaquirá" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                <input type="text" name="ptAvailability" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 6 Horas" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <textarea name="ptDescription" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de extrega express" required></textarea>
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
        <h5>EDITAR TURISMO DE PRODUCTO:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('products.tourism.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">PRODUCTO:</small>
                <input type="text" name="ptProduct_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Paseo minas de sal zipaquirá" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                <input type="text" name="ptAvailability_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 6 Horas" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <textarea name="ptDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de extrega express" required></textarea>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="ptId_Edit" value="" required>
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
        <h5>ELIMINACION DE TURISMO DE PRODUCTO:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">PRODUCTO: </small><br>
            <span class="text-muted"><b class="ptProduct_Delete"></b></span><br>
            <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
            <span class="text-muted"><b class="ptAvailability_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION: </small><br>
            <span class="text-muted"><b class="ptDescription_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('products.tourism.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="ptId_Delete" value="" required>
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
    var ptId = $(this).find('span:nth-child(2)').text();
    var ptProduct = $(this).find('span:nth-child(3)').text();
    var ptAvailability = $(this).find('span:nth-child(4)').text();
    var ptDescription = $(this).find('span:nth-child(5)').text();
    $('input[name=ptId_Edit]').val(ptId);
    $('input[name=ptProduct_Edit]').val(ptProduct);
    $('input[name=ptAvailability_Edit]').val(ptAvailability);
    $('textarea[name=ptDescription_Edit]').val(ptDescription);
    $('#editTurism-modal').modal();
  });

  $('.deleteTurism-link').on('click', function(e) {
    e.preventDefault();
    var ptId = $(this).find('span:nth-child(2)').text();
    var ptProduct = $(this).find('span:nth-child(3)').text();
    var ptAvailability = $(this).find('span:nth-child(4)').text();
    var ptDescription = $(this).find('span:nth-child(5)').text();
    $('input[name=ptId_Delete]').val(ptId);
    $('.ptProduct_Delete').text(ptProduct);
    $('.ptAvailability_Delete').text(ptAvailability);
    $('.ptDescription_Delete').text(ptDescription);
    $('#deleteTurism-modal').modal();
  });
</script>
@endsection