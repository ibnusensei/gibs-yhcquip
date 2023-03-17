<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Leader</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.leader.create') }}">
                        <i class="bi-plus me-1"></i> Create New Leader
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data Leader</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                ($nomor = 1)
                            @endphp
                            @forelse ($leaders as $leader)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $leader->name }}</td>
                                    <td>{{ $leader->position }}</td>
                                    <td>
                                        <a href="{{ route('admin.leader.edit', $leader) }}" class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>
                                        <a href="{{ route('admin.leader.show', $leader) }}" class="btn btn-sm btn-outline-danger">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center fw-bold fs-4">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>