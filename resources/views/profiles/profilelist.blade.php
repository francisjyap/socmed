@extends('layouts.layout')

@section('title', 'Profiles')

@section('content')

<div class="row">
    <div class="col-md-8 offset-2" style="margin-top: 5%;">
        @if(isset($status))
            <div class="alert alert-{{ $type }}" role="alert">
              {{ $msg }}
            </div>
        @endif

        <div class="clearfix" style="margin-bottom: 5%;">
            <h3 style="float: left;">Profiles</h3>
            <a href="{{ route("addProfile") }}" class="btn btn-success" style="float: right;"><i class="fas fa-user-plus"></i> Add New Profile</a>
        </div>
		
		<table id="table" data-unique-id="id"></table>
    </div>
	
</div>

<script type="text/javascript" src="js/profiles.js"></script>

@endsection