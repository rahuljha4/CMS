@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        Categories
        <a href="{{ route('categories.create') }}" class="btn btn-success float-right text-bold">Add Category</a>
    </div>
</div>
@endsection
