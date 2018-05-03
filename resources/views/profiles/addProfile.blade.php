{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}
@extends('layouts.layout')

@section('title', 'Add Profile')

@section('content')

<div class="row mar-bot-5">
	<div class="col-md-8 offset-2">
		
		@include('layouts.errors')

    	<h3 style="margin-top: 5%; margin-bottom: 5%;">Add Profile</h3>
		
		<div class="row">
			<div class="col-md-6 offset-3">
				<form id="form" method="POST" action="{{ route('storeProfile') }}">
					@csrf
					<div class="form-group">
						<label>Name <span style="color: red;">*</span></label>
						<input type="text" name="name" placeholder="John Doe" class="form-control" autofocus="true" required="true">
					</div>
					<div class="form-group">
						<label>Email <span style="color: red;">*</span></label>
						<input type="email" name="email" placeholder="john.doe@example.com" class="form-control" required="true">
					</div>
                    <div class="form-group">
						<label>Payment Email</label>
						<input type="email" name="payment_email" placeholder="payment@example.com" class="form-control">
					</div>
					<div class="form-group">
						<label>Website URL</label>
						<input type="url" name="website" placeholder="http://www.example.com" class="form-control">
					</div>
					<div class="form-group">
						<label>Company Name</label>
						<input type="text" name="company_name" placeholder="John Inc." class="form-control">
					</div>
					<div class="row form-group">
						<div class="col-md-3">
							<label>Country</label>
							<input type="tel" name="country_code" placeholder="1" class="form-control" minlength="1" maxlength="3">
						</div>
						<div class="col-md-9">
							<label>Phone Number</label>
							<input type="tel" name="phone_number" placeholder="808-555-1234" class="form-control" minlength="10" maxlength="12">
						</div>
					</div>
					<div class="form-group">
						<label>Country</label>
						<input type="text" name="country" placeholder="United States" class="form-control">
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
