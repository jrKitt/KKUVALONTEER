@extends("components/layouts/layoutAdmin")

@section("title")
    admin event | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50 text-black">
        <div class="mx-auto aspect-auto max-w-6xl px-2">
            <div class="my-6 flex w-full items-center max-md:flex-col justify-between">
                <div class="my-6 text-5xl font-bold">จัดการกิจกรรม</div>
                <div class="flex flex-col gap-5">
                    <section class="flex w-full items-center justify-end gap-5 max-sm:justify-center">
                        <div
                            class="cursor-pointer rounded-lg border-2 border-gray-400 p-1 transition-all hover:bg-stone-500/20 active:scale-90"
                        >
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <button
                            class="cursor-pointer rounded-md bg-green-500/80 px-4 py-1 text-white transition-all hover:bg-green-600/80 active:scale-90"
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
                    <div class="col-span-4 w-full rounded-xl shadow-md max-lg:col-span-6 max-md:col-span-12">
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
    </div>
@endsection
