@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="assets/css/chosen.min.css" />
<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
<!-- ace styles -->
<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

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
		
		<?php $selectedDept=$users->department; //print_r($status); exit; ?>

		<div class="row">
			<div class="col-xs-12">	

					<div class="clearfix">
						<div class="pull-left alert alert-success no-margin alert-dismissable">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>

							<i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
							Please fill all required profile fields to edit them ...
						</div>
					</div>

						@if(Session::has('success'))
						   <div class="alert alert-success">
						     {{ Session::get('success') }}
						   </div>
						@endif

					<div class="hr dotted"></div>			

				{!! Form::open(array('action' => array('UserController@editUserProfile', $users->user_id), 'class' => 'form-horizontal')) !!}

				<div class="form-group {{ $errors->has('Full Name') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Full Name : </label>

						<div class="col-sm-5">
							{!! Form::text('name', Auth::user()->name, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'readonly'=>'readonly']) !!}							
						</div>
						<span class="text-danger">{{ $errors->first('name') }}</span>
					</div>					

					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email Id : </label>

						<div class="col-sm-5">
							{!! Form::text('name', Auth::user()->email, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'readonly'=>'readonly']) !!}
						</div>
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>

					<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Contact No. : </label>

						<div class="col-sm-5">
							{!! Form::text('phone_number', $users->phone_number, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Phone Number']) !!}
						</div>
						<span class="text-danger">{{ $errors->first('phone_number') }}</span>
					</div>

					<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('name') ? 'has-error' : '' }}" for="form-field-1"> Employee Id : </label>

						<div class="col-sm-5">	
						{!! Form::text('employee_id', $users->emp_id, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11','placeholder'=>'Employee Id']) !!}
						</div>
						<span class="text-danger">{{ $errors->first('employee_id') }}</span>
					</div>				

					<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Title : </label>

						<div class="col-sm-5">
							{!! Form::text('title', $users->title, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Your Role']) !!}	
						</div>
						<span class="text-danger">{{ $errors->first('title') }}</span>
					</div>				
					
					<div class="form-group {{ $errors->has('department') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department </label>

						<div class="col-sm-5">
						<select name="department" class="form-control">
							<option value="">Please select department</option>
							@foreach($departments as $department)
							<option value="{{ $department->id}}" {{ $selectedDept == $department->id ? 'selected="selected"' : '' }}>{{ $department->dept_name}}</option>
							@endforeach
						</select>							
						</div>
						<span class="text-danger">{{ $errors->first('department') }}</span>
					</div>


					<div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> DOB : </label>
						<div class="col-sm-9">							
							<div class="row">
								<div class="col-xs-8 col-sm-5">
									<div class="input-group">								
										{!! Form::text('dob', $users->dob, ['class'=>'form-control date-picker', 'id'=>'id-date-picker-1', 'readonly'=>'readonly','data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'Date of Birth']) !!}
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
									 <span class="text-danger">{{ $errors->first('dob') }}</span>
								</div>
							</div>                          
						</div>	
					</div>

					<div class="form-group {{ $errors->has('doj') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> DOJ : </label>
						<div class="col-sm-9">							
							<div class="row">
								<div class="col-xs-8 col-sm-5">
									<div class="input-group">								
										{!! Form::text('doj', $users->doj, ['class'=>'form-control date-picker', 'id'=>'id-date-picker-1', 'readonly'=>'readonly','data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'Date of Joining']) !!}
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
									 <span class="text-danger">{{ $errors->first('doj') }}</span>
								</div>
							</div>                          
						</div>	
					</div>					

					<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Total Experience : </label>

						<div class="col-sm-5">
							{!! Form::text('total_exp', $users->total_exp, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Total Experience']) !!}
						</div>
						<span class="text-danger">{{ $errors->first('total_exp') }}</span>
					</div>

					<div class="form-group {{ $errors->has('relevant_exp') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Relevant Expiriance : </label>

						<div class="col-sm-5">
							{!! Form::text('relevant_exp', $users->relevant_exp, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Relevant Experience']) !!}							
						</div>
						<span class="text-danger">{{ $errors->first('relevant_exp') }}</span>
					</div>

					<div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Work Location : </label>

						<div class="col-sm-5">
							{!! Form::text('location', $users->location, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Work Location']) !!}
						</div>
						<span class="text-danger">{{ $errors->first('location') }}</span>
					</div>

					@if(Auth::user()->is_profile==0)

					<div class="col-sm-5">
							{!! Form::hidden('emp_ctc', $users->emp_ctc, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter CTC']) !!}
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

					@endif

				{!! Form::close() !!}
				
					<!-- <div class="hr hr-24"></div> -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div>
<script src="assets/js/bootstrap-datepicker.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {			
	
		//datepicker plugin
		//link
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
	
		//or change it into a date range picker
		$('.input-daterange').datepicker({autoclose:true});

		if(!ace.vars['touch']) {
			$('.chosen-select').chosen({allow_single_deselect:true}); 
			//resize the chosen on window resize
	
			$(window)
			.off('resize.chosen')
			.on('resize.chosen', function() {
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			}).trigger('resize.chosen');
			//resize chosen on sidebar collapse/expand
			$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
				if(event_name != 'sidebar_collapsed') return;
				$('.chosen-select').each(function() {
					 var $this = $(this);
					 $this.next().css({'width': $this.parent().width()});
				})
			});	
	
			$('#chosen-multiple-style .btn').on('click', function(e){
				var target = $(this).find('input[type=radio]');
				var which = parseInt(target.val());
				if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
				 else $('#form-field-select-4').removeClass('tag-input-style');
			});
		}

		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		})		
	});
</script>
@stop