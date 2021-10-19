@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('settlement.clients') }}" class="nav-link">
							<i class="fas fa-money-check-alt"></i>
							<p>{{ __('Liquidación para clientes') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('settlement.operators') }}" class="nav-link">
							<i class="fas fa-funnel-dollar"></i>
							<p>{{ __('Liquidación para operadores') }}</p>
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