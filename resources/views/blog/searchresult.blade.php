@extends('parts.master')

@section('content')
<div class="container mt-5">
    <!-- Search Form -->
    <form action="{{ route('post.search') }}" method="GET" class="d-flex mb-4">
        <input type="text" name="query" class="form-control me-2" placeholder="Search blogs..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Search Results -->
    @if(isset($query))
        <h4>Search results for "{{ $query }}":</h4>
    @endif

    <div class="row">
        @forelse($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if ($post->image)
                <img src="{{ asset($post->image) }}" 
                class="card-img-top" alt="Blog Image" style="height: 250px; object-fit: cover;"> <!-- Smaller Image -->
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}. Click below to read more.</p>
                    <a href="{{ route('single', $post->id) }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">No blogs found for "{{ $query }}".</p>
        @endforelse
    </div>

    <!-- Pagination -->
    {{ $posts->links() }}
</div>
@endsection
