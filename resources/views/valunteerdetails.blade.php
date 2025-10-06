@extends("components/layouts/layoutAfterLogin")

@section("title")
    โปรไฟล์ | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <section class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Main -->
            <main class="px-10 text-gray-600">
                <div
                    class="mt-10 flex flex-wrap items-center justify-between gap-2 gap-y-4"
                >
                    <h2 class="text-5xl font-bold">
                        เปิดรับจิตอาสาสอนน้องซ่อมคอม
                    </h2>
                    <div
                        class="rounded-md bg-red-200 px-4 py-2 text-5xl font-bold text-red-600"
                    >
                        <span class="">30</span>
                        <span class="">/</span>
                        <span class="">30</span>
                    </div>
                </div>
                <div class="">
                    <img
                        src="/image/535018398_1283960293523557_6096213167155752135_n (1).jpg"
                        alt=""
                        class="mt-10 rounded-md object-cover"
                    />
                </div>
                <nav class="mt-5 text-lg">
                    <div>เปิดรับจิตอาสา: สอนน้องซ่อมคอม</div>
                    <div>
                        <ul class="ml-8 list-disc">
                            <li>
                                ช่วยสอนน้องๆเรื่องทักษะคอมพิวเตอร์และการซ่อมบำรุงคอม
                            </li>
                            <li>ส่งเสริมการเรียนรู้แบบลงมือทำและจิตอาสา</li>
                            <li>สร้างความสัมพันธ์พี่-น้องและความสามัคคี</li>
                        </ul>
                    </div>
                </nav>

                <!-- Datail -->
                <div>
                    <h2 class="mt-2 text-2xl font-bold text-gray-900">
                        รายละเอียด
                    </h2>
                    <div class="text-gray-700">
                        โครงการเปิดรับจิตอาสาสอนน้องซ่อมคอม
                        จัดขึ้นเพื่อเปิดโอกาสให้นักศึกษาที่มีทักษะด้านคอมพิวเตอร์ได้ถ่ายทอดความรู้และเทคนิคการซ่อมบำรุงคอมพิวเตอร์ให้กับน้อง
                        ๆ ที่สนใจเรียนรู้ ส่งเสริมการเรียนรู้แบบลงมือทำจริง
                        การทำงานเป็นทีม และทักษะการสื่อสาร
                        ตลอดจนสร้างแรงบันดาลใจและความสัมพันธ์ที่ดีระหว่างรุ่นพี่และน้อง
                        หลังจบกิจกรรมผู้เข้าร่วมจะได้รับประสบการณ์เชิงปฏิบัติ
                        ทักษะเฉพาะกิจกรรม ชั่วโมงจิตอาสาในระบบ KKU VOLUNTEER
                        รวมถึงมิตรภาพและความภาคภูมิใจในการมีส่วนร่วมพัฒนาสังคม
                    </div>
                </div>

                <nav class="grid grid-cols-2 p-5 md:grid-cols-2">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>นาหลังบ้าน นายเอกรินทร์</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-clock"></i>
                        48
                        <span>ชั่วโมง</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar-days"></i>
                        04 กันยายน 2568
                    </div>
                </nav>

                <div class="flex justify-end space-x-4 px-4 py-4">
                    <button
                        type="submit"
                        class="rounded-md bg-blue-400 px-10 py-2 text-lg text-white shadow-lg hover:bg-blue-600"
                    >
                        สมัครเข้าร่วม
                    </button>
                    <button
                        type="submit"
                        class="rounded-md border border-blue-300 px-10 py-2 text-lg text-blue-300 shadow-lg hover:bg-blue-200 hover:text-white"
                    >
                        รายละเอียด
                    </button>
                </div>
                <hr class="my-2 border-gray-300" />

                <!-- Other activity -->
                <div>
                    <h1 class="mt-5 text-4xl font-bold">กิจกรรมอื่นๆ</h1>
                    <div
                        class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                    >
                        <!-- Activity 1 -->
                        @foreach ([1, 2, 3, 4] as $item)
                            <div
                                class="mr-3 flex flex-col rounded-md border border-gray-300 p-5 shadow-xl"
                            >
                                <div
                                    class="h-40 overflow-hidden rounded-md sm:h-48 md:h-40"
                                >
                                    <img
                                        src="{{ asset("images/family.png") }}"
                                        alt=""
                                    />
                                </div>

                                <h1 class="mt-2 text-lg">
                                    กิจกรรมชวนน้องดำน้ำครั้งที่ 1
                                </h1>

                                <div class="mt-2 flex flex-row gap-2 text-xs">
                                    <button
                                        class="rounded-full bg-green-500 px-2 py-1 text-white"
                                    >
                                        #เกษตรศาสตร์
                                    </button>
                                    <button
                                        class="rounded-full bg-gray-400 px-2 py-1 text-white"
                                    >
                                        #กลางแจ้ง
                                    </button>
                                    <br />
                                </div>

                                <div
                                    class="mt-2 line-clamp-3 flex flex-grow text-xs text-gray-500"
                                >
                                    กิจกรรมชวนน้องดำนาครั้งที่ 1
                                    <br />
                                    จัดขึ้นเพื่อเปิดโอกาสให้นักศึกษาและเยาวชนได้ร่วมเรียนรู้วิถีชีวิตชาวนา
                                    สัมผัสประสบการณ์การลงมือดำนาอย่างแท้จริง
                                    พร้อมทั้งสร้างความสัมพันธ์อันดีระหว่างรุ่นพี่และน้อง
                                    ส่งเสริมการอนุรักษ์ภูมิปัญญาท้องถิ่น
                                    และปลูกฝังความสามัคคี
                                    ความรับผิดชอบต่อสังคมและสิ่งแวดล้อมในบรรยากาศที่เต็มไปด้วยความอบอุ่นและมิตรภาพ
                                </div>

                                <nav
                                    class="grid grid-cols-2 p-1 text-xs md:grid-cols-2"
                                >
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>นาหลังบ้าน นายเอกรินทร์</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-solid fa-clock"></i>
                                        48
                                        <span>ชั่วโมง</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i
                                            class="fa-solid fa-calendar-days"
                                        ></i>
                                        04 กันยายน 2568
                                    </div>
                                </nav>

                                <div
                                    class="flex justify-end space-x-3 px-1 py-1 text-xs"
                                >
                                    <button
                                        type="submit"
                                        class="rounded-md bg-blue-400 px-6 py-1 text-lg text-white shadow-lg hover:bg-blue-600"
                                    >
                                        สมัครเข้าร่วม
                                    </button>
                                    <button
                                        type="submit"
                                        class="rounded-md border border-blue-300 px-6 py-1 text-lg text-blue-300 shadow-lg hover:bg-blue-200 hover:text-white"
                                    >
                                        รายละเอียด
                                    </button>
                                </div>
                            </div>
                        @endforeach

                        <!-- Activity 2 -->
                        {{--
                            <div
                            class="mr-3 flex flex-col rounded-md border border-gray-300 p-5 shadow-xl"
                            >
                            <div
                            class="h-40 overflow-hidden rounded-md sm:h-48 md:h-40"
                            >
                            <img src="" alt="" />
                            </div>
                            <h1 class="mt-2 text-lg">
                            เปิดรับจิตอาสาสอนน้องซ่อมคอม
                            </h1>
                            <div class="mt-2 flex flex-row gap-2 text-xs">
                            <button
                            class="rounded-full bg-blue-400 px-2 py-1 text-white"
                            >
                            #วิทยาลัยการคอม
                            </button>
                            <button
                            class="rounded-full bg-gray-400 px-2 py-1 text-white"
                            >
                            #ลงมือจริง
                            </button>
                            <br />
                            </div>
                            <div
                            class="mt-2 mb-3 line-clamp-3 flex flex-grow text-xs text-gray-500"
                            >
                            โครงการเปิดรับจิตอาสาสอนน้องซ่อมคอม
                            <br />
                            จัดขึ้นเพื่อให้นักศึกษาและผู้มีความรู้ด้านคอมพิวเตอร์ได้มีโอกาสถ่ายทอดทักษะและความรู้ในการซ่อมบำรุงคอมพิวเตอร์ให้กับน้อง
                            ๆ ที่สนใจเรียนรู้
                            พร้อมทั้งส่งเสริมให้เกิดการเรียนรู้แบบลงมือทำจริง
                            สร้างแรงบันดาลใจให้เยาวชนมีทักษะเทคโนโลยี
                            </div>
                            
                            <nav
                            class="grid grid-cols-2 p-1 text-xs md:grid-cols-2"
                            >
                            <div class="flex items-center">
                            <img
                            src=""
                            alt=""
                            class="h-11 w-auto p-2"
                            />
                            <span>นาหลังบ้าน นายเอกรินทร์</span>
                            </div>
                            <div class="flex items-center">
                            <img
                            src=""
                            alt=""
                            class="h-11 w-auto p-2"
                            />
                            48
                            <span>ชั่วโมง</span>
                            </div>
                            <div class="flex items-center">
                            <img
                            src=""
                            alt=""
                            class="h-11 w-auto p-2"
                            />
                            04 กันยายน 2568
                            </div>
                            </nav>
                            
                            <div
                            class="flex justify-end space-x-3 px-1 py-1 text-xs"
                            >
                            <button
                            type="submit"
                            class="rounded-md bg-blue-400 px-6 py-1 text-lg text-white shadow-lg hover:bg-blue-600"
                            >
                            สมัครเข้าร่วม
                            </button>
                            <button
                            type="submit"
                            class="rounded-md border border-blue-300 px-6 py-1 text-lg text-blue-300 shadow-lg hover:bg-blue-200 hover:text-white"
                            >
                            รายละเอียด
                            </button>
                            </div>
                            </div>
                            
                            <!-- Activity 3 -->
                            <div
                            class="mr-3 flex flex-col rounded-md border border-gray-300 p-5 shadow-xl"
                            >
                            <div
                            class="h-40 overflow-hidden rounded-md sm:h-48 md:h-40"
                            >
                            <img src="" alt="" />
                            </div>
                            <h1 class="mt-2 text-lg">จิตอาสาสอนน้องผสมปูน</h1>
                            <div class="mt-2 flex flex-row gap-2 text-xs">
                            <button
                            class="rounded-full bg-red-800 px-2 py-1 text-white"
                            >
                            #วิศวกรรม
                            </button>
                            <button
                            class="rounded-full bg-gray-400 px-2 py-1 text-white"
                            >
                            #กลางแจ้ง
                            </button>
                            <br />
                            </div>
                            <div
                            class="mt-2 mb-3 line-clamp-3 flex flex-grow text-xs text-gray-500"
                            >
                            โครงการจิตอาสาสอนน้องผสมปูน
                            <br />
                            จัดขึ้นเพื่อให้นักศึกษาและผู้ที่มีทักษะด้านงานช่างได้ถ่ายทอดความรู้และเทคนิคการผสมปูนอย่างถูกวิธีให้กับน้อง
                            ๆ ที่สนใจเรียนรู้
                            ส่งเสริมการเรียนรู้เชิงปฏิบัติและการทำงานเป็นทีม
                            สร้างความเข้าใจในกระบวนการทำงานช่างเบื้องต้น
                            ปลูกฝังความรับผิดชอบต่อสังคม
                            และสร้างความสัมพันธ์ที่ดีระหว่างรุ่นพี่และน้องในบรรยากาศที่เป็นมิตร
                            สนุกสนาน และสร้างแรงบันดาลใจในการทำงานเพื่อสังคม
                            </div>
                            
                            <nav
                            class="grid grid-cols-2 p-1 text-xs md:grid-cols-2"
                            >
                            <div class="flex items-center">
                            <img
                            src=""
                            alt=""
                            class="h-11 w-auto p-2"
                            />
                            <span>นาหลังบ้าน นายเอกรินทร์</span>
                            </div>
                            <div class="flex items-center">
                            <img
                            src=""
                            alt=""
                            class="h-11 w-auto p-2"
                            />
                            48
                            <span>ชั่วโมง</span>
                            </div>
                            <div class="flex items-center">
                            <img
                            src=""
                            alt=""
                            class="h-11 w-auto p-2"
                            />
                            04 กันยายน 2568
                            </div>
                            </nav>
                            
                            <div
                            class="flex justify-end space-x-3 px-1 py-1 text-xs"
                            >
                            <button
                            type="submit"
                            class="rounded-md bg-blue-400 px-6 py-1 text-lg text-white shadow-lg hover:bg-blue-600"
                            >
                            สมัครเข้าร่วม
                            </button>
                            <button
                            type="submit"
                            class="rounded-md border border-blue-300 px-6 py-1 text-lg text-blue-300 shadow-lg hover:bg-blue-200 hover:text-white"
                            >
                            รายละเอียด
                            </button>
                            </div>
                            </div>
                        --}}
                    </div>
                </div>
            </main>
        </section>
    </div>
@endsection
