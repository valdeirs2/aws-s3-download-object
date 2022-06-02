<?php 

	require dirname(__DIR__) . '/aws-sdk/aws-autoloader.php';

	class ReportAWS {

		private $region;
		private $credentials;
		private $sdk;
		private $s3;


		public function __construct( $credentials, $region ) {

			$this->credentials = new Aws\Credentials\Credentials(
				$credentials['key'],
				$credentials['secret']
			);

			$this->region = $region;

			return $this;
		}

		public function init() {

			$this->sdk = new Aws\Sdk([
			    'region'   => $this->region,
			    'version'  => 'latest',
			    'scheme'  =>  'http',
			    'credentials' => $this->credentials
			]);

			$this->s3 = $this->sdk->createS3();

			return $this;
		}

		public function create_directory($path) {

			if( !is_dir($path) ) {
				try {
					mkdir($path);
				} catch (Exception $error) {
					die($error);
				}
			}
		}

		public function getObject($data) {

			$this->create_directory($data['path_to_save']);

			$result = $this->s3->getObject([
				'Bucket' => $data['bucket'],
				'Key'    => $data['object_name'],
				'SaveAs' => sprintf( '%s\\%s', $data['path_to_save'], $data['object_name'] )
			]);

			return $this;
		}
	}
?>