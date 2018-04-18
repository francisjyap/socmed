{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}
@extends('layouts.layout')

@section('title', 'Create Influencer History')

@section('content')

<div class="row">
	<div class="col-md-8 offset-2">
    	<h3 style="margin-top: 5%; margin-bottom: 5%;">Create Influencer History</h3>
		
		<div class="row">
			<div class="col-md-6 offset-3">
				<form id="form" method="POST" action="{{ route('createHistory') }}">
					@csrf
					<input type="hidden" name="user_id" value="{{ Auth::id() }}">
					<input type="hidden" name="profile_id" value="{{ $profile_id }}">
					<input type="hidden" name="class" value="0">

					<div class="form-group">
						<label>Data</label>
						<select class="form-control" name="field_name">
							<option value="Status">Status</option>
							<option value="Follow-up">Follow-up</option>
						</select>
					</div>

					<div class="form-group">
						<label>Data</label>
						<select class="form-control" name="field_data">
							<option value="0">N/A</option>
							<option value="1">Done</option>
							<option value="2">Declined</option>
							<option value="3">Interested</option>
							<option value="4">Emailed</option>
							<option value="5">Rejected</option>
						</select>
					</div>

					<div class="form-group">
						<label>Date</label>
						<input type="date" name="date" class="form-control">
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
