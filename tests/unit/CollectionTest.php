<?php

class CollectionTest extends \PHPUnit\Framework\TestCase
{
    protected $collection;

    public function setUp(): void
    {
        $this->collection = new \App\Support\Collection([]);
    }

    /** @test */
    public function empty_instaintiated_collection_returns_no_items()
    {
        $this->assertEmpty($this->collection->get());
    }
    /** @test */
    public function count_is_correct_for_items_passed_in()
    {
        $collection = new App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $this->assertEquals(3, $collection->count());
    }

    /** @test */

    public function items_returned_match_items_passed_in()
    {
        $collection = new App\Support\Collection([
            'one', 'two'
        ]);

        $this->assertCount(2, $collection->get());
        $this->assertEquals($collection->get()[0], 'one');
        $this->assertEquals($collection->get()[1], 'two');
    }

    /** @test */

    public function collection_is_instance_of_iterator_aggregate()
    {
        $collection = new App\Support\Collection([]);

        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }
    /** @test */
    public function collection_can_be_iterated()
    {
        $collection = new App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $items = [];
        foreach ($collection as $item) {
            $items[] = $item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    /** @test */

    public function collection_can_be_merged_with_another_collection()
    {
        $collection1 = new App\Support\Collection([
            'one', 'two', 'three'
        ]);
        $collection2 = new App\Support\Collection([
            'four', 'five'
        ]);

        $collection1->merge($collection2);

        $this->assertCount(5, $collection1->get());
        $this->assertEquals(5, $collection1->count());
    }
    /** @test */
    public function can_add_to_existing_collection()
    {
        $collection = new App\Support\Collection([
            'one', 'two', 'three'
        ]);

        $collection->add(['four']);

        $this->assertEquals(4, $collection->count());
        $this->assertCount(4, $collection->get());
    }

    /** @test */

    public function returns_json_encoded_items()
    {
        $collection = new \App\Support\Collection([
            ['username' => 'Nazmus'],
            ['username' => 'Sakib']
        ]);

        $this->assertEquals('[{"username":"Nazmus"},{"username":"Sakib"}]', $collection->toJson());
    }
}
