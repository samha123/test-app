<div class="modal fade" id="addItemModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add  New Gemstone</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('admin.certification.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Enter Name" name="name" required>
                    </div>
                     <label for="">Price</label> 
             <div class="form-group">
         
            <input type="text" class="col-md-6 form-control form-control-sm" placeholder="Enter Price" style="display: initial;" id="a" onkeyup="add_making()"  required>
          <input type="hidden" class="col-md-4 form-control form-control-sm" name="price" id="c">
          <select name="gram_carat"  class="col-md-4 form-control form-control-sm " style="display: initial;" onchange="add_making()"  id="b" >
                                      <option value="" >select Gram/Carat</option>
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
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
