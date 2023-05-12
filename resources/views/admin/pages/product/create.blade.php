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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  
                                    <label for="">Name *</label>
                                    <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Product Name" value=" {{ old('name') }} ">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">SKU *</label>
                                    <input type="text" name="sku" class="form-control form-control-sm @error('sku') is-invalid @enderror" placeholder="Enter SKU" value="{{ old('sku') }}">
                                    @error('sku')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stock *</label>
                                    <input type="text" name="stock" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Enter Stock" value="{{ old('stock') }}">
                                    @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Days for Dispatch *</label>
                                    <input type="text" name="dispatch" class="form-control form-control-sm @error('stock') is-invalid @enderror" placeholder="Enter No of days for dispatch" value="{{ old('dispatch') }}">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dimension</label>
                                    <input type="text" name="dimension" class="form-control form-control-sm @error('dimension') is-invalid @enderror" placeholder="Enter Dimension" value="{{ old('dimension') }}">
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
                                            <option value="{{ $color->id }}" >{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('color_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Gross Weight</label>
                                    <input type="text" name="weight" onkeyup="add_weight()"  id="weight" class="form-control form-control-sm @error('weight') is-invalid @enderror" placeholder="Enter Weight" value="{{ old('weight') }}" >
                                    @error('weight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group select2-blue" id="opwp_woo_tickets">
                                    <label for="">Gemstone</label>
                                  
                                    <br>
                                        @foreach($certifications as $certification)
          <input type="checkbox" class="maxtickets_enable_cb" id="myCheck{{$certification->id}}" name='check[]'  value="{{ $certification->id }}"  onchange="computez({{$certification->id}});sumAll();add_number();add_weight();" > {{ $certification->name }}&emsp;&emsp;
        <div class="max_tickets">
          
            <input type="text"  id="qty{{$certification->id}}"  name='{{ $certification->id }}'style="display: initial;"
 onchange="computez({{$certification->id}});add_number();" onkeyup="compute({{$certification->id}});add_weight();" 
                   class="col-md-8 form-control form-control-sm smt " placeholder="{{$certification->name}} weight"  >
           <input type="hidden"  id="qty_org{{$certification->id}}"   onchange="computez({{$certification->id}});add_number();"
  
                   class="col-md-8 form-control form-control-sm stone_sum" placeholder="weight in gram"  >
        &emsp; <select name="gram_carat{{ $certification->id }}"  class="col-md-3 form-control form-control-sm g_c" style="display: initial;" onchange="compute({{$certification->id}});"  id="gram_carat{{$certification->id}}" >
                                       <option value="carat" >Carat</option>
                                      <option value="gram" >Gram</option>
                                  </select>
           <input type="hidden" id="price{{$certification->id}}"    onchange="compute({{$certification->id}})" value="{{$certification->price}}"class="form-control gemstone_price" name="certification_ids" placeholder="{{$certification->name}} price/gram"  />
           <input type="hidden"  id="total{{$certification->id}}"  name='price{{ $certification->id }}' value="0" class="stone_price_one form-control  "   placeholder="{{$certification->name}} total price"/>
        </div>
                                 
                                        @endforeach
                                   
                                    @error('certification_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                 <br>
                               
                                </div>
                            </div>
                          
                                
                          
                         
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Stone Weight</label>
                                
                                    <input type="text" name="stone_weight_total"  id="stone_weight" onchange="add_weight();"class="form-control form-control-sm @error('stone_weight') is-invalid @enderror" placeholder="Enter Stone Weight" value="0" readonly>
                                    @error('stone_weight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Net Weight</label>
                                    <input type="text" name="net_weight" onchange="add_number()" id="net_weight" class="form-control form-control-sm @error('net_weight') is-invalid @enderror"  readonly>
                                    @error('net_weight')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Gold Purity</label>
                                    <select name="origin_id" onchange="add_number()" class="form-control  form-control-sm @error('origin_id') is-invalid @enderror" id="origin" required>
                                        <option value="">Select Purity</option>
                                        @foreach($origins as $origin)
                                            <option   value="{{ $origin->rate }}"  >{{ $origin->name }}</option>
                                        
                                        @endforeach
                                    </select>
                                    @error('origin_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                 
                                </div>
                            </div>
                           
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category_id" onchange="MinPecas(this.value)" class="form-control  form-control-sm @error('category_id') is-invalid @enderror" id="">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                     
                                            @if($category->parent_id==7)<option value="{{ $category->id }}" >{{ $category->name }}(Women Jewels)</option>
                                      @elseif($category->parent_id==8)<option value="{{ $category->id }}" >{{ $category->name }}(Men Jewels)</option>
                                      @elseif($category->parent_id==2)<option value="{{ $category->id }}" >{{ $category->name }}(Diamond)</option>
                                      @else<option value="{{ $category->id }}" >{{ $category->name }}</option>
                                      @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                          <div class="col-md-6" style="display:none" id="ifYesd">
                              
                                   
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
                                    @error('certification_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                 
                             
                            </div>
                          <div class="col-md-6" style="display:none" id="ifYesdd">
                              
                                   
                                 <div class="form-group select2-blue">
                                    <label for="">Size Available</label>
                                    <select name="size_ids[]" class="form-control select2 form-control-sm" multiple id="" id="">
                                       
                                        <option value="">Select Bangle Size</option>
                                       <option value="2.0''- 51 mm">2.0'' - 51 mm</option>
                                       <option value="2.1''- 53 mm">2.1'' - 53 mm</option>
                                       <option value="2.2''- 54 mm">2.2'' - 54 mm</option>
                                       <option value="2.3''- 54 mm">2.3'' - 54 mm</option>
                                       <option value="2.4''- 57 mm">2.4'' - 57 mm</option>
                                       <option value="2.5''- 59 mm">2.5'' - 59 mm</option>  
                                      
                                    </select>
                                    @error('certification_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                 
                             
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Short Description</label>
                                    <textarea name="short_description" id="" cols="" rows="" class="form-control form-control-sm @error('short_description') is-invalid @enderror" placeholder="Enter Description">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Long Description</label>
                                    <textarea name="long_description" id="" cols="" rows="" class="form-control form-control-sm @error('long_description') is-invalid @enderror" placeholder="Enter Description">{{ old('long_description') }}</textarea>
                                    @error('long_description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                           <div class="col-md-6">
                              <label for="">Price Breakup:</label>
                                <div class="form-group">
                                   Gold Price:&nbsp;<input class="col-md-3  form-control form-control-sm @error('gold_price') is-invalid @enderror" type="text" onchange="add_making()" name="gold_price" style="display: initial;" 
                                           value="0" id="gold" readonly>
                                    @error('gold_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                   
                                    &emsp;&emsp; Stone Price:&nbsp;
                                  <input class="stone_price col-md-3 form-control  form-control-sm @error('stone_Price') is-invalid @enderror"  type="text"  onchange="add_number()" name="Stone_Price" id="stone" style="display: initial;" readonly>
                                   @error('stone_Price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                            </div>
                          <div class="col-md-6">
                              <label for="">   &nbsp;</label>
                                <div class="form-group">
                                   
                                    Value Added:&nbsp;<input onkeyup="add_making()" class="col-md-3 form-control form-control-sm " name="value_added_single"  type="text"  id="making_prcnt_gram" value="0" 
                                                        style="display: initial;" >
                                  <select name="gram_percent"   onchange="add_making()"class=" col-md-3 form-control form-control-sm"  id="gram_percent" style="display: initial;">
                                       
                                       
                                            <option value="gram" >Gram</option>
                                      <option value="percent" >%</option>
                                       
                                    </select>
                                 
                                 
                                </div>
                            </div>
                           <div class="col-md-6">
                              <label for="">   &nbsp;</label>
                              <div class="form-group">
                               Value Price:&nbsp; <input onblur="add_number()" onpaste="add_number()" class="col-md-3 form-control form-control-sm @error('value_Added') is-invalid @enderror" type="text"   value="0" name="Value_Added" id="hjk"
                                                        style="display: initial;"class="form-control form-control-sm @error('value_Added') is-invalid @enderror"  readonly>
                                   @error('value_Added')
                                    <div class="text-danger">must be number</div>
                                    @enderror
                             &emsp;&emsp;&emsp;&emsp; &emsp;GST:&nbsp;<input  type="text" class="col-md-3 form-control form-control-sm @error('gst') is-invalid @enderror"  style="display: initial;" name="GST" id="gst"  readonly>
                                  @error('gst')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                          </div>
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Rate *</label>
                                    <input type="text" name="rate" class="form-control form-control-sm @error('rate') is-invalid @enderror" placeholder="Enter Rate"  id="total" readonly>
                                    
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
                    <div class="card-footer text-right">
                        <button type="submit" id="save"class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
     var gst = Math.round(results);
       document.getElementById("gst").value = gst;
   
     
     var totals=goldprice+gst+value+stone;
    
        var total=  Math.round(totals);
      document.getElementById("total").value = total;
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
