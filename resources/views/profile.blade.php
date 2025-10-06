@extends("components/layouts/layoutAfterLogin")

@section("title")
    โปรไฟล์ | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Profile Section -->
            <main>
                <div class="mt-20 flex justify-center items-end">
                    <img
                        src="{{ asset("images/profileTemp.png") }}"
                        alt="profile"
                        class="h-[200px] w-[200px] rounded-full"
                    />
                    <div class="relative right-10 bottom-5 border ">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <h1 class="text-xl font-bold">นายโยโกะ คามิโจ</h1>
                    <p class="text-sm">yoko.ka@kkumail.com</p>
                    <p class="text-gray-400">
                        วิทยาลัยการคอมพิวเตอร์ / วิทยาลัยการคอมพิวเตอร์
                    </p>
                </div>

                <hr class="my-2 border-gray-300" />

                <!-- Form Section -->
                <div class="mt-20 flex justify-center">
                    <form action="" class="w-full max-w-lg">
                        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
                            <!-- FirstName -->
                            <div class="flex flex-col">
                                <label for="firstname" class="mb-2 font-bold">
                                    Firstname
                                </label>
                                <input
                                    type="text"
                                    id="firstname"
                                    name="firstname"
                                    placeholder="นายโยโกะ"
                                    class="w-[250px] appearance-none rounded-lg border-gray-300 px-5 py-2 leading-tight text-gray-400 shadow-md focus:outline-none"
                                />
                            </div>

                            <!-- LastName -->
                            <div class="flex flex-col">
                                <label for="lastname" class="mb-2 font-bold">
                                    Lastname
                                </label>
                                <input
                                    type="text"
                                    id="lastname"
                                    name="lastname"
                                    placeholder="คามิโจ"
                                    class="w-[250px] appearance-none rounded-lg border-gray-300 px-5 py-2 leading-tight text-gray-400 shadow-md focus:outline-none"
                                />
                            </div>
                        </div>

                        <!-- Faculty -->
                        <div class="mt-5 flex flex-col">
                            <label for="faculty" class="mb-2 font-bold">
                                Faculty
                            </label>
                            <select
                                id="faculty"
                                name="faculty"
                                class="w-full appearance-none rounded-lg border-gray-300 px-5 py-2 pr-8 leading-tight text-gray-400 shadow-md hover:border-gray-500 focus:outline-none"
                            >
                                <option value="">วิทยาลัยการคอมพิวเตอร์</option>
                                <option value="">วิทยาลัยการคอมพิวเตอร์</option>
                            </select>
                        </div>

                        <div
                            class="mt-5 grid grid-cols-1 gap-10 md:grid-cols-2"
                        >
                            <!-- Major -->
                            <div class="flex flex-col">
                                <label for="major" class="mb-2 font-bold">
                                    Faculty (สาขา)
                                </label>
                                <select
                                    id="major"
                                    name="major"
                                    class="w-full appearance-none rounded-lg border-gray-300 px-5 py-2 pr-8 leading-tight text-gray-400 shadow-md hover:border-gray-500 focus:outline-none"
                                >
                                    <option value="">
                                        วิทยาการคอมพิวเตอร์
                                    </option>
                                    <option value="">
                                        วิทยาการคอมพิวเตอร์
                                    </option>
                                </select>
                            </div>

                            <!-- Year -->
                            <div class="flex flex-col">
                                <label for="year" class="mb-2 font-bold">
                                    Year
                                </label>
                                <select
                                    id="year"
                                    name="year"
                                    class="w-full appearance-none rounded-lg border-gray-300 px-5 py-2 pr-8 leading-tight text-gray-400 shadow-md hover:border-gray-500 focus:outline-none"
                                >
                                    <option value="1">ปี 1</option>
                                    <option value="2">ปี 2</option>
                                    <option value="3">ปี 3</option>
                                    <option value="4">ปี 4</option>
                                    <option value="5">ปี 5</option>
                                    <option value="6">ปี 6</option>
                                    <option value="7">ปี 7</option>
                                    <option value="8">ปี 8</option>
                                </select>
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
                                placeholder="yoko.ka@kkumail.com"
                                class="w-full appearance-none rounded-lg border-gray-300 px-5 py-2 leading-tight text-gray-400 shadow focus:outline-none"
                            />
                        </div>

                        <div class="mt-10 flex justify-center">
                            <button
                                type="submit"
                                class="w-full rounded-lg border-blue-500 bg-blue-400 px-5 py-2 text-white"
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
