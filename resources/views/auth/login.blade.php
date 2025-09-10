@extends('components/layouts/layout-app')

@section('title')
    เข้าสู่ระบบ | KKU VOLENTEER
@endsection


@section('content')
    <div class="w-full h-full flex">
        <x-sliders.slider-auth/>
        <div class="w-1/2 h-full flex justify-center items-center">
            <div class="w-[600px] ">

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf
                    <h1 class=" text-2xl font-semibold text-gray-900 tracking-wide">เข้าสู่ระบบ</h1>
                    <div class="w-12 h-1 bg-sky-500 mt-2"></div>
                    <p class="mt-1">หากยังต้องการสมัครบัญชี <a href="{{ route('auth.register') }}" class="text-sky-500 underline">ลงทะเบียน</a></p>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex flex-col gap-3 mt-4">
                        <input id="email" name="email" type="email" placeholder="student.s@kkumail.com"
                               value="{{ old('email') }}" required
                               class="border-1 border-black p-2 rounded-lg">

                        <input id="password" name="password" type="password" placeholder="••••••••" required
                               class="border-1 border-black p-2 rounded-lg">

                        <div>
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">จดจำผู้ใช้</label>
                        </div>

                        <button type="submit" class="bg-sky-500 text-white rounded-lg py-2 mt-4 cursor-pointer hover:bg-sky-600">
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
