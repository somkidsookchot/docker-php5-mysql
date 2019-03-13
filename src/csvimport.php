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
$csvimport = new cimport();
$Page =& $csvimport;

// Page init
$csvimport->Page_Init();

// Page main
$csvimport->Page_Main();

?>
<?php 

include_once "header.php";

?>
<script type="text/javascript">


var csvimport = new ew_Page("csvimport");
function getFileExtension(filename)
{
 
  var ext = /^.+\.([^.]+)$/.exec(filename);
  return ext == null ? "" : ext[1];
}
// page properties
csvimport.PageID = "edit"; // page ID
csvimport.FormID = "fimport"; // form ID
var EW_PAGE_ID = csvimport.PageID; // for backward compatibility
// extend page with Form_CustomValidate function
csvimport.Form_CustomValidate =  function(fobj) { // DO NOT CHANGE THIS LINE!
	// Your custom validation code here, return false if invalid. 

	var fname = fobj.elements[0].value;
	if (fname == "") return ew_OnError(this, fobj.elements["dead_id"], "โปรดเลือกไฟล์");
	if (getFileExtension(fname) != 'csv' ) return ew_OnError(this, fobj.elements["dead_id"], "โปรดเลือกไฟล์ CSV เท่านั้น");
	return true;                                                                      
}  

//-->
</script>

<?php

if ($_POST["import"]){
	
require_once("include/csvimport.class.php");	
	    $csv = new csvimport();

		$arr_encodings = $csv->get_encodings(); //take possible encodings list
		$arr_encodings["default"] = "[default database encoding]"; //set a default (when the default database encoding should be used)
		
		//unlink("/var/www/authen/upload/db.csv");
		//$new_name = "/var/www/authen/upload/db.csv";
		//$new_name = SITE_ROOT."/upload/db.csv";
		//copy($_FILES['file_source']['tmp_name'],$new_name);
		//chmod($new_name,0777);
 		$csv->file_name = $_FILES['file_source']['tmp_name'];
		$name = $_FILES['file_source']['name'];
  
 		 //optional parameters
  		$csv->use_csv_header = isset($_POST["use_csv_header"]);
 		 $csv->field_separate_char = $_POST["field_separate_char"][0];
  		$csv->field_enclose_char = $_POST["field_enclose_char"][0];
 		 $csv->field_escape_char = $_POST["field_escape_char"][0];
  		$csv->encoding = $_POST["encoding"];
  
  		//start import now
		$csv->import();
  		if(!$csv->error) CurrentPage()->setSuccessMessage("นำเข้าข้อมูล ".$name." สำเร็จ"); 
		else CurrentPage()->setFailureMessage("นำเข้าข้อมูลไม่สำเร็จ<br>". $csv->error); 
		
			
	}
	
?>
<div class="ewTitle"><img src="images/ico_import_csv.png" width="40" height="40" align="absmiddle" />นำเข้าข้อมูลสมาชิก</div>
<div class="clear"></div>
<br />
<?php echo  $csvimport->ShowMessage(); ?>
<br />
<div style="float:right; width:400px; padding:10px; border-left:dotted 1px  #666; margin-right:50px;"><a href="example.xls" target="_blank"><img src="images/icon_csv.png" width="55" height="63" border="0" align="absmiddle" /></a><strong>ดาวน์โหลดตัวอย่างไฟล์ CSV</strong><br />
  <br />
  <br />
<strong>  วิธีการสร้างฐานข้อมูล CSV</strong><br />
<ol><li>ดาวน์โหลดไฟล์ตัวอย่างจากลิ้งด้านบนลงในเครื่องคอมพิวเตอร์</li>
  <li>เปิดไฟล์ด้วยโปรแกรม Microsoft Excel</li>
  <li>ทำการแก้ไขข้อมูลตามต้องการ  จากนั้นเซฟไฟล์เป็นนามสกุล .csv และปิดไฟล์</li>
  <li>นำเข้าไฟล์ฐานข้อมูลด้วยฟอร์มด้านซ้ายมือ</li>
</ol>
</div>
<form method="post" enctype="multipart/form-data" style="width:500px; float:left;" id="fimport" onsubmit="return csvimport.Form_CustomValidate(this);">
<table width="100%" align="center" cellspacing="0" class="ewGrid"><tr><td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="1" class="ewTable" <?php if ($xprint == 1) {?> style="padding:5px;"<?php }?>>
  <tr id="r_min_advance_subv6">
    <td width="150" align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>เลือกไฟล์ CSV</strong></td>
    <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><input type="file" name="file_source" id="file_source" class="textField" /></td>
  </tr>
  </table></td></tr></table>
<div class="clear"></div>

<div style="display:none;">
<label for="use_csv_header" class="labelWi">User Header</label><input name="use_csv_header" type="checkbox" id="use_csv_header" checked="checked"/>
<div class="clear"></div>
<label for="field_separate_char" class="labelWi">Separate Char</label><input type="text" name="field_separate_char" id="field_separate_char" class="textField"  maxlength="1" value="<?php echo(""!=$_POST["field_separate_char"] ? htmlspecialchars($_POST["field_separate_char"]) : ",")?>"/>
<div class="clear"></div>
<label for="field_enclose_char" class="labelWi">Encloase Char</label><input type="text" name="field_enclose_char" id="field_enclose_char" class="textField"  maxlength="1" value="<?php echo htmlspecialchars("\"")?>"/>
<div class="clear"></div>
<label for="field_escape_char" class="labelWi">Field Escape Char</label><input type="text" name="field_escape_char" id="field_escape_char" class="textField"  maxlength="1" value="<?php echo htmlspecialchars("\\")?>"/>
<div class="clear"></div>
<label for="encoding" class="labelWi">Encode</label><!-- <select name="encoding" id="encoding" class="textField" >
          <?
           // if(!empty($arr_encodings))
            //  foreach($arr_encodings as $charset=>$description):
          ?>
           <option value="<?=$charset?>"<?=($charset == $_POST["encoding"] ? "selected=\"selected\"" : "")?>><?=$description?></option> 
          <? //endforeach;?>
          </select>-->
<input type="text" name="encoding" id="encoding" class="textField"  value="tis620"/>
</div>

<br />
<input type="Submit" name="import" value="นำเข้าข้อมูล" id="import" class="bt" style="width:150px;"/>
</form>

	<div class="clear"></div>

<!-- Put your custom html here -->
<?php 

include_once "footer.php";

?>
<?php
$csvimport->Page_Terminate();
?>
<?php

//
// Page class
//
class cimport {

	// Page ID
	var $PageID = 'csvimport';

	// Page object name
	var $PageObjName = 'csvimport';

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
	function cimport() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (administrator)
		if (!isset($GLOBALS["administrator"])) $GLOBALS["administrator"] = new cadministrator;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'csvimport', TRUE);

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


		//$this->setSuccessMessage("Welcome " . CurrentUserName());
		// Put your custom codes here
		
	}

}
?>

