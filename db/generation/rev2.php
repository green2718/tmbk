<?php
// ADD a column to count "Je ne peux me décider" choices
$count_equal = "ALTER TABLE $assoc_table ADD equal int(12) UNSIGNED DEFAULT 0;";
$conn -> exec($count_equal);
echo "Add column for equality\n"

// ADD a column with the number of time the association was selected
$select_count = "ALTER TABLE $assoc_table ADD nb_select int(12) UNSIGNED DEFAULT 0;";
$conn -> exec ($select_count);
$init_count = "UPDATE $assoc_table SET nb_select = val1 + val2 + equal;";
$conn -> exec ($init_count);
echo "Add column to count number of selection of an association\n";
