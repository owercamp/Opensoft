@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('products.messenger') }}" class="nav-link">
							<i class="fas fa-truck-loading"></i>
							<p>{{ __('Mensajeria Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('products.logistic') }}" class="nav-link">
							<i class="fas fa-cogs"></i>
							<p>{{ __('Logística Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('products.express') }}" class="nav-link">
							<i class="fas fa-car"></i>
							<p>{{ __('Carga Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('products.tourism') }}" class="nav-link">
							<i class="fas fa-globe-americas"></i>
							<p>{{ __('Turismo Pasajeros') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('products.transfers') }}" class="nav-link">
							<i class="fas fa-shipping-fast"></i>
							<p>{{ __('Traslados Urbanos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('products.transfersmunicipals') }}" class="nav-link">
							<i class="fas fa-shipping-fast"></i>
							<p>{{ __('Traslados Intermunicipales') }}</p>
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