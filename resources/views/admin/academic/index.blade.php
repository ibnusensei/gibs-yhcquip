<x-app-layout>
    @push('styles')
        
    @endpush
    
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Academic</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.academic.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
                <!-- End Col -->

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                    <form action = /admin/academic>
                        <input type="search" id="inputPassword6" name = "search" class="form-control" placeholder="Search...">
                    </form>
                    </div>                    
                </div>
                
                

                

            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Academic</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($academics as $academic)
                                <tr>
                                    <td scope="row">{{ $academic->name }}</td>
                                    <td>{{ Str::limit($academic->description, 100, '...') }}</td>
                                    
                                    <td>
                                        <img src=" {{ $academic->getFirstMediaUrl('image') }}"
                                            style="max-width: 100px; height: auto">
                                    </td>

                                    <td>
                                        @if ($academic->is_published)
                                            <i class="bi bi-check-circle fs-2 text-success"></i>    
                                        @else
                                            <i class="bi bi-x-circle-fill"></i>
                                        @endif
                                    </td>

                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.academic.edit', $academic) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.academic.show', $academic) }}">Show</a>
                                        <form action="{{ route('admin.academic.destroy', $academic) }}" method="POST" class="d-inline">
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
    
    @include('scripts.delete')
</x-app-layout>
