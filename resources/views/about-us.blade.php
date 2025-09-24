@extends("components/layouts/layoutAfterLogin")

@section("title")
    อื่นๆ/เกี่ยวกับเรา | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="mx-auto mb-8 max-w-1/2">
                <div
                    class="flex flex-col items-center justify-between gap-2 rounded-lg bg-red-600 p-6 text-white"
                >
                    <div class="text-xl max-sm:text-sm">สถานะปัจจุบัน</div>
                    <div class="text-4xl font-bold max-sm:text-xl">40 ชั่วโมง</div>
                    <div class="text-xl max-sm:text-sm">เป้าหมาย 1200 ชั่วโมง</div>
                </div>
            </div>

            <hr class="my-8 text-gray-400" />

            <main>
                <section class="mb-8">
                    <div
                        class="my-6 flex items-center justify-between max-md:flex-col"
                    >
                        <h3
                            class="mb-6 text-3xl font-bold text-gray-900 md:text-4xl"
                        >
                            กิจกรรมทั้งหมด
                        </h3>
                        <div class="flex flex-col items-end gap-5">
                            <div>
                                <input
                                    type="search"
                                    class="w-70 rounded-xl border border-gray-400 px-2 py-1"
                                    placeholder="ค้นหา"
                                />
                            </div>
                            <div class="flex gap-5 max-md:flex-col">
                                <select
                                    name=""
                                    id=""
                                    class="w-50 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                >
                                    <option value="" disabled selected>
                                        # แท็ก
                                    </option>
                                    <option value="">a</option>
                                    <option value="">b</option>
                                    <option value="">c</option>
                                </select>
                                <select
                                    name=""
                                    id=""
                                    class="w-50 rounded-xl border border-gray-400 px-2 py-1 max-md:w-70"
                                >
                                    <option value="" disabled selected>
                                        คณะ / สาขา
                                    </option>
                                    <option value="">a</option>
                                    <option value="">b</option>
                                    <option value="">c</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <section class="flex flex-wrap justify-center gap-3">
                        <div
                            class="m-2 flex w-fit justify-between rounded-md p-4 shadow-md max-lg:flex-col"
                        >
                            <div
                                class="flex gap-5 max-lg:flex-col max-lg:items-center"
                            >
                                <section class="w-fit">
                                    <img
                                        src="{{ asset("/images/event_1.png") }}"
                                        alt="img"
                                        class="rounded-md"
                                    />
                                </section>
                                <section
                                    class="flex w-full flex-col justify-around gap-1"
                                >
                                    <div
                                        class="flex w-full justify-between max-sm:flex-col-reverse"
                                    >
                                        <h1
                                            class="text-2xl font-bold max-md:text-lg"
                                        >
                                            ประกอบคอมให้ i have gpu
                                        </h1>
                                        <div
                                            class="text-2xl font-medium text-[#ffc107] max-md:text-lg"
                                        >
                                            กำลังดำเนินการ
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <div
                                            class="flex items-center rounded-full border bg-[#a73b24] px-4 py-1 text-sm text-white"
                                        >
                                            #แพทศ์
                                        </div>
                                        <div
                                            class="flex items-center rounded-full border bg-gray-400 px-4 py-1 text-sm text-white"
                                        >
                                            #ลงมือ
                                        </div>
                                    </div>
                                    <div
                                        class="flex gap-3 text-sm max-sm:flex-col"
                                    >
                                        <div class="flex items-center">
                                            <div class="w-6">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 640 640"
                                                >
                                                    <path
                                                        d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>นาหลังบ้าน นายเอกรินทร์</div>
                                        </div>

                                        <div class="flex items-center">
                                            <div class="w-6">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 640 640"
                                                >
                                                    <path
                                                        d="M192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 128C512 92.7 483.3 64 448 64L192 64zM224 128L416 128C433.7 128 448 142.3 448 160L448 192C448 209.7 433.7 224 416 224L224 224C206.3 224 192 209.7 192 192L192 160C192 142.3 206.3 128 224 128zM240 296C240 309.3 229.3 320 216 320C202.7 320 192 309.3 192 296C192 282.7 202.7 272 216 272C229.3 272 240 282.7 240 296zM320 320C306.7 320 296 309.3 296 296C296 282.7 306.7 272 320 272C333.3 272 344 282.7 344 296C344 309.3 333.3 320 320 320zM448 296C448 309.3 437.3 320 424 320C6.7 320 400 309.3 400 296C400 282.7 410.7 272 424 272C437.3 272 448 282.7 448 296zM216 416C202.7 416 192 405.3 192 392C192 378.7 202.7 368 216 368C229.3 368 240 378.7 240 392C240 405.3 229.3 416 216 416zM344 392C344 405.3 333.3 416 320 416C306.7 416 296 405.3 296 392C296 378.7 306.7 368 320 368C333.3 368 344 378.7 344 392zM424 416C410.7 416 400 405.3 400 392C400 378.7 410.7 368 424 368C437.3 368 448 378.7 448 392C448 405.3 437.3 416 424 416zM192 488C192 474.7 202.7 464 216 464L328 464C341.3 464 352 474.7 352 488C352 501.3 341.3 512 328 512L216 512C202.7 512 192 501.3 192 488zM424 464C437.3 464 448 474.7 448 488C448 501.3 437.3 512 424 512C410.7 512 400 501.3 400 488C400 474.7 410.7 464 424 464z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>04 กันยายน 2568</div>
                                        </div>

                                        <div class="flex items-center">
                                            <div class="w-6">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 640 640"
                                                >
                                                    <path
                                                        d="M320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320C64 178.6 178.6 64 320 64zM296 184L296 320C296 328 300 335.5 306.7 340L402.7 404C413.7 411.4 428.6 408.4 436 397.3C443.4 386.2 440.4 371.4 429.3 364L344 307.2L344 184C344 170.7 333.3 160 320 160C306.7 160 296 170.7 296 184z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>48 ชั่วโมง</div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex w-full items-end justify-between gap-2 max-lg:flex-col max-lg:items-stretch"
                                    >
                                        <div>
                                            <div
                                                class="flex justify-between font-medium text-gray-600"
                                            >
                                                <div>ดำเนินการไปแล้ว</div>
                                                <div>1 ชั่วโมง</div>
                                            </div>
                                            <progress
                                                value="33"
                                                max="100"
                                                class="progress h-5 w-100 rounded-full max-lg:w-full max-md:w-full"
                                            ></progress>
                                        </div>
                                        <div>
                                            <div
                                                class="flex items-center justify-center gap-2"
                                            >
                                                <div class="w-10">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 640 640"
                                                    >
                                                        <path
                                                            d="M160 128C142.3 128 128 142.3 128 160L128 480C128 497.7 142.3 512 160 512L480 512C497.7 512 512 497.7 512 480L512 160C512 142.3 497.7 128 480 128L160 128zM96 160C96 124.7 124.7 96 160 96L480 96C515.3 96 544 124.7 544 160L544 480C544 515.3 515.3 544 480 544L160 544C124.7 544 96 515.3 96 480L96 160zM224 288C232.8 288 240 295.2 240 304L240 432C240 440.8 232.8 448 224 448C215.2 448 208 440.8 208 432L208 304C208 295.2 215.2 288 224 288zM304 208C304 199.2 311.2 192 320 192C328.8 192 336 199.2 336 208L336 432C336 440.8 328.8 448 320 448C311.2 448 304 440.8 304 432L304 208zM416 352C424.8 352 432 359.2 432 368L432 432C432 440.8 424.8 448 416 448C407.2 448 400 440.8 400 432L400 368C400 359.2 407.2 352 416 352z"
                                                        />
                                                    </svg>
                                                </div>
                                                <a href="#">
                                                    <button
                                                        class="btn border bg-sky-400 text-nowrap text-white hover:bg-sky-600"
                                                    >
                                                        รายละเอียด
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <div
                            class="m-2 flex w-fit justify-between rounded-md p-4 shadow-md max-lg:flex-col"
                        >
                            <div
                                class="flex gap-5 max-lg:flex-col max-lg:items-center"
                            >
                                <section class="w-fit">
                                    <img
                                        src="{{ asset("/images/event_1.png") }}"
                                        alt="img"
                                        class="rounded-md"
                                    />
                                </section>
                                <section
                                    class="flex w-full flex-col justify-around gap-1"
                                >
                                    <div
                                        class="flex w-full justify-between max-sm:flex-col-reverse"
                                    >
                                        <h1
                                            class="text-2xl font-bold max-md:text-lg"
                                        >
                                            ประกอบคอมให้ i have gpu
                                        </h1>
                                        <div
                                            class="text-2xl font-medium text-[#ffc107] max-md:text-lg"
                                        >
                                            กำลังดำเนินการ
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <div
                                            class="flex items-center rounded-full border bg-[#a73b24] px-4 py-1 text-sm text-white"
                                        >
                                            #แพทศ์
                                        </div>
                                        <div
                                            class="flex items-center rounded-full border bg-gray-400 px-4 py-1 text-sm text-white"
                                        >
                                            #ลงมือ
                                        </div>
                                    </div>
                                    <div
                                        class="flex gap-3 text-sm max-sm:flex-col"
                                    >
                                        <div class="flex items-center">
                                            <div class="w-6">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 640 640"
                                                >
                                                    <path
                                                        d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>นาหลังบ้าน นายเอกรินทร์</div>
                                        </div>

                                        <div class="flex items-center">
                                            <div class="w-6">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 640 640"
                                                >
                                                    <path
                                                        d="M192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 128C512 92.7 483.3 64 448 64L192 64zM224 128L416 128C433.7 128 448 142.3 448 160L448 192C448 209.7 433.7 224 416 224L224 224C206.3 224 192 209.7 192 192L192 160C192 142.3 206.3 128 224 128zM240 296C240 309.3 229.3 320 216 320C202.7 320 192 309.3 192 296C192 282.7 202.7 272 216 272C229.3 272 240 282.7 240 296zM320 320C306.7 320 296 309.3 296 296C296 282.7 306.7 272 320 272C333.3 272 344 282.7 344 296C344 309.3 333.3 320 320 320zM448 296C448 309.3 437.3 320 424 320C6.7 320 400 309.3 400 296C400 282.7 410.7 272 424 272C437.3 272 448 282.7 448 296zM216 416C202.7 416 192 405.3 192 392C192 378.7 202.7 368 216 368C229.3 368 240 378.7 240 392C240 405.3 229.3 416 216 416zM344 392C344 405.3 333.3 416 320 416C306.7 416 296 405.3 296 392C296 378.7 306.7 368 320 368C333.3 368 344 378.7 344 392zM424 416C410.7 416 400 405.3 400 392C400 378.7 410.7 368 424 368C437.3 368 448 378.7 448 392C448 405.3 437.3 416 424 416zM192 488C192 474.7 202.7 464 216 464L328 464C341.3 464 352 474.7 352 488C352 501.3 341.3 512 328 512L216 512C202.7 512 192 501.3 192 488zM424 464C437.3 464 448 474.7 448 488C448 501.3 437.3 512 424 512C410.7 512 400 501.3 400 488C400 474.7 410.7 464 424 464z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>04 กันยายน 2568</div>
                                        </div>

                                        <div class="flex items-center">
                                            <div class="w-6">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 640 640"
                                                >
                                                    <path
                                                        d="M320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320C64 178.6 178.6 64 320 64zM296 184L296 320C296 328 300 335.5 306.7 340L402.7 404C413.7 411.4 428.6 408.4 436 397.3C443.4 386.2 440.4 371.4 429.3 364L344 307.2L344 184C344 170.7 333.3 160 320 160C306.7 160 296 170.7 296 184z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>48 ชั่วโมง</div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex w-full items-end justify-between gap-2 max-lg:flex-col max-lg:items-stretch"
                                    >
                                        <div>
                                            <div
                                                class="flex justify-between font-medium text-gray-600"
                                            >
                                                <div>ดำเนินการไปแล้ว</div>
                                                <div>1 ชั่วโมง</div>
                                            </div>
                                            <progress
                                                value="33"
                                                max="100"
                                                class="progress h-5 w-100 rounded-full max-lg:w-full max-md:w-full"
                                            ></progress>
                                        </div>
                                        <div>
                                            <div
                                                class="flex items-center justify-center gap-2"
                                            >
                                                <div class="w-10">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 640 640"
                                                    >
                                                        <path
                                                            d="M160 128C142.3 128 128 142.3 128 160L128 480C128 497.7 142.3 512 160 512L480 512C497.7 512 512 497.7 512 480L512 160C512 142.3 497.7 128 480 128L160 128zM96 160C96 124.7 124.7 96 160 96L480 96C515.3 96 544 124.7 544 160L544 480C544 515.3 515.3 544 480 544L160 544C124.7 544 96 515.3 96 480L96 160zM224 288C232.8 288 240 295.2 240 304L240 432C240 440.8 232.8 448 224 448C215.2 448 208 440.8 208 432L208 304C208 295.2 215.2 288 224 288zM304 208C304 199.2 311.2 192 320 192C328.8 192 336 199.2 336 208L336 432C336 440.8 328.8 448 320 448C311.2 448 304 440.8 304 432L304 208zM416 352C424.8 352 432 359.2 432 368L432 432C432 440.8 424.8 448 416 448C407.2 448 400 440.8 400 432L400 368C400 359.2 407.2 352 416 352z"
                                                        />
                                                    </svg>
                                                </div>
                                                <a href="#">
                                                    <button
                                                        class="btn border bg-sky-400 text-nowrap text-white hover:bg-sky-600"
                                                    >
                                                        รายละเอียด
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                </section>
            </main>
        </section>
    </div>
@endsection
