<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
                <option value="wali kelas">Wali Kelas</option>
                <option value="admin">Admin</option>
                <option value="super admin">Super Admin</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- NISN -->
        <div class="mt-4">
            <x-input-label for="nisn" :value="__('NISN')" />
            <x-text-input id="nisn" class="block mt-1 w-full" type="text" name="nisn" :value="old('nisn')" />
            <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
        </div>

        <!-- NIS -->
        <div class="mt-4">
            <x-input-label for="nis" :value="__('NIS')" />
            <x-text-input id="nis" class="block mt-1 w-full" type="text" name="nis" :value="old('nis')" />
            <x-input-error :messages="$errors->get('nis')" class="mt-2" />
        </div>

        <!-- ID Guru -->
        <div class="mt-4">
            <x-input-label for="idguru" :value="__('ID Guru')" />
            <x-text-input id="idguru" class="block mt-1 w-full" type="text" name="idguru" :value="old('idguru')" />
            <x-input-error :messages="$errors->get('idguru')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
