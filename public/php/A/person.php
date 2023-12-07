<?php
namespace A;

function hello()
{
    echo "hello A";
}
class Pesrson
{
    use Info;
    public $name;
    protected $gender;
    private $age;
    public static $country;

    public function __construct()
    {
        echo __CLASS__."<br>";
    }

    public function setGender($gender)
    {
        $this->gender=$gender;
        return $this;
    }
}

?>
