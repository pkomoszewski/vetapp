@extends('layouts.Frontend.main')
@section('content')
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Utwórz konto weterynarza</h2>
                    <form method="POST" class="register-form" id="register-form"
                        action="{{ route('registervetpost') }}">
                        @csrf
                        <div class="form-group">

                            <input type="email" name="email" name="email" value="{{ old('email') }}" id="email"
                                placeholder="Twój Email" />
                        </div>
                        <div class="form-group">

                            <input type="text" name="imie" value="{{ old('imie') }}" placeholder="Imie" />


                        </div>
                        <div class="form-group">

                            <input type="text" name="nazwisko" value="{{ old('nazwisko') }}" placeholder="nazwisko" />
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
                                regulamin <a href="#" class="term-service">czytaj</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" value="Rejestracja" class="button-vet" />
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection