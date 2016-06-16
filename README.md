Glory\Executor
======

执行指定命名空间下的类 execute namespace\\*->execute()
----

### 

```
//src/app/install/User.php
namespace App\Install;

use Glory\Executor\Mission;

class User extends Mission
{
    //The greater the number the first execution, default 0.
    public function getPriority()
    {
        return 0;
    }

    //Whether can be allowed to execute.
    public function isValid()
    {
        return isInstall()? false: true;
    }

     public function execute()
    {
        //you execute code.
    }
}

```

```php
use Glory\Executor\Executor;

$executor = new Executor();
$executor->addNamespace('App\\Install', getRealpath('app\\install'));
$executor->execute();
//execute App\Install\*->execute()
```

### Symfony Bundle Usage

Configure in you bundle

```yaml
services:
    appbundle.executor:
        class: Glory\Executor\Bundle\ContainerAwareExecutor
        calls:
            - [ setContainer, [@service_container] ]
            - [ setEventDispatcher, [@event_dispatcher] ]
```

```php
$executor = $this->getContainer()->get('appbundle.executor');

foreach ($this->getContainer()->get('kernel')->getBundles() as $bundle) {
    $executor->addNamespace($bundle->getNamespace() . '\\Install', $bundle->getPath() . '\\Install');
}
$executor->execute();
foreach ($executor->getMissions() as $mission) {
    var_dump(get_class($mission), $mission->getResult());
}
// 将按顺序执行所有 Bundle\Install\* 类
// *Bundle\Install\*->execute();
```

```php
namespace AppBundle\Install;

use Glory\Executor\Mission;
use Glory\Executor\Bundle\ContainerAwareMission;

class UserInstall extends ContainerAwareMission
{

    public function execute()
    {
        //User Install Code
    }

}
```
