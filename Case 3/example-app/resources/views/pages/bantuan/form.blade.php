<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Use 'Edit' for edit mode and create for non-edit/create mode --}}
            {{ isset($bantuan) ? 'Edit' : 'Create' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- don't forget to add multipart/form-data so we can accept file in our form --}}
                    <form method="post" action="{{ isset($bantuan) ? route('bantuans.update', $bantuan->id) : route('bantuans.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        {{-- add @method('put') for edit mode --}}
                        @isset($bantuan)
                            @method('put')
                        @endisset
                        <div>
                            <x-input-label for="name" value="Name" />
                            {{-- use textarea-input component that we will create after this --}}
                            <x-textarea-input id="name" name="name" class="mt-1 block w-full" required autofocus>{{ $batuan->name ?? old('name') }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description" />
                            {{-- use textarea-input component that we will create after this --}}
                            <x-textarea-input id="description" name="description" class="mt-1 block w-full" required autofocus>{{ $bantuan->description ?? old('description') }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
