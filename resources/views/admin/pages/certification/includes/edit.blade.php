<form action="{{ route('admin.certification.update', $certification->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control form-control-sm" placeholder="Enter Name" value="{{ $certification->name }}" name="name" required>
          </div>
           <label for="">Price</label>
        
       <div class="form-group">
           
            <input type="text" class="col-md-6 form-control form-control-sm" placeholder="Enter Price" value="{{ $certification->price * 0.2 }}"style="display: initial;" id="aa" 
                   onkeyup="add_makings()"  required>
          <input type="hidden" class="col-md-4 form-control form-control-sm" value="{{ $certification->price }}" name="price" id="ca">
          <select name="gram_carat"  class="col-md-3 form-control form-control-sm " style="display: initial;" onchange="add_makings()"  id="ba" >
                                        <option value="carat" >Carat</option>
                                      <option value="gram" >Gram</option>
           
                                  </select>
        </div>
     
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
    </div>
</form>
