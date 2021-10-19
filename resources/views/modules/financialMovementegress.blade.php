@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('egress.accounts') }}" class="nav-link">
							<i class="fas fa-donate"></i>
							<p>{{ __('Cuentas por pagar') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('egress.obligations') }}" class="nav-link">
							<i class="fas fa-file-invoice-dollar"></i>
							<p>{{ __('Obligaciones vencidas') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('egress.vouchers') }}" class="nav-link">
							<i class="fas fa-file-invoice"></i>
							<p>{{ __('Comprobantes de egreso') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('egress.statistic') }}" class="nav-link">
							<i class="fas fa-chart-bar"></i>
							<p>{{ __('Estadística de gastos') }}</p>
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