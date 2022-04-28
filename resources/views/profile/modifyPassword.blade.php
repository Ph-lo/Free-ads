@extends('layout')
@section('content')

<main class="login-form">

    <div id="modify-profile-card" class="container">
        
        @if (\Session::has('errorMessage'))
        <div class="alert alert-danger">
            <p>{!! \Session::get('errorMessage') !!}</p>
        </div>
        @elseif (\Session::has('message'))
        <div class="alert alert-success">
            <p>{!! \Session::get('message') !!}</p>
        </div>
        @endif
        <div class="row justify-content-center">
            <a class="back-link" href="{{ route('profile') }}">back</a>
            <div class="col-md-10">
                <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card-header">Modify password</div>
                    <div class="card-body">
                        <form action="{{ route('modifyPass.post') }}" method="POST">

                            @csrf

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Actual password</label>
                                <div class="col-md-6">
                                    <input type="password" id="actual-password" class="form-control" name="actual-password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">Modify</button>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection