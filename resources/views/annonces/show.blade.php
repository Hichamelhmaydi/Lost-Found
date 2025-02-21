@extends('layouts.app')

@section('content')
<div class="min-h-screen px-4 py-8 bg-gray-50 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h1 class="mb-6 text-3xl font-bold text-center text-gray-900">{{ $annonce->titre }}</h1>

            <div class="space-y-4">
                <div>
                    <strong class="block text-sm font-medium text-gray-700">Description</strong>
                    <p class="mt-1 text-gray-900">{{ $annonce->description }}</p>
                </div>

                <div>
                    <strong class="block text-sm font-medium text-gray-700">Lieu</strong>
                    <p class="mt-1 text-gray-900">{{ $annonce->lieu }}</p>
                </div>

                <div>
                    <strong class="block text-sm font-medium text-gray-700">Statut</strong>
                    <p class="mt-1 text-gray-900">{{ $annonce->status }}</p>
                </div>

                <div>
                    <strong class="block text-sm font-medium text-gray-700">Email</strong>
                    <p class="mt-1 text-gray-900">{{ $annonce->email }}</p>
                </div>

                <div>
                    <strong class="block text-sm font-medium text-gray-700">Téléphone</strong>
                    <p class="mt-1 text-gray-900">{{ $annonce->tele }}</p>
                </div>

                @if ($annonce->photo)
                    <div>
                        <strong class="block text-sm font-medium text-gray-700">Photo</strong>
                        <img src="{{ asset('storage/' . $annonce->photo) }}" alt="Photo de l'annonce" class="mt-3 rounded-lg shadow-sm">
                    </div>
                @endif
            </div>

            {{-- Comment Section --}}
            <div class="mt-8">
                <h2 class="text-2xl font-semibold text-gray-900">Commentaires</h2>

                {{-- Display existing comments --}}
                <div class="mt-4 space-y-4">
                    @forelse($annonce->commentaires as $comment)
                        <div class="p-4 bg-gray-100 rounded-lg shadow-sm">
                            <p class="text-gray-800">{{ $comment->contenu }}</p>
                            <small class="text-gray-500">Posté par {{ $comment->user->name }} le {{ $comment->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                    @empty
                        <p class="text-gray-500">Aucun commentaire pour le moment.</p>
                    @endforelse
                </div>

                {{-- Add a new comment --}}
                @auth
                    <div class="mt-6">
                        <form action="{{ route('commentaires.store', $annonce->id) }}" method="POST">
                            @csrf
                            <textarea name="contenu" class="w-full p-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="3" placeholder="Ajoutez un commentaire..."></textarea>
                            <button type="submit" class="px-4 py-2 mt-2 text-black bg-indigo-600 rounded-md shadow hover:bg-indigo-700">
                                Publier
                            </button>
                        </form>
                    </div>
                @else
                    <p class="mt-4 text-sm text-gray-600">Vous devez être connecté pour ajouter un commentaire.</p>
                @endauth
            </div>

            {{-- Back button --}}
            <div class="mt-6">
                <a href="{{ route('annonces.index') }}" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection