<div class="symbol-group symbol-hover">

<?php foreach($terlambat as $row) : ?>
    <?php if($row->image_profile != null) : ?>
    <div class="symbol symbol-circle symbol-50px">
        <img src="<?= base_url(); ?>/assets/images/users/<?= $row->image_profile; ?>" alt="" />
    </div>
    <?php else: ?>
    <div class="symbol symbol-circle symbol-50px">
        <div class="symbol-label fs-2 fw-semibold bg-danger text-inverse-danger"><?= strtoupper(substr($row->first_name, 0, 1)); ?><?= strtoupper(substr($row->last_name, 0, 1)); ?></div>
    </div>
    <?php endif; ?>
<?php endforeach; ?>

</div>