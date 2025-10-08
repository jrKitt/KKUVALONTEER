@extends("components/layouts/layoutAfterLogin")

@section("title")
    ชั่วโมงจิตอาสา | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="mx-auto mb-8 max-w-1/2">
                <div
                    class="flex flex-col items-center justify-between gap-2 rounded-lg bg-red-600 p-6 text-white"
                >
                    <div class="text-xl max-sm:text-sm">สถานะปัจจุบัน</div>
                    <div class="text-4xl font-bold max-sm:text-xl">
                        {{ $totalHours ?? 0 }} ชั่วโมง
                    </div>
                    <div class="text-xl max-sm:text-sm">
                        เป้าหมาย 1200 ชั่วโมง
                    </div>
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
                                    <option value="pending">สมัครแล้ว</option>
                                    <option value="finished">เสร็จสิ้น</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <section
                        class="flex flex-wrap justify-center gap-3"
                        id="activitiesContainer"
                    >
                        @forelse ($userActivities as $activity)
                            <div
                                class="activity-card m-2 flex w-full max-w-5xl justify-center rounded-md p-4 shadow-md max-lg:flex-col"
                                data-status="{{ $activity->status }}"
                                data-progress="{{ $activity->progress }}"
                                data-search="{{ strtolower($activity->name . " " . ($activity->description ?? "")) }}"
                            >
                                <div
                                    class="flex w-full items-center justify-between gap-5 max-lg:flex-col"
                                >
                                    <section class="w-fit">
                                        @if ($activity->image_file_name)
                                            <img
                                                src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                                                alt="{{ $activity->name }}"
                                                class="h-32 w-48 rounded-md object-cover"
                                            />
                                        @else
                                            <img
                                                src="{{ asset("/images/event_1.png") }}"
                                                alt="{{ $activity->name }}"
                                                class="h-32 w-48 rounded-md object-cover"
                                            />
                                        @endif
                                    </section>

                                    <section
                                        class="flex w-full flex-col justify-around gap-1"
                                    >
                                        <div
                                            class="flex w-full justify-between max-sm:flex-col-reverse"
                                        >
                                            <h1
                                                class="text-2xl font-bold max-md:text-lg"
                                            >
                                                {{ $activity->name }}
                                            </h1>
                                            <div
                                                class="flex items-center gap-2"
                                            >
                                                <div
                                                    class="@if ($activity->status === "checked_in")
                                                        text-green-600
                                                    @elseif ($activity->status === "finished")
                                                        text-purple-600
                                                    @elseif ($activity->status === "pending")
                                                        text-blue-600
                                                    @else
                                                        text-gray-600
                                                    @endif text-2xl font-medium max-md:text-lg"
                                                >
                                                    @if ($activity->status === "checked_in")
                                                        เช็คชื่อแล้ว
                                                    @elseif ($activity->status === "finished")
                                                        เสร็จสิ้น
                                                    @elseif ($activity->status === "pending")
                                                        ลงทะเบียนแล้ว
                                                    @else
                                                            รอดำเนินการ
                                                    @endif
                                                </div>
                                                @if ($activity->checked_in && $activity->checked_in_at)
                                                    <div
                                                        class="text-sm text-gray-500"
                                                    >
                                                        {{ \Carbon\Carbon::parse($activity->checked_in_at)->format("d/m/Y H:i") }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            @foreach ($activity->tags as $tag)
                                                <div
                                                    class="flex items-center rounded-full border bg-green-600 px-4 py-1 text-sm text-white"
                                                >
                                                    {{ $tag }}
                                                </div>
                                            @endforeach
                                        </div>
                                        <div
                                            class="flex gap-3 text-sm max-sm:flex-col"
                                        >
                                            <div
                                                class="flex w-100 items-center"
                                            >
                                                <div class="w-6">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 640 640"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div class="text-wrap">
                                                    {{ $activity->location }}
                                                </div>
                                            </div>

                                            <div class="flex items-center">
                                                <div class="w-6">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 640 640"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            d="M192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 128C512 92.7 483.3 64 448 64L192 64zM224 128L416 128C433.7 128 448 142.3 448 160L448 192C448 209.7 433.7 224 416 224L224 224C206.3 224 192 209.7 192 192L192 160C192 142.3 206.3 128 224 128z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    {{ $activity->start_date->format("d M Y") }}
                                                </div>
                                            </div>

                                            <div class="flex items-center">
                                                <div class="w-6">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 640 640"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            d="M320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320C64 178.6 178.6 64 320 64zM296 184L296 320C296 328 300 335.5 306.7 340L402.7 404C413.7 411.4 428.6 408.4 436 397.3C443.4 386.2 440.4 371.4 429.3 364L344 307.2L344 184C344 170.7 333.3 160 320 160C306.7 160 296 170.7 296 184z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    {{ $activity->total_hours }}
                                                    ชั่วโมง
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="flex w-full items-center justify-between gap-2 max-lg:flex-col max-lg:items-stretch"
                                        >
                                            <div class="flex-1">
                                                <div
                                                    class="flex justify-between font-medium text-gray-600"
                                                >
                                                    <div>ดำเนินการไปแล้ว</div>
                                                    <div>
                                                        {{ $activity->completed_hours }}
                                                        ชั่วโมง
                                                    </div>
                                                </div>
                                                <div
                                                    class="h-5 w-full rounded-full bg-gray-200 max-lg:w-full max-md:w-full"
                                                >
                                                    <div
                                                        class="h-5 rounded-full bg-blue-600 transition-all duration-300"
                                                        style="
                                                            width: {{ $activity->progress }}%;
                                                        "
                                                    ></div>
                                                </div>
                                                <div
                                                    class="mt-1 text-xs text-gray-500"
                                                >
                                                    {{ $activity->progress }}%
                                                    เสร็จสิ้น
                                                </div>
                                            </div>
                                            <div>
                                                <div
                                                    class="flex items-center justify-center gap-2"
                                                >
                                                    <a
                                                        href="{{ route("activity.detail", $activity->id) }}"
                                                    >
                                                        <button
                                                            class="btn border bg-sky-400 text-nowrap text-white hover:bg-sky-600"
                                                        >
                                                            รายละเอียด
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <div
                                    class="mx-auto mb-4 h-12 w-12 text-gray-400"
                                >
                                    <svg
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
                                </div>
                                <h3
                                    class="mt-2 text-sm font-medium text-gray-900"
                                >
                                    ยังไม่มีกิจกรรมที่เข้าร่วม
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    คุณยังไม่ได้สมัครเข้าร่วมกิจกรรมใดๆ
                                </p>
                                <div class="mt-6">
                                    <a
                                        href="{{ route("user.activities") }}"
                                        class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700"
                                    >
                                        ดูกิจกรรมทั้งหมด
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </section>
                </section>
            </main>
        </section>
    </div>

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
            const progressFilterElement =
                document.getElementById('progressFilter');

            const searchTerm = searchInput
                ? searchInput.value.toLowerCase()
                : '';
            const statusFilter = statusFilterElement
                ? statusFilterElement.value
                : '';
            const progressFilter = progressFilterElement
                ? progressFilterElement.value
                : '';
            const activityCards = document.querySelectorAll('.activity-card');

            activityCards.forEach((card) => {
                const searchText = card.dataset.search;
                const status = card.dataset.status;
                const progress = parseInt(card.dataset.progress);

                let showCard = true;

                if (searchTerm && !searchText.includes(searchTerm)) {
                    showCard = false;
                }

                if (statusFilter && statusFilter !== status) {
                    showCard = false;
                }

                if (progressFilter) {
                    switch (progressFilter) {
                        case '0-25':
                            if (progress > 25) showCard = false;
                            break;
                        case '26-50':
                            if (progress < 26 || progress > 50)
                                showCard = false;
                            break;
                        case '51-75':
                            if (progress < 51 || progress > 75)
                                showCard = false;
                            break;
                        case '76-100':
                            if (progress < 76) showCard = false;
                            break;
                    }
                }

                card.style.display = showCard ? 'flex' : 'none';
            });

            const visibleCards = Array.from(activityCards).filter(
                (card) => card.style.display !== 'none',
            );
            const container = document.getElementById('activitiesContainer');

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

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');

            if (searchInput) {
                searchInput.addEventListener('input', searchActivities);
            }

            if (statusFilter) {
                statusFilter.addEventListener('change', filterActivities);
            }
        });
    </script>
@endsection
