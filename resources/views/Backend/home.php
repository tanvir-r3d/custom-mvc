<?php partial_asset('layouts/head_section'); ?>
<form action="">
  <div class="row">

    <div class="col-md-3">
      <label for="buyer">Buyer</label>
      <input type="text" class='form-control form-control-sm' id="buyer">
    </div>

    <div class="col-md-3">
      <label for="amount">Amount</label>
      <input type="number" class='form-control form-control-sm' id="amount">
    </div>

    <div class="col-md-3">
      <label for="receipt_id">Receipt Id</label>
      <input type="number" class='form-control form-control-sm' id="receipt_id">
    </div>

    
  </div>
</form>
<?php partial_asset('layouts/footer_section'); ?>