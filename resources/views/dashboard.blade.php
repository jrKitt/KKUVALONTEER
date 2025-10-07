@extends("components/layouts/layoutAfterLogin")

@section("title")
    หน้าหลัก | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Hero Section with Status and Goal -->
            <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Current Status Card -->
                <div
                    class="flex items-center justify-center rounded-2xl bg-red-600 p-6 text-white md:p-8"
                >
                    <div class="text-center">
                        <h2 class="mb-2 text-lg font-semibold md:text-xl">
                            สถานะปัจจุบัน
                        </h2>
                        <div class="text-3xl font-bold md:text-4xl">
                            {{ $totalHours ?? 0 }} ชั่วโมง
                        </div>
                    </div>
                </div>

                <!-- Goal Progress Card -->
                @if (isset($goalProgress) && $goalProgress)
                    <div
                        class="rounded-2xl bg-gradient-to-br from-green-600 to-green-700 p-6 text-white shadow-lg"
                    >
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold md:text-xl">
                                    <svg
                                        class="mr-2 inline-block h-5 w-5"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    เป้าหมายปัจจุบัน
                                </h3>
                                <p class="mt-1 text-sm text-green-100">
                                    {{ Str::limit($goalProgress["goal"]->description ?? "เป้าหมาย " . $goalProgress["goal"]->target_hours . " ชั่วโมง", 50) }}
                                </p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold md:text-3xl">
                                    {{ $goalProgress["goal"]->current_hours }}
                                    / {{ $goalProgress["goal"]->target_hours }}
                                </div>
                                <div class="text-sm text-green-100">
                                    ชั่วโมง
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div
                                class="mb-2 text-center text-sm text-green-100"
                            >
                                {{ number_format($goalProgress["progress"], 1) }}%
                                • เหลือ {{ $goalProgress["remaining"] }}
                                ชั่วโมง
                            </div>
                            <div class="h-3 w-full rounded-full bg-green-800">
                                <div
                                    class="h-3 rounded-full bg-white transition-all duration-500"
                                    style="
                                        width: {{ min(100, $goalProgress["progress"]) }}%;
                                    "
                                ></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-xs text-green-100">
                                <svg
                                    class="mr-1 inline-block h-4 w-4"
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

                                @if ($goalProgress["days_left"] > 0)
                                    เหลือ {{ $goalProgress["days_left"] }} วัน
                                @elseif ($goalProgress["days_left"] == 0)
                                    สิ้นสุดวันนี้
                                @else
                                        หมดเวลาแล้ว
                                @endif
                            </div>
                            <a
                                href="{{ route("goals.index") }}"
                                class="rounded-lg bg-white/20 px-4 py-2 text-xs font-medium text-white transition-colors duration-200 hover:bg-white/30"
                            >
                                จัดการเป้าหมาย
                            </a>
                        </div>
                    </div>
                @else
                    <div
                        class="rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 p-6 text-center"
                    >
                        <svg
                            class="mx-auto mb-4 h-12 w-12 text-gray-400"
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
                        <h4 class="mb-2 text-lg font-medium text-gray-900">
                            ยังไม่มีเป้าหมาย
                        </h4>
                        <p class="mb-4 text-gray-600">
                            สร้างเป้าหมายชั่วโมงอาสาสมัครเพื่อติดตามความคืบหน้าของคุณ
                        </p>
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
                            สร้างเป้าหมาย
                        </a>
                    </div>
                @endif
            </div>

            <div class="mb-8 flex gap-5 max-sm:flex-col">
                <!-- Stats Cards -->
                <div class="grow rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">
                                รวมชั่วโมงทั้งหมด
                            </p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $totalHours ?? 0 }}
                            </p>
                        </div>
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
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grow rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">
                                เช็คชื่อแล้ว
                            </p>
                            <p class="text-2xl font-bold text-green-600">
                                {{ $approvedHours ?? 0 }}
                            </p>
                        </div>
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
                                    d="M5 13l4 4L19 7"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grow rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">
                                รออนุมัติ
                            </p>
                            <p class="text-2xl font-bold text-yellow-600">
                                {{ $pendingHours ?? 0 }}
                            </p>
                        </div>
                        <div class="rounded-full bg-yellow-100 p-3">
                            <svg
                                class="h-6 w-6 text-yellow-600"
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
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($recentActivities) && $recentActivities->count() > 0)
                <div class="mb-8">
                    <h3
                        class="mb-6 text-xl font-bold text-gray-900 md:text-2xl"
                    >
                        กิจกรรมที่เข้าร่วมล่าสุด
                    </h3>
                    <div
                        class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                    >
                        @foreach ($recentActivities as $activity)
                            <div
                                class="flex h-full flex-col justify-between overflow-hidden rounded-xl bg-white shadow-lg transition-shadow duration-300 hover:shadow-xl"
                            >
                                <div class="relative">
                                    @if ($activity->image_file_name)
                                        <img
                                            src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                                            alt="{{ $activity->activity_name }}"
                                            class="h-48 w-full object-cover"
                                        />
                                    @else
                                        <img
                                            src="{{ asset("images/carousel_" . (($loop->index % 3) + 1) . ".jpg") }}"
                                            alt="{{ $activity->activity_name }}"
                                            class="h-48 w-full object-cover"
                                        />
                                    @endif
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="@if ($activity->status === 'checked_in') bg-green-500 @elseif ($activity->status === 'completed') bg-purple-500 @elseif ($activity->status === 'cancelled') bg-red-500 @else bg-blue-500 @endif rounded-full px-3 py-1 text-sm font-medium text-white shadow-lg"
                                        >
                                            @if ($activity->status === "checked_in")
                                                เช็คชื่อแล้ว
                                            @elseif ($activity->status === "completed")
                                                เสร็จสิ้น
                                            @elseif ($activity->status === "cancelled")
                                                ยกเลิก
                                            @else
                                                    ลงทะเบียนแล้ว
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="flex grow flex-col p-6">
                                    <h4
                                        class="mb-3 text-lg leading-tight font-bold text-gray-900"
                                    >
                                        {{ $activity->activity_name }}
                                    </h4>

                                    <div
                                        class="mb-4 flex flex-wrap items-center gap-2"
                                    >
                                        @if (isset($activity->tags) && is_array($activity->tags))
                                            @foreach (array_slice($activity->tags, 0, 3) as $tag)
                                                <span
                                                    class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800"
                                                >
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span
                                                class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800"
                                            >
                                                #กิจกรรมอาสา
                                            </span>
                                        @endif
                                    </div>

                                    @if ($activity->description)
                                        <p
                                            class="mb-4 text-sm leading-relaxed text-gray-600"
                                        >
                                            {{ Str::limit($activity->description, 80) }}
                                        </p>
                                    @endif

                                    <div class="mb-4 space-y-2">
                                        <div
                                            class="flex items-center text-sm text-gray-500"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            {{ $activity->location ?? "มหาวิทยาลัยขอนแก่น" }}
                                        </div>
                                        <div
                                            class="flex items-center text-sm text-gray-500"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            {{ $activity->date->format("d M Y") }}
                                        </div>
                                        <div
                                            class="flex items-center text-sm text-gray-500"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            {{ $activity->hours }} ชั่วโมง
                                        </div>
                                    </div>
                                </div>

                                <div class="m-4 flex gap-2">
                                    <a
                                        href="{{ route("activity.detail", $activity->id) }}"
                                        class="flex-1 cursor-pointer rounded-lg bg-blue-600 px-4 py-2 text-center font-medium text-white transition-all hover:bg-blue-700 active:scale-90"
                                    >
                                        ดูรายละเอียด
                                    </a>
                                    @if ($activity->status === "registered")
                                        <button
                                            class="cursor-pointer rounded-lg border border-red-600 px-4 py-2 font-medium text-red-600 transition-all hover:bg-red-50 active:scale-90"
                                            onclick="cancelRegistration({{ $activity->id }})"
                                        >
                                            ยกเลิก
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <hr class="my-8 text-gray-400" />

            <section class="mb-8">
                <h3 class="mb-6 text-xl font-bold text-gray-900 md:text-2xl">
                    กิจกรรมแนะนำ
                </h3>
                <div
                    class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                >
                    @foreach ($upcomingEvents as $event)
                        <div
                            class="overflow-hidden rounded-xl bg-white shadow-lg transition-shadow duration-300 hover:shadow-xl"
                        >
                            <div class="relative">
                                <img
                                    src="{{ asset($event["image"]) }}"
                                    alt="{{ $event["title"] }}"
                                    class="h-48 w-full object-cover"
                                />
                                @if ($event["is_registered"])
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="rounded-full bg-green-500 px-3 py-1 text-sm font-medium text-white shadow-lg"
                                        >
                                            สมัครแล้ว
                                        </span>
                                    </div>
                                @elseif ($event["is_full"])
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="rounded-full bg-red-500 px-3 py-1 text-sm font-medium text-white shadow-lg"
                                        >
                                            เต็มแล้ว
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h4
                                    class="mb-3 text-lg leading-tight font-bold text-gray-900"
                                >
                                    {{ $event["title"] }}
                                </h4>

                                <div class="mb-4 flex items-center gap-2">
                                    @foreach ($event["tags"] as $tag)
                                        <span
                                            class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800"
                                        >
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>

                                <p
                                    class="mb-4 text-sm leading-relaxed text-gray-600"
                                >
                                    {{ Str::limit($event["description"] ?? "ไม่มีรายละเอียด", 80) }}
                                </p>

                                <div class="mb-4 space-y-2">
                                    <div
                                        class="flex items-center text-sm text-gray-500"
                                    >
                                        <svg
                                            class="mr-2 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        {{ $event["location"] }}
                                    </div>
                                    <div
                                        class="flex items-center text-sm text-gray-500"
                                    >
                                        <svg
                                            class="mr-2 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        {{ $event["date"] }}
                                    </div>
                                    <div
                                        class="flex items-center text-sm text-gray-500"
                                    >
                                        <svg
                                            class="mr-2 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        {{ $event["hours"] }}
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    @if ($event["is_registered"])
                                        <button
                                            class="flex-1 cursor-not-allowed rounded-lg bg-green-500 px-4 py-2 text-center font-medium text-white"
                                            disabled
                                        >
                                            สมัครแล้ว
                                        </button>
                                    @elseif ($event["is_full"])
                                        <button
                                            class="flex-1 cursor-not-allowed rounded-lg bg-red-500 px-4 py-2 text-center font-medium text-white"
                                            disabled
                                        >
                                            เต็มแล้ว
                                        </button>
                                    @elseif ($event["can_register"])
                                        <button
                                            class="flex-1 cursor-pointer rounded-lg bg-cyan-400 px-4 py-2 text-center font-medium text-white transition-all hover:bg-cyan-500 active:scale-90"
                                            onclick="registerForActivity({{ $event["id"] }}, '{{ $event["title"] }}')"
                                        >
                                            สมัครเลย
                                        </button>
                                    @else
                                        <button
                                            class="flex-1 cursor-not-allowed rounded-lg bg-gray-400 px-4 py-2 text-center font-medium text-white"
                                            disabled
                                        >
                                            ปิดรับสมัคร
                                        </button>
                                    @endif
                                    <a
                                        href="{{ route("activity.detail", $event["id"]) }}"
                                        class="cursor-pointer rounded-lg border border-cyan-400 px-4 py-2 font-medium text-cyan-600 transition-all hover:bg-cyan-50 active:scale-90"
                                    >
                                        ดูรายละเอียด
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
@endsection

@push("scripts")
    <script>
        function registerForActivity(activityId, activityName) {
            if (!confirm(`คุณต้องการสมัครกิจกรรม "${activityName}" หรือไม่?`)) {
                return;
            }

            fetch('/activities/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
                body: JSON.stringify({
                    activity_id: activityId,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('ลงทะเบียนสำเร็จ!');
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
                });
        }

        function cancelRegistration(activityId) {
            if (!confirm('คุณต้องการยกเลิกการสมัครกิจกรรมนี้หรือไม่?')) {
                return;
            }

            fetch('/activities/cancel', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
                body: JSON.stringify({
                    activity_id: activityId,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('ยกเลิกการสมัครสำเร็จ!');
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
                });
        }
    </script>
@endpush
