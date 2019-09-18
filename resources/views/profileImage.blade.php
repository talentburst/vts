@extends('layouts.master')
@section('content')


<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">Profile</a>
				</li>
				<li class="active">Edit Profile Image</li>
			</ul><!-- /.breadcrumb -->

		</div>		

			<div class="page-header">
				<h1>
					Profile
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Edit Profile Image
					</small>
				</h1>
			</div><!-- /.page-header -->

			@if(Session::has('success'))
			   <div class="alert alert-success">
			     {{ Session::get('success') }}
			   </div>
			@endif

			<div class="row">

				@if(Auth::user()->is_id_proof==0)

				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="alert alert-info">
						<i class="ace-icon fa fa-hand-o-right"></i>

						Please note your existing image will be replced by current uploaded image.
						<button class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
					</div>

					{!! Form::open(array('action' => array('UserController@editProfileImage', Auth::user()->id), 'class' => 'form-horizontal', 'id' => 'dropzone', 'enctype' => 'multipart/form-data')) !!}

					<div class="form-group {{ $errors->has('aadhar_no') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('aadhar_no') ? 'has-error' : '' }}" for="form-field-1"> Aadhar Card Number </label>

						<div class="col-sm-9">

						{!! Form::number('aadhar_no', $user->aadhar_no, ['class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-1', 'placeholder'=>'Aadhar Card Number']) !!}	
						
                           <span class="text-danger">{{ $errors->first('aadhar_no') }}</span>
						</div>						
					</div>

					<div class="form-group {{ $errors->has('pan_no') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('pan_no') ? 'has-error' : '' }}" for="form-field-1"> Pan card Number </label>

						<div class="col-sm-9">

						{!! Form::text('pan_no', $user->pan_no, ['class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-1', 'placeholder'=>'Pan Card Number']) !!}				
						
                           <span class="text-danger">{{ $errors->first('pan_no') }}</span>
						</div>						
					</div>					

					<div class="form-group {{ $errors->has('aadhar_image') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('aadhar_image') ? 'has-error' : '' }}" for="form-field-1"> Aadhar Card Image </label>

						<div class="col-sm-9">										
						
						{!! Form::file('aadhar_image') !!}

						<span class="text-danger">{{ $errors->first('aadhar_image') }}</span>
						</div>	

					</div>

					<div class="form-group {{ $errors->has('pan_image') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('pan_image') ? 'has-error' : '' }}" for="form-field-1"> Pan Card Image </label>

						<div class="col-sm-9">										
						
						{!! Form::file('pan_image') !!}

						<span class="text-danger">{{ $errors->first('pan_image') }}</span>
						</div>	

					</div>

					<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('image') ? 'has-error' : '' }}" for="form-field-1"> Profile Image </label>

						<div class="col-sm-9">										
						
						{!! Form::file('image') !!}

						<span class="text-danger">{{ $errors->first('image') }}</span>
						</div>	

					</div>

					<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Update
								</button>

								&nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									Reset
								</button>
							</div>
					</div>

					{!! Form::close() !!}

					</div>

					@endif

					<div align="center">
						<span class="profile-picture" style="margin: 5px;">
						@if($user->profile_image!=NULL)
							<a href="resources/assets/images/avatars/{{$user->profile_image}}" target="_blank"><img id="avatar" class="editable" title="{{$user->name}}" alt="{{$user->aadhar_no}}" src="resources/assets/images/avatars/{{$user->profile_image}}" width="180" height="200" /></a>									
						@endif
						</span>
						<span class="profile-picture" style="margin: 5px;">
						@if($user->pan_image!=NULL)
							<a href="resources/assets/images/pancard/{{$user->pan_image}}" target="_blank"><img id="avatar" class="editable" title="Pancard No.- {{$user->pan_no}}" alt="{{$user->pan_image}}" src="resources/assets/images/pancard/{{$user->pan_image}}" width="180" height="200" /></a>									
						@endif
						</span>
						<span class="profile-picture" style="margin: 5px;">
						@if($user->aadhar_image!=NULL)
							<a href="resources/assets/images/aadharcard/{{$user->aadhar_image}}" target="_blank"><img id="avatar" class="editable" title="Aadhar No.- {{$user->aadhar_no}}" alt="{{$user->aadhar_no}}" src="resources/assets/images/aadharcard/{{$user->aadhar_image}}" width="180" height="200" /></a>									
						@endif
						</span>
					</div>
					
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

@stop