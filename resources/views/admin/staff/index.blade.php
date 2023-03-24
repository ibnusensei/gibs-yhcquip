<x-app-layout>
<div class="content container-fluid">
    <!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
      <div class="col-sm mb-2 mb-sm-0">
        <h2 class="page-header-title">Staff</h2>
      </div>
  
      <div class="col-sm-auto">
        <a class="btn btn-soft-primary btn-sm" href="{{ route('admin.staff.create') }}">
          <i class="bi bi-plus"></i> Create New Staff
        </a>
      </div>
    </div>
  </div>
  <!-- End Page Header -->

  <!-- Starts Menu Search-->
  <form action="{{ route('admin.staff.index') }}">
    <div class="col-5 me-5">
      <div class="input-group input-group mb-3 me-3 float-right">
        <input type="text" class="form-control" placeholder="Search" name="search" aria-label="Search" value="{{ request('search') }}" aria-describedby="button-addon2">
        <button class="btn btn-secondary" type="sumbit" id="button-addon2"><i class="bi bi-search"></i> Search</button>
      </div>
    </div>
  </form>
  <!-- End Menu Search-->

  <!-- Stars Menu Pagination-->
  <div class="d-flex justify-content-end">
    {{ $staffs->links() }}
  </div>
  <!-- End Menu Pagination-->



 

  <!-- start body Header -->
  <div class="card">
    <div class="card-body">
        <h3 class="mb-3 card-title">Data Staff</h3>
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
    <tbody>
        @php
            ($nomor = 1)
        @endphp
        @forelse ($staffs as $staff)
        <tr>
          <th scope="row">{{ $nomor++ }}</th>
          <td>{{ $staff->name }}</td>
          <td>{{ $staff->position }}</td>
          <td>
            <div class="avatar avatar-xl">
                <img class="avatar-img" src="{{ $staff->getFirstMediaUrl('image', 'thumbs') }}" alt="Image Description">
              </div>
          </td>
          <td style="display: flex; flex-direction: row;" >
            <a href="{{ route('admin.staff.edit', $staff) }}" class="btn btn-sm btn-soft-warning">
              <i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('admin.staff.show', $staff) }}" class="btn btn-sm btn-soft-info" style="margin-left:10px;">
              <i class="bi bi-eye"></i> Detail</a>
            <form action="{{ route('admin.staff.destroy', $staff) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-soft-danger ms-3 delete-btn" >
                  <i class="bi bi-trash3"></i> Delete</button>
            </form>
          </td>
        </tr>
        
        @empty
        <tr>
          <td colspan="3" class="text-center fw-bold fs-5 ">No Data</td>
        </tr>
            
        @endforelse
  </table>
  <!-- End Table -->
    </div>
  </div>
  <!-- end body Header -->
  
</div>
@include('scripts.delete')
</x-app-layout>

