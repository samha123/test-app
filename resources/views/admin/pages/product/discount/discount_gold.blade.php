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
                  
                   
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                          <th ></th>
                            <th style="width: 30%">Image</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Rate</th>
                        
                         
                            <th>Value Added</th>
                            <th>Discount Percent</th>
                          <th>Discounted MC</th>
                           <th>Diamond Price</th>
                           <th>Discounted DP</th>
                           <th>Sale Price</th>
                          
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        @foreach($products as $product)
                             @php
                                  $carat_price=$product->gold_price;

                        $stone=$product->product_certifications->sum('stone_price_single');
                               $stone_d=$product->product_certifications->sum('stone_price_discount');
                              $GST_notround=( $carat_price + $stone +$product->value_addeds ) *(3/100);
                              $GST=round($GST_notround);
                          $discounted=$product->value_addeds-$product->discounted_values;
                              $GST_notround_sale=( $carat_price + $stone_d +$discounted ) *(3/100);
                              $GST_sale=round( $GST_notround_sale);
                              $t=$carat_price +$GST + $stone +$product->value_addeds; 
                              $tota=round($t);
                             $total=number_format($tota);
                               $t_sale=$carat_price +$GST_sale + $stone_d +$discounted; 
                                $tota_sale=round($t_sale);
                               $total_sale=number_format($tota_sale);
                              @endphp
                            <tr>
                                <td>
                              <input type="hidden" class="maxtickets_enable_cb" id="myCheck1" name="check[]"  >
                                   </td>
                                <td>
                                    <img class="" style="width: 20%" src="{{ ProductMediaHelper::getImagePath($product->file_name, $product->id) }}" alt="">
                                </td>
                            
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                               
                        
                       
                                <td>Rs.{{$total}}</td>
                               
                               
                                <td>
                                 
                                      Rs.{{ $product->value_addeds}}
                                   
                                </td>
                               <td>
                                 @if($product->value_discount_percent )
                                     {{ $product->value_discount_percent }}% @else 0%
                                   @endif
                                </td>
                                                             <td>
                                
                                      Rs.{{ round(  ($product->value_addeds-$product->discounted_values),2) }}
                                  
                                </td>
                               <td>
                                  @if($stone )
                                  @foreach($product->product_certifications as $tag)
                               @if($tag->certification_id===1)
                              {{ $tag->stone_price_single }}
                            @endif
                           @endforeach
                              @else  Rs.0
                                   @endif
                                </td>
                                <td>
                                  @if($stone_d )
                                   @foreach($product->product_certifications as $tag)
                               @if($tag->certification_id===1)
                              {{ $tag->stone_price_discount }}
                            @endif
                                  @endforeach    @else  Rs.0
                                   @endif
                                </td>
                                                              <td>
                                  @if($total_sale )
                                      Rs.{{ $total_sale}}
                                   @endif
                                </td>
                                <td class="text-right">
                                  <a href="javascript:;" data-href="{{ route('admin.product.gold.discount.edit', $product->id) }}" class="btn btn-sm btn-outline-info edit"><i class="fa fa-edit"></i>MC</a>
                                   <a href="javascript:;" data-href="{{ route('admin.product.diamond.discount.edit', $product->id) }}" class="btn btn-sm btn-outline-info dedit"><i class="fa fa-edit"></i>Diamond</a>
                                    
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

    @include('admin.pages.product.discount.discount_gold_edit')
       @include('admin.pages.product.discount.discount_diamond_edit')
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var App = {
                boot: function () {
                   
                    $('.edit').on('click', function () {
                        var url = $(this).data('href');
                        App.renderEditModal(url);
                    });
                    
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
               
                    
            };
            App.boot();
        })
    </script>
    <script>
        $(document).ready(function() {
            var App = {
                boot: function () {
                   
                    $('.dedit').on('click', function () {
                        var url = $(this).data('href');
                        App.renderEditModal(url);
                    });
                    
                },
                renderEditModal: function(url) {
                    $.ajax({
                        url: url,
                        success: function (res) {
                            $('#editFormD').empty().append(res.html);
                            $('#editItemModalD').modal('show');
                        }
                    })
                },
               
                    
            };
            App.boot();
        })
    </script>   
 
 <script>
    function add_discount() {
   var first_number = parseFloat(document.getElementById("discount").value);
        if (isNaN(first_number)) first_number = 0;
       var second_number = parseFloat(document.getElementById("value").value);
        if (isNaN(second_number)) second_number = 0;
      var netdiscount = first_number*(second_number/100);
       document.getElementById("discount_mc").value = netdiscount;
      add_number();
    }
   add_discount();
     </script>
      

@endpush


