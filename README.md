# maph
Traits that helps you to destructure arguments on complex classes and self wiring simple dependencies

## Usage

For creation with unordered parameters you can use the `Maph\Destructure` trait.
This trait adds a public static method `create` that allows you to send a keyed array
that matches the names of the indexes with the name of the parameter for association,
creating the class if all the required named parameters are supplied on the sent keyed array.

```php
class SomeOverParamethrizedObject
{
    use Maph\Destructure;

    public function __construct(
        Handler $handler,
        Publisher $publisher,
        Mailer $mailer,
        Logger $logger,
        string $attachmentsPath,
        string $storagePath,
        int $severity,
        bool $verbose
    ) {
        // some logic
    }
}

$object = SomeOverParamethrizedObject::create([
   'mailer' => $mailer,
   'logger' => $logger,
   'severity' => Logger::SEVERITY_CRITICAL,
   'publisher' => $publisher,
   'handler' => $handler,
   'attachmentsPath' => '/var/files/attachments',
   'verbose' => false,
   'storagePath' => 's3://my-bucket'
]);

echo get_class($object); // SomeOverParamethrizedObject
```

You can also define classes as self wiring with the `Maph\SelfWire` trait, if they are able to create their own parameters
without any further dependencies they will create an instance for it.

```php
class Curl
{
    public function get($url)
    {
        echo sprintf('GET "%s"', $url);
    }
}

class ApiClient
{
    use Maph\SelfWire;

    public function __construct(Curl $curl)
    {
        $curl->get("http://api-endpoint/");
    }
}


$client = ApiClient::wire(); // GET http://api-endpoint/

```

