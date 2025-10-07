@extends("components/layouts/layoutAfterLogin")

@section("title")
    เป้าหมายชั่วโมงอาสา | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Header -->
            <div
                class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between"
            >
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        เป้าหมายชั่วโมงอาสา
                    </h1>
                    <p class="mt-2 text-gray-600">
                        ติดตามและจัดการเป้าหมายชั่วโมงกิจกรรมอาสาสมัครของคุณ
                    </p>
                </div>
                <div class="mt-4 flex gap-3 md:mt-0">
                    <button
                        onclick="updateProgress()"
                        class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-3 font-medium text-white transition-colors duration-200 hover:bg-blue-700"
                        id="updateBtn"
                    >
                        <svg
                            class="mr-2 h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                            ></path>
                        </svg>
                        อัปเดตความคืบหน้า
                    </button>
                    <a
                        href="{{ route("goals.create") }}"
                        class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 font-medium text-white transition-colors duration-200 hover:bg-red-700"
                    >
                        <svg
                            class="mr-2 h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                            ></path>
                        </svg>
                        สร้างเป้าหมายใหม่
                    </a>
                </div>
            </div>

            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-4">
                <div
                    class="rounded-xl bg-white p-6 shadow-md transition-shadow duration-300 hover:shadow-lg"
                >
                    <div class="flex items-center">
                        <div class="rounded-full bg-green-100 p-3">
                            <svg
                                class="h-6 w-6 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                                ></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">
                                เป้าหมายที่บรรลุ
                            </p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $completedGoals->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="rounded-xl bg-white p-6 shadow-md transition-shadow duration-300 hover:shadow-lg"
                >
                    <div class="flex items-center">
                        <div class="rounded-full bg-blue-100 p-3">
                            <svg
                                class="h-6 w-6 text-blue-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"
                                ></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">
                                เป้าหมายที่กำลังดำเนิน
                            </p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $activeGoals->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="rounded-xl bg-white p-6 shadow-md transition-shadow duration-300 hover:shadow-lg"
                >
                    <div class="flex items-center">
                        <div class="rounded-full bg-red-100 p-3">
                            <svg
                                class="h-6 w-6 text-red-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">
                                เป้าหมายที่หมดเวลา
                            </p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $overdueGoals->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="rounded-xl bg-white p-6 shadow-md transition-shadow duration-300 hover:shadow-lg"
                >
                    <div class="flex items-center">
                        <div class="rounded-full bg-purple-100 p-3">
                            <svg
                                class="h-6 w-6 text-purple-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                ></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">
                                เป้าหมายทั้งหมด
                            </p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $activeGoals->count() + $completedGoals->count() + $overdueGoals->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Goals -->
            @if ($activeGoals->count() > 0)
                <div class="mb-8">
                    <h2
                        class="mb-6 flex items-center text-2xl font-bold text-gray-900"
                    >
                        <svg
                            class="mr-2 h-6 w-6 text-blue-600"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        เป้าหมายที่กำลังดำเนิน
                    </h2>
                    <div
                        class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                    >
                        @foreach ($activeGoals as $goal)
                            <div
                                class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow duration-300 hover:shadow-lg"
                            >
                                <div class="p-6">
                                    <div
                                        class="mb-4 flex items-start justify-between"
                                    >
                                        <div>
                                            <h3
                                                class="text-lg font-semibold text-gray-900"
                                            >
                                                {{ $goal->description ?? "เป้าหมาย" . $goal->target_hours . " ชั่วโมง" }}
                                            </h3>
                                            <p
                                                class="mt-1 text-sm text-gray-500"
                                            >
                                                {{ \Carbon\Carbon::parse($goal->start_date)->format("d M Y") }}
                                                -
                                                {{ \Carbon\Carbon::parse($goal->end_date)->format("d M Y") }}
                                            </p>
                                        </div>
                                        <span
                                            class="@if ($goal->progress_percentage >= 100)
                                                bg-green-100
                                                text-green-800
                                            @elseif ($goal->progress_percentage >= 75)
                                                bg-blue-100
                                                text-blue-800
                                            @elseif ($goal->progress_percentage >= 50)
                                                bg-yellow-100
                                                text-yellow-800
                                            @else
                                                bg-gray-100
                                                text-gray-800
                                            @endif rounded-full px-3 py-1 text-xs font-medium"
                                        >
                                            {{ number_format($goal->progress_percentage, 1) }}%
                                        </span>
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="mb-4">
                                        <div
                                            class="mb-2 flex justify-between text-sm text-gray-600"
                                        >
                                            <span>
                                                {{ $goal->current_hours }} /
                                                {{ $goal->target_hours }}
                                                ชั่วโมง
                                            </span>
                                            <span>
                                                เหลือ
                                                {{ $goal->remaining_hours }}
                                                ชั่วโมง
                                            </span>
                                        </div>
                                        <div
                                            class="h-2 w-full rounded-full bg-gray-200"
                                        >
                                            <div
                                                class="h-2 rounded-full bg-red-600 transition-all duration-300"
                                                style="
                                                    width: {{ min(100, $goal->progress_percentage) }}%;
                                                "
                                            ></div>
                                        </div>
                                    </div>

                                    <!-- Goal Info -->
                                    <div
                                        class="mb-4 flex justify-between text-sm text-gray-600"
                                    >
                                        <span class="flex items-center">
                                            <svg
                                                class="mr-1 h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                ></path>
                                            </svg>
                                            เหลือ {{ $goal->days_remaining }}
                                            วัน
                                        </span>
                                        @if ($goal->category)
                                            <span
                                                class="rounded bg-gray-100 px-2 py-1 text-xs"
                                            >
                                                {{ $goal->category }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex gap-2">
                                        <a
                                            href="{{ route("goals.show", $goal) }}"
                                            class="flex-1 rounded-lg bg-gray-100 px-4 py-2 text-center text-gray-700 transition-colors duration-200 hover:bg-gray-200"
                                        >
                                            ดูรายละเอียด
                                        </a>
                                        <a
                                            href="{{ route("goals.edit", $goal) }}"
                                            class="rounded-lg bg-red-600 px-4 py-2 text-white transition-colors duration-200 hover:bg-red-700"
                                        >
                                            แก้ไข
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Overdue Goals -->
            @if ($overdueGoals->count() > 0)
                <div class="mb-8">
                    <h2
                        class="mb-6 flex items-center text-2xl font-bold text-red-600"
                    >
                        <svg
                            class="mr-2 h-6 w-6 text-red-600"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        เป้าหมายที่หมดเวลาแล้ว
                    </h2>
                    <div
                        class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                    >
                        @foreach ($overdueGoals as $goal)
                            <div
                                class="overflow-hidden rounded-xl bg-red-50 shadow-md transition-shadow duration-300 hover:shadow-lg"
                            >
                                <div class="p-6">
                                    <div
                                        class="mb-4 flex items-start justify-between"
                                    >
                                        <div>
                                            <h3
                                                class="text-lg font-semibold text-red-900"
                                            >
                                                {{ $goal->description ?? "เป้าหมาย" . $goal->target_hours . " ชั่วโมง" }}
                                            </h3>
                                            <p
                                                class="mt-1 text-sm text-red-600"
                                            >
                                                หมดเวลา:
                                                {{ \Carbon\Carbon::parse($goal->end_date)->format("d M Y") }}
                                            </p>
                                        </div>
                                        <span
                                            class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-800"
                                        >
                                            {{ number_format($goal->progress_percentage, 1) }}%
                                        </span>
                                    </div>

                                    <div class="mb-4">
                                        <div
                                            class="mb-2 flex justify-between text-sm text-red-700"
                                        >
                                            <span>
                                                {{ $goal->current_hours }} /
                                                {{ $goal->target_hours }}
                                                ชั่วโมง
                                            </span>
                                            <span>
                                                ขาด
                                                {{ $goal->remaining_hours }}
                                                ชั่วโมง
                                            </span>
                                        </div>
                                        <div
                                            class="h-2 w-full rounded-full bg-red-200"
                                        >
                                            <div
                                                class="h-2 rounded-full bg-red-500"
                                                style="
                                                    width: {{ min(100, $goal->progress_percentage) }}%;
                                                "
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="flex gap-2">
                                        <a
                                            href="{{ route("goals.show", $goal) }}"
                                            class="flex-1 rounded-lg bg-red-100 px-4 py-2 text-center text-red-700 transition-colors duration-200 hover:bg-red-200"
                                        >
                                            ดูรายละเอียด
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($completedGoals->count() > 0)
                <div class="mb-8">
                    <h2
                        class="mb-6 flex items-center text-2xl font-bold text-green-600"
                    >
                        <svg
                            class="mr-2 h-6 w-6 text-green-600"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        เป้าหมายที่บรรลุแล้ว
                    </h2>
                    <div
                        class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3"
                    >
                        @foreach ($completedGoals as $goal)
                            <div
                                class="overflow-hidden rounded-xl bg-green-50 shadow-md transition-shadow duration-300 hover:shadow-lg"
                            >
                                <div class="p-6">
                                    <div
                                        class="mb-4 flex items-start justify-between"
                                    >
                                        <div>
                                            <h3
                                                class="text-lg font-semibold text-green-900"
                                            >
                                                {{ $goal->description ?? "เป้าหมาย" . $goal->target_hours . " ชั่วโมง" }}
                                            </h3>
                                            <p
                                                class="mt-1 text-sm text-green-600"
                                            >
                                                บรรลุเมื่อ:
                                                {{ \Carbon\Carbon::parse($goal->achieved_at)->format("d M Y") }}
                                            </p>
                                        </div>
                                        <span
                                            class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800"
                                        >
                                            สำเร็จ
                                        </span>
                                    </div>

                                    <div class="mb-4">
                                        <div
                                            class="mb-2 flex justify-between text-sm text-green-700"
                                        >
                                            <span>
                                                {{ $goal->current_hours }} /
                                                {{ $goal->target_hours }}
                                                ชั่วโมง
                                            </span>
                                            @if ($goal->current_hours > $goal->target_hours)
                                                <span>
                                                    เกิน
                                                    {{ $goal->current_hours - $goal->target_hours }}
                                                    ชั่วโมง
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="h-2 w-full rounded-full bg-green-200"
                                        >
                                            <div
                                                class="h-2 rounded-full bg-green-500"
                                                style="width: 100%"
                                            ></div>
                                        </div>
                                    </div>

                                    <a
                                        href="{{ route("goals.show", $goal) }}"
                                        class="block rounded-lg bg-green-100 px-4 py-2 text-center text-green-700 transition-colors duration-200 hover:bg-green-200"
                                    >
                                        ดูรายละเอียด
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Empty State -->
            @if ($activeGoals->count() == 0 && $completedGoals->count() == 0 && $overdueGoals->count() == 0)
                <div class="py-12 text-center">
                    <svg
                        class="mx-auto h-24 w-24 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                        ></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">
                        ยังไม่มีเป้าหมาย
                    </h3>
                    <p class="mt-2 text-gray-500">
                        เริ่มต้นโดยการสร้างเป้าหมายชั่วโมงอาสาสมัครใหม่
                    </p>
                    <div class="mt-6">
                        <a
                            href="{{ route("goals.create") }}"
                            class="inline-flex items-center rounded-lg bg-red-600 px-6 py-3 font-medium text-white transition-colors duration-200 hover:bg-red-700"
                        >
                            <svg
                                class="mr-2 h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                ></path>
                            </svg>
                            สร้างเป้าหมายแรกของคุณ
                        </a>
                    </div>
                </div>
            @endif

            @if (isset($recentActivities) && $recentActivities->count() > 0)
                <div class="mt-12">
                    <h2
                        class="mb-6 flex items-center text-2xl font-bold text-gray-900"
                    >
                        <svg
                            class="mr-3 h-6 w-6 text-blue-600"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        สถานะกิจกรรมล่าสุด
                    </h2>

                    <div
                        class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3"
                    >
                        @foreach ($recentActivities as $activity)
                            <div
                                class="rounded-xl bg-white p-6 shadow-md transition-shadow duration-300 hover:shadow-lg"
                            >
                                <div
                                    class="mb-3 flex items-start justify-between"
                                >
                                    <h3
                                        class="line-clamp-2 text-lg font-medium text-gray-900"
                                    >
                                        {{ $activity->name }}
                                    </h3>

                                    @if ($activity->status === "checked_in")
                                        <span
                                            class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800"
                                        >
                                            <svg
                                                class="mr-1 h-3 w-3"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            เช็คชื่อแล้ว
                                        </span>
                                    @elseif ($activity->status === "completed")
                                        <span
                                            class="inline-flex items-center rounded-full bg-purple-100 px-2.5 py-0.5 text-xs font-medium text-purple-800"
                                        >
                                            <svg
                                                class="mr-1 h-3 w-3"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                                />
                                            </svg>
                                            เสร็จสิ้น
                                        </span>
                                    @elseif ($activity->status === "registered")
                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                        >
                                            <svg
                                                class="mr-1 h-3 w-3"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            ลงทะเบียนแล้ว
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800"
                                        >
                                            <svg
                                                class="mr-1 h-3 w-3"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            รอดำเนินการ
                                        </span>
                                    @endif
                                </div>

                                <div class="space-y-2 text-sm text-gray-600">
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <span>ชั่วโมง:</span>
                                        <span class="font-medium">
                                            @if ($activity->checked_in)
                                                {{ $activity->actual_hours }}
                                                ชม.
                                            @else
                                                {{ $activity->total_hours }}
                                                ชม.
                                            @endif
                                        </span>
                                    </div>

                                    @if ($activity->start_time)
                                        <div
                                            class="flex items-center justify-between"
                                        >
                                            <span>วันที่:</span>
                                            <span>
                                                {{ \Carbon\Carbon::parse($activity->start_time)->format("d/m/Y") }}
                                            </span>
                                        </div>
                                    @endif

                                    @if ($activity->checked_in && $activity->checked_in_at)
                                        <div
                                            class="flex items-center justify-between"
                                        >
                                            <span>เช็คชื่อเมื่อ:</span>
                                            <span
                                                class="font-medium text-green-600"
                                            >
                                                {{ \Carbon\Carbon::parse($activity->checked_in_at)->format("d/m/Y H:i") }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </main>
    </div>

    <script>
        setInterval(function () {
            fetch('/goals/update-progress', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log('Progress updated successfully');
                    }
                })
                .catch((error) => {
                    console.error('Error updating progress:', error);
                });
        }, 300000); // 5 minutes

        // Manual update function
        async function updateProgress() {
            const btn = document.getElementById('updateBtn');
            const originalText = btn.innerHTML;

            // Show loading state
            btn.innerHTML = `
                <svg class="mr-2 h-5 w-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                กำลังอัปเดต...
            `;
            btn.disabled = true;

            try {
                const response = await fetch(
                    '{{ route("goals.updateProgress") }}',
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    },
                );

                if (response.ok) {
                    // Reload the page to show updated data
                    window.location.reload();
                } else {
                    throw new Error('Failed to update progress');
                }
            } catch (error) {
                alert('เกิดข้อผิดพลาดในการอัปเดตความคืบหน้า');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }
    </script>
@endsection
