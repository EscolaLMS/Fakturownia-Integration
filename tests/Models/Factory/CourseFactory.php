<?php

namespace EscolaLms\FakturowniaIntegration\Tests\Models\Factory;

use EscolaLms\Courses\Database\Factories\CourseFactory as BaseCourseFactory;
use EscolaLms\FakturowniaIntegration\Tests\Models\Course;

class CourseFactory extends BaseCourseFactory
{
    protected $model = Course::class;
}
