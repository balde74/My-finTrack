@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="verification section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Les informations du compte</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('account.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-xl-12">
                                            <label class="form-label">Nom </label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                                placeholder="Compte epargne" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-xl-12">
                                            <label class="form-label">Solde initial</label>
                                            <input type="number" min="1" name="balance"
                                                class="form-control @error('balance') is-invalid @enderror" value="{{ old('balance') }}"
                                                placeholder="100000" required>
                                            @error('balance')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <input type="text" class="d-none" name="user_id" id="" value="{{ Auth::user()->id }}">
                                        {{-- <div class="mb-3 col-xl-4">
                                        <label class="form-label">Expiration </label>
                                        <input type="text" class="form-control" placeholder="10/22">
                                    </div>
                                    <div class="mb-3 col-xl-4">
                                        <label class="form-label">CVC </label>
                                        <input type="text" class="form-control" placeholder="125">
                                    </div>
                                    <div class="mb-3 col-xl-4">
                                        <label class="form-label">Postal code </label>
                                        <input type="text" class="form-control" placeholder="2368">
                                    </div> --}}
                                        <div class="text-center col-12">
                                            <button type="submit" class="btn btn-success w-100">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
