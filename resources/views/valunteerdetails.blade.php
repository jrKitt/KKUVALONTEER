@extends('components/layouts/layoutAfterLogin')

@section('title')
    โปรไฟล์ | KKU VOLUNTEER
@endsection

@section('layout-content')
     <div class="min-h-screen bg-gray-50">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <header class="flex items-center">
        <div class="ml-5 font-bold">
            <div class="flex items-center">
                <span class="text-red-700 text-4xl">KKU</span>
                <img src="/image/image.png" alt="logo" class="w-10 h-10">
            </div>
            <span class="text-2xl">VALUNTEER</span>
        </div>

        <nav class="flex items-center ml-auto space-x-2">
            <a href="">หน้าแรก</a>
            <a href="">กิจกรรมจิตอาสา</a>
            <a href="">ชั่วโมงจิตอาสา</a>
        </nav>
        <div class="ml-10 mr-10"><img src="" alt="profile" class="w-11 h-11 rounded-full"></div>
    </header>
    <hr class="border-gray-300 my-2">


    <!-- Main -->
    <main class="px-10 text-gray-600">
        <div class="flex flex-wrap gap-2 gap-y-4 items-center justify-between mt-10 ">
            <h2 class="font-bold text-5xl">เปิดรับจิตอาสาสอนน้องซ่อมคอม</h2>
            <div class="bg-red-200 rounded-md  px-4 py-2 text-red-600 text-5xl font-bold">
                <span class="">30</span>
                <span class="">/</span>
                <span class="">30</span>
            </div>
        </div>
        <div class=""><img src="/image/535018398_1283960293523557_6096213167155752135_n (1).jpg" alt=""
                class=" mt-10  object-cover rounded-md"></div>
        <nav class="mt-5 text-lg">
            <div>เปิดรับจิตอาสา: สอนน้องซ่อมคอม</div>
            <div>
                <ul class="list-disc ml-8">
                    <li>ช่วยสอนน้องๆเรื่องทักษะคอมพิวเตอร์และการซ่อมบำรุงคอม</li>
                    <li>ส่งเสริมการเรียนรู้แบบลงมือทำและจิตอาสา</li>
                    <li>สร้างความสัมพันธ์พี่-น้องและความสามัคคี</li>
                </ul>
            </div>
        </nav>

        <!-- Datail -->
        <div>
            <h2 class="text-2xl font-bold mt-2 text-gray-900">รายละเอียด</h2>
            <div class="text-gray-700">โครงการเปิดรับจิตอาสาสอนน้องซ่อมคอม
                จัดขึ้นเพื่อเปิดโอกาสให้นักศึกษาที่มีทักษะด้านคอมพิวเตอร์ได้ถ่ายทอดความรู้และเทคนิคการซ่อมบำรุงคอมพิวเตอร์ให้กับน้อง
                ๆ ที่สนใจเรียนรู้ ส่งเสริมการเรียนรู้แบบลงมือทำจริง การทำงานเป็นทีม และทักษะการสื่อสาร
                ตลอดจนสร้างแรงบันดาลใจและความสัมพันธ์ที่ดีระหว่างรุ่นพี่และน้อง
                หลังจบกิจกรรมผู้เข้าร่วมจะได้รับประสบการณ์เชิงปฏิบัติ ทักษะเฉพาะกิจกรรม ชั่วโมงจิตอาสาในระบบ KKU
                VOLUNTEER
                รวมถึงมิตรภาพและความภาคภูมิใจในการมีส่วนร่วมพัฒนาสังคม
            </div>
        </div>

        <nav class="p-5 grid grid-cols-2 md:grid-cols-2">
            <div class="flex items-center">
                <img src="/image/image (1).png" alt="" class="w-auto h-11 p-2">
                <span>นาหลังบ้าน นายเอกรินทร์</span>
            </div>
            <div class="flex items-center">
                <img src="/image/image (3).png" alt="" class="w-auto h-11 p-2">
                48
                <span>ชั่วโมง</span>
            </div>
            <div class="flex items-center">
                <img src="/image/image (2).png" alt="" class="w-auto h-11 p-2">
                04 กันยายน 2568
            </div>
        </nav>

        <div class="px-4 py-4 flex justify-end space-x-4">
            <button type="submit"
                class="bg-blue-400 hover:bg-blue-600 text-white rounded-md py-2 px-10 text-lg shadow-lg">สมัครเข้าร่วม</button>
            <button type="submit"
                class="border border-blue-300 hover:bg-blue-200 hover:text-white text-blue-300 rounded-md py-2 px-10 text-lg shadow-lg">รายละเอียด</button>
        </div>
        <hr class="border-gray-300 my-2">


        <!-- Other activity -->
        <div>
            <h1 class="text-4xl font-bold mt-5">กิจกรรมอื่นๆ</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-10">

                <!-- Activity 1 -->
                <div class="shadow-xl border border-gray-300 rounded-md p-5 flex flex-col mr-3">
                    <div class="h-40 sm:h-48 md:h-40 overflow-hidden rounded-md">
                        <img src="" alt="">
                    </div>

                    <h1 class="text-lg mt-2">กิจกรรมชวนน้องดำน้ำครั้งที่ 1</h1>

                    <div class="flex flex-row text-xs gap-2 mt-2">
                        <button class="bg-green-500 text-white rounded-full px-2 py-1">#เกษตรศาสตร์</button>
                        <button class="bg-gray-400 text-white rounded-full px-2 py-1">#กลางแจ้ง</button> <br>
                    </div>

                    <div class=" text-xs mt-2 text-gray-500 line-clamp-3 flex flex-grow">
                        กิจกรรมชวนน้องดำนาครั้งที่ 1 <br>
                        จัดขึ้นเพื่อเปิดโอกาสให้นักศึกษาและเยาวชนได้ร่วมเรียนรู้วิถีชีวิตชาวนา
                        สัมผัสประสบการณ์การลงมือดำนาอย่างแท้จริง พร้อมทั้งสร้างความสัมพันธ์อันดีระหว่างรุ่นพี่และน้อง
                        ส่งเสริมการอนุรักษ์ภูมิปัญญาท้องถิ่น และปลูกฝังความสามัคคี
                        ความรับผิดชอบต่อสังคมและสิ่งแวดล้อมในบรรยากาศที่เต็มไปด้วยความอบอุ่นและมิตรภาพ
                    </div>

                    <nav class="p-1 grid grid-cols-2 md:grid-cols-2 text-xs">
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            <span>นาหลังบ้าน นายเอกรินทร์</span>
                        </div>
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            48
                            <span>ชั่วโมง</span>
                        </div>
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            04 กันยายน 2568
                        </div>
                    </nav>

                    <div class="px-1 py-1 flex justify-end space-x-3 text-xs">
                        <button type="submit"
                            class="bg-blue-400 hover:bg-blue-600 text-white rounded-md py-1 px-6 text-lg shadow-lg">สมัครเข้าร่วม</button>
                        <button type="submit"
                            class="border border-blue-300 hover:bg-blue-200 hover:text-white text-blue-300 rounded-md py-1 px-6 text-lg shadow-lg">รายละเอียด</button>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="shadow-xl border border-gray-300 rounded-md p-5 flex flex-col mr-3">
                    <div class="h-40 sm:h-48 md:h-40 overflow-hidden rounded-md">
                        <img src="" alt="">
                    </div>
                    <h1 class="text-lg mt-2">เปิดรับจิตอาสาสอนน้องซ่อมคอม</h1>
                    <div class="flex flex-row text-xs gap-2 mt-2">
                        <button class="bg-blue-400 text-white rounded-full px-2 py-1">#วิทยาลัยการคอม</button>
                        <button class="bg-gray-400 text-white rounded-full px-2 py-1">#ลงมือจริง</button> <br>

                    </div>
                    <div class="text-xs mt-2 text-gray-500 mb-3 line-clamp-3 flex flex-grow">
                        โครงการเปิดรับจิตอาสาสอนน้องซ่อมคอม <br>
                        จัดขึ้นเพื่อให้นักศึกษาและผู้มีความรู้ด้านคอมพิวเตอร์ได้มีโอกาสถ่ายทอดทักษะและความรู้ในการซ่อมบำรุงคอมพิวเตอร์ให้กับน้อง
                        ๆ ที่สนใจเรียนรู้ พร้อมทั้งส่งเสริมให้เกิดการเรียนรู้แบบลงมือทำจริง
                        สร้างแรงบันดาลใจให้เยาวชนมีทักษะเทคโนโลยี
                    </div>

                    <nav class="p-1 grid grid-cols-2 md:grid-cols-2 text-xs">
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            <span>นาหลังบ้าน นายเอกรินทร์</span>
                        </div>
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            48
                            <span>ชั่วโมง</span>
                        </div>
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            04 กันยายน 2568
                        </div>
                    </nav>

                    <div class="px-1 py-1 flex justify-end space-x-3 text-xs">
                        <button type="submit"
                            class="bg-blue-400 hover:bg-blue-600 text-white rounded-md py-1 px-6 text-lg shadow-lg">สมัครเข้าร่วม</button>
                        <button type="submit"
                            class="border border-blue-300 hover:bg-blue-200 hover:text-white text-blue-300 rounded-md py-1 px-6 text-lg shadow-lg">รายละเอียด</button>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="shadow-xl border border-gray-300 rounded-md p-5 flex flex-col mr-3">
                    <div class="h-40 sm:h-48 md:h-40 overflow-hidden rounded-md">
                        <img src="" alt="">
                    </div>
                    <h1 class="text-lg mt-2">จิตอาสาสอนน้องผสมปูน</h1>
                    <div class="flex flex-row text-xs gap-2 mt-2">
                        <button class="bg-red-800 text-white rounded-full px-2 py-1">#วิศวกรรม</button>
                        <button class="bg-gray-400 text-white rounded-full px-2 py-1">#กลางแจ้ง</button> <br>

                    </div>
                    <div class=" text-xs mt-2 text-gray-500 mb-3 line-clamp-3 flex flex-grow">
                        โครงการจิตอาสาสอนน้องผสมปูน <br>
                        จัดขึ้นเพื่อให้นักศึกษาและผู้ที่มีทักษะด้านงานช่างได้ถ่ายทอดความรู้และเทคนิคการผสมปูนอย่างถูกวิธีให้กับน้อง
                        ๆ ที่สนใจเรียนรู้ ส่งเสริมการเรียนรู้เชิงปฏิบัติและการทำงานเป็นทีม
                        สร้างความเข้าใจในกระบวนการทำงานช่างเบื้องต้น ปลูกฝังความรับผิดชอบต่อสังคม
                        และสร้างความสัมพันธ์ที่ดีระหว่างรุ่นพี่และน้องในบรรยากาศที่เป็นมิตร สนุกสนาน
                        และสร้างแรงบันดาลใจในการทำงานเพื่อสังคม
                    </div>

                    <nav class="p-1 grid grid-cols-2 md:grid-cols-2 text-xs">
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            <span>นาหลังบ้าน นายเอกรินทร์</span>
                        </div>
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            48
                            <span>ชั่วโมง</span>
                        </div>
                        <div class="flex items-center">
                            <img src="" alt="" class="w-auto h-11 p-2">
                            04 กันยายน 2568
                        </div>
                    </nav>

                    <div class="px-1 py-1 flex justify-end space-x-3 text-xs">
                        <button type="submit"
                            class="bg-blue-400 hover:bg-blue-600 text-white rounded-md py-1 px-6 text-lg shadow-lg">สมัครเข้าร่วม</button>
                        <button type="submit"
                            class="border border-blue-300 hover:bg-blue-200 hover:text-white text-blue-300 rounded-md py-1 px-6 text-lg shadow-lg">รายละเอียด</button>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <!-- Footer -->
    <p class="mt-20"></p>
    <hr class="border-gray-300 my-2">
    <footer class="flex items-center justify-between ">
        <!-- Logo -->
        <div class="ml-5 font-bold mr-20">
            <div class="flex items-center">
                <span class="text-red-700 text-4xl ">KKU</span>
                <img src="" alt="logo" class="w-10 h-10">
            </div>
            <span class="text-2xl">VALUNTEER</span>
        </div>


        <div class="mr-20">

            <!-- About us -->
            <div class="mb-2 font-bold">เกี่ยวกับเรา</div>
            <div class="text-gray-500 text-xs ">ระบบบริหารจัดการกิจกรรมและชั่วโมงจิตอาสานักศึกษา KKU VOLUNTEER <br>
                ถูกพัฒนาขึ้นเพื่อเป็นแพลตฟอร์มกลางในการรวบรวม จัดเก็บ <br>
                และติดตามข้อมูลการเข้าร่วมกิจกรรมของนักศึกษา โดยมุ่งเน้นให้เกิดความสะดวก รวดเร็ว <br>
                และโปร่งใสในการบริหารจัดการ ทั้งในด้านการลงทะเบียนเข้าร่วม การตรวจสอบชั่วโมงจิตอาสา <br>
                และการสรุปรายงานผลการเข้าร่วมกิจกรรม <br>
                ระบบยังช่วยเสริมสร้างวัฒนธรรมการทำกิจกรรมจิตอาสาในมหาวิทยาลัย <br>
                ส่งเสริมให้นักศึกษาได้เรียนรู้การทำงานร่วมกับชุมชนและสังคม <br>
                พร้อมทั้งเป็นฐานข้อมูลสำคัญสำหรับอาจารย์และผู้ดูแลในการติดตามความก้าวหน้าและการพัฒนา <br>
                ศักยภาพของนักศึกษาอย่างเป็นระบบและยั่งยืน
            </div>
        </div>

        <!-- Contact us -->
        <div class="mr-20">
            <div class="mb-2 font-bold">ติดต่อเรา</div>
            <p class="text-gray-500 text-xs">วิทยาลัยการคอมพิวเตอร์ <br> อาคารวิทยวิภาส <br>123 ถนนมิตรภาพ ตำบลในเมือง อำเภอเมืองขอนแก่น
                จังหวัดขอนแก่น 40002</p>
        </div>
    </footer>
        </section>
    </div>
@endsection