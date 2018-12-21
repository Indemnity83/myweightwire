@extends('layouts.guest')

@section('body')
    <div class="min-h-screen flex flex-col items-center justify-center bg-grey-lightest">
        <div class="w-full max-w-sm">

            <nav class="w-full mb-4 text-2xl">
                <ol class="list-reset flex text-grey-dark">
                    <li><a href="/" class="text-purple-light font-bold"><i class="fas fa-home"></i></a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>{{ __('Reset Password') }}</li>
                </ol>
            </nav>

            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('password.update') }}">

                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                        {{ __('E-Mail Address') }}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? 'border-red-dark' : 'border-grey-light' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                    {!! $errors->first('email', '<p class="text-red text-xs italic">:message</p>') !!}
                </div>

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                        {{ __('Password') }}
                    </label>
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password') ? 'border-red-dark' : 'border-grey-light' }}" name="password" placeholder="**********" required>
                    {!! $errors->first('password', '<p class="text-red text-xs italic">:message</p>') !!}
                </div>

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                        {{ __('Confirm Password') }}
                    </label>
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('password_confirmation') ? 'border-red-dark' : 'border-grey-light' }}" name="password_confirmation" placeholder="**********" required>
                    {!! $errors->first('password_confirmation', '<p class="text-red text-xs italic">:message</p>') !!}
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-purple hover:bg-purple-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection