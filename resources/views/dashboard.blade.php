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
                <input type="text" name="cep" id="cep" value="{{ old('cep') ?: (isset($address) ? $address->cep : '') }}">
                <input type="submit" value="Buscar" class="p-2 text-gray-900 self-start bg-white my-4 p-1 rounded-sm">

                <label class="p-2 text-gray-900 dark:text-gray-100">Rua: </label>
                <input type="text" name="street" id="street" value="<?php echo $address->logradouro ?? ''?>">

                <label class="p-2 text-gray-900 dark:text-gray-100">Bairro: </label>
                <input type="text" name="neighbourhood" id="neighbourhood"  value="<?php echo $address->bairro ?? ''?>">

                <label class="p-2 text-gray-900 dark:text-gray-100">Cidade: </label>
                <input type="text" name="city" id="city" value="<?php echo $address->localidade ?? ''?>">

                <label class="p-2 text-gray-900 dark:text-gray-100">Estado: </label>
                <input type="text" name="state" id="state" value="<?php echo $address->uf ?? ''?>">
            </form>
        </div>
    </div>
</x-app-layout>

