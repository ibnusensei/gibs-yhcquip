<x-app-layout>
    @push('styles')
    @endpush

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Detail news</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.news.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="content fs-4 lh-2">
            <div class="container">
                <h1 style="font-size:40px; font-weight: bold; " class="mb-6">{{ $news->title }}</h1>
                <img src="{{ $news->getFirstMediaUrl('news') }}" alt="" class="rounded-3 mb-5" style="max-width:700px">
                {!! $news->content !!}
            </div>
        </div>
    </div>
    <!-- End Content -->

    @include('scripts.delete')
</x-app-layout>
