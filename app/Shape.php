<!-- Create classes to represent geometric shapes, including circles and rectangles.
 Implement methods for area calculation -->

<?php
class Shape
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function calculateArea()
    {
        return 0;
    }
}

class Circle extends Shape
{
    private $radius;

    public function __construct($radius)
    {
        parent::__construct("Circle");
        $this->radius = $radius;
    }

    public function calculateArea()
    {
        return pi() * pow($this->radius, 2);
    }
}

class Rectangle extends Shape
{
    private $width;
    private $height;

    public function __construct($width, $height)
    {
        parent::__construct("Rectangle");
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateArea()
    {
        return $this->width * $this->height;
    }
}

// Usage
$circle = new Circle(3);
$rectangle = new Rectangle(2, 4);

echo $circle->getName() . " Area: " . $circle->calculateArea() . PHP_EOL;
echo $rectangle->getName() . " Area: " . $rectangle->calculateArea();
