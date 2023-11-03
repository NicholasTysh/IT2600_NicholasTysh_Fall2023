<!DOCTYPE html>
<html>

<head>
    <style>
        div {
            margin-bottom: 20px;
        }
    </style>
    <?php
    // tax amount is 7%
    define("TAX", 0.07);

    // 1. Add 3 properties to the Book class: $title, $author, and $price. 
    class Book
    {
        // Properties
        public $title;
        public $author;
        public $price;

        // 2. Fill-in the following constructor method, so that it assigns values to the properties $title, $author, and $price
        function __construct($title, $author, $price)
        {
            $this->title = $title;
            $this->author = $author;
            $this->price = $price;
        }

        // 3. Create a method called display(), which outputs a line for the current book with title, author, and price
        function display()
        {
            echo
            "<div>" .
                "<b>Title:</b> " . $this->title . "<br>" .
                "<b>Author:</b> " . $this->author . "<br>" .
                "<b>Price:</b> $" . number_format($this->price, 2) .
            "</div>";
        }
    }

    // 4. Create a function called get_tax() that calculates the tax using the constant TAX defined above. Return the price * tax amount.
    function get_tax($price)
    {
        return $price * TAX;
    }

    // Book object 1
    $book1 = new Book($_POST['book1title'], $_POST['book1author'], $_POST['book1price']);
    $book1->display();

    // 5. Create a second object called book2. Use the values posted from index.php to assign values to the properties of the book object. Display it.
    $book2 = new Book($_POST['book2title'], $_POST['book2author'], $_POST['book2price']);
    $book2->display();

    // 6. Create variables for $tax, $cost_with_tax. 
    // Calculate and display a total cost before tax (both books), tax cost, and total cost with tax.
    $cost_before_tax = $book1->price + $book2->price;
    $tax = get_tax($book1->price) + get_tax($book2->price);
    $cost_with_tax = $cost_before_tax + $tax;

    echo "<div><b>Total cost of book1 and book2:</b><br>$" . number_format($cost_before_tax, 2) . "</div>";
    echo "<div><b>Taxes on book1 and book2:</b><br>$" . number_format($tax, 2) . "</div>";
    echo "<div><b>Cost after tax for book1 and book2:</b><br>$" . number_format($cost_with_tax, 2) . "</div>";
    ?>
</head>

<body>
</body>

</html>