@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">Users</div>
        <div class="card-body">
            @if ($users->count() > 0)
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                            <img src="{{ Gravatar::src($user->email) }}" alt="User Image" width="50px" height="50px" style="border-radius: 50%">
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            @if (!$user->isAdmin())
                                <td>
                                    <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Make Admin</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h3 class="text-center">
                                        No User Yet!
                                    </h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
    </div>
    </div>
@endsection
