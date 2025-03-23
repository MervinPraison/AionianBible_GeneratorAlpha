echo "RSYNC AIONIAN BIBLE TO DIGITALCLOUD!"


# works
#touch ../www-production-files/do-test
#scp -P 22 -p -i ~/.ssh/id_new -o User=apache  ../www-production-files/do-test 68.183.200.96:/var/www/html/

# rsync is better
rsync -ravlz --delete --progress -e "ssh -i ~/.ssh/id_new -l apache  -p 22" ../www-resources/ 157.230.69.163:/var/www/www-resources/
rsync -ravlz --delete --progress -e "ssh -i ~/.ssh/id_new -l apache  -p 22" ../www-production-files/ 157.230.69.163:/var/www/html/

echo "DONE"