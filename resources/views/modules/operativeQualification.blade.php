@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('qualification.users') }}" class="nav-link">
							<i class="fas fa-sort-numeric-up"></i>
							<p>{{ __('Calificación del usuario') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('qualification.operators') }}" class="nav-link">
							<i class="fas fa-sort-numeric-down"></i>
							<p>{{ __('Calificación del operador') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('qualification.statistic') }}" class="nav-link">
							<i class="fas fa-chart-line"></i>
							<p>{{ __('Estadística') }}</p>
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