<?php

namespace Bestform\Divider\Tests;


use Bestform\Divider\Divider;

class DividerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function it_divides_for_existing_parts()
    {
        $divider = new Divider();
        $result = $divider->divide(5000);

        $this->assertEquals([5000 => 1], $result);
    }

    /**
     * @test
     */
    public function it_divides_for_exact_multiples_of_one_part()
    {
        $divider = new Divider();
        $result = $divider->divide(400);

        $this->assertEquals([200 => 2], $result);
    }

    /**
     * @test
     */
    public function it_divides_for_arbitrary_amounts()
    {
        $divider = new Divider();

        $this->assertEquals([500 => 1, 100 => 1], $divider->divide(600));
        $this->assertEquals([5000 => 1, 1000 => 1], $divider->divide(6000));
        $this->assertEquals([5000 => 1, 1000 => 1, 100 => 1], $divider->divide(6100));
    }


    /**
     * @test
     */
    public function it_divides_for_fractions()
    {
        $divider = new Divider();

        $this->assertEquals([20 => 1, 10 => 1], $divider->divide(30));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_denies_working_with_floats()
    {
        $divider = new Divider([3, 5, 0.2]);
    }

    /**
     * @test
     */
    public function it_works_with_unsorted_custom_value_lists()
    {
        $divider = new Divider([1, 4, 2, 3]);

        $this->assertEquals([4=>1, 1=>1], $divider->divide(5));
    }

    /**
     * @test
     */
    public function it_handles_rest_values()
    {
        $divider = new Divider([3]);

        $this->assertEquals([3=>1, "REST" => 1], $divider->divide(4));
    }
}
