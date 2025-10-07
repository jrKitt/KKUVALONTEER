@extends("components/layouts/layoutAdmin")

@section("title", "เช็คชื่อกิจกรรม - " . $activity->name_th)

@section("layout-content")
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    เช็คชื่อกิจกรรม
                </h1>
                <p class="mt-2 text-gray-600">{{ $activity->name_th }}</p>
            </div>
            <a
                href="{{ route("admin.events") }}"
                class="btn btn-outline btn-sm"
            >
                <svg
                    class="mr-2 h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>
                กลับ
            </a>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Activity Info -->
            <div class="rounded-xl bg-white p-6 shadow-md">
                <h3 class="mb-4 text-lg font-semibold text-gray-900">
                    ข้อมูลกิจกรรม
                </h3>

                @if ($activity->image_file_name)
                    <img
                        src="{{ asset("uploads/activities/" . $activity->image_file_name) }}"
                        alt="{{ $activity->name_th }}"
                        class="mb-4 h-32 w-full rounded-lg object-cover"
                    />
                @endif

                <div class="space-y-3 text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg
                            class="mr-2 h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                        </svg>
                        {{ $activity->location ?: "ไม่ระบุสถานที่" }}
                    </div>

                    <div class="flex items-center text-gray-600">
                        <svg
                            class="mr-2 h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h8m-8 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"
                            />
                        </svg>
                        {{ $activity->start_time ? $activity->start_time->format("d M Y H:i") : "ไม่ระบุ" }}
                    </div>

                    <div class="flex items-center text-gray-600">
                        <svg
                            class="mr-2 h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        {{ $activity->total_hour ?? 0 }} ชั่วโมง
                    </div>

                    <div class="flex items-center text-gray-600">
                        <svg
                            class="mr-2 h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                            />
                        </svg>
                        {{ $participants->count() }} /
                        {{ $activity->accept_amount }} คน
                    </div>
                </div>

                @if ($activity->description)
                    <div class="mt-4 border-t border-gray-100 pt-4">
                        <p class="text-sm text-gray-600">
                            {{ $activity->description }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- Checkin Stats & Actions -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Stats Cards -->
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    <div class="rounded-xl bg-white p-4 text-center shadow-md">
                        <div class="text-2xl font-bold text-blue-600">
                            {{ $participants->count() }}
                        </div>
                        <div class="text-sm text-gray-600">ลงทะเบียน</div>
                    </div>
                    <div class="rounded-xl bg-white p-4 text-center shadow-md">
                        <div class="text-2xl font-bold text-green-600">
                            {{ $participants->where("checked_in", true)->count() }}
                        </div>
                        <div class="text-sm text-gray-600">เช็คชื่อแล้ว</div>
                    </div>
                    <div class="rounded-xl bg-white p-4 text-center shadow-md">
                        <div class="text-2xl font-bold text-orange-600">
                            {{ $participants->where("checked_in", false)->count() }}
                        </div>
                        <div class="text-sm text-gray-600">ยังไม่เช็คชื่อ</div>
                    </div>
                    <div class="rounded-xl bg-white p-4 text-center shadow-md">
                        <div class="text-2xl font-bold text-purple-600">
                            {{ number_format(($participants->where("checked_in", true)->count() / max($participants->count(), 1)) * 100, 1) }}%
                        </div>
                        <div class="text-sm text-gray-600">อัตราเช็คชื่อ</div>
                    </div>
                </div>

                <!-- Bulk Actions -->
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">
                        การจัดการแบบกลุ่ม
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <button
                            onclick="selectAll()"
                            class="btn btn-outline btn-sm"
                        >
                            <svg
                                class="mr-2 h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            เลือกทั้งหมด
                        </button>
                        <button
                            onclick="deselectAll()"
                            class="btn btn-outline btn-sm"
                        >
                            ยกเลิกการเลือก
                        </button>
                        <button
                            onclick="bulkCheckin()"
                            class="btn btn-primary btn-sm"
                            id="bulkCheckinBtn"
                            disabled
                        >
                            <svg
                                class="mr-2 h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            เช็คชื่อที่เลือก
                        </button>

                        <!-- Bulk Hours Input -->
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-600">
                                ชั่วโมงจริง:
                            </label>
                            <input
                                type="number"
                                id="bulkHours"
                                step="0.5"
                                min="0"
                                value="{{ $activity->total_hour }}"
                                class="input input-bordered input-sm w-24"
                            />
                        </div>
                    </div>
                </div>

                <!-- Participants List -->
                <div class="overflow-hidden rounded-xl bg-white shadow-md">
                    <div class="border-b border-gray-200 p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">
                                รายชื่อผู้เข้าร่วม
                            </h3>
                            <div class="flex items-center gap-2">
                                <input
                                    type="text"
                                    id="searchParticipant"
                                    placeholder="ค้นหาชื่อ..."
                                    class="input input-bordered input-sm"
                                />
                                <select
                                    id="filterStatus"
                                    class="select select-bordered select-sm"
                                >
                                    <option value="">สถานะทั้งหมด</option>
                                    <option value="checked_in">
                                        เช็คชื่อแล้ว
                                    </option>
                                    <option value="registered">
                                        ยังไม่เช็คชื่อ
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        <input
                                            type="checkbox"
                                            id="selectAllCheckbox"
                                            class="checkbox checkbox-sm"
                                        />
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        ชื่อ-นามสกุล
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        อีเมล
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        สถานะ
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        ชั่วโมง
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        เวลาเช็คชื่อ
                                    </th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        การจัดการ
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-gray-200 bg-white"
                                id="participantsTableBody"
                            >
                                @foreach ($participants as $participant)
                                    <tr
                                        class="participant-row hover:bg-gray-50"
                                        data-participant-id="{{ $participant->id }}"
                                        data-status="{{ $participant->checkin_status }}"
                                        data-search="{{ strtolower($participant->user->firstname . " " . $participant->user->lastname . " " . $participant->user->email) }}"
                                    >
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <input
                                                type="checkbox"
                                                class="participant-checkbox checkbox checkbox-sm"
                                                value="{{ $participant->id }}"
                                                {{ $participant->checked_in ? "disabled" : "" }}
                                            />
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if ($participant->user->profile_image)
                                                    <img
                                                        src="{{ asset("uploads/profiles/" . $participant->user->profile_image) }}"
                                                        alt="{{ $participant->user->firstname }}"
                                                        class="mr-3 h-8 w-8 rounded-full"
                                                    />
                                                @else
                                                    <div
                                                        class="mr-3 flex h-8 w-8 items-center justify-center rounded-full bg-blue-100"
                                                    >
                                                        <span
                                                            class="text-sm font-medium text-blue-600"
                                                        >
                                                            {{ substr($participant->user->firstname, 0, 1) }}
                                                        </span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div
                                                        class="text-sm font-medium text-gray-900"
                                                    >
                                                        {{ $participant->user->firstname }}
                                                        {{ $participant->user->lastname }}
                                                    </div>
                                                    <div
                                                        class="text-sm text-gray-500"
                                                    >
                                                        {{ $participant->user->faculty }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm whitespace-nowrap text-gray-900"
                                        >
                                            {{ $participant->user->email }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            @php
                                                $badge = $participant->status_badge;
                                            @endphp

                                            <span
                                                class="{{ $badge["class"] }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                                            >
                                                {{ $badge["icon"] }}
                                                {{ $badge["text"] }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm whitespace-nowrap text-gray-900"
                                        >
                                            {{ $participant->actual_hours ?? $activity->total_hour }}
                                            ชม.
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm whitespace-nowrap text-gray-500"
                                        >
                                            {{ $participant->checked_in_at ? $participant->checked_in_at->format("d/m/Y H:i") : "-" }}
                                        </td>
                                        <td
                                            class="px-4 py-4 text-right text-sm font-medium whitespace-nowrap"
                                        >
                                            @if ($participant->checked_in)
                                                <button
                                                    onclick="undoCheckin({{ $participant->id }})"
                                                    class="mr-3 text-red-600 hover:text-red-900"
                                                >
                                                    ยกเลิก
                                                </button>
                                                <button
                                                    onclick="showCheckinDetails({{ $participant->id }})"
                                                    class="text-blue-600 hover:text-blue-900"
                                                >
                                                    รายละเอียด
                                                </button>
                                            @else
                                                <button
                                                    onclick="showCheckinModal({{ $participant->id }})"
                                                    class="text-green-600 hover:text-green-900"
                                                >
                                                    เช็คชื่อ
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkin Modal -->
    <dialog id="checkinModal" class="modal">
        <div class="modal-box">
            <h3 class="mb-4 text-lg font-bold">เช็คชื่อผู้เข้าร่วม</h3>
            <form id="checkinForm">
                <input type="hidden" id="participantId" />

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        ชั่วโมงจริงที่เข้าร่วม
                    </label>
                    <input
                        type="number"
                        id="actualHours"
                        step="0.5"
                        min="0"
                        value="{{ $activity->total_hour }}"
                        class="input input-bordered w-full"
                    />
                </div>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        หมายเหตุ (ไม่บังคับ)
                    </label>
                    <textarea
                        id="checkinNotes"
                        rows="3"
                        class="textarea textarea-bordered w-full"
                        placeholder="เช่น: เข้าร่วมเต็มเวลา, มาสาย 30 นาที"
                    ></textarea>
                </div>

                <div class="modal-action">
                    <button
                        type="button"
                        class="btn btn-outline"
                        onclick="document.getElementById('checkinModal').close()"
                    >
                        ยกเลิก
                    </button>
                    <button type="submit" class="btn btn-primary">
                        เช็คชื่อ
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Details Modal -->
    <dialog id="detailsModal" class="modal">
        <div class="modal-box">
            <h3 class="mb-4 text-lg font-bold">รายละเอียดการเช็คชื่อ</h3>
            <div id="checkinDetails"></div>
            <div class="modal-action">
                <button
                    class="btn btn-outline"
                    onclick="document.getElementById('detailsModal').close()"
                >
                    ปิด
                </button>
            </div>
        </div>
    </dialog>

    <script>
        // Global variables
        let selectedParticipants = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function () {
            updateBulkActionButton();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Search functionality
            document
                .getElementById('searchParticipant')
                .addEventListener('input', filterParticipants);
            document
                .getElementById('filterStatus')
                .addEventListener('change', filterParticipants);

            // Select all checkbox
            document
                .getElementById('selectAllCheckbox')
                .addEventListener('change', function () {
                    const checkboxes = document.querySelectorAll(
                        '.participant-checkbox:not(:disabled)',
                    );
                    checkboxes.forEach((cb) => {
                        cb.checked = this.checked;
                    });
                    updateSelectedParticipants();
                });

            // Individual checkboxes
            document.querySelectorAll('.participant-checkbox').forEach((cb) => {
                cb.addEventListener('change', updateSelectedParticipants);
            });

            // Checkin form
            document
                .getElementById('checkinForm')
                .addEventListener('submit', function (e) {
                    e.preventDefault();
                    submitCheckin();
                });
        }

        function filterParticipants() {
            const searchTerm = document
                .getElementById('searchParticipant')
                .value.toLowerCase();
            const statusFilter = document.getElementById('filterStatus').value;

            document.querySelectorAll('.participant-row').forEach((row) => {
                const searchData = row.dataset.search;
                const status = row.dataset.status;

                const matchesSearch =
                    searchTerm === '' || searchData.includes(searchTerm);
                const matchesStatus =
                    statusFilter === '' || status === statusFilter;

                row.style.display =
                    matchesSearch && matchesStatus ? '' : 'none';
            });
        }

        function selectAll() {
            const visibleCheckboxes = document.querySelectorAll(
                '.participant-row:not([style*="display: none"]) .participant-checkbox:not(:disabled)',
            );
            visibleCheckboxes.forEach((cb) => {
                cb.checked = true;
            });
            updateSelectedParticipants();
        }

        function deselectAll() {
            document.querySelectorAll('.participant-checkbox').forEach((cb) => {
                cb.checked = false;
            });
            updateSelectedParticipants();
        }

        function updateSelectedParticipants() {
            selectedParticipants = Array.from(
                document.querySelectorAll('.participant-checkbox:checked'),
            ).map((cb) => cb.value);
            updateBulkActionButton();
        }

        function updateBulkActionButton() {
            const button = document.getElementById('bulkCheckinBtn');
            button.disabled = selectedParticipants.length === 0;
            button.textContent = `เช็คชื่อที่เลือก (${selectedParticipants.length})`;
        }

        function showCheckinModal(participantId) {
            document.getElementById('participantId').value = participantId;
            document.getElementById('checkinModal').showModal();
        }

        function submitCheckin() {
            const participantId =
                document.getElementById('participantId').value;
            const actualHours = document.getElementById('actualHours').value;
            const notes = document.getElementById('checkinNotes').value;

            fetch(`/admin/activities/{{ $activity->id }}/checkin`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
                body: JSON.stringify({
                    participant_id: participantId,
                    actual_hours: actualHours,
                    notes: notes,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        location.reload(); // Simple reload for now
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
                });

            document.getElementById('checkinModal').close();
        }

        function undoCheckin(participantId) {
            if (!confirm('คุณแน่ใจหรือไม่ที่จะยกเลิกการเช็คชื่อ?')) {
                return;
            }

            fetch(`/admin/activities/{{ $activity->id }}/checkin/undo`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
                body: JSON.stringify({
                    participant_id: participantId,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + data.message);
                    }
                });
        }

        function bulkCheckin() {
            if (selectedParticipants.length === 0) {
                alert('กรุณาเลือกผู้เข้าร่วมที่ต้องการเช็คชื่อ');
                return;
            }

            const actualHours = document.getElementById('bulkHours').value;

            if (
                !confirm(
                    `คุณแน่ใจหรือไม่ที่จะเช็คชื่อ ${selectedParticipants.length} คน?`,
                )
            ) {
                return;
            }

            fetch(`/admin/activities/{{ $activity->id }}/checkin/bulk`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                },
                body: JSON.stringify({
                    participant_ids: selectedParticipants,
                    actual_hours: actualHours,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    alert(data.message);
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
                });
        }

        function showCheckinDetails(participantId) {
            // Find participant data
            const row = document.querySelector(
                `[data-participant-id="${participantId}"]`,
            );
            // Implementation for showing details - you can customize this
            document.getElementById('detailsModal').showModal();
        }
    </script>
@endsection
