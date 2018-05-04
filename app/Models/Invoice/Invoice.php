<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice\InvoiceItem;
use App\Models\Invoice\InvoiceStatus;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'due_date', 'invoice_terms', 'tax', 'invoice_status', 'amount'
    ];

    /**
     * Relationship to invoice items
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoiceitems()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    /**
     * Relationship to invoice statuses
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoicestatus()
    {
        return $this->belongsTo(InvoiceStatus::class, 'invoice_status');
    }
}
