<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppSupplement
 * 
 * @property int|null $id
 * @property string $name
 * @property float $original_price
 * @property float $discount_price
 * @property string $url
 * @property int $brand_id
 * @property string $image
 * @property int $category_id
 * @property Carbon|null $date
 * @property float $discount
 * @property |null $active
 * @property int $advertiser_id
 * @property int $supplementlink_id
 * 
 * @property DiscountsuppBrand $discountsupp_brand
 * @property DiscountsuppCategory $discountsupp_category
 * @property DiscountsuppAdvertiser $discountsupp_advertiser
 * @property DiscountsuppSupplementlink $discountsupp_supplementlink
 *
 * @package App\Models
 */
class DiscountsuppSupplement extends Model
{
	protected $table = 'discountsupp_supplement';
	public $timestamps = false;

	protected $casts = [
		'original_price' => 'float',
		'discount_price' => 'float',
		'brand_id' => 'int',
		'category_id' => 'int',
		'date' => 'datetime',
		'discount' => 'float',
		'active' => NULL,
		'advertiser_id' => 'int',
		'supplementlink_id' => 'int'
	];

	protected $fillable = [
		'name',
		'original_price',
		'discount_price',
		'url',
		'brand_id',
		'image',
		'category_id',
		'date',
		'discount',
		'active',
		'advertiser_id',
		'supplementlink_id'
	];

	public function discountsupp_brand()
	{
		return $this->belongsTo(DiscountsuppBrand::class, 'brand_id');
	}

	public function discountsupp_category()
	{
		return $this->belongsTo(DiscountsuppCategory::class, 'category_id');
	}

	public function discountsupp_advertiser()
	{
		return $this->belongsTo(DiscountsuppAdvertiser::class, 'advertiser_id');
	}

	public function discountsupp_supplementlink()
	{
		return $this->belongsTo(DiscountsuppSupplementlink::class, 'supplementlink_id');
	}
}
