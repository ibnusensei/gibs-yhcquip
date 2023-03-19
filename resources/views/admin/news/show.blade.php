<x-app-layout>

    @push('styles')
        <style>
            .container p {
                margin-bottom: 30px;
            }

            .container ul li {
                list-style-type: square;
                list-style-size: 150%;
                color: blue;
                list-style-size: 30px
            }
        </style>
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
                <div class="author py-1 px-2 mb-5 d-inline text-center"
                    style="background-color: rgba(75, 75, 255, 0.338); border-radius:6px; color:rgb(11, 0, 132)">
                    {{ $news->newsCategory->name }}
                </div>
                <h1 style="font-size:40px; font-weight: bold; " class="mb-6 mt-3">{{ $news->title }}</h1>
                <img src="{{ $news->getFirstMediaUrl('news') }}" alt="" class="rounded-3 mb-5"
                    style="max-width:700px">
                {!! $news->content !!}

                <div class="publis mx-auto my-4 text-center fs-5">
                    <small class="opacity-50">Published
                        {{ \Carbon\Carbon::parse($news->published_at)->format('d M Y - h:i A') }}</small>
                    <small class="d-block">By {{ $news->user->name }}</small>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    @include('scripts.delete')
</x-app-layout>
