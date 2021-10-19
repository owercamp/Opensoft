@extends('modules.administrativeProviders')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>PRODUCTOS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar un producto" class="bj-btn-table-add form-control-sm newProduct-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessProducts'))
				    <div class="alert alert-success">
				        {{ session('SuccessProducts') }}
				    </div>
				@endif
				@if(session('PrimaryProducts'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryProducts') }}
				    </div>
				@endif
				@if(session('WarningProducts'))
				    <div class="alert alert-warning">
				        {{ session('WarningProducts') }}
				    </div>
				@endif
				@if(session('SecondaryProducts'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryProducts') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE</th>
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($products as $product)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $product->ppName }}</td>
					<td>{{ $product->ppDescription }}</td>
					<td>
						<a href="#" title="Editar producto {{ $product->ppName }}" class="bj-btn-table-edit form-control-sm editProduct-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $product->ppId }}</span>
							<span hidden>{{ $product->ppName }}</span>
							<span hidden>{{ $product->ppDescription }}</span>
						</a>
						<a href="#" title="Eliminar producto {{ $product->ppName }}" class="bj-btn-table-delete form-control-sm deleteProduct-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $product->ppId }}</span>
							<span hidden>{{ $product->ppName }}</span>
							<span hidden>{{ $product->ppDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newProduct-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVO PRODUCTO:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('providers.products.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DEL PRODUCTO:</small>
									<input type="text" name="ppName" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 0000000000" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="ppDescription" rows="2" maxlength="200" class="form-control form-control-sm" required></textarea>
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

	<div class="modal fade" id="editProduct-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('providers.products.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DEL PRODUCTO:</small>
									<input type="text" name="ppName_Edit" maxlength="50" pattern="[0-9]{1,50}" class="form-control form-control-sm" placeholder="Ej. 0000000000" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="ppDescription_Edit" rows="2" maxlength="200" class="form-control form-control-sm" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="ppId_Edit" value="" required>
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

	<div class="modal fade" id="deleteProduct-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">NOMBRE DEL PRODUCTO: </small><br>
							<span class="text-muted"><b class="ppName_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="ppDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('providers.products.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="ppId_Delete" value="" required>
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

		$('.newProduct-link').on('click',function(){
			$('#newProduct-modal').modal();
		});

		$('.editProduct-link').on('click',function(e){
			e.preventDefault();
			var ppId = $(this).find('span:nth-child(2)').text();
			var ppName = $(this).find('span:nth-child(3)').text();
			var ppDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=ppId_Edit]').val(ppId);
			$('input[name=ppName_Edit]').val(ppName);
			$('textarea[name=ppDescription_Edit]').val(ppDescription);
			$('#editProduct-modal').modal();
		});

		$('.deleteProduct-link').on('click',function(e){
			e.preventDefault();
			var ppId = $(this).find('span:nth-child(2)').text();
			var ppName = $(this).find('span:nth-child(3)').text();
			var ppDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=ppId_Delete]').val(ppId);
			$('.ppName_Delete').text(ppName);
			$('.ppDescription_Delete').text(ppDescription);
			$('#deleteProduct-modal').modal();
		});
	</script>
@endsection