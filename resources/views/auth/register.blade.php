@extends("components/layouts/layout-app")

@section("title")
    ลงทะเบียน | KKU VOLENTEER
@endsection

@push("styles")
    <style>
        @media (max-width: 640px) {
            .custom-select {
                background-size: 1.2em 1.2em;
                padding-right: 2rem;
            }
        }

        @media (max-height: 700px) {
            .overflow-y-auto {
                max-height: 100vh;
            }
        }
    </style>
@endpush

@section("content")
    <div class="flex h-screen w-full flex-col md:flex-row">
        <div class="hidden h-full md:flex md:w-1/2">
            <x-sliders.slider-auth class="h-full w-full" />
        </div>

        <div
            class="flex h-full w-full items-center justify-center overflow-y-auto p-4 md:w-1/2 md:p-0"
        >
            <div class="w-full max-w-[600px] px-4 py-4 md:px-0 md:py-8">
                <form
                    method="POST"
                    action="{{ route("auth.register") }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="flex w-100 items-center">
                        <img src="{{ asset("images/app_icon_2.png") }}" />
                    </div>
                    <h1
                        class="text-xl font-semibold tracking-wide text-gray-900 md:text-2xl"
                    >
                        ลงทะเบียน
                    </h1>
                    <div class="mt-2 h-1 w-12 bg-sky-500"></div>
                    <p class="mt-1 text-sm md:text-base">
                        หากมีบัญชีผู้ใช้แล้ว
                        <a
                            href="{{ route("auth.login") }}"
                            class="text-sky-500 underline"
                        >
                            เข้าสู่ระบบ
                        </a>
                    </p>

                    @if ($errors->any())
                        <div
                            class="mt-4 rounded border border-red-400 bg-red-100 px-3 py-3 text-sm text-red-700 md:px-4"
                        >
                            <ul class="list-inside list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mt-4 flex flex-col gap-3 md:mt-6 md:gap-4">
                        <!-- Profile Image Upload -->
                        <div
                            class="flex flex-col items-center gap-4 rounded-lg border-2 border-dashed border-gray-300 p-4"
                        >
                            <div class="flex flex-col items-center">
                                <div
                                    class="mb-3 flex h-24 w-24 items-center justify-center rounded-full bg-gray-200"
                                    id="imagePreview"
                                >
                                    <i
                                        class="fas fa-user text-3xl text-gray-400"
                                    ></i>
                                </div>
                                <label
                                    for="profile_image"
                                    class="cursor-pointer rounded-lg bg-sky-500 px-4 py-2 text-white transition-colors duration-200 hover:bg-sky-600"
                                >
                                    <i class="fas fa-camera mr-2"></i>
                                    เลือกรูปโปรไฟล์
                                </label>
                                <input
                                    type="file"
                                    id="profile_image"
                                    name="profile_image"
                                    accept="image/*"
                                    class="hidden"
                                    onchange="previewImage(this)"
                                />
                                <p class="mt-2 text-xs text-gray-500">
                                    รองรับไฟล์ JPG, PNG, GIF (ขนาดไม่เกิน 2MB)
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <div class="flex-1">
                                <input
                                    id="firstname"
                                    name="firstname"
                                    type="text"
                                    placeholder="ชื่อจริง"
                                    value="{{ old("firstname") }}"
                                    required
                                    class="w-full rounded-lg border-2 border-gray-300 p-3 text-sm outline-none focus:border-sky-500 md:text-base"
                                />
                            </div>
                            <div class="flex-1">
                                <input
                                    id="lastname"
                                    name="lastname"
                                    type="text"
                                    placeholder="นามสกุล"
                                    value="{{ old("lastname") }}"
                                    required
                                    class="w-full rounded-lg border-2 border-gray-300 p-3 text-sm outline-none focus:border-sky-500 md:text-base"
                                />
                            </div>
                        </div>

                        <input
                            id="major"
                            name="major"
                            type="text"
                            placeholder="สาขา"
                            value="{{ old("major") }}"
                            required
                            class="rounded-lg border-2 border-sky-500 p-3 text-sm outline-none focus:border-sky-600 md:text-base"
                        />

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <div class="flex-1">
                                <select
                                    id="faculty"
                                    name="faculty"
                                    required
                                    class="custom-select w-full appearance-none rounded-lg border-2 border-gray-300 bg-white p-3 text-sm outline-none focus:border-sky-500 md:text-base"
                                >
                                    <option value="">เลือกคณะ</option>
                                    <optgroup
                                        label="กลุ่มสาขาวิชาวิทยาศาสตร์เทคโนโลยี"
                                    >
                                        <option
                                            value="คณะเกษตรศาสตร์"
                                            {{ old("faculty") == "คณะเกษตรศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะเกษตรศาสตร์
                                        </option>
                                        <option
                                            value="คณะเทคโนโลยี"
                                            {{ old("faculty") == "คณะเทคโนโลยี" ? "selected" : "" }}
                                        >
                                            คณะเทคโนโลยี
                                        </option>
                                        <option
                                            value="คณะวิศวกรรมศาสตร์"
                                            {{ old("faculty") == "คณะวิศวกรรมศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะวิศวกรรมศาสตร์
                                        </option>
                                        <option
                                            value="คณะวิทยาศาสตร์"
                                            {{ old("faculty") == "คณะวิทยาศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะวิทยาศาสตร์
                                        </option>
                                        <option
                                            value="คณะสถาปัตยกรรมศาสตร์"
                                            {{ old("faculty") == "คณะสถาปัตยกรรมศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะสถาปัตยกรรมศาสตร์
                                        </option>
                                        <option
                                            value="วิทยาลัยการคอมพิวเตอร์"
                                            {{ old("faculty") == "วิทยาลัยการคอมพิวเตอร์" ? "selected" : "" }}
                                        >
                                            วิทยาลัยการคอมพิวเตอร์
                                        </option>
                                    </optgroup>
                                    <optgroup
                                        label="กลุ่มสาขาวิชาวิทยาศาสตร์สุขภาพ"
                                    >
                                        <option
                                            value="คณะพยาบาลศาสตร์"
                                            {{ old("faculty") == "คณะพยาบาลศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะพยาบาลศาสตร์
                                        </option>
                                        <option
                                            value="คณะแพทยศาสตร์"
                                            {{ old("faculty") == "คณะแพทยศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะแพทยศาสตร์
                                        </option>
                                        <option
                                            value="คณะเทคนิคการแพทย์"
                                            {{ old("faculty") == "คณะเทคนิคการแพทย์" ? "selected" : "" }}
                                        >
                                            คณะเทคนิคการแพทย์
                                        </option>
                                        <option
                                            value="คณะสาธารณสุขศาสตร์"
                                            {{ old("faculty") == "คณะสาธารณสุขศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะสาธารณสุขศาสตร์
                                        </option>
                                        <option
                                            value="คณะทันตแพทยศาสตร์"
                                            {{ old("faculty") == "คณะทันตแพทยศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะทันตแพทยศาสตร์
                                        </option>
                                        <option
                                            value="คณะเภสัชศาสตร์"
                                            {{ old("faculty") == "คณะเภสัชศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะเภสัชศาสตร์
                                        </option>
                                        <option
                                            value="คณะสัตวแพทยศาสตร์"
                                            {{ old("faculty") == "คณะสัตวแพทยศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะสัตวแพทยศาสตร์
                                        </option>
                                    </optgroup>
                                    <optgroup
                                        label="กลุ่มสาขาวิชามนุษยศาสตร์และสังคมศาสตร์"
                                    >
                                        <option
                                            value="คณะศึกษาศาสตร์"
                                            {{ old("faculty") == "คณะศึกษาศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะศึกษาศาสตร์
                                        </option>
                                        <option
                                            value="คณะมนุษยศาสตร์และสังคมศาสตร์"
                                            {{ old("faculty") == "คณะมนุษยศาสตร์และสังคมศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะมนุษยศาสตร์และสังคมศาสตร์
                                        </option>
                                        <option
                                            value="คณะบริหารธุรกิจและการบัญชี"
                                            {{ old("faculty") == "คณะบริหารธุรกิจและการบัญชี" ? "selected" : "" }}
                                        >
                                            คณะบริหารธุรกิจและการบัญชี
                                        </option>
                                        <option
                                            value="คณะศิลปกรรมศาสตร์"
                                            {{ old("faculty") == "คณะศิลปกรรมศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะศิลปกรรมศาสตร์
                                        </option>
                                        <option
                                            value="คณะเศรษฐศาสตร์"
                                            {{ old("faculty") == "คณะเศรษฐศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะเศรษฐศาสตร์
                                        </option>
                                        <option
                                            value="คณะนิติศาสตร์"
                                            {{ old("faculty") == "คณะนิติศาสตร์" ? "selected" : "" }}
                                        >
                                            คณะนิติศาสตร์
                                        </option>
                                        <option
                                            value="วิทยาลัยการปกครองท้องถิ่น"
                                            {{ old("faculty") == "วิทยาลัยการปกครองท้องถิ่น" ? "selected" : "" }}
                                        >
                                            วิทยาลัยการปกครองท้องถิ่น
                                        </option>
                                        <option
                                            value="วิทยาลัยบัณฑิตศึกษาการจัดการ"
                                            {{ old("faculty") == "วิทยาลัยบัณฑิตศึกษาการจัดการ" ? "selected" : "" }}
                                        >
                                            วิทยาลัยบัณฑิตศึกษาการจัดการ
                                        </option>
                                    </optgroup>
                                    <optgroup label="กลุ่มสหสาขาวิชา">
                                        <option
                                            value="บัณฑิตวิทยาลัย"
                                            {{ old("faculty") == "บัณฑิตวิทยาลัย" ? "selected" : "" }}
                                        >
                                            บัณฑิตวิทยาลัย
                                        </option>
                                        <option
                                            value="วิทยาลัยนานาชาติ"
                                            {{ old("faculty") == "วิทยาลัยนานาชาติ" ? "selected" : "" }}
                                        >
                                            วิทยาลัยนานาชาติ
                                        </option>
                                        <option
                                            value="คณะสหวิทยาการ"
                                            {{ old("faculty") == "คณะสหวิทยาการ" ? "selected" : "" }}
                                        >
                                            คณะสหวิทยาการ
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="flex-1">
                                <select
                                    id="year"
                                    name="year"
                                    required
                                    class="custom-select w-full appearance-none rounded-lg border-2 border-gray-300 bg-white p-3 text-sm outline-none focus:border-sky-500 md:text-base"
                                >
                                    <option value="">ชั้นปี</option>
                                    <option
                                        value="1"
                                        {{ old("year") == "1" ? "selected" : "" }}
                                    >
                                        ปี 1
                                    </option>
                                    <option
                                        value="2"
                                        {{ old("year") == "2" ? "selected" : "" }}
                                    >
                                        ปี 2
                                    </option>
                                    <option
                                        value="3"
                                        {{ old("year") == "3" ? "selected" : "" }}
                                    >
                                        ปี 3
                                    </option>
                                    <option
                                        value="4"
                                        {{ old("year") == "4" ? "selected" : "" }}
                                    >
                                        ปี 4
                                    </option>
                                </select>
                            </div>
                        </div>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="อีเมล์ (KKU Mail)"
                            value="{{ old("email") }}"
                            required
                            class="rounded-lg border-2 border-gray-300 p-3 text-sm outline-none focus:border-sky-500 md:text-base"
                        />

                        <input
                            id="phone"
                            name="phone"
                            type="text"
                            placeholder="เบอร์โทรศัพท์"
                            value="{{ old("phone") }}"
                            required
                            maxlength="10"
                            class="rounded-lg border-2 border-gray-300 p-3 text-sm outline-none focus:border-sky-500 md:text-base"
                        />

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <div class="flex-1">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="รหัสผ่าน"
                                    required
                                    class="w-full rounded-lg border-2 border-gray-300 p-3 text-sm outline-none focus:border-sky-500 md:text-base"
                                />
                            </div>
                            <div class="flex-1">
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    placeholder="ยืนยันรหัสผ่าน"
                                    required
                                    class="w-full rounded-lg border-2 border-gray-300 p-3 text-sm outline-none focus:border-sky-500 md:text-base"
                                />
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="mt-4 cursor-pointer rounded-lg bg-sky-500 py-3 text-base font-semibold text-white transition-colors duration-200 hover:bg-sky-600 md:mt-6 md:py-4 md:text-lg"
                        >
                            ลงทะเบียน
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-full">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML =
                    '<i class="fas fa-user text-gray-400 text-3xl"></i>';
            }
        }
    </script>
@endpush
