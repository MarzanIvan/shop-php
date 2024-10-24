<h3>To build container you are to move to Docker/ and write that command: </h3><br>

```bash
git clone https://github.com/MarzanIvan/shop-php.git
cd Docker
sudo docker-compose up --build
curl http://localhost:9000/ 
curl http://localhost:9001/

```
<h3>To get sql code for mysql_db:</h3>

```bash
cat "App/Source/The program code of database/Create DB.sql"
```

Docker Configuration
<br>
Here is an overview of the Docker services:<br>


php_env:<br>
This service runs the PHP 8.3 environment for the web application.<br>
The source code is mapped from the App/ directory on the host machine to the /var/www/html directory in the container.<br>
Exposed port: 9000 to access the PHP application.<br>
mysql_db:<br>
The MySQL database is configured with a root password root.<br>
Uses the latest MySQL image.<br>
Automatically restarts if the container stops.<br>
phpmyadmin:<br>
Provides a graphical user interface for MySQL database management.<br>
Accessible via port 9001.<br>
Set up to allow arbitrary server connections using the PMA_ARBITRARY environment variable.<br>
