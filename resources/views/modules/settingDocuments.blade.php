@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('documents.personal') }}" class="nav-link">
							<i class="fas fa-id-card"></i>
							<p>{{ __('Identificación personal') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documents.driving') }}" class="nav-link">
							<i class="fas fa-id-card-alt"></i>
							<p>{{ __('Licencias de conducción') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documents.courses') }}" class="nav-link">
							<i class="fas fa-certificate"></i>
							<p>{{ __('Cursos certificados') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documents.insurances') }}" class="nav-link">
							<i class="fas fa-copy"></i>
							<p>{{ __('Pólizas y seguros') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('documents.legalization') }}" class="nav-link">
							<i class="fas fa-file-contract"></i>
							<p>{{ __('Legalización de vehículos') }}</p>
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