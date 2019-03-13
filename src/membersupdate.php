<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membersinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$members_update = new cmembers_update();
$Page =& $members_update;

// Page init
$members_update->Page_Init();

// Page main
$members_update->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var members_update = new ew_Page("members_update");

// page properties
members_update.PageID = "update"; // page ID
members_update.FormID = "fmembersupdate"; // form ID
var EW_PAGE_ID = members_update.PageID; // for backward compatibility

// extend page with ValidateForm function
members_update.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		alert(ewLanguage.Phrase("NoFieldSelected"));
		return false;
	}
	var uelm;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_regis_date"];
		uelm = fobj.elements["u" + infix + "_regis_date"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->regis_date->FldCaption()) ?>");
		}
		elm = fobj.elements["x" + infix + "_regis_date"];
		uelm = fobj.elements["u" + infix + "_regis_date"];
		if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->regis_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_effective_date"];
		uelm = fobj.elements["u" + infix + "_effective_date"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->effective_date->FldCaption()) ?>");
		}
		elm = fobj.elements["x" + infix + "_effective_date"];
		uelm = fobj.elements["u" + infix + "_effective_date"];
		if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->effective_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_member_status"];
		uelm = fobj.elements["u" + infix + "_member_status"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->member_status->FldCaption()) ?>");
		}
		elm = fobj.elements["x" + infix + "_resign_date"];
		uelm = fobj.elements["u" + infix + "_resign_date"];
		if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->resign_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_dead_date"];
		uelm = fobj.elements["u" + infix + "_dead_date"];
		if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->dead_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_terminate_date"];
		uelm = fobj.elements["u" + infix + "_terminate_date"];
		if (uelm && uelm.checked && elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->terminate_date->FldErrMsg()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
members_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
members_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
members_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
members_update.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
members_update.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Update") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $members->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></p>
<?php $members_update->ShowPageHeader(); ?>
<?php
$members_update->ShowMessage();
?>
<form name="fmembersupdate" id="fmembersupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return members_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="members">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php foreach ($members_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tr class="ewTableHeader">
		<td><?php echo $Language->Phrase("UpdateValue") ?><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td><?php echo $Language->Phrase("FieldName") ?></td>
		<td><?php echo $Language->Phrase("NewValue") ?></td>
	</tr>
<?php if ($members->regis_date->Visible) { // regis_date ?>
	<tr id="r_regis_date"<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->regis_date->CellAttributes() ?>>
<input type="checkbox" name="u_regis_date" id="u_regis_date" value="1"<?php echo ($members->regis_date->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $members->regis_date->CellAttributes() ?>><?php echo $members->regis_date->FldCaption() ?></td>
		<td<?php echo $members->regis_date->CellAttributes() ?>><span id="el_regis_date">
<input type="text" name="x_regis_date" id="x_regis_date" value="<?php echo $members->regis_date->EditValue ?>"<?php echo $members->regis_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_regis_date" name="cal_x_regis_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_regis_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_regis_date" // button id
});
</script>
</span><?php echo $members->regis_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->effective_date->Visible) { // effective_date ?>
	<tr id="r_effective_date"<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->effective_date->CellAttributes() ?>>
<input type="checkbox" name="u_effective_date" id="u_effective_date" value="1"<?php echo ($members->effective_date->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $members->effective_date->CellAttributes() ?>><?php echo $members->effective_date->FldCaption() ?></td>
		<td<?php echo $members->effective_date->CellAttributes() ?>><span id="el_effective_date">
<input type="text" name="x_effective_date" id="x_effective_date" value="<?php echo $members->effective_date->EditValue ?>"<?php echo $members->effective_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_effective_date" name="cal_x_effective_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_effective_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_effective_date" // button id
});
</script>
</span><?php echo $members->effective_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->attachment->Visible) { // attachment ?>
	<tr id="r_attachment"<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->attachment->CellAttributes() ?>>
<input type="checkbox" name="u_attachment" id="u_attachment" value="1"<?php echo ($members->attachment->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $members->attachment->CellAttributes() ?>><?php echo $members->attachment->FldCaption() ?></td>
		<td<?php echo $members->attachment->CellAttributes() ?>><span id="el_attachment">
<input type="text" name="x_attachment" id="x_attachment" size="30" maxlength="10" value="<?php echo $members->attachment->EditValue ?>"<?php echo $members->attachment->EditAttributes() ?>>
</span><?php echo $members->attachment->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->member_status->Visible) { // member_status ?>
	<tr id="r_member_status"<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->member_status->CellAttributes() ?>>
<input type="checkbox" name="u_member_status" id="u_member_status" value="1"<?php echo ($members->member_status->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $members->member_status->CellAttributes() ?>><?php echo $members->member_status->FldCaption() ?></td>
		<td<?php echo $members->member_status->CellAttributes() ?>><span id="el_member_status">
<select id="x_member_status" name="x_member_status"<?php echo $members->member_status->EditAttributes() ?>>
<?php
if (is_array($members->member_status->EditValue)) {
	$arwrk = $members->member_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->member_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `s_title`, `s_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `memberstatus`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_member_status" id="s_x_member_status" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_member_status" id="lft_x_member_status" value="">
</span><?php echo $members->member_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->resign_date->Visible) { // resign_date ?>
	<tr id="r_resign_date"<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->resign_date->CellAttributes() ?>>
<input type="checkbox" name="u_resign_date" id="u_resign_date" value="1"<?php echo ($members->resign_date->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $members->resign_date->CellAttributes() ?>><?php echo $members->resign_date->FldCaption() ?></td>
		<td<?php echo $members->resign_date->CellAttributes() ?>><span id="el_resign_date">
<input type="text" name="x_resign_date" id="x_resign_date" value="<?php echo $members->resign_date->EditValue ?>"<?php echo $members->resign_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_resign_date" name="cal_x_resign_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_resign_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_resign_date" // button id
});
</script>
</span><?php echo $members->resign_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->dead_date->Visible) { // dead_date ?>
	<tr id="r_dead_date"<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->dead_date->CellAttributes() ?>>
<input type="checkbox" name="u_dead_date" id="u_dead_date" value="1"<?php echo ($members->dead_date->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $members->dead_date->CellAttributes() ?>><?php echo $members->dead_date->FldCaption() ?></td>
		<td<?php echo $members->dead_date->CellAttributes() ?>><span id="el_dead_date">
<input type="text" name="x_dead_date" id="x_dead_date" value="<?php echo $members->dead_date->EditValue ?>"<?php echo $members->dead_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_dead_date" name="cal_x_dead_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_dead_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_dead_date" // button id
});
</script>
</span><?php echo $members->dead_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->terminate_date->Visible) { // terminate_date ?>
	<tr id="r_terminate_date"<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->terminate_date->CellAttributes() ?>>
<input type="checkbox" name="u_terminate_date" id="u_terminate_date" value="1"<?php echo ($members->terminate_date->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $members->terminate_date->CellAttributes() ?>><?php echo $members->terminate_date->FldCaption() ?></td>
		<td<?php echo $members->terminate_date->CellAttributes() ?>><span id="el_terminate_date">
<input type="text" name="x_terminate_date" id="x_terminate_date" value="<?php echo $members->terminate_date->EditValue ?>"<?php echo $members->terminate_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_terminate_date" name="cal_x_terminate_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_terminate_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_terminate_date" // button id
});
</script>
</span><?php echo $members->terminate_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->note->Visible) { // note ?>
	<tr id="r_note"<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->note->CellAttributes() ?>>
<input type="checkbox" name="u_note" id="u_note" value="1"<?php echo ($members->note->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $members->note->CellAttributes() ?>><?php echo $members->note->FldCaption() ?></td>
		<td<?php echo $members->note->CellAttributes() ?>><span id="el_note">
<textarea name="x_note" id="x_note" cols="35" rows="4"<?php echo $members->note->EditAttributes() ?>><?php echo $members->note->EditValue ?></textarea>
</span><?php echo $members->note->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("UpdateBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_member_status','x_member_status',false]]);

//-->
</script>
<?php
$members_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$members_update->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_update {

	// Page ID
	var $PageID = 'update';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_update';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $members;
		if ($members->UseTokenInUrl) $PageUrl .= "t=" . $members->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $members;
		if ($members->UseTokenInUrl) {
			if ($objForm)
				return ($members->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($members->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembers_update() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (members)
		if (!isset($GLOBALS["members"])) {
			$GLOBALS["members"] = new cmembers();
			$GLOBALS["Table"] =& $GLOBALS["members"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'members', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $members;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $RecKeys;
	var $Disabled;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $members;

		// Try to load keys from list form
		$this->RecKeys = $members->GetRecordKeys(); // Load record keys
		if (@$_POST["a_update"] <> "") {

			// Get action
			$members->CurrentAction = $_POST["a_update"];
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$members->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else {
			$this->LoadMultiUpdateValues(); // Load initial values to form
		}
		if (count($this->RecKeys) <= 0)
			$this->Page_Terminate("memberslist.php"); // No records selected, return to list
		switch ($members->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set update success message
					$this->Page_Terminate($members->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$members->RowType = EW_ROWTYPE_EDIT; // Render edit
		$members->ResetAttrs();
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $members;
		$members->CurrentFilter = $members->GetKeyFilter();

		// Load recordset
		if ($this->Recordset = $this->LoadRecordset()) {
			$i = 1;
			while (!$this->Recordset->EOF) {
				if ($i == 1) {
					$members->regis_date->setDbValue($this->Recordset->fields('regis_date'));
					$members->effective_date->setDbValue($this->Recordset->fields('effective_date'));
					$members->attachment->setDbValue($this->Recordset->fields('attachment'));
					$members->member_status->setDbValue($this->Recordset->fields('member_status'));
					$members->resign_date->setDbValue($this->Recordset->fields('resign_date'));
					$members->dead_date->setDbValue($this->Recordset->fields('dead_date'));
					$members->terminate_date->setDbValue($this->Recordset->fields('terminate_date'));
					$members->note->setDbValue($this->Recordset->fields('note'));
				} else {
					if (!ew_CompareValue($members->regis_date->DbValue, $this->Recordset->fields('regis_date')))
						$members->regis_date->CurrentValue = NULL;
					if (!ew_CompareValue($members->effective_date->DbValue, $this->Recordset->fields('effective_date')))
						$members->effective_date->CurrentValue = NULL;
					if (!ew_CompareValue($members->attachment->DbValue, $this->Recordset->fields('attachment')))
						$members->attachment->CurrentValue = NULL;
					if (!ew_CompareValue($members->member_status->DbValue, $this->Recordset->fields('member_status')))
						$members->member_status->CurrentValue = NULL;
					if (!ew_CompareValue($members->resign_date->DbValue, $this->Recordset->fields('resign_date')))
						$members->resign_date->CurrentValue = NULL;
					if (!ew_CompareValue($members->dead_date->DbValue, $this->Recordset->fields('dead_date')))
						$members->dead_date->CurrentValue = NULL;
					if (!ew_CompareValue($members->terminate_date->DbValue, $this->Recordset->fields('terminate_date')))
						$members->terminate_date->CurrentValue = NULL;
					if (!ew_CompareValue($members->note->DbValue, $this->Recordset->fields('note')))
						$members->note->CurrentValue = NULL;
				}
				$i++;
				$this->Recordset->MoveNext();
			}
			$this->Recordset->Close();
		}
	}

	// Set up key value
	function SetupKeyValues($key) {
		global $members;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$members->member_id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $Language, $members;
		$conn->BeginTrans();

		// Get old recordset
		$members->CurrentFilter = $members->GetKeyFilter();
		$sSql = $members->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->RecKeys as $key) {
			if ($this->SetupKeyValues($key)) {
				$sThisKey = $key;
				$members->SendEmail = FALSE; // Do not send email on update success
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				break; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $members;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $members;
		if (!$members->regis_date->FldIsDetailKey) {
			$members->regis_date->setFormValue($objForm->GetValue("x_regis_date"));
			$members->regis_date->CurrentValue = ew_UnFormatDateTime($members->regis_date->CurrentValue, 7);
		}
		$members->regis_date->MultiUpdate = $objForm->GetValue("u_regis_date");
		if (!$members->effective_date->FldIsDetailKey) {
			$members->effective_date->setFormValue($objForm->GetValue("x_effective_date"));
			$members->effective_date->CurrentValue = ew_UnFormatDateTime($members->effective_date->CurrentValue, 7);
		}
		$members->effective_date->MultiUpdate = $objForm->GetValue("u_effective_date");
		if (!$members->attachment->FldIsDetailKey) {
			$members->attachment->setFormValue($objForm->GetValue("x_attachment"));
		}
		$members->attachment->MultiUpdate = $objForm->GetValue("u_attachment");
		if (!$members->member_status->FldIsDetailKey) {
			$members->member_status->setFormValue($objForm->GetValue("x_member_status"));
		}
		$members->member_status->MultiUpdate = $objForm->GetValue("u_member_status");
		if (!$members->resign_date->FldIsDetailKey) {
			$members->resign_date->setFormValue($objForm->GetValue("x_resign_date"));
			$members->resign_date->CurrentValue = ew_UnFormatDateTime($members->resign_date->CurrentValue, 7);
		}
		$members->resign_date->MultiUpdate = $objForm->GetValue("u_resign_date");
		if (!$members->dead_date->FldIsDetailKey) {
			$members->dead_date->setFormValue($objForm->GetValue("x_dead_date"));
			$members->dead_date->CurrentValue = ew_UnFormatDateTime($members->dead_date->CurrentValue, 7);
		}
		$members->dead_date->MultiUpdate = $objForm->GetValue("u_dead_date");
		if (!$members->terminate_date->FldIsDetailKey) {
			$members->terminate_date->setFormValue($objForm->GetValue("x_terminate_date"));
			$members->terminate_date->CurrentValue = ew_UnFormatDateTime($members->terminate_date->CurrentValue, 7);
		}
		$members->terminate_date->MultiUpdate = $objForm->GetValue("u_terminate_date");
		if (!$members->note->FldIsDetailKey) {
			$members->note->setFormValue($objForm->GetValue("x_note"));
		}
		$members->note->MultiUpdate = $objForm->GetValue("u_note");
		if (!$members->member_id->FldIsDetailKey)
			$members->member_id->setFormValue($objForm->GetValue("x_member_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $members;
		$members->member_id->CurrentValue = $members->member_id->FormValue;
		$members->regis_date->CurrentValue = $members->regis_date->FormValue;
		$members->regis_date->CurrentValue = ew_UnFormatDateTime($members->regis_date->CurrentValue, 7);
		$members->effective_date->CurrentValue = $members->effective_date->FormValue;
		$members->effective_date->CurrentValue = ew_UnFormatDateTime($members->effective_date->CurrentValue, 7);
		$members->attachment->CurrentValue = $members->attachment->FormValue;
		$members->member_status->CurrentValue = $members->member_status->FormValue;
		$members->resign_date->CurrentValue = $members->resign_date->FormValue;
		$members->resign_date->CurrentValue = ew_UnFormatDateTime($members->resign_date->CurrentValue, 7);
		$members->dead_date->CurrentValue = $members->dead_date->FormValue;
		$members->dead_date->CurrentValue = ew_UnFormatDateTime($members->dead_date->CurrentValue, 7);
		$members->terminate_date->CurrentValue = $members->terminate_date->FormValue;
		$members->terminate_date->CurrentValue = ew_UnFormatDateTime($members->terminate_date->CurrentValue, 7);
		$members->note->CurrentValue = $members->note->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $members;

		// Call Recordset Selecting event
		$members->Recordset_Selecting($members->CurrentFilter);

		// Load List page SQL
		$sSql = $members->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$members->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $members;

		// Initialize URLs
		// Call Row_Rendering event

		$members->Row_Rendering();

		// Common render codes for all row types
		// member_id
		// member_code
		// id_code
		// prefix
		// gender
		// fname
		// lname
		// birthdate
		// age
		// email
		// address
		// t_code
		// village_id
		// phone
		// suffix
		// bnfc1_name
		// bnfc1_rel
		// bnfc2_name
		// bnfc2_rel
		// bnfc3_name
		// bnfc3_rel
		// bnfc4_name
		// bnfc4_rel
		// regis_date
		// effective_date
		// attachment
		// member_status
		// resign_date
		// dead_date
		// terminate_date
		// advance_budget
		// dead_id
		// note
		// update_detail
		// member_type

		if ($members->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$members->member_code->ViewValue = $members->member_code->CurrentValue;
			$members->member_code->ViewCustomAttributes = "";

			// id_code
			$members->id_code->ViewValue = $members->id_code->CurrentValue;
			$members->id_code->ViewCustomAttributes = "";

			// prefix
			if (strval($members->prefix->CurrentValue) <> "") {
				$sFilterWrk = "`p_title` = '" . ew_AdjustSql($members->prefix->CurrentValue) . "'";
			$sSqlWrk = "SELECT `p_title` FROM `prefix`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->prefix->ViewValue = $rswrk->fields('p_title');
					$rswrk->Close();
				} else {
					$members->prefix->ViewValue = $members->prefix->CurrentValue;
				}
			} else {
				$members->prefix->ViewValue = NULL;
			}
			$members->prefix->ViewCustomAttributes = "";

			// gender
			if (strval($members->gender->CurrentValue) <> "") {
				$sFilterWrk = "`g_title` = '" . ew_AdjustSql($members->gender->CurrentValue) . "'";
			$sSqlWrk = "SELECT `g_title` FROM `gender`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->gender->ViewValue = $rswrk->fields('g_title');
					$rswrk->Close();
				} else {
					$members->gender->ViewValue = $members->gender->CurrentValue;
				}
			} else {
				$members->gender->ViewValue = NULL;
			}
			$members->gender->ViewCustomAttributes = "";

			// fname
			$members->fname->ViewValue = $members->fname->CurrentValue;
			$members->fname->ViewCustomAttributes = "";

			// lname
			$members->lname->ViewValue = $members->lname->CurrentValue;
			$members->lname->ViewCustomAttributes = "";

			// birthdate
			$members->birthdate->ViewValue = $members->birthdate->CurrentValue;
			$members->birthdate->ViewValue = ew_FormatDateTime($members->birthdate->ViewValue, 7);
			$members->birthdate->ViewCustomAttributes = "";

			// age
			$members->age->ViewValue = $members->age->CurrentValue;
			$members->age->ViewCustomAttributes = "";

			// address
			$members->address->ViewValue = $members->address->CurrentValue;
			$members->address->ViewCustomAttributes = "";

			// t_code
			if (strval($members->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($members->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->t_code->ViewValue = $rswrk->fields('t_code');
					$members->t_code->ViewValue .= ew_ValueSeparator(0,1,$members->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$members->t_code->ViewValue = $members->t_code->CurrentValue;
				}
			} else {
				$members->t_code->ViewValue = NULL;
			}
			$members->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($members->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($members->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->village_id->ViewValue = $rswrk->fields('v_code');
					$members->village_id->ViewValue .= ew_ValueSeparator(0,1,$members->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$members->village_id->ViewValue = $members->village_id->CurrentValue;
				}
			} else {
				$members->village_id->ViewValue = NULL;
			}
			$members->village_id->ViewCustomAttributes = "";

			// phone
			$members->phone->ViewValue = $members->phone->CurrentValue;
			$members->phone->ViewCustomAttributes = "";

			// bnfc1_name
			$members->bnfc1_name->ViewValue = $members->bnfc1_name->CurrentValue;
			$members->bnfc1_name->ViewCustomAttributes = "";

			// bnfc1_rel
			$members->bnfc1_rel->ViewValue = $members->bnfc1_rel->CurrentValue;
			$members->bnfc1_rel->ViewCustomAttributes = "";

			// bnfc2_name
			$members->bnfc2_name->ViewValue = $members->bnfc2_name->CurrentValue;
			$members->bnfc2_name->ViewCustomAttributes = "";

			// bnfc2_rel
			$members->bnfc2_rel->ViewValue = $members->bnfc2_rel->CurrentValue;
			$members->bnfc2_rel->ViewCustomAttributes = "";

			// bnfc3_name
			$members->bnfc3_name->ViewValue = $members->bnfc3_name->CurrentValue;
			$members->bnfc3_name->ViewCustomAttributes = "";

			// bnfc3_rel
			$members->bnfc3_rel->ViewValue = $members->bnfc3_rel->CurrentValue;
			$members->bnfc3_rel->ViewCustomAttributes = "";

			// regis_date
			$members->regis_date->ViewValue = $members->regis_date->CurrentValue;
			$members->regis_date->ViewValue = ew_FormatDateTime($members->regis_date->ViewValue, 7);
			$members->regis_date->ViewCustomAttributes = "";

			// effective_date
			$members->effective_date->ViewValue = $members->effective_date->CurrentValue;
			$members->effective_date->ViewValue = ew_FormatDateTime($members->effective_date->ViewValue, 7);
			$members->effective_date->ViewCustomAttributes = "";

			// attachment
			$members->attachment->ViewValue = $members->attachment->CurrentValue;
			$members->attachment->ViewCustomAttributes = "";

			// member_status
			if (strval($members->member_status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($members->member_status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->member_status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$members->member_status->ViewValue = $members->member_status->CurrentValue;
				}
			} else {
				$members->member_status->ViewValue = NULL;
			}
			$members->member_status->ViewCustomAttributes = "";

			// resign_date
			$members->resign_date->ViewValue = $members->resign_date->CurrentValue;
			$members->resign_date->ViewValue = ew_FormatDateTime($members->resign_date->ViewValue, 7);
			$members->resign_date->ViewCustomAttributes = "";

			// dead_date
			$members->dead_date->ViewValue = $members->dead_date->CurrentValue;
			$members->dead_date->ViewValue = ew_FormatDateTime($members->dead_date->ViewValue, 7);
			$members->dead_date->ViewCustomAttributes = "";

			// terminate_date
			$members->terminate_date->ViewValue = $members->terminate_date->CurrentValue;
			$members->terminate_date->ViewValue = ew_FormatDateTime($members->terminate_date->ViewValue, 7);
			$members->terminate_date->ViewCustomAttributes = "";

			// note
			$members->note->ViewValue = $members->note->CurrentValue;
			$members->note->ViewCustomAttributes = "";

			// regis_date
			$members->regis_date->LinkCustomAttributes = "";
			$members->regis_date->HrefValue = "";
			$members->regis_date->TooltipValue = "";

			// effective_date
			$members->effective_date->LinkCustomAttributes = "";
			$members->effective_date->HrefValue = "";
			$members->effective_date->TooltipValue = "";

			// attachment
			$members->attachment->LinkCustomAttributes = "";
			$members->attachment->HrefValue = "";
			$members->attachment->TooltipValue = "";

			// member_status
			$members->member_status->LinkCustomAttributes = "";
			$members->member_status->HrefValue = "";
			$members->member_status->TooltipValue = "";

			// resign_date
			$members->resign_date->LinkCustomAttributes = "";
			$members->resign_date->HrefValue = "";
			$members->resign_date->TooltipValue = "";

			// dead_date
			$members->dead_date->LinkCustomAttributes = "";
			$members->dead_date->HrefValue = "";
			$members->dead_date->TooltipValue = "";

			// terminate_date
			$members->terminate_date->LinkCustomAttributes = "";
			$members->terminate_date->HrefValue = "";
			$members->terminate_date->TooltipValue = "";

			// note
			$members->note->LinkCustomAttributes = "";
			$members->note->HrefValue = "";
			$members->note->TooltipValue = "";
		} elseif ($members->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// regis_date
			$members->regis_date->EditCustomAttributes = "";
			$members->regis_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->regis_date->CurrentValue, 7));

			// effective_date
			$members->effective_date->EditCustomAttributes = "";
			$members->effective_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->effective_date->CurrentValue, 7));

			// attachment
			$members->attachment->EditCustomAttributes = "";
			$members->attachment->EditValue = ew_HtmlEncode($members->attachment->CurrentValue);

			// member_status
			$members->member_status->EditCustomAttributes = 'onchange=showmemberfield(this.options[this.selectedIndex].value);';
			if (trim(strval($members->member_status->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($members->member_status->CurrentValue) . "'";
			}
			$sSqlWrk = "SELECT `s_title`, `s_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$members->member_status->EditValue = $arwrk;

			// resign_date
			$members->resign_date->EditCustomAttributes = "";
			$members->resign_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->resign_date->CurrentValue, 7));

			// dead_date
			$members->dead_date->EditCustomAttributes = "";
			$members->dead_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->dead_date->CurrentValue, 7));

			// terminate_date
			$members->terminate_date->EditCustomAttributes = "";
			$members->terminate_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->terminate_date->CurrentValue, 7));

			// note
			$members->note->EditCustomAttributes = "";
			$members->note->EditValue = ew_HtmlEncode($members->note->CurrentValue);

			// Edit refer script
			// regis_date

			$members->regis_date->HrefValue = "";

			// effective_date
			$members->effective_date->HrefValue = "";

			// attachment
			$members->attachment->HrefValue = "";

			// member_status
			$members->member_status->HrefValue = "";

			// resign_date
			$members->resign_date->HrefValue = "";

			// dead_date
			$members->dead_date->HrefValue = "";

			// terminate_date
			$members->terminate_date->HrefValue = "";

			// note
			$members->note->HrefValue = "";
		}
		if ($members->RowType == EW_ROWTYPE_ADD ||
			$members->RowType == EW_ROWTYPE_EDIT ||
			$members->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$members->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($members->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$members->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $members;

		// Initialize form error message
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($members->regis_date->MultiUpdate == "1") $lUpdateCnt++;
		if ($members->effective_date->MultiUpdate == "1") $lUpdateCnt++;
		if ($members->attachment->MultiUpdate == "1") $lUpdateCnt++;
		if ($members->member_status->MultiUpdate == "1") $lUpdateCnt++;
		if ($members->resign_date->MultiUpdate == "1") $lUpdateCnt++;
		if ($members->dead_date->MultiUpdate == "1") $lUpdateCnt++;
		if ($members->terminate_date->MultiUpdate == "1") $lUpdateCnt++;
		if ($members->note->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($members->regis_date->MultiUpdate <> "" && !is_null($members->regis_date->FormValue) && $members->regis_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->regis_date->FldCaption());
		}
		if ($members->regis_date->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($members->regis_date->FormValue)) {
				ew_AddMessage($gsFormError, $members->regis_date->FldErrMsg());
			}
		}
		if ($members->effective_date->MultiUpdate <> "" && !is_null($members->effective_date->FormValue) && $members->effective_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->effective_date->FldCaption());
		}
		if ($members->effective_date->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($members->effective_date->FormValue)) {
				ew_AddMessage($gsFormError, $members->effective_date->FldErrMsg());
			}
		}
		if ($members->member_status->MultiUpdate <> "" && !is_null($members->member_status->FormValue) && $members->member_status->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->member_status->FldCaption());
		}
		if ($members->resign_date->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($members->resign_date->FormValue)) {
				ew_AddMessage($gsFormError, $members->resign_date->FldErrMsg());
			}
		}
		if ($members->dead_date->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($members->dead_date->FormValue)) {
				ew_AddMessage($gsFormError, $members->dead_date->FldErrMsg());
			}
		}
		if ($members->terminate_date->MultiUpdate <> "") {
			if (!ew_CheckEuroDate($members->terminate_date->FormValue)) {
				ew_AddMessage($gsFormError, $members->terminate_date->FldErrMsg());
			}
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $members;
		$sFilter = $members->KeyFilter();
			if ($members->member_code->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`member_code` = '" . ew_AdjustSql($members->member_code->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$members->CurrentFilter = $sFilterChk;
			$sSqlChk = $members->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $members->member_code->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $members->member_code->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
			if ($members->id_code->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`id_code` = '" . ew_AdjustSql($members->id_code->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$members->CurrentFilter = $sFilterChk;
			$sSqlChk = $members->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $members->id_code->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $members->id_code->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$members->CurrentFilter = $sFilter;
		$sSql = $members->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// regis_date
			$members->regis_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->regis_date->CurrentValue, 7), NULL, $members->regis_date->ReadOnly || $members->regis_date->MultiUpdate <> "1");

			// effective_date
			$members->effective_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->effective_date->CurrentValue, 7), ew_CurrentDate(), $members->effective_date->ReadOnly || $members->effective_date->MultiUpdate <> "1");

			// attachment
			$members->attachment->SetDbValueDef($rsnew, $members->attachment->CurrentValue, NULL, $members->attachment->ReadOnly || $members->attachment->MultiUpdate <> "1");

			// member_status
			$members->member_status->SetDbValueDef($rsnew, $members->member_status->CurrentValue, NULL, $members->member_status->ReadOnly || $members->member_status->MultiUpdate <> "1");

			// resign_date
			$members->resign_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->resign_date->CurrentValue, 7), NULL, $members->resign_date->ReadOnly || $members->resign_date->MultiUpdate <> "1");

			// dead_date
			$members->dead_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->dead_date->CurrentValue, 7), NULL, $members->dead_date->ReadOnly || $members->dead_date->MultiUpdate <> "1");

			// terminate_date
			$members->terminate_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->terminate_date->CurrentValue, 7), NULL, $members->terminate_date->ReadOnly || $members->terminate_date->MultiUpdate <> "1");

			// note
			$members->note->SetDbValueDef($rsnew, $members->note->CurrentValue, NULL, $members->note->ReadOnly || $members->note->MultiUpdate <> "1");

			// Call Row Updating event
			$bUpdateRow = $members->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($members->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($members->CancelMessage <> "") {
					$this->setFailureMessage($members->CancelMessage);
					$members->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$members->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
