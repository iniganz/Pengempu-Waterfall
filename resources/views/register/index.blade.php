@extends('publik.layout.layoutlog')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">

            <main class="form-registration w-100 cuy m-auto">
                <h1 class="h3 fw-normal mb-3 text-center">Registration Form</h1>
                <form action="/register" method="post">
                    @csrf
                    {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
                    <div class="form-floating"> <input type="text" name="name"
                            class="form-control rounded-top @error('name') is-invalid @enderror" id="name"
                            placeholder="Name" required value="{{ old('name') }}">
                        <label for="name">Name</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating"> <input type="text" name="username"
                            class="form-control @error('username') is-invalid @enderror" id="username"
                            placeholder="Username"  value="{{ old('username')}}" > <label for="username">Username</label> @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating"> <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                            placeholder="name@example.com"   value="{{ old('email')}}"> <label for="floatingInput">Email address</label> @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating"> <input type="password" name="password"
                            class="form-control rounded-bottom @error('password') is-invalid @enderror"
                            id="floatingPassword" placeholder="Password"   value="{{ old('password')}}"> <label for="floatingPassword">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button class="btn btn-primary w-100 mt-3 py-2" type="submit">Register</button>

                </form>
                <small class="d-block mt-3 text-center">Already registered? <a href="/login">Login</a></small>
            </main>
        </div>
    </div>
@endsection
