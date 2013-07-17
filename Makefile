help:
	@echo "Available targets:"
	@echo " install - download composer and retrieve dependencies"
	@echo " test - run test suites"
	@echo " doc - generate documentation (requires PHPDocumentor)"
	@echo " clean - remove files created by test/doc commands"
	@echo ""
	@exit 0

test:
	@vendor/bin/phpunit

doc:
	@phpdoc -d src -t doc --template new-black

clean:
	@rm -rf doc/
	@rm -rf build/

install:
	@if [ ! -d ./bin ]; then mkdir bin; fi
	@if [ ! -f ./bin/composer.phar ]; then curl -s http://getcomposer.org/installer | php -n -d allow_url_fopen=1 -d date.timezone="Europe/Berlin" -- --install-dir=./bin/; fi
	@php -n -d allow_url_fopen=1 -d date.timezone="Europe/Berlin" ./bin/composer.phar update --dev

.PHONY: test help
