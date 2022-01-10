@extends('modules.archive')

@section('space')
<div class="container-fluid">
  <h6>MATRIZ EPP</h6>
  @include('partials.alerts')
  <div class="contaider fluid">
    <div class="w-100 justify-content-around d-flex">
      <button class="btn btn-outline-primary btn-navbar" id="Create">{{ucwords('crear analisis de matriz')}}</button>
      <form action="{{route('PDFepp')}}" method="post">
        @csrf
        <button class="btn btn-outline-danger btn-docs" id="PDF">{{ucwords('PDF analisis de matriz')}}</button>
      </form>
    </div>
    <hr>
    <table id="tableDatatable" class="table table-striped w-100 text-center">
      <thead>
        <tr>
          <th class="align-middle">{{ucwords('documento')}}</th>
          <th class="align-middle">{{ucwords('elemento de protección')}}</th>
          <th class="align-middle">{{ucwords('norma')}}</th>
          <th class="align-middle">{{ucwords('observaciones')}}</th>
          <th class="align-middle">{{ucwords('acciones')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($epps as $epp)
        <tr>
          <td>{{$epp->domName}}</td>
          <td>{{$epp->meEPP}}</td>
          <td>{{$epp->meNor}}</td>
          <td>{{$epp->meObs}}</td>
          <td>

            <button class="btn btn-outline-success rounded-circle editMatrixEPP"><i class="fas fa-pen-nib"></i><span hidden>{{$epp->me_id}}</span><span hidden>{{asset('storage/MatrixEPP')."/".$epp->meFil}}</span></button>
            <button class="btn btn-outline-secondary rounded-circle deleteMatrixEPP"><i class="fas fa-trash-alt"></i><span hidden>{{$epp->me_id}}</span><span hidden>{{asset('storage/MatrixEPP')."/".$epp->meFil}}</span></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- formulario de creación -->
<div class="modal fade" id="createEppMatrix">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('creación matriz EPP')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1 dismiss" data-dismiss="modal">&gacute;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('matriz.save')}}" method="post" enctype="multipart/form-data">
          @include('modules.document.partial.formEPP')
          <div class="col-lg-12 row justify-content-around">
            <div class="col-lg-6">
              <div class="form-group">
                <small class="text-muted">{{ucwords('Imagen EPP')}}</small>
                <input type="file" name="meFil" class="img-fluid" accept=".jpg" required>
              </div>
            </div>
          </div>
          <hr>
          <div class="d-flex justify-content-center w-100">
            <button class="btn btn-outline-success">{{ucwords('guardar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formulario de edición -->
<div class="modal fade" id="editEppMatrix">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('edición matriz EPP')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1 dismiss" data-dismiss="modal">&gacute;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('matriz.update')}}" method="post" enctype="multipart/form-data">
          @method('PATCH')
          @include('modules.document.partial.formEPP')
          <div class="col-lg-12 row justify-content-around">
            <div class="col-lg-6">
              <div class="form-group">
                <small class="text-muted">{{ucwords('Imagen EPP')}}</small>
                <input type="file" name="meFil" class="img-fluid" accept=".jpg" required>
              </div>
            </div>
          </div>
          <input type="hidden" name="matrixIdUpdate">
          <div class="col-lg-12 row justify-content-center">
            <div class="col-lg-3">
              <div class="form-group">
                <small class="text-muted">{{ucwords('imagen actual')}}</small>
                <img id="editEPP" src="" alt="Imagen Actual" height="150" width="150" class="img-thumbnail">
              </div>
            </div>
          </div>
          <hr>
          <div class="d-flex justify-content-around w-100">
            <button class="btn btn-outline-success">{{ucwords('actualizar')}}</button>
            <button type="button" class="btn btn-dark dismiss" data-dismiss="modal">{{ucwords('cancelar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formulario de eliminación -->
<div class="modal fade" id="deleteEppMatrix">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('eliminación matriz EPP')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1 dismiss" data-dismiss="modal">&gacute;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('matriz.delete')}}" method="post">
          @method('DELETE')
          @include('modules.document.partial.formEPP')
          <input type="hidden" name="matrixIdDelete">
          <div class="col-lg-12 row justify-content-center">
            <div class="col-lg-3">
              <div class="form-group">
                <small class="text-muted">{{ucwords('imagen actual')}}</small>
                <img id="deleteEPP" src="" alt="Imagen Actual" height="150" width="150" class="img-thumbnail">
              </div>
            </div>
          </div>
          <hr>
          <div class="d-flex justify-content-around w-100">
            <button class="btn btn-outline-danger">{{ucwords('eliminar')}}</button>
            <button type="button" class="btn btn-dark dismiss" data-dismiss="modal">{{ucwords('cancelar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  // ?lanzador del formulario de eliminación "FORM"
  $('.deleteMatrixEPP').click(function() {
    // *ruta de mis imagenes de Matrix EPP
    const id = $(this).find("span:nth-child(2)").text(),
      img = $(this).find("span:nth-child(3)").text();
    $.ajax({
      "_token": "{{csrf_token()}}",
      dataType: "JSON",
      type: "POST",
      url: "{{route('apiMatrix')}}",
      data: {
        id: id
      },
      success(res) {
        $('select[name=meDoc]').val(res[0]['meDoc']);
        $('input[name=meEPP]').val(res[0]['meEPP']);
        $('input[name=meDes]').val(res[0]['meDes']);
        $('input[name=meNor]').val(res[0]['meNor']);
        $('input[name=meObs]').val(res[0]['meObs']);
        $('input[name=matrixIdDelete]').val(res[0]['me_id']);
        $("#deleteEPP").attr("src", img);
        $("input[name=meFil]").removeAttr("required");
      },
      complete() {
        $('select[name=meDoc]').prop("disabled", true);
        $('input[name=meEPP]').prop("disabled", true);
        $('input[name=meDes]').prop("disabled", true);
        $('input[name=meNor]').prop("disabled", true);
        $('input[name=meObs]').prop("disabled", true);
        $('#deleteEppMatrix').modal();
      }
    })
  });

  // ?lanzador del formulario de edición "FORM"
  $('.editMatrixEPP').click(function() {
    // *ruta de mis imagenes de Matrix EPP
    const id = $(this).find("span:nth-child(2)").text(),
      img = $(this).find("span:nth-child(3)").text();
    $.ajax({
      "_token": "{{csrf_token()}}",
      dataType: "JSON",
      type: "POST",
      url: "{{route('apiMatrix')}}",
      data: {
        id: id
      },
      success(res) {
        $('select[name=meDoc]').prop("disabled", false);
        $('input[name=meEPP]').prop("disabled", false);
        $('input[name=meDes]').prop("disabled", false);
        $('input[name=meNor]').prop("disabled", false);
        $('input[name=meObs]').prop("disabled", false);
        $('select[name=meDoc]').val(res[0]['meDoc']);
        $('input[name=meEPP]').val(res[0]['meEPP']);
        $('input[name=meDes]').val(res[0]['meDes']);
        $('input[name=meNor]').val(res[0]['meNor']);
        $('input[name=meObs]').val(res[0]['meObs']);
        $('input[name=matrixIdUpdate]').val(res[0]['me_id']);
        $("#editEPP").attr("src", img);
        $("input[name=meFil]").removeAttr("required");
      },
      complete() {
        $('#editEppMatrix').modal();
      }
    })
  });

  // *lanzador del formulario de creación "FORM"
  $("#Create").click(() => {
    $('select[name=meDoc]').prop("disabled", false);
    $('input[name=meEPP]').prop("disabled", false);
    $('input[name=meDes]').prop("disabled", false);
    $('input[name=meNor]').prop("disabled", false);
    $('input[name=meObs]').prop("disabled", false);
    $('#createEppMatrix').modal();
  });

  // *clear form
  $('.dismiss').click(() => {
    $('select[name=meDoc]').val("");
    $('input[name=meDes]').val("");
    $('input[name=meNor]').val("");
    $('input[name=meObs]').val("");
  });
</script>
@endsection