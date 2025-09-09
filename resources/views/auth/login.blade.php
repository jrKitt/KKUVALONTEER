@extends('components/layouts/layout-app')

@section('title')
    เข้าสู่ระบบ | KKU VOLENTEER
@endsection


@section('content')
    <div class="w-full h-full flex">
        <x-sliders.slider-auth/>
        <div class="w-1/2 h-full flex justify-center items-center">
            <div class="w-[600px] ">

                <form action="" >
                    <h1 class=" text-2xl font-semibold text-gray-900 tracking-wide">เข้าสู่ระบบ</h1>
                    <div class="w-12 h-1 bg-sky-500 mt-2"></div>
                    <p class="mt-1">หากยังต้องการสมัครบัญชี <a href="/register" class="text-sky-500 underline">ลงทะเบียน</a></p>
                    <div class="flex flex-col gap-3 mt-4">
                         <label for="input_login_email" class=" inline-block">อีเมล : </label>
                    <input id="input_login_email" type="text" placeholder="student@kkumail.com" class="border-1 border-black p-2 rounded-lg">

                    <label for="input_login_password" class=" inline-block">รหัสผ่าน : </label>
                    <input id="input_login_password" type="password" placeholder="••••••••" class="border-1 border-black p-2 rounded-lg">

                    <div>
                     <input type="checkbox">
                     <label for="">จดจำผู้ใช้</label>
                    </div>

                    <button type="submit" class="bg-sky-500 text-white rounded-lg py-2 mt-4 cursor-pointer">
                            เข้าสู่ระบบ
                    </button>

                    </div>
                   

                    <input type="text">
                </form>
            </div>
        </div>
    </div>
@endsection
