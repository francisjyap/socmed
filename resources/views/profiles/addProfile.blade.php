@extends('layouts.layout')

@section('title', 'Add Profile')

@section('content')

<div class="row">
	<div class="col-md-8 offset-2">
    	<h3 style="margin-top: 5%; margin-bottom: 5%;">Add Profile</h3>
		
		<div class="row">
			<div class="col-md-6 offset-3">
				<form id="form" method="POST" action="addProfile">
					@csrf
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" autofocus="true" required="true">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" required="true">
					</div>
					<div class="form-group">
						<label>Website URL</label>
						<input type="url" name="website" class="form-control">
					</div>
					<div class="form-group">
						<label>Country</label>
						<input type="text" name="country" class="form-control">
					</div>
					<div class="clearfix">
						<a href="{{ route("home") }}" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
						<button type="submit" class="btn btn-success" style="float: right;"><i class="fas fa-check"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
