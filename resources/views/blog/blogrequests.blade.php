@extends('parts.master') <!-- Assuming this layout includes the navbar and footer -->

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ __('Blog Requests') }}</h1>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>{{ __('User ID') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Summary') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    <a href="{{ route('post.user', $post->user_id) }}" class="btn btn-link">
                        {{ $post->user_id }}
                    </a>
                </td>
                <td>
                        {{ $post->title }}
                </td>
                <td>
                    {{ Str::limit($post->summary, 50, '...') }}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <!-- Approve Button -->
                        <form action="{{ route('post.accept', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">
                                {{ __('Approve') }}
                            </button>
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('post.decline', $post->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">{{ __('No post requests found.') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{$posts->Links()}}
</div>
@endsection
