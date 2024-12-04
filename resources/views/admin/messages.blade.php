@extends('parts.master')

@section('content')
<div class="container mt-5">
    <h1>Messages</h1>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Message</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $message)
                <tr>
                    <!-- Display Name -->
                    <td>{{ $message->name }}</td>

                    <!-- Display Phone -->
                    <td>{{ $message->phone }}</td>

                    <!-- Display Message -->
                    <td>{{ $message->message }}</td>

                    <!-- Link to User Profile or Guest -->
                    <td>
                        @if ($message->user_id)
                            <a href="{{ route('post.user', $message->user_id) }}" class="btn btn-info btn-sm">View Profile</a>
                            <a href="{{ route('post.user', $message->user_id) }}" class="btn btn-link">User ID: {{$message->user_id}}</a>
                        @else
                            <span class="text-muted">Guest User</span>
                        @endif
                    </td>

                    <!-- Delete Message -->
                    <td>
                        <form action="{{ route('contact.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No messages found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{$messages->links()}}
</div>
@endsection
