# aws-s3-download-object
Class for get object from AWS s3 

## How to use
It's as simple as that:

```php

require __DIR__ . '/src/conf/define.php';
require __DIR__ . '/src/GetBucketObject.class.php';

$report = new ReportAWS(
	[
		'key' => AWS_KEY, 
		'secret' => AWS_SECRET
	], 
	AWS_REGION
);

$report->init()
	->getObject([
		'bucket' => 'bucket-de-teste-valolsa',
		'object_name' => 'YOUR_FILE_TO_DOWNLOAD',
		'path_to_save' => __DIR__ . '\objects'
	]);
  
```
