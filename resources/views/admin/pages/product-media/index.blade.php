@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.product-media.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group col-md-4">
                    <select type="dropdown" class="form-control" id="parent_id" name="color">
                        <option selected="" value="">Select Variations</option>
                                                <option value="white gold">White gold</option>
                                                <option value="yellow gold">Yellow gold</option>
                                                <option value="rose gold">Rose gold</option>
                                            </select>
                </div>
                        <div class="form-group">
                            <label for="">Media * (Upload Only 370 x 370 Dimension Images)</label>
                            <input type="file" name="media" class="form-control-file image-input" required accept="image/*">
                           
                            <input type="text" name="media" class="form-control form-control-sm video-input d-none" disabled placeholder="Enter Youtube Video ID">
                        </div>
                       <div class="form-group">
                           @foreach(ProductMediaConstants::MEDIA_TYPES as $key=>$mediaType)
                               <div class="custom-control custom-radio">
                                   <input class="custom-control-input media-type"  value="{{ $key }}" {{ $key == 0 ?'checked':'' }} type="radio" id="customRadio{{ $key }}" name="media_type">
                                   <label for="customRadio{{ $key }}" class="custom-control-label">{{ $mediaType }}</label>
                               </div>
                         @endforeach
                      </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-sm btn-info w-100">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
                <hr>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 30%">Media</th>
                            <th>Is Cover</th>
                           <th>Color</th>
                            <th>Type</th>
                                                      <th>Change Color</th>
                            <th >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productMedias as $productMedia)
                            <tr>
                                <td>
                                    @if (ProductMediaConstants::MEDIA_TYPE_IMAGE == $productMedia->media_type)
                                    <img class="" style="width: 25%" src="{{ ProductMediaHelper::getImagePath($productMedia->file_name, $productMedia->product_id) }}" alt="">
                                  
                                    @elseif(ProductMediaConstants::MEDIA_TYPE_YOUTUBE == $productMedia->media_type)
                                        <img style="width: 25%" src="https://img.youtube.com/vi/{{ $productMedia->file_name }}/mqdefault.jpg" alt="product-details" />
                                        {{-- <img style="width: 25%" src="{{ asset('assets/images/yt-logo.png') }}" alt=""> --}}
                                        {{-- {{ $productMedia->file_name }} --}}
                                   @else
                                 <video width="130" height="130" >
  <source src="{{ ProductMediaHelper::getImagePath($productMedia->file_name, $productMedia->product_id) }}" >
 
</video>
                                    @endif

                                </td>
                                <td>{{ ProductMediaConstants::IS_COVER_TYPE[$productMedia->is_cover] }}</td>
                              <td>{{ $productMedia->color }}</td>
                                <td>{{ ProductMediaConstants::MEDIA_TYPES[$productMedia->media_type] }}</td>
                                <td class="text-right">
                                   <form action="{{route('admin.product-media.color.edit', [$productMedia->id])}}" method="POST">
                        @csrf
                       
                        <div class="row">
                            <div class="col-md-4">
                 <select  class="form-control form-control-sm" id="" name="color">
                   <option selected="" value="">select color</option>
                                                <option value="white gold">White gold</option>
                                                <option value="yellow gold">Yellow gold</option>
                                                <option value="rose gold">Rose gold</option>
                                            </select>
                            </div>
                            <div class="">
                                <button class="btn btn-sm btn-success">Save</button>
                            </div>

                        </div>
                    </form></td><td>
                                  <a href="javascript:;" data-href="{{ route('admin.product-media.destroy', [$product->id, $productMedia->id]) }}" class="btn btn-sm btn-outline-danger delete"><i class="fa fa-trash"></i></a>
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
                    $('.delete').on('click', function () {
                        var url = $(this).data('href');
                        App.deleteItem(url);
                    });
                  
                    $('.media-type').on('change', function () {
                        var mediaType = $(this).val();
                        if (mediaType == 0 || mediaType == 2) {
                            $('.image-input').removeClass('d-none');
                            $('.image-input').prop('required',true);
                            $('.image-input').prop('disabled',false);
                            $('.video-input').addClass('d-none');
                            $('.video-input').prop('required',false);
                            $('.video-input').prop('disabled',true);
                        } else {
                            $('.video-input').removeClass('d-none');
                            $('.video-input').prop('required',true);
                            $('.image-input').prop('disabled',true);
                            $('.image-input').addClass('d-none');
                            $('.image-input').prop('required',false);
                            $('.video-input').prop('disabled',false);
                        }
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
