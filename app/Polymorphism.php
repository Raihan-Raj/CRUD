<!-- Build a set of animal classes that demonstrate polymorphism by overriding a method for making sounds -->

<?php

interface SoundMaker
{
    public function makeSound();
}

class Animal implements SoundMaker
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function makeSound()
    {
        return "Unknown sound";
    }
}

class Dog extends Animal
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function makeSound()
    {
        return "Woof!";
    }
}

class Cat extends Animal
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function makeSound()
    {
        return "Meow!";
    }
}

class Elephant extends Animal
{
    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function makeSound()
    {
        return "Trumpet!";
    }
}

// Usage
$dog = new Dog("Dog");
$cat = new Cat("Cat");
$elephant = new Elephant("Elephant");

$animals = [$dog, $cat, $elephant];

foreach ($animals as $animal) {
    echo $animal->name . " makes sound: " . $animal->makeSound() . PHP_EOL;
}
