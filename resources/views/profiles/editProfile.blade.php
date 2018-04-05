@extends('layouts.layout')

@section('title', 'Edit Profile')

@section('content')

<div class="row">
	<div class="col-md-8 offset-2">
    	<h3 style="margin-top: 5%; margin-bottom: 5%;">Edit Profile</h3>
		
		<div class="row">
			<div class="col-md-6 offset-3">
				<form id="form" method="POST" action="{{ route('updateProfile') }}">
					@csrf
					<input type="hidden" name="id" value="{{ $profile->id }}">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" autofocus="true" required="true" value="{{ $profile->name }}">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" required="true" value="{{ $profile->email }}">
					</div>
					<div class="form-group">
						<label>Website URL</label>
						<input type="url" name="website" class="form-control" value="{{ $profile->website }}">
					</div>
					<div class="form-group">
						<label>Country</label>
						<input type="text" name="country" class="form-control" value="{{ $profile->country }}">
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
