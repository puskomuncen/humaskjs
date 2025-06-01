<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$KerjasamaView = &$Page;
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
<form name="fkerjasamaview" id="fkerjasamaview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kerjasama: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fkerjasamaview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fkerjasamaview")
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
<input type="hidden" name="t" value="kerjasama">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->kerjasama_id->Visible) { // kerjasama_id ?>
    <tr id="r_kerjasama_id"<?= $Page->kerjasama_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_kerjasama_id"><?= $Page->kerjasama_id->caption() ?></span></td>
        <td data-name="kerjasama_id"<?= $Page->kerjasama_id->cellAttributes() ?>>
<span id="el_kerjasama_kerjasama_id">
<span<?= $Page->kerjasama_id->viewAttributes() ?>>
<?= $Page->kerjasama_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
    <tr id="r_mitra_id"<?= $Page->mitra_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_mitra_id"><?= $Page->mitra_id->caption() ?></span></td>
        <td data-name="mitra_id"<?= $Page->mitra_id->cellAttributes() ?>>
<span id="el_kerjasama_mitra_id">
<span<?= $Page->mitra_id->viewAttributes() ?>>
<?= $Page->mitra_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->judul_kerjasama->Visible) { // judul_kerjasama ?>
    <tr id="r_judul_kerjasama"<?= $Page->judul_kerjasama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_judul_kerjasama"><?= $Page->judul_kerjasama->caption() ?></span></td>
        <td data-name="judul_kerjasama"<?= $Page->judul_kerjasama->cellAttributes() ?>>
<span id="el_kerjasama_judul_kerjasama">
<span<?= $Page->judul_kerjasama->viewAttributes() ?>>
<?= $Page->judul_kerjasama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <tr id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_deskripsi"><?= $Page->deskripsi->caption() ?></span></td>
        <td data-name="deskripsi"<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_kerjasama_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_mulai->Visible) { // tanggal_mulai ?>
    <tr id="r_tanggal_mulai"<?= $Page->tanggal_mulai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_tanggal_mulai"><?= $Page->tanggal_mulai->caption() ?></span></td>
        <td data-name="tanggal_mulai"<?= $Page->tanggal_mulai->cellAttributes() ?>>
<span id="el_kerjasama_tanggal_mulai">
<span<?= $Page->tanggal_mulai->viewAttributes() ?>>
<?= $Page->tanggal_mulai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
    <tr id="r_tanggal_berakhir"<?= $Page->tanggal_berakhir->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_tanggal_berakhir"><?= $Page->tanggal_berakhir->caption() ?></span></td>
        <td data-name="tanggal_berakhir"<?= $Page->tanggal_berakhir->cellAttributes() ?>>
<span id="el_kerjasama_tanggal_berakhir">
<span<?= $Page->tanggal_berakhir->viewAttributes() ?>>
<?= $Page->tanggal_berakhir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis_kerjasama->Visible) { // jenis_kerjasama ?>
    <tr id="r_jenis_kerjasama"<?= $Page->jenis_kerjasama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_jenis_kerjasama"><?= $Page->jenis_kerjasama->caption() ?></span></td>
        <td data-name="jenis_kerjasama"<?= $Page->jenis_kerjasama->cellAttributes() ?>>
<span id="el_kerjasama_jenis_kerjasama">
<span<?= $Page->jenis_kerjasama->viewAttributes() ?>>
<?= $Page->jenis_kerjasama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dokumen_path->Visible) { // dokumen_path ?>
    <tr id="r_dokumen_path"<?= $Page->dokumen_path->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_dokumen_path"><?= $Page->dokumen_path->caption() ?></span></td>
        <td data-name="dokumen_path"<?= $Page->dokumen_path->cellAttributes() ?>>
<span id="el_kerjasama_dokumen_path">
<span<?= $Page->dokumen_path->viewAttributes() ?>>
<?= $Page->dokumen_path->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kerjasama_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_kerjasama_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fkerjasamaadd.validateFields()){ew.prompt({title: ew.language.phrase("MessageAddConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#fkerjasamaadd").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<?php if (!$Page->IsModal && !$Page->isExport()) { ?>
<script>
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fkerjasamaedit.validateFields()){ew.prompt({title: ew.language.phrase("MessageEditConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#fkerjasamaedit").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
