@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        Create Category
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item text-danger">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" minlength="2" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
