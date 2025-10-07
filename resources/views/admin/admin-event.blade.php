@extends("components/layouts/layoutAdmin")

@section("title")
    admin event | KKU VOLUNTEER
@endsection

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
                <div class="text-3xl font-bold sm:text-4xl md:text-5xl">
                    จัดการกิจกรรม
                </div>
                <div class="flex w-full flex-col gap-3 sm:gap-5 md:w-auto">
                    <section
                        class="flex w-full items-center justify-end gap-3 sm:gap-5"
                    >
                        <div
                            class="cursor-pointer rounded-lg border-2 border-gray-400 p-1 transition-all hover:bg-stone-500/20 active:scale-90"
                        >
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <button
                            class="cursor-pointer rounded-md bg-green-500/80 px-3 py-1 text-sm whitespace-nowrap text-white transition-all hover:bg-green-600/80 active:scale-90 sm:px-4 sm:text-base"
                            onclick="my_modal_1.showModal()"
                        >
                            + เพิ่มกิจกรรม
                        </button>
                    </section>
                    <section class="flex flex-col gap-2 sm:flex-row">
                        <select
                            class="w-full rounded-xl border-2 border-gray-400 px-2 py-1 text-sm sm:w-auto"
                        >
                            <option value="" disabled selected>
                                -- ทุกคณะ --
                            </option>
                            <option value="">a</option>
                            <option value="">b</option>
                            <option value="">c</option>
                        </select>
                        <input
                            type="text"
                            placeholder="ชื่อกิจกรรม..."
                            class="w-full rounded-xl border-2 border-gray-400 px-2 py-1 text-sm sm:w-auto"
                        />
                        <button class="btn btn-sm sm:btn-md">ค้นหา</button>
                    </section>
                </div>
            </div>
            <hr class="my-6 text-gray-400" />
        </div>

        <main>
            <div
                class="mx-auto grid w-full max-w-6xl grid-cols-1 gap-5 pb-6 sm:grid-cols-2 lg:grid-cols-3"
            >
                @foreach ($rec as $activity)
                    <div class="w-full rounded-xl shadow-md">
                        <div class="p-4">
                            <section>
                                <div
                                    class="py- absolute m-2 rounded-full bg-red-100 px-2 text-sm text-red-600/80"
                                >
                                    15 days left
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
                                    <div class="bg-green-500">#เกษตรศาสตร์</div>
                                    <div class="bg-gray-400">#กลางแจ้ง</div>
                                </div>
                                <div>
                                    <h6 class="text-gray-600">
                                        {{ $activity->name_th }}
                                    </h6>
                                    <p class="text-gray-600">
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
                                            {{ $activity->location }}
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-clock"></i>
                                            {{ $activity->total_hour }} ชั่วโมง
                                        </div>
                                    </div>
                                    <div class="mb-3 text-xs text-gray-500">
                                        <i
                                            class="fa-solid fa-calendar-days"
                                        ></i>
                                        8 พ.ย. 2568
                                    </div>
                                </div>
                            </section>
                            <section
                                class="flex flex-col gap-2 sm:flex-row sm:gap-5"
                            >
                                <button
                                    class="w-full rounded-xl bg-amber-400/80 py-2 text-sm text-white sm:text-base"
                                    onclick="my_modal_1.showModal()"
                                >
                                    แก้ไขข้อมูล
                                </button>
                                <button
                                    class="w-full rounded-xl border border-red-400 py-2 text-sm text-red-400 shadow sm:text-base"
                                >
                                    ลบข้อมูล
                                </button>
                            </section>
                        </div>
                    </div>
                @endforeach
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
                        <div class="card-title mb-4">+ สร้างกิจกรรมใหม่่</div>
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
                                    id="tagsContainer"
                                    class="flex min-h-20 w-full flex-wrap gap-2 rounded-md border-2 border-gray-300 p-3"
                                ></div>
                                <div class="mt-2 flex">
                                    <input
                                        type="text"
                                        id="tagInput"
                                        class="flex-1 rounded-md border border-gray-400 px-4 py-2"
                                        placeholder="ชื่อแท็ก..."
                                        onkeypress="handleTagKeyPress(event)"
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
