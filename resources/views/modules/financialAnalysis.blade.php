@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('analysis.conciliation') }}" class="nav-link">
							<i class="fas fa-hand-holding-usd"></i>
							<p>{{ __('Conciliación de saldos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('analysis.structure') }}" class="nav-link">
							<i class="fas fa-coins"></i>
							<p>{{ __('Estructura de costos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('analysis.description') }}" class="nav-link">
							<i class="fas fa-receipt"></i>
							<p>{{ __('Descripción de costos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('analysis.budget') }}" class="nav-link">
							<i class="fab fa-mizuni"></i>
							<p>{{ __('Presupuesto anual') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('analysis.tracking') }}" class="nav-link">
							<i class="fab fa-mix"></i>
							<p>{{ __('Seguimiento mensual') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('analysis.report') }}" class="nav-link">
							<i class="fas fa-money-check-alt"></i>
							<p>{{ __('Informe de cierre') }}</p>
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