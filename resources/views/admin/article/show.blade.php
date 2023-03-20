<x-app-layout>

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div>
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="ms-3 page-header-title">Article Page</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.article.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card shadow my-5" style="width: 20rem;">
            <img src="{{ $article->getFirstMediaUrl('image') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h2 class="card-title text-primary">{{ $article->title }}</h2>
                <p class="card-text text-dark py-2">{{ $article->description }}</p>
                <p class="card-text">
                    <i class="bi bi-pencil-square nav-icon pe-1"></i> {{ $article->author }}
                </p>
            </div>
        </div>
        
    </div>

</x-app-layout>


{{--  <x-app-layout>

    <div class="content container-fluid py-1">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title mt-2">Article View</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.article.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>

        <div class="card shadow my-5" style="width: 20rem;">
            <img src="{{ $article->getFirstMediaUrl('image') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h2 class="card-title text-primary">{{ $article->title }}</h2>
                <p class="card-text text-dark py-2">{{ $article->description }}</p>
                <p class="card-text">
                    <i class="bi bi-pencil-square nav-icon pe-1"></i> {{ $article->author }}
                </p>
            </div>
        </div>
    </div>

</x-app-layout>  --}}
