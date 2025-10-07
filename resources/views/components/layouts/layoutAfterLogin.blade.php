{{-- resources/views/layouts/admin.blade.php --}}
@extends("components/layouts/layout-app")

@section("content")
    <div class="w-full">
        <header class="fixed z-1000 w-full bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <a href="/dashboard">
                        <div class="flex items-center">
                            <img
                                src="{{ asset("images/app_icon_2.png") }}"
                                class="w-50"
                            />
                        </div>
                    </a>
                    <button
                        class="flex items-center md:hidden"
                        id="mobile-menu-button"
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
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>
                    <nav class="hidden space-x-8 md:flex">
                        <a
                            href="/dashboard"
                            class="text-gray-700 hover:text-blue-600"
                        >
                            หน้าแรก
                        </a>
                        <a
                            href="{{ route("user.activities") }}"
                            class="text-gray-700 hover:text-blue-600"
                        >
                            กิจกรรมจิตอาสา
                        </a>
                        <a
                            href="/about"
                            class="text-gray-700 hover:text-blue-600"
                        >
                            ชั่วโมงจิตอาสา
                        </a>
                    </nav>
                    <div class="flex items-center space-x-4">
                        {{--
                            <div class="w-full h-full">
                            <button href="/profile">
                            <img class="rounded-full w-10 h-10" src="{{ asset('images/profileTemp.png') }}"
                            alt="img" width="100" height="100">
                            </button>
                            </div>
                        --}}
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <button href="/profile" class="cursor-pointer">
                                <img
                                    class="h-10 w-10 rounded-full border-2 border-gray-200 object-cover transition-colors hover:border-blue-300"
                                    src="{{ Auth::check() && Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset("images/tako.png") }}"
                                    alt="{{ Auth::check() ? Auth::user()->firstname . " " . Auth::user()->lastname : "Profile" }}"
                                    width="100"
                                    height="100"
                                />
                            </button>
                            <ul
                                tabindex="0"
                                class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 border border-gray-200 p-2 shadow-lg"
                            >
                                @auth
                                    <li
                                        class="menu-title px-3 py-2 text-lg text-gray-500"
                                    >
                                        <span>
                                            {{ Auth::user()->firstname }}
                                            {{ Auth::user()->lastname }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ Auth::user()->email }}
                                        </span>
                                    </li>
                                    <div class="divider my-1"></div>
                                @endauth

                                <li>
                                    <a
                                        href="/profile"
                                        class="flex items-center gap-2"
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                        โปรไฟล์
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="/logout"
                                        class="flex items-center gap-2 text-red-600 hover:text-red-700"
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                            />
                                        </svg>
                                        ออกจากระบบ
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="hidden border-t border-gray-200 bg-white md:hidden"
                id="mobile-menu"
            >
                <nav class="flex flex-col space-y-2 px-4 py-4">
                    <a
                        href="/dashboard"
                        class="py-2 text-gray-700 hover:text-blue-600"
                    >
                        หน้าแรก
                    </a>
                    <a
                        href="{{ route("user.activities") }}"
                        class="py-2 text-gray-700 hover:text-blue-600"
                    >
                        กิจกรรมจิตอาสา
                    </a>
                    <a
                        href="/about"
                        class="py-2 text-gray-700 hover:text-blue-600"
                    >
                        ชั่วโมงจิตอาสา
                    </a>
                </nav>
            </div>
        </header>

        <div class="bg-gray-50 pt-16">
            @yield("layout-content")
        </div>

        <footer class="border-t border-gray-200 bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                        <div class="flex items-center">
                            <img
                                src="{{ asset("images/app_icon_2.png") }}"
                                class="w-50"
                            />
                        </div>
                        <div class="col-span-2">
                            <h3 class="mb-4 font-bold text-gray-900">
                                เกี่ยวกับเรา
                            </h3>
                            <p class="text-sm leading-relaxed text-gray-600">
                                แพลตฟอร์มการจัดการกิจกรรมอาสาสมัครสำหรับนักศึกษามหาวิทยาลัยขอนแก่น
                                ที่ช่วยให้นักศึกษาสามารถค้นหา ลงทะเบียน
                                และติดตามกิจกรรมอาสาสมัครได้อย่างสะดวก
                                พร้อมระบบการจัดการชั่วโมงอาสาและใบรับรองการเข้าร่วมกิจกรรม
                                เพื่อส่งเสริมจิตสำนึกการให้บริการสังคมและการพัฒนาชุมชนอย่างยั่งยื่น
                            </p>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-4 font-bold text-gray-900">ติดต่อเรา</h3>
                        <div class="flex space-x-4">
                            <a
                                href="#"
                                class="text-gray-600 hover:text-gray-800"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="26"
                                    height="26"
                                    fill="currentColor"
                                    class="bi bi-facebook"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"
                                    />
                                </svg>
                            </a>
                            <a
                                href="#"
                                class="text-gray-600 hover:text-gray-800"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="26"
                                    height="26"
                                    fill="currentColor"
                                    class="bi bi-envelope-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"
                                    />
                                </svg>
                            </a>
                            <a
                                href="#"
                                class="text-gray-600 hover:text-gray-800"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="26"
                                    height="26"
                                    fill="currentColor"
                                    class="bi bi-telephone-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"
                                    />
                                </svg>
                            </a>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">
                            123 มหาวิทยาลัยขอนแก่น ตำบลในเมือง อำเภอเมืองขอนแก่น
                            จังหวัดขอนแก่น 40002
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@section("scripts")
    <script>
        document
            .getElementById('mobile-menu-button')
            .addEventListener('click', function () {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            });
    </script>
@endsection
