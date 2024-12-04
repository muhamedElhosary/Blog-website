@extends('parts.master')

@section('content')
<div class="container mt-5">
    <h2>{{ __('msgs.Edit Blog') }}</h2>
    <p>{{ __('msgs.Edit Text') }}</p>

    @if(Session::has('success'))
    <a class="btn btn-sm btn-outline-primary">{{ session('success') }}</a>
    @endif

    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Include method PUT for updating -->

        <!-- Hidden User ID Field -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('msgs.Title') }}</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title', $post->title) }}"> <!-- Use old() with fallback to $post->title -->
            @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Summary Field -->
        <div class="mb-3">
            <label for="summary" class="form-label">{{ __('msgs.Summary') }}</label>
            <textarea name="summary" id="summary" rows="2" class="form-control @error('summary') is-invalid @enderror">{{ old('summary', $post->summary) }}</textarea>
            @error('summary')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Content Field -->
        <div class="mb-3">
            <label for="content" class="form-label">{{ __('msgs.Content') }}</label>
            <textarea name="content" id="content" rows="5" class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image Upload Field -->
        <div class="mb-3">
            <label for="image" class="form-label">{{ __('msgs.Image') }}</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @if($post->image) <!-- Show existing image if available -->
                <small class="text-muted">{{ __('msgs.Current Image') }}: </small>
                <img src="{{ asset($post->image) }}" alt="" width="100">
            @endif
            @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">{{ __('msgs.Update Blog') }}</button>
    </form>
</div>

@endsection
