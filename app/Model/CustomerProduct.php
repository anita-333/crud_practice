<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerProduct extends Model
{
    use Notifiable;
    protected $table = 'customer_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer',
        'material',
        'telephone',
        'thickness',
        'width',
        'length',
        'quantity',
        'shipment_date'
    ];

    /**
     * @param $info
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function createInfo($info)
    {
        return $this->query()->create($info);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getInfo()
    {
        return $this->query()->get();
    }

    /**
     * @param $condition
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function firstInfo($condition)
    {
        return $this->query()->where($condition)->first();
    }

    /**
     * @param $search_condition
     * @param $change_Information
     * @return int
     */
    public function updateInfo($search_condition,$change_Information)
    {
        return $this->query()->where($search_condition)->update($change_Information);
    }

    /**
     * @param $search_condition
     * @return mixed
     */
    public function deleteInfo($search_condition)
    {
        return $this->query()->where($search_condition)->delete();
    }










}

