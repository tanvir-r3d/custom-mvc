<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class BuyerDetail extends Model
{
	protected $table = "buyer_details";
	protected $fillable = [
		'amount',
		'buyer',
		'receipt_id',
		'items',
		'buyer_email',
		'buyer_ip',
		'note',
		'city',
		'phone',
		'hash_key',
		'entry_at',
		'entry_by',
	];
	public $timestamps = false;

	public function getItemNamesAttribute()
	{
		return implode(',', json_decode($this->attributes['items'], true));
	}
}