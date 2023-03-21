<x-app-layout>
   <!-- Content -->
  <div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Campus Tour</h1>
            </div>
            <!-- End Col -->

            <div class="col-auto">
                <a class="btn btn-soft-primary" href="{{ route('admin.campustour.create') }}">
                    <i class="bi-plus me-1"></i> Create New Campus Tour
                </a>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <div class="card">
      <div class="card-body">
        <h3 class="mb-3 card-title">Data Campus Tour</h3>
        <div class="table-responsive">
          <table class="table table-align-middle">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                  ($nomor = 1)
              @endphp
              @forelse ($campustours as $campustour)
                  <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $campustour->title }}</td>
                    <td>{{ Str::limit($campustour->description, 20, '...')  }}</td>
                    <td>
                      <span class="avatar avatar-xl avatar-4x3">
                        <img class="avatar-img" src="{{ $campustour->getFirstMediaUrl('image', 'thumbs') }}" alt="Image Description">
                      </span>
                    </td>
                    <td style="display:flex; flex-direction: row;">
                      <a href="{{ route('admin.campustour.edit', $campustour) }}" class="btn btn-sm btn-soft-warning">
                        <i class="bi bi-pencil"></i> Edit</a>
                      <a href="{{ route('admin.campustour.show', $campustour) }}" class="btn btn-sm btn-soft-info ms-3">
                        <i class="bi bi-eye"></i> Detail</a>
                      <form action="{{ route('admin.campustour.destroy', $campustour) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-soft-danger ms-3 delete-btn">
                          <i class="bi bi-trash3"></i> Delete</button>
                      </form>
                    </td>
                  </tr>
              @empty
                  <tr>
                    <td colspan="3" class="text-center fw-bold">No Data</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @include('scripts.delete')
</x-app-layout>

