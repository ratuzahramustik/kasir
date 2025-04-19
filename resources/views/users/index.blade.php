@extends('layouts')

@section('content')

<!-- Breadcrumb -->
<div class="text-sm text-gray-500 flex items-center space-x-2 mb-2">
        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-home"></i>
        </a>
        <span>&gt;</span>
        <span class="text-gray-700">User</span>
    </div>

<h2 class="text-xl font-bold mb-4"> User</h2>

<div class="flex justify-end mb-4 mr-14">
    <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah User</a>
</div>

@if(session('success'))
    <div class="mt-2 text-green-600">{{ session('success') }}</div>
@endif

<div class="overflow-x-auto max-w-6xl mx-auto px-4">
    <table class="table-auto w-full border-collapse bg-white shadow rounded-lg">
        <thead>
            <tr class="bg-white-100 text-gray-700 text-left">
                <th class="p-3 border">#</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Nama</th>
                <th class="p-3 border">Role</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr class="hover:bg-gray-50">
                <td class="p-3 border">{{ $index + 1 }}</td>
                <td class="p-3 border">{{ $user->email }}</td>
                <td class="p-3 border">{{ $user->name }}</td>
                <td class="p-3 border">{{ $user->role }}</td>
                <td class="p-3 border w-44">
                <div class="flex gap-1 flex-wrap">
                    <a href="{{ route('users.edit', $user) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">
                            Hapus
                        </button>
                    </form>
                </div>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
