@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('clients.bidding') }}" class="nav-link">
							<i class="fas fa-file-alt"></i>
							<p>{{ __('Licitaciones públicas') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('clients.proposal') }}" class="nav-link">
							<i class="fas fa-podcast"></i>
							<p>{{ __('Propuesta comercial') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('clients.tracking') }}" class="nav-link">
							<i class="fas fa-stop-circle"></i>
							<p>{{ __('Seguimiento comercial') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('clients.records') }}" class="nav-link">
							<i class="fas fa-box"></i>
							<p>{{ __('Archivo comercial') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('clients.statistic') }}" class="nav-link">
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