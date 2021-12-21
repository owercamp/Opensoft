@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('tracking.confirmation') }}" class="nav-link">
							<i class="fas fa-user-check"></i>
							<p>{{ __('Confirmación Operador') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tracking.start') }}" class="nav-link">
							<i class="fas fa-external-link-alt"></i><!-- chevron-circle-right -->
							<p>{{ __('Inicio del servicio') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tracking.running') }}" class="nav-link">
							<i class="fas fa-exchange-alt"></i>
							<p>{{ __('Servicio en ejecución') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tracking.finalized') }}" class="nav-link">
							<i class="fas fa-clipboard-list"></i>
							<p>{{ __('Servicios finalizados') }}</p>
						</a>
					</li>
          <div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('tracking.canceled') }}" class="nav-link">
							<i class="fas fa-clipboard-list"></i>
							<p>{{ __('Servicios Cancelados') }}</p>
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