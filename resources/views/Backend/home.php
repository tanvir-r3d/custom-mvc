<?php partial_asset('layouts/head_section'); ?>
<form action="">
  <div class="row">

    <div class="col-md-3">
      <label for="buyer">Buyer</label>
      <input type="text" class='form-control form-control-sm' id="buyer" name="buyer">
    </div>

    <div class="col-md-3">
      <label for="amount">Amount</label>
      <input type="number" class='form-control form-control-sm' id="amount" name="amount">
    </div>

    <div class="col-md-3">
      <label for="receipt_id">Receipt Id</label>
      <input type="text" class='form-control form-control-sm' id="receipt_id" name="receipt_id">
    </div>

    <div class="col-md-3">
      <label for="buyer_email">Buyer Email</label>
      <input type="text" class='form-control form-control-sm' id="buyer_email" name="buyer_email">
    </div>

    <div class="col-md-3">
      <label for="city">City</label>
      <input type="text" class='form-control form-control-sm' id="city" name="city">
    </div>

    <div class="col-md-3">
      <label for="phone">Phone</label>
      <input type="text" class='form-control form-control-sm' id="phone" name="phone">
    </div>

    <div class="col-md-3">
      <label for="entry_by">Entry By</label>
      <input type="text" class='form-control form-control-sm' id="entry_by" name="entry_by">
    </div>

  </div>

  <div id="item-div">
    <div class="row">
      <div class="col-md-3">
        <label for="items">Items</label>
        <input type="text" class='form-control form-control-sm' id="items" name="items[]">
      </div>
      <div class="col-md-1">
        <label>&nbsp;</label>
        <button class="btn btn-success btn-xs form-control" id="addItem" type="button"><strong>ADD</strong></button>
      </div>
    </div>
  </div>

  <center>
    <button class='btn btn-sm btn-success'>Save</button>
    <a class="btn btn-sm btn-info" href="">Refresh</a>
  </center>
</form>
<?php partial_asset('layouts/footer_section'); ?>

<script>
  $("#addItem").click(function () {
    $("#item-div").append(
      `
      <div class="row">
      <div class="col-md-3">
        <label for="items">Items</label>
        <input type="text" name='items[]' class='form-control form-control-sm' id="items">
      </div>
       <div class="col-md-1">
        <label>&nbsp;</label>
        <button class="btn btn-danger btn-xs form-control" id="delItem"
          type="button"><strong>DEL</strong></button>
      </div>
    </div>
      `
    )
  })

  $(document).on('click', "#delItem", function () {
    $(this).parent().parent().remove()
  });
</script>