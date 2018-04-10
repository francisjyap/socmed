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
            <a href="#" id="btnResetFilter" class="btn btn-danger" style="float: right; margin-left: 1%;"><i class="fas fa-sync"></i> Reset Filters</a>
            <a href="{{ route("addProfile") }}" class="btn btn-success" style="float: right;"><i class="fas fa-user-plus"></i> Add New Profile</a>
        </div>

        <div class="col-md-12" style="margin-bottom: 5%;">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="selectType">
                        <option value="0">All (Accounts)</option>
                        @foreach($types as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-control" id="selectInfAff">
                        <option value="0">All (Influencer/Affliate)</option>
                        <option value="1">Influencers Only</option>
                        <option value="2">Affliates Only</option>
                        <option value="3">Non-Influencers</option>
                        <option value="4">Non-Affliates</option>
                    </select>
                </div>
            </div>

        </div>
		
		<table id="table" data-unique-id="id"></table>
    </div>
	
</div>

<script type="text/javascript" src="js/profiles.js"></script>

@endsection