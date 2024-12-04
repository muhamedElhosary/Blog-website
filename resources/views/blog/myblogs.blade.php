@extends('parts.master')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ $posts->first()?->author?->name??"Admin"}}, Blogs</h1>

    <!-- Blog List -->
    <div class="row">
        @foreach ($posts as $post)
        <div class="row mb-4 align-items-center">
            <!-- Blog Image (Left-Aligned) -->
            @if ($post->image)
            <div class="col-md-4">
                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" 
                     class="img-fluid rounded shadow-sm" style="max-width: 100%; height: 100%;">
            </div>
            @endif

            <!-- Blog Content (Right-Aligned) -->
            <div class="col-md-8">
                <h2 class="text-dark">
                    {{ $post->title }}
                </h2>
                <p class="text-muted small">
                    <strong>{{ __('Author:') }}</strong> {{ $post->author->name ?? 'Admin' }} | 
                    <strong>{{ __('Published:') }}</strong> {{ $post->created_at->format('F j, Y') }}
                </p>
                <p class="text-muted">{{ $post->summary }}</p>

                <!-- Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <!-- Read More Button -->
                    <a href="{{ route('single', $post->id) }}" class="btn btn-primary btn-sm">
                        {{ __('More Details') }}
                    </a>

                    <!-- Edit & Delete Buttons -->
                    <div>
                        @if(Auth::check()&&Auth::user()->id==$post->user_id)
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm me-2">
                            {{ __('Edit') }}
                        </a>
                        @endif
                        @if((Auth::check()&&Auth::user()->id==$post->user_id)||Auth::guard('admin')->check())
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('{{ __('Are you sure you want to delete this blog?') }}')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>

    <!-- Empty State -->
    @if ($posts->isEmpty())
    <p class="text-center text-muted mt-4">{{ __('No blogs available at the moment.') }}</p>
    @endif
    {{$posts->Links()}}
</div>
@endsection

