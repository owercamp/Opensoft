@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('automotors.messengers') }}" class="nav-link">
							<i class="fas fa-hiking"></i>
							<p>{{ __('Mensajeria') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('automotors.express') }}" class="nav-link">
							<i class="fas fa-luggage-cart"></i>
							<p>{{ __('Carga Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('automotors.services') }}" class="nav-link">
							<i class="fas fa-book-reader"></i>
							<p>{{ __('Servicios Especiales') }}</p>
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