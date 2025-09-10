@extends('components/layouts/layout-app')

@section('title')
    เข้าสู่ระบบ | KKU VOLENTEER
@endsection


@section('content')
    <div class="w-full h-full flex flex-col md:flex-row">
        <div class="hidden md:block md:w-1/2">
            <x-sliders.slider-auth/>
        </div>

        <div class="w-full md:w-1/2 h-full flex justify-center items-center p-4 md:p-0">
            <div class="w-full max-w-[600px] px-4 md:px-0">

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-900 tracking-wide">เข้าสู่ระบบ</h1>
                    <div class="w-12 h-1 bg-sky-500 mt-2"></div>
                    <p class="mt-1 text-sm md:text-base">หากยังต้องการสมัครบัญชี <a href="{{ route('auth.register') }}" class="text-sky-500 underline">ลงทะเบียน</a></p>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-3 md:px-4 py-3 rounded mt-4 text-sm md:text-base">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex flex-col gap-3 md:gap-4 mt-4 md:mt-6">
                        <input id="email" name="email" type="email" placeholder="student.s@kkumail.com"
                               value="{{ old('email') }}" required
                               class="w-full border-2 border-gray-300 p-3 md:p-4 rounded-lg focus:border-sky-500 outline-none text-sm md:text-base">

                        <input id="password" name="password" type="password" placeholder="••••••••" required
                               class="w-full border-2 border-gray-300 p-3 md:p-4 rounded-lg focus:border-sky-500 outline-none text-sm md:text-base">

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4">
                            <label for="remember" class="text-sm md:text-base">จดจำผู้ใช้</label>
                        </div>

                        <button type="submit" class="bg-sky-500 text-white rounded-lg py-3 md:py-4 mt-4 md:mt-6 cursor-pointer hover:bg-sky-600 transition-colors duration-200 text-base md:text-lg font-semibold">
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
