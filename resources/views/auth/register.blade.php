@extends('components/layouts/layout-app')

@section('title')
    ลงทะเบียน | KKU VOLENTEER
@endsection

@push('styles')
<style>
    .custom-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
</style>
@endpush

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
                                <input id="firstname" name="firstname" type="text" placeholder="ชื่อจริง"
                                       value="{{ old('firstname') }}" required
                                       class="w-full border-2 border-gray-300 p-3 rounded-lg focus:border-sky-500 outline-none">
                            </div>
                            <div class="flex-1">
                                <input id="lastname" name="lastname" type="text" placeholder="นามสกุล"
                                       value="{{ old('lastname') }}" required
                                       class="w-full border-2 border-gray-300 p-3 rounded-lg focus:border-sky-500 outline-none">
                            </div>
                        </div>

                        <select id="faculty" name="faculty" required class="w-full border-2 border-gray-300 p-3 rounded-lg focus:border-sky-500 outline-none bg-white">
                                    <option value="">เลือกคณะ</option>
                                    <optgroup label="กลุ่มสาขาวิชาวิทยาศาสตร์เทคโนโลยี">
                                        <option value="คณะเกษตรศาสตร์" {{ old('faculty') == 'คณะเกษตรศาสตร์' ? 'selected' : '' }}>คณะเกษตรศาสตร์</option>
                                        <option value="คณะเทคโนโลยี" {{ old('faculty') == 'คณะเทคโนโลยี' ? 'selected' : '' }}>คณะเทคโนโลยี</option>
                                        <option value="คณะวิศวกรรมศาสตร์" {{ old('faculty') == 'คณะวิศวกรรมศาสตร์' ? 'selected' : '' }}>คณะวิศวกรรมศาสตร์</option>
                                        <option value="คณะวิทยาศาสตร์" {{ old('faculty') == 'คณะวิทยาศาสตร์' ? 'selected' : '' }}>คณะวิทยาศาสตร์</option>
                                        <option value="คณะสถาปัตยกรรมศาสตร์" {{ old('faculty') == 'คณะสถาปัตยกรรมศาสตร์' ? 'selected' : '' }}>คณะสถาปัตยกรรมศาสตร์</option>
                                        <option value="วิทยาลัยการคอมพิวเตอร์" {{ old('faculty') == 'วิทยาลัยการคอมพิวเตอร์' ? 'selected' : '' }}>วิทยาลัยการคอมพิวเตอร์</option>
                                    </optgroup>
                                    <optgroup label="กลุ่มสาขาวิชาวิทยาศาสตร์สุขภาพ">
                                        <option value="คณะพยาบาลศาสตร์" {{ old('faculty') == 'คณะพยาบาลศาสตร์' ? 'selected' : '' }}>คณะพยาบาลศาสตร์</option>
                                        <option value="คณะแพทยศาสตร์" {{ old('faculty') == 'คณะแพทยศาสตร์' ? 'selected' : '' }}>คณะแพทยศาสตร์</option>
                                        <option value="คณะเทคนิคการแพทย์" {{ old('faculty') == 'คณะเทคนิคการแพทย์' ? 'selected' : '' }}>คณะเทคนิคการแพทย์</option>
                                        <option value="คณะสาธารณสุขศาสตร์" {{ old('faculty') == 'คณะสาธารณสุขศาสตร์' ? 'selected' : '' }}>คณะสาธารณสุขศาสตร์</option>
                                        <option value="คณะทันตแพทยศาสตร์" {{ old('faculty') == 'คณะทันตแพทยศาสตร์' ? 'selected' : '' }}>คณะทันตแพทยศาสตร์</option>
                                        <option value="คณะเภสัชศาสตร์" {{ old('faculty') == 'คณะเภสัชศาสตร์' ? 'selected' : '' }}>คณะเภสัชศาสตร์</option>
                                        <option value="คณะสัตวแพทยศาสตร์" {{ old('faculty') == 'คณะสัตวแพทยศาสตร์' ? 'selected' : '' }}>คณะสัตวแพทยศาสตร์</option>
                                    </optgroup>
                                    <optgroup label="กลุ่มสาขาวิชามนุษยศาสตร์และสังคมศาสตร์">
                                        <option value="คณะศึกษาศาสตร์" {{ old('faculty') == 'คณะศึกษาศาสตร์' ? 'selected' : '' }}>คณะศึกษาศาสตร์</option>
                                        <option value="คณะมนุษยศาสตร์และสังคมศาสตร์" {{ old('faculty') == 'คณะมนุษยศาสตร์และสังคมศาสตร์' ? 'selected' : '' }}>คณะมนุษยศาสตร์และสังคมศาสตร์</option>
                                        <option value="คณะบริหารธุรกิจและการบัญชี" {{ old('faculty') == 'คณะบริหารธุรกิจและการบัญชี' ? 'selected' : '' }}>คณะบริหารธุรกิจและการบัญชี</option>
                                        <option value="คณะศิลปกรรมศาสตร์" {{ old('faculty') == 'คณะศิลปกรรมศาสตร์' ? 'selected' : '' }}>คณะศิลปกรรมศาสตร์</option>
                                        <option value="คณะเศรษฐศาสตร์" {{ old('faculty') == 'คณะเศรษฐศาสตร์' ? 'selected' : '' }}>คณะเศรษฐศาสตร์</option>
                                        <option value="คณะนิติศาสตร์" {{ old('faculty') == 'คณะนิติศาสตร์' ? 'selected' : '' }}>คณะนิติศาสตร์</option>
                                        <option value="วิทยาลัยการปกครองท้องถิ่น" {{ old('faculty') == 'วิทยาลัยการปกครองท้องถิ่น' ? 'selected' : '' }}>วิทยาลัยการปกครองท้องถิ่น</option>
                                        <option value="วิทยาลัยบัณฑิตศึกษาการจัดการ" {{ old('faculty') == 'วิทยาลัยบัณฑิตศึกษาการจัดการ' ? 'selected' : '' }}>วิทยาลัยบัณฑิตศึกษาการจัดการ</option>
                                    </optgroup>
                                    <optgroup label="กลุ่มสหสาขาวิชา">
                                        <option value="บัณฑิตวิทยาลัย" {{ old('faculty') == 'บัณฑิตวิทยาลัย' ? 'selected' : '' }}>บัณฑิตวิทยาลัย</option>
                                        <option value="วิทยาลัยนานาชาติ" {{ old('faculty') == 'วิทยาลัยนานาชาติ' ? 'selected' : '' }}>วิทยาลัยนานาชาติ</option>
                                        <option value="คณะสหวิทยาการ" {{ old('faculty') == 'คณะสหวิทยาการ' ? 'selected' : '' }}>คณะสหวิทยาการ</option>
                                    </optgroup>
                                </select>
                        <div class="flex gap-3">
                            <div class="flex-1">
                            <input id="major" name="major" type="text" placeholder="สาขาวิชา"
                               value="{{ old('major') }}" required
                               class="w-full border-2 border-sky-500 p-3 rounded-lg focus:border-sky-600 outline-none">

                            </div>
                            <div class="flex-1">
                                <select id="year" name="year" required class="w-full border-2 border-gray-300 p-3 rounded-lg focus:border-sky-500 outline-none bg-white">
                                    <option value="">เลือกชั้นปี</option>
                                    <option value="1" {{ old('year') == '1' ? 'selected' : '' }}>ปี 1</option>
                                    <option value="2" {{ old('year') == '2' ? 'selected' : '' }}>ปี 2</option>
                                    <option value="3" {{ old('year') == '3' ? 'selected' : '' }}>ปี 3</option>
                                    <option value="4" {{ old('year') == '4' ? 'selected' : '' }}>ปี 4</option>
                                </select>
                            </div>
                        </div>

                        <input id="email" name="email" type="email" placeholder="Email (KKU Mail)"
                               value="{{ old('email') }}" required
                               class="border-2 border-gray-300 p-3 rounded-lg focus:border-sky-500 outline-none">

                        <input id="phone" name="phone" type="text" placeholder="เบอร์โทรศัพท์"
                               value="{{ old('phone') }}" required maxlength="10"
                               class="border-2 border-gray-300 p-3 rounded-lg focus:border-sky-500 outline-none">

                        <div class="flex gap-3">
                            <div class="flex-1">
                                <input id="password" name="password" type="password" placeholder="รหัสผ่าน" required
                                       class="w-full border-2 border-gray-300 p-3 rounded-lg focus:border-sky-500 outline-none">
                            </div>
                            <div class="flex-1">
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="ยืนยันรหัสผ่าน" required
                                       class="w-full border-2 border-gray-300 p-3 rounded-lg focus:border-sky-500 outline-none">
                            </div>
                        </div>

                        <button type="submit" class="bg-sky-500 text-white rounded-lg py-3 mt-6 cursor-pointer hover:bg-sky-600 transition-colors duration-200 text-lg font-semibold">
                            ลงทะเบียน
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
