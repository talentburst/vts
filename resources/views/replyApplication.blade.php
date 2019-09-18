@extends('layouts.master')
@section('content')

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="{{ url('/dashboard') }}">Home</a>
			</li>

			<li>
				<a href="{{ url('/pendingApplication') }}">Application</a>
			</li>
			<li class="active">Reply application</li>
		</ul><!-- /.breadcrumb -->
		
	</div>

	<div class="page-content">
		

		<div class="page-header">
			<h1>
				Application
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Reply Application
				</small>
			</h1>
		</div><!-- /.page-header -->

		<?php //print_r($status); exit; ?>

		<div class="row">
			<div class="col-xs-12">				

				{!! Form::open(array('action' => array('HrAdminController@replyApplicationData', $ticket->ticket_id), 'class' => 'form-horizontal')) !!}

					<div class="form-group {{ $errors->has('ticket_id') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('ticket_id') ? 'has-error' : '' }}" for="form-field-1"> Application Id </label>

						<div class="col-sm-9">

						{!! Form::text('ticket_id', $ticket->ticket_id, ['class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-11', 'step'=>'any', 'readonly'=>'readonly', 'placeholder'=>'Application Id taken']) !!}		
						
                           <span class="text-danger">{{ $errors->first('ticket_id') }}</span>
						</div>						
					</div>

					<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('name') ? 'has-error' : '' }}" for="form-field-1"> Subject </label>

						<div class="col-sm-9">		

						{!!Form::select('subject', array('' => 'Please Select', 'Application for PL' => 'Application for PL', 'Application for SL' => 'Application for SL'), $ticket->subject, ['class' => 'col-xs-10 col-sm-5','id' => 'form-field-1', 'disabled' => 'disabled']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('subject') }}</span>
					</div>

					<div class="form-group {{ $errors->has('leave_days') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('leave_days') ? 'has-error' : '' }}" for="form-field-1"> Leave Days </label>

						<div class="col-sm-9">

						{!! Form::number('leave_days', $ticket->leave_no, ['min'=>0.50,'class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-11', 'step'=>'any', 'readonly'=>'readonly', 'placeholder'=>'Number of days to be taken']) !!}		
						
                           <span class="text-danger">{{ $errors->first('leave_days') }}</span>
						</div>						
					</div>

					<div class="form-group {{ $errors->has('from_date') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('from_date') ? 'has-error' : '' }}" for="form-field-1"> Effective From </label>

						<div class="col-sm-9">

						{!! Form::date('from_date', $ticket->from_date, ['class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-1', 'readonly'=>'readonly', 'placeholder'=>'Leave Effective From date']) !!}			
                           <span class="text-danger">{{ $errors->first('from_date') }}</span>
						</div>						
					</div>

					<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Message </label>

						<div class="col-sm-6">							

							{!! Form::textarea('message', $ticket->message, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Message', 'rows' => 5, 'cols' => 40]) !!} 

						</div>
						<span class="text-danger">{{ $errors->first('message') }}</span>
					</div>

					<div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Remark </label>

						<div class="col-sm-6">

							{!! Form::textarea('remark', $ticket->remark, ['class'=>'autosize-transition form-control',  'placeholder'=>'Enter remark', 'rows' => 5, 'cols' => 40]) !!}
														
						</div>
					</div>

					<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('name') ? 'has-error' : '' }}" for="form-field-1"> Status </label>

						<div class="col-sm-9">	

						<select name="status" class="col-xs-10 col-sm-5">
							<option value="">Please select status</option>
							@foreach($status as $status)
							<option value="{{ $status->id}}">{{ $status->status_name}}</option>
							@endforeach
						</select>					
							
						</div>
						<span class="text-danger">{{ $errors->first('status') }}</span>
					</div>

					<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Reply Remark </label>

						<div class="col-sm-6">							

							{!! Form::textarea('responce', $ticket->responce, ['class'=>'autosize-transition form-control', 'rows' => 5, 'cols' => 40, 'placeholder'=>'Enter reply remark']) !!} 

						</div>
						<span class="text-danger">{{ $errors->first('responce') }}</span>
					</div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Update
							</button>
							{!! Form::hidden('user_id', $ticket->user_id, ['class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-11', 'readonly'=>'readonly', 'placeholder'=>'Applicant Id taken']) !!}

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