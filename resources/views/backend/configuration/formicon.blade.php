<!-- Modal -->
<div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <center>
                <img class="img-thumbnail" width="70%" src="{{ asset('backend/configuration/' . $data->icon) }}"
                    alt="Icon Website">
            </center>
            <form id="formIcon">
                <input type="hidden" value="{{ $data->id }}" id="configuration_id" name="configuration_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Upload</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="icon" name="icon">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnupload"><i class="fa fa-share-square"></i>
                        Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('backend/script/configuration.js') }}"></script>
