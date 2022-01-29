test:
	php ./vendor/bin/pest

scan:
	php ./vendor/bin/ecs check

scan-fix:
	php ./vendor/bin/ecs check --fix
