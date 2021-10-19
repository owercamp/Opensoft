@extends('modules.logisticContractors')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-4">
				<h6>ACTIVACIONES DEL SISTEMA</h6>
			</div>
			<div class="col-md-4">
				<button type="button" title="Registrar" class="bj-btn-table-add form-control-sm newActivation-link">NUEVO</button>
			</div>
			<div class="col-md-4" style="font-size: 12px;">
				@if(session('SuccessActivation'))
				    <div class="alert alert-success">
				        {{ session('SuccessActivation') }}
				    </div>
				@endif
				@if(session('PrimaryActivation'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryActivation') }}
				    </div>
				@endif
				@if(session('WarningActivation'))
				    <div class="alert alert-warning">
				        {{ session('WarningActivation') }}
				    </div>
				@endif
				@if(session('SecondaryActivation'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryActivation') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>TIPO DE CONTRATISTA</th>
					<th>CONTRATISTA</th>
					<th>ESTADO</th>
					<th>FECHA VENCIMIENTO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($activations as $activation)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $activation->accTypecontractor }}</td>
					<td>
						@if($activation->accTypecontractor == 'MENSAJERIA')
							{{ $activation->messenger->cmNames }}
						@elseif($activation->accTypecontractor == 'CARGA EXPRESS')
							{{ $activation->charge->ccNames }}
						@elseif($activation->accTypecontractor == 'SERVICIO ESPECIAL')
							{{ $activation->especial->ceNames }}
						@endif
					</td>
					<td>{{ $activation->accState }}</td>
					<td>
						@if($activation->accDateend != null)
							{{ $activation->accDateend }}
						@else
							{{ __('No aplica') }}
						@endif
					</td>
					<td class="d-flex justofy-content-center">
						<a href="#" title="EDITAR" class="bj-btn-table-edit form-control-sm editActivation-link">
							<i class="fas fa-edit"></i>
							<span hidden>{{ $activation->accId }}</span>
							<span hidden>{{ $activation->accTypecontractor }}</span>
							@if($activation->accTypecontractor == 'MENSAJERIA')
								<span hidden>{{ $activation->messenger->cmNames }}</span>
							@elseif($activation->accTypecontractor == 'CARGA EXPRESS')
								<span hidden>{{ $activation->charge->ccNames }}</span>
							@elseif($activation->accTypecontractor == 'SERVICIO ESPECIAL')
								<span hidden>{{ $activation->especial->ceNames }}</span>
							@endif
							<span hidden>{{ $activation->accState }}</span>
							<span hidden>{{ $activation->accDateend }}</span>
						</a>
						<a href="#" title="ELIMINAR" class="bj-btn-table-delete form-control-sm deleteActivation-link">
							<i class="fas fa-trash-alt"></i>
							<span hidden>{{ $activation->accId }}</span>
							<span hidden>{{ $activation->accTypecontractor }}</span>
							@if($activation->accTypecontractor == 'MENSAJERIA')
								<span hidden>{{ $activation->messenger->cmNames }}</span>
							@elseif($activation->accTypecontractor == 'CARGA EXPRESS')
								<span hidden>{{ $activation->charge->ccNames }}</span>
							@elseif($activation->accTypecontractor == 'SERVICIO ESPECIAL')
								<span hidden>{{ $activation->especial->ceNames }}</span>
							@endif
							<span hidden>{{ $activation->accState }}</span>
							<span hidden>{{ $activation->accDateend }}</span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="newActivation-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>NUEVO REGISTRO DE ACTIVACION:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('contractors.activation.save') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">TIPO DE CONTRATISTA:</small>
											<select name="accTypecontractor" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												<option value="MENSAJERIA">MENSAJERIA</option>
												<option value="CARGA EXPRESS">CARGA EXPRESS</option>
												<option value="SERVICIO ESPECIAL">SERVICIO ESPECIAL</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 section-selectbill">
										<div class="row section-contractormessenger" style="display: none;">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CONTRATISTA DE MENSAJERIA:</small>
													<select name="accContractormessenger_id" class="form-control form-control-sm" disabled>
														<option value="">Seleccione ...</option>
														@foreach($contractormessengers as $contractormessenger)
															<option value="{{ $contractormessenger->cmId }}" data-bill="{{ $contractormessenger->bcId }}">{{ $contractormessenger->cmNames }}</option>
														@endforeach
													</select>
												</div>	
											</div>
										</div>
										<div class="row section-contractorcharge" style="display: none;">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CONTRATISTA DE CARGA EXPRESS:</small>
													<select name="accContractorcharge_id" class="form-control form-control-sm" disabled>
														<option value="">Seleccione ...</option>
														@foreach($contractorcharges as $contractorcharge)
															<option value="{{ $contractorcharge->ccId }}" data-bill="{{ $contractorcharge->bcId }}">{{ $contractorcharge->ccNames }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="row section-contractorespecial" style="display: none;">
											<div class="col-md-12">
												<div class="form-group">
													<small class="text-muted">CONTRATISTA DE SERVICIO ESPECIAL:</small>
													<select name="accContractorespecial_id" class="form-control form-control-sm" disabled>
														<option value="">Seleccione ...</option>
														@foreach($contractorespecials as $contractorespecial)
															<option value="{{ $contractorespecial->ceId }}" data-bill="{{ $contractorespecial->bcId }}">{{ $contractorespecial->ceNames }}</option>
														@endforeach
													</select>
												</div>	
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">ESTADO:</small>
											<select name="accState" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												<option value="ACTIVADO">ACTIVADO</option>
												<option value="DESACTIVADO">DESACTIVADO</option>
											</select>
										</div>
										<div class="form-group section-accDateend" style="display: none;">
											<small class="text-muted">FECHA DE VENCIMIENTO:</small>
											<input type="text" name="accDateend" class="form-control form-control-sm text-center datepicker" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group text-center mt-3">
							<input type="hidden" name="accBillcontractor_id" class="form-control form-control-sm" disabled>
							<button type="submit" class="bj-btn-table-add form-control-sm">GUARDAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editActivation-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>MODIFICACION DE ACTIVACION:</h6>
				</div>
				<div class="modal-body">
					<form action="{{ route('contractors.activation.update') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<small class="text-muted">TIPO: </small><br>
										<span class="text-muted"><b class="accTypecontractor_Edit"></b></span><br>
									</div>
									<div class="col-md-6">
										<small class="text-muted">CONTRATISTA: </small><br>
										<span class="text-muted"><b class="accContractor_Edit"></b></span><br>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<small class="text-muted">ESTADO:</small>
											<select name="accState_Edit" class="form-control form-control-sm" required>
												<option value="">Seleccione ...</option>
												<option value="ACTIVADO">ACTIVADO</option>
												<option value="DESACTIVADO">DESACTIVADO</option>
											</select>
										</div>
										<div class="form-group section-accDateend_Edit" style="display: none;">
											<small class="text-muted">FECHA DE VENCIMIENTO:</small>
											<input type="text" name="accDateend_Edit" class="form-control form-control-sm text-center datepicker" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row border-top mt-3 text-center">
							<div class="col-md-6">
								<input type="hidden" class="form-control form-control-sm" name="accId_Edit" readonly required>
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

	<div class="modal fade" id="deleteActivation-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>ELIMINACION DE CONVENIO:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<small class="text-muted">TIPO: </small><br>
							<span class="text-muted"><b class="accTypecontractor_Delete"></b></span><br>
						</div>
						<div class="col-md-6">
							<small class="text-muted">CONTRATISTA: </small><br>
							<span class="text-muted"><b class="accContractor_Delete"></b></span><br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<small class="text-muted">ESTADO: </small><br>
							<span class="text-muted"><b class="accState_Delete"></b></span><br>
						</div>
						<div class="col-md-6">
							<small class="text-muted">FECHA VENCIMIENTO: </small><br>
							<span class="text-muted"><b class="accDateend_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('contractors.activation.delete') }}" method="POST" class="col-md-6">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="accId_Delete" readonly required>
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

		$('.newActivation-link').on('click',function(){
			$('#newActivation-modal').modal();
		});

		$('select[name=accTypecontractor]').on('change',function(e){
			var selected = e.target.value;
			if(selected != ''){
				if(selected == 'MENSAJERIA'){
					$('div.section-contractormessenger').css('display','flex');
					$('div.section-contractormessenger select').attr('disabled',false);
					$('div.section-contractormessenger select').attr('required',true);
					$('div.section-contractormessenger select').val('');
					$('div.section-contractorcharge').css('display','none');
					$('div.section-contractorcharge select').attr('disabled',true);
					$('div.section-contractorcharge select').attr('required',false);
					$('div.section-contractorcharge select').val('');
					$('div.section-contractorespecial').css('display','none');
					$('div.section-contractorespecial select').attr('disabled',true);
					$('div.section-contractorespecial select').attr('required',false);
					$('div.section-contractorespecial select').val('');
				}else if(selected == 'CARGA EXPRESS'){
					$('div.section-contractormessenger').css('display','none');
					$('div.section-contractormessenger select').attr('disabled',true);
					$('div.section-contractormessenger select').attr('required',false);
					$('div.section-contractormessenger select').val('');
					$('div.section-contractorcharge').css('display','flex');
					$('div.section-contractorcharge select').attr('disabled',false);
					$('div.section-contractorcharge select').attr('required',true);
					$('div.section-contractorcharge select').val('');
					$('div.section-contractorespecial').css('display','none');
					$('div.section-contractorespecial select').attr('disabled',true);
					$('div.section-contractorespecial select').attr('required',false);
					$('div.section-contractorespecial select').val('');
				}else if(selected == 'SERVICIO ESPECIAL'){
					$('div.section-contractormessenger').css('display','none');
					$('div.section-contractormessenger select').attr('disabled',true);
					$('div.section-contractormessenger select').attr('required',false);
					$('div.section-contractormessenger select').val('');
					$('div.section-contractorcharge').css('display','none');
					$('div.section-contractorcharge select').attr('disabled',true);
					$('div.section-contractorcharge select').attr('required',false);
					$('div.section-contractorcharge select').val('');
					$('div.section-contractorespecial').css('display','flex');
					$('div.section-contractorespecial select').attr('disabled',false);
					$('div.section-contractorespecial select').attr('required',true);
					$('div.section-contractorespecial select').val('');
				}else{
					$('div.section-contractormessenger').css('display','none');
					$('div.section-contractormessenger select').attr('disabled',true);
					$('div.section-contractormessenger select').attr('required',false);
					$('div.section-contractormessenger select').val('');
					$('div.section-contractorcharge').css('display','none');
					$('div.section-contractorcharge select').attr('disabled',true);
					$('div.section-contractorcharge select').attr('required',false);
					$('div.section-contractorcharge select').val('');
					$('div.section-contractorespecial').css('display','none');
					$('div.section-contractorespecial select').attr('disabled',true);
					$('div.section-contractorespecial select').attr('required',false);
					$('div.section-contractorespecial select').val('');
				}
			}
		});

		$('select[name=accState]').on('change',function(e){
			var selected = e.target.value;
			if(selected != ''){
				if(selected == 'ACTIVADO'){
					$('div.section-accDateend').css('display','flex');
					$('div.section-accDateend input').attr('disabled',false);
					$('div.section-accDateend input').attr('required',true);
					$('div.section-accDateend input').val('');
				}else if(selected == 'DESACTIVADO'){
					$('div.section-accDateend').css('display','none');
					$('div.section-accDateend input').attr('disabled',true);
					$('div.section-accDateend input').attr('required',false);
					$('div.section-accDateend input').val('');
				}
			}else{
				$('div.section-accDateend').css('display','none');
				$('div.section-accDateend input').attr('disabled',true);
				$('div.section-accDateend input').attr('required',false);
				$('div.section-accDateend input').val('');
			}
		});

		$('.section-selectbill').on('change','select',function(e){
			var selected = e.target.value;
			if(selected != ''){
				var bill = $(this).find('option:selected').attr('data-bill');
				$('input[name=accBillcontractor_id]').val(bill);
			}else{
				$('input[name=accBillcontractor_id]').val('');
			}
		});

		$('.editActivation-link').on('click',function(e){
			e.preventDefault();
			var accId = $(this).find('span:nth-child(2)').text();
			var accTypecontractor = $(this).find('span:nth-child(3)').text();
			var accContractor = $(this).find('span:nth-child(4)').text();
			var accState = $(this).find('span:nth-child(5)').text();
			var accDateend = $(this).find('span:nth-child(6)').text();
			$('input[name=accId_Edit]').val(accId);
			$('.accTypecontractor_Edit').text(accTypecontractor);
			$('.accContractor_Edit').text(accContractor);
			$('select[name=accState_Edit]').val(accState);
			if(accState == 'ACTIVADO'){
				$('.section-accDateend_Edit').css('display','flex');
				$('input[name=accDateend_Edit]').attr('disabled',false);
				$('input[name=accDateend_Edit]').attr('required',true);
				$('input[name=accDateend_Edit]').val(accDateend);
			}else{
				$('.section-accDateend_Edit').css('display','none');
				$('input[name=accDateend_Edit]').attr('disabled',true);
				$('input[name=accDateend_Edit]').attr('required',false);
				$('input[name=accDateend_Edit]').val('');
			}
			$('#editActivation-modal').modal();
		});

		$('select[name=accState_Edit]').on('change',function(e){
			var selected = e.target.value;
			if(selected != ''){
				if(selected == 'ACTIVADO'){
					$('div.section-accDateend_Edit').css('display','flex');
					$('div.section-accDateend_Edit input').attr('disabled',false);
					$('div.section-accDateend_Edit input').attr('required',true);
					$('div.section-accDateend_Edit input').val('');
				}else if(selected == 'DESACTIVADO'){
					$('div.section-accDateend_Edit').css('display','none');
					$('div.section-accDateend_Edit input').attr('disabled',true);
					$('div.section-accDateend_Edit input').attr('required',false);
					$('div.section-accDateend_Edit input').val('');
				}
			}else{
				$('div.section-accDateend_Edit').css('display','none');
				$('div.section-accDateend_Edit input').attr('disabled',true);
				$('div.section-accDateend_Edit input').attr('required',false);
				$('div.section-accDateend_Edit input').val('');
			}
		});

		$('.deleteActivation-link').on('click',function(e){
			e.preventDefault();
			var accId = $(this).find('span:nth-child(2)').text();
			var accTypecontractor = $(this).find('span:nth-child(3)').text();
			var accContractor = $(this).find('span:nth-child(4)').text();
			var accState = $(this).find('span:nth-child(5)').text();
			var accDateend = $(this).find('span:nth-child(6)').text();
			$('input[name=accId_Delete]').val(accId);
			$('.accTypecontractor_Delete').text(accTypecontractor);
			$('.accContractor_Delete').text(accContractor);
			$('.accState_Delete').text(accState);
			if(accDateend != null && accDateend != 'null' && accDateend != ''){
				$('.accDateend_Delete').text(accDateend);
			}else{ 
				$('.accDateend_Delete').text('No aplica');
			}
			$('#deleteActivation-modal').modal();
		});
	</script>
@endsection