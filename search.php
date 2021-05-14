<?php
class App {
	const SORT_WHITELIST = ["label", "name"];
	
	public static function search(string $query, string $sort=null, int $limit=30, int $offset=0): array
	{
		if (!in_array($sort, self::SORT_WHITELIST)) $sort = "label";
		if ($limit > 50) $limit = 50;

		if ($query !== "") {
			$db = new PDO("sqlite:database.db");
			$stmt = $db->prepare("select * from items where name like :query or label like :query order by $sort");
			
			$stmt->bindValue(":query", "%" . str_replace("%", "[%]", $query) . "%");
			
			$stmt->execute();
			
			$results = $stmt->fetchAll();
		} else {
			$results = [];
		}
		
		$data["count"] = count($results);
		$data["results"] = array_slice($results, $offset*$limit, $limit);

		return $data;
	}
}
