<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSectionItem extends Model
{
    protected $fillable = [
        'page_section_id',
        'title',
        'description',
        'value',
        'suffix',
        'icon',
        'icon_color',
        'sort_order',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }
}
