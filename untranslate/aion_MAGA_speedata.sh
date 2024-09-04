# Make Aionian Great Again

SECONDS=0

echo
echo "*** MAGA Speedata ***"
date
echo

./aion_8_speedata.sh		2>&1 | tee aion_8_speedata.sh.aionian.out
./aion_X_proofer.sh			2>&1 | tee aion_X_proofer.out
./aion_X_proofer_diff.sh	2>&1 | tee aion_X_proofer_diff.out

echo
date
echo "*** MAGA Speedata ***"
ELAPSED="Elapsed: $(($SECONDS / 3600))hrs $((($SECONDS / 60) % 60))min $(($SECONDS % 60))sec"
echo $ELAPSED

