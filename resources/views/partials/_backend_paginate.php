<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($collection->onFirstPage()) { ?>
            <li class="page-item disabled">
                <span class="page-link">&laquo; Previous</span>
            </li>
        <?php } else { ?>
            <li class="page-item">
                <a class="page-link" href="<?= baseUri() . '/list' . $collection->previousPageUrl() ?>" rel="prev">&laquo;
                    Previous</a>
            </li>
        <?php } ?>

        <?php foreach ($collection->getUrlRange(1, $collection->lastPage()) as $page => $url) { ?>
            <?php if ($page == $collection->currentPage()) { ?>
                <li class="page-item active" aria-current="page">
                    <span class="page-link"><?= $page ?></span>
                </li>
            <?php } else { ?>
                <li class="page-item">
                    <a class="page-link" href="<?= baseUri() . '/list' . $url ?>"><?= $page ?></a>
                </li>
            <?php } ?>
        <?php } ?>

        <?php if ($collection->hasMorePages()) { ?>
            <li class="page-item">
                <a class="page-link" href="<?= baseUri() . '/list' . $collection->nextPageUrl() ?>" rel="next">Next
                    &raquo;</a>
            </li>
        <?php } else { ?>
            <li class="page-item disabled">
                <span class="page-link">Next &raquo;</span>
            </li>
        <?php } ?>
    </ul>
</nav>