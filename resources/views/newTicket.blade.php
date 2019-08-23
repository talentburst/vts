@extends('layouts.master')
@section('content')

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
						<label class="col-sm-3 control-label no-padding-right {{ $errors->has('name') ? 'has-error' : '' }}" for="form-field-1"> Subject </label>

						<div class="col-sm-9">

						{!!Form::select('subject', array('' => 'Please Select', 'Application for PL' => 'Application for PL', 'Application for SL' => 'Application for SL'), null, ['class' => 'col-xs-10 col-sm-5','id' => 'form-field-1']) !!}				
						
                           <span class="text-danger">{{ $errors->first('subject') }}</span>
						</div>
						
					</div>

					<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Message </label>

						<div class="col-sm-6">
							
							{!! Form::textarea('message', old('message'), ['id'=>'form-field-11','class'=>'autosize-transition form-control', 'placeholder'=>'Enter Message']) !!}

						</div>
						<span class="text-danger">{{ $errors->first('message') }}</span>
					</div>

					<div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Remark </label>

						<div class="col-sm-6">
							
							{!! Form::textarea('remark', old('remark'), ['id'=>'form-field-11','class'=>'autosize-transition form-control', 'placeholder'=>'Enter Remark']) !!}							
							
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

@stop