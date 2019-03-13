<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_ITEM_CLASSNAME", "", TRUE);
define("EW_MENUBAR_ITEM_LABEL_CLASSNAME", "", TRUE);
define("EW_MENU_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENU_ITEM_CLASSNAME", "", TRUE);
define("EW_MENU_ITEM_LABEL_CLASSNAME", "", TRUE);
?>
<?php

// Menu Rendering event
function Menu_Rendering(&$Menu) {

	// Change menu items here
}

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(283, $Language->MenuPhrase("283", "MenuText"), "home.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "memberslist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(52, $Language->MenuPhrase("52", "MenuText"), "memberslist.php?x_member_status=ปกติ", 3, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(53, $Language->MenuPhrase("53", "MenuText"), "memberslist.php?x_member_status=เสียชีวิต", 3, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(54, $Language->MenuPhrase("54", "MenuText"), "memberslist.php?x_member_status=ลาออก", 3, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(55, $Language->MenuPhrase("55", "MenuText"), "memberslist.php?x_member_status=พ้นสภาพ", 3, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10262, $Language->MenuPhrase("10262", "MenuText"), "csvimport.php", 3, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10135, $Language->MenuPhrase("10135", "MenuText"), "subvchargelist.php", -1, "", IsLoggedIn(), FALSE);
/*$RootMenu->AddMenuItem(106, $Language->MenuPhrase("106", "MenuText"), "subvchargelist.php", 10135, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10137, $Language->MenuPhrase("10137", "MenuText"), "refundablelist.php", 10135, "", IsLoggedIn(), FALSE);*/
$RootMenu->AddMenuItem(360, $Language->MenuPhrase("360", "MenuText"), "subvcalculatelist.php?cmd=resetall", -1, "", IsLoggedIn(), FALSE);
/*$RootMenu->AddMenuItem(206, $Language->MenuPhrase("206", "MenuText"), "subvcalculatelist.php?x_cal_type=1", 360, "", IsLoggedIn(), FALSE);*/
$RootMenu->AddMenuItem(207, $Language->MenuPhrase("207", "MenuText"), "subvcalculatelist.php?x_cal_type=2", 360, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(423, $Language->MenuPhrase("423", "MenuText"), "subvcalculatelist.php?x_cal_type=6", 360, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(361, $Language->MenuPhrase("361", "MenuText"), "subvcalculatelist.php?x_cal_type=3", 360, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(362, $Language->MenuPhrase("362", "MenuText"), "subvcalculatelist.php?x_cal_type=4", 360, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(422, $Language->MenuPhrase("422", "MenuText"), "subvcalculatelist.php?x_cal_type=5", 360, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(446, $Language->MenuPhrase("446", "MenuText"), "", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(87, $Language->MenuPhrase("87", "MenuText"), "paymentlogadd.php", 446, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(86, $Language->MenuPhrase("86", "MenuText"), "paymentloglist.php", 446, "", IsLoggedIn(), FALSE);
/*$RootMenu->AddMenuItem(10066, $Language->MenuPhrase("10066", "MenuText"), "payalllist.php", 446, "", IsLoggedIn(), FALSE);*/
$RootMenu->AddMenuItem(4, $Language->MenuPhrase("4", "MenuText"), "paymentsummarylist.php?cmd=resetall", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(158, $Language->MenuPhrase("158", "MenuText"), "paymentsummarylist.php?x_pay_sum_type=1", 4, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(159, $Language->MenuPhrase("159", "MenuText"), "paymentsummarylist.php?x_pay_sum_type=2", 4, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(163, $Language->MenuPhrase("163", "MenuText"), "paymentsummarylist.php?x_pay_sum_type=6", 4, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(160, $Language->MenuPhrase("160", "MenuText"), "paymentsummarylist.php?x_pay_sum_type=3", 4, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(161, $Language->MenuPhrase("161", "MenuText"), "paymentsummarylist.php?x_pay_sum_type=4", 4, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(162, $Language->MenuPhrase("162", "MenuText"), "paymentsummarylist.php?x_pay_sum_type=5", 4, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(135, $Language->MenuPhrase("135", "MenuText"), "#", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10060, $Language->MenuPhrase("10060", "MenuText"), "reportvillgesmry.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10047, $Language->MenuPhrase("10047", "MenuText"), "reportallmembersmry.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10192, $Language->MenuPhrase("10192", "MenuText"), "reportmemberperiod.php", 135, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10041, $Language->MenuPhrase("10041", "MenuText"), "allmemberbystatusctb.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10061, $Language->MenuPhrase("10061", "MenuText"), "daysummaryctb.php", 135, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10227, $Language->MenuPhrase("10227", "MenuText"), "reportpaymentperiod.php", 135, "", IsLoggedIn(), FALSE);

$RootMenu->AddMenuItem(10049, $Language->MenuPhrase("10049", "MenuText"), "reportpaymentsmry.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10059, $Language->MenuPhrase("10059", "MenuText"), "reportpaymentlogsmry.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10062, $Language->MenuPhrase("10062", "MenuText"), "reportpaymentlogsepctb.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10052, $Language->MenuPhrase("10052", "MenuText"), "reportunpaymembersmry.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10033, $Language->MenuPhrase("10033", "MenuText"), "reportnotpaybyvillagectb.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10056, $Language->MenuPhrase("10056", "MenuText"), "reportadvsubvsmry.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(10058, $Language->MenuPhrase("10058", "MenuText"), "reportexpensesmry.php", 135, "PHPReportMaker", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(105, $Language->MenuPhrase("105", "MenuText"), "settingedit.php?setting_id=1", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(486, $Language->MenuPhrase("486", "MenuText"), "#", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(447, $Language->MenuPhrase("447", "MenuText"), "expensescategorylist.php", 486, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(448, $Language->MenuPhrase("448", "MenuText"), "expenseslistlist.php?cmd=resetall", 486, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(81, $Language->MenuPhrase("81", "MenuText"), "#", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(82, $Language->MenuPhrase("82", "MenuText"), "changepwd.php", 81, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(84, $Language->MenuPhrase("84", "MenuText"), "exportmysql.php", 81, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(85, $Language->MenuPhrase("85", "MenuText"), "importmysql.php", 81, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(83, $Language->MenuPhrase("83", "MenuText"), "logout.php", 81, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
