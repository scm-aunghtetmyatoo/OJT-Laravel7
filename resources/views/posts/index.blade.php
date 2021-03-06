@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4 form-inline">
        <form action="{{ route('posts.search') }}" method="POST" class="form-inline mr-3">
            @csrf
            <input type="text" name="search" class="form-control mr-3" required />
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mr-3">Add</a>
        
        <a class="btn btn-primary mr-3" href="{{ route('posts.upload') }}">Upload</a>
        <a class="btn btn-primary" href="{{ route('export') }}">Export User Data</a>
    </div>
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">Post Title</th>
            <th scope="col">Post Description</th>
            <th scope="col">Posted User</th>
            <th scope="col">Post Date</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
            <th><a href="{{ route('posts.edit',$post->id) }}">{{ $post->title }}</a></th>
            <td>{{ $post->description }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->created_at->format('d/m/Y') }}</td>
            <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection
