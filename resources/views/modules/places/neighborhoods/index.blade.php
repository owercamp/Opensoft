@extends('modules.settingPlaces')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>BARRIOS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar barrio" class="bj-btn-table-add form-control-sm newNeighborhood-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessNeighborhood'))
				    <div class="alert alert-success">
				        {{ session('SuccessNeighborhood') }}
				    </div>
				@endif
				@if(session('PrimaryNeighborhood'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryNeighborhood') }}
				    </div>
				@endif
				@if(session('WarningNeighborhood'))
				    <div class="alert alert-warning">
				        {{ session('WarningNeighborhood') }}
				    </div>
				@endif
				@if(session('SecondaryNeighborhood'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryNeighborhood') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE</th>
					<th>CODIGO POSTAL</th>
					<th>ZONIFICACION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($neighborhoods as $neighborhood)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $neighborhood->neName }}</td>
					<td>{{ $neighborhood->neCode }}</td>
					<td>{{ $neighborhood->zonName }}</td>
					<td>
						<a href="#" title="Editar barrio {{ $neighborhood->neName }}" class="bj-btn-table-edit form-control-sm editNeighborhood-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $neighborhood->neId }}</span>
							<span hidden>{{ $neighborhood->neName }}</span>
							<span hidden>{{ $neighborhood->neCode }}</span>
							<span hidden>{{ $neighborhood->depId }}</span>
							<span hidden>{{ $neighborhood->munId }}</span>
							<span hidden>{{ $neighborhood->zonId }}</span>
						</a>
						<a href="#" title="Eliminar barrio {{ $neighborhood->neName }}" class="bj-btn-table-delete form-control-sm deleteNeighborhood-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $neighborhood->neId }}</span>
							<span hidden>{{ $neighborhood->neName }}</span>
							<span hidden>{{ $neighborhood->neCode }}</span>
							<span hidden>{{ $neighborhood->depName }}</span>
							<span hidden>{{ $neighborhood->munName }}</span>
							<span hidden>{{ $neighborhood->zonName }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newNeighborhood-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVO BARRIO:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('neighborhoods.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">DEPARTAMENTO:</small>
									<select name="neDepartment_id" class="form-control form-control-sm" required>
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
									<select name="neMunicipality_id" class="form-control form-control-sm" required>
										<option value="">Seleccione un municipio...</option>
										<!-- options dinamics -->
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">ZONA:</small>
									<select name="neZoning_id" class="form-control form-control-sm" required>
										<option value="">Seleccione una zona...</option>
										<!-- options dinamics -->
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">BARRIO:</small>
									<input type="text" name="neName" maxlength="50" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">CODIGO POSTAL:</small>
									<input type="number" name="neCode" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
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

	<div class="modal fade" id="editNeighborhood-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR BARRIO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('neighborhoods.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">DEPARTAMENTO:</small>
									<select name="neDepartment_id_Edit" class="form-control form-control-sm" required>
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
									<select name="neMunicipality_id_Edit" class="form-control form-control-sm" required>
										<option value="">Seleccione un municipio...</option>
										<!-- options dinamics -->
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">ZONA:</small>
									<select name="neZoning_id_Edit" class="form-control form-control-sm" required>
										<option value="">Seleccione un municipio...</option>
										<!-- options dinamics -->
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<small class="text-muted">BARRIO:</small>
									<input type="text" name="neName_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">CODIGO POSTAL:</small>
									<input type="number" name="neCode_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="neId_Edit" value="" required>
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

	<div class="modal fade" id="deleteNeighborhood-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE BARRIO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">BARRIO / CODIGO POSTAL: </small><br>
							<span class="text-muted"><b class="neName_Delete"></b></span><br>
							<small class="text-muted">DE ZONA/MUNICIPIO/DEPARTAMENTO: </small><br>
							<span class="text-muted"><b class="neZoning_Delete"></b></span>
							/
							<span class="text-muted"><b class="neMunicipality_Delete"></b></span>
							/
							<span class="text-muted"><b class="neDepartment_Delete"></b></span>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('neighborhoods.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="neId_Delete" value="" required>
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

		$('.newNeighborhood-link').on('click',function(){
			$('#newNeighborhood-modal').modal();
		});

		// Eveneto para abrir ventana modal de edicion de las zonas
		$('.editNeighborhood-link').on('click',function(e){
			e.preventDefault();
			var neId = $(this).find('span:nth-child(2)').text();
			var neName = $(this).find('span:nth-child(3)').text();
			var neCode = $(this).find('span:nth-child(4)').text();
			var depId = $(this).find('span:nth-child(5)').text();
			var munId = $(this).find('span:nth-child(6)').text();
			var zonId = $(this).find('span:nth-child(7)').text();
			$('input[name=neId_Edit]').val(neId);
			$('input[name=neName_Edit]').val(neName);
			$('input[name=neCode_Edit]').val(neCode);
			$('select[name=neMunicipality_id_Edit]').empty();
			$('select[name=neMunicipality_id_Edit]').append("<option value=''>Seleccione un municipio...</option>");
			$('select[name=neZoning_id_Edit]').empty();
			$('select[name=neZoning_id_Edit]').append("<option value=''>Seleccione una zona...</option>");
			if(depId != ''){
				$('select[name=neDepartment_id_Edit]').val(depId);
				$.get("{{ route('getMunicipalities') }}",{ depId: depId },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					var municipalitySelected = 0;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							if(objectMunicipalities[i]['munId'] == munId){
								municipalitySelected = objectMunicipalities[i]['munId'];
								$('select[name=neMunicipality_id_Edit]').append(
									"<option value='" + objectMunicipalities[i]['munId'] + "' selected>" + 
										objectMunicipalities[i]['munName'] + 
									"</option>"
								);
							}else{
								$('select[name=neMunicipality_id_Edit]').append(
									"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
										objectMunicipalities[i]['munName'] + 
									"</option>"
								);
							}								
						}
					}
					if(municipalitySelected > 0){
						$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
							var count = Object.keys(objectZonings).length;
							if(count > 0){
								for (var i = 0; i < count; i++) {
									if(objectZonings[i]['zonId'] == zonId){
										$('select[name=neZoning_id_Edit]').append(
											"<option value='" + objectZonings[i]['zonId'] + "' selected>" + 
												objectZonings[i]['zonName'] + 
											"</option>"
										);
									}else{
										$('select[name=neZoning_id_Edit]').append(
											"<option value='" + objectZonings[i]['zonId'] + "'>" + 
												objectZonings[i]['zonName'] + 
											"</option>"
										);
									}
								}
							}
						});
					}
				});
			}else{
				$('select[name=neDepartment_id_Edit]').val('');
			}
			$('#editNeighborhood-modal').modal();
		});

		// Evento de consulta para actualizar municipios de acuerdo al departamento seleccionado (Modal de creacion de zonas)
		$('select[name=neDepartment_id]').on('change',function(e){
			var departmentSelected = e.target.value;
			$('select[name=neMunicipality_id]').empty();
			$('select[name=neMunicipality_id]').append("<option value=''>Seleccione un municipio...</option>");
			$('select[name=neZoning_id]').empty();
			$('select[name=neZoning_id]').append("<option value=''>Seleccione una zona...</option>");
			if(departmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: departmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=neMunicipality_id]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// Evento de consulta para actualizar zonas de acuerdo al municipio seleccionado (Modal de creacion de zonas)
		$('select[name=neMunicipality_id]').on('change',function(e){
			var municipalitySelected = e.target.value;
			$('select[name=neZoning_id]').empty();
			$('select[name=neZoning_id]').append("<option value=''>Seleccione una zona...</option>");
			if(municipalitySelected != ''){
				$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
					var count = Object.keys(objectZonings).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=neZoning_id]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// Evento de consulta para actualizar municipios de acuerdo al departamento seleccionado (Modal de edición)
		$('select[name=neDepartment_id_Edit]').on('change',function(e){
			var departmentSelected = e.target.value;
			$('select[name=neMunicipality_id_Edit]').empty();
			$('select[name=neMunicipality_id_Edit]').append("<option value=''>Seleccione un municipio...</option>");
			$('select[name=neZoning_id_Edit]').empty();
			$('select[name=neZoning_id_Edit]').append("<option value=''>Seleccione una zona...</option>");
			if(departmentSelected != ''){
				$.get("{{ route('getMunicipalities') }}",{ depId: departmentSelected },function(objectMunicipalities){
					var count = Object.keys(objectMunicipalities).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=neMunicipality_id_Edit]').append(
								"<option value='" + objectMunicipalities[i]['munId'] + "'>" + 
									objectMunicipalities[i]['munName'] + 
								"</option>"
							);
						}
					}
				});
			}
		});

		// Evento de consulta para actualizar zonas de acuerdo al municipio seleccionado (Modal de edición)
		$('select[name=neMunicipality_id_Edit]').on('change',function(e){
			var municipalitySelected = e.target.value;
			$('select[name=neZoning_id_Edit]').empty();
			$('select[name=neZoning_id_Edit]').append("<option value=''>Seleccione una zona...</option>");
			if(municipalitySelected != ''){
				$.get("{{ route('getZonings') }}",{ munId: municipalitySelected },function(objectZonings){
					var count = Object.keys(objectZonings).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=neZoning_id_Edit]').append(
								"<option value='" + objectZonings[i]['zonId'] + "'>" + 
									objectZonings[i]['zonName'] + 
								"</option>"
							);
						}
					}
				});
			}else{
				$('select[name=neDepartment_id_Edit]').empty();
				$('select[name=neDepartment_id_Edit]').append("<option value=''>Seleccione un departamento...</option>");
				$('select[name=neZoning_id_Edit]').empty();
				$('select[name=neZoning_id_Edit]').append("<option value=''>Seleccione un departamento...</option>");
			}
		});

		$('.deleteNeighborhood-link').on('click',function(e){
			e.preventDefault();
			var neId = $(this).find('span:nth-child(2)').text();
			var neName = $(this).find('span:nth-child(3)').text();
			var neCode = $(this).find('span:nth-child(4)').text();
			var depName = $(this).find('span:nth-child(5)').text();
			var munName = $(this).find('span:nth-child(6)').text();
			var zonName = $(this).find('span:nth-child(7)').text();
			$('input[name=neId_Delete]').val(neId);
			$('.neName_Delete').text(neName + ' - Cod. ' + neCode);
			$('.neDepartment_Delete').text(depName);
			$('.neMunicipality_Delete').text(munName);
			$('.neZoning_Delete').text(zonName);
			$('#deleteNeighborhood-modal').modal();
		});
	</script>
@endsection