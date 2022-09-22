<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductitemsModel;
use App\Models\SalesModel;
// use App\ThirdParty\FPDF;
use FPDF;
use TCPDF;

class Sales extends BaseController
{
	public function __construct()
	{
		$this->itemsModel = new ProductitemsModel();
		$this->salesModel = new SalesModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Sales',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales',
			'breadcrumb' => 'Sales',
			'product' => $this->itemsModel->sales(),
			'invoice' => $this->salesModel->checkInvoice(),
			'contact' => $this->salesModel->getContactcustomer(),
			'termOfPayment' => $this->salesModel->termOfPayment(),
			'cart' => $this->salesModel->getCart(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('sales/v_sales_index3', $data);
	}
	public function updateCart()
	{

		$id_temp = $this->request->getPost("id_temp");
		$qty_temp = $this->request->getPost("qty_temp");
		// dd($id_temp . '-' . $qty_temp);
		if ($qty_temp == '') {
			$qty_temp = 0;
		}
		$data = $this->salesModel->updateCart($id_temp, $qty_temp);
		$data2 = $this->salesModel->getCart();
		echo json_encode($data2);
	}
	public function getData()
	{
		$data = $this->salesModel->getCart();
		echo json_encode($data);
	}
	public function add_product()
	{

		$id = $this->request->getGet('id');
		##check product id
		$db = \Config\Database::connect();
		$check = $db->query("SELECT * FROM tbl_discount_program_in INNER JOIN tbl_discount_program ON tbl_discount_program.id = tbl_discount_program_in.id_discount_program WHERE tbl_discount_program.status = 'Y' AND tbl_discount_program_in.status = 'Y' AND tbl_discount_program_in.id_product_item = $id  ");
		if ($check->getNumRows() > 0) {
			$this->salesModel->addCart1($id);
			return redirect()->to('/sales');
		} else {

			$this->salesModel->addCart2($id);
			return redirect()->to('/sales');
		}
	}
	public function getGrandTotal()
	{
		$no_invoice = $this->request->getGet("invoice");
		$data = $this->salesModel->grandTotal($no_invoice);
		echo json_encode($data);
	}
	public function delete()
	{
		$id = $this->request->getGET('id');
		$this->salesModel->delItem($id);
		return redirect()->to('/sales');
	}
	public function submitPayment()
	{

		$id_contact = $this->request->getPost("id_contact");

		#data contact
		$db = \Config\Database::connect();
		$sql = $db->query("SELECT * FROM tbl_contact WHERE id_contact =$id_contact ");

		if ($sql->getNumRows()) {
			$row = $sql->getRow();
			$contact_id = $row->id_contact;
			$contact_name = $row->name;
			$contact_company_name = $row->company_name;
			$contact_address = $row->payment_address;
			$contact_hp = $row->hp;
			$contact_telp = $row->telp;
			$contact_email = $row->email;
		} else {
			$contact_id = '';
			$contact_name = '';
			$contact_company_name = '';
			$contact_address = '';
			$contact_hp = '';
			$contact_telp = '';
			$contact_email = '';
		}

		// dd($contact_id . $contact_name . $contact_company_name . $contact_address . $contact_hp . $contact_telp . $contact_email);

		$date = date("Y-m-d H:i:s");
		$id_cashier = $this->request->getPost("id_cashier");
		$no_invoice = $this->request->getPost("no_invoice");
		$disc_type = $this->request->getPost("disc_type");
		$discount = $this->request->getPost("discount");
		$ppn = $this->request->getPost("ppn");
		$discount_amount = $this->request->getPost("discount_amount");
		$grandtotal = $this->request->getPost("grantotal");
		$grandtotalpayment = $this->request->getPost("grantotalPayment");
		$payment = $this->request->getPost("payment");
		$remainder_payment = $this->request->getPost("sisa");
		$shipping = $this->request->getPost("shipping");


		$sql = $this->salesModel->getTempInv($date, $id_cashier, $no_invoice, $disc_type, $discount, $discount_amount, $grandtotal, $ppn, $grandtotalpayment, $payment, $remainder_payment, $shipping, $contact_id, $contact_name, $contact_company_name, $contact_address, $contact_hp, $contact_telp, $contact_email);
		return redirect()->to('/sales/invoice?no_invoice=' . "$no_invoice");
	}

	public function invoice()
	{
		$no_invoice = $this->request->getGet('no_invoice');
		$db = \Config\Database::connect();
		$sql = $db->query("SELECT * FROM tbl_profile_comp");
		if ($sql->getNumRows()) {
			$row = $sql->getRow();
			$comp_name = $row->company_name;
			$comp_address = $row->address;
			$comp_telp = $row->telp;
			$comp_email = $row->email;
			$comp_bank = $row->bank_name;
			$comp_bank_account = $row->account_number;
			$comp_bank_account_under_name = $row->bautno;
		} else {
			$comp_name = '';
			$comp_address = '';
			$comp_telp = '';
			$comp_email = '';
			$comp_bank = '';
			$comp_bank_account = '';
			$comp_bank_account_under_name = '';
		}

		$sql2 = $db->query("SELECT * FROM tbl_invoice WHERE nomor_invoice = '" . $no_invoice . "'");
		if ($sql2->getNumRows()) {
			$row2 = $sql2->getRow();
			$contact_name = $row2->contact_name;
			$contact_company = $row2->contact_company;
			$contact_telp = $row2->contact_telp;
			$contact_email = $row2->contact_email;
			$contact_address = $row2->contact_address;
		} else {
			$contact_name = '';
			$contact_company = '';
			$contact_telp = '';
			$contact_email = '';
			$contact_address = '';
		}
		$data = [
			'title' => 'Sales',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales',
			'h2' => 'Invoice',
			'no_invoice' => $no_invoice,
			'comp_name' => $comp_name,
			'comp_address' => $comp_address,
			'comp_telp' => $comp_telp,
			'comp_email' => $comp_email,
			'comp_bank' => $comp_bank,
			'contact_name' => $contact_name,
			'contact_company' => $contact_company,
			'contact_telp' => $contact_telp,
			'contact_email' => $contact_email,
			'contact_address' => $contact_address,
			'comp_bank_account' => $comp_bank_account,
			'comp_bank_account_under_name' => $comp_bank_account_under_name,
			'breadcrumb' => 'Sales',
			'invoice' => $this->salesModel->getInvoice($no_invoice),
			'grandTotal' => $this->salesModel->grandTotalInv1($no_invoice),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('sales/v_invoice', $data);
	}

	public function invoicePrint()
	{
		$no_invoice = $this->request->getGet('no_invoice');
		$data = [
			'title' => 'Sales',
			'category_menu' => 'Main Menu',
			'no_invoice' => $no_invoice,
			'invoice' => $this->salesModel->getInvoice($no_invoice),
			'grandTotal' => $this->salesModel->grandTotalInv1($no_invoice),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('sales/v_invoice_print', $data);
	}

	public function invoicePrint2()
	{
		$no_invoice = $this->request->getGet('no_invoice');
		$db = \Config\Database::connect();
		$sql = $db->query("SELECT * FROM tbl_profile_comp");
		if ($sql->getNumRows()) {
			$row = $sql->getRow();
			$comp_name = $row->company_name;
			$comp_address = $row->address;
			$comp_telp = $row->telp;
			$comp_email = $row->email;
			$comp_bank = $row->bank_name;
			$comp_bank_account = $row->account_number;
			$comp_bank_account_under_name = $row->bautno;
		} else {
			$comp_name = '';
			$comp_address = '';
			$comp_telp = '';
			$comp_email = '';
			$comp_bank = '';
			$comp_bank_account = '';
			$comp_bank_account_under_name = '';
		}
		$sql2 = $db->query("SELECT * FROM tbl_invoice WHERE nomor_invoice = '" . $no_invoice . "'");
		if ($sql2->getNumRows()) {
			$row2 = $sql2->getRow();
			$contact_name = $row2->contact_name;
			$contact_company = $row2->contact_company;
			$contact_telp = $row2->contact_telp;
			$contact_email = $row2->contact_email;
			$contact_address = $row2->contact_address;
		} else {
			$contact_name = '';
			$contact_company = '';
			$contact_telp = '';
			$contact_email = '';
			$contact_address = '';
		}
		$data = [
			'title' => 'Sales',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales',
			'h2' => 'Invoice',
			'no_invoice' => $no_invoice,
			'comp_name' => $comp_name,
			'comp_address' => $comp_address,
			'comp_telp' => $comp_telp,
			'comp_email' => $comp_email,
			'comp_bank' => $comp_bank,
			'contact_name' => $contact_name,
			'contact_company' => $contact_company,
			'contact_telp' => $contact_telp,
			'contact_email' => $contact_email,
			'contact_address' => $contact_address,
			'comp_bank_account' => $comp_bank_account,
			'comp_bank_account_under_name' => $comp_bank_account_under_name,
			'invoice' => $this->salesModel->getInvoice($no_invoice),
			'grandTotal' => $this->salesModel->grandTotalInv1($no_invoice)
		];


		$filename = $no_invoice;
		$date = date("d-m-Y");
		$pdf = new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(0, 7, 'Kepada YTH.', 0, 1, 'L');
		$pdf->Cell(0, 7, $contact_name, 0, 0, 'L');
		$pdf->Cell(0, 7, 'Invoice ' . $no_invoice, 0, 1, 'R');
		$pdf->Cell(0, 4, $contact_address, 0, 0, 'L');
		$pdf->Cell(0, 4, 'Date: ' . $date, 0, 1, 'R');
		$pdf->Cell(0, 4, 'Phone: ' . $contact_telp, 0, 1, 'L');
		$pdf->Cell(0, 4, 'Email: ' . $contact_email, 0, 1, 'L');
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->Cell(50, 6, 'Product Code', 1, 0, 'C');
		$pdf->Cell(120, 6, 'Product Name', 1, 0, 'C');
		$pdf->Cell(20, 6, 'Quantity', 1, 1, 'C');
		$sql3 = $db->query("SELECT
						a.*,
						a.total2 - a.total1 AS total
						FROM
						(
						SELECT
							tbl_invoice_detail.id,
							tbl_invoice_detail.nomor_invoice,
							tbl_invoice_detail.id_product_item,
							tbl_invoice_detail.id_contact,
							tbl_invoice_detail.id_user,
							tbl_invoice_detail.quantity,
							tbl_invoice_detail.disc,
							tbl_invoice_detail.disc_amount,
							tbl_invoice_detail.unit_price,
							tbl_product_items.product_code,
							tbl_product_items.product_name, 
							FLOOR(CASE
								WHEN tbl_invoice_detail.disc > 0 THEN
								( tbl_invoice_detail.unit_price * tbl_invoice_detail.quantity ) * ( tbl_invoice_detail.disc / 100 ) ELSE 0 
							END) AS total1,
							tbl_invoice_detail.unit_price * tbl_invoice_detail.quantity AS total2 
							FROM tbl_invoice INNER JOIN tbl_invoice_detail ON tbl_invoice_detail.nomor_invoice = tbl_invoice.nomor_invoice INNER JOIN tbl_product_items on tbl_product_items.id = tbl_invoice_detail.id_product_item WHERE tbl_invoice.id_user = '" . session()->get('isLoggedIn') . "' AND tbl_invoice.nomor_invoice = '$no_invoice') a									
						");
		foreach ($sql3->getResult() as $row3) {
			$pdf->Cell(50, 6, $row3->product_code, 1, 0, 'L');
			$pdf->Cell(120, 6, $row3->product_name, 1, 0, 'L');
			$pdf->Cell(20, 6, $row3->quantity, 1, 1, 'C');
		}
		$this->response->setContentType('application/pdf');
		$pdf->Output('I', $filename, true);

		// $html =  view('sales/v_invoice_print2', $data);
		// // create new PDF document
		// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// // remove default header/footer
		// $pdf->setPrintHeader(false);
		// $pdf->setPrintFooter(false);
		// // add a page
		// $pdf->AddPage();
		// $pdf->writeHTML($html);
		// $this->response->setContentType('application/pdf');
		// //Close and output PDF document
		// $pdf->Output('example_006.pdf', 'I');
	}

	public function suratJalan()
	{
		$no_invoice = $this->request->getGet('no_invoice');
		$db = \Config\Database::connect();
		$sql = $db->query("SELECT * FROM tbl_profile_comp");
		if ($sql->getNumRows()) {
			$row = $sql->getRow();
			$comp_name = $row->company_name;
			$comp_address = $row->address;
			$comp_telp = $row->telp;
			$comp_email = $row->email;
			$comp_bank = $row->bank_name;
			$comp_bank_account = $row->account_number;
			$comp_bank_account_under_name = $row->bautno;
		} else {
			$comp_name = '';
			$comp_address = '';
			$comp_telp = '';
			$comp_email = '';
			$comp_bank = '';
			$comp_bank_account = '';
			$comp_bank_account_under_name = '';
		}
		$data = [
			'title' => 'Sales',
			'category_menu' => 'Main Menu',
			'no_invoice' => $no_invoice,
			'comp_name' => $comp_name,
			'comp_address' => $comp_address,
			'comp_telp' => $comp_telp,
			'comp_email' => $comp_email,
			'comp_bank' => $comp_bank,
			'comp_bank_account' => $comp_bank_account,
			'comp_bank_account_under_name' => $comp_bank_account_under_name,
			'invoice' => $this->salesModel->getInvoice($no_invoice),
			'grandTotal' => $this->salesModel->grandTotalInv1($no_invoice)
		];
		echo view('sales/v_surat_jalan_print', $data);
	}



	function loadData()
	{
		echo $this->showCart();
	}

	function showCart()
	{
		$data = $this->salesModel->getCart();
		$output = '';
		$no = 1;
		foreach ($data as $items) {
			$no++;
			$output .= '
				<tr>
					<td>' . $no++ . '</td>
					<td>' . $items->product_code . '</td>
					<td>' . $items->product_name . '</td>
					<td class="text-center"><input type="number" name="qty_temp" id="qty_temp" value="' . $items->quantity . '" min="1" max="' . $items->max_qty . '"  style="width: 100%" ></td>
					<td class="text-right">Rp. ' . number_format($items->unit_price) . '</td>
					<td class="text-right">Rp. ' . number_format($items->total) . '</td>
					<td><button type="button" id="' . $items->id . '" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
				</tr>
			';
		}
		// $output .= '
		// 	<tr>
		// 		<th colspan="3">Total</th>
		// 		<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
		// 	</tr>
		// ';
		return $output;
	}
}
