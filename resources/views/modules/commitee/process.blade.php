@extends('modules.commitee')

@section('space')
<div class="container-fluid w-100">
  <h6>ACTAS EN PROCESO</h6>
</div>
@include('partials.alerts')
<div class="w-100 container">
  <table id="tableDatatable" class="table table-bordered table-striped w-100 text-center">
    <thead>
      <th>N°</th>
      <th>DOCUMENTO</th>
      <th>CONTENIDO</th>
      <th>ACCIONES</th>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach ($minutes as $item)
      @if($item->com_status == "non-approved")
      <tr>
        <td class="align-middle">{{ $row++ }}</td>
        <td class="align-middle">{{ $item->domName }}</td>
        <td class="align-middle">
          @php
          $data = str_split($item->comtext);
          $num=0;
          foreach($data as $key => $items){
          if($key >= 50 & $items == " "){
          break;
          }
          print($items);
          }
          @endphp
          ...
        </td>
        <!-- <td class="align-middle">{!! substr($item->comtext,0,70)."..."!!}</td> -->
        <td>
          <button title="EDITAR" class="btn btn-outline-info rounded-circle showForm"><i class="fas fa-indent"></i><span hidden>{{$item->comid}}</span>
          </button>
          <button title="ELIMINAR" class="btn btn-outline-danger rounded-circle showDelete"><i class="fas fa-folder-minus"></i><span hidden>{{$item->comid}}</span><span hidden>{{$row-1}}</span>
          </button>
          <button title="APROBAR" class="btn btn-outline-primary rounded-circle showApproved"><i class="far fa-thumbs-up"></i><span hidden>{{$item->comid}}</span><span hidden>{{$row-1}}</span></button>
        </td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</div>

<div class="modal fade" id="formCommitee">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header justify-content-between">
        <h5 class="my-auto mx-auto">Edición Actas de Comite</h5>
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-outline-danger rounded left"><i class="fas fa-times-circle"></i></button>
      </div>
      <div class="modal-body">
        <form action="{{route('commitee.update')}}" method="post" id="FormUpdate">
          @method("PATCH")
          @include('modules.commitee.partials.formcommitee')
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

<form action="{{route('commitee.destroy')}}" method="post" id="formDelete" hidden>
  @csrf @method('DELETE')
  <input type="text" name="idDelete">
</form>

<form action="{{route('commitee.approved')}}" method="post" id="formApproved" hidden>
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

  let all = [];
  $("#btn-save").click(function(e) {
    e.preventDefault();
    $("#List input").each(function(index, element) {
      if ($(element).prop("checked")) {
        all.push($(element).val());
      }
    });
    $("textarea[name=DataCollaborators]").val(all);
    $("#FormUpdate").submit();
  });

  $(".showDelete").click(function() {
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
    })
  });
  $(".showApproved").click(function() {
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

  $("select[name=SelectDocument]").change(function() {
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

  $(".showForm").click(function() {
    let id = $(this).find("span:nth-child(2)").text();
    $("input[name=UpdateId]").val(id);
    $.ajax({
      "_token": "{{ csrf_token() }}",
      type: "POST",
      url: "{{route('MinutesCommitee')}}",
      dataType: "json",
      data: {
        id: id,
      },
      beforeSend() {
        $("select[name=SelectDocument]").val("");
        $("textarea[name=DataCollaborators]").val("");
        $("#List input").each(function(index, element) {
          $(element).prop("checked", false);
        });
      },
      success(response) {
        $("select[name=SelectDocument]").val(response[0]["comconf"]);
        MyEditor.setData(response[0]["comtext"]);
        $("textarea[name=DataCollaborators]").val(response[0]["comfir"]);
        let data = response[0]["comfir"];
        let separateData = data.split(",");
        $("#List input").each(function(index, elementList) {
          separateData.forEach(element => {
            if ($(elementList).val() == element) {
              $(elementList).prop("checked", true);
            }
          });
        })
      },
      error() {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Ha ocurrido un error en la consulta',
        })
      },
      complete() {
        $("#formCommitee").modal();
      },
    });
  });
</script>
@endsection