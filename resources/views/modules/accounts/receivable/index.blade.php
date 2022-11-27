@extends('modules.financialReceivable')

@section('space')
<div class="col-md-12">
	<h6>CUENTAS POR COBRAR</h6>
	<div class="container-fluid">
		<div class="table-responsive">
			<div class="container">
				<div class="card bg-light mb-3">
					<h4 class="card-header text-center" id="months"></h4>
				</div>
			</div>
			<table id="table-receible" class="table table-bordered table-striped w-100 text-center">
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
	var table;
	$(document).ready(function() {
		let month;
		$("a.accountMount").map((e) => {
			let monthNow = new Date;
			if (e.valueOf() == (monthNow.getUTCMonth() + 1)) {
				month = monthNow.getUTCMonth() + 1;
				$("#months").text($("#"+month).children("p").text());
			}
		});

		table = $("#table-receible").DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			order: [
				[0, 'asc']
			],
			ajax: {
				url: "{{ route('serverside.recevable') }}",
				dataType: "JSON",
				type: "GET",
				data: {
					"_token": "{{ csrf_token() }}",
					"month": month
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
					<i class="fas fa-dolly-flatbed"></i>
					</a>
					</div>`;
				}
			}],
			language: {
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			responsive: true,
			pagingType: "full_numbers"
		});
	});

	$('li a.accountMount').click((e) => {
		table.destroy();
		let month = e.currentTarget.id;
		$("#months").text($("#"+month).children("p").text());
		table = $("#table-receible").DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			order: [
				[0, 'asc']
			],
			ajax: {
				url: "{{ route('serverside.recevable') }}",
				datatype: "JSON",
				type: "GET",
				data: {
					"_token": "{{ csrf_token() }}",
					"month": month
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
		});

		table.ajax.reload();
	})
</script>
@endsection