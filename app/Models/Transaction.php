<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   /**
     * Fillable attribute.
     *
     * @var array
     */
    protected $fillable = [
        'billing_firstname',
        'billing_lastname',
        'billing_country',
        'billing_address',
        'billing_address_type',
        'billing_city',
        'billing_postcode',
        'billing_phone',
        'billing_email',
        'billing_subtotal',
        'billing_tax',
        'billing_total'
    ];

    /**
     * Set transaction status to $status.
     *
     * @return void
     */
    public function setStatus($status)
    {
        switch($status) {
            case 'challenge': {
                $this->attributes['status'] = 'Detected by FDS';
                self::save();
                break;
            }
            case 'pending': {
                $this->attributes['status'] = 'Pending';
                self::save();
                break;
            }
            case 'deny': {
                $this->attributes['status'] = 'Failed';
                self::save();
                break;
            }
            case 'expire': {
                $this->attributes['status'] = 'Expired';
                self::save();
                break;
            }
            case 'cancel': {
                $this->attributes['status'] = 'Cancelled';
                self::save();
                break;
            }
        }
    }

    /**
     * Set transaction status to success.
     *
     * @return void
     */
    public function setSuccess($type)
    {
        $this->attributes['status'] = 'Success';
        $this->attributes['payment_type'] = $type;
        self::save();
    }
}
