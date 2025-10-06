@extends("components/layouts/layoutAfterLogin")

@section("title")
    กิจกรรมอาสาสมัคร | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div
                class="relative mx-auto w-full max-w-6xl overflow-hidden rounded-md"
            >
                {{-- text on image --}}
                <div class="absolute z-1 w-2/3 p-6 max-md:w-2/5 max-sm:w-2/3">
                    <div>
                        <h1
                            class="mb-4 text-2xl font-bold text-white md:text-5xl"
                        >
                            ค่ายปลุกฝันสอนน้อง
                        </h1>
                        <div class="text-white max-md:hidden">
                            ค่ายปลุกฝันสอนน้อง
                            จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง
                            ผ่านกิจกรรมการเรียนรู้ การสอนทักษะ
                            และการแนะแนวทางการพัฒนาตัวเองอย่างสร้างสรรค์
                            โดยมุ่งเน้นการสร้างแรงบันดาลใจ ปลูกฝังทัศนคติที่ดี
                            และส่งเสริมความสามัคคีระหว่างรุ่นพี่และน้อง
                            รวมถึงการเรียนรู้การทำงานเป็นทีมและการรับผิดชอบต่อสังคมในบรรยากาศที่สนุกสนานและเป็นมิตร
                        </div>
                    </div>
                    <div class="flex gap-2 max-md:flex-col">
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
                    </div>
                </div>

                {{-- carousel --}}
                <div class="animate-slide flex w-[300%] brightness-50">
                    <div class="w-1/3 flex-shrink-0">
                        <img
                            src="{{ asset("images/carousel_1.jpg") }}"
                            class="h-100 w-full rounded-lg object-cover"
                        />
                    </div>

                    <div class="w-1/3 flex-shrink-0">
                        <img
                            src="{{ asset("images/carousel_2.jpg") }}"
                            class="h-100 w-full rounded-lg object-cover"
                        />
                    </div>

                    <div class="w-1/3 flex-shrink-0">
                        <img
                            src="{{ asset("images/carousel_3.jpg") }}"
                            class="h-100 w-full rounded-lg object-cover"
                        />
                    </div>
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
                                />
                            </div>
                            <div class="flex gap-5 max-md:flex-col">
                                <select
                                    name=""
                                    id=""
                                    class="w-50 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                >
                                    <option value="" disabled selected>
                                        # แท็ก
                                    </option>
                                    <option value="">a</option>
                                    <option value="">b</option>
                                    <option value="">c</option>
                                </select>
                                <select
                                    name=""
                                    id=""
                                    class="w-50 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                >
                                    <option value="" disabled selected>
                                        คณะ / สาขา
                                    </option>
                                    <option value="">a</option>
                                    <option value="">b</option>
                                    <option value="">c</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                    >
                        <div
                            class="overflow-hidden rounded-lg bg-white shadow-md"
                        >
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-48 w-full object-cover"
                            />
                            <div class="p-4">
                                <h4 class="mb-2 font-semibold text-gray-900">
                                    กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1
                                </h4>
                                <div class="mb-2 flex items-center gap-2">
                                    <span
                                        class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-800"
                                    >
                                        #เกษตรศาสตร์
                                    </span>
                                    <span
                                        class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800"
                                    >
                                        ปี 1-4
                                    </span>
                                </div>
                                <p class="mb-3 text-sm text-gray-600">
                                    ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ
                                    บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                    จังหวัดขอนแก่น
                                </p>
                                <div
                                    class="mb-3 flex items-center justify-between text-sm text-gray-500"
                                >
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-location-dot"></i>
                                        นาหลังบ้านนายเอกรินทร์
                                    </div>
                                    <div class="flex items-center">
                                        <i
                                            class="fa-solid fa-calendar-days"
                                        ></i>
                                        8 พ.ย. 2568
                                    </div>
                                </div>
                                <div class="mb-3 text-xs text-gray-500">
                                    <i class="fa-solid fa-clock"></i>
                                    30 ชั่วโมง
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 rounded-lg bg-blue-500 px-4 py-2 text-white transition-colors hover:bg-blue-600"
                                    >
                                        สมัครเลย
                                    </button>
                                    <button
                                        class="rounded-lg border border-blue-500 px-4 py-2 text-blue-500 transition-colors hover:bg-blue-50"
                                    >
                                        ดูรายละเอียด
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div
                            class="overflow-hidden rounded-lg bg-white shadow-md"
                        >
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-48 w-full object-cover"
                            />
                            <div class="p-4">
                                <h4 class="mb-2 font-semibold text-gray-900">
                                    กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1
                                </h4>
                                <div class="mb-2 flex items-center gap-2">
                                    <span
                                        class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-800"
                                    >
                                        #เกษตรศาสตร์
                                    </span>
                                    <span
                                        class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800"
                                    >
                                        ปี 1-4
                                    </span>
                                </div>
                                <p class="mb-3 text-sm text-gray-600">
                                    ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ
                                    บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                    จังหวัดขอนแก่น
                                </p>
                                <div
                                    class="mb-3 flex items-center justify-between text-sm text-gray-500"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        นาหลังบ้านนายเอกรินทร์
                                    </div>
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        8 พ.ย. 2568
                                    </div>
                                </div>
                                <div class="mb-3 text-xs text-gray-500">
                                    <svg
                                        class="mr-1 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-clock-fill"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"
                                        />
                                    </svg>
                                    30 ชั่วโมง
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 rounded-lg bg-blue-500 px-4 py-2 text-white transition-colors hover:bg-blue-600"
                                    >
                                        สมัครเลย
                                    </button>
                                    <button
                                        class="rounded-lg border border-blue-500 px-4 py-2 text-blue-500 transition-colors hover:bg-blue-50"
                                    >
                                        ดูรายละเอียด
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div
                            class="overflow-hidden rounded-lg bg-white shadow-md"
                        >
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-48 w-full object-cover"
                            />
                            <div class="p-4">
                                <h4 class="mb-2 font-semibold text-gray-900">
                                    กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1
                                </h4>
                                <div class="mb-2 flex items-center gap-2">
                                    <span
                                        class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-800"
                                    >
                                        #เกษตรศาสตร์
                                    </span>
                                    <span
                                        class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800"
                                    >
                                        ปี 1-4
                                    </span>
                                </div>
                                <p class="mb-3 text-sm text-gray-600">
                                    ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ
                                    บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                    จังหวัดขอนแก่น
                                </p>
                                <div
                                    class="mb-3 flex items-center justify-between text-sm text-gray-500"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        นาหลังบ้านนายเอกรินทร์
                                    </div>
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        8 พ.ย. 2568
                                    </div>
                                </div>
                                <div class="mb-3 text-xs text-gray-500">
                                    <svg
                                        class="mr-1 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-clock-fill"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"
                                        />
                                    </svg>
                                    30 ชั่วโมง
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 rounded-lg bg-blue-500 px-4 py-2 text-white transition-colors hover:bg-blue-600"
                                    >
                                        สมัครเลย
                                    </button>
                                    <button
                                        class="rounded-lg border border-blue-500 px-4 py-2 text-blue-500 transition-colors hover:bg-blue-50"
                                    >
                                        ดูรายละเอียด
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                    >
                        <div
                            class="overflow-hidden rounded-lg bg-white shadow-md"
                        >
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-48 w-full object-cover"
                            />
                            <div class="p-4">
                                <h4 class="mb-2 font-semibold text-gray-900">
                                    กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1
                                </h4>
                                <div class="mb-2 flex items-center gap-2">
                                    <span
                                        class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-800"
                                    >
                                        #เกษตรศาสตร์
                                    </span>
                                    <span
                                        class="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-800"
                                    >
                                        สร้างเอง
                                    </span>
                                </div>
                                <p class="mb-3 text-sm text-gray-600">
                                    ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ
                                    บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                    จังหวัดขอนแก่น
                                </p>
                                <div
                                    class="mb-3 flex items-center justify-between text-sm text-gray-500"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        นาหลังบ้านนายเอกรินทร์
                                    </div>
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        8 พ.ย. 2568
                                    </div>
                                </div>
                                <div class="mb-3 text-xs text-gray-500">
                                    <svg
                                        class="mr-1 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-clock-fill"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"
                                        />
                                    </svg>
                                    30 ชั่วโมง
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 rounded-lg bg-blue-500 px-4 py-2 text-white transition-colors hover:bg-blue-600"
                                    >
                                        สมัครเลย
                                    </button>
                                    <button
                                        class="rounded-lg border border-blue-500 px-4 py-2 text-blue-500 transition-colors hover:bg-blue-50"
                                    >
                                        ดูรายละเอียด
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div
                            class="overflow-hidden rounded-lg bg-white shadow-md"
                        >
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-48 w-full object-cover"
                            />
                            <div class="p-4">
                                <h4 class="mb-2 font-semibold text-gray-900">
                                    กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1
                                </h4>
                                <div class="mb-2 flex items-center gap-2">
                                    <span
                                        class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-800"
                                    >
                                        #เกษตรศาสตร์
                                    </span>
                                    <span
                                        class="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-800"
                                    >
                                        สร้างเอง
                                    </span>
                                </div>
                                <p class="mb-3 text-sm text-gray-600">
                                    ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ
                                    บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                    จังหวัดขอนแก่น
                                </p>
                                <div
                                    class="mb-3 flex items-center justify-between text-sm text-gray-500"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        นาหลังบ้านนายเอกรินทร์
                                    </div>
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        8 พ.ย. 2568
                                    </div>
                                </div>
                                <div class="mb-3 text-xs text-gray-500">
                                    <svg
                                        class="mr-1 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-clock-fill"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"
                                        />
                                    </svg>
                                    30 ชั่วโมง
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 rounded-lg bg-blue-500 px-4 py-2 text-white transition-colors hover:bg-blue-600"
                                    >
                                        สมัครเลย
                                    </button>
                                    <button
                                        class="rounded-lg border border-blue-500 px-4 py-2 text-blue-500 transition-colors hover:bg-blue-50"
                                    >
                                        ดูรายละเอียด
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div
                            class="overflow-hidden rounded-lg bg-white shadow-md"
                        >
                            <img
                                src="{{ asset("images/test.jpg") }}"
                                alt="กิจกรรม"
                                class="h-48 w-full object-cover"
                            />
                            <div class="p-4">
                                <h4 class="mb-2 font-semibold text-gray-900">
                                    กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1
                                </h4>
                                <div class="mb-2 flex items-center gap-2">
                                    <span
                                        class="rounded-full bg-green-100 px-2 py-1 text-xs text-green-800"
                                    >
                                        #เกษตรศาสตร์
                                    </span>
                                    <span
                                        class="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-800"
                                    >
                                        สร้างเอง
                                    </span>
                                </div>
                                <p class="mb-3 text-sm text-gray-600">
                                    ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ
                                    บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                    จังหวัดขอนแก่น
                                </p>
                                <div
                                    class="mb-3 flex items-center justify-between text-sm text-gray-500"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        นาหลังบ้านนายเอกรินทร์
                                    </div>
                                    <div class="flex items-center">
                                        <svg
                                            class="mr-1 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        8 พ.ย. 2568
                                    </div>
                                </div>
                                <div class="mb-3 text-xs text-gray-500">
                                    <svg
                                        class="mr-1 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        fill="currentColor"
                                        class="bi bi-clock-fill"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"
                                        />
                                    </svg>
                                    30 ชั่วโมง
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="flex-1 rounded-lg bg-blue-500 px-4 py-2 text-white transition-colors hover:bg-blue-600"
                                    >
                                        สมัครเลย
                                    </button>
                                    <button
                                        class="rounded-lg border border-blue-500 px-4 py-2 text-blue-500 transition-colors hover:bg-blue-50"
                                    >
                                        ดูรายละเอียด
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </section>
    </div>
@endsection
