## Routes

To take advantage of the conditional route loader your routes should be broken up into modules.
The loader works by getting the URL path after the host and looking for a file in the 'route' folder
that matches and loading that set of routes.

```www.foo.com/bar/1233``` looks for a file called ```bar.php``` in the route folder.

If the path after the host is empty it looks for a route named ```base.php```.

If the loader can not find any file that matches, then all the route files are loaded.
