<nav class="bg-white py-4">
    <div class="flex container justify-between items-center mx-auto">
        <div>
            <a class="text-2xl font-bold mr-3 text-blue-500" href="{{route('dashboard')}}">EduTrack</a>
        </div>

        <div class="flex gap-11 items-center">
            <div class="flex gap-4">
                <!-- <a href="">Calendario</a> -->
                <a href="{{route('periods')}}">Semestre</a>
                <!-- <a href="">Progreso</a> -->
                <!-- <a href="">Tareas</a> -->
                <a href="{{route('pensum')}}">Pensum</a>
            </div>
            <!-- <div
                class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600"
            >
                <span class="font-medium text-gray-600 dark:text-gray-300"
                    >JL</span
                >
            </div> -->
        </div>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit" class="absolute right-0 top-0 mt-5 mr-5">Logout</button>

        </form>
    </div>
</nav>
<hr class="border-y-2 border-blue-500" />
