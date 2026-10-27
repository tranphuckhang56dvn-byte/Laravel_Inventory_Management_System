<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsIssueItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'goods_issue_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function issue()
    {
        return $this->belongsTo(GoodsIssue::class, 'goods_issue_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
