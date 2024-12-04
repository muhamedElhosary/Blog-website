@extends('parts.master')

@section('content')
<div class="container my-5">
    <!-- Blog Details -->
    <div class="row mb-5">
        <!-- Blog Image -->
        @if($blog->image)
        <div class="col-md-4">
            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" 
                 class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
        </div>
        @endif

        <!-- Blog Content -->
        <div class="col-md-8">
            <h1 class="mb-3">{{ $blog->title }}</h1>
            <p class="text-muted">{{ $blog->summary }}</p>
            <div class="content mb-4">
                <p>{{ $blog->content }}</p>
            </div>
            <div class="text-muted small">
                <p><strong>{{ __('Author:') }}</strong> {{ $blog->author->name ?? __('Admin') }}</p>
                <p><strong>{{ __('Published on:') }}</strong> {{ $blog->created_at->format('F j, Y, g:i a') }}</p>
            </div>

            <!-- Action Buttons (Edit, Delete, Back) -->
            <div class="d-flex justify-content-start align-items-center mt-4">
                @if(Auth::check()&&Auth::user()->id==$blog->user_id)
                <a href="{{ route('post.edit', $blog->id) }}" class="btn btn-warning btn-sm me-2">
                    {{ __('Edit') }}
                </a>
                @endif
                @if((Auth::check()&&Auth::user()->id==$blog->user_id)||Auth::guard('admin')->check())
                <form action="{{ route('post.destroy', $blog->id) }}" method="POST" class="d-inline-block me-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('{{ __('Are you sure you want to delete this blog?') }}')">
                        {{ __('Delete') }}
                    </button>
                </form>
                @endif
                
            

                <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
                    {{ __('Back to Blogs') }}
                </a>
            </div>
        </div>
    </div>
        <!-- Comments Section -->
        <div class="comments">
            <h2 class="mb-4">{{ __('Comments') }}</h2>

            <!-- Existing Comments -->
            <div class="mb-4">
                @forelse($blog->comments as $comment)
                <div class="p-3 border rounded shadow-sm mb-3">
                    <p class="mb-1">
                        <strong>{{ $comment->user->name ?? 'Admin' }}</strong> - 
                        <span class="text-muted">{{ $comment->created_at->format('F j, Y, g:i a') }}</span>
                    </p>
                    <p>{{ $comment->comment }}</p>

                    <!-- Delete Button -->
                    @if((Auth::check() && (Auth::id() == $comment->user_id) || Auth::guard('admin')->check()))
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('{{ __('Are you sure you want to delete this comment?') }}')">
                            {{ __('Delete') }}
                        </button>
                    </form>
                    @endif
                </div>
                @empty
                <p class="text-muted">{{ __('No comments yet. Be the first to comment!') }}</p>
                @endforelse
            </div>

            <!-- Add Comment Form -->
            @if(Auth::check() || Auth::guard('admin')->check())
            <form action="{{ route('comments.store', $blog->id) }}" method="POST">
                @csrf
                <!-- Hidden Fields for post_id and user_id -->
                <input type="hidden" name="post_id" value="{{ $blog->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <div class="mb-3">
                    <label for="comment" class="form-label">{{ __('Add a Comment') }}</label>
                    <textarea name="comment" id="comment" rows="3" 
                            class="form-control @error('content') is-invalid @enderror" 
                            placeholder="{{ __('Write your comment here...') }}" required></textarea>
                    @error('content')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Post Comment') }}</button>
            </form>
            @else
            <p class="text-muted">{{ __('To add a comment, you should have an account first.') }}</p>
            @endif
        </div>

</div>
@endsection
