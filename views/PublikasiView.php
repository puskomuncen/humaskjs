<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$PublikasiView = &$Page;
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
<form name="fpublikasiview" id="fpublikasiview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { publikasi: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fpublikasiview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpublikasiview")
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
<input type="hidden" name="t" value="publikasi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->publikasi_id->Visible) { // publikasi_id ?>
    <tr id="r_publikasi_id"<?= $Page->publikasi_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_publikasi_publikasi_id"><?= $Page->publikasi_id->caption() ?></span></td>
        <td data-name="publikasi_id"<?= $Page->publikasi_id->cellAttributes() ?>>
<span id="el_publikasi_publikasi_id">
<span<?= $Page->publikasi_id->viewAttributes() ?>>
<?= $Page->publikasi_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
    <tr id="r_judul"<?= $Page->judul->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_publikasi_judul"><?= $Page->judul->caption() ?></span></td>
        <td data-name="judul"<?= $Page->judul->cellAttributes() ?>>
<span id="el_publikasi_judul">
<span<?= $Page->judul->viewAttributes() ?>>
<?= $Page->judul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->konten->Visible) { // konten ?>
    <tr id="r_konten"<?= $Page->konten->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_publikasi_konten"><?= $Page->konten->caption() ?></span></td>
        <td data-name="konten"<?= $Page->konten->cellAttributes() ?>>
<span id="el_publikasi_konten">
<span<?= $Page->konten->viewAttributes() ?>>
<?= $Page->konten->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_publikasi->Visible) { // tanggal_publikasi ?>
    <tr id="r_tanggal_publikasi"<?= $Page->tanggal_publikasi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_publikasi_tanggal_publikasi"><?= $Page->tanggal_publikasi->caption() ?></span></td>
        <td data-name="tanggal_publikasi"<?= $Page->tanggal_publikasi->cellAttributes() ?>>
<span id="el_publikasi_tanggal_publikasi">
<span<?= $Page->tanggal_publikasi->viewAttributes() ?>>
<?= $Page->tanggal_publikasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis_media->Visible) { // jenis_media ?>
    <tr id="r_jenis_media"<?= $Page->jenis_media->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_publikasi_jenis_media"><?= $Page->jenis_media->caption() ?></span></td>
        <td data-name="jenis_media"<?= $Page->jenis_media->cellAttributes() ?>>
<span id="el_publikasi_jenis_media">
<span<?= $Page->jenis_media->viewAttributes() ?>>
<?= $Page->jenis_media->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gambar_path->Visible) { // gambar_path ?>
    <tr id="r_gambar_path"<?= $Page->gambar_path->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_publikasi_gambar_path"><?= $Page->gambar_path->caption() ?></span></td>
        <td data-name="gambar_path"<?= $Page->gambar_path->cellAttributes() ?>>
<span id="el_publikasi_gambar_path">
<span<?= $Page->gambar_path->viewAttributes() ?>>
<?= $Page->gambar_path->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->penulis_id->Visible) { // penulis_id ?>
    <tr id="r_penulis_id"<?= $Page->penulis_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_publikasi_penulis_id"><?= $Page->penulis_id->caption() ?></span></td>
        <td data-name="penulis_id"<?= $Page->penulis_id->cellAttributes() ?>>
<span id="el_publikasi_penulis_id">
<span<?= $Page->penulis_id->viewAttributes() ?>>
<?= $Page->penulis_id->getViewValue() ?></span>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fpublikasiadd.validateFields()){ew.prompt({title: ew.language.phrase("MessageAddConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#fpublikasiadd").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<?php if (!$Page->IsModal && !$Page->isExport()) { ?>
<script>
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fpublikasiedit.validateFields()){ew.prompt({title: ew.language.phrase("MessageEditConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#fpublikasiedit").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
