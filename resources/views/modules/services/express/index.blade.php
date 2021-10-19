@extends('modules.settingServices')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>CARGA EXPRESS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar carga express" class="bj-btn-table-add form-control-sm newExpress-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessExpress'))
				    <div class="alert alert-success">
				        {{ session('SuccessExpress') }}
				    </div>
				@endif
				@if(session('PrimaryExpress'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryExpress') }}
				    </div>
				@endif
				@if(session('WarningExpress'))
				    <div class="alert alert-warning">
				        {{ session('WarningExpress') }}
				    </div>
				@endif
				@if(session('SecondaryExpress'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryExpress') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>SERVICIO</th>
					<th>DESCRIPCION</th>
					<th>TIPO DE PRODUCTO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($charges as $charge)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $charge->scService }}</td>
					@if(strlen($charge->scDescription) > 50)
						<td>{{ substr($charge->scDescription,0,50) . ' ... ' }}</td>
					@else
						<td>{{ $charge->scDescription }}</td>
					@endif
					<td>{{ $charge->pcProduct }}</td>
					<td>
						<a href="#" title="Editar carga express {{ $charge->scService }}" class="bj-btn-table-edit form-control-sm editExpress-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $charge->scId }}</span>
							<span hidden>{{ $charge->scTypeproduct_id }}</span>
							<span hidden>{{ $charge->scService }}</span>
							<span hidden>{{ $charge->scUnit }}</span>
							<span hidden>{{ $charge->scKilos }}</span>
							<span hidden>{{ $charge->scDimensions }}</span>
							<span hidden>{{ $charge->scDescription }}</span>
						</a>
						<a href="#" title="Eliminar carga express {{ $charge->scService }}" class="bj-btn-table-delete form-control-sm deleteExpress-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $charge->scId }}</span>
							<span hidden>{{ $charge->pcProduct }}</span>
							<span hidden>{{ $charge->scService }}</span>
							<span hidden>{{ $charge->scUnit }}</span>
							<span hidden>{{ $charge->scKilos }}</span>
							<span hidden>{{ $charge->scDimensions }}</span>
							<span hidden>{{ $charge->scDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newExpress-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CARGA EXPRESS DE SERVICIOS:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('services.express.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">TIPO DE PRODUCTO:</small>
									<select name="scTypeproduct_id" class="form-control form-control-sm" required>
										<option value="">Seleccione ...</option>
										@foreach($productsexpress as $typeproduct)
											<option value="{{ $typeproduct->pcId }}">{{ $typeproduct->pcProduct }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<small class="text-muted">SERVICIO:</small>
									<input type="text" name="scService" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">MAXIMA UNIDADES:</small>
									<input type="text" name="scUnit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">MAXIMO PESO VOLUMEN:</small>
									<div class="input-group">
										<input type="text" name="scKilos" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
										<div class="input-group-prepend">
										    <span class="input-group-text" style="font-size: 11px;">
										    	Kilos
										    </span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col -md-12">
										<div class="row border-bottom">
											<small class="text-muted ml-3">DIMENSIONES MAXIMAS:</small>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">ALTO:</small>
													<div class="input-group">
														<input type="text" name="scDimensions_height" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
														<div class="input-group-prepend">
														    <span class="input-group-text" style="font-size: 11px;">
														    	Cm
														    </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">LARGO:</small>
													<div class="input-group">
														<input type="text" name="scDimensions_long" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
														<div class="input-group-prepend">
														    <span class="input-group-text" style="font-size: 11px;">
														    	Cm
														    </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">ANCHO:</small>
													<div class="input-group">
														<input type="text" name="scDimensions_width" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
														<div class="input-group-prepend">
														    <span class="input-group-text" style="font-size: 11px;">
														    	Cm
														    </span>
														</div>
													</div>
												</div>
											</div>	
										</div>
									</div>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="scDescription" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
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

	<div class="modal fade" id="editExpress-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>EDITAR CARGA EXPRESS DE SERVICIOS:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('services.express.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">TIPO DE PRODUCTO:</small>
									<select name="scTypeproduct_id_Edit" class="form-control form-control-sm" required>
										<option value="">Seleccione ...</option>
										@foreach($productsexpress as $typeproduct)
											<option value="{{ $typeproduct->pcId }}">{{ $typeproduct->pcProduct }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<small class="text-muted">SERVICIO:</small>
									<input type="text" name="scService_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">MAXIMA UNIDADES:</small>
									<input type="text" name="scUnit_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">MAXIMO PESO VOLUMEN:</small>
									<div class="input-group">
										<input type="text" name="scKilos_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
										<div class="input-group-prepend">
										    <span class="input-group-text" style="font-size: 11px;">
										    	Kilos
										    </span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col -md-12">
										<div class="row border-bottom">
											<small class="text-muted ml-3">DIMENSIONES MAXIMAS:</small>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">ALTO:</small>
													<div class="input-group">
														<input type="text" name="scDimensions_height_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
														<div class="input-group-prepend">
														    <span class="input-group-text" style="font-size: 11px;">
														    	Cm
														    </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">LARGO:</small>
													<div class="input-group">
														<input type="text" name="scDimensions_long_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
														<div class="input-group-prepend">
														    <span class="input-group-text" style="font-size: 11px;">
														    	Cm
														    </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<small class="text-muted">ANCHO:</small>
													<div class="input-group">
														<input type="text" name="scDimensions_width_Edit" maxlength="10" pattern="[0-9]{1,10}" class="form-control form-control-sm" required>
														<div class="input-group-prepend">
														    <span class="input-group-text" style="font-size: 11px;">
														    	Cm
														    </span>
														</div>
													</div>
												</div>
											</div>	
										</div>
									</div>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="scDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="scId_Edit" value="" required>
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

	<div class="modal fade" id="deleteExpress-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE CARGA EXPRESS DE SERVICIOS:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">SERVICIO: </small><br>
							<span class="text-muted"><b class="scService_Delete"></b></span><br>
							<small class="text-muted">TIPO DE PRODUCTO: </small><br>
							<span class="text-muted"><b class="scTypeproduct_id_Delete"></b></span><br>
							<small class="text-muted">MAXIMAS UNIDADES: </small><br>
							<span class="text-muted"><b class="scUnit_Delete"></b></span><br>
							<small class="text-muted">MAXIMO PESO VOLUMEN: </small><br>
							<span class="text-muted"><b class="scKilos_Delete"></b></span><br>
							<small class="text-muted">DIMENSIONES MAXIMAS: </small><br>
							<small class="text-muted">Alto: </small><br>
							<span class="text-muted"><b class="scHeight_Delete"></b></span><br>
							<small class="text-muted">Largo: </small><br>
							<span class="text-muted"><b class="scLong_Delete"></b></span><br>
							<small class="text-muted">Ancho: </small><br>
							<span class="text-muted"><b class="scWidth_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="scDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('services.express.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="scId_Delete" value="" required>
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

		$('.newExpress-link').on('click',function(){
			$('#newExpress-modal').modal();
		});

		$('.editExpress-link').on('click',function(e){
			e.preventDefault();
			var scId = $(this).find('span:nth-child(2)').text();
			var scTypeproduct_id = $(this).find('span:nth-child(3)').text();
			var scService = $(this).find('span:nth-child(4)').text();
			var scUnit = $(this).find('span:nth-child(5)').text();
			var scKilos = $(this).find('span:nth-child(6)').text();
			var scDimensions = $(this).find('span:nth-child(7)').text();
			var scDescription = $(this).find('span:nth-child(8)').text();
			$('input[name=scId_Edit]').val(scId);
			$('select[name=scTypeproduct_id_Edit]').val(scTypeproduct_id);
			$('input[name=scService_Edit]').val(scService);
			$('input[name=scUnit_Edit]').val(scUnit);
			$('input[name=scKilos_Edit]').val(scKilos);

			var find = scDimensions.indexOf('-');
			if(find > -1){
				var separated = scDimensions.split('-');
				$('input[name=scDimensions_height_Edit]').val(separated[0]);
				$('input[name=scDimensions_long_Edit]').val(separated[1]);
				$('input[name=scDimensions_width_Edit]').val(separated[2]);
			}else{
				$('input[name=scDimensions_height_Edit]').val('');
				$('input[name=scDimensions_long_Edit]').val('');
				$('input[name=scDimensions_width_Edit]').val('');
			}
			$('textarea[name=scDescription_Edit]').val(scDescription);
			$('#editExpress-modal').modal();
		});

		$('.deleteExpress-link').on('click',function(e){
			e.preventDefault();
			var scId = $(this).find('span:nth-child(2)').text();
			var scTypeproduct_id = $(this).find('span:nth-child(3)').text();
			var scService = $(this).find('span:nth-child(4)').text();
			var scUnit = $(this).find('span:nth-child(5)').text();
			var scKilos = $(this).find('span:nth-child(6)').text();
			var scDimensions = $(this).find('span:nth-child(7)').text();
			var scDescription = $(this).find('span:nth-child(8)').text();
			$('input[name=scId_Delete]').val(scId);
			$('.scTypeproduct_id_Delete').text(scTypeproduct_id);
			$('.scService_Delete').text(scService);
			$('.scUnit_Delete').text(scUnit);
			$('.scKilos_Delete').text(scKilos);
			var separated = scDimensions.split('-');
			$('.scHeight_Delete').text(separated[0] + ' Centimetros');
			$('.scLong_Delete').text(separated[1] + ' Centimetros');
			$('.scWidth_Delete').text(separated[2] + ' Centimetros');
			$('.scDescription_Delete').text(scDescription);
			$('#deleteExpress-modal').modal();
		});
	</script>
@endsection