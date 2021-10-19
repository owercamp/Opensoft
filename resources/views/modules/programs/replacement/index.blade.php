@extends('modules.logisticPrograms')

@section('space')
<div class="container-fluid px-2">
  <h5>REPOSICION DEL PARQUE AUTOMOTOR</h5>
  @include('partials.alerts')
  <form action="{{route('replacement.save')}}" method="post" class="shadow p-3 rounded">
    @include('modules.programs.partials.programs')
    <div class="d-flex justify-content-center">
      <button class="btn btn-outline-primary px-auto">GUARDAR</button>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script>
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