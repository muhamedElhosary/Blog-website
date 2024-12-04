@extends('parts.master')

@section('content')
<div class="container mt-5">
    <h2>{{ __('msgs.Contact Us') }}</h2>
    <p>{{ __('msgs.Contact Text') }}</p>

    @if(Session::has('success'))
    <a class="btn btn-sm btn-outline-primary">{{ session('success') }}</a>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <!-- Hidden User ID Field -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('msgs.Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Phone Field -->
        <div class="mb-3">
            <label for="phone" class="form-label">{{ __('msgs.Phone') }}</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Ask/Message Field -->
        <div class="mb-3">
            <label for="message" class="form-label">{{ __('msgs.Message') }}</label>
            <textarea name="message" id="ask" rows="4" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
            @error('message')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">{{ __('msgs.Send Message') }}</button>
    </form>
</div>
@endsection
