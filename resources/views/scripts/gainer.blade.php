@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript">
        $('.addGainer').on('click', function() {
            addGainer();
        });
        function addGainer() {
            var gainer = '<div><div class="form-group row mb-1"><label class="col-sm-2 col-form-label text-end">Name</label><div class="col-sm-9"><input type="text" class="form-control" name="name[]" value="{{ @$achievements->gainer->name }}"placeholder="Enter Name, Ex: Fulan" required></div><div class="col-sm-1"><a href="javascript:;" class="remove link-danger" style="float:right;"><i class="bi-x-circle"></i></a></div></div><div class="form-group row mb-3"><label class="col-sm-2 col-form-label text-end">From</label><div class="col-sm-9"><input type="text" class="form-control" name="from[]" value="{{ @$achievements->gainer->from }}"placeholder="From..., Ex: Jakarta" required></div></div></div>'
        $('.gainer').append(gainer);
        };
        $('.remove').live('click', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
    @endpush
