<div id="navbar" class="navbar navbar-default ace-save-state">
	<div class="navbar-container ace-save-state" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<a href="{{ url('/dashboard') }}" class="navbar-brand">
				<small>
					<!-- <i class="fa fa-leaf"></i> -->
					<img src="resources/assets/images/avatars/tb_logo.png" alt="VTS" height="25">
					VTS HR Admin
				</small>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
			
				<li class="light-blue dropdown-modal">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
					@if(Auth::user()->profile_image!=NULL)
						<img class="nav-user-photo" src="resources/assets/images/avatars/{{Auth::user()->profile_image}}" width="36" height="36" alt="{{Auth::user()->profile_image}}" />
					@else
						<img class="nav-user-photo" src="assets/images/avatars/avatar5.png" alt="Jason's Photo" />
					@endif	
						<span class="user-info">
							<small>Welcome,</small>
							{{Auth::user()->name}}
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="{{ url('/profile') }}">
								<i class="ace-icon fa fa-cog"></i>
								Settings
							</a>
						</li>

						<li>
							<a href="{{ url('/profile') }}">
								<i class="ace-icon fa fa-user"></i>
								Profile
							</a>
						</li>

						<li class="divider"></li>

						<li>
							<a href="{{ url('/logout') }}">
								<i class="ace-icon fa fa-power-off"></i>
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div><!-- /.navbar-container -->
</div>