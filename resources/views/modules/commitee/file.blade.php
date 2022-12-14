@extends('modules.commitee')

@section('space')
<div class="container-fluid">
  <h6>ARCHIVO DE ACTAS</h6>
  <div class="container">
    <table id="tableDatatable" class="table table-hover w-100 text-center">
      <thead>
        <th>#</th>
        <th>DOCUMENTO</th>
        <th>CONTENIDO</th>
        <th>ACCION</th>
      </thead>
      <tbody>
        @php
        $row = 1;
        @endphp
        @foreach ($archives as $archive)
        @if ($archive->com_status == "approved")
        <tr>
          <td>{{ $row++ }}</td>
          <td>{{ $archive->domName }}</td>
          <td>
            @php
            $data = str_split($archive->comtext);
            $num=0;
            foreach($data as $key => $item){
            if($key >= 70 & $item == " "){
            break;
            }
            print($item);
            }
            @endphp
            ...
          </td>
          <td>
            <button class="btn btn-outline-danger rounded-circle btnPDF"><i class="far fa-file-pdf"></i><span hidden>{{ $archive->comid }}</span></button>
          </td>
        </tr>
        @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<form action="{{ route('commitee.pdf') }}" method="post" id="formPDF" hidden>
  @csrf
  <input type="text" name="idPDF">
</form>
@endsection

@section('scripts')
<script>
  $(".btnPDF").click(function() {
    let pdf = $(this).find("span:nth-child(2)").text();
    $("input[name=idPDF]").val(pdf);
    $("#formPDF").submit();
  });
</script>
@endsection