all:
	@echo 'make <target>'
	@echo '    setup'
	@echo '    start'
	@echo '    stop'

setup:
	@bundle
	@brew install npm
	@npm install yo
	@npm install grunt --save-dev
	@npm install generator-wp-theme

start:
	@$(call background,compass watch .)

stop:
	@$(call kill_it,compass)

define background
	$(shell nohup $1 > /dev/null 2>&1 &)
endef

define kill_it
	@ps aux | egrep "$1" | egrep -v egrep | awk '{ print $$2 }' | xargs kill -9 2>/dev/null
endef
