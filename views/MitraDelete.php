<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$MitraDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { mitra: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmitradelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmitradelete")
        .setPageId("delete")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script<?= Nonce() ?>>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmitradelete" id="fmitradelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mitra">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
        <th class="<?= $Page->mitra_id->headerCellClass() ?>"><span id="elh_mitra_mitra_id" class="mitra_mitra_id"><?= $Page->mitra_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_mitra->Visible) { // nama_mitra ?>
        <th class="<?= $Page->nama_mitra->headerCellClass() ?>"><span id="elh_mitra_nama_mitra" class="mitra_nama_mitra"><?= $Page->nama_mitra->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis_mitra->Visible) { // jenis_mitra ?>
        <th class="<?= $Page->jenis_mitra->headerCellClass() ?>"><span id="elh_mitra_jenis_mitra" class="mitra_jenis_mitra"><?= $Page->jenis_mitra->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th class="<?= $Page->alamat->headerCellClass() ?>"><span id="elh_mitra_alamat" class="mitra_alamat"><?= $Page->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
        <th class="<?= $Page->email->headerCellClass() ?>"><span id="elh_mitra_email" class="mitra_email"><?= $Page->email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->telepon->Visible) { // telepon ?>
        <th class="<?= $Page->telepon->headerCellClass() ?>"><span id="elh_mitra_telepon" class="mitra_telepon"><?= $Page->telepon->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_bergabung->Visible) { // tanggal_bergabung ?>
        <th class="<?= $Page->tanggal_bergabung->headerCellClass() ?>"><span id="elh_mitra_tanggal_bergabung" class="mitra_tanggal_bergabung"><?= $Page->tanggal_bergabung->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_aktif->Visible) { // status_aktif ?>
        <th class="<?= $Page->status_aktif->headerCellClass() ?>"><span id="elh_mitra_status_aktif" class="mitra_status_aktif"><?= $Page->status_aktif->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
        <td<?= $Page->mitra_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->mitra_id->viewAttributes() ?>>
<?= $Page->mitra_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_mitra->Visible) { // nama_mitra ?>
        <td<?= $Page->nama_mitra->cellAttributes() ?>>
<span id="">
<span<?= $Page->nama_mitra->viewAttributes() ?>>
<?= $Page->nama_mitra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis_mitra->Visible) { // jenis_mitra ?>
        <td<?= $Page->jenis_mitra->cellAttributes() ?>>
<span id="">
<span<?= $Page->jenis_mitra->viewAttributes() ?>>
<?= $Page->jenis_mitra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <td<?= $Page->alamat->cellAttributes() ?>>
<span id="">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
        <td<?= $Page->email->cellAttributes() ?>>
<span id="">
<span<?= $Page->email->viewAttributes() ?>>
<?= $Page->email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->telepon->Visible) { // telepon ?>
        <td<?= $Page->telepon->cellAttributes() ?>>
<span id="">
<span<?= $Page->telepon->viewAttributes() ?>>
<?= $Page->telepon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_bergabung->Visible) { // tanggal_bergabung ?>
        <td<?= $Page->tanggal_bergabung->cellAttributes() ?>>
<span id="">
<span<?= $Page->tanggal_bergabung->viewAttributes() ?>>
<?= $Page->tanggal_bergabung->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_aktif->Visible) { // status_aktif ?>
        <td<?= $Page->status_aktif->cellAttributes() ?>>
<span id="">
<span<?= $Page->status_aktif->viewAttributes() ?>>
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" id="x_status_aktif_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->status_aktif->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->status_aktif->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_status_aktif_<?= $Page->RowCount ?>"></label>
</div>
</span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Result?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
?>
<?php if (!$Page->IsModal && !$Page->isExport()) { ?>
<script>
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fmitradelete.validateFields()){ew.prompt({title: ew.language.phrase("MessageDeleteConfirm"),icon:'question',showCancelButton:true},result=>{if(result) $("#fmitradelete").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
