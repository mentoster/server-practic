<?php
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://nginx-apache-php-docker_redis_1:6379,tcp://nginx-apache-php-docker_redis_1:6379');
