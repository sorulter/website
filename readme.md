## iProxier.com



### schedule

​	In order to reset flows of users,**MUST** add follow crontab item to your server.

``` bash
* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1
```

