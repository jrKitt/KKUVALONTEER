@extends("components/layouts/layoutAdmin")

@section("title")
    activities | KKU VOLUNTEER
@endsection

@php
    if (! function_exists("thaiDate")) {
        function thaiDate($dateString)
        {
            $months = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
            $ts = strtotime($dateString);
            $day = date("j", $ts);
            $month = $months[(int) date("n", $ts)];
            $year = date("Y", $ts) + 543;
            return "$day $month $year";
        }
    }

    $faculties = [
        "กลุ่มสาขาวิชาวิทยาศาสตร์เทคโนโลยี" => ["คณะเกษตรศาสตร์", "คณะเทคโนโลยี", "คณะวิศวกรรมศาสตร์", "คณะวิทยาศาสตร์", "คณะสถาปัตยกรรมศาสตร์", "วิทยาลัยการคอมพิวเตอร์"],
        "กลุ่มสาขาวิชาวิทยาศาสตร์สุขภาพ" => ["คณะพยาบาลศาสตร์", "คณะแพทยศาสตร์", "คณะเทคนิคการแพทย์", "คณะสาธารณสุขศาสตร์", "คณะทันตแพทยศาสตร์", "คณะเภสัชศาสตร์", "คณะสัตวแพทยศาสตร์"],
        "กลุ่มสาขาวิชามนุษยศาสตร์และสังคมศาสตร์" => ["คณะศึกษาศาสตร์", "คณะมนุษยศาสตร์และสังคมศาสตร์", "คณะบริหารธุรกิจและการบัญชี", "คณะศิลปกรรมศาสตร์", "คณะเศรษฐศาสตร์", "คณะนิติศาสตร์", "วิทยาลัยการปกครองท้องถิ่น", "วิทยาลัยบัณฑิตศึกษาการจัดการ"],
        "กลุ่มสหสาขาวิชา" => ["บัณฑิตวิทยาลัย", "วิทยาลัยนานาชาติ", "คณะสหวิทยาการ"],
    ];


    $selectedFaculty = request('faculty');
    $search = request('search');
    $filtered = $rec->filter(function($activity) use ($selectedFaculty, $search) {
        $matchFaculty = !$selectedFaculty || ($activity->user && $activity->user->faculty === $selectedFaculty);
        $matchSearch = !$search || str_contains(strtolower($activity->name_th), strtolower($search));
        return $matchFaculty && $matchSearch;
    });
@endphp

<script>
    let tags = [];

    function renderTags() {
        const container = document.getElementById('tag-container');
        container.innerHTML = '';

        tags.forEach((tag, index) => {
            const tagEl = document.createElement('div');
            tagEl.className =
                'bg-gray-200 h-7 flex gap-1 items-center px-3 rounded-sm';
            tagEl.innerHTML = `
                            <p class="text-xs">${tag}</p>
                            <button type="button" class="text-xs text-red-500" onclick="removeTag(${index})">x</button>
                            <input type="hidden" name="tag[]" value="${tag}">
                        `;
            container.appendChild(tagEl);
        });
    }

    function addTag() {
        const input = document.getElementById('tag-input');
        const value = input.value.trim();
        if (value && !tags.includes(value)) {
            tags.push(value);
            renderTags();
            input.value = '';
        }
    }

    function removeTag(index) {
        tags.splice(index, 1);
        renderTags();
    }

    let editTags = [];

    function openEditModal(activity) {
        document.getElementById('editForm').action = `/activity/${activity.id}`;
        document.getElementById('edit_id').value = activity.id;
        document.getElementById('edit_name').value = activity.name_th;
        document.getElementById('edit_des').value = activity.description || '';
        document.getElementById('edit_start').value = activity.start_time
            ?.slice(0, 16)
            .replace(' ', 'T');
        document.getElementById('edit_end').value = activity.end_time
            ?.slice(0, 16)
            .replace(' ', 'T');
        document.getElementById('edit_hour').value = activity.total_hour;
        document.getElementById('edit_accept').value = activity.accept_amount;
        document.getElementById('edit_location').value = activity.location;

        editTags = [];
        try {
            editTags = JSON.parse(activity.tags || '[]');
        } catch (e) {}

        renderEditTags();
        edit_modal.showModal();
    }

    function addEditTag() {
        const input = document.getElementById('edit-tag-input');
        const value = input.value.trim();
        if (value && !editTags.includes(value)) {
            editTags.push(value);
            renderEditTags();
            input.value = '';
        }
    }

    function removeEditTag(index) {
        editTags.splice(index, 1);
        renderEditTags();
    }

    function renderEditTags() {
        const container = document.getElementById('edit-tag-container');
        container.innerHTML = '';

        editTags.forEach((tag, index) => {
            const tagEl = document.createElement('div');
            tagEl.className =
                'bg-gray-200 h-7 flex gap-1 items-center px-3 rounded-sm';
            tagEl.innerHTML = `
                        <p class="text-xs">${tag}</p>
                        <button type="button" class="text-xs text-red-500" onclick="removeEditTag(${index})">x</button>
                        <input type="hidden" name="tags[]" value="${tag}">
                    `;
            container.appendChild(tagEl);
        });
    }
</script>

@section("layout-content")
    <div class="mx-4 min-h-screen bg-gray-50 text-black">
        <!-- Success/Error Messages -->
        @if (session("success"))
            <div class="mx-auto mb-4 max-w-6xl">
                <div
                    class="relative rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700"
                    role="alert"
                >
                    <span class="block sm:inline">
                        {{ session("success") }}
                    </span>
                </div>
            </div>
        @endif

        @if (session("error"))
            <div class="mx-auto mb-4 max-w-6xl">
                <div
                    class="relative rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                    role="alert"
                >
                    <span class="block sm:inline">{{ session("error") }}</span>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-auto mb-4 max-w-6xl">
                <div
                    class="relative rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                    role="alert"
                >
                    <strong class="font-bold">เกิดข้อผิดพลาด!</strong>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="mx-auto aspect-auto max-w-6xl px-2">
            <div
                class="my-6 flex w-full items-center justify-between gap-4 max-md:flex-col"
            >
                <div class="text-3xl font-semibold sm:text-4xl md:text-5xl">
                    จัดการกิจกรรม
                </div>
                <div class="flex w-full flex-col gap-3 sm:gap-5 md:w-auto">
                    <section
                        class="flex w-full items-center justify-end gap-3 sm:gap-5"
                    >
                        {{--
                            <div
                            class="cursor-pointer rounded-lg border-2 border-gray-400 p-1 transition-all hover:bg-stone-500/20 active:scale-90"
                            >
                            <i class="fa-solid fa-calendar"></i>
                            </div>
                        --}}
                        <button
                            class="cursor-pointer rounded-md bg-green-500/80 px-3 py-1 text-sm whitespace-nowrap text-white transition-all hover:bg-green-600/80 active:scale-90 sm:px-4 sm:text-base"
                            onclick="my_modal_1.showModal()"
                        >
                            + เพิ่มกิจกรรม
                        </button>
                    </section>
                    <section class="flex flex-col gap-2 sm:flex-row">
                        <form
                            method="GET"
                            action="/admin/event"
                            class="flex gap-2"
                        >
                            @if(request("faculty") || request("search"))
                                <a
                                    href="{{ url('/admin/event') }}"
                                    class="btn btn-sm sm:btn-md btn-ghost text-gray-700 border border-gray-300 hover:bg-gray-100 w-3"
                                >
                                    <i class="fa-solid fa-rotate-right"></i>
                                </a>
                            @endif
                            {{-- <select
                                name="faculty"
                                class="w-full rounded-xl border-2 border-gray-400 px-2 py-1 text-sm sm:w-auto"
                                onchange="this.form.submit()"
                            >
                                <option
                                    value=""
                                    disabled
                                    {{ request("faculty") ? "" : "selected" }}
                                >
                                    -- ทุกคณะ --
                                </option>
                                @foreach ($faculties as $group => $items)
                                    <optgroup label="{{ $group }}">
                                        @foreach ($items as $faculty)
                                            <option
                                                value="{{ $faculty }}"
                                                {{ request("faculty") == $faculty ? "selected" : "" }}
                                            >
                                                {{ $faculty }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select> --}}

                            <input
                                type="text"
                                name="search"
                                value="{{ request("search") }}"
                                placeholder="ชื่อกิจกรรม..."
                                class="rounded-xl border-2 border-gray-400 px-2 py-1 text-sm sm:w-auto"
                            />
                            <button
                                class="btn btn-sm sm:btn-md btn-info text-white"
                            >
                                ค้นหา
                            </button>


                        </form>
                    </section>
                </div>
            </div>
            <hr class="my-6 text-gray-400" />
        </div>

        <main>
            <script>
                function confirmDelete(e) {
                    if (!confirm('ยืนยันการลบกิจกรรมนี้หรือไม่?')) {
                        e.preventDefault();
                        return false;
                    }
                    return true;
                }

                function confirmFinish(e, activityName) {
                    if (!confirm(`ยืนยันการเสร็จสิ้นกิจกรรม "${activityName}" หรือไม่?\n\nเมื่อจบกิจกรรมแล้วจะไม่สามารถแก้ไขได้`)) {
                        e.preventDefault();
                        return false;
                    }
                    return true;
                }
            </script>
           @if ($filtered->isEmpty())
                <div class="mx-auto my-10 max-w-2xl text-center text-gray-500">
                    ไม่พบกิจกรรมที่ตรงกับการค้นหา
                </div>
            @else
                <div class="mx-auto grid w-full max-w-6xl grid-cols-1 gap-5 pb-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($filtered as $activity)
                    <div class="w-full rounded-xl shadow-md">
                        <div class="p-4">
                            <section>
                                <div
                                    id="activity_card_{{ $activity->id }}"
                                    class="py- absolute m-2 rounded-full bg-red-100 px-2 text-sm text-red-600/80"
                                >
                                    {{ $activity->day_left }} Day left
                                </div>

                                @if ($activity->image_file_name)
                                    <img
                                        src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                                        alt="{{ $activity->name_th }}"
                                        class="h-48 w-full rounded-xl object-cover"
                                    />
                                @else
                                    <img
                                        src="{{ asset("images/family.png") }}"
                                        alt="img"
                                        class="h-48 w-full rounded-xl object-cover"
                                    />
                                @endif
                            </section>
                            <section class="my-2 flex flex-col gap-2">
                                <h1>{{ $activity->name_th }}</h1>
                                <div
                                    class="] flex gap-2 [&_div]:rounded-full [&_div]:px-2 [&_div]:py-1 [&_div]:text-sm [&_div]:text-white"
                                >
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-500',
                                            'ongoing' => 'bg-blue-500',
                                            'finished' => 'bg-gray-500'
                                        ];
                                        $statusTexts = [
                                            'pending' => 'รอดำเนินการ',
                                            'ongoing' => 'กำลังดำเนินการ',
                                            'finished' => 'เสร็จสิ้น'
                                        ];
                                    @endphp

                                    <div class="{{ $statusColors[$activity->status] ?? 'bg-gray-500' }}">
                                        {{ $statusTexts[$activity->status] ?? $activity->status }}
                                    </div>

                                    @if($activity->is_expired && $activity->status !== 'finished')
                                        <div class="bg-red-500">
                                            หมดเขต
                                        </div>
                                    @endif

                                    <div class="bg-green-500">
                                        #{{ $activity->user->faculty ?? "ไม่ทราบคณะ" }}
                                    </div>
                                </div>
                                <div>
                                    <h6 class="text-gray-600">
                                        {{ $activity->name_th }}
                                    </h6>
                                    <p class="line-clamp-3 text-gray-600">
                                        {{ $activity->description }}
                                    </p>
                                </div>
                                <div>
                                    <div
                                        class="mb-3 flex items-center justify-between text-sm text-gray-500"
                                    >
                                        <div class="flex items-center">
                                            <i
                                                class="fa-solid fa-location-dot"
                                            ></i>
                                            <p class="line-clamp-1">
                                                {{ $activity->location }}
                                            </p>
                                        </div>
                                        <div class="flex items-center text-xs">
                                            <i class="fa-solid fa-clock"></i>
                                            <p class=" w-10">

                                                {{ $activity->total_hour }} ชม.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-3 text-xs text-gray-500">
                                        <i class="fa-solid fa-users mr-1"></i>
                                        ผู้เข้าร่วม {{ $activity->participants_count ?? 0 }}/{{ $activity->accept_amount }} คน
                                    </div>
                                    <div class="mb-3 text-xs text-gray-500">
                                        <i
                                            class="fa-solid fa-calendar-days"
                                        ></i>
                                        {{ thaiDate($activity->start_time) }}
                                    </div>
                                </div>
                            </section>
                            <section class="flex flex-col gap-2">
                                <!-- Checkin Button -->
                                <a
                                    href="{{ route("admin.activity.checkin", $activity->id) }}"
                                    class="w-full rounded-xl bg-green-500/80 py-2 text-center text-sm text-white transition-colors hover:bg-green-600/80 sm:text-base"
                                >
                                    เช็คชื่อกิจกรรม
                                </a>

                                @php
                                    $isExpired = $activity->start_time && now() > $activity->start_time;
                                    $isNotFinished = $activity->status !== 'finished';
                                @endphp

                                @if($isExpired && $isNotFinished)
                                    <form
                                        action="{{ route('activity.finish', $activity->id) }}"
                                        method="POST"
                                        onsubmit="return confirmFinish(event, '{{ $activity->name_th }}')"
                                        class="w-full"
                                    >
                                        @csrf
                                        <button
                                            type="submit"
                                            class="w-full rounded-xl bg-blue-500/80 py-2 text-sm text-white transition-colors hover:bg-blue-600/80 sm:text-base animate-pulse"
                                        >
                                            เสร็จสิ้นกิจกรรม
                                        </button>
                                    </form>
                                @elseif($activity->status === 'finished')
                                    <div class="w-full rounded-xl bg-gray-400 py-2 text-center text-sm text-white sm:text-base">
                                        <i class="fa-solid fa-check mr-1"></i>
                                        กิจกรรมเสร็จสิ้นแล้ว
                                    </div>
                                @endif

                                <div class="flex gap-2 sm:gap-5">
                                    @if($activity->status === 'finished')
                                        <button
                                            class="w-1/2 rounded-xl bg-gray-400 py-2 text-sm text-white cursor-not-allowed sm:text-base"
                                            disabled
                                        >
                                            แก้ไขไม่ได้
                                        </button>
                                    @else
                                        <button
                                            class="w-1/2 rounded-xl bg-amber-400/80 py-2 text-sm text-white sm:text-base"
                                            onclick="openEditModal({{ $activity->toJson() }})"
                                        >
                                            แก้ไขข้อมูล
                                        </button>
                                    @endif

                                    <form
                                        class="w-1/2"
                                        action="{{ route("activity.delete", $activity->id) }}"
                                        method="POST"
                                        onsubmit="return confirmDelete(event)"
                                    >
                                        @csrf
                                        @method("DELETE")
                                        <button
                                            type="submit"
                                            class="w-full rounded-xl border border-red-400 py-2 text-sm text-red-400 shadow sm:text-base {{ $activity->status === 'finished' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ $activity->status === 'finished' ? 'disabled' : '' }}
                                        >
                                            ลบข้อมูล
                                        </button>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                    @endforeach
                 @endif
            </div>
        </main>

        <dialog id="my_modal_1" class="modal">
            <form
                action="/activity"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                <div
                    class="modal-box w-11/12 max-w-5xl rounded-xl [&_input]:text-lg [&_label]:text-lg [&_textarea]:text-lg"
                >
                    <div class="card">
                        <div class="card-title mb-4">สร้างกิจกรรมใหม่่</div>
                        <hr class="text-gray-300" />
                        <div class="card-body grid grid-cols-12 gap-5">
                            <div class="fieldset col-span-6 max-md:col-span-12">
                                <label class="">ชื่อกิจกรรม</label>
                                <input
                                    name="activity_name"
                                    type="text"
                                    required
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                    placeholder="ชื่อกิจกรรม..."
                                />
                            </div>

                            <div class="fieldset col-span-12">
                                <label class="">รายละเอียดกิจกรรม</label>
                                <textarea
                                    id=""
                                    cols="30"
                                    name="des"
                                    required
                                    rows="5"
                                    class="textarea-xs rounded-md border border-gray-400 px-4 py-2"
                                    placeholder="รายละเอียด..."
                                ></textarea>
                            </div>

                            <div class="fieldset col-span-4 max-md:col-span-12">
                                <label class="">วัน/เวลา เริ่มกิจกรรม</label>
                                <input
                                    type="datetime-local"
                                    required
                                    name="start_time"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                    placeholder="วันเริ่มกิจกรรม..."
                                />
                            </div>

                            <div class="fieldset col-span-4 max-md:col-span-12">
                                <label class="">วัน/เวลา จบกิจกรรม</label>
                                <input
                                    type="datetime-local"
                                    required
                                    name="end_time"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                    placeholder="วันเริ่มกิจกรรม..."
                                />
                            </div>

                            <div
                                class="fieldset col-span-4 pr-6 max-md:col-span-12"
                            >
                                <label class="">จำนวนชั่วโมงรวม</label>
                                <input
                                    type="number"
                                    required
                                    name="total_hour"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="fieldset col-span-4 max-md:col-span-12">
                                <label class="">จำนวนผู้เข้าร่วมสูงสุด</label>
                                <input
                                    type="number"
                                    required
                                    name="accept_amount"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="fieldset col-span-8 max-md:col-span-12">
                                <label class="">สถานที่</label>
                                <input
                                    type="text"
                                    required
                                    name="location"
                                    placeholder="สถานที่..."
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="col-span-12">
                                <label for="">แท็กกิจกรรม</label>
                                <div
                                    id="tag-container"
                                    class="flex min-h-20 w-full flex-wrap gap-2 rounded-md border-2 border-gray-300 p-3"
                                ></div>
                                <div class="mt-2 flex">
                                    <input
                                        type="text"
                                        id="tag-input"
                                        class="flex-1 rounded-md border border-gray-400 px-4 py-2"
                                        placeholder="ชื่อแท็ก..."
                                    />
                                    <button
                                        type="button"
                                        class="btn ml-1"
                                        onclick="addTag()"
                                    >
                                        เพิ่มแท็ก
                                    </button>
                                </div>
                                <div class="mt-1 text-sm text-gray-500">
                                    กด Enter หรือคลิก "เพิ่มแท็ก"
                                    เพื่อเพิ่มแท็กใหม่
                                </div>
                            </div>

                            <div class="fieldset col-span-12">
                                <label class="">รูปภาพกิจกรรม</label>
                                <div
                                    class="flex items-center space-x-2 rounded-md border border-gray-300"
                                >
                                    <label
                                        for="file-upload"
                                        class="cursor-pointer bg-gray-100 px-4 py-2 text-sm hover:bg-gray-200"
                                    >
                                        เลือกรูปภาพ...
                                    </label>

                                    <input
                                        id="file-upload"
                                        name="activity_image"
                                        type="file"
                                        accept="image/*"
                                        class="hidden"
                                        onchange="updateFileName(this)"
                                    />

                                    <span
                                        id="file-name"
                                        class="text-sm text-gray-500"
                                    >
                                        ยังไม่ได้เลือกไฟล์
                                    </span>
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    รองรับไฟล์: JPG, PNG, GIF (ขนาดไม่เกิน 5MB)
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="text-gray-300" />
                    <div class="modal-action">
                        <button
                            type="button"
                            class="cursor-pointer rounded-xl border-2 border-sky-400 px-12 py-2 text-sky-400 transition-all hover:bg-gray-100 active:scale-90"
                            onclick="my_modal_1.close()"
                        >
                            ยกเลิก
                        </button>
                        <input
                            type="submit"
                            value="ยืนยัน"
                            class="cursor-pointer rounded-xl border-2 bg-sky-400 px-12 py-2 text-white transition-all hover:bg-sky-500 active:scale-90"
                        />
                    </div>
                </div>
            </form>
        </dialog>

        <dialog id="edit_modal" class="modal">
            <script></script>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div
                    class="modal-box w-11/12 max-w-5xl rounded-xl [&_input]:text-lg [&_label]:text-lg [&_textarea]:text-lg"
                >
                    <div class="card">
                        <div class="card-title mb-4">แก้ไขกิจกรรม</div>
                        <hr class="text-gray-300" />
                        <div class="card-body grid grid-cols-12 gap-5">
                            <input
                                type="hidden"
                                name="activity_id"
                                id="edit_id"
                            />

                            <div class="fieldset col-span-6 max-md:col-span-12">
                                <label>ชื่อกิจกรรม</label>
                                <input
                                    type="text"
                                    id="edit_name"
                                    name="activity_name"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                    required
                                />
                            </div>

                            <div class="fieldset col-span-12">
                                <label>รายละเอียดกิจกรรม</label>
                                <textarea
                                    id="edit_des"
                                    name="des"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                    rows="4"
                                ></textarea>
                            </div>

                            <div
                                class="fieldset col-span-4 mr-3 max-md:col-span-12"
                            >
                                <label>วัน/เวลาเริ่มกิจกรรม</label>
                                <input
                                    type="datetime-local"
                                    id="edit_start"
                                    name="start_time"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="fieldset col-span-4 max-md:col-span-12">
                                <label>วัน/เวลาจบกิจกรรม</label>
                                <input
                                    type="datetime-local"
                                    id="edit_end"
                                    name="end_time"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="fieldset col-span-4 max-md:col-span-12">
                                <label>จำนวนชั่วโมงรวม</label>
                                <input
                                    type="number"
                                    id="edit_hour"
                                    name="total_hour"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="fieldset col-span-4 max-md:col-span-12">
                                <label>จำนวนผู้เข้าร่วมสูงสุด</label>
                                <input
                                    type="number"
                                    id="edit_accept"
                                    name="accept_amount"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="fieldset col-span-8 max-md:col-span-12">
                                <label>สถานที่</label>
                                <input
                                    type="text"
                                    id="edit_location"
                                    name="location"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="col-span-12">
                                <label for="">แท็กกิจกรรม</label>
                                <div
                                    id="edit-tag-container"
                                    class="flex min-h-20 w-full flex-wrap gap-2 rounded-md border-2 border-gray-300 p-3"
                                ></div>
                                <div class="mt-2 flex">
                                    <input
                                        type="text"
                                        id="edit-tag-input"
                                        class="flex-1 rounded-md border border-gray-400 px-4 py-2"
                                        placeholder="ชื่อแท็ก..."
                                    />
                                    <button
                                        type="button"
                                        class="btn ml-1"
                                        onclick="addEditTag()"
                                    >
                                        เพิ่มแท็ก
                                    </button>
                                </div>
                                <div class="mt-1 text-sm text-gray-500">
                                    กด Enter หรือคลิก "เพิ่มแท็ก"
                                    เพื่อเพิ่มแท็กใหม่
                                </div>
                            </div>

                            <div class="col-span-12">
                                <label class="">รูปภาพกิจกรรม</label>
                                <div
                                    class="flex items-center space-x-2 rounded-md border border-gray-300"
                                >
                                    <label
                                        for="edit-file-upload"
                                        class="cursor-pointer bg-gray-100 px-4 py-2 text-sm hover:bg-gray-200"
                                    >
                                        เลือกรูปภาพ...
                                    </label>

                                    <input
                                        id="edit-file-upload"
                                        name="activity_image"
                                        type="file"
                                        accept="image/*"
                                        class="hidden"
                                        onchange="updateEditFileName(this)"
                                    />

                                    <span
                                        id="edit-file-name"
                                        class="text-sm text-gray-500"
                                    >
                                        ยังไม่ได้เลือกไฟล์
                                    </span>
                                </div>
                                <div class="mt-2 text-sm text-gray-500">
                                    รองรับไฟล์: JPG, PNG, GIF (ขนาดไม่เกิน 5MB)
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="text-gray-300" />

                    <div class="modal-action">
                        <button
                            type="button"
                            class="cursor-pointer rounded-xl border-2 border-sky-400 px-12 py-2 text-sky-400 transition-all hover:bg-gray-100 active:scale-90"
                            onclick="edit_modal.close()"
                        >
                            ยกเลิก
                        </button>
                        <button
                            type="submit"
                            class="cursor-pointer rounded-xl border-2 bg-sky-400 px-12 py-2 text-white transition-all hover:bg-sky-500 active:scale-90"
                        >
                            บันทึกการแก้ไข
                        </button>
                    </div>
                </div>
            </form>
        </dialog>
    </div>

    <script>
        let tags = [];

        const updateFileName = (input) => {
            const fileName =
                input.files.length > 0
                    ? input.files[0].name
                    : 'ยังไม่ได้เลือกไฟล์';
            document.getElementById('file-name').textContent = fileName;

            if (input.files.length > 0) {
                const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
                document.getElementById('file-name').textContent =
                    `${fileName} (${fileSize} MB)`;
            }
        };

        function addTag() {
            const tagInput = document.getElementById('tagInput');
            const tagValue = tagInput.value.trim();

            if (tagValue && !tags.includes(tagValue)) {
                tags.push(tagValue);
                updateTagsDisplay();
                tagInput.value = '';
            }
        }

        function removeTag(index) {
            tags.splice(index, 1);
            updateTagsDisplay();
        }

        function handleTagKeyPress(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                addTag();
            }
        }

        function updateTagsDisplay() {
            const container = document.getElementById('tagsContainer');
            container.innerHTML = '';

            tags.forEach((tag, index) => {
                const tagElement = document.createElement('span');
                tagElement.className =
                    'inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800';
                tagElement.innerHTML = `
                    ${tag}
                    <button type="button" onclick="removeTag(${index})" class="ml-2 text-blue-600 hover:text-blue-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                container.appendChild(tagElement);
            });

            updateHiddenTagInputs();
        }

        function updateHiddenTagInputs() {
            const existingInputs = document.querySelectorAll(
                'input[name="tags[]"]',
            );
            existingInputs.forEach((input) => input.remove());

            const form = document.querySelector('form');
            tags.forEach((tag) => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'tags[]';
                hiddenInput.value = tag;
                form.appendChild(hiddenInput);
            });
        }
    </script>
@endsection
