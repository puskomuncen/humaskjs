<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$MitraEdit = &$Page;
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
<form name="fmitraedit" id="fmitraedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { mitra: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmitraedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmitraedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["mitra_id", [fields.mitra_id.visible && fields.mitra_id.required ? ew.Validators.required(fields.mitra_id.caption) : null], fields.mitra_id.isInvalid],
            ["nama_mitra", [fields.nama_mitra.visible && fields.nama_mitra.required ? ew.Validators.required(fields.nama_mitra.caption) : null], fields.nama_mitra.isInvalid],
            ["jenis_mitra", [fields.jenis_mitra.visible && fields.jenis_mitra.required ? ew.Validators.required(fields.jenis_mitra.caption) : null], fields.jenis_mitra.isInvalid],
            ["alamat", [fields.alamat.visible && fields.alamat.required ? ew.Validators.required(fields.alamat.caption) : null], fields.alamat.isInvalid],
            ["email", [fields.email.visible && fields.email.required ? ew.Validators.required(fields.email.caption) : null], fields.email.isInvalid],
            ["telepon", [fields.telepon.visible && fields.telepon.required ? ew.Validators.required(fields.telepon.caption) : null], fields.telepon.isInvalid],
            ["tanggal_bergabung", [fields.tanggal_bergabung.visible && fields.tanggal_bergabung.required ? ew.Validators.required(fields.tanggal_bergabung.caption) : null, ew.Validators.datetime(fields.tanggal_bergabung.clientFormatPattern)], fields.tanggal_bergabung.isInvalid],
            ["status_aktif", [fields.status_aktif.visible && fields.status_aktif.required ? ew.Validators.required(fields.status_aktif.caption) : null], fields.status_aktif.isInvalid]
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
            "jenis_mitra": <?= $Page->jenis_mitra->toClientList($Page) ?>,
            "status_aktif": <?= $Page->status_aktif->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="mitra">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
    <div id="r_mitra_id"<?= $Page->mitra_id->rowAttributes() ?>>
        <label id="elh_mitra_mitra_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mitra_id->caption() ?><?= $Page->mitra_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mitra_id->cellAttributes() ?>>
<span id="el_mitra_mitra_id">
<span<?= $Page->mitra_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->mitra_id->getDisplayValue($Page->mitra_id->getEditValue()))) ?>"></span>
<input type="hidden" data-table="mitra" data-field="x_mitra_id" data-hidden="1" name="x_mitra_id" id="x_mitra_id" value="<?= HtmlEncode($Page->mitra_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_mitra->Visible) { // nama_mitra ?>
    <div id="r_nama_mitra"<?= $Page->nama_mitra->rowAttributes() ?>>
        <label id="elh_mitra_nama_mitra" for="x_nama_mitra" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_mitra->caption() ?><?= $Page->nama_mitra->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama_mitra->cellAttributes() ?>>
<span id="el_mitra_nama_mitra">
<input type="<?= $Page->nama_mitra->getInputTextType() ?>" name="x_nama_mitra" id="x_nama_mitra" data-table="mitra" data-field="x_nama_mitra" value="<?= $Page->nama_mitra->getEditValue() ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_mitra->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nama_mitra->formatPattern()) ?>"<?= $Page->nama_mitra->editAttributes() ?> aria-describedby="x_nama_mitra_help">
<?= $Page->nama_mitra->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_mitra->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_mitra->Visible) { // jenis_mitra ?>
    <div id="r_jenis_mitra"<?= $Page->jenis_mitra->rowAttributes() ?>>
        <label id="elh_mitra_jenis_mitra" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_mitra->caption() ?><?= $Page->jenis_mitra->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis_mitra->cellAttributes() ?>>
<span id="el_mitra_jenis_mitra">
<template id="tp_x_jenis_mitra">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="mitra" data-field="x_jenis_mitra" name="x_jenis_mitra" id="x_jenis_mitra"<?= $Page->jenis_mitra->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_jenis_mitra" class="ew-item-list"></div>
<selection-list hidden
    id="x_jenis_mitra"
    name="x_jenis_mitra"
    value="<?= HtmlEncode($Page->jenis_mitra->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis_mitra"
    data-target="dsl_x_jenis_mitra"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis_mitra->isInvalidClass() ?>"
    data-table="mitra"
    data-field="x_jenis_mitra"
    data-value-separator="<?= $Page->jenis_mitra->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis_mitra->editAttributes() ?>></selection-list>
<?= $Page->jenis_mitra->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_mitra->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <div id="r_alamat"<?= $Page->alamat->rowAttributes() ?>>
        <label id="elh_mitra_alamat" for="x_alamat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alamat->caption() ?><?= $Page->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->alamat->cellAttributes() ?>>
<span id="el_mitra_alamat">
<input type="<?= $Page->alamat->getInputTextType() ?>" name="x_alamat" id="x_alamat" data-table="mitra" data-field="x_alamat" value="<?= $Page->alamat->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->alamat->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->alamat->formatPattern()) ?>"<?= $Page->alamat->editAttributes() ?> aria-describedby="x_alamat_help">
<?= $Page->alamat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alamat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
    <div id="r_email"<?= $Page->email->rowAttributes() ?>>
        <label id="elh_mitra_email" for="x_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email->caption() ?><?= $Page->email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->email->cellAttributes() ?>>
<span id="el_mitra_email">
<input type="<?= $Page->email->getInputTextType() ?>" name="x_email" id="x_email" data-table="mitra" data-field="x_email" value="<?= $Page->email->getEditValue() ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->email->formatPattern()) ?>"<?= $Page->email->editAttributes() ?> aria-describedby="x_email_help">
<?= $Page->email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->telepon->Visible) { // telepon ?>
    <div id="r_telepon"<?= $Page->telepon->rowAttributes() ?>>
        <label id="elh_mitra_telepon" for="x_telepon" class="<?= $Page->LeftColumnClass ?>"><?= $Page->telepon->caption() ?><?= $Page->telepon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->telepon->cellAttributes() ?>>
<span id="el_mitra_telepon">
<input type="<?= $Page->telepon->getInputTextType() ?>" name="x_telepon" id="x_telepon" data-table="mitra" data-field="x_telepon" value="<?= $Page->telepon->getEditValue() ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->telepon->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->telepon->formatPattern()) ?>"<?= $Page->telepon->editAttributes() ?> aria-describedby="x_telepon_help">
<?= $Page->telepon->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->telepon->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_bergabung->Visible) { // tanggal_bergabung ?>
    <div id="r_tanggal_bergabung"<?= $Page->tanggal_bergabung->rowAttributes() ?>>
        <label id="elh_mitra_tanggal_bergabung" for="x_tanggal_bergabung" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_bergabung->caption() ?><?= $Page->tanggal_bergabung->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggal_bergabung->cellAttributes() ?>>
<span id="el_mitra_tanggal_bergabung">
<input type="<?= $Page->tanggal_bergabung->getInputTextType() ?>" name="x_tanggal_bergabung" id="x_tanggal_bergabung" data-table="mitra" data-field="x_tanggal_bergabung" value="<?= $Page->tanggal_bergabung->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->tanggal_bergabung->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tanggal_bergabung->formatPattern()) ?>"<?= $Page->tanggal_bergabung->editAttributes() ?> aria-describedby="x_tanggal_bergabung_help">
<?= $Page->tanggal_bergabung->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_bergabung->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_bergabung->ReadOnly && !$Page->tanggal_bergabung->Disabled && !isset($Page->tanggal_bergabung->EditAttrs["readonly"]) && !isset($Page->tanggal_bergabung->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["fmitraedit", "datetimepicker"], function () {
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
        "fmitraedit",
        "x_tanggal_bergabung",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready(['fmitraedit', 'jqueryinputmask'], function() {
	options = {
		'jitMasking': false,
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("fmitraedit", "x_tanggal_bergabung", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_aktif->Visible) { // status_aktif ?>
    <div id="r_status_aktif"<?= $Page->status_aktif->rowAttributes() ?>>
        <label id="elh_mitra_status_aktif" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_aktif->caption() ?><?= $Page->status_aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status_aktif->cellAttributes() ?>>
<span id="el_mitra_status_aktif">
<div class="form-check form-switch d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->status_aktif->isInvalidClass() ?>" data-table="mitra" data-field="x_status_aktif" data-boolean name="x_status_aktif" id="x_status_aktif" value="1"<?= ConvertToBool($Page->status_aktif->CurrentValue) ? " checked" : "" ?><?= $Page->status_aktif->editAttributes() ?> aria-describedby="x_status_aktif_help">
    <div class="invalid-feedback"><?= $Page->status_aktif->getErrorMessage() ?></div>
</div>
<?= $Page->status_aktif->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmitraedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmitraedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fmitraedit.validateFields()){ew.prompt({title: ew.language.phrase("MessageEditConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#fmitraedit").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("mitra");
});
</script>
<?php if (Config("MS_ENTER_MOVING_CURSOR_TO_NEXT_FIELD")) { ?>
<script>
loadjs.ready("head", function() { $("#fmitraedit:first *:input[type!=hidden]:first").focus(),$("input").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("select").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("radio").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()})});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
