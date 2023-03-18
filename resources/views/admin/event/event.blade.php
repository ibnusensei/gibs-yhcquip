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

                <form action="/admin/event" class="d-flex">
                    {{-- <div class="input-group p-3">
                        <input type="text" class="form-control width" name="search" placeholder="Search. . ."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div> --}}
                    <div class="input-group justify-content-end">
                        <div class="form-outline">
                            <input type="search" class="form-control" placeholder="Search. . ." name="search"
                                value="{{ request('search') }}">
                            {{-- <label class="form-label" for="form1">Search</label> --}}
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{-- <i class="fas fa-search"></i> --}}Search
                        </button>
                    </div>
                </form>

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
                            @forelse ($events as $event)
                                <tr>
                                    <td scope="row">{{ $event->title }}</td>
                                    <td>{{ Str::limit($event->description, 50, '...') }}</td>
                                    <td>
                                        <img src=" {{ $event->getFirstMediaUrl('images') }}"
                                            style="max-width: 100px; height: auto">
                                    </td>
                                    <td>
                                        @if ($event->is_published)
                                            <i class="bi bi-check-circle fs-2 text-success"></i>
                                        @else
                                            <i class="bi bi-x-circle fs-2 text-danger "></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.event.edit', $event) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.event.show', $event) }}">Show</a>
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
                    {{ $events->links('vendor/pagination/bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @include('scripts.delete')
</x-app-layout>
