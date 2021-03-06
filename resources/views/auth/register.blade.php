@extends('layouts.guest')

@section('body')
    <div class="min-h-screen flex flex-col items-center justify-center bg-grey-lightest">
        <div class="w-full max-w-sm">
            <nav class="w-full mb-4 text-2xl">
                <ol class="list-reset flex text-grey-dark">
                    <li><a href="/" class="text-purple-light font-bold"><i class="fas fa-home"></i></a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>{{ __('Register') }}</li>
                </ol>
            </nav>

            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('register') }}">

                {{ csrf_field() }}

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                        {{ __('Name') }}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('name') ? 'border-red-dark' : 'border-grey-light' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                    {!! $errors->first('name', '<p class="text-red text-xs italic">:message</p>') !!}
                </div>

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                        {{ __('E-Mail Address') }}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? 'border-red-dark' : 'border-grey-light' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
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

                <div class="mb-4">
                    <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.sitekey')}}"></div>
                    {!! $errors->first('g-recaptcha-response', '<p class="text-red text-xs italic">:message</p>') !!}
                </div>

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2">
                        <span class="text-sm">
                        By clicking Register, you are indicating that you have read and agree to the Terms of Service and Privacy Policy.
                        </span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-purple hover:bg-purple-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        {{ __('Register') }}
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-purple hover:text-purple-darker" href="{{ route('login') }}">
                        {{ __('← Back to login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection