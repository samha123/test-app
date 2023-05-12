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
                        <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> Add Category</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 30%">Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <img class="" style="width: 20%" src="{{asset('storage/category/'.$category->image)}}" alt="{{$category->image}}">
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if (is_null($category->parent_id))
                                        <span class="badge badge-success">Main</span>
                                    @else
                                        <span class="badge badge-warning">Sub</span>
                                    @endif
                                </td>
                                
                                <td class="text-right">
                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:;" data-href="{{ route('admin.category.destroy', $category->id) }}" class="btn btn-sm btn-outline-danger delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="paginatoin-area text-center">
                                {{ $categories->withQueryString()->links() }}
                </div>
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
                    $('.delete').on('click', function () {
                        var url = $(this).data('href');
                        App.deleteItem(url);
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
