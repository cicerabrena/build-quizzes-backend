
.DEFAULT_GOAL := help

SA=./vendor/bin/sail artisan

help:
	@echo "Choose action: analyse, sa (sail artisan) or test"

analyse:
	./vendor/bin/sail composer phpstan

sa:
	@ $(SA)

test:
	@ $(SA) test