@extends('layouts.master')
@section('content')

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="{{ url('/dashboard') }}">Home</a>
			</li>

			<li>
				<a href="{{ url('/openTickets') }}">Ticket</a>
			</li>
			<li class="active">Edit Ticket</li>
		</ul><!-- /.breadcrumb -->
		
	</div>

	<div class="page-content">
		

		<div class="page-header">
			<h1>
				Ticket
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Edit Ticket
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				
				@foreach ($tickets as $ticket)

				{!! Form::open(array('action' => array('TicketController@editTicketData', $ticket->ticket_id), 'class' => 'form-horizontal')) !!}

					<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('name') ? 'has-error' : '' }}" for="form-field-1"> Subject </label>

						<div class="col-sm-9">		

						{!!Form::select('subject', array('' => 'Please Select', 'Application for PL' => 'Application for PL', 'Application for SL' => 'Application for SL'), $ticket->subject, ['class' => 'col-xs-10 col-sm-5','id' => 'form-field-1']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('subject') }}</span>
					</div>from_date

					<div class="form-group {{ $errors->has('leave_days') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('leave_days') ? 'has-error' : '' }}" for="form-field-1"> Leave Days </label>

						<div class="col-sm-9">

						{!! Form::number('leave_days', $ticket->leave_no, ['min'=>0.50,'class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-11', 'step'=>'any', 'placeholder'=>'Number of days to be taken']) !!}		
						
                           <span class="text-danger">{{ $errors->first('leave_days') }}</span>
						</div>						
					</div>

					<div class="form-group {{ $errors->has('from_date') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('from_date') ? 'has-error' : '' }}" for="form-field-1"> Effective From </label>

						<div class="col-sm-9">

						{!! Form::date('from_date', $ticket->from_date, ['class'=>'col-xs-10 col-sm-5', 'id'=>'form-field-1', 'placeholder'=>'Leave Effective From date']) !!}			
                           <span class="text-danger">{{ $errors->first('from_date') }}</span>
						</div>						
					</div>

					<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Message </label>

						<div class="col-sm-6">							

							{!! Form::textarea('message', $ticket->message, ['class'=>'autosize-transition form-control', 'rows' => 5, 'cols' => 40, 'placeholder'=>'Enter Message']) !!} 

						</div>
						<span class="text-danger">{{ $errors->first('message') }}</span>
					</div>

					<div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Remark </label>

						<div class="col-sm-6">

							{!! Form::textarea('remark', $ticket->remark, ['class'=>'autosize-transition form-control',  'rows' => 5, 'cols' => 40, 'placeholder'=>'Enter remark']) !!}
														
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
				@endforeach
					<!-- <div class="hr hr-24"></div> -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div>

@stop