@extends("components/layouts/layoutAfterLogin")

@section("title")
    โปรไฟล์ | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <main>
                <div class="mt-10 flex items-end justify-center sm:mt-20">
                    <form id="profileImageForm" enctype="multipart/form-data">
                        @csrf
                        <input
                            type="file"
                            id="profileInput"
                            name="profile_image"
                            accept="image/*"
                            class="hidden"
                            onchange="uploadProfileImage(this)"
                        />
                    </form>
                    <img
                        id="profileImage"
                        src="{{ $user->profile_image ? asset($user->profile_image) : asset("images/tako.png") }}"
                        alt="profile"
                        class="h-32 w-32 cursor-pointer rounded-full border-4 border-white object-cover shadow-lg sm:h-40 sm:w-40 md:h-[200px] md:w-[200px]"
                        onclick="document.getElementById('profileInput').click()"
                    />
                    <div
                        class="relative right-6 bottom-3 cursor-pointer rounded-full bg-white p-1.5 shadow-md sm:right-8 sm:bottom-4 sm:p-2 md:right-10 md:bottom-5"
                        onclick="document.getElementById('profileInput').click()"
                    >
                        <i
                            class="fa-solid fa-camera text-sm text-gray-600 sm:text-base"
                        ></i>
                    </div>
                </div>

                <!-- Loading indicator -->
                <div id="uploadLoading" class="mt-4 hidden text-center">
                    <div
                        class="inline-flex items-center rounded-md bg-white px-4 py-2 text-sm leading-6 font-semibold text-blue-500 shadow"
                    >
                        <svg
                            class="mr-3 -ml-1 h-5 w-5 animate-spin text-blue-500"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                        กำลังอัพโหลด...
                    </div>
                </div>

                <div class="mt-5 px-4 text-center">
                    <h1 class="text-lg font-bold sm:text-xl">
                        {{ $user->firstname }} {{ $user->lastname }}
                    </h1>
                    <p class="text-xs break-words sm:text-sm">
                        {{ $user->email }}
                    </p>
                    <p class="text-xs text-gray-400 sm:text-sm">
                        {{ $user->faculty }} / {{ $user->major }}
                    </p>
                </div>

                <hr class="my-2 border-gray-300" />

                @if (session("success"))
                    <div
                        class="mt-4 rounded-lg border border-green-400 bg-green-100 p-4 text-green-700"
                    >
                        {{ session("success") }}
                    </div>
                @endif

                <div class="mt-10 flex justify-center px-4 sm:mt-20">
                    <form
                        action="{{ route("profile.update") }}"
                        method="POST"
                        class="w-full max-w-lg"
                    >
                        @csrf
                        @method("PUT")
                        <div
                            class="grid grid-cols-1 gap-5 sm:gap-10 md:grid-cols-2"
                        >
                            <div class="flex flex-col">
                                <label for="firstname" class="mb-2 font-bold">
                                    Firstname
                                </label>
                                <input
                                    type="text"
                                    id="firstname"
                                    name="firstname"
                                    value="{{ old("firstname", $user->firstname) }}"
                                    class="@error("firstname") @enderror w-full appearance-none rounded-lg border-gray-300 border-red-500 px-3 py-2 text-sm leading-tight text-gray-700 shadow-md focus:outline-none sm:px-5 sm:text-base"
                                />
                                @error("firstname")
                                    <span class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="lastname" class="mb-2 font-bold">
                                    Lastname
                                </label>
                                <input
                                    type="text"
                                    id="lastname"
                                    name="lastname"
                                    value="{{ old("lastname", $user->lastname) }}"
                                    class="@error("lastname") @enderror w-full appearance-none rounded-lg border-gray-300 border-red-500 px-3 py-2 text-sm leading-tight text-gray-700 shadow-md focus:outline-none sm:px-5 sm:text-base"
                                />
                                @error("lastname")
                                    <span class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 flex flex-col">
                            <label for="faculty" class="mb-2 font-bold">
                                Faculty
                            </label>
                            <input
                                disabled
                                type="text"
                                id="faculty"
                                name="faculty"
                                value="{{ old("faculty", $user->faculty) }}"
                                class="@error("faculty") @enderror w-full cursor-not-allowed appearance-none rounded-lg border-gray-300 border-red-500 bg-gray-100 px-3 py-2 text-sm leading-tight text-gray-900 shadow-md focus:outline-none sm:px-5 sm:text-base"
                            />
                            @error("faculty")
                                <span class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div
                            class="mt-5 grid grid-cols-1 gap-5 sm:gap-10 md:grid-cols-2"
                        >
                            <div class="flex flex-col">
                                <label for="major" class="mb-2 font-bold">
                                    Faculty (สาขา)
                                </label>
                                <input
                                    type="text"
                                    id="major"
                                    name="major"
                                    value="{{ old("major", $user->major) }}"
                                    class="@error("major") @enderror w-full appearance-none rounded-lg border-gray-300 border-red-500 px-3 py-2 text-sm leading-tight text-gray-700 shadow-md focus:outline-none sm:px-5 sm:text-base"
                                />
                                @error("major")
                                    <span class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="flex flex-col">
                                <label for="year" class="mb-2 font-bold">
                                    Year
                                </label>
                                <select
                                    id="year"
                                    name="year"
                                    class="@error("year") @enderror w-full appearance-none rounded-lg border-gray-300 border-red-500 px-3 py-2 pr-8 text-sm leading-tight text-gray-700 shadow-md hover:border-gray-500 focus:outline-none sm:px-5 sm:text-base"
                                >
                                    <option
                                        value="1"
                                        {{ old("year", $user->year) == 1 ? "selected" : "" }}
                                    >
                                        ปี 1
                                    </option>
                                    <option
                                        value="2"
                                        {{ old("year", $user->year) == 2 ? "selected" : "" }}
                                    >
                                        ปี 2
                                    </option>
                                    <option
                                        value="3"
                                        {{ old("year", $user->year) == 3 ? "selected" : "" }}
                                    >
                                        ปี 3
                                    </option>
                                    <option
                                        value="4"
                                        {{ old("year", $user->year) == 4 ? "selected" : "" }}
                                    >
                                        ปี 4
                                    </option>
                                </select>
                                @error("year")
                                    <span class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mt-5 flex flex-col">
                            <label for="email" class="mb-2 font-bold">
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old("email", $user->email) }}"
                                class="@error("email") @enderror w-full appearance-none rounded-lg border-gray-300 border-red-500 px-3 py-2 text-sm leading-tight text-gray-700 shadow focus:outline-none sm:px-5 sm:text-base"
                            />
                            @error("email")
                                <span class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mt-5 flex flex-col">
                            <label for="phone" class="mb-2 font-bold">
                                Phone
                            </label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old("phone", $user->phone) }}"
                                class="@error("phone") @enderror w-full appearance-none rounded-lg border-gray-300 border-red-500 px-3 py-2 text-sm leading-tight text-gray-700 shadow focus:outline-none sm:px-5 sm:text-base"
                            />
                            @error("phone")
                                <span class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="mt-6 flex justify-center sm:mt-10">
                            <button
                                type="submit"
                                class="w-full rounded-lg border-blue-500 bg-blue-400 px-4 py-2 text-sm text-white transition-colors hover:bg-blue-500 sm:px-5 sm:text-base"
                            >
                                แก้ไข
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </section>
    </div>
@endsection

@section("scripts")
    <script>
        function uploadProfileImage(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                if (file.size > 2048 * 1024) {
                    alert(
                        'ขนาดไฟล์ใหญ่เกินไป กรุณาเลือกไฟล์ที่มีขนาดไม่เกิน 2MB',
                    );
                    return;
                }

                const validTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/jpg',
                    'image/gif',
                ];
                if (!validTypes.includes(file.type)) {
                    alert('กรุณาเลือกไฟล์รูปภาพ (JPEG, PNG, JPG, GIF)');
                    return;
                }

                document
                    .getElementById('uploadLoading')
                    .classList.remove('hidden');

                const formData = new FormData();
                formData.append('profile_image', file);
                formData.append(
                    '_token',
                    document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                );

                fetch('{{ route("profile.image.update") }}', {
                    method: 'POST',
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        document
                            .getElementById('uploadLoading')
                            .classList.add('hidden');

                        if (data.success) {
                            document.getElementById('profileImage').src =
                                data.image_url;

                            showSuccessMessage(data.message);
                        } else {
                            alert(
                                'เกิดข้อผิดพลาด: ' +
                                    (data.message || 'ไม่สามารถอัพโหลดรูปได้'),
                            );
                        }
                    })
                    .catch((error) => {
                        document
                            .getElementById('uploadLoading')
                            .classList.add('hidden');
                        console.error('Error:', error);
                        alert('เกิดข้อผิดพลาดในการอัพโหลด');
                    });
            }
        }

        function showSuccessMessage(message) {
            const successDiv = document.createElement('div');
            successDiv.className =
                'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50';
            successDiv.innerHTML = message;

            document.body.appendChild(successDiv);

            setTimeout(() => {
                if (successDiv.parentNode) {
                    successDiv.parentNode.removeChild(successDiv);
                }
            }, 3000);
        }

        if (!document.querySelector('meta[name="csrf-token"]')) {
            const meta = document.createElement('meta');
            meta.name = 'csrf-token';
            meta.content = '{{ csrf_token() }}';
            document.getElementsByTagName('head')[0].appendChild(meta);
        }
    </script>
@endsection
