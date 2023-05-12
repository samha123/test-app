@extends('layouts.admin')
@push('styles')
<style>
input + div.max_tickets {
    display: none;
}

input:checked + div.max_tickets {
    display: block;
}
  .form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
}
 
 
 </style>
@endpush
@section('content')
<main onload="add_number()">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="form1">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  
                                    <label for="">Name *</label>
                                    <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Product Name" value="{{ old('name', $product->name) }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">SKU *</label>
                                    <input type="text" name="sku" class="form-control form-control-sm @error('sku') is-invalid @enderror" placeholder="Enter SKU" value="{{ old('sku', $product->sku) }}">
                                    @error('sku')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stock *</label>
                                    <input type="text" name="stock" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Enter Stock" value="{{ old('stock', $product->stock) }}">
                                    @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Days for Dispatch *</label>
                                    <input type="text" name="dispatch" class="form-control form-control-sm @error('dispatch') is-invalid @enderror" placeholder="Enter No of days  for dispatch" value="{{ old('dispatch', $product->dispatch) }}">
                                    
                                </div>
                                  </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dimension</label>
                                    <input type="text" name="dimension" class="form-control form-control-sm @error('dimension') is-invalid @enderror" placeholder="Enter Dimension" value="{{ old('dimension', $product->dimension) }}">
                                    @error('dimension')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Color</label>
                                    <select name="color_id" class="form-control  form-control-sm @error('color_id') is-invalid @enderror" id="" >
                                        <option value="">Select Color</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}"{{  old('color_id', $product->color_id) ===  $product->color_id ? 'selected' : '' }} >{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('color_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Short Description</label>
                                    <textarea name="short_description" id="" cols="" rows="" class="form-control form-control-sm @error('short_description') is-invalid @enderror" placeholder="Enter Description">{{ old('short_desc',$product->short_desc) }}</textarea>
                                    @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Long Description</label>
                                    <textarea name="long_description" id="" cols="" rows="" class="form-control form-control-sm @error('long_description') is-invalid @enderror" placeholder="Enter Description">{{ old('long_desc',$product->long_desc) }}</textarea>
                                    @error('long_description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category_id" onchange="MinPecas(this.value)" class="form-control select2 form-control-sm @error('category_id') is-invalid @enderror" id="">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            @if($category->parent_id==7)<option value="{{ $category->id }}" {{ old('category_id',$product->category_id) ===  $category->id ? 'selected' : '' }} >{{ $category->name }}(Women Jewels)</option>
                                      @elseif($category->parent_id==8)<option value="{{ $category->id }}" {{ old('category_id',$product->category_id) ===  $category->id ? 'selected' : '' }}>{{ $category->name }}(Men Jewels)</option>
                                      @elseif($category->parent_id==2)<option value="{{ $category->id }}" {{ old('category_id',$product->category_id) ===  $category->id ? 'selected' : '' }}>{{ $category->name }}(Diamond)</option>
                                      @else<option value="{{ $category->id }}"{{ old('category_id',$product->category_id) ===  $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                      @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                          @php
    $anArraySize =$product->category_id ;
@endphp

                          <div class="col-md-6" style="display:{{ 
   
    ($anArraySize === 3) ? 'block' : 
        'none';
}}" id="ifYesd">
                              
                                   
                                 <div class="form-group select2-blue">
                                    <label for="">Size Available</label>
                                    <select name="size_ids[]" class="form-control select2 form-control-sm" multiple id="" id="sel1">
                                       
                                          <option value="" >Select Ring Size</option>
                                       <option value="7- 15 mm">7 - 15 mm</option>
                                       <option value="8 - 15.3 mm">8 - 15.3 mm</option>
                                       <option value="9- 15.6 mm">9 - 15.6 mm</option>
                                       <option value="10- 15.9 mm">10 - 15.9 mm</option>
                                       <option value="11 - 16.2 mm">11 - 16.2 mm</option>
                                       <option value="12- 16.5 mm">12 - 16.5 mm</option>
                                       <option value="13- 16.8 mm">13 - 16.8 mm</option>
                                       <option value="14- 17.2 mm">14 - 17.2 mm</option>
                                       <option value="15 - 17.5 mm">15 - 17.5 mm</option>
                                       <option value="16- 17.8 mm">16 - 17.8 mm</option>
                                       <option value="17- 18.1 mm">17 - 18.1 mm</option>
                                       <option value="18- 18.4 mm">18 - 18.4 mm</option>
                                       <option value="19- 18.8 mm">19 - 18.8 mm</option>
                                       <option value="20- 19.1 mm">20 - 19.1 mm</option>
                                       <option value="21- 19.4 mm">21 - 19.4 mm</option>
                                       <option value="22- 19.7 mm">22 - 19.7 mm</option>
                                       <option value="23- 20 mm">23 - 20 mm</option>
                                       <option value="24- 20.3 mm">24 - 20.3 mm</option>
                                       <option value="25- 20.4 mm">25 - 20.4 mm</option>
                                      
                                    </select>
                                    
                                </div>
                                 
                             
                            </div>
                          <div class="col-md-6" style="display:{{ 
   
    ($anArraySize === 4) ? 'block' : 
        'none';
}}" id="ifYesdd">
                              
                                   
                                 <div class="form-group select2-blue">
                                    <label for="">Size Available</label>
                                    <select name="size_ids[]" class="form-control select2 form-control-sm" multiple id="" id="">
                                       
                                        <option value="">Select Bangle Size</option>
                                       <option value="2.0''- 51 mm"{{ ! empty($shapes) && in_array("7- 15 mm", $shapes) ? 'selected' :'' }}>2.0'' - 51 mm</option>
                                       <option value="2.1''- 53 mm">2.1'' - 53 mm</option>
                                       <option value="2.2''- 54 mm">2.2'' - 54 mm</option>
                                       <option value="2.3''- 54 mm">2.3'' - 54 mm</option>
                                       <option value="2.4''- 57 mm">2.4'' - 57 mm</option>
                                       <option value="2.5''- 58 mm">2.4'' - 58 mm</option>
                                       <option value="2.6''- 60 mm">2.5'' - 60 mm</option>  
                                        <option value="2.7''- 61 mm">2.4'' - 61 mm</option>
                                       <option value="2.8''- 63 mm">2.5'' - 63 mm</option>  
                                       <option value="2.9''- 66 mm">2.9'' - 66 mm</option> 
                                    </select>
                                   
                                </div>
                           
                             
                            </div>
                           
                         
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control form-control-sm @error('status') is-invalid @enderror" id="">
                                        @foreach(ProductConstants::STATUS as $key=>$status)
                                            <option value="{{ $key }}" >{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input name="is_featured" type="checkbox" id="checkboxPrimary3" >
                                        <label for="checkboxPrimary3">
                                            Is Featured
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input name="is_new" type="checkbox" id="checkboxPrimary1" >
                                        <label for="checkboxPrimary1">
                                            Is New
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input name="is_exclusive" type="checkbox" id="checkboxPrimary2" >
                                        <label for="checkboxPrimary2">
                                            Is Exclusive
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                 
                               
                                  

                                    
                             
                           
                         <div>  
                  <div class="col-md-2 " style="display: initial;padding:1px;">
                      <button type="submit" class="btn btn-sm btn-success " name="submit" value="submit"><i class="fa fa-save"></i> Save</button> 
                    </div>
                 
              
               
           
               
                      
                    
           &nbsp;&nbsp;  
           
        </div>
          </form>          
    </div>
 

	

    
                        
                   
  <!--edit -->
  
 
           
  
 

@endsection

@push('script')
     <script>
  
        $(document).ready(function () {
            $('.select2').select2()
        })
        function add_number() {
      var first_number = parseFloat(document.getElementById("net_weight").value);
      if (isNaN(first_number)) first_number = 0;
      var second_number = parseFloat(document.getElementById("origin").value);
      if (isNaN(second_number)) second_number = 0;
     
      var goldpriced = first_number * second_number;
     var  goldprice=   Math.round(goldpriced)
      document.getElementById("gold").value = goldprice;
        var stone = parseFloat(document.getElementById("stone").value);
      if (isNaN(stone)) stone = 0;
      var value = parseFloat(document.getElementById("hjk").value);
          console.log(value);
      if (isNaN(value)) value = 0;
        var results = (goldprice+ value+stone)*(3/100);
     var gst=Math.round(results);
       document.getElementById("gst").value = gst;
   
     
     var totals=goldprice+gst+value+stone;
          console.log(totals);
      var total= Math.round(totals);
      document.getElementById("total").value = totals;
    }
      add_number();
    </script>
 <script>
    function add_weight() {
   var first_number = parseFloat(document.getElementById("weight").value);
        if (isNaN(first_number)) first_number = 0;
       var second_number = parseFloat(document.getElementById("stone_weight").value);
        if (isNaN(second_number)) second_number = 0;
      var netweight = first_number-second_number;
       document.getElementById("net_weight").value = netweight;
      add_number();
    }
   add_weight();
     </script>

<script >
 var textboxe = document.querySelectorAll(".smt"); 
  var textboxed = document.querySelectorAll(".g_c"); 
var textboxes = document.querySelectorAll(".stone_sum");
textboxe.forEach(function(box) {
  box.addEventListener("keyup", sumAll);
});
textboxed.forEach(function(box) {
  box.addEventListener("click", sumAll);
});

function sumAll() {
  var total = 0;
  
  textboxes.forEach(function(box) {
    var val;
    if (box.value == "") val = 0;
    else val = parseFloat(box.value);
    total += val;
  });

  document.getElementById("stone_weight").value = total;
  add_weight();
  add_number();
}
</script>
<script >
 


   function add_making() {
      var first_number = parseFloat(document.getElementById("gold").value);
      if (isNaN(first_number)) first_number = 0;
     
     var third = parseFloat(document.getElementById("making_prcnt_gram").value);
      if (isNaN(third)) value = 0;
   
      var second = document.getElementById("gram_percent").value;
    if(second =="percent"){
     
      var value_added = first_number *(third/100);
      document.getElementById("hjk").value =value_added;}
       else {
    var net_weight=document.getElementById("net_weight").value;
           var value_added = net_weight  *third
         document.getElementById("hjk").value =value_added;}
       add_number();
    }
      add_making();
  </script>
<script >
 function compute(id) {
        var result = 0;
      var txtFirstNumberValue = document.getElementById('qty'+id).value;
      var checkbox = document.getElementById('myCheck'+id);
      var gram_carat=document.getElementById('gram_carat'+id).value;
      var txtSecondNumberValue = document.getElementById('price'+id).value;
     var thirdNumberValue = document.getElementById('qty_org'+id).value;
      if (document.getElementById('gram_carat'+id).value === "carat" ){
        
      
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue)*0.2;
        if (!isNaN(result)) {
        document.getElementById('total'+id).value = result;
          document.getElementById('qty_org'+id).value=txtFirstNumberValue*0.2;
     sumAlls();}
     
  } else if (document.getElementById('gram_carat'+id).value === "gram" ){
    var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
        if (!isNaN(result)) {
        document.getElementById('total'+id).value = result;
          document.getElementById('qty_org'+id).value=txtFirstNumberValue;
     sumAlls();} 

  }
   
        
}</script>
 <script >

    function computez(id) {
        var result = 0;
     
      var checkbox = document.getElementById('myCheck'+id);
     
    
      if (document.getElementById('myCheck'+id).checked===false){
      document.getElementById('qty'+id).value =0;
       document.getElementById('total'+id).value = 0;
  
          sumAlls();
        
  } 
  
  
       
          

        
}</script>
<script >
  var textboxesa = document.querySelectorAll(".stone_sum");
textboxesa.forEach(function(box) {
  box.addEventListener('input', sumAlls);
});

function sumAlls() {
  var total = 0;
  var textboxesad = document.querySelectorAll(".stone_price_one ");
  textboxesad.forEach(function(box) {
    var val;
    
    if (box.value == "") val = 0;
    else val = parseFloat(box.value);
   
   
    total += val;
  });
  
var round;
  round=total.toFixed(2);
  document.getElementById("stone").value = round;
   
}
  
 
 
</script>
<script> 
    function MinPecas(quantidade){
    	if(quantidade == 3){
         	 document.getElementById("ifYesd").style.display = "block";
          document.getElementById("ifYesdd").style.display = "none";}
         else if(quantidade == 4){
         	 document.getElementById("ifYesdd").style.display = "block";
            document.getElementById("ifYesd").style.display = "none";
    } else {
        document.getElementById("ifYesd").style.display = "none";
    }
    }  
    </script>
    
@endpush


   