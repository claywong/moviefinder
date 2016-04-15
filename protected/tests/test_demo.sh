#!/bin/bash

APPLICATION_ENV='newdev'
MODULE_NAME='demo'
IDC_NUM=1
IDC_ID=0

export APPLICATION_ENV MODULE_NAME IDC_NUM IDC_ID
phpunit --colors --coverage-html ~/data/coverage/"$MODULE_NAME" --testsuite "$MODULE_NAME" "$1"
