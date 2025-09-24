<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>test</title>
        @vite("resources/css/app.css")
        @vite('resources/js/app.js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body>
        <div class="mx-auto flex h-screen max-w-6xl items-center w-full">

            <calendar-range months="2">
                <calendar-month></calendar-month>
            </calendar-range>

        </div>

        <script>
           import "cally";
            const ctx = document.getElementById('myChart');

            const month = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ];

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: month.filter((e, index) => index < 9 && e),
                    datasets: [
                        {
                            data: [1, 4, 2, 8, 10, 15, 20, 17, 24, 30, 27, 37],
                            borderWidth: 5,
                            tension: 0,
                        },
                        {
                            data: [1, 0, 2, 8, 10, 15, 20, 17, 24, 30, 27, 37],
                            borderWidth: 5,
                            tension: 0,
                        },
                        {
                            data: [1, 4, 2, 1, 10, 15, 50, 17, 24, 30, 27, 37],
                            borderWidth: 5,
                            tension: 0,
                        }
                    ],
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                },
            });
        </script>
    </body>
</html>
