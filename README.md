```shell

# for clone from github
git clone https://github.com/mdShakilHossainNsu2018/cse_482_project.git

# for git status
git status

#  
git add .
git commit -m "<any message>"
git push

# Do every time before start
git fetch
git pull


# for build and recreate
docker-compose up --build
# for only run
docker-compose up

# database init table
docker-compose exec app sh
php -f database/init.php

```

# run sql code for windows 
docker-compose exec db sh
mysql -u user -p
password:password
use db
select * from users;