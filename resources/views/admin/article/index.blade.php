<x-app-layout class="bg-secondary-subtle">

    {{--  @push('stylesDataTables')
        <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    @endpush  --}}

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div>
            <div class="row align-items-center">
                <div class="col ms-1 mb-4">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Article</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Article
                            </li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title mb-5 ms-1">Article Page</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.article.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table py-3">
                        <thead>
                            <tr class="table-secondary">
                                <th class="fw-bolder">Title</th>
                                <th class="fw-bolder">Image</th>
                                <th class="fw-bolder">Description</th>
                                <th class="fw-bolder">Author</th>
                                <th class="fw-bolder">Category</th>
                                <th class="fw-bolder">Status</th>
                                <th class="fw-bolder">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($articles as $article)
                                <tr>
                                    <td scope="row">{{ Str::limit($article->title, 15, '...') }}</td>
                                    <td>
                                        <div class="avatar avatar-xl">
                                            <img class="avatar-img" src="{{ $article->getFirstMediaUrl('image') }} "
                                                alt="Image Description">
                                        </div>
                                    </td>
                                    <td>{!! Str::limit(strip_tags($article->description), 30) !!}
                                    </td>
                                    <td>{{ $article->author }}</td>
                                    <td>{{ ucfirst($article->category_article?->name) }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault">
                                            <label class="form-check-label"
                                                for="flexSwitchCheckDefault">Published</label>
                                        </div>
                                    </td>
                                    <td class="flex flex-row">
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.article.edit', $article) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.article.show', $article) }}">Show</a>
                                        <form action="{{ route('admin.article.destroy', $article) }}" method="POST"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Data</td>
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
