{{-- resources/views/layouts/admin.blade.php --}}
@extends('components/layouts/layout-app')

@section('content')
    <div class="w-full">
        <header class="bg-white shadow-sm fixed w-full z-1000">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="/dashboard">
                        <div class="flex items-center">
                            <img src="{{ asset('images/app_icon_2.png') }}" class="w-50">
                        </div>
                    </a>
                    <nav class="hidden md:flex space-x-8">
                        <a href="/dashboard" class="text-gray-700 hover:text-blue-600">หน้าแรก</a>
                        <a href="/event" class="text-gray-700 hover:text-blue-600">กิจกรรมอาสาสมัคร</a>
                        <a href="/about" class="text-gray-700 hover:text-blue-600">อื่นๆ/เกี่ยวกับเรา</a>
                    </nav>
                    <div class="flex items-center space-x-4">
                        <div class="w-full h-full">
                            <a href="/profile">
                                <img class="rounded-full w-10 h-10" src="{{ asset('images/profileTemp.png') }}"
                                    alt="img" width="100" height="100">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="pt-16">
            @yield('layout-content')
        </div>

        <footer class="bg-white border-t border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 ">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 ">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="flex items-center">
                            <img src="{{ asset('images/app_icon_2.png') }}" class="w-50">
                        </div>
                        <div class=" col-span-2">
                            <h3 class="font-bold text-gray-900 mb-4">เกี่ยวกับเรา</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                แพลตฟอร์มการจัดการกิจกรรมอาสาสมัครสำหรับนักศึกษามหาวิทยาลัยขอนแก่น
                                ที่ช่วยให้นักศึกษาสามารถค้นหา ลงทะเบียน และติดตามกิจกรรมอาสาสมัครได้อย่างสะดวก
                                พร้อมระบบการจัดการชั่วโมงอาสาและใบรับรองการเข้าร่วมกิจกรรม
                                เพื่อส่งเสริมจิตสำนึกการให้บริการสังคมและการพัฒนาชุมชนอย่างยั่งยื่น
                            </p>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-4">ติดต่อเรา</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-600 hover:text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                    class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                    class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                    class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                </svg>
                            </a>

                        </div>
                        <p class="text-gray-600 text-sm mt-4">
                            123 มหาวิทยาลัยขอนแก่น ตำบลในเมือง อำเภอเมืองขอนแก่น จังหวัดขอนแก่น 40002
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
