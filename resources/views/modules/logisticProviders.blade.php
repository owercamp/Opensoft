@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('providers.bill') }}" class="nav-link">
							<i class="fas fa-list-ol"></i>
							<p>{{ __('Minuta de Contrato') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('providers.legalization') }}" class="nav-link">
							<i class="fab fa-accusoft"></i>
							<p>{{ __('Legalización de Contrato') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('providers.notifications') }}" class="nav-link">
							<i class="fas fa-comment-alt"></i>
							<p>{{ __('Notificaciones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('providers.tests') }}" class="nav-link">
							<i class="fas fa-paste"></i>
							<p>{{ __('Evaluaciones de desempeño') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('providers.order') }}" class="nav-link">
							<i class="fas fa-file-invoice-dollar"></i>
							<p>{{ __('Orden de compra') }}</p>
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