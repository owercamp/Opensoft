@extends('modules.procedure');

@section('space')
<div class="container-fluid">
  <h6>IMPLEMENTACION DE PROCEDIMIENTOS</h6>
  @include('partials.alerts')
  <div class="container shadow">
    <form action="{{route('implementation.save')}}" method="post" class="row p-4">
      @include('modules.procedure.partials.formProcedure')
      <hr>
      <div class="w-100 d-flex justify-content-center py-3">
        <button class="btn btn-outline-primary">GUARDAR</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
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
        $('textarea[name=TextContent]').val(response[0]['cdmContent']);
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
</script>
@endsection