<?php

namespace App\Models\Notes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $table = 'notes';

    protected $fillable = [
        'title',
        'body',
        'witnesses',
        'action_taken',
        'remarks',
    ];

    protected $casts = [
        'created_by_user_id' => 'int',
        'location_id' => 'int',
        'note_type_id' => 'int'
    ];

    /**
     * Relationship to the children this note belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children()
    {
        return $this->belongsToMany(
            \App\Models\Child::class,
            'notes_to_children',
            'note_id',
            'child_id'
        );
    }

    /**
     * Relationship to the location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(\App\Models\Notes\Location::class, 'location_id');
    }

    /**
     * Relationship to this note's types
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(\App\Models\Notes\Type::class, 'note_type_id');
    }

    /**
     * Relationship to this note's photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photos()
    {
        return $this->belongsTo(\App\Models\Notes\Photo::class);
    }

    /**
     * Relationship to the incident type for this note
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incidentType()
    {
        return $this->belongsTo(\App\Models\Notes\IncidentType::class, 'incident_type_id');
    }
}
