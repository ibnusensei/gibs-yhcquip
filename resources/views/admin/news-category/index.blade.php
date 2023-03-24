<x-app-layout>
    @push('styles')
    @endpush

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">News Categories</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"">
                        <i class="bi-plus me-1"></i> Create
                    </button>
                </div>
                @include('admin.news-category.modal-create')
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card mb-3">
            <div class="card-body">
               
                <h4 class="card-title">Data News Category</h4>
                <div class="table-responsive">
                    <table class="table table-thead-bordered">
                        <thead class="thead-light">
                            <tr class="py-2">
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="table-align-middle">
                            @forelse ($newsCategory as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.news-category.edit', $item->id) }}">Edit</a>

                                            <form action="{{ route('admin.news-category.destroy', $item->id) }}"
                                                method="POST" class="d-inline">
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


</x-app-layout>
