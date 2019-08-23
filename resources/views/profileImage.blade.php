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
				<li class="active">Edit Profile Image</li>
			</ul><!-- /.breadcrumb -->

		</div>		

			<div class="page-header">
				<h1>
					Profile
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Edit Profile Image
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
					<!-- PAGE CONTENT BEGINS -->
					<div class="alert alert-info">
						<i class="ace-icon fa fa-hand-o-right"></i>

						Please note your existing image will be replced by current uploaded image.
						<button class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
					</div>

					<div>
						{!! Form::open(array('action' => array('UserController@editProfileImage',Auth::user()->id), 'class' => 'dropzone well', 'id' => 'dropzone', 'enctype' => 'multipart/form-data')) !!}							
						
						{!! Form::file('image') !!}

						<span class="text-danger">{{ $errors->first('image') }}</span>

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

					</div>
					
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->



@stop