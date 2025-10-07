@extends("components/layouts/layout-app")

@section("content")
    <aside class="fixed top-10 left-10">
        <div class="drawer">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <!-- Page content here -->
                <label
                    for="my-drawer"
                    class="drawer-button flex cursor-pointer items-center justify-center rounded-full p-2 shadow-lg hover:bg-zinc-50 active:scale-90"
                >
                    <i class="fa-solid fa-bars"></i>
                </label>
            </div>
            <div class="drawer-side">
                <label
                    for="my-drawer"
                    aria-label="close sidebar"
                    class="drawer-overlay"
                ></label>
                <ul
                    class="menu bg-base-200 text-base-content min-h-full w-80 p-4"
                >
                    <div class="flex items-center justify-center">
                        <img
                            src="{{ asset("images/app_icon_2.png") }}"
                            alt=""
                        />
                    </div>
                    <hr class="mb-4">
                    <!-- Sidebar content here -->
                    <li><a href="#">ตารางข้อมูล</a></li>
                    <li><a href="#">กิจกรรม</a></li>
                    <li><a href="#">รายงาน</a></li>
                </ul>
            </div>
        </div>
    </aside>
    <div class="">
        @yield("ownerContent")
    </div>
@endsection
