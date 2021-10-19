@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('permanent.clients') }}" class="nav-link">
							<i class="fas fa-user-friends"></i>
							<p>{{ __('Clientes') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('permanent.legalizations') }}" class="nav-link">
							<i class="fas fa-file-contract"></i>
							<p>{{ __('Legalización Contractual') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('permanent.conditions') }}" class="nav-link">
							<i class="fas fa-file-invoice-dollar"></i>
							<p>{{ __('Condiciones Económicas') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('permanent.records') }}" class="nav-link">
							<i class="fas fa-box-open"></i>
							<p>{{ __('Archivo de Contratos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('permanent.statistic') }}" class="nav-link">
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