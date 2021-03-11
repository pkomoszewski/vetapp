@extends('layouts.Frontend.main')

@section('content')
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content d-flex justify-content-center"">
                <div class=" signup-form">
                <h1 class="form-title">Logowanie</h1>
                <form method="POST" class="login-form" id="login-form" action="{{ route('login') }}"">
                        @csrf
                        <div class=" form-group">

                    <input type="email" name="email" name="email" value="{{ old('email') }}" id="email"
                        placeholder="Twój Email" />
            </div>

            <div class="form-group">

                <input type="password" name="password" id="pass" placeholder="Hasło" />
            </div>
            <div class="form-group form-button">
                <input type="submit" name="signup" id="signup" class="button-vet" value="Zaloguj się" />
            </div>

               
            </form>
            @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

    </section>
</div>

@endsection