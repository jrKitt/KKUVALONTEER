@extends("components/layouts/layoutAdmin")

@section("title")
    admin event | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen flex flex-col w-screen items-center *:max-w-6xl ">
        <div class="w-full flex justify-between px-4 pt-8">
            <h1 class="text-black font-semibold tracking-wider  text-4xl">จัดการกิจกรรม</h1>
            <div class="flex">
                <button class="btn btn-success text-white shadow-none"><span class="text-3xl font-normal mb-1">+</span>เพิ่มกิจกรรม</button>
            </div>
        </div>
        <div class="w-full flex justify-end px-4 gap-2 pt-8">
            <input type="text" name="" id="" class="input" placeholder="ค้นหา">
            <select name="" id="" class="select" >
                <option selected>ทั้งหมด</option>
            </select>
        </div>
        <div class="w-full grid grid-cols-12">

        </div>
    </div>
@endsection
