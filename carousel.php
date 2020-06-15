<?php
/**
 * Created by PhpStorm.
 * @author Alerinos
 * @github https://github.com/Alerinos
 *
 */

class Carusele {

    private int $account;
    private array $items = [];

    public int $price;

    public function __construct(int $account)
    {
        $this->account = $account;
    }

    /**
     * A function to dedicate the number of items
     * @param array $list
     */
    public function items(array $list): void
    {
        $this->items = $list;
    }

    /**
     * Prize draw feature
     * @return int
     * @throws Exception
     */
    public function random(): int
    {
        $rand = rand(1,1000);
        $list = array_map(function ($v) use ($rand){
            if($v[1] >= $rand){
                return $v[0];
            }else{
                return null;
            }
        }, $this->items);

        $list = array_filter($list);

        if(count($list) == 0){
            return $this->random();
        }

        $reward = $list[array_rand($list, 1)];

        $this->getPoints();             // Checks if the user has points
        if($this->subtractPoints()){    // Subtracts points
            $this->reward($reward);     // Gives a reward
            return $reward;
        }else{
            return false;
        }
    }

    /**
     * Function to display items during the draw
     * @param int $quantity
     * @return array
     */
    public function contents(int $quantity = 20): array
    {
        $contents = [];
        for ($i = 1; $i <= $quantity; $i++){
            $rand = rand(0, count($this->items) - 1);
            $contents[] = $this->items[$rand][0];
        }

        return $contents;
    }

    /**
     * Function for passing the prize
     * @param int $item
     */
    public function reward(int $item): void
    {
        // TODO: Make a prize here, e.g. put data in MySQL
    }

    /**
     * The function checks the number of points on the account
     * @return int
     * @throws Exception
     */
    public function getPoints(): int
    {
        // TODO: Add character points check here
        // $this->account; // Here you have the account ID
        $points = 500;

        if($points <= $this->price){
            throw new Exception("No points, top up your account.");
        }

        return $points;
    }

    /**
     * The function deducts points from the account
     * @return bool
     */
    public function subtractPoints(): bool
    {
        // TODO: Subtract points from the user here, return true if the result is correct.
        $this->account;
        $this->price;
        return true;
    }

}

$c = new Carusele(1);
$c->price = 100;
$c->items([
    [100100, 500],
    [100200, 500],
    [100000, 500],
    [100300, 200],
    [100400, 200],
    [100500, 100],
    [30270, 100],
    [50255, 100],
    [50256, 100],
    [50257, 100],
    [50258, 100],
    [50259, 100],
]);

try{
    $reward = $c->random();
}catch (Exception $e){
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>M2-System-Carousel-draw</title>
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <style>
        .carousel {
            height: 80px;
        }

        .slick-slide {}

        .slick-center {
            background-color: red;
        }

        .slick-track {
            display: flex;
        }
        .slick-track .slick-slide {
            display: flex;
            height: auto;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">congratulations, you won</h1>
                    <p class="lead"><img src='https://atonis.pl/Module/Template/m2/img/M2/item/<?= $reward ?>.png' /></p>
                </div>
            </div>

        </div>

        <div class="col-12" >
            <div class="carousel text-center">
                <?PHP
                    $items = [...$c->contents(15), $reward, ...$c->contents(10)];
                    $stop = 15+1+10+15;
                    foreach ($items as $r){
                        echo "<div><img src='https://atonis.pl/Module/Template/m2/img/M2/item/$r.png' /></div>";
                    }
                ?>
            </div>
        </div>

        <div class="col-12">
            <button type="button" class="btn btn-outline-success w-100" onclick="window.location.reload();">spin again</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
        let c = $('.carousel').slick({
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 7,
            speed: 50,
            autoplay: false,
        });

        loop(<?= $stop ?>);
        function loop(count) {
            if(count > 0) {
                setTimeout(function () {
                    count = count - 1;

                    $('.carousel').slick('slickNext');
                    console.log(count);
                    loop(count)
                }, 50);
            }
        }
    });
</script>

</body>
</html>