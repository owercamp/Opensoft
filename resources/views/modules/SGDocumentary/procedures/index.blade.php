@extends('modules.integralDocumentary')

@section('space')
	<div class="col-md-12 P-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>CREACION DE VARIABLES</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registro" class="bj-btn-table-add form-control-sm newVariable-link">Nuevo</button>
			</div>
			<div class="col-md-4">
				@if (session('SuccessVariable'))
					<div class="alert alert-success">
						{{session('SuccessVariable')}}
					</div>
				@endif
				@if(session('PrimaryVariable'))
					<div class="alert alert-primary">
						{{ session('PrimaryVariable') }}
					</div>
				@endif
				@if (session('SecondaryVariable'))
					<div class="alert alert-secondary">
						{{session('SecondaryVariable')}}
					</div>
				@endif
				@if(session('WarningVariable'))
					<div class="alert alert-warning">
						{{ session('WarningVariable') }}
					</div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover table-bordered text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>NOMBRE DE VARIABLE</th>
					<th>TIPO DE VARIABLE</th>
					<th>LONGITUD VARIABLE</th>
					<th>DOCUMENTO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($variables as $variable)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $variable->valdName }}</td>
					<td>{{ $variable->valdType }}</td>
					<td>{{ $variable->valdLongitud }}</td>
					<td>{{ $variable->document->dodName }}</td>
					<td>
						<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm editVariable-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $variable->valdId }}</span>
							<span hidden>{{ $variable->valdName }}</span>
							<span hidden>{{ $variable->valdType }}</span>
							<span hidden>{{ $variable->valdLongitud }}</span>
							<span hidden>{{ $variable->valdDocument_id }}</span>
						</a>
						<a href="#" title="Eliminar" class="bj-btn-table-delete form-control-sm deleteVariable-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $variable->valdId }}</span>
							<span hidden>{{ $variable->valdName }}</span>
							<span hidden>{{ $variable->valdType }}</span>
							<span hidden>{{ $variable->valdLongitud }}</span>
							<span hidden>{{ $variable->document->dodName }}</span>
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

	{{-- formulario creación de una nueva variable --}}
	<div class="modal fade" id="NewVariableDoc-modal">
		<div class="modal-dialog" style="font-size: 12px">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVA CREACION VARIABLE</h6>
				</div>
				<div class="modal-body">
					<form action="{{route('documentary.variable.save')}}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DOCUMENTO:</small>
											<select name="valdDocument_id" class="form-control form-control-sm" required>
												<option value="">Selección..</option>
												@foreach ($documents as $documento)
													<option value="{{$documento->dodId}}">{{$documento->dodName}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<small class="text-muted">NOMBRE DE VARIABLE:</small>
											<input type="text" name="valdName" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE VARIABLE:</small>
											<select name="valdType" class="form-control form-control-sm" required>
												<option value="">Selección...</option>
												<option value="Texto">Texto</option>
												<option value="Numérico">Numérico</option>
												<option value="Moneda">Moneda</option>
												<option value="Calendario">Calendario</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">LONGITUD:</small>
											<input type="text" name="valdLongitud" maxlength="2" class="form-control form-control-sm" pattern="[0-9]{1,2}" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- formulario edición --}}
	<div class="modal fade" id="editVariableDoc-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE VARIABLE:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('documentary.variable.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">DOCUMENTO:</small>
											<select name="valdDocument_id_Edit" class="form-control form-control-sm" required>
												<option value="">Selección ...</option>
												@foreach($documents as $document)
													<option value="{{ $document->dodId }}">{{ $document->dodName }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<small class="text-muted">NOMBRE DE VARIABLE:</small>
											<input type="text" name="valdName_Edit" maxlength="50" class="form-control form-control-sm" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">TIPO DE VARIABLE:</small>
											<select name="valdType_Edit" class="form-control form-control-sm" required>
												<option value="">Selección ...</option>
												<option value="Texto">Texto</option>
												<option value="Numérico">Numérico</option>
												<option value="Moneda">Moneda</option>
												<option value="Calendario">Calendario</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">LONGITUD:</small>
											<input type="text" name="valdLongitud_Edit" maxlength="2" class="form-control form-control-sm" pattern="[0-9]{1,2}" required>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="valdId_Edit" readonly required>
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

	{{-- formulario Eliminación --}}
	<div class="modal fade" id="deleteVariableDoc-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE VARIABLE:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">NOMBRE DE VARIABLE: </small><br>
							<span class="text-muted"><b class="valdName_Delete"></b></span><br>
							<small class="text-muted">TIPO DE VARIABLE: </small><br>
							<span class="text-muted"><b class="valdType_Delete"></b></span><br>
							<small class="text-muted">LONGITUD DE VARIABLE: </small><br>
							<span class="text-muted"><b class="valdLongitud_Delete"></b></span><br>
							<small class="text-muted">DOCUMENTO: </small><br>
							<span class="text-muted"><b class="valdDocument_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('documentary.variable.delete') }}" method="POST" class="col-md-6 DeleteSend">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="valdId_Delete" readonly required>
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
		// lanza formulario creación
		$('.newVariable-link').on('click',function(){
			$('#NewVariableDoc-modal').modal();
		});
		// lanza formulario edición
		$('.editVariable-link').on('click',function(e){				
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
					var valdId, valdName,valdType,valdLongitud,valdDocument_id;
					valdId = $(this).find('span:nth-child(2)').text();
					valdName = $(this).find('span:nth-child(3)').text();
					valdType = $(this).find('span:nth-child(4)').text();
					valdLongitud = $(this).find('span:nth-child(5)').text();
					valdDocument_id = $(this).find('span:nth-child(6)').text();
					$('input[name=valdId_Edit]').val(valdId);
					$('input[name=valdName_Edit]').val(valdName);
					$('select[name=valdType_Edit]').val(valdType);
					$('input[name=valdLongitud_Edit]').val(valdLongitud);
					$('select[name=valdDocument_id_Edit]').val(valdDocument_id);
					$('#editVariableDoc-modal').modal();
					}
				})
		});
		//lanza formulario de eliminación
		$('.deleteVariable-link').on('click',function(e){
			e.preventDefault();
			var valdId, valdName,valdType,valdLongitud,valdDocument_id;
			valdId = $(this).find('span:nth-child(2)').text();
			valdName = $(this).find('span:nth-child(3)').text();
			valdType = $(this).find('span:nth-child(4)').text();
			valdLongitud = $(this).find('span:nth-child(5)').text();
			valdDocument_id = $(this).find('span:nth-child(6)').text();
			$('input[name=valdId_Delete]').val(valdId);
			$('b.valdName_Delete').text(valdName);
			$('b.valdType_Delete').text(valdType);
			$('b.valdLongitud_Delete').text(valdLongitud);
			$('b.valdDocument_Delete').text(valdDocument_id);
			$('#deleteVariableDoc-modal').modal();
		})

		//envio de eliminación
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
				},
			}).then((result) => {
				if (result.isConfirmed) {
					this.submit();
				}
			})
		})
	</script>

	@if (session('SuccessVariable'))
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
	@if (session('PrimaryVariable'))
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
	@if(session('SecondaryVariable'))
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
	@if (session('WarningVariable'))
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