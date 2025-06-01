<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$KerjasamaDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kerjasama: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fkerjasamadelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fkerjasamadelete")
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
<form name="fkerjasamadelete" id="fkerjasamadelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kerjasama">
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
<?php if ($Page->kerjasama_id->Visible) { // kerjasama_id ?>
        <th class="<?= $Page->kerjasama_id->headerCellClass() ?>"><span id="elh_kerjasama_kerjasama_id" class="kerjasama_kerjasama_id"><?= $Page->kerjasama_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
        <th class="<?= $Page->mitra_id->headerCellClass() ?>"><span id="elh_kerjasama_mitra_id" class="kerjasama_mitra_id"><?= $Page->mitra_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->judul_kerjasama->Visible) { // judul_kerjasama ?>
        <th class="<?= $Page->judul_kerjasama->headerCellClass() ?>"><span id="elh_kerjasama_judul_kerjasama" class="kerjasama_judul_kerjasama"><?= $Page->judul_kerjasama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <th class="<?= $Page->deskripsi->headerCellClass() ?>"><span id="elh_kerjasama_deskripsi" class="kerjasama_deskripsi"><?= $Page->deskripsi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_mulai->Visible) { // tanggal_mulai ?>
        <th class="<?= $Page->tanggal_mulai->headerCellClass() ?>"><span id="elh_kerjasama_tanggal_mulai" class="kerjasama_tanggal_mulai"><?= $Page->tanggal_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
        <th class="<?= $Page->tanggal_berakhir->headerCellClass() ?>"><span id="elh_kerjasama_tanggal_berakhir" class="kerjasama_tanggal_berakhir"><?= $Page->tanggal_berakhir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis_kerjasama->Visible) { // jenis_kerjasama ?>
        <th class="<?= $Page->jenis_kerjasama->headerCellClass() ?>"><span id="elh_kerjasama_jenis_kerjasama" class="kerjasama_jenis_kerjasama"><?= $Page->jenis_kerjasama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dokumen_path->Visible) { // dokumen_path ?>
        <th class="<?= $Page->dokumen_path->headerCellClass() ?>"><span id="elh_kerjasama_dokumen_path" class="kerjasama_dokumen_path"><?= $Page->dokumen_path->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_kerjasama_status" class="kerjasama_status"><?= $Page->status->caption() ?></span></th>
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
<?php if ($Page->kerjasama_id->Visible) { // kerjasama_id ?>
        <td<?= $Page->kerjasama_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->kerjasama_id->viewAttributes() ?>>
<?= $Page->kerjasama_id->getViewValue() ?></span>
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
<?php if ($Page->judul_kerjasama->Visible) { // judul_kerjasama ?>
        <td<?= $Page->judul_kerjasama->cellAttributes() ?>>
<span id="">
<span<?= $Page->judul_kerjasama->viewAttributes() ?>>
<?= $Page->judul_kerjasama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <td<?= $Page->deskripsi->cellAttributes() ?>>
<span id="">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_mulai->Visible) { // tanggal_mulai ?>
        <td<?= $Page->tanggal_mulai->cellAttributes() ?>>
<span id="">
<span<?= $Page->tanggal_mulai->viewAttributes() ?>>
<?= $Page->tanggal_mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
        <td<?= $Page->tanggal_berakhir->cellAttributes() ?>>
<span id="">
<span<?= $Page->tanggal_berakhir->viewAttributes() ?>>
<?= $Page->tanggal_berakhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis_kerjasama->Visible) { // jenis_kerjasama ?>
        <td<?= $Page->jenis_kerjasama->cellAttributes() ?>>
<span id="">
<span<?= $Page->jenis_kerjasama->viewAttributes() ?>>
<?= $Page->jenis_kerjasama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dokumen_path->Visible) { // dokumen_path ?>
        <td<?= $Page->dokumen_path->cellAttributes() ?>>
<span id="">
<span<?= $Page->dokumen_path->viewAttributes() ?>>
<?= $Page->dokumen_path->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fkerjasamadelete.validateFields()){ew.prompt({title: ew.language.phrase("MessageDeleteConfirm"),icon:'question',showCancelButton:true},result=>{if(result) $("#fkerjasamadelete").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
