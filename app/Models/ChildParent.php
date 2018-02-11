<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use function dump;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class ChildParent extends Model
{
    use SoftDeletes;

    protected $table = 'parents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo_uri', 'date_of_birth', 'pin', 'is_primary'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Store attributes and their casts
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
        'is_primary' => 'bool'
    ];

    /**
     * Attributes that should be treated as dates
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = ['full_photo_uri'];

    /**
     * Relationship to the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(\App\User::class,'id', 'user_id');
    }

    /**
     * Relationship to this parent's children
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany(
            \App\Models\Child::class,
            'children_to_parents',
            'parent_id',
            'child_id'
        );
    }

    /**
     * Returns registration stats
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getRegistrationStats($filter = null)
    {
        $is_returning_all_records = false;
        if ($filter == null) {
            $date_difference_results = self::query()
                ->selectRaw(
                    'YEAR(MAX(created_at)) - YEAR(MIN(created_at)) - (DATE_FORMAT(MAX(created_at), \'%m%d\') < DATE_FORMAT(MIN(created_at), \'%m%d\')) AS \'difference\',
                    MIN(created_at) as \'first_date\'')
                ->first();
            $filter = $date_difference_results->difference > 0 ? 'yearly' : 'monthly';
            $is_returning_all_records = true;
            $first_date = new Carbon($date_difference_results->first_date);
            $first_date = $first_date->startOfMonth()->startOfDay();
        }

        $query = self::query();

        switch ($filter) {
            case "monthly":
                $query->selectRaw("count(*) as 'count', MONTH(created_at) as 'month'")
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->orderByRaw('MONTH(created_at) ASC');

                if (!$is_returning_all_records) {
                    $query->where('created_at', '>=', Carbon::now()->subYear());
                }
                break;
            default:
                $query->selectRaw("count(*) as 'count', YEAR(created_at) as 'year'")
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->where('created_at', '>=', Carbon::now()->subYear(10))
                    ->orderByRaw('YEAR(created_at) ASC');;
                break;
        }

        $results = $query->get();

        foreach ($results as $result) {
            $date = null;
            if ($filter == "monthly"){
                $date = Carbon::create(null, $result->month)->startOfMonth()->startOfDay();
            } elseif ($filter == "yearly"){
                $date = Carbon::create($result->year)->startOfMonth()->startOfDay();
            }

            $result->date = $date;
        }

        $stats = [];
        $last_date = Carbon::now()->startOfMonth()->startOfDay();
        if ($filter == 'monthly' && !$is_returning_all_records) {
            $first_date = Carbon::now()->subYear(1)->startOfMonth()->startOfDay();
        } elseif ($filter == 'yearly') {
            $first_date = Carbon::now()->subYear(10)->startOfMonth()->startOfDay();
        }
        $current_date = $first_date;

        while ($current_date <= $last_date) {
            $stat = new stdClass();
            $stat->count = 0;
            if ($filter == 'monthly') {
                $stat->label = $current_date->format('M');
            } elseif ($filter == 'yearly') {
                $stat->label = $current_date->format('Y');
            }

            $current_value = null;
            $current_value = $results->first(function ($value, $key) use ($current_date, $filter) {
                if ($filter == 'monthly') {
                    return $current_date->month == $value->date->month;
                }

                return $current_date->equalTo($value->date);
            });

            if ($current_value != null) {
                $stat->count = $current_value->count;
            }
            $stats[] = $stat;

            if ($filter == null || $filter == 'monthly') {
                $current_date = $current_date->addMonth();
            } else {
                $current_date = $current_date->addYear();
            }
        }

        return $stats;
    }

    /**
     * Query scope for where belongs to daycare
     *
     * @param Builder $query
     * @param int $daycare_id
     */
    public function scopeWhereDaycareId(Builder $query, $daycare_id)
    {
        $query->select($this->getTable() . '.*')
            ->join('users', 'users.id', '=', $this->getTable() . '.user_id')
            ->where('users.daycare_id', '=', $daycare_id);
    }

    /**
     * Gets the full photo uri
     *
     * @return string
     */
    public function getFullPhotoUriAttribute()
    {
        if (empty($this->photo_uri)) {
            return asset('/img/portrait.png');
        }
        return asset('storage/' . $this->photo_uri);
    }
}
