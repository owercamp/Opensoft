@extends('modules.settingServices')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>LOGISTICA EXPRESS</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar logística" class="btn btn-outline-success form-control-sm newLogistic-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessLogistics'))
      <div class="alert alert-success">
        {{ session('SuccessLogistics') }}
      </div>
      @endif
      @if(session('PrimaryLogistics'))
      <div class="alert alert-primary">
        {{ session('PrimaryLogistics') }}
      </div>
      @endif
      @if(session('WarningLogistics'))
      <div class="alert alert-warning">
        {{ session('WarningLogistics') }}
      </div>
      @endif
      @if(session('SecondaryLogistics'))
      <div class="alert alert-secondary">
        {{ session('SecondaryLogistics') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>TIPO DE PRODUCTO</th>
        <th>SERVICIO</th>
        <th>TIEMPO DE DISPONIBILIDAD</th>
        <th>DESCRIPCION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($logistics as $logistic)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $logistic->plProduct }}</td>
        <td>{{ $logistic->slService }}</td>
        <td>{{ $logistic->slAvailability }}</td>
        @if(strlen($logistic->slDescription) > 50)
        <td>{{ substr($logistic->slDescription,0,50) . ' ... ' }}</td>
        @else
        <td>{{ $logistic->slDescription }}</td>
        @endif
        <td>
          <a href="#" title="Editar logística {{ $logistic->slService }}" class="btn btn-outline-primary rounded-circle form-control-sm editLogistic-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $logistic->slId }}</span>
            <span hidden>{{ $logistic->slProduct_id }}</span>
            <span hidden>{{ $logistic->slService }}</span>
            <span hidden>{{ $logistic->slAvailability }}</span>
            <span hidden>{{ $logistic->slDescription }}</span>
          </a>
          <a href="#" title="Eliminar logística {{ $logistic->slService }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteLogistic-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $logistic->slId }}</span>
            <span hidden>{{ $logistic->plProduct }}</span>
            <span hidden>{{ $logistic->slService }}</span>
            <span hidden>{{ $logistic->slAvailability }}</span>
            <span hidden>{{ $logistic->slDescription }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newLogistic-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA LOGISTICA DE SERVICIOS:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('services.logistic.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">TIPO DE PRODUCTO:</small>
                <select name="slProduct_id" class="form-control form-control-sm" required>
                  <option value="">Seleccione un tipo de producto ...</option>
                  @foreach($productslogistics as $productslogistic)
                  <option value="{{ $productslogistic->plId }}">{{ $productslogistic->plProduct }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <small class="text-muted">SERVICIO:</small>
                <input type="text" name="slService" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Ruta empresarial" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                <input type="text" name="slAvailability" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 2 Horas" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <textarea name="slDescription" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de entrega express" required></textarea>
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

<div class="modal fade" id="editLogistic-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR LOGISTICA DE SERVICIOS:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('services.logistic.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">TIPO DE PRODUCTO:</small>
                <select name="slProduct_id_Edit" class="form-control form-control-sm" required>
                  <option value="">Seleccione un tipo de producto ...</option>
                  @foreach($productslogistics as $productslogistic)
                  <option value="{{ $productslogistic->plId }}">{{ $productslogistic->plProduct }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <small class="text-muted">SERVICIO:</small>
                <input type="text" name="slService_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Ruta empresarial" required>
              </div>
              <div class="form-group">
                <small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
                <input type="text" name="slAvailability_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 2 Horas" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <textarea name="slDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de entrega express" required></textarea>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="slId_Edit" value="" required>
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

<div class="modal fade" id="deleteLogistic-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE LOGISTICA DE SERVICIOS:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">TIPO DE PRODUCTO: </small><br>
            <span class="text-muted"><b class="slProduct_id_Delete"></b></span><br>
            <small class="text-muted">SERVICIO: </small><br>
            <span class="text-muted"><b class="slService_Delete"></b></span><br>
            <small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
            <span class="text-muted"><b class="slAvailability_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION: </small><br>
            <span class="text-muted"><b class="slDescription_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('services.logistic.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="slId_Delete" value="" required>
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

  $('.newLogistic-link').on('click', function() {
    $('#newLogistic-modal').modal();
  });

  $('.editLogistic-link').on('click', function(e) {
    e.preventDefault();
    var slId = $(this).find('span:nth-child(2)').text();
    var slProduct_id = $(this).find('span:nth-child(3)').text();
    var slService = $(this).find('span:nth-child(4)').text();
    var slAvailability = $(this).find('span:nth-child(5)').text();
    var slDescription = $(this).find('span:nth-child(6)').text();
    $('input[name=slId_Edit]').val(slId);
    $('select[name=slProduct_id_Edit]').val(slProduct_id);
    $('input[name=slService_Edit]').val(slService);
    $('input[name=slAvailability_Edit]').val(slAvailability);
    $('textarea[name=slDescription_Edit]').val(slDescription);
    $('#editLogistic-modal').modal();
  });

  $('.deleteLogistic-link').on('click', function(e) {
    e.preventDefault();
    var slId = $(this).find('span:nth-child(2)').text();
    var plProduct = $(this).find('span:nth-child(3)').text();
    var slService = $(this).find('span:nth-child(4)').text();
    var slAvailability = $(this).find('span:nth-child(5)').text();
    var slDescription = $(this).find('span:nth-child(6)').text();
    $('input[name=slId_Delete]').val(slId);
    $('.slProduct_id_Delete').text(plProduct);
    $('.slService_Delete').text(slService);
    $('.slAvailability_Delete').text(slAvailability);
    $('.slDescription_Delete').text(slDescription);
    $('#deleteLogistic-modal').modal();
  });
</script>
@endsection