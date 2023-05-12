<form action="{{ route('admin.origin.update', $origin->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="">Rate</label>
            <input type="text" class="form-control form-control-sm" placeholder="Enter rate" value="{{ $origin->rate}}" name="name" required>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
    </div>
</form>
