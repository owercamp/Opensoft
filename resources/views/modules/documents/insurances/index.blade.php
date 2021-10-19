@extends('modules.settingDocuments')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>POLIZAS Y SEGUROS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar una poliza/seguro" class="bj-btn-table-add form-control-sm newInsurance-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessInsurances'))
				    <div class="alert alert-success">
				        {{ session('SuccessInsurances') }}
				    </div>
				@endif
				@if(session('PrimaryInsurances'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryInsurances') }}
				    </div>
				@endif
				@if(session('WarningInsurances'))
				    <div class="alert alert-warning">
				        {{ session('WarningInsurances') }}
				    </div>
				@endif
				@if(session('SecondaryInsurances'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryInsurances') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE DE POLIZA/SEGURO</th>
					<th>DESCRIPCION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($insurances as $insurance)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $insurance->insName }}</td>
					<td>{{ $insurance->insDescription }}</td>
					<td>
						<a href="#" title="Editar poliza/seguro {{ $insurance->insName }}" class="bj-btn-table-edit form-control-sm editInsurance-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $insurance->insId }}</span>
							<span hidden>{{ $insurance->insName }}</span>
							<span hidden>{{ $insurance->insDescription }}</span>
						</a>
						<a href="#" title="Eliminar poliza/seguro {{ $insurance->insName }}" class="bj-btn-table-delete form-control-sm deleteInsurance-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $insurance->insId }}</span>
							<span hidden>{{ $insurance->insName }}</span>
							<span hidden>{{ $insurance->insDescription }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newInsurance-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h4>NUEVA POLIZA/SEGURO:</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('insurance.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DE POLIZA/SEGURO:</small>
									<input type="text" name="insName" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<input type="text" name="insDescription" maxlength="100" class="form-control form-control-sm" required>
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

	<div class="modal fade" id="editInsurance-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>EDITAR POLIZA/SEGURO:</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('insurance.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="text-muted">NOMBRE DE POLIZA/SEGURO:</small>
									<input type="text" name="insName_Edit" maxlength="50" class="form-control form-control-sm" required>
								</div>
								<div class="form-group">
									<small class="text-muted">DESCRIPCION:</small>
									<input type="text" name="insDescription_Edit" maxlength="100" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="insId_Edit" value="" required>
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

	<div class="modal fade" id="deleteInsurance-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ELIMINACION DE POLIZA/SEGURO:</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<small class="text-muted">NOMBRE DE POLIZA/SEGURO: </small><br>
							<span class="text-muted"><b class="insName_Delete"></b></span><br>
							<small class="text-muted">DESCRIPCION: </small><br>
							<span class="text-muted"><b class="insDescription_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('insurance.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="insId_Delete" value="" required>
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

		$('.newInsurance-link').on('click',function(){
			$('#newInsurance-modal').modal();
		});

		$('.editInsurance-link').on('click',function(e){
			e.preventDefault();
			var insId = $(this).find('span:nth-child(2)').text();
			var insName = $(this).find('span:nth-child(3)').text();
			var insDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=insId_Edit]').val(insId);
			$('input[name=insName_Edit]').val(insName);
			$('input[name=insDescription_Edit]').val(insDescription);
			$('#editInsurance-modal').modal();
		});

		$('.deleteInsurance-link').on('click',function(e){
			e.preventDefault();
			var insId = $(this).find('span:nth-child(2)').text();
			var insName = $(this).find('span:nth-child(3)').text();
			var insDescription = $(this).find('span:nth-child(4)').text();
			$('input[name=insId_Delete]').val(insId);
			$('.insName_Delete').text(insName);
			$('.insDescription_Delete').text(insDescription);
			$('#deleteInsurance-modal').modal();
		});
	</script>
@endsection