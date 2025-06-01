<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$KerjasamaAdd = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kerjasama: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fkerjasamaadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fkerjasamaadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["mitra_id", [fields.mitra_id.visible && fields.mitra_id.required ? ew.Validators.required(fields.mitra_id.caption) : null, ew.Validators.integer], fields.mitra_id.isInvalid],
            ["judul_kerjasama", [fields.judul_kerjasama.visible && fields.judul_kerjasama.required ? ew.Validators.required(fields.judul_kerjasama.caption) : null], fields.judul_kerjasama.isInvalid],
            ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid],
            ["tanggal_mulai", [fields.tanggal_mulai.visible && fields.tanggal_mulai.required ? ew.Validators.required(fields.tanggal_mulai.caption) : null, ew.Validators.datetime(fields.tanggal_mulai.clientFormatPattern)], fields.tanggal_mulai.isInvalid],
            ["tanggal_berakhir", [fields.tanggal_berakhir.visible && fields.tanggal_berakhir.required ? ew.Validators.required(fields.tanggal_berakhir.caption) : null, ew.Validators.datetime(fields.tanggal_berakhir.clientFormatPattern)], fields.tanggal_berakhir.isInvalid],
            ["jenis_kerjasama", [fields.jenis_kerjasama.visible && fields.jenis_kerjasama.required ? ew.Validators.required(fields.jenis_kerjasama.caption) : null], fields.jenis_kerjasama.isInvalid],
            ["dokumen_path", [fields.dokumen_path.visible && fields.dokumen_path.required ? ew.Validators.required(fields.dokumen_path.caption) : null], fields.dokumen_path.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
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
            "jenis_kerjasama": <?= $Page->jenis_kerjasama->toClientList($Page) ?>,
            "status": <?= $Page->status->toClientList($Page) ?>,
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php // Begin of Card view by Masino Sinaga, September 10, 2023 ?>
<?php if (!$Page->IsModal) { ?>
<div class="col-md-12">
  <div class="card shadow-sm">
    <div class="card-header">
	  <h4 class="card-title"><?php echo Language()->phrase("AddCaption"); ?></h4>
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
<form name="fkerjasamaadd" id="fkerjasamaadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kerjasama">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
    <div id="r_mitra_id"<?= $Page->mitra_id->rowAttributes() ?>>
        <label id="elh_kerjasama_mitra_id" for="x_mitra_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mitra_id->caption() ?><?= $Page->mitra_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mitra_id->cellAttributes() ?>>
<span id="el_kerjasama_mitra_id">
<input type="<?= $Page->mitra_id->getInputTextType() ?>" name="x_mitra_id" id="x_mitra_id" data-table="kerjasama" data-field="x_mitra_id" value="<?= $Page->mitra_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->mitra_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->mitra_id->formatPattern()) ?>"<?= $Page->mitra_id->editAttributes() ?> aria-describedby="x_mitra_id_help">
<?= $Page->mitra_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mitra_id->getErrorMessage() ?></div>
<script<?= Nonce() ?>>
loadjs.ready(['fkerjasamaadd', 'jqueryinputmask'], function() {
	options = {
		'alias': 'numeric',
		'autoUnmask': true,
		'jitMasking': false,
		'groupSeparator': '<?php echo $GROUPING_SEPARATOR ?>',
		'digits': 0,
		'radixPoint': '<?php echo $DECIMAL_SEPARATOR ?>',
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("fkerjasamaadd", "x_mitra_id", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->judul_kerjasama->Visible) { // judul_kerjasama ?>
    <div id="r_judul_kerjasama"<?= $Page->judul_kerjasama->rowAttributes() ?>>
        <label id="elh_kerjasama_judul_kerjasama" for="x_judul_kerjasama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul_kerjasama->caption() ?><?= $Page->judul_kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->judul_kerjasama->cellAttributes() ?>>
<span id="el_kerjasama_judul_kerjasama">
<input type="<?= $Page->judul_kerjasama->getInputTextType() ?>" name="x_judul_kerjasama" id="x_judul_kerjasama" data-table="kerjasama" data-field="x_judul_kerjasama" value="<?= $Page->judul_kerjasama->getEditValue() ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->judul_kerjasama->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->judul_kerjasama->formatPattern()) ?>"<?= $Page->judul_kerjasama->editAttributes() ?> aria-describedby="x_judul_kerjasama_help">
<?= $Page->judul_kerjasama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->judul_kerjasama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <div id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <label id="elh_kerjasama_deskripsi" for="x_deskripsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi->caption() ?><?= $Page->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_kerjasama_deskripsi">
<input type="<?= $Page->deskripsi->getInputTextType() ?>" name="x_deskripsi" id="x_deskripsi" data-table="kerjasama" data-field="x_deskripsi" value="<?= $Page->deskripsi->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->deskripsi->formatPattern()) ?>"<?= $Page->deskripsi->editAttributes() ?> aria-describedby="x_deskripsi_help">
<?= $Page->deskripsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_mulai->Visible) { // tanggal_mulai ?>
    <div id="r_tanggal_mulai"<?= $Page->tanggal_mulai->rowAttributes() ?>>
        <label id="elh_kerjasama_tanggal_mulai" for="x_tanggal_mulai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_mulai->caption() ?><?= $Page->tanggal_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggal_mulai->cellAttributes() ?>>
<span id="el_kerjasama_tanggal_mulai">
<input type="<?= $Page->tanggal_mulai->getInputTextType() ?>" name="x_tanggal_mulai" id="x_tanggal_mulai" data-table="kerjasama" data-field="x_tanggal_mulai" value="<?= $Page->tanggal_mulai->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->tanggal_mulai->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tanggal_mulai->formatPattern()) ?>"<?= $Page->tanggal_mulai->editAttributes() ?> aria-describedby="x_tanggal_mulai_help">
<?= $Page->tanggal_mulai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_mulai->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_mulai->ReadOnly && !$Page->tanggal_mulai->Disabled && !isset($Page->tanggal_mulai->EditAttrs["readonly"]) && !isset($Page->tanggal_mulai->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["fkerjasamaadd", "datetimepicker"], function () {
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
        "fkerjasamaadd",
        "x_tanggal_mulai",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready(['fkerjasamaadd', 'jqueryinputmask'], function() {
	options = {
		'jitMasking': false,
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("fkerjasamaadd", "x_tanggal_mulai", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
    <div id="r_tanggal_berakhir"<?= $Page->tanggal_berakhir->rowAttributes() ?>>
        <label id="elh_kerjasama_tanggal_berakhir" for="x_tanggal_berakhir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_berakhir->caption() ?><?= $Page->tanggal_berakhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggal_berakhir->cellAttributes() ?>>
<span id="el_kerjasama_tanggal_berakhir">
<input type="<?= $Page->tanggal_berakhir->getInputTextType() ?>" name="x_tanggal_berakhir" id="x_tanggal_berakhir" data-table="kerjasama" data-field="x_tanggal_berakhir" value="<?= $Page->tanggal_berakhir->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->tanggal_berakhir->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tanggal_berakhir->formatPattern()) ?>"<?= $Page->tanggal_berakhir->editAttributes() ?> aria-describedby="x_tanggal_berakhir_help">
<?= $Page->tanggal_berakhir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_berakhir->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_berakhir->ReadOnly && !$Page->tanggal_berakhir->Disabled && !isset($Page->tanggal_berakhir->EditAttrs["readonly"]) && !isset($Page->tanggal_berakhir->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["fkerjasamaadd", "datetimepicker"], function () {
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
        "fkerjasamaadd",
        "x_tanggal_berakhir",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready(['fkerjasamaadd', 'jqueryinputmask'], function() {
	options = {
		'jitMasking': false,
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("fkerjasamaadd", "x_tanggal_berakhir", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_kerjasama->Visible) { // jenis_kerjasama ?>
    <div id="r_jenis_kerjasama"<?= $Page->jenis_kerjasama->rowAttributes() ?>>
        <label id="elh_kerjasama_jenis_kerjasama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_kerjasama->caption() ?><?= $Page->jenis_kerjasama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis_kerjasama->cellAttributes() ?>>
<span id="el_kerjasama_jenis_kerjasama">
<template id="tp_x_jenis_kerjasama">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="kerjasama" data-field="x_jenis_kerjasama" name="x_jenis_kerjasama" id="x_jenis_kerjasama"<?= $Page->jenis_kerjasama->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_jenis_kerjasama" class="ew-item-list"></div>
<selection-list hidden
    id="x_jenis_kerjasama"
    name="x_jenis_kerjasama"
    value="<?= HtmlEncode($Page->jenis_kerjasama->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis_kerjasama"
    data-target="dsl_x_jenis_kerjasama"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis_kerjasama->isInvalidClass() ?>"
    data-table="kerjasama"
    data-field="x_jenis_kerjasama"
    data-value-separator="<?= $Page->jenis_kerjasama->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis_kerjasama->editAttributes() ?>></selection-list>
<?= $Page->jenis_kerjasama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_kerjasama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dokumen_path->Visible) { // dokumen_path ?>
    <div id="r_dokumen_path"<?= $Page->dokumen_path->rowAttributes() ?>>
        <label id="elh_kerjasama_dokumen_path" for="x_dokumen_path" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokumen_path->caption() ?><?= $Page->dokumen_path->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dokumen_path->cellAttributes() ?>>
<span id="el_kerjasama_dokumen_path">
<input type="<?= $Page->dokumen_path->getInputTextType() ?>" name="x_dokumen_path" id="x_dokumen_path" data-table="kerjasama" data-field="x_dokumen_path" value="<?= $Page->dokumen_path->getEditValue() ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->dokumen_path->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->dokumen_path->formatPattern()) ?>"<?= $Page->dokumen_path->editAttributes() ?> aria-describedby="x_dokumen_path_help">
<?= $Page->dokumen_path->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dokumen_path->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_kerjasama_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_kerjasama_status">
<template id="tp_x_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="kerjasama" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_status" class="ew-item-list"></div>
<selection-list hidden
    id="x_status"
    name="x_status"
    value="<?= HtmlEncode($Page->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="kerjasama"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>></selection-list>
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fkerjasamaadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fkerjasamaadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
<?php
$Page->showPageFooter();
?>
<?php if (!$Page->IsModal && !$Page->isExport()) { ?>
<script>
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fkerjasamaadd.validateFields()){ew.prompt({title: ew.language.phrase("MessageAddConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#fkerjasamaadd").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("kerjasama");
});
</script>
<?php if (Config("MS_ENTER_MOVING_CURSOR_TO_NEXT_FIELD")) { ?>
<script>
loadjs.ready("head", function() { $("#fkerjasamaadd:first *:input[type!=hidden]:first").focus(),$("input").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("select").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("radio").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()})});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
