@foreach($product as $product)
<form action="{{ route('admin.product.gold.discount.update', $product->id) }}" method="POST">
    @csrf
   
    <div class="modal-body">
        <div class="form-group">
            <label for="">Discount Percentage</label>
            <input type="text" class="form-control form-control-sm" onkeyup="add_discount()" id="discount"placeholder="Enter Discount Percentage" value="{{$product->value_discount_percent}}" name="value_discount_percent" required>
           <input type="hidden" class="form-control form-control-sm" id="value" value="{{$product->Value_Added}}" name="" >
           <input type="hidden" class="form-control form-control-sm" id="discount_mc"  value="{{$product->discounted_value }}" name="discounted_value" >
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
    </div>
</form>
@endforeach