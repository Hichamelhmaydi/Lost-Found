@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center text-primary">Bienvenue dans votre tableau de bord</h1>
        <div class="bg-teal-800 card">
            <a href="{{ url('/annonces') }}" class="btn btn-primary" >Retour à la page d'accueil</a>
        </div>
    </div>
@endsection
<div class="grid w-full grid-cols-1 gap-6 p-4 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($annonces as $annonce)
    <div class="flex flex-col items-center w-full p-6 bg-white border rounded-lg shadow-lg">
        <h2 class="mb-2 text-xl font-bold text-center text-gray-800">{{ $annonce->titre }}</h2>
        <p class="mb-4 text-center text-gray-600">{{ Str::limit($annonce->description, 100) }}</p>
        <p class="mb-2 text-sm text-center text-gray-500">Lieu: {{ $annonce->lieu }}</p>
        <span class="px-2 py-1 text-sm rounded-lg block w-fit {{ $annonce->status == 'Disponible' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
            {{ $annonce->status }}
        </span>
        <div class="flex flex-wrap justify-center w-full gap-2 mt-4">
            <a href="{{ route('annonces.show', $annonce->id) }}" class="px-4 py-2 text-sm text-white transition bg-blue-500 rounded-lg hover:bg-blue-600">Voir</a>
            <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
    @endforeach
</div>

