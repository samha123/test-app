@foreach($product as $product)
<form action="{{ route('admin.product.diamond.discount.update', $product->id) }}" method="POST">
    @csrf
   
    <div class="modal-body">
        <div class="form-group">
            <label for="">Discount Amount</label>
            <input type="text"  class="form-control form-control-sm" id="discountd"placeholder="Enter Discount Amount/carat" value="" name="diamond_price" required>
          
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
    </div>
</form>
@endforeach