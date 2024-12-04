@extends('parts.master') <!-- Assuming this layout includes the navbar and footer -->

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Users List</h2>

    <!-- Links to move between active users and trashed accounts -->
    <div class="mb-3">
        <a href="{{ route('admin.users') }}" class="btn btn-primary">Active Users</a>
        <a href="{{ route('trash') }}" class="btn btn-secondary">Trashed Accounts</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Verify') }}</th>
                <th>{{ __('google_register') }}</th>
                <th>{{ __('User Blogs') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($accounts as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at }}</td>
                <td>{{$user->google_id}}</td>
                <td>
                    <a href="{{ route('post.user', $user->id) }}" class="btn btn-info btn-sm">
                        {{ __('View Blogs') }}
                    </a>
                </td>
                <td>
                    <form action="{{ route('soft', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete Account') }}</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">{{ __('No users found.') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{$accounts->Links()}}
</div>
@endsection
