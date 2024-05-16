<?php

namespace App\Models;

use App\Models\Point;
use App\Models\Reset;
use App\Models\Version;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ads extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'home',
        'fanpage',
        'image',
        'category_id',
        'reset_id',
        'version_id',
        'point_id',
        'short_description',
        'server',
        'alpha_test',
        'open_beta',
        'exp',
        'drop',
        'anti_hack',
        'description',
    ];
    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function reset(): belongsTo
    {
        return $this->belongsTo(Reset::class);
    }
    public function version(): belongsTo
    {
        return $this->belongsTo(Version::class);
    }
    public function point(): belongsTo
    {
        return $this->belongsTo(Point::class);
    }
}
