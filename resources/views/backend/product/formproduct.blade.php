<!-- Modal -->
<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formProduct">
                @csrf
                <div class="modal-body">
                    <h5> {{ isset($data) ? 'Edit Product' : 'Add Product' }}</h5>
                    <br>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>
                                    Name
                                </label>
                                <input type="hidden" value="{{ isset($data) ? $data->id : '' }}" id="product_id"
                                    name="product_id">
                                <input type="text" id="product_name"
                                    value="{{ isset($data) ? $data->product_name : '' }}" name="product_name"
                                    class="form-control">
                                <div class="invalid-feedback errorproduct_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>
                                    Categories
                                </label>
                                <select name="categories_id" id="categories_id" class="form-control">
                                    @foreach ($categories as $item)
                                        @if (isset($data))
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == $data->categories_id) selected @endif>{{ $item->name }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback errorcategories_id">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    Price
                                </label>
                                <input type="text" id="price" value="{{ isset($data) ? $data->price : '' }}"
                                    name="price" class="form-control">
                                <div class="invalid-feedback errorprice">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    Weight
                                </label>
                                <input type="text" id="weight" value="{{ isset($data) ? $data->weight : '' }}"
                                    name="weight" class="form-control">
                                <div class="invalid-feedback errorweight">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    Descriptions
                                </label>
                                <textarea name="product_descriptions" id="product_descriptions" cols="30" rows="10" class="form-control">{{ isset($data) ? $data->product_descriptions : '' }}</textarea>
                                <div class="invalid-feedback errorproduct_descriptions">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    Thumbnails
                                </label>
                                <input type="file" class="form-control" id="thumbnails" name="thumbnails">
                                <div class="invalid-feedback errorthumbnails">
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
    $(document).ready(function() {
        $('#formProduct').submit(function(e) {
            e.preventDefault();

            $('#product_name').removeClass('is-invalid');
            $('#price').removeClass('is-invalid');
            $('#weight').removeClass('is-invalid');
            $('#product_descriptions').removeClass('is-invalid');
            $('#thumbnails').removeClass('is-invalid');

            let data = new FormData(this);
            let product_id = $('#product_id').val();
            $.ajax({
                type: "POST",
                url: "actionProduct",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        swal(response.message, {
                            icon: "success",
                        }).then((success) => {
                            $('#modalProduct').modal('hide');
                            $('#productList').DataTable().ajax.reload();
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
            });
        })
    });
</script>
