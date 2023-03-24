<x-app-layout>

    {{--  @push('stylesDataTables')
        <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    @endpush  --}}

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Article Page</h1>
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

        <div class="card shadow-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table py-3">
                        <thead>
                            <tr class="table-secondary">
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Author</th>
                                <th>Publish</th>
                                <th>Action</th>
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
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
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
                            {{--  <tr>
                                <td>No Data</td>
                                <td>No Data</td>
                                <td>No Data</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                                    </div>
                                </td>
                                <td>
                                    <a name="" id="" class="btn btn-success btn-sm"
                                        href="#">Edit</a>
                                    <a name="" id="" class="btn btn-primary btn-sm"
                                        href="#">Show</a>
                                    <form action="#" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>  --}}

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
