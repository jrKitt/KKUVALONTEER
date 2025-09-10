@extends('components/layouts/layout-app')

@section('title')
    ลงทะเบียน | KKU VOLENTEER
@endsection

@section('content')
    <div class="w-full h-full flex">
        <x-sliders.slider-auth/>
        <div class="w-1/2 h-full flex justify-center items-center">
            <div class="w-[600px] ">
                <form method="POST" action="{{ route('auth.register') }}">
                    @csrf
                    <h1 class=" text-2xl font-semibold text-gray-900 tracking-wide">ลงทะเบียน</h1>
                    <div class="w-12 h-1 bg-sky-500 mt-2"></div>
                    <p class="mt-1">หากมีบัญชีผู้ใช้แล้ว <a href="{{ route('auth.login') }}" class="text-sky-500 underline">เข้าสู่ระบบ</a></p>

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
                        <div class="flex gap-3">
                            <div class="flex-1">
                                <label for="firstname" class="inline-block">ชื่อ : </label>
                                <input id="firstname" name="firstname" type="text" placeholder="ชื่อ"
                                       value="{{ old('firstname') }}" required
                                       class="w-full border-1 border-black p-2 rounded-lg">
                            </div>
                            <div class="flex-1">
                                <label for="lastname" class="inline-block">นามสกุล : </label>
                                <input id="lastname" name="lastname" type="text" placeholder="นามสกุล"
                                       value="{{ old('lastname') }}" required
                                       class="w-full border-1 border-black p-2 rounded-lg">
                            </div>
                        </div>
                        <label for="email" class="inline-block">อีเมล : </label>
                        <input id="email" name="email" type="email" placeholder="student@kkumail.com"
                               value="{{ old('email') }}" required
                               class="border-1 border-black p-2 rounded-lg">

                        <label for="phone" class="inline-block">เบอร์โทรศัพท์ : </label>
                        <input id="phone" name="phone" type="text" placeholder="0801234567"
                               value="{{ old('phone') }}" required maxlength="10"
                               class="border-1 border-black p-2 rounded-lg">

                        <label for="faculty" class="inline-block">คณะ : </label>
                        <input id="faculty" name="faculty" type="text" placeholder="วิทยาลัยการคอมพิวเตอร​์"
                               value="{{ old('faculty') }}" required
                               class="border-1 border-black p-2 rounded-lg">

                        <label for="major" class="inline-block">สาขาวิชา : </label>
                        <input id="major" name="major" type="text" placeholder="วิทยาการคอมพิวเตอร์"
                               value="{{ old('major') }}" required
                               class="border-1 border-black p-2 rounded-lg">

                        <label for="year" class="inline-block">ชั้นปี : </label>
                        <select id="year" name="year" required class="border-1 border-black p-2 rounded-lg">
                            <option value="">เลือกชั้นปี</option>
                            <option value="1" {{ old('year') == '1' ? 'selected' : '' }}>ปี 1</option>
                            <option value="2" {{ old('year') == '2' ? 'selected' : '' }}>ปี 2</option>
                            <option value="3" {{ old('year') == '3' ? 'selected' : '' }}>ปี 3</option>
                            <option value="4" {{ old('year') == '4' ? 'selected' : '' }}>ปี 4</option>
                        </select>

                        <label for="password" class="inline-block">รหัสผ่าน : </label>
                        <input id="password" name="password" type="password" placeholder="••••••••" required
                               class="border-1 border-black p-2 rounded-lg">

                        <label for="password_confirmation" class="inline-block">ยืนยันรหัสผ่าน : </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required
                               class="border-1 border-black p-2 rounded-lg">

                        <button type="submit" class="bg-sky-500 text-white rounded-lg py-2 mt-4 cursor-pointer hover:bg-sky-600">
                            ลงทะเบียน
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
