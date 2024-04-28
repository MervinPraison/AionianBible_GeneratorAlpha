# files to rename


#	-path "../www-archive" -prune -o \
#	-path "../www-production" -prune -o \
#	-path "../www-production-files" -prune -o \
#	-name "*Holy-Bible---Spanish---Free-Bible-NT*" -o \
#	-name "*Holy-Bible---BOOGEY-MAN*" \
# Holy-Bible---Gourmantche---Gourma-Bible/Holy-Bible---Gourma---Gourma-Bible

find ../ \
	\( \
	-name "*Holy-Bible---Coptic---Sahidic-Bible-2*" \
	\) \
	-print \
	| sort | tee aion_X_rename.nameorig

# file newnames	
cp aion_X_rename.nameorig aion_X_rename.namenew
sed -i \
	-e 's/Holy-Bible---Coptic---Sahidic-Bible-2/Holy-Bible---Coptic---Sahidic-Bible/g' \
	aion_X_rename.namenew

# file rename script	
paste -d" " aion_X_rename.nameorig aion_X_rename.namenew | sed -e "s/^/mv /" >  aion_X_rename.namedoit.2nd	
	
	
# files to edit
#	--exclude-dir=www-archive \
#	--exclude-dir=www-production \
#	--exclude-dir=www-production-files \
grep -R -l \
	--exclude=aion_X_rename* \
	--exclude=*.zip \
	--exclude=*.xls \
	-e Holy-Bible---Coptic---Sahidic-Bible-2 \
	../ \
	| sort | tee aion_X_rename.edit	

# file edit	script
echo "
cat aion_X_rename.edit |\
xargs \
sed -i \
	-e 's/Holy-Bible---Coptic---Sahidic-Bible-2/Holy-Bible---Coptic---Sahidic-Bible/g'
" \
| tee aion_X_rename.editdoit.1st