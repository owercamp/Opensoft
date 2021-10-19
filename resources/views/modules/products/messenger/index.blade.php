@extends('modules.settingProducts')

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
					<td>{{ $messenger->pmAvailability }}</td>
					@if(strlen($messenger->pmDescription) > 50)
						<td>{{ substr($messenger->pmDescription,0,50) . ' ... ' }}</td>
					@else
						<td>{{ $messenger->pmDescription }}</td>
					@endif
					<td>
						<a href="#" title="Editar mensajeria {{ $messenger->pmProduct }}" class="bj-btn-table-edit form-control-sm editMessenger-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $messenger->pmId }}</span>
							<span hidden>{{ $messenger->pmProduct }}</span>
							<span hidden>{{ $messenger->pmAvailability }}</span>
							<span hidden>{{ $messenger->pmDescription }}</span>
						</a>
						<a href="#" title="Eliminar mensajeria {{ $messenger->pmProduct }}" class="bj-btn-table-delete form-control-sm deleteMessenger-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $messenger->pmId }}</span>
							<span hidden>{{ $messenger->pmProduct }}</span>
							<span hidden>{{ $messenger->pmAvailability }}</span>
							<span hidden>{{ $messenger->pmDescription }}</span>
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
					<h4>NUEVA MENSAJERIA DE PRODUCTO:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.messenger.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="pmProduct" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
									<input type="text" name="pmAvailability" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="pmDescription" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
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
					<h5>EDITAR MENSAJERIA DE PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.messenger.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="pmProduct_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
									<input type="text" name="pmAvailability_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="pmDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="pmId_Edit" value="" required>
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
					<h5>ELIMINACION DE MENSAJERIA DE PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">PRODUCTO: </small><br>
							<span class="text-muted"><b class="pmProduct_Delete"></b></span><br>
							<small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
							<span class="text-muted"><b class="pmAvailability_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="pmDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('products.messenger.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="pmId_Delete" value="" required>
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
			var pmId = $(this).find('span:nth-child(2)').text();
			var pmProduct = $(this).find('span:nth-child(3)').text();
			var pmAvailability = $(this).find('span:nth-child(4)').text();
			var pmDescription = $(this).find('span:nth-child(5)').text();
			$('input[name=pmId_Edit]').val(pmId);
			$('input[name=pmProduct_Edit]').val(pmProduct);
			$('input[name=pmAvailability_Edit]').val(pmAvailability);
			$('input[name=pmDescription_Edit]').val(pmDescription);
			$('#editMessenger-modal').modal();
		});

		$('.deleteMessenger-link').on('click',function(e){
			e.preventDefault();
			var pmId = $(this).find('span:nth-child(2)').text();
			var pmProduct = $(this).find('span:nth-child(3)').text();
			var pmAvailability = $(this).find('span:nth-child(4)').text();
			var pmDescription = $(this).find('span:nth-child(5)').text();
			$('input[name=pmId_Delete]').val(pmId);
			$('.pmProduct_Delete').text(pmProduct);
			$('.pmAvailability_Delete').text(pmAvailability);
			$('.pmDescription_Delete').text(pmDescription);
			$('#deleteMessenger-modal').modal();
		});
	</script>
@endsection