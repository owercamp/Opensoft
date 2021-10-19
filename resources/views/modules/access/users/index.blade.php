@extends('modules.settingAccess')

@section('space')
	<div class="col-md-12">
		<div class="row text-center border-bottom mb-4">
			<div class="col-md-4">
				<h5>USUARIOS</h5>
			</div>
			<div class="col-md-4">
				<a href="#" class="bj-btn-table-add form-control-sm">CREAR USUARIO</a>
			</div>
			<div class="col-md-4">
				@if(session('SuccessMessageUser'))
				    <div class="alert alert-primary">
				        {{ session('SuccessMessageUser') }}
				    </div>
				@endif
				@if(session('SecondaryMessageUser'))
				    <div class="alert alert-secondary">
				        {{ session('SecondaryMessageUser') }}
				    </div>
				@endif
			</div>
		</div>
		<table id="tableDatatable" class="table table-hover text-center" width="100%" style="font-size: 12px;">
			<thead>
				<tr>
					<th>#</th>
					<th>IDENTIFICACION</th>
					<th>NOMBRES</th>
					<th>ROL</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody>
				@php $i = 1 @endphp
				@foreach($users as $user)
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $user->id }}</td>
						<td>{{ $user->firstname . ' ' . $user->lastname }}</td>
						@if($user->roles->implode('name',',') !== '')
							<td>{{ $user->roles->implode('name',',') }}</td>
						@else
							<td>{{ __('Indefinido') }}</td>
						@endif
						<td>
							<a href="#" title="Editar usuario" class="bj-btn-table-edit form-control-sm">
								<i class="fas fa-edit"></i>
								<span hidden>{{ $user->id }}</span>
								<span hidden>{{ $user->firstname }}</span>
								<span hidden>{{ $user->lastname }}</span>
							</a>
							<a href="#" title="Eliminar usuario" class="bj-btn-table-delete form-control-sm">
								<i class="fas fa-trash-alt"></i>
								<span hidden>{{ $user->id }}</span>
								<span hidden>{{ $user->firstname }}</span>
								<span hidden>{{ $user->lastname }}</span>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>
@endsection
