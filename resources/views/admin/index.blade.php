<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin | KKU VOLUNTEER</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="h-screen flex flex-col items-center justify-center font-extrabold text-9xl ">
        <div class="flex flex-col items-center underline">
            <img src="{{ asset('/images/family.png') }}" alt="img" class="w-200 rounded-4xl">
            <div>ADMIN</div>
        </div>
        <div class="text-3xl flex flex-col m-10 font-medium gap-2">
            <button class="btn bg-red-300 text-zinc-600 transition-all hover:scale-200">
                <a href="admin/dashboard">Dashboard</a>
            </button>
            <button class="btn bg-yellow-200 text-zinc-600 transition-all hover:scale-200">
                <a href="admin/event">Event</a>
            </button>
        </div>
    </div>
</body>

</html>
