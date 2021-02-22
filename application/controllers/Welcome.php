<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'third_party/endroid_qrcode/autoload.php';
		
		use Endroid\QrCode\ErrorCorrectionLevel;
		//use Endroid\QrCode\LabelAlignment;
		use Endroid\QrCode\QrCode;
		//use Endroid\QrCode\Response\QrCodeResponse;
		
class Welcome extends CI_Controller {

	public function index()
	{	
		$this->load->view('welcome_message');
	}
	
	function create_qr(){
		$datanya = $this->input->post('text');//"ABI2021021900010000001";

		// Create a basic QR code
		$data = $datanya;
		$qrCode = new QrCode($data);
		$qrCode->setSize(250);

		$qrCode->setWriterByName('png');
		$qrCode->setMargin(10);
		$qrCode->setEncoding('UTF-8');
		$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
		$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
		$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
		$qrCode->setLogoPath('assets/icon/logo.png');
		$qrCode->setLogoWidth(80);
		$qrCode->setValidateResult(false);

		$datanya2 = preg_replace( '/[^a-z0-9 ]/i', '', $datanya);
		$filename = $datanya2.".png";
		$qrCode->writeFile('barcode/'.$filename);
		$filename;
		$setdata = base_url('barcode/'.$filename);
		echo json_encode(['dataset' => $setdata,'namafile'=>$datanya2]);
	}
}
