<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppBrand
 * 
 * @property int|null $id
 * @property string|null $brand_name
 * @property string|null $brand_url
 *
 * @package App\Models
 */
class DiscountsuppBrand extends Model
{
	protected $table = 'discountsupp_brand';
	public $timestamps = false;

	protected $fillable = [
		'brand_name',
		'brand_url'
	];
}
