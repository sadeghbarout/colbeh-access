#Installation: 

1- Composer require colbeh/access

        
2- Add config file
        
        php artisan vendor:publish --provider="Colbeh\Access\ServiceProvider"

3- Go to config/access_colbeh and set your admin guard to check with permissions

4- add this HasRoles trait to your admin Model.

         use HasRoles

5- migrate 
        
        php artisan migrate
        
6- Go to database/seeders/PermissionsSeeder and add your permissions.

7- Seed your permissions

        php artisan db:seed --class=PermissionsSeeder
        
8- Go to App/Http/middleware/CheckPermission.php and add your conditions

#Upgrade:
        composer require colbeh/access:x.x.x
        
        
        
        
#Usage

###Rules
You can add your rules in

         App/Http/middleware/CheckPermission.php
for every controller and method
 
 
###Check with gate
If you want to check one permission in blade, you can use "permission" guard
 
```blade
  @can('permission','root')
        {{-- has permission --}}
  @endcan
```


###Check with helper
If you want to check one permission in code, you can use "hasAccess" method

```php
    if(Access::hasPermission('root')){
    
        // access granted
      
    }else{
    
        // access denied
    }
    
```


###Roles and permissions add,edit
Here is some function to add and edit roles and permissions:

 ```php
    * getAdmin ($id)
    * getRole ($id)
    
    * roleStore ($name,$desc,$permissionIds)
    * roleUpdate ($roleId,$name,$desc,$permissionIds=null)
    * roleToggle ($adminId,$permissionId)  // toggle a role to admin
    * roleAttach ($adminId,$permissionId)  // add a role to admin
    * roleDetach ($adminId,$permissionId)  // remove a role from admin
    * rolesList()
    
    * permissionToggle ($roleId,$permissionId)  // toggle a permission to role
    * permissionAttach ($roleId,$permissionId)  // add a permission to role
    * permissionDetach ($roleId,$permissionId)  // remove a permission from role
    * permissionsList ($roleId=null)
 ```
