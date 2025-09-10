@extends('components/layouts/layout-app')

@section('title')
    หน้าหลัก | KKU VOLUNTEER
@endsection

@section('content')
    <div class="min-h-screen bg-gray-50">
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                            <img src="{{asset('images/app_icon_2.png')}}" class="w-50">
                    </div>
                    <nav class="hidden md:flex space-x-8">
                        <a href="#" class="text-gray-700 hover:text-blue-600">หน้าแรก</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600">กิจกรรมอาสาสมัคร</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600">อื่นๆ/เกี่ยวกับเรา</a>
                    </nav>
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-8">
                <div class="bg-red-600 text-white p-6 md:p-8 rounded-2xl text-center max-w-md mx-auto">
                    <h2 class="text-lg md:text-xl font-semibold mb-2">สถานะปัจจุบัน</h2>
                    <div class="text-3xl md:text-4xl font-bold">40 ชั่วโมง</div>
                </div>
            </div>

            <section class="mb-8">
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6">กิจกรรมแนะนำ</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('images/test.jpg') }}" alt="กิจกรรม" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1</h4>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">ปี 1-4</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
</svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
                                    ดูรายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('images/test.jpg') }}" alt="กิจกรรม" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1</h4>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">ปี 1-4</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
</svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
                                    ดูรายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('images/test.jpg') }}" alt="กิจกรรม" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1</h4>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">ปี 1-4</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
</svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
                                    ดูรายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('images/test.jpg') }}" alt="กิจกรรม" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1</h4>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">สร้างเอง</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
</svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
                                    ดูรายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('images/test.jpg') }}" alt="กิจกรรม" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1</h4>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">สร้างเอง</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
</svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
                                    ดูรายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('images/test.jpg') }}" alt="กิจกรรม" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2">กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1</h4>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">สร้างเอง</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
</svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
                                    ดูรายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-white border-t border-gray-400">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-bold text-gray-900 mb-4">เกี่ยวกับเรา</h3>
                        <div class="flex items-center mb-4">
                            <img src="{{asset('images/app_icon_2.png')}}" class="w-50">
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            แพลตฟอร์มการจัดการกิจกรรมอาสาสมัครสำหรับนักศึกษามหาวิทยาลัยขอนแก่น
                            ที่ช่วยให้นักศึกษาสามารถค้นหา ลงทะเบียน และติดตามกิจกรรมอาสาสมัครได้อย่างสะดวก
                            พร้อมระบบการจัดการชั่วโมงอาสาและใบรับรองการเข้าร่วมกิจกรรม
                            เพื่อส่งเสริมจิตสำนึกการให้บริการสังคมและการพัฒนาชุมชนอย่างยั่งยื่น
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-4">ติดต่อเรา</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-600 hover:text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
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
