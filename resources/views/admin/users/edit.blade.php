@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold">Nama</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $user->name) }}" required>
        </div>

        <div>
            <label for="email" class="block font-semibold">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" value="{{ old('email', $user->email) }}" required>
        </div>

        <div>
            <label for="role" class="block font-semibold">Role</label>
            <select name="role" id="role" class="w-full border rounded px-3 py-2" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="tamu" {{ $user->role == 'tamu' ? 'selected' : '' }}>Tamu</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
@endsection
