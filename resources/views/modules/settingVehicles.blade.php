@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('vehicle.motorcycles') }}" class="nav-link">
							<i class="fas fa-motorcycle"></i>
							<p>{{ __('Motocicletas') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('vehicle.heavy') }}" class="nav-link">
							<i class="fas fa-truck-moving"></i>
							<p>{{ __('Carga') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('vehicle.especial') }}" class="nav-link">
							<i class="fas fa-taxi"></i>
							<p>{{ __('Especial') }}</p>
						</a>
					</li>
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