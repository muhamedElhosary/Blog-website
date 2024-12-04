@extends('parts.master')
@section('content')
<form action="{{route('admin.profile.update',$admin->id)}}" method="POST" class="w-50 mx-auto mt-5 p-4 border rounded shadow bg-light">
    <!-- CSRF Token -->
    @csrf
    @method('put')
    <!-- Form Title -->
    <h2 class="text-center mb-4">Edit Profile</h2>
    @if(Session::has('success'))
    <div class="btn btn-sm btn-outline-primary">{{Session::get('success')}}</div>
    @elseif(session::has('failed'))
    <div class="btn btn-sm btn-outline-danger">{{Session::get('failed')}}</div>
    @endif
    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', auth()->guard('admin')->user()->name) }}" class="form-control" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', auth()->guard('admin')->user()->email) }}" class="form-control" required>
    </div>

    <!-- Current Password -->
    <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" id="current_password" name="current_password" class="form-control" required>
    </div>

    <!-- New Password -->
    <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" id="new_password" name="new_password" class="form-control">
    </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary w-100">Update Profile</button>
    </div>
</form>

@endsection