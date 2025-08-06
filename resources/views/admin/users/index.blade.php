@extends('layouts.admin')

@section('title', 'Daftar User')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Daftar User</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">#</th>
                    <th class="px-4 py-2 text-left font-semibold">Nama</th>
                    <th class="px-4 py-2 text-left font-semibold">Email</th>
                    <th class="px-4 py-2 text-left font-semibold">No. Telepon</th> {{-- ✅ Tambahan --}}
                    <th class="px-4 py-2 text-left font-semibold">Role</th>
                    <th class="px-4 py-2 text-left font-semibold">Dibuat</th>
                    <th class="px-4 py-2 text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->phone ?? '-' }}</td> {{-- ✅ Tambahan --}}
                        <td class="px-4 py-2">{{ $user->role }}</td>
                        <td class="px-4 py-2">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:underline">Detail</a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
