@extends("components/layouts/layoutAfterLogin")

@section("title")
    กิจกรรมอาสาสมัคร | KKU VOLUNTEER
@endsection

@push("head")
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section("layout-content")
    @include("components.alert")
    <div class="min-h-screen bg-gray-50">
        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div
                class="relative mx-auto w-full max-w-6xl overflow-hidden rounded-md"
            >
                {{-- text on image --}}
                <div class="absolute z-1 w-2/3 p-6 max-md:w-2/5 max-sm:w-2/3">
                    <div>
                        <h1
                            class="carousel-title mb-4 text-2xl font-bold text-white md:text-5xl"
                        >
                            @if ($rec->isNotEmpty())
                                {{ $rec->first()->name_th }}
                            @else
                                    ค่ายปลุกฝันสอนน้อง
                            @endif
                        </h1>
                        <div
                            class="carousel-description text-white max-md:hidden"
                        >
                            @if ($rec->isNotEmpty())
                                {{ Str::limit($rec->first()->description, 300) }}
                            @else
                                    ค่ายปลุกฝันสอนน้อง
                                    จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง
                                    ผ่านกิจกรรมการเรียนรู้ การสอนทักษะ
                                    และการแนะแนวทางการพัฒนาตัวเองอย่างสร้างสรรค์
                                    โดยมุ่งเน้นการสร้างแรงบันดาลใจ
                                    ปลูกฝังทัศนคติที่ดี
                                    และส่งเสริมความสามัคคีระหว่างรุ่นพี่และน้อง
                                    รวมถึงการเรียนรู้การทำงานเป็นทีมและการรับผิดชอบต่อสังคมในบรรยากาศที่สนุกสนานและเป็นมิตร
                            @endif
                        </div>
                    </div>
                    <div
                        class="carousel-buttons my-4 flex gap-2 max-md:flex-col"
                    >
                        @if ($rec->isNotEmpty())
                            @php
                                $firstActivity = $rec->first();
                            @endphp

                            @if ($firstActivity->status === "finished")
                                <button
                                    class="cursor-not-allowed rounded-xl bg-gray-500 px-6 py-2 text-nowrap text-white shadow-lg"
                                    disabled
                                >
                                    <i class="fa-solid fa-check mr-1"></i>
                                    กิจกรรมเสร็จสิ้น
                                </button>
                            @elseif (isset($firstActivity->is_registered) && $firstActivity->is_registered)
                                <button
                                    class="cursor-not-allowed rounded-xl bg-emerald-400 px-6 py-2 text-nowrap text-white shadow-lg"
                                    disabled
                                >
                                    สมัครแล้ว
                                </button>
                            @elseif (($firstActivity->participants_count ?? 0) >= $firstActivity->accept_amount)
                                <button
                                    class="cursor-not-allowed rounded-xl bg-red-500 px-6 py-2 text-nowrap text-white shadow-lg"
                                    disabled
                                >
                                    เต็มแล้ว
                                </button>
                            @elseif ($firstActivity->status === "pending" || $firstActivity->status === "ongoing")
                                @auth
                                    <a
                                        href="{{ route("activities.register") }}"
                                        onclick="event.preventDefault(); registerActivity({{ $firstActivity->id }});"
                                        class="inline-block cursor-pointer rounded-xl bg-cyan-400 px-6 py-2 text-center text-nowrap text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90"
                                    >
                                        สมัครเข้าร่วม
                                    </a>
                                @else
                                    <a
                                        href="{{ route("login") }}"
                                        class="inline-block cursor-pointer rounded-xl bg-cyan-400 px-6 py-2 text-center text-nowrap text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90"
                                    >
                                        เข้าสู่ระบบเพื่อสมัคร
                                    </a>
                                @endauth
                            @else
                                <button
                                    class="cursor-not-allowed rounded-xl bg-gray-400 px-6 py-2 text-nowrap text-white shadow-lg"
                                    disabled
                                >
                                    ปิดการสมัคร
                                </button>
                            @endif
                            <a
                                href="{{ route("activity.detail", $firstActivity->id) }}"
                                class="cursor-pointer rounded-xl bg-white px-6 py-2 text-sky-400 shadow-lg transition-all hover:bg-gray-300 active:scale-90"
                            >
                                รายละเอียด
                            </a>
                        @else
                            @auth
                                <form
                                    method="POST"
                                    action="{{ route("activities.register") }}"
                                    style="display: inline"
                                >
                                    @csrf
                                    <input
                                        type="hidden"
                                        name="activity_id"
                                        value="1"
                                    />
                                    <button
                                        type="submit"
                                        class="cursor-pointer rounded-xl bg-cyan-400 px-6 py-2 text-nowrap text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90"
                                    >
                                        สมัครเข้าร่วม
                                    </button>
                                </form>
                            @else
                                <a
                                    href="{{ route("login") }}"
                                    class="inline-block cursor-pointer rounded-xl bg-cyan-400 px-6 py-2 text-center text-nowrap text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90"
                                >
                                    เข้าสู่ระบบเพื่อสมัคร
                                </a>
                            @endauth
                            <button
                                class="cursor-pointer rounded-xl bg-white px-6 py-2 text-sky-400 shadow-lg transition-all hover:bg-gray-300 active:scale-90"
                            >
                                รายละเอียด
                            </button>
                        @endif
                    </div>
                </div>

                {{-- carousel --}}
                <div class="animate-slide flex w-[300%] brightness-50">
                    @if ($rec->isNotEmpty())
                        @foreach ($rec->take(3) as $index => $activity)
                            <div class="w-1/3 flex-shrink-0">
                                @if ($activity->image_file_name)
                                    <img
                                        src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                                        class="h-100 w-full rounded-lg object-cover"
                                        alt="{{ $activity->name_th }}"
                                    />
                                @else
                                    <img
                                        src="{{ asset("images/carousel_" . ($index + 1) . ".jpg") }}"
                                        class="h-100 w-full rounded-lg object-cover"
                                        alt="{{ $activity->name_th }}"
                                    />
                                @endif
                            </div>
                        @endforeach

                        @for ($i = $rec->count(); $i < 3; $i++)
                            <div class="w-1/3 flex-shrink-0">
                                <img
                                    src="{{ asset("images/carousel_" . ($i + 1) . ".jpg") }}"
                                    class="h-100 w-full rounded-lg object-cover"
                                    alt="กิจกรรมอาสาสมัคร"
                                />
                            </div>
                        @endfor
                    @else
                        <div class="w-1/3 flex-shrink-0">
                            <img
                                src="{{ asset("images/carousel_1.jpg") }}"
                                class="h-100 w-full rounded-lg object-cover"
                                alt="กิจกรรมอาสาสมัคร"
                            />
                        </div>
                        <div class="w-1/3 flex-shrink-0">
                            <img
                                src="{{ asset("images/carousel_2.jpg") }}"
                                class="h-100 w-full rounded-lg object-cover"
                                alt="กิจกรรมอาสาสมัคร"
                            />
                        </div>
                        <div class="w-1/3 flex-shrink-0">
                            <img
                                src="{{ asset("images/carousel_3.jpg") }}"
                                class="h-100 w-full rounded-lg object-cover"
                                alt="กิจกรรมอาสาสมัคร"
                            />
                        </div>
                    @endif
                </div>

                {{-- indicator --}}
                <div
                    class="absolute bottom-3 left-1/2 flex w-auto -translate-x-1/2 space-x-2"
                >
                    <span
                        class="animate-indicator1 block h-1 w-6 rounded-full bg-white"
                    ></span>
                    <span
                        class="animate-indicator2 block h-1 w-6 rounded-full bg-white"
                    ></span>
                    <span
                        class="animate-indicator3 block h-1 w-6 rounded-full bg-white"
                    ></span>
                </div>
            </div>

            <hr class="my-8 text-gray-400" />

            <main>
                <section class="mb-8">
                    <div
                        class="my-6 flex items-center justify-between max-md:flex-col"
                    >
                        <div>
                            <h3
                                class="mb-2 text-3xl font-bold text-gray-900 md:text-4xl"
                            >
                                กิจกรรมทั้งหมด
                            </h3>
                            <p class="text-sm text-gray-600" id="resultsInfo">
                                พบ {{ $rec->count() }} กิจกรรม
                            </p>
                        </div>
                        <div class="flex flex-col items-end gap-5">
                            <div>
                                <input
                                    type="search"
                                    class="w-70 rounded-xl border border-gray-400 px-2 py-1"
                                    placeholder="ค้นหากิจกรรม"
                                    id="searchInput"
                                />
                            </div>
                            <div class="flex gap-5 max-md:flex-col">
                                <select
                                    name=""
                                    id="statusFilter"
                                    class="w-50 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                >
                                    <option value="">สถานะทั้งหมด</option>
                                    <option value="pending">รอดำเนินการ</option>
                                    <option value="ongoing">กำลังดำเนินการ</option>
                                    <option value="finished">เสร็จสิ้น</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                        id="activitiesGrid"
                    >
                        @forelse ($rec as $activity)
                            @php
                                $cardTags = [];
                                if ($activity->tags) {
                                    if (is_string($activity->tags)) {
                                        $cardTags = json_decode($activity->tags, true) ?: [];
                                    } elseif (is_array($activity->tags)) {
                                        $cardTags = $activity->tags;
                                    }
                                }
                            @endphp

                            <div
                                class="activity-card overflow-hidden rounded-lg bg-white shadow-md"
                                data-status="{{ $activity->status }}"
                                data-search="{{ strtolower($activity->name_th . " " . $activity->description . " " . $activity->location) }}"
                                data-tags="{{ ! empty($cardTags) ? implode(",", $cardTags) : "" }}"
                            >
                                @if ($activity->image_file_name)
                                    <img
                                        src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                                        alt="{{ $activity->name_th }}"
                                        class="h-48 w-full object-cover"
                                    />
                                @else
                                    <img
                                        src="{{ asset("images/test.jpg") }}"
                                        alt="กิจกรรม"
                                        class="h-48 w-full object-cover"
                                    />
                                @endif
                                <div class="p-4">
                                    <h4
                                        class="mb-2 font-semibold text-gray-900"
                                    >
                                        {{ $activity->name_th }}
                                    </h4>
                                    <!-- Status Badge -->
                                    <div
                                        class="mb-2 flex items-center justify-between"
                                    >
                                        @php
                                            $statusColors = [
                                                "pending" => "border-yellow-200 bg-yellow-100 text-yellow-800",
                                                "ongoing" => "border-blue-200 bg-blue-100 text-blue-800",
                                                "finished" => "border-gray-200 bg-gray-100 text-gray-800",
                                            ];
                                            $statusTexts = [
                                                "pending" => "รอดำเนินการ",
                                                "ongoing" => "กำลังดำเนินการ",
                                                "finished" => "เสร็จสิ้น",
                                            ];
                                            $statusIcons = [
                                                "pending" => "fa-clock",
                                                "ongoing" => "fa-play",
                                                "finished" => "fa-check-circle",
                                            ];
                                        @endphp

                                        <span
                                            class="{{ $statusColors[$activity->status] ?? "bg-gray-100 text-gray-800 border-gray-200" }} inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium"
                                        >
                                            <i
                                                class="fa-solid {{ $statusIcons[$activity->status] ?? "fa-question" }} mr-1"
                                            ></i>
                                            {{ $statusTexts[$activity->status] ?? $activity->status }}
                                        </span>

                                        @if ($activity->status === "finished")
                                            <span class="text-xs text-gray-500">
                                                <i
                                                    class="fa-solid fa-flag-checkered mr-1"
                                                ></i>
                                                สิ้นสุดแล้ว
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Tags -->
                                    @php
                                        $activityTags = [];
                                        if ($activity->tags) {
                                            if (is_string($activity->tags)) {
                                                $activityTags = json_decode($activity->tags, true) ?: [];
                                            } elseif (is_array($activity->tags)) {
                                                $activityTags = $activity->tags;
                                            }
                                        }
                                    @endphp

                                    @if (! empty($activityTags))
                                        <div class="mb-2 flex flex-wrap gap-2">
                                            @foreach (array_slice($activityTags, 0, 3) as $tag)
                                                <div
                                                    class="rounded-full bg-green-500 px-2 py-1 text-xs text-white"
                                                >
                                                    #{{ $tag }}
                                                </div>
                                            @endforeach

                                            @if (count($activityTags) > 3)
                                                <div
                                                    class="rounded-full bg-gray-400 px-2 py-1 text-xs text-white"
                                                >
                                                    +{{ count($activityTags) - 3 }}
                                                    อื่นๆ
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <p class="mb-3 text-sm text-gray-600">
                                        {{ Str::limit($activity->description ?: "ไม่มีรายละเอียด", 120) }}
                                    </p>
                                    <div
                                        class="mb-3 flex items-center justify-between text-sm text-gray-500"
                                    >
                                        <div class="flex items-center">
                                            <i
                                                class="fa-solid fa-location-dot mr-1"
                                            ></i>
                                            {{ Str::limit($activity->location ?: "ไม่ระบุสถานที่", 20) }}
                                        </div>
                                        <div class="flex items-center">
                                            <i
                                                class="fa-solid fa-calendar-days mr-1"
                                            ></i>
                                            {{ $activity->start_time ? $activity->start_time->format("d M Y") : "ไม่ระบุ" }}
                                        </div>
                                    </div>
                                    <div class="mb-3 text-xs text-gray-500">
                                        <i class="fa-solid fa-clock mr-1"></i>
                                        {{ $activity->total_hour ?? 0 }}
                                        ชั่วโมง
                                    </div>
                                    <div class="mb-3 text-xs text-gray-500">
                                        <i class="fa-solid fa-users mr-1"></i>
                                        รับสมัคร
                                        {{ $activity->participants_count ?? 0 }}/{{ $activity->accept_amount }}
                                        คน
                                    </div>
                                    @if (isset($activity->is_registration_closed) && $activity->is_registration_closed)
                                        <div
                                            class="mb-2 rounded-lg border border-red-200 bg-red-50 px-3 py-2"
                                        >
                                            <div class="flex items-center">
                                                <svg
                                                    class="mr-2 h-4 w-4 text-red-500"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"
                                                    ></path>
                                                </svg>
                                                <span
                                                    class="text-sm font-medium text-red-800"
                                                >
                                                    หมดเวลารับสมัคร
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex gap-2">
                                        @if ($activity->status === "finished")
                                            <button
                                                class="flex-1 cursor-not-allowed rounded-lg bg-gray-500 px-4 py-2 text-white"
                                                disabled
                                            >
                                                กิจกรรมเสร็จสิ้น
                                            </button>
                                        @elseif (isset($activity->is_registered) && $activity->is_registered)
                                            <button
                                                class="flex-1 cursor-not-allowed rounded-lg bg-emerald-400 px-4 py-2 text-white"
                                                disabled
                                            >
                                                สมัครแล้ว
                                            </button>
                                        @elseif (isset($activity->is_registration_closed) && $activity->is_registration_closed)
                                            <button
                                                class="flex-1 cursor-not-allowed rounded-lg bg-red-500 px-4 py-2 text-white"
                                                disabled
                                            >
                                                หมดเวลารับสมัคร
                                            </button>
                                        @elseif (($activity->participants_count ?? 0) >= $activity->accept_amount)
                                            <button
                                                class="flex-1 cursor-not-allowed rounded-lg bg-red-500 px-4 py-2 text-white"
                                                disabled
                                            >
                                                เต็มแล้ว
                                            </button>
                                        @elseif ($activity->status === "pending" || $activity->status === "ongoing")
                                            @auth
                                                <form
                                                    method="POST"
                                                    action="{{ route("activities.register") }}"
                                                    style="
                                                        display: inline;
                                                        width: 100%;
                                                    "
                                                >
                                                    @csrf
                                                    <input
                                                        type="hidden"
                                                        name="activity_id"
                                                        value="{{ $activity->id }}"
                                                    />
                                                    <button
                                                        type="submit"
                                                        class="w-full flex-1 rounded-lg bg-cyan-400 px-4 py-2 text-white transition-colors hover:bg-cyan-500"
                                                    >
                                                        สมัครเลย
                                                    </button>
                                                </form>
                                            @else
                                                <a
                                                    href="{{ route("login") }}"
                                                    class="flex-1 rounded-lg bg-cyan-400 px-4 py-2 text-center text-white transition-colors hover:bg-cyan-500"
                                                >
                                                    เข้าสู่ระบบเพื่อสมัคร
                                                </a>
                                            @endauth
                                        @else
                                            <button
                                                class="flex-1 cursor-not-allowed rounded-lg bg-gray-400 px-4 py-2 text-white"
                                                disabled
                                            >
                                                ปิดการสมัคร
                                            </button>
                                        @endif
                                        <a
                                            href="{{ route("activity.detail", $activity->id) }}"
                                            class="rounded-lg border border-blue-500 px-4 py-2 text-blue-500 transition-colors hover:bg-blue-50"
                                        >
                                            ดูรายละเอียด
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <svg
                                    class="mx-auto h-12 w-12 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                    />
                                </svg>
                                <h3
                                    class="mt-2 text-sm font-medium text-gray-900"
                                >
                                    ยังไม่มีกิจกรรม
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    ไม่พบกิจกรรมอาสาสมัครในขณะนี้
                                </p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </main>
        </section>
    </div>
@endsection

@section("scripts")
    @parent
    <script>
        function searchActivities() {
            const searchTerm = document
                .getElementById('searchInput')
                .value.toLowerCase();
            filterActivities();
        }

        function filterActivities() {
            const searchInput = document.getElementById('searchInput');
            const statusFilterElement = document.getElementById('statusFilter');

            const searchTerm = searchInput
                ? searchInput.value.toLowerCase()
                : '';
            const statusFilter = statusFilterElement
                ? statusFilterElement.value
                : '';
            const activityCards = document.querySelectorAll('.activity-card');

            activityCards.forEach((card) => {
                const searchText = card.dataset.search;
                const status = card.dataset.status;

                let showCard = true;

                if (searchTerm && !searchText.includes(searchTerm)) {
                    showCard = false;
                }

                if (statusFilter && statusFilter !== status) {
                    showCard = false;
                }

                card.style.display = showCard ? 'block' : 'none';
            });

            const visibleCards = Array.from(activityCards).filter(
                (card) => card.style.display !== 'none',
            );
            const container = document.getElementById('activitiesGrid');

            let noResultsMessage = document.getElementById('noResultsMessage');
            if (visibleCards.length === 0) {
                if (!noResultsMessage) {
                    noResultsMessage = document.createElement('div');
                    noResultsMessage.id = 'noResultsMessage';
                    noResultsMessage.className =
                        'col-span-full py-12 text-center w-full';
                    noResultsMessage.innerHTML = `
                        <div class="mx-auto h-12 w-12 text-gray-400 mb-4">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">ไม่พบกิจกรรมที่ตรงกับเงื่อนไข</h3>
                        <p class="mt-1 text-sm text-gray-500">ลองเปลี่ยนเงื่อนไขการค้นหาหรือกรองข้อมูล</p>
                    `;
                    container.appendChild(noResultsMessage);
                }
            } else {
                if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            }
        }

        function registerActivity(activityId) {
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    alert('ไม่พบ CSRF token กรุณาโหลดหน้าใหม่');
                    return;
                }

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("activities.register") }}';
                form.style.display = 'none';

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken.getAttribute('content');

                const activityInput = document.createElement('input');
                activityInput.type = 'hidden';
                activityInput.name = 'activity_id';
                activityInput.value = activityId;

                form.appendChild(csrfInput);
                form.appendChild(activityInput);
                document.body.appendChild(form);
                form.submit();
            } catch (err) {
                console.error('registerActivity failed', err);
                alert('เกิดข้อผิดพลาด โปรดลองอีกครั้ง');
            }
        }

        // Carousel functionality
        const carouselData = [
            @if ($rec->isNotEmpty())
                @foreach ($rec->take(3) as $index => $activity)
                    {
                        title: "{{ $activity->name_th }}",
                        description: "{{ Str::limit($activity->description ?: 'ค่ายปลุกฝันสอนน้อง', 300) }}",
                        id: {{ $activity->id }},
                        is_registered: {{ isset($activity->is_registered) && $activity->is_registered ? 'true' : 'false' }},
                        participants_count: {{ $activity->participants_count ?? 0 }},
                        accept_amount: {{ $activity->accept_amount }},
                        status: "{{ $activity->status }}"
                    }{{ !$loop->last ? ',' : '' }}
                @endforeach
            @else
                {
                    title: "ค่ายปลุกฝันสอนน้อง",
                    description: "ค่ายปลุกฝันสอนน้อง จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง",
                    id: null,
                    is_registered: false,
                    participants_count: 0,
                    accept_amount: 0,
                    status: "pending"
                }
            @endif
        ];

        let currentSlide = 0;

        function updateCarouselText() {
            const data = carouselData[currentSlide % carouselData.length];
            const titleElement = document.querySelector('.carousel-title');
            const descriptionElement = document.querySelector('.carousel-description');
            const buttonsContainer = document.querySelector('.carousel-buttons');

            if (titleElement) titleElement.textContent = data.title;
            if (descriptionElement) descriptionElement.textContent = data.description;

            if (buttonsContainer && data.id) {
                let buttonHTML = '';

                if (data.status === "finished") {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-gray-500 px-6 py-2 text-nowrap text-white shadow-lg" disabled><i class="fa-solid fa-check mr-1"></i>กิจกรรมเสร็จสิ้น</button>';
                } else if (data.is_registered) {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-emerald-400 px-6 py-2 text-nowrap text-white shadow-lg" disabled>สมัครแล้ว</button>';
                } else if (data.participants_count >= data.accept_amount) {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-red-500 px-6 py-2 text-nowrap text-white shadow-lg" disabled>เต็มแล้ว</button>';
                } else if (data.status === "pending" || data.status === "ongoing") {
                    @auth
                        buttonHTML = `<a href="{{ route('activities.register') }}" onclick="event.preventDefault(); registerActivity(${data.id});" class="inline-block cursor-pointer rounded-xl bg-cyan-400 px-6 py-2 text-center text-nowrap text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90">สมัครเข้าร่วม</a>`;
                    @else
                        buttonHTML = `<a href="{{ route('login') }}" class="inline-block cursor-pointer rounded-xl bg-cyan-400 px-6 py-2 text-center text-nowrap text-white shadow-lg transition-all hover:bg-cyan-500 active:scale-90">เข้าสู่ระบบเพื่อสมัคร</a>`;
                    @endauth
                } else {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-gray-400 px-6 py-2 text-nowrap text-white shadow-lg" disabled>ปิดการสมัคร</button>';
                }

                buttonHTML += `<a href="/activity/detail/${data.id}" class="cursor-pointer rounded-xl bg-white px-6 py-2 text-sky-400 shadow-lg transition-all hover:bg-gray-300 active:scale-90">รายละเอียด</a>`;
                buttonsContainer.innerHTML = buttonHTML;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');

            if (searchInput) {
                searchInput.addEventListener('input', searchActivities);
            }

            if (statusFilter) {
                statusFilter.addEventListener('change', filterActivities);
            }

            // Card hover effects
            const cards = document.querySelectorAll('.activity-card');
            cards.forEach((card) => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-4px)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Start carousel if data exists
            if (carouselData.length > 0) {
                setInterval(() => {
                    currentSlide = (currentSlide + 1) % carouselData.length;
                    updateCarouselText();
                }, 5000);
            }
        });
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .activity-card {
            transition: all 0.3s ease-in-out;
        }

        .activity-card.hidden-card {
            display: none !important;
        }

        .activity-card.visible-card {
            display: block !important;
            opacity: 1;
            transform: translateY(0);
        }

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

        /* Carousel Animations */
        .animate-slide {
            animation: slide 15s infinite;
        }

        .animate-indicator1 {
            animation: indicator1 15s infinite;
        }

        .animate-indicator2 {
            animation: indicator2 15s infinite;
        }

        .animate-indicator3 {
            animation: indicator3 15s infinite;
        }

        @keyframes slide {
            0%,
            30% {
                transform: translateX(0);
            }
            33.33%,
            63.33% {
                transform: translateX(-33.33%);
            }
            66.66%,
            96.66% {
                transform: translateX(-66.66%);
            }
            100% {
                transform: translateX(0);
            }
        }

        @keyframes indicator1 {
            0%,
            30% {
                background-color: white;
                opacity: 1;
            }
            33.33%,
            100% {
                background-color: rgba(255, 255, 255, 0.5);
                opacity: 0.5;
            }
        }

        @keyframes indicator2 {
            0%,
            30% {
                background-color: rgba(255, 255, 255, 0.5);
                opacity: 0.5;
            }
            33.33%,
            63.33% {
                background-color: white;
                opacity: 1;
            }
            66.66%,
            100% {
                background-color: rgba(255, 255, 255, 0.5);
                opacity: 0.5;
            }
        }

        @keyframes indicator3 {
            0%,
            63.33% {
                background-color: rgba(255, 255, 255, 0.5);
                opacity: 0.5;
            }
            66.66%,
            96.66% {
                background-color: white;
                opacity: 1;
            }
            100% {
                background-color: rgba(255, 255, 255, 0.5);
                opacity: 0.5;
            }
        }

        /* Height utilities */
        .h-100 {
            height: 25rem;
        }

        .z-1 {
            z-index: 1;
        }

        .w-70 {
            width: 17.5rem;
        }

        .w-50 {
            width: 12.5rem;
        }

        /* Status and Tags styling */
        .activity-card[data-status='finished'] {
            opacity: 0.85;
        }
    </style>
@endsection
