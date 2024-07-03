@extends('layout.app')
@section('content')
<div class="authincation">
    <div class="container">
        <div class="row justify-content-center align-items-center g-0">
            <div class="col-xl-8">
                <div class="row g-0">
                    {{-- <div class="col-lg-6">
                        <div class="welcome-content">
                            <div class="welcome-title">
                                <div class="mini-logo">
                                    <a href="index.html">
                                        <img src="images/logo-white.png" alt="" width="30" /></a>
                                </div>
                                <h3>Welcome to Ekash</h3>
                            </div>
                            <div class="privacy-social">
                                <div class="privacy-link"><a href="#">Have an issue with 2-factor
                                        authentication?</a><br /><a href="#">Privacy Policy</a></div>
                                <div class="intro-social">
                                    <ul>
                                        <li><a href="#"><i class="fi fi-brands-facebook"></i></a></li>
                                        <li><a href="#"><i class="fi fi-brands-twitter-alt"></i></a></li>
                                        <li><a href="#"><i class="fi fi-brands-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fi fi-brands-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-8 mx-auto">
                        <div class="auth-form">
                            <h4>Se connecter</h4>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"/>

                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Mot de passe</label>
                                        <input name="password" type="password" class="form-control" />
                                    </div>
                                    {{-- <div class="col-6">
                                        <div class="form-check">
                                            <input name="acceptTerms" id="acceptTerms" type="checkbox" class="form-check-input" />
                                            <label class="form-check-label" for="acceptTerms">Remember me</label>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-6 text-end"><a href="reset.html">Forgot Password?</a></div> --}}
                                </div>
                                <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-primary me-8 text-white">Se connecter</button></div>
                            </form>
                            <p class="mt-3 mb-0 undefined">Vous n'avez pas de compte ?<a class="text-primary" href="{{ route('register') }}"> S'enregistrer</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
