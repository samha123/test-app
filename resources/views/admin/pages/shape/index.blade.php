@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
                    <div class="card-tools">
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary add-item"><i class="fa fa-plus"></i> Add Shape</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($shapes as $shape)
                                <tr>
                                    <td>{{ $shape->name }}</td>
                                    <td class="text-right">
                                        <a href="javascript:;" data-href="{{ route('admin.shape.edit', $shape->id) }}" class="btn btn-sm btn-outline-info edit"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:;" data-href="{{ route('admin.shape.destroy', $shape->id) }}" class="btn btn-sm btn-outline-danger delete"><i class="fa fa-trash"></i></a>
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
    @include('admin.pages.shape.modals.create')
    @include('admin.pages.shape.modals.edit')
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