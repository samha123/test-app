@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="card col-xs-12">
                <div class="card-header">
                    <form action="">
                    <div class="input-group input-group-sm float-left" style="width: 30%;">
                        <input type="text" name="keyword" class="form-control float-right" placeholder="Search" value="{{ isset($_GET['keyword'])?$_GET['keyword']:'' }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    </form>
                    {{-- <div class="card-tools">
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary add-item"><i class="fa fa-plus"></i> Add Metal</a>
                    </div> --}}
                </div>
                <!-- /.card-header --><div style="overflow-x:auto;">
                <div class="card-body table-responsive p-0"  style="overflow-x:auto;">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Order No.</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Status</th>
                          <th>Payment Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                             
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/M/Y') }}</td>
                                    <td>{{ $order->user }}</td>
                                     <td>{{ $order->product_amounts  }}</td>
                                    <td>{{ OrderConstants::ORDER_STATUS[$order->status] }}</td>
                                    <td>{{ $order->payment_status}}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.advance_order.show', $order->id) }}" class="btn btn-sm btn-outline-warning "><i class="fa fa-eye"></i></a>
                                    </td>
                                 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <form action="" id="delete-form" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var App = {
                boot: function () {
                    $('.add-item').on('click', function () {
                        $('#addItemModal').modal('show');
                    });
                    $('.edit').on('click', function () {
                        var url = $(this).data('href');
                        App.renderEditModal(url);
                    });
                    $('.delete').on('click', function () {
                        var url = $(this).data('href');
                        App.deleteItem(url);
                    })
                },
                renderEditModal: function(url) {
                    $.ajax({
                        url: url,
                        success: function (res) {
                            $('#editForm').empty().append(res.html);
                            $('#editItemModal').modal('show');
                        }
                    })
                },
                deleteItem: function (url) {
                    Swal.fire({
                        title: 'Confirm!',
                        text: 'Are you sure you want to delete this item?',
                        icon: 'warning',
                        confirmButtonText: 'Confirm',
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.value) {
                            $('#delete-form').attr('action', url);
                            $('#delete-form').submit();
                        }
                    })
                }
            };
            App.boot();
        })
    </script>
@endpush
