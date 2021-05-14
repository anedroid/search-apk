<?php
ini_set("display_errors", 1);
require_once "search.php";

header("Content-type: application/json");

$query = filter_input(INPUT_GET, "q") ?? "";
$sort = filter_input(INPUT_GET, "sort") ?? "label";
$limit = filter_input(INPUT_GET, "max", FILTER_SANITIZE_NUMBER_INT) ?? 30;
	if ($limit === "") $limit = 30;
	else if ($limit > 50) $limit = 50;
$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT) ?? 1;

$response = App::search($query, $sort, $limit, $page-1);
echo json_encode($response);
