@extends('modules.settingSecurity')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>FONDO DE CESANTIAS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar un fondo de cesantias" class="bj-btn-table-add form-control-sm newLayoff-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessLayoffs'))
				    <div class="alert alert-success">
				        {{ session('SuccessLayoffs') }}
				    </div>
				@endif
				@if(session('PrimaryLayoffs'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryLayoffs') }}
				    </div>
				@endif
				@if(session('WarningLayoffs'))
				    <div class="alert alert-warning">
				        {{ session('WarningLayoffs') }}
				    </div>
				@endif
				@if(session('SecondaryLayoffs'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryLayoffs') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE DE FONDO DE CESANTIAS</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($layoffs as $layoff)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $layoff->layName }}</td>
					<td>
						<a href="#" title="Editar fondo {{ $layoff->layName }}" class="bj-btn-table-edit form-control-sm editLayoff-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $layoff->layId }}</span>
							<span hidden>{{ $layoff->layName }}</span>
						</a>
						<a href="#" title="Eliminar fondo {{ $layoff->layName }}" class="bj-btn-table-delete form-control-sm deleteLayoff-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $layoff->layId }}</span>
							<span hidden>{{ $layoff->layName }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newLayoff-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVO FONDO DE CESANTIAS:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('layoffs.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DE FONDO:</small>
									<input type="text" name="layName" maxlength="50" class="form-control form-control-sm" required>
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

	<div class="modal fade" id="editLayoff-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR FONDO DE CESANTIAS:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('layoffs.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DE FONDO:</small>
									<input type="text" name="layName_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="layId_Edit" value="" required>
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

	<div class="modal fade" id="deleteLayoff-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINAR FONDO DE CESANTIAS:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">NOMBRE DE FONDO: </small><br>
							<span class="text-muted"><b class="layName_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('layoffs.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="layId_Delete" value="" required>
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

		$('.newLayoff-link').on('click',function(){
			$('#newLayoff-modal').modal();
		});

		$('.editLayoff-link').on('click',function(e){
			e.preventDefault();
			var layId = $(this).find('span:nth-child(2)').text();
			var layName = $(this).find('span:nth-child(3)').text();
			$('input[name=layId_Edit]').val(layId);
			$('input[name=layName_Edit]').val(layName);
			$('#editLayoff-modal').modal();
		});

		$('.deleteLayoff-link').on('click',function(e){
			e.preventDefault();
			var layId = $(this).find('span:nth-child(2)').text();
			var layName = $(this).find('span:nth-child(3)').text();
			$('input[name=layId_Delete]').val(layId);
			$('.layName_Delete').text(layName);
			$('#deleteLayoff-modal').modal();
		});
	</script>
@endsection