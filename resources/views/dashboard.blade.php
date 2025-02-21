@extends('layouts.app')

@section('content')
<div class="container px-4 py-8 mx-auto">
    <h1 class="mb-6 text-3xl font-bold text-center text-gray-800">Liste des Annonces</h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('annonces.create') }}" class="px-4 py-2 text-black transition bg-blue-600 rounded-lg shadow-md hover:bg-blue-700">
            Ajouter une Annonce
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-collapse border-gray-300 rounded-lg shadow-lg">
            <thead>
                <tr class="text-gray-700 bg-gray-200">
                    <th class="px-6 py-3 text-left border-b">Titre</th>
                    <th class="px-6 py-3 text-left border-b">Description</th>
                    <th class="px-6 py-3 text-left border-b">Lieu</th>
                    <th class="px-6 py-3 text-left border-b">Statut</th>
                    <th class="px-6 py-3 text-left text-center border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($annonces as $annonce)
                    <tr class="transition border-b hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $annonce->titre }}</td>
                        <td class="px-6 py-4">{{ Str::limit($annonce->description, 50) }}</td>
                        <td class="px-6 py-4">{{ $annonce->lieu }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-sm rounded-lg {{ $annonce->status == 'Disponible' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $annonce->status }}
                            </span>
                        </td>
                        <td class="flex justify-center gap-2 px-6 py-4">
                            <a href="{{ route('annonces.show', $annonce->id) }}" class="px-3 py-1 text-sm text-black transition bg-blue-500 rounded-lg hover:bg-blue-600">
                                Voir
                            </a>
                            <a href="{{ route('annonces.edit', $annonce->id) }}" class="px-3 py-1 text-sm text-black transition bg-yellow-500 rounded-lg hover:bg-yellow-600">
                                Modifier
                            </a>
                            <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-sm text-white transition bg-red-500 rounded-lg hover:bg-red-600">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
