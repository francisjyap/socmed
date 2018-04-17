@extends('layouts.layout')

@section('title', 'Login')

@section('content')

<div class="row">
	<div class="col-md-6 offset-3" style="margin-top: 5%;">
        <form method="POST" action="{{ route('login') }}">
        	@csrf
			<label class="col-form-label">E-mail</label>
			<div class="form-group">
				<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
			</div>

			<label class="col-form-label">Password</label>
			<div class="form-group">
				<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success" style="float: right;"> Login</button>
			</div>
		</form>
	</div>
</div>

@endsection