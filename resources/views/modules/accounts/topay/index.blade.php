@extends('modules.financialPay')

@section('space')
<div class="col-md-12">
	<h6>CUENTAS POR PAGAR</h6>
	<div class="container-fluid">
		<div class="table-responsive">
			<table id="table-pay" class="table table-bordered table-striped w-100 text-center">
				<thead>
					<th>SERVICIO</th>
					<th>ORIGEN - DESTINO</th>
					<th>COLABORADOR</th>
					<th>COSTO</th>
					<th>ACCIONES</th>
				</thead>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		$("#table-pay").DataTable({
			processing: true,
			serverSide: true,
			order: [
				[0, 'asc']
			],
			ajax: {
				url: "{{ route('serverside.pay') }}",
				datatype: "JSON",
				type: "GET",
				data: {
					"_token": "{{ csrf_token() }}"
				}
			},
			columns: [{
				data: 'services'
			}, {
				data: 'origin'
			}, {
				data: 'collaborator'
			}, {
				data: 'price'
			}, {
				data: 'action',
				render: function(data, type, full, meta) {
					return `<div class="btn-group">
					<a href="javascript:void(0)" class="btn btn-outline-primary rounded-circle form-control-sm" height="150" width="50" data-id="${data.id}">
					<i class="fas fa-dolly"></i>
					</a>
					</div>`;
				}
			}],
			language: {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			responsive: true,
			pagingType: "full_numbers"
		})
	})
</script>
@endsection