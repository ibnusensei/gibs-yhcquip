<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Gallery</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.gallery.create') }}">
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
                <h4 class="card-title">Data Gallery</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galleries as $gallery)
                        <tr>
                            <td scope="row">{{ $gallery->name }}</td>
                            <td>{{ $gallery->description }}</td>
                            <td></td>
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
    <!-- End Content -->
</x-app-layout>
