<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog"><!-- Log on to codeastro.com for more projects! -->
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>


                <div class="modal-body">
                    <input type="hidden" id="id" name="id">


                    <div class="box-body">
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" class="form-control" id="staffName" name="staffName"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Date of Birth</label>
                            <input type="text" class="form-control" id="dob" name="dob"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label >Address</label>
                            <input type="text" class="form-control" id="address" name="address"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Email</label>
                            <input type="email" class="form-control" id="email" name="email"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Phone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Date of Joining</label>
                            <input type="text" class="form-control" id="doj" name="doj"  autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Date of Leaving</label>
                            <input type="text" class="form-control" id="dol" name="dol" placeholder="N/A" value="N/A" autofocus>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Remark</label>
                            <textarea class="form-control" id="remark" name="remark" rows="3" cols="50" autofocus>N/A
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>

                    </div><!-- Log on to codeastro.com for more projects! -->
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
