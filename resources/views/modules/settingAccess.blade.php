@extends('home')

@section('modules')
	<div class="col-md-12 bj-container-nav">
		<div class="row">
			<div class="col-md-2">
				<ul class="nav bj-flex">
					<li>
						<a href="{{ route('access.roles') }}" class="nav-link">
							<i class="fas fa-user-tag"></i>
							<p>{{ __('Roles') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('access.permissions') }}" class="nav-link">
							<i class="fas fa-user-shield"></i>
							<p>{{ __('Permisos') }}</p>
						</a>
					</li>
					<div class="dropdown-divider bj-divider"></div>
					<li>
						<a href="{{ route('access.users') }}" class="nav-link">
							<i class="fas fa-users"></i>
							<p>{{ __('Usuarios') }}</p>
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