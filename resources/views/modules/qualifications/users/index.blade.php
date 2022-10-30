@extends('modules.operativeQualification')

@section('space')
<div class="col-md-12">
	@include('partials.alerts')
	<h5>CALIFICACION DEL USUARIO</h5>
	<div class="container-fluid">
		<div class="table-responsive">
			<table id="QualitificationUsers" class="table table-hover text-center w-100">
				<thead>
					<th>TIPO DE SERVICIO</th>
					<th>ORIGEN - DESTINO</th>
					<th>COLABORADOR</th>
					<th>ESTRELLAS</th>
					<th>COMENTARIO</th>
				</thead>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		$('#QualitificationUsers').DataTable({
			processing: true,
			serverSide: true,
			order: [
				[0, 'asc']
			],
			ajax: {
				url: "{{ route('serverside.qualification') }}",
				dataType: "JSON",
				type: "GET",
				data: {
					"_token": "{{ csrf_token() }}"
				}
			},
			columns: [{
				data: 'type_service'
			},{
				data:'origin'
			},{
				data:'collaborator'
			},{
				data:'star'
			},{
				data:'comment'
			}],
			language:{
				"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			},
			responsive: true,
			pagingType:"full_numbers"
		});
	})
</script>
@endsection