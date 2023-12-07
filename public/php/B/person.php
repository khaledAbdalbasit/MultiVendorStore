<?php
namespace B;

function hello()
{
    echo "hello B";
}

class Pesrson
{
    public $name;
    protected $gender;
    private $age;
    public static $country;

    public function __construct()
    {
        echo __CLASS__."<br>";
    }
    public function setName($name)
    {
        $this->name=$name;
        return $this;
    }

    public function setAge($age)
    {
        $this->age=$age;
        return $this;
    }

    public function setGender($gender)
    {
        $this->gender=$gender;
        return $this;
    }
}

?>
