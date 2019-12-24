@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Posts</a>
    </div>

    <div class="card card-default">
    <div class="card-header">Posts</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th></th>
                <th></th>
            </thead>

            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>
                        <img src="{{ asset("storage/" . $post->image)}}" alt="" width="120px" height="60px" style="display:block">
                    </td>
                    <td>
                        {{ $post->title }}
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $post->category->id) }}">
                            {{ $post->category->name }}
                        </a>
                    </td>
                    <td>
                        @if (!$post->trashed())
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info text-white btn-sm">
                                Edit
                            </a>
                        @else
                        <form action="{{ route('restore-posts', $post->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-info text-white btn-sm">
                                Restore
                            </button>
                        </form>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                {{ $post->trashed() ? 'Delete' : 'Trash' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <h3 class="text-center">
                                No Post Yet!
                            </h3>
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>
    </div>
@endsection
