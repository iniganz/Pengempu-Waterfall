@extends('publik.layout.layoutlog')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">

            <main class="form-signin w-100 cuy m-auto">
                <h1 class="h3 fw-normal mb-3 text-center">Please Log In</h1>
                <form action="/login" method="post">
                    @csrf
                    {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"  id="email" name="email"
                            placeholder="name@example.com" autofocus required value="{{ old('email') }}"> <label for="email" >Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password"> <label for="password">Password</label> </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">Login</button>

                </form>
                <small class="d-block mt-3 text-center">Nor registered? <a href="/register">Register Now!</a></small>
            </main>
        </div>
    </div>
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end', // bisa diubah: top-start, bottom-end, dll
                showConfirmButton: false,
                timer: 3000, // waktu tampil dalam ms (3 detik)
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        </script>
    @endif
    @if (session('loginError'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end', // bisa diubah: top-start, bottom-end, dll
                showConfirmButton: false,
                timer: 3000, // waktu tampil dalam ms (3 detik)
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'eror',
                title: '{{ session('loginError') }}'
            });
        </script>
    @endif
@endsection
