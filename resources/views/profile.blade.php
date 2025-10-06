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
                <img src="" alt="logo" class="w-10 h-10">
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

    <!-- Profile Section -->
    <main>
        <div class="flex justify-center mt-20">
            <img src="" alt="profile" class="rounded-full w-[200px] h-[200px]">
        </div>

        <div class="text-center mt-5">
            <h1 class="text-xl font-bold">นายโยโกะ คามิโจ</h1>
            <p class="text-sm">yoko.ka@kkumail.com</p>
            <p class="text-gray-400">วิทยาลัยการคอมพิวเตอร์ / วิทยาลัยการคอมพิวเตอร์</p>
        </div>
        <hr class="border-gray-300 my-2">

        <!-- Form Section-->
        <div class="flex justify-center mt-20">
            <form action="" class="w-full max-w-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md-5">
                    <!-- FirstName -->
                    <div class="flex flex-col">
                        <label for="" class="mb-2 font-bold">Firstname</label>
                        <input type="text" name="firstname" placeholder="นายโยโกะ" class="shadow-md appearance-none border-gray-300 rounded-lg py-2 px-5 w-[250px] text-gray-400 leading-tight focus:outline-none">
                    </div>
                    <!-- LastName -->
                    <div class="flex flex-col">
                        <label for="" class="mb-2 font-bold"">Lastname</label>
                        <input type="text" name="lastname" placeholder="คามิโจ" class="shadow-md appearance-none border-gray-300 rounded-lg py-2 px-5 w-[250px] text-gray-400 leading-tight focus:outline-none">
                    </div>
                </div>

                <!-- Faculty(คณะ) -->
                <div class="mt-5 flex flex-col">
                    <label for="" class="mb-2 font-bold"">Faculty</label>
                    <select name="" id="" class="shadow-md appearance-none w-full border-gray-300 px-5 py-2 rounded-lg leading-tight text-gray-400 focus:outline-none hover:border-gray-500 pr-8">
                        
                        <option value="" class="">วิทยาลัยการคอมพิวเตอร์</option>
                        <option value="" class="">วิทยาลัยการคอมพิวเตอร์</option>
                        
                    </select>
                </div>


                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-10 md-5">
                    <!-- Faculty(สาขา) -->
                    <div class="flex flex-col">
                        <label for="" class="mb-2 font-bold">Faculty (สาขา)</label>
                        <select name="" id="" class="shadow-md appearance-none w-full border-gray-300 px-5 py-2 rounded-lg leading-tight text-gray-400 focus:outline-none hover:border-gray-500 pr-8">
                            
                            <option value="">วิทยาการคอมพิวเตอร์</option>
                            <option value="">วิทยาการคอมพิวเตอร์</option>
                            
                        </select>
                    </div>

                    <!-- Year -->
                    <div class="flex flex-col">
                        <label for="" class="mb-2 font-bold">Year</label>
                        <select name="" id="" class="shadow-md appearance-none w-full border-gray-300 px-5 py-2 rounded-lg leading-tight text-gray-400 focus:outline-none hover:border-gray-500 pr-8">
                            <option value="1">ปี 1</option>
                            <option value="2">ปี 2</option>
                            <option value="3">ปี 3</option>
                            <option value="4">ปี 4</option>
                            <option value="5">ปี 5</option>
                            <option value="6">ปี 6</option>
                            <option value="7">ปี 7</option>
                            <option value="8">ปี 8</option>
                        </select>
                    </div>
                </div>

                <!-- Email -->
                <div class="mt-5 flex flex-col">
                    <label for="" class="mb-2 font-bold">Email</label>
                    <input type="email" placeholder="yoko.ka@kkumail.com"
                        class="shadow appearance-none border-gray-300 rounded-lg py-2 px-5 w-full text-gray-400 leading-tight focus:outline-none">
                </div>
                <div class="mt-10 flex justify-center border-blue-500 bg-blue-400 text-white rounded-lg py-2 px-5 w-full">
                    <button type="submit">แก้ไข</button>
                </div>
            </form>
        </div>
    </main> 
    <br><br>
    

    <!-- Footer -->
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