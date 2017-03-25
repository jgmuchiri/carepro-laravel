<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Addresses\Address;
use App\Models\Addresses\City;
use App\Models\Addresses\State;
use App\Models\Addresses\ZipCode;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'zip_code' => 'required|max:10',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'address_line_1' => 'required|max:255',
            'address_line_2' => 'max:255',
            'phone' => 'required|max:10'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
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

        $address = new Address([
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'phone' => $data['phone']
        ]);

        $address->city()->associate($city);
        $address->state()->associate($state);
        $address->zipCode()->associate($zip_code);

        $address->save();

        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->address()->associate($address);

        $user->save();

        return $user;
    }
}
