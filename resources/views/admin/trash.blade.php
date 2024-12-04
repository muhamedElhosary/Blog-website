@extends('parts.master') <!-- Assuming this layout includes the navbar and footer -->

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Deleted Accounts List</h2>

    <!-- Links to move between active users and trashed accounts -->
    <div class="mb-3">
        <a href="{{ route('admin.users') }}" class="btn btn-primary">Active Users</a>
        <a href="{{ route('trash') }}" class="btn btn-secondary">Trashed Accounts</a>
    </div>

    <!-- Table to display deleted accounts -->
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Verify') }}</th>
                <th>{{ __('google_register') }}</th>
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
                    <!-- Restore Account -->
                    <a href="{{ route('restore', $user->id) }}" class="btn btn-success btn-sm">
                        {{ __('Restore') }}
                    </a>
                    
                    <!-- Force Delete Account -->
                    <form action="{{ route('force', $user->id) }}" method="POST" class="d-inline" 
                          onsubmit="return confirm('{{ __('Are you sure you want to permanently delete this account?') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            {{ __('Force Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">{{ __('No deleted accounts found.') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{$accounts->Links()}}
</div>
@endsection
