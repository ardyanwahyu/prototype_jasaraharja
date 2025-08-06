@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail User</h1>

    <div class="bg-white shadow rounded p-6">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>No. Telepon:</strong> {{ $user->phone ?? '-' }}</p>
        <p><strong>Dibuat:</strong> {{ $user->created_at->format('d M Y') }}</p>
        <p><strong>Update Terakhir:</strong> {{ $user->updated_at->format('d M Y') }}</p>
        
    </div>
@endsection
