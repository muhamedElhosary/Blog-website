<x-app-layout>
    <x-slot name="header">
      <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
        <!-- Back Arrow Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a1 1 0 01-.707-.293l-7-7a1 1 0 010-1.414l7-7a1 1 0 111.414 1.414L4.414 10H18a1 1 0 110 2H4.414l6.293 6.293A1 1 0 0110 18z" clip-rule="evenodd" />
        </svg>
        {{ __('Go to Home') }}
     </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in, please go to home page to view and add blogs.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
