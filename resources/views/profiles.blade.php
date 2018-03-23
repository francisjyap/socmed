@extends('layouts.layout')

@section('title', 'Profiles')

@section('content')

	<div class="row">
        <div class="col-md-8 offset-2">
        	<h3 style="margin-top: 5%;">Profiles</h3>
        	<a href="#" class="btn btn-success" style="float: right;  margin-bottom: 5%;">Add New Profile</a>
    		
    		<table id="table"></table>
        </div>
		
	</div>

	<script type="text/javascript" src="js/profiles.js"></script>

@endsection