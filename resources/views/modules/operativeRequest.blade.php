@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('request.messenger') }}" class="nav-link">
							<i class="fas fa-truck-loading"></i>
							<p>{{ __('Mensajeria Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('request.logistic') }}" class="nav-link">
							<i class="fas fa-cogs"></i>
							<p>{{ __('Logística Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('request.charge') }}" class="nav-link">
							<i class="fas fa-truck-moving"></i>
							<p>{{ __('Carga Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('request.turism') }}" class="nav-link">
							<i class="fas fa-dragon"></i>
							<p>{{ __('Turismo pasajeros') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('request.transfer') }}" class="nav-link">
							<i class="fas fa-rainbow"></i>
							<p>{{ __('Traslado urbano') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('request.transferintermunipal') }}" class="nav-link">
							<i class="fas fa-map"></i>
							<p>{{ __('Traslado intermunicipal') }}</p>
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