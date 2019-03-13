<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expresspaymentinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expresspayment_delete = new cexpresspayment_delete();
$Page =& $expresspayment_delete;

// Page init
$expresspayment_delete->Page_Init();

// Page main
$expresspayment_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expresspayment_delete = new ew_Page("expresspayment_delete");

// page properties
expresspayment_delete.PageID = "delete"; // page ID
expresspayment_delete.FormID = "fexpresspaymentdelete"; // form ID
var EW_PAGE_ID = expresspayment_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expresspayment_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expresspayment_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expresspayment_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expresspayment_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($expresspayment_delete->Recordset = $expresspayment_delete->LoadRecordset())
	$expresspayment_deleteTotalRecs = $expresspayment_delete->Recordset->RecordCount(); // Get record count
if ($expresspayment_deleteTotalRecs <= 0) { // No record found, exit
	if ($expresspayment_delete->Recordset)
		$expresspayment_delete->Recordset->Close();
	$expresspayment_delete->Page_Terminate("expresspaymentlist.php"); // Return to list
}
?>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expresspayment->TableCaption() ?></div>
<div class="clear"></div>
<p class="phpmaker"><a href="<?php echo $expresspayment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $expresspayment_delete->ShowPageHeader(); ?>
<?php
$expresspayment_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="expresspayment">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($expresspayment_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $expresspayment->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $expresspayment->t_code->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->village_id->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->subv_total->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->subv_detail->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->adv_total->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->adv_detail->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->annual_total->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->annual_detail->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->regis_total->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->regis_detail->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->other_total->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->other_detail->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->expr_total->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->expr_note->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->expr_pay_date->FldCaption() ?></td>
		<td valign="top"><?php echo $expresspayment->expr_slipt_num->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$expresspayment_delete->RecCnt = 0;
$i = 0;
while (!$expresspayment_delete->Recordset->EOF) {
	$expresspayment_delete->RecCnt++;

	// Set row properties
	$expresspayment->ResetAttrs();
	$expresspayment->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$expresspayment_delete->LoadRowValues($expresspayment_delete->Recordset);

	// Render row
	$expresspayment_delete->RenderRow();
?>
	<tr<?php echo $expresspayment->RowAttributes() ?>>
		<td<?php echo $expresspayment->t_code->CellAttributes() ?>>
<div<?php echo $expresspayment->t_code->ViewAttributes() ?>><?php echo $expresspayment->t_code->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->village_id->CellAttributes() ?>>
<div<?php echo $expresspayment->village_id->ViewAttributes() ?>><?php echo $expresspayment->village_id->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->subv_total->CellAttributes() ?>>
<div<?php echo $expresspayment->subv_total->ViewAttributes() ?>><?php echo $expresspayment->subv_total->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->subv_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->subv_detail->ViewAttributes() ?>><?php echo $expresspayment->subv_detail->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->adv_total->CellAttributes() ?>>
<div<?php echo $expresspayment->adv_total->ViewAttributes() ?>><?php echo $expresspayment->adv_total->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->adv_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->adv_detail->ViewAttributes() ?>><?php echo $expresspayment->adv_detail->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->annual_total->CellAttributes() ?>>
<div<?php echo $expresspayment->annual_total->ViewAttributes() ?>><?php echo $expresspayment->annual_total->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->annual_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->annual_detail->ViewAttributes() ?>><?php echo $expresspayment->annual_detail->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->regis_total->CellAttributes() ?>>
<div<?php echo $expresspayment->regis_total->ViewAttributes() ?>><?php echo $expresspayment->regis_total->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->regis_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->regis_detail->ViewAttributes() ?>><?php echo $expresspayment->regis_detail->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->other_total->CellAttributes() ?>>
<div<?php echo $expresspayment->other_total->ViewAttributes() ?>><?php echo $expresspayment->other_total->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->other_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->other_detail->ViewAttributes() ?>><?php echo $expresspayment->other_detail->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->expr_total->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_total->ViewAttributes() ?>><?php echo $expresspayment->expr_total->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->expr_note->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_note->ViewAttributes() ?>><?php echo $expresspayment->expr_note->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->expr_pay_date->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_pay_date->ViewAttributes() ?>><?php echo $expresspayment->expr_pay_date->ListViewValue() ?></div></td>
		<td<?php echo $expresspayment->expr_slipt_num->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_slipt_num->ViewAttributes() ?>><?php echo $expresspayment->expr_slipt_num->ListViewValue() ?></div></td>
	</tr>
<?php
	$expresspayment_delete->Recordset->MoveNext();
}
$expresspayment_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$expresspayment_delete->ShowPageFooter();
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
$expresspayment_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpresspayment_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'expresspayment';

	// Page object name
	var $PageObjName = 'expresspayment_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expresspayment;
		if ($expresspayment->UseTokenInUrl) $PageUrl .= "t=" . $expresspayment->TableVar . "&"; // Add page token
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
		global $objForm, $expresspayment;
		if ($expresspayment->UseTokenInUrl) {
			if ($objForm)
				return ($expresspayment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expresspayment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpresspayment_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expresspayment)
		if (!isset($GLOBALS["expresspayment"])) {
			$GLOBALS["expresspayment"] = new cexpresspayment();
			$GLOBALS["Table"] =& $GLOBALS["expresspayment"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expresspayment', TRUE);

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
		global $expresspayment;

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $expresspayment;

		// Load key parameters
		$this->RecKeys = $expresspayment->GetRecordKeys(); // Load record keys
		$sFilter = $expresspayment->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("expresspaymentlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in expresspayment class, expresspaymentinfo.php

		$expresspayment->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$expresspayment->CurrentAction = $_POST["a_delete"];
		} else {
			$expresspayment->CurrentAction = "I"; // Display record
		}
		switch ($expresspayment->CurrentAction) {
			case "D": // Delete
				$expresspayment->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($expresspayment->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expresspayment;

		// Call Recordset Selecting event
		$expresspayment->Recordset_Selecting($expresspayment->CurrentFilter);

		// Load List page SQL
		$sSql = $expresspayment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expresspayment->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expresspayment;
		$sFilter = $expresspayment->KeyFilter();

		// Call Row Selecting event
		$expresspayment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expresspayment->CurrentFilter = $sFilter;
		$sSql = $expresspayment->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expresspayment;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expresspayment->Row_Selected($row);
		$expresspayment->expr_id->setDbValue($rs->fields('expr_id'));
		$expresspayment->t_code->setDbValue($rs->fields('t_code'));
		$expresspayment->village_id->setDbValue($rs->fields('village_id'));
		$expresspayment->subv_total->setDbValue($rs->fields('subv_total'));
		$expresspayment->subv_detail->setDbValue($rs->fields('subv_detail'));
		$expresspayment->adv_total->setDbValue($rs->fields('adv_total'));
		$expresspayment->adv_detail->setDbValue($rs->fields('adv_detail'));
		$expresspayment->annual_total->setDbValue($rs->fields('annual_total'));
		$expresspayment->annual_detail->setDbValue($rs->fields('annual_detail'));
		$expresspayment->regis_total->setDbValue($rs->fields('regis_total'));
		$expresspayment->regis_detail->setDbValue($rs->fields('regis_detail'));
		$expresspayment->other_total->setDbValue($rs->fields('other_total'));
		$expresspayment->other_detail->setDbValue($rs->fields('other_detail'));
		$expresspayment->expr_total->setDbValue($rs->fields('expr_total'));
		$expresspayment->expr_note->setDbValue($rs->fields('expr_note'));
		$expresspayment->expr_pay_date->setDbValue($rs->fields('expr_pay_date'));
		$expresspayment->expr_slipt_num->setDbValue($rs->fields('expr_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expresspayment;

		// Initialize URLs
		// Call Row_Rendering event

		$expresspayment->Row_Rendering();

		// Common render codes for all row types
		// expr_id

		$expresspayment->expr_id->CellCssStyle = "white-space: nowrap;";

		// t_code
		$expresspayment->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$expresspayment->village_id->CellCssStyle = "white-space: nowrap;";

		// subv_total
		$expresspayment->subv_total->CellCssStyle = "white-space: nowrap;";

		// subv_detail
		$expresspayment->subv_detail->CellCssStyle = "white-space: nowrap;";

		// adv_total
		$expresspayment->adv_total->CellCssStyle = "white-space: nowrap;";

		// adv_detail
		$expresspayment->adv_detail->CellCssStyle = "white-space: nowrap;";

		// annual_total
		$expresspayment->annual_total->CellCssStyle = "white-space: nowrap;";

		// annual_detail
		$expresspayment->annual_detail->CellCssStyle = "white-space: nowrap;";

		// regis_total
		$expresspayment->regis_total->CellCssStyle = "white-space: nowrap;";

		// regis_detail
		$expresspayment->regis_detail->CellCssStyle = "white-space: nowrap;";

		// other_total
		$expresspayment->other_total->CellCssStyle = "white-space: nowrap;";

		// other_detail
		$expresspayment->other_detail->CellCssStyle = "white-space: nowrap;";

		// expr_total
		$expresspayment->expr_total->CellCssStyle = "white-space: nowrap;";

		// expr_note
		$expresspayment->expr_note->CellCssStyle = "white-space: nowrap;";

		// expr_pay_date
		$expresspayment->expr_pay_date->CellCssStyle = "white-space: nowrap;";

		// expr_slipt_num
		$expresspayment->expr_slipt_num->CellCssStyle = "white-space: nowrap;";
		if ($expresspayment->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_code
			if (strval($expresspayment->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($expresspayment->t_code->CurrentValue) . "'";
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
					$expresspayment->t_code->ViewValue = $rswrk->fields('t_code');
					$expresspayment->t_code->ViewValue .= ew_ValueSeparator(0,1,$expresspayment->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$expresspayment->t_code->ViewValue = $expresspayment->t_code->CurrentValue;
				}
			} else {
				$expresspayment->t_code->ViewValue = NULL;
			}
			$expresspayment->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($expresspayment->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($expresspayment->village_id->CurrentValue) . "";
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
					$expresspayment->village_id->ViewValue = $rswrk->fields('v_code');
					$expresspayment->village_id->ViewValue .= ew_ValueSeparator(0,1,$expresspayment->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$expresspayment->village_id->ViewValue = $expresspayment->village_id->CurrentValue;
				}
			} else {
				$expresspayment->village_id->ViewValue = NULL;
			}
			$expresspayment->village_id->ViewCustomAttributes = "";

			// subv_total
			$expresspayment->subv_total->ViewValue = $expresspayment->subv_total->CurrentValue;
			$expresspayment->subv_total->ViewValue = ew_FormatCurrency($expresspayment->subv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->subv_total->ViewCustomAttributes = "";

			// subv_detail
			$expresspayment->subv_detail->ViewValue = $expresspayment->subv_detail->CurrentValue;
			$expresspayment->subv_detail->ViewCustomAttributes = "";

			// adv_total
			$expresspayment->adv_total->ViewValue = $expresspayment->adv_total->CurrentValue;
			$expresspayment->adv_total->ViewValue = ew_FormatCurrency($expresspayment->adv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->adv_total->ViewCustomAttributes = "";

			// adv_detail
			$expresspayment->adv_detail->ViewValue = $expresspayment->adv_detail->CurrentValue;
			$expresspayment->adv_detail->ViewCustomAttributes = "";

			// annual_total
			$expresspayment->annual_total->ViewValue = $expresspayment->annual_total->CurrentValue;
			$expresspayment->annual_total->ViewValue = ew_FormatCurrency($expresspayment->annual_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->annual_total->ViewCustomAttributes = "";

			// annual_detail
			$expresspayment->annual_detail->ViewValue = $expresspayment->annual_detail->CurrentValue;
			$expresspayment->annual_detail->ViewCustomAttributes = "";

			// regis_total
			$expresspayment->regis_total->ViewValue = $expresspayment->regis_total->CurrentValue;
			$expresspayment->regis_total->ViewValue = ew_FormatCurrency($expresspayment->regis_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->regis_total->ViewCustomAttributes = "";

			// regis_detail
			$expresspayment->regis_detail->ViewValue = $expresspayment->regis_detail->CurrentValue;
			$expresspayment->regis_detail->ViewCustomAttributes = "";

			// other_total
			$expresspayment->other_total->ViewValue = $expresspayment->other_total->CurrentValue;
			$expresspayment->other_total->ViewValue = ew_FormatCurrency($expresspayment->other_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->other_total->ViewCustomAttributes = "";

			// other_detail
			$expresspayment->other_detail->ViewValue = $expresspayment->other_detail->CurrentValue;
			$expresspayment->other_detail->ViewCustomAttributes = "";

			// expr_total
			$expresspayment->expr_total->ViewValue = $expresspayment->expr_total->CurrentValue;
			$expresspayment->expr_total->ViewValue = ew_FormatCurrency($expresspayment->expr_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->expr_total->ViewCustomAttributes = "";

			// expr_note
			$expresspayment->expr_note->ViewValue = $expresspayment->expr_note->CurrentValue;
			$expresspayment->expr_note->ViewCustomAttributes = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->ViewValue = $expresspayment->expr_pay_date->CurrentValue;
			$expresspayment->expr_pay_date->ViewValue = ew_FormatDateTime($expresspayment->expr_pay_date->ViewValue, 7);
			$expresspayment->expr_pay_date->ViewCustomAttributes = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->ViewValue = $expresspayment->expr_slipt_num->CurrentValue;
			$expresspayment->expr_slipt_num->ViewCustomAttributes = "";

			// t_code
			$expresspayment->t_code->LinkCustomAttributes = "";
			$expresspayment->t_code->HrefValue = "";
			$expresspayment->t_code->TooltipValue = "";

			// village_id
			$expresspayment->village_id->LinkCustomAttributes = "";
			$expresspayment->village_id->HrefValue = "";
			$expresspayment->village_id->TooltipValue = "";

			// subv_total
			$expresspayment->subv_total->LinkCustomAttributes = "";
			$expresspayment->subv_total->HrefValue = "";
			$expresspayment->subv_total->TooltipValue = "";

			// subv_detail
			$expresspayment->subv_detail->LinkCustomAttributes = "";
			$expresspayment->subv_detail->HrefValue = "";
			$expresspayment->subv_detail->TooltipValue = "";

			// adv_total
			$expresspayment->adv_total->LinkCustomAttributes = "";
			$expresspayment->adv_total->HrefValue = "";
			$expresspayment->adv_total->TooltipValue = "";

			// adv_detail
			$expresspayment->adv_detail->LinkCustomAttributes = "";
			$expresspayment->adv_detail->HrefValue = "";
			$expresspayment->adv_detail->TooltipValue = "";

			// annual_total
			$expresspayment->annual_total->LinkCustomAttributes = "";
			$expresspayment->annual_total->HrefValue = "";
			$expresspayment->annual_total->TooltipValue = "";

			// annual_detail
			$expresspayment->annual_detail->LinkCustomAttributes = "";
			$expresspayment->annual_detail->HrefValue = "";
			$expresspayment->annual_detail->TooltipValue = "";

			// regis_total
			$expresspayment->regis_total->LinkCustomAttributes = "";
			$expresspayment->regis_total->HrefValue = "";
			$expresspayment->regis_total->TooltipValue = "";

			// regis_detail
			$expresspayment->regis_detail->LinkCustomAttributes = "";
			$expresspayment->regis_detail->HrefValue = "";
			$expresspayment->regis_detail->TooltipValue = "";

			// other_total
			$expresspayment->other_total->LinkCustomAttributes = "";
			$expresspayment->other_total->HrefValue = "";
			$expresspayment->other_total->TooltipValue = "";

			// other_detail
			$expresspayment->other_detail->LinkCustomAttributes = "";
			$expresspayment->other_detail->HrefValue = "";
			$expresspayment->other_detail->TooltipValue = "";

			// expr_total
			$expresspayment->expr_total->LinkCustomAttributes = "";
			$expresspayment->expr_total->HrefValue = "";
			$expresspayment->expr_total->TooltipValue = "";

			// expr_note
			$expresspayment->expr_note->LinkCustomAttributes = "";
			$expresspayment->expr_note->HrefValue = "";
			$expresspayment->expr_note->TooltipValue = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->LinkCustomAttributes = "";
			$expresspayment->expr_pay_date->HrefValue = "";
			$expresspayment->expr_pay_date->TooltipValue = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->LinkCustomAttributes = "";
			$expresspayment->expr_slipt_num->HrefValue = "";
			$expresspayment->expr_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expresspayment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expresspayment->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $expresspayment;
		$DeleteRows = TRUE;
		$sSql = $expresspayment->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $expresspayment->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['expr_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($expresspayment->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($expresspayment->CancelMessage <> "") {
				$this->setFailureMessage($expresspayment->CancelMessage);
				$expresspayment->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$expresspayment->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
}
?>
