@extends('modules.archive')

@section('space')
<div class="container-fluid">
  <h6>ANALISIS DE MATRIZ</h6>
  @include('partials.alerts')
  <div class="container-fluid">
    <div class="w-100 justify-content-around d-flex">
      <button class="btn btn-outline-primary btn-navbar" id="Create">{{ucwords('crear analisis')}}</button>
    </div>
    <hr>
    <table id="tableDatatable" class="w-100 table table-striped text-center">
      <thead>
        <tr>
          <th class="align-middle">{{ucwords('documentos')}}</th>
          <th class="align-middle">{{ucwords('actividad')}}</th>
          <th class="align-middle">{{ucwords('riesgo')}}</th>
          <th class="align-middle">{{ucwords('tipo de riesgo')}}</th>
          <th class="align-middle">{{ucwords('grado de riesgo')}}</th>
          <th class="align-middle">{{ucwords('acciones')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($analysis as $item)
        <tr>
          <td class="align-middle">{{$item->domName}}</td>
          <td class="align-middle">{{$item->amActivity}}</td>
          <td class="align-middle">{{$item->amRick}}</td>
          <td class="align-middle">{{$item->amTypeRick}}</td>
          <td class="align-middle">{{$item->amGradeRick}}</td>
          <td>
            <button class="btn btn-primary editAnalysisMatrix"><i class="fas fa-pen-square"></i><span hidden>{{$item->am_id}}</span></button>
            <button class="btn btn-danger deleteAnalysisMatrix"><i class="fas fa-ban"></i><span hidden>{{$item->am_id}}</span></button>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- formularo de creación -->
<div class="fade modal" id="createMatrixAnalysis">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('creación analisis de matriz')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1 dismiss" data-dismiss="modal">&bigwedge;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('analysis.save')}}" method="post">
          @include('modules.document.partial.formMatrix')
          <hr>
          <div class="d-flex justify-content-center w-100">
            <button class="btn btn-success">{{ucwords('guardar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formularo de edición -->
<div class="fade modal" id="editMatrixAnalysis">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('edición analisis de matriz')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1 dismiss" data-dismiss="modal">&bigwedge;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('analysis.update')}}" method="post">
          @method("PATCH")
          @include('modules.document.partial.formMatrix')
          <input type="hidden" name="analysisIdUpdate">
          <hr>
          <div class="d-flex justify-content-around w-100">
            <button class="btn btn-success">{{ucwords('actualizar')}}</button>
            <button type="button" class="btn btn-dark dismiss" data-dismiss="modal">{{ucwords('cancelar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- formularo de eliminación -->
<div class="fade modal" id="deleteMatrixAnalysis">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-muted">{{ucwords('eliminación analisis de matriz')}}</h5>
        <button class="btn-outline-dark btn-sm mr-1 dismiss" data-dismiss=" modal">&bigwedge;</button>
      </div>
      <div class="modal-body">
        <form action="{{route('analysis.destroy')}}" method="post">
          @method("DELETE")
          @include('modules.document.partial.formMatrix')
          <input type="hidden" name="analysisIdDelete">
          <hr>
          <div class="d-flex justify-content-around w-100">
            <button class="btn btn-danger">{{ucwords('eliminar')}}</button>
            <button type="button" class="btn btn-dark dismiss" data-dismiss="modal">{{ucwords('cancelar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  // !multiplicación de riesgos
  const Arr = [1, 1, 1, 1, 1, 1, 1];
  const Multiply = () => {
    $('input[name=amProSeverity]').val("");
    multi = Arr[0] * Arr[1] * Arr[2] * Arr[3] * Arr[4] * Arr[5] * Arr[6];
    $('input[name=amProSeverity]').val(multi);
  };

  // ?Personal Expuesto
  $('input[name=amPExposed]').keyup(e => {
    if (e.target.value && $('input[name=amPExposed]').val() != "") {
      Arr[0] = parseInt(e.target.value);
      Multiply();
    }
  });

  // ?Personal Entrenado
  $('input[name=amPTrained]').keyup(e => {
    if (e.target.value && $('input[name=amPTrained]').val() != "") {
      Arr[1] = parseInt(e.target.value);
      Multiply();
    }
  });

  // ?Personal Parcialmente Entrenado
  $('input[name=amPPTrained]').keyup(e => {
    if (e.target.value && $('input[name=amPPTrained]').val() != "") {
      Arr[2] = parseInt(e.target.value);
      Multiply();
    }
  });

  // ?Personal No Entrenado
  $('input[name=amPNotTrained]').keyup(e => {
    if (e.target.value && $('input[name=amPNotTrained]').val() != "") {
      Arr[3] = parseInt(e.target.value);
      Multiply();
    }
  });

  // ?Exposición de Riesgos
  $('input[name=amExpoRick]').keyup(e => {
    if (e.target.value && $('input[name=amExpoRick]').val() != "") {
      Arr[4] = parseInt(e.target.value);
      Multiply();
    }
  });

  // ?Probabilidad
  $('input[name=amProbability]').keyup(e => {
    if (e.target.value && $('input[name=amProbability]').val() != "") {
      Arr[5] = parseInt(e.target.value);
      Multiply();
    }
  });

  // ?Severidad
  $('input[name=amSeverity]').keyup(e => {
    if (e.target.value && $('input[name=amSeverity]').val() != "") {
      Arr[6] = parseInt(e.target.value);
      Multiply();
    }
  });

  // ?edición de matriz de riesgos "FORM"
  $(".editAnalysisMatrix").click(function() {
    const id = $(this).find('span:nth-child(2)').text();
    $.ajax({
      "_method": "{{csrf_token()}}",
      type: "POST",
      dataType: "JSON",
      url: "{{route('apiAnalysis')}}",
      data: {
        data: id
      },
      success(res) {
        $('select[name=amDoc]').val(res[0]['amDoc']);
        $('input[name=amActivity]').val(res[0]['amActivity']);
        $('select[name=amFrequency]').val(res[0]['amFrequency']);
        $('input[name=amDanger]').val(res[0]['amDanger']);
        $('input[name=amRick]').val(res[0]['amRick']);
        $('select[name=amTypeRick]').val(res[0]['amTypeRick']);
        $('input[name=amExistsControl]').val(res[0]['amExistsControl']);
        $('select[name=amLevel]').val(res[0]['amLevel']);
        $('input[name=amPExposed]').val(res[0]['amPExposed']);
        Arr[0] = res[0]['amPExposed'];
        $('input[name=amPTrained]').val(res[0]['amPTrained']);
        Arr[1] = res[0]['amPTrained'];
        $('input[name=amPPTrained]').val(res[0]['amPPTrained']);
        Arr[2] = res[0]['amPPTrained'];
        $('input[name=amPNotTrained]').val(res[0]['amPNotTrained']);
        Arr[3] = res[0]['amPNotTrained'];
        $('input[name=amExpoRick]').val(res[0]['amExpoRick']);
        Arr[4] = res[0]['amExpoRick'];
        $('input[name=amProbability]').val(res[0]['amProbability']);
        Arr[5] = res[0]['amProbability'];
        $('input[name=amSeverity]').val(res[0]['amSeverity']);
        Arr[6] = res[0]['amSeverity'];
        $('input[name=amProSeverity]').val(res[0]['amProSeverity']);
        $('select[name=amGradeRick]').val(res[0]['amGradeRick']);
        $('input[name=analysisIdUpdate]').val(res[0]['am_id']);
      },
      complete() {
        $('select[name=amDoc]').prop("disabled", false);
        $('input[name=amActivity]').prop("disabled", false);
        $('select[name=amFrequency]').prop("disabled", false);
        $('input[name=amDanger]').prop("disabled", false);
        $('input[name=amRick]').prop("disabled", false);
        $('select[name=amTypeRick]').prop("disabled", false);
        $('input[name=amExistsControl]').prop("disabled", false);
        $('select[name=amLevel]').prop("disabled", false);
        $('input[name=amPExposed]').prop("disabled", false);
        $('input[name=amPTrained]').prop("disabled", false);
        $('input[name=amPPTrained]').prop("disabled", false);
        $('input[name=amPNotTrained]').prop("disabled", false);
        $('input[name=amExpoRick]').prop("disabled", false);
        $('input[name=amProbability]').prop("disabled", false);
        $('input[name=amSeverity]').prop("disabled", false);
        $('input[name=amProSeverity]').prop("disabled", false);
        $('select[name=amGradeRick]').prop("disabled", false);
        $('#editMatrixAnalysis').modal();
      }
    })
  });

  // ?eliminación de matriz de riesgo "FORM"
  $(".deleteAnalysisMatrix").click(function() {
    const id = $(this).find('span:nth-child(2)').text();
    $.ajax({
      "_method": "{{csrf_token()}}",
      type: "POST",
      dataType: "JSON",
      url: "{{route('apiAnalysis')}}",
      data: {
        data: id
      },
      success(res) {
        $('select[name=amDoc]').val(res[0]['amDoc']);
        $('input[name=amActivity]').val(res[0]['amActivity']);
        $('select[name=amFrequency]').val(res[0]['amFrequency']);
        $('input[name=amDanger]').val(res[0]['amDanger']);
        $('input[name=amRick]').val(res[0]['amRick']);
        $('select[name=amTypeRick]').val(res[0]['amTypeRick']);
        $('input[name=amExistsControl]').val(res[0]['amExistsControl']);
        $('select[name=amLevel]').val(res[0]['amLevel']);
        $('input[name=amPExposed]').val(res[0]['amPExposed']);
        $('input[name=amPTrained]').val(res[0]['amPTrained']);
        $('input[name=amPPTrained]').val(res[0]['amPPTrained']);
        $('input[name=amPNotTrained]').val(res[0]['amPNotTrained']);
        $('input[name=amExpoRick]').val(res[0]['amExpoRick']);
        $('input[name=amProbability]').val(res[0]['amProbability']);
        $('input[name=amSeverity]').val(res[0]['amSeverity']);
        $('input[name=amProSeverity]').val(res[0]['amProSeverity']);
        $('select[name=amGradeRick]').val(res[0]['amGradeRick']);
        $('input[name=analysisIdDelete]').val(res[0]['am_id']);
      },
      complete() {
        $('select[name=amDoc]').prop("disabled", true);
        $('input[name=amActivity]').prop("disabled", true);
        $('select[name=amFrequency]').prop("disabled", true);
        $('input[name=amDanger]').prop("disabled", true);
        $('input[name=amRick]').prop("disabled", true);
        $('select[name=amTypeRick]').prop("disabled", true);
        $('input[name=amExistsControl]').prop("disabled", true);
        $('select[name=amLevel]').prop("disabled", true);
        $('input[name=amPExposed]').prop("disabled", true);
        $('input[name=amPTrained]').prop("disabled", true);
        $('input[name=amPPTrained]').prop("disabled", true);
        $('input[name=amPNotTrained]').prop("disabled", true);
        $('input[name=amExpoRick]').prop("disabled", true);
        $('input[name=amProbability]').prop("disabled", true);
        $('input[name=amSeverity]').prop("disabled", true);
        $('input[name=amProSeverity]').prop("disabled", true);
        $('select[name=amGradeRick]').prop("disabled", true);
        $('#deleteMatrixAnalysis').modal();
      }
    })
  });

  // ?lanzador del formulario de creación de registros para analisis
  $('#Create').click(function() {
    $('select[name=amDoc]').prop("disabled", false);
    $('input[name=amActivity]').prop("disabled", false);
    $('select[name=amFrequency]').prop("disabled", false);
    $('input[name=amDanger]').prop("disabled", false);
    $('input[name=amRick]').prop("disabled", false);
    $('select[name=amTypeRick]').prop("disabled", false);
    $('input[name=amExistsControl]').prop("disabled", false);
    $('select[name=amLevel]').prop("disabled", false);
    $('input[name=amPExposed]').prop("disabled", false);
    $('input[name=amPTrained]').prop("disabled", false);
    $('input[name=amPPTrained]').prop("disabled", false);
    $('input[name=amPNotTrained]').prop("disabled", false);
    $('input[name=amExpoRick]').prop("disabled", false);
    $('input[name=amProbability]').prop("disabled", false);
    $('input[name=amSeverity]').prop("disabled", false);
    $('input[name=amProSeverity]').prop("disabled", false);
    $('select[name=amGradeRick]').prop("disabled", false);
    $('#createMatrixAnalysis').modal();
  });

  // *formato del input por medio de jQuery mask
  $('input[name=amPExposed]').mask("000");
  $('input[name=amPTrained]').mask("000");
  $('input[name=amPPTrained]').mask("000");
  $('input[name=amPNotTrained]').mask("000");
  $('input[name=amExpoRick]').mask("000");
  $('input[name=amProbability]').mask("000");
  $('input[name=amSeverity]').mask("000");

  // *clear form
  $('.dismiss').click(() => {
    $('select[name=amDoc]').val("");
    $('input[name=amActivity]').val("");
    $('select[name=amFrequency]').val("");
    $('input[name=amDanger]').val("");
    $('input[name=amRick]').val("");
    $('select[name=amTypeRick]').val("");
    $('input[name=amExistsControl]').val("");
    $('select[name=amLevel]').val("");
    $('input[name=amPExposed]').val("");
    $('input[name=amPTrained]').val("");
    $('input[name=amPPTrained]').val("");
    $('input[name=amPNotTrained]').val("");
    $('input[name=amExpoRick]').val("");
    $('input[name=amProbability]').val("");
    $('input[name=amSeverity]').val("");
    $('input[name=amProSeverity]').val("");
    $('select[name=amGradeRick]').val("");
  });
</script>
@endsection