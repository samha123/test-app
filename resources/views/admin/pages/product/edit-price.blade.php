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
  .clicker {
 
width:100px;

outline:none;
cursor:pointer;
}
  .hiddendiv{

height:435px;
 
   
  
    
    margin-bottom: 1em;
    max-height: 435px;
   

}
 
 </style>
@endpush
@section('content')
<main onload="add_number()">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.product.price.update', $product->id) }}" method="post" enctype="multipart/form-data" id="form1">
                    @csrf
                
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Gross Weight</label>
                                    <input type="text" name="weight" onkeyup="add_weight()"  id="weight" class="form-control form-control-sm @error('weight') is-invalid @enderror" placeholder="Enter Weight" value="{{ old('weight',$product->weight) }}" >
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
           <input type="hidden"  id="total{{$certification->id}}"   value="0" name='price{{ $certification->id }}'class="stone_price_one form-control  "   placeholder="{{$certification->name}} total price"/>
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
                                
                                    <input type="text" name="stone_weight_total"  id="stone_weight" onchange="add_weight();"class="form-control form-control-sm @error('stone_weight_total') is-invalid @enderror" placeholder="Enter Stone Weight" value="" readonly>
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
                                    <select name="origin_id" onchange="add_number()" class="form-control select2 form-control-sm @error('origin_id') is-invalid @enderror" id="origin"  >
                                        <option value="">Select Purity</option>
                                        @foreach($origins as $origin)
                                            <option   value="{{ $origin->rate }}"{{ old('origin_id',$product->origin_id) === $origin->rate ? 'selected' : '' }}  >{{ $origin->name }}</option>
                                        
                                        @endforeach
                                    </select>
                                    @error('origin_id')
                                    <div class="text-danger">Gold Purity Required</div>
                                    @enderror
                                 
                                </div>
                            </div>
                           
                           
                           
                           
                           <div class="col-md-6">
                              <label for="">Price Breakup:</label>
                                <div class="form-group">
                                   Gold Price:&nbsp;<input class="col-md-2  form-control form-control-sm @error('gold_price') is-invalid @enderror" type="text" onchange="add_making()" name="gold_price" style="display: initial;" 
                                           value="0" id="gold" readonly>
                                    @error('gold_price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                   
                                    &nbsp;&emsp; Stone Price:&nbsp;
                                  <input class="stone_price col-md-2 form-control  form-control-sm @error('stone_Price') is-invalid @enderror" value="" type="text"  onchange="add_number()" name="Stone_Price" id="stone" style="display: initial;"readonly>
                                   @error('stone_Price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror 
                                </div>
                            </div>
                          <div class="col-md-6">
                              <label for="">   &nbsp;</label>
                                <div class="form-group">
                                   
                                    Value Added:&nbsp;<input onkeyup="add_making()" class="col-md-2 form-control " name="value_added_single"  type="text"  id="making_prcnt_gram" value="0" 
                                                        style="display: initial;" >
                                  <select name="gram_percent"   onchange="add_making()"class=" col-md-2 form-control"  id="gram_percent" style="display: initial;">
                                       
                                       
                                            <option value="gram" >Gram</option>
                                      <option value="percent" >%</option>
                                       
                                    </select>
                                  <input onblur="add_number()" onpaste="add_number()" class="col-md-2 form-control form-control-sm @error('value_Added') is-invalid @enderror" type="text"   value="0" name="Value_Added" id="hjk"
                                                        style="display: initial;"class="form-control form-control-sm @error('value_Added') is-invalid @enderror"  readonly>
                                   @error('value_Added')
                                    <div class="text-danger">must be number</div>
                                    @enderror
                                  &nbsp;&emsp; GST:&nbsp;<input  type="text" class="col-md-2 form-control form-control-sm @error('gst') is-invalid @enderror"  style="display: initial;" name="GST" id="gst"  readonly>
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
                           
                            
                    <div class=" text-right">
                        <button type="submit" id="pricesave" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
               
                
            </div>
                         
        </div>
    </div>     
                
         </form>         
               
           
               
                      
                    
           &nbsp;&nbsp;  
           
      

 

	

    
                        
                   
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
      <script>
$(document).ready(
    function(){
        $("#clicker").click(function () {
            $("#hiddendiv").show();
        });

    });
</script>
@endpush


   