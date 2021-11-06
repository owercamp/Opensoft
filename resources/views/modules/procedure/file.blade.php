@extends('modules.procedure')

@section('space')
<div class="container-fluid">
  <h6>ARCHIVO DE PROCEDIMIENTOS</h6>
  <table class="w-100 table table-striped text-center" id="tableDatatable">
    <thead>
      <tr>
        <th>N°</th>
        <th>DOCUMENTO</th>
        <th>CONTENIDO</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($allfiles as $file)
      @if($file->pro_status == "approved")
      <tr>
        <td class="align-middle">{{ $row++ }}</td>
        <td class="align-middle">{{ $file->domName}}</td>
        <td class="align-middle">{{ substr($file->pro_content,0,80)."..."}}</td>
        <td><button class="btn btn-outline-danger rounded-circle btn-PDF" title="PDF"><i class="far fa-file-pdf"></i><span hidden>{{$file->pro_id}}</span></button></td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</div>

<form action="{{route('implementation.pdf')}}" method="post" id="formPDF" hidden>
  @csrf
  <input type="text" name="idPDF">
</form>
@endsection

@section("scripts")
<script>
  $(".btn-PDF").click(function() {
    let id = $(this).find("span:nth-child(2)").text();
    $("input[name=idPDF]").val(id);
    $("#formPDF").submit();
  });
</script>
@endsection