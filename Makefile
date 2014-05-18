MSG_STARTSTOP = $1"ing" $0"..."

.PHONY: all setup start stop

all:
	@echo 'make <target>'
	@echo '    setup'
	@echo '    start'
	@echo '    stop'

setup:
	@bundle
	@brew install php55
	@brew install npm
	@npm install yo
	@npm install grunt --save-dev
	@npm install generator-wp-theme

start:
	@$(call php,start)
	@$(call compass,start)

stop:
	@$(call compass,stop)
	@$(call php,stop)

define background
	$(shell nohup $1 > /dev/null 2>&1 &)
endef

define kill_it
	@ps aux | egrep "$1" | egrep -v egrep | awk '{ print $$2 }' | xargs kill -9 2>/dev/null
endef

define compass
	@echo $(MSG_STARTSTOP)
	$(if $(filter $1,start),
		@$(call background,compass watch .)
	,
		@$(call kill_it,compass)
	)
endef

define php
	@echo $(MSG_STARTSTOP)
	$(if $(filter $1,start),
		@$(call background,php -S localhost:8000)
	,
		@$(call kill_it,php -S localhost:8000)
	)
endef
