@extends('layouts.Frontend.main')
@section('content')
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content d-flex justify-content-center">
                <div class="signup-form">
                    <h2 class="form-title">Utwórz konto użytkownika</h2>
                    <form method="POST" class="register-form" id="register-form" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">

                            <input type="email" name="email" name="email" value="{{ old('email') }}" id="email"
                                placeholder="Twój Email" />
                        </div>

                        <div class="form-group">

                            <input type="text" name="imie" value="{{ old('imie') }}" id="imie"
                                placeholder="Twój Imie" />


                        </div>
                        <div class="form-group">

                            <input type="password" name="password" id="pass" placeholder="Hasło" />
                        </div>

                        <div class="form-group">

                            <input type="password" name="password_confirmation" id="re_pass"
                                placeholder="Powtórz hasło" />
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>Akcetpuje
                                regulamin <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="button-vet" value="Rejestracja" />
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


            </div>
        </div>
    </section>
</div>
@endsection