@extends('layouts.guest')

@section('body')
    <div class="min-h-screen flex flex-col items-center justify-center bg-grey-lightest">
        <div class="w-full max-w-md">
            <nav class="w-full mb-4 text-2xl">
                <ol class="list-reset flex text-grey-dark">
                    <li><a href="/" class="text-purple-light font-bold"><i class="fas fa-home"></i></a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>{{ __('Waiting for Approval') }}</li>
                </ol>
            </nav>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <p class="text-grey-dark">
                    {{ __('Your account is waiting for administrator approval. Please check back later.') }}
                </p>
            </div>
        </div>
@endsection