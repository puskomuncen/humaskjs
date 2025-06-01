<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$InteraksiEdit = &$Page;
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
<form name="finteraksiedit" id="finteraksiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { interaksi: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var finteraksiedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finteraksiedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["interaksi_id", [fields.interaksi_id.visible && fields.interaksi_id.required ? ew.Validators.required(fields.interaksi_id.caption) : null], fields.interaksi_id.isInvalid],
            ["mitra_id", [fields.mitra_id.visible && fields.mitra_id.required ? ew.Validators.required(fields.mitra_id.caption) : null, ew.Validators.integer], fields.mitra_id.isInvalid],
            ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid],
            ["jenis_interaksi", [fields.jenis_interaksi.visible && fields.jenis_interaksi.required ? ew.Validators.required(fields.jenis_interaksi.caption) : null], fields.jenis_interaksi.isInvalid],
            ["catatan", [fields.catatan.visible && fields.catatan.required ? ew.Validators.required(fields.catatan.caption) : null], fields.catatan.isInvalid],
            ["tanggal_interaksi", [fields.tanggal_interaksi.visible && fields.tanggal_interaksi.required ? ew.Validators.required(fields.tanggal_interaksi.caption) : null, ew.Validators.datetime(fields.tanggal_interaksi.clientFormatPattern)], fields.tanggal_interaksi.isInvalid]
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
            "jenis_interaksi": <?= $Page->jenis_interaksi->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="interaksi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->interaksi_id->Visible) { // interaksi_id ?>
    <div id="r_interaksi_id"<?= $Page->interaksi_id->rowAttributes() ?>>
        <label id="elh_interaksi_interaksi_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->interaksi_id->caption() ?><?= $Page->interaksi_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->interaksi_id->cellAttributes() ?>>
<span id="el_interaksi_interaksi_id">
<span<?= $Page->interaksi_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->interaksi_id->getDisplayValue($Page->interaksi_id->getEditValue()))) ?>"></span>
<input type="hidden" data-table="interaksi" data-field="x_interaksi_id" data-hidden="1" name="x_interaksi_id" id="x_interaksi_id" value="<?= HtmlEncode($Page->interaksi_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
    <div id="r_mitra_id"<?= $Page->mitra_id->rowAttributes() ?>>
        <label id="elh_interaksi_mitra_id" for="x_mitra_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mitra_id->caption() ?><?= $Page->mitra_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mitra_id->cellAttributes() ?>>
<span id="el_interaksi_mitra_id">
<input type="<?= $Page->mitra_id->getInputTextType() ?>" name="x_mitra_id" id="x_mitra_id" data-table="interaksi" data-field="x_mitra_id" value="<?= $Page->mitra_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->mitra_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->mitra_id->formatPattern()) ?>"<?= $Page->mitra_id->editAttributes() ?> aria-describedby="x_mitra_id_help">
<?= $Page->mitra_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mitra_id->getErrorMessage() ?></div>
<script<?= Nonce() ?>>
loadjs.ready(['finteraksiedit', 'jqueryinputmask'], function() {
	options = {
		'alias': 'numeric',
		'autoUnmask': true,
		'jitMasking': false,
		'groupSeparator': '<?php echo $GROUPING_SEPARATOR ?>',
		'digits': 0,
		'radixPoint': '<?php echo $DECIMAL_SEPARATOR ?>',
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("finteraksiedit", "x_mitra_id", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <label id="elh_interaksi_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user_id->cellAttributes() ?>>
<span id="el_interaksi_user_id">
<input type="<?= $Page->user_id->getInputTextType() ?>" name="x_user_id" id="x_user_id" data-table="interaksi" data-field="x_user_id" value="<?= $Page->user_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->user_id->formatPattern()) ?>"<?= $Page->user_id->editAttributes() ?> aria-describedby="x_user_id_help">
<?= $Page->user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
<script<?= Nonce() ?>>
loadjs.ready(['finteraksiedit', 'jqueryinputmask'], function() {
	options = {
		'alias': 'numeric',
		'autoUnmask': true,
		'jitMasking': false,
		'groupSeparator': '<?php echo $GROUPING_SEPARATOR ?>',
		'digits': 0,
		'radixPoint': '<?php echo $DECIMAL_SEPARATOR ?>',
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("finteraksiedit", "x_user_id", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_interaksi->Visible) { // jenis_interaksi ?>
    <div id="r_jenis_interaksi"<?= $Page->jenis_interaksi->rowAttributes() ?>>
        <label id="elh_interaksi_jenis_interaksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_interaksi->caption() ?><?= $Page->jenis_interaksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis_interaksi->cellAttributes() ?>>
<span id="el_interaksi_jenis_interaksi">
<template id="tp_x_jenis_interaksi">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="interaksi" data-field="x_jenis_interaksi" name="x_jenis_interaksi" id="x_jenis_interaksi"<?= $Page->jenis_interaksi->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_jenis_interaksi" class="ew-item-list"></div>
<selection-list hidden
    id="x_jenis_interaksi"
    name="x_jenis_interaksi"
    value="<?= HtmlEncode($Page->jenis_interaksi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis_interaksi"
    data-target="dsl_x_jenis_interaksi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis_interaksi->isInvalidClass() ?>"
    data-table="interaksi"
    data-field="x_jenis_interaksi"
    data-value-separator="<?= $Page->jenis_interaksi->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis_interaksi->editAttributes() ?>></selection-list>
<?= $Page->jenis_interaksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_interaksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
    <div id="r_catatan"<?= $Page->catatan->rowAttributes() ?>>
        <label id="elh_interaksi_catatan" for="x_catatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catatan->caption() ?><?= $Page->catatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->catatan->cellAttributes() ?>>
<span id="el_interaksi_catatan">
<input type="<?= $Page->catatan->getInputTextType() ?>" name="x_catatan" id="x_catatan" data-table="interaksi" data-field="x_catatan" value="<?= $Page->catatan->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->catatan->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->catatan->formatPattern()) ?>"<?= $Page->catatan->editAttributes() ?> aria-describedby="x_catatan_help">
<?= $Page->catatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->catatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_interaksi->Visible) { // tanggal_interaksi ?>
    <div id="r_tanggal_interaksi"<?= $Page->tanggal_interaksi->rowAttributes() ?>>
        <label id="elh_interaksi_tanggal_interaksi" for="x_tanggal_interaksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_interaksi->caption() ?><?= $Page->tanggal_interaksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggal_interaksi->cellAttributes() ?>>
<span id="el_interaksi_tanggal_interaksi">
<input type="<?= $Page->tanggal_interaksi->getInputTextType() ?>" name="x_tanggal_interaksi" id="x_tanggal_interaksi" data-table="interaksi" data-field="x_tanggal_interaksi" value="<?= $Page->tanggal_interaksi->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->tanggal_interaksi->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tanggal_interaksi->formatPattern()) ?>"<?= $Page->tanggal_interaksi->editAttributes() ?> aria-describedby="x_tanggal_interaksi_help">
<?= $Page->tanggal_interaksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_interaksi->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_interaksi->ReadOnly && !$Page->tanggal_interaksi->Disabled && !isset($Page->tanggal_interaksi->EditAttrs["readonly"]) && !isset($Page->tanggal_interaksi->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["finteraksiedit", "datetimepicker"], function () {
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
        "finteraksiedit",
        "x_tanggal_interaksi",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready(['finteraksiedit', 'jqueryinputmask'], function() {
	options = {
		'jitMasking': false,
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("finteraksiedit", "x_tanggal_interaksi", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="finteraksiedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="finteraksiedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(finteraksiedit.validateFields()){ew.prompt({title: ew.language.phrase("MessageEditConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#finteraksiedit").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("interaksi");
});
</script>
<?php if (Config("MS_ENTER_MOVING_CURSOR_TO_NEXT_FIELD")) { ?>
<script>
loadjs.ready("head", function() { $("#finteraksiedit:first *:input[type!=hidden]:first").focus(),$("input").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("select").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("radio").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()})});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
