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
				<a href="{{ url('/dashboard') }}">Home</a>
			</li>

			<li>
				<a href="{{ url('/openTickets') }}">Applications</a>
			</li>
			<li class="active">New Application</li>
		</ul><!-- /.breadcrumb -->
		
	</div>

	<div class="page-content">
		

		<div class="page-header">
			<h1>
				Applications
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					New Application
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				
				{!! Form::open(['route'=>'saveticket.store', 'class' => 'form-horizontal']) !!}

					<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('name') ? 'has-error' : '' }}" for="form-field-1"> Subject  : </label>

						<div class="col-sm-9">

						{!!Form::select('subject', array('' => 'Please Select', 'Application for PL' => 'Application for PL', 'Application for SL' => 'Application for SL'), null, ['class' => 'col-xs-10 col-sm-5','id' => 'form-field-1']) !!}				
						
                           <span class="text-danger">{{ $errors->first('subject') }}</span>
						</div>						
					</div>

					<div class="form-group {{ $errors->has('leave_days') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('leave_days') ? 'has-error' : '' }}" for="form-field-1"> Leave Days : </label>

						<div class="col-sm-9">

						{!! Form::number('leave_days', '', ['min'=>0.50, 'class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-1', 'step'=>'any', 'placeholder'=>'Number of days to be taken']) !!}				
						
                           <span class="text-danger">{{ $errors->first('leave_days') }}</span>
						</div>						
					</div>

					<div class="form-group {{ $errors->has('from_date') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('from_date') ? 'has-error' : '' }}" for="form-field-1"> Leave Effective From : </label>

						<div class="col-sm-9">							
							<div class="row">
								<div class="col-xs-8 col-sm-5">
									<div class="input-group">								
										{!! Form::text('from_date', '', ['class'=>'form-control date-picker', 'id'=>'id-date-picker-1', 'readonly'=>'readonly','data-date-format'=>'yyyy-mm-dd', 'readonly'=>'readonly', 'placeholder'=>'Leave Start Date']) !!}
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
									 <span class="text-danger">{{ $errors->first('from_date') }}</span>
								</div>
							</div>                          
						</div>						
					</div>

					<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Message  : </label>

						<div class="col-sm-6">
							
							{!! Form::textarea('message', old('message'), ['id'=>'form-field-11','class'=>'autosize-transition form-control', 'rows' => 5, 'cols' => 40, 'placeholder'=>'Enter Message']) !!}

						</div>
						<span class="text-danger">{{ $errors->first('message') }}</span>
					</div>

					<div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Remark : </label>

						<div class="col-sm-6">
							
							{!! Form::textarea('remark', old('remark'), ['id'=>'form-field-11','class'=>'autosize-transition form-control', 'rows' => 5, 'cols' => 40, 'placeholder'=>'Enter Remark']) !!}		
							
						</div>
						<span class="text-danger">{{ $errors->first('remark') }}</span>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
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

		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>


		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		
		<script src="assets/js/spinbox.min.js"></script>
		
		<script src="assets/js/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="assets/js/jquery.knob.min.js"></script>
		<script src="assets/js/autosize.min.js"></script>
		<script src="assets/js/jquery.inputlimiter.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		<script src="assets/js/bootstrap-tag.min.js"></script>

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
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
				

			});
		</script>
@stop