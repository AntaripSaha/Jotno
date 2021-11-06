<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ $test_type->name }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('test.edit',$test_type->id) }}">
        @csrf
        <div class="row">

            <!-- name -->
            <div class="col-md-12 col-12 form-group">
                <label for="name">Test Type</label>
                <input type="text" class="form-control" name="test_type" value="{{ $test_type->name }}">
            </div>

            <!-- status -->
            <div class="col-md-12 col-12 form-group">
                <label>Status</label>
                <select class="form-control select2" name="is_active">
                    <option value="1" @if( $test_type->is_active == true ) selected @endif >Active</option>
                    <option value="0" @if( $test_type->is_active == false ) selected @endif >Inactive</option>
                </select>
            </div>

            <!-- all test list -->
            <div class="col-md-12 form-group test-list">

                <!-- item start -->
                @foreach( $test_type_lists as $test_type_list )
                <div class="row">

                    <div class="col-md-4 form-group">
                        <label>Test Name</label>
                        <input type="text" class="form-control" name="exists_test_name[]" value="{{ $test_type_list->name }}">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Test Price</label>
                        <input type="text" class="form-control" name="exists_test_price[]" value="{{ $test_type_list->price }}">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Status</label>
                        <select class="form-control" name="exists_test_status[]">
                            <option value="1" @if( $test_type_list->is_active == true ) selected @endif >Active</option>
                            <option value="0" @if( $test_type_list->is_active == false ) selected @endif >Inactive</option>
                        </select>
                    </div>

                </div>
                @endforeach
                <!-- item end -->

            </div>


            <!-- add test -->
            <div class="col-md-12 form-group">
                <button type="button" class="btn btn-primary addNewTest" id="">
                    <i class="fas fa-plus"></i>
                </button>
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


<script>
    $(document).ready(function(){
        $(".addNewTest").click(function(){
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

