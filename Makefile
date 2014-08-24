MSG_STARTSTOP = $1"ing" $0"..."

.PHONY: all setup start stop test zip

all:
	@echo 'make <target>'
	@echo '    setup'
	@echo '    start'
	@echo '    stop'

setup:
	@(cd wordpress/wp-content/themes/ && ln -s ../../../portalnuvem . && cd -)
	@bundle
	@brew install php55
	@brew install npm
	@npm install yo --save-dev
	@npm install grunt --save-dev
	@npm install generator-wp-theme --save-dev

start:
	$(call compass,start)
	$(call wordpress,start)
	@tail -f *.log

stop:
	$(call compass,stop)
	$(call wordpress,stop)

test:
	@scss-lint sass/

define background
	@nohup $1 > $2 2>&1 &
endef

define kill_it
	@ps aux | egrep "$1" | egrep -v egrep | awk '{ print $$2 }' | xargs kill -9 2>/dev/null
endef

define compass
	@echo $(MSG_STARTSTOP)
	$(if $(filter $1,start),
		$(call background,compass watch .,$0.log)
	,
		$(call kill_it,compass)
	)
endef

define wordpress
	@echo $(MSG_STARTSTOP)
	$(if $(filter $1,start),
		$(call background,php -S localhost:8000 -c php.ini -t wordpress/,$0.log)
	,
		$(call kill_it,php -S localhost:8000)
	)
endef
