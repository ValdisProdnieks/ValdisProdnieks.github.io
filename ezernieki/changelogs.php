<?php
header('Content-Type: application/json');
$logs = array();

//version 1.8.3.4
$logs[] = array('version' => '1.8.4', 'logs' => 
										array(
											'Internet Explorer cookie javascript issue fixed.',
											'New redesigned Rotator.',
											'Old tables migrated to InnoDB.',
										));

//version 1.8.3.3
$logs[] = array('version' => '1.8.3.3', 'logs' => 
										array(
											'Group Overview MySQL error.',
											'Fixed memory problem.',
											'Internet Explorer Detector.',
											'Simple Landing page javascript code conflict with jQuery.',
										));

//version 1.8.3.2
$logs[] = array('version' => '1.8.3.2', 'logs' => 
										array(
											'SSL bug fixed.',
											'Global Post Back bug fixed.',
											'Setup wizard tweaked.',
										));

//version 1.8.3.1
$logs[] = array('version' => '1.8.3.1', 'logs' => 
										array(
											'Check if geoIP model exist.',
											'Some code tweaks.',
										));
//version 1.8.3
$logs[] = array('version' => '1.8.3', 'logs' => 
										array(
											'Brand New Look & Feel',
											'VIP Perks System.',
											'Enhancements for Mobile.',
											'Database enhancements.',
											'New postback response codes.',
											'Enhanced security.',
											'Expanded user agent detection.',
											'Bot, search engine crawler detection and filtering.',
											'New reports for GEO, User Agent and Platforms.',
											'New group overview segments.',
											'New report filters.',
											'New Reporting API.',
											'Landing Page redirect url.',
											'Improved support for organic traffic.',
											'Smart post click redirection rules.',
											'Raw universal smart pixel.',
											'New tokens for universal smart pixels.',
											'Clickbank API integration.',
											'1-Click auto upgrade.',
											'New async javascript for lp javascript.',
											'Expanded timezones.',
											'Reports caching.',
											'Ability to delete clicks prior to a certain date.',
											'BlazerCache redirects.',
											'BlazerCache downtime protection.',
											'Smart Rotator.',
										));

echo json_encode($logs);
?>