@extends('admin.layout.index')

@section('content')

    <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3 Maindiv">
        <h1 class="h2">My Games, {{ auth()->user()->name }}</h1>
    </div>

    {{-- Search Form --}}
    <form method="GET" action="{{ url('/dashboard/posts') }}" class="mb-3 col-lg-8">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by slug or title..."
                value="{{ request('search') }}">
            <button class="btn btn-dark" type="submit">Search</button>
        </div>
    </form>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-8 tablecontent">
        <a href="/dashboard/posts/create" class="btn btn-light mb-3">Create New Post</a>
        <table class="table-striped table-sm table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col" class="black-text">Category</th>
                    <th scope="col" class="black-text">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $posts->firstItem() + $loop->index }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-dark"><i
                                    class="fa-solid fa-eye text-light" style="font-size: 17px;"></i></a>
                            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge  bg-dark"><i
                                    class="fa-solid fa-pen-to-square text-light" style="font-size: 17px;"></i></a>
                            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-dark border-0" onclick="return confirm('Kamu yakin?')"><i
                                        class="fa-solid fa-circle-xmark text-light" style="font-size: 17px;"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $posts->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
