@extends('layouts.admin')
	
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">

        <a class="float-right btn  btn-swa px-4" href="{{ route('admin.blog') }}">
            <i class="fa fa-backward"></i> Save
        </a>

    </div>
                <div class="card-body">
                    <form action="{{ route('admin.blog.image', $blog_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          @foreach($blogs as $productMedia)<img class="text-right" style="width:20%" src="{{ ProductMediaHelper::getImagePath($productMedia->blog_image, $productMedia->blog_id) }}" alt="">
            
                          
                             
                                   
                                    
                                   
                                   

                              
                               
                              
                             
                                  
                    
                        @endforeach
                     &nbsp;
                      </div>
                      <div>
                          <br>
                            <input type="file" name="media" class="form-control-file image-input" required accept="image/*">
                            <input type="text" name="media" class="form-control form-control-sm video-input d-none" disabled placeholder="Enter Youtube Video ID">
                        </div>
                       <div class="form-group">
                          
                      </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-sm btn-info " style=" width: 20%!important;">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
                <hr>
                <!-- /.card-header -->
              
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    
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
                        if (mediaType == 0) {
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
