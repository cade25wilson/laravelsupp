<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppBrandpagevisit
 * 
 * @property int|null $id
 * @property string|null $page
 * @property Carbon|null $date
 * @property string|null $brand
 *
 * @package App\Models
 */
class DiscountsuppBrandpagevisit extends Model
{
	protected $table = 'discountsupp_brandpagevisit';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'page',
		'date',
		'brand'
	];
}
