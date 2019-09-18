@extends('layouts.master')
@section('content')

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="{{ url('/dashboard') }}">Home</a>
			</li>

			<li>
				<a href="{{ url('/userDetails') }}">Manage User</a>
			</li>
			<li class="active">Manage Leave</li>
		</ul><!-- /.breadcrumb -->
		
	</div>

	<div class="page-content">
		

		<div class="page-header">
			<h1>
				Manage User
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Manage Leave
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">				

				{!! Form::open(array('action' => array('LeaveController@editLeaveData', $leaves->user_id), 'class' => 'form-horizontal')) !!}					

					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email Id </label>

						<div class="col-sm-5">							

							{!! Form::text('email', $leaves->email, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Name', 'readonly'=>'readonly']) !!}

						</div>
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>

					<div class="form-group {{ $errors->has('Full Name') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Full Name </label>

						<div class="col-sm-5">

							{!! Form::text('name', $leaves->name, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Enter Full Name', 'readonly'=>'readonly']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('employee_id') }}</span>
					</div>

					<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('name') ? 'has-error' : '' }}" for="form-field-1"> Employee Id </label>

						<div class="col-sm-5">		

						{!! Form::text('employee_id', $leaves->emp_id, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11','placeholder'=>'Employee Id', 'readonly'=>'readonly']) !!}

						</div>
						<span class="text-danger">{{ $errors->first('employee_id') }}</span>
					</div>					

					<div class="form-group {{ $errors->has('paid_leave') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Available PL </label>

						<div class="col-sm-5">

							{!! Form::text('paid_leave', $leaves->paid_leave, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Available PL','readonly'=>'readonly']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('paid_leave') }}</span>
					</div>					

					<div class="form-group {{ $errors->has('sick_leave') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Available SL</label>

						<div class="col-sm-5">

							{!! Form::text('sick_leave', $leaves->sick_leave, ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'placeholder'=>'Available SL','readonly'=>'readonly']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('sick_leave') }}</span>
					</div>

					<div class="form-group {{ $errors->has('leave_type') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Leave Type</label>

						<div class="col-sm-5">							

							{!!Form::select('leave_type', array('' => 'Please Select', 'Credit PL' => 'Credit PL', 'Credit SL' => 'Credit SL','Debit PL' => 'Debit PL', 'Debit SL' => 'Debit SL'), null, ['class' => 'col-xs-10 col-sm-5','id' => 'form-field-1']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('leave_type') }}</span>
					</div>

					<div class="form-group {{ $errors->has('leave_days') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Leave Days</label>

						<div class="col-sm-5">

							{!! Form::number('leave_days', '', ['class'=>'autosize-transition form-control', 'id'=>'form-field-11', 'step'=>'any', 'placeholder'=>'Number of days to be taken']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('leave_days') }}</span>
					</div>

					<div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Remark</label>

						<div class="col-sm-5">							

							{!! Form::textarea('remark',null,['class'=>'autosize-transition form-control', 'rows' => 5, 'cols' => 40, 'placeholder'=>'Remark']) !!}
							
						</div>
						<span class="text-danger">{{ $errors->first('remark') }}</span>
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