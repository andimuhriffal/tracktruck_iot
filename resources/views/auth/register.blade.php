@extends('layouts.main')

@section('title', 'Registration Form')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-5">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
                    <label for="name" style="color: black">Name</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                    <label for="username" style="color: black">Username</label>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                    <label for="email" style="color: black">Email address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="new-password">
                    <label for="password" style="color: black">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" class="form-control rounded-bottom" id="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    <label for="password_confirmation" style="color: black">Confirm Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Register</button>
            </form>
        </main>
    </div>
</div>
@endsection
