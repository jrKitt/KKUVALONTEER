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
                            <div class="relative">
                                <input
                                    type="search"
                                    class="w-70 rounded-xl border border-gray-400 px-4 py-2 pr-10"
                                    placeholder="ค้นหาชื่อกิจกรรม, สถานที่, หรือรายละเอียด"
                                    id="searchInput"
                                    value="{{ request("search") }}"
                                    oninput="searchActivities()"
                                />
                                <i
                                    class="fa-solid fa-search absolute top-1/2 right-3 -translate-y-1/2 transform text-gray-400"
                                ></i>
                            </div>
                            <div class="flex gap-3 max-md:flex-col">
                                <select
                                    name="tag"
                                    id="tagFilter"
                                    class="w-72 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                    onchange="filterActivities()"
                                >
                                    <option value=""># แท็ก</option>
                                    <optgroup label="วิทยาศาสตร์เทคโนโลยี">
                                        <option
                                            value="คณะเกษตรศาสตร์"
                                            {{ request("tag") == "คณะเกษตรศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะเกษตรศาสตร์
                                        </option>
                                        <option
                                            value="คณะเทคโนโลยี"
                                            {{ request("tag") == "คณะเทคโนโลยี" ? "selected" : "" }}
                                        >
                                            คณะเทคโนโลยี
                                        </option>
                                        <option
                                            value="คณะวิศวกรรมศาสตร์"
                                            {{ request("tag") == "คณะวิศวกรรมศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะวิศวกรรมศาสตร์
                                        </option>
                                        <option
                                            value="คณะวิทยาศาสตร์"
                                            {{ request("tag") == "คณะวิทยาศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะวิทยาศาสตร์
                                        </option>
                                        <option
                                            value="คณะสถาปัตยกรรมศาสตร์"
                                            {{ request("tag") == "คณะสถาปัตยกรรมศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะสถาปัตยกรรมศาสตร์
                                        </option>
                                        <option
                                            value="วิทยาลัยการคอมพิวเตอร์"
                                            {{ request("tag") == "วิทยาลัยการคอมพิวเตอร์" ? "selected" : "" }}
                                        >
                                            วิทยาลัยการคอมพิวเตอร์
                                        </option>
                                    </optgroup>
                                    <optgroup label="วิทยาศาสตร์สุขภาพ">
                                        <option
                                            value="คณะพยาบาลศาสตร์"
                                            {{ request("tag") == "คณะพยาบาลศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะพยาบาลศาสตร์
                                        </option>
                                        <option
                                            value="คณะแพทยศาสตร์"
                                            {{ request("tag") == "คณะแพทยศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะแพทยศาสตร์
                                        </option>
                                        <option
                                            value="คณะเทคนิคการแพทย์"
                                            {{ request("tag") == "คณะเทคนิคการแพทย์" ? "selected" : "" }}
                                        >
                                            คณะเทคนิคการแพทย์
                                        </option>
                                        <option
                                            value="คณะสาธารณสุขศาสตร์"
                                            {{ request("tag") == "คณะสาธารณสุขศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะสาธารณสุขศาสตร์
                                        </option>
                                        <option
                                            value="คณะทันตแพทยศาสตร์"
                                            {{ request("tag") == "คณะทันตแพทยศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะทันตแพทยศาสตร์
                                        </option>
                                        <option
                                            value="คณะเภสัชศาสตร์"
                                            {{ request("tag") == "คณะเภสัชศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะเภสัชศาสตร์
                                        </option>
                                        <option
                                            value="คณะสัตวแพทยศาสตร์"
                                            {{ request("tag") == "คณะสัตวแพทยศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะสัตวแพทยศาสตร์
                                        </option>
                                    </optgroup>
                                    <optgroup label="มนุษยศาสตร์และสังคมศาสตร์">
                                        <option
                                            value="คณะศึกษาศาสตร์"
                                            {{ request("tag") == "คณะศึกษาศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะศึกษาศาสตร์
                                        </option>
                                        <option
                                            value="คณะมนุษยศาสตร์และสังคมศาสตร์"
                                            {{ request("tag") == "คณะมนุษยศาสตร์และสังคมศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะมนุษยศาสตร์และสังคมศาสตร์
                                        </option>
                                        <option
                                            value="คณะบริหารธุรกิจและการบัญชี"
                                            {{ request("tag") == "คณะบริหารธุรกิจและการบัญชี" ? "selected" : "" }}
                                        >
                                            คณะบริหารธุรกิจและการบัญชี
                                        </option>
                                        <option
                                            value="คณะศิลปกรรมศาสตร์"
                                            {{ request("tag") == "คณะศิลปกรรมศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะศิลปกรรมศาสตร์
                                        </option>
                                        <option
                                            value="คณะเศรษฐศาสตร์"
                                            {{ request("tag") == "คณะเศรษฐศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะเศรษฐศาสตร์
                                        </option>
                                        <option
                                            value="คณะนิติศาสตร์"
                                            {{ request("tag") == "คณะนิติศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะนิติศาสตร์
                                        </option>
                                        <option
                                            value="วิทยาลัยการปกครองท้องถิ่น"
                                            {{ request("tag") == "วิทยาลัยการปกครองท้องถิ่น" ? "selected" : "" }}
                                        >
                                            วิทยาลัยการปกครองท้องถิ่น
                                        </option>
                                        <option
                                            value="วิทยาลัยบัณฑิตศึกษาการจัดการ"
                                            {{ request("tag") == "วิทยาลัยบัณฑิตศึกษาการจัดการ" ? "selected" : "" }}
                                        >
                                            วิทยาลัยบัณฑิตศึกษาการจัดการ
                                        </option>
                                    </optgroup>
                                    <optgroup label="สหสาขาวิชา">
                                        <option
                                            value="บัณฑิตวิทยาลัย"
                                            {{ request("tag") == "บัณฑิตวิทยาลัย" ? "selected" : "" }}
                                        >
                                            บัณฑิตวิทยาลัย
                                        </option>
                                        <option
                                            value="วิทยาลัยนานาชาติ"
                                            {{ request("tag") == "วิทยาลัยนานาชาติ" ? "selected" : "" }}
                                        >
                                            วิทยาลัยนานาชาติ
                                        </option>
                                        <option
                                            value="คณะสหวิทยาการ"
                                            {{ request("tag") == "คณะสหวิทยาการ" ? "selected" : "" }}
                                        >
                                            คณะสหวิทยาการ
                                        </option>
                                    </optgroup>
                                </select>
                                <select
                                    name="status"
                                    id="statusFilter"
                                    class="w-50 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                    onchange="filterActivities()"
                                >
                                    <option value="">สถานะ</option>
                                    <option
                                        value="pending"
                                        {{ request("status") == "pending" ? "selected" : "" }}
                                    >
                                        รอดำเนินการ
                                    </option>
                                    <option
                                        value="ongoing"
                                        {{ request("status") == "ongoing" ? "selected" : "" }}
                                    >
                                        กำลังดำเนินการ
                                    </option>
                                    <option
                                        value="finished"
                                        {{ request("status") == "finished" ? "selected" : "" }}
                                    >
                                        เสร็จสิ้น
                                    </option>
                                </select>
                                <button
                                    id="clearButton"
                                    onclick="clearFilters()"
                                    class="rounded-xl border border-gray-400 px-4 py-1 text-gray-600 transition-colors hover:bg-gray-50"
                                    title="ล้างตัวกรอง"
                                    style="display: none"
                                >
                                    <i class="fa-solid fa-times"></i>
                                    ล้าง
                                </button>
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
                                class="activity-card overflow-hidden rounded-lg bg-white shadow-md flex flex-col justify-between"
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
                                <div class="p-4 grow">
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

                                </div>

                                <div class="flex gap-2 m-4 text-nowrap">
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

        let searchTimeout;

        function searchActivities() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                applyAllFilters();
            }, 300); // ดีเลย์ 300ms
        }

        function filterActivities() {
            applyAllFilters();
        }

        function applyAllFilters() {

            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const statusFilter = document.getElementById('statusFilter').value;
            const tagFilter = document.getElementById('tagFilter').value;
            const cards = document.querySelectorAll('.activity-card');



            let visibleCount = 0;
            let statusCounts = {
                'pending': 0,
                'ongoing': 0,
                'finished': 0
            };

            cards.forEach((card) => {
                let showCard = true;
                const searchData = card.dataset.search || '';
                const cardStatus = card.dataset.status || '';
                const cardTags = card.dataset.tags || '';

                // Apply search filter
                if (searchTerm && !searchData.includes(searchTerm)) {
                    showCard = false;
                }

                // Apply status filter
                if (statusFilter && cardStatus !== statusFilter) {
                    showCard = false;
                }

                // Apply tag filter
                if (tagFilter && !cardTags.includes(tagFilter)) {
                    showCard = false;
                }

                if (showCard) {
                    visibleCount++;
                    if (statusCounts.hasOwnProperty(cardStatus)) {
                        statusCounts[cardStatus]++;
                    }
                }



                if (showCard) {
                    card.classList.remove('hidden-card');
                    card.classList.add('visible-card');

                } else {
                    card.classList.remove('visible-card');
                    card.classList.add('hidden-card');

                }
            });


            updateResultsMessage(visibleCount, searchTerm, statusFilter, tagFilter, statusCounts);
        }

        function updateResultsMessage(visibleCount, searchTerm, statusFilter, tagFilter, statusCounts) {
            const noResultsMsg = document.getElementById('noResultsMessage');
            const resultsInfo = document.getElementById('resultsInfo');
            const clearButton = document.getElementById('clearButton');

            const hasFilters = searchTerm || statusFilter || tagFilter;
            if (clearButton) {
                clearButton.style.display = hasFilters ? 'block' : 'none';
            }

            if (resultsInfo) {
                let filterText = '';
                if (hasFilters) {
                    const filters = [];
                    if (searchTerm) filters.push(`<span class="font-medium text-blue-600">ค้นหา: "${searchTerm}"</span>`);
                    if (tagFilter) filters.push(`<span class="font-medium text-green-600">แท็ก: ${tagFilter}</span>`);
                    if (statusFilter) {
                        const statusTexts = {
                            'pending': 'รอดำเนินการ',
                            'ongoing': 'กำลังดำเนินการ',
                            'finished': 'เสร็จสิ้น'
                        };
                        filters.push(`<span class="font-medium text-orange-600">สถานะ: ${statusTexts[statusFilter] || statusFilter}</span>`);
                    }
                    filterText = filters.join(' | ') + ' | ';
                }

                let statusInfo = '';
                if (!statusFilter && visibleCount > 0) {
                    const statusDisplay = [];
                    if (statusCounts.pending > 0) statusDisplay.push(`<span class="text-yellow-600">${statusCounts.pending} รออนุมัติ</span>`);
                    if (statusCounts.ongoing > 0) statusDisplay.push(`<span class="text-blue-600">${statusCounts.ongoing} ดำเนินการ</span>`);
                    if (statusCounts.finished > 0) statusDisplay.push(`<span class="text-gray-600">${statusCounts.finished} เสร็จสิ้น</span>`);
                    if (statusDisplay.length > 0) {
                        statusInfo = ` (${statusDisplay.join(', ')})`;
                    }
                }

                resultsInfo.innerHTML = `${filterText}พบ <span class="font-semibold text-gray-800">${visibleCount}</span> กิจกรรม${statusInfo}`;
            }

            if (visibleCount === 0) {
                if (!noResultsMsg) {
                    const gridContainer = document.getElementById('activitiesGrid');
                    const noResults = document.createElement('div');
                    noResults.id = 'noResultsMessage';
                    noResults.className = 'col-span-full py-12 text-center';
                    noResults.innerHTML = `
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">ไม่พบกิจกรรม</h3>
                        <p class="mt-1 text-sm text-gray-500">ลองปรับเปลี่ยนคำค้นหาหรือเงื่อนไขการกรอง</p>
                    `;
                    gridContainer.appendChild(noResults);
                }
            } else {
                if (noResultsMsg) {
                    noResultsMsg.remove();
                }
            }
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('tagFilter').value = '';
            applyAllFilters();
        }

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

                if (data.status === "finished") {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-gray-500 px-6 py-2 text-nowrap text-white" disabled><i class="fa-solid fa-check mr-1"></i>กิจกรรมเสร็จสิ้น</button>';
                } else if (data.is_registered) {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-emerald-400 px-6 py-2 text-nowrap text-white" disabled>สมัครแล้ว</button>';
                } else if (data.participants_count >= data.accept_amount) {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-red-500 px-6 py-2 text-nowrap text-white" disabled>เต็มแล้ว</button>';
                } else if (data.status === "pending" || data.status === "ongoing") {
                    @auth
                        buttonHTML = `<form method="POST" action="{{ route('activities.register') }}" style="display: inline;"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="activity_id" value="${data.id}"><button type="submit" class="cursor-pointer rounded-xl bg-cyan-400 px-6 py-2 text-nowrap text-white hover:bg-cyan-500">สมัครเข้าร่วม</button></form>`;
                    @else
                        buttonHTML = `<a href="{{ route('login') }}" class="cursor-pointer rounded-xl bg-cyan-400 px-6 py-2 text-nowrap text-white hover:bg-cyan-500 text-center inline-block">เข้าสู่ระบบเพื่อสมัคร</a>`;
                    @endauth
                } else {
                    buttonHTML = '<button class="cursor-not-allowed rounded-xl bg-gray-400 px-6 py-2 text-nowrap text-white" disabled>ปิดการสมัคร</button>';
                }

                buttonHTML += `<a href="/activity/detail/${data.id}" class="cursor-pointer rounded-xl bg-white px-6 py-2 text-sky-400 hover:bg-gray-300">รายละเอียด</a>`;
                buttonsContainer.innerHTML = buttonHTML;
            }
        }

        setInterval(() => {
            currentSlide = (currentSlide + 1) % 3;
            updateCarouselText();
        }, 5000);

        document.addEventListener('DOMContentLoaded', function () {
            applyAllFilters();

            const cards = document.querySelectorAll('.activity-card');

            cards.forEach((card) => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-4px)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0)';
                });
            });

            applyAllFilters();
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

        /* Optgroup styling */
        optgroup {
            font-weight: bold;
            color: #374151;
            background-color: #f9fafb;
        }

        optgroup option {
            font-weight: normal;
            color: #6b7280;
            padding-left: 1rem;
        }

        select option {
            padding: 0.5rem 0.75rem;
        }

        /* Status and Tags styling */
        .activity-card .status-badge {
            animation: none;
        }

        .activity-card[data-status='finished'] {
            opacity: 0.85;
        }

        .activity-card[data-status='finished'] .status-badge {
            background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
        }

        .activity-card[data-status='ongoing'] .status-badge {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
        }

        .activity-card[data-status='pending'] .status-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        }

        .tag-badge {
            transition: none;
        }
    </style>
@endsection
