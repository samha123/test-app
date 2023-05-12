@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Name *</label>
                                    <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name', $category->name) }}">
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
                                        @foreach($parentCategories as $parentCategory)
                                        @if($parentCategory->parent_id==7)<option value="{{ $parentCategory->id }}" {{ old('parent_id', $parentCategory->parent_id) == $parentCategory->id ? 'selected' : '' }}>{{ $parentCategory->name }}(Women Jewels)</option>
                                      @elseif($parentCategory->parent_id==8)<option value="{{ $parentCategory->id }}" {{ old('parent_id', $parentCategory->parent_id) == $parentCategory->id ? 'selected' : '' }}>{{ $parentCategory->name }}(Men Jewels)</option>
                                      @elseif($parentCategory->parent_id==2)<option value="{{ $parentCategory->id }}" {{ old('parent_id', $parentCategory->parent_id) == $parentCategory->id ? 'selected' : '' }}>{{ $parentCategory->name }}(Diamond)</option>
                                      @else<option value="{{ $parentCategory->id }}" {{ old('parent_id', $parentCategory->parent_id) == $parentCategory->id ? 'selected' : '' }}>{{ $parentCategory->name }}</option>
                                      @endif     @endforeach
                                    </select>
                                    @error('parent_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="" cols="" rows="" class="form-control form-control-sm @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                      </div>
                      
							 <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Full Width Banner Image (Upload Only 1920 x 500 Dimension Images)</label>
                                    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <img src="" class="w-25 mt-3" alt="">
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
