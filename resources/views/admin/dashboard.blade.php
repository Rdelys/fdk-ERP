@extends('layouts.admin')

@section('content')
    <h3 class="mb-4">Dashboard</h3>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <h6>Projets</h6>
                <h2>{{ $stats['total_projects'] }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <h6>Prospecteurs</h6>
                <h2>{{ $stats['total_prospecteurs'] }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <h6>Total Prospects</h6>
                <h2>{{ $stats['total_prospects'] }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <h6>Vendus</h6>
                <h2 class="text-success">{{ $stats['total_vendus'] }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <h6>En cours</h6>
                <h2 class="text-warning">{{ $stats['total_en_cours'] }}</h2>
            </div>
        </div>
    </div>
@endsection