<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Owner KKU</title>
        @vite("resources/css/app.css")
    </head>
    <body>
        <div class="mx-auto my-6 flex max-w-7xl flex-col items-center">
            <h1 class="text-5xl">Data of User</h1>
            <div class="my-6">
                <table>
                    <thead
                        class="border-b text-nowrap [&_th]:p-4 [&_th]:font-light"
                    >
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
                    </thead>
                    <tbody
                        class="[&_td]:p-4 [&_tr]:border-b [&_tr]:text-nowrap"
                    >
                        @foreach ($user as $us)
                            <tr
                                class="cursor-pointer transition-colors hover:bg-zinc-800 hover:text-white"
                            >
                                <td>{{ $us->id }}</td>
                                <td>{{ $us->firstname }}</td>
                                <td>{{ $us->lastname }}</td>
                                <td>{{ $us->email }}</td>
                                <td>{{ $us->phone }}</td>
                                <td>{{ $us->faculty }}</td>
                                <td>{{ $us->major }}</td>
                                <td>{{ $us->year }}</td>
                                <td>{{ $us->role }}</td>
                                <td>
                                    <div class="w-fit">
                                        <img
                                            src="{{ $us->profile_image ? asset($us->profile_image) : asset("images/tako.png") }}"
                                            alt="profile"
                                            class="w-full rounded-full"
                                        />
                                    </div>
                                </td>
                                <td>{{ $us->created_at }}</td>
                                <td>{{ $us->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
