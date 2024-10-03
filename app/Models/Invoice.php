<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'date',
        'emitter_identification',
        'emitter_name',
        'receiver_identification',
        'receiver_name',
        'total_value',
        'iva',
        'total_value_iva'
    ];

    /**
     * Get all of the items for the invoices.
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

}
