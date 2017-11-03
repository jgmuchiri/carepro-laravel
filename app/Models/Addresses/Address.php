<?php

namespace App\Models\Addresses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = ['address_line_1', 'address_line_2', 'phone'];

    /**
     * Relationship to the city for this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(\App\Models\Addresses\City::class);
    }

    /**
     * Relationship to the state for this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(\App\Models\Addresses\State::class);
    }

    /**
     * Relationship to the zip code for this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zipCode()
    {
        return $this->belongsTo(\App\Models\Addresses\ZipCode::class);
    }

    /**
     * Relationship to the country for this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(\App\Models\Addresses\Country::class);
    }

    /**
     * Relationship to the users that have this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(\App\Models\Addresses\Address::class);
    }

    /**
     * Gets the rules used to validate an address and its relationships
     *
     * @return array
     */
    public static function getRules()
    {
        return [
            'zip_code' => 'required|max:10',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'address_line_1' => 'required|max:255',
            'address_line_2' => 'max:255',
            'phone' => 'required|max:50',
            'country' => 'required|exists:countries,id'
        ];
    }

    /**
     * Creates an address from raw data input
     *
     * @param array $data
     */
    public static function createFromRawInput($data)
    {
        $city = City::whereName($data['city'])->first();
        if (empty($city)) {
            $city = City::create(['name' => $data['city']]);
        }

        $state = State::whereName($data['state'])->first();
        if (empty($state)) {
            $state = State::create(['name' => $data['state']]);
        }

        $zip_code = ZipCode::whereZipCode($data['zip_code'])->first();
        if (empty($zip_code)) {
            $zip_code = ZipCode::create(['zip_code' => $data['zip_code']]);
        }

        $country = Country::find($data['country']);

        $address = new Address([
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'phone' => $data['phone']
        ]);

        $address->city()->associate($city);
        $address->state()->associate($state);
        $address->zipCode()->associate($zip_code);
        $address->country()->associate($country);

        $address->save();

        return $address;
    }

    /**
     * Updates an address from raw data input
     *
     * @param array $data
     */
    public function updateFromRawInput($data)
    {
        $city = City::whereName($data['city'])->first();
        if (empty($city)) {
            $city = City::create(['name' => $data['city']]);
        }

        $state = State::whereName($data['state'])->first();
        if (empty($state)) {
            $state = State::create(['name' => $data['state']]);
        }

        $zip_code = ZipCode::whereZipCode($data['zip_code'])->first();
        if (empty($zip_code)) {
            $zip_code = ZipCode::create(['zip_code' => $data['zip_code']]);
        }

        $country = Country::find($data['country']);

        $this->fill([
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'phone' => $data['phone']
        ]);

        $this->city()->associate($city);
        $this->state()->associate($state);
        $this->zipCode()->associate($zip_code);
        $this->country()->associate($country);

        $this->save();
    }
}
