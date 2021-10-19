@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2 mt-4">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('collaborators.position') }}" class="nav-link">
							<i class="fas fa-fist-raised"></i>
							<p>{{ __('Creación de Cargos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.hankbook') }}" class="nav-link">
							<i class="fas fa-file-alt"></i>
							<p>{{ __('Manual de funciones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.bill') }}" class="nav-link">
							<i class="fas fa-list-ol"></i>
							<p>{{ __('Minuta de Contrato') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.legalization') }}" class="nav-link">
							<i class="fab fa-accusoft"></i>
							<p>{{ __('Legalización de Contrato') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.affiliations') }}" class="nav-link">
							<i class="fas fa-copy"></i>
							<p>{{ __('Afiliaciones Seguridad Social') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.endowments') }}" class="nav-link">
							<i class="fas fa-toolbox"></i>
							<p>{{ __('Entrega de dotaciones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.tools') }}" class="nav-link">
							<i class="fas fa-tools"></i>
							<p>{{ __('Entrega de Equipos y Herramientas') }}</p>
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
						<a href="{{ route('collaborators.notifications') }}" class="nav-link">
							<i class="fas fa-comment-alt"></i>
							<p>{{ __('Notificaciones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.control') }}" class="nav-link">
							<i class="fas fa-paste"></i>
							<p>{{ __('Control de Asistencia y Ausentismo') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.trainings') }}" class="nav-link">
							<i class="fas fa-check-double"></i>
							<p>{{ __('Control de Asistencia a Capacitaciones') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.entranceexams') }}" class="nav-link">
							<i class="fas fa-notes-medical"></i>
							<p>{{ __('Exámenes Médicos de Ingreso') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.examsperiods') }}" class="nav-link">
							<i class="fas fa-file-signature"></i>
							<p>{{ __('Exámenes médicos Periódicos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.exitexams') }}" class="nav-link">
							<i class="fas fa-notes-medical"></i>
							<p>{{ __('Exámenes médicos de egreso') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('collaborators.tests') }}" class="nav-link">
							<i class="fas fa-notes-medical"></i>
							<p>{{ __('Evaluaciones de desempeño') }}</p>
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