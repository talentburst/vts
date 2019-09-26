@extends('layouts.master')
@section('content')

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					 <a href="{{ url('/dashboard') }}">Home</a>
				</li>
				<li>
				<a href="{{ url('/ClosedApplications') }}">Applications</a>
			</li>
				<li class="active">View Application</li>
			</ul><!-- /.breadcrumb -->			

		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Applications
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						View Application
					</small>
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="clearfix">
						<div class="pull-left alert alert-success no-margin alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>

							<i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
							Given below are you full apllication details ...
						</div>
					</div>

					@if(Session::has('success'))
					   <div class="alert alert-success">
					     {{ Session::get('success') }}
					   </div>
					@endif

					<div class="hr dotted"></div>

					<div>
						<div id="user-profile-1" class="user-profile row">


							<div class="col-xs-12">								

								<div class="space-12"></div>

								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name"> Application Id</div>

										<div class="profile-info-value">
											<span class="editable" id="username">
											<b>	#{{$tickets->ticket_id}}</b></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Apply Date</div>

										<div class="profile-info-value">
											<span class="editable" id="username">{{$tickets->created_at}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name">Applicant Email</div>

										<div class="profile-info-value">
											<span class="editable" id="email">{{$tickets->email}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Contact No.</div>

										<div class="profile-info-value">
											<span class="editable" id="username">{{$tickets->phone_number}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Name</div>

										<div class="profile-info-value">
											<span class="editable" id="name">{{$tickets->name}}</span>
										</div>
									</div>								

									<div class="profile-info-row">
										<div class="profile-info-name"> Subject</div>

										<div class="profile-info-value">
											<span class="editable" id="about">{{$tickets->subject}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name">No. of Laeve</div>

										<div class="profile-info-value">
											<span class="editable" id="about">{{$tickets->leave_no}}  Day's</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name">Laeve Effective From</div>

										<div class="profile-info-value">
											<span class="editable" id="about">{{$tickets->from_date}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Application </div>

										<div class="profile-info-value">						
											<span class="editable" id="country">{{$tickets->message}}</span>											
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Remark </div>

										<div class="profile-info-value">
											<span class="editable" id="age">{{$tickets->remark}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Status </div>

										<div class="profile-info-value">
											<span class="editable" id="signup">
											<b>	{{$tickets->status_name}}</b></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Responce </div>

										<div class="profile-info-value">
											<span class="editable" id="login">{{$tickets->responce}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Responce by</div>

										<div class="profile-info-value">
											<span class="editable" id="login">{{$tickets->responce_by_name}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Responce Date</div>

										<div class="profile-info-value">
											<span class="editable" id="login">{{$tickets->responce_at}}</span>
										</div>
									</div>
									
								</div>

								<div class="space-20"></div>								

								<div class="hr hr2 hr-double"></div>

								<div class="space-6"></div>

								
							</div>
						</div>
					</div>

					

					

					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

@stop			