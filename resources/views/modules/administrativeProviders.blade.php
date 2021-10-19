@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('providers.products') }}" class="nav-link">
							<i class="fas fa-briefcase"></i>
							<p>{{ __('Productos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('providers.services') }}" class="nav-link">
							<i class="fas fa-podcast"></i>
							<p>{{ __('Servicios') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('providers.providers') }}" class="nav-link">
							<i class="fas fa-comments"></i>
							<p>{{ __('Proveedores') }}</p>
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