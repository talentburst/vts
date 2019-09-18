@extends('layouts.master')
@section('content')

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					 <a href="{{ url('/dashboard') }}">Home</a>
				</li>
				<li class="active">User Profile</li>
			</ul><!-- /.breadcrumb -->			

		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					User Profile
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Edit your profile
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
							Click on the image below or on profile fields to edit them ...
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
							<div class="col-xs-12 col-sm-3 center">
								<div>
									<span class="profile-picture">
									@if($users->profile_image!=NULL)
										<img id="avatar" class="editable" alt="{{$users->name}}" src="resources/assets/images/avatars/{{$users->profile_image}}" width="200" height="255" />
									@else
										<img id="avatar" class="editable img-responsive" alt="{{$users->profile_image}}" src="assets/images/avatars/profile-pic.jpg" />
									@endif
									</span>

									<div class="space-4"></div>

									<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
										<div class="inline position-relative">
											<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
												<i class="ace-icon fa fa-circle light-green"></i>
												&nbsp;
												<span class="white">{{$users->name}}</span>
											</a>

											<ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
												<li class="dropdown-header"> Change Status </li>

												<li>
													<a href="#">
														<i class="ace-icon fa fa-circle green"></i>
&nbsp;
														<span class="green">Available</span>
													</a>
												</li>

												<li>
													<a href="#">
														<i class="ace-icon fa fa-circle red"></i>
&nbsp;
														<span class="red">Busy</span>
													</a>
												</li>

												<li>
													<a href="#">
														<i class="ace-icon fa fa-circle grey"></i>
&nbsp;
														<span class="grey">Invisible</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>

								<div class="space-6"></div>

								<div class="profile-contact-info">
									<div class="profile-contact-links align-left">
										<a href="{{ url('/editProfile') }}" class="btn btn-link">
											<i class="ace-icon fa fa-pencil bigger-130"></i>
											Edit Profile
										</a>

										<a href="{{ url('/profileImage') }}" class="btn btn-link">
											<i class="ace-icon fa fa-user bigger-120 pink"></i>
											Update Profile Image/Id Proof
										</a>

										<a href="{{ url('/editAddress') }}" class="btn btn-link">
											<i class="ace-icon fa fa-envelope bigger-125 blue"></i>
											Update Address
										</a>
									</div>

									<div class="space-6"></div>
									
								</div>

							</div>

							<div class="col-xs-12 col-sm-9">								

								<div class="space-12"></div>

								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name"> Employee Id</div>

										<div class="profile-info-value">
											<span class="editable" id="username">#{{$users->emp_id}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Name</div>

										<div class="profile-info-value">
											<span class="editable" id="name">{{$users->name}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Email</div>

										<div class="profile-info-value">
											<span class="editable" id="email">{{$users->email}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Contact No.</div>

										<div class="profile-info-value">
											<span class="editable" id="username">{{$users->phone_number}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Title </div>

										<div class="profile-info-value">
											<span class="editable" id="about">{{$users->title}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Department </div>

										<div class="profile-info-value">
											<span class="editable" id="about">{{$users->department}}</span>
										</div>
									</div>									

									<div class="profile-info-row">
										<div class="profile-info-name"> DOB </div>

										<div class="profile-info-value">
											<span class="editable" id="age">{{$users->dob}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> DOJ </div>

										<div class="profile-info-value">
											<span class="editable" id="signup">{{$users->doj}}</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Total Experience </div>

										<div class="profile-info-value">						
											<span class="editable" id="country">{{$users->total_exp}}</span>											
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Relevant Expiriance </div>

										<div class="profile-info-value">						
											<span class="editable" id="country">{{$users->relevant_exp}}</span>											
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Work Location </div>

										<div class="profile-info-value">
											<i class="fa fa-map-marker light-orange bigger-110"></i>
											<span class="editable" id="country">{{$users->location}}</span>											
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Last Login </div>

										<div class="profile-info-value">
											<span class="editable" id="login">{{$users->last_login}}</span>
										</div>
									</div>
									
								</div>

								<div class="space-20"></div>								

								<!-- <div class="hr hr2 hr-double"></div> -->

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