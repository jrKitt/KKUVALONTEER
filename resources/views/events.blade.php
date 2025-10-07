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
                    <div class="carousel-buttons flex gap-2 max-md:flex-col">
                        @if ($rec->isNotEmpty())
                            @php
                                $firstActivity = $rec->first();
                            @endphp

                            @if (isset($firstActivity->is_registered) && $firstActivity->is_registered)
                                <button
                                    class="cursor-not-allowed rounded-xl bg-green-500 px-6 py-2 text-nowrap text-white"
                                    disabled
                                >
                                    สมัครแล้ว
                                </button>
                            @elseif (($firstActivity->participants_count ?? 0) >= $firstActivity->accept_amount)
                                <button
                                    class="cursor-not-allowed rounded-xl bg-red-500 px-6 py-2 text-nowrap text-white"
                                    disabled
                                >
                                    เต็มแล้ว
                                </button>
                            @elseif ($firstActivity->status === "pending" || $firstActivity->status === "ongoing")
                                <button
                                    class="cursor-pointer rounded-xl bg-sky-400 px-6 py-2 text-nowrap text-white hover:bg-sky-600"
                                    onclick="registerForActivity({{ $firstActivity->id }}, '{{ $firstActivity->name_th }}')"
                                >
                                    สมัครเข้าร่วม
                                </button>
                            @else
                                <button
                                    class="cursor-not-allowed rounded-xl bg-gray-400 px-6 py-2 text-nowrap text-white"
                                    disabled
                                >
                                    ปิดการสมัคร
                                </button>
                            @endif
                            <a
                                href="{{ route("activity.detail", $firstActivity->id) }}"
                                class="cursor-pointer rounded-xl bg-white px-6 py-2 text-sky-400 hover:bg-gray-300"
                            >
                                รายละเอียด
                            </a>
                        @else
                            <button
                                class="cursor-pointer rounded-xl bg-sky-400 px-6 py-2 text-nowrap text-white hover:bg-sky-600"
                            >
                                สมัครเข้าร่วม
                            </button>
                            <button
                                class="cursor-pointer rounded-xl bg-white px-6 py-2 text-sky-400 hover:bg-gray-300"
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
                        <h3
                            class="mb-6 text-3xl font-bold text-gray-900 md:text-4xl"
                        >
                            กิจกรรมทั้งหมด
                        </h3>
                        <div class="flex flex-col items-end gap-5">
                            <div>
                                <input
                                    type="search"
                                    class="w-70 rounded-xl border border-gray-400 px-2 py-1"
                                    placeholder="ค้นหา"
                                    id="searchInput"
                                    onkeyup="searchActivities()"
                                />
                            </div>
                            <div class="flex gap-5 max-md:flex-col">
                                <select
                                    name=""
                                    id="tagFilter"
                                    class="w-50 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                    onchange="filterActivities()"
                                >
                                    <option value=""># แท็ก</option>
                                    <option value="เกษตรศาสตร์">
                                        เกษตรศาสตร์
                                    </option>
                                    <option value="คอมพิวเตอร์">
                                        คอมพิวเตอร์
                                    </option>
                                    <option value="วิศวกรรม">วิศวกรรม</option>
                                </select>
                                <select
                                    name=""
                                    id="statusFilter"
                                    class="w-50 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                    onchange="filterActivities()"
                                >
                                    <option value="">สถานะ</option>
                                    <option value="pending">รอดำเนินการ</option>
                                    <option value="ongoing">
                                        กำลังดำเนินการ
                                    </option>
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
                            <div
                                class="activity-card overflow-hidden rounded-lg bg-white shadow-md"
                                data-status="{{ $activity->status }}"
                                data-search="{{ strtolower($activity->name_th . " " . $activity->description . " " . $activity->location) }}"
                                data-tags="{{ $activity->tags && is_array($activity->tags) ? implode(",", $activity->tags) : "" }}"
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
                                    <div class="mb-2 flex items-center gap-2">
                                        @if ($activity->tags && is_array($activity->tags))
                                            @foreach (array_slice($activity->tags, 0, 2) as $tag)
                                                <span
                                                    class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-800"
                                                >
                                                    #{{ $tag }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span
                                                class="rounded-full bg-blue-400 px-2 py-1 text-xs text-white"
                                            >
                                                #วิทยาลัยการคอมพิวเตอร์
                                            </span>
                                            <span
                                                class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800"
                                            >
                                                ปี 1-4
                                            </span>
                                        @endif

                                        @php
                                            $statusColors = [
                                                "pending" => "bg-yellow-100 text-yellow-800",
                                                "ongoing" => "bg-green-100 text-green-800",
                                                "finished" => "bg-gray-100 text-gray-800",
                                            ];
                                            $statusTexts = [
                                                "pending" => "รอดำเนินการ",
                                                "ongoing" => "กำลังดำเนินการ",
                                                "finished" => "เสร็จสิ้น",
                                            ];
                                        @endphp

                                        <span
                                            class="{{ $statusColors[$activity->status] ?? "bg-gray-100 text-gray-800" }} rounded-full px-2 py-1 text-xs"
                                        >
                                            {{ $statusTexts[$activity->status] ?? $activity->status }}
                                        </span>
                                    </div>
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
                                    <div class="flex gap-2">
                                        @if (isset($activity->is_registered) && $activity->is_registered)
                                            <button
                                                class="flex-1 cursor-not-allowed rounded-lg bg-green-500 px-4 py-2 text-white"
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
                                            <button
                                                class="flex-1 rounded-lg bg-blue-500 px-4 py-2 text-white transition-colors hover:bg-blue-600"
                                                onclick="registerForActivity({{ $activity->id }}, '{{ $activity->name_th }}')"
                                            >
                                                สมัครเลย
                                            </button>
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
    <script>
        const activitiesData = @json($rec);

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

        function filterActivities(status) {
            const cards = document.querySelectorAll('.activity-card');

            cards.forEach((card) => {
                if (status === '' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function searchActivities() {
            const searchTerm = document
                .getElementById('searchInput')
                .value.toLowerCase();
            const cards = document.querySelectorAll('.activity-card');

            cards.forEach((card) => {
                const searchData = card.dataset.search;
                if (searchData.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            filterActivities();
        }

        function filterActivities() {
            const statusFilter = document.getElementById('statusFilter').value;
            const tagFilter = document.getElementById('tagFilter').value;
            const cards = document.querySelectorAll('.activity-card');

            cards.forEach((card) => {
                let showCard = true;

                if (card.style.display === 'none') {
                    return;
                }

                if (statusFilter && card.dataset.status !== statusFilter) {
                    showCard = false;
                }

                if (tagFilter && !card.dataset.tags.includes(tagFilter)) {
                    showCard = false;
                }

                card.style.display = showCard ? 'block' : 'none';
            });
        }

        // Carousel data for text overlay
        const carouselData = [
            @if ($rec->isNotEmpty())
                @foreach ($rec->take(3) as $index => $activity)
                    {
                        title: "{{ $activity->name_th }}",
                        description: "{{ Str::limit($activity->description ?: 'ค่ายปลุกฝันสอนน้อง จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง', 300) }}",
                        id: {{ $activity->id }},
                        is_registered: {{ isset($activity->is_registered) && $activity->is_registered ? 'true' : 'false' }},
                        participants_count: {{ $activity->participants_count ?? 0 }},
                        accept_amount: {{ $activity->accept_amount }},
                        status: "{{ $activity->status }}"
                    }@if (!$loop->last),@endif
                @endforeach
                @for ($i = $rec->count(); $i < 3; $i++)
                    @if ($i > 0 || $rec->count() > 0),@endif
                    {
                        title: "ค่ายปลุกฝันสอนน้อง",
                        description: "ค่ายปลุกฝันสอนน้อง จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง ผ่านกิจกรรมการเรียนรู้ การสอนทักษะ และการแนะแนวทางการพัฒนาตัวเองอย่างสร้างสรรค์",
                        id: null,
                        is_registered: false,
                        participants_count: 0,
                        accept_amount: 0,
                        status: "pending"
                    }
                @endfor
            @else
                {
                    title: "ค่ายปลุกฝันสอนน้อง",
                    description: "ค่ายปลุกฝันสอนน้อง จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง ผ่านกิจกรรมการเรียนรู้ การสอนทักษะ และการแนะแนวทางการพัฒนาตัวเองอย่างสร้างสรรค์ โดยมุ่งเน้นการสร้างแรงบันดาลใจ ปลูกฝังทัศนคติที่ดี และส่งเสริมความสามัคคีระหว่างรุ่นพี่และน้อง รวมถึงการเรียนรู้การทำงานเป็นทีมและการรับผิดชอบต่อสังคมในบรรยากาศที่สนุกสนานและเป็นมิตร",
                    id: null,
                    is_registered: false,
                    participants_count: 0,
                    accept_amount: 0,
                    status: "pending"
                },
                {
                    title: "ค่ายปลุกฝันสอนน้อง",
                    description: "ค่ายปลุกฝันสอนน้อง จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง ผ่านกิจกรรมการเรียนรู้ การสอนทักษะ และการแนะแนวทางการพัฒนาตัวเองอย่างสร้างสรรค์ โดยมุ่งเน้นการสร้างแรงบันดาลใจ ปลูกฝังทัศนคติที่ดี และส่งเสริมความสามัคคีระหว่างรุ่นพี่และน้อง รวมถึงการเรียนรู้การทำงานเป็นทีมและการรับผิดชอบต่อสังคมในบรรยากาศที่สนุกสนานและเป็นมิตร",
                    id: null,
                    is_registered: false,
                    participants_count: 0,
                    accept_amount: 0,
                    status: "pending"
                },
                {
                    title: "ค่ายปลุกฝันสอนน้อง",
                    description: "ค่ายปลุกฝันสอนน้อง จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง ผ่านกิจกรรมการเรียนรู้ การสอนทักษะ และการแนะแนวทางการพัฒนาตัวเองอย่างสร้างสรรค์ โดยมุ่งเน้นการสร้างแรงบันดาลใจ ปลูกฝังทัศนคติที่ดี และส่งเสริมความสามัคคีระหว่างรุ่นพี่และน้อง รวมถึงการเรียนรู้การทำงานเป็นทีมและการรับผิดชอบต่อสังคมในบรรยากาศที่สนุกสนานและเป็นมิตร",
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
            const data = carouselData[currentSlide];
            const titleElement = document.querySelector('.carousel-title');
            const descriptionElement = document.querySelector('.carousel-description');
            const buttonsContainer = document.querySelector('.carousel-buttons');

            if (titleElement) titleElement.textContent = data.title;
            if (descriptionElement) descriptionElement.textContent = data.description;

            if (buttonsContainer && data.id) {
                let buttonHTML = '';

                if (data.is_registered) {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-green-500 px-6 py-2 text-nowrap text-white" disabled>สมัครแล้ว</button>';
                } else if (data.participants_count >= data.accept_amount) {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-red-500 px-6 py-2 text-nowrap text-white" disabled>เต็มแล้ว</button>';
                } else if (data.status === "pending" || data.status === "ongoing") {
                    buttonHTML = `<button class="cursor-pointer rounded-xl bg-sky-400 px-6 py-2 text-nowrap text-white hover:bg-sky-600" onclick="registerForActivity(${data.id}, '${data.title}')">สมัครเข้าร่วม</button>`;
                } else {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-gray-400 px-6 py-2 text-nowrap text-white" disabled>ปิดการสมัคร</button>';
                }

                buttonHTML += `<a href="/activity/detail/${data.id}" class="cursor-pointer rounded-xl bg-white px-6 py-2 text-sky-400 hover:bg-gray-300">รายละเอียด</a>`;
                buttonsContainer.innerHTML = buttonHTML;
            }
        }

        // Update carousel text every 5 seconds (matching the slide timing)
        setInterval(() => {
            currentSlide = (currentSlide + 1) % 3;
            updateCarouselText();
        }, 5000);

        function registerForActivity(activityId, activityName) {
            const activity = activitiesData.find((a) => a.id === activityId);
            if (!activity) return;

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
                            `คุณได้สมัครเข้าร่วมกิจกรรม "${activity.name_th}" เรียบร้อยแล้ว`,
                        );

                        button.textContent = 'สมัครแล้ว';
                        button.className =
                            'flex-1 cursor-not-allowed rounded-lg bg-green-500 px-4 py-2 text-white';
                        button.disabled = true;

                        // Update participant count
                        const participantsElement = button
                            .closest('.activity-card')
                            .querySelector('i.fa-users')?.parentElement;
                        if (participantsElement) {
                            const currentText = participantsElement.textContent;
                            const match = currentText.match(/(\d+)\/(\d+)/);
                            if (match) {
                                const newCount = parseInt(match[1]) + 1;
                                participantsElement.innerHTML = `<i class="fa-solid fa-users mr-1"></i>รับสมัคร ${newCount}/${match[2]} คน`;
                            }
                        }

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

        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.activity-card');

            cards.forEach((card) => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-4px)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0)';
                });
            });
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
            transition: transform 0.2s ease-in-out;
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
    </style>
@endsection
