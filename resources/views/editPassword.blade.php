@extends('layouts.master')
@section('content')

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				 <a href="{{ url('/dashboard') }}">Home</a>
			</li>
			<li>
				 <a href="{{ url('/profile') }}">Profile</a>
			</li>
			<li class="active">Edit Password</li>
		</ul><!-- /.breadcrumb -->
		
	</div>

	<div class="page-content">
		

		<div class="page-header">
			<h1>
				Profile
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Edit Password
				</small>
			</h1>
		</div><!-- /.page-header -->

		@if(Session::has('success'))
		   <div class="alert alert-success">
		     {{ Session::get('success') }}
		   </div>
		@endif

		<div class="row">
			<div class="col-xs-12">				

				 {!! Form::open(array('action' => array('UserController@editUserPass','1'), 'class' => 'form-horizontal')) !!}				

					<div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Old Password </label>

						<div class="col-sm-5">

							{!! Form::password('old_password',['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Old Password']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('old_password') }}</span>
					</div>

					<div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> New Password </label>

						<div class="col-sm-5">		

						{!! Form::password('new_password',['class'=>'autosize-transition form-control', 'id'=>'form-field-11','placeholder'=>'New Password']) !!}

						</div>
						<span class="text-danger">{{ $errors->first('new_password') }}</span>
					</div>

					<div class="form-group {{ $errors->has('verify_new_password') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Verify New Password </label>

						<div class="col-sm-5">

							{!! Form::password('verify_new_password',['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Verify New Password']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('verify_new_password') }}</span>
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

				 <div class="hr hr-24"></div> 
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div>

@stop