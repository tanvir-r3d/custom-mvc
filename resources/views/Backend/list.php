<?php partial_asset('layouts/head_section'); ?>

<div class="row" style="margin: 10px 0;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Buyer Details List</h5>
                <a class="btn btn-info btn-sm" href="<?= baseUri() ?>">Create</a>
            </div>
            <div class="card-body">
                <form class="search-form" style="margin-bottom: 5px;" action="<?php echo baseUri(); ?>/list"
                    method="get">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone" class="form-control form-control-sm"
                                placeholder="Enter phone number" value="<?= $_GET['phone'] ?? null ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="entry_by">Entry By:</label>
                            <input type="text" id="entry_by" name="entry_by" class="form-control form-control-sm"
                                placeholder="Enter entry ID" value="<?= $_GET['entry_by'] ?? null ?>">
                        </div>
                        <div class="col-md-1">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn btn-success form-control form-control-sm" value="Search">
                        </div>
                    </div>
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Buyer</th>
                            <th>Amount</th>
                            <th>Receipt Id</th>
                            <th>Buyer Email</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Entry By</th>
                            <th>Items</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $itemsPerPage = $buyerDetails->perPage();
                        $currentPage = $buyerDetails->currentPage();
                        $offset = ($currentPage - 1) * $itemsPerPage;
                        foreach ($buyerDetails as $key => $buyerDetail) {
                            ?>
                            <tr>
                                <td style="text-align:center"><?= $key + 1 + $offset ?></td>
                                <td><?= $buyerDetail['buyer'] ?></td>
                                <td><?= $buyerDetail['amount'] ?></td>
                                <td><?= $buyerDetail['receipt_id'] ?></td>
                                <td><?= $buyerDetail['buyer_email'] ?></td>
                                <td><?= $buyerDetail['city'] ?></td>
                                <td><?= $buyerDetail['phone'] ?></td>
                                <td><?= $buyerDetail['entry_by'] ?></td>
                                <td><?= $buyerDetail['item_names'] ?></td>
                                <td><?= $buyerDetail['note'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                <?php partial_asset('partials/_backend_paginate', ['collection' => $buyerDetails]); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php partial_asset('layouts/footer_section'); ?>