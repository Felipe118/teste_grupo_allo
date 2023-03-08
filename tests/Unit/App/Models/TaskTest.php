<?php

namespace Tests\Unit\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function model() :Task
    {
        return new Task();
    }

    public function test_traits_from_model_task()
    {
        $traits = array_keys(class_uses($this->model()));

        $expectedTraits = [
           HasFactory::class,
        ];

        $this->assertEquals($expectedTraits,$traits);
    }

    public function test_check_fillable_from_model_task()
    {
        $fillables = $this->model()->getFillable();

        $expectedFillables = [
            'title',
            'description',
            'status',
            'completion_date',
            'user_id',
        ];

        $this->assertEquals($expectedFillables,$fillables);
    }

}
