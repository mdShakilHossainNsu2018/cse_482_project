tests:
	XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-html html --testdox --colors tests


.PHONY: tests

