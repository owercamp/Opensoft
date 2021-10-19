@extends('modules.settingProducts')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>LOGISTICA EXPRESS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar logística" class="bj-btn-table-add form-control-sm newLogistic-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessLogistics'))
				    <div class="alert alert-success">
				        {{ session('SuccessLogistics') }}
				    </div>
				@endif
				@if(session('PrimaryLogistics'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryLogistics') }}
				    </div>
				@endif
				@if(session('WarningLogistics'))
				    <div class="alert alert-warning">
				        {{ session('WarningLogistics') }}
				    </div>
				@endif
				@if(session('SecondaryLogistics'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryLogistics') }}
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
				@foreach($logistics as $logistic)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $logistic->plProduct }}</td>
					@if(strlen($logistic->plDescription) > 50)
						<td>{{ substr($logistic->plDescription,0,50) . ' ... ' }}</td>
					@else
						<td>{{ $logistic->plDescription }}</td>
					@endif
					<td>
						<a href="#" title="Editar logística {{ $logistic->plProduct }}" class="bj-btn-table-edit form-control-sm editLogistic-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $logistic->plId }}</span>
							<span hidden>{{ $logistic->plProduct }}</span>
							<span hidden>{{ $logistic->plDescription }}</span>
						</a>
						<a href="#" title="Eliminar logística {{ $logistic->plProduct }}" class="bj-btn-table-delete form-control-sm deleteLogistic-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $logistic->plId }}</span>
							<span hidden>{{ $logistic->plProduct }}</span>
							<span hidden>{{ $logistic->plDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newLogistic-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA LOGISTICA DE PRODUCTO:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.logistic.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="plProduct" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="plDescription" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
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

	<div class="modal fade" id="editLogistic-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR LOGISTICA DE PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.logistic.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="plProduct_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="plDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="plId_Edit" value="" required>
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

	<div class="modal fade" id="deleteLogistic-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE LOGISTICA DE PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">PRODUCTO: </small><br>
							<span class="text-muted"><b class="plProduct_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="plDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('products.logistic.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="plId_Delete" value="" required>
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

		$('.newLogistic-link').on('click',function(){
			$('#newLogistic-modal').modal();
		});

		$('.editLogistic-link').on('click',function(e){
			e.preventDefault();
			var plId = $(this).find('span:nth-child(2)').text();
			var plProduct = $(this).find('span:nth-child(3)').text();
			var plDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=plId_Edit]').val(plId);
			$('input[name=plProduct_Edit]').val(plProduct);
			$('textarea[name=plDescription_Edit]').val(plDescription);
			$('#editLogistic-modal').modal();
		});

		$('.deleteLogistic-link').on('click',function(e){
			e.preventDefault();
			var plId = $(this).find('span:nth-child(2)').text();
			var plProduct = $(this).find('span:nth-child(3)').text();
			var plDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=plId_Delete]').val(plId);
			$('.plProduct_Delete').text(plProduct);
			$('.plDescription_Delete').text(plDescription);
			$('#deleteLogistic-modal').modal();
		});
	</script>
@endsection