@extends('modules.procedure')

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
  })
</script>
@endsection