<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>
						<span class="btn btn-info"></span>
						<span class="btn btn-warning"></span>
						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

					<?php 
						$action = app('request')->route()->getAction();
						$controller = class_basename($action['controller']);
						list($controller, $action) = explode('@', $controller);
					?>

				<ul class="nav nav-list">
					<li class="@if($controller=='UserController' && $action=='dashboard') active @endif">
						<a href="{{ url('/dashboard') }}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

				<li class="@if($controller=='UserController' && $action!='dashboard') active open @endif">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> Users </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="@if($segment = Request::segment(1)=='profile') active @endif">
								 <a href="{{ url('/profile') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									User Profile
								</a>

								<b class="arrow"></b>
							</li>

							<li class="@if($action=='editPassword') active @endif">
								<a href="{{ url('/editPassword') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Update Password
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>

					<li class="@if($controller=='TicketController') active open @endif">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Applications </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="@if($action=='newTicket') active @endif">
								 <a href="{{ url('/newTicket') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									New Application
								</a>

								<b class="arrow"></b>
							</li>

							<li class="@if($action=='getOpenTickets') active @endif">
								<a href="{{ url('/openTickets') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Pending Applications
								</a>

								<b class="arrow"></b>
							</li>

							<li class="@if($action=='getClosedTickets') active @endif">
								<a href="{{ url('/closedTickets') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Closed Applications
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					@if(Auth::user()->is_hr_admin==1)

					<li class="@if($controller=='HrAdminController' || $controller=='LeaveController') active open @endif">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> HR Admin </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">

							<li class="@if($action=='pendingApplications') active @endif">
								 <a href="{{ url('/pendingApplications') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Pending Applications(All) 
								</a>

								<b class="arrow"></b>
							</li>

							<li class="@if($action=='closedApplications') active @endif">
								 <a href="{{ url('/closedApplications') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Closed Applications(All) 
								</a>

								<b class="arrow"></b>
							</li>

							<li class="@if($action=='userDetails') active @endif">
								 <a href="{{ url('/userDetails') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									User Details
								</a>

								<b class="arrow"></b>
							</li>

							<li class="@if($action=='leaveDetails') active @endif">
								<a href="{{ url('/leaveDetails') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Manage Leave
								</a>

								<b class="arrow"></b>
							</li>

							<li class="@if($action=='leaveReports') active @endif">
								<a href="{{ url('/leaveReports') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Leave Reports
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>

					 @endif

					<li class="">
						<a href="{{ url('/calendar') }}">						
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								Calendar
								<span class="badge badge-transparent tooltip-error" title="2 Important Events">
									<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li>					

					

					
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>