@extends('layouts.guest')

@section('body')
    <div class="min-h-screen flex flex-col items-center justify-center bg-grey-lightest">
        <div class="w-full max-w-sm">
            <h2 class="mb-4 text-purple-light">{{ __('Login') }}</h2>

            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">

                {{ csrf_field() }}

                <div class="mb-4">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                        {{ __('E-Mail Address') }}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline{{ $errors->has('email') ? 'border-red-dark' : 'border-grey-light' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                    {!! $errors->first('email', '<p class="text-red text-xs italic">:message</p>') !!}
                </div>

                <div class="mb-2">
                    <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                        {{ __('Password') }}
                    </label>
                    <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('password') ? 'border-red-dark' : 'border-grey-light' }}" name="password" required placeholder="******************">
                    {!! $errors->first('password', '<p class="text-red text-xs italic">:message</p>') !!}
                </div>

                <div class="mb-6">
                    <label class="block text-grey-darker text-sm font-bold mb-2">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span class="text-sm text-grey-dark"> {{ __('Remember Me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-purple hover:bg-purple-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        {{ __('Login') }}
                    </button>
                    <div class="text-right">
                        <a class="inline-block align-baseline font-bold text-sm text-purple hover:text-purple-darker" href="{{ route('register') }}">
                            {{ __('Need an account?') }}
                        </a>
                        <br />
                        <a class="inline-block align-baseline font-bold text-sm text-purple hover:text-purple-darker" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection