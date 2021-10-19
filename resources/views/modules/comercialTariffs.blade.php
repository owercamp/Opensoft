@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('tariffs.messenger') }}" class="nav-link">
							<i class="fas fa-mail-bulk"></i>
							<p>{{ __('Mensajeria Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tariffs.logistic') }}" class="nav-link">
							<i class="fas fa-exchange-alt"></i>
							<p>{{ __('Logística Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tariffs.charge') }}" class="nav-link">
							<i class="fas fa-boxes"></i>
							<p>{{ __('Carga Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tariffs.turism') }}" class="nav-link">
							<i class="fas fa-dragon"></i>
							<p>{{ __('Turismo Pasajeros') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tariffs.transfer') }}" class="nav-link">
							<i class="fas fa-rainbow"></i>
							<p>{{ __('Traslado Urbano') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tariffs.transferintermunipality') }}" class="nav-link">
							<i class="fas fa-map"></i>
							<p>{{ __('Traslado Intermunicipal') }}</p>
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