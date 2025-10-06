@extends("components/layouts/layoutAdmin")

@section("title")
    admin event | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="mx-4 min-h-screen bg-gray-50 text-black">
        <div class="mx-auto aspect-auto max-w-6xl px-2">
            <div
                class="my-6 flex w-full items-center justify-between max-md:flex-col"
            >
                <div class="my-6 text-5xl font-bold">จัดการกิจกรรม</div>
                <div class="flex flex-col gap-5">
                    <section
                        class="flex w-full items-center justify-end gap-5 max-sm:justify-center"
                    >
                        <div
                            class="cursor-pointer rounded-lg border-2 border-gray-400 p-1 transition-all hover:bg-stone-500/20 active:scale-90"
                        >
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <button
                            class="cursor-pointer rounded-md bg-green-500/80 px-4 py-1 text-white transition-all hover:bg-green-600/80 active:scale-90"
                            onclick="my_modal_1.showModal()"
                        >
                            + เพิ่มกิจกรรม
                        </button>
                    </section>
                    <section class="flex gap-5 max-sm:flex-col">
                        <input
                            type="text"
                            placeholder="ค้นหา"
                            class="rounded-xl border-2 border-gray-400 px-2 py-1"
                        />
                        <select
                            class="w-50 rounded-xl border-2 border-gray-400 px-2 py-1 max-md:w-70"
                        >
                            <option value="" disabled selected>รายเดือน</option>
                            <option value="">a</option>
                            <option value="">b</option>
                            <option value="">c</option>
                        </select>
                    </section>
                </div>
            </div>
            <hr class="my-6 text-gray-400" />
        </div>

        <main>
            <div class="mx-auto grid w-full max-w-6xl grid-cols-12 gap-5">
                @foreach ([1, 2, 3] as $arr)
                    <div
                        class="col-span-4 w-full rounded-xl shadow-md max-lg:col-span-6 max-md:col-span-12"
                    >
                        <div class="p-4">
                            <section>
                                <div
                                    class="py- absolute m-2 rounded-full bg-red-100 px-2 text-sm text-red-600/80"
                                >
                                    15 days left
                                </div>
                                <img
                                    src="{{ asset("images/family.png") }}"
                                    alt="img"
                                    class="rounded-xl"
                                />
                            </section>
                            <section class="my-2 flex flex-col gap-2">
                                <h1>กิจกรรมชวนน้องดำนาครั้งที่ 1</h1>
                                <div
                                    class="] flex gap-2 [&_div]:rounded-full [&_div]:px-2 [&_div]:py-1 [&_div]:text-sm [&_div]:text-white"
                                >
                                    <div class="bg-green-500">#เกษตรศาสตร์</div>
                                    <div class="bg-gray-400">#กลางแจ้ง</div>
                                </div>
                                <div>
                                    <h6 class="text-gray-600">
                                        กิจกรรมชวนน้องดำนาครั้งที่ 1
                                    </h6>
                                    <p class="text-gray-600">
                                        จัดขึ้นเพื่อเปิดโอกาสให้นักศึกษาและเยาวชนได้ร่วมเรียนรู้วิถีชีวิตชาวนา
                                        สัมผัสประสบการณ์การลงมือดำนาอย่างแท้จริง
                                        พร้อมทั้งสร้างความสัมพันธ์อันดีระหว่างรุ่นพี่และน้อง
                                        ส่งเสริมการอนุรักษ์ภูมิปัญญาท้องถิ่น
                                        และปลูกฝังความสามัคคี
                                        ความรับผิดชอบต่อสังคมและสิ่งแวดล้อมในบรรยากาศที่เต็มไปด้วยความอบอุ่นและมิตรภาพ
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
                                            นาหลังบ้านนายเอกรินทร์
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-clock"></i>
                                            30 ชั่วโมง
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
                            <section class="flex gap-5">
                                <button
                                    class="w-full rounded-xl bg-amber-400/80 py-2 text-white"
                                    onclick="my_modal_1.showModal()"
                                >
                                    จัดการ
                                </button>
                                <button
                                    class="w-full rounded-xl border border-amber-400/80 py-2 text-amber-400/80 shadow"
                                >
                                    จัดเก็บ
                                </button>
                            </section>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <dialog id="my_modal_1" class="modal">
            <form action="/activity" method="POST">
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
                                    rows="5"
                                    class="textarea-xs rounded-md border border-gray-400 px-4 py-2"
                                    placeholder="รายละเอียด..."
                                ></textarea>
                            </div>

                            <div class="fieldset col-span-4 max-md:col-span-12">
                                <label class="">วันจัดกิจกรรม</label>
                                <input
                                    type="date"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                    placeholder="วันเริ่มกิจกรรม..."
                                />
                            </div>

                            <div
                                class="fieldset col-span-4 pr-6 max-md:col-span-12"
                            >
                                <label class="">จำนวนชั่วโมง</label>
                                <input
                                    type="number"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="fieldset col-span-4 max-md:col-span-12">
                                <label class="">จำนวนผู้เข้าร่วมสูงสุด</label>
                                <input
                                    type="number"
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div
                                class="fieldset col-span-12 max-md:col-span-12"
                            >
                                <label class="">สถานที่</label>
                                <input
                                    type="text"
                                    name="location"
                                    placeholder="สถานที่..."
                                    class="rounded-md border border-gray-400 px-4 py-2"
                                />
                            </div>

                            <div class="col-span-12">
                                <label for="">แท็กกิจกรรม</label>
                                <div
                                    class="h-20 w-full rounded-md border-2 border-gray-300"
                                ></div>
                                <input
                                    type="text"
                                    class="mt-2 rounded-md border border-gray-400 px-4 py-2"
                                    placeholder="ชื่อแท็ก..."
                                />
                                <button class="btn ml-1">เพิ่มแท็ก</button>
                            </div>

                            <div class="fieldset col-span-12">
                                <div
                                    class="flex items-center space-x-2 rounded-md border border-gray-300"
                                >
                                    <label
                                        for="file-upload"
                                        class="cursor-pointer bg-gray-100 px-4 py-2 text-sm hover:bg-gray-200"
                                    >
                                        Browse...
                                    </label>

                                    <input
                                        id="file-upload"
                                        type="file"
                                        class="hidden"
                                        onchange="updateFileName(this)"
                                    />

                                    <span
                                        id="file-name"
                                        class="text-sm text-gray-500"
                                    >
                                        No file selected.
                                    </span>
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
        const = updateFileName = (input) => {
            const fileName =
                input.files.length > 0
                    ? input.files[0].name
                    : 'No file selected.';
            document.getElementById('file-name').textContent = fileName;
        }
    </script>
@endsection
