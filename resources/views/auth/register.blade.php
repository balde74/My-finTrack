@extends('layouts.app')
@section('content')
<div class="authincation">
    <div class="container">
        <div class="row justify-content-center align-items-center g-0">
            <div class="col-xl-8 ">
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
                            <h4>Creer un compte</h4>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Prénom</label>
                                        <input name="first_name" value="{{ old('first_name') }}" type="text" class="form-control" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Nom de famille</label>
                                        <input name="last_name" value="{{ old('last_name') }}" type="text" class="form-control @error('last_name') is-invalid @enderror" />
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3"><label class="form-label">Email</label>
                                        <input name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Numéro de téléphone</label>
                                        <input name="phone_number" value="{{ old('phone_number') }}" type="number" class="form-control @error('phone_number') is-invalid @enderror" />
                                        @error('phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3"><label class="form-label">Mot de passe</label>
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" />
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3"><label class="form-label">Repeter le mot de passe</label>
                                        <input name="password_confirmation" type="password" class="form-control" />
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="form-check">
                                            <input name="acceptTerms" type="checkbox" class="form-check-input" id="acceptTerms" />
                                            <label class="form-check-label" for="acceptTerms">I
                                                certify that I
                                                am 18 years of age or
                                                older, and agree to the <a href="#" class="text-primary">User
                                                    Agreement</a> and <a href="#" class="text-primary">Privacy
                                                    Policy</a>.</label>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-primary me-8 text-white">Creer un compte</button></div>
                            </form>
                            <p class="mt-3 mb-0 undefined">Vous avez déjà un compte?<a class="text-primary" href="{{ route('login') }}"> Se connecter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
