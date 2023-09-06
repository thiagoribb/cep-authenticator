<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('dashboard.process') }}" method="post" class="display-flex">
                @csrf
                <label class="p-2 text-gray-900 dark:text-gray-100">CEP: </label>
                <input type="text" name="cep" id="cep" value="{{ Auth::user()->cep ?? old('cep') ?: (isset($address) ? $address->cep : '') }}">
                <input type="submit" value="Buscar" class="p-2 text-gray-900 self-start bg-white my-4 p-1 rounded-sm">
            </form>

            <form action="{{ route('profile.updateAddress') }}" method="POST" class="display-flex">
                @method('PATCH')
                @csrf

                <input type="hidden" name="cep" value="{{ $cep ?? '' }}"> <!-- Adicione o campo cpf como um campo oculto -->

                <label class="p-2 text-gray-900 dark:text-gray-100">Rua: </label>
                <input type="text" name="street" id="street" value="<?php echo $address->logradouro ?? Auth::user()->street ?? ''?>">

                <label class="p-2 text-gray-900 dark:text-gray-100">Bairro: </label>
                <input type="text" name="neighbourhood" id="neighbourhood"  value="<?php echo $address->bairro ?? Auth::user()->neighbourhood ?? ''?>">

                <label class="p-2 text-gray-900 dark:text-gray-100">Cidade: </label>
                <input type="text" name="city" id="city" value="<?php echo $address->localidade ?? Auth::user()->city ?? ''?>">

                <label class="p-2 text-gray-900 dark:text-gray-100">Estado: </label>
                <input type="text" name="uf" id="uf" value="<?php echo $address->uf ?? Auth::user()->uf ?? ''?>">
                <input type="submit" value="Atualizar endereço" class="p-2 text-gray-900 self-start bg-white my-4 p-1 rounded-sm">
                @if (session('successAddress'))
                    <div class="bg-teal-100 my-7 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                        <div class="flex">
                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                            <div>
                            <p class="font-bold">{{ session('successAddress') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </form>

        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('profile.updatePhoto') }}" method="POST" class="display-flex" enctype="multipart/form-data">
                @csrf
                @if (auth()->user()->profile_photo)
                    <img src="data:image/png;base64,{{ auth()->user()->profile_photo }}" alt="Foto de Perfil" class="rounded w-48 h-48 object-cover">
                @else
                    <p>Sem foto de perfil</p>
                @endif
                @if (session('successPhoto'))
                    <div class="bg-teal-100 my-7 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                        <div class="flex">
                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                            <div>
                            <p class="font-bold">{{ session('successPhoto') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <label class="p-2 text-gray-900 dark:text-gray-100">Foto de perfil: </label>
                <input type="file" name="profile_photo" id="profile_photo">
                <input type="submit" value="Atualizar foto" class="p-2 self-start bg-white my-4 p-1 rounded-sm">
            </form>
        </div>
    </div>
</x-app-layout>

