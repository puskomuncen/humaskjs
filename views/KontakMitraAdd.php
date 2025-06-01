<?php

namespace PHPMaker2025\humaskerjasama;

// Page object
$KontakMitraAdd = &$Page;
?>
<script<?= Nonce() ?>>
var currentTable = <?= json_encode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontak_mitra: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fkontak_mitraadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fkontak_mitraadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["mitra_id", [fields.mitra_id.visible && fields.mitra_id.required ? ew.Validators.required(fields.mitra_id.caption) : null, ew.Validators.integer], fields.mitra_id.isInvalid],
            ["nama_kontak", [fields.nama_kontak.visible && fields.nama_kontak.required ? ew.Validators.required(fields.nama_kontak.caption) : null], fields.nama_kontak.isInvalid],
            ["jabatan", [fields.jabatan.visible && fields.jabatan.required ? ew.Validators.required(fields.jabatan.caption) : null], fields.jabatan.isInvalid],
            ["email", [fields.email.visible && fields.email.required ? ew.Validators.required(fields.email.caption) : null], fields.email.isInvalid],
            ["telepon", [fields.telepon.visible && fields.telepon.required ? ew.Validators.required(fields.telepon.caption) : null], fields.telepon.isInvalid]
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
<form name="fkontak_mitraadd" id="fkontak_mitraadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CSRF_PROTECTION") && Csrf()->isEnabled()) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" id="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" id="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontak_mitra">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->getFormOldKeyName() ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->mitra_id->Visible) { // mitra_id ?>
    <div id="r_mitra_id"<?= $Page->mitra_id->rowAttributes() ?>>
        <label id="elh_kontak_mitra_mitra_id" for="x_mitra_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mitra_id->caption() ?><?= $Page->mitra_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mitra_id->cellAttributes() ?>>
<span id="el_kontak_mitra_mitra_id">
<input type="<?= $Page->mitra_id->getInputTextType() ?>" name="x_mitra_id" id="x_mitra_id" data-table="kontak_mitra" data-field="x_mitra_id" value="<?= $Page->mitra_id->getEditValue() ?>" size="30" placeholder="<?= HtmlEncode($Page->mitra_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->mitra_id->formatPattern()) ?>"<?= $Page->mitra_id->editAttributes() ?> aria-describedby="x_mitra_id_help">
<?= $Page->mitra_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mitra_id->getErrorMessage() ?></div>
<script<?= Nonce() ?>>
loadjs.ready(['fkontak_mitraadd', 'jqueryinputmask'], function() {
	options = {
		'alias': 'numeric',
		'autoUnmask': true,
		'jitMasking': false,
		'groupSeparator': '<?php echo $GROUPING_SEPARATOR ?>',
		'digits': 0,
		'radixPoint': '<?php echo $DECIMAL_SEPARATOR ?>',
		'removeMaskOnSubmit': true
	};
	ew.createjQueryInputMask("fkontak_mitraadd", "x_mitra_id", jQuery.extend(true, "", options));
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_kontak->Visible) { // nama_kontak ?>
    <div id="r_nama_kontak"<?= $Page->nama_kontak->rowAttributes() ?>>
        <label id="elh_kontak_mitra_nama_kontak" for="x_nama_kontak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_kontak->caption() ?><?= $Page->nama_kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama_kontak->cellAttributes() ?>>
<span id="el_kontak_mitra_nama_kontak">
<input type="<?= $Page->nama_kontak->getInputTextType() ?>" name="x_nama_kontak" id="x_nama_kontak" data-table="kontak_mitra" data-field="x_nama_kontak" value="<?= $Page->nama_kontak->getEditValue() ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_kontak->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->nama_kontak->formatPattern()) ?>"<?= $Page->nama_kontak->editAttributes() ?> aria-describedby="x_nama_kontak_help">
<?= $Page->nama_kontak->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_kontak->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
    <div id="r_jabatan"<?= $Page->jabatan->rowAttributes() ?>>
        <label id="elh_kontak_mitra_jabatan" for="x_jabatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan->caption() ?><?= $Page->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan->cellAttributes() ?>>
<span id="el_kontak_mitra_jabatan">
<input type="<?= $Page->jabatan->getInputTextType() ?>" name="x_jabatan" id="x_jabatan" data-table="kontak_mitra" data-field="x_jabatan" value="<?= $Page->jabatan->getEditValue() ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->jabatan->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->jabatan->formatPattern()) ?>"<?= $Page->jabatan->editAttributes() ?> aria-describedby="x_jabatan_help">
<?= $Page->jabatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jabatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->email->Visible) { // email ?>
    <div id="r_email"<?= $Page->email->rowAttributes() ?>>
        <label id="elh_kontak_mitra_email" for="x_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->email->caption() ?><?= $Page->email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->email->cellAttributes() ?>>
<span id="el_kontak_mitra_email">
<input type="<?= $Page->email->getInputTextType() ?>" name="x_email" id="x_email" data-table="kontak_mitra" data-field="x_email" value="<?= $Page->email->getEditValue() ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->email->formatPattern()) ?>"<?= $Page->email->editAttributes() ?> aria-describedby="x_email_help">
<?= $Page->email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->telepon->Visible) { // telepon ?>
    <div id="r_telepon"<?= $Page->telepon->rowAttributes() ?>>
        <label id="elh_kontak_mitra_telepon" for="x_telepon" class="<?= $Page->LeftColumnClass ?>"><?= $Page->telepon->caption() ?><?= $Page->telepon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->telepon->cellAttributes() ?>>
<span id="el_kontak_mitra_telepon">
<input type="<?= $Page->telepon->getInputTextType() ?>" name="x_telepon" id="x_telepon" data-table="kontak_mitra" data-field="x_telepon" value="<?= $Page->telepon->getEditValue() ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->telepon->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->telepon->formatPattern()) ?>"<?= $Page->telepon->editAttributes() ?> aria-describedby="x_telepon_help">
<?= $Page->telepon->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->telepon->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fkontak_mitraadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fkontak_mitraadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
loadjs.ready(["wrapper", "head", "swal"],function(){$('#btn-action').on('click',function(){if(fkontak_mitraadd.validateFields()){ew.prompt({title: ew.language.phrase("MessageAddConfirm"),icon:'question',showCancelButton:true},result=>{if(result)$("#fkontak_mitraadd").submit();});return false;} else { ew.prompt({title: ew.language.phrase("MessageInvalidForm"), icon: 'warning', showCancelButton:false}); }});});
</script>
<?php } ?>
<script<?= Nonce() ?>>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("kontak_mitra");
});
</script>
<?php if (Config("MS_ENTER_MOVING_CURSOR_TO_NEXT_FIELD")) { ?>
<script>
loadjs.ready("head", function() { $("#fkontak_mitraadd:first *:input[type!=hidden]:first").focus(),$("input").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("select").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()}),$("radio").keydown(function(i){if(13==i.which){var e=$(this).closest("form").find(":input:visible:enabled"),n=e.index(this);n==e.length-1||(e.eq(e.index(this)+1).focus(),i.preventDefault())}else 113==i.which&&$("#btn-action").click()})});
</script>
<?php } ?>
<script<?= Nonce() ?>>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
