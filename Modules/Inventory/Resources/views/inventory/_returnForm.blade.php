<style>
    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 1400px !important;
        }
    }

    .select2-container--classic .select2-selection--single,
    .select2-container--default .select2-selection--single {
        height: 31px !important;
        padding: 0 1px !important;
    }

    .select2-container--classic .select2-selection--single,
    .select2-container--default .select2-selection--single {
        height: 29px !important;
        padding: 0 1px !important;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 21px;
    }

</style>
<form id="dataFormUpdate" name="dataFormUpdate">
    <input type="hidden" name="data_id" id="data_id">
    <table class="beforeGrid" border="1">
        <tr>
            <th>Supplier</th>
            <th style="width:10%">PO No</th>
            <th>Receive No</th>
            <th>Receive Date</th>
            <th style="width:20%">Return Date</th>
        </tr>
        <tr>
            <td id="supplierName"></td>
            <td><input type="text" id="po_no" name="po_no"></td>
            <td id="receiveNo"></td>
            <td id="receiveDate"></td>
            <td><input type="text" id="return_date" , name="return_date"></td>
        </tr>
    </table>
    <table id="dataGrid" class="beforeGrid mt-2" border="1">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Receive Qty</th>
                <th>Previous Return Qty</th>
                <th>Return Qty</th>
                <th>Remaining Return Qty</th>
            </tr>
        </thead>
        <tbody id="return_details"></tbody>
    </table>
    <div class="col-sm-offset-2 col-sm-10 mt-2">
        <button type="submit" class="btn btn-primary" id="returnBtn" value="create">Save</button>
    </div>
</form>

<script>
    function calculateReturn(element) {
        var remainingQty = parseFloat(element.parents('tr').find('#remaining_return_qty').val());
        var recvQty = parseFloat(element.parents('tr').find('#return_qty').val());
        if (recvQty > remainingQty) {
            alert("Sorry! Invalid Input");
            element.parents('tr').find('#return_qty').val("");
            return false;
        }
    }



</script>
