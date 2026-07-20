@extends('layouts.prospecteur')

@section('content')
    <h3 class="mb-4">Mes Paramètres</h3>

    <form method="POST" action="{{ route('prospecteur.parametres.update') }}" class="bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>

        <hr>
        <p class="text-muted small">Laisser vide si vous ne voulez pas changer le mot de passe</p>

        <div class="mb-3">
            <label class="form-label">Nouveau mot de passe</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button class="btn btn-primary">Enregistrer</button>
    </form>
@endsection