<?php
ini_set("display_errors", 1);
require_once "search.php";

$query = filter_input(INPUT_GET, "q") ?? "";
$query_html = filter_input(INPUT_GET, "q", FILTER_SANITIZE_SPECIAL_CHARS);
$query_regex = preg_replace("/([^\w])/", "\\\\$1", $query_html);
$sort = filter_input(INPUT_GET, "sort") ?? "label";
$limit = filter_input(INPUT_GET, "max", FILTER_SANITIZE_NUMBER_INT) ?? 30;
	if ($limit === "") $limit = 30;
	else if ($limit < 10) $limit = 10;
	else if ($limit > 50) $limit = 50;
$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT) ?? 1;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<script src="js/autocomplete.js" defer></script>
<!-- <script src="js/autosubmit.js"></script> -->
<title><?=$query? "$query_html - " : null?>Search apk</title>
</head>
<body>
<div id="top"></div>
<div id="search">
	<form>
		<div>
			<input type="search" name="q" value="<?=$query_html?>" size="20" placeholder="Type something..." autocomplete="off" list="autocomplete" maxlength="255" id="searchbox">
			<datalist id="autocomplete"></datalist>
			<!-- <input type="image" src="icons/search.svg" value="search" title="search"> -->
			<button type="submit" title="search">
				<img src="icons/search.svg" alt="search">
			</button>
		</div>
		<div>
			<label>sort by:
				<select name="sort" class="autosubmit">
					<?php
					$options = [
						"label" => "apk label",
						"name" => "package name"
					];
					foreach ($options as $value=>$label) {
						echo "<option value=\"$value\"" . ($sort === $value? " selected" : null) . ">$label</option>";
					}
					?>
				</select>
			</label>
			<label>show:
				<input type="number" name="max" value="<?=$limit?>" size="1" min="10" max="50" step="10">
			</label>
		</div>
	</form>
</div>
<?php
if ($query !== "") {
	$response = App::search($query, $sort, $limit, $page-1);
	$results = $response["results"];
	$count = $response["count"];
	$pages = (int) ceil($count / $limit);
		if ($pages === 0) $pages = 1;
?>
	<hr>
	<?php
	if ($count) {
	?>
		<p>Search results for "<b><?=$query_html?></b>" (<?=$count?>):</p>
		<div id="results">
		<?php
		foreach ($results as $item) {
		?>
			<div class="item">
				<?php
				$label = $item["label"];
				$label_html = filter_var($label, FILTER_SANITIZE_SPECIAL_CHARS);
				$label_html = preg_replace("/($query_regex)/is", "<b>$1</b>", $label);

				$name = $item["name"];
				$name_html = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
				$name_html = preg_replace("/($query_regex)/is", "<b>$1</b>", $name);
				?>
				<div class="label"><?=$label_html?></div>
				<div class="name"><?=$name_html?></div>
			</div>
		<?php
		}
		if ($count > 10 && $limit >= 20) {
		?>
			<div id="scroll-top">
				<a href="#top"><img src="icons/scroll-top.png" width="50" height="50" title="scroll top"></a>
			</div>
		<?php
		}
		if ($pages > 1) {
		?>
			<hr>
			<div id="footer">
				<form>
					<input type="hidden" name="q" value="<?=$query_html?>">
					<input type="hidden" name="sort" value="<?=$sort?>">
					<input type="hidden" name="max" value="<?=$limit?>">
					<label>page:
						<input type="number" name="page" value="<?=$page?>" min="1" max="<?=$pages?>" size="1" class="autosubmit" data-timeout="500">
					</label>
					<span> / <?=$pages?></span>
					<noscript>
						<button type="submit">go</button>
					</noscript>
				</form>
			</div>
		<?php
		}
		?>
		<script src="js/autosubmit.js"></script>
	<?php
	} else {
	?>
		<p>No results of "<b><?=$query_html?></b>"</p>
	<?php
	}
}
?>
</body>
</html>
