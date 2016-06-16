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
$executor = new BundleExecutor();
$executor->addNamespace('App\\Install', getRealpath('app\\install'));
$executor->execute();
//execute App\Install\*->execute()
```