@extends('modules.settingProducts')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>TRASLADOS INTERMUNICIPALES</h6>
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
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($transfers as $transfer)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $transfer->ptmProduct }}</td>
					@if(strlen($transfer->ptmDescription) > 50)
						<td>{{ substr($transfer->ptmDescription,0,50) . ' ... ' }}</td>
					@else
						<td>{{ $transfer->ptmDescription }}</td>
					@endif
					<td>
						<a href="#" title="Editar traslado {{ $transfer->ptmProduct }}" class="bj-btn-table-edit form-control-sm editTransfer-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $transfer->ptmId }}</span>
							<span hidden>{{ $transfer->ptmProduct }}</span>
							<span hidden>{{ $transfer->ptmDescription }}</span>
						</a>
						<a href="#" title="Eliminar traslado {{ $transfer->ptmProduct }}" class="bj-btn-table-delete form-control-sm deleteTransfer-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $transfer->ptmId }}</span>
							<span hidden>{{ $transfer->ptmProduct }}</span>
							<span hidden>{{ $transfer->ptmDescription }}</span>
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
					<h6>NUEVO TRASLADO INTERMUNICIPAL DE PRODUCTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.transfersmunicipals.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="ptmProduct" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Nombre de producto" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="ptmDescription" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de extrega express" required></textarea>
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
					<h6>EDITAR TRASLADO INTERMUNICIPAL DE PRODUCTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.transfersmunicipals.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="ptmProduct_Edit" maxlength="50" class="form-control form-control-sm" placeholder="Ej. Nombre de producto" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="ptmDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" placeholder="Ej. Es un servicio de extrega express" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="ptmId_Edit" value="" required>
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
					<h6>ELIMINACION DE TRASLADO INTERMUNICIPAL DE PRODUCTO:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">PRODUCTO: </small><br>
							<span class="text-muted"><b class="ptmProduct_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="ptmDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('products.transfersmunicipals.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="ptmId_Delete" value="" required>
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
			var ptmId = $(this).find('span:nth-child(2)').text();
			var ptmProduct = $(this).find('span:nth-child(3)').text();
			var ptmDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=ptmId_Edit]').val(ptmId);
			$('input[name=ptmProduct_Edit]').val(ptmProduct);
			$('textarea[name=ptmDescription_Edit]').val(ptmDescription);
			$('#editTransfer-modal').modal();
		});

		$('.deleteTransfer-link').on('click',function(e){
			e.preventDefault();
			var ptmId = $(this).find('span:nth-child(2)').text();
			var ptmProduct = $(this).find('span:nth-child(3)').text();
			var ptmDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=ptmId_Delete]').val(ptmId);
			$('.ptmProduct_Delete').text(ptmProduct);
			$('.ptmDescription_Delete').text(ptmDescription);
			$('#deleteTransfer-modal').modal();
		});
	</script>
@endsection