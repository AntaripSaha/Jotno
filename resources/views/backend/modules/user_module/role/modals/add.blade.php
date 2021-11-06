<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('role.add') }}">
        @csrf
        <div class="row">

            <!-- name -->
            <div class="col-md-12 col-12 form-group">
                <label for="name">Role Name</label>
                <input type="text" class="form-control" name="name" >
            </div>

            <!-- permission -->
            <div class="col-md-12 form-group" style="column-count: 3;column-gap: 0;">
                <div class="row">

                    @foreach( App\Models\UserModule\Module::get() as $module )
                    @foreach( $module->permission->where("key",$module->key) as $module_permission )
                    
                    <div class="permission_block" style="padding: 0">
                        <p style="
                            border-bottom: 1px solid #e0d9d9;
                            background: #e8e4e4;
                        ">
                            <label>
                                <input type="checkbox" class="module_check" name="permission[]"
                                    value="{{ $module_permission->id }}" />
                                <span>{{ $module->name }}</span>
                            </label>
                        </p>
                        <div class="sub_module_block">
                            <ul>
                                @foreach( $module->permission->where("key","!=",$module->key) as $sub_module_permission )
                                <p>
                                    <label>
                                        <input type="checkbox" class="sub_module_check" name="permission[]"
                                            disabled value="{{ $sub_module_permission->id }}" />
                                        <span>{{ $sub_module_permission->display_name }}</span>
                                    </label>
                                </p>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    @endforeach
                    @endforeach
                </div>
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
    $(".module_check").click(function (e) {
        let $this = $(this);
        if (e.target.checked == true) {
            $this.closest(".permission_block").find(".sub_module_block").find(".sub_module_check").removeAttr(
                "disabled")
        } else {
            $this.closest(".permission_block").find(".sub_module_block").find(".sub_module_check").attr(
                "disabled", "disabled")
        }
    })
</script>
