<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Child extends Model
{
    use SoftDeletes;

    protected $table = 'children';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'ssn',
        'dob',
        'pin',
        'photo',
        'gender_id',
        'blood_type_id',
        'status_id',
        'created_by_user_id',
        'updated_by_user_id',
        'religion_id',
        'ethnicity_id'
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
        'gender_id' => 'int',
        'blood_type_id' => 'int',
        'status_id' => 'int',
        'created_by_user_id' => 'int',
        'updated_by_user_id' => 'int',
        'religion_id' => 'int',
        'ethnicity_id' => 'int',
        'is_active' => 'bool'
    ];

    /**
     * Attributes that should be treated as dates
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_of_birth'
    ];

    protected $appends = [
        'full_photo_uri',
        'full_photo_uri_original',
        'is_checked_in'
    ];

    /**
     * Relationship to this child's parents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parents()
    {
        return $this->belongsToMany(
            \App\Models\ChildParent::class,
            'children_to_parents',
            'child_id',
            'parent_id'
        );
    }

    /**
     * Relationship to this child's groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(
            \App\Models\Groups\Group::class,
            'groups_to_children',
            'child_id',
            'group_id'
        );
    }

    /**
     * Relationship to this child's status
     *
     * @return \Illuminate\Database\Eloquent\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_id');
    }

    /**
     * Relationship to this child's notes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notes()
    {
        return $this->belongsToMany(
            \App\Models\Notes\Note::class,
            'notes_to_children',
            'child_id',
            'note_id'
        );
    }

    /**
     * Relationship to this child's photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photos()
    {
        return $this->hasMany(\App\Models\Photo::class, 'child_id');
    }

    /**
     * Relationship to this child's pickup users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pickupUsers()
    {
        return $this->hasMany(\App\Models\PickupUsers\PickupUser::class, 'child_id');
    }

    /**
     * Relationship to attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendance()
    {
        return $this->hasMany(\App\Models\Attendance::class, 'child_id');
    }

    /**
     * Relationship to medication
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medication()
    {
        return $this->hasMany(\App\Models\Medication::class, 'child_id');
    }

    /**
     * Relationship to emergency contacts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emergencyContacts()
    {
        return $this->hasMany(\App\Models\EmergencyContact::class, 'child_id');
    }

    /**
     * Relationship to health providers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function healthProviders()
    {
        return $this->hasMany(\App\Models\HealthProviders\HealthProvider::class, 'child_id');
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
        $query->distinct()->select($this->getTable() . '.*')
            ->join(
            'children_to_parents',
            'children_to_parents.child_id',
            '=',
            $this->getTable() . '.id')
            ->join('parents', 'parents.id', '=', 'children_to_parents.parent_id')
            ->join('users', 'users.id', '=', 'parents.user_id')
            ->where('users.daycare_id', '=', $daycare_id);
    }

    /**
     * Query scope for where belongs to a specific parent
     *
     * @param Builder $query
     * @param int $user_id
     */
    public function scopeWhereParentId(Builder $query, $user_id)
    {
        $query->select($this->getTable() . '.*')
            ->join(
                'children_to_parents',
                'children_to_parents.child_id',
                '=',
                $this->getTable() . '.id')
            ->join('parents', 'parents.id', '=', 'children_to_parents.parent_id')
            ->where('parents.user_id', '=', $user_id);
    }

    /**
     * Query scope for where is pending approval
     *
     * @param Builder $query
     */
    public function scopeWherePendingApproval(Builder $query)
    {
        $query->distinct()->select($this->getTable() . '.*')
            ->join(
                'statuses',
                function ($join) {
                    $join->on('statuses.id', '=', $this->getTable() . '.status_id')
                        ->where('statuses.name', '=', 'Pending Approval');
                }
            );
    }

    /**
     * Query scope for where is assigned to staff member
     *
     * @param Builder $query
     */
    public function scopeWhereAssignedStaffId(Builder $query, $id)
    {
        $query->distinct()->select($this->getTable() . '.*')
            ->join(
                'groups_to_children',
                'groups_to_children.child_id',
                '=',
                $this->getTable() . '.id'
            )->join(
                'groups_to_staff',
                'groups_to_staff.group_id',
                '=',
                'groups_to_children.group_id'
            );
    }

    /**
     * Get full photo uri
     *
     * @return string
     */
    public function getFullPhotoUriAttribute()
    {
        if ($this->photo =="") {
            return  asset('/img/portrait.png');
        }

        return asset('storage/' . $this->photo);
    }

    /**
     * Get full photo uri for the original photo
     *
     * @return string
     */
    public function getFullPhotoUriOriginalAttribute()
    {
        if ($this->photo =="") {
            return  asset('/img/portrait.png');
        }

        $split_uri = explode('/', $this->photo);
        $file_name = array_pop($split_uri);
        $full_uri = implode('/', $split_uri) . '/original/' . $file_name;
        return asset('storage/' . $full_uri);
    }

    public function getIsCheckedInAttribute()
    {
        $attendance = $this->attendance()->onlyLastRecord()->first();

        if ($attendance == null || $attendance->check_out_date != null) {
            return false;
        }

        return true;
    }
}
