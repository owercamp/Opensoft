@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2 mt-4">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('contractors.handbook') }}" class="nav-link">
							<i class="fas fa-fist-raised"></i>
							<p>{{ __('Manual de funciones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('contractors.bill') }}" class="nav-link">
							<i class="fas fa-list-ol"></i>
							<p>{{ __('Minuta de Contrato') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('contractors.legalization') }}" class="nav-link">
							<i class="fab fa-accusoft"></i>
							<p>{{ __('Legalización de Contrato') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('contractors.agreement') }}" class="nav-link">
							<i class="fas fa-copy"></i>
							<p>{{ __('Convenio Colaboración Empresarial') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('contractors.tracking') }}" class="nav-link">
							<i class="fas fa-paste"></i>
							<p>{{ __('Seguimiento Seguridad Social') }}</p>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-md-8">
				<div class="row">
					@yield('space')
				</div>
			</div>
			<div class="col-md-2 mt-4">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('contractors.notifications') }}" class="nav-link">
							<i class="fas fa-comment-alt"></i>
							<p>{{ __('Notificaciones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('contractors.control') }}" class="nav-link">
							<i class="fas fa-paste"></i>
							<p>{{ __('Control de Asistencia y Ausentismo') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('contractors.trainings') }}" class="nav-link">
							<i class="fas fa-check-double"></i>
							<p>{{ __('Control de Asistencia a Capacitaciones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('contractors.tests') }}" class="nav-link">
							<i class="fas fa-notes-medical"></i>
							<p>{{ __('Evaluaciones de desempeño') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('contractors.activations') }}" class="nav-link">
							<i class="fas fa-notes-medical"></i>
							<p>{{ __('Activaciones del sistema') }}</p>
						</a>
					</li>
				</ul>
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