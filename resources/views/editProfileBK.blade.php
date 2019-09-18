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
			<li class="active">Edit Profile</li>
		</ul><!-- /.breadcrumb -->
		
	</div>

	<div class="page-content">
		

		<div class="page-header">
			<h1>
				Profile
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Edit Profile
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">				

				{!! Form::open(array('action' => array('UserController@editUserProfile', $users->id), 'class' => 'form-horizontal')) !!}					

					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email Id </label>

						<div class="col-sm-5">							

							{!! Form::text('name', $users->email, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Name', 'readonly'=>'readonly']) !!}

						</div>
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>

					<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Contact No. </label>

						<div class="col-sm-5">

							{!! Form::text('phone_number', $users->phone_number, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Phone Number']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('phone_number') }}</span>
					</div>

					<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('name') ? 'has-error' : '' }}" for="form-field-1"> Employee Id </label>

						<div class="col-sm-5">		

						{!! Form::text('employee_id', $users->emp_id, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11','placeholder'=>'Employee Id']) !!}

						</div>
						<span class="text-danger">{{ $errors->first('employee_id') }}</span>
					</div>

					<div class="form-group {{ $errors->has('Full Name') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Full Name </label>

						<div class="col-sm-5">

							{!! Form::text('name', $users->name, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Full Name']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('employee_id') }}</span>
					</div>

					<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Role </label>

						<div class="col-sm-5">

							{!! Form::text('role', $users->role, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Your Role']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('role') }}</span>
					</div>

					<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> DOB </label>

						<div class="col-sm-5">

							{!! Form::date('dob', $users->dob, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Date of Birth']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('dob') }}</span>
					</div>

					<div class="form-group {{ $errors->has('doj') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> DOJ </label>

						<div class="col-sm-5">

							{!! Form::date('doj', $users->doj, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Date of Joining']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('doj') }}</span>
					</div>

					<div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Location</label>

						<div class="col-sm-5">

							{!! Form::text('location', $users->location, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Your Working Location']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('location') }}</span>
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
				
					<!-- <div class="hr hr-24"></div> -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div>

@stop