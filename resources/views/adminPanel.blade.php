{{-- /*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/ --}}
@extends('layouts.layout')

@section('title', 'Profiles')

@section('content')

<div class="row mar-bot-5">
    <div class="col-md-8 offset-2" style="margin-top: 5%;">
        @if(isset($status))
            <div class="alert alert-{{ $type }}" role="alert">
              {{ $msg }}
            </div>
        @endif

        <h3 style="float: left;">Admin Panel</h3>

        <table id="table" data-unique-id="id"></table>
    </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#table').bootstrapTable({
        url: 'getUsers',
        uniqueId: 'id',
        search: true,
        columns: [{
            field: 'name',
            title: 'Name'
        }, {
            field: 'email',
            title: 'Email'
        }, {
            field: 'is_admin',
            title: 'Admin Status',
            searchable: false,
            cellStyle: function(value) {
                if(value == 'Yes'){
                    return{
                        css: {'color': 'green'}
                    }
                } else {
                    return{
                        css: {'color': 'red'}
                    }
                }
            }
        }, {
            field: 'created_at',
            title: 'Date Created'
        }]
    });
});
</script>

@endsection
