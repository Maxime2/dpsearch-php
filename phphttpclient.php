<?php
include('./httpful.phar');

// The host with searchd running
$host = 'http://inet-sochi.ru:7003/';

// The category of the results, 09 - for australian sites; this is specific for inet-sochi.ru installation
$_c = '09';
// number of results per page, i.e. how many results will be returned
$_ps = 10;
// result page number, starting with 0
$_np = 0;
// synonyms use flag, 1 - to use, 0 - don't
$_sy = 0;
// word forms use flag, 1 - to use, 0 - don't (search for words in query exactly)
$_sp = 1;
// search mode, can be 'near', 'all', 'any'
$_m = 'near';
// results groupping by site flag, 'yes' - to group, 'no' - don't
$_GroupBySite = 'no';
// search result template 
$_tmplt = 'json2.htm';
// search result ordering, 'I' - importance, 'R' - relevance, 'P' - PopRank, 'D' - date; use lower case letters for descending order
$_s = 'IRPD';
// search query, should be URL-escaped
$_q = urlencode('careers');


$url = $host . '?c=' . $_c 
    . '&ps=' . $_ps 
    . '&np=' . $_np 
    . '&sy=' . $_sy 
    . '&sp=' . $_sp 
    . '&m=' . $_m 
    . '&GroupBySite=' . $_GroupBySite 
    . '&tmplt=' . $_tmplt 
    . '&s=' . $_s 
    . '&q=' . $_q 
    ;

$response = \Httpful\Request::get($url)
    ->send();

$result = $response->body->responseData;

foreach ($result->results as $res) {
    echo "{$res->title} => {$res->url}\n";
}

echo " ** Total {$result->found} documents found in {$result->time} sec.\n";
echo " Displaying documents {$result->first}-{$result->last}.\n";