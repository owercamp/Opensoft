@extends('modules.settingServices')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>MENSAJERIA EXPRESS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar mensajeria" class="bj-btn-table-add form-control-sm newMessenger-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessMessengers'))
				    <div class="alert alert-success">
				        {{ session('SuccessMessengers') }}
				    </div>
				@endif
				@if(session('PrimaryMessengers'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryMessengers') }}
				    </div>
				@endif
				@if(session('WarningMessengers'))
				    <div class="alert alert-warning">
				        {{ session('WarningMessengers') }}
				    </div>
				@endif
				@if(session('SecondaryMessengers'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryMessengers') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>PRODUCTO</th>
					<th>SERVICIO</th>
					<th>TIEMPO DE DISPONIBILIDAD</th>
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($messengers as $messenger)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $messenger->pmProduct }}</td>
					<td>{{ $messenger->smService }}</td>
					<td>{{ $messenger->smAvailability }}</td>
					@if(strlen($messenger->smDescription) > 50)
						<td>{{ substr($messenger->smDescription,0,50) . ' ... ' }}</td>
					@else
						<td>{{ $messenger->smDescription }}</td>
					@endif
					<td>
						<a href="#" title="Editar mensajeria {{ $messenger->smService }}" class="bj-btn-table-edit form-control-sm editMessenger-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $messenger->smId }}</span>
							<span hidden>{{ $messenger->smProduct_id }}</span>
							<span hidden>{{ $messenger->smService }}</span>
							<span hidden>{{ $messenger->smAvailability }}</span>
							<span hidden>{{ $messenger->smDescription }}</span>
						</a>
						<a href="#" title="Eliminar mensajeria {{ $messenger->smService }}" class="bj-btn-table-delete form-control-sm deleteMessenger-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $messenger->smId }}</span>
							<span hidden>{{ $messenger->pmProduct }}</span>
							<span hidden>{{ $messenger->smService }}</span>
							<span hidden>{{ $messenger->smAvailability }}</span>
							<span hidden>{{ $messenger->smDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newMessenger-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA MENSAJERIA DE SERVICIO:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('services.messenger.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">TIPO DE PRODUCTO:</small>
									<select name="smProduct_id" class="form-control form-control-sm" required>
										<option value="">Seleccione un tipo de producto ...</option>
										@foreach($productsmessengers as $productsmessenger)
											<option value="{{ $productsmessenger->pmId }}">{{ $productsmessenger->pmProduct }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<small class="text-muted">SERVICIO:</small>
									<input type="text" name="smService" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Ruta empresarial" required>
								</div>
								<div class="form-group">
									<small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
									<input type="text" name="smAvailability" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 2 Horas" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="smDescription" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de entrega express" required></textarea>
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

	<div class="modal fade" id="editMessenger-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR MENSAJERIA DE SERVICIO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('services.messenger.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">TIPO DE PRODUCTO:</small>
									<select name="smProduct_id_Edit" class="form-control form-control-sm" required>
										<option value="">Seleccione un tipo de producto ...</option>
										@foreach($productsmessengers as $productsmessenger)
											<option value="{{ $productsmessenger->pmId }}">{{ $productsmessenger->pmProduct }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<small class="text-muted">SERVICIO:</small>
									<input type="text" name="smService_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
									<input type="text" name="smAvailability_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="smDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="smId_Edit" value="" required>
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

	<div class="modal fade" id="deleteMessenger-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE MENSAJERIA DE SERVICIO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">TIPO DE PRODUCTO: </small><br>
							<span class="text-muted"><b class="smProduct_id_Delete"></b></span><br>
							<small class="text-muted">SERVICIO: </small><br>
							<span class="text-muted"><b class="smService_Delete"></b></span><br>
							<small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
							<span class="text-muted"><b class="smAvailability_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="smDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('services.messenger.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="smId_Delete" value="" required>
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

		$('.newMessenger-link').on('click',function(){
			$('#newMessenger-modal').modal();
		});

		$('.editMessenger-link').on('click',function(e){
			e.preventDefault();
			var smId = $(this).find('span:nth-child(2)').text();
			var smProduct_id = $(this).find('span:nth-child(3)').text();
			var smService = $(this).find('span:nth-child(4)').text();
			var smAvailability = $(this).find('span:nth-child(5)').text();
			var smDescription = $(this).find('span:nth-child(6)').text();
			$('input[name=smId_Edit]').val(smId);
			$('select[name=smProduct_id_Edit]').val(smProduct_id);
			$('input[name=smService_Edit]').val(smService);
			$('input[name=smAvailability_Edit]').val(smAvailability);
			$('textarea[name=smDescription_Edit]').val(smDescription);
			$('#editMessenger-modal').modal();
		});

		$('.deleteMessenger-link').on('click',function(e){
			e.preventDefault();
			var smId = $(this).find('span:nth-child(2)').text();
			var smProduct_id = $(this).find('span:nth-child(3)').text();
			var smService = $(this).find('span:nth-child(4)').text();
			var smAvailability = $(this).find('span:nth-child(5)').text();
			var smDescription = $(this).find('span:nth-child(6)').text();
			$('input[name=smId_Delete]').val(smId);
			$('.smProduct_id_Delete').text(smProduct_id);
			$('.smService_Delete').text(smService);		
			$('.smAvailability_Delete').text(smAvailability);
			$('.smDescription_Delete').text(smDescription);
			$('#deleteMessenger-modal').modal();
		});
	</script>
@endsection