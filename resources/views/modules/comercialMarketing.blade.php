@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('marketing.opportunity') }}" class="nav-link">
							<i class="fas fa-dice-d20"></i>
							<p>{{ __('Oportunidad de negocios') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('marketing.tracking') }}" class="nav-link">
							<i class="fas fa-stop-circle"></i>
							<p>{{ __('Seguimiento de negocios') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('marketing.records') }}" class="nav-link">
							<i class="fas fa-box-open"></i>
							<p>{{ __('Archivo de negocios') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('marketing.statistic') }}" class="nav-link">
							<i class="fas fa-poll"></i>
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