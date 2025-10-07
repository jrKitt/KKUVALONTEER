@extends("components/layouts/layoutAfterLogin")

@section("title")
    รายละเอียดกิจกรรม | KKU VOLUNTEER
@endsection

@push("head")
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section("layout-content")
    @include("components.alert")
    <div class="min-h-screen bg-gray-50">
        <section class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Main -->
            <main class="px-10 text-gray-600">
                <div
                    class="mt-10 flex flex-wrap items-center justify-between gap-2 gap-y-4"
                >
                    <h2 class="text-5xl font-bold">
                        {{ $activity->name_th }}
                    </h2>
                    <div
                        class="{{ ($activity->participants_count ?? 0) >= $activity->accept_amount ? "bg-red-200" : "bg-green-200" }} {{ ($activity->participants_count ?? 0) >= $activity->accept_amount ? "text-red-600" : "text-green-600" }} rounded-md px-4 py-2 text-5xl font-bold"
                    >
                        <span class="">
                            {{ $activity->participants_count ?? 0 }}
                        </span>
                        <span class="">/</span>
                        <span class="">{{ $activity->accept_amount }}</span>
                    </div>
                </div>
                <div class="">
                    @if ($activity->image_file_name)
                        <img
                            src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                            alt="{{ $activity->name_th }}"
                            class="mt-10 rounded-md object-cover"
                        />
                    @else
                        <img
                            src="{{ asset("images/family.png") }}"
                            alt="{{ $activity->name_th }}"
                            class="mt-10 rounded-md object-cover"
                        />
                    @endif
                </div>
                <nav class="mt-5 text-lg">
                    <div>{{ $activity->name_th }}</div>

                    @if ($activity->tags && is_array($activity->tags))
                        <div class="mt-2 mb-3 flex flex-wrap gap-2">
                            @foreach ($activity->tags as $tag)
                                <span
                                    class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm text-green-800"
                                >
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    @if ($activity->description)
                        <div>
                            <ul class="ml-8 list-disc">
                                @foreach (explode(".", $activity->description) as $point)
                                    @if (trim($point))
                                        <li>{{ trim($point) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </nav>

                <!-- Detail -->
                <div>
                    <h2 class="mt-2 text-2xl font-bold text-gray-900">
                        รายละเอียด
                    </h2>
                    <div class="text-gray-700">
                        {{ $activity->description ?: "ไม่มีรายละเอียด" }}
                    </div>
                </div>

                <nav class="grid grid-cols-2 p-5 md:grid-cols-2">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>
                            {{ $activity->location ?: "ไม่ระบุสถานที่" }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-clock"></i>
                        {{ $activity->total_hour ?? 0 }}
                        <span>ชั่วโมง</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar-days"></i>
                        {{ $activity->start_time ? $activity->start_time->format("d M Y") : "ไม่ระบุวันที่" }}
                    </div>
                </nav>

                <div class="flex justify-end space-x-4 px-4 py-4">
                    @if (isset($activity->is_registered) && $activity->is_registered)
                        <button
                            type="button"
                            class="cursor-not-allowed rounded-md bg-green-500 px-10 py-2 text-lg text-white shadow-lg"
                            disabled
                        >
                            สมัครแล้ว
                        </button>
                    @elseif (($activity->participants_count ?? 0) >= $activity->accept_amount)
                        <button
                            type="button"
                            class="cursor-not-allowed rounded-md bg-red-500 px-10 py-2 text-lg text-white shadow-lg"
                            disabled
                        >
                            เต็มแล้ว
                        </button>
                    @elseif ($activity->status === "pending" || $activity->status === "ongoing")
                        <button
                            type="button"
                            class="rounded-md bg-blue-400 px-10 py-2 text-lg text-white shadow-lg hover:bg-blue-600"
                            onclick="registerForActivity({{ $activity->id }}, '{{ $activity->name_th }}')"
                        >
                            สมัครเข้าร่วม
                        </button>
                    @else
                        <button
                            type="button"
                            class="cursor-not-allowed rounded-md bg-gray-400 px-10 py-2 text-lg text-white shadow-lg"
                            disabled
                        >
                            ปิดการสมัคร
                        </button>
                    @endif
                    <button
                        type="button"
                        class="rounded-md border border-blue-300 px-10 py-2 text-lg text-blue-300 shadow-lg hover:bg-blue-200 hover:text-white"
                        onclick="window.history.back()"
                    >
                        กลับ
                    </button>
                </div>
                <hr class="my-2 border-gray-300" />

                <!-- Other activity -->
                <div>
                    <h1 class="mt-5 text-4xl font-bold">กิจกรรมอื่นๆ</h1>
                    <div
                        class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                    >
                        @php
                            $otherActivities = App\Models\Activity::where("id", "!=", $activity->id)
                                ->orderBy("created_at", "desc")
                                ->limit(4)
                                ->get();
                        @endphp

                        @foreach ($otherActivities as $otherActivity)
                            <div
                                class="mr-3 flex flex-col rounded-md border border-gray-300 p-5 shadow-xl"
                            >
                                <div
                                    class="h-40 overflow-hidden rounded-md sm:h-48 md:h-40"
                                >
                                    @if ($otherActivity->image_file_name)
                                        <img
                                            src="{{ asset("uploads/activities/" . $otherActivity->image_file_name) }}"
                                            alt="{{ $otherActivity->name_th }}"
                                            class="h-full w-full object-cover"
                                        />
                                    @else
                                        <img
                                            src="{{ asset("images/family.png") }}"
                                            alt=""
                                            class="h-full w-full object-cover"
                                        />
                                    @endif
                                </div>

                                <h1 class="mt-2 text-lg">
                                    {{ $otherActivity->name_th }}
                                </h1>

                                <div class="mt-2 flex flex-row gap-2 text-xs">
                                    @if ($otherActivity->tags && is_array($otherActivity->tags))
                                        @foreach (array_slice($otherActivity->tags, 0, 2) as $tag)
                                            <button
                                                class="rounded-full bg-blue-500 px-2 py-1 text-white"
                                            >
                                                #{{ $tag }}
                                            </button>
                                        @endforeach
                                    @else
                                        <button
                                            class="rounded-full bg-green-500 px-2 py-1 text-white"
                                        >
                                            #กิจกรรม
                                        </button>
                                        <button
                                            class="rounded-full bg-gray-400 px-2 py-1 text-white"
                                        >
                                            #จิตอาสา
                                        </button>
                                    @endif
                                </div>

                                <div
                                    class="mt-2 line-clamp-3 flex flex-grow text-xs text-gray-500"
                                >
                                    {{ Str::limit($otherActivity->description ?: "ไม่มีรายละเอียด", 150) }}
                                </div>

                                <nav
                                    class="grid grid-cols-2 p-1 text-xs md:grid-cols-2"
                                >
                                    <div class="flex items-center">
                                        <i
                                            class="fa-solid fa-location-dot mr-1"
                                        ></i>
                                        <span>
                                            {{ Str::limit($otherActivity->location ?: "ไม่ระบุ", 15) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-clock mr-1"></i>
                                        {{ $otherActivity->total_hour ?? 0 }}
                                        <span>ชั่วโมง</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i
                                            class="fa-solid fa-calendar-days mr-1"
                                        ></i>
                                        {{ $otherActivity->start_time ? $otherActivity->start_time->format("d M Y") : "ไม่ระบุ" }}
                                    </div>
                                </nav>

                                <div
                                    class="flex justify-end space-x-3 px-1 py-1 text-xs"
                                >
                                    @php
                                        $otherActivity->participants_count = App\Models\ActivityParticipant::where("activity_id", $otherActivity->id)->count();
                                        $otherActivity->is_registered = auth()->check()
                                            ? App\Models\ActivityParticipant::where("activity_id", $otherActivity->id)
                                                ->where("user_id", auth()->id())
                                                ->exists()
                                            : false;
                                    @endphp

                                    @if ($otherActivity->is_registered)
                                        <button
                                            type="button"
                                            class="cursor-not-allowed rounded-md bg-green-500 px-6 py-1 text-lg text-white shadow-lg"
                                            disabled
                                        >
                                            ✓ สมัครแล้ว
                                        </button>
                                    @elseif ($otherActivity->participants_count >= $otherActivity->accept_amount)
                                        <button
                                            type="button"
                                            class="cursor-not-allowed rounded-md bg-red-500 px-6 py-1 text-lg text-white shadow-lg"
                                            disabled
                                        >
                                            เต็มแล้ว
                                        </button>
                                    @elseif ($otherActivity->status === "pending" || $otherActivity->status === "ongoing")
                                        <button
                                            type="button"
                                            class="rounded-md bg-blue-400 px-6 py-1 text-lg text-white shadow-lg hover:bg-blue-600"
                                            onclick="registerForActivity({{ $otherActivity->id }}, '{{ $otherActivity->name_th }}')"
                                        >
                                            สมัครเข้าร่วม
                                        </button>
                                    @else
                                        <button
                                            type="button"
                                            class="cursor-not-allowed rounded-md bg-gray-400 px-6 py-1 text-lg text-white shadow-lg"
                                            disabled
                                        >
                                            ปิดการสมัคร
                                        </button>
                                    @endif
                                    <button
                                        type="button"
                                        class="rounded-md border border-blue-300 px-6 py-1 text-lg text-blue-300 shadow-lg hover:bg-blue-200 hover:text-white"
                                        onclick="window.location.href='/detail/{{ $otherActivity->id }}'"
                                    >
                                        รายละเอียด
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </main>
        </section>
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
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
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
                    } else {
                        showAlert('error', 'เกิดข้อผิดพลาด!', data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    showAlert(
                        'error',
                        'เกิดข้อผิดพลาด!',
                        'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้',
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
