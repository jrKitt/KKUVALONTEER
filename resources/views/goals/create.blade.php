@extends("components/layouts/layoutAfterLogin")

@section("title")
    สร้างเป้าหมายใหม่ | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <main class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center">
                    <a
                        href="{{ route("goals.index") }}"
                        class="mr-4 p-2 text-gray-600 transition-colors duration-200 hover:text-gray-900"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            ></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            สร้างเป้าหมายใหม่
                        </h1>
                        <p class="mt-2 text-gray-600">
                            กำหนดเป้าหมายชั่วโมงกิจกรรมอาสาสมัครของคุณ
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="overflow-hidden rounded-xl bg-white shadow-lg">
                <form
                    action="{{ route("goals.store") }}"
                    method="POST"
                    class="p-8"
                >
                    @csrf

                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Goal Type -->
                            <div>
                                <label
                                    for="goal_type"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    ประเภทเป้าหมาย
                                    <span class="text-red-500">*</span>
                                </label>
                                <select
                                    name="goal_type"
                                    id="goal_type"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-colors duration-200 focus:border-red-500 focus:ring-2 focus:ring-red-500"
                                    required
                                >
                                    <option value="">
                                        เลือกประเภทเป้าหมาย
                                    </option>
                                    @foreach ($goalTypes as $key => $label)
                                        <option
                                            value="{{ $key }}"
                                            {{ old("goal_type") == $key ? "selected" : "" }}
                                        >
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("goal_type")
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Target Hours -->
                            <div>
                                <label
                                    for="target_hours"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    เป้าหมายชั่วโมง
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input
                                        type="number"
                                        name="target_hours"
                                        id="target_hours"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-colors duration-200 focus:border-red-500 focus:ring-2 focus:ring-red-500"
                                        placeholder="กรอกจำนวนชั่วโมง"
                                        min="1"
                                        step="0.5"
                                        value="{{ old("target_hours") }}"
                                        required
                                    />
                                    <span
                                        class="absolute top-1/2 right-4 -translate-y-1/2 transform text-gray-500"
                                    >
                                        ชั่วโมง
                                    </span>
                                </div>
                                @error("target_hours")
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Period Type -->
                            <div>
                                <label
                                    for="period_type"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    ช่วงเวลา
                                    <span class="text-red-500">*</span>
                                </label>
                                <select
                                    name="period_type"
                                    id="period_type"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-colors duration-200 focus:border-red-500 focus:ring-2 focus:ring-red-500"
                                    required
                                >
                                    <option value="">เลือกช่วงเวลา</option>
                                    @foreach ($periodTypes as $key => $label)
                                        <option
                                            value="{{ $key }}"
                                            {{ old("period_type") == $key ? "selected" : "" }}
                                        >
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("period_type")
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label
                                    for="category"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    ประเภทกิจกรรม
                                </label>
                                <select
                                    name="category"
                                    id="category"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-colors duration-200 focus:border-red-500 focus:ring-2 focus:ring-red-500"
                                >
                                    <option value="">
                                        เลือกประเภทกิจกรรม (ไม่บังคับ)
                                    </option>
                                    @foreach ($categories as $key => $label)
                                        <option
                                            value="{{ $key }}"
                                            {{ old("category") == $key ? "selected" : "" }}
                                        >
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("category")
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Start Date -->
                            <div>
                                <label
                                    for="start_date"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    วันที่เริ่มต้น
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="date"
                                    name="start_date"
                                    id="start_date"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-colors duration-200 focus:border-red-500 focus:ring-2 focus:ring-red-500"
                                    value="{{ old("start_date", date("Y-m-d")) }}"
                                    required
                                />
                                @error("start_date")
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label
                                    for="end_date"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    วันที่สิ้นสุด
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="date"
                                    name="end_date"
                                    id="end_date"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-colors duration-200 focus:border-red-500 focus:ring-2 focus:ring-red-500"
                                    value="{{ old("end_date") }}"
                                    required
                                />
                                @error("end_date")
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label
                                    for="description"
                                    class="mb-2 block text-sm font-medium text-gray-700"
                                >
                                    รายละเอียดเป้าหมาย
                                </label>
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="4"
                                    class="w-full resize-none rounded-lg border border-gray-300 px-4 py-3 transition-colors duration-200 focus:border-red-500 focus:ring-2 focus:ring-red-500"
                                    placeholder="อธิบายเป้าหมายของคุณ (ไม่บังคับ)"
                                    maxlength="500"
                                >
{{ old("description") }}</textarea
                                >
                                <p class="mt-1 text-sm text-gray-500">
                                    เหลือ
                                    <span id="charCount">500</span>
                                    ตัวอักษร
                                </p>
                                @error("description")
                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Quick Presets -->
                            <div class="rounded-lg bg-gray-50 p-4">
                                <h4
                                    class="mb-3 text-sm font-medium text-gray-900"
                                >
                                    เป้าหมายแนะนำ
                                </h4>
                                <div class="grid grid-cols-2 gap-2">
                                    <button
                                        type="button"
                                        class="preset-btn rounded border border-gray-300 bg-white p-2 text-sm text-gray-700 hover:bg-gray-50"
                                        data-hours="20"
                                        data-period="semester"
                                    >
                                        20 ชม./ภาคเรียน
                                    </button>
                                    <button
                                        type="button"
                                        class="preset-btn rounded border border-gray-300 bg-white p-2 text-sm text-gray-700 hover:bg-gray-50"
                                        data-hours="40"
                                        data-period="academic_year"
                                    >
                                        40 ชม./ปีการศึกษา
                                    </button>
                                    <button
                                        type="button"
                                        class="preset-btn rounded border border-gray-300 bg-white p-2 text-sm text-gray-700 hover:bg-gray-50"
                                        data-hours="10"
                                        data-period="monthly"
                                    >
                                        10 ชม./เดือน
                                    </button>
                                    <button
                                        type="button"
                                        class="preset-btn rounded border border-gray-300 bg-white p-2 text-sm text-gray-700 hover:bg-gray-50"
                                        data-hours="120"
                                        data-period="custom"
                                    >
                                        120 ชม./4 ปี
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        class="mt-8 flex flex-col gap-4 sm:flex-row sm:justify-end"
                    >
                        <a
                            href="{{ route("goals.index") }}"
                            class="rounded-lg border border-gray-300 px-6 py-3 text-center text-gray-700 transition-colors duration-200 hover:bg-gray-50"
                        >
                            ยกเลิก
                        </a>
                        <button
                            type="submit"
                            class="rounded-lg bg-emerald-500 px-8 py-3 font-medium text-white transition-colors duration-200 hover:bg-emerald-600"
                        >
                            สร้างเป้าหมาย
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Character count for description
            const description = document.getElementById('description');
            const charCount = document.getElementById('charCount');

            description.addEventListener('input', function () {
                const remaining = 500 - this.value.length;
                charCount.textContent = remaining;
                charCount.className =
                    remaining < 50 ? 'text-red-600' : 'text-gray-500';
            });

            // Preset buttons
            const presetButtons = document.querySelectorAll('.preset-btn');
            presetButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    const hours = this.dataset.hours;
                    const period = this.dataset.period;

                    document.getElementById('target_hours').value = hours;
                    document.getElementById('period_type').value = period;

                    // Auto-set dates based on period
                    const today = new Date();
                    const startDate = document.getElementById('start_date');
                    const endDate = document.getElementById('end_date');

                    startDate.value = today.toISOString().split('T')[0];

                    let end = new Date(today);
                    switch (period) {
                        case 'semester':
                            end.setMonth(end.getMonth() + 4);
                            break;
                        case 'academic_year':
                            end.setFullYear(end.getFullYear() + 1);
                            break;
                        case 'monthly':
                            end.setMonth(end.getMonth() + 1);
                            break;
                        case 'custom':
                            end.setFullYear(end.getFullYear() + 4);
                            break;
                    }

                    endDate.value = end.toISOString().split('T')[0];
                });
            });

            // Period type auto-date setting
            const periodType = document.getElementById('period_type');
            periodType.addEventListener('change', function () {
                const period = this.value;
                const today = new Date();
                const endDate = document.getElementById('end_date');

                if (!endDate.value) {
                    let end = new Date(today);
                    switch (period) {
                        case 'semester':
                            end.setMonth(end.getMonth() + 4);
                            break;
                        case 'academic_year':
                            end.setFullYear(end.getFullYear() + 1);
                            break;
                        case 'monthly':
                            end.setMonth(end.getMonth() + 1);
                            break;
                    }

                    if (period !== 'custom') {
                        endDate.value = end.toISOString().split('T')[0];
                    }
                }
            });

            // Validate end date is after start date
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');

            function validateDates() {
                if (startDate.value && endDate.value) {
                    if (new Date(endDate.value) <= new Date(startDate.value)) {
                        endDate.setCustomValidity(
                            'วันที่สิ้นสุดต้องมาหลังวันที่เริ่มต้น',
                        );
                    } else {
                        endDate.setCustomValidity('');
                    }
                }
            }

            startDate.addEventListener('change', validateDates);
            endDate.addEventListener('change', validateDates);
        });
    </script>
@endsection
