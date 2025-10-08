@extends("components/layouts/layout-app")

@section("title")
    เข้าสู่ระบบ | KKU VOLENTEER
@endsection

@section("content")
    <div class="flex min-h-screen w-full flex-col md:flex-row">
        <div class="hidden min-h-screen md:flex md:w-1/2">
            <x-sliders.slider-auth class="min-h-screen w-full" />
        </div>

        <div
            class="flex min-h-screen w-full items-center justify-center p-4 sm:p-6 md:w-1/2 md:p-12"
        >
            <div class="w-full max-w-[700px] px-2 sm:px-6 md:px-8">
                <form method="POST" action="{{ route("auth.login") }}">
                    @csrf
                    <div class="flex w-100 items-center">
                        <img src="{{ asset("images/app_icon_2.png") }}" />
                    </div>
                    <h1
                        class="mb-3 sm:mb-4 text-2xl sm:text-3xl md:text-4xl font-bold tracking-wide text-gray-900"
                    >
                        เข้าสู่ระบบ
                    </h1>
                    <div class="mt-2 mb-3 sm:mb-4 h-1 w-12 sm:w-16 bg-sky-500"></div>
                    <p class="mt-2 mb-6 sm:mb-8 text-base sm:text-lg md:text-xl text-gray-600">
                        หากยังต้องการสมัครบัญชี
                        <a
                            href="{{ route("auth.register") }}"
                            class="text-sky-500 underline hover:text-sky-600"
                        >
                            ลงทะเบียน
                        </a>
                    </p>

                    @if ($errors->any())
                        <div
                            class="mt-6 rounded-lg border border-red-400 bg-red-100 px-6 py-4 text-base text-red-700"
                        >
                            <ul class="list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mt-8 flex flex-col gap-6">
                        <div>
                            <label
                                for="email"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                อีเมล
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                placeholder="student.s@kkumail.com"
                                value="{{ old("email") }}"
                                required
                                class="w-full rounded-lg border-2 border-gray-300 px-3 sm:px-4 py-3 sm:py-4 text-base sm:text-lg transition-all duration-200 outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                            />
                        </div>

                        <div>
                            <label
                                for="password"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                รหัสผ่าน
                            </label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="••••••••"
                                required
                                class="w-full rounded-lg border-2 border-gray-300 px-3 sm:px-4 py-3 sm:py-4 text-base sm:text-lg transition-all duration-200 outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                            />
                        </div>
                        <button
                            type="submit"
                            class="mt-4 sm:mt-6 w-full cursor-pointer rounded-lg bg-sky-500 px-4 sm:px-6 py-3 sm:py-4 text-lg sm:text-xl font-semibold text-white shadow-lg transition-all duration-200 hover:bg-sky-600 hover:shadow-xl focus:ring-4 focus:ring-sky-200"
                        >
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
