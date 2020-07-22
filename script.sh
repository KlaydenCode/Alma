#!/usr/bin/env bash

cd $PWD/alma_web
docker-compose up --build -d
cd ../alma_api
./serve.sh
