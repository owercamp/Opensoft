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
			}, {
				data: 'origin'
			}, {
				data: 'collaborator'
			}, {
				data: 'star'
			}, {
				data: 'comment'
			}, {
				data: 'action',
				render: function(data, type, full, meta) {
					const base = `{{ route('qualification.users.cancel','') }}`;
					const url = `${base}/${data.id}`;
					return `<div class="btn-group" role="group">
					<a class="btn btn-light m-2 border border-dark questions-limk" data-id="${data.id}" data-collaborator="${data.collaborator}" data-destiny="${data.destiny}" data-type_service="${data.type_service}" data-origin="${data.origin}" title="SOLICITAR CALIFICACION">
					<i class="fas fa-star-half-alt"></i>
					</a>
					<a href="${url}" class="btn btn-dark m-2" data-id="${data.id}" title="OMITIR CALIFICACION">
					<i class="fas fa-comment-slash"></i>
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

	})


	$(document).on('click', ".questions-limk",function(e) {
		e.preventDefault();
		let id, collaborator, destiny, service, origin;
		id = $(this).data("id");
		collaborator = $(this).data("collaborator");
		destiny = $(this).data("destiny");
		service = $(this).data("type_service");
		origin = $(this).data("origin");

		$.ajax({
			"_token": "{{ csrf_token() }}",
			url: "{{ route('apiSend') }}",
			type: "POST",
			dataType:"JSON",
			data:{
				collaborator: collaborator
			},
			success(response){
				console.log(response);
			}
		})
	})
</script>
@endsection