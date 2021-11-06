<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Test</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('test.add') }}">
        @csrf
        <div class="row">

            <!-- name -->
            <div class="col-md-12 col-12 form-group">
                <label for="name">Test Type</label>
                <input type="text" class="form-control" name="test_type" >
            </div>

            <!-- all test list -->
            <div class="col-md-12 form-group test-list">

                <!-- item start -->
                <div class="row">

                    <div class="col-md-6 form-group">
                        <label>Test Name</label>
                        <input type="text" class="form-control" name="test_name[]" >
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Test Price</label>
                        <input type="text" class="form-control" name="test_price[]" >
                    </div>

                </div>
                <!-- item end -->

            </div>

            <!-- add test -->
            <div class="col-md-12 form-group">
                <button type="button" class="btn btn-primary" id="addNewTest">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

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


<script>
    $(document).ready(function(){
        $("#addNewTest").click(function(){
            $(".test-list").append(`
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Test Name</label>
                        <input type="text" class="form-control" name="test_name[]" >
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Test Price</label>
                        <input type="text" class="form-control" name="test_price[]" >
                    </div>
                    <div class="col-md-1 form-group">
                        <label></label>
                        <button type="button" class="btn btn-danger removeItem">
                            <i class='fas fa-times'></i>
                        </button>
                    </div>
                </div>
            `);
        })
    })
    $(document).on("click",".removeItem",function(){
        let $this = $(this)
        $this.closest(".row").remove()
    })
</script>