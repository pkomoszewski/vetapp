@extends('layouts.Backend.main')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card">
                
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($data['user']->loginSecurity == null)
                            <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <button type="submit" class="btn button-vet">
                                        Włącz 2FA
                                    </button>
                                </div>
                            </form>
                        @elseif(!$data['user']->loginSecurity->google2fa_enable)
                      1. Zeskanuj ten kod QR za pomocą aplikacji Google Authenticator. Alternatywnie możesz użyć kodu:<code>{{ $data['secret'] }}</code><br/>
                            <img src="{{$data['googletwofa_url'] }}" alt="">
                            <br/><br/>
                      2. Wpisz kod z aplikacji Google Authenticator:<br/><br/>
                            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                    <label for="secret" class="control-label">Authenticator Code</label>
                                    <input id="secret" type="password" class="form-control col-md-4" name="secret" required>
                                    @if ($errors->has('verify-code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('verify-code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn button-vet">
                                    Włącz 2FA
                                </button>
                            </form>
                        @elseif($data['user']->loginSecurity->google2fa_enable)
                            <div class="alert alert-success">
                                2FA jest <strong>włączone</strong>
                            </div>
                            <p>Jeśli chcesz wyłączyć uwierzytelnianie dwuskładnikowe. Potwierdź hasło i kliknij przycisk Wyłącz 2FA.</p>
                            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="change-password" class="control-label">Aktualne hasło</label>
                                        <input id="current-password" type="password" class="form-control col-md-4" name="current-password" required>
                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                        @endif
                                </div>
                                <button type="submit" class="btn button-vet">Wyłącz 2FA</button>
                            </form>
                        @endif
                    </div>
           
            </div>
        </div>
    </div>
@endsection