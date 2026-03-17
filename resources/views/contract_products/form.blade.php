<div class="modal fade" id="cp_modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog"><!-- Log on to codeastro.com for more projects! -->
        <div class="modal-content">
            <form id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
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
                            <label>Company Name</label>
                            <input type="text" class="form-control" id="cpname" name="cpname" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            {!! Form::select('category_id', $categorys, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Category --', 'id' => 'category_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label>Product Model</label>
                            <input type="text" class="form-control" id="pmodel" name="pmodel" required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label>Serial No</label>
                            <input type="text" class="form-control" id="srno" name="srno" required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="0.00" value="0.00">
                            <span class="help-block with-errors"></span>
                        </div>


                        <!-- <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                            <img src="{{ URL::asset('noImage.png') }}" id="imagePreview" alt="Product Image" width="200" style="display: block;" />
                            <span class="help-block with-errors"></span>
                        </div> -->

                        <div class="form-group">
                            <label>Client/Customer </label>
                            {!! Form::select('cust_id', $customers, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Customer --', 'id' => 'cust_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label>Agreement Status</label>
                            <select name="agrStatus" id="agrStatus" class="form-control" placeholder="Select Contract Type...">
                                <option value="Rental">Rental</option>
                                <option value="FSMA">FSMA</option>
                                <option value="SSMA">SSMA</option>
                                <option value="C&M">C&M</option>
                                <option value="Other">Other</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label>Agreement No/ID</label>
                            <input type="text" class="form-control" id="agrNo" name="agrNo" placeholder="N/A" value="N/A">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label>Agreement Start Date (DD/MM/YYYY)</label>
                            <input type="text" class="form-control" id="agrDos" name="agrDos" placeholder="N/A" value="N/A">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label>Agreement End Date (DD/MM/YYYY)</label>
                            <input type="text" class="form-control" id="agrDoe" name="agrDoe" placeholder="N/A" value="N/A">
                            <span class="help-block with-errors"></span>
                        </div>


                        <div class="form-group">
                            <label>Remark</label>
                            <textarea class="form-control" id="remark" name="remark" rows="3" cols="50" autofocus>N/A
                            </textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
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
</div><!-- Log on to codeastro.com for more projects! -->
<!-- /.modal -->

<!-- <script>
    const chooseFile = document.getElementById("image");
    const imgPreview = document.getElementById("previewImage");
    chooseFile.addEventListener("change", function() {
        getImgData();
    });


    function getImgData() {
        const files = chooseFile.files[0];
        console.log(files);
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                imgPreview.style.display = "block";
                imgPreview.innerHTML = '<img src="' + files + '" />';
            });

        }
    }
</script> -->
<!-- <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script> -->