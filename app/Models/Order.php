<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'vendor_id',
    	'order_number',
    	'cart_details',
    	'total_amount',
    	'order_status',
    	'vendor_status'
    ];

    public function get_user($id) {
        $user = User::where('id', $id)->first();
        $data['name']    = $user->name;
        $data['email']   = $user->email;
        $data['pincode'] = $user->pincode;
        return $data;
    }
}
