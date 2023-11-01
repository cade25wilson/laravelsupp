<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppSubscription
 * 
 * @property int|null $id
 * @property |null $active
 * @property string|null $email
 *
 * @package App\Models
 */
class DiscountsuppSubscription extends Model
{
	protected $table = 'discountsupp_subscription';
	public $timestamps = false;

	protected $casts = [
		'active' => NULL
	];

	protected $fillable = [
		'active',
		'email'
	];
}
