<?php

namespace PHPMaker2025\humaskerjasama;

/**
 * User levels
 *
 * @var array<int, string, string>
 * [0] int User level ID
 * [1] string User level name
 * [2] string User level hierarchy
 */
$USER_LEVELS = [["-2","Anonymous",""],
    ["0","Default",""]];

/**
 * User roles
 *
 * @var array<int, string>
 * [0] int User level ID
 * [1] string User role name
 */
$USER_ROLES = [["-1","ROLE_ADMIN"],
    ["0","ROLE_DEFAULT"]];

/**
 * User level permissions
 *
 * @var array<string, int, int>
 * [0] string Project ID + Table name
 * [1] int User level ID
 * [2] int Permissions
 */
// Begin of modification by Masino Sinaga, September 17, 2023
$USER_LEVEL_PRIVS_1 = [["{48315587-314B-49E3-9526-BFD08EAC1CB1}announcement","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}announcement","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}help","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}help","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}help_categories","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}help_categories","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}home.php","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}home.php","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}languages","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}languages","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}settings","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}settings","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}theuserprofile","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}theuserprofile","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}userlevelpermissions","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}userlevelpermissions","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}userlevels","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}userlevels","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}users","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}users","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}event","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}event","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}interaksi","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}interaksi","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}kerjasama","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}kerjasama","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}kontak_mitra","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}kontak_mitra","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}mitra","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}mitra","0","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}publikasi","-2","0"],
    ["{48315587-314B-49E3-9526-BFD08EAC1CB1}publikasi","0","0"]];
$USER_LEVEL_PRIVS_2 = [["{48315587-314B-49E3-9526-BFD08EAC1CB1}breadcrumblinksaddsp","-1","8"],
					["{48315587-314B-49E3-9526-BFD08EAC1CB1}breadcrumblinkschecksp","-1","8"],
					["{48315587-314B-49E3-9526-BFD08EAC1CB1}breadcrumblinksdeletesp","-1","8"],
					["{48315587-314B-49E3-9526-BFD08EAC1CB1}breadcrumblinksmovesp","-1","8"],
					["{48315587-314B-49E3-9526-BFD08EAC1CB1}loadhelponline","-2","8"],
					["{48315587-314B-49E3-9526-BFD08EAC1CB1}loadaboutus","-2","8"],
					["{48315587-314B-49E3-9526-BFD08EAC1CB1}loadtermsconditions","-2","8"],
					["{48315587-314B-49E3-9526-BFD08EAC1CB1}printtermsconditions","-2","8"]];
$USER_LEVEL_PRIVS = array_merge($USER_LEVEL_PRIVS_1, $USER_LEVEL_PRIVS_2);
// End of modification by Masino Sinaga, September 17, 2023

/**
 * Tables
 *
 * @var array<string, string, string, bool, string>
 * [0] string Table name
 * [1] string Table variable name
 * [2] string Table caption
 * [3] bool Allowed for update (for userpriv.php)
 * [4] string Project ID
 * [5] string URL (for OthersController::index)
 */
// Begin of modification by Masino Sinaga, September 17, 2023
$USER_LEVEL_TABLES_1 = [["announcement","announcement","Announcement",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","announcementlist"],
    ["help","help","Help (Details)",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","helplist"],
    ["help_categories","help_categories","Help (Categories)",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","helpcategorieslist"],
    ["home.php","home","Home",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","home"],
    ["languages","languages","Languages",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","languageslist"],
    ["settings","settings","Application Settings",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","settingslist"],
    ["theuserprofile","theuserprofile","User Profile",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","theuserprofilelist"],
    ["userlevelpermissions","userlevelpermissions","User Level Permissions",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","userlevelpermissionslist"],
    ["userlevels","userlevels","User Levels",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","userlevelslist"],
    ["users","users","Users",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","userslist"],
    ["event","event","event",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","eventlist"],
    ["interaksi","interaksi","interaksi",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","interaksilist"],
    ["kerjasama","kerjasama","kerjasama",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","kerjasamalist"],
    ["kontak_mitra","kontak_mitra","kontak mitra",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","kontakmitralist"],
    ["mitra","mitra","mitra",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","mitralist"],
    ["publikasi","publikasi","publikasi",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","publikasilist"]];
$USER_LEVEL_TABLES_2 = [["breadcrumblinksaddsp","breadcrumblinksaddsp","System - Breadcrumb Links - Add",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","breadcrumblinksaddsp"],
						["breadcrumblinkschecksp","breadcrumblinkschecksp","System - Breadcrumb Links - Check",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","breadcrumblinkschecksp"],
						["breadcrumblinksdeletesp","breadcrumblinksdeletesp","System - Breadcrumb Links - Delete",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","breadcrumblinksdeletesp"],
						["breadcrumblinksmovesp","breadcrumblinksmovesp","System - Breadcrumb Links - Move",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","breadcrumblinksmovesp"],
						["loadhelponline","loadhelponline","System - Load Help Online",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","loadhelponline"],
						["loadaboutus","loadaboutus","System - Load About Us",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","loadaboutus"],
						["loadtermsconditions","loadtermsconditions","System - Load Terms and Conditions",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","loadtermsconditions"],
						["printtermsconditions","printtermsconditions","System - Print Terms and Conditions",true,"{48315587-314B-49E3-9526-BFD08EAC1CB1}","printtermsconditions"]];
$USER_LEVEL_TABLES = array_merge($USER_LEVEL_TABLES_1, $USER_LEVEL_TABLES_2);
// End of modification by Masino Sinaga, September 17, 2023
