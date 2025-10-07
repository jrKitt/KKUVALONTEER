@extends("components/layouts/layoutAfterLogin")

@section("title", "รายละเอียดเป้าหมาย")

@section("layout-content")
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    รายละเอียดเป้าหมาย
                </h1>
                <p class="mt-2 text-gray-600">
                    ติดตามความคืบหน้าและรายละเอียดของเป้าหมาย
                </p>
            </div>
            <div class="flex gap-2">
                <a
                    href="{{ route("goals.edit", $goal) }}"
                    class="btn btn-outline btn-sm"
                >
                    <svg
                        class="mr-2 h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                        />
                    </svg>
                    แก้ไข
                </a>
                <a
                    href="{{ route("goals.index") }}"
                    class="btn btn-outline btn-sm"
                >
                    <svg
                        class="mr-2 h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>
                    กลับ
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Goal Details -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Goal Info Card -->
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="mb-4 flex items-start justify-between">
                        <div>
                            <h2
                                class="mb-2 text-xl font-semibold text-gray-900"
                            >
                                ข้อมูลเป้าหมาย
                            </h2>
                            <div
                                class="flex items-center space-x-4 text-sm text-gray-600"
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
                                            d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h8m-8 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"
                                        />
                                    </svg>
                                    {{
                                        collect([
                                            "personal" => "เป้าหมายส่วนตัว",
                                            "academic" => "เป้าหมายตามหลักสูตร",
                                            "faculty" => "เป้าหมายตามคณะ",
                                            "custom" => "เป้าหมายกำหนดเอง",
                                        ])->get($goal->goal_type, $goal->goal_type)
                                    }}
                                </span>
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
                                        />
                                    </svg>
                                    {{
                                        collect([
                                            "academic_year" => "ปีการศึกษา",
                                            "semester" => "ภาคเรียน",
                                            "monthly" => "รายเดือน",
                                            "custom" => "กำหนดเอง",
                                        ])->get($goal->period_type, $goal->period_type)
                                    }}
                                </span>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        @if ($goal->is_achieved)
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
                                สำเร็จแล้ว
                            </span>
                        @elseif ($goal->is_overdue)
                            <span
                                class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800"
                            >
                                <svg
                                    class="mr-1 h-3 w-3"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                เกินกำหนด
                            </span>
                        @else
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
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                กำลังดำเนินการ
                            </span>
                        @endif
                    </div>

                    <!-- Date Range -->
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="mb-1 block text-sm font-medium text-gray-500"
                            >
                                วันที่เริ่มต้น
                            </label>
                            <p class="text-gray-900">
                                {{ $goal->start_date->format("d/m/Y") }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="mb-1 block text-sm font-medium text-gray-500"
                            >
                                วันที่สิ้นสุด
                            </label>
                            <p class="text-gray-900">
                                {{ $goal->end_date->format("d/m/Y") }}
                            </p>
                        </div>
                    </div>

                    <!-- Category -->
                    @if ($goal->category)
                        <div class="mb-4">
                            <label
                                class="mb-1 block text-sm font-medium text-gray-500"
                            >
                                หมวดหมู่
                            </label>
                            <p class="text-gray-900">
                                {{
                                    collect([
                                        "academic" => "กิจกรรมวิชาการ",
                                        "social_service" => "บริการสังคม",
                                        "sports" => "กีฬา",
                                        "cultural" => "ศิลปวัฒนธรรม",
                                        "environment" => "สิ่งแวดล้อม",
                                        "other" => "อื่นๆ",
                                    ])->get($goal->category, $goal->category)
                                }}
                            </p>
                        </div>
                    @endif

                    <!-- Description -->
                    @if ($goal->description)
                        <div>
                            <label
                                class="mb-1 block text-sm font-medium text-gray-500"
                            >
                                รายละเอียด
                            </label>
                            <p class="leading-relaxed text-gray-900">
                                {{ $goal->description }}
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Progress History -->
                @if ($relatedHours->count() > 0)
                    <div class="rounded-xl bg-white p-6 shadow-md">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900">
                            ประวัติการทำกิจกรรม
                        </h3>
                        <div class="space-y-4">
                            @foreach ($relatedHours as $hour)
                                <div
                                    class="flex items-start space-x-4 rounded-lg bg-gray-50 p-4"
                                >
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100"
                                        >
                                            <svg
                                                class="h-5 w-5 text-blue-600"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div
                                            class="flex items-center justify-between"
                                        >
                                            <p
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{ $hour->activity_name }}
                                            </p>
                                            <span
                                                class="text-sm font-semibold text-blue-600"
                                            >
                                                +{{ $hour->hours }} ชั่วโมง
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500">
                                            {{ $hour->date->format("d/m/Y") }}
                                        </p>
                                        @if ($hour->description)
                                            <p
                                                class="mt-1 text-sm text-gray-600"
                                            >
                                                {{ $hour->description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Progress Sidebar -->
            <div class="space-y-6">
                <!-- Progress Card -->
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">
                        ความคืบหน้า
                    </h3>

                    <!-- Progress Circle or Bar -->
                    <div class="mb-4 text-center">
                        <div
                            class="relative mb-4 inline-flex h-32 w-32 items-center justify-center"
                        >
                            <svg
                                class="h-32 w-32 -rotate-90 transform"
                                viewBox="0 0 36 36"
                            >
                                <path
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    fill="none"
                                    stroke="#e5e7eb"
                                    stroke-width="2"
                                />
                                <path
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                    fill="none"
                                    stroke="#3b82f6"
                                    stroke-width="2"
                                    stroke-dasharray="{{ min($goal->progress_percentage, 100) }}, 100"
                                />
                            </svg>
                            <div
                                class="absolute inset-0 flex items-center justify-center"
                            >
                                <div class="text-center">
                                    <div
                                        class="text-2xl font-bold text-gray-900"
                                    >
                                        {{ number_format($goal->progress_percentage, 0) }}%
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        เสร็จสิ้น
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hours Display -->
                    <div class="mb-4 text-center">
                        <div class="text-3xl font-bold text-gray-900">
                            {{ $goal->current_hours }}
                        </div>
                        <div class="text-sm text-gray-500">
                            จาก {{ $goal->target_hours }} ชั่วโมง
                        </div>
                    </div>

                    <!-- Time Remaining -->
                    <div class="text-center">
                        @php
                            $daysLeft = $goal->days_remaining;
                        @endphp

                        @if ($goal->is_achieved)
                            <div
                                class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800"
                            >
                                <svg
                                    class="mr-1 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                เป้าหมายสำเร็จแล้ว!
                            </div>
                        @elseif ($daysLeft > 0)
                            <div class="text-sm text-gray-600">
                                เหลือเวลาอีก
                                <span class="font-semibold text-blue-600">
                                    {{ $daysLeft }} วัน
                                </span>
                            </div>
                        @else
                            <div
                                class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-800"
                            >
                                <svg
                                    class="mr-1 h-4 w-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                เกินกำหนดแล้ว
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">
                        สถิติด่วน
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                ชั่วโมงคงเหลือ
                            </span>
                            <span class="font-semibold text-gray-900">
                                {{ max(0, $goal->target_hours - $goal->current_hours) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                จำนวนกิจกรรม
                            </span>
                            <span class="font-semibold text-gray-900">
                                {{ $relatedHours->count() }}
                            </span>
                        </div>
                        @if ($daysLeft > 0 && ! $goal->is_achieved)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">
                                    ชั่วโมง/วัน (เฉลี่ย)
                                </span>
                                <span class="font-semibold text-orange-600">
                                    {{ number_format(max(0, $goal->target_hours - $goal->current_hours) / $daysLeft, 1) }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">
                        การจัดการ
                    </h3>
                    <div class="space-y-3">
                        <a
                            href="{{ route("goals.edit", $goal) }}"
                            class="btn btn-outline btn-sm w-full"
                        >
                            <svg
                                class="mr-2 h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                />
                            </svg>
                            แก้ไขเป้าหมาย
                        </a>

                        <form
                            action="{{ route("goals.destroy", $goal) }}"
                            method="POST"
                            onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบเป้าหมายนี้?')"
                        >
                            @csrf
                            @method("DELETE")
                            <button
                                type="submit"
                                class="btn btn-outline btn-error btn-sm w-full"
                            >
                                <svg
                                    class="mr-2 h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    />
                                </svg>
                                ลบเป้าหมาย
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
