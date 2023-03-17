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
                    <a class="btn btn-soft-primary" href="{{ route('admin.leader.create') }}">
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
                    <!-- Table -->
   <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Position</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody class="table-align-middle">
      @php
          ($nomor = 1)
      @endphp
      @forelse ($leaders as $leader)
      <tr>
        <th scope="row">{{ $nomor++ }}</th>
        <td>{{ $leader->name }}</td>
        <td>{{ $leader->position }}</td>
        <td>
         <div class="avatar avatar-xl">
            <img class="avatar-img" src="{{ $leader->getFirstMediaUrl('image') }} " alt="Image Description">
          </div>
        </td>
        <td style="display:flex; flex-direction: row;">
         <a href="{{ route('admin.leader.edit', $leader) }}" class="btn btn-sm btn-soft-warning">
          <i class="bi bi-pencil"></i> Edit</a>
         <a href="{{ route('admin.leader.show', $leader) }}" class="btn btn-sm btn-soft-info" style="margin-left:10px;">
          <i class="bi bi-eye"></i> Detail</a>
         <form action="{{ route('admin.leader.destroy', $leader) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-sm btn-soft-danger delete-btn" style="margin-left:10px;">
              <i class="bi bi-trash3"></i> Delete</button>
         </form>
        </td>
      </tr>
          
      @empty
      <tr>
         <td colspan="3" class="text-center m-auto fw-bold">No Data</td>
      </tr>
          
      @endforelse
    </tbody>
  </table>
  <!-- End Table -->
                </div>
            </div>
        </div>
    </div>
    @include('scripts.delete')
</x-app-layout>