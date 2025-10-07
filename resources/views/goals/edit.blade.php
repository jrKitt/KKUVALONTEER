@extends("components/layouts/layoutAfterLogin")

@section("title", "แก้ไขเป้าหมาย")

@section("layout-content")
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">แก้ไขเป้าหมาย</h1>
                <p class="mt-2 text-gray-600">
                    แก้ไขรายละเอียดเป้าหมายการทำกิจกรรมอาสาสมัคร
                </p>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-md">
            <form action="{{ route("goals.update", $goal) }}" method="POST">
                @csrf
                @method("PUT")

                <div class="mb-6">
                    <label
                        for="goal_type"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        ประเภทเป้าหมาย
                    </label>
                    <select
                        name="goal_type"
                        id="goal_type"
                        required
                        class="select select-bordered @error("goal_type") select-error @enderror w-full"
                    >
                        <option value="">เลือกประเภทเป้าหมาย</option>
                        @foreach ($goalTypes as $key => $value)
                            <option
                                value="{{ $key }}"
                                {{ old("goal_type", $goal->goal_type) == $key ? "selected" : "" }}
                            >
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error("goal_type")
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="target_hours"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        เป้าหมายจำนวนชั่วโมง
                    </label>
                    <input
                        type="number"
                        name="target_hours"
                        id="target_hours"
                        value="{{ old("target_hours", $goal->target_hours) }}"
                        min="1"
                        step="0.5"
                        required
                        class="input input-bordered @error("target_hours") input-error @enderror w-full"
                        placeholder="เช่น 40"
                    />
                    @error("target_hours")
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="period_type"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        ช่วงเวลา
                    </label>
                    <select
                        name="period_type"
                        id="period_type"
                        required
                        class="select select-bordered @error("period_type") select-error @enderror w-full"
                    >
                        <option value="">เลือกช่วงเวลา</option>
                        @foreach ($periodTypes as $key => $value)
                            <option
                                value="{{ $key }}"
                                {{ old("period_type", $goal->period_type) == $key ? "selected" : "" }}
                            >
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error("period_type")
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label
                            for="start_date"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            วันที่เริ่มต้น
                        </label>
                        <input
                            type="date"
                            name="start_date"
                            id="start_date"
                            value="{{ old("start_date", $goal->start_date->format("Y-m-d")) }}"
                            required
                            class="input input-bordered @error("start_date") input-error @enderror w-full"
                        />
                        @error("start_date")
                            <div class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label
                            for="end_date"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            วันที่สิ้นสุด
                        </label>
                        <input
                            type="date"
                            name="end_date"
                            id="end_date"
                            value="{{ old("end_date", $goal->end_date->format("Y-m-d")) }}"
                            required
                            class="input input-bordered @error("end_date") input-error @enderror w-full"
                        />
                        @error("end_date")
                            <div class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label
                        for="category"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        หมวดหมู่กิจกรรม
                    </label>
                    <select
                        name="category"
                        id="category"
                        class="select select-bordered @error("category") select-error @enderror w-full"
                    >
                        <option value="">เลือกหมวดหมู่ (ไม่บังคับ)</option>
                        @foreach ($categories as $key => $value)
                            <option
                                value="{{ $key }}"
                                {{ old("category", $goal->category) == $key ? "selected" : "" }}
                            >
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error("category")
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="description"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        รายละเอียดเพิ่มเติม
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="textarea textarea-bordered @error("description") textarea-error @enderror w-full"
                        placeholder="อธิบายเป้าหมายและแรงจูงใจของคุณ (ไม่บังคับ)"
                    >
{{ old("description", $goal->description) }}</textarea
                    >
                    @error("description")
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-6 rounded-lg bg-blue-50 p-4">
                    <h3 class="mb-2 font-medium text-blue-900">
                        ความคืบหน้าปัจจุบัน
                    </h3>
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-sm text-blue-700">
                            {{ $goal->current_hours }} /
                            {{ $goal->target_hours }} ชั่วโมง
                        </span>
                        <span class="text-sm font-medium text-blue-900">
                            {{ number_format($goal->progress_percentage, 1) }}%
                        </span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-blue-200">
                        <div
                            class="h-2 rounded-full bg-blue-600 transition-all duration-300"
                            style="
                                width: {{ min($goal->progress_percentage, 100) }}%;
                            "
                        ></div>
                    </div>
                </div>

                <div class="flex flex-col justify-end gap-4 sm:flex-row">
                    <a href="{{ route("goals.index") }}" class="btn shadow-md">
                        ยกเลิก
                    </a>
                    <button type="submit" class="btn btn-primary">
                        บันทึกการแก้ไข
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document
            .getElementById('period_type')
            .addEventListener('change', function () {
                const periodType = this.value;
                const startDateInput = document.getElementById('start_date');
                const endDateInput = document.getElementById('end_date');
                const today = new Date();

                if (periodType === 'academic_year') {
                    const currentMonth = today.getMonth() + 1;
                    let academicStartYear = today.getFullYear();

                    if (currentMonth <= 5) {
                        academicStartYear -= 1;
                    }

                    startDateInput.value = `${academicStartYear}-08-01`;
                    endDateInput.value = `${academicStartYear + 1}-05-31`;
                } else if (periodType === 'semester') {
                    const currentMonth = today.getMonth() + 1;
                    let semesterStart, semesterEnd;

                    if (currentMonth >= 8 || currentMonth <= 12) {
                        semesterStart = `${today.getFullYear()}-08-01`;
                        semesterEnd = `${today.getFullYear()}-12-31`;
                    } else {
                        semesterStart = `${today.getFullYear()}-01-01`;
                        semesterEnd = `${today.getFullYear()}-05-31`;
                    }

                    startDateInput.value = semesterStart;
                    endDateInput.value = semesterEnd;
                }
            });

        document
            .getElementById('start_date')
            .addEventListener('change', function () {
                const startDate = new Date(this.value);
                const endDateInput = document.getElementById('end_date');

                if (endDateInput.value) {
                    const endDate = new Date(endDateInput.value);
                    if (endDate <= startDate) {
                        const newEndDate = new Date(startDate);
                        newEndDate.setMonth(newEndDate.getMonth() + 3);
                        endDateInput.value = newEndDate
                            .toISOString()
                            .split('T')[0];
                    }
                }
            });
    </script>
@endsection
