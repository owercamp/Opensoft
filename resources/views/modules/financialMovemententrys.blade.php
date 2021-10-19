@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('entrys.facturation') }}" class="nav-link">
							<i class="fas fa-receipt"></i>
							<p>{{ __('Facturación de venta') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('entrys.wallet') }}" class="nav-link">
							<i class="fas fa-wallet"></i>
							<p>{{ __('Cartera vencida') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('entrys.voucher') }}" class="nav-link">
							<i class="fas fa-file-invoice-dollar"></i>
							<p>{{ __('Comprobantes de ingreso') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('entrys.statistic') }}" class="nav-link">
							<i class="fas fa-chart-bar"></i>
							<p>{{ __('Estadística de ventas') }}</p>
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