@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($post)  ? 'Edit Post' : 'Create Post' }}
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
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" id="title" class="form-control" name="title" value="{{ isset($post)  ? $post->title : '' }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" cols="50" rows="5">{{ isset($post)  ? $post->description : ''}}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                {{-- <textarea name="content" class="form-control" id="content" cols="50" rows="5"></textarea> --}}
                <input id="content" type="hidden" name="content" value="{{ isset($post)  ? $post->content : '' }}">
                <trix-editor input="content"></trix-editor>
            </div>

            <div class="form-group">
                <label for="published_at">Publised At</label>
                <input type="text" id="published_at" class="form-control" name="published_at" value="{{ isset($post)  ? $post->published_at : '' }}">
            </div>

            @if (isset($post))
                <div class="form-group">
                    <img src="{{ asset("storage/" . $post->image) }}" alt="Post Image">
                </div>
            @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" class="form-control" name="image">
            </div>

            <div class="form-group">
                <button class="btn btn-success">
                    {{ isset($post) ? 'Update Post': 'Add Post' }}
                </button>
            </div>
        </form>
  </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr('#published_at', {
            enableTime: true,
            dateFormat: "Y-m-d H:i"
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
