<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppAdvertiser
 * 
 * @property int|null $id
 * @property string|null $name
 * @property string|null $url
 *
 * @package App\Models
 */
class DiscountsuppAdvertiser extends Model
{
	protected $table = 'discountsupp_advertiser';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'url'
	];
}
