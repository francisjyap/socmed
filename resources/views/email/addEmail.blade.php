{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}
@extends('layouts.layout')

@section('title', 'Add Email')

@section('content')

<div class="row">
	<div class="col-md-8 offset-2">
		
		@include('layouts.errors')
		
    	<h3 style="margin-top: 5%; margin-bottom: 5%;">Add Email</h3>
		
		<div class="row">
			<div class="col-md-6 offset-3">
				<form id="form" method="POST" action="{{ route('storeEmail') }}">
					@csrf
					<input type="hidden" name="profile_id" value="{{ $profile_id }}">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" required="true">
					</div>
					<div class="clearfix">
						<a href="{{ route("viewProfile", $profile_id) }}" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
						<button type="submit" class="btn btn-success" style="float: right;"><i class="fas fa-check"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection