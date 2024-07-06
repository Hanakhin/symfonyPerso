docker compose up

docker exec -it phpgrp composer install

docker exec -it nodegrp yarn

docker exec -it nodegrp yarn encore dev --watch
