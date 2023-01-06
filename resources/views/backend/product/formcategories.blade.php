<!-- Modal -->
<div class="modal fade" id="modalCategories" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCategories">
                @csrf
                <div class="modal-body">
                    <h5> {{ isset($data) ? 'Edit Categories' : 'Add Categories' }}</h5>
                    <br>
                    <div class="form-group">
                        <label>Name</label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" value="{{ isset($data) ? $data->id : '' }}" id="categories_id"
                                    name="categories_id">
                                <input type="text" id="name" value="{{ isset($data) ? $data->name : '' }}"
                                    name="name" class="form-control">
                                <div class="invalid-feedback errorname">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-share-square"></i>
                        Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#formCategories').submit(function(e) {
        e.preventDefault();
        $('#name').removeClass('is-invalid');
        let categories_id = $('#categories_id').val();
        let name = $('#name').val();
        $.ajax({
            type: "POST",
            url: 'actionCategories',
            data: {
                categories_id: categories_id,
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: name,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 200) {
                    swal(response.message, {
                        icon: "success",
                    }).then((success) => {
                        $('#modalCategories').modal('hide');
                        $('#categoriesList').DataTable().ajax.reload();
                    });
                } else {
                    swal(response.message, {
                        icon: "warning",
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function(index, value) {
                        $('.error' + index).text(value[0]);
                        $('#' + index).addClass('is-invalid');
                    });
                }
            }
        })
    })
</script>
