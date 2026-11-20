<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-2xl font-bold text-gray-700 p-6 border-b">{{ $form->name }}</h1>
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user.form.submit') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="form_group_id" value="{{ $form->id_form }}">
                        @foreach ($form->fields as $field)
                        <div class="flex flex-col">
                            <!-- Label -->
                            <label class="text-sm font-medium text-gray-700 mb-1">{{ $field->label }}</label>
                            
                            <!-- Input Type -->
                            @if ($field->type == 'text')
                                <input type="text" name="{{ $field->name }}" 
                                       placeholder="{{ $field->placeholder }}" 
                                       {{ $field->required ? 'required' : '' }}
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @elseif ($field->type == 'textarea')
                                <textarea name="{{ $field->name }}" 
                                          placeholder="{{ $field->placeholder }}" 
                                          {{ $field->required ? 'required' : '' }}
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                            @elseif ($field->type == 'select')
                                <select name="{{ $field->name }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @foreach (explode(',', $field->options) as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            @elseif ($field->type == 'file')
                                <input type="file" name="{{ $field->name }}" 
                                       {{ $field->required ? 'required' : '' }}
                                       class="w-full file:bg-blue-50 file:border-0 file:text-blue-600 file:font-semibold file:py-2 file:px-4 file:rounded-md hover:file:bg-blue-100 sm:text-sm">
                            @elseif ($field->type == 'number')
                                <input type="number" name="{{ $field->name }}" 
                                       placeholder="{{ $field->placeholder }}" 
                                       {{ $field->required ? 'required' : '' }}
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @elseif ($field->type == 'email')
                                <input type="email" name="{{ $field->name }}" 
                                       placeholder="{{ $field->placeholder }}" 
                                       {{ $field->required ? 'required' : '' }}
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @elseif ($field->type == 'checkbox')
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="{{ $field->name }}" 
                                           value="1" {{ $field->required ? 'required' : '' }}
                                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">{{ $field->placeholder }}</span>
                                </div>
                            @elseif ($field->type == 'date')
                                <input type="date" name="{{ $field->name }}" 
                                       {{ $field->required ? 'required' : '' }}
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @endif
                        </div>
                    @endforeach
                    

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
