<?php
require_once ("../../includes/buildServer-common.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php"); require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php");  require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); $App = new App(); $Nav = new Nav(); $Menu = new Menu(); include($App->getProjectCommon());

ob_start();

/* zips that are allowed to be absent from the downloads page (eg., new ones added mid-stream) */
$extraZips = array(
	"emf-xsd-Update",
	"emf-sdo-xsd-Update",
# Different OCL Core/Tools builds produce different downloadable artifacts, so every zip may be absent	
	"mdt-ocl-standalone",
	"mdt-ocl-automated-tests",	# deprecated Modeling build version
	"mdt-ocl-Automated-Tests",	# new Athena version
	"mdt-ocl-Update", 			# deprecated
	"mdt-ocl-Update-core",      # new in buckminster based tools/core builds
	"mdt-ocl-Update-tools", 	# new in buckminster based tools/core builds
	"mdt-ocl-SDK", 				# deprecated
	"mdt-ocl-SDK-core", 		# deprecated (SDK moved to tools build)
	"mdt-ocl-SDK-tools", 		# new in buckminster based tools/core builds
	"mdt-ocl-CoreSDK", 			# deprecated
	"mdt-ocl-CoreSDK-core", 	# new in buckminster based tools/core builds	
	"mdt-ocl-runtime",			# deprecated
	"mdt-ocl-runtime-core", 	# new in buckminster based tools/core builds	
	"mdt-ocl-examples",			# deprecated
	"mdt-ocl-examples-tools",	# new in buckminster based tools/core builds
# End OCL Stuff
	"modisco-Update", 				# post 1.5.0
	"org.eclipse.modisco.updatesite", 	# post 0.10.1 - 1.2
	"MoDisco-Update", 				# post 0.10.0
	"MODISCO-Update", 				# pre 0.10.0
	"xsd-SDK", # deprecated
	"xsd-sourcedoc", # new EMF 2.4.0M5 x 3
	"emf-sdo-xsd-sourcedoc", # never existed
);

/* config */

/* $project => sections/Project Name => (prettyname => filename) */
/* only required if using something other than the default 4; otherwise will be generated */
$dls = array(
	/*"/newProj" => array(
		"Project Name" => array( # same as value in _projectCommon.php's $projects array
			"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update",
			"SDK (Runtime, Source)" => "SDK",
			"Runtime" => "runtime",
			"Examples" => "examples",
			"Automated Tests" => "automated-tests"
		)
	),*/
	"/uml2" => array(
		"UML2" => array(
			"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update",
			"SDK (Runtime, Source, Examples)" => "SDK",
			"Runtime" => array("-runtime",""), // multiple prefixes supported
			"Examples" => "examples",
			"Automated Tests" => "automated-tests"
		)
	),
	"/ocl" => array(
		"OCL" => array(
			"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update",  # deprecated
			"<acronym title=\"Click to download archived Core SDK P2 Repository\"><img alt=\"Click to download archived Core SDK P2 Repository\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">Core SDK Update Site</b></acronym>" => "Update-core", # new in buckminster based tools/core builds
			"<acronym title=\"Click to download archived All-In-One Tools P2 Repository\"><img alt=\"Click to download archived All-In-One Tools P2 Repository\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update-tools", # new in buckminster based tools/core builds
			"SDK (Runtime, EMF Edit Support, Source, Documentation) " => "SDK", # deprecated						
			"SDK (Runtime, EMF Edit Support, Source, Documentation)" => "SDK-core", # deprecated
			"SDK (Runtime, EMF Edit Support, Source, Documentation)" => "SDK-tools", # new in buckminster based tools/core builds
			"Core SDK (Runtime, Source) " => "CoreSDK", # deprecated
			"Core SDK (Runtime, Source)" => "CoreSDK-core", # new in buckminster based tools/core builds
			"Runtime " => "runtime", # deprecated
			"Runtime" => "runtime-core", # new in buckminster based tools/core builds
			"Examples " => "examples",  # deprecated
			"Examples" => "examples-tools", # new in buckminster based tools/core builds
			"Automated Tests" => "automated-tests",  # deprecated Modeling build 
			"Automated Tests" => "Automated-Tests",  # new Athena build
			"Stand-alone" => "standalone"
		)
	),
	"/xsd" => array(
		"XSD" => array(
			"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update",
			"SDK (Runtime, Source, Doc)" => "SDK",	# deprecated EMF 2.4.0M5
			"Sources + Docs" => "sourcedoc",		# new EMF 2.4.0M5
			"Runtime" => "runtime" //,
			//"Examples" => "examples",
			//"Automated Tests" => "automated-tests"
		)
	),
	"/modisco" => array(
		"MoDisco" => array(
			"<acronym title=\"Click to download archived All-In-One p2 Repo Update Site\"><img alt=\"Click to download archived All-In-One p2 Repo Update Site\" src=\"/modeling/images/dl-icon-update-zip.gif\"/> <b style=\"color:green\">All-In-One Update Site</b></acronym>" => "Update",
			//"SDK (Runtime, Source, Doc)" => "SDK",	# deprecated EMF 2.4.0M5
			//"Sources + Docs" => "sourcedoc",		# new EMF 2.4.0M5
			//"Runtime" => "runtime" //,
			//"Examples" => "examples",
			//"Automated Tests" => "automated-tests"
		)
	)
);

/* list of valid file prefixes for projects who have been renamed; keys have leading / to match $proj */
/* only required if using something other than the default; otherwise will be generated */
$filePre = array(
	/* "/newproj" => array("mdt-newproj"), */
	"/eodm" => array("emft-eodm","mdt-eodm"),
	"/uml2" => array("uml2","mdt-uml2"),
	"/ocl" => array("emft-ocl","mdt-ocl"),
	"/xsd" => array("xsd","mdt-xsd", "emf-xsd", "emf-sdo-xsd"),
	"/modisco" => array("modisco","MoDisco","MODISCO","org.eclipse.modisco")
);

/* define showNotes(), $oldrels, doLanguagePacks() in extras-$proj.php (or just extras.php for flat projects) if necessary, downloads-common.php will include them */
/* end config */

if ($isBuildServer) { include_once $_SERVER["DOCUMENT_ROOT"] . "/modeling/mdt/build/sideitems-common.php"; }
require_once($_SERVER["DOCUMENT_ROOT"] . "/modeling/includes/downloads-common.php");

$html = ob_get_contents();
ob_end_clean();

$trans = array_flip($projects);
$pageTitle = "Eclipse Modeling - MDT - $trans[$projct] - Downloads";
$pageKeywords = ""; // TODO: add something here
$pageAuthor = "Neil Skrypuch, Nick Boldt";

# Generate the web page
$App->AddExtraHtmlHeader('<link rel="stylesheet" type="text/css" href="/modeling/includes/downloads.css"/>' . "\n");
$App->AddExtraHtmlHeader('<script src="/modeling/includes/downloads.js" type="text/javascript"></script>' . "\n"); //ie doesn't understand self closing script tags, and won't even try to render the page if you use one
$App->AddExtraHtmlHeader('<link type="application/rss+xml" rel="alternate" title="MDT '.$trans[$projct].' Build Feed" href="http://www.eclipse.org/modeling/download.php?file=/'.$PR.'/feeds/builds-'.$projct.'.xml"/>' . "\n");
$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);

?>
