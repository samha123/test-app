<form action="{{ route('admin.shape.update', $shape->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control form-control-sm" placeholder="Enter Name" value="{{ $shape->name }}" name="name" required>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
    </div>
</form>
