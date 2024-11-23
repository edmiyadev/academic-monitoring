<form wire:submit.prevent="submit" class="flex flex-col items-center pt-8">
    <h2 class="text-center text-xl font-bold mb-16">
        Configura tu éxito académico
    </h2>

    <div class="flex flex-row items-start mx-10 gap-10">
        <div class="w-1/2 ml-10">
            <div class="flex flex-col mb-16">
                <label
                    for="educational-level"
                    class="block mb-2 text-md font-medium text-gray-900"
                >Nivel Educativo de los Estudios</label>

                <select
                    wire:model.live="educationalLevel"
                    id="educational-level"
                    class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2"
                >
                    <option value="">Selecciona un nivel</option>

                    @foreach(\App\Enums\EducationalLevelEnum::cases() as $case)
                        <option value="{{$case->value}}">{{$case->name}}</option>
                    @endforeach
                </select>
                @error('educationalLevel')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col mb-16">
                <label
                    for="educational-institution"
                    class="block mb-2 text-md font-medium text-gray-900"
                >Nombre de la Institución</label>

                <select
                    wire:model.live="educationalInstitution"
                    wire:key="{{ $educationalLevel }}"
                    id="educational-institution"
                    class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2"
                >
                    <option value="">Selecciona una institución</option>
                    @foreach(\App\Enums\EducationalInstitutionEnum::cases() as $case)
                        <option value="{{$case->value}}">{{$case->name}}</option>
                    @endforeach
                </select>
                @error('educationalInstitution')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col mb-16">
                <label
                    for="career"
                    class="block mb-2 text-md font-medium text-gray-900"
                >¿Qué carrera estudias?</label>
                <select
                    wire:model="selectedCareer"
                    id="career"
                    class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2"
                >
                    <option value="">Selecciona una carrera</option>
                    @foreach($availableCareers as $career)
                        <option value="{{ $career->id }}">{{ $career->name }}</option>
                    @endforeach
                </select>
                @error('selectedCareer')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="w-1/2">
            <img src="{{ asset('img/image.jpeg') }}" alt=""/>
        </div>
    </div>

    <button
        type="submit"
        class="bg-sky-600 px-14 py-3 text-white font-bold cursor-pointer rounded-md hover:bg-sky-700"
    >
        Listo
    </button>
</form>
