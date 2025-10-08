@extends("components/layouts/layoutAfterLogin")

@section("title")
    รายละเอียดกิจกรรม | KKU VOLUNTEER
@endsection

@push("head")
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <div class="mx-auto max-w-4xl px-4 py-8">
            <!-- Header -->
            <div class="mb-6 rounded-lg bg-white p-6 shadow-sm">
                <div
                    class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
                >
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $activity->name_th }}
                    </h1>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">ผู้เข้าร่วม:</span>
                        <div
                            class="{{ ($activity->participants_count ?? 0) >= $activity->accept_amount ? "bg-red-100 text-red-800" : "bg-green-100 text-green-800" }} inline-flex items-center rounded-full px-3 py-1 text-sm font-medium"
                        >
                            {{ $activity->participants_count ?? 0 }}/{{ $activity->accept_amount }}
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                @if ($activity->tags && is_array($activity->tags) && count($activity->tags) > 0)
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($activity->tags as $tag)
                            <span
                                class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-800"
                            >
                                #{{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Image & Content -->
            <div class="mb-6 flex flex-col gap-8">
                <!-- Image -->
                <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                    @if ($activity->image_file_name)
                        <img
                            src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                            alt="{{ $activity->name_th }}"
                            class="h-64 w-full object-cover"
                        />
                    @else
                        <img
                            src="{{ asset("images/family.png") }}"
                            alt="{{ $activity->name_th }}"
                            class="h-64 w-full object-cover"
                        />
                    @endif
                </div>

                <!-- Details -->
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">
                        รายละเอียดกิจกรรม
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-600">
                            <i
                                class="fa-solid fa-location-dot mr-3 w-5 text-blue-500"
                            ></i>
                            <span>
                                {{ $activity->location ?: "ไม่ระบุสถานที่" }}
                            </span>
                        </div>

                        <div class="flex items-center text-gray-600">
                            <i
                                class="fa-solid fa-clock mr-3 w-5 text-green-500"
                            ></i>
                            <span>
                                {{ $activity->total_hour ?? 0 }} ชั่วโมง
                            </span>
                        </div>

                        <div class="flex items-center text-gray-600">
                            <i
                                class="fa-solid fa-calendar-days mr-3 w-5 text-purple-500"
                            ></i>
                            <span>
                                {{ $activity->start_time ? $activity->start_time->format("d M Y") : "ไม่ระบุวันที่" }}
                            </span>
                        </div>
                    </div>

                    @if ($activity->description)
                        <div>
                            <ul class="text-md ml-8 list-disc">
                                @foreach (preg_split("/\r\n|\n|\r/", $activity->description) as $point)
                                    @if (trim($point))
                                        <li>{{ trim($point) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mb-8 rounded-lg bg-white p-6 shadow-sm">
                <div class="flex flex-col justify-center gap-3 sm:flex-row">
                    @if (isset($activity->is_registered) && $activity->is_registered)
                        <button
                            type="button"
                            class="cursor-not-allowed rounded-lg bg-green-500 px-8 py-3 font-medium text-white"
                            disabled
                        >
                            ✓ สมัครแล้ว
                        </button>
                    @elseif (($activity->participants_count ?? 0) >= $activity->accept_amount)
                        <button
                            type="button"
                            class="cursor-not-allowed rounded-lg bg-red-500 px-8 py-3 font-medium text-white"
                            disabled
                        >
                            เต็มแล้ว
                        </button>
                    @elseif ($activity->status === "pending" || $activity->status === "ongoing")
                        @auth
                            <button
                                type="button"
                                class="cursor-pointer rounded-md bg-cyan-400 px-10 py-2 text-lg text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90"
                                onclick="registerForActivity({{ $activity->id }}, '{{ $activity->name_th }}')"
                            >
                                สมัครเข้าร่วม
                            </button>
                        @else
                            <a
                                href="{{ route("login") }}"
                                class="inline-block cursor-pointer rounded-md bg-cyan-400 px-10 py-2 text-center text-lg text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90"
                            >
                                เข้าสู่ระบบเพื่อสมัคร
                            </a>
                        @endauth
                    @else
                        <button
                            type="button"
                            class="cursor-not-allowed rounded-lg bg-gray-400 px-8 py-3 font-medium text-white"
                            disabled
                        >
                            ปิดการสมัคร
                        </button>
                    @endif
                    <button
                        type="button"
                        class="cursor-pointer rounded-md border border-blue-300 px-10 py-2 text-lg text-blue-300 shadow-lg transition-all hover:bg-blue-300 hover:text-white active:scale-90"
                        onclick="window.history.back()"
                    >
                        กลับ
                    </button>
                </div>
            </div>

            <!-- Other activity -->
            <div>
                <h1 class="mt-5 text-4xl font-bold">กิจกรรมอื่นๆ</h1>
                <div
                    class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
                >
                    @php
                        $otherActivities = App\Models\Activity::where("id", "!=", $activity->id)
                            ->orderBy("created_at", "desc")
                            ->limit(4)
                            ->get();
                    @endphp

                    @foreach ($otherActivities as $otherActivity)
                        <div
                            class="overflow-hidden rounded-lg border border-gray-200 transition-shadow hover:shadow-md"
                        >
                            <!-- Image -->
                            <div class="h-48 overflow-hidden">
                                @if ($otherActivity->image_file_name)
                                    <img
                                        src="{{ asset("uploads/activities/" . $otherActivity->image_file_name) }}"
                                        alt="{{ $otherActivity->name_th }}"
                                        class="h-full w-full object-cover"
                                    />
                                @else
                                    <img
                                        src="{{ asset("images/family.png") }}"
                                        alt="{{ $otherActivity->name_th }}"
                                        class="h-full w-full object-cover"
                                    />
                                @endif
                            </div>

                            <!-- Content -->
                            <div
                                class="flex h-full flex-col justify-between p-4"
                            >
                                <div>
                                    <h3
                                        class="mb-2 line-clamp-2 font-medium text-gray-900"
                                    >
                                        {{ $otherActivity->name_th }}
                                    </h3>

                                    <!-- Tags -->
                                    @if ($otherActivity->tags && is_array($otherActivity->tags) && count($otherActivity->tags) > 0)
                                        <div class="mb-3 flex flex-wrap gap-1">
                                            @foreach (array_slice($otherActivity->tags, 0, 2) as $tag)
                                                <span
                                                    class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800"
                                                >
                                                    #{{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Info -->
                                    <div
                                        class="mt-2 line-clamp-3 text-xs text-gray-500"
                                    >
                                        {{ Str::limit($otherActivity->description ?: "ไม่มีรายละเอียด") }}
                                    </div>

                                    <div
                                        class="mt-3 grid grid-cols-2 text-xs text-gray-600"
                                    >
                                        <div class="flex items-center">
                                            <i
                                                class="fa-solid fa-location-dot mr-2 w-4"
                                            ></i>
                                            {{ Str::limit($otherActivity->location ?: "ไม่ระบุ", 20) }}
                                        </div>
                                        <div class="flex items-center">
                                            <i
                                                class="fa-solid fa-clock mr-2 w-4"
                                            ></i>
                                            {{ $otherActivity->total_hour ?? 0 }}
                                            ชั่วโมง
                                        </div>
                                        <div class="flex items-center">
                                            <i
                                                class="fa-solid fa-calendar-days mr-2 w-4"
                                            ></i>
                                            {{ $otherActivity->start_time ? $otherActivity->start_time->format("d M Y") : "ไม่ระบุ" }}
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-3 flex justify-end space-x-3 px-1 py-1 text-xs text-nowrap"
                                >
                                    @php
                                        $otherActivity->participants_count = App\Models\ActivityParticipant::where(
                                            "activity_id",
                                            $otherActivity->id,
                                        )->count();
                                        $otherActivity->is_registered = auth()->check()
                                            ? App\Models\ActivityParticipant::where("activity_id", $otherActivity->id)
                                                ->where("user_id", auth()->id())
                                                ->exists()
                                            : false;
                                    @endphp

                                    @if ($otherActivity->is_registered)
                                        <button
                                            type="button"
                                            class="flex-1 cursor-not-allowed rounded bg-green-500 px-3 py-2 text-sm text-white"
                                            disabled
                                        >
                                            ✓ สมัครแล้ว
                                        </button>
                                    @elseif ($otherActivity->participants_count >= $otherActivity->accept_amount)
                                        <button
                                            type="button"
                                            class="flex-1 cursor-not-allowed rounded bg-red-500 px-3 py-2 text-sm text-white"
                                            disabled
                                        >
                                            เต็มแล้ว
                                        </button>
                                    @elseif ($otherActivity->status === "pending" || $otherActivity->status === "ongoing")
                                        @auth
                                            <button
                                                type="button"
                                                class="cursor-pointer rounded-md bg-cyan-400 px-6 py-1 text-lg text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90"
                                                onclick="registerForActivity({{ $otherActivity->id }}, '{{ $otherActivity->name_th }}')"
                                            >
                                                สมัคร
                                            </button>
                                        @else
                                            <a
                                                href="{{ route("login") }}"
                                                class="inline-block cursor-pointer rounded-md bg-cyan-400 px-6 py-1 text-center text-lg text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90"
                                            >
                                                เข้าสู่ระบบ
                                            </a>
                                        @endauth
                                    @else
                                        <button
                                            type="button"
                                            class="flex-1 cursor-not-allowed rounded bg-gray-400 px-3 py-2 text-sm text-white"
                                            disabled
                                        >
                                            ปิดสมัคร
                                        </button>
                                    @endif

                                    <button
                                        type="button"
                                        class="cursor-pointer rounded-md border border-blue-300 px-6 py-1 text-lg text-blue-300 shadow-lg transition-all hover:bg-blue-200 hover:text-white active:scale-90"
                                        onclick="window.location.href='/detail/{{ $otherActivity->id }}'"
                                    >
                                        ดูเพิ่ม
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        function showAlert(type, title, message) {
            const alertId = 'alert-' + type + '-' + Date.now();
            const alertHTML = `
                <div id="${alertId}" role="alert" class="alert-modern alert-${type}-modern fixed top-6 right-6 z-[9999] min-w-80 max-w-96" style="opacity: 0; transform: translateX(100%);">
                    <div class="flex items-center p-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-${type === 'success' ? 'green' : type === 'error' ? 'red' : 'blue'}-500 rounded-full flex items-center justify-center shadow-lg">
                                ${
                                    type === 'success'
                                        ? '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'
                                        : '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>'
                                }
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-semibold text-${type === 'success' ? 'green' : type === 'error' ? 'red' : 'blue'}-800">${title}</p>
                            <p class="text-sm text-${type === 'success' ? 'green' : type === 'error' ? 'red' : 'blue'}-700">${message}</p>
                        </div>
                        <button type="button" class="flex-shrink-0 ml-4 text-${type === 'success' ? 'green' : type === 'error' ? 'red' : 'blue'}-400 hover:text-${type === 'success' ? 'green' : type === 'error' ? 'red' : 'blue'}-600 transition-colors duration-200" onclick="closeAlert('${alertId}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', alertHTML);
            const alertElement = document.getElementById(alertId);

            setTimeout(() => {
                alertElement.style.opacity = '1';
                alertElement.style.transform = 'translateX(0)';
                alertElement.style.transition =
                    'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            }, 100);

            setTimeout(() => {
                closeAlert(alertId);
            }, 5000);
        }

        function closeAlert(alertId) {
            const alertElement = document.getElementById(alertId);
            if (alertElement) {
                alertElement.style.transform = 'translateX(100%)';
                alertElement.style.opacity = '0';
                setTimeout(() => {
                    if (alertElement.parentNode) {
                        alertElement.remove();
                    }
                }, 300);
            }
        }

        function registerForActivity(activityId, activityName) {
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'กำลังสมัคร...';
            button.disabled = true;

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
                .then((response) => {
                    // Check if response is redirecting (usually means not authenticated)
                    if (response.redirected) {
                        window.location.href = response.url;
                        return;
                    }

                    if (!response.ok) {
                        throw new Error(
                            `HTTP error! status: ${response.status}`,
                        );
                    }

                    return response.json();
                })
                .then((data) => {
                    if (data && data.success) {
                        showAlert(
                            'success',
                            'ลงทะเบียนสำเร็จ!',
                            `คุณได้สมัครเข้าร่วมกิจกรรม "${activityName}" เรียบร้อยแล้ว`,
                        );

                        // Reload the page to update registration status
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);

                        return;
                    } else if (data && data.message) {
                        showAlert('error', 'เกิดข้อผิดพลาด!', data.message);
                    } else {
                        showAlert(
                            'error',
                            'เกิดข้อผิดพลาด!',
                            'ไม่สามารถลงทะเบียนได้',
                        );
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    showAlert(
                        'error',
                        'เกิดข้อผิดพลาด!',
                        'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้ กรุณาตรวจสอบการเชื่อมต่อและลองใหม่',
                    );
                })
                .finally(() => {
                    if (button.textContent === 'กำลังสมัคร...') {
                        button.textContent = originalText;
                        button.disabled = false;
                    }
                });
        }
    </script>

    <style>
        .alert-modern {
            background: white;
            border-radius: 12px;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(8px);
        }

        .alert-success-modern {
            border-left: 4px solid #10b981;
        }

        .alert-error-modern {
            border-left: 4px solid #ef4444;
        }

        .alert-info-modern {
            border-left: 4px solid #3b82f6;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
