<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$KontakMitraDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontak_mitra: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fkontak_mitradelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fkontak_mitradelete")
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
<form name="fkontak_mitradelete" id="fkontak_mitradelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontak_mitra">
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
<?php if ($Page->kontak_id->Visible) { // kontak_id ?>
        <th class="<?= $Page->kontak_id->headerCellClass() ?>"><span id="elh_kontak_mitra_kontak_id" class="kontak_mitra_kontak_id"><?= $Page->kontak_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
        <th class="<?= $Page->mitra_id->headerCellClass() ?>"><span id="elh_kontak_mitra_mitra_id" class="kontak_mitra_mitra_id"><?= $Page->mitra_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_kontak->Visible) { // nama_kontak ?>
        <th class="<?= $Page->nama_kontak->headerCellClass() ?>"><span id="elh_kontak_mitra_nama_kontak" class="kontak_mitra_nama_kontak"><?= $Page->nama_kontak->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <th class="<?= $Page->jabatan->headerCellClass() ?>"><span id="elh_kontak_mitra_jabatan" class="kontak_mitra_jabatan"><?= $Page->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
        <th class="<?= $Page->email->headerCellClass() ?>"><span id="elh_kontak_mitra_email" class="kontak_mitra_email"><?= $Page->email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->telepon->Visible) { // telepon ?>
        <th class="<?= $Page->telepon->headerCellClass() ?>"><span id="elh_kontak_mitra_telepon" class="kontak_mitra_telepon"><?= $Page->telepon->caption() ?></span></th>
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
<?php if ($Page->kontak_id->Visible) { // kontak_id ?>
        <td<?= $Page->kontak_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->kontak_id->viewAttributes() ?>>
<?= $Page->kontak_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
        <td<?= $Page->mitra_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->mitra_id->viewAttributes() ?>>
<?= $Page->mitra_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_kontak->Visible) { // nama_kontak ?>
        <td<?= $Page->nama_kontak->cellAttributes() ?>>
<span id="">
<span<?= $Page->nama_kontak->viewAttributes() ?>>
<?= $Page->nama_kontak->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <td<?= $Page->jabatan->cellAttributes() ?>>
<span id="">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fkontak_mitradelete.validateFields()){ew.prompt({title: ew.language.phrase("MessageDeleteConfirm"),icon:'question',showCancelButton:true},result=>{if(result) $("#fkontak_mitradelete").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
