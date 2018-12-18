@extends('layouts.guest')

@section('body')
    <div class="min-h-screen flex flex-col items-center justify-center bg-grey-lightest">
        <div class="w-full max-w-md">
            <h2 class="mb-4 text-purple-light">{{ __('Waiting for Approval') }}</h2>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <p class="text-grey-dark">
                    {{ __('Your account is waiting for administrator approval. Please check back later.') }}
                </p>
            </div>
        </div>
@endsection