@extends('modules.integralOperative')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h5>CREACION DE DOCUMENTOS</h5>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newCreation-link">NUEVO</button>
			</div>
			<div class="col-md-4">
				@if(session('SuccessCreation'))
					<div class="alert alert-success">
						{{ session('SuccessCreation') }}
					</div>
				@endif
				@if(session('PrimaryCreation'))
					<div class="alert alert-primary">
						{{ session('PrimaryCreation') }}
					</div>
				@endif
				@if(session('WarningCreation'))
					<div class="alert alert-warning">
						{{ session('WarningCreation') }}
					</div>
				@endif
				@if(session('SecondaryCreation'))
					<div class="alert alert-secondary">
						{{ session('SecondaryCreation') }}
					</div>
				@endif
			</div>			
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE DEL DOCUMENTO</th>
					<th>CODIGO</th>
					<th>VERSION</th>
					<th>FECHA DE ACTUALIZACION</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row= 1; @endphp
				@foreach ($DocumentOp as $item)
				<tr>
					<td>{{$row++}}</td>
					<td>{{$item->doOName}}</td>
					<td>{{$item->doOCode}}</td>
					<td>{{$item->doOVersion}}</td>
					<td>{{$item->doODate}}</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editCreation-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $item->doOId }}</span>
							<span hidden>{{ $item->doOName }}</span>
							<span hidden>{{ $item->doOCode }}</span>
							<span hidden>{{ $item->doOVersion }}</span>
							<span hidden>{{ $item->doODate }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteCreation-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $item->doOId }}</span>
							<span hidden>{{ $item->doOName }}</span>
							<span hidden>{{ $item->doOCode }}</span>
							<span hidden>{{ $item->doOVersion }}</span>
							<span hidden>{{ $item->doODate }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@php
		$yearnow = date('Y');
		$mountnow = date('m');
		$yearfutureOne = date('Y') + 1;
		$yearfutureTwo = date('Y') + 2;
		$yearfutureThree = date('Y') + 3;
		$yearfutureFour = date('Y') + 4;
		$yearfutureFive = date('Y') + 5;
		$yearfutureSix = date('Y') + 6;
		$yearfutureSeven = date('Y') + 7;
	@endphp

	{{-- formulario de creación --}}
	<div class="modal fade" id="newCreationOp-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CREACION DE DOCUMENTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('operative.document.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<input type="text" name="doOName" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="doOVersion" maxlength="4" pattern="[A-Z0-9]{1,4}" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CONFIGURACION CODIGO:</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="doOCode_one" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 1" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="doOCode_two" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 2" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="doOCode_three" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 3" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">FECHA DE ACTUALIZACION:</small>
											<input type="text" name="doODate" maxlength="4" class="form-control form-control-sm text-center datepicker" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<button type="submit" class="bj-btn-table-add form-control-sm btn-saveDefinitive">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- formulario de edicion --}}
	<div class="modal fade" id="editCreationOp-modal">
		<div class="modal-dialog" style="font-size: 12px;"> <!-- modal-lg -->
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE DOCUMENTO:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('operative.document.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<small class="text-muted">NOMBRE DEL DOCUMENTO:</small>
											<input type="text" name="doOName_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<small class="text-muted">VERSION:</small>
											<input type="text" name="doOVersion_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">CONFIGURACION CODIGO:</small>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="doOCode_one_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 1" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="doOCode_two_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 2" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" name="doOCode_three_Edit" maxlength="4" pattern="[A-Z0-9]{1,4}" placeholder="Código 3" title="Campo en mayúscula" class="form-control form-control-sm text-center" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">FECHA DE ACTUALIZACION:</small>
											<input type="text" name="doODate_Edit" maxlength="4" class="form-control form-control-sm text-center datepicker" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="doOId_Edit" readonly required>
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

	{{-- formulario de eliminación --}}
	<div class="modal fade" id="deleteCreationOp-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE DOCUMENTO:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="doOName_Delete"></b></span><br>
							<small class="text-muted">CODIGO: </small><br>
							<span class="text-muted"><b class="doOCode_Delete"></b></span><br>
							<small class="text-muted">VERSION: </small><br>
							<span class="text-muted"><b class="doOVersion_Delete"></b></span><br>
							<small class="text-muted">FECHA DE ACTUALIZACION: </small><br>
							<span class="text-muted"><b class="doODate_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('operative.document.delete') }}" method="POST" class="col-md-6 DeleteSend">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="doOId_Delete" readonly required>
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
		// lanza formulario de creacion
		$('.newCreation-link').on('click',function(){
			$('#newCreationOp-modal').modal();
		});
		// lanza formulario de edicion
		$('.editCreation-link').on('click',function(e){				
			Swal.fire({
				title: 'Desea editar este registro?',
				icon: 'info',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#f58f4d',
				confirmButtonText: 'Si, editar',
				cancelButtonText: 'No',
				showClass: {
				popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
				popup: 'animate__animated animate__flipOutX'
				},
			}).then((result) => {
				if (result.isConfirmed) {
					e.preventDefault();
					var doOId, doOName, doOCode, doOVersion, doODate;
					doOId = $(this).find('span:nth-child(2)').text();
					doOName = $(this).find('span:nth-child(3)').text();
					doOCode = $(this).find('span:nth-child(4)').text();
					doOVersion = $(this).find('span:nth-child(5)').text();
					doODate = $(this).find('span:nth-child(6)').text();
					$('input[name=doOId_Edit]').val(doOId);
					$('input[name=doOName_Edit]').val(doOName);
					var code_separate = doOCode.split('-');
					$('input[name=doOCode_one_Edit]').val(code_separate[0]);
					$('input[name=doOCode_two_Edit]').val(code_separate[1]);
					$('input[name=doOCode_three_Edit]').val(code_separate[2]);
					$('input[name=doOVersion_Edit]').val(doOVersion);
					$('input[name=doODate_Edit]').val(doODate);
					$('#editCreationOp-modal').modal();
					}
				})
		});

		// Llama al formulario de eliminación
		$('.deleteCreation-link').on('click',function(e){			
			e.preventDefault();
			var doOId, doOName, doOCode, doOVersion, doODate;
			doOId = $(this).find('span:nth-child(2)').text();
			doOName = $(this).find('span:nth-child(3)').text();
			doOCode = $(this).find('span:nth-child(4)').text();
			doOVersion = $(this).find('span:nth-child(5)').text();
			doODate = $(this).find('span:nth-child(6)').text();
			$('input[name=doOId_Delete]').val(doOId);
			$('b.doOName_Delete').text(doOName);
			$('b.doOCode_Delete').text(doOCode);
			$('b.doOVersion_Delete').text(doOVersion);
			$('b.doODate_Delete').text(doODate);
			$('#deleteCreationOp-modal').modal();					
		})

		// envia el formulario de eliminación
		$('.DeleteSend').submit('click', function(e){
			e.preventDefault();
			Swal.fire({
				title: '¡¡Eliminación!!',
				text: "Desea continuar con la eliminación",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#f58f4d',
				confirmButtonText: 'Si, Eliminar',
				cancelButtonText: 'No',
				showClass: {
					popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
					popup: 'animate__animated animate__flipOutX'
				}
			}).then((result) => {
				if (result.isConfirmed) {
					this.submit();
				}
			})
		})

	</script>
	@if(session('SuccessCreation'))
	<script>
		Swal.fire({
			icon: 'success',
			title: '¡creado con exito!',
			timer: 3000,
			timerProgressBar: true,
			showConfirmButton: false,
			showClass: {
			popup: 'animate__animated animate__flipInX'
			},
			hideClass: {
			popup: 'animate__animated animate__flipOutX'
			}
		})
	</script>
	@endif
	@if(session('SecondaryCreation'))
	<script>
		Swal.fire({
			icon: 'error',
			title: 'Oops..',
			text: '¡documento existente!',
			timer: 3000,
			timerProgressBar: true,
			showConfirmButton: false,
			showClass: {
			popup: 'animate__animated animate__flipInX'
			},
			hideClass: {
			popup: 'animate__animated animate__flipOutX'
			}
		})
	</script>
	@endif
	@if (session('SecondCreation') == "NoEncontrado")
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Oops..',
				text: 'documento no encontrado',
				timer: 3000,
				timerProgressBar: true,
				showConfirmButton: false,
				showClass: {
					popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
					popup: 'animate__animated animate__flipOutX'
				}
			})
		</script>
	@endif
	@if (session('PrimaryCreation'))
		<script>
			Swal.fire({
				icon: 'success',
				title: '¡actualizado con exito!',
				timer: 3000,
				timerProgressBar: true,
				showConfirmButton: false,
				showClass: {
					popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
				popup: 'animate__animated animate__flipOutX'
				}
			})
		</script>		
	@endif
	@if (session('WarningCreation'))
		<script>
			Swal.fire({
				icon: 'success',
				title: '¡eliminado con exito!',
				timer: 3000,
				timerProgressBar: true,
				showConfirmButton: false,
				showClass: {
				popup: 'animate__animated animate__flipInX'
				},
				hideClass: {
				popup: 'animate__animated animate__flipOutX'
				}
			})
		</script>
	@endif
@endsection