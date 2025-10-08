@extends("components/layouts/layoutAdmin")

@section("title")
    admin dashboard | KKU VOLUNTEER
@endsection

@php
    $now = now();
    $activitiesThisMonth = collect($activities)->filter(function ($a) use ($now) {
        return \Carbon\Carbon::parse($a->start_time)->month === $now->month;
    });

    \Carbon\Carbon::setLocale("th");
    $colors = ["bg-green-400", "bg-blue-400", "bg-yellow-400", "bg-pink-400", "bg-purple-400", "bg-red-400", "bg-teal-400"];
    $randomColor = $colors[array_rand($colors)];

    $year = request()->get("year", date("Y"));
    $month = request()->get("month", date("m"));
    $daysInMonth = date("t", strtotime("$year-$month-01"));
    $firstDay = date("w", strtotime("$year-$month-01"));

    $dates = $activities->map(fn ($a) => \Carbon\Carbon::parse($a->start_time)->format("Y-m-d"))->toArray();

    $prevMonth = date("Y-m", strtotime("$year-$month-01 -1 month"));
    $nextMonth = date("Y-m", strtotime("$year-$month-01 +1 month"));
@endphp

@section("layout-content")
    <div class="min-h-screen bg-gray-50 text-black">
        <div class="mx-auto aspect-auto max-w-6xl px-2">
            <div class="my-6 text-5xl font-bold">Dashboard</div>
            <div class="flex h-fit gap-5 p-4 max-lg:flex-col">
                <div class="roucnded-lg w-full shadow-md shadow-zinc-400/80">
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

        <main class="pb-12">
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
                        class="mb-6 flex w-full gap-5 max-md:flex-col-reverse max-md:items-center"
                    >
                        <div class="flex w-2/3 flex-col gap-10 max-md:w-full">
                            @foreach ($activitiesThisMonth as $a)
                                <section
                                    class="flex h-fit w-full gap-3 rounded-lg shadow-md"
                                >
                                    <div
                                        class="{{ $randomColor }} max-h-full w-3 rounded-xl"
                                    ></div>

                                    <div class="flex w-full flex-col px-4 py-2">
                                        <section
                                            class="flex w-full justify-between max-sm:flex-col"
                                        >
                                            <div
                                                class="flex w-full items-center gap-3"
                                            >
                                                <div
                                                    class="{{ $randomColor }} h-3 w-3 rounded-full"
                                                ></div>
                                                <div
                                                    class="text-xl font-medium text-black"
                                                >
                                                    {{ $a->name_th }}
                                                </div>
                                            </div>

                                            <div>
                                                <div
                                                    class="w-fit rounded-md bg-gray-200 px-2 py-1 font-bold text-gray-500"
                                                >
                                                    {{ $a->participants_count }}/{{ $a->accept_amount }}
                                                </div>
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
                                                        สถานที่ :
                                                        {{ $a->location }}
                                                    </span>
                                                </div>
                                                <div class="flex text-gray-600">
                                                    <p class="text-gray-500">
                                                        รวม
                                                        {{ $a->total_hour }}
                                                        ชั่วโมง
                                                    </p>
                                                    <span
                                                        class="mx-2 text-gray-500"
                                                    >
                                                        |
                                                    </span>
                                                    <span class="text-gray-500">
                                                        {{ \Carbon\Carbon::parse($a->start_time)->translatedFormat("d F Y") }}
                                                        <span class="mx-1">
                                                            →
                                                        </span>
                                                        {{ \Carbon\Carbon::parse($a->end_time)->translatedFormat("d F Y") }}
                                                    </span>
                                                </div>

                                                <div
                                                    class="flex max-sm:justify-center"
                                                >
                                                    <div
                                                        class="inline rounded-4xl bg-gray-300 px-4 py-1 font-medium text-gray-800"
                                                    >
                                                        {{ ["pending" => "รอดำเนินการ", "ongoing" => "กำลังดำเนินการ", "finished" => "เสร็จสิ้น"][$a->status] ?? $a->status }}
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </section>
                            @endforeach
                        </div>

                        {{-- calendar --}}

                        <div class="flex h-fit w-full justify-center md:w-1/3">
                            <div class="w-full max-w-sm">
                                {{--
                                    <div class="flex items-center gap-3">
                                    <div
                                    class="{{ $randomColor }} mb-2 h-3 w-3 rounded-full"
                                    ></div>
                                    <p class="mb-2 text-xl font-medium">
                                    วันจัดกิจกรรมตลอดทั้งปี
                                    </p>
                                    </div>
                                --}}
                                <div
                                    class="w-full overflow-clip rounded-md pb-3 shadow-md"
                                >
                                    <table
                                        class="calendar w-full border-gray-300 text-center"
                                    >
                                        <thead>
                                            <tr
                                                class="bg-gray-200/80 font-light"
                                            >
                                                @foreach (["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"] as $day)
                                                    <th class="p-2">
                                                        {{ $day }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $firstDay = date("w", strtotime("$year-$month-01"));
                                                $day = 1;
                                            @endphp

                                            @for ($i = 0; $i < 5; $i++)
                                                <tr>
                                                    @for ($j = 0; $j < 7; $j++)
                                                        @if ($i === 0 && $j < $firstDay)
                                                            <td
                                                                class="p-2"
                                                            ></td>
                                                        @elseif ($day > $daysInMonth)
                                                            <td
                                                                class="p-2"
                                                            ></td>
                                                        @else
                                                            @php
                                                                $currentDate = "$year-$month-" . str_pad($day, 2, "0", STR_PAD_LEFT);
                                                            @endphp

                                                            <td
                                                                class="{{ in_array($currentDate, $dates) ? "bg-green-200 font-semibold" : "" }} p-2"
                                                            >
                                                                {{ $day }}
                                                            </td>
                                                            @php
                                                                $day++;
                                                            @endphp
                                                        @endif
                                                    @endfor
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
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

        const activityDates = @json($dates);
        console.log(activityDates);
    </script>
@endsection
