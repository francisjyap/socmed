{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}
@extends('layouts.layout')

@section('title', 'Edit History')

@section('content')

<div class="row">
	<div class="col-md-8 offset-2">
    	<h3 style="margin-top: 5%; margin-bottom: 5%;">Edit History</h3>
		
		<div class="row">
			<div class="col-md-6 offset-3">
				<form id="form" method="POST" action="{{ route('updateHistory') }}">
					@csrf
					<input type="hidden" name="id" value="{{ $log->id }}">

					<div class="form-group">
						<label>Date</label>
						<input type="date" name="date" class="form-control" value="{{ substr($log->created_at,0,10) }}">
					</div>

					<div class="clearfix">
						<a href="{{ route("viewProfile", $log->profile_id) }}" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
						<button type="submit" class="btn btn-success" style="float: right;"><i class="fas fa-check"></i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
