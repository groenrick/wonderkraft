@extends('app.layouts.app')

@section('title', 'Create page')

@section('main')
    <main class="ml-64 pt-16 min-h-screen">
        <div class="p-8">
            <form
                action="{{ $isNewPage ? route('app.pages.store') : route('app.pages.update', $page) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @if(!$isNewPage)
                    @method('PUT')
                @endif

                @include('app.pages.partials.header')
                @include('app.pages.partials.validation-errors')

                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-2 space-y-6">
                        @include('app.pages.partials.main-column')
                    </div>
                    <div class="space-y-6">
                        @include('app.pages.partials.settings-sidebar')
                    </div>
                </div>
            </form>
        </div>
    </main>

    @include('app.pages.partials.block-templates')
    @include('app.pages.partials.block-scripts')
@endsection
