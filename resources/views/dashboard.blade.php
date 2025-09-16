@extends('components/layouts/layoutAfterLogin')

@section('title')
    หน้าหลัก | KKU VOLUNTEER
@endsection

@section('layout-content')
    <div class="min-h-screen bg-gray-50">
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
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                </svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button
                                    class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
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
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                </svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button
                                    class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
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
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                </svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button
                                    class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
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
                                <span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">สร้างเอง</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                </svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button
                                    class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
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
                                <span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">สร้างเอง</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                </svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button
                                    class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
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
                                <span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">#เกษตรศาสตร์</span>
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">สร้างเอง</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">
                                ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง
                                จังหวัดขอนแก่น
                            </p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    นาหลังบ้านนายเอกรินทร์
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    8 พ.ย. 2568
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                </svg> 30 ชั่วโมง
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                                    สมัครเลย
                                </button>
                                <button
                                    class="px-4 py-2 text-blue-500 border border-blue-500 rounded-lg hover:bg-blue-50 transition-colors">
                                    ดูรายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

    </div>
@endsection
