@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">

        <a class="float-right btn  btn-swa px-4" href="{{ route('admin.blog') }}">
            <i class="fa fa-backward"></i> Back
        </a>

    </div>
     <div class="alert alert-success print-success-msg" style="display:none">
        <ul></ul>
    </div>
</div>
<div class='card' style="padding: 8px;">
    <div class='card-body p-0'>
         <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <form class="" id="blog-upload" action="{{ route('admin.blog.save') }}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                 
                    <input class="form-control" type="text" name="blog_id"   @if($blog_info!= null)value="{{ $blog_info['blog_id'] }}"@endif hidden>
                    <label>Blog Heading</label>
                    <input class="form-control" type="text" name="blog_heading"  @if($blog_info!= null)value="{{ $blog_info['blog_heading'] }}"@endif placeholder="Blog Heading">

                </div>
				<div class="form-group col-md-6">
                    <label>Author</label>
                    <input class="form-control" type="text" name="author"  @if($blog_info!= null)value="{{ $blog_info['author'] }}"@endif placeholder="Author">

                </div>
              <div class="form-group col-md-6">
                    <label>keyword</label>
                    <input class="form-control" type="text" name="meta_keywords"   placeholder="Enter keywords">

                </div>
               
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Blog Description</label>
                  
                    <textarea class="  form-control" name="blog_desc" id="summary-ckeditor" placeholder="Blog Description" style="height: 350px;width: 1000px;">@if($blog_info!= null){{ $blog_info['blog_desc'] }}@endif</textarea>
                </div>
            </div>
            



            <div class="text-right">
                <a type="button" class="btn btn-sm btn-secondary" href="{{ route('admin.blog') }}">
                    <i class="fa fa-undo"></i> Cancel
                </a>

                <button type="submit" class="btn btn-sm btn-swa" id='blog-save'>
                    <i class="fa fa-check"></i> Save
                </button>
            </div>

       
      @if($blog_info= null)
       
      @endif
           </form>
    </div>
</div>
@endsection

@push('scripts')






@endpush

