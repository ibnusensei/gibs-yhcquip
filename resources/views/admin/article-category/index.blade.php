<x-app-layout>

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
          <div class="row align-items-center">
                <div class="col ms-1 mb-4">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.article.index') }}">Article</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Article Category
                            </li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Article Category - New Page</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.article-category.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card shadow-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table py-3">
                        <thead>
                            <tr class="table-secondary">
                                <th>id</th>
                                <th>name</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($categories as $category)
                                <tr>
                                    <td width="50">{{  $category->id }}</td>
                                    <td>{{ ucFirst($category->name) }}</td>
                                    {{--  <td>
                                        <div class="avatar avatar-xl">
                                            <img class="avatar-img" src="{{ $article->getFirstMediaUrl('image') }} "
                                                alt="Image Description">
                                        </div>
                                    </td>  --}}
                                    {{--  <td>{!! Str::limit(strip_tags($article->description), 30) !!}
                                    </td>  --}}
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    @endpush

</x-app-layout>
