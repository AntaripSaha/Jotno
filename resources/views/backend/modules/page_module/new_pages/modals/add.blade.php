<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add New Page</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">

  <form class="ajax-form" method="post" action="{{ route('new.page.add') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
          
        <!-- name -->
          <div class="col-md-12 col-12 form-group">
              <label for="name">Page Name</label>
              <input type="text" class="form-control" name="name" >
          </div>
      </div>
      <div class="row">
         <!-- description -->
         <div class="col-md-12 col-12 form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control div_editor1" name="description" >
        </div>
      </div>
      <div class="row">
          <div class="col-md-12 form-group text-right">
              <button type="submit" class="btn btn-outline-dark">
                  Add
              </button>
          </div>

      </div>
  </form>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>



<link rel="stylesheet" href="{{ asset('backend/css/rich_text_editor/rte_theme_default.css') }}">
<script src="{{ asset('backend/js/rich_text_editor/all_pluggins.js') }}"></script>
<script src="{{ asset('backend/js/rich_text_editor/rte.js') }}"></script>
<script>
    var editor1 = new RichTextEditor(".div_editor1");
    var editor2 = new RichTextEditor(".div_editor2");
</script>