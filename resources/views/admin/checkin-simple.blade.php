@extends("components/layouts/layoutAdmin")

@section("title", "เช็คชื่อกิจกรรม - Admin")

@section("layout-content")
    <div class="container mx-auto px-6 py-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                {{ $event->title }}
            </h1>
        </div>

        <div class="flex flex-col gap-6 lg:flex-row">
            <div class="w-full px-2 sm:px-0 lg:w-1/2">
                <div
                    class="rounded-lg border border-gray-200 bg-white shadow-sm"
                >
                    <div
                        class="aspect-video overflow-hidden rounded-t-lg bg-gray-50"
                    >
                        <img
                            src="{{ $event->image ?? "https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=500&h=300&fit=crop" }}"
                            alt="{{ $event->title }}"
                            class="h-full w-full object-cover"
                        />
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <span
                                class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700"
                            >
                                กิจกรรมจิตอาสา
                            </span>
                        </div>

                        <div class="space-y-3 text-sm text-gray-600">
                            <p class="leading-relaxed text-gray-800">
                                {{ $event->description }}
                            </p>

                            <div
                                class="space-y-2 border-t border-gray-100 pt-2"
                            >
                                <div class="flex items-center gap-2">
                                    <span>{{ $event->location }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span>
                                        {{ date("j F Y", strtotime($event->date)) }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span>{ $event->hours }} ชั่วโมง</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full px-2 sm:px-0 lg:w-1/2">
                <div
                    class="rounded-lg border border-gray-200 bg-white shadow-sm"
                >
                    <div class="p-3 sm:p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3
                                class="text-base font-semibold text-gray-900 sm:text-lg"
                            >
                                รายชื่อผู้เข้าร่วมกิจกรรม
                            </h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-2 py-2 text-left text-xs font-medium tracking-wider text-gray-500 uppercase sm:px-4 sm:py-3"
                                        >
                                            ชื่อ-นามสกุล
                                        </th>
                                        <th
                                            class="hidden px-2 py-2 text-center text-xs font-medium tracking-wider text-gray-500 uppercase sm:table-cell sm:px-4 sm:py-3"
                                        >
                                            ทำไปกี่ชม
                                        </th>
                                        <th
                                            class="hidden px-2 py-2 text-center text-xs font-medium tracking-wider text-gray-500 uppercase sm:table-cell sm:px-4 sm:py-3"
                                        >
                                            เหลืออีกกี่ชม
                                        </th>
                                        <th
                                            class="px-2 py-2 text-center text-xs font-medium tracking-wider text-gray-500 uppercase sm:px-4 sm:py-3"
                                        >
                                            เช็คชื่อ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white"
                                >
                                    @foreach ($participants as $participant)
                                        <tr
                                            class="participant-row hover:bg-gray-50"
                                        >
                                            <td
                                                class="px-2 py-3 sm:px-4 sm:py-4"
                                            >
                                                <div class="flex items-center">
                                                    <div
                                                        class="h-8 w-8 flex-shrink-0 sm:h-10 sm:w-10"
                                                    >
                                                        <img
                                                            class="h-8 w-8 rounded-full object-cover sm:h-10 sm:w-10"
                                                            src="{{ $participant->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode($participant->firstname . "+" . $participant->lastname) . "&background=random&color=fff" }}"
                                                            alt=""
                                                        />
                                                    </div>
                                                    <div class="ml-2 sm:ml-3">
                                                        <div
                                                            class="participant-name text-xs font-medium text-gray-900 sm:text-sm"
                                                        >
                                                            {{ $participant->firstname }}
                                                            {{ $participant->lastname }}
                                                        </div>
                                                        <div
                                                            class="hidden text-xs text-gray-500 sm:block"
                                                        >
                                                            {{ $participant->faculty }}
                                                            - ปี
                                                            {{ $participant->year }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="hidden px-2 py-3 text-center sm:table-cell sm:px-4 sm:py-4"
                                            >
                                                <span
                                                    class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                                >
                                                    {{ $participant->volunteer_hours->sum("hours") ?? 0 }}
                                                    ชม.
                                                </span>
                                            </td>
                                            <td
                                                class="hidden px-2 py-3 text-center sm:table-cell sm:px-4 sm:py-4"
                                            >
                                                @php
                                                    $totalHours = $participant->volunteer_hours->sum("hours") ?? 0;
                                                    $remainingHours = max(0, 40 - $totalHours);
                                                @endphp

                                                <span
                                                    class="{{ $remainingHours > 10 ? "bg-yellow-100 text-yellow-800" : ($remainingHours > 0 ? "bg-red-100 text-red-800" : "bg-green-100 text-green-800") }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                                                >
                                                    {{ $remainingHours }} ชม.
                                                </span>
                                            </td>
                                            <td
                                                class="px-2 py-3 text-center sm:px-4 sm:py-4"
                                            >
                                                @if ($participant->pivot->checked_in)
                                                    <span
                                                        class="inline-flex items-center rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800 sm:px-3"
                                                    >
                                                        ✓
                                                    </span>
                                                @else
                                                    <button
                                                        class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-2 py-1 text-xs font-medium text-white transition-colors duration-200 hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:outline-none sm:px-3"
                                                    >
                                                        เช็ค
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($participants->isEmpty())
                            <div class="py-8 text-center">
                                <div class="text-gray-500">
                                    <p class="text-sm">
                                        ยังไม่มีผู้สมัครเข้าร่วมกิจกรรมนี้
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="notification" class="fixed top-4 right-4 z-50 hidden">
        <div
            class="rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700 shadow-lg"
        >
            <span id="notificationMessage">เช็คชื่อสำเร็จ!</span>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const messageElement = document.getElementById(
                'notificationMessage',
            );

            messageElement.textContent = message;
            notification.classList.remove('hidden');

            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
        }

        document
            .querySelectorAll('button:not([disabled])')
            .forEach((button) => {
                if (button.textContent.trim() === 'เช็คชื่อ') {
                    button.addEventListener('click', function () {
                        showNotification('เช็คชื่อสำเร็จ!');

                        const cell = this.parentElement;
                        cell.innerHTML = `
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✓ เช็คแล้ว
                        </span>
                    `;
                    });
                }
            });
    </script>
@endsection
