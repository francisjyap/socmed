@extends('layouts.layout')

@section('title', 'Profiles')

@section('content')

	<div class="row">
        <div class="col-md-8 offset-2">
        	<h3>Profiles</h3>
        	<a href="#" class="btn btn-success" style="float: right;">Add New Profile</a>
    		<table class="table table-striped" id="table"></table>
        </div>
		
	</div>

	<script type="text/javascript" src="js/profiles.js"></script>

@endsection