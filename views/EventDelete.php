<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$EventDelete = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { event: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var feventdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("feventdelete")
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
<form name="feventdelete" id="feventdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="event">
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
<?php if ($Page->event_id->Visible) { // event_id ?>
        <th class="<?= $Page->event_id->headerCellClass() ?>"><span id="elh_event_event_id" class="event_event_id"><?= $Page->event_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_event->Visible) { // nama_event ?>
        <th class="<?= $Page->nama_event->headerCellClass() ?>"><span id="elh_event_nama_event" class="event_nama_event"><?= $Page->nama_event->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <th class="<?= $Page->deskripsi->headerCellClass() ?>"><span id="elh_event_deskripsi" class="event_deskripsi"><?= $Page->deskripsi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_mulai->Visible) { // tanggal_mulai ?>
        <th class="<?= $Page->tanggal_mulai->headerCellClass() ?>"><span id="elh_event_tanggal_mulai" class="event_tanggal_mulai"><?= $Page->tanggal_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_selesai->Visible) { // tanggal_selesai ?>
        <th class="<?= $Page->tanggal_selesai->headerCellClass() ?>"><span id="elh_event_tanggal_selesai" class="event_tanggal_selesai"><?= $Page->tanggal_selesai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <th class="<?= $Page->lokasi->headerCellClass() ?>"><span id="elh_event_lokasi" class="event_lokasi"><?= $Page->lokasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
        <th class="<?= $Page->mitra_id->headerCellClass() ?>"><span id="elh_event_mitra_id" class="event_mitra_id"><?= $Page->mitra_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->peserta_terdaftar->Visible) { // peserta_terdaftar ?>
        <th class="<?= $Page->peserta_terdaftar->headerCellClass() ?>"><span id="elh_event_peserta_terdaftar" class="event_peserta_terdaftar"><?= $Page->peserta_terdaftar->caption() ?></span></th>
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
<?php if ($Page->event_id->Visible) { // event_id ?>
        <td<?= $Page->event_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->event_id->viewAttributes() ?>>
<?= $Page->event_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_event->Visible) { // nama_event ?>
        <td<?= $Page->nama_event->cellAttributes() ?>>
<span id="">
<span<?= $Page->nama_event->viewAttributes() ?>>
<?= $Page->nama_event->getViewValue() ?></span>
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
<?php if ($Page->tanggal_selesai->Visible) { // tanggal_selesai ?>
        <td<?= $Page->tanggal_selesai->cellAttributes() ?>>
<span id="">
<span<?= $Page->tanggal_selesai->viewAttributes() ?>>
<?= $Page->tanggal_selesai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
        <td<?= $Page->lokasi->cellAttributes() ?>>
<span id="">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
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
<?php if ($Page->peserta_terdaftar->Visible) { // peserta_terdaftar ?>
        <td<?= $Page->peserta_terdaftar->cellAttributes() ?>>
<span id="">
<span<?= $Page->peserta_terdaftar->viewAttributes() ?>>
<?= $Page->peserta_terdaftar->getViewValue() ?></span>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(feventdelete.validateFields()){ew.prompt({title: ew.language.phrase("MessageDeleteConfirm"),icon:'question',showCancelButton:true},result=>{if(result) $("#feventdelete").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
