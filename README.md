# smooth-pdo
A drop-in PDO wrapper that provides smooth and pleasant method chaining.

## Rationale
PDO is a perfectly fine way to access a database, but it would be a little more pleasant to work with if all the methods could be chained together.
Unfortunately, you can't do that with PDO since it uses boolean return values to indicate errors.
This just overrides the methods that use return values to indicate errors so they throw exceptions instead.

## Example
A typical example from the PDO documentation looks like this:
```php
$calories = 150;
$colour = 'red';

$sth = $dbh->prepare('SELECT name, colour, calories
    FROM fruit
    WHERE calories < :calories AND colour = :colour');
$sth->bindParam(':calories', $calories, PDO::PARAM_INT);
$sth->bindParam(':colour', $colour, PDO::PARAM_STR, 12);
$sth->execute();
```

Here's how it looks with `SmoothPdo\DataObject`:
```php
<?php
$calories = 150;
$colour = 'red';

$dbh->prepare('SELECT name, colour, calories
    FROM fruit
    WHERE calories < :calories AND colour = :colour')
    ->bindParam(':calories', $calories, PDO::PARAM_INT)
    ->bindParam(':colour', $colour, PDO::PARAM_STR, 12)
    ->execute();
```

## Migrating
You don't even need to start a new project to benefit from this library.
Because it extends `\PDO` and `\PDOStatement`, you can use it anywhere you already use PDO without much hassle.
Just update all the places you check the return values of these functions and you're ready to go:
* `PDO::beginTransaction`
* `PDO::commit`
* `PDO::rollback`
* `PDO::setAttribute`
* `PDOStatement::bindColumn`