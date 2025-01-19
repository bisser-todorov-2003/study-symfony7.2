#!/bin/sh
echo 'Deploy Learning Project'
git add . 
git commit -m "Progress ... "
git push origin master

cd /home/bisser/Work/Projects/Production/study-symfony7.2
git pull