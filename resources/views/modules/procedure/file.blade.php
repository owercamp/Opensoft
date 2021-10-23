@extends('modules.procedure')

@section('space')
<div class="container-fluid">
  <h6>ARCHIVO DE PROCEDIMIENTOS</h6>
  <table id="tableDatatable" class="table table-borderless table-striped text-center w-100">
    <thead>
      <th>N°</th>
      <th>DOCUMENTO</th>
      <th>CONTENIDO</th>
      <th>ACCIONES</th>
    </thead>
    <tbody>
      @php $row = 1; @endphp
      @foreach($allfiles as $file)
      <tr>
        @if($file->pro_status == "approved")
        <td class="align-middle">{{ $row++ }}</td>
        <td class="align-middle">{{ $file->domName}}</td>
        <td class="align-middle">{{ substr($file->pro_content,0,80)."..."}}</td>
        <td><button class="btn btn-outline-danger btn-PDF"><i class="far fa-file-pdf"></i><span hidden>{{$file->pro_id}}</span></button></td>
        @endif
      </tr>
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