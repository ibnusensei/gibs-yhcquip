<x-app-layout>

    {{--  Content  --}}
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Article Category</h1>
                </div>

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.article.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
            </div>
        </div>
        
    </div>

</x-app-layout>
