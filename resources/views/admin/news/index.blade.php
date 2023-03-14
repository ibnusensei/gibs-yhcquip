<x-app-layout>
    @push('styles')
    @endpush

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">News</h1>
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

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data News</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>title</th>
                                <th>category</th>
                                <th>author</th>
                                <th>Publis</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-align-middle">
                            @forelse ($news as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input published-checkbox" type="checkbox"
                                                name="publish" role="switch" id="publish"
                                                onclick="publisNews({{ $item->id }})"
                                                {{ $item->publish == true ? 'checked' : '' }}>
                                        </div>
                                    </td>

                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.news.edit', $item->id) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.news.show', $item->slug) }}">Show</a>
                                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                        </tbody>
                    @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    @include('scripts.delete')

    @push('scripts')
        <script>
            function publisNews(id) {
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.publis.news') }}",
                    data: {
                        '_token': `{{ csrf_token() }}`,
                        'id': id,
                    },
                    
                })
            }
        </script>
    @endpush
</x-app-layout>
