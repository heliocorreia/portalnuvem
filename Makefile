all:
	@echo 'make <target>'
	@echo '    setup'

setup:
	@brew install npm
	@npm install yo
	@npm install grunt --save-dev
	@npm install generator-wp-theme
