<x-app-layout>
    @push('styles')
    @endpush

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">News</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.news.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Create New News</h4>
                <!-- seacrch-->
                <div class="mb-4 w-md-50">
                    <div class="input-group input-group-merge">
                        <input type="text" class="js-form-search form-control" id="search" placeholder="Search..."
                            data-hs-form-search-options='{
             "clearIcon": "#clearIcon2",
             "defaultIcon": "#defaultClearIconToggleEg"
           }'>
                        <button type="button" class="input-group-append input-group-text">
                            <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                            <i id="defaultClearIconToggleEg" class="bi-search" style="display: none;"></i>
                        </button>
                    </div>
                </div>
                <!-- End search -->
                <div class="table-responsive">
                    <table class="table table-thead-bordered">
                        <thead class="thead-light">
                            <tr class="py-2">
                                <th>No</th>
                                <th>title</th>
                                <th>category</th>
                                <th>author</th>
                                <th>Publis</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="allData table-align-middle">
                            @forelse ($news as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->newsCategory->name }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="switch form-check-input published-checkbox" type="checkbox"
                                                name="publish" role="switch" id="pub lish{{$item->id}}"
                                                onclick="publisNews({{ $item->id }})"
                                                {{ $item->is_publish == true ? 'checked' : '' }}>
                                        </div>
                                    </td>

                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.news.edit', $item->id) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.news.show', $item->slug) }}">Show</a>
                                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <p class="text-center">Not Data</p>
                            @endforelse
                        </tbody>
                        <tbody id="Content" class="searchData">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        {{ $news->links() }}
    </div>
    <!-- End Content -->

    @include('scripts.delete')

    @push('scripts')
        <script src="{{ asset('dropify/dist/js/dropify.min.js') }}"></script>

        <script>
            function publisNews(id) {
                // $(".switch").prop('checked', true); 


                $.ajax({

                    type: "post",
                    url: "{{ route('admin.publis.news') }}",
                    data: {
                        '_token': `{{ csrf_token() }}`,
                        'id': id,
                    },
                    // success: function(data) {
                    //     status = $('#publish'+data);
                    //     status.prop('checked', true);
                    // }

                })
            }

            $('#search').on('keyup', function() {
                value = $(this).val();
                if (value) {
                    $('.allData').hide();
                    $('.searchData').show();
                } else {
                    $('.allData').show();
                    $('.searchData').hide();
                }
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.search.news') }}",
                    data: {
                        'search': value,
                    },

                    success: function(data) {
                        console.log(data);
                        $('#Content').html(data);
                    }
                });
            })
        </script>
    @endpush
</x-app-layout>
