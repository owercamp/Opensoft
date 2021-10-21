@extends('modules.archive')

@section('space')
<div class="container-fluid">
  <h6>MATRIZ LEGAL</h6>
  @include('partials.alerts')
  <div class="container-fluid">
    <div class="w-100 justify-content-center d-flex">
      <button class="btn btn-outline-primary btn-navbar" id="Create">{{ucwords('crear matriz legal')}}</button>
    </div>
    <hr>
    <table id="tableDatatable" class="w-100 table table-bordered table-striped text-center" style="font-size: 0.45cm">
      <thead>
        <tr>
          <th>{{ucwords('documento')}}</th>
          <th>{{ucwords('titulo')}}</th>
          <th>{{ucwords('articulo')}}</th>
          <th>{{ucwords('año')}}</th>
          <th>{{ucwords('Colaborador')}}</th>
          <th>{{ucwords('acciones')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($legals as $legal)
        <tr>
          <td class="align-middle">{{$legal->lp_typeDoc}}</td>
          <td class="align-middle">{{$legal->lp_title}}</td>
          <td class="align-middle">{{$legal->lp_article}}</td>
          <td class="align-middle">{{$legal->lp_year}}</td>
          <td class="align-middle">{{ucwords($legal->coNames)}}</td>
          <td>
            <button class="btn btn-secondary editLegalParent"><i class="far fa-keyboard"></i><span hidden>{{$legal->lp_id}}</span></button>
            <button class="btn btn-dark deleteLegalParent"><i class="fas fa-eraser"></i><span hidden>{{$legal->lp_id}}</span></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- formularo de creación -->
<div class="fade modal" id="createLegalParent">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('creación matriz legal')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1" data-dismiss="modal">&because;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('legal.save')}}" method="post">
          @include('modules.document.partial.formLegal')
          <hr>
          <div class="d-flex justify-content-center w-100">
            <button class="btn btn-success">{{ucwords('guardar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formulario de edición -->
<div class="fade modal" id="editLegalParent">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('edición matriz legal')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1" data-dismiss="modal">&bemptyv;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('legal.update')}}" method="post">
          @method("PATCH")
          @include('modules.document.partial.formLegal')
          <input type="hidden" name="legalIdUpdate">
          <hr>
          <div class="d-flex justify-content-around w-100">
            <button class="btn btn-success">{{ucwords('actualizar')}}</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">{{ucwords('cancelar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formulario de eliminación -->
<div class="fade modal" id="deleteLegalParent">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('eliminación matriz legal')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1" data-dismiss="modal">&bemptyv;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('legal.destroy')}}" method="post">
          @method("DELETE")
          @include('modules.document.partial.formLegal')
          <input type="hidden" name="legalIdDelete">
          <hr>
          <div class="d-flex justify-content-around w-100">
            <button class="btn btn-danger">{{ucwords('eliminar')}}</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">{{ucwords('cancelar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  // ?edita el registro de matriz legal seleccionado
  $('.editLegalParent').click(() => {
    const id = $('.editLegalParent').find('span:nth-child(2)').text();
    $.ajax({
      "_token": "{{csrf_token()}}",
      type: "POST",
      dataType: "JSON",
      url: "{{route('apiLegal')}}",
      data: {
        data: id
      },
      success(response) {
        $('select[name=mlDoc]').val(response[0]['lp_typeDoc']);
        $('input[name=mlNum]').val(response[0]['lp_Num']);
        $('select[name=mlYear]').val(response[0]['lp_year']);
        $('input[name=mltitle]').val(response[0]['lp_title']);
        $('input[name=mlArticle]').val(response[0]['lp_article']);
        $('input[name=mlDescription]').val(response[0]['lp_description']);
        $('input[name=mlArea]').val(response[0]['lp_area']);
        $('input[name=mlEvidence]').val(response[0]['lp_evidence']);
        $('select[name=mlCollaborator]').val(response[0]['lp_collaborator']);
        $('select[name=mlMeet]').val(response[0]['lp_meet']);
        $('input[name=legalIdUpdate]').val(response[0]['lp_id']);
      },
      complete() {
        $('#editLegalParent').modal();
      }
    })
  });

  // !elimina el registro seleccionado de la matriz legal
  $('.deleteLegalParent').click(() => {
    const id = $('.editLegalParent').find('span:nth-child(2)').text();
    $.ajax({
      "_token": "{{csrf_token()}}",
      type: "POST",
      dataType: "JSON",
      url: "{{route('apiLegal')}}",
      data: {
        data: id
      },
      success(response) {
        $('select[name=mlDoc]').val(response[0]['lp_typeDoc']);
        $('input[name=mlNum]').val(response[0]['lp_Num']);
        $('select[name=mlYear]').val(response[0]['lp_year']);
        $('input[name=mltitle]').val(response[0]['lp_title']);
        $('input[name=mlArticle]').val(response[0]['lp_article']);
        $('input[name=mlDescription]').val(response[0]['lp_description']);
        $('input[name=mlArea]').val(response[0]['lp_area']);
        $('input[name=mlEvidence]').val(response[0]['lp_evidence']);
        $('select[name=mlCollaborator]').val(response[0]['lp_collaborator']);
        $('select[name=mlMeet]').val(response[0]['lp_meet']);
        $('input[name=legalIdDelete]').val(response[0]['lp_id']);
      },
      complete() {
        $('select[name=mlDoc]').prop("disabled", true);
        $('input[name=mlNum]').prop("disabled", true);
        $('select[name=mlYear]').prop("disabled", true);
        $('input[name=mltitle]').prop("disabled", true);
        $('input[name=mlArticle]').prop("disabled", true);
        $('input[name=mlDescription]').prop("disabled", true);
        $('input[name=mlArea]').prop("disabled", true);
        $('input[name=mlEvidence]').prop("disabled", true);
        $('select[name=mlCollaborator]').prop("disabled", true);
        $('select[name=mlMeet]').prop("disabled", true);
        $('#deleteLegalParent').modal();
      }
    })
  });

  // *muestra el modal del creación de matriz legal
  $('#Create').click(() => {
    $("#createLegalParent").modal();
  });

  // *realiza la carga de los años desde 1960 hasta el año actual
  const year = () => {
    const now = new Date();
    const year = now.getFullYear();
    $('select[name=mlYear]').empty();
    $('select[name=mlYear]').append(`<option value="">Seleccione...</option>`);
    for (let index = 1960; index <= year; index++) {
      $('select[name=mlYear]').append(`<option value="${index}">${index}</option>`);
    }
  }
  year();
</script>
@endsection