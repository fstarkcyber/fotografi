<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TransaksiModel');
	}

	public function index()
	{
		$this->session->set_userdata(['menu_active' => 'laporan', 'sub_menu_active' => '']);
		$menu = $this->MenusModel->getMenu();

		$data = [
			'content' => 'components/laporan',
			'plugin' => 'plugins/laporan',
			'css' => 'css/default',
			'menus' => fetch_menu($menu)
		];

		$this->load->view('layouts/app', $data);
	}

	public function GetTransaction()
	{
		$data = [];
		$where = null;

		if ($this->input->get('start_date')) {
			$where['DATE(t.created_at) >= '] = $this->input->get('start_date');
		}

		if ($this->input->get('end_date')) {
			$where['DATE(t.created_at) <= '] = $this->input->get('end_date');
		}

		if ($this->input->get('photographer_id')) {
			$where['t.photographer_id'] = $this->input->get('photographer_id');
		}

		$trx = $this->TransaksiModel->GetTransaction($where);

		// echo $this->db->last_query($trx);
		// die;

		if ($trx) {
			foreach ($trx->result() as $tr) {
				$status = '';
				$action = '';
				$date = $tr->datetime;

				if ($tr->payment_date == NULL || $tr->payment_image == NULL) {
					$status = '<span class="badge badge-danger">Menunggu Pembayaran</span>';
				} else if ($tr->payment_validation_at == NULL || $tr->payment_validation_by == NULL) {
					$action = '
								<a target="_blank" href="' . base_url('assets/img/transactions/' . $tr->payment_image) . '" class="table-action text-success" title="Lihat Bukti Pembayaran"><i class="fas fa-eye"></i></a>
								<a data-id="' . $tr->id_transaction . '" href="#" class="table-action text-danger btn-cancel-payment" title="Batal Validasi Pembayaran"><i class="fas fa-ban"></i></a>
								<a data-date="' . date('Y-m-d\TH:i', strtotime($tr->datetime)) . '" data-id="' . $tr->id_transaction . '" href="#" class="table-action text-primary btn-validation" title="Validasi Pembayaran"><i class="fas fa-check"></i></a>
								';
					$status = '<span class="badge badge-warning">Menunggu Validasi</span>';
				} else {
					if ($tr->datetime != $tr->datetime_fix) {
						$date = $tr->datetime_fix;
						$status = '<span class="badge badge-success">Validasi Berhasil</span><span class="badge badge-danger">Jadwal di ubah</span>';
					} else {
						$status = '<span class="badge badge-success">Validasi Berhasil</span>';
					}
				}

				$data[] = array(
					'booking_code' => $tr->booking_code,
					'created_at' => DATE('d-m-Y H:i:s', strtotime($tr->created_at)),
					'customer_id' => $tr->customer_id,
					'datetime' => date('d-m-Y H:i:s', strtotime($date)),
					'email' => $tr->email,
					'id_transaction' => $tr->id_transaction,
					'name' => $tr->name,
					'note' => $tr->note,
					'packet_duration' => $tr->packet_duration,
					'packet_id' => $tr->packet_id,
					'packet_name' => $tr->packet_name,
					'packet_price' => number_format($tr->packet_price),
					'payment_date' => $tr->payment_date,
					'payment_image' => $tr->payment_image,
					'payment_validation_at' => $tr->payment_validation_at,
					'payment_validation_by' => $tr->payment_validation_by,
					'photographer_finish_confirm' => DATE('d-m-Y H:i:s', strtotime($tr->photographer_finish_confirm)),
					'photographer_id' => $tr->photographer_id,
					'photographer_take_booking' => $tr->photographer_take_booking,
					'role_id' => $tr->role_id,
					'updated_at' => $tr->updated_at,
					'photographer_name' => $tr->photographer_name,
					'status' => $status,
					'action' => $action
				);
			}
		}

		echo json_encode($data);
	}

	public function export()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];
		$sheet->setCellValue('A1', "LAPORAN TRANSAKSI"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('B3', "BOOKING CODE"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('C3', "PACKET NAME"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('D3', "PACKET PRICE"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('E3', "DATE & TIME"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('F3', "PHOTOGRAPHER NAME"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('G3', "CREATED AT"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('H3', "FINISH AT"); // Set kolom E3 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);

		$where = null;

		if ($this->input->get('start_date')) {
			$where['DATE(t.created_at) >= '] = $this->input->get('start_date');
		}

		if ($this->input->get('end_date')) {
			$where['DATE(t.created_at) <= '] = $this->input->get('end_date');
		}

		if ($this->input->get('photographer_id')) {
			$where['t.photographer_id'] = $this->input->get('photographer_id');
		}

		$trx = $this->TransaksiModel->GetTransaction($where);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		if ($trx) {
			foreach ($trx->result() as $data) {
				$sheet->setCellValue('A' . $numrow, $no);
				$sheet->setCellValue('B' . $numrow, $data->booking_code);
				$sheet->setCellValue('C' . $numrow, $data->packet_name);
				$sheet->setCellValue('D' . $numrow, $data->packet_price);
				$sheet->setCellValue('E' . $numrow, $data->datetime_fix);
				$sheet->setCellValue('F' . $numrow, $data->photographer_name);
				$sheet->setCellValue('G' . $numrow, $data->created_at);
				$sheet->setCellValue('H' . $numrow, $data->photographer_finish_confirm);

				// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
				$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
				$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);

				$no++; // Tambah 1 setiap kali looping
				$numrow++; // Tambah 1 setiap kali looping
			}
		}
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
		$sheet->getColumnDimension('F')->setWidth(30); // Set width kolom E
		$sheet->getColumnDimension('G')->setWidth(30); // Set width kolom E
		$sheet->getColumnDimension('H')->setWidth(30); // Set width kolom E

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$sheet->setTitle("Laporan Data Transaksi");
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Transaksi.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
