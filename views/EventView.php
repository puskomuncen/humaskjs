<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$EventView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
<?php // Begin of Card view by Masino Sinaga, September 10, 2023 ?>
<?php if (!$Page->IsModal) { ?>
<div class="col-md-12">
  <div class="card shadow-sm">
    <div class="card-header">
	  <h4 class="card-title"><?php echo Language()->phrase("ViewCaption"); ?></h4>
	  <div class="card-tools">
	  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
	  </button>
	  </div>
	  <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
<?php } ?>
<?php // End of Card view by Masino Sinaga, September 10, 2023 ?>
<form name="feventview" id="feventview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { event: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var feventview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("feventview")
        .setPageId("view")
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
<?php } ?>
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="event">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->event_id->Visible) { // event_id ?>
    <tr id="r_event_id"<?= $Page->event_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_event_id"><?= $Page->event_id->caption() ?></span></td>
        <td data-name="event_id"<?= $Page->event_id->cellAttributes() ?>>
<span id="el_event_event_id">
<span<?= $Page->event_id->viewAttributes() ?>>
<?= $Page->event_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_event->Visible) { // nama_event ?>
    <tr id="r_nama_event"<?= $Page->nama_event->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_nama_event"><?= $Page->nama_event->caption() ?></span></td>
        <td data-name="nama_event"<?= $Page->nama_event->cellAttributes() ?>>
<span id="el_event_nama_event">
<span<?= $Page->nama_event->viewAttributes() ?>>
<?= $Page->nama_event->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <tr id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_deskripsi"><?= $Page->deskripsi->caption() ?></span></td>
        <td data-name="deskripsi"<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_event_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_mulai->Visible) { // tanggal_mulai ?>
    <tr id="r_tanggal_mulai"<?= $Page->tanggal_mulai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_tanggal_mulai"><?= $Page->tanggal_mulai->caption() ?></span></td>
        <td data-name="tanggal_mulai"<?= $Page->tanggal_mulai->cellAttributes() ?>>
<span id="el_event_tanggal_mulai">
<span<?= $Page->tanggal_mulai->viewAttributes() ?>>
<?= $Page->tanggal_mulai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_selesai->Visible) { // tanggal_selesai ?>
    <tr id="r_tanggal_selesai"<?= $Page->tanggal_selesai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_tanggal_selesai"><?= $Page->tanggal_selesai->caption() ?></span></td>
        <td data-name="tanggal_selesai"<?= $Page->tanggal_selesai->cellAttributes() ?>>
<span id="el_event_tanggal_selesai">
<span<?= $Page->tanggal_selesai->viewAttributes() ?>>
<?= $Page->tanggal_selesai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <tr id="r_lokasi"<?= $Page->lokasi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_lokasi"><?= $Page->lokasi->caption() ?></span></td>
        <td data-name="lokasi"<?= $Page->lokasi->cellAttributes() ?>>
<span id="el_event_lokasi">
<span<?= $Page->lokasi->viewAttributes() ?>>
<?= $Page->lokasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
    <tr id="r_mitra_id"<?= $Page->mitra_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_mitra_id"><?= $Page->mitra_id->caption() ?></span></td>
        <td data-name="mitra_id"<?= $Page->mitra_id->cellAttributes() ?>>
<span id="el_event_mitra_id">
<span<?= $Page->mitra_id->viewAttributes() ?>>
<?= $Page->mitra_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->peserta_terdaftar->Visible) { // peserta_terdaftar ?>
    <tr id="r_peserta_terdaftar"<?= $Page->peserta_terdaftar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_event_peserta_terdaftar"><?= $Page->peserta_terdaftar->caption() ?></span></td>
        <td data-name="peserta_terdaftar"<?= $Page->peserta_terdaftar->cellAttributes() ?>>
<span id="el_event_peserta_terdaftar">
<span<?= $Page->peserta_terdaftar->viewAttributes() ?>>
<?= $Page->peserta_terdaftar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php // Begin of Card view by Masino Sinaga, September 10, 2023 ?>
<?php if (!$Page->IsModal) { ?>
		</div>
     <!-- /.card-body -->
     </div>
  <!-- /.card -->
</div>
<?php } ?>
<?php // End of Card view by Masino Sinaga, September 10, 2023 ?>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
</main>
<?php
$Page->showPageFooter();
?>
<?php if (!$Page->IsModal && !$Page->isExport()) { ?>
<script>
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(feventadd.validateFields()){ew.prompt({title: ew.language.phrase("MessageAddConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#feventadd").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<?php if (!$Page->IsModal && !$Page->isExport()) { ?>
<script>
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(feventedit.validateFields()){ew.prompt({title: ew.language.phrase("MessageEditConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#feventedit").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
