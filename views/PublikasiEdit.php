<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$PublikasiEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<?php // Begin of Card view by Masino Sinaga, September 10, 2023 ?>
<?php if (!$Page->IsModal) { ?>
<div class="col-md-12">
  <div class="card shadow-sm">
    <div class="card-header">
	  <h4 class="card-title"><?php echo Language()->phrase("EditCaption"); ?></h4>
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
<form name="fpublikasiedit" id="fpublikasiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { publikasi: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fpublikasiedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpublikasiedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["publikasi_id", [fields.publikasi_id.visible && fields.publikasi_id.required ? ew.Validators.required(fields.publikasi_id.caption) : null], fields.publikasi_id.isInvalid],
            ["judul", [fields.judul.visible && fields.judul.required ? ew.Validators.required(fields.judul.caption) : null], fields.judul.isInvalid],
            ["konten", [fields.konten.visible && fields.konten.required ? ew.Validators.required(fields.konten.caption) : null], fields.konten.isInvalid],
            ["tanggal_publikasi", [fields.tanggal_publikasi.visible && fields.tanggal_publikasi.required ? ew.Validators.required(fields.tanggal_publikasi.caption) : null, ew.Validators.datetime(fields.tanggal_publikasi.clientFormatPattern)], fields.tanggal_publikasi.isInvalid],
            ["jenis_media", [fields.jenis_media.visible && fields.jenis_media.required ? ew.Validators.required(fields.jenis_media.caption) : null], fields.jenis_media.isInvalid],
            ["gambar_path", [fields.gambar_path.visible && fields.gambar_path.required ? ew.Validators.required(fields.gambar_path.caption) : null], fields.gambar_path.isInvalid],
            ["penulis_id", [fields.penulis_id.visible && fields.penulis_id.required ? ew.Validators.required(fields.penulis_id.caption) : null, ew.Validators.integer], fields.penulis_id.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)
                    // Your custom validation code in JAVASCRIPT here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "jenis_media": <?= $Page->jenis_media->toClientList($Page) ?>,
        })
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
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="publikasi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->publikasi_id->Visible) { // publikasi_id ?>
    <div id="r_publikasi_id"<?= $Page->publikasi_id->rowAttributes() ?>>
        <label id="elh_publikasi_publikasi_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->publikasi_id->caption() ?><?= $Page->publikasi_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->publikasi_id->cellAttributes() ?>>
<span id="el_publikasi_publikasi_id">
<span<?= $Page->publikasi_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->publikasi_id->getDisplayValue($Page->publikasi_id->getEditValue()))) ?>"></span>
<input type="hidden" data-table="publikasi" data-field="x_publikasi_id" data-hidden="1" name="x_publikasi_id" id="x_publikasi_id" value="<?= HtmlEncode($Page->publikasi_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
    <div id="r_judul"<?= $Page->judul->rowAttributes() ?>>
        <label id="elh_publikasi_judul" for="x_judul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul->caption() ?><?= $Page->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->judul->cellAttributes() ?>>
<span id="el_publikasi_judul">
<input type="<?= $Page->judul->getInputTextType() ?>" name="x_judul" id="x_judul" data-table="publikasi" data-field="x_judul" value="<?= $Page->judul->getEditValue() ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->judul->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->judul->formatPattern()) ?>"<?= $Page->judul->editAttributes() ?> aria-describedby="x_judul_help">
<?= $Page->judul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->judul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->konten->Visible) { // konten ?>
    <div id="r_konten"<?= $Page->konten->rowAttributes() ?>>
        <label id="elh_publikasi_konten" for="x_konten" class="<?= $Page->LeftColumnClass ?>"><?= $Page->konten->caption() ?><?= $Page->konten->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->konten->cellAttributes() ?>>
<span id="el_publikasi_konten">
<input type="<?= $Page->konten->getInputTextType() ?>" name="x_konten" id="x_konten" data-table="publikasi" data-field="x_konten" value="<?= $Page->konten->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->konten->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->konten->formatPattern()) ?>"<?= $Page->konten->editAttributes() ?> aria-describedby="x_konten_help">
<?= $Page->konten->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->konten->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_publikasi->Visible) { // tanggal_publikasi ?>
    <div id="r_tanggal_publikasi"<?= $Page->tanggal_publikasi->rowAttributes() ?>>
        <label id="elh_publikasi_tanggal_publikasi" for="x_tanggal_publikasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_publikasi->caption() ?><?= $Page->tanggal_publikasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggal_publikasi->cellAttributes() ?>>
<span id="el_publikasi_tanggal_publikasi">
<input type="<?= $Page->tanggal_publikasi->getInputTextType() ?>" name="x_tanggal_publikasi" id="x_tanggal_publikasi" data-table="publikasi" data-field="x_tanggal_publikasi" value="<?= $Page->tanggal_publikasi->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->tanggal_publikasi->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tanggal_publikasi->formatPattern()) ?>"<?= $Page->tanggal_publikasi->editAttributes() ?> aria-describedby="x_tanggal_publikasi_help">
<?= $Page->tanggal_publikasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_publikasi->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_publikasi->ReadOnly && !$Page->tanggal_publikasi->Disabled && !isset($Page->tanggal_publikasi->EditAttrs["readonly"]) && !isset($Page->tanggal_publikasi->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["fpublikasiedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker(
        "fpublikasiedit",
        "x_tanggal_publikasi",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready(['fpublikasiedit', 'jqueryinputmask'], function() {
	options = {
		'jitMasking': false,
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("fpublikasiedit", "x_tanggal_publikasi", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_media->Visible) { // jenis_media ?>
    <div id="r_jenis_media"<?= $Page->jenis_media->rowAttributes() ?>>
        <label id="elh_publikasi_jenis_media" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_media->caption() ?><?= $Page->jenis_media->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis_media->cellAttributes() ?>>
<span id="el_publikasi_jenis_media">
<template id="tp_x_jenis_media">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="publikasi" data-field="x_jenis_media" name="x_jenis_media" id="x_jenis_media"<?= $Page->jenis_media->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_jenis_media" class="ew-item-list"></div>
<selection-list hidden
    id="x_jenis_media"
    name="x_jenis_media"
    value="<?= HtmlEncode($Page->jenis_media->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis_media"
    data-target="dsl_x_jenis_media"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis_media->isInvalidClass() ?>"
    data-table="publikasi"
    data-field="x_jenis_media"
    data-value-separator="<?= $Page->jenis_media->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis_media->editAttributes() ?>></selection-list>
<?= $Page->jenis_media->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_media->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gambar_path->Visible) { // gambar_path ?>
    <div id="r_gambar_path"<?= $Page->gambar_path->rowAttributes() ?>>
        <label id="elh_publikasi_gambar_path" for="x_gambar_path" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gambar_path->caption() ?><?= $Page->gambar_path->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gambar_path->cellAttributes() ?>>
<span id="el_publikasi_gambar_path">
<input type="<?= $Page->gambar_path->getInputTextType() ?>" name="x_gambar_path" id="x_gambar_path" data-table="publikasi" data-field="x_gambar_path" value="<?= $Page->gambar_path->getEditValue() ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->gambar_path->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->gambar_path->formatPattern()) ?>"<?= $Page->gambar_path->editAttributes() ?> aria-describedby="x_gambar_path_help">
<?= $Page->gambar_path->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gambar_path->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->penulis_id->Visible) { // penulis_id ?>
    <div id="r_penulis_id"<?= $Page->penulis_id->rowAttributes() ?>>
        <label id="elh_publikasi_penulis_id" for="x_penulis_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->penulis_id->caption() ?><?= $Page->penulis_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->penulis_id->cellAttributes() ?>>
<span id="el_publikasi_penulis_id">
<input type="<?= $Page->penulis_id->getInputTextType() ?>" name="x_penulis_id" id="x_penulis_id" data-table="publikasi" data-field="x_penulis_id" value="<?= $Page->penulis_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->penulis_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->penulis_id->formatPattern()) ?>"<?= $Page->penulis_id->editAttributes() ?> aria-describedby="x_penulis_id_help">
<?= $Page->penulis_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->penulis_id->getErrorMessage() ?></div>
<script<?= Nonce() ?>>
loadjs.ready(['fpublikasiedit', 'jqueryinputmask'], function() {
	options = {
		'alias': 'numeric',
		'autoUnmask': true,
		'jitMasking': false,
		'groupSeparator': '<?php echo $GROUPING_SEPARATOR ?>',
		'digits': 0,
		'radixPoint': '<?php echo $DECIMAL_SEPARATOR ?>',
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("fpublikasiedit", "x_penulis_id", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpublikasiedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpublikasiedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
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
</main>
<?php
$Page->showPageFooter();
?>
<?php if (!$Page->IsModal && !$Page->isExport()) { ?>
<script>
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fpublikasiedit.validateFields()){ew.prompt({title: ew.language.phrase("MessageEditConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#fpublikasiedit").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("publikasi");
});
</script>
<?php if (Config("MS_ENTER_MOVING_CURSOR_TO_NEXT_FIELD")) { ?>
<script>
loadjs.ready("head", function() { $("#fpublikasiedit:first *:input[type!=hidden]:first").focus(),$("input").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("select").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("radio").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()})});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
