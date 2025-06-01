<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$EventEdit = &$Page;
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
<form name="feventedit" id="feventedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { event: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var feventedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("feventedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["event_id", [fields.event_id.visible && fields.event_id.required ? ew.Validators.required(fields.event_id.caption) : null], fields.event_id.isInvalid],
            ["nama_event", [fields.nama_event.visible && fields.nama_event.required ? ew.Validators.required(fields.nama_event.caption) : null], fields.nama_event.isInvalid],
            ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid],
            ["tanggal_mulai", [fields.tanggal_mulai.visible && fields.tanggal_mulai.required ? ew.Validators.required(fields.tanggal_mulai.caption) : null, ew.Validators.datetime(fields.tanggal_mulai.clientFormatPattern)], fields.tanggal_mulai.isInvalid],
            ["tanggal_selesai", [fields.tanggal_selesai.visible && fields.tanggal_selesai.required ? ew.Validators.required(fields.tanggal_selesai.caption) : null, ew.Validators.datetime(fields.tanggal_selesai.clientFormatPattern)], fields.tanggal_selesai.isInvalid],
            ["lokasi", [fields.lokasi.visible && fields.lokasi.required ? ew.Validators.required(fields.lokasi.caption) : null], fields.lokasi.isInvalid],
            ["mitra_id", [fields.mitra_id.visible && fields.mitra_id.required ? ew.Validators.required(fields.mitra_id.caption) : null, ew.Validators.integer], fields.mitra_id.isInvalid],
            ["peserta_terdaftar", [fields.peserta_terdaftar.visible && fields.peserta_terdaftar.required ? ew.Validators.required(fields.peserta_terdaftar.caption) : null, ew.Validators.integer], fields.peserta_terdaftar.isInvalid]
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
<input type="hidden" name="t" value="event">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->event_id->Visible) { // event_id ?>
    <div id="r_event_id"<?= $Page->event_id->rowAttributes() ?>>
        <label id="elh_event_event_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_id->caption() ?><?= $Page->event_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->event_id->cellAttributes() ?>>
<span id="el_event_event_id">
<span<?= $Page->event_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->event_id->getDisplayValue($Page->event_id->getEditValue()))) ?>"></span>
<input type="hidden" data-table="event" data-field="x_event_id" data-hidden="1" name="x_event_id" id="x_event_id" value="<?= HtmlEncode($Page->event_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_event->Visible) { // nama_event ?>
    <div id="r_nama_event"<?= $Page->nama_event->rowAttributes() ?>>
        <label id="elh_event_nama_event" for="x_nama_event" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_event->caption() ?><?= $Page->nama_event->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama_event->cellAttributes() ?>>
<span id="el_event_nama_event">
<input type="<?= $Page->nama_event->getInputTextType() ?>" name="x_nama_event" id="x_nama_event" data-table="event" data-field="x_nama_event" value="<?= $Page->nama_event->getEditValue() ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_event->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nama_event->formatPattern()) ?>"<?= $Page->nama_event->editAttributes() ?> aria-describedby="x_nama_event_help">
<?= $Page->nama_event->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_event->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <div id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <label id="elh_event_deskripsi" for="x_deskripsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi->caption() ?><?= $Page->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_event_deskripsi">
<input type="<?= $Page->deskripsi->getInputTextType() ?>" name="x_deskripsi" id="x_deskripsi" data-table="event" data-field="x_deskripsi" value="<?= $Page->deskripsi->getEditValue() ?>" size="30" maxlength="65535" placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->deskripsi->formatPattern()) ?>"<?= $Page->deskripsi->editAttributes() ?> aria-describedby="x_deskripsi_help">
<?= $Page->deskripsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_mulai->Visible) { // tanggal_mulai ?>
    <div id="r_tanggal_mulai"<?= $Page->tanggal_mulai->rowAttributes() ?>>
        <label id="elh_event_tanggal_mulai" for="x_tanggal_mulai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_mulai->caption() ?><?= $Page->tanggal_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggal_mulai->cellAttributes() ?>>
<span id="el_event_tanggal_mulai">
<input type="<?= $Page->tanggal_mulai->getInputTextType() ?>" name="x_tanggal_mulai" id="x_tanggal_mulai" data-table="event" data-field="x_tanggal_mulai" value="<?= $Page->tanggal_mulai->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->tanggal_mulai->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tanggal_mulai->formatPattern()) ?>"<?= $Page->tanggal_mulai->editAttributes() ?> aria-describedby="x_tanggal_mulai_help">
<?= $Page->tanggal_mulai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_mulai->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_mulai->ReadOnly && !$Page->tanggal_mulai->Disabled && !isset($Page->tanggal_mulai->EditAttrs["readonly"]) && !isset($Page->tanggal_mulai->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["feventedit", "datetimepicker"], function () {
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
        "feventedit",
        "x_tanggal_mulai",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready(['feventedit', 'jqueryinputmask'], function() {
	options = {
		'jitMasking': false,
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("feventedit", "x_tanggal_mulai", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_selesai->Visible) { // tanggal_selesai ?>
    <div id="r_tanggal_selesai"<?= $Page->tanggal_selesai->rowAttributes() ?>>
        <label id="elh_event_tanggal_selesai" for="x_tanggal_selesai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_selesai->caption() ?><?= $Page->tanggal_selesai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggal_selesai->cellAttributes() ?>>
<span id="el_event_tanggal_selesai">
<input type="<?= $Page->tanggal_selesai->getInputTextType() ?>" name="x_tanggal_selesai" id="x_tanggal_selesai" data-table="event" data-field="x_tanggal_selesai" value="<?= $Page->tanggal_selesai->getEditValue() ?>" placeholder="<?= HtmlEncode($Page->tanggal_selesai->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tanggal_selesai->formatPattern()) ?>"<?= $Page->tanggal_selesai->editAttributes() ?> aria-describedby="x_tanggal_selesai_help">
<?= $Page->tanggal_selesai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_selesai->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_selesai->ReadOnly && !$Page->tanggal_selesai->Disabled && !isset($Page->tanggal_selesai->EditAttrs["readonly"]) && !isset($Page->tanggal_selesai->EditAttrs["disabled"])) { ?>
<script<?= Nonce() ?>>
loadjs.ready(["feventedit", "datetimepicker"], function () {
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
        "feventedit",
        "x_tanggal_selesai",
        ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options),
        {"inputGroup":true}
    );
});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready(['feventedit', 'jqueryinputmask'], function() {
	options = {
		'jitMasking': false,
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("feventedit", "x_tanggal_selesai", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lokasi->Visible) { // lokasi ?>
    <div id="r_lokasi"<?= $Page->lokasi->rowAttributes() ?>>
        <label id="elh_event_lokasi" for="x_lokasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lokasi->caption() ?><?= $Page->lokasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lokasi->cellAttributes() ?>>
<span id="el_event_lokasi">
<input type="<?= $Page->lokasi->getInputTextType() ?>" name="x_lokasi" id="x_lokasi" data-table="event" data-field="x_lokasi" value="<?= $Page->lokasi->getEditValue() ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->lokasi->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->lokasi->formatPattern()) ?>"<?= $Page->lokasi->editAttributes() ?> aria-describedby="x_lokasi_help">
<?= $Page->lokasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lokasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
    <div id="r_mitra_id"<?= $Page->mitra_id->rowAttributes() ?>>
        <label id="elh_event_mitra_id" for="x_mitra_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mitra_id->caption() ?><?= $Page->mitra_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mitra_id->cellAttributes() ?>>
<span id="el_event_mitra_id">
<input type="<?= $Page->mitra_id->getInputTextType() ?>" name="x_mitra_id" id="x_mitra_id" data-table="event" data-field="x_mitra_id" value="<?= $Page->mitra_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->mitra_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->mitra_id->formatPattern()) ?>"<?= $Page->mitra_id->editAttributes() ?> aria-describedby="x_mitra_id_help">
<?= $Page->mitra_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mitra_id->getErrorMessage() ?></div>
<script<?= Nonce() ?>>
loadjs.ready(['feventedit', 'jqueryinputmask'], function() {
	options = {
		'alias': 'numeric',
		'autoUnmask': true,
		'jitMasking': false,
		'groupSeparator': '<?php echo $GROUPING_SEPARATOR ?>',
		'digits': 0,
		'radixPoint': '<?php echo $DECIMAL_SEPARATOR ?>',
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("feventedit", "x_mitra_id", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->peserta_terdaftar->Visible) { // peserta_terdaftar ?>
    <div id="r_peserta_terdaftar"<?= $Page->peserta_terdaftar->rowAttributes() ?>>
        <label id="elh_event_peserta_terdaftar" for="x_peserta_terdaftar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->peserta_terdaftar->caption() ?><?= $Page->peserta_terdaftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->peserta_terdaftar->cellAttributes() ?>>
<span id="el_event_peserta_terdaftar">
<input type="<?= $Page->peserta_terdaftar->getInputTextType() ?>" name="x_peserta_terdaftar" id="x_peserta_terdaftar" data-table="event" data-field="x_peserta_terdaftar" value="<?= $Page->peserta_terdaftar->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->peserta_terdaftar->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->peserta_terdaftar->formatPattern()) ?>"<?= $Page->peserta_terdaftar->editAttributes() ?> aria-describedby="x_peserta_terdaftar_help">
<?= $Page->peserta_terdaftar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->peserta_terdaftar->getErrorMessage() ?></div>
<script<?= Nonce() ?>>
loadjs.ready(['feventedit', 'jqueryinputmask'], function() {
	options = {
		'alias': 'numeric',
		'autoUnmask': true,
		'jitMasking': false,
		'groupSeparator': '<?php echo $GROUPING_SEPARATOR ?>',
		'digits': 0,
		'radixPoint': '<?php echo $DECIMAL_SEPARATOR ?>',
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("feventedit", "x_peserta_terdaftar", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="feventedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="feventedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(feventedit.validateFields()){ew.prompt({title: ew.language.phrase("MessageEditConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#feventedit").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("event");
});
</script>
<?php if (Config("MS_ENTER_MOVING_CURSOR_TO_NEXT_FIELD")) { ?>
<script>
loadjs.ready("head", function() { $("#feventedit:first *:input[type!=hidden]:first").focus(),$("input").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("select").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("radio").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()})});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
