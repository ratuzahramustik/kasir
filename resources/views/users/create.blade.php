    @extends('layouts')

        @section('content')

        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 flex items-center space-x-2 mb-4">
            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-home"></i>
            </a>
            <span>&gt;</span>
            <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-gray-700">User</a>
            <span>&gt;</span>
            <span class="text-gray-700">Create</span>
        </div>

        <h2 class="text-xl font-bold mb-6">Tambah User</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Centered Form Card -->
        <div class="flex justify-center mt-6">
            <div class="w-full max-w-5xl"> <!-- Diperbesar -->
                <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow w-full">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200" required value="{{ old('email') }}">
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200" required value="{{ old('name') }}">
                        </div>

                        <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                        <select name="role" id="role" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200" required>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Employee" {{ old('role') == 'Employee' ? 'selected' : '' }}>Employee</option>                </select>
                        </div>

                                <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200" required>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>


        @endsection
