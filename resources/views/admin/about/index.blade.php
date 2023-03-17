<x-app-layout>
    <div class="content container-fluid">
     <div class="page-header">
         <div class="row aligns-items-center">
             <div class="col">
                 <h1 class="page-header-title">About</h1>
             </div>
             <div class="col-auto">
                 <a href="{{ route('admin.about.create') }}" class="btn btn-sm btn-primary">
                     <i class="bi-plus"></i>
                     Create New About
                 </a>
             </div>
         </div>
     </div>
     <div class="card">
         <div class="card-body">
             <h4 class="card-title">Data About</h4>
             <div class="table-responsive">
             <table class="table">
                 <thead class="thead-light">
                     <tr>
                        <th>No</th>
                         <th>Title</th>
                         <th>Description</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 @php($nomor = 1)
                 <tbody class="table-align-middle">
                     @forelse ($abouts as $about)
                         <tr>
                            <td>{{ $nomor++ }}</td>
                             <td scope="row">{{ $about->title }}</td>
                             <td>{{ Str::limit($about->description, 50, '...') }}</td>
                             <td>
                                <a href="{{ route('admin.about.edit', $about) }}" class="btn btn-outline-warning btn-sm ">
                                     Edit
                                </a>
                                <a href="{{ route('admin.about.show', $about) }}" class="btn btn-outline-info btn-sm">
                                    Detail
                                </a>
                               
                                <form action="{{ route('admin.about.destroy', $about) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-outline-danger btn-sm delete-btn">
                                          Delete
                                    </button>
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