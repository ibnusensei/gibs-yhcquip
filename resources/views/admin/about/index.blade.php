<x-app-layout>
    <div class="content container-fluid">
     <div class="page-header">
         <div class="row aligns-items-center">
             <div class="col">
                 <h1 class="page-header-title">About</h1>
             </div>
             <div class="col-auto">  
                 <a href="{{ route('admin.about.create') }}" class="btn btn-sm btn-soft-primary">
                     <i class="bi bi-plus"></i>
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
                         <th>Image</th>
                         <th>Action</th>
                     </tr>
                 </thead>
                 @php($nomor = 1)
                 <tbody >
                     @forelse ($abouts as $about)
                         <tr >
                            <td>{{ $nomor++ }}</td>
                             <td scope="row">{{ $about->title }}</td>
                             <td style="white-space: pre-wrap; max-width: 200px">{{ Str::limit($about->description, 20, '...') }}</td>
                             <td>
                                <div class="avatar avatar-xl">
                                    <img class="avatar-img" src="{{ $about->getFirstMediaUrl('image') }} " alt="Image Description">
                                  </div>
                             </td>
                             <td style="display: flex;
                             flex-direction: row;">
                                <a href="{{ route('admin.about.edit', $about) }}" class="btn btn-soft-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                     Edit
                                </a>
                                <a href="{{ route('admin.about.show', $about) }}" class="btn btn-soft-info btn-sm" style="margin-left:20px">
                                   <i class="bi bi-eye"></i> Detail
                                </a>
                               
                                <form action="{{ route('admin.about.destroy', $about) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-soft-danger  btn-sm btn-block delete-btn" style="margin-left:20px;">
                                        <i class="bi bi-trash3"></i> Delete
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

 