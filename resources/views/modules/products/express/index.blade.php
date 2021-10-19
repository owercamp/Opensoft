@extends('modules.settingProducts')

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
					<th>PRODUCTO</th>
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($charges as $charge)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $charge->pcProduct }}</td>
					@if(strlen($charge->pcDescription) > 50)
						<td>{{ substr($charge->pcDescription,0,50) . ' ... ' }}</td>
					@else
						<td>{{ $charge->pcDescription }}</td>
					@endif
					<td>
						<a href="#" title="Editar carga express {{ $charge->pcProduct }}" class="bj-btn-table-edit form-control-sm editExpress-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $charge->pcId }}</span>
							<span hidden>{{ $charge->pcProduct }}</span>
							<span hidden>{{ $charge->pcDescription }}</span>
						</a>
						<a href="#" title="Eliminar carga express {{ $charge->pcProduct }}" class="bj-btn-table-delete form-control-sm deleteExpress-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $charge->pcId }}</span>
							<span hidden>{{ $charge->pcProduct }}</span>
							<span hidden>{{ $charge->pcDescription }}</span>
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
					<h6>NUEVA CARGA EXPRESS DE PRODUCTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.express.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="pcProduct" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="pcDescription" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
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
					<h6>EDITAR CARGA EXPRESS DE PRODUCTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.express.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">PRODUCTO:</small>
									<input type="text" name="pcProduct_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<textarea name="pcDescription_Edit" maxlength="200" class="form-control form-control-sm" rows="2" required></textarea>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="pcId_Edit" value="" required>
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
					<h5>ELIMINACION DE CARGA EXPRESS DE PRODUCTO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">PRODUCTO: </small><br>
							<span class="text-muted"><b class="pcProduct_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="pcDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('products.express.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="pcId_Delete" value="" required>
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
			var pcId = $(this).find('span:nth-child(2)').text();
			var pcProduct = $(this).find('span:nth-child(3)').text();
			var pcDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=pcId_Edit]').val(pcId);
			$('input[name=pcProduct_Edit]').val(pcProduct);
			$('textarea[name=pcDescription_Edit]').val(pcDescription);
			$('#editExpress-modal').modal();
		});

		$('.deleteExpress-link').on('click',function(e){
			e.preventDefault();
			var pcId = $(this).find('span:nth-child(2)').text();
			var pcProduct = $(this).find('span:nth-child(3)').text();
			var pcDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=pcId_Delete]').val(pcId);
			$('.pcProduct_Delete').text(pcProduct);
			$('.pcDescription_Delete').text(pcDescription);
			$('#deleteExpress-modal').modal();
		});
	</script>
@endsection