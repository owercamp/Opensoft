@extends('modules.commitee')

@section('space')
<div class="container-fluid px-2">
  <h5>ACTAS DE COMITES</h5>
  @include('partials.alerts')
  <form action="{{route('commitee.save')}}" method="post" class="shadow p-3 rounded">
    @include('modules.commitee.partials.formcommitee')
    <div class="d-flex justify-content-center">
      <button class="btn btn-outline-primary px-auto">GUARDAR</button>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script>
  let all = [];
  $("#List input").each(function(index, element) {
    $(element).click(function() {
      if ($(this).prop("checked")) {
        let data = $(element).val();
        all.push(data);
        $("textarea[name=DataCollaborators]").val(all);
      } else if ($(this).prop("checked") == false) {
        let del = $(element).val();
        all.forEach(element => {
          if (element === del) {
            let del = all.indexOf(element);
            all.splice(del, 1);
            $("textarea[name=DataCollaborators]").val(all);
          }
        });
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