@extends('layouts.app')

@section('content')
    <section class="flex justify-center items-center h-screen bg-gray-200">
        <form
            action="{{ route('login') }}"
            method="post"
            class="flex flex-col justify-around bg-white w-[469px] h-[682px] gap-6 py-4 rounded-lg"
        >
            @csrf

            <p class="text-red-500 text-center h-10">
                @if(session('message'))
                    {{ session("message") }}
                @endif
            </p>

            <h2 class="text-center text-2xl font-bold">Log in</h2>

            <div class="flex flex-col mx-10">
                <label class="text-xl" for="email">Email</label>
                <input
                    class="border px-3 text-xl py-2 rounded-md bg-slate-100 @error('email') border-red-600 @enderror"
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                />
                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col mx-10">
                <label class="text-xl" for="password">Password</label>
                <input
                    class="border px-3 text-xl py-2 rounded-md bg-slate-100 @error('password') border-red-600 @enderror"
                    type="password"
                    name="password"
                    id="password"
                />
                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="mt-4">
                    <input
                        class="mr-2 ml-1"
                        type="checkbox"
                        id="remember"
                        name="remember"
                    />
                    <label class="text-lg" for="remember">remember me</label>
                </div>
            </div>

            <div class="flex flex-col justify-center w-3/4 mx-auto">
                <input
                    class="bg-sky-600 px-14 py-3 text-white font-bold cursor-pointer rounded-md hover:bg-sky-700 mb-5"
                    type="submit"
                    value="Login"
                />
                <a
                    href="{{ route('register') }}"
                    class="text-center mb-28 font-extralight hover:text-blue-700"
                >Don't have an account?</a
                >
            </div>
        </form>
    </section>
@endsection
