# files to rename


#	-path "../www-archive" -prune -o \
#	-path "../www-production" -prune -o \
#	-path "../www-production-files" -prune -o \
#	-name "*Holy-Bible---Spanish---Free-Bible-NT*" -o \
#	-name "*Holy-Bible---BOOGEY-MAN*" \
find ../ \
	\( \
	-name "*Holy-Bible---Vietnamese---Vietnamese-NT*" \
	\) \
	-print \
	| sort | tee aion_X_rename.nameorig

# file newnames	
cp aion_X_rename.nameorig aion_X_rename.namenew
sed -i \
	-e 's/Holy-Bible---Vietnamese---Vietnamese-NT/Holy-Bible---Vietnamese---Vietnamese-Bible/g' \
	aion_X_rename.namenew

# file rename script	
paste -d" " aion_X_rename.nameorig aion_X_rename.namenew | sed -e "s/^/mv /" >  aion_X_rename.namedoit	
	
	
# files to edit
#	--exclude-dir=www-archive \
#	--exclude-dir=www-production \
#	--exclude-dir=www-production-files \
grep -R -l \
	--exclude=aion_X_rename* \
	--exclude=*.zip \
	--exclude=*.xls \
	-e Holy-Bible---Vietnamese---Vietnamese-NT \
	../ \
	| sort | tee aion_X_rename.edit	

# file edit	script
echo "
cat aion_X_rename.edit |\
xargs \
sed -i \
	-e 's/Holy-Bible---Vietnamese---Vietnamese-NT/Holy-Bible---Vietnamese---Vietnamese-Bible/g'
" \
| tee aion_X_rename.editdoit