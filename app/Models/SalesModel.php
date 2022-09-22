<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
	protected $table                = 'tbl_invoice';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	//protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = true;

	function checkInvoice()
	{
		$q = $this->db->query("SELECT
		MAX( SUBSTR( nomor_invoice, - 4 ) ) + 1 AS no_inv_max
			FROM
				tbl_invoice 
			WHERE
				SUBSTR( nomor_invoice, 4, 2 ) = DATE_FORMAT(CURRENT_DATE, '%y')
			AND SUBSTR( nomor_invoice, 6, 2 ) = DATE_FORMAT(CURRENT_DATE, '%m');");
		return $q;
	}

	function getContact()
	{
		$db = \Config\Database::connect();
		$q = $this->db->query("SELECT id_contact, name, company_name from tbl_contact");
		return $q;
	}
	function getContactcustomer()
	{
		$db = \Config\Database::connect();
		$q = $this->db->query("SELECT id_contact, name, company_name from tbl_contact where type =1");
		return $q;
	}

	function addCart1($id)
	{
		$id_user = session()->get('isLoggedIn');
		$session = session()->get('session');
		$q1 = $this->db->query("SELECT tbl_discount_program.discount FROM tbl_discount_program_in INNER JOIN tbl_discount_program ON tbl_discount_program.id = tbl_discount_program_in.id_discount_program WHERE tbl_discount_program.status = 'Y' AND tbl_discount_program_in.status = 'Y' AND tbl_discount_program_in.id_product_item = $id ");
		$r1 = $q1->getRow();
		$q2 = $this->db->query("INSERT INTO tbl_invoice_temp (id_product_item, product_name, quantity, unit_price, id_user, id_uniq, disc)
		SELECT id, product_name, 1, selling_price, '$id_user', '$session', '$r1->discount' FROM tbl_product_items WHERE id = $id ");
		return $q2;
	}
	function addCart2($id)
	{
		$id_user = session()->get('isLoggedIn');
		$session = session()->get('session');
		$q = $this->db->query("INSERT INTO tbl_invoice_temp (id_product_item, product_name, quantity, unit_price, id_user, id_uniq)
		SELECT id, product_name, 1, selling_price, '$id_user', '$session' FROM tbl_product_items WHERE id = $id ");
		return $q;
	}

	function getCart()
	{
		$q = $this->db->query("SELECT
									a.*,
									a.total2 - a.total1 AS total 
								FROM
									(
									SELECT
										tbl_invoice_temp.id,
										tbl_invoice_temp.quantity,
										tbl_product_items.id AS id_item,
										tbl_product_items.product_code,
										tbl_product_items.product_name,
										tbl_product_items.selling_price,
										tbl_product_items.quantity AS max_qty,
										tbl_invoice_temp.unit_price,
										tbl_invoice_temp.disc,
										FLOOR(CASE
											WHEN tbl_invoice_temp.disc > 0 THEN
											( tbl_invoice_temp.unit_price * tbl_invoice_temp.quantity ) * ( tbl_invoice_temp.disc / 100 ) ELSE 0 
										END) AS total1,
										tbl_invoice_temp.unit_price * tbl_invoice_temp.quantity AS total2 
									FROM
										tbl_invoice_temp
										INNER JOIN tbl_product_items ON tbl_product_items.id = tbl_invoice_temp.id_product_item 
									WHERE
									tbl_invoice_temp.id_user = '" . session()->get('isLoggedIn') . "') a									
									");
		return $q->getResult();
	}

	function grandTotal($no_invoice)
	{
		$sql = $this->db->query("SELECT
								SUM( b.total ) AS grandtotal 
							FROM
								(
								SELECT
									a.*,
									a.total2 - a.total1 AS total 
								FROM
									(
									SELECT
										FLOOR (
										CASE
												
												WHEN tbl_invoice_temp.disc > 0 THEN
												( tbl_invoice_temp.unit_price * tbl_invoice_temp.quantity ) * ( tbl_invoice_temp.disc / 100 ) ELSE 0 
											END 
											) AS total1,
											tbl_invoice_temp.unit_price * tbl_invoice_temp.quantity AS total2 
										FROM
											tbl_invoice_temp 
										WHERE
											tbl_invoice_temp.id_user = '" . session()->get('isLoggedIn') . "'
										) a 
									) b;");
		return $sql->getResult();
	}

	function grandTotalInv($no_invoice)
	{
		$sql = $this->db->query("SELECT
								SUM( b.total ) AS grandtotal 
							FROM
								(
								SELECT
									a.*,
									a.total2 - a.total1 AS total 
								FROM
									(
									SELECT
										FLOOR (
										CASE
												
												WHEN tbl_invoice_temp.disc > 0 THEN
												( tbl_invoice_temp.unit_price * tbl_invoice_temp.quantity ) * ( tbl_invoice_temp.disc / 100 ) ELSE 0 
											END 
											) AS total1,
											tbl_invoice_temp.unit_price * tbl_invoice_temp.quantity AS total2 
										FROM
											tbl_invoice_temp 
										WHERE
											tbl_invoice_temp.id_user = '" . session()->get('isLoggedIn') . "
										) a 
									) b;");
		return $sql->getResult();
	}

	function delItem($id)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('tbl_invoice_temp');
		$builder->where('id', $id);
		$builder->delete();
	}

	function updateCart($id_temp, $qty_temp)
	{
		// $qty_temp = $this->request->getPost("qty_temp");
		// $id_temp = $this->request->getPost("id_temp");
		$this->db->query("UPDATE tbl_invoice_temp SET quantity = $qty_temp WHERE id = $id_temp");

		// $db = \Config\Database::connect();
		// $builder = $db->table('tbl_invoice_temp');
		// $data = [
		// 	'quantity' => $qty_temp
		// ];

		// $builder->where('id', $id_temp);
		// $builder->update($data);

	}

	function getTempInv($date, $id_cashier, $no_invoice, $disc_type, $discount, $discount_amount, $grandtotal, $ppn,  $grandtotalpayment, $payment, $remainder_payment, $shipping, $contact_id, $contact_name, $contact_company_name, $contact_address, $contact_hp, $contact_telp, $contact_email)
	{

		$this->db->transStart();
		$this->db->query("INSERT INTO tbl_invoice (nomor_invoice, disc, disc_type,  disc_amount, grandtotal, ppn, grandtotalpayment, payment, remainder_payment, shipping, id_user, created_at, id_contact, contact_name, contact_company, contact_address, contact_hp, contact_telp, contact_email) VALUES ('$no_invoice', '$discount', '$disc_type', '$discount_amount', '$grandtotal', '$ppn', '$grandtotalpayment','$payment','$remainder_payment', '$shipping', '$id_cashier', '$date', '$contact_id', '$contact_name', '$contact_company_name', '$contact_address', '$contact_hp', '$contact_telp', '$contact_email')");
		$this->db->query("UPDATE tbl_product_items INNER JOIN tbl_invoice_temp ON tbl_invoice_temp.id_product_item = tbl_product_items.id SET tbl_product_items.quantity = tbl_product_items.quantity - tbl_invoice_temp.quantity WHERE tbl_invoice_temp.id_user ='$id_cashier' ");
		$this->db->query("INSERT INTO tbl_invoice_detail (nomor_invoice, id_product_item,product_name,quantity,disc_amount,unit_price,ppn,disc,id_user) SELECT '$no_invoice', id_product_item,product_name,quantity,disc_amount,unit_price,'$ppn',disc,id_user FROM tbl_invoice_temp WHERE id_user ='$id_cashier'");
		$this->db->query("DELETE FROM tbl_invoice_temp WHERE id_user='$id_cashier'");
		$this->db->transComplete();
	}

	function getInvoice($no_invoice)
	{
		// $sql = $this->db->query("SELECT tbl_invoice_detail.id,
		// tbl_invoice_detail.nomor_invoice,
		// tbl_invoice_detail.id_product_item,
		// tbl_invoice_detail.id_contact,
		// tbl_invoice_detail.id_user,
		// tbl_invoice_detail.quantity,
		// tbl_invoice_detail.disc,
		// tbl_invoice_detail.disc_amount,
		// tbl_invoice_detail.unit_price,
		// tbl_product_items.product_code,
		// tbl_product_items.product_name  
		// FROM tbl_invoice INNER JOIN tbl_invoice_detail ON tbl_invoice_detail.nomor_invoice = tbl_invoice.nomor_invoice INNER JOIN tbl_product_items on tbl_product_items.id = tbl_invoice_detail.id_product_item WHERE tbl_invoice.id_user = '" . session()->get('isLoggedIn') . "' AND tbl_invoice.nomor_invoice = '$no_invoice'");

		$sql = $this->db->query("SELECT
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
		return $sql->getResult();
	}

	function grandTotalInv1($no_invoice)
	{
		// $sql1 = $this->db->query("SELECT * FROM tbl_invoice WHERE tbl_invoice.nomor_invoice ='$no_invoice'");
		// $result1   = $sql1->getRow();
		// if ($result1->disc != null or $result1->disc != '') {
		// 	$sql = $this->db->query("SELECT * FROM tbl_invoice WHERE tbl_invoice.nomor_invoice ='$no_invoice'");
		// 	return $sql->getResult();
		// } else {
		// 	$sql = $this->db->query("SELECT sum(tbl_invoice_detail.unit_price * tbl_invoice_detail.quantity) as grandtotal, tbl_invoice_detail.disc_category FROM tbl_invoice_detail WHERE tbl_invoice_detail.nomor_invoice ='$no_invoice'");
		// 	return $sql->getResult();
		// }

		$sql = $this->db->query("SELECT
								SUM( b.total ) AS grandtotal, b.*
							FROM
								(
								SELECT
									a.*,
									a.total2 - a.total1 AS total 
								FROM
									(
									SELECT  tbl_invoice_detail.invoice_id,
										tbl_invoice_detail.nomor_invoice,
										tbl_invoice_detail.id_product_item,
										tbl_invoice_detail.id_contact,
										tbl_invoice_detail.id_user,
										tbl_invoice_detail.product_name,
										tbl_invoice_detail.quantity,
										tbl_invoice_detail.disc_category,
										tbl_invoice_detail.disc,
										tbl_invoice_detail.disc_type,
										tbl_invoice_detail.disc_amount,
										tbl_invoice_detail.unit_price,
										tbl_invoice.disc_category as disc_category_all,
										tbl_invoice.disc as disc_all,
										tbl_invoice.disc_type as disc_type_all,
										tbl_invoice.disc_amount as disc_amount_all,
										tbl_invoice.grandtotal,
										tbl_invoice.ppn,
										tbl_invoice.grandtotalpayment,										
										tbl_invoice.shipping, 
										tbl_invoice.payment, 
										tbl_invoice.remainder_payment, 
										FLOOR (
										CASE
												
												WHEN tbl_invoice_detail.disc > 0 THEN
												( tbl_invoice_detail.unit_price * tbl_invoice_detail.quantity ) * ( tbl_invoice_detail.disc / 100 ) ELSE 0 
											END 
											) AS total1,
											tbl_invoice_detail.unit_price * tbl_invoice_detail.quantity AS total2 
										FROM
											tbl_invoice
											INNER JOIN tbl_invoice_detail ON tbl_invoice_detail.nomor_invoice = tbl_invoice.nomor_invoice
											WHERE tbl_invoice_detail.nomor_invoice ='$no_invoice'
										) a 
									) b ");

		return $sql->getResult();
	}

	public function termOfPayment()
	{
		$sql = $this->db->query("SELECT * FROM tbl_payment_terms");
		return $sql->getResult();
	}
}
