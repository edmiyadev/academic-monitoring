@extends('layouts.app')

<div class="flex justify-center items-center h-screen">
    <form
        action="{{ route('register') }}"
        method="post"
        class="flex flex-col justify-around bg-white w-[469px] h-[682px] gap-6 py-4 rounded-lg"
    >
        @csrf
        <h2 class="text-center text-2xl font-bold">Sign up</h2>

        <div class="flex flex-col mx-10">
            <label class="text-xl" for="name">Name</label>
            <input
                class="border px-3 text-xl py-2 rounded-md bg-slate-100 inline-block @error('name') border-red-600 @enderror"
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
            />
            @error('name')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

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
        </div>
        <div class="flex flex-col mx-10">
            <label class="text-xl" for="password_confirmation"
                >Repeat password</label
            >
            <input
                class="border px-3 text-xl py-2 rounded-md bg-slate-100 @error('password_confirmation') border-red-600 @enderror"
                type="password"
                name="password_confirmation"
                id="password_confirmation"
            />
            @error('password_confirmation')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col justify-center w-3/4 mx-auto mb-16 mt-8">
            <input
                class="bg-sky-600 px-14 py-3 text-white font-bold cursor-pointer rounded-md hover:bg-sky-700"
                type="submit"
                value="Register"
            />
            <p class="text-center mt-2 font-extralight">Already have an account? <a class="text-blue-500 hover:text-blue-600" href="{{ route('login')}}">Sign in</a></p>
        </div>
    </form>
</div>
