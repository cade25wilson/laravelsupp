<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppCategory
 * 
 * @property int|null $id
 * @property string|null $name
 *
 * @package App\Models
 */
class DiscountsuppCategory extends Model
{
	protected $table = 'discountsupp_category';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}
