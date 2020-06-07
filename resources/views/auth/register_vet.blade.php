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
                            <label for="text"><i class="zmdi zmdi-text"></i></label>
                            <input type="text" name="imie" value="{{ old('imie') }}" placeholder="Imie" />
                            @error('imie')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text"><i class="zmdi zmdi-text"></i></label>
                            <input type="text" name="nazwisko" value="{{ old('nazwisko') }}" placeholder="nazwisko" />
                            @error('nazwisko')
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
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
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