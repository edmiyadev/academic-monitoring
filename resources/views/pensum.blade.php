@extends('layouts.app')

@section('content')
    @include('navigation')

    <section class="bg-white h-screen">
        <div class="flex flex-col container mx-auto">
            <div>
                <h2 class="text-4xl font-bold text-start mt-16">Pensum</h2>
                <p class="mb-10 mt-4 font-light text-gray-500">Lista de materias</p>
            </div>

            <div>
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 border-4 rounded-3xl"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50"
                    >
                    <tr>
                        <th scope="col" class="px-6 py-3">Clave</th>
                        <th scope="col" class="px-6 py-3">Asignatura</th>
                        <th scope="col" class="px-6 py-3">HT</th>
                        <th scope="col" class="px-6 py-3">HP</th>
                        <th scope="col" class="px-6 py-3">CR</th>
                        <th scope="col" class="px-6 py-3">Prerequisitos</th>
                        <th scope="col" class="px-6 py-3">Semestre</th>
                        <th scope="col" class="px-6 py-3">Estatus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        class="bg-white border-b"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        >
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4">Silver</td>
                        <td class="px-6 py-4">Laptop</td>
                        <td class="px-6 py-4">$2999</td>
                    </tr>
                    <tr
                        class="bg-white border-b"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        >
                            Microsoft Surface Pro
                        </th>
                        <td class="px-6 py-4">White</td>
                        <td class="px-6 py-4">Laptop PC</td>
                        <td class="px-6 py-4">$1999</td>
                    </tr>
                    <tr class="bg-white">
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        >
                            Magic Mouse 2
                        </th>
                        <td class="px-6 py-4">Black</td>
                        <td class="px-6 py-4">Accessories</td>
                        <td class="px-6 py-4">$99</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
