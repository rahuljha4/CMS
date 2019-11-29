@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($posts)  ? 'Edit Post' : 'Create Post' }}
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item text-danger">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ isset($posts) ? route('posts.update', $category->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($posts))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" id="title" class="form-control" name="title" value="{{ isset($posts) ? $posts->name : '' }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" cols="50" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" id="content" cols="50" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="published_at">Publised At</label>
                <input type="text" id="published_at" class="form-control" name="published_at">
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" class="form-control" name="image">
            </div>

            <div class="form-group">
                <button class="btn btn-success">
                    {{ isset($posts) ? 'Update Post': 'Add Post' }}
                </button>
            </div>
        </form>
  </div>
</div>
@endsection
