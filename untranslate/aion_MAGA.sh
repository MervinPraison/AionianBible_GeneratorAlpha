# Make Aionian Great Again

echo
echo "*** MAGA - MAKE AIONIAN GREAT AGAIN! ***"
date
echo
echo "*** MAGA Stage Initialization ***"
./aion_3q_stage.sh 2>&1 > aion_3q_stage.sh.aionian.out
diff ./aion_diffout/aion_3q_stage.sh.aionian.out aion_3q_stage.sh.aionian.out 2>&1 | tee aion_3q_stage.sh.diff.aionian.out
yes | cp ../checks/UNTRANSLATEREVERSE.txt		./aion_database
yes | cp ../checks/SKIPPED.txt					./aion_database
yes | cp ../checks/TALLY.txt					./aion_database

echo
echo "*** MAGA Check Initialization ***"
./aion_6q_check.sh 2>&1 > aion_6q_check.sh.aionian.out
diff ./aion_diffout/aion_6q_check.sh.aionian.out aion_6q_check.sh.aionian.out 2>&1 | tee aion_6q_check.sh.diff.aionian.out
yes | cp ../checks/UNTRANSLATEMODULE.txt		./aion_database
yes | cp ../checks/UNTRANSLATEMODULE.txt.sort	./aion_database

echo
echo "*** MAGA Stage Execution ***"
./aion_3_stage.sh 2>&1 > aion_3_stage.sh.aionian.out
diff ./aion_diffout/aion_3_stage.sh.aionian.out aion_3_stage.sh.aionian.out 2>&1 | tee aion_3_stage.sh.diff.aionian.out
yes | cp ../checks/UNICODE_USAGE.txt			./aion_database

echo
echo "*** MAGA Check Execution ***"
./aion_6_check.sh 2>&1 > aion_6_check.sh.aionian.out
diff ./aion_diffout/aion_6_check.sh.aionian.out aion_6_check.sh.aionian.out 2>&1 | tee aion_6_check.sh.diff.aionian.out

echo
echo "*** MAGA CheckX Execution ***"
./aion_X_check.sh
./aion_X_check_diff.sh

echo
echo "*** MAGA Index Build ***"
./aion_5_index.sh 2>&1 > aion_5_index.sh.aionian.out
diff ./aion_diffout/aion_5_index.sh.aionian.out aion_5_index.sh.aionian.out 2>&1 | tee aion_5_index.sh.diff.aionian.out
yes | cp ./aion_customize_index/index.php		../www-stage

echo
echo "*** MAGA Spell Check ***"
./aion_X_spell.sh 2>&1 | tee aion_X_spell.out

#echo
#echo "*** MAGA Speedata ***"
#./aion_8_speedata.sh 2>&1 > aion_8_speedata.sh.aionian.out

echo
date
echo "*** MAGA Review and TODO ***"
echo "Checks"
echo "ChecksX-diff"
echo "diff-www-stage-with-www-production-BEFORE-DEPLOY"
echo "raw-diff-diff"
echo "spellcheck-diff"
echo "Copy MARKERS if needed"
