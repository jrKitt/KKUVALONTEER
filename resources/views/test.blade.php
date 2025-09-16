<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="w-full h-full fixed hidden items-center justify-center" id='modal'>
        <div class="bg-black opacity-30 w-full h-full fixed" onclick="toggle()"></div>
        <div class=" w-80 h-80 border flex items-center justify-center bg-white z-1000">MODAL</div>
    </div>

    <div class='bg-zinc-600 flex justify-center items-end h-screen pb-40'>
        <button class="btn border bg-white hover:bg-gray-300" id='btnModal' onclick="toggle()">btn</button>
    </div>

    <script>
        const toggle = () => {
            var modal = document.getElementById('modal')
            if (modal.style.display === "none") {
                modal.style.display = "flex";
            } else {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>
