@extends('modules.settingProducts')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>TRASLADOS URBANOS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar traslado" class="bj-btn-table-add form-control-sm newTransfer-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessTransfer'))
				    <div class="alert alert-success">
				        {{ session('SuccessTransfer') }}
				    </div>
				@endif
				@if(session('PrimaryTransfer'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryTransfer') }}
				    </div>
				@endif
				@if(session('WarningTransfer'))
				    <div class="alert alert-warning">
				        {{ session('WarningTransfer') }}
				    </div>
				@endif
				@if(session('SecondaryTransfer'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryTransfer') }}
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
				@foreach($transfers as $transfer)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $transfer->ptrProduct }}</td>
					<td>{{ $transfer->ptrAvailability }}</td>
					@if(strlen($transfer->ptrDescription) > 50)
						<td>{{ substr($transfer->ptrDescription,0,50) . ' ... ' }}</td>
					@else
						<td>{{ $transfer->ptrDescription }}</td>
					@endif
					<td>
						<a href="#" title="Editar traslado {{ $transfer->ptrProduct }}" class="bj-btn-table-edit form-control-sm editTransfer-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $transfer->ptrId }}</span>
							<span hidden>{{ $transfer->ptrProduct }}</span>
							<span hidden>{{ $transfer->ptrAvailability }}</span>
							<span hidden>{{ $transfer->ptrDescription }}</span>
						</a>
						<a href="#" title="Eliminar traslado {{ $transfer->ptrProduct }}" class="bj-btn-table-delete form-control-sm deleteTransfer-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $transfer->ptrId }}</span>
							<span hidden>{{ $transfer->ptrProduct }}</span>
							<span hidden>{{ $transfer->ptrAvailability }}</span>
							<span hidden>{{ $transfer->ptrDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newTransfer-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVO TRASLADO DE PRODUCTO:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.transfers.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="ptrProduct" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Ruta empresarial" required>
								</div>
								<div class="form-group">
									<small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
									<input type="text" name="ptrAvailability" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 2 Horas" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="ptrDescription" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de extrega express" required></textarea>
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

	<div class="modal fade" id="editTransfer-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR TRASLADO DE PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.transfers.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="ptrProduct_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Paseo minas de sal zipaquirá" required>
								</div>
								<div class="form-group">
									<small class="text-muted">TIEMPO DE DISPONIBILIDAD:</small>
									<input type="text" name="ptrAvailability_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. 6 Horas" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="ptrDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de extrega express" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="ptrId_Edit" value="" required>
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

	<div class="modal fade" id="deleteTransfer-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE TRASLADO DE PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">PRODUCTO: </small><br>
							<span class="text-muted"><b class="ptrProduct_Delete"></b></span><br>
							<small class="text-muted">TIEMPO DE DISPONIBILIDAD: </small><br>
							<span class="text-muted"><b class="ptrAvailability_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="ptrDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('products.transfers.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="ptrId_Delete" value="" required>
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

		$('.newTransfer-link').on('click',function(){
			$('#newTransfer-modal').modal();
		});

		$('.editTransfer-link').on('click',function(e){
			e.preventDefault();
			var ptrId = $(this).find('span:nth-child(2)').text();
			var ptrProduct = $(this).find('span:nth-child(3)').text();
			var ptrAvailability = $(this).find('span:nth-child(4)').text();
			var ptrDescription = $(this).find('span:nth-child(5)').text();
			$('input[name=ptrId_Edit]').val(ptrId);
			$('input[name=ptrProduct_Edit]').val(ptrProduct);
			$('input[name=ptrAvailability_Edit]').val(ptrAvailability);
			$('textarea[name=ptrDescription_Edit]').val(ptrDescription);
			$('#editTransfer-modal').modal();
		});

		$('.deleteTransfer-link').on('click',function(e){
			e.preventDefault();
			var ptrId = $(this).find('span:nth-child(2)').text();
			var ptrProduct = $(this).find('span:nth-child(3)').text();
			var ptrAvailability = $(this).find('span:nth-child(4)').text();
			var ptrDescription = $(this).find('span:nth-child(5)').text();
			$('input[name=ptrId_Delete]').val(ptrId);
			$('.ptrProduct_Delete').text(ptrProduct);
			$('.ptrAvailability_Delete').text(ptrAvailability);
			$('.ptrDescription_Delete').text(ptrDescription);
			$('#deleteTransfer-modal').modal();
		});
	</script>
@endsection