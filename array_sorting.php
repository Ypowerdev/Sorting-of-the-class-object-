<?php 

class Phone
{
    public function __construct(string $title, float $price)
    {
        $this->phoneTitle = $title;
        $this->phonePrice = $price;
    }
}


class Phones
{

    const UNSORTING = 'unsorting';
    const TITLE = 'title';
    const PRICE = 'price';

    private string $sortingType = self::UNSORTING;

    public array $list = [];

    public function __construct(array $items = [])
    {
        foreach ($items as ['title' => $title, 'price' => $price]) {
            $this->list[] = new Phone($title, $price);
        }
    }

    public function sort(string $field = Phones::PRICE): void
    {
               
        $this->sortingType = $field;
        usort($this->list, function( $a, $b ) use ($field) {
            return $a->$field == $b->$field ? 0 : ( $a->$field > $b->$field ? -1 : 1);
        });
    }

    public function print(): void  
    {
        echo "\n" . 'Sorting by ' . $this->sortingType . ": \n";

        foreach ($this->list as $phone) {
            echo 'Phone: ' . $phone->phoneTitle . ' (' . $phone->phonePrice . " p.) \n";
        }
    }
}

$itemsArray = [
    [
        'title' => 'Nokia',
        'price' => 20500,
    ],
    [
        'title' => 'Iphone25',
        'price' => 120000,
    ],
    [
        'title' => 'Samsung',
        'price' => 80000,
    ]];
    
$phones = new Phones($itemsArray);

echo "<pre>";
$phones->print();

$phones->sort();
$phones->print();

$phones->sort(Phones::PRICE);
$phones->print();

$phones->sort(Phones::TITLE);
$phones->print();

?> 
