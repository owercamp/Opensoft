@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('security.health') }}" class="nav-link">
							<i class="fas fa-hospital"></i>
							<p>{{ __('Entidad promotora de salud') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('security.pensions') }}" class="nav-link">
							<i class="fas fa-business-time"></i>
							<p>{{ __('Fondo de pensiones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('security.layoffs') }}" class="nav-link">
							<i class="fas fa-wallet"></i>
							<p>{{ __('Fondo de cesantias') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('security.risks') }}" class="nav-link">
							<i class="fas fa-poll"></i>
							<p>{{ __('Administradora de riesgos laborales') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('security.compensations') }}" class="nav-link">
							<i class="fas fa-vote-yea"></i>
							<p>{{ __('Cajas de compensación') }}</p>
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