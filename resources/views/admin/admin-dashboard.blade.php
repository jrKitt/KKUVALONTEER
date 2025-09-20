@extends('components/layouts/layoutAdmin')

@section('title')
    admin dashboard | KKU VOLUNTEER
@endsection

@section('layout-content')
    <div class="min-h-screen bg-gray-50">
        <header class="max-w-6xl mx-auto">
            <div class="flex gap-5 p-4 h-fit max-md:flex-col">
                <div class="border w-full rounded h-50">
                    graph1
                </div>
                <div class="border w-full h-50 rounded">
                    graph2
                </div>
            </div>
            <hr class="my-6 text-gray-400">
        </header>
        <main>
            admin dashboard
        </main>
        </section>
    </div>
@endsection
