<nav class="bg-white py-4">
    <div class="flex container justify-between items-center mx-auto">
        <div>
            <p class="text-2xl font-bold mr-3 text-blue-500">EduTrack</p>
        </div>

        <div class="flex gap-11 items-center">
            <div class="flex gap-4">
                <!-- <a class="hover:text-blue-500 font-bold cursor-pointer delay-150"
                   href="{{route('dashboard')}}">Dashboard</a> -->
                <!-- <a href="">Calendario</a> -->
                <a class="hover:text-blue-500 font-bold cursor-pointer delay-150"
                   href="{{route('periods')}}">Semestre</a>
                <!-- <a class="hover:text-blue-500 font-bold cursor-pointer delay-150"
                href="">Progreso</a> -->
                <a class="hover:text-blue-500 font-bold cursor-pointer delay-150"
                   href="{{route('tasks')}}">Tareas</a>
                <a class="hover:text-blue-500 font-bold cursor-pointer delay-150"
                   href="{{route('pensum')}}">Pensum</a>
            </div>
            <!-- <div
                class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600"
            >
                <span class="font-medium text-gray-600 dark:text-gray-300"
                    >JL</span
                >
            </div> -->
        </div>
        <form class="text-blue-500 hover:text-blue-600 font-bold cursor-pointer delay-150"
            action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit" class="absolute right-0 top-0 mt-5 mr-5">Logout</button>

        </form>
    </div>
</nav>
<hr class="border-y-2 border-blue-500"/>
