@extends('layouts.app')

@section('content')
    <section class="bg-white h-screen">
        <form action="{{ route('profile') }}" class="flex flex-col items-center pt-8" method="post">
            @csrf
            <h2 class="text-center text-xl font-bold mb-16">
                Configura tu exito academico
            </h2>
            <div class="flex flex-row items-start mx-10 gap-10">
                <div class="w-1/2 ml-10">
                    <div class="flex flex-col mb-16">
                        <label
                            for="educational-level"
                            class="block mb-2 text-md font-medium text-gray-900"
                        >Nivel Educativo de los Estudios</label
                        >

                        <select
                            name="educational-level"
                            id="educational-level"
                            class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2"
                        >

                            @foreach(\App\Enums\EducationalLevelEnum::cases() as $case)
                                <option value="{{$case->value}}">{{$case->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col mb-16">
                        <label
                            for="educational-institution"
                            class="block mb-2 text-md font-medium text-gray-900"
                        >Nombre de la Institución</label
                        >
                        <select
                            name="educational-institution"
                            id="educational-institution"
                            class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2"
                        >
                            @foreach(\App\Enums\EducationalInstitutionEnum::cases() as $case)
                                <option value="{{$case->value}}">{{$case->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col mb-16">
                        <label
                            for="career"
                            class="block mb-2 text-md font-medium text-gray-900"
                        >¿Qué carrera estudias?</label
                        >
                        <select
                            name="career"
                            id="career"
                            class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2"
                        >
                            <option value="">UASD</option>
                            <option value="">UTESA</option>
                        </select>
                    </div>
                </div>

                <div class=" w-1/2">
                    <img src="{{ asset('img/image.jpeg') }}" alt=""/>
                </div>
            </div>
            <input
                class="bg-sky-600 px-14 py-3 text-white font-bold cursor-pointer rounded-md hover:bg-sky-700"
                type="submit"
                value="Listo"
            />
        </form>
    </section>
@endsection
