# M2-System-Carousel-draw

![screen](https://github.com/Alerinos/M2-System-Carousel/blob/master/screen/1.png?raw=true)
System for drawing items for points  
For the system to work, you need to connect to your base (class, function, etc.). They are marked as TODO   

Setting:
```
$c->price = 100;  // Number of points needed for the draw
$c->items([       // List of items to be won. [ID, Promil] (percentage * 10)
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
```

Instruction
```
The class has no database connection, you must use your (PDO, MySQLi etc.)
1.) Find the reward() function, paste your SQL into the database where it will receive the prize. The $item variable is the item ID.
2.) Check the status of your points in the getPoints() function
3.) In the subtractPoints() function you must subtract points from your account.

$this->account - User account ID
$this->price - Price for using the draw
```

If you have a problem with the configuration, I help on discord Alerin#5559

HTML and JS code is an example, you can use another one or expand the current one.
