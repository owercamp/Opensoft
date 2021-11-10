@extends('modules.procedure')

@section('space')
<div class="container-fluid">
  <h6>PROCEDIMIENTOS EN PROCESO</h6>
  @include('partials.alerts')
  <div class="container">
    <table id="tableDatatable" class="table table-borderless table-striped text-center w-100">
      <thead>
        <th>N°</th>
        <th>DOCUMENTO</th>
        <th>CONTENIDO</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>
        @php $row=1; @endphp
        @foreach($all as $item)
        @if($item->pro_status == "non-approved")
        <tr>
          <td class="align-middle">{{$row++}}</td>
          <td class="align-middle">{{$item->domName}}</td>
          <td class="align-middle">{!!substr($item->pro_content,0,80)."..."!!}</td>
          <td>
            <button class="btn btn-outline-primary rounded-circle btn-edit" title="EDITAR"><i class="fas fa-keyboard"></i><span hidden>{{$item->pro_id}}</span></button>
            <button title="ELIMINAR" class="btn btn-outline-danger rounded-circle mx-2 btn-delete"><i class="fas fa-minus-square"></i><span hidden>{{$item->pro_id}}</span><span hidden>{{$row-1}}</span></button>
            <button title="APROBAR" class="btn btn-outline-secondary rounded-circle btn-approved"><i class="fas fa-check-double"></i></i><span hidden>{{$item->pro_id}}</span><span hidden>{{$row-1}}</span></button>
          </td>
        </tr>
        @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="formProcedure">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header justify-content-between">
        <h5 class="my-auto mx-auto">Edición Implementación Procedimientos</h5>
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-outline-danger rounded left"><i class="fas fa-times-circle"></i></button>
      </div>
      <div class="modal-body">
        <form action="{{route('implementation.update')}}" method="post" id="FormUpdate">
          @method("PATCH")
          @include('modules.procedure.partials.formProcedure')
          <input type="hidden" name="UpdateId">
          <div class="d-flex justify-content-around">
            <button class="btn btn-outline-primary px-auto" id="btn-save">ACTUALIZAR</button>
            <button class="btn btn-outline-secondary px-auto" data-dismiss="modal">CANCELAR</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<form action="{{route('implementation.destroy')}}" method="post" id="formDelete" hidden>
  @csrf @method('DELETE')
  <input type="text" name="idDelete">
</form>

<form action="{{route('implementation.approved')}}" method="post" id="formApproved" hidden>
  @csrf @method('PUT')
  <input type="text" name="idApproved">
</form>
@endsection

@section('scripts')
<script>
  // ?implementación de ckeditor
  let MyEditor;
  ClassicEditor
    .create(document.querySelector('#TextContent'), {
      fontColor: {
        colors: [{
            color: '#000000',
            label: 'Black',
            hasBorder: true
          },
          {
            color: '#4D4D4D',
            label: 'Dim grey',
            hasBorder: true
          },
          {
            color: '#999999',
            label: 'Grey',
            hasBorder: true
          },
          {
            color: '#E6E6E6',
            label: 'Light grey',
            hasBorder: true
          },
          {
            color: '#FFFFFF',
            label: 'White',
            hasBorder: true
          },
          {
            color: '#e3342f',
            label: 'Red',
            hasBorder: true
          },
          {
            color: '#0086f9',
            label: 'Blue',
            hasBorder: true
          },
          {
            color: '#ffed4a',
            label: 'Yellow',
            hasBorder: true
          },
          {
            color: '#fd8701',
            label: 'Orange',
            hasBorder: true
          },
          {
            color: '#627700',
            label: 'Green',
            hasBorder: true
          }
        ]
      },
    })
    .then(editor => {
      MyEditor = editor;
    })
    .catch(error => {
      console.error(error);
    });

  $(".btn-delete").click(function() {
    let id = $(this).find("span:nth-child(2)").text();
    let number = $(this).find("span:nth-child(3)").text();
    Swal.fire({
      icon: "question",
      title: "Eliminación Registro",
      html: `Desea eliminar el registro N°: <b>${number}<b>`,
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonColor: '#007bff',
      cancelButtonColor: '#dc3545',
      confirmButtonText: '¡Sí, bórralo!',
      cancelButtonText: "¡No lo Elimines!"
    }).then((result) => {
      if (result.isConfirmed) {
        $('input[name=idDelete]').val(id);
        $("#formDelete").submit();
      }
    });
  });

  $(".btn-approved").click(function() {
    let id = $(this).find("span:nth-child(2)").text();
    let number = $(this).find("span:nth-child(3)").text();
    Swal.fire({
      icon: "question",
      title: "Aprobación Registro",
      html: `Desea aprobar el registro N°: <b>${number}<b>`,
      showConfirmButton: true,
      showCancelButton: true,
      confirmButtonColor: '#007bff',
      cancelButtonColor: '#dc3545',
      confirmButtonText: '¡Sí, Aprobar!',
      cancelButtonText: "¡No lo Apruebes!"
    }).then((response) => {
      if (response.isConfirmed) {
        $('input[name=idApproved]').val(id);
        $("#formApproved").submit();
      }
    })
  });

  $('select[name=SelectDocument]').change(function() {
    let id = $('select[name=SelectDocument]').val();
    $.ajax({
      "_token": "{{ csrf_token() }}",
      url: "{{route('getConfig')}}",
      type: "POST",
      data: {
        id: id
      },
      beforeSend() {
        Swal.fire({
          icon: 'info',
          title: 'Consulting',
          text: 'Consultando el contenido',
          showConfirmButton: false
        })
      },
      success(response) {
        MyEditor.setData(response[0]['cdmContent']);
      },
      complete() {
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Consulta terminada',
          timer: 1500,
          showConfirmButton: false
        })
      }
    })
  });

  $('.btn-edit').click(function() {
    let select = $(this).find("span:nth-child(2)").text();
    $("input[name=UpdateId]").val(select);
    $.ajax({
      "_token": "{{csrf_token()}}",
      url: "{{route('getRegister')}}",
      type: "POST",
      dataType: "json",
      data: {
        data: select
      },
      success(objectRegister) {
        $("select[name=SelectDocument]").val(objectRegister[0]['pro_doc']);
        MyEditor.setData(objectRegister[0]['pro_content']);
      },
      complete() {
        $("#formProcedure").modal();
      }
    })
  });
</script>
@endsection