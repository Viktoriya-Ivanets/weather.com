<!-- Search content -->
<!-- main row -->
<div class="row d-block ml-5 mr-5">
    <?php if (!empty($search_items)) : ?>
        <!-- header row -->
        <div class="row d-flex justify-content-center align-items-center">
            <h4> Founded results:</h4>
        </div>
        <!-- /.row -->
        <?php foreach ($search_items as $search_item) : ?>
            <!-- link row -->
            <div class="row">
                <h4><a class="text-decoration-none" href="index.php?city=<?= $search_item->name; ?>"><?= $search_item->name; ?></a></h4>
            </div>
            <!-- /.row -->
            <!-- detailed info row -->
            <div class="row mb-2">
                <h5><small><?= $search_item->name; ?>, <?= $search_item->region; ?>, <?= $search_item->country; ?></small></h5>
            </div>
            <!-- /.row -->
        <?php endforeach; ?>
    <?php else : ?>
        <!-- no results row -->
        <div class="row d-flex justify-content-center align-items-center">
            <h4>No results found</h4>
        </div>
        <!-- /.row -->
    <?php endif; ?>
</div>
<!-- /.row -->
