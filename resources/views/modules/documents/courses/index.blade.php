@extends('modules.settingDocuments')

@section('space')
<div class="col-md-12 p-3">
  <div class="row border-bottom mb-3">
    <div class="col-md-4">
      <h5>CURSOS CERTIFICADOS</h5>
    </div>
    <div class="col-md-4">
      <button type="button" title="Registrar un curso" class="btn btn-outline-success form-control-sm newCourse-link">NUEVO</button>
    </div>
    <div class="col-md-4">
      @if(session('SuccessCourses'))
      <div class="alert alert-success">
        {{ session('SuccessCourses') }}
      </div>
      @endif
      @if(session('PrimaryCourses'))
      <div class="alert alert-primary">
        {{ session('PrimaryCourses') }}
      </div>
      @endif
      @if(session('WarningCourses'))
      <div class="alert alert-warning">
        {{ session('WarningCourses') }}
      </div>
      @endif
      @if(session('SecondaryCourses'))
      <div class="alert alert-secondary">
        {{ session('SecondaryCourses') }}
      </div>
      @endif
    </div>
  </div>
  <table id="tableDatatable" class="table table-hover text-center" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>CURSO</th>
        <th>INTENSIDAD HORARIA</th>
        <th>DESCRIPCION</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($courses as $course)
      <tr>
        <td>{{ $row++ }}</td>
        <td>{{ $course->couName }}</td>
        <td>{{ $course->couIntensity }}</td>
        <td>{{ $course->couDescription }}</td>
        <td>
          <a href="#" title="Editar curso {{ $course->couName }}" class="btn btn-outline-primary rounded-circle form-control-sm editCourse-link">
            <i class="fas fa-edit"></i>
            <span hidden>{{ $course->couId }}</span>
            <span hidden>{{ $course->couName }}</span>
            <span hidden>{{ $course->couIntensity }}</span>
            <span hidden>{{ $course->couDescription }}</span>
          </a>
          <a href="#" title="Eliminar curso {{ $course->couName }}" class="btn btn-outline-tertiary rounded-circle form-control-sm deleteCourse-link">
            <i class="fas fa-trash-alt"></i>
            <span hidden>{{ $course->couId }}</span>
            <span hidden>{{ $course->couName }}</span>
            <span hidden>{{ $course->couIntensity }}</span>
            <span hidden>{{ $course->couDescription }}</span>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="newCourse-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4>NUEVO CURSO CERTIFICADO:</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('course.save') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">CURSO:</small>
                <input type="text" name="couName" maxlength="50" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">INTENSIDAD HORARIA:</small>
                <input type="text" name="couIntensity" maxlength="50" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <input type="text" name="couDescription" maxlength="100" class="form-control form-control-sm" required>
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

<div class="modal fade" id="editCourse-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>EDITAR CURSO CERTIFICADO:</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('course.update') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <small class="text-muted">CURSO:</small>
                <input type="text" name="couName_Edit" maxlength="50" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">INTENSIDAD HORARIA:</small>
                <input type="text" name="couIntensity_Edit" maxlength="50" class="form-control form-control-sm" required>
              </div>
              <div class="form-group">
                <small class="text-muted">DESCRIPCION:</small>
                <input type="text" name="couDescription_Edit" maxlength="100" class="form-control form-control-sm" required>
              </div>
            </div>
          </div>
          <div class="row border-top mt-3 text-center">
            <div class="col-md-6">
              <input type="hidden" class="form-control form-control-sm" name="couId_Edit" value="" required>
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

<div class="modal fade" id="deleteCourse-modal">
  <div class="modal-dialog" style="font-size: 12px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5>ELIMINACION DE CURSO CERTIFICADO:</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <small class="text-muted">CURSO: </small><br>
            <span class="text-muted"><b class="couName_Delete"></b></span><br>
            <small class="text-muted">INTENSIDAD HORARIA: </small><br>
            <span class="text-muted"><b class="couIntensity_Delete"></b></span><br>
            <small class="text-muted">DESCRIPCION: </small><br>
            <span class="text-muted"><b class="couDescription_Delete"></b></span><br>
          </div>
        </div>
        <div class="row mt-3 border-top text-center">
          <form action="{{ route('course.delete') }}" method="POST" class="col-md-6">
            @csrf
            <input type="hidden" class="form-control form-control-sm" name="couId_Delete" value="" required>
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

  $('.newCourse-link').on('click', function() {
    $('#newCourse-modal').modal();
  });

  $('.editCourse-link').on('click', function(e) {
    e.preventDefault();
    var couId = $(this).find('span:nth-child(2)').text();
    var couName = $(this).find('span:nth-child(3)').text();
    var couIntensity = $(this).find('span:nth-child(4)').text();
    var couDescription = $(this).find('span:nth-child(5)').text();
    $('input[name=couId_Edit]').val(couId);
    $('input[name=couName_Edit]').val(couName);
    $('input[name=couIntensity_Edit]').val(couIntensity);
    $('input[name=couDescription_Edit]').val(couDescription);
    $('#editCourse-modal').modal();
  });

  $('.deleteCourse-link').on('click', function(e) {
    e.preventDefault();
    var couId = $(this).find('span:nth-child(2)').text();
    var couName = $(this).find('span:nth-child(3)').text();
    var couIntensity = $(this).find('span:nth-child(4)').text();
    var couDescription = $(this).find('span:nth-child(5)').text();
    $('input[name=couId_Delete]').val(couId);
    $('.couName_Delete').text(couName);
    $('.couIntensity_Delete').text(couIntensity);
    $('.couDescription_Delete').text(couDescription);
    $('#deleteCourse-modal').modal();
  });
</script>
@endsection