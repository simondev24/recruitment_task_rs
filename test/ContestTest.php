<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\Contest;
use App\Core as Core;

class ContestTest extends TestCase
{
    private array $contests;

    protected function setUp(): void
    {
        $this->contests = ([
            ['user_1', new \DateTime('2023-02-01'), 10],
            ['user_2', new \DateTime('2023-02-02'), 16],
            ['user_3', new \DateTime('2023-01-03'), 11],
            ['user_1', new \DateTime('2023-02-04'), 6],
            ['user_4', new \DateTime('2023-02-11'), 1],
        ]);
    }

    public function testGetUsersWithHighestPointsMonthly() {
        $expectedResult = [
            'user_1' => 16,
            'user_2' => 16
        ];

        $contest = new Contest();

        $reflection = new \ReflectionClass($contest);
        $reflection_property = $reflection->getProperty('contests');
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($contest, $this->contests);

        $result = $contest->getUsersWithHighestPointsMonthly(new \DateTime('2023-02-22'));
        $this->assertEquals($result, $expectedResult);
    }
}