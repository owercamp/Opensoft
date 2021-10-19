@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('company.legal') }}" class="nav-link">
							<i class="fas fa-globe"></i>
							<p>{{ __('Información juridica') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('company.financial') }}" class="nav-link">
							<i class="fas fa-funnel-dollar"></i>
							<p>{{ __('Información financiera') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('company.technical') }}" class="nav-link">
							<i class="fas fa-drafting-compass"></i>
							<p>{{ __('Información técnica') }}</p>
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