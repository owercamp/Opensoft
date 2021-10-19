@extends('modules.logisticContractors')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h6>LEGALIZACION DE CONTRATO</h6>
			</div>
			<div class="col-md-6" style="font-size: 12px;">
				@if(session('SuccessLegalization'))
				    <div class="alert alert-success">
				        {{ session('SuccessLegalization') }}
				    </div>
				@endif
				@if(session('PrimaryLegalization'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryLegalization') }}
				    </div>
				@endif
				@if(session('WarningLegalization'))
				    <div class="alert alert-warning">
				        {{ session('WarningLegalization') }}
				    </div>
				@endif
				@if(session('SecondaryLegalization'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryLegalization') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>COLABORADOR</th>
					<th>NOMBRE DE DOCUMENTO</th>
					<th>CODIGO DE DOCUMENTO</th>
					<th>CONTENIDO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($bills as $bill)
				<tr>
					<td>{{ $row++ }}</td>
					<td>
						@if($bill->bcTypecontractor == 'MENSAJERIA')
							{{ $bill->messenger->cmNames }}
						@elseif($bill->bcTypecontractor == 'CARGA EXPRESS')
							{{ $bill->charge->ccNames }}
						@elseif($bill->bcTypecontractor == 'SERVICIO ESPECIAL')
							{{ $bill->especial->ceNames }}
						@endif
					</td>
					<td>{{ $bill->document->dolName }}</td>
					<td>{{ $bill->bcDocumentcode }}</td>
					<td>
						@if(strlen($bill->bcContentfinal) > 20)
							{{ substr($bill->bcContentfinal,0,20) . ' ...' }}
						@else
							{{ $bill->bcContentfinal }}
						@endif
					</td>
					<td class="d-flex justofy-content-center">
						@if($bill->bcStatus == 'VIGENTE')
							<a href="#" title="FINALIZAR CONTRATO" class="bj-btn-table-delete form-control-sm deleteLegalization-link">
								<i class="fas fa-hourglass-end"></i>
								<span hidden>{{ $bill->bcId }}</span>
								<span hidden>{{ $bill->document->dolName }}</span>
								<span hidden>{{ $bill->bcDocumentcode }}</span>
								<span hidden>{{ $bill->document->dolVersion }}</span>
								@if($bill->bcTypecontractor == 'MENSAJERIA')
									<span hidden>{{ $bill->messenger->cmNames }}</span>
									<span hidden>{{ $bill->messenger->cmNumberdocument }}</span>
								@elseif($bill->bcTypecontractor == 'CARGA EXPRESS')
									<span hidden>{{ $bill->charge->ccNames }}</span>
									<span hidden>{{ $bill->charge->ccNumberdocument }}</span>
								@elseif($bill->bcTypecontractor == 'SERVICIO ESPECIAL')
									<span hidden>{{ $bill->especial->ceNames }}</span>
									<span hidden>{{ $bill->especial->ceNumberdocument }}</span>
								@endif
								<span hidden>{{ $bill->bcContentfinal }}</span>
							</a>
							<form action="{{ route('contractors.legalization.pdf') }}" method="GET" style="display: inline-block;">
								@csrf
								<input type="hidden" name="bcId" value="{{ $bill->bcId }}" class="form-control form-control-sm" required>
								<button type="submit" title="DESCARGAR PDF" class="bj-btn-table-pdf form-control-sm">
									<i class="fas fa-file-pdf"></i>
								</button>
							</form>
						@else
							<h6><span class="badge badge-warning">FINALIZADO</span></h6>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="deleteLegalization-modal">
		<div class="modal-dialog" style="font-size: 12px;">
			<div class="modal-content">
				<div class="modal-header">
					<h6>FINALIZACION DE CONTRATO:</h6>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<small class="text-muted">CONTRATISTA: </small><br>
							<span class="text-muted"><b class="contractorNames_Delete"></b></span><br>
							<small class="text-muted">NUMERO DE IDENTIFICACION: </small><br>
							<span class="text-muted"><b class="contractorNumberdocument_Delete"></b></span><br>
							<small class="text-muted">NOMBRE DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolName_Delete"></b></span><br>
							<small class="text-muted">CODIGO DE DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolCode_Delete"></b></span><br>
							<small class="text-muted">VERSION DEL DOCUMENTO: </small><br>
							<span class="text-muted"><b class="dolVersion_Delete"></b></span><br>
							<small class="text-muted">CONTENIDO: </small><br>
							<span class="text-muted"><b class="bcContentfinal_Delete"></b></span><br>
						</div>
					</div>
					<div class="row mt-3 border-top text-center">
						<form action="{{ route('contractors.legalization.finish') }}" method="POST" class="col-md-12">
							@csrf
							<input type="hidden" class="form-control form-control-sm" name="bcId_Finish" readonly required>
							<button type="submit" class="bj-btn-table-delete form-control-sm my-3">FINALIZAR</button>
						</form>
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

		$('.deleteLegalization-link').on('click',function(e){
			e.preventDefault();
			var bcId = $(this).find('span:nth-child(2)').text();
			var dolName = $(this).find('span:nth-child(3)').text();
			var dolCode = $(this).find('span:nth-child(4)').text();
			var dolVersion = $(this).find('span:nth-child(5)').text();
			var contractorNames = $(this).find('span:nth-child(6)').text();
			var contractorNumberdocument = $(this).find('span:nth-child(7)').text();
			var bcContentfinal = $(this).find('span:nth-child(8)').text();
			$('input[name=bcId_Finish]').val(bcId);
			$('b.dolName_Delete').text(dolName);
			$('b.dolCode_Delete').text(dolCode);
			$('b.dolVersion_Delete').text(dolVersion);
			$('b.contractorNames_Delete').text(contractorNames);
			$('b.contractorNumberdocument_Delete').text(contractorNumberdocument);
			$('b.bcContentfinal_Delete').text(bcContentfinal);
			$('#deleteLegalization-modal').modal();
		});
	</script>
@endsection