@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Profile">
        <x-slot:breadcrumbs>
            <li>
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-brand-600 dark:text-gray-400 dark:hover:text-brand-500">Dashboard</a>
            </li>
            <li>
                <span class="text-gray-700 dark:text-gray-400">Profile</span>
            </li>
        </x-slot:breadcrumbs>
    </x-common.page-breadcrumb>

    <x-layouts.settings title="Profile" description="Update your name and email address">
        @if (session('status'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/20 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('settings.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Input -->
            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Name
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                    required
                    autofocus
                />
                @error('name')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Email
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                    required
                />
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Save Button -->
            <div>
                <x-ui.button type="submit" variant="primary">
                    Save
                </x-ui.button>
            </div>
        </form>

        <!-- Delete Account Section -->
        <div class="mt-8 border-t border-gray-200 pt-8 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Delete account</h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Delete your account and all of its resources</p>

            <form method="POST" action="{{ route('settings.profile.destroy') }}" class="mt-4"
                  onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <x-ui.button
                    type="submit"
                    variant="primary"
                    className="bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800"
                >
                    Delete account
                </x-ui.button>
            </form>
        </div>
    </x-layouts.settings>
@endsection
