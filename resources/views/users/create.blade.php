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
        @include('partials.errors')
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
                <label for="category">Category</label>
                <select name="category" class="form-control" id="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if (isset($post))
                                @if ($category->id == $post->id)
                                    selected
                                @endif
                            @endif
                        >
                                {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if ($tags->count() > 0)
                <div class="form-group">
                    <label for="trags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if (isset($post))
                                @if ($post->hasTag($tag->id))
                                        selected
                                    @endif
                                @endif
                            >
                                    {{ $tag->name }}
                            </option>
                        @endforeach
                        </select>
                    </div>
            @endif

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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
        flatpickr('#published_at', {
            enableTime: true,
            dateFormat: "Y-m-d H:i"
        });

        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
