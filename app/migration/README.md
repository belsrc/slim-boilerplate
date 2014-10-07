## Migrations
Depends on Phinx. Thorough documentation can be found [here](http://docs.phinx.org/en/latest).

#### To Create A Migration

__Windows__
```PowerShell
cd vendor/bin
```
```PowerShell
phinx.bat create -c ../../phinx.yml [MigrationName]
```

__Linux__
```Shell
cd vendor/bin
```
```Shell
php phinx create -c ../../phinx.yml [MigrationName]
```

#### To Run the Migrations

__Windows__
```PowerShell
cd vendor/bin
```
```PowerShell
phinx.bat migrate -e [development|production] -c ../../phinx.yml
```

__Linux__
```Shell
cd vendor/bin
```
```Shell
php phinx migrate -e [development|production] -c ../../phinx.yml
```
