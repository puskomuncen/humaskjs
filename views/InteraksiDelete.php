<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$InteraksiDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { interaksi: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var finteraksidelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finteraksidelete")
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
<form name="finteraksidelete" id="finteraksidelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="interaksi">
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
<?php if ($Page->interaksi_id->Visible) { // interaksi_id ?>
        <th class="<?= $Page->interaksi_id->headerCellClass() ?>"><span id="elh_interaksi_interaksi_id" class="interaksi_interaksi_id"><?= $Page->interaksi_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
        <th class="<?= $Page->mitra_id->headerCellClass() ?>"><span id="elh_interaksi_mitra_id" class="interaksi_mitra_id"><?= $Page->mitra_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_interaksi_user_id" class="interaksi_user_id"><?= $Page->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis_interaksi->Visible) { // jenis_interaksi ?>
        <th class="<?= $Page->jenis_interaksi->headerCellClass() ?>"><span id="elh_interaksi_jenis_interaksi" class="interaksi_jenis_interaksi"><?= $Page->jenis_interaksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
        <th class="<?= $Page->catatan->headerCellClass() ?>"><span id="elh_interaksi_catatan" class="interaksi_catatan"><?= $Page->catatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_interaksi->Visible) { // tanggal_interaksi ?>
        <th class="<?= $Page->tanggal_interaksi->headerCellClass() ?>"><span id="elh_interaksi_tanggal_interaksi" class="interaksi_tanggal_interaksi"><?= $Page->tanggal_interaksi->caption() ?></span></th>
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
<?php if ($Page->interaksi_id->Visible) { // interaksi_id ?>
        <td<?= $Page->interaksi_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->interaksi_id->viewAttributes() ?>>
<?= $Page->interaksi_id->getViewValue() ?></span>
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
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td<?= $Page->user_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis_interaksi->Visible) { // jenis_interaksi ?>
        <td<?= $Page->jenis_interaksi->cellAttributes() ?>>
<span id="">
<span<?= $Page->jenis_interaksi->viewAttributes() ?>>
<?= $Page->jenis_interaksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
        <td<?= $Page->catatan->cellAttributes() ?>>
<span id="">
<span<?= $Page->catatan->viewAttributes() ?>>
<?= $Page->catatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_interaksi->Visible) { // tanggal_interaksi ?>
        <td<?= $Page->tanggal_interaksi->cellAttributes() ?>>
<span id="">
<span<?= $Page->tanggal_interaksi->viewAttributes() ?>>
<?= $Page->tanggal_interaksi->getViewValue() ?></span>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(finteraksidelete.validateFields()){ew.prompt({title: ew.language.phrase("MessageDeleteConfirm"),icon:'question',showCancelButton:true},result=>{if(result) $("#finteraksidelete").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
