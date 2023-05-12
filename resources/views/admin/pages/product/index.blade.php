@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="">
                        <div class="input-group input-group-sm float-left" style="width: 50%;">
                            <input type="text" name="keyword" class="form-control float-right" placeholder="Search" value="{{ isset($_GET['keyword'])?$_GET['keyword']:'' }}">
                            <select name="cat_id" class="form-control" id="">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($_GET['cat_id']) && ($_GET['cat_id'] == $category->id)?'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                  
                    <div class="card-tools">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> Add Product</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 30%">Image</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Rate</th>
                            <th> Sale Rate</th>
                         
                            <th>Stock</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <img class="" style="width: 20%" src="{{ ProductMediaHelper::getImagePath($product->file_name, $product->id) }}" alt="">
                                </td>
                               @php
                                            
                                 $carat_price=round($product->gold_price);
                        $stone=$product->product_certifications->sum('stone_price_single');
$stone_d=$product->product_certifications->sum('stone_price_discount');
                              $discounted=$product->value_addeds-$product->discounted_values;
                              $GST_notround=( $carat_price + $stone +$product->value_addeds) *(3/100);
                              $GST=round($GST_notround);
                                                            $GST_sale=round(( $carat_price + $stone_d +$discounted ) *(3/100));
                              $t=$carat_price +$GST + $stone +$product->value_addeds; 
                              $tota=round($t);
                             $total=number_format($tota);
                              $t_sale=$carat_price +$GST_sale + $stone_d +$discounted; 
                                                              $tota_sale=round($t_sale);
                               $total_sale=number_format($tota_sale);
                              @endphp
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                               
                        
                       
                                <td>Rs.{{$total}}</td>
                               <td>Rs.{{$total_sale}}</td>
                                 
                                <td>
                                    @if ($product->stock > 0)
                                        <span class="badge badge-success">In Stock ({{ $product->stock }})</span>
                                    @else
                                        <span class="badge badge-success">Out Of Stock</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.product-media.index', $product->id) }}" class="btn btn-sm btn-outline-warning" title="Add Media"><i class="fa fa-images"></i></a>
                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i>Info</a>
                                  <a href="{{ route('admin.product.edit-price', $product->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i>Price</a>
                                    <a href="javascript:;" data-href="{{ route('admin.product.destroy', $product->id) }}" class="btn btn-sm btn-outline-danger delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                  <div class="paginatoin-area text-center">
                                {{ $products->withQueryString()->links() }}
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
