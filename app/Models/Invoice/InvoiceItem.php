<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'quantity', 'amount', 'total'
    ];

    /**
     * Get the invoice that owns the invoice items.
     */
    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice\Invoice');
    }
}
