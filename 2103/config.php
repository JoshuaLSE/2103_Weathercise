<?php

phpinfo();
$server = "mongodb+srv://admin:Passw0rd@ict2103.jbggf.mongodb.net/test?authSource=admin&replicaSet=atlas-lie30k-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true";
$client = new MongoDB\Driver\Manager($server);
# setting your options and filter
$filter  = [];
$options = ['sort'=>array('_id'=>-1),'limit'=>3]; # limit -1 from newest to oldest

#constructing the querry
$query = new MongoDB\Driver\Query($filter, $options);

#executing
$cursor = $client->executeQuery('ICT2103.locations', $query);

echo "dumping results<br>";
foreach ($cursor as $document) {
    var_dump($document);
}
?>