@extends("components/layouts/layoutAdmin")

@section("title")
    admin dashboard | KKU VOLUNTEER
@endsection

@php
    $now = now();
    $activitiesThisMonth = collect($activities)->filter(function ($a) use ($now) {
        return \Carbon\Carbon::parse($a->start_time)->month === $now->month;
    });
@endphp

@section("layout-content")
    <div class="min-h-screen bg-gray-50 text-black">
        <div class="mx-auto aspect-auto max-w-6xl px-2">
            <div class="my-6 text-5xl font-bold">Dashboard</div>
            <div class="flex h-fit gap-5 p-4 max-lg:flex-col">
                <div class="w-full rounded-lg shadow-md shadow-zinc-400/80">
                    <div class="p-2 sm:p-4">
                        <section
                            class="flex w-full flex-wrap items-center justify-between gap-2"
                        >
                            <h3 class="text-sm sm:text-base">
                                สถิติการเข้าร่วมกิจกรรม
                            </h3>
                            {{--
                                <select
                                class="w-full sm:w-50 rounded-xl border-2 border-gray-400 px-2 py-1 text-sm"
                                >
                                <option value="" disabled selected>
                                รายเดือน
                                </option>
                                <option value="">a</option>
                                <option value="">b</option>
                                <option value="">c</option>
                                </select>
                            --}}
                        </section>
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
                <div class="w-full rounded-lg shadow-md shadow-zinc-400/80">
                    <div class="p-2 sm:p-4">
                        <section
                            class="flex w-full flex-wrap items-center justify-between gap-2"
                        >
                            <h3 class="text-sm sm:text-base">
                                สัดส่วนการเข้าร่วมกิจกรรมของนักศึกษา
                            </h3>
                            {{--
                                <select
                                class="w-full sm:w-50 rounded-xl border-2 border-gray-400 px-2 py-1 text-sm"
                                >
                                <option value="" disabled selected>
                                รายเดือน
                                </option>
                                <option value="">a</option>
                                <option value="">b</option>
                                <option value="">c</option>
                                </select>
                            --}}
                        </section>
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
            </div>
            <hr class="my-6 text-gray-400" />
        </div>

        <main>
            <div
                class="mx-auto w-full max-w-6xl rounded p-4 shadow shadow-zinc-400/80"
            >
                <div>
                    <section
                        class="my-2 flex items-start justify-between gap-3 max-sm:flex-col sm:gap-5"
                    >
                        <h1
                            class="my-3 text-2xl font-semibold sm:text-3xl md:text-4xl"
                        >
                            กิจกรรมของเดือน
                            <span id="monthName"></span>
                        </h1>

                        {{--
                            <select
                            class="w-full sm:w-50 rounded-xl border-2 border-gray-400 px-2 py-1 text-sm"
                            >
                            <option value="" disabled selected>ทั้งหมด</option>
                            <option value="">a</option>
                            <option value="">b</option>
                            <option value="">c</option>
                            </select>
                        --}}
                    </section>

                    <section
                        class="flex w-full gap-5 max-md:flex-col-reverse max-md:items-center"
                    >
                        {{-- slot --}}
                        <div class="flex w-2/3 flex-col gap-10 max-md:w-full">
                            @foreach ($activitiesThisMonth as $a)
                                <section
                                    class="flex h-fit w-full gap-3 rounded-lg shadow-md"
                                >
                                    <div
                                        class="max-h-full w-3 rounded-xl bg-green-500"
                                    ></div>

                                    <div class="flex w-full flex-col px-4 py-2">
                                        <section
                                            class="flex w-full justify-between max-sm:flex-col"
                                        >
                                            <div
                                                class="flex w-full items-center gap-3"
                                            >
                                                <div
                                                    class="h-3 w-3 rounded-full bg-green-400"
                                                ></div>
                                                <div
                                                    class="text-xl font-bold text-black"
                                                >
                                                    {{ $a->name_th }}
                                                </div>
                                            </div>

                                            <div>
                                                <section>
                                                    <div
                                                        class="w-fit rounded-md bg-red-400/80 px-2 py-1 font-bold text-red-500"
                                                    >
                                                        {{ $a->accept_amount }}
                                                    </div>
                                                </section>
                                            </div>
                                        </section>

                                        <section
                                            class="flex h-full justify-between max-sm:flex-col max-sm:items-center max-sm:gap-5"
                                        >
                                            <div
                                                class="flex h-full flex-col justify-between gap-2 py-2"
                                            >
                                                <div class="text-gray-600">
                                                    <span>
                                                        {{ $a->location }}
                                                    </span>
                                                    <span>
                                                        {{ $a->total_hour }}
                                                        ชั่วโมง
                                                    </span>
                                                </div>
                                                <div class="text-gray-600">
                                                    <span>
                                                        {{ \Carbon\Carbon::parse($a->start_time)->format("d F Y") }}
                                                    </span>
                                                </div>
                                                <div
                                                    class="flex max-sm:justify-center"
                                                >
                                                    <div
                                                        class="inline rounded-4xl bg-green-300 px-4 py-1 font-medium text-green-800/80"
                                                    >
                                                        {{ $a->status }}
                                                    </div>
                                                </div>
                                            </div>

                                            {{--
                                                <div
                                                class="flex h-full items-end max-sm:justify-center"
                                                >
                                                <button
                                                class="rounded-sm bg-yellow-500/70 px-4 py-2 text-white"
                                                >
                                                แก้ไขกิจกรรม
                                                </button>
                                                </div>
                                            --}}
                                        </section>
                                    </div>
                                </section>
                            @endforeach
                        </div>
                        {{-- slot --}}

                        {{-- calendar --}}
                        <div class="flex h-fit w-full justify-center md:w-1/3">
                            <div class="w-full max-w-sm">
                                <calendar-date
                                    class="cally bg-base-100 rounded-box w-full shadow-lg"
                                >
                                    <svg
                                        aria-label="Previous"
                                        class="size-4 fill-current"
                                        slot="previous"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M15.75 19.5 8.25 12l7.5-7.5"
                                        ></path>
                                    </svg>
                                    <svg
                                        aria-label="Next"
                                        class="size-4 fill-current"
                                        slot="next"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="m8.25 4.5 7.5 7.5-7.5 7.5"
                                        ></path>
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

        const recs = @json($recs);

        const activities = @json($activities);
        console.log(activities);

        const monthlyCount = Array(12).fill(0);
        recs.forEach((item) => {
            const date = new Date(item.created_at || item.registered_at);
            const month = date.getMonth(); // 0–11
            monthlyCount[month]++;
        });

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: [
                    'ม.ค.',
                    'ก.พ.',
                    'มี.ค.',
                    'เม.ย.',
                    'พ.ค.',
                    'มิ.ย.',
                    'ก.ค.',
                    'ส.ค.',
                    'ก.ย.',
                    'ต.ค.',
                    'พ.ย.',
                    'ธ.ค.',
                ],
                datasets: [
                    {
                        label: 'จำนวนกิจกรรม',
                        data: monthlyCount,
                        borderWidth: 4,
                        borderColor: '#3b82f6',
                        tension: 0.3,
                        pointStyle: false,
                    },
                ],
            },
            options: {
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: { beginAtZero: true },
                },
            },
        });

        const facultyCount = {};
        recs.forEach((item) => {
            const faculty = item.user?.faculty || 'ไม่ระบุคณะ';
            facultyCount[faculty] = (facultyCount[faculty] || 0) + 1;
        });

        const labels = Object.keys(facultyCount);
        const data = Object.values(facultyCount);

        const colors = labels.map(() => {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, 0.6)`;
        });

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'จำนวนกิจกรรมตามคณะ',
                        data,
                        borderWidth: 2,
                        backgroundColor: colors,
                        borderColor: colors.map((c) => c.replace('0.6', '1')),
                    },
                ],
            },
            options: {
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: { beginAtZero: true },
                },
            },
        });

        const monthNames = [
            'มกราคม',
            'กุมภาพันธ์',
            'มีนาคม',
            'เมษายน',
            'พฤษภาคม',
            'มิถุนายน',
            'กรกฎาคม',
            'สิงหาคม',
            'กันยายน',
            'ตุลาคม',
            'พฤศจิกายน',
            'ธันวาคม',
        ];
        const now = new Date();
        document.getElementById('monthName').textContent =
            monthNames[now.getMonth()];
    </script>
@endsection
