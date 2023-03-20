<x-app-layout>
    @push('styles')
    <style>
    .img-custom img {
        max-width: 300px;
        max-height: 200px;
        margin: 0;
        padding: 0;
    }
    </style>

        
    @endpush
    
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Career</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.career.create') }}">
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
                <h4 class="card-title">Careers Data</h4>
                <div class="table-responsive">
                    <table id="table_data" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Poster</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($careers as $career)
                                <tr>
                                    <td scope="row">{{ $career->title }}</td>
                                    <td style="white-space: pre-wrap; max-width: 200px">{!! Str::limit($career->description, 50) !!}</td>
                                    <td class="img-custom">@if ($career->getFirstMedia('image'))
                                        <img src="{{ $career->getFirstMediaUrl('image') }}" class="img-thumbnail" alt="">
                                    @endif</td>
                                    <td>
                                        <form class="publishForm" action="{{ route('admin.career.publish', $career->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input class="form-check-input publishSwitch" type="checkbox" name="is_published" {{ $career->is_published ? 'checked' : '' }}>
                                                <label class="form-check-label" for="publishSwitch">{{ $career->is_published ? 'Published' : 'Unpublished' }}</label>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.career.edit', $career) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.career.show', $career) }}">Show</a>
                                        <form action="{{ route('admin.career.destroy', $career) }}" method="POST" class="d-inline">
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

    @push('scripts')
    <script>
    $(document).ready(function () {
    $("#table_data").DataTable();
    });

    </script>

    <script>
    const publishForms = document.querySelectorAll('.publishForm');
    const publishSwitches = document.querySelectorAll('.publishSwitch');

    publishSwitches.forEach((publishSwitch, index) => {
        publishSwitch.addEventListener('change', () => {
            publishForms[index].submit();
        });
    });

    </script>
    @endpush
</x-app-layout>
