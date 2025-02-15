<?php partial_asset('layouts/head_section'); ?>

<div class="row" style="margin: 10px 0;">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Buyer Details</h5>
        <a class="btn btn-info btn-sm" href="<?php echo baseUri() ?>/list">List</a>
      </div>
      <div class="card-body">
        <form action="<?php echo baseUri() ?>" method="post">
          <div class="row">

            <div class="col-md-3">
              <label for="buyer">Buyer</label>
              <input type="text" class='form-control form-control-sm' id="buyer" name="buyer">
              <span id="buyer_validation" class="text-danger"></span>
            </div>

            <div class="col-md-3">
              <label for="amount">Amount</label>
              <input type="number" class='form-control form-control-sm' id="amount" name="amount">
              <span id="amount_validation" class="text-danger"></span>
            </div>

            <div class="col-md-3">
              <label for="receipt_id">Receipt Id</label>
              <input type="text" class='form-control form-control-sm' id="receipt_id" name="receipt_id">
              <span id="receipt_id_validation" class="text-danger"></span>
            </div>

            <div class="col-md-3">
              <label for="buyer_email">Buyer Email</label>
              <input type="text" class='form-control form-control-sm' id="buyer_email" name="buyer_email">
              <span id="buyer_email_validation" class="text-danger"></span>
            </div>

            <div class="col-md-3">
              <label for="city">City</label>
              <input type="text" class='form-control form-control-sm' id="city" name="city">
              <span id="city_validation" class="text-danger"></span>
            </div>

            <div class="col-md-3">
              <label for="phone">Phone</label>
              <input type="text" class='form-control form-control-sm' id="phone" name="phone">
              <span id="phone_validation" class="text-danger"></span>
            </div>

            <div class="col-md-3">
              <label for="entry_by">Entry By</label>
              <input type="text" class='form-control form-control-sm' id="entry_by" name="entry_by">
              <span id="entry_by_validation" class="text-danger"></span>
            </div>

          </div>

          <div id="item-div">
            <div class="row">
              <div class="col-md-3">
                <label for="items">Items</label>
                <input type="text" class='form-control form-control-sm' id="items" name="items[]">
                <span id="items_0_validation" class="text-danger"></span>
              </div>
              <div class="col-md-1">
                <label>&nbsp;</label>
                <button class="btn btn-success btn-sm form-control form-control-sm" id="addItem"
                  type="button"><strong>ADD</strong></button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <label for="note">Note</label>
              <textarea class='form-control form-control-sm' id="note" name="note"></textarea>
              <span id="note_validation" class="text-danger"></span>
            </div>
          </div>
          <center>
            <button class='btn btn-sm btn-success' type="button" id="submitBtn">Save</button>
            <a class="btn btn-sm btn-info" href="">Refresh</a>
          </center>
        </form>
      </div>
    </div>
  </div>
</div>

<?php partial_asset('layouts/footer_section'); ?>

<script>
  let itemRowCounter = 1;
  $("#addItem").click(function () {
    $("#item-div").append(
      `
      <div class="row">
      <div class="col-md-3">
        <label for="items">Items</label>
        <input type="text" name='items[]' class='form-control form-control-sm' id="items">
        <span id="items_${itemRowCounter++}_validation" class="text-danger"></span>
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

  $("#submitBtn").click(function () {
    if (!validateForm()) {
      toastr.warning('Form data is invalid');
      return;
    }

    const submissionCookie = getCookie('form_submitted');
    if (submissionCookie) {
      toastr.warning('Buyer Details can stored once in 24 hours.');
      return;
    }

    $.ajax({
      url: "<?php echo baseUri() ?>/store",
      type: "POST",
      dataType: "json",
      data: $("form").serialize(),
      success: function (response) {

        if (response.error) {
          toastr.warning('Form data is invalid');
          validateForm();
          return;
        }
        toastr.success('Successfully stored.');
        setCookie('form_submitted', 'true', 24);
        setTimeout(() => {
          location.reload();
        }, 5000);
      },
      error: function (error) {
        toastr.error('Something went wrong.');
        console.log(error);
      }
    })

  });

  function validateForm() {
    const formData = $("form").serializeArray();
    let itemCounter = 0;
    let isInvalid = false;
    formData.forEach(function (form) {
      if (!form.name.startsWith('items')) {
        $(`#${form.name}_validation`).text('');
      } else {
        $(`#items_${itemCounter}_validation`).text('')
      }

      if (form.value.length <= 0) {
        if (!form.name.startsWith('items')) {
          $(`#${form.name}_validation`).text('This field is required');
          isInvalid = true;
        } else {
          $(`#items_${itemCounter}_validation`).text('This field is required')
          isInvalid = true;
        }
      }

      if (form.name === 'buyer') {
        if (!(form.value.length <= 20)) {
          $(`#${form.name}_validation`).text('Buyer can\'t be longer then 20 charecter');
          isInvalid = true;
        }
        if (!validateString(form.value)) {
          $(`#${form.name}_validation`).text('Buyer must be string, number or space');
          isInvalid = true;
        }
      }

      if (form.name === 'amount') {
        if (!validateNumber(form.value)) {
          $(`#${form.name}_validation`).text('Amount must be number');
          isInvalid = true;
        }
      }

      if (form.name === 'receipt_id') {
        if (!validateString(form.value)) {
          $(`#${form.name}_validation`).text('Receipt Id must be string, number or space');
          isInvalid = true;
        }
      }

      if (form.name === 'items[]') {
        if (!validateString(form.value)) {
          $(`#items_${itemCounter}_validation`).text('Item must be string, number or space');
          isInvalid = true;
        }
        itemCounter++;
      }

      if (form.name === 'buyer_email') {
        if (!validateEmail(form.value)) {
          $(`#${form.name}_validation`).text('Buyer email must be in email format');
          isInvalid = true;
        }
      }

      if (form.name === 'note') {
        if (form.value.length > 30) {
          $(`#${form.name}_validation`).text('Note can\'t be longer then 30 charecter');
          isInvalid = true;
        }
      }

      if (form.name === 'city') {
        if (!validateString(form.value)) {
          $(`#${form.name}_validation`).text('City must be string, number or space');
          isInvalid = true;
        }
      }

      if (form.name === 'phone') {
        if (!validateNumber(form.value)) {
          $(`#${form.name}_validation`).text('Phone must be number');
          isInvalid = true;
        }
      }

      if (form.name === 'entry_by') {
        if (!validateNumber(form.value)) {
          $(`#${form.name}_validation`).text('Entry by must be number');
          isInvalid = true;
        }
      }
    });
    return !isInvalid;
  }

  $(document).on('keydown', '#phone', function () {
    const val = $(this).val();
    if (val.length == 0) {
      $(this).val('880');
    }
  });

  function setCookie(name, value, hours) {
    const date = new Date();
    date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
    const expires = `expires=${date.toUTCString()}`;
    document.cookie = `${name}=${value}; ${expires}; path=/`;
  }

  function getCookie(name) {
    const cookieName = `${name}=`;
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
      let cookie = cookies[i].trim();
      if (cookie.startsWith(cookieName)) {
        return cookie.substring(cookieName.length, cookie.length);
      }
    }
    return null;
  }
</script>