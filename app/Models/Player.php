<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'player';
    protected const FIELD_ID = 'id';
    protected const FIELD_USERNAME = 'username';
    protected const FIELD_PHONENUMBER = 'phonenumber';
    protected const FIELD_UNIQUE_LINK = 'unique_link';
    protected const FIELD_EXPIRES_AT= 'expires_at';

    protected $fillable = [
        self::FIELD_USERNAME,
        self::FIELD_PHONENUMBER,
        self::FIELD_UNIQUE_LINK,
        self::FIELD_EXPIRES_AT,
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function getId()
    {
        return $this->attributes[self::FIELD_ID];
    }

    public function getUsername()
    {
        return ucfirst($this->attributes[self::FIELD_USERNAME]);
    }

    public function setUsername($username): void
    {
        $this->attributes[self::FIELD_USERNAME] = trim($username);
    }

    public function getPhonenumber()
    {
        return $this->formatPhoneNumber($this->attributes[self::FIELD_PHONENUMBER]);
    }

    public function setPhonenumberAttribute($phonenumber): void
    {
        $this->attributes[self::FIELD_PHONENUMBER] = preg_replace('/\D/', '', $phonenumber);
    }

    public function getUniqueLink()
    {
        return $this->attributes[self::FIELD_UNIQUE_LINK];
    }

    public function setUniqueLink($uniqueLink)
    {
        $this->attributes[self::FIELD_UNIQUE_LINK] = strtolower($uniqueLink);
    }

    public function getExpiresAt()
    {
        return Carbon::parse($this->attributes[self::FIELD_EXPIRES_AT])
            ->format('Y-m-d H:i:s');
    }

    public function setExpiresAt($expiresAt)
    {
        $this->attributes[self::FIELD_EXPIRES_AT] = Carbon::parse($expiresAt);
    }

    protected function formatPhoneNumber($phoneNumber)
    {
        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $phoneNumber);
    }
}
