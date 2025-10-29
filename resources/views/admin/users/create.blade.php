@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Tambah User Baru</h1>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 max-w-lg">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm @error('name') border-red-500 @enderror">
                    @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror">
                    @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm @error('password') border-red-500 @enderror">
                    @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Role (Req #2) -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                    <select name="role" id="role" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Anggota)</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                
                <!-- No HP (Req #5) -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. HP</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Alamat (Req #5) -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                    <textarea name="address" id="address" rows="3"
                              class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">{{ old('address') }}</textarea>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 mr-2">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Simpan User
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

