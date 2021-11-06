<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Update {{ $service->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('service.update',$service->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <!-- number -->
          <div class="col-md-6 col-12 form-group">
              <label for="number">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $service->name }}">
          </div>
  
          <!-- image -->
          <div class="col-md-6 col-12 form-group">
              <label for="image" >Image</label>
              <img src="{{ asset('images/service/'.$service->image) }}" alt="{{ $service->name }}" style="width: 100px;heigh:80px;">
              <input type="file" class="form-control" name="image">
          </div>
  
          <!-- position -->
          <div class="col-md-6 col-12 form-group">
              <label for="position" >Position</label>
              <input type="number" class="form-control" name="position" value="{{ $service->position }}">
          </div>
  
            <!-- status -->
            <div class="col-md-6 col-12 form-group">
                <label>Status</label>
                <select class="form-control select2" name="is_active">
                    <option value="1" @if( $service->is_active == true ) selected @endif >Active</option>
                    <option value="0" @if( $service->is_active == false ) selected @endif >Inactive</option>
                </select>
            </div>

          <div class="col-md-12 form-group text-right">
              <button type="submit" class="btn btn-outline-dark">
                  Update
              </button>
          </div>
  
      </div>
    </form>
  
  </div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#largeModal')
        });
    });
</script>