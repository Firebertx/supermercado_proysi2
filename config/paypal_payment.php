<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => env('AQ5mfkJ0F12Q9JCzObyZffOrV9dPerxC2cadLBDMrFRHQAG0tTdoABX63X6XDwpn48pZze262snU4P1i', ''),
		'ClientSecret' => env('EGwEa-ZkkCgXFMw38yx4k3yAJeVXW9xb661rs1Fo10KlM7egfA34bQnchrzozrS1j3-G-kdx2oCCP3ky', ''),
	),

	# Connection Information
	'Http' => array(
		// 'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),


	# Logging Information
	'Log' => array(
		//'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		//'LogLevel' => 'FINE',
	),
);
