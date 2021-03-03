# Modify JWT payload

## Create the event

In the folder EventListener (if it's not here, create it) create a file named JWTCreatedListener.php and put the following code in it
```php
namespace App\EventListener;

use App\Repository\UserRepository;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\SerializerInterface;

class JWTCreatedListener {

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        
    }
} 
```  

## Declare the event

In config/services.yaml, put the following code at the end of the file :
```yaml
acme_api.event.jwt_created_listener:
        class: App\EventListener\JWTCreatedListener
        arguments: [ '@request_stack' ]
        tags:
            - { name: kernel.event_listener, event: lexik_jwt_authentication.on_jwt_created, method: onJWTCreated }

```

## Modify the payload

In onJWTCreated methode we can add data to the payload with : 
```php
$payload = $event->getData();
$payload['someData'] = ['coucou', 'hello'];
$event->setData($payload);
```