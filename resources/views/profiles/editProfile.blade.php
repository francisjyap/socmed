{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}
@extends('layouts.layout')

@section('title', 'Edit Profile')

@section('content')

<div class="row mar-bot-5">
	<div class="col-md-10 offset-1">

		@include('layouts.errors')

    	<h3 style="margin-top: 5%; margin-bottom: 5%;">Edit Profile</h3>
		
		<div class="row">
			<div class="col-md-8 offset-2">
				<form id="form" method="POST" action="{{ route('updateProfile') }}">
					@csrf
					<input type="hidden" name="id" value="{{ $profile->id }}">
					<div class="form-group">
						<label>Name <span style="color: red;">*</span></label>
						<input type="text" name="name" class="form-control" autofocus="true" required="true" value="{{ $profile->name }}">
					</div>
					<div class="form-group">
						<label>Company Name</label>
						<input type="text" name="company_name" class="form-control" value="{{ $profile->company_name }}">
					</div>
					<div class="row form-group">
						<div class="col-md-3">
							<label>Country</label>
							<input type="tel" name="country_code" placeholder="1" class="form-control" minlength="1" maxlength="5" value="{{ $profile->country_code }}">
						</div>
						<div class="col-md-9">
							<label>Phone Number</label>
							<input type="tel" name="phone_number" placeholder="808-555-1234" class="form-control" minlength="8" maxlength="12" value="{{ $profile->phone_number }}">
						</div>
					</div>
					<div class="form-group">
						<label>Country</label>
						<input type="text" name="country" class="form-control" value="{{ $profile->country }}">
					</div>
					<div class="clearfix">
						<a href="{{ route("viewProfile", $profile->id) }}" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
						<button type="submit" class="btn btn-success" style="float: right;"><i class="fas fa-check"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
