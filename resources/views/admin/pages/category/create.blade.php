@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name *</label>
                                    <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Parent Category</label>
                                    <select name="parent_id" class="form-control form-control-sm @error('parent_id') is-invalid @enderror" id="">
                                        <option value="">Select Parent Category</option>
                                        @foreach($categories as $category)
                                       @if($category->parent_id==7)<option value="{{ $category->id }}" >{{ $category->name }}(Women Jewels)</option>
                                      @elseif($category->parent_id==8)<option value="{{ $category->id }}" >{{ $category->name }}(Men Jewels)</option>
                                      @elseif($category->parent_id==2)<option value="{{ $category->id }}" >{{ $category->name }}(Diamond)</option>
                                      @else<option value="{{ $category->id }}" >{{ $category->name }}</option>
                                      @endif
                                            
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="" cols="" rows="" class="form-control form-control-sm @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Image * (Upload Only  x 500 Dimension Images)</label>
                                    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            

                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
