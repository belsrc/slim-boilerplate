## Configuration
All the config files are located in the app > config folder and broken up into their respective roles.

 * __app__ - Contains various application config rules. Allows setting the timezone, sections to be authenticated,
 auth redirect url and production error string.

 * __database__ - This config allows you to define a production and a development connection.

 * __environment__ - Allows you to set the host name of the production server and development server. Aids in environment detection in the start file.
 Albeit, currently, the development field doesn't really do anything. Its there for future use.

 * __log__ - Allows you to set some configurations associated with Slim's DateTimeFileWriter.

 * __view__ - Allows you to set some configurations associated with Slim's View.
