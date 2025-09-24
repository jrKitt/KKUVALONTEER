@extends("components/layouts/layoutAdmin")

@section("title")
    admin dashboard | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <header class="mx-auto max-w-6xl">
            <div class="my-6 text-5xl font-bold">Dashboard</div>
            <div class="flex h-fit gap-5 p-4 max-md:flex-col">
                <div class="w-full rounded-lg shadow-md shadow-zinc-400/80">
                    <div class="p-4">
                        <section
                            class="flex w-full items-center justify-between"
                        >
                            <h3>สถิติการเข้าร่วมกิจกรรม</h3>
                            <select
                                class="w-50 rounded-xl border-2 border-gray-400 px-2 py-1 max-md:w-70"
                            >
                                <option value="" disabled selected>
                                    รายเดือน
                                </option>
                                <option value="">a</option>
                                <option value="">b</option>
                                <option value="">c</option>
                            </select>
                        </section>
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
                <div class="w-full rounded-lg shadow-md shadow-zinc-400/80">
                    <div class="p-4">
                        <section
                            class="flex w-full items-center justify-between"
                        >
                            <h3>สัดส่วนการเข้าร่วมกิจกรรม</h3>
                            <select
                                class="w-50 rounded-xl border-2 border-gray-400 px-2 py-1 max-md:w-70"
                            >
                                <option value="" disabled selected>
                                    รายเดือน
                                </option>
                                <option value="">a</option>
                                <option value="">b</option>
                                <option value="">c</option>
                            </select>
                        </section>
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
            </div>
            <hr class="my-6 text-gray-400" />
        </header>

        <main>
            <div
                class="mx-auto w-full max-w-6xl rounded p-4 shadow shadow-zinc-400/80"
            >
                <div>
                    <section class="flex items-start justify-between">
                        <h1 class="text-3xl my-3 font-bold">กิจกรรม</h1>
                        <select
                            class="w-50 rounded-xl border-2 border-gray-400 px-2 py-1 max-md:w-70"
                        >
                            <option value="" disabled selected>ทั้งหมด</option>
                            <option value="">a</option>
                            <option value="">b</option>
                            <option value="">c</option>
                        </select>
                    </section>
                    <section class="">
                        
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script>
        const ctx1 = document.getElementById('chart1');
        const ctx2 = document.getElementById('chart2');

        const month = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec',
        ];

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: month.filter((e, index) => index < 9 && e),
                datasets: [
                    {
                        data: [1, 4, 2, 8, 10, 15, 20, 17, 24, 30, 27, 37],
                        borderWidth: 5,
                        tension: 0,
                        pointStyle: false,
                    },
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

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: month.filter((e, index) => index < 9 && e),
                datasets: [
                    {
                        data: [1, 4, 2, 8, 10, 15, 20, 17, 24, 30, 27, 37],
                        borderWidth: 5,
                        tension: 0,
                        pointStyle: false,
                        borderColor: 'rgb(54, 162, 235)',
                    },
                    {
                        data: [9, 16, 8, 24, 40, 60, 80, 68, 50, 80, 19, 58],
                        borderWidth: 5,
                        tension: 0,
                        pointStyle: false,
                        borderColor: 'rgb(39, 231, 166)',
                        borderDash: [5, 5],
                    },
                    {
                        data: [18, 12, 6, 4, 28, 40, 50, 34, 73, 12, 39, 20],
                        borderWidth: 5,
                        tension: 0,
                        pointStyle: false,
                        borderColor: 'rgb(254, 188, 59)',
                        borderDash: [5, 5],
                    },
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
@endsection
