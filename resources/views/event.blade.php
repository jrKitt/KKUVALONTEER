@extends('components/layouts/layoutAfterLogin')

@section('title')
    กิจกรรมอาสาสมัคร | KKU VOLUNTEER
@endsection

@section('layout-content')
    <div class="min-h-screen">
        <div class="my-8 h-full">
            <div class="relative w-full max-w-6xl mx-auto overflow-hidden rounded-md">

                <div class="absolute z-1 p-6 w-1/2">
                    <div>
                        <h1 class="text-2xl md:text-5xl font-bold text-white mb-4">ค่ายปลุกฝันสอนน้อง</h1>
                        <div class="text-white">
                            ค่ายปลุกฝันสอนน้อง จัดขึ้นเพื่อเป็นเวทีให้เยาวชนได้ค้นพบความฝันและศักยภาพของตนเอง
                            ผ่านกิจกรรมการเรียนรู้ การสอนทักษะ และการแนะแนวทางการพัฒนาตัวเองอย่างสร้างสรรค์
                            โดยมุ่งเน้นการสร้างแรงบันดาลใจ ปลูกฝังทัศนคติที่ดี และส่งเสริมความสามัคคีระหว่างรุ่นพี่และน้อง
                            รวมถึงการเรียนรู้การทำงานเป็นทีมและการรับผิดชอบต่อสังคมในบรรยากาศที่สนุกสนานและเป็นมิตร
                        </div>
                    </div>
                </div>

                <div class="flex w-[300%] animate-slide contrast-50">
                    <div class="w-1/3 flex-shrink-0 ">
                        <img src="{{ asset('images/carousel_1.jpg') }}"
                            class="w-full h-100 object-cover rounded-lg shadow-md ">
                    </div>

                    <div class="w-1/3 flex-shrink-0">
                        <img src="{{ asset('images/carousel_2.jpg') }}"
                            class="w-full h-100 object-cover rounded-lg shadow-md">
                    </div>

                    <div class="w-1/3 flex-shrink-0">
                        <img src="{{ asset('images/carousel_3.jpg') }}"
                            class="w-full h-100 object-cover rounded-lg shadow-md">
                    </div>
                </div>

                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-2 w-auto">
                    <span class="block h-1 w-6 bg-white rounded-full animate-indicator1"></span>
                    <span class="block h-1 w-6 bg-white rounded-full animate-indicator2"></span>
                    <span class="block h-1 w-6 bg-white rounded-full animate-indicator3"></span>
                </div>

                
            </div>

            <main>
                กิจกรรมอาสาสมัคร
            </main>

        </div>
    </div>
@endsection
