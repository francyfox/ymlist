@extends('layouts.app')

@section('content')
    <section class="hero is-fullheight">
        <div class="hero-body has-text-centered">
            <div class="login">
                <div class="title">{{ __('Login') }}</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field">
                        <div class="control">
                            <span class="icon is-small is-left">
                              <i class="fas fa-envelope"></i>
                            </span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input id="email" class="input is-medium is-rounded @error('email') is-danger @enderror" type="email" name="email" placeholder="hello@example.com" autocomplete="username" value="{{ old('email') }}" required />
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <span class="icon is-small is-left">
                              <i class="fas fa-lock"></i>
                            </span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input id="password" class="input is-medium is-rounded @error('password') is-danger @enderror" type="password" name="password" placeholder="**********" autocomplete="current-password" required />
                        </div>
                    </div>

                    <label class="checkbox" for="remember">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        {{ __('Remember Me') }}
                    </label>
                    <br />
                    <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                        Login
                    </button>
                </form>
                <br>
                <nav class="level">
                    <div class="level-item has-text-centered">
                        @if (Route::has('password.request'))
                            <div>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif

                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <a href="/register">Create an Account</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>
@endsection
