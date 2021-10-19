@extends('modules.logisticPrograms')

@section('space')
<div>
  <h5>ARCHIVO PROCEDIMIENTOS DE ATENCION DE USUARIOS</h5>
</div>
@include('partials.alerts')
<div class="container">
  <table id="tableDatatable" class="table table-bordered table-striped text-center w-100">
    <thead>
      <th>N°</th>
      <th>DOCUMENTO</th>
      <th>CONTENIDO</th>
      <th>ACCIONES</th>
    </thead>
    <tbody>
      @php
      $row = 1;
      @endphp
      @foreach ($all as $item)
      <tr>
        <td class="align-middle">{{$row++}}</td>
        <td class="align-middle">{{$item->dolName}}</td>
        <td class="align-middle">{{substr($item->usp_content,0,70).'...'}}</td>
        <td>
          <button class="btn btn-outline-primary showEdit"><i class="fas fa-edit"></i><span hidden aria-hidden="true">{{$item->usp_id}}</span></button>
          <button class="btn btn-outline-danger mx-2 Delete-register"><i class="fas fa-eraser"></i><span hidden aria-hidden="true">{{$item->usp_id}}</span><span hidden aria-hidden="true">{{$row-1}}</span></button>
          <button class="btn btn-outline-secondary PDF-programs"><i class="far fa-file-pdf"></i><span hidden aria-hidden="true">{{$item->usp_id}}</span></button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="formEdit">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5> EDICION PROCEDIMIENTOS DE ATENCION DE USUARIOS</h5>
        <button class="btn-close btn btn-dark btn-sm" data-dismiss="modal">&xmap;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('update.procedures')}}" method="post">
          @csrf @method('PATCH')
          @include('modules.programs.partials.programs')
          <input type="hidden" name="idhidden">
          <div class="d-flex justify-content-around">
            <button class="btn btn-primary px-auto" id="btn-save">ACTUALIZAR</button>
            <button class="btn btn-secondary px-auto" data-dismiss="modal">CANCELAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<form action="{{route('delete.procedures')}}" method="post" id="formDelete" hidden aria-hidden="true">
  @csrf @method('DELETE')
  <input type="text" name="idDelete">
</form>

<form action="{{route('procedures.pdf')}}" method="post" hidden aria-hidden="true" id="formPDF">
  @csrf
  <input type="text" name="pdf">
</form>
@endsection

@section('scripts')
<script>
  $('.PDF-programs').click(function() {
    let id = $(this).find('span:nth-child(2)').text();
    $('input[name=pdf]').val(id);
    $('#formPDF').submit();
  });

  $('.Delete-register').click(function() {
    let num = $(this).find('span:nth-child(2)').text();
    let registerNum = $(this).find('span:nth-child(3)').text();
    Swal.fire({
      icon: 'question',
      title: 'Eliminación Registro',
      html: `¿Desea eliminar el registro N° ${registerNum}?`,
      showDenyButton: true,
      confirmButtonText: "¡Sí, elimínalo!",
      denyButtonText: "¡No lo elimines!"
    }).then(result => {
      if (result.isConfirmed) {
        $('input[name=idDelete]').val(num);
        $('#formDelete').submit();
      }
    })
  });

  $('.showEdit').click(function() {
    let id = $(this).find('span:nth-child(2)').text();
    $.ajax({
      "_token": "{{csrf_token()}}",
      url: "{{route('getProcedures')}}",
      type: "POST",
      dataType: "json",
      data: {
        data: id
      },
      success(response) {
        $('Select[name=SelectDocument]').val(response[0]['usp_config']);
        $('textarea[name=TextContent]').val(response[0]['usp_content']);
        $('input[name=idhidden]').val(response[0]['usp_id']);
      },
      complete() {
        $('#formEdit').modal();
      },
    })
  });

  $("select[name=SelectDocument]").change(function() {
    let select = $(this).val();
    let name = "";
    $.ajax({
      "_token": "{{csrf_token()}}",
      url: "{{ route('getSelect') }}",
      type: "POST",
      dataType: "json",
      data: {
        data: select
      },
      beforeSend() {
        Swal.fire({
          icon: "info",
          title: "Consulta",
          html: "<b>Realizando la consulta</b>",
          showConfirmButton: false
        })
      },
      success(objectSearch) {
        $("textarea[name=TextContent]").val(objectSearch[0]['cdlContent']);
        name = objectSearch[0]['dolName'];
      },
      complete(objectSearch) {
        Swal.fire({
          icon: "success",
          title: "Consulta terminada",
          html: `<b>La consulta del contenido de ${name} ha terminado</b>`
        })
      }
    })
  })
</script>
@endsection