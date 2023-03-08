<?php

namespace Tests\Unit\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected function model(): Model 
    {
        return new User();
    }

    public function test_traits_from_model_user()
    {
        $traits = array_keys(class_uses($this->model()));

        $expectedTraits = [
            HasApiTokens::class,
            HasFactory::class,
            Notifiable::class
        ];

        $this->assertEquals($expectedTraits,$traits);
    }

    public function test_check_fillable_from_model_user()
    {
        $fillables = $this->model()->getFillable();

        $expectedFillables = [
            'name',
            'email',
            'password'
        ];

        $this->assertEquals($expectedFillables,$fillables);
    }

    public function teste_has_cast_from_model_user()
    {
        $expectedCast = [
            'id' => 'int',
            'email_verified_at' => 'datetime'
        ];

        $casts = $this->model()->getCasts();

        $this->assertEquals($expectedCast, $casts);
    }
}
