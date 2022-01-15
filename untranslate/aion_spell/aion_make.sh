for f in *.tar.bz2 ; do
    tar -xvjf $f
done

chmod 700 ./*/configure

for d in */ ; do
	(cd $d && ./configure && make)
done
