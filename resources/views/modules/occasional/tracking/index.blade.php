@extends('modules.comercialOccasionalcontracts')

@section('space')
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
      <h5>ARCHIVO DE CONTRATOS</h5>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table id="tableDatatable" class="table table-hover text-center" width="100%" style="font-size: 12px;">
        <thead>
          <tr>
            <th>#</th>
            <th>CODIGO DOCUMENTO</th>
            <th>CLIENTE</th>
            <th>FECHA DE INICIO</th>
            <th>FECHA DE VENCIMIENTO</th>
            <th>ESTADO</th>
            <th>DETALLES PDF</th>
          </tr>
        </thead>
        <tbody>
          @php $row = 1; @endphp
          @foreach($orders as $order)
          @if($order->oroState === 'APROBADO')
          <tr>
            <td>{{ $row++ }}</td>
            <td>{{ $order->oroDocumentcode }}</td>
            <td>{{ $order->proposal->cprClient }}</td>
            <td>{{ $order->oroDatestart }}</td>
            <td>{{ $order->oroDateend }}</td>
            <td>
              <h3 class="badge badge-success">{{ $order->oroState }}</h3>
            </td>
            <td>
              <form action="{{ route('occasional.order.pdf') }}" method="GET" style="display: inline-block;">
                @csrf
                <input type="hidden" name="oroId" value="{{ $order->oroId }}" class="form-control form-control-sm" required>
                <input type="hidden" name="clientPdf" value="{{ $order->proposal->cprClient }}" class="form-control form-control-sm" required>
                <button type="submit" title="DESCARGAR PDF" class="btn btn-outline-danger rounded-circle form-control-sm">
                  <i class="fas fa-file-pdf"></i>
                </button>
              </form>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!-- <h5>SEGUIMIENTO DEL SERVICIO CARGA EXPRESS</h5> -->
</div>
@endsection

@section('scripts')
<script>
  $(function() {

  });
</script>
@endsection