<?php

namespace PHPMaker2025\humaskerjasama;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(4, "mi_home", $Language->menuPhrase("4", "MenuText"), "home", -1, substr("mi_home", strpos("mi_home", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}home.php'), false, false, "fa-home", "", false, true);
$sideMenu->addMenuItem(40, "mci_Master", $Language->menuPhrase("40", "MenuText"), "", -1, substr("mci_Master", strpos("mci_Master", "mi_") + 3), true, false, true, "fa-file", "", false, true);
$sideMenu->addMenuItem(44, "mi_kontak_mitra", $Language->menuPhrase("44", "MenuText"), "kontakmitralist", 40, substr("mi_kontak_mitra", strpos("mi_kontak_mitra", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}kontak_mitra'), false, false, "", "", false, true);
$sideMenu->addMenuItem(43, "mi_kerjasama", $Language->menuPhrase("43", "MenuText"), "kerjasamalist", 40, substr("mi_kerjasama", strpos("mi_kerjasama", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}kerjasama'), false, false, "", "", false, true);
$sideMenu->addMenuItem(39, "mci_Data", $Language->menuPhrase("39", "MenuText"), "", -1, substr("mci_Data", strpos("mci_Data", "mi_") + 3), true, false, true, "fa-file", "", false, true);
$sideMenu->addMenuItem(42, "mi_interaksi", $Language->menuPhrase("42", "MenuText"), "interaksilist", 39, substr("mi_interaksi", strpos("mi_interaksi", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}interaksi'), false, false, "", "", false, true);
$sideMenu->addMenuItem(41, "mi_event", $Language->menuPhrase("41", "MenuText"), "eventlist", 39, substr("mi_event", strpos("mi_event", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}event'), false, false, "", "", false, true);
$sideMenu->addMenuItem(45, "mi_mitra", $Language->menuPhrase("45", "MenuText"), "mitralist", 39, substr("mi_mitra", strpos("mi_mitra", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}mitra'), false, false, "", "", false, true);
$sideMenu->addMenuItem(46, "mi_publikasi", $Language->menuPhrase("46", "MenuText"), "publikasilist", 39, substr("mi_publikasi", strpos("mi_publikasi", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}publikasi'), false, false, "", "", false, true);
$sideMenu->addMenuItem(16, "mi_theuserprofile", $Language->menuPhrase("16", "MenuText"), "theuserprofilelist", -1, substr("mi_theuserprofile", strpos("mi_theuserprofile", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}theuserprofile'), false, false, "fa-user", "", false, true);
$sideMenu->addMenuItem(5, "mi_help_categories", $Language->menuPhrase("5", "MenuText"), "helpcategorieslist", -1, substr("mi_help_categories", strpos("mi_help_categories", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}help_categories'), false, false, "fa-book", "", false, true);
$sideMenu->addMenuItem(6, "mi_help", $Language->menuPhrase("6", "MenuText"), "helplist?cmd=resetall", 5, substr("mi_help", strpos("mi_help", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}help'), false, false, "fa-book", "", false, true);
$sideMenu->addMenuItem(13, "mci_Terms_and_Condition", $Language->menuPhrase("13", "MenuText"), "javascript:void(0);|||getTermsConditions();return false;", 5, substr("mci_Terms_and_Condition", strpos("mci_Terms_and_Condition", "mi_") + 3), true, false, true, "fas fa-cannabis", "", false, true);
$sideMenu->addMenuItem(14, "mci_About_Us", $Language->menuPhrase("14", "MenuText"), "javascript:void(0);|||getAboutUs();return false;", 5, substr("mci_About_Us", strpos("mci_About_Us", "mi_") + 3), true, false, true, "fa-question", "", false, true);
$sideMenu->addMenuItem(12, "mci_ADMIN", $Language->menuPhrase("12", "MenuText"), "", -1, substr("mci_ADMIN", strpos("mci_ADMIN", "mi_") + 3), true, false, true, "fa-key", "", false, true);
$sideMenu->addMenuItem(1, "mi_users", $Language->menuPhrase("1", "MenuText"), "userslist?cmd=resetall", 12, substr("mi_users", strpos("mi_users", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}users'), false, false, "fa-user", "", false, true);
$sideMenu->addMenuItem(3, "mi_userlevels", $Language->menuPhrase("3", "MenuText"), "userlevelslist", 12, substr("mi_userlevels", strpos("mi_userlevels", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}userlevels'), false, false, "fa-tags", "", false, true);
$sideMenu->addMenuItem(2, "mi_userlevelpermissions", $Language->menuPhrase("2", "MenuText"), "userlevelpermissionslist", 12, substr("mi_userlevelpermissions", strpos("mi_userlevelpermissions", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}userlevelpermissions'), false, false, "fa-file", "", false, true);
$sideMenu->addMenuItem(8, "mi_settings", $Language->menuPhrase("8", "MenuText"), "settingslist", 12, substr("mi_settings", strpos("mi_settings", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}settings'), false, false, "fa-tools", "", false, true);
$sideMenu->addMenuItem(7, "mi_languages", $Language->menuPhrase("7", "MenuText"), "languageslist", 12, substr("mi_languages", strpos("mi_languages", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}languages'), false, false, "fa-flag", "", false, true);
$sideMenu->addMenuItem(15, "mi_announcement", $Language->menuPhrase("15", "MenuText"), "announcementlist", 12, substr("mi_announcement", strpos("mi_announcement", "mi_") + 3), AllowListMenu('{48315587-314B-49E3-9526-BFD08EAC1CB1}announcement'), false, false, "fas fa-bullhorn", "", false, true);
echo $sideMenu->toScript();
