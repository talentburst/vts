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
			
			<li class="active">Leave Applications Reports</li>
			</ul><!-- /.breadcrumb -->
			
		</div>

		<div class="page-content">						

			<div class="page-header">
				<h1>
					Home
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Leave Applications Reports
					</small>
				</h1>
			</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								

								@if(Session::has('success'))
						   <div class="alert alert-success">
						     {{ Session::get('success') }}
						   </div>
						@endif

							 <h3 class="header smaller lighter blue">Download Leave Applications Report</h3>

							 <div class="row">
								<div class="col-xs-8 col-sm-6">
								    {!! Form::open(array('action' => array('LeaveController@exports', Auth::user()->id), 'class' => 'form-horizontal', 'id' => 'dropzone')) !!}

									<div class="input-daterange input-group">
										<input type="text" class="input-sm form-control" name="from_date" placeholder="Start Date" autocomplete="off" />
										<span class="input-group-addon">
											<i class="fa fa-exchange"></i>
										</span>

										<input type="text" class="input-sm form-control" name="to_date" placeholder="To Date" autocomplete="off" />
										
									</div>
									<span class="text-danger">{{ $errors->first('from_date') }}</span><br>
									<span class="text-danger">{{ $errors->first('to_date') }}</span>

									<hr />

									<div class="input-daterange input-group">						<div>	
											<select name="status" class="chosen-select form-control"  id="form-field-select-3" data-placeholder="Choose a status...">
												<option value=""></option>
												@foreach($status as $status)
												<option value="{{ $status->id}}">{{ $status->status_name}}</option>
												@endforeach
											</select>
										</div>
										<span class="input-group-addon">
											<i class="fa fa-exchange"></i>
										</span>
										<div>	
											<select name="user_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a employee...">
												<option value=""></option>
												@foreach($users as $user)
												<option value="{{ $user->id}}">{{ $user->email}}</option>
												@endforeach
											</select>
										</div>
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
								</div>
							</div>							

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
		</div><!-- /.main-container -->

		
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