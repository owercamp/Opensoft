@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('places.departments') }}" class="nav-link">
							<i class="fas fa-mountain"></i>
							<p>{{ __('Departamentos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('places.municipalities') }}" class="nav-link">
							<i class="fas fa-city"></i>
							<p>{{ __('Municipios') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('places.zoning') }}" class="nav-link">
							<i class="fas fa-road"></i>
							<p>{{ __('Zonificación') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('places.neighborhoods') }}" class="nav-link">
							<i class="fas fa-home"></i>
							<p>{{ __('Barrios') }}</p>
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

		// PINTAR LA OPCION DEL MENU QUE SE HALLA CLIKEADO PARA IDENTIFICAR EN CUAL MODULO ESTA EL USUARIO
		// $('a').on('click',function(){
		// 	$('a').each(function(){
		// 		$(this).css('opacity','.5');
		// 	});
		// 	$(this).css('opacity','1');
		// 	$(this).css('background','#627700');
		// });
	</script>
@endsection