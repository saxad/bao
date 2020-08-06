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
                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-block  login-btn">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-8 offset-md-2 ">
                                
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

@section('scripts')

<script src="{{asset('js/login/login.js')}}" defer></script>

@endsection