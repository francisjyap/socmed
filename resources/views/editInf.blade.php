{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}
@extends('layouts.layout')

@section('title', 'Edit Influencer')

@section('content')

<div class="row">
    <div class="col-md-8 offset-2">
        <h3 style="margin-top: 5%; margin-bottom: 5%;">Edit Influencer</h3>

        <div class="row">
            <div class="col-md-6 offset-3">
                <form id="form" method="POST" action="{{ route('editInfAff') }}">
                    @csrf
                    <input type="hidden" name="profile_id" value="{{ $profile_id }}">
                    <input type="hidden" name="class" value="0">

                    <div class="form-group">
                        <label>Status Date</label>
                        <input type="date" name="status_date" class="form-control" value="{{ $status_date }}">
                    </div>

                    <div class="form-group">
                        <label>Follow-up Date</label>
                        <input type="date" name="follow_up_date" class="form-control" value="{{ $follow_up_date }}">
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
