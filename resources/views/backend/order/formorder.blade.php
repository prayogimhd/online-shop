<!-- Modal -->
<div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            <div class="align-content-center text-center align-items-center">
                <h4 id="invoice">No Invoice : #{{ $data->invoice }}</h4>
                @foreach ($detail as $item)
                <div id="product">{{ $item->products->product_name }} x {{ $item->quantity }}</div>
                @endforeach
                <br>
                <h6>Total</h6>
                <h5> {{ rupiah($data->total) }} </h5>
                <hr>
                <h5>Recipient</h5>
                <div id="recipient">
                    <div class="container text-left offset-1">
                        <div class="row">
                            <div class="col-sm-3">Name</div>
                            <div class="col-sm-9">: {{ $data->first_name }} {{ $data->last_name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">Address</div>
                            <div class="col-sm-9">: {{ $data->street }}, {{ $data->city }} {{ $data->postcode }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">Email</div>
                            <div class="col-sm-9">: {{ $data->email }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">Phone</div>
                            <div class="col-sm-9">: {{ $data->phone }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="formOrder">
                @csrf
                <input type="hidden" value="{{ $data->id }}" id="order_id" name="order_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="order_status" id="order_status" class="form-control"
                                @if ($data->order_status == 'A' || $data->order_status == 'C') disabled @endif>
                                <option value="P" @if ($data->order_status == 'P') selected @endif>Process
                                </option>
                                <option value="O" @if ($data->order_status == 'O') selected @endif>On The Way
                                </option>
                                <option value="A" @if ($data->order_status == 'A') selected @endif>Accept</option>
                                <option value="C" @if ($data->order_status == 'C') selected @endif>Cancel</option>
                            </select>
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
    $('#formOrder').submit(function(e) {
        e.preventDefault();
        let order_id = $('#order_id').val();
        let order_status = $('#order_status').val();
        $.ajax({
            type: "POST",
            url: 'orderStore',
            data: {
                order_id: order_id,
                order_status: order_status,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 200) {
                    swal(response.message, {
                        icon: "success",
                    }).then((success) => {
                        $('#modalOrder').modal('hide');
                        $('#orderList').DataTable().ajax.reload();
                    });
                } else {
                    swal(response.message, {
                        icon: "warning",
                    });
                }
            },
        })
    })
</script>
