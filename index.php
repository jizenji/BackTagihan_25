<?php
if (isset($_GET['page'])) {
	$page = $_GET['page'];
	switch ($page) {
		case 'kontak':
			include 'kontak.php';
			break;
		default:
			include '404.php';
			break;
	}
} elseif (isset($_GET['home'])) {
	$home = $_GET['home'];
	switch ($home) {
		default:
			include 'home.php';
			break;
	}
} elseif (isset($_GET['input'])) {
	$input = $_GET['input'];
	switch ($input) {
		case 'x':
			include 'input-token/input_token.php';
			break;
		case 'prosesX':
			include 'input-token/func.inputoken.php';
			inputX($koneksi);
			break;
		case 'prosesXX':
			include 'input-token/func.inputoken.php';
			inputXX($koneksi);
			break;
		default:
			include '404.php';
			break;
	}
} elseif (isset($_GET['laporan'])) {
	$laporan = $_GET['laporan'];
	switch ($laporan) {
		case 'xl':
			include 'laporan/laporan_admin_listrik.php';
			break;
		case 'xa':
			include 'laporan/laporan_admin_air.php';
			break;
		case 'xg':
			include 'laporan/laporan_admin_gas.php';
			break;
		case 'xi':
			include 'laporan/laporan_customer.php';
			break;
		case 'export':
			include 'laporan/proses_laporan.php';
			export($koneksi);
			break;
		case 'realtimeVend':
			include 'laporan/proses_laporan.php';
			realtimeVend($koneksi);
			break;
		case 'update-x':
			include 'laporan/proses_laporan.php';
			update_x($koneksi);
			break;
		case 'delete-x':
			include 'laporan/proses_laporan.php';
			delete_x($koneksi);
			break;
		case 'delete-xi':
			include 'laporan/proses_laporan.php';
			delete_xi($koneksi);
			break;
		default:
			include '404.php';
			break;
	}
} elseif (isset($_GET['login'])) {
	$login = $_GET['login'];
	switch ($login) {
		case 'proses':
			include 'login/func.login.php';
			prosesLogin($koneksi);
			break;
		default:
			include 'login/login.php';
			break;
	}
} elseif (isset($_GET['part-customer'])) {
	$page = $_GET['part-customer'];
	switch ($page) {
		case 'login':
			include 'customer/login.php';
			break;
		case 'choice':
			include 'customer/choice.php';
			break;
		case 'choices':
			include 'customer/func.customer.php';
			choices($koneksi);
			break;
		case 'swChoices':
			include 'customer/func.customer.php';
			redChoices($koneksi);
			break;
		case 'index':
			include 'customer/home.php';
			break;
		case 'history':
			include 'customer/history.php';
			break;
		case 'export':
			include 'customer/func.customer.php';
			export($koneksi);
			break;
		case 'realtimeVend':
			include 'customer/func.customer.php';
			realtimeVend($koneksi);
			break;
		case 'kontak':
			include 'customer/kontak.php';
			break;
		case 'buy':
			include 'customer/generate_token.php';
			break;
		case 'confirm':
			include 'customer/confirm.php';
			break;
		case 'check-meter':
			include 'customer/check_meter.php';
			break;
		case 'proses-buy':
			include 'customer/func.customer.php';
			prosesBuy($koneksi);
			break;
		case 'proses-claim':
			include 'customer/func.customer.php';
			prosesClaim($koneksi);
			break;
		case 'proses-confirm':
			include 'customer/func.customer.php';
			prosesVerif($koneksi);
			break;
		case 'process-check':
			include 'customer/func.customer.php';
			processCheck($koneksi);
			break;
		case 'pay-now':
			include 'customer/payment.php';
			break;
		case 'thankyou':
			include 'customer/thankyou.php';
			break;
		case 'claim':
			include 'customer/claim_token.php';
			break;
		case 'cancel':
			include 'customer/cancel.php';
			break;
		case 'setting-receipt':
			include 'customer/setting_receipt.php';
			break;
		case 'update-sett-receipt':
			include 'customer/func.customer.php';
			updateSetReceipt($koneksi);
			break;
		case 'proses-beli':
			include 'customer/func.customer.php';
			prosesBeli($koneksi);
			break;
		case 'notify':
			include 'customer/func.customer.php';
			prosesNotify($koneksi);
			break;
		case 'proses-delete':
			include 'customer/func.customer.php';
			delete_his($koneksi);
			break;
		case 'proses-login':
			include 'customer/func.customer.php';
			loginCustomer($koneksi);
		default:
			include 'customer/404.php';
			break;
	}
} elseif (isset($_GET['data-customer'])) {
	$page = $_GET['data-customer'];
	switch ($page) {
		case 'x':
			include 'data-customer/data_customer.php';
			break;
		case 'create_data':
			include 'data-customer/create_data.php';
			break;
		case 'proses-create':
			include 'data-customer/func.data_customer.php';
			createProses($koneksi);
			break;
		case 'update-x':
			include 'data-customer/func.data_customer.php';
			updateX($koneksi);
		case 'refresh-conce':
			include 'data-customer/func.data_customer.php';
			refreshMeter($koneksi);
		case 'remote':
			include 'data-customer/func.data_customer.php';
			switchMeter($koneksi);
			break;
		case 'delete-x':
			include 'data-customer/func.data_customer.php';
			deleteX($koneksi);
		case 'generateup':
			include 'data-customer/func.data_customer.php';
			generateAllUsrnmPsswd($koneksi);
		case 'randomup':
			include 'data-customer/func.data_customer.php';
			randomUsrnmPasswdById($koneksi);
		case 'reset':
			include 'data-customer/func.data_customer.php';
			resetLogin($koneksi);
			break;
		default:
			include '404.php';
			break;
	}
} elseif (isset($_GET['data-harga'])) {
	$page = $_GET['data-harga'];
	switch ($page) {
		case 'x':
			include 'data-harga/data_harga.php';
			break;
		case 'add-pric':
			include 'data-harga/create_harga.php';
			break;
		case 'update-x':
			include 'data-harga/func.data_harga.php';
			updateHarga($koneksi);
		case 'pros-pric':
			include 'data-harga/func.data_harga.php';
			tambahHARGA($koneksi);
		case 'delete-x':
			include 'data-harga/func.data_harga.php';
			deleteHarga($koneksi);
		default:
			include '404.php';
			break;
	}
} elseif (isset($_GET['template-invoice'])) {
	$page = $_GET['template-invoice'];
	switch ($page) {
		case 'data':
			include 'template_invoice/data_template.php';
			break;
		case 'add-data':
			include 'template_invoice/create_template.php';
			break;
		case 'process-create':
			include 'template_invoice/func.template_invoice.php';
			add($koneksi);
		case 'proccess-update':
			include 'template_invoice/func.template_invoice.php';
			update($koneksi);
		case 'delete':
			include 'template_invoice/func.template_invoice.php';
			delete($koneksi);
		default:
			include '404.php';
			break;
	}
} elseif (isset($_GET['profile'])) {
	$profile = $_GET['profile'];
	switch ($profile) {
		case 'edit':
			include 'profile/profile.php';
			break;
		case 'update-profile':
			include 'profile/func.profile.php';
			updateProfile($koneksi);
			break;

		default:
			include '404.php';
			break;
	}
} elseif (isset($_GET['config'])) {
	$config = $_GET['config'];
	switch ($config) {
		case 'api':
			include 'config/api.php';
			break;
		case 'proses-api':
			include 'config/func.config.php';
			prosesAPI($koneksi);
			break;
		case 'index':
			include 'config/config.php';
			break;
		case 'update-config':
			include 'config/func.config.php';
			updateConfig($koneksi);
			break;
		case 'setting-receipt':
			include 'config/receipt.php';
			break;
		case 'update-sett-receipt':
			include 'config/func.config.php';
			updateSetReceipt($koneksi);
			break;
		case 'clear-tamper-meter':
			include 'config/clear_tamper.php';
			break;
		case 'proccess-clear-tamper-meter':
			include 'config/func.config.php';
			clearTamper($koneksi);
			break;

		default:
			include '404.php';
			break;
	}
} elseif (isset($_GET['backup'])) {
	$backup = $_GET['backup'];
	switch ($backup) {
		case 'index':
			include 'backup/backup.php';
			backupDatabaseTables($$dbHost, $dbUsername, $dbPassword, $dbName, $tables);
			break;
		default:
			include '404.php';
			break;
	}
} else {
	// include 'home.php';
	include 'login/login.php';
	// include 'customer/login.php';
}
