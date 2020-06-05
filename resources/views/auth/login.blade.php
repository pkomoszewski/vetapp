@extends('layouts.Frontend.main')

@section('content')
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content d-flex justify-content-center"">
                <div class=" signup-form">
                <h2 class="form-title">Logowanie</h2>
                @if (session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
                @endif
                <form method="POST" class="login-form" id="login-form" action="{{ route('login') }}"">
                        @csrf
                        <div class=" form-group">
                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                    <input type="email" name="email" name="email" value="{{ old('email') }}" id="email"
                        placeholder="Twój Email" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>

            <div class="form-group">
                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                <input type="password" name="password" id="pass" placeholder="Hasło" />
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="form-group form-button">
                <input type="submit" name="signup" id="signup" class="button-vet" value="Rejestracja" />
            </div>
            </form>
            @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>


</div>
</div>
</section>
</div>
@endsection