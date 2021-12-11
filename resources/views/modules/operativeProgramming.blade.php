@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('programming.assignment') }}" class="nav-link">
							<i class="fas fa-user-edit"></i>
							<p>{{ __('Asignación Operador') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('programming.acceptance') }}" class="nav-link">
							<i class="fas fa-user-check"></i>
							<p>{{ __('Aceptación Operador') }}</p>
						</a>
					</li>
					<!-- <div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('programming.report') }}" class="nav-link">
							<i class="fas fa-list-alt"></i>
							<p>{{ __('Informe de servicio') }}</p>
						</a>
					</li> -->
				</ul>
			</div>
			<div class="col-md-10">
				<div class="row">
					@yield('space')
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(function(){

		});
	</script>
@endsection