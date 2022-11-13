<x-app-layout>
    <form method="POST" action="{{ route('donor.signup') }}" class="p-3">
        @csrf
        <input type="hidden" name="refUrl" value="{{ url()->previous() }}" />

        <label for="name" class="sr-only">{{ __('Your Name') }}</label>
        <input type="text" name="name" required class="mb-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Your Name" />

        <label for="email" class="sr-only">{{ __('Your Email') }}</label>
        <input type="email" name="email" required class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" placeholder="Your Email" />

        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">{{ __('Sign Up') }}</button>
    </form>
</x-app-layout>