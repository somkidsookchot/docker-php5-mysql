<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$cnotpaylist = new cnotpaylist();
$Page =& $cnotpaylist;

// Page init
$cnotpaylist->Page_Init();

// Page main
$cnotpaylist->Page_Main();
if (isset($_GET['xprint'])) $xprint = $_GET["xprint"];
?>
<?php 
if ($xprint != 1){
include_once "header.php";
}
?>
<script type="text/javascript">
var cnotpaylist = new ew_Page("cnotpaylist");

// page properties
cnotpaylist.PageID = "edit"; // page ID
cnotpaylist.FormID = "fnotpay"; // form ID
var EW_PAGE_ID = cnotpaylist.PageID; // for backward compatibility
// extend page with Form_CustomValidate function
cnotpaylist.Form_CustomValidate =  function(fobj) { // DO NOT CHANGE THIS LINE!
	// Your custom validation code here, return false if invalid. 
											   
	return true;                                                                      
}  
cnotpaylist.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
cnotpaylist.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cnotpaylist.ValidateRequired = false; // no JavaScript validation
<?php } ?>
//-->
</script>


<?php

if ($xprint != 1){
	$_SESSION['print']= $_GET["id"];
}

if (! $xprint) $svc_id = 	$_GET["id"];
else $svc_id = $_SESSION['print'];


global $conn;  

			// $member = ew_Execute("SELECT * FROM  members WHERE village_id = ".$vid);
			$info = $conn->Execute("SELECT subvcalculate.*, paymenttype.pt_title as title, village.v_title  as vtitle, village.v_code as vcode, tambon.* FROM  subvcalculate LEFT JOIN paymenttype on (paymenttype.pt_id = subvcalculate.cal_type) LEFT JOIN village ON (village.village_id = subvcalculate.village_id) LEFT JOIN tambon on (tambon.t_code = subvcalculate.t_code) WHERE svc_id = '".$svc_id."'");

			$arr = $info->GetArray();

		switch ($arr[0]['cal_type']) {	
		
			case 1 : $notpay = getNotPayDeadList($arr[0]['village_id'],$arr[0]['member_code'],true);
				break;
			case 2: $notpay = getNotPayAdvList($arr[0]['village_id'],$arr[0]['adv_num'],true);
				break;
			case 3: $notpay = getNotPayAnnaulList($arr[0]['village_id'],$arr[0]['cal_detail'],true);
				break;
			case 4: $notpay = getNotPayRegisList($arr[0]['village_id'],true);
				break;
			case 5: $notpay = getNotPayOtherList($arr[0]['village_id'],$arr[0]['cal_detail'],true);
				break;
			case 6: $notpay = getNotPayOtherList($arr[0]['village_id'],$arr[0]['cal_detail'],true);
				break;
		}
		

$thetitle .= "รายชื่อสมาชิก หมู่ ".$arr[0]['vcode']." บ้าน ".$arr[0]['vtitle']." ตำบล ".$arr[0]['t_title'];
$thetitle .= ' ที่ค้างจ่าย ';
if ($arr[0]['cal_type'] != 5 && $arr[0]['cal_type'] != 6) $thetitle .= $arr[0]['title']."&nbsp;";
if ($arr[0]['cal_type'] == 1) $thetitle .= 'ศพที่ '.getDeadIdByMember($arr[0]['member_code']).", ".getNameById($arr[0]['member_code']);
if ($arr[0]['cal_type'] == 2) $thetitle .= 'งวดที่ '.$arr[0]['adv_num'];
if ($arr[0]['cal_type'] == 3) $thetitle .= ' '.$arr[0]['cal_detail'];
if ($arr[0]['cal_type'] == 5) $thetitle .= ' '.$arr[0]['cal_detail'];
if ($arr[0]['cal_type'] == 6) $thetitle .= ' '.$arr[0]['cal_detail'];


if ($xprint != 1){
?>
<a href="javascript:;history.go(-1);"><?php echo $Language->Phrase("goback") ?></a>&nbsp;&nbsp;<a href="notpaylist.php?xprint=1" target="_blank"><img src="images/ico_print_all.png" width="152" height="37" border="0" align="absmiddle"/></a><br />
<br />

<?php } ?>
<div class="ewTitle"><?php if ($xprint == 1){?><font face="Cordia New"><?php }?><?php echo $thetitle?><?php if ($xprint == 1){?></font><?php }?>&nbsp;&nbsp;</div><br /><br />
<form name="fnotpay" id="fnotpay" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return cnotpaylist.Form_CustomValidate(this);">
  <table width="100%" border="0" cellspacing="0" class="ewGrid">
    <tr>
      <td class="ewGridContent"><div class="ewGridMiddlePanel">
      <?php if ($xprint == 1){?><font face="Cordia New"><?php }?>
      <table width="100%" border="0" cellpadding="1" cellspacing="1" class="ewTable">
        <tr id="r_min_advance_subv">
            <?php if ($xprint != 1){?>
            <td width="30" align="center" class="ewTableHeader"><label>
              <input type="checkbox" name="key" id="key" onclick="cnotpaylist.SelectAllKey(this);"/>
            </label></td>
            <?php } ?>
            <td width="50" align="center" class="ewTableHeader" style="border: solid 1px #999"><strong>ลำดับที่</strong></td>
            <td align="center" class="ewTableHeader" style="border: solid 1px #999"><strong>รหัสสมาชิก</strong></td>
            <td align="left" class="ewTableHeader" style="border: solid 1px #999"><strong>ชื่อ นามสกุล</strong></td>
            </tr>
          <?php foreach($notpay as $key => $value){?>
          <tr id="r_max_advance_subv">
            <?php if ($xprint != 1){?>
            <td align="center"><input name="key_m[]" type="checkbox" id="key_m[]" value="<?php echo getMemberCodeById($value['un_member_id'])?>" /></td>
            <?php } ?>
            <td style="border: solid 1px #999"><?php echo $key+1?></td>
            <td align="center" style="border: solid 1px #999"><?php echo getMemberCodeById($value['un_member_id'])?></td>
            <td style="border: solid 1px #999"><?php echo getName($value['un_member_id'])?></td>
            </tr>
          <?php } ?>
          </table>
        <?php if ($xprint == 1){?></font><?php }?>   
      </div></td>
    </tr>
  </table>
  <br />
  <input name="addother" type="hidden" id="addother" value="1" />
 <?php 
if ($xprint != 1){?>
  <input type="button" name="btnAction" id="btnAction" value="ชำระเงิน"  onclick="ew_SubmitSelected(document.fnotpay, 'notpayprocess.php');return false;"/>
<?php } ?>
<input name="t_code" type="hidden" id="t_code" value="<?php echo $arr[0]['t_code']?>" />
<input name="v_id" type="hidden" id="v_id" value="<?php echo $arr[0]['village_id']?>" />
<input name="pay_type" type="hidden" id="pay_type" value="<?php echo $arr[0]['cal_type']?>" />
<input name="pay_death" type="hidden" id="pay_death" value="<?php echo getDeadIdByMember($arr[0]['member_code'])?>" />

<input name="pay_date" type="hidden" id="pay_date" value="<?php echo date('Y-m-d')?>" />
<input name="pay_total" type="hidden" id="pay_total" value="<?php echo $arr[0]['unit_rate']?>" />
<input name="pay_num" type="hidden" id="pay_num" value="<?php echo $arr[0]['adv_num']?>" />
<?php if ($arr[0]['cal_type'] != 3){?>
<input name="pay_detail" type="hidden" id="annual_year" value="<?php echo $arr[0]['cal_detail']?>" />
<input name="annual_year" type="hidden" id="annual_year" value="" />
<?php } else {?>
<input name="annual_year" type="hidden" id="annual_year" value="<?php echo $arr[0]['cal_detail']?>" />
<input name="pay_detail" type="hidden" id="annual_year" value="" />
<?php } ?>
</form>
<!-- Put your custom html here -->


<?php 

if ($xprint != 1){
include_once "footer.php";
}
if ($xprint == 1){
//addSliptNumber();	
?>
<script language="javascript">window.print();
window.close();
</script>
<?php }

?>

<?php
$cnotpaylist->Page_Terminate();
?>
<?php

//
// Page class
//
class cnotpaylist {

	// Page ID
	var $PageID = 'cnotpaylist';

	// Page object name
	var $PageObjName = 'cnotpaylist';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}

	//
	// Page class constructor
	//
	function cnotpaylist() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (administrator)
		if (!isset($GLOBALS["administrator"])) $GLOBALS["administrator"] = new cadministrator;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'slipview', TRUE);

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
		global $Report1;

		// Security
		$Security = new cAdvancedSecurity();

		// Uncomment codes below for security

		
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn())
			$this->Page_Terminate("login.php");
		

		// Global Page Loading event (in userfn*.php)
		Page_Loading();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

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

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;

		//$this->setSuccessMessage("Welcome " . CurrentUserName());
		// Put your custom codes here
		
	}

}
?>

