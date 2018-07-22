<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name_full',
        'name_short',
        'contact_name',
        'contact_phone',
        'email',
        'site',
        'time_zone',
        'inn',
        'kpp',
        'okpo',
        'ogrn'
    ];

    public $reg_data_names = [
        'Полное наименование',
        'Сокращенное наименование',
        'Контактное лицо',
        'Контактный номер телефона',
        'Электронный адрес',
        'Сайт',
        'Часовой пояс',
        'ИНН',
        'КПП',
        'ОКПО',
        'ОГРН'
    ];

    public function tenders()
    {
        return $this->hasMany('App\Customer', 'App\Tender');
    }

    public function getData()
    {
        $data = [
            "$this->name_full",
            "$this->name_short",
            "$this->contact_name",
            "$this->contact_phone",
            "$this->email",
            "$this->site",
            "$this->time_zone",
            "$this->inn",
            "$this->kpp",
            "$this->okpo",
            "$this->ogrn"
        ];

        return $data;
    }
}
