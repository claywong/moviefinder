#!/bin/bash

if [ $# -gt 0 ]
then
    OUTPUT_DIR=$1
    COVERAGE_CLOVER=$OUTPUT_DIR/clover.xml
    COVERAGE_PHP=$OUTPUT_DIR/php
    COVERAGE_HTML=$OUTPUT_DIR/html
    LOG_JUNIT=$OUTPUT_DIR/junit
    echo -e "clean output"
    rm -rf $COVERAGE_CLOVER
    rm -rf $COVERAGE_PHP
    rm -rf $COVERAGE_HTML
    rm -rf $LOG_JUNIT
    mkdir -p $COVERAGE_PHP
    mkdir -p $COVERAGE_HTML
    mkdir -p $LOG_JUNIT
fi

APPLICATION_ENV="testing"
TESTS_DIR=$PWD
CASE_DIR=$TESTS_DIR/../modules/
IDC_NUM=1
IDC_ID=0
STATUS=0

testRate=0

for MODULE_NAME in `ls $CASE_DIR`
do
    export APPLICATION_ENV MODULE_NAME IDC_NUM IDC_ID
    echo -e "\n========= $APPLICATION_ENV --> $MODULE_NAME =========\n"
    if [ -z "$OUTPUT_DIR" ]
    then
        phpunit --testsuite "$MODULE_NAME"
    else
        phpunit --coverage-php $COVERAGE_PHP/"$MODULE_NAME".php --log-junit $LOG_JUNIT/"$MODULE_NAME".xml --testsuite "$MODULE_NAME"
    fi
    STATUS=$(( $STATUS + $? ))
done
if [ -n "$OUTPUT_DIR" ]
then
    echo -e "begin merge coverage report"
    ret=`mergeCoverReport --coverage-clover=$COVERAGE_CLOVER --coverage-html=$COVERAGE_HTML $COVERAGE_PHP`
    data=($ret)
    testRate=${data[2]}
    echo -e "end merge coverage report"
fi
