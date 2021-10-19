@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('documentary.hankbook') }}" class="nav-link">
							<i class="fas fa-fist-raised"></i>
							<p>{{ __('Creación de Documentos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documentary.procedures') }}" class="nav-link">
							<i class="fas fa-clipboard-list"></i>
							<p>{{ __('Creación de variables') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documentary.planing') }}" class="nav-link">
							<i class="fas fa-list-ol"></i>
							<p>{{ __('Configuración Documento') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documentary.programs') }}" class="nav-link">
							<i class="fab fa-accusoft"></i>
							<p>{{ __('Programas') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documentary.documents') }}" class="nav-link">
							<i class="fas fa-copy"></i>
							<p>{{ __('Documentos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documentary.formats') }}" class="nav-link">
							<i class="fas fa-paste"></i>
							<p>{{ __('Formatos') }}</p>
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