<?php
/* Disable error reporting.. */
error_reporting(0);
@ini_set('display_errors', 0);

/* Get geohive data */
include '../vaccineData.php';

$populationIreland = 4977400;
$vaccinationRatePer100 = round(((getGeoHiveTotalVaccinations()/$populationIreland)*100), 2);;

/* Encode data for JSON Response */
$jsonResponse = "";
$jsonResponse->date = getGeoHiveFirstDoseTotalsDate();
$jsonResponse->totalFirstDoseAdministered = getGeoHiveFirstDoseTotals();
$jsonResponse->totalSecondDoseAdministered = getGeoHiveSecondDoseTotals();
$jsonResponse->totalVaccinations = getGeoHiveTotalVaccinations();
$jsonResponse->vaccinatedToday = 'unknown';
$jsonResponse->vaccinationsPer100People = $vaccinationRatePer100;
//$jsonResponse->dataSource = 'https://services-eu1.arcgis.com/z6bHNio59iTqqSUY/arcgis/rest/services/Covid19_Vaccine_Administration_Data/FeatureServer/0/query?where=1%3D1&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&resultType=none&distance=0.0&units=esriSRUnit_Meter&returnGeodetic=false&outFields=*&returnGeometry=true&featureEncoding=esriDefault&multipatchOption=xyFootprint&maxAllowableOffset=&geometryPrecision=&outSR=&datumTransformation=&applyVCSProjection=false&returnIdsOnly=false&returnUniqueIdsOnly=false&returnCountOnly=false&returnExtentOnly=false&returnQueryGeometry=false&returnDistinctValues=false&cacheHint=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&having=&resultOffset=&resultRecordCount=&returnZ=false&returnM=false&returnExceededLimitFeatures=true&quantizationParameters=&sqlFormat=none&f=html&token=';



$json = json_encode($jsonResponse);
header('Content-Type: application/json');
echo $json;