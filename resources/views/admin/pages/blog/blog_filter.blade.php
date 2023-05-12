@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
      
        <a class="float-right btn  btn btn-sm btn-outline-primary" href="{{ route('admin.blog.create',['blog_id'=>0]) }}">
            <i class="fa fa-plus"></i> New Blog
        </a>

    </div>
</div>
<div class="card" >
    <div class="card-header">Blogs</div>
    <div class="card-body">
		@if(count($blog_info) > 0)
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Blog Image</th>
                    <th>Blog Heading</th>
					<th>Author</th>
                    <th>Blog Description</th>
                    <th> Manage </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($blog_info as $row)
                <tr>
                    <td><img src="{{ ProductMediaHelper::getblogPath($row->blog_image,$row->blog_id ) }}" width="100" height="100"></td>
                    
                    <td><a href="{{route('admin.blog.create',['blog_id'=>$row->blog_id])}}">{{ucwords($row->blog_heading)}}</a></td>
					<td>{{ucwords($row->author)}}</td>
                    <td>{{strip_tags(\Illuminate\Support\Str::limit(($row->blog_desc),100))}}</td>
                    
                    <td><a class="btn btn-sm btn-outline-info" href="{{route('admin.blog.create',['blog_id'=>$row->blog_id])}}"><i class="fa fa-edit"></i> </a></td>
                    <td><a class="btn btn-sm btn-outline-danger delete" onclick="return confirm('Are you sure to delete this Blog ?')" href="{{route('admin.blog.delete',['blog_id'=>$row->blog_id])}}"><i class="fa fa-trash"></i> </a></td>
                    
                </tr>
                @endforeach

            </tbody>
        </table>
		 @else
         <div class="alert alert-danger">
        No results found.
      </div>
        @endif
    </div>
</div>
@endsection