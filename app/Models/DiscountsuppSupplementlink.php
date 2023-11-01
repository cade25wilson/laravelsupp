<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppSupplementlink
 * 
 * @property int|null $id
 * @property string|null $name
 * @property string|null $url
 *
 * @package App\Models
 */
class DiscountsuppSupplementlink extends Model
{
	protected $table = 'discountsupp_supplementlink';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'url'
	];
}
