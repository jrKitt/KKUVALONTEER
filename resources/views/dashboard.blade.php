@extends('components/layouts/layoutAfterLogin')

@section('title')
    หน้าหลัก | KKU VOLUNTEER
@endsection

@section('layout-content')
    <div class="min-h-screen bg-gray-50">
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-8">
                <div class="bg-red-600 text-white p-6 md:p-8 rounded-2xl text-center max-w-md mx-auto">
                    <h2 class="text-lg md:text-xl font-semibold mb-2">สถานะปัจจุบัน</h2>
                    <div class="text-3xl md:text-4xl font-bold">{{ $totalHours ?? 0 }} ชั่วโมง</div>
                </div>
            </div>

            <!-- Volunteer Hours Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">รวมชั่วโมงทั้งหมด</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalHours ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">อนุมัติแล้ว</p>
                            <p class="text-2xl font-bold text-green-600">{{ $approvedHours ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">รออนุมัติ</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $pendingHours ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>


            @if(isset($recentActivities) && $recentActivities->count() > 0)
            <!-- Recent Activities -->
            <div class="mb-8">
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6">กิจกรรมที่เข้าร่วมล่าสุด</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentActivities->take(6) as $activity)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ asset('images/carousel_' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $activity->activity_name }}" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 text-sm font-medium rounded-full text-white shadow-lg
                                    @if($activity->status === 'approved') bg-green-500
                                    @elseif($activity->status === 'rejected') bg-red-500
                                    @else bg-yellow-500 @endif">
                                    @if($activity->status === 'approved') อนุมัติแล้ว
                                    @elseif($activity->status === 'rejected') ไม่อนุมัติ
                                    @else รออนุมัติ @endif
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-3 leading-tight">{{ $activity->activity_name }}</h4>

                            <div class="flex items-center gap-2 mb-4">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">#เกษตรศาสตร์</span>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">ปี 1-4</span>
                            </div>

                            @if($activity->description)
                            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                                {{ Str::limit($activity->description, 80) }}
                            </p>
                            @endif

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    มหาวิทยาลัยขอนแก่น
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $activity->date->format('d M Y', 'th') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $activity->hours }} ชั่วโมง
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('volunteer-hours.show', $activity) }}"
                                   class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-center font-medium">
                                    ดูรายละเอียด
                                </a>
                                @if($activity->status === 'pending')
                                <a href="{{ route('volunteer-hours.edit', $activity) }}"
                                   class="px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 transition-colors font-medium">
                                    แก้ไข
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <hr class="my-8 text-gray-400">

            <section class="mb-8">
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6">กิจกรรมแนะนำ</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($upcomingEvents as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ asset('images/' . $event['image']) }}" alt="{{ $event['title'] }}" class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-3 leading-tight">{{ $event['title'] }}</h4>

                            <div class="flex items-center gap-2 mb-4">
                                @foreach($event['tags'] as $tag)
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">{{ $tag }}</span>
                                @endforeach
                            </div>

                            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                                {{ $event['description'] }}
                            </p>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $event['location'] }}
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $event['date'] }}
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $event['hours'] }}
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <button class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-center font-medium">
                                    สมัครเลย
                                </button>
                                <button class="px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 transition-colors font-medium">
                                    ดูรายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
@endsection
