In PHP, a common yet often overlooked error involves improper handling of array keys, especially when dealing with functions that modify array structures.  Consider this scenario:

```php
function modifyArray(array &$arr) {
  unset($arr['key1']);
  $arr['key2'] = 'new value';
}

$myArray = ['key1' => 'old value', 'key2' => 'original value'];
modifyArray($myArray);
print_r($myArray); // Notice that key1 is gone, but key2 is replaced
```

While seemingly straightforward, this demonstrates an issue. If you loop through the array *after* modifying it using `unset()`, the loop might skip values, leading to unpredictable results or logic errors.  This happens because `unset()` doesn't reindex the array automatically.

Another subtle bug occurs when expecting integers as keys and inadvertently receiving strings. This can cause comparison issues and break your logic.  For instance:

```php
$myArray = [1 => 'value1', '1' => 'value2'];
foreach ($myArray as $key => $value) {
  echo "Key: $key, Value: $value\n";
}
```

This loop will only show two entries. PHP treats `1` and `'1'` as separate keys because of type coercion.  This behavior isn't always obvious, leading to unexpected results.