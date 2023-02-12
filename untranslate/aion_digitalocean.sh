echo "RSYNC AIONIAN BIBLE TO DIGITALCLOUD!"

touch ../www-production-files/do-test
# works
#scp -P 22 -p -i ~/.ssh/id_new -o User=apache  ../www-production-files/do-test 68.183.200.96:/var/www/html/
# rsync is better
rsync -r -a -v --copy-links --progress -e "ssh -i ~/.ssh/id_new -l apache  -p 22" ../www-production-files/ 68.183.200.96:/var/www/html/


echo "DONE"