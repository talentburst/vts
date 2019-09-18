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
					Edit Address
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">	

			<div class="clearfix">
						<div class="pull-left alert alert-success no-margin alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>

							<i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
							Please fill all required permanent & current address fields to edit them ...
						</div>
					</div>

						@if(Session::has('success'))
						   <div class="alert alert-success">
						     {{ Session::get('success') }}
						   </div>
						@endif

					<div class="hr dotted"></div>			

				{!! Form::open(array('action' => array('UserController@editUserAddress', $users->user_id), 'class' => 'form-horizontal')) !!}

				<div class="row">						

					<div class="col-sm-6">
						<h4>Permanent Addrees Details:</h4>	<br>

					<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address : </label>

						<div class="col-sm-8">
							{!! Form::text('address', $users->address, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Address']) !!}
							<span class="text-danger">{{ $errors->first('address') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> City : </label>

						<div class="col-sm-8">
							{!! Form::text('city', $users->city, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter City']) !!}
							<span class="text-danger">{{ $errors->first('city') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> State : </label>

						<div class="col-sm-8">
							{!! Form::text('state', $users->state, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter State']) !!}
							<span class="text-danger">{{ $errors->first('state') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Country : </label>

						<div class="col-sm-8">
							{!! Form::text('country', $users->country, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Country']) !!}
							<span class="text-danger">{{ $errors->first('country') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('pincode') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Pancode: </label>

						<div class="col-sm-8">
							{!! Form::text('pincode', $users->pincode, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Pincode']) !!}
							<span class="text-danger">{{ $errors->first('pincode') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('landmark') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Landmark : </label>

						<div class="col-sm-8">
							{!! Form::text('landmark', $users->landmark, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Ladmark']) !!}
							<span class="text-danger">{{ $errors->first('landmark') }}</span>
						</div>
						
					</div>

				</div>					

					<div class="col-sm-6" id="current_address">

						<h4>Current Addrees Details:</h4><br>

						<div class="form-group {{ $errors->has('current_address') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address : </label>

						<div class="col-sm-8">
							{!! Form::text('current_address', $users->cur_address, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Current Address']) !!}
							<span class="text-danger">{{ $errors->first('current_address') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('current_city') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> City : </label>

						<div class="col-sm-8">
							{!! Form::text('current_city', $users->cur_city, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Current City']) !!}
							<span class="text-danger">{{ $errors->first('current_city') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('current_state') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> State : </label>

						<div class="col-sm-8">
							{!! Form::text('current_state', $users->cur_state, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Current State']) !!}
							<span class="text-danger">{{ $errors->first('current_state') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('current_country') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Country : </label>

						<div class="col-sm-8">
							{!! Form::text('current_country', $users->cur_country, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Current Country']) !!}
							<span class="text-danger">{{ $errors->first('current_country') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('current_pincode') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Pancode : </label>

						<div class="col-sm-8">
							{!! Form::text('current_pincode', $users->cur_pincode, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Current Pincode']) !!}
							<span class="text-danger">{{ $errors->first('current_pincode') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('current_landmark') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Landmark : </label>

						<div class="col-sm-8">
							{!! Form::text('current_landmark', $users->cur_landmark, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Current Ladmark']) !!}
							<span class="text-danger">{{ $errors->first('current_landmark') }}</span>
						</div>
						
					</div>

				</div>

					<div class="form-group {{ $errors->has('is_same_address') ? 'has-error' : '' }}">
						<label class="col-sm-4 control-label no-padding-right">
							 Permanent & Current address are same:
							 {!! Form::checkbox('is_same_address',1,false, array('class'=>'autosize-transition form-control ace ace-switch ace-switch-5 form-control','id'=>'is_same_address')) !!} 
							 <span class="lbl middle"></span> 	
						</label>						
						<span class="text-danger">{{ $errors->first('is_same_address') }}</span>
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
				
			<!-- <div class="hr hr-24"></div> -->
			
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div>
<style type="text/css">
	.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script>
         $(document).ready(function () {
             $("#is_same_address").change(function() {
				if (this.checked) {
					$("#current_address").addClass("disabledbutton");
				} else {
					$("#current_address").removeClass("disabledbutton");
				} 
             });
         })
         
     </script>
@stop