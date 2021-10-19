@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('humans.collaborators') }}" class="nav-link">
							<i class="fas fa-users-cog"></i>
							<p>{{ __('Colaboradores') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('humans.contractorsMessenger') }}" class="nav-link">
							<i class="fas fa-people-carry"></i>
							<p>{{ __('Contratistas Mensajeria') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('humans.contractorsExpress') }}" class="nav-link">
							<i class="fas fa-wind"></i>
							<p>{{ __('Contratistas Carga Express') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('humans.contractorsEspecial') }}" class="nav-link">
							<i class="fas fa-book-reader"></i>
							<p>{{ __('Contratistas Servicio Especial') }}</p>
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