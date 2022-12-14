<?php

/* used for sidebar entry */
$NLpacks = array(
	"1.0.x" => "NLS1.0.x"
);

$oldrels = array(
    "6.12.0" => "202006081555",
    "6.11.0" => "202003090848",
    "6.10.1" => "202002201710",
    "6.10.0" => "201912091145",
    "6.9.0" => "201909100937",
    "6.8.0" => "201906031146",
    "6.7.0" => "201903111843",
    "6.6.0" => "201812101441",
    "6.5.0" => "201809161223",
    "6.4.0" => "201806111119",
    "6.3.0" => "201706132000",
    "6.2.2" => "201612120613",
    "6.2.1" => "201608201353",
    "6.2.0" => "201606131221",
    "6.1.2" => "201611141024",
    "6.1.1" => "201608201313",
    "6.1.0" => "201605300614",
    "6.0.2" => "201602100610",
    "6.0.1" => "201509081048",
    "6.0.0" => "201506090403",
    "5.0.5" => "201510060617",
    "5.0.4" => "201502151102",
    "5.0.3" => "201411231422",
    "5.0.2" => "201409011459",
    "5.0.1" => "201406230143",
    "5.0.0" => "201406091420",
    "4.1.2" => "201402101137",
    "4.1.1" => "201309161423",
    "4.1.0" => "201306101317",
    "4.0.2" => "201301281158",
    "4.0.1" => "201209171739",
    "4.0.0" => "201206111210",
    "3.1.2a" => "201202200927",
    "3.1.1" => "201109131213",
    "3.1.0" => "201106061427",
    "3.0.2" => "201101181757",
    "3.0.1" => "201009240345",
    "3.0.0" => "201006141954",
    "1.3.0" => "200906151742",
	"1.2.3" => "200902101708",
	"1.2.2" => "200809160927",
	"1.2.1" => "200808130848",
	"1.2.0" => "200806091714",
	"1.1.2" => "200711281212",
	"1.1.1" => "200709121604",
	"1.1.0" => "200706201142",
	"1.0.2" => "200611161546",
	"1.0.1" => "200609250830",
	"1.0.0" => "200606261119"
);

function doLanguagePacks()
{
	global $downloadScript, $downloadPre;

?>
<div class="homeitem3col">
	<a name="NLS"></a>

	<h3>Language Packs</h3>

	<p>IBM is pleased to contribute translations for the Eclipse Modeling Development Tools subcomponent OCL.</p>
	<ul>
		<li>
			<a href="javascript:toggle('lang1_0')">1.0.x Language Packs</a><a name="NLS1.0.x"></a>
			<ul id="lang1_0">
					<?php
					$packs = array(
						"1.0.x NLS Translation Packs" => "NLpacks-",
					);
					$cols = array(
						"OCL" => "ocl"
					);
					$subcols = array(
						"SDK" => "SDK-1.0.0",
						"Runtime" => "runtime-1.0.0"
					);
					$packSuf = ".zip";
					$folder = "NLS/1.0/";
					doNLSLinksList($packs, $cols, $subcols, $packSuf, $folder, false); ?>
				<li>

					<p>The language packs contain NL fragments and features for:</p>
					<ul>
						<li>NLpack1 - German, Spanish, French, Italian, Japanese, Korean, Portuguese (Brazil), Traditional Chinese, Simplified Chinese</li>
						<li>NLpack2 - Czech, Hungarian, Polish, Russian</li>
						<li>NLpack2a - Danish, Dutch, Finnish, Greek, Norwegian, Portuguese, Swedish and Turkish</li>
						<li>NLpackBidi - Arabic</li>
					</ul>
					<p>Each language pack zip contains 4 other zips (one for each of the language groups above). Unpack these zips into your Eclipse directory before starting Eclipse.</p>
					<p>These translations are based on OCL 1.0.0. The NLS translation fragment packs should work with all subsequent 1.0.x maintenance releases, with any new strings remaining untranslated.</p>
				</li>
			</ul>
		</li>
	</ul>
</div>

<?php
}

function showNotes()
{
?>
	<div class="homeitem3col">
		<h3>Questions?</h3>
		<p>If you have problems downloading the drops, contact the <a href="mailto:webmaster@eclipse.org">webmaster</a>.</p>
		<p>These are the minimum required downloads for using OCL:</p>
		<ul>
			<li>To use OCL, you require both the OCL &amp; <a href="/modeling/emf/downloads/?project=emf">EMF</a> Runtimes.</li>
			<li>To use OCL with UML2, you will also require the <a href="/modeling/mdt/downloads/?project=uml2">UML2</a> runtime.</li>
		</ul>
		<p>All downloads are provided under the terms and conditions of the <a href="http://www.eclipse.org/legal/epl/notice.html">Eclipse Foundation Software User Agreement</a> unless otherwise specified.</p>
	</div>
<?php
}
?>
