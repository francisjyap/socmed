{{-- /*
|	Authored/Written/Maintained by:
|		Francis Alec J. Yap
|		francisj.yap@gmail.com
|		https://github.com/francisjyap/socmed
|
*/ --}}

@extends('layouts.layout')

@section('title', 'View Profile')

@section('content')

<div class="row mar-top-5 mar-bot-5">

    @include('layouts.view_profile_sidebar')

    <div class="col-md-8">

        @include('layouts.banner')

        <h3 class="mar-bot-5">View Profile</h3>


        @include('components.view_profile.details')

        @include('components.view_profile.accordion')

        @include('components.view_profile.inf_aff_panel')

        @include('components.view_profile.notes')

        @include('components.view_profile.history_table')

    </div>
</div>

@include('components.view_profile.modals')

@include('components.view_profile.hidden_forms')

<script type="text/javascript">
    /*
        Laravel Variables declared for Javascript
    */
    var routeGetNotes = '{{ route('getNotes', $profile->id) }}';
    var profileName = '{{ $profile->name }}';

    @isset($influencer)
        var influencerStatus = {{ $influencer['status'] }};
        var influencerFollowUp = {{ $influencer['follow-up'] }};
    @endisset

    @isset($affliate)
        var affliateStatus = {{ $affliate['status'] }};
        var affliateFollowUp = {{ $affliate['follow-up'] }};
    @endisset
</script>
<script type="text/javascript" src="../js/viewProfile.js"></script>


@endsection
