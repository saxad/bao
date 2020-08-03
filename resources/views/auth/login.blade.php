@extends('layouts.app')

@section('content')
<div class="container col-md-12 login-container">
    
        <div class="col-md-6 login-form">
            
                

                
                    <form class="" method="POST" action="{{ route('login') }}">
                        <h1>login</h1>
                        @csrf

                        
                            

                            <div class="col-md-12 txtb" >
                                <input class="form-control" id="email" type="email"  name="email"  required >
                                <span data-placeholder="email"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        

                        
                            

                            <div class="col-md-12 txtb">
                                <input id="password" type="password" class="form-control   @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <span data-placeholder="password"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                
            
        </div>
    
</div>
@endsection
