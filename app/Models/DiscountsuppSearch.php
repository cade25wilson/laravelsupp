<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppSearch
 * 
 * @property int|null $id
 * @property string|null $search
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class DiscountsuppSearch extends Model
{
	protected $table = 'discountsupp_search';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'search',
		'date'
	];
}
