<?php
/**
 * Test
 *
 * @copyright Copyright © 2021 Peretiatko Kyrylo. All rights reserved.
 * @author    batontramp@gmail.com
 */

namespace Training\TestOM\Model;


class Test
{
    private $manager;
    private $arrayList;
    private $name;
    private $number;

    /**
     * Test constructor.
     * @param ManagerInterface $manager
     * @param $name
     * @param int $number
     * @param array $arrayList
     */
    public function __construct(
        \Training\TestOM\Model\ManagerInterface $manager,
        $name,
        int $number,
        array $arrayList
    )
    {
        $this->manager = $manager;
        $this->name = $name;
        $this->number = $number;
        $this->arrayList = $arrayList;
    }

    public function log()
    {
        print_r(get_class($this->manager));
        echo '<br>';
        print_r($this->name);
        echo '<br>';
        print_r($this->number);
        echo '<br>';
        var_dump($this->arrayList);
    }
}
