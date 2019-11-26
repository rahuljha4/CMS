@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">
        Categories
        <a href="{{ route('categories.create') }}" class="btn btn-success float-right text-bold">Add Category</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Name</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            {{ $category->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
