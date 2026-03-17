<div class="modal fade" id="ledger_modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
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
                            <label for="srNo">Serial No.</label>
                            <input type="text" class="form-control" id="srNo" name="srNo" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label>Date (YYYY/MM/DD)</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="date" name="date" required>
                            <span class="help-block with-errors"></span>
                        </div>
                        

                        <div class="form-group">
                            <label for="staff_id">Assigned Staff/Engineer </label>
                            {!! Form::select('staff_id', $staffs, null, ['class' => 'form-control select', 'placeholder' => '-- Select Staff/Engineer --', 'id' => 'staff_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label for="action_done">Action Done</label>
                            <input type="text" class="form-control" id="action_done" name="action_done">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group" id="partsSelection">
                            <div class="form-group col-md-4">
                                <label>Products & Price</label>
                                {!! Form::select('product_id', $products, null, ['class' => 'form-control select', 'placeholder' => '-- Choose Product --', 'id' => 'product_id']) !!}
                                <!-- <span class="help-block with-errors"></span> -->
                            </div>
                            <div class="form-group col-md-2" style="margin-left: 5px;">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty" min="1" placeholder="1" value="1">
                                <!-- <span class="help-block with-errors"></span> -->
                            </div>

                            <div class="form-group col-md-2" style="margin-left: 2px; margin-top:25px">
                                <label for="qty"></label>
                                <a onclick="SelectedItems()" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</a>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="appendedItems">Appended Items:</label>
                                    <select id="appendedItems" class="form-control" multiple>
                                        <!-- Appended items will be displayed here -->
                                    </select>
                                </div>
                            </div>


                        </div>

                        <!-- <div class="form-group"> -->
                        <div class="form-group text-center">
                            <label></label>
                            <a onclick="saveParts()" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Save Parts Used</a>
                            <a onclick= "clearParts()" class="btn btn-danger"><i class="fa fa-mi nus"></i>Clear</a>
                        </div>
                        <!-- </div> -->

                        <div class="form-group">
                            <label for="partsAndConsumables">Parts and Consumables Used</label>
                            <textarea rows="2" class="form-control" id="partsAndConsumables" name="partsAndConsumables"  readonly> No Parts / Consumables
                            </textarea>
                            
                        </div>
                        <!-- <div class="form-group">
                            <input type="hidden" id="itemsBeforeEdit" name="itemsBeforeEdit">
                        </div> -->

                        <div class="form-group">
                            <label for="totalSpent">Total Charges</label>
                            <input type="number" class="form-control" id="totalSpent" name="totalSpent" min="0" step="0.01" value="0.00", placeholder="0.00">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label for="preReading">Previous Reading</label>
                            <input type="number" class="form-control" id="preReading" name="preReading" min="0" value="0.00" placeholder="0">
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label for="todayReading">Todays Reading</label>
                            <input type="number" class="form-control" id="todayReading" name="todayReading" min="0" value="0.00" placeholder="0">
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label for="totalReading">Total Used Reading</label>
                            <input type="number" class="form-control" id="totalReading" name="totalReading" min="0" value="0.00" placeholder="0" readonly>
                            <span class="help-block with-errors"></span>
                        </div>


                        <div class="form-group">
                            <label for="remark">Remark</label>
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



<script>
    
    function SelectedItems() {
        var itemSelect = document.getElementById('product_id');
        var appendedItems = document.getElementById('appendedItems');
        qty = document.getElementById('qty').value;
        // Get selected options
        var selectedOptions = Array.from(itemSelect.selectedOptions);

        // Append selected options to the appended items select element
        selectedOptions.forEach(option => {
            // Create a new option element
            var newOption = document.createElement('option');
            newOption.value = option.value;
            newOption.text = option.text;
            if (newOption.text == '-- Choose Product --') {
                return 0;
            }
            // finalNewOption.text = newOption.text + " x " + qty
            // alert(finalNewOption)

            // Append the new option to the appendedItems select element
            newOption.text = option.text + ":" + qty;
            appendedItems.add(newOption);

            // Optionally, remove the option from the original select element
            option.remove();
        });



    }

    appendedItems.addEventListener('dblclick', (event) => {
        var itemSelect = document.getElementById('product_id');
        var appendedItems = document.getElementById('appendedItems');
        const option = event.target;
        if (option.tagName === 'OPTION') {
            // Create a new option element for the itemSelect select
            const newOption = document.createElement('option');
            newOption.value = option.value;
            newOption.text = option.text;
            undoText = newOption.text;
            let finalUndoText = undoText.split(':')[0];

            newOption.text = finalUndoText;
            // Append the new option to the itemSelect select element
            itemSelect.add(newOption);

            // Remove the option from the appendedItems select element
            option.remove();
        }
    });

    function saveParts() {

        
        const dropdown = document.getElementById('appendedItems');
        if(dropdown.options.length == 0)
        {
            document.getElementById('partsAndConsumables').value ="No Parts / Consumables";
            return;
        }
        const options = dropdown.options;
        const values = [];
        let finalParts='';
        for (let i = 0; i < options.length; i++) {
            values.push(options[i].value);
            finalParts = finalParts + options[i].text +", ";
        }
        document.getElementById('partsAndConsumables').value = finalParts;
        // console.log(values);
    }


    function clearParts(){
        partsAndConsumables
        document.getElementById("partsAndConsumables").value='No Parts / Consumables';

    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var result=0;
        function calUnits() {
            var input1 = parseFloat(document.getElementById('todayReading').value) || 0;
            var input2 = parseFloat(document.getElementById('preReading').value) || 0;
            result = input1 - input2;
            document.getElementById('totalReading').value = result;
        }

        document.getElementById('todayReading').addEventListener('input', calUnits);
        document.getElementById('preReading').addEventListener('input', calUnits);
    });
</script>