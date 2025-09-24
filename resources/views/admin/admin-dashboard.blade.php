@extends('components/layouts/layoutAdmin')

@section('title')
    admin dashboard | KKU VOLUNTEER
@endsection

@section('layout-content')
    <div class="min-h-screen bg-gray-50 text-black">
        <header class="mx-auto max-w-6xl">
            <div class="my-6 text-5xl font-bold">Dashboard</div>
            <div class="flex h-fit gap-5 p-4 max-sm:flex-col">
                <div class="w-full rounded-lg shadow-md shadow-zinc-400/80">
                    <div class="p-4">
                        <section class="flex w-full items-center justify-between">
                            <h3>สถิติการเข้าร่วมกิจกรรม</h3>
                            <select class="w-50 rounded-xl border-2 border-gray-400 px-2 py-1 max-md:w-70">
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
                        <section class="flex w-full items-center justify-between">
                            <h3>สัดส่วนการเข้าร่วมกิจกรรม</h3>
                            <select class="w-50 rounded-xl border-2 border-gray-400 px-2 py-1 max-md:w-70">
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
            <div class="mx-auto w-full max-w-6xl rounded p-4 shadow shadow-zinc-400/80">
                <div>
                    <section class="flex items-start justify-between">
                        <h1 class="my-3 text-4xl font-bold">กิจกรรม</h1>
                        <select class="w-50 rounded-xl border-2 border-gray-400 px-2 py-1 max-md:w-70">
                            <option value="" disabled selected>ทั้งหมด</option>
                            <option value="">a</option>
                            <option value="">b</option>
                            <option value="">c</option>
                        </select>
                    </section>
                    <section class="flex w-full gap-5">
                        <div class="w-2/3 flex flex-col gap-10">

                            <section class="flex h-40 w-full gap-3 rounded-lg shadow-md">
                                {{-- Line startContent --}}
                                <div class="h-full w-3 rounded-xl bg-green-500"></div>
                                {{-- Line startContent --}}

                                <div class="flex h-full w-full justify-between p-2">
                                    <div class="flex flex-col justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="h-3 w-3 rounded-full bg-green-400"></div>
                                            <div class="text-xl font-bold text-black">
                                                กิจกรรมชวนน้องดำนาครั้งที่ 1
                                            </div>
                                        </div>
                                        <div class="text-gray-600">
                                            <span>นาหลังบ้าน นายเอกรินทร์</span>
                                            <span>48 ชั่วโมง</span>
                                        </div>
                                        <div class="text-gray-600">
                                            <span>07 มกราคม 2568</span>
                                        </div>
                                        <div>
                                            <button
                                                class="rounded-4xl bg-green-300 px-4 py-1 font-medium text-green-800/80">
                                                Active
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end justify-between">
                                        <div class="w-fit rounded-md bg-red-400/80 px-2 py-1 font-bold text-red-500">
                                            30/30
                                        </div>
                                        <div>
                                            <button class="px-4 py-2 rounded-sm bg-yellow-500/70 text-white">
                                                แก้ไขกิจกรรม
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="flex h-40 w-full gap-3 rounded-lg shadow-md">
                                {{-- Line startContent --}}
                                <div class="h-full w-3 rounded-xl bg-green-500"></div>
                                {{-- Line startContent --}}

                                <div class="flex h-full w-full justify-between p-2">
                                    <div class="flex flex-col justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="h-3 w-3 rounded-full bg-green-400"></div>
                                            <div class="text-xl font-bold text-black">
                                                กิจกรรมชวนน้องดำนาครั้งที่ 1
                                            </div>
                                        </div>
                                        <div class="text-gray-600">
                                            <span>นาหลังบ้าน นายเอกรินทร์</span>
                                            <span>48 ชั่วโมง</span>
                                        </div>
                                        <div class="text-gray-600">
                                            <span>07 มกราคม 2568</span>
                                        </div>
                                        <div>
                                            <button
                                                class="rounded-4xl bg-green-300 px-4 py-1 font-medium text-green-800/80">
                                                Active
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end justify-between">
                                        <div class="w-fit rounded-md bg-red-400/80 px-2 py-1 font-bold text-red-500">
                                            30/30
                                        </div>
                                        <div>
                                            <button class="px-4 py-2 rounded-sm bg-yellow-500/70 text-white">
                                                แก้ไขกิจกรรม
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="flex h-40 w-full gap-3 rounded-lg shadow-md">
                                {{-- Line startContent --}}
                                <div class="h-full w-3 rounded-xl bg-green-500"></div>
                                {{-- Line startContent --}}

                                <div class="flex h-full w-full justify-between p-2">
                                    <div class="flex flex-col justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="h-3 w-3 rounded-full bg-green-400"></div>
                                            <div class="text-xl font-bold text-black">
                                                กิจกรรมชวนน้องดำนาครั้งที่ 1
                                            </div>
                                        </div>
                                        <div class="text-gray-600">
                                            <span>นาหลังบ้าน นายเอกรินทร์</span>
                                            <span>48 ชั่วโมง</span>
                                        </div>
                                        <div class="text-gray-600">
                                            <span>07 มกราคม 2568</span>
                                        </div>
                                        <div>
                                            <button
                                                class="rounded-4xl bg-green-300 px-4 py-1 font-medium text-green-800/80">
                                                Active
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end justify-between">
                                        <div class="w-fit rounded-md bg-red-400/80 px-2 py-1 font-bold text-red-500">
                                            30/30
                                        </div>
                                        <div>
                                            <button class="px-4 py-2 rounded-sm bg-yellow-500/70 text-white">
                                                แก้ไขกิจกรรม
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>

                        <div class="w-1/3 flex justify-center h-fit">
                            <div>
                                <calendar-date class="cally bg-zinc-100 shadow-lg rounded-box ">
                                    <svg aria-label="Previous" class="fill-current  size-4" slot="previous"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                                    </svg>
                                    <svg aria-label="Next" class="fill-current  size-4" slot="next"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                                    </svg>
                                    <calendar-month class=""></calendar-month>
                                </calendar-date>
                            </div>

                        </div>
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
                datasets: [{
                    data: [1, 4, 2, 8, 10, 15, 20, 17, 24, 30, 27, 37],
                    borderWidth: 5,
                    tension: 0,
                    pointStyle: false,
                }, ],
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
                datasets: [{
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
