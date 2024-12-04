@extends('parts.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('msgs.Latest Blogs') }}</h1>
    <div class="row g-4">
        @foreach($posts as $post)
        <!-- Blog Card -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                @if($post->image)
                <img src="{{ asset($post->image) }}" 
                     class="card-img-top" 
                     alt="Blog Image" 
                     style="height: 200px; object-fit: cover;"> <!-- Smaller Image -->
                @else
                <div class="card-img-top" style="height: 200px; background-color: #f0f0f0;"></div> <!-- Placeholder for No Image -->
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->summary }}. Click below to read more.</p>
                    <a href="{{ route('single', $post->id) }}" class="btn btn-primary">{{ __('msgs.Read More') }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{$posts->Links()}}
@endsection
