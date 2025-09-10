{{-- resources/views/layouts/admin.blade.php --}}
@extends('components/layouts/layout-app')

@section('content')
    <div class="w-full">
        <header class="bg-white shadow-sm fixed w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <img src="{{ asset('images/app_icon_2.png') }}" class="w-50">
                    </div>
                    <nav class="hidden md:flex space-x-8">
                        <a href="/dashboard" class="text-gray-700 hover:text-blue-600">หน้าแรก</a>
                        <a href="/event" class="text-gray-700 hover:text-blue-600">กิจกรรมอาสาสมัคร</a>
                        <a href="/about" class="text-gray-700 hover:text-blue-600">อื่นๆ/เกี่ยวกับเรา</a>
                    </nav>
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="pt-16">
            @yield('layout-content')
        </div>
    </div>
@endsection
