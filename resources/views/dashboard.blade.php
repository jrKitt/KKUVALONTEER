@extends('components/layouts/layout-app')

@section('title')
    Dashboard | KKU VOLENTEER
@endsection

@section('content')
    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">ยินดีต้อนรับ</h1>
                            <p class="text-gray-600">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('auth.logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                    ออกจากระบบ
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white shadow rounded-lg p-6 border">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">ข้อมูลส่วนตัว</h3>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">ชื่อ:</span> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                                <p><span class="font-medium">อีเมล:</span> {{ Auth::user()->email }}</p>
                                <p><span class="font-medium">เบอร์โทร:</span> {{ Auth::user()->phone }}</p>
                                <p><span class="font-medium">คณะ:</span> {{ Auth::user()->faculty }}</p>
                                <p><span class="font-medium">สาขา:</span> {{ Auth::user()->major }}</p>
                                <p><span class="font-medium">ชั้นปี:</span> {{ Auth::user()->year }}</p>
                            </div>
                        </div>

                        <div class="bg-white shadow rounded-lg p-6 border">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">กิจกรรมอาสา</h3>
                            <div class="text-center text-gray-500">
                                <p>ยังไม่มีกิจกรรมที่เข้าร่วม</p>
                                <a href="#" class="text-sky-500 hover:text-sky-600 mt-2 inline-block">
                                    ค้นหากิจกรรม
                                </a>
                            </div>
                        </div>

                        <div class="bg-white shadow rounded-lg p-6 border">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">สถิติ</h3>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">กิจกรรมที่เข้าร่วม:</span> 0 กิจกรรม</p>
                                <p><span class="font-medium">ชั่วโมงอาสา:</span> 0 ชั่วโมง</p>
                                <p><span class="font-medium">คะแนนอาสา:</span> 0 คะแนน</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
