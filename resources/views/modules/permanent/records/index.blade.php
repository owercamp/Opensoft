@extends('modules.comercialPermanentcontracts')

@section('space')
	<div class="col-md-12 p-3">
		<div class="row border-bottom mb-3">
			<div class="col-md-6">
				<h6>ARCHIVO DE CONTRATOS</h6>
			</div>
			<div class="col-md-6">
				@if(session('SuccessContract'))
				    <div class="alert alert-success">
				        {{ session('SuccessContract') }}
				    </div>
				@endif
				@if(session('PrimaryContract'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryContract') }}
				    </div>
				@endif
				@if(session('WarningContract'))
				    <div class="alert alert-warning">
				        {{ session('WarningContract') }}
				    </div>
				@endif
				@if(session('SecondaryContract'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryContract') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>CODIGO</th>
					<th>RAZON SOCIAL</th>
					<th>CIUDAD</th>
					<th>CONTACTO</th>
					<th>ESTADO</th>
				</tr>
			</thead>
			<tbody>
				@php $row = 1; @endphp
				@foreach($legalizations as $legalization)
				<tr>
					<td>{{ $row++ }}</td>
					<td>{{ $legalization->document->docCode }}</td>
					<td>{{ $legalization->client->cliNamereason }}</td>
					<td>{{ $legalization->client->municipality->munName }}</td>
					<td>
						@if($legalization->client->cliType == 'Jurídica')
							{{ $legalization->client->cliNamerepresentative }}
						@else
							{{ __('No aplica') }}
						@endif
					</td>
					<td>{{ $legalization->lcoStatus }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){

		});
	</script>
@endsection