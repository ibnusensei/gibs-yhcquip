<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Event</h1>
                </div>

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.event.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
            </div>
        </div>
        <div class="card m-5">
            <div class="card-body">
                <h4 class="card-title">Data Event</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Publish</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($events as $event)
                                <tr>
                                    <td scope="row">{{ $event->title }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>image</td>
                                    <td>
                                        <h1><i class="bi bi-toggle2-off ms-3"></i></h1>
                                    </td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.event.edit', $event) }}">Edit</a>
                                        <form action="{{ route('admin.event.destroy', $event) }}" method="POST"
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
</x-app-layout>
