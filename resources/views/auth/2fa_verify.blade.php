@extends('layouts.Backend.main')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header h3">Weryfikacja dwuetpowa</div>
                    <div class="card-body">
                        <p></p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        Otwórz aplikację do uwierzytelniania dwuskładnikowego na swoim urządzeniu, aby wyświetlić kod uwierzytelniający i zweryfikować swoją tożsamość. Wpisz kod z aplikacji.<br/><br/>
                        <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                <label for="one_time_password" class="control-label">PIN</label>
                                <input id="one_time_password" name="one_time_password" class="form-control col-md-4"  type="text" required/>
                            </div>
                            <button class="btn button-vet" type="submit">OK</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection