@extends("components/layouts/layoutAdmin")

@section("title")
    admin dashboard | KKU VOLUNTEER
@endsection

@section("layout-content")
    <div class="min-h-screen bg-gray-50">
        <header class="mx-auto max-w-6xl">
            <div class="flex h-fit gap-5 p-4 max-md:flex-col">
                <div class="h-50 w-full rounded border">graph1</div>
                <div class="h-50 w-full rounded border">graph2</div>
            </div>
            <hr class="my-6 text-gray-400" />
        </header>
        <main>admin dashboard</main>
    </div>
@endsection
