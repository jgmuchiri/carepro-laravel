<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'plans';

    protected $fillable = ['name', 'number_of_children_allowed', 'number_of_staff_allowed', 'has_invoice_due_alert_to_parents'];

    protected $casts = [
        'number_of_children_allowed' => 'int',
        'number_of_staff_allowed' => 'int',
        'has_invoice_due_alert_to_parents'
    ];

    /**
     * Query scope for where the plan name is
     *
     * @param Builder $query
     * @param string $name
     */
    public function scopeWhereName(Builder $query, $name)
    {
        $query->where('name', '=', $name);
    }

    public function getNameLabelAttribute($value)
    {
        return __($this->name);
    }
}
