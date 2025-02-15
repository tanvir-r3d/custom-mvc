<?php

namespace App\Controllers;

use App\Models\BuyerDetail;
use Exception;

class HomeController
{
	public function index()
	{
		return view("Backend/home");
	}

	public function store()
	{
		if (count($this->validateData()) > 0) {
			return json_encode([
				'error' => 'Validation error',
				'status' => 401,
				'message' => 'Form Validation Error!',
				'data' => $this->validateData()
			]);
		}

		$buyer = $_POST['buyer'];
		$amount = $_POST['amount'];
		$receiptId = $_POST['receipt_id'];
		$buyerEmail = $_POST['buyer_email'];
		$city = $_POST['city'];
		$phone = $_POST['phone'];
		$entryBy = $_POST['entry_by'];
		$items = $_POST['items'];
		$note = $_POST['note'];


		$buyerIp = $_SERVER['REMOTE_ADDR'];
		$hashKey = generateHash($receiptId);

		try {
			BuyerDetail::create([
				'amount' => $amount,
				'buyer' => $buyer,
				'receipt_id' => $receiptId,
				'items' => json_encode($items),
				'buyer_email' => $buyerEmail,
				'buyer_ip' => $buyerIp,
				'note' => $note,
				'city' => $city,
				'phone' => $phone,
				'hash_key' => $hashKey,
				'entry_at' => date('Y-m-d'),
				'entry_by' => $entryBy,
			]);

			return json_encode([
				'message' => 'Successfully buyer details stored.',
				'status' => 201,
			]);
		} catch (Exception $exception) {
			return json_encode([
				'error' => $exception->getMessage(),
				'status' => 500,
				'message' => 'Oops! Something went wrong.'
			]);
		}
	}

	private function validateData()
	{
		$buyer = $_POST['buyer'];
		$amount = $_POST['amount'];
		$receiptId = $_POST['receipt_id'];
		$buyerEmail = $_POST['buyer_email'];
		$city = $_POST['city'];
		$phone = $_POST['phone'];
		$entryBy = $_POST['entry_by'];
		$items = $_POST['items'];
		$note = $_POST['note'];
		$validationBag = [];

		if (!validateInput($amount, '/^\d+$/')) {
			$validationBag['amount'] = 'Amount must be number';
		}

		if (!validateInput($buyer, '/^[a-zA-Z0-9\s]{1,20}$/')) {
			$validationBag['buyer'] = 'Buyer must be string, number or space and not exceed 20 characters';
		}

		if (!validateInput($receiptId, '/^[a-zA-Z]+$/')) {
			$validationBag['receipt_id'] = 'Receipt Id must be string, number or space';
		}

		if (!filter_var($buyerEmail, FILTER_VALIDATE_EMAIL)) {
			$validationBag['buyer_email'] = 'Buyer email must be in email format';
		}

		if (str_word_count($note) > 30) {
			$validationBag['note'] = 'Note can\'t be longer then 30 charecter';
		}

		if (!validateInput($city, '/^[a-zA-Z\s]+$/')) {
			$validationBag['city'] = 'City must be string, number or space';
		}

		if (!validateInput($phone, '/^880\d+$/')) {
			$validationBag['phone'] = 'Phone must be number';
		}

		if (!validateInput($entryBy, '/^\d+$/')) {
			$validationBag['entry_by'] = 'Entry by must be number';
		}

		foreach ($items as $i => $item) {
			if (!validateInput($item, '/^[a-zA-Z\s]+$/')) {
				$validationBag['items'][$i] = 'Item must be string, number or space';
			}
		}
		return $validationBag;
	}

	public function list()
	{
		$page = $_GET['page'] ?? 1;
		$phone = $_GET['phone'] ?? null;
		$entryBy = $_GET['entry_by'] ?? null;
		$buyerDetails = BuyerDetail::query()
			->when($phone, function ($query) use ($phone) {
				return $query->where('phone', 'LIKE', "%$phone%");
			})
			->when($entryBy, function ($query) use ($entryBy) {
				return $query->where('entry_by', 'LIKE', "%$entryBy");
			})
			->paginate(10, '*', 'page', $page);

		return view("Backend/list", ['buyerDetails' => $buyerDetails]);
	}
}