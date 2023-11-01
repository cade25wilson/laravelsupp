<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountsuppWebsite
 * 
 * @property int|null $id
 * @property string|null $name
 * @property string|null $url
 * @property string|null $tag_element
 * @property string|null $tag_class
 * @property string|null $nametag
 * @property string|null $nameclass
 * @property string $brandtag
 * @property string $brandclass
 * @property string $ogpricetag
 * @property string $ogpriceclass
 * @property string|null $dispricetag
 * @property string|null $dispriceclass
 * @property string|null $urltag
 * @property string|null $urlclass
 * @property string|null $imgtag
 * @property string $imgclass
 * @property |null $active
 * @property int $advertiser_id
 * 
 * @property DiscountsuppAdvertiser $discountsupp_advertiser
 *
 * @package App\Models
 */
class DiscountsuppWebsite extends Model
{
	protected $table = 'discountsupp_website';
	public $timestamps = false;

	protected $casts = [
		'active' => NULL,
		'advertiser_id' => 'int'
	];

	protected $fillable = [
		'name',
		'url',
		'tag_element',
		'tag_class',
		'nametag',
		'nameclass',
		'brandtag',
		'brandclass',
		'ogpricetag',
		'ogpriceclass',
		'dispricetag',
		'dispriceclass',
		'urltag',
		'urlclass',
		'imgtag',
		'imgclass',
		'active',
		'advertiser_id'
	];

	public function discountsupp_advertiser()
	{
		return $this->belongsTo(DiscountsuppAdvertiser::class, 'advertiser_id');
	}
}
