@extends("../components/layouts/layoutOwner")

@section("title")
    Owner Valonteer
@endsection

@php
    $itemSelect = request("type", "user");
@endphp

@section("ownerContent")
    <div class="mx-auto max-w-7xl py-4">
        <div class="fixed top-20 right-50 border">
            <select name="table" id="selectItem" onchange="filterTableData()">
                <option
                    value="user"
                    {{ $itemSelect == "user" ? "selected" : "" }}
                >
                    User
                </option>
                <option
                    value="activity"
                    {{ $itemSelect == "activity" ? "selected" : "" }}
                >
                    Activity
                </option>
            </select>
        </div>

        <div class="my-6 flex flex-col items-center">
            <h1 class="text-5xl">Data Table</h1>
            <div class="m-6 max-w-full overflow-auto text-wrap">
                <table>
                    <thead
                        class="border-b text-nowrap [&_th]:p-4 [&_th]:font-light"
                    >
                        @if ($itemSelect == "user")
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Faculty</th>
                            <th>Major</th>
                            <th>Year</th>
                            <th>Role</th>
                            <th>Profile</th>
                            <th>Create</th>
                            <th>Update</th>
                        @elseif ($itemSelect == "activity")
                            <th>Id</th>
                            <th>Name_th</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Accept Count</th>
                            <th>Create by</th>
                            <th>Image</th>
                            <th>Total Hour</th>
                            <th>Create Time</th>
                            <th>Update Time</th>
                        @endif
                        <th>Edit</th>
                    </thead>
                    <tbody
                        class="[&_td]:p-4 [&_tr]:border-b [&_tr]:text-nowrap"
                    >
                        @if ($itemSelect == "user")
                            @foreach ($user as $item)
                                <tr
                                    class="cursor-pointer transition-colors hover:bg-zinc-800 hover:text-white"
                                >
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->firstname }}</td>
                                    <td>{{ $item->lastname }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->faculty }}</td>
                                    <td>{{ $item->major }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        <div class="w-fit">
                                            <img
                                                src="{{ $item->profile_image ? asset($item->profile_image) : asset("images/tako.png") }}"
                                                alt="profile"
                                                class="w-full rounded-full"
                                            />
                                        </div>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>

                                    <td>
                                        <div
                                            class="rounded-md border px-4 py-2"
                                            onclick="edit.showModal()"
                                        >
                                            Edit
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @elseif ($itemSelect == "activity")
                            @foreach ($activity as $item)
                                <tr
                                    class="cursor-pointer transition-colors hover:bg-zinc-800 hover:text-white"
                                >
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name_th }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <div class="text-sm text-wrap">
                                            {{ Str::limit($item->description ?: "none") }}
                                        </div>
                                    </td>
                                    <td>{{ $item->location }}</td>
                                    <td>{{ $item->start_time }}</td>
                                    <td>{{ $item->end_time }}</td>
                                    <td>{{ $item->accept_count }}</td>
                                    <td>{{ $item->create_by }}</td>
                                    <td>
                                        <div class="w-fit">
                                            <img
                                                src="{{ $item->image_file_name ? asset($item->image_file_name) : asset("images/tako.png") }}"
                                                alt="profile"
                                                class="w-full rounded-full"
                                            />
                                        </div>
                                    </td>
                                    <td>{{ $item->total_hour }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    
                                    <td>
                                        <div
                                            class="rounded-md border px-4 py-2"
                                            onclick="edit.showModal()"
                                        >
                                            Edit
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="edit" class="modal">
        <div class="modal-box">
            <div class="card">
                <div class="grid grid-cols-2 [&_input]:border [&_input]:p-2 [&_input]:rounded-md [&_input]: gap-5">
                    <div class="col-span-2 flex justify-center">
                        <img src="{{asset('images/tako.png')}}" alt="img" class="w-1/2 rounded-full">
                    </div>
                    <input type="text" placeholder="ชื่อ">
                    <input type="text" placeholder="นามสกุล">
                    <input type="text" placeholder="อีเมล">
                    <input type="text" placeholder="เบอร์">
                    <input type="text" placeholder="คณะ">
                    <input type="text" placeholder="สาขา">
                    <input type="text" placeholder="ชั้นปี">
                    <input type="text" placeholder="บทบาท">
                </div>
            </div>

            <div class="modal-action">
                <button class="btn">
                    บันทึก
                </button>
                <form method="dialog">
                    <button class="btn">ปิด</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function filterTableData() {
            var items = document.getElementById('selectItem').value;
            window.location.href = '?type=' + items;
        }
    </script>
@endsection
