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
                            @endif
                        </div>
                    </div>
                </div>

                <div class="animate-slide flex w-[300%] brightness-50">
                    @if ($rec->isNotEmpty())
                        @foreach ($rec->take(3) as $index => $activity)
                            <div class="w-1/3 flex-shrink-0">
                                @if ($activity->image_file_name)
                                    <img
                                        src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                                        alt="{{ $activity->name_th }}"
                                        class="h-100 w-full object-cover"
                                    />
                                @else
                                    <img
                                        src="{{ asset("images/test.jpg") }}"
                                        alt="กิจกรรม"
                                        class="h-100 w-full object-cover"
                                    />
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="w-1/3 flex-shrink-0">
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-100 w-full object-cover"
                            />
                        </div>
                        <div class="w-1/3 flex-shrink-0">
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-100 w-full object-cover"
                            />
                        </div>
                        <div class="w-1/3 flex-shrink-0">
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-100 w-full object-cover"
                            />
                        </div>
                    @endif
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
                                พบ {{ $rec->total() }} กิจกรรม (หน้าที่
                                {{ $rec->currentPage() }}/{{ $rec->lastPage() }})
                            </p>
                        </div>
                        <div class="flex gap-5 max-md:flex-col">
                            <input
                                type="text"
                                id="searchInput"
                                placeholder="ค้นหากิจกรรม..."
                                class="rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none"
                            />

                            <select
                                id="tagFilter"
                                class="rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none"
                            >
                                <option value="">-- ทั้งหมด --</option>
                                @php
                                    $allTags = [];
                                    foreach ($rec as $activity) {
                                        if ($activity->tags) {
                                            $tags = json_decode($activity->tags, true);
                                            if (is_array($tags)) {
                                                $allTags = array_merge($allTags, $tags);
                                            }
                                        }
                                    }
                                    $uniqueTags = array_unique($allTags);
                                    sort($uniqueTags);
                                @endphp

                                @foreach ($uniqueTags as $tag)
                                    <option value="{{ $tag }}">
                                        {{ $tag }}
                                    </option>
                                @endforeach
                            </select>

                            <select
                                id="statusFilter"
                                class="rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none"
                            >
                                <option value="">ทุกสถานะ</option>
                                <option value="pending">รอดำเนินการ</option>
                                <option value="ongoing">กำลังดำเนินการ</option>
                                <option value="finished">เสร็จสิ้น</option>
                            </select>

                            <button
                                onclick="applyFilterWithPagination()"
                                class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            >
                                ค้นหา
                            </button>
                        </div>
                    </div>

                    <!-- Activities Grid -->
                    <div
                        class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                        id="activitiesGrid"
                    >
                        @forelse ($rec as $activity)
                            @php
                                $activityTags = [];
                                if ($activity->tags) {
                                    $activityTags = json_decode($activity->tags, true) ?: [];
                                }
                            @endphp

                            <div
                                class="activity-card overflow-hidden rounded-lg bg-white shadow-md"
                                data-status="{{ $activity->status }}"
                                data-search="{{ strtolower($activity->name_th . " " . $activity->description . " " . $activity->location) }}"
                                data-tags="{{ implode(",", $activityTags) }}"
                            >
                                <!-- Activity Image -->

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
                                    <!-- Title -->
                                    <h4
                                        class="mb-2 font-semibold text-gray-900"
                                    >
                                        {{ $activity->name_th }}
                                    </h4>

                                    <!-- Status Badge -->
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
                                    @endphp

                                    <div
                                        class="mb-2 flex items-center justify-between"
                                    >
                                        <span
                                            class="{{ $statusColors[$activity->status] ?? "bg-gray-100 text-gray-800 border-gray-200" }} inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium"
                                        >
                                            {{ $statusTexts[$activity->status] ?? $activity->status }}
                                        </span>
                                    </div>

                                    <!-- Tags -->
                                    @if (! empty($activityTags))
                                        <div class="mb-3 flex flex-wrap gap-2">
                                            @foreach (array_slice($activityTags, 0, 3) as $tag)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                                >
                                                    #{{ $tag }}
                                                </span>
                                            @endforeach

                                            @if (count($activityTags) > 3)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800"
                                                >
                                                    +{{ count($activityTags) - 3 }}
                                                    อื่นๆ
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Description -->
                                    <p class="mb-3 text-sm text-gray-600">
                                        {{ Str::limit($activity->description ?: "ไม่มีรายละเอียด", 120) }}
                                    </p>

                                    <!-- Location & Date -->
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

                                    <!-- Hours & Participants -->
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

                                    <!-- Action Buttons -->
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
                                        @elseif (($activity->participants_count ?? 0) >= $activity->accept_amount)
                                            <button
                                                class="flex-1 cursor-not-allowed rounded-lg bg-red-500 px-4 py-2 text-white"
                                                disabled
                                            >
                                                เต็มแล้ว
                                            </button>
                                        @elseif ($activity->status === "pending" || $activity->status === "ongoing")
                                            @auth
                                                <button
                                                    onclick="registerActivity({{ $activity->id }})"
                                                    class="flex-1 rounded-lg bg-cyan-400 px-4 py-2 text-white transition-colors hover:bg-cyan-500"
                                                >
                                                    สมัครเลย
                                                </button>
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

                    @if ($rec->hasPages())
                        <div class="mt-8 flex justify-center">
                            <nav
                                class="flex items-center space-x-1"
                                role="navigation"
                                aria-label="Pagination Navigation"
                            >
                                @if ($rec->onFirstPage())
                                    <span
                                        class="relative inline-flex cursor-default items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm leading-5 font-medium text-gray-300"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </span>
                                @else
                                    <a
                                        href="{{ $rec->previousPageUrl() }}"
                                        class="focus:shadow-outline-cyan relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm leading-5 font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-cyan-300 focus:outline-none active:bg-gray-100 active:text-gray-500"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </a>
                                @endif

                                @foreach ($rec->getUrlRange(1, $rec->lastPage()) as $page => $url)
                                    @if ($page == $rec->currentPage())
                                        <span
                                            class="relative -ml-px inline-flex cursor-default items-center border border-cyan-300 bg-cyan-400 px-4 py-2 text-sm leading-5 font-medium text-white"
                                        >
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a
                                            href="{{ $url }}"
                                            class="focus:shadow-outline-cyan relative -ml-px inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm leading-5 font-medium text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:z-10 focus:border-cyan-300 focus:outline-none active:bg-gray-100 active:text-gray-700"
                                        >
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}

                                @if ($rec->hasMorePages())
                                    <a
                                        href="{{ $rec->nextPageUrl() }}"
                                        class="focus:shadow-outline-cyan relative -ml-px inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm leading-5 font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-400 focus:z-10 focus:border-cyan-300 focus:outline-none active:bg-gray-100 active:text-gray-500"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </a>
                                @else
                                    <span
                                        class="relative -ml-px inline-flex cursor-default items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm leading-5 font-medium text-gray-300"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </span>
                                @endif
                            </nav>
                        </div>

                        <!-- Pagination Info -->
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-700">
                                แสดง {{ $rec->firstItem() }} ถึง
                                {{ $rec->lastItem() }} จาก {{ $rec->total() }}
                                รายการ
                            </p>
                        </div>
                    @endif
                </section>
            </main>
        </section>
    </div>
@endsection

@section("scripts")
    @parent
    <script>
        function searchActivities() {
            const searchInput = document.getElementById('searchInput');
            const statusFilterElement = document.getElementById('statusFilter');
            const tagFilterElement = document.getElementById('tagFilter');

            const searchTerm = searchInput
                ? searchInput.value.toLowerCase().trim()
                : '';
            const statusFilter = statusFilterElement
                ? statusFilterElement.value
                : '';
            const tagFilter = tagFilterElement ? tagFilterElement.value : '';
            const activityCards = document.querySelectorAll('.activity-card');

            console.log(
                'Searching for:',
                searchTerm,
                'Status filter:',
                statusFilter,
                'Tag filter:',
                tagFilter,
            );

            let visibleCount = 0;

            activityCards.forEach((card) => {
                const searchText = card.dataset.search || '';
                const status = card.dataset.status || '';
                const tags = card.dataset.tags || '';

                let showCard = true;

                if (searchTerm && !searchText.includes(searchTerm)) {
                    showCard = false;
                }

                if (statusFilter && statusFilter !== status) {
                    showCard = false;
                }

                if (tagFilter) {
                    const cardTags = tags.split(',').map((tag) => tag.trim());
                    if (!cardTags.includes(tagFilter)) {
                        showCard = false;
                    }
                }

                if (showCard) {
                    visibleCount++;
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            const resultsInfo = document.getElementById('resultsInfo');
            if (resultsInfo) {
                let resultText = `พบ ${visibleCount} กิจกรรม (ในหน้านี้)`;
                const filters = [];
                if (tagFilter) filters.push(`Tag: ${tagFilter}`);
                if (statusFilter) {
                    const statusTexts = {
                        pending: 'รอดำเนินการ',
                        ongoing: 'กำลังดำเนินการ',
                        finished: 'เสร็จสิ้น',
                    };
                    filters.push(
                        `สถานะ: ${statusTexts[statusFilter] || statusFilter}`,
                    );
                }
                if (filters.length > 0) {
                    resultText += ` (${filters.join(', ')})`;
                }
                resultsInfo.textContent = resultText;
            }

            let noResultsMessage = document.getElementById('noResultsMessage');
            const container = document.getElementById('activitiesGrid');

            if (visibleCount === 0) {
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
                        <p class="mt-1 text-sm text-gray-500">ลองเปลี่ยนเงื่อนไขการค้นหา</p>
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
                const csrfToken = document.querySelector(
                    'meta[name="csrf-token"]',
                );
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

        function applyFilterWithPagination() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const tagFilter = document.getElementById('tagFilter');

            const searchTerm = searchInput ? searchInput.value : '';
            const status = statusFilter ? statusFilter.value : '';
            const tag = tagFilter ? tagFilter.value : '';

            const params = new URLSearchParams();
            if (searchTerm) params.append('search', searchTerm);
            if (status) params.append('status', status);
            if (tag) params.append('tag', tag);

            const url =
                '{{ route("user.activities") }}' +
                (params.toString() ? '?' + params.toString() : '');
            window.location.href = url;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const tagFilter = document.getElementById('tagFilter');

            const urlParams = new URLSearchParams(window.location.search);
            if (searchInput && urlParams.get('search')) {
                searchInput.value = urlParams.get('search');
            }
            if (statusFilter && urlParams.get('status')) {
                statusFilter.value = urlParams.get('status');
            }
            if (tagFilter && urlParams.get('tag')) {
                tagFilter.value = urlParams.get('tag');
            }

            if (searchInput) {
                searchInput.addEventListener('input', searchActivities);
            }

            if (statusFilter) {
                statusFilter.addEventListener('change', searchActivities);
            }

            if (tagFilter) {
                tagFilter.addEventListener('change', searchActivities);
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

        .activity-card {
            transition: all 0.3s ease-in-out;
        }

        .activity-card:hover {
            transform: translateY(-4px);
        }

        /* Carousel Animations */
        .animate-slide {
            animation: slide 15s infinite;
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

        .h-100 {
            height: 25rem;
        }

        .z-1 {
            z-index: 1;
        }
    </style>
@endsection
