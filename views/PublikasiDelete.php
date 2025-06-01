<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$PublikasiDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { publikasi: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fpublikasidelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpublikasidelete")
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
<form name="fpublikasidelete" id="fpublikasidelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="publikasi">
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
<?php if ($Page->publikasi_id->Visible) { // publikasi_id ?>
        <th class="<?= $Page->publikasi_id->headerCellClass() ?>"><span id="elh_publikasi_publikasi_id" class="publikasi_publikasi_id"><?= $Page->publikasi_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
        <th class="<?= $Page->judul->headerCellClass() ?>"><span id="elh_publikasi_judul" class="publikasi_judul"><?= $Page->judul->caption() ?></span></th>
<?php } ?>
<?php if ($Page->konten->Visible) { // konten ?>
        <th class="<?= $Page->konten->headerCellClass() ?>"><span id="elh_publikasi_konten" class="publikasi_konten"><?= $Page->konten->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_publikasi->Visible) { // tanggal_publikasi ?>
        <th class="<?= $Page->tanggal_publikasi->headerCellClass() ?>"><span id="elh_publikasi_tanggal_publikasi" class="publikasi_tanggal_publikasi"><?= $Page->tanggal_publikasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis_media->Visible) { // jenis_media ?>
        <th class="<?= $Page->jenis_media->headerCellClass() ?>"><span id="elh_publikasi_jenis_media" class="publikasi_jenis_media"><?= $Page->jenis_media->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gambar_path->Visible) { // gambar_path ?>
        <th class="<?= $Page->gambar_path->headerCellClass() ?>"><span id="elh_publikasi_gambar_path" class="publikasi_gambar_path"><?= $Page->gambar_path->caption() ?></span></th>
<?php } ?>
<?php if ($Page->penulis_id->Visible) { // penulis_id ?>
        <th class="<?= $Page->penulis_id->headerCellClass() ?>"><span id="elh_publikasi_penulis_id" class="publikasi_penulis_id"><?= $Page->penulis_id->caption() ?></span></th>
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
<?php if ($Page->publikasi_id->Visible) { // publikasi_id ?>
        <td<?= $Page->publikasi_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->publikasi_id->viewAttributes() ?>>
<?= $Page->publikasi_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
        <td<?= $Page->judul->cellAttributes() ?>>
<span id="">
<span<?= $Page->judul->viewAttributes() ?>>
<?= $Page->judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->konten->Visible) { // konten ?>
        <td<?= $Page->konten->cellAttributes() ?>>
<span id="">
<span<?= $Page->konten->viewAttributes() ?>>
<?= $Page->konten->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_publikasi->Visible) { // tanggal_publikasi ?>
        <td<?= $Page->tanggal_publikasi->cellAttributes() ?>>
<span id="">
<span<?= $Page->tanggal_publikasi->viewAttributes() ?>>
<?= $Page->tanggal_publikasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis_media->Visible) { // jenis_media ?>
        <td<?= $Page->jenis_media->cellAttributes() ?>>
<span id="">
<span<?= $Page->jenis_media->viewAttributes() ?>>
<?= $Page->jenis_media->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gambar_path->Visible) { // gambar_path ?>
        <td<?= $Page->gambar_path->cellAttributes() ?>>
<span id="">
<span<?= $Page->gambar_path->viewAttributes() ?>>
<?= $Page->gambar_path->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->penulis_id->Visible) { // penulis_id ?>
        <td<?= $Page->penulis_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->penulis_id->viewAttributes() ?>>
<?= $Page->penulis_id->getViewValue() ?></span>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fpublikasidelete.validateFields()){ew.prompt({title: ew.language.phrase("MessageDeleteConfirm"),icon:'question',showCancelButton:true},result=>{if(result) $("#fpublikasidelete").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
