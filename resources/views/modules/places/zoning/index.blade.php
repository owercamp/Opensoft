@extends('modules.settingPlaces')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>ZONIFICACION</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar zonificación" class="bj-btn-table-add form-control-sm newZoning-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessZonings'))
				    <div class="alert alert-success">
				        {{ session('SuccessZonings') }}
				    </div>
				@endif
				@if(session('PrimaryZonings'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryZonings') }}
				    </div>
				@endif
				@if(session('WarningZonings'))
				    <div class="alert alert-warning">
				        {{ session('WarningZonings') }}
				    </div>
				@endif
				@if(session('SecondaryZonings'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryZonings') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE</th>
					<th>PERTENECE A</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($zonings as $zoning)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $zoning->zonName }}</td>
					<td>{{ $zoning->munName . ', ' . $zoning->depName }}</td>
					<td>
						<a href="#" title="Editar zona {{ $zoning->zonName }}" class="bj-btn-table-edit form-control-sm editZoning-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $zoning->zonId }}</span>
							<span hidden>{{ $zoning->zonName }}</span>
							<span hidden>{{ $zoning->depId }}</span>
							<span hidden>{{ $zoning->munId }}</span>
						</a>
						<a href="#" title="Eliminar zona {{ $zoning->zonName }}" class="bj-btn-table-delete form-control-sm deleteZoning-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $zoning->zonId }}</span>
							<span hidden>{{ $zoning->zonName }}</span>
							<span hidden>{{ $zoning->depName }}</span>
							<span hidden>{{ $zoning->munName }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newZoning-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA ZONIFICACION:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('zonings.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">DEPARTAMENTO:</small>
									<select name="zonDepartment_id" class="form-control form-control-sm" required>
										<option value="">Seleccione un departamento...</option>
										@foreach($departments as $department)
											<option value="{{ $department->depId }}">{{ $department->depName }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">MUNICIPIO:</small>
									<select name="zonMunicipality_id" class="form-control form-control-sm" required>
										<option value="">Seleccione un municipio...</option>
										<!-- options dinamics -->
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE:</small>
									<input type="text" name="zonName" maxlength="50" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editZoning-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR ZONIFICACION:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('zonings.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">DEPARTAMENTO:</small>
									<select name="zonDepartment_id_Edit" class="form-control form-control-sm" required>
										<option value="">Seleccione un departamento...</option>
										@foreach($departments as $department)
											<option value="{{ $department->depId }}">{{ $department->depName }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">MUNICIPIO:</small>
									<select name="zonMunicipality_id_Edit" class="form-control form-control-sm" required>
										<option value="">Seleccione un municipio...</option>
										<!-- options dinamics -->
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE:</small>
									<input type="text" name="zonName_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="zonId_Edit" value="" required>
								<button type="submit" class="bj-btn-table-add form-control-sm my-3">GUARDAR CAMBIOS</button>
							</div>
							<div class="col-md-6">
								<button type="button" class="bj-btn-table-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteZoning-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE ZONIFICACION:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">NOMBRE: </small><br>
							<span class="text-muted"><b class="zonName_Delete"></b></span><br>
							<small class="text-muted">DE MUNICIPIO/DEPARTAMENTO: </small><br>
							<span class="text-muted"><b class="zonMunicipality_Delete"></b></span>
							/
							<span class="text-muted"><b class="zonDepartment_Delete"></b></span>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('zonings.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="zonId_Delete" value="" required>
							<button type="submit" class="bj-btn-table-add form-control-sm my-3">ELIMINAR</button>
						</form>
						<div class="col-md-6">
							<button type="button" class="bj-btn-table-delete mx-3 form-control-sm my-3" data-dismiss="modal">CANCELAR</button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){

		});

		$('.newZoning-link').on('click',function(){
			$('#newZoning-modal').modal();
		});

		// Eveneto para abrir ventana modal de edicion de las zonas
		$('.editZoning-link').on('click',function(e){
			e.preventDefault();
			var zonId = $(this).find('span:nth-child(2)').text();
			var zonName = $(this).find('span:nth-child(3)').text();
			var depId = $(this).find('span:nth-child(4)').text();
			var munId = $(this).find('span:nth-child(5)').text();
			$('input[name=zonId_Edit]').val(zonId);
			$('input[name=zonName_Edit]').val(zonName);
			$('select[name=zonMunicipality_id_Edit]').empty();
			$('select[name=zonMunicipality_id_Edit]').append("<option value=''>Seleccione un municipio...</option>");
			if(depId != ''){
				$('select[name=zonDepartment_id_Edit]').val(depId);
				$.get("{{ route('getMunicipalities') }}",{ depId: depId },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							if(objectMunicipalities[i]['munId'] == munId){
								$('select[name=zonMunicipality_id_Edit]').append(
									"<option value='" + objectMunicipalities[i]['munId'] + "' selected>" + 
										objectMunicipalities[i]['munName'] + 
									"</option>"
								);
							}else{
								$('select[name=zonMunicipality_id_Edit]').append(
									"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
										objectMunicipalities[i]['munName'] + 
									"</option>"
								);
							}
								
						}
					}
				});
			}else{
				$('select[name=zonDepartment_id_Edit]').val('');
			}
			$('#editZoning-modal').modal();
		});

		// Evento de consulta para actualizar municipios de acuerdo al departamento seleccionado (Modal de creacion de zonas)
		$('select[name=zonDepartment_id]').on('change',function(e){
			var departmentSelected = e.target.value;
			$('select[name=zonMunicipality_id]').empty();
			$('select[name=zonMunicipality_id]').append("<option value=''>Seleccione un municipio...</option>");
			if(departmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: departmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=zonMunicipality_id]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// Evento de consulta para actualizar municipios de acuerdo al departamento seleccionado (Modal de edición)
		$('select[name=zonDepartment_id_Edit]').on('change',function(e){
			var departmentSelected = e.target.value;
			$('select[name=zonMunicipality_id_Edit]').empty();
			$('select[name=zonMunicipality_id_Edit]').append("<option value=''>Seleccione un municipio...</option>");
			if(departmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: departmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=zonMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		$('.deleteZoning-link').on('click',function(e){
			e.preventDefault();
			var zonId = $(this).find('span:nth-child(2)').text();
			var zonName = $(this).find('span:nth-child(3)').text();
			var depName = $(this).find('span:nth-child(4)').text();
			var munName = $(this).find('span:nth-child(5)').text();
			$('input[name=zonId_Delete]').val(zonId);
			$('.zonName_Delete').text(zonName);
			$('.zonDepartment_Delete').text(depName);
			$('.zonMunicipality_Delete').text(munName);
			$('#deleteZoning-modal').modal();
		});
	</script>
@endsection