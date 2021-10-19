@extends('modules.operativeProgramming')

@section('space')
	<div class="col-md-12" style="font-size: 12px;">
		<div class="row border-bottom mb-2">
			<div class="col-md-6">
				<h5>PENDIENTE DE ASIGNACION</h5>
			</div>
			<div class="col-md-6">
				@if(session('SuccessAssignment'))
				    <div class="alert alert-success">
				        {{ session('SuccessAssignment') }}
				    </div>
				@endif
				@if(session('PrimaryAssignment'))
				    <div class="alert alert-primary">
				        {{ session('PrimaryAssignment') }}
				    </div>
				@endif
				@if(session('WarningAssignment'))
				    <div class="alert alert-warning">
				        {{ session('WarningAssignment') }}
				    </div>
				@endif
				@if(session('SecondaryAssignment'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryAssignment') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table text-center" width="100%">
			<thead>
				<tr>
					<th>N° SERVICIO</th>
					<th>TIPO DE SOLICITUD</th>
					<th>SERVICIO</th>
					<th>CLIENTE</th>
					<th>ORIGEN</th>
					<th>DESTINO</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<!-- Función para retornar el onsecutivo con ceros a la izquierda de acuerdo a cada iteracion -->
				@php
					function getStringSequence ($number){
				        $len = strlen($number);
				        switch ($len) {
				            case 1: return '00000' . $number; break;
				            case 2: return '0000' . $number; break;
				            case 3: return '000' . $number; break;
				            case 4: return '00' . $number; break;
				            case 5: return '0' . $number; break;
				            default: return (string)$number; break;
				        }
				    }
				@endphp
				@for($i = 0; $i < count($dates); $i++)
					<tr>
						<td>{{ getStringSequence($i + 1) }}</td>
						<td>{{ $dates[$i][3] }}</td>
						<td>{{ $dates[$i][4] }}</td>
						<td>{{ $dates[$i][2] }}</td>
						<td>{{ $dates[$i][5] }}</td>
						<td>{{ $dates[$i][9] }}</td>
						<td>
							<a href="#" title="Ver información completa" class="bj-btn-table-delete form-control-sm details-link">
								<i class="fas fa-eye"></i>
								<span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
								<span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
								<span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
								<span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
								<span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
								<span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
								<span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
								<span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
								<span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
								<span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
								<span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
								<span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
							</a>
							<a href="#" title="Editar" class="bj-btn-table-edit form-control-sm edit-link">
								<i class="fas fa-edit"></i>
								<span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
								<span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
								<span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
								<span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
								<span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
								<span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
								<span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
								<span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
								<span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
								<span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
								<span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
								<span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
							</a>
							<a href="#" title="Asignar" class="bj-btn-table-add form-control-sm assign-link">
								<i class="fas fa-exchange-alt"></i>
								<span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
								<span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
								<span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
								<span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
								<span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
								<span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
								<span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
								<span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
								<span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
								<span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
								<span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
								<span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
							</a>
							<a href="#" title="Eliminar" class="bj-btn-table-pdf form-control-sm delete-link">
								<i class="fas fa-trash-alt"></i>
								<span hidden>{{ $dates[$i][0] }}</span> <!-- Fecha -->
								<span hidden>{{ $dates[$i][1] }}</span> <!-- Hora -->
								<span hidden>{{ $dates[$i][2] }}</span> <!-- Cliente -->
								<span hidden>{{ $dates[$i][3] }}</span> <!-- Tipo de solicitud -->
								<span hidden>{{ $dates[$i][4] }}</span> <!-- Servicio -->
								<span hidden>{{ $dates[$i][5] }}</span> <!-- Ciudad origen -->
								<span hidden>{{ $dates[$i][6] }}</span> <!-- Dirección origen -->
								<span hidden>{{ $dates[$i][7] }}</span> <!-- Contacto -->
								<span hidden>{{ $dates[$i][8] }}</span> <!-- Telefono -->
								<span hidden>{{ $dates[$i][9] }}</span> <!-- Ciudad destino -->
								<span hidden>{{ $dates[$i][10] }}</span> <!-- Dirección destino -->
								<span hidden>{{ $dates[$i][11] }}</span> <!-- Observacion -->
							</a>
						</td>
					</tr>
				@endfor
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