@extends('modules.settingVehicles')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>CARGA</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar una carga" class="btn btn-outline-success form-control-sm newHeavy-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessHeavys'))
      <div class="alert alert-success">
        {{ session('SuccessHeavys') }}
      </div>
      @endif
      @if(session('PrimaryHeavys'))
      <div class="alert alert-primary">
        {{ session('PrimaryHeavys') }}
      </div>
      @endif
      @if(session('WarningHeavys'))
      <div class="alert alert-warning">
        {{ session('WarningHeavys') }}
      </div>
      @endif
      @if(session('SecondaryHeavys'))
      <div class="alert alert-secondary">
        {{ session('SecondaryHeavys') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>TIPOLOGIA</th>
        <th>CILINDRAJE</th>
        <th>CAPACIDAD</th>
        <th>DESCRIPCION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($heavys as $heavy)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $heavy->heaTypology }}</td>
        <td>{{ $heavy->heaDisplacement }}</td>
        <td>{{ $heavy->heaCapacity }}</td>
        <td>{{ $heavy->heaDescription }}</td>
        <td>
          <a href="#" title="Editar carga {{ $heavy->heaTypology }}" class="btn btn-outline-primary rounded-circle form-control-sm editHeavy-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $heavy->heaId }}</span>
            <span hidden>{{ $heavy->heaTypology }}</span>
            <span hidden>{{ $heavy->heaDisplacement }}</span>
            <span hidden>{{ $heavy->heaCapacity }}</span>
            <span hidden>{{ $heavy->heaDescription }}</span>
          </a>
          <a href="#" title="Eliminar carga {{ $heavy->heaTypology }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteHeavy-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $heavy->heaId }}</span>
            <span hidden>{{ $heavy->heaTypology }}</span>
            <span hidden>{{ $heavy->heaDisplacement }}</span>
            <span hidden>{{ $heavy->heaCapacity }}</span>
            <span hidden>{{ $heavy->heaDescription }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newHeavy-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVA CARGA:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('heavys.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">TIPOLOGIA:</small>
                    <input type="text" name="heaTypology" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CILINDRAJE:</small>
                    <input type="text" name="heaDisplacement" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CAPACIDAD:</small>
                    <input type="text" name="heaCapacity" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DESCRIPCION:</small>
                    <input type="text" name="heaDescription" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
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

<div class="modal fade" id="editHeavy-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR CARGA:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('heavys.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">TIPOLOGIA:</small>
                    <input type="text" name="heaTypology_Edit" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CILINDRAJE:</small>
                    <input type="text" name="heaDisplacement_Edit" maxlength="5" pattern="[0-9]{1,5}" class="form-control form-control-sm" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <small class="text-muted">CAPACIDAD:</small>
                    <input type="text" name="heaCapacity_Edit" maxlength="50" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <small class="text-muted">DESCRIPCION:</small>
                    <input type="text" name="heaDescription_Edit" maxlength="100" class="form-control form-control-sm" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="heaId_Edit" value="" required>
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

<div class="modal fade" id="deleteHeavy-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE CARGA:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">TIPOLOGIA: </small><br>
            <span class="text-muted"><b class="heaTypology_Delete"></b></span><br>
            <small class="text-muted">CILINDRAJE: </small><br>
            <span class="text-muted"><b class="heaDisplacement_Delete"></b></span><br>
            <small class="text-muted">CAPACIDAD: </small><br>
            <span class="text-muted"><b class="heaCapacity_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION: </small><br>
            <span class="text-muted"><b class="heaDescription_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('heavys.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="heaId_Delete" value="" required>
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

  $('.newHeavy-link').on('click', function() {
    $('#newHeavy-modal').modal();
  });

  $('.editHeavy-link').on('click', function(e) {
    e.preventDefault();
    var heaId = $(this).find('span:nth-child(2)').text();
    var heaTypology = $(this).find('span:nth-child(3)').text();
    var heaDisplacement = $(this).find('span:nth-child(4)').text();
    var heaCapacity = $(this).find('span:nth-child(5)').text();
    var heaDescription = $(this).find('span:nth-child(6)').text();
    $('input[name=heaId_Edit]').val(heaId);
    $('input[name=heaTypology_Edit]').val(heaTypology);
    $('input[name=heaDisplacement_Edit]').val(heaDisplacement);
    $('input[name=heaCapacity_Edit]').val(heaCapacity);
    $('input[name=heaDescription_Edit]').val(heaDescription);
    $('#editHeavy-modal').modal();
  });

  $('.deleteHeavy-link').on('click', function(e) {
    e.preventDefault();
    var heaId = $(this).find('span:nth-child(2)').text();
    var heaTypology = $(this).find('span:nth-child(3)').text();
    var heaDisplacement = $(this).find('span:nth-child(4)').text();
    var heaCapacity = $(this).find('span:nth-child(5)').text();
    var heaDescription = $(this).find('span:nth-child(6)').text();
    $('input[name=heaId_Delete]').val(heaId);
    $('.heaTypology_Delete').text(heaTypology);
    $('.heaDisplacement_Delete').text(heaDisplacement);
    $('.heaCapacity_Delete').text(heaCapacity);
    $('.heaDescription_Delete').text(heaDescription);
    $('#deleteHeavy-modal').modal();
  });
</script>
@endsection